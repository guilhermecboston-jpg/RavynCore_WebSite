#!/usr/bin/env python3
"""Replace ONLY image URLs in hunts_config — never touch locations or hunt names."""

import re
import sys
from pathlib import Path

DEFAULT = Path(r"C:\Users\PICHAU\Documents\RavynCore_OTC\modules\game_huntfinder\serverSIDE\hunts_config.lua")
PRODUCTION = Path(r"C:\Users\PICHAU\Desktop\DURVAL\RavynCore\data\scripts\movements\hunts_config.lua")
BASE = "https://www.ravyncore.com/images/library/"


def fix_urls_only(text: str) -> str:
    text = text.replace("http://177.55.153.178/images/library/", BASE)
    text = re.sub(
        r"(https://www\.ravyncore\.com/images/library/[A-Za-z0-9_]+)\.png",
        r"\1.gif",
        text,
    )
    return text


def main() -> None:
    target = Path(sys.argv[1]) if len(sys.argv) > 1 else DEFAULT
    if PRODUCTION.is_file() and target == DEFAULT:
        print("Restoring from production hunts_config (Ravyn Depths locations)...")
        text = PRODUCTION.read_text(encoding="utf-8")
    else:
        text = target.read_text(encoding="utf-8")
    text = fix_urls_only(text)
    target.write_text(text, encoding="utf-8")
    print("Updated URLs only:", target)


if __name__ == "__main__":
    main()
