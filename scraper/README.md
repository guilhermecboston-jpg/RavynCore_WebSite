# RavynCore TibiaWiki Scraper

Baixa GIFs animados de criaturas do [TibiaWiki BR](https://www.tibiawiki.com.br) para `images/library/` (Hunt Finder / Boss Finder no site e OTC).

## Instalação

```powershell
cd scraper
pip install -r requirements.txt
```

## Uso rápido (só o que falta no Hunt/Boss config)

```powershell
python main.py --mode missing
```

## Outros modos

```powershell
# Criaturas específicas
python main.py --mode slugs --ids caveman boar rhino qarapredator

# Wiki completa (demora horas)
python main.py --mode full --limit 100
```

## Saída

- Principal: `../images/library/<slug>.gif`
- Cópia opcional: `../imagens/creaturestibiawiki/`

Aliases de nome (slug → título wiki): `name_map.json`

## VPS

Após rodar no PC, faça commit das novas GIFs ou rsync de `images/library/` para a VPS.
