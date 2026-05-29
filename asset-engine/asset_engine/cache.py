"""Disk cache with asset fingerprint invalidation."""

from __future__ import annotations

import json
import shutil
from pathlib import Path
from typing import Optional

from .config import EngineConfig
from .utils import file_sha256


class CacheManager:
    SUBDIRS = ("outfits", "monsters", "items", "effects", "missiles")

    def __init__(self, cfg: EngineConfig) -> None:
        self.cfg = cfg
        self.root = Path(cfg.cache_dir)
        for sub in self.SUBDIRS:
            (self.root / sub).mkdir(parents=True, exist_ok=True)

    def path_for(self, category: str, key: str, ext: str) -> Path:
        sub = category.lower()
        if sub not in self.SUBDIRS:
            sub = "items"
        return self.root / sub / f"{key}.{ext}"

    def get(self, category: str, key: str, ext: str) -> Optional[Path]:
        p = self.path_for(category, key, ext)
        return p if p.is_file() and p.stat().st_size > 0 else None

    def put_bytes(self, category: str, key: str, ext: str, data: bytes) -> Path:
        p = self.path_for(category, key, ext)
        p.parent.mkdir(parents=True, exist_ok=True)
        p.write_bytes(data)
        return p

    def fingerprint_assets(self) -> str:
        import hashlib

        h = hashlib.sha256()
        cat = self.cfg.catalog_path
        if cat.is_file():
            h.update(file_sha256(cat).encode())
            data = json.loads(cat.read_text(encoding="utf-8"))
            for entry in data:
                if entry.get("type") == "appearances":
                    ap = self.cfg.things_dir / entry["file"]
                    if ap.is_file():
                        h.update(file_sha256(ap).encode())
        return h.hexdigest()

    def ensure_valid(self) -> bool:
        fp_path = self.cfg.assets_fingerprint_path
        current = self.fingerprint_assets()
        if fp_path.is_file() and fp_path.read_text(encoding="utf-8").strip() == current:
            return True
        self.clear()
        fp_path.parent.mkdir(parents=True, exist_ok=True)
        fp_path.write_text(current, encoding="utf-8")
        return False

    def clear(self) -> None:
        if self.root.is_dir():
            for sub in self.SUBDIRS:
                d = self.root / sub
                if d.is_dir():
                    shutil.rmtree(d, ignore_errors=True)
                    d.mkdir(parents=True, exist_ok=True)
