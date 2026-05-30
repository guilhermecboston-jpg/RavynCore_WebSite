TibiaWiki creature GIFs (scraper output)
=======================================

Gerado pelo scraper em /scraper (modo full ou slugs).

Uso no site (Skill Gem, etc.): /var/www/html/imagens/creaturestibiawiki/<itemId>.gif
Ex.: 63340.gif, 63475.gif — estes IDs não vão no Git (deploy manual na VPS).

O Hunt/Boss Finder usa images/library/ com os mesmos nomes do hunts_config.lua.

Regenerar:
  cd scraper
  python main.py --mode full
