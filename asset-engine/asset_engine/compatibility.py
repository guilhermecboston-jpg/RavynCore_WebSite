"""Safe-mode compatibility checks before enabling modern asset rendering."""

from __future__ import annotations

from dataclasses import dataclass, field
from pathlib import Path
from typing import Optional

from . import LEGACY_MESSAGE
from .config import EngineConfig
from .lzma_sprite import decompress_sprite_sheet


@dataclass
class CompatibilityReport:
    compatible: bool
    message: str
    otc_root: Optional[Path] = None
    things_dir: Optional[Path] = None
    appearances_file: Optional[Path] = None
    catalog_entries: int = 0
    sprite_sheets: int = 0
    errors: list[str] = field(default_factory=list)
    warnings: list[str] = field(default_factory=list)

    def to_dict(self) -> dict:
        return {
            "compatible": self.compatible,
            "message": self.message,
            "otc_root": str(self.otc_root) if self.otc_root else None,
            "things_dir": str(self.things_dir) if self.things_dir else None,
            "appearances_file": str(self.appearances_file) if self.appearances_file else None,
            "catalog_entries": self.catalog_entries,
            "sprite_sheets": self.sprite_sheets,
            "errors": self.errors,
            "warnings": self.warnings,
        }


def _import_protobuf() -> bool:
    try:
        from .generated import appearances_pb2  # noqa: F401
        from .generated import staticdata_pb2  # noqa: F401
        return True
    except Exception as exc:
        return False


def run_compatibility_check(cfg: EngineConfig, test_decompress: bool = True) -> CompatibilityReport:
    report = CompatibilityReport(compatible=False, message=LEGACY_MESSAGE)

    if not cfg.otc_root.is_dir():
        report.errors.append(f"OTC root not found: {cfg.otc_root}")
        return report

    report.otc_root = cfg.otc_root
    things = cfg.things_dir
    if not things.is_dir():
        report.errors.append(f"Things folder missing: {things}")
        return report

    report.things_dir = things
    catalog = cfg.catalog_path
    if not catalog.is_file():
        report.errors.append(f"catalog-content.json missing: {catalog}")
        return report

    if not _import_protobuf():
        report.errors.append("Protobuf modules not generated. Run: python scripts/compile_protos.py")
        return report

    try:
        import json

        entries = json.loads(catalog.read_text(encoding="utf-8"))
        report.catalog_entries = len(entries)
        appearances_name = None
        sprite_files: list[str] = []
        for obj in entries:
            t = obj.get("type")
            if t == "appearances":
                appearances_name = obj.get("file")
            elif t == "sprite":
                sprite_files.append(obj.get("file", ""))

        report.sprite_sheets = len(sprite_files)
        if not appearances_name:
            report.errors.append("catalog-content.json has no appearances entry")
            return report

        app_path = things / appearances_name
        if not app_path.is_file():
            report.errors.append(f"appearances dat missing: {app_path}")
            return report

        report.appearances_file = app_path

        if test_decompress and sprite_files:
            sample = things / sprite_files[0]
            if sample.is_file():
                try:
                    decompress_sprite_sheet(sample)
                except Exception as exc:
                    report.errors.append(f"LZMA sprite decompress failed ({sample.name}): {exc}")
                    return report
            else:
                report.warnings.append(f"sample sprite sheet missing: {sample.name}")

    except Exception as exc:
        report.errors.append(f"catalog parse failed: {exc}")
        return report

    report.compatible = True
    report.message = "RavynCore Asset Engine compatible with client assets."
    return report


def ensure_compatible(cfg: EngineConfig) -> CompatibilityReport:
    report = run_compatibility_check(cfg)
    if cfg.force_modern_engine and not report.compatible:
        report.warnings.append("force_modern_engine=true but checks failed — falling back to legacy")
        report.compatible = False
        report.message = LEGACY_MESSAGE
    return report
