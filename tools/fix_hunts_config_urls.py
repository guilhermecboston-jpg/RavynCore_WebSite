#!/usr/bin/env python3
"""Point hunts_config.lua image URLs to ravyncore.com GIF library."""

import re
from pathlib import Path

HUNTS = Path(r"C:\Users\PICHAU\Documents\RavynCore_OTC\modules\game_huntfinder\serverSIDE\hunts_config.lua")
BASE = "https://www.ravyncore.com/images/library/"

REPLACEMENTS = {
    "qarapredator": "quarapredator",
}


def main() -> None:
    text = HUNTS.read_text(encoding="utf-8")
    text = text.replace("http://177.55.153.178/images/library/", BASE)
    for old, new in REPLACEMENTS.items():
        text = text.replace(f"/{old}.png", f"/{new}.gif")
        text = text.replace(f"/{old}.gif", f"/{new}.gif")
    text = re.sub(
        r"(https://www\.ravyncore\.com/images/library/[A-Za-z0-9_]+)\.png",
        r"\1.gif",
        text,
    )
    text = text.replace(".jpg", ".jpg")  # keep difficulty banners as jpg if present
    HUNTS.write_text(text, encoding="utf-8")
    print("Updated", HUNTS)


if __name__ == "__main__":
    main()
