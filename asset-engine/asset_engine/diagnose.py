"""Diagnostics for missing or failed asset renders."""

from __future__ import annotations

from typing import Any, Optional

from .engine import RavynAssetEngine


def diagnose_outfit(engine: RavynAssetEngine, outfit_id: int, addons: int = 0, direction: int = 2) -> dict[str, Any]:
    result: dict[str, Any] = {
        "outfit_id": outfit_id,
        "engine_enabled": engine.enabled,
        "things_dir": str(engine.cfg.things_dir),
        "catalog_exists": engine.cfg.catalog_path.is_file(),
        "in_appearances": False,
        "layers": 0,
        "phases": 0,
        "sprite_ids": 0,
        "render_ok": False,
        "cache_file": None,
        "hints": [],
    }

    if not engine.cfg.catalog_path.is_file():
        result["hints"].append(
            "catalog-content.json ausente na VPS. Copie data/things/1524 do PC (rsync). git pull nao envia sprites."
        )
        return result

    if not engine.enabled:
        result["hints"].append(engine.report.message)
        result["hints"].extend(engine.report.errors)
        return result

    thing = engine.parser.get_thing("outfit", outfit_id) if engine.parser else None
    if not thing:
        result["hints"].append("ID nao encontrado em appearances.dat (outfit).")
        return result

    result["in_appearances"] = True
    result["layers"] = thing.layers
    result["phases"] = thing.phases
    result["sprite_ids"] = len(thing.sprite_ids)

    if not thing.sprite_ids:
        result["hints"].append("Outfit existe mas sem sprite_id no frame group escolhido.")
        return result

    path, ext, msg = engine.outfit(outfit_id, addons=addons, direction=direction)
    result["render_ok"] = path is not None and path.is_file()
    result["cache_file"] = str(path) if path else None
    result["format"] = ext
    if not result["render_ok"]:
        result["hints"].append("Render falhou (spritesheet LZMA ou indice invalido).")
        if msg:
            result["hints"].append(msg)
    return result
