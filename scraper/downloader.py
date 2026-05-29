"""Download creature GIFs."""

from __future__ import annotations

from pathlib import Path

import requests

from utils import USER_AGENT, LOGGER, ensure_dir

SESSION = requests.Session()
SESSION.headers.update({"User-Agent": USER_AGENT})


def download_gif(url: str, dest: Path, timeout: int = 45) -> bool:
    try:
        resp = SESSION.get(url, timeout=timeout)
        if resp.status_code != 200:
            LOGGER.warning("Download HTTP %s: %s", resp.status_code, url)
            return False
        data = resp.content
        if len(data) < 200:
            LOGGER.warning("File too small (%d bytes): %s", len(data), dest.name)
            return False
        ensure_dir(dest.parent)
        dest.write_bytes(data)
        return True
    except requests.RequestException as exc:
        LOGGER.warning("Download error %s: %s", dest.name, exc)
        return False
