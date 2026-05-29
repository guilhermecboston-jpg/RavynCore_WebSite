# RavynCore Asset Engine

Renderiza outfits, itens, monstros, efeitos e mísseis diretamente dos assets modernos do OTClient (`data/things/1524/`: `catalog-content.json`, `appearances-*.dat`, `sprites-*.bmp.lzma`, `staticdata-*.dat`).

**Modo seguro:** se os assets não forem compatíveis, o motor **não** substitui o site legado e responde:

> Já estamos utilizando o sistema atual do cliente/assets.

## Requisitos

- Python 3.11+
- Pasta OTC com `data/things/1524/` (ex.: `RavynCore_OTC`)
- Linux VPS / Docker / Windows (dev)

## Instalação

```bash
cd asset-engine
pip install -r requirements.txt
cp config.example.json config.json
# Edite otc_root se necessário
python main.py check
```

## Uso

```bash
python main.py status
python main.py serve          # API em http://127.0.0.1:8765
python main.py render outfit 128 --addons 0
python main.py regenerate-cache
```

### Endpoints

| Endpoint | Exemplo |
|----------|---------|
| `/api/outfit` | `?id=128&addons=3&direction=2` |
| `/api/item` | `?id=2160` |
| `/api/monster` | `?id=demon` |
| `/api/effect` | `?id=34` |
| `/api/missile` | `?id=12` |
| `/api/status` | JSON de compatibilidade |
| `/admin` | Painel (regenerar cache, preview) |

Cache em disco: `../public/cache/asset-engine/` (outfits, items, monsters, effects, missiles).

## MyAAC / PHP

Endpoints PHP (desligados por padrão):

- `/api/assets/outfit.php`
- `/api/assets/item.php`
- `/api/assets/monster.php`

Copie `api/assets/config.example.php` → `config.php` e defina `enabled => true` **somente** após `python main.py check` passar.

## Docker

```bash
docker compose up -d --build
```

Monta o OTC em `/otclient` (read-only) e persiste o cache.

## Atualizar sprites

Substitua apenas a pasta `data/things/1524/` no cliente e reinicie o serviço — o fingerprint invalida o cache automaticamente.

## Variáveis de ambiente

| Variável | Descrição |
|----------|-----------|
| `RAVYN_OTC_ROOT` | Caminho do OTClient |
| `OTCLIENT_ROOT` | Alias |

## Notas

- Não usa `Tibia.dat`, `Tibia.spr`, TibiaWiki nem imagens manuais.
- O sistema legado (`images/library/*.gif`, `images/animated-outfits/`) continua intacto até você habilitar o bridge PHP.
