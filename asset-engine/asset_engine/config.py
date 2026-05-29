"""Configuration and path discovery for RavynCore Asset Engine."""

from __future__ import annotations

import json
import os
from dataclasses import dataclass, field
from pathlib import Path
from typing import Optional

ASSET_ENGINE_ROOT = Path(__file__).resolve().parents[1]
WEBSITE_ROOT = ASSET_ENGINE_ROOT.parent
DEFAULT_CACHE = WEBSITE_ROOT / "public" / "cache" / "asset-engine"


@dataclass
class EngineConfig:
    otc_root: Path
    things_version: str = "1524"
    cache_dir: Path = field(default_factory=lambda: DEFAULT_CACHE)
    host: str = "127.0.0.1"
    port: int = 8765
    sprite_size: int = 32
    max_workers: int = 4
    force_modern_engine: bool = False
    legacy_library_url: str = "https://www.ravyncore.com/images/library/"

    @property
    def things_dir(self) -> Path:
        return self.otc_root / "data" / "things" / self.things_version

    @property
    def catalog_path(self) -> Path:
        return self.things_dir / "catalog-content.json"

    @property
    def assets_fingerprint_path(self) -> Path:
        return self.cache_dir / ".assets_fingerprint"


def _discover_otc_root(explicit: Optional[Path] = None) -> Optional[Path]:
    if explicit and explicit.is_dir():
        return explicit.resolve()

    env = os.environ.get("RAVYN_OTC_ROOT") or os.environ.get("OTCLIENT_ROOT")
    if env:
        p = Path(env)
        if p.is_dir():
            return p.resolve()

    candidates = [
        WEBSITE_ROOT.parent / "RavynCore_OTC",
        ASSET_ENGINE_ROOT.parent / "RavynCore_OTC",
        Path(r"C:\Users\PICHAU\Documents\RavynCore_OTC"),
        WEBSITE_ROOT.parent.parent / "RavynCore_OTC",
    ]
    for c in candidates:
        if c.is_dir() and (c / "data" / "things").is_dir():
            return c.resolve()
    return None


def load_config(path: Optional[Path] = None) -> EngineConfig:
    data: dict = {}
    if os.environ.get("RAVYN_CACHE_DIR"):
        data["cache_dir"] = os.environ["RAVYN_CACHE_DIR"]
    cfg_path = path or ASSET_ENGINE_ROOT / "config.json"
    if cfg_path.is_file():
        data = {**data, **json.loads(cfg_path.read_text(encoding="utf-8"))}

    otc = _discover_otc_root(Path(data["otc_root"]) if data.get("otc_root") else None)
    if not otc:
        otc = Path(data.get("otc_root", "."))

    return EngineConfig(
        otc_root=otc,
        things_version=str(data.get("things_version", "1524")),
        cache_dir=Path(data.get("cache_dir", DEFAULT_CACHE)),
        host=str(data.get("asset_engine_host", data.get("host", "127.0.0.1"))),
        port=int(data.get("asset_engine_port", data.get("port", 8765))),
        sprite_size=int(data.get("sprite_size", 32)),
        max_workers=int(data.get("max_workers", 4)),
        force_modern_engine=bool(data.get("force_modern_engine", False)),
        legacy_library_url=str(
            data.get("legacy_library_url", "https://www.ravyncore.com/images/library/")
        ),
    )
