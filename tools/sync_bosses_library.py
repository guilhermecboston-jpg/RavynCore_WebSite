#!/usr/bin/env python3
"""Copy boss creature GIFs from imagens/creaturestibiawiki to images/library.

Reads slugs only from bosses_config.lua (never hunts_config).
"""

from __future__ import annotations

import argparse
import json
import re
import shutil
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
STAGING = ROOT / "imagens" / "creaturestibiawiki"
LIBRARY = ROOT / "images" / "library"
DEFAULT_BOSSES = Path(
    r"C:\Users\PICHAU\Documents\RavynCore_OTC\modules\game_huntfinder\serverSIDE\bosses_config.lua"
)
ALIASES_FILE = Path(__file__).with_name("boss_staging_aliases.json")


def slugs_from_bosses_config(path: Path) -> set[str]:
    text = path.read_text(encoding="utf-8", errors="ignore")
    slugs: set[str] = set()
    for block in re.findall(r"bossImages\(([^)]+)\)", text):
        slugs.update(s.lower() for s in re.findall(r'"([^"]+)"', block))
    slugs |= {m.lower() for m in re.findall(r"images/library/([A-Za-z0-9_]+)\.", text)}
    slugs.discard("aahunthard")
    return slugs


def load_aliases(path: Path) -> dict[str, str]:
    if not path.is_file():
        return {}
    data = json.loads(path.read_text(encoding="utf-8"))
    return {k.lower(): v.lower() for k, v in data.items()}


def resolve_source(slug: str, staging: Path, aliases: dict[str, str]) -> Path | None:
    direct = staging / f"{slug}.gif"
    if direct.is_file():
        return direct
    alt = aliases.get(slug)
    if alt:
        p = staging / f"{alt}.gif"
        if p.is_file():
            return p
    return None


def sync_bosses(
    bosses_lua: Path,
    staging: Path,
    library: Path,
    aliases: dict[str, str],
    *,
    dry_run: bool,
    force: bool,
) -> int:
    if not bosses_lua.is_file():
        print(f"bosses_config not found: {bosses_lua}", file=sys.stderr)
        return 1
    if not staging.is_dir():
        print(f"staging folder not found: {staging}", file=sys.stderr)
        return 1

    slugs = sorted(slugs_from_bosses_config(bosses_lua))
    print(f"Boss slugs in {bosses_lua.name}: {len(slugs)}")

    copied = missing_staging = already_ok = 0
    for slug in slugs:
        src = resolve_source(slug, staging, aliases)
        dest = library / f"{slug}.gif"
        if src is None:
            if dest.is_file():
                already_ok += 1
                continue
            missing_staging += 1
            print(f"  missing staging: {slug}.gif")
            continue
        if dest.is_file() and not force:
            if dest.stat().st_size >= src.stat().st_size:
                already_ok += 1
                continue
        label = slug if src.name == f"{slug}.gif" else f"{slug} <- {src.name}"
        if dry_run:
            print(f"  would copy: {label}")
            copied += 1
            continue
        library.mkdir(parents=True, exist_ok=True)
        shutil.copy2(src, dest)
        print(f"  copied: {label}")
        copied += 1

    print(
        f"Done: copied={copied}, unchanged={already_ok}, "
        f"missing_in_staging={missing_staging}"
    )
    return 1 if missing_staging else 0


def main() -> None:
    ap = argparse.ArgumentParser(description="Sync boss GIFs to images/library")
    ap.add_argument("--bosses-config", type=Path, default=DEFAULT_BOSSES)
    ap.add_argument("--aliases", type=Path, default=ALIASES_FILE)
    ap.add_argument("--staging", type=Path, default=STAGING)
    ap.add_argument("--library", type=Path, default=LIBRARY)
    ap.add_argument("--dry-run", action="store_true")
    ap.add_argument("--force", action="store_true", help="Overwrite even if dest exists")
    args = ap.parse_args()
    raise SystemExit(
        sync_bosses(
            args.bosses_config,
            args.staging,
            args.library,
            load_aliases(args.aliases),
            dry_run=args.dry_run,
            force=args.force,
        )
    )


if __name__ == "__main__":
    main()
