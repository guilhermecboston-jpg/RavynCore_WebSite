$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $Root

function Find-Python {
    foreach ($c in @(
        "$env:LOCALAPPDATA\Programs\Python\Python312\python.exe",
        "python", "python3"
    )) {
        if ($c -eq "python" -or $c -eq "python3") {
            if (Get-Command $c -ErrorAction SilentlyContinue) { return (Get-Command $c).Source }
        } elseif (Test-Path $c) { return $c }
    }
    throw "Python não encontrado."
}

$py = Find-Python
& $py -m pip install -r requirements.txt -q
& $py main.py @args
