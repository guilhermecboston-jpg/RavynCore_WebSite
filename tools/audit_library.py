#!/usr/bin/env python3
"""Audit images/library vs hunt/boss Lua configs."""
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
LIB = ROOT / "images" / "library"
OTC = Path(r"C:\Users\PICHAU\Documents\RavynCore_OTC\modules\game_huntfinder\serverSIDE")

def slugs_from_file(path: Path) -> set[str]:
    text = path.read_text(encoding="utf-8", errors="ignore")
    return {m.lower() for m in re.findall(r"images/library/([A-Za-z0-9_]+)\.", text)}

def main() -> None:
    slugs = slugs_from_file(OTC / "hunts_config.lua") | slugs_from_file(OTC / "bosses_config.lua")
    hunts = (OTC / "hunts_config.lua").read_text(encoding="utf-8", errors="ignore")
    old_ip = hunts.count("177.55.153.178")
    ravyn = hunts.count("ravyncore.com")
    missing = sorted(s for s in slugs if not (LIB / f"{s}.gif").is_file())
    png_only = sorted(
        s for s in slugs if (LIB / f"{s}.png").is_file() and not (LIB / f"{s}.gif").is_file()
    )
    print(f"Slugs in configs: {len(slugs)}")
    print(f"hunts_config old IP URLs: {old_ip}")
    print(f"hunts_config ravyncore URLs: {ravyn}")
    print(f"PNG only (no GIF): {len(png_only)}")
    print(f"Missing .gif in library: {len(missing)}")
    for s in missing[:80]:
        print(f"  - {s}")
    if len(missing) > 80:
        print(f"  ... +{len(missing) - 80} more")

if __name__ == "__main__":
    main()
