# TibiaWiki scraper launcher (Windows) — não depende de python/pip no PATH.
$ErrorActionPreference = "Stop"

$PythonCandidates = @(
    "$env:LOCALAPPDATA\Programs\Python\Python313\python.exe",
    "$env:LOCALAPPDATA\Programs\Python\Python312\python.exe",
    "$env:LOCALAPPDATA\Programs\Python\Python311\python.exe",
    "C:\Python312\python.exe"
)

$Python = $null
foreach ($candidate in $PythonCandidates) {
    if (Test-Path $candidate) {
        $Python = $candidate
        break
    }
}

if (-not $Python) {
    Write-Host ""
    Write-Host "Python 3.12+ nao encontrado." -ForegroundColor Red
    Write-Host ""
    Write-Host "Instale com um dos comandos:" -ForegroundColor Yellow
    Write-Host "  winget install Python.Python.3.12"
    Write-Host "  https://www.python.org/downloads/  (marque 'Add python.exe to PATH')"
    Write-Host ""
    exit 1
}

$ScraperDir = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $ScraperDir

Write-Host "Python: $Python" -ForegroundColor Cyan
& $Python -m pip install -q -r requirements.txt
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

& $Python main.py @args
exit $LASTEXITCODE
