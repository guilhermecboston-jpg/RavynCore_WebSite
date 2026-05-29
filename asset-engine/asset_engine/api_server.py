"""FastAPI HTTP API for RavynCore Asset Engine."""

from __future__ import annotations

import logging
from pathlib import Path
from typing import Optional

from fastapi import FastAPI, HTTPException, Query
from fastapi.responses import FileResponse, JSONResponse, PlainTextResponse
from fastapi.staticfiles import StaticFiles

from . import LEGACY_MESSAGE
from .config import ASSET_ENGINE_ROOT, load_config
from .engine import RavynAssetEngine, get_engine
from .utils import setup_logging

LOGGER = logging.getLogger("ravyn.asset_engine.api")

PLACEHOLDER = ASSET_ENGINE_ROOT / "static" / "placeholder.png"


def create_app(engine: Optional[RavynAssetEngine] = None) -> FastAPI:
    setup_logging()
    app = FastAPI(
        title="RavynCore Asset Engine",
        version="1.0.0",
        description="Render OTC appearance.dat assets for MyAAC/RavynCore website.",
    )
    eng = engine or get_engine()

    admin_dir = ASSET_ENGINE_ROOT / "admin"
    if admin_dir.is_dir():
        app.mount("/admin", StaticFiles(directory=str(admin_dir), html=True), name="admin")

    @app.get("/health")
    def health():
        return {"ok": True, "engine": eng.status()}

    @app.get("/api/status")
    def status():
        return eng.status()

    @app.post("/api/cache/regenerate")
    def regenerate_cache():
        if not eng.enabled:
            return JSONResponse(
                {"ok": False, "message": LEGACY_MESSAGE, "status": eng.status()},
                status_code=503,
            )
        eng.regenerate_cache()
        return {"ok": True, "message": "Cache cleared and fingerprint updated."}

    def _file_response(path: Optional[Path], ext: str, legacy_msg: str):
        if path and path.is_file():
            media = "image/gif" if ext == "gif" else "image/png"
            return FileResponse(path, media_type=media, filename=path.name)
        if not eng.enabled:
            return PlainTextResponse(legacy_msg, status_code=503)
        if PLACEHOLDER.is_file():
            return FileResponse(PLACEHOLDER, media_type="image/png")
        raise HTTPException(404, "Asset not found")

    @app.get("/api/outfit")
    def api_outfit(
        id: int = Query(..., alias="id"),
        addons: int = 0,
        direction: int = 2,
        head: int = 0,
        body: int = 0,
        legs: int = 0,
        feet: int = 0,
    ):
        path, ext, msg = eng.outfit(id, addons, direction, head, body, legs, feet)
        return _file_response(path, ext, msg or LEGACY_MESSAGE)

    @app.get("/api/item")
    def api_item(id: int = Query(..., alias="id")):
        path, ext, msg = eng.item(id)
        return _file_response(path, ext, msg or LEGACY_MESSAGE)

    @app.get("/api/monster")
    def api_monster(
        id: str = Query(..., alias="id"),
        direction: int = 2,
    ):
        key: str | int = int(id) if id.isdigit() else id
        path, ext, msg = eng.monster(key, direction=direction)
        return _file_response(path, ext, msg or LEGACY_MESSAGE)

    @app.get("/api/effect")
    def api_effect(id: int = Query(..., alias="id")):
        path, ext, msg = eng.effect(id)
        return _file_response(path, ext, msg or LEGACY_MESSAGE)

    @app.get("/api/missile")
    def api_missile(id: int = Query(..., alias="id")):
        path, ext, msg = eng.missile(id)
        return _file_response(path, ext, msg or LEGACY_MESSAGE)

    return app


def run_server(host: Optional[str] = None, port: Optional[int] = None) -> None:
    import uvicorn

    cfg = load_config()
    app = create_app()
    uvicorn.run(app, host=host or cfg.host, port=port or cfg.port, log_level="info")
