"""Shared utilities for TibiaWiki creature image scraper."""

from __future__ import annotations

import logging
import random
import re
import time
import unicodedata
from pathlib import Path
from typing import Optional

WIKI_BASE = "https://www.tibiawiki.com.br"
WIKI_API = f"{WIKI_BASE}/api.php"
DEFAULT_USER_AGENT = (
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
    "AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
)

# Pages to skip when collecting creature links from Lista_de_Criaturas
SKIP_TITLE_PREFIXES = (
    "Especial:",
    "MediaWiki:",
    "Categoria:",
    "Arquivo:",
    "Predefinição:",
    "Predefinicao:",
    "Ajuda:",
    "Usuário:",
    "Usuario:",
    "TibiaWiki:",
    "Lista_de_",
    "Discussão:",
    "Discussao:",
)

SKIP_EXACT_TITLES = frozenset(
    {
        "Lista_de_Criaturas",
        "Criaturas",
        "Bosses",
        "Rashid",
        "Main_Page",
        "Página_principal",
        "Pagina_principal",
    }
)

IMAGE_SKIP_PATTERN = re.compile(
    r"icon|coin|potion|ring|gem|tick|cross|warning|bosstiary|xpbestiary|"
    r"heal_|físico|fisico|poisoned|burning|cursed|electrified|dazzled|freezing|"
    r"life_drain|summon|heartp\.png|xpbestiary",
    re.IGNORECASE,
)


def project_root() -> Path:
    """RavynCore_website root (parent of scraper/)."""
    return Path(__file__).resolve().parent.parent


def default_output_dir() -> Path:
    return project_root() / "imagens" / "creaturestibiawiki"


def default_log_dir() -> Path:
    return Path(__file__).resolve().parent / "logs"


def normalize_creature_filename(title: str) -> str:
    """
    Convert wiki title to RavynCore file stem.

    Dragon Lord -> dragon_lord
    Demon -> demon
    """
    text = title.strip()
    text = unicodedata.normalize("NFKD", text)
    text = text.encode("ascii", "ignore").decode("ascii")
    text = text.lower()
    text = text.replace("-", "_")
    text = re.sub(r"[^\w\s]", "", text)
    text = re.sub(r"\s+", "_", text)
    text = re.sub(r"_+", "_", text).strip("_")
    return text or "unknown"


def wiki_page_url(title: str) -> str:
    from urllib.parse import quote

    return f"{WIKI_BASE}/wiki/{quote(title.replace(' ', '_'), safe='/')}"


def wiki_file_path_url(file_name: str) -> str:
    from urllib.parse import quote

    return f"{WIKI_BASE}/wiki/Special:FilePath/{quote(file_name, safe='/')}"


def should_skip_wiki_title(title: str) -> bool:
    if not title or title.startswith("#"):
        return True
    if title in SKIP_EXACT_TITLES:
        return True
    for prefix in SKIP_TITLE_PREFIXES:
        if title.startswith(prefix):
            return True
    if ":" in title:
        ns = title.split(":", 1)[0]
        blocked_ns = {
            "Especial",
            "MediaWiki",
            "Categoria",
            "Arquivo",
            "Predefinição",
            "Predefinicao",
            "Ajuda",
            "Usuário",
            "Usuario",
            "TibiaWiki",
            "Discussão",
            "Discussao",
            "Module",
        }
        if ns in blocked_ns:
            return True
    return False


def random_delay(min_s: float, max_s: float) -> None:
    time.sleep(random.uniform(min_s, max_s))


def setup_logging(log_dir: Path, verbose: bool = True) -> logging.Logger:
    log_dir.mkdir(parents=True, exist_ok=True)
    logger = logging.getLogger("tibiawiki_scraper")
    logger.setLevel(logging.DEBUG)
    logger.handlers.clear()

    fmt = logging.Formatter("%(asctime)s [%(levelname)s] %(message)s", datefmt="%Y-%m-%d %H:%M:%S")

    fh = logging.FileHandler(log_dir / "scraper.log", encoding="utf-8")
    fh.setLevel(logging.DEBUG)
    fh.setFormatter(fmt)
    logger.addHandler(fh)

    eh = logging.FileHandler(log_dir / "errors.log", encoding="utf-8")
    eh.setLevel(logging.ERROR)
    eh.setFormatter(fmt)
    logger.addHandler(eh)

    if verbose:
        ch = logging.StreamHandler()
        ch.setLevel(logging.INFO)
        ch.setFormatter(logging.Formatter("%(message)s"))
        logger.addHandler(ch)

    return logger


def log_error(logger: logging.Logger, creature: str, message: str, exc: Optional[BaseException] = None) -> None:
    detail = f"{creature}: {message}"
    if exc:
        logger.error("%s (%s)", detail, exc, exc_info=exc)
    else:
        logger.error(detail)
