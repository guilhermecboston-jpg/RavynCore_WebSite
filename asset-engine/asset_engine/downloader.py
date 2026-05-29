"""Lazy sprite sheet loading with in-memory cache."""

from __future__ import annotations

import threading
from functools import lru_cache
from pathlib import Path
from typing import Optional

from PIL import Image

from .config import EngineConfig
from .lzma_sprite import decompress_sprite_sheet
from .parser import AssetParser, SpriteSheetRef
from .utils import SHEET_SIZE, SPRITE_LAYOUT_SIZES


class AssetDownloader:
    def __init__(self, cfg: EngineConfig, parser: AssetParser) -> None:
        self.cfg = cfg
        self.parser = parser
        self.things_dir = cfg.things_dir
        self._lock = threading.RLock()

    @lru_cache(maxsize=48)
    def _load_sheet_pixels(self, file_name: str) -> bytes:
        path = self.things_dir / file_name
        return decompress_sprite_sheet(path)

    def get_sprite_image(self, sprite_id: int) -> Optional[Image.Image]:
        if sprite_id <= 0:
            return None
        sheet = self.parser.sheet_for_sprite(sprite_id)
        if not sheet:
            return None

        w, h = SPRITE_LAYOUT_SIZES.get(sheet.layout, (32, 32))
        columns = SHEET_SIZE // w
        offset = sprite_id - sheet.first_id
        row = offset // columns
        col = offset % columns

        try:
            pixels = self._load_sheet_pixels(sheet.file)
        except Exception:
            return None

        sprite_w_bytes = w * 4
        img = Image.new("RGBA", (w, h))
        px = img.load()
        for yy in range(h):
            src_y = row * h + yy
            src_off = src_y * SHEET_SIZE * 4 + col * sprite_w_bytes
            for xx in range(w):
                i = src_off + xx * 4
                r, g, b, a = pixels[i], pixels[i + 1], pixels[i + 2], pixels[i + 3]
                px[xx, yy] = (r, g, b, a)
        return img
