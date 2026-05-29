#!/usr/bin/env python3
"""
TibiaWiki BR creature sprite scraper for RavynCore.

Collects outfit images from Lista_de_Criaturas and saves as GIF in:
  ravyncore_website/imagens/creaturestibiawiki/

Usage:
  pip install -r requirements.txt
  python main.py
  python main.py --force
  python main.py --workers 6 --limit 50
"""

from __future__ import annotations

import argparse
import sys
import threading
import time
from concurrent.futures import ThreadPoolExecutor, as_completed
from pathlib import Path

from downloader import CreatureDownloader, DownloadResult
from parser import CreatureEntry, TibiaWikiParser
from utils import (
    DEFAULT_USER_AGENT,
    default_log_dir,
    default_output_dir,
    setup_logging,
)

# Thread-local sessions for parser prefetch in workers
_thread_local = threading.local()
_progress_lock = threading.Lock()


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(
        description="Download TibiaWiki creature sprites as GIF for RavynCore.",
    )
    parser.add_argument(
        "--output",
        type=Path,
        default=default_output_dir(),
        help="Output directory for .gif files",
    )
    parser.add_argument(
        "--force",
        action="store_true",
        help="Re-download even if file already exists (force_download=True)",
    )
    parser.add_argument(
        "--workers",
        type=int,
        default=6,
        help="Parallel download workers (default: 6)",
    )
    parser.add_argument(
        "--limit",
        type=int,
        default=0,
        help="Max creatures to process (0 = all)",
    )
    parser.add_argument(
        "--min-delay",
        type=float,
        default=0.35,
        help="Minimum random delay between requests (seconds)",
    )
    parser.add_argument(
        "--max-delay",
        type=float,
        default=1.1,
        help="Maximum random delay between requests (seconds)",
    )
    parser.add_argument(
        "--list-only",
        action="store_true",
        help="Only list creature count, do not download",
    )
    parser.add_argument(
        "-q",
        "--quiet",
        action="store_true",
        help="Less console output",
    )
    return parser.parse_args()


def print_progress(index: int, total: int, stem: str, result: DownloadResult) -> None:
    status = "SKIP" if result.skipped else ("OK" if result.success else "FAIL")
    line = f"[{index}/{total}] {stem}.gif {status}"
    if not result.success and result.message:
        line += f" — {result.message}"
    with _progress_lock:
        print(line, flush=True)


def worker_task(
    downloader: CreatureDownloader,
    entry: CreatureEntry,
    index: int,
    total: int,
) -> DownloadResult:
    result = downloader.process_creature(entry)
    print_progress(index, total, entry.file_stem, result)
    return result


def main() -> int:
    args = parse_args()
    log_dir = default_log_dir()
    logger = setup_logging(log_dir, verbose=not args.quiet)

    logger.info("TibiaWiki creature scraper — RavynCore")
    logger.info("Source: https://www.tibiawiki.com.br/wiki/Lista_de_Criaturas")
    logger.info("Output: %s", args.output.resolve())

    # Discovery uses its own session
    import requests
    from requests.adapters import HTTPAdapter
    from urllib3.util.retry import Retry

    session = requests.Session()
    session.headers["User-Agent"] = DEFAULT_USER_AGENT
    retry = Retry(total=5, backoff_factor=1.0, status_forcelist=(429, 500, 502, 503, 504))
    session.mount("https://", HTTPAdapter(max_retries=retry))

    parser = TibiaWikiParser(session, min_delay=args.min_delay, max_delay=args.max_delay)
    logger.info("Collecting creature links…")
    entries = parser.collect_creature_entries()
    session.close()

    if not entries:
        logger.error("No creatures found. Check network or Cloudflare blocking.")
        return 1

    if args.limit > 0:
        entries = entries[: args.limit]

    total = len(entries)
    logger.info("Creatures to process: %d", total)

    if args.list_only:
        for e in entries[:20]:
            print(f"  {e.wiki_title} -> {e.file_stem}.gif")
        if total > 20:
            print(f"  … and {total - 20} more")
        return 0

    downloader = CreatureDownloader(
        output_dir=args.output,
        force_download=args.force,
        min_delay=args.min_delay,
        max_delay=args.max_delay,
        logger=logger,
    )

    ok = skip = fail = 0
    start = time.perf_counter()

    # Each worker needs serialized delays inside downloader; limit workers if site blocks
    workers = max(1, min(args.workers, 12))

    if workers == 1:
        for i, entry in enumerate(entries, start=1):
            result = worker_task(downloader, entry, i, total)
            if result.skipped:
                skip += 1
            elif result.success:
                ok += 1
            else:
                fail += 1
    else:
        # One downloader per thread to avoid shared session races
        def run_one(item: tuple[int, CreatureEntry]) -> DownloadResult:
            idx, ent = item
            local = CreatureDownloader(
                output_dir=args.output,
                force_download=args.force,
                min_delay=args.min_delay,
                max_delay=args.max_delay,
                logger=logger,
            )
            try:
                return worker_task(local, ent, idx, total)
            finally:
                local.close()

        with ThreadPoolExecutor(max_workers=workers) as pool:
            futures = {
                pool.submit(run_one, (i, entry)): entry
                for i, entry in enumerate(entries, start=1)
            }
            for fut in as_completed(futures):
                result = fut.result()
                if result.skipped:
                    skip += 1
                elif result.success:
                    ok += 1
                else:
                    fail += 1

    downloader.close()
    elapsed = time.perf_counter() - start

    summary = (
        f"\nDone in {elapsed:.1f}s — OK: {ok}, skipped: {skip}, failed: {fail}, total: {total}\n"
        f"Files: {args.output.resolve()}\n"
        f"Logs: {log_dir.resolve()}"
    )
    print(summary)
    logger.info(
        "Finished — OK=%d skipped=%d failed=%d total=%d elapsed=%.1fs",
        ok,
        skip,
        fail,
        total,
        elapsed,
    )

    return 0 if fail == 0 else 2


if __name__ == "__main__":
    sys.exit(main())
