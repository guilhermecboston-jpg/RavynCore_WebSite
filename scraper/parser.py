"""Parse TibiaWiki BR pages and resolve creature sprite URLs."""

from __future__ import annotations

import json
import re
from dataclasses import dataclass
from typing import Iterator, Optional
from urllib.parse import unquote, urlparse

import requests
from bs4 import BeautifulSoup

from utils import (
    IMAGE_SKIP_PATTERN,
    WIKI_API,
    WIKI_BASE,
    normalize_creature_filename,
    random_delay,
    should_skip_wiki_title,
    wiki_file_path_url,
)

LIST_PAGE = "Lista_de_Criaturas"
CATEGORY_FALLBACK = "Criaturas"


@dataclass(frozen=True)
class CreatureEntry:
    wiki_title: str
    file_stem: str


class TibiaWikiParser:
    def __init__(
        self,
        session: requests.Session,
        min_delay: float = 0.35,
        max_delay: float = 1.1,
    ) -> None:
        self.session = session
        self.min_delay = min_delay
        self.max_delay = max_delay

    def _delay(self) -> None:
        random_delay(self.min_delay, self.max_delay)

    def _get_json(self, params: dict) -> Optional[dict]:
        params = {**params, "format": "json"}
        try:
            self._delay()
            resp = self.session.get(WIKI_API, params=params, timeout=45)
            resp.raise_for_status()
            if resp.text.lstrip().startswith("<!DOCTYPE") or resp.text.lstrip().startswith("<html"):
                return None
            return resp.json()
        except (requests.RequestException, json.JSONDecodeError):
            return None

    def _get_html(self, url: str) -> Optional[str]:
        try:
            self._delay()
            resp = self.session.get(url, timeout=45)
            resp.raise_for_status()
            if "Just a moment" in resp.text[:500]:
                return None
            return resp.text
        except requests.RequestException:
            return None

    def collect_creature_entries(self) -> list[CreatureEntry]:
        titles: set[str] = set()
        titles.update(self._titles_from_list_page())
        titles.update(self._titles_from_category(CATEGORY_FALLBACK))

        entries: list[CreatureEntry] = []
        seen_stems: set[str] = set()

        for title in sorted(titles):
            if should_skip_wiki_title(title):
                continue
            stem = normalize_creature_filename(title)
            if not stem or stem in seen_stems:
                continue
            seen_stems.add(stem)
            entries.append(CreatureEntry(wiki_title=title, file_stem=stem))

        return entries

    def _titles_from_list_page(self) -> set[str]:
        titles: set[str] = set()

        # HTML parse (primary — user requirement)
        html = self._get_html(f"{WIKI_BASE}/wiki/{LIST_PAGE}")
        if html:
            titles.update(self._extract_creature_links_from_html(html))

        # API links (pagination)
        continue_token: Optional[str] = None
        while True:
            params = {
                "action": "query",
                "titles": LIST_PAGE,
                "prop": "links",
                "pllimit": "500",
            }
            if continue_token:
                params["plcontinue"] = continue_token

            data = self._get_json(params)
            if not data:
                break

            pages = data.get("query", {}).get("pages", {})
            for page in pages.values():
                for link in page.get("links", []):
                    title = link.get("title")
                    if title and not should_skip_wiki_title(title):
                        titles.add(title)

            cont = data.get("continue", {})
            continue_token = cont.get("plcontinue")
            if not continue_token:
                break

        return titles

    def _titles_from_category(self, category: str) -> set[str]:
        titles: set[str] = set()
        continue_token: Optional[str] = None

        while True:
            params = {
                "action": "query",
                "list": "categorymembers",
                "cmtitle": f"Category:{category}",
                "cmlimit": "500",
                "cmnamespace": "0",
            }
            if continue_token:
                params["cmcontinue"] = continue_token

            data = self._get_json(params)
            if not data:
                break

            for member in data.get("query", {}).get("categorymembers", []):
                title = member.get("title")
                if title:
                    titles.add(title)

            cont = data.get("continue", {})
            continue_token = cont.get("cmcontinue")
            if not continue_token:
                break

        return titles

    def _extract_creature_links_from_html(self, html: str) -> set[str]:
        titles: set[str] = set()
        soup = BeautifulSoup(html, "html.parser")
        content = soup.find("div", class_="mw-parser-output") or soup

        for anchor in content.find_all("a", href=True):
            href = anchor["href"]
            if not href.startswith("/wiki/"):
                continue
            path = unquote(href.split("/wiki/", 1)[-1])
            title = path.replace("_", " ")
            # MediaWiki stores underscores; normalize to API title form
            api_title = path.replace(" ", "_")
            if should_skip_wiki_title(api_title):
                continue
            # Creature pages are usually simple names without namespace
            if "/" in path or "#" in path:
                continue
            titles.add(api_title)

        return titles

    def resolve_sprite_file(self, wiki_title: str) -> Optional[str]:
        """
        Return wiki file name for creature outfit (e.g. Dragon.gif or Dragon_Lord.gif).
        """
        data = self._get_json(
            {
                "action": "parse",
                "page": wiki_title,
                "prop": "images",
            }
        )
        if not data:
            return self._fallback_sprite_from_html(wiki_title)

        images = data.get("parse", {}).get("images") or []
        return self._pick_outfit_gif(images, wiki_title)

    def _fallback_sprite_from_html(self, wiki_title: str) -> Optional[str]:
        from urllib.parse import quote

        html = self._get_html(f"{WIKI_BASE}/wiki/{quote(wiki_title.replace(' ', '_'), safe='/')}")
        if not html:
            return None

        underscored = wiki_title.replace(" ", "_")
        pattern = re.compile(
            rf"(?:{re.escape(underscored)}|{re.escape(wiki_title)})\.(?:gif|png|webp|jpg)",
            re.IGNORECASE,
        )

        for match in pattern.finditer(html):
            ext = match.group(0).split(".")[-1]
            return f"{underscored}.{ext.lower()}"

        soup = BeautifulSoup(html, "html.parser")
        for img in soup.select("img"):
            src = img.get("src") or img.get("data-src") or ""
            if "/images/" not in src:
                continue
            name = Path_from_wiki_src(src)
            if name and not IMAGE_SKIP_PATTERN.search(name):
                return name

        return None

    def _pick_outfit_gif(self, images: list[str], page_title: str) -> Optional[str]:
        underscored = page_title.replace(" ", "_")
        preferred = [
            f"{underscored}.gif",
            f"{page_title}.gif",
            f"{underscored}.png",
            f"{underscored}.webp",
        ]
        for name in preferred:
            if name in images:
                return name

        for name in images:
            lower = name.lower()
            if not lower.endswith((".gif", ".png", ".webp", ".jpg", ".jpeg")):
                continue
            if IMAGE_SKIP_PATTERN.search(name):
                continue
            base = name.rsplit(".", 1)[0].replace("_", " ").lower()
            title_lower = page_title.lower()
            if base == title_lower or title_lower.startswith(base.split()[0]):
                return name

        for name in images:
            lower = name.lower()
            if lower.endswith(".gif") and not IMAGE_SKIP_PATTERN.search(name):
                return name

        for name in images:
            lower = name.lower()
            if lower.endswith((".png", ".webp", ".jpg", ".jpeg")) and not IMAGE_SKIP_PATTERN.search(name):
                return name

        return None

    def sprite_download_url(self, wiki_file: str) -> str:
        return wiki_file_path_url(wiki_file)


def Path_from_wiki_src(src: str) -> Optional[str]:
    """Extract File:Name.ext from /images/a/ab/Name.gif style URL."""
    path = urlparse(src).path
    if "/images/" not in path:
        return None
    filename = path.rsplit("/", 1)[-1]
    if not filename or "." not in filename:
        return None
    return filename


def iter_batches(items: list, size: int) -> Iterator[list]:
    for i in range(0, len(items), size):
        yield items[i : i + size]
