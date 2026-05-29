# Envia pasta things/1524 do PC para a VPS (obrigatorio para o Asset Engine)
# Uso: .\sync-things-to-vps.ps1 -User root -Host 123.45.67.89 -RemoteWebRoot /var/www/html

param(
    [Parameter(Mandatory = $true)][string]$User,
    [Parameter(Mandatory = $true)][string]$Host,
    [string]$RemoteWebRoot = "/var/www/html",
    [string]$LocalThings = "C:\Users\PICHAU\Documents\RavynCore_OTC\data\things\1524"
)

$ErrorActionPreference = "Stop"
if (-not (Test-Path $LocalThings)) {
    throw "Pasta local nao encontrada: $LocalThings"
}

$remote = "${User}@${Host}:${RemoteWebRoot}/system/data/things/"
Write-Host "Enviando $LocalThings -> $remote"
Write-Host "Isso pode demorar (varios GB)."

# Requer rsync no PATH (Git Bash / WSL)
& rsync -avz --progress "$LocalThings/" "${remote}1524/"

Write-Host "Concluido. Na VPS rode: cd $RemoteWebRoot/asset-engine && python3 main.py check"
