<?php
defined('MYAAC') or die('Direct access not allowed!');

return [
    'how_it_works' => [
        'Utilize o <strong>HuntFinder</strong>, localizado no <strong>+1 do Templo</strong>, para consultar respawns e ser teleportado diretamente para a hunt escolhida.',
        'Cada card exibe as criaturas disponíveis naquele respawn, com opções de <strong>detalhes</strong>, <strong>favoritos</strong> e <strong>teleporte</strong>.',
        'Use a barra de busca para filtrar hunts pelo nome da criatura ou do local.',
    ],
    'features' => [
        'Consultar quais criaturas estão disponíveis em cada respawn.',
        'Filtrar hunts por nível de dificuldade.',
        'Selecionar a instância desejada (<strong>Ravyn Depths I</strong> a <strong>V</strong>) quando a hunt possuir mais de uma localização.',
        'Marcar hunts como favoritas e filtrar apenas favoritos.',
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
        'Todas as hunts possuem um <strong>teleport de retorno</strong> para o templo de RavynCore.',
        'O teleport de retorno <strong>não possui Protection Zone (PZ)</strong>. Ao utilizá-lo, você não estará em área segura.',
        'Se estiver em <strong>fight</strong> ou com <strong>PZ Lock</strong> ao usar o teleport de retorno, você <strong>não será enviado ao templo</strong>.',
        'Nessa situação, será transportado <strong>aleatoriamente</strong> para um dos barcos ao redor de RavynCore:',
    ],
    'return_boats' => [
        'Barco localizado ao <strong>norte</strong> de RavynCore.',
        'Barco localizado à <strong>esquerda (oeste)</strong> de RavynCore.',
        'Barco localizado à <strong>direita (leste)</strong> de RavynCore.',
    ],
    'return_note' => 'O destino é escolhido aleatoriamente a cada utilização do teleport enquanto você estiver em condição de fight ou PZ Lock.',
];
