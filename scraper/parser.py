"""Parse TibiaWiki BR creature pages and list."""

from __future__ import annotations

import json
import re
from pathlib import Path
from typing import Optional
from urllib.parse import quote, unquote, urljoin

import requests
from bs4 import BeautifulSoup

from utils import LIST_URL, USER_AGENT, WIKI_BASE, LOGGER, polite_sleep, wiki_title_from_slug

SESSION = requests.Session()
SESSION.headers.update({"User-Agent": USER_AGENT})


def load_name_map(path: Path) -> dict[str, str]:
    if path.is_file():
        return json.loads(path.read_text(encoding="utf-8"))
    return {}


def fetch_html(url: str, timeout: int = 30) -> Optional[str]:
    try:
        resp = SESSION.get(url, timeout=timeout)
        if resp.status_code != 200:
            LOGGER.warning("HTTP %s for %s", resp.status_code, url)
            return None
        return resp.text
    except requests.RequestException as exc:
        LOGGER.warning("Request failed %s: %s", url, exc)
        return None


def creature_links_from_list() -> list[tuple[str, str]]:
    html = fetch_html(LIST_URL)
    if not html:
        return []
    soup = BeautifulSoup(html, "lxml")
    out: list[tuple[str, str]] = []
    seen: set[str] = set()
    for a in soup.select('a[href^="/wiki/"]'):
        href = a.get("href", "")
        title = a.get("title") or a.get_text(strip=True)
        if not title or ":" in title or title.startswith("Categoria:"):
            continue
        if href in seen:
            continue
        if "/wiki/Lista_" in href or "/wiki/Especial:" in href:
            continue
        seen.add(href)
        out.append((title, urljoin(WIKI_BASE, href)))
    LOGGER.info("Found %d wiki links on creature list", len(out))
    return out


def gif_url_from_creature_page(html: str) -> Optional[str]:
    soup = BeautifulSoup(html, "lxml")
    candidates: list[str] = []

    for img in soup.select("table img, .infobox img, a.image img, img"):
        src = img.get("src") or ""
        if ".gif" in src.lower():
            candidates.append(urljoin(WIKI_BASE, src))

    for a in soup.select('a[href*="/wiki/Arquivo:"], a[href*="/wiki/File:"]'):
        href = a.get("href", "")
        if ".gif" in href.lower():
            candidates.append(urljoin(WIKI_BASE, href))

    for m in re.finditer(r'(?:src|href)="([^"]+\.gif[^"]*)"', html, re.I):
        candidates.append(urljoin(WIKI_BASE, m.group(1)))

    for url in candidates:
        low = url.lower()
        if "/thumb/" in low or "reliable_ram" in low:
            continue
        if "static" not in low and "icon" not in low:
            return url
    return None


def resolve_file_url(wiki_file_url: str) -> Optional[str]:
    if wiki_file_url.lower().endswith(".gif") and "/wiki/images/" in wiki_file_url:
        return wiki_file_url
    name = unquote(wiki_file_url.rsplit("/", 1)[-1])
    if name.lower().endswith(".gif"):
        return f"{WIKI_BASE}/wiki/Especial:FilePath/{quote(name)}"
    html = fetch_html(wiki_file_url)
    if not html:
        return None
    m = re.search(r'(?:src|href)="([^"]+/images/[^"]+\.gif)"', html, re.I)
    if m:
        return urljoin(WIKI_BASE, m.group(1))
    return None


def api_creature_gif_url(wiki_title: str) -> Optional[str]:
    """Resolve animated outfit GIF via MediaWiki API (most reliable)."""
    candidates = [
        f"Arquivo:{wiki_title}.gif",
        f"Arquivo:{wiki_title.replace(' ', '_')}.gif",
        f"File:{wiki_title}.gif",
    ]
    for file_title in candidates:
        try:
            resp = SESSION.get(
                f"{WIKI_BASE}/api.php",
                params={
                    "action": "query",
                    "titles": file_title,
                    "prop": "imageinfo",
                    "iiprop": "url",
                    "format": "json",
                },
                timeout=30,
            )
            if resp.status_code != 200:
                continue
            pages = resp.json().get("query", {}).get("pages", {})
            for page in pages.values():
                if page.get("missing") or "imageinfo" not in page:
                    continue
                url = page["imageinfo"][0].get("url")
                if url and ".gif" in url.lower() and "/thumb/" not in url.lower():
                    return url
        except requests.RequestException:
            continue
    return None


def get_creature_gif_url(wiki_title: str) -> Optional[str]:
    url = api_creature_gif_url(wiki_title)
    if url:
        return url

    page_url = f"{WIKI_BASE}/wiki/{quote(wiki_title.replace(' ', '_'))}"
    html = fetch_html(page_url)
    polite_sleep()
    if not html:
        return None
    gif = gif_url_from_creature_page(html)
    if not gif or "/thumb/" in gif.lower():
        return None
    if "/wiki/Arquivo:" in gif or "/wiki/File:" in gif:
        return resolve_file_url(gif)
    return gif


def get_gif_for_slug(slug: str, name_map: dict[str, str]) -> Optional[str]:
    title = wiki_title_from_slug(slug, name_map)
    return get_creature_gif_url(title)
