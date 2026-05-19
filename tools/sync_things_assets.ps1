param(
    [string]$Source = "C:\Users\PICHAU\Documents\RavynCore_OTC\data\things\1524",
    [string]$Destination = "$PSScriptRoot\..\system\data\things\1524"
)

$ErrorActionPreference = "Stop"

if (-not (Test-Path -LiteralPath $Source)) {
    throw "Source path not found: $Source"
}

New-Item -ItemType Directory -Path $Destination -Force | Out-Null

robocopy $Source $Destination /E /R:2 /W:1
$code = $LASTEXITCODE

if ($code -ge 8) {
    throw "Robocopy failed with exit code: $code"
}

Write-Host "Assets synchronized."
Write-Host "Source: $Source"
Write-Host "Destination: $Destination"
Write-Host "Robocopy exit code: $code"
