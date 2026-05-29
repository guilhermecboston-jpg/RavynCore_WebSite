#!/usr/bin/env python3
from pathlib import Path

from PIL import Image

out = Path(__file__).resolve().parents[1] / "static" / "placeholder.png"
out.parent.mkdir(parents=True, exist_ok=True)
img = Image.new("RGBA", (32, 32), (40, 44, 52, 255))
for x in range(8, 24):
    for y in range(8, 24):
        img.putpixel((x, y), (124, 92, 255, 255))
img.save(out)
print("Wrote", out)
