<?php
defined('MYAAC') or die('Direct access not allowed!');

return [
    'how_it_works' => [
        'Utilize o <span class="rc-hf-highlight">HuntFinder</span>, localizado no <span class="rc-hf-highlight">+1 do Templo</span>, para consultar respawns e ser teleportado diretamente para a hunt escolhida.',
        'Cada card exibe as criaturas disponíveis naquele respawn, com opções de <span class="rc-hf-highlight">detalhes</span>, <span class="rc-hf-highlight">favoritos</span> e <span class="rc-hf-highlight">teleporte</span>.',
        'Use a barra de busca para filtrar hunts pelo nome da criatura ou do local.',
    ],
    'features' => [
        'Consultar quais criaturas estão disponíveis em cada respawn.',
        'Filtrar hunts por nível de <span class="rc-hf-highlight">dificuldade</span>.',
        'Selecionar a instância desejada (<span class="rc-hf-highlight">Ravyn Depths I</span> a <span class="rc-hf-highlight">V</span>) quando a hunt possuir mais de uma localização.',
        'Marcar hunts como <span class="rc-hf-highlight">favoritos</span> e filtrar apenas favoritos.',
        'Teleportar diretamente para o respawn selecionado.',
    ],
    'difficulties' => [
        [
            'name' => 'Easy',
            'class' => 'rc-hf-diff-easy',
            'desc' => 'Hunts introdutórias, ideais para começar a explorar o sistema e conhecer os respawns.',
        ],
        [
            'name' => 'Medium',
            'class' => 'rc-hf-diff-medium',
            'desc' => 'Dificuldade intermediária. Respawns mais exigentes, com criaturas e recompensas superiores.',
        ],
        [
            'name' => 'Hard',
            'class' => 'rc-hf-diff-hard',
            'desc' => 'Hunts avançadas para personagens preparados. Maior risco e melhor potencial de loot.',
        ],
        [
            'name' => 'Epic',
            'class' => 'rc-hf-diff-epic',
            'desc' => 'O mais alto nível de dificuldade disponível no HuntFinder, reservado aos respawns mais desafiadores.',
        ],
    ],
    'locations' => [
        ['name' => 'Ravyn Depths I', 'desc' => 'Primeira instância paralela. Disponível em diversas hunts como opção de teleporte.'],
        ['name' => 'Ravyn Depths II', 'desc' => 'Segunda instância paralela. Alguns respawns possuem esta localização como alternativa.'],
        ['name' => 'Ravyn Depths III', 'desc' => 'Terceira instância paralela. Permite distribuir hunts entre instâncias quando o respawn oferece múltiplos pontos.'],
        ['name' => 'Ravyn Depths IV', 'desc' => 'Quarta instância paralela. Selecionável no painel de detalhes quando disponível para a hunt.'],
        ['name' => 'Ravyn Depths V', 'desc' => 'Quinta instância paralela. Use quando precisar de uma instância adicional do mesmo respawn.'],
    ],
    'return_teleport' => [
        'Todas as hunts possuem um <span class="rc-hf-highlight">teleport de retorno</span> para o <span class="rc-hf-highlight">templo de RavynCore</span>.',
        'O teleport de retorno <span class="rc-hf-highlight">não possui Protection Zone (PZ)</span>. Ao utilizá-lo, você <span class="rc-hf-highlight">não estará em área segura</span>.',
        'Se estiver com <span class="rc-hf-highlight">PZ Lock</span> (PvP / atacou outro jogador) ao usar o teleport de retorno, você <span class="rc-hf-highlight">não será enviado ao templo</span>.',
        'Nessa situação, será transportado <span class="rc-hf-highlight">aleatoriamente</span> para um dos barcos ao redor de RavynCore:',
    ],
    'return_boats' => [
        'Barco localizado ao <span class="rc-hf-highlight">norte</span> de RavynCore.',
        'Barco localizado à <span class="rc-hf-highlight">esquerda (oeste)</span> de RavynCore.',
        'Barco localizado à <span class="rc-hf-highlight">direita (leste)</span> de RavynCore.',
    ],
    'return_note' => 'O destino é escolhado <span class="rc-hf-highlight">aleatoriamente</span> a cada utilização do teleport enquanto você estiver com <span class="rc-hf-highlight">PZ Lock</span>. Battle de monstro não impede o retorno ao templo.',
];
