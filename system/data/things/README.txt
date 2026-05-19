RavynCore Website - Client Assets (Things)
==========================================

Objetivo
--------
Permitir que o site resolva imagens por ID (item/outfit/mount/missile/effect)
sem depender de cadastro manual de .gif/.png por registro.

Caminho padrao
-------------
Copie a pasta de assets do cliente para:

  system/data/things/1524

O resultado esperado e:

  system/data/things/1524/catalog-content.json
  system/data/things/1524/appearances-*.dat
  system/data/things/1524/sprites-*.bmp.lzma

Config
------
As opcoes estao em config.php / config.local.php:

  $config['things_assets_path']
  $config['things_assets_version']
  $config['things_assets_cache_path']

Endpoint por ID
---------------
O site expoe:

  ?subtopic=asset&type=item&id=2160
  ?subtopic=asset&type=outfit&id=128&addons=3
  ?subtopic=asset&type=mount&id=368
  ?subtopic=asset&type=missile&id=10
  ?subtopic=asset&type=effect&id=15

Observacao importante
---------------------
Para item/outfit/mount o endpoint ja possui fallback pronto:
- item: usa geracao/classico de item image existente no projeto
- outfit/mount: usa outfit_images_url (renderer)

Para missile/effect (client 12+/15+):
- o endpoint busca arquivos pre-renderizados em:
  images/things-cache/missiles/<id>.(png|gif|webp|jpg)
  images/things-cache/effects/<id>.(png|gif|webp|jpg)
- se nao existir cache, retorna placeholder.

Assim voce pode plugar um conversor em segundo plano no futuro sem alterar as paginas.
