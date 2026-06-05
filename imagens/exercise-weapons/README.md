# Exercise Weapons — imagens do site RavynCore

Coloque aqui os sprites de cada exercise weapon para a página `?subtopic=exerciseweapons`.

## Estrutura

```
imagens/exercise-weapons/
├── durable/
│   ├── sword.png
│   ├── axe.png
│   ├── club.png
│   ├── bow.png
│   ├── rod.png
│   ├── wand.png
│   ├── shield.png
│   └── wraps.png
├── lasting/
│   └── (mesmos nomes)
├── mystic/
│   └── (mesmos nomes)
├── legendary/
│   └── (mesmos nomes)
└── boxes/
    ├── mystic-box.png
    └── legendary-box.png
```

## Prioridade de exibição

1. PNG customizado nesta pasta (`{tier}/{slug}.png`)
2. Sprite TibiaWiki pelo ID do item (fallback automático)
3. Placeholder tracejado com o nome do arquivo esperado

Formato recomendado: PNG transparente, 32×32 ou 64×64 (pixel art).
