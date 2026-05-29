"""RavynCore Asset Engine facade with safe fallback."""

from __future__ import annotations

import logging
from pathlib import Path
from typing import Optional

from . import LEGACY_MESSAGE
from .cache import CacheManager
from .compatibility import CompatibilityReport, ensure_compatible
from .config import EngineConfig, load_config
from .downloader import AssetDownloader
from .parser import AssetParser
from .renderer import AssetRenderer
from .utils import normalize_slug

LOGGER = logging.getLogger("ravyn.asset_engine")


class RavynAssetEngine:
    def __init__(self, cfg: Optional[EngineConfig] = None) -> None:
        self.cfg = cfg or load_config()
        self.report: CompatibilityReport = ensure_compatible(self.cfg)
        self.enabled = self.report.compatible
        self.parser: Optional[AssetParser] = None
        self.downloader: Optional[AssetDownloader] = None
        self.renderer: Optional[AssetRenderer] = None
        self.cache: Optional[CacheManager] = None

        if self.enabled:
            try:
                self.parser = AssetParser(self.cfg)
                self.parser.load()
                self.downloader = AssetDownloader(self.cfg, self.parser)
                self.renderer = AssetRenderer(self.parser, self.downloader)
                self.cache = CacheManager(self.cfg)
                self.cache.ensure_valid()
                LOGGER.info("RavynCore Asset Engine initialized (things/%s)", self.cfg.things_version)
            except Exception as exc:
                LOGGER.exception("Asset engine init failed: %s", exc)
                self.enabled = False
                self.report.compatible = False
                self.report.message = LEGACY_MESSAGE
                self.report.errors.append(str(exc))

    def status(self) -> dict:
        data = self.report.to_dict()
        data["enabled"] = self.enabled
        data["things_version"] = self.cfg.things_version
        data["cache_dir"] = str(self.cfg.cache_dir)
        if self.parser:
            data["counts"] = {
                "items": len(self.parser._things["object"]),
                "outfits": len(self.parser._things["outfit"]),
                "effects": len(self.parser._things["effect"]),
                "missiles": len(self.parser._things["missile"]),
                "sprite_sheets": len(self.parser.sheets),
            }
        return data

    def regenerate_cache(self) -> None:
        if self.cache:
            self.cache.clear()
            self.cache.ensure_valid()
        if self.downloader:
            self.downloader._load_sheet_pixels.cache_clear()

    def _cached_render(
        self,
        category: str,
        cache_key: str,
        render_fn,
    ) -> tuple[Optional[Path], str, bool]:
        if not self.enabled or not self.renderer or not self.cache:
            return None, "png", False

        for ext in ("gif", "png"):
            hit = self.cache.get(category, cache_key, ext)
            if hit:
                return hit, ext, True

        data, ext = render_fn()
        if not data:
            return None, ext, False
        path = self.cache.put_bytes(category, cache_key, ext, data)
        return path, ext, False

    def outfit(
        self,
        outfit_id: int,
        addons: int = 0,
        direction: int = 2,
        head: int = 0,
        body: int = 0,
        legs: int = 0,
        feet: int = 0,
    ) -> tuple[Optional[Path], str, str]:
        key = f"{outfit_id}_a{addons}_d{direction}_h{head}_b{body}_l{legs}_f{feet}"
        path, ext, _ = self._cached_render(
            "outfits",
            key,
            lambda: self.renderer.render_outfit(
                outfit_id,
                addons=addons,
                direction=direction,
                head=head,
                body=body,
                legs=legs,
                feet=feet,
            ),
        )
        return path, ext, self.report.message if not path else ""

    def item(self, item_id: int) -> tuple[Optional[Path], str, str]:
        path, ext, _ = self._cached_render(
            "items",
            str(item_id),
            lambda: self.renderer.render_item(item_id),
        )
        return path, ext, self.report.message if not path else ""

    def monster(self, name_or_id: str | int, direction: int = 2) -> tuple[Optional[Path], str, str]:
        if isinstance(name_or_id, str) and not str(name_or_id).isdigit():
            key = normalize_slug(name_or_id)
        else:
            key = f"race_{int(name_or_id)}"
        path, ext, _ = self._cached_render(
            "monsters",
            f"{key}_d{direction}",
            lambda: self.renderer.render_monster(name_or_id, direction=direction),
        )
        return path, ext, self.report.message if not path else ""

    def effect(self, effect_id: int) -> tuple[Optional[Path], str, str]:
        path, ext, _ = self._cached_render(
            "effects",
            str(effect_id),
            lambda: self.renderer.render_effect(effect_id),
        )
        return path, ext, self.report.message if not path else ""

    def missile(self, missile_id: int) -> tuple[Optional[Path], str, str]:
        path, ext, _ = self._cached_render(
            "missiles",
            str(missile_id),
            lambda: self.renderer.render_missile(missile_id),
        )
        return path, ext, self.report.message if not path else ""


_ENGINE: Optional[RavynAssetEngine] = None


def get_engine(reload: bool = False) -> RavynAssetEngine:
    global _ENGINE
    if _ENGINE is None or reload:
        _ENGINE = RavynAssetEngine()
    return _ENGINE
