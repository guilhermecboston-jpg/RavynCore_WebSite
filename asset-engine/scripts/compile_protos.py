#!/usr/bin/env python3
"""Compile OTClient protobuf definitions for the asset engine."""

from __future__ import annotations

import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
OTC = ROOT.parent.parent / "RavynCore_OTC"
if not OTC.is_dir():
    OTC = Path(r"C:\Users\PICHAU\Documents\RavynCore_OTC")

PROTO_DIR = OTC / "src" / "protobuf"
OUT = ROOT / "asset_engine" / "generated"


def main() -> int:
    OUT.mkdir(parents=True, exist_ok=True)
    protos = list(PROTO_DIR.glob("*.proto"))
    if not protos:
        print(f"No .proto files in {PROTO_DIR}", file=sys.stderr)
        return 1
    cmd = [
        sys.executable,
        "-m",
        "grpc_tools.protoc",
        f"-I{PROTO_DIR}",
        f"--python_out={OUT}",
        *[str(p) for p in protos],
    ]
    print("Running:", " ".join(cmd))
    subprocess.check_call(cmd)
    init = OUT / "__init__.py"
    if not init.exists():
        init.write_text('"""Generated protobuf modules."""\n', encoding="utf-8")
    print("Done:", OUT)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
