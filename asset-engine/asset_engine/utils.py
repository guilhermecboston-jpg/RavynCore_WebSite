"""Utilities for RavynCore Asset Engine."""

from __future__ import annotations

import hashlib
import json
import logging
import re
import unicodedata
from pathlib import Path
from typing import Any

LOGGER = logging.getLogger("ravyn.asset_engine")

SPRITE_LAYOUT_SIZES: dict[int, tuple[int, int]] = {
    0: (32, 32),
    1: (32, 64),
    2: (64, 32),
    3: (64, 64),
    4: (32, 96),
    5: (32, 128),
    6: (32, 192),
    7: (32, 384),
    8: (64, 96),
    9: (64, 128),
    10: (64, 192),
    11: (64, 384),
    12: (96, 32),
    13: (96, 64),
    14: (96, 96),
    15: (96, 128),
    16: (96, 192),
    17: (96, 384),
    18: (128, 32),
    19: (128, 64),
    20: (128, 96),
    21: (128, 128),
    22: (128, 192),
    23: (128, 384),
    24: (192, 32),
    25: (192, 64),
    26: (192, 96),
    27: (192, 128),
    28: (192, 192),
    29: (192, 384),
    30: (384, 32),
    31: (384, 64),
    32: (384, 96),
    33: (384, 128),
    34: (384, 192),
    35: (384, 384),
}

SHEET_SIZE = 384
BYTES_IN_SPRITE_SHEET = SHEET_SIZE * SHEET_SIZE * 4
SPRITE_SHEET_WIDTH_BYTES = SHEET_SIZE * 4


def setup_logging(level: int = logging.INFO) -> None:
    logging.basicConfig(
        level=level,
        format="%(asctime)s [%(levelname)s] %(name)s: %(message)s",
    )


def read_json(path: Path) -> Any:
    return json.loads(path.read_text(encoding="utf-8"))


def file_sha256(path: Path) -> str:
    h = hashlib.sha256()
    with path.open("rb") as f:
        for chunk in iter(lambda: f.read(1024 * 1024), b""):
            h.update(chunk)
    return h.hexdigest()


def normalize_slug(name: str) -> str:
    text = unicodedata.normalize("NFKD", name)
    text = text.encode("ascii", "ignore").decode("ascii")
    text = text.lower().replace("-", "_")
    text = re.sub(r"[^\w\s]", "", text)
    text = re.sub(r"\s+", "_", text)
    return re.sub(r"_+", "_", text).strip("_")


def addons_to_ypattern(addons: int) -> int:
    addons = max(0, min(3, int(addons)))
    if addons == 3:
        return 3
    if addons == 2:
        return 2
    if addons == 1:
        return 1
    return 0
