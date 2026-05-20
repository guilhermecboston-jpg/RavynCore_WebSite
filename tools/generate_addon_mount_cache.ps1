param(
    [string]$Python = "python",
    [string]$Things = "$PSScriptRoot\..\system\data\things\1524",
    [string]$Cache = "$PSScriptRoot\..\images\things-cache",
    [string]$OutfitsXml = "C:\Users\PICHAU\Desktop\DURVAL\RavynCore\data\XML\outfits.xml",
    [string]$MountsXml = "C:\Users\PICHAU\Desktop\DURVAL\RavynCore\data\XML\mounts.xml"
)

$ErrorActionPreference = "Stop"

$fallbackPython = "$env:USERPROFILE\.cache\codex-runtimes\codex-primary-runtime\dependencies\python\python.exe"
if (-not (Get-Command $Python -ErrorAction SilentlyContinue) -and (Test-Path -LiteralPath $fallbackPython)) {
    $Python = $fallbackPython
}

$generator = Join-Path $PSScriptRoot "generate_things_cache.py"

& $Python $generator --type outfits --xml $OutfitsXml --things $Things --cache $Cache
if ($LASTEXITCODE -ne 0) {
    throw "Outfits cache generation failed with exit code $LASTEXITCODE"
}

& $Python $generator --type mounts --xml $MountsXml --things $Things --cache $Cache --addons 0
if ($LASTEXITCODE -ne 0) {
    throw "Mounts cache generation failed with exit code $LASTEXITCODE"
}

Write-Host "Addon and mount cache generated."
Write-Host "Things: $Things"
Write-Host "Cache: $Cache"
