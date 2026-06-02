TibiaWiki creature GIFs (scraper output)
=======================================

Gerado pelo scraper em /scraper (modo full ou slugs).

Uso no site: /var/www/html/imagens/creaturestibiawiki/<itemId>.gif
(Prioridade) imagens/creaturestibiawiki/ → fallback images/creaturetibiawiki/ → asset do MyAAC.

Elemental Stones / Stone Forge: 60581, 3043, 46625, 46626, bags 63980–60578, stones 61826–61815 (ver elementalstonesbonuses.php).
Copiar de IMPORTANDO RUBINI: ITENS/items/<id>/0.gif → <id>.gif nesta pasta.

Supreme Tasks e outras páginas wiki buscam criaturas por slug em:
  imagens/creaturestibiawiki/<slug>.gif (prioridade)
  images/library/<slug>.gif (fallback)
Slugs aceitos: compacto (minotaurhunter) ou com underscore (minotaur_hunter).

O Hunt/Boss Finder usa images/library/ com os mesmos nomes do hunts_config.lua.

Regenerar:
  cd scraper
  python main.py --mode full
