"""Compose sprites into PNG / animated GIF."""

from __future__ import annotations

import io
from typing import Optional

from PIL import Image

from .downloader import AssetDownloader
from .parser import AssetParser, ThingAppearance
from .utils import addons_to_ypattern


class AssetRenderer:
    def __init__(self, parser: AssetParser, downloader: AssetDownloader) -> None:
        self.parser = parser
        self.downloader = downloader

    def render_thing_frame(
        self,
        thing: ThingAppearance,
        *,
        direction: int = 2,
        addons: int = 0,
        layer: int = -1,
        phase: int = 0,
    ) -> Optional[Image.Image]:
        x = max(0, min(direction, thing.pattern_x - 1))
        y = addons_to_ypattern(addons) if thing.category == "outfit" else 0
        y = min(y, thing.pattern_y - 1)
        z = 0
        ph = phase % max(1, thing.phases)

        canvas: Optional[Image.Image] = None
        max_layer = thing.layers if layer < 0 else min(thing.layers, layer + 1)
        for lay in range(max_layer):
            idx = thing.sprite_index(lay, x, y, z, ph)
            sid = thing.sprite_ids[idx]
            sprite = self.downloader.get_sprite_image(sid)
            if not sprite:
                continue
            if canvas is None:
                canvas = Image.new("RGBA", sprite.size, (0, 0, 0, 0))
            canvas.paste(sprite, (0, 0), sprite)
        return canvas

    def render_thing_animation(
        self,
        thing: ThingAppearance,
        *,
        direction: int = 2,
        addons: int = 0,
    ) -> list[Image.Image]:
        frames: list[Image.Image] = []
        for ph in range(max(1, thing.phases)):
            img = self.render_thing_frame(
                thing, direction=direction, addons=addons, phase=ph
            )
            if img:
                frames.append(img)
        return frames

    def render_outfit(
        self,
        outfit_id: int,
        *,
        addons: int = 0,
        direction: int = 2,
        head: int = 0,
        body: int = 0,
        legs: int = 0,
        feet: int = 0,
        animated: bool = True,
    ) -> tuple[Optional[bytes], str]:
        thing = self.parser.get_thing("outfit", outfit_id)
        if not thing:
            return None, "png"
        frames = self.render_thing_animation(thing, direction=direction, addons=addons)
        if not frames:
            return None, "png"
        if animated and len(frames) > 1:
            return self._encode_gif(frames, thing.phase_durations), "gif"
        return self._encode_png(frames[0]), "png"

    def render_item(self, item_id: int) -> tuple[Optional[bytes], str]:
        thing = self.parser.get_thing("item", item_id)
        if not thing:
            return None, "png"
        img = self.render_thing_frame(thing, direction=0, addons=0, phase=0)
        if not img:
            return None, "png"
        frames = self.render_thing_animation(thing) if thing.phases > 1 else [img]
        if len(frames) > 1:
            return self._encode_gif(frames, thing.phase_durations), "gif"
        return self._encode_png(img), "png"

    def render_monster(
        self,
        name_or_id: str | int,
        *,
        direction: int = 2,
        animated: bool = True,
    ) -> tuple[Optional[bytes], str]:
        creature = self.parser.find_monster(name_or_id)
        if not creature or not creature.outfit.looktype:
            return None, "png"
        addons = int(creature.outfit.lookaddons or 0)
        colors = creature.outfit.colors if creature.outfit.HasField("colors") else None
        return self.render_outfit(
            int(creature.outfit.looktype),
            addons=addons,
            direction=direction,
            head=int(colors.head or 0) if colors else 0,
            body=int(colors.body or 0) if colors else 0,
            legs=int(colors.legs or 0) if colors else 0,
            feet=int(colors.feet or 0) if colors else 0,
            animated=animated,
        )

    def render_effect(self, effect_id: int) -> tuple[Optional[bytes], str]:
        thing = self.parser.get_thing("effect", effect_id)
        if not thing:
            return None, "png"
        frames = self.render_thing_animation(thing)
        if not frames:
            return None, "png"
        if len(frames) > 1:
            return self._encode_gif(frames, thing.phase_durations), "gif"
        return self._encode_png(frames[0]), "png"

    def render_missile(self, missile_id: int) -> tuple[Optional[bytes], str]:
        thing = self.parser.get_thing("missile", missile_id)
        if not thing:
            return None, "png"
        img = self.render_thing_frame(thing)
        if not img:
            return None, "png"
        return self._encode_png(img), "png"

    @staticmethod
    def _encode_png(img: Image.Image) -> bytes:
        buf = io.BytesIO()
        img.save(buf, format="PNG")
        return buf.getvalue()

    @staticmethod
    def _encode_gif(frames: list[Image.Image], durations: list[int]) -> bytes:
        buf = io.BytesIO()
        durs = durations or [100] * len(frames)
        while len(durs) < len(frames):
            durs.append(durs[-1] if durs else 100)
        rgba = [f.convert("RGBA") for f in frames]
        rgba[0].save(
            buf,
            format="GIF",
            save_all=True,
            append_images=rgba[1:],
            duration=durs[: len(frames)],
            loop=0,
            disposal=2,
            transparency=0,
        )
        return buf.getvalue()
