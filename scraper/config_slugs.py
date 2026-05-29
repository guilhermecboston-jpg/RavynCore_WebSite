"""Extract creature slugs from Hunt/Boss Finder Lua configs."""

from __future__ import annotations

import re
from pathlib import Path

OTC_DEFAULT = Path(__file__).resolve().parents[2].parent / "RavynCore_OTC" / "modules" / "game_huntfinder" / "serverSIDE"
WEBSITE_ROOT = Path(__file__).resolve().parents[1]


def slugs_from_lua(path: Path) -> set[str]:
    text = path.read_text(encoding="utf-8", errors="ignore")
    return {m.lower() for m in re.findall(r"images/library/([A-Za-z0-9_]+)\.", text)}


def collect_config_slugs(
    otc_side: Path | None = None,
) -> set[str]:
    base = otc_side or Path(r"C:\Users\PICHAU\Documents\RavynCore_OTC\modules\game_huntfinder\serverSIDE")
    slugs: set[str] = set()
    for name in ("hunts_config.lua", "bosses_config.lua"):
        p = base / name
        if p.is_file():
            slugs |= slugs_from_lua(p)
    return slugs


def missing_in_library(slugs: set[str], library_dir: Path) -> list[str]:
    missing = []
    for s in sorted(slugs):
        if s.startswith("aahunt"):
            continue
        if not (library_dir / f"{s}.gif").is_file():
            missing.append(s)
    return missing
