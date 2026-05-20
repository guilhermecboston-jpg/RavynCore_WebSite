import argparse
import json
from pathlib import Path

from generate_things_cache import (
    SpriteStore,
    find_appearances,
    load_ids_from_xml,
    pick_frame_group,
    resolve_things_root,
    unique_ids,
)


def collect_sheet_files(sprite_store, sprite_ids):
    files = {}
    for sprite_id in sprite_ids:
        sheet = sprite_store.get_sheet_entry(sprite_id)
        if not sheet:
            continue
        files[sheet["file"]] = sheet
    return files


def export_sheet_pngs(sprite_store, sheets, output_root):
    sheets_dir = output_root / "sheets"
    sheets_dir.mkdir(parents=True, exist_ok=True)

    manifest = {}
    for file_name, sheet in sorted(sheets.items()):
        image = sprite_store.load_sheet(sheet)
        target_name = Path(file_name).name
        if target_name.endswith(".bmp.lzma"):
            target_name = target_name[:-9] + ".png"
        else:
            target_name = target_name + ".png"

        target = sheets_dir / target_name
        image.save(target)
        manifest[file_name] = {
            "src": "sheets/" + target_name,
            "first": sheet["first"],
            "last": sheet["last"],
            "spriteWidth": sheet["sprite_width"],
            "spriteHeight": sheet["sprite_height"],
        }
    return manifest


def build_appearance_manifest(appearance):
    group = pick_frame_group(appearance)
    if not group or not group.get("sprite_info"):
        return None

    info = group["sprite_info"]
    return {
        "name": appearance.get("name", ""),
        "patternWidth": info["pattern_width"],
        "patternHeight": info["pattern_height"],
        "patternDepth": info["pattern_depth"],
        "layers": info["layers"],
        "phases": info["phases"],
        "spriteIds": info["sprite_ids"],
    }


def main():
    parser = argparse.ArgumentParser(description="Export web canvas assets from OTC things data.")
    parser.add_argument("--things", default="system/data/things/1524")
    parser.add_argument("--out", default="images/things-web")
    parser.add_argument("--outfits-xml", default="")
    parser.add_argument("--mounts-xml", default="")
    parser.add_argument("--ids", default="")
    args = parser.parse_args()

    things_root = resolve_things_root(args.things)
    catalog = json.loads((things_root / "catalog-content.json").read_text(encoding="utf-8"))
    appearances_file = next((entry["file"] for entry in catalog if entry.get("type") == "appearances"), "")
    if not appearances_file:
        raise RuntimeError("No appearances entry found in catalog-content.json")

    ids = [int(part.strip()) for part in args.ids.split(",") if part.strip()]
    if args.outfits_xml:
        ids.extend(load_ids_from_xml(args.outfits_xml, "outfits"))
    if args.mounts_xml:
        ids.extend(load_ids_from_xml(args.mounts_xml, "mounts"))
    ids = unique_ids(ids)
    if not ids:
        raise RuntimeError("No ids were provided.")

    output_root = Path(args.out)
    output_root.mkdir(parents=True, exist_ok=True)

    appearances = find_appearances(things_root / appearances_file, "outfits", ids)
    sprite_store = SpriteStore(things_root, catalog)

    appearance_manifest = {}
    sprite_ids = set()
    missing = []
    for appearance_id in ids:
        appearance = appearances.get(appearance_id)
        if not appearance:
            missing.append(appearance_id)
            continue

        entry = build_appearance_manifest(appearance)
        if not entry:
            missing.append(appearance_id)
            continue

        appearance_manifest[str(appearance_id)] = entry
        sprite_ids.update(entry["spriteIds"])

    sheets = collect_sheet_files(sprite_store, sprite_ids)
    sheet_manifest = export_sheet_pngs(sprite_store, sheets, output_root)

    manifest = {
        "spriteSheetSize": 384,
        "appearances": appearance_manifest,
        "sheets": sheet_manifest,
    }
    (output_root / "manifest.json").write_text(json.dumps(manifest, separators=(",", ":")), encoding="utf-8")

    print(f"appearances: {len(appearance_manifest)}")
    print(f"sheets: {len(sheet_manifest)}")
    if missing:
        print("missing: " + ",".join(str(value) for value in missing))


if __name__ == "__main__":
    main()
