import argparse
import json
import lzma
import re
from pathlib import Path

from PIL import Image


TYPE_FIELDS = {
    "items": 1,
    "outfits": 2,
    "effects": 3,
    "missiles": 4,
}

SPRITE_LAYOUT_SIZES = [
    (32, 32), (32, 64), (64, 32), (64, 64),
    (32, 96), (32, 128), (32, 192), (32, 384),
    (64, 96), (64, 128), (64, 192), (64, 384),
    (96, 32), (96, 64), (96, 96), (96, 128), (96, 192), (96, 384),
    (128, 32), (128, 64), (128, 96), (128, 128), (128, 192), (128, 384),
    (192, 32), (192, 64), (192, 96), (192, 128), (192, 192), (192, 384),
    (384, 32), (384, 64), (384, 96), (384, 128), (384, 192), (384, 384),
]

SPRITE_SHEET_SIZE = 384
SPRITE_SHEET_BYTES = SPRITE_SHEET_SIZE * SPRITE_SHEET_SIZE * 4
OUTFIT_COLORS = [
    0xFFFFFF, 0xFFD4BF, 0xFFE9BF, 0xFFFFBF, 0xE9FFBF, 0xD4FFBF,
    0xBFFFBF, 0xBFFFD4, 0xBFFFE9, 0xBFFFFF, 0xBFE9FF, 0xBFD4FF,
    0xBFBFFF, 0xD4BFFF, 0xE9BFFF, 0xFFBFFF, 0xFFBFE9, 0xFFBFD4,
    0xFFBFBF, 0xDADADA, 0xBF9F8F, 0xBFAF8F, 0xBFBF8F, 0xAFBF8F,
    0x9FBF8F, 0x8FBF8F, 0x8FBF9F, 0x8FBFAF, 0x8FBFBF, 0x8FAFBF,
    0x8F9FBF, 0x8F8FBF, 0x9F8FBF, 0xAF8FBF, 0xBF8FBF, 0xBF8FAF,
    0xBF8F9F, 0xBF8F8F, 0xB6B6B6, 0xBF7F5F, 0xBFAF8F, 0xBFBF5F,
    0x9FBF5F, 0x7FBF5F, 0x5FBF5F, 0x5FBF7F, 0x5FBF9F, 0x5FBFBF,
    0x5F9FBF, 0x5F7FBF, 0x5F5FBF, 0x7F5FBF, 0x9F5FBF, 0xBF5FBF,
    0xBF5F9F, 0xBF5F7F, 0xBF5F5F, 0x919191, 0xBF6A3F, 0xBF943F,
    0xBFBF3F, 0x94BF3F, 0x6ABF3F, 0x3FBF3F, 0x3FBF6A, 0x3FBF94,
    0x3FBFBF, 0x3F94BF, 0x3F6ABF, 0x3F3FBF, 0x6A3FBF, 0x943FBF,
    0xBF3FBF, 0xBF3F94, 0xBF3F6A, 0xBF3F3F, 0x6D6D6D, 0xFF5500,
    0xFFAA00, 0xFFFF00, 0xAAFF00, 0x54FF00, 0x00FF00, 0x00FF54,
    0x00FFAA, 0x00FFFF, 0x00A9FF, 0x0055FF, 0x0000FF, 0x5500FF,
    0xA900FF, 0xFE00FF, 0xFF00AA, 0xFF0055, 0xFF0000, 0x484848,
    0xBF3F00, 0xBF7F00, 0xBFBF00, 0x7FBF00, 0x3FBF00, 0x00BF00,
    0x00BF3F, 0x00BF7F, 0x00BFBF, 0x007FBF, 0x003FBF, 0x0000BF,
    0x3F00BF, 0x7F00BF, 0xBF00BF, 0xBF007F, 0xBF003F, 0xBF0000,
    0x242424, 0x7F2A00, 0x7F5500, 0x7F7F00, 0x557F00, 0x2A7F00,
    0x007F00, 0x007F2A, 0x007F55, 0x007F7F, 0x00547F, 0x002A7F,
    0x00007F, 0x2A007F, 0x54007F, 0x7F007F, 0x7F0055, 0x7F002A,
    0x7F0000,
]


def read_varint(data, pos):
    shift = 0
    value = 0
    while True:
        if pos >= len(data):
            raise ValueError("Unexpected end of protobuf varint")
        byte = data[pos]
        pos += 1
        value |= (byte & 0x7F) << shift
        if not byte & 0x80:
            return value, pos
        shift += 7


def skip_field(data, pos, wire_type):
    if wire_type == 0:
        _, pos = read_varint(data, pos)
        return pos
    if wire_type == 1:
        return pos + 8
    if wire_type == 2:
        length, pos = read_varint(data, pos)
        return pos + length
    if wire_type == 5:
        return pos + 4
    raise ValueError(f"Unsupported protobuf wire type: {wire_type}")


def parse_sprite_info(data):
    info = {
        "pattern_width": 1,
        "pattern_height": 1,
        "pattern_depth": 1,
        "layers": 1,
        "sprite_ids": [],
        "phases": 1,
    }
    pos = 0
    while pos < len(data):
        key, pos = read_varint(data, pos)
        field = key >> 3
        wire = key & 7

        if field in (1, 2, 3, 4, 7) and wire == 0:
            value, pos = read_varint(data, pos)
            if field == 1:
                info["pattern_width"] = max(1, value)
            elif field == 2:
                info["pattern_height"] = max(1, value)
            elif field == 3:
                info["pattern_depth"] = max(1, value)
            elif field == 4:
                info["layers"] = max(1, value)
        elif field == 5 and wire == 0:
            value, pos = read_varint(data, pos)
            info["sprite_ids"].append(value)
        elif field == 5 and wire == 2:
            length, pos = read_varint(data, pos)
            end = pos + length
            while pos < end:
                value, pos = read_varint(data, pos)
                info["sprite_ids"].append(value)
        elif field == 6 and wire == 2:
            length, pos = read_varint(data, pos)
            animation = data[pos:pos + length]
            pos += length
            phases = count_animation_phases(animation)
            if phases > 0:
                info["phases"] = phases
        else:
            pos = skip_field(data, pos, wire)
    return info


def count_animation_phases(data):
    pos = 0
    phases = 0
    while pos < len(data):
        key, pos = read_varint(data, pos)
        field = key >> 3
        wire = key & 7
        if field == 6 and wire == 2:
            length, pos = read_varint(data, pos)
            pos += length
            phases += 1
        else:
            pos = skip_field(data, pos, wire)
    return phases


def parse_frame_group(data):
    group = {"fixed_frame_group": 0, "id": 0, "sprite_info": None}
    pos = 0
    while pos < len(data):
        key, pos = read_varint(data, pos)
        field = key >> 3
        wire = key & 7

        if field in (1, 2) and wire == 0:
            value, pos = read_varint(data, pos)
            if field == 1:
                group["fixed_frame_group"] = value
            else:
                group["id"] = value
        elif field == 3 and wire == 2:
            length, pos = read_varint(data, pos)
            group["sprite_info"] = parse_sprite_info(data[pos:pos + length])
            pos += length
        else:
            pos = skip_field(data, pos, wire)
    return group


def parse_appearance(data):
    appearance = {"id": 0, "name": "", "frame_groups": []}
    pos = 0
    while pos < len(data):
        key, pos = read_varint(data, pos)
        field = key >> 3
        wire = key & 7

        if field == 1 and wire == 0:
            appearance["id"], pos = read_varint(data, pos)
        elif field == 2 and wire == 2:
            length, pos = read_varint(data, pos)
            appearance["frame_groups"].append(parse_frame_group(data[pos:pos + length]))
            pos += length
        elif field == 4 and wire == 2:
            length, pos = read_varint(data, pos)
            appearance["name"] = data[pos:pos + length].decode("utf-8", "ignore")
            pos += length
        else:
            pos = skip_field(data, pos, wire)
    return appearance


def find_appearances(dat_path, type_name, ids):
    wanted_field = TYPE_FIELDS[type_name]
    wanted_ids = set(ids)
    found = {}
    data = dat_path.read_bytes()
    pos = 0
    while pos < len(data) and wanted_ids:
        key, pos = read_varint(data, pos)
        field = key >> 3
        wire = key & 7
        if field == wanted_field and wire == 2:
            length, pos = read_varint(data, pos)
            chunk = data[pos:pos + length]
            pos += length
            appearance = parse_appearance(chunk)
            appearance_id = appearance["id"]
            if appearance_id in wanted_ids:
                found[appearance_id] = appearance
                wanted_ids.remove(appearance_id)
        else:
            pos = skip_field(data, pos, wire)
    return found


def read_7bit_size(data, pos):
    while pos < len(data):
        byte = data[pos]
        pos += 1
        if (byte & 0x80) == 0:
            return pos
    raise ValueError("Invalid CIP LZMA size header")


def decode_cip_lzma_sprite_sheet(raw):
    pos = 0
    while pos < len(raw) and raw[pos] == 0:
        pos += 1
    if pos >= len(raw):
        raise ValueError("Invalid empty sprite sheet")

    pos += 1  # first byte of the constant CIP marker
    pos += 4  # remaining marker bytes
    pos = read_7bit_size(raw, pos)

    lclppb = raw[pos]
    pos += 1
    lc = lclppb % 9
    remainder = lclppb // 9
    lp = remainder % 5
    pb = remainder // 5
    dict_size = int.from_bytes(raw[pos:pos + 4], "little")
    pos += 4
    pos += 8

    decompressed = lzma.decompress(
        raw[pos:],
        format=lzma.FORMAT_RAW,
        filters=[{
            "id": lzma.FILTER_LZMA1,
            "dict_size": dict_size,
            "lc": lc,
            "lp": lp,
            "pb": pb,
        }],
    )

    bmp_offset = int.from_bytes(decompressed[10:14], "little")
    pixels = bytearray(decompressed[bmp_offset:bmp_offset + SPRITE_SHEET_BYTES])
    if len(pixels) != SPRITE_SHEET_BYTES:
        raise ValueError("Decoded sprite sheet has an unexpected size")

    for i in range(0, len(pixels), 4):
        pixels[i], pixels[i + 2] = pixels[i + 2], pixels[i]
        if pixels[i] == 255 and pixels[i + 1] == 0 and pixels[i + 2] == 255:
            pixels[i] = 0
            pixels[i + 1] = 0
            pixels[i + 2] = 0
            pixels[i + 3] = 0

    row_size = SPRITE_SHEET_SIZE * 4
    for y in range(SPRITE_SHEET_SIZE // 2):
        top = y * row_size
        bottom = (SPRITE_SHEET_SIZE - 1 - y) * row_size
        top_row = pixels[top:top + row_size]
        pixels[top:top + row_size] = pixels[bottom:bottom + row_size]
        pixels[bottom:bottom + row_size] = top_row

    return Image.frombytes("RGBA", (SPRITE_SHEET_SIZE, SPRITE_SHEET_SIZE), bytes(pixels))


class SpriteStore:
    def __init__(self, things_root, catalog):
        self.things_root = things_root
        self.sheets = []
        self.loaded = {}
        for entry in catalog:
            if entry.get("type") == "sprite":
                sprite_type = int(entry.get("spritetype", 0))
                sprite_size = SPRITE_LAYOUT_SIZES[sprite_type] if sprite_type < len(SPRITE_LAYOUT_SIZES) else (32, 32)
                self.sheets.append({
                    "first": int(entry["firstspriteid"]),
                    "last": int(entry["lastspriteid"]),
                    "file": entry["file"],
                    "sprite_width": sprite_size[0],
                    "sprite_height": sprite_size[1],
                })

    def get_sheet_entry(self, sprite_id):
        for sheet in self.sheets:
            if sheet["first"] <= sprite_id <= sheet["last"]:
                return sheet
        return None

    def load_sheet(self, sheet):
        file_name = sheet["file"]
        if file_name in self.loaded:
            return self.loaded[file_name]

        raw = (self.things_root / file_name).read_bytes()
        image = decode_cip_lzma_sprite_sheet(raw)
        self.loaded[file_name] = image
        return image

    def get_sprite(self, sprite_id):
        sheet = self.get_sheet_entry(sprite_id)
        if not sheet:
            return None

        image = self.load_sheet(sheet)
        sprite_width = sheet["sprite_width"]
        sprite_height = sheet["sprite_height"]
        columns = max(1, image.width // sprite_width)
        offset = sprite_id - sheet["first"]
        x = (offset % columns) * sprite_width
        y = (offset // columns) * sprite_height
        return image.crop((x, y, x + sprite_width, y + sprite_height))


def get_sprite_index(info, layer, x, y, z, phase):
    return (((phase % info["phases"]) * info["pattern_depth"] + z)
            * info["pattern_height"] + y) * info["pattern_width"] * info["layers"] + x * info["layers"] + layer


def color_multiplier(color_id):
    value = OUTFIT_COLORS[color_id] if 0 <= color_id < len(OUTFIT_COLORS) else 0
    return ((value >> 16) & 0xFF, (value >> 8) & 0xFF, value & 0xFF)


def apply_outfit_colors(base, template, head, body, legs, feet):
    base_pixels = base.load()
    template_pixels = template.load()
    color_ids = {
        "head": color_multiplier(head),
        "body": color_multiplier(body),
        "legs": color_multiplier(legs),
        "feet": color_multiplier(feet),
    }

    for y in range(base.height):
        for x in range(base.width):
            tr, tg, tb, ta = template_pixels[x, y]
            if ta == 0:
                continue

            br, bg, bb, ba = base_pixels[x, y]
            if ba == 0:
                continue

            target = None
            if tr and tg and not tb:
                target = color_ids["head"]
            elif tr and not tg and not tb:
                target = color_ids["body"]
            elif not tr and tg and not tb:
                target = color_ids["legs"]
            elif not tr and not tg and tb:
                target = color_ids["feet"]

            if target is None:
                continue

            cr, cg, cb = target
            base_pixels[x, y] = (int(br * (cr / 255)), int(bg * (cg / 255)), int(bb * (cb / 255)), ba)

    return base


def addon_patterns(addons, max_patterns):
    patterns = [0]
    if addons in (1, 3):
        patterns.append(1)
    if addons in (2, 3):
        patterns.append(2)
    return [pattern for pattern in patterns if pattern < max_patterns]


def pick_frame_group(appearance):
    groups = [g for g in appearance["frame_groups"] if g.get("sprite_info")]
    if not groups:
        return None
    for group in groups:
        if group.get("fixed_frame_group") == 0:
            return group
    return groups[0]


def render_appearance(appearance, sprite_store, direction=2, addons=3, head=95, body=114, legs=39, feet=115):
    group = pick_frame_group(appearance)
    if not group:
        return None

    info = group["sprite_info"]
    sprites = info["sprite_ids"]
    if not sprites:
        return None

    x = min(max(0, direction), info["pattern_width"] - 1)
    z = 0
    phase = 0
    base = None
    template = None

    for y in addon_patterns(addons, info["pattern_height"]):
        for layer in range(info["layers"]):
            index = get_sprite_index(info, layer, x, y, z, phase)
            if index >= len(sprites):
                continue
            sprite = sprite_store.get_sprite(sprites[index])
            if not sprite:
                continue

            if base is None:
                base = Image.new("RGBA", sprite.size, (0, 0, 0, 0))
                template = Image.new("RGBA", sprite.size, (0, 0, 0, 0))

            if layer == 0:
                base.alpha_composite(sprite, (0, 0))
            else:
                template.alpha_composite(sprite, (0, 0))

    if base is None:
        return None

    if template is not None:
        base = apply_outfit_colors(base, template, head, body, legs, feet)

    bbox = base.getbbox()
    if not bbox:
        return None
    return base


def resolve_things_root(root):
    root = Path(root)
    catalog = root / "catalog-content.json"
    if not catalog.exists():
        raise FileNotFoundError(f"catalog-content.json not found in {root}")
    return root


def load_ids_from_xml(path, type_name):
    content = Path(path).read_text(encoding="utf-8", errors="ignore")
    if type_name == "mounts":
        return [int(value) for value in re.findall(r'\bclientid\s*=\s*"(\d+)"', content, flags=re.IGNORECASE)]
    return [int(value) for value in re.findall(r'\blooktype\s*=\s*"(\d+)"', content, flags=re.IGNORECASE)]


def unique_ids(ids):
    seen = set()
    result = []
    for value in ids:
        if value in seen:
            continue
        seen.add(value)
        result.append(value)
    return result


def main():
    parser = argparse.ArgumentParser(description="Generate RavynCore website image cache from OTC things assets.")
    parser.add_argument("--things", default="system/data/things/1524")
    parser.add_argument("--cache", default="images/things-cache")
    parser.add_argument("--type", choices=["outfits", "mounts", "items", "effects", "missiles"], required=True)
    parser.add_argument("--ids", default="", help="Comma-separated appearance ids.")
    parser.add_argument("--xml", default="", help="Read ids from outfits.xml or mounts.xml.")
    parser.add_argument("--direction", type=int, default=2)
    parser.add_argument("--addons", type=int, default=3)
    parser.add_argument("--head", type=int, default=95)
    parser.add_argument("--body", type=int, default=114)
    parser.add_argument("--legs", type=int, default=39)
    parser.add_argument("--feet", type=int, default=115)
    args = parser.parse_args()

    things_root = resolve_things_root(args.things)
    catalog = json.loads((things_root / "catalog-content.json").read_text(encoding="utf-8"))
    appearances_file = next((entry["file"] for entry in catalog if entry.get("type") == "appearances"), "")
    if not appearances_file:
        raise RuntimeError("No appearances entry found in catalog-content.json")

    ids = [int(part.strip()) for part in args.ids.split(",") if part.strip()]
    if args.xml:
        ids.extend(load_ids_from_xml(args.xml, args.type))
    ids = unique_ids(ids)
    if not ids:
        raise RuntimeError("No ids were provided. Use --ids or --xml.")

    output_type = "outfits" if args.type == "mounts" else args.type
    output_dir = Path(args.cache) / output_type
    output_dir.mkdir(parents=True, exist_ok=True)

    proto_type = "outfits" if args.type == "mounts" else args.type
    appearances = find_appearances(things_root / appearances_file, proto_type, ids)
    sprite_store = SpriteStore(things_root, catalog)

    ok = 0
    missing = []
    for appearance_id in ids:
        appearance = appearances.get(appearance_id)
        if not appearance:
            missing.append(appearance_id)
            continue

        image = render_appearance(appearance, sprite_store, args.direction, args.addons, args.head, args.body, args.legs, args.feet)
        if not image:
            missing.append(appearance_id)
            continue

        target = output_dir / f"{appearance_id}.png"
        image.save(target)
        ok += 1
        print(f"generated {output_type}/{appearance_id}.png")

    if missing:
        print("missing: " + ",".join(str(v) for v in missing))
    print(f"done: {ok}/{len(ids)} generated")


if __name__ == "__main__":
    main()
