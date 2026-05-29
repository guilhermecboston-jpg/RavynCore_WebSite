#!/usr/bin/env python3
"""RavynCore Asset Engine CLI."""

from __future__ import annotations

import argparse
import json
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parent
if str(ROOT) not in sys.path:
    sys.path.insert(0, str(ROOT))

from asset_engine.compatibility import run_compatibility_check
from asset_engine.config import load_config
from asset_engine.engine import RavynAssetEngine, get_engine
from asset_engine.utils import setup_logging


def cmd_check(_: argparse.Namespace) -> int:
    cfg = load_config()
    report = run_compatibility_check(cfg)
    print(json.dumps(report.to_dict(), indent=2, ensure_ascii=False))
    return 0 if report.compatible else 1


def cmd_status(_: argparse.Namespace) -> int:
    eng = get_engine(reload=True)
    print(json.dumps(eng.status(), indent=2, ensure_ascii=False))
    return 0


def cmd_serve(args: argparse.Namespace) -> int:
    from asset_engine.api_server import run_server

    run_server(host=args.host, port=args.port)
    return 0


def cmd_render(args: argparse.Namespace) -> int:
    eng = RavynAssetEngine()
    if not eng.enabled:
        print(eng.report.message, file=sys.stderr)
        return 1
    if args.kind == "outfit":
        path, ext, _ = eng.outfit(args.id, addons=args.addons, direction=args.direction)
    elif args.kind == "item":
        path, ext, _ = eng.item(args.id)
    elif args.kind == "monster":
        path, ext, _ = eng.monster(args.id, direction=args.direction)
    elif args.kind == "effect":
        path, ext, _ = eng.effect(args.id)
    else:
        path, ext, _ = eng.missile(args.id)
    if not path:
        print("Render failed", file=sys.stderr)
        return 2
    print(f"{path} ({ext})")
    return 0


def cmd_diagnose(args: argparse.Namespace) -> int:
    from asset_engine.diagnose import diagnose_outfit

    eng = RavynAssetEngine()
    if args.kind != "outfit":
        print("Only outfit diagnose supported in CLI for now.", file=sys.stderr)
        return 1
    print(json.dumps(diagnose_outfit(eng, int(args.id), addons=args.addons), indent=2, ensure_ascii=False))
    return 0


def cmd_regenerate_cache(_: argparse.Namespace) -> int:
    eng = get_engine(reload=True)
    if not eng.enabled:
        print(eng.report.message)
        return 1
    eng.regenerate_cache()
    print("Cache regenerated.")
    return 0


def main() -> int:
    setup_logging()
    parser = argparse.ArgumentParser(description="RavynCore Asset Engine")
    sub = parser.add_subparsers(dest="command", required=True)

    sub.add_parser("check", help="Run compatibility checks (safe mode)").set_defaults(func=cmd_check)
    sub.add_parser("status", help="Engine status JSON").set_defaults(func=cmd_status)
    sub.add_parser("regenerate-cache", help="Clear rendered cache").set_defaults(func=cmd_regenerate_cache)

    p_serve = sub.add_parser("serve", help="Start HTTP API")
    p_serve.add_argument("--host", default=None)
    p_serve.add_argument("--port", type=int, default=None)
    p_serve.set_defaults(func=cmd_serve)

    p_diag = sub.add_parser("diagnose", help="Diagnose why an asset fails")
    p_diag.add_argument("kind", choices=("outfit",))
    p_diag.add_argument("id", type=int)
    p_diag.add_argument("--addons", type=int, default=0)
    p_diag.set_defaults(func=cmd_diagnose)

    p_render = sub.add_parser("render", help="Render one asset to cache")
    p_render.add_argument("kind", choices=("outfit", "item", "monster", "effect", "missile"))
    p_render.add_argument("id")
    p_render.add_argument("--addons", type=int, default=0)
    p_render.add_argument("--direction", type=int, default=2)
    p_render.set_defaults(func=cmd_render)

    args = parser.parse_args()
    return args.func(args)


if __name__ == "__main__":
    raise SystemExit(main())
