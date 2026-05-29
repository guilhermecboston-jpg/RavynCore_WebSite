"""Download and convert creature sprites to RavynCore GIF format."""

from __future__ import annotations

import io
import logging
from dataclasses import dataclass
from pathlib import Path
from typing import Optional

import requests
from PIL import Image
from requests.adapters import HTTPAdapter
from urllib3.util.retry import Retry

from parser import CreatureEntry, TibiaWikiParser
from utils import (
    DEFAULT_USER_AGENT,
    log_error,
    random_delay,
    wiki_file_path_url,
)


@dataclass
class DownloadResult:
    stem: str
    success: bool
    skipped: bool = False
    message: str = ""


class CreatureDownloader:
    def __init__(
        self,
        output_dir: Path,
        force_download: bool = False,
        min_delay: float = 0.35,
        max_delay: float = 1.1,
        timeout: int = 60,
        logger: Optional[logging.Logger] = None,
    ) -> None:
        self.output_dir = output_dir
        self.force_download = force_download
        self.min_delay = min_delay
        self.max_delay = max_delay
        self.timeout = timeout
        self.logger = logger or logging.getLogger("tibiawiki_scraper")
        self.output_dir.mkdir(parents=True, exist_ok=True)
        self.session = self._build_session()
        self.parser = TibiaWikiParser(self.session, min_delay=min_delay, max_delay=max_delay)
        self._seen_hashes: dict[str, str] = {}

    @staticmethod
    def _build_session() -> requests.Session:
        session = requests.Session()
        session.headers.update(
            {
                "User-Agent": DEFAULT_USER_AGENT,
                "Accept": "image/avif,image/webp,image/apng,image/*,*/*;q=0.8",
                "Accept-Language": "pt-BR,pt;q=0.9,en;q=0.8",
            }
        )
        retry = Retry(
            total=5,
            connect=5,
            read=5,
            backoff_factor=1.2,
            status_forcelist=(429, 500, 502, 503, 504),
            allowed_methods=["GET", "HEAD"],
        )
        adapter = HTTPAdapter(max_retries=retry, pool_connections=20, pool_maxsize=20)
        session.mount("https://", adapter)
        session.mount("http://", adapter)
        return session

    def dest_path(self, stem: str) -> Path:
        return self.output_dir / f"{stem}.gif"

    def process_creature(self, entry: CreatureEntry) -> DownloadResult:
        dest = self.dest_path(entry.file_stem)

        if dest.exists() and not self.force_download:
            return DownloadResult(entry.file_stem, True, skipped=True, message="exists")

        try:
            wiki_file = self.parser.resolve_sprite_file(entry.wiki_title)
            if not wiki_file:
                return DownloadResult(
                    entry.file_stem,
                    False,
                    message="sprite not found on wiki page",
                )

            url = wiki_file_path_url(wiki_file)
            raw = self._download_bytes(url)
            if not raw:
                return DownloadResult(entry.file_stem, False, message="empty download")

            if self._is_duplicate(raw, entry.file_stem):
                return DownloadResult(
                    entry.file_stem,
                    False,
                    message="duplicate image content",
                )

            self._save_as_gif(raw, dest)
            return DownloadResult(entry.file_stem, True, message=wiki_file)

        except Exception as exc:  # noqa: BLE001 — log and continue batch
            log_error(self.logger, entry.file_stem, "download failed", exc)
            return DownloadResult(entry.file_stem, False, message=str(exc))

    def _download_bytes(self, url: str) -> Optional[bytes]:
        random_delay(self.min_delay, self.max_delay)
        resp = self.session.get(url, timeout=self.timeout, allow_redirects=True)
        resp.raise_for_status()
        data = resp.content
        if len(data) < 120:
            return None
        if data[:15].lstrip().startswith(b"<!DOCTYPE") or data[:6].lower().startswith(b"<html"):
            return None
        return data

    def _is_duplicate(self, data: bytes, stem: str) -> bool:
        import hashlib

        digest = hashlib.sha256(data).hexdigest()
        existing = self._seen_hashes.get(digest)
        if existing and existing != stem:
            self.logger.warning("Duplicate content: %s same as %s", stem, existing)
            return True
        self._seen_hashes[digest] = stem
        return False

    @staticmethod
    def _save_as_gif(data: bytes, dest: Path) -> None:
        with Image.open(io.BytesIO(data)) as img:
            frames: list[Image.Image] = []
            durations: list[int] = []

            try:
                n_frames = getattr(img, "n_frames", 1)
            except Exception:
                n_frames = 1

            if n_frames > 1:
                for i in range(n_frames):
                    img.seek(i)
                    frame = img.convert("RGBA")
                    frames.append(frame)
                    durations.append(max(int(img.info.get("duration", 100)), 20))
            else:
                frames.append(img.convert("RGBA"))
                durations.append(100)

            if len(frames) == 1:
                frame = frames[0]
                frame.save(
                    dest,
                    format="GIF",
                    save_all=False,
                    transparency=0,
                    disposal=2,
                    optimize=False,
                )
            else:
                frames[0].save(
                    dest,
                    format="GIF",
                    save_all=True,
                    append_images=frames[1:],
                    duration=durations,
                    loop=0,
                    disposal=2,
                    optimize=False,
                )

        if not dest.exists() or dest.stat().st_size < 80:
            raise ValueError("converted GIF is empty or invalid")

    def close(self) -> None:
        self.session.close()
