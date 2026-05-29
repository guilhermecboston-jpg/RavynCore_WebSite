#!/usr/bin/env python3
"""TibiaWiki creature GIF scraper for RavynCore images/library."""

from __future__ import annotations

import argparse
import shutil
import sys
import time
from pathlib import Path

from config_slugs import collect_config_slugs, missing_in_library
from downloader import download_gif
from parser import creature_links_from_list, get_gif_for_slug, load_name_map
from utils import LOGGER, ensure_dir, setup_logging, slugify

ROOT = Path(__file__).resolve().parent
WEBSITE = ROOT.parent
DEFAULT_OUT = WEBSITE / "images" / "library"
STAGING = WEBSITE / "imagens" / "creaturestibiawiki"
NAME_MAP = ROOT / "name_map.json"


def run_slugs(slugs: list[str], out_dir: Path, name_map: dict, force: bool) -> tuple[int, int]:
    ok = fail = 0
    for i, slug in enumerate(slugs, 1):
        dest = out_dir / f"{slug}.gif"
        if dest.is_file() and not force and dest.stat().st_size > 500:
            ok += 1
            continue
        LOGGER.info("[%d/%d] %s", i, len(slugs), slug)
        url = get_gif_for_slug(slug, name_map)
        if not url:
            LOGGER.warning("No GIF URL for slug=%s", slug)
            fail += 1
            continue
        if download_gif(url, dest):
            LOGGER.info("OK %s (%d bytes)", dest.name, dest.stat().st_size)
            ok += 1
        else:
            fail += 1
    return ok, fail


def run_full_list(out_dir: Path, limit: int, force: bool, name_map: dict) -> tuple[int, int]:
    links = creature_links_from_list()
    if limit > 0:
        links = links[:limit]
    ok = fail = 0
    for i, (title, _) in enumerate(links, 1):
        slug = slugify(title)
        if not slug:
            continue
        dest = out_dir / f"{slug}.gif"
        if dest.is_file() and not force and dest.stat().st_size > 500:
            ok += 1
            continue
        LOGGER.info("[%d/%d] %s -> %s", i, len(links), title, slug)
        merged = {**name_map, slug: title}
        url = get_gif_for_slug(slug, merged)
        if not url:
            fail += 1
            continue
        if download_gif(url, dest):
            ok += 1
        else:
            fail += 1
    return ok, fail


def main() -> int:
    setup_logging()
    ap = argparse.ArgumentParser(description="RavynCore TibiaWiki creature scraper")
    ap.add_argument("--mode", choices=("missing", "slugs", "full"), default="missing")
    ap.add_argument("--output", type=Path, default=DEFAULT_OUT)
    ap.add_argument("--staging", type=Path, default=STAGING)
    ap.add_argument("--ids", nargs="*")
    ap.add_argument("--limit", type=int, default=0)
    ap.add_argument("--force", action="store_true")
    ap.add_argument("-v", "--verbose", action="store_true")
    args = ap.parse_args()
    if args.verbose:
        setup_logging(True)

    out_dir = ensure_dir(args.output.resolve())
    name_map = load_name_map(NAME_MAP)

    if args.mode == "full":
        t0 = time.time()
        ok, fail = run_full_list(out_dir, args.limit, args.force, name_map)
        LOGGER.info("Finished full — OK=%d failed=%d elapsed=%.1fs", ok, fail, time.time() - t0)
        return 0 if fail == 0 else 1

    if args.mode == "missing":
        slugs = missing_in_library(collect_config_slugs(), out_dir)
        LOGGER.info("Missing from library: %d", len(slugs))
    else:
        slugs = [s.lower() for s in (args.ids or [])]

    if not slugs:
        LOGGER.info("Nothing to download.")
        return 0

    t0 = time.time()
    ok, fail = run_slugs(slugs, out_dir, name_map, args.force)
    if args.staging:
        staging = ensure_dir(args.staging.resolve())
        for slug in slugs:
            src = out_dir / f"{slug}.gif"
            if src.is_file():
                shutil.copy2(src, staging / src.name)

    LOGGER.info(
        "Finished — OK=%d failed=%d total=%d elapsed=%.1fs -> %s",
        ok,
        fail,
        len(slugs),
        time.time() - t0,
        out_dir,
    )
    return 0 if fail == 0 else 1


if __name__ == "__main__":
    raise SystemExit(main())
