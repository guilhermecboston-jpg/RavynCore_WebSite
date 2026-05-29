# RavynCore Asset Engine — Deploy VPS

## Arquitetura (importante)

| Onde | O quê |
|------|--------|
| **PC PICHAU** | OTC completo (`RavynCore_OTC`), client, assets de produção |
| **VPS** `/var/www/html` (ou `/var/www/hrml`) | Site MyAAC (GitHub) + cópia **só** de `things/1524` |
| **GitHub** | Código PHP/Python — **não** inclui os ~10.000 `.bmp.lzma` |

`git pull` **sozinho não basta** para outfits funcionarem: falta a pasta de assets no servidor.

---

## Passo 1 — Site (já fez)

```bash
cd /var/www/html   # ajuste se sua pasta for /var/www/hrml
git pull origin main
```

---

## Passo 2 — Enviar assets do PC para a VPS (obrigatório)

No **Windows (PowerShell)** — substitua `USER` e IP:

```powershell
$LOCAL = "C:\Users\PICHAU\Documents\RavynCore_OTC\data\things\1524"
$REMOTE = "USER@SEU_IP:/var/www/html/system/data/things/"

# rsync via WSL ou Git Bash:
rsync -avz --progress "$LOCAL/" "${REMOTE}1524/"
```

Alternativa: WinSCP / FileZilla — copiar a pasta inteira `1524` para:

`/var/www/html/system/data/things/1524/`

Deve existir na VPS:

```text
/var/www/html/system/data/things/1524/catalog-content.json
/var/www/html/system/data/things/1524/appearances-*.dat
/var/www/html/system/data/things/1524/sprites-*.bmp.lzma   (milhares)
```

---

## Passo 3 — Asset Engine na VPS

```bash
cd /var/www/html/asset-engine
cp config.vps.example.json config.json
# Se o site não estiver em /var/www/html, edite paths no config.json

python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt

python main.py check
# compatible: true  → OK
```

Serviço (systemd):

```bash
sudo cp deploy/ravyn-asset-engine.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable --now ravyn-asset-engine
sudo systemctl status ravyn-asset-engine
```

Testes:

```bash
curl -s http://127.0.0.1:8765/api/status | python3 -m json.tool
curl -s "http://127.0.0.1:8765/api/outfit?id=128&addons=0" -o /tmp/o.gif
file /tmp/o.gif
curl -s "http://127.0.0.1:8765/api/diagnose/outfit?id=128" | python3 -m json.tool
```

---

## Passo 4 — Ligar o site ao motor

### A) MyAAC `config.local.php` (recomendado)

```php
<?php
$config['asset_engine_enabled'] = true;
$config['asset_engine_url'] = 'http://127.0.0.1:8765';
$config['things_assets_path'] = 'system/data/things/1524';
$config['things_assets_python_path'] = '/var/www/html/asset-engine/venv/bin/python';
```

### B) Outfits animados (substituir sistema antigo)

Em `config.php` ou `config.local.php`, quando o motor estiver OK:

```php
$config['outfit_images_url'] = '/api/assets/outfit.php';
```

Copiar e ativar bridge PHP:

```bash
cp api/assets/config.example.php api/assets/config.php
# enabled => true
```

---

## Diagnóstico — “outfit não aparece”

| Sintoma | Causa provável |
|---------|----------------|
| `compatible: false` no check | `things/1524` ausente ou incompleto na VPS |
| `curl :8765` falha | Serviço não rodando (`systemctl status`) |
| API OK, site não muda | Ainda usa `animoutfit.php` — alterar `outfit_images_url` |
| `animoutfit.php` vazio | Falta `cache.generated.txt` / pasta `outfits_anim` (sistema **antigo**) |
| Alguns IDs falham | Outfit sem sprites no frame group — ver `/api/diagnose/outfit?id=XXX` |

Comando rápido na VPS:

```bash
test -f /var/www/html/system/data/things/1524/catalog-content.json && echo "ASSETS OK" || echo "FALTAM ASSETS"
curl -s http://127.0.0.1:8765/api/status
```

---

## Atualizar assets no futuro

1. Atualize `1524` no PC (OTC).
2. Rode de novo o `rsync` (só pasta `1524`).
3. Na VPS: `curl -X POST http://127.0.0.1:8765/api/cache/regenerate`

---

## Prompt para outro agente / suporte

```
Site em /var/www/html (VPS Ubuntu). OTC fica no PC Windows.
Assets: rsync RavynCore_OTC/data/things/1524 → /var/www/html/system/data/things/1524/
Asset engine: /var/www/html/asset-engine, config.json com things_dir absoluto.
Serviço: ravyn-asset-engine na porta 8765.
Validar: python main.py check && curl /api/status && curl /api/diagnose/outfit?id=128
MyAAC: asset_engine_enabled + outfit_images_url=/api/assets/outfit.php
```
