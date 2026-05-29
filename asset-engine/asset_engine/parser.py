"""Parse catalog-content.json and appearances.dat (protobuf)."""

from __future__ import annotations

import json
from dataclasses import dataclass, field
from pathlib import Path
from typing import Optional

from .config import EngineConfig
from .generated import appearances_pb2, staticdata_pb2
from .utils import read_json


@dataclass
class SpriteSheetRef:
    file: str
    first_id: int
    last_id: int
    layout: int

    @property
    def columns(self) -> int:
        from .utils import SPRITE_LAYOUT_SIZES, SHEET_SIZE

        w, _ = SPRITE_LAYOUT_SIZES.get(self.layout, (32, 32))
        return SHEET_SIZE // w


@dataclass
class ThingAppearance:
    category: str
    id: int
    layers: int
    pattern_x: int
    pattern_y: int
    pattern_z: int
    phases: int
    sprite_ids: list[int] = field(default_factory=list)
    phase_durations: list[int] = field(default_factory=list)

    def sprite_index(self, layer: int, x: int, y: int, z: int, phase: int) -> int:
        """Matches ThingType::getSpriteIndex(w=-1, h=-1, ...) in OTClient."""
        if not self.sprite_ids:
            return 0
        a = phase % max(1, self.phases)
        idx = (
            (((a * self.pattern_z + z) * self.pattern_y + y) * self.pattern_x + x)
            * self.layers
            + layer
        )
        return min(idx, len(self.sprite_ids) - 1)


class AssetParser:
    CATEGORY_MAP = {
        "item": "object",
        "outfit": "outfit",
        "creature": "outfit",
        "effect": "effect",
        "missile": "missile",
    }

    def __init__(self, cfg: EngineConfig) -> None:
        self.cfg = cfg
        self.things_dir = cfg.things_dir
        self._catalog: list[dict] = []
        self._sheets: list[SpriteSheetRef] = []
        self._appearances: Optional[appearances_pb2.Appearances] = None
        self._staticdata: Optional[staticdata_pb2.Staticdata] = None
        self._things: dict[str, dict[int, ThingAppearance]] = {
            "object": {},
            "outfit": {},
            "effect": {},
            "missile": {},
        }
        self._monster_by_name: dict[str, staticdata_pb2.Creature] = {}
        self._monster_by_race: dict[int, staticdata_pb2.Creature] = {}

    def load(self) -> None:
        self._catalog = read_json(self.cfg.catalog_path)
        appearances_file = None
        staticdata_file = None

        for entry in self._catalog:
            t = entry.get("type")
            if t == "appearances":
                appearances_file = entry.get("file")
            elif t == "staticdata":
                staticdata_file = entry.get("file")
            elif t == "sprite":
                self._sheets.append(
                    SpriteSheetRef(
                        file=entry["file"],
                        first_id=int(entry["firstspriteid"]),
                        last_id=int(entry["lastspriteid"]),
                        layout=int(entry.get("spritetype", 0)),
                    )
                )

        if appearances_file:
            path = self.things_dir / appearances_file
            blob = appearances_pb2.Appearances()
            blob.ParseFromString(path.read_bytes())
            self._appearances = blob
            self._index_appearances()

        if staticdata_file:
            path = self.things_dir / staticdata_file
            blob = staticdata_pb2.Staticdata()
            blob.ParseFromString(path.read_bytes())
            self._staticdata = blob
            self._index_staticdata()

        self._sheets.sort(key=lambda s: s.first_id)

    def _index_staticdata(self) -> None:
        if not self._staticdata:
            return
        for creature in list(self._staticdata.monsters) + list(self._staticdata.bosses):
            name = (creature.name or "").strip().lower()
            if name:
                self._monster_by_name[name] = creature
            if creature.raceId:
                self._monster_by_race[int(creature.raceId)] = creature

    def _index_appearances(self) -> None:
        assert self._appearances
        groups = [
            ("object", self._appearances.object),
            ("outfit", self._appearances.outfit),
            ("effect", self._appearances.effect),
            ("missile", self._appearances.missile),
        ]
        for cat, repeated in groups:
            for app in repeated:
                thing = self._parse_appearance(cat, app)
                if thing:
                    self._things[cat][thing.id] = thing

    def _parse_appearance(self, category: str, app) -> Optional[ThingAppearance]:
        if not app.frame_group:
            return None

        # Prefer moving animation, else idle, else first group
        fg = None
        for candidate in app.frame_group:
            if candidate.fixed_frame_group == 1:
                fg = candidate
                break
        if fg is None:
            for candidate in app.frame_group:
                if candidate.fixed_frame_group == 0:
                    fg = candidate
                    break
        if fg is None:
            fg = app.frame_group[0]

        si = fg.sprite_info
        phases = max(1, len(si.animation.sprite_phase)) if si.animation.sprite_phase else 1
        durations = []
        if si.animation.sprite_phase:
            for ph in si.animation.sprite_phase:
                d = int(ph.duration_min or 100)
                durations.append(max(50, d))
        else:
            durations = [100] * phases

        sprite_ids = list(si.sprite_id)
        if not sprite_ids:
            return None

        return ThingAppearance(
            category=category,
            id=int(app.id),
            layers=max(1, int(si.layers or 1)),
            pattern_x=max(1, int(si.pattern_width or 1)),
            pattern_y=max(1, int(si.pattern_height or 1)),
            pattern_z=max(1, int(si.pattern_depth or 1)),
            phases=phases,
            sprite_ids=sprite_ids,
            phase_durations=durations,
        )

    def get_thing(self, category: str, thing_id: int) -> Optional[ThingAppearance]:
        key = self.CATEGORY_MAP.get(category.lower(), category.lower())
        return self._things.get(key, {}).get(int(thing_id))

    def find_monster(self, name_or_id: str | int) -> Optional[staticdata_pb2.Creature]:
        if isinstance(name_or_id, int) or str(name_or_id).isdigit():
            return self._monster_by_race.get(int(name_or_id))
        return self._monster_by_name.get(str(name_or_id).strip().lower())

    @property
    def sheets(self) -> list[SpriteSheetRef]:
        return self._sheets

    def sheet_for_sprite(self, sprite_id: int) -> Optional[SpriteSheetRef]:
        for sheet in self._sheets:
            if sheet.first_id <= sprite_id <= sheet.last_id:
                return sheet
        return None
