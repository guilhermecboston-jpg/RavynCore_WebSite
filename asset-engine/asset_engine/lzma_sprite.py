"""Decompress CIP .bmp.lzma sprite sheets (OTClient-compatible)."""

from __future__ import annotations

import lzma
import struct
from pathlib import Path

from .utils import BYTES_IN_SPRITE_SHEET, SHEET_SIZE, SPRITE_SHEET_WIDTH_BYTES

LZMA_UNCOMPRESSED_SIZE = 2 * 1024 * 1024


class LzmaSpriteError(Exception):
    pass


def _decompress_lzma1(props: bytes, compressed: bytes) -> bytes:
    """LZMA1 raw stream (CIP). Windows CPython often lacks FILTER_LZMA1 — use pylzma."""
    try:
        return lzma.decompress(
            compressed,
            format=lzma.FORMAT_RAW,
            filters=[{"id": lzma.FILTER_LZMA1, "props": props}],
        )
    except (lzma.LZMAError, ValueError):
        pass
    try:
        import pylzma

        return pylzma.decompress(props + compressed, maxlength=LZMA_UNCOMPRESSED_SIZE)
    except Exception as exc:
        raise LzmaSpriteError(str(exc)) from exc


def _parse_cip_header(raw: bytes) -> tuple[bytes, int]:
    """Return (lzma_props_5_bytes, offset_to_compressed_payload)."""
    offset = 0
    while offset < len(raw) and raw[offset] == 0:
        offset += 1
    if offset >= len(raw):
        raise LzmaSpriteError("empty header")

    offset += 1  # first non-zero byte (e.g. 0x70)
    if offset + 4 > len(raw):
        raise LzmaSpriteError("truncated magic")
    offset += 4  # 0x0A 0xFA 0x80 0x24

    # 7-bit encoded compressed size (all bytes consumed, including terminal)
    while offset < len(raw) and (raw[offset] & 0x80) == 0x80:
        offset += 1
    if offset >= len(raw):
        raise LzmaSpriteError("truncated vint")
    offset += 1  # terminal vint byte without high bit

    lclppb = raw[offset]
    offset += 1
    if offset + 4 > len(raw):
        raise LzmaSpriteError("truncated dictionary size")
    dictionary_size = raw[offset] | (raw[offset + 1] << 8) | (raw[offset + 2] << 16) | (raw[offset + 3] << 24)
    offset += 4
    offset += 8  # CIP compressed size field

    props = bytes([lclppb]) + struct.pack("<I", dictionary_size)
    return props, offset


def decompress_sprite_sheet(path: Path) -> bytes:
    raw = path.read_bytes()
    if len(raw) < 32:
        raise LzmaSpriteError(f"file too small: {path}")

    props, offset = _parse_cip_header(raw)
    compressed = raw[offset:]
    decompressed = _decompress_lzma1(props, compressed)

    if len(decompressed) < 14:
        raise LzmaSpriteError("decompressed BMP header too small")

    bmp_data_offset = struct.unpack_from("<I", decompressed, 10)[0]
    if bmp_data_offset + BYTES_IN_SPRITE_SHEET > len(decompressed):
        raise LzmaSpriteError("BMP pixel offset out of bounds")

    buffer = bytearray(decompressed[bmp_data_offset : bmp_data_offset + BYTES_IN_SPRITE_SHEET])

    for i in range(0, len(buffer), 4):
        buffer[i], buffer[i + 2] = buffer[i + 2], buffer[i]
        rgb = buffer[i] | (buffer[i + 1] << 8) | (buffer[i + 2] << 16)
        if rgb == 0xFF00FF:
            buffer[i : i + 4] = b"\x00\x00\x00\x00"
        else:
            buffer[i + 3] = 255

    half = SHEET_SIZE // 2
    row_bytes = SPRITE_SHEET_WIDTH_BYTES
    temp = bytearray(row_bytes)
    for y in range(half):
        top = y * row_bytes
        bottom = (SHEET_SIZE - 1 - y) * row_bytes
        temp[:] = buffer[top : top + row_bytes]
        buffer[top : top + row_bytes] = buffer[bottom : bottom + row_bytes]
        buffer[bottom : bottom + row_bytes] = temp

    return bytes(buffer)
