<?php
defined('MYAAC') or die('Direct access not allowed!');

return [
    'how_it_works' => [
        'Utilize o Boss Finder, localizado no <strong>+1 do Templo</strong>, para selecionar um boss e ser teleportado diretamente para o waypoint da alavanca.',
        'O cooldown é iniciado no momento em que a alavanca é acionada, e <strong>não</strong> após a morte do boss.',
        'O tempo padrão de cooldown é de <strong>20 horas</strong>.',
    ],
    'progression_intro' => [
        'Alguns bosses possuem uma progressão obrigatória através de Mini Bosses. Para acessar o Boss Final, é necessário derrotar todos os Mini Bosses da respectiva linha de progressão.',
        'Após derrotar o Boss Final, todo o progresso daquela linha é reiniciado. Para enfrentar o Boss Final novamente, será necessário derrotar todos os Mini Bosses outra vez.',
    ],
    'progression_bosses' => [
        ['name' => 'Ascending Ferumbras', 'note' => 'cooldown de 2 dias'],
        ['name' => 'King Zelos', 'note' => ''],
        ['name' => 'The Nightmare Beast', 'note' => ''],
        ['name' => 'Bakragore', 'note' => 'cooldown de 2 dias'],
        ['name' => 'Megalomania', 'note' => ''],
    ],
    'progression_systems' => [
        [
            'id' => 'dream-courts',
            'name' => 'Dream Courts Progressão',
            'minis' => ['Plagueroot', 'Malofur Mangrinder', 'Maxxenius', 'Alptramun', 'Izcandar The Banished'],
            'final' => 'The Nightmare Beast',
            'mini_count' => 5,
        ],
        [
            'id' => 'grave-danger',
            'name' => 'Grave Danger (GT) Progressão',
            'minis' => ['Count Vlarkorth', 'Duke Krule', 'Earl Osam', 'Lord Azaram', 'Sir Nictros'],
            'final' => 'King Zelos',
            'mini_count' => 5,
        ],
        [
            'id' => 'ferumbras',
            'name' => 'Ferumbras Ascendant Progressão',
            'minis' => ['Plagirath', 'Ragiaz', 'Razzagorn', 'Tarbaz', 'Zamulosh', 'Shulgrax', 'Mazoran', 'The Lord of the Lice'],
            'final' => 'Ascending Ferumbras',
            'mini_count' => 8,
        ],
        [
            'id' => 'sanguine',
            'name' => 'Sanguine / Rotten Blood Progressão',
            'minis' => ['Vermiath', 'Murcion', 'Chagorz', 'Ichgahal'],
            'final' => 'Bakragore',
            'mini_count' => 4,
        ],
    ],
    'summary_table' => [
        ['system' => 'Dream Courts', 'minis' => 5, 'final' => 'The Nightmare Beast', 'reset' => 'Sim'],
        ['system' => 'Grave Danger', 'minis' => 5, 'final' => 'King Zelos', 'reset' => 'Sim'],
        ['system' => 'Ferumbras Ascendant', 'minis' => 8, 'final' => 'Ascending Ferumbras', 'reset' => 'Sim'],
        ['system' => 'Sanguine / Rotten Blood', 'minis' => 4, 'final' => 'Bakragore', 'reset' => 'Sim'],
    ],
    'general_rules' => [
        'É obrigatório derrotar todos os Mini Bosses para liberar o acesso ao Boss Final.',
        'O progresso é individual para cada linha de bosses.',
        'Ao derrotar o Boss Final, todos os Mini Bosses da respectiva progressão são resetados.',
        'Para enfrentar o Boss Final novamente, será necessário refazer toda a progressão.',
        'Bosses com cooldown especial: <strong>Ascending Ferumbras</strong> (2 dias) e <strong>Bakragore</strong> (2 dias). Os demais seguem o cooldown padrão do servidor.',
    ],
];
