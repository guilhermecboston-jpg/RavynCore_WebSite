# TibiaWiki Creature Sprite Scraper

Downloads **only** creature outfit images from [Lista de Criaturas](https://www.tibiawiki.com.br/wiki/Lista_de_Criaturas) and saves them as `.gif` for RavynCore.

## Output

```
../imagens/creaturestibiawiki/
    demon.gif
    dragon_lord.gif
    ...
```

## Setup (Windows)

**Opção A — mais fácil (não precisa de `python`/`pip` no PATH):**

```powershell
cd c:\Users\PICHAU\Documents\RavynCore_website\scraper
.\run.ps1
```

Ou dê duplo clique em `run.bat`.

**Opção B — manual:**

1. Instale Python 3.12+: `winget install Python.Python.3.12`
2. Marque **“Add python.exe to PATH”** no instalador (ou feche e abra o PowerShell de novo).
3. `pip install -r requirements.txt`
4. `python main.py`

Se `python` / `pip` não forem reconhecidos, use o caminho completo:

```powershell
& "$env:LOCALAPPDATA\Programs\Python\Python312\python.exe" -m pip install -r requirements.txt
& "$env:LOCALAPPDATA\Programs\Python\Python312\python.exe" main.py
```

Requires **Python 3.12+**.

## Run

```powershell
.\run.ps1
# ou
python main.py
```

### Options

| Flag | Description |
|------|-------------|
| `--force` | Re-download existing files |
| `--workers 8` | Parallel workers (default 6) |
| `--limit 100` | Process only first N creatures (testing) |
| `--list-only` | Show mapping sample without downloading |
| `--output PATH` | Custom output directory |

## Logs

- `logs/scraper.log` — full log
- `logs/errors.log` — failures only

## Notes

- Respects existing files unless `--force` is set.
- Detects duplicate image content (SHA-256) during a run.
- Uses random delays + retries to reduce rate limiting.
- Recompile OTC / use GIF texture support when serving these in the client.
