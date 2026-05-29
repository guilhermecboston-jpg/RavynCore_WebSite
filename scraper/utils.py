"""Shared helpers for TibiaWiki scraper."""

from __future__ import annotations

import logging
import re
import time
import unicodedata
from pathlib import Path

USER_AGENT = (
    "RavynCoreLibraryBot/1.0 (+https://www.ravyncore.com; creature library sync)"
)
WIKI_BASE = "https://www.tibiawiki.com.br"
LIST_URL = f"{WIKI_BASE}/wiki/Lista_de_Criaturas"

LOGGER = logging.getLogger("ravyn.scraper")


def setup_logging(verbose: bool = False) -> None:
    level = logging.DEBUG if verbose else logging.INFO
    logging.basicConfig(
        level=level,
        format="%(asctime)s [%(levelname)s] %(message)s",
        datefmt="%Y-%m-%d %H:%M:%S",
    )


def slugify(name: str) -> str:
    text = unicodedata.normalize("NFKD", name)
    text = text.encode("ascii", "ignore").decode("ascii")
    text = text.lower().replace("-", "").replace("'", "")
    text = re.sub(r"[^a-z0-9]+", "", text)
    return text


def wiki_title_from_slug(slug: str, name_map: dict[str, str]) -> str:
    if slug in name_map:
        return name_map[slug]
    parts = re.findall(r"[a-z]+|\d+", slug.lower())
    if not parts:
        return slug
    return " ".join(p.capitalize() for p in parts)


def polite_sleep(seconds: float = 0.35) -> None:
    time.sleep(seconds)


def ensure_dir(path: Path) -> Path:
    path.mkdir(parents=True, exist_ok=True)
    return path
