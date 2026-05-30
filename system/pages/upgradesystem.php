<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Upgrade System';

$upgradeStoneItems = [
    'basic' => 63100,
    'medium' => 63101,
    'epic' => 63099,
];

$stoneTypes = [
    [
        'key' => 'basic',
        'title' => 'Basic Stone',
        'name' => 'Basic Upgrade Stone',
        'desc' => 'Pedra básica para upgrades até o nível 4',
    ],
    [
        'key' => 'medium',
        'title' => 'Medium Stone',
        'name' => 'Medium Upgrade Stone',
        'desc' => 'Pedra intermediária para upgrades até o nível 7',
    ],
    [
        'key' => 'epic',
        'title' => 'Epic Stone',
        'name' => 'Epic Upgrade Stone',
        'desc' => 'Pedra épica para upgrades até o nível 12',
    ],
];

$successRates = [
    ['level' => '+1', 'basic' => '100%', 'medium' => '100%', 'epic' => '100%'],
    ['level' => '+2', 'basic' => '60%', 'medium' => '75%', 'epic' => '75%'],
    ['level' => '+3', 'basic' => '40%', 'medium' => '50%', 'epic' => '60%'],
    ['level' => '+4', 'basic' => '20%', 'medium' => '35%', 'epic' => '50%'],
    ['level' => '+5', 'basic' => '-', 'medium' => '25%', 'epic' => '40%'],
    ['level' => '+6', 'basic' => '-', 'medium' => '18%', 'epic' => '35%'],
    ['level' => '+7', 'basic' => '-', 'medium' => '10%', 'epic' => '30%'],
    ['level' => '+8', 'basic' => '-', 'medium' => '-', 'epic' => '26%'],
    ['level' => '+9', 'basic' => '-', 'medium' => '-', 'epic' => '13%'],
    ['level' => '+10', 'basic' => '-', 'medium' => '-', 'epic' => '10%'],
    ['level' => '+11', 'basic' => '-', 'medium' => '-', 'epic' => '5%'],
    ['level' => '+12', 'basic' => '-', 'medium' => '-', 'epic' => '2%'],
];

$attackBonuses = [];
for ($i = 1; $i <= 12; $i++) {
    $attackBonuses[] = [
        'level' => '+' . $i,
        'attack' => (string)($i <= 10 ? $i : ($i === 11 ? 12 : 13)),
    ];
}

$transferPrices = [
    ['level' => '+1', 'price' => '50kk'],
    ['level' => '+2', 'price' => '125kk'],
    ['level' => '+3', 'price' => '200kk'],
    ['level' => '+4', 'price' => '300kk'],
    ['level' => '+5', 'price' => '400kk'],
    ['level' => '+6', 'price' => '550kk'],
    ['level' => '+7', 'price' => '750kk'],
    ['level' => '+8', 'price' => '1,000kk'],
    ['level' => '+9', 'price' => '1,250kk'],
    ['level' => '+10', 'price' => '1,500kk'],
    ['level' => '+11', 'price' => '2,000kk'],
    ['level' => '+12', 'price' => '3,000kk'],
];

if (!function_exists('rc_upg_esc')) {
    function rc_upg_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_upg_item_html')) {
    function rc_upg_item_html($itemId, $large = false, $label = '')
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }

        $alt = $label !== '' ? $label : 'Item';
        $class = $large ? 'rc-tier-item-img rc-tier-item-img-lg' : 'rc-tier-item-img';
        $wikiPath = 'images/creaturetibiawiki/' . $itemId . '.gif';
        if (file_exists(BASE . $wikiPath)) {
            return '<img class="' . $class . '" src="' . rc_upg_esc($wikiPath) . '" width="32" height="32" alt="' . rc_upg_esc($alt) . '" loading="lazy">';
        }

        $img = function_exists('getItemImage') ? getItemImage($itemId) : '';
        if ($img !== '') {
            $img = preg_replace('/<img\s+/', '<img class="' . $class . '" ', $img, 1);
            if (strpos($img, 'class="') === false) {
                $img = str_replace('<img ', '<img class="' . $class . '" ', $img);
            }
            $img = preg_replace('/alt="[^"]*"/', 'alt="' . rc_upg_esc($alt) . '"', $img, 1);
            $img = preg_replace('/title="[^"]*"/', '', $img);

            return $img;
        }

        $path = 'images/items/' . $itemId . '.gif';
        if (file_exists(BASE . $path)) {
            return '<img class="' . $class . '" src="' . rc_upg_esc($path) . '" width="32" height="32" alt="' . rc_upg_esc($alt) . '" loading="lazy">';
        }

        return '<span class="rc-tier-item-fallback">' . rc_upg_esc($alt) . '</span>';
    }
}

$stoneCardsHtml = '';
foreach ($stoneTypes as $stone) {
    $itemId = (int)($upgradeStoneItems[$stone['key']] ?? 0);
    $itemImg = rc_upg_item_html($itemId, true, $stone['name']);
    $stoneCardsHtml .= '<div class="rc-tier-extractor rc-upg-stone-card">'
        . '<h4>' . rc_upg_esc($stone['title']) . '</h4>'
        . '<div class="rc-tier-item-spot">' . ($itemImg !== '' ? $itemImg : '<span class="rc-tier-item-fallback">' . rc_upg_esc($stone['title']) . '</span>') . '</div>'
        . '<p class="rc-upg-stone-desc">' . rc_upg_esc($stone['desc']) . '</p>'
        . '</div>';
}

$successRows = '';
foreach ($successRates as $row) {
    $successRows .= '<tr>'
        . '<td><strong>' . rc_upg_esc($row['level']) . '</strong></td>'
        . '<td>' . rc_upg_esc($row['basic']) . '</td>'
        . '<td>' . rc_upg_esc($row['medium']) . '</td>'
        . '<td>' . rc_upg_esc($row['epic']) . '</td>'
        . '</tr>';
}

$attackRows = '';
foreach ($attackBonuses as $row) {
    $attackRows .= '<tr>'
        . '<td><strong>' . rc_upg_esc($row['level']) . '</strong></td>'
        . '<td>' . rc_upg_esc($row['attack']) . '</td>'
        . '</tr>';
}

$transferRows = '';
foreach ($transferPrices as $row) {
    $transferRows .= '<tr>'
        . '<td><strong>' . rc_upg_esc($row['level']) . '</strong></td>'
        . '<td>' . rc_upg_esc($row['price']) . '</td>'
        . '</tr>';
}

echo '<div class="rc-st-page rc-tier-page rc-upg-page">'
    . '<header class="rc-st-page-title rc-tier-hero">'
    . '<h2>Upgrade System</h2>'
    . '<p class="rc-tier-subtitle">Aprimore suas armas com Upgrade Stones, aumentando o ataque conforme o nível de refinamento — com taxas de sucesso e pedras específicas para cada faixa.</p>'
    . '<nav class="rc-tier-nav" aria-label="Seções do guia">'
    . '<a href="#rc-upg-sobre">Sobre</a>'
    . '<a href="#rc-upg-onde">Onde Obter</a>'
    . '<a href="#rc-upg-tipos">Tipos de Pedras</a>'
    . '<a href="#rc-upg-chances">Chances</a>'
    . '<a href="#rc-upg-bonus">Bônus</a>'
    . '<a href="#rc-upg-transfer">Transferência</a>'
    . '</nav>'
    . '</header>'

    . '<section class="rc-st-card" id="rc-upg-sobre">'
    . '<h3>Sobre o Upgrade System</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>O Upgrade System tem como objetivo aprimorar suas armas, aumentando o poder de ataque por meio do uso das <strong>Upgrade Stones</strong>.</li>'
    . '<li>Durante o processo de refinamento, é possível utilizar diferentes pedras de aprimoramento, cada uma com uma taxa de sucesso variável. Quanto maior o nível de refinamento, menor será a chance de sucesso.</li>'
    . '</ul>'
    . '<p class="rc-tier-spaced">Existem três tipos de Upgrade Stones disponíveis no jogo:</p>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Basic Upgrade Stones:</strong> permite melhorias em equipamentos até o nível 4.</li>'
    . '<li><strong>Medium Upgrade Stones:</strong> permite melhorias em equipamentos até o nível 7.</li>'
    . '<li><strong>Epic Upgrade Stones:</strong> permite melhorias em equipamentos até o nível máximo, que é 12.</li>'
    . '</ul>'
    . '<p class="rc-upg-warning"><strong>⚠️ Atenção!</strong> Ao utilizar a Fusion/Convergence Fusion no Forge System em um item com upgrade, todos os upgrades serão perdidos, pois o sistema cria um novo item, o que impossibilita manter quaisquer bônus.</p>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-upg-onde">'
    . '<h3>Onde Obter?</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>Comprando com o NPC <strong>Dealer Merchant</strong>, localizado no -1 do Templo.</li>'
    . '<li>Através do sistema de <strong>Cassino</strong>.</li>'
    . '<li>Completando a <strong>Upgrade Stones Quest</strong>.</li>'
    . '<li>Derrotando <strong>bosses custom</strong> e de <strong>invasão</strong>.</li>'
    . '</ul>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-upg-tipos">'
    . '<h3>Tipos de Pedras</h3>'
    . '<div class="rc-upg-stones-grid">' . $stoneCardsHtml . '</div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-upg-chances">'
    . '<h3>Chances de Sucesso</h3>'
    . '<h4 class="rc-tier-h4">Taxas de Sucesso por Nível</h4>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-upg-table">'
    . '<thead><tr><th>Upgrade</th><th>Basic</th><th>Medium</th><th>Epic</th></tr></thead>'
    . '<tbody>' . $successRows . '</tbody>'
    . '</table></div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-upg-bonus">'
    . '<h3>Bônus de Ataque</h3>'
    . '<h4 class="rc-tier-h4">Tabela de Bônus</h4>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-upg-table">'
    . '<thead><tr><th>Bônus</th><th>Ataque</th></tr></thead>'
    . '<tbody>' . $attackRows . '</tbody>'
    . '</table></div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-upg-transfer">'
    . '<h3>Transfer Upgrade to Catcher</h3>'
    . '<h4 class="rc-tier-h4">Preços de Transferência</h4>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-upg-table">'
    . '<thead><tr><th>Upgrade</th><th>Price</th></tr></thead>'
    . '<tbody>' . $transferRows . '</tbody>'
    . '</table></div>'
    . '</section>'

    . '<style>'
    . '.rc-upg-page .rc-upg-stones-grid{display:flex;flex-wrap:wrap;gap:16px;justify-content:center;margin-top:8px}'
    . '.rc-upg-page .rc-upg-stone-card{flex:1 1 220px;max-width:280px}'
    . '.rc-upg-page .rc-upg-stone-desc{margin:10px 0 0;color:#d6e4ff;font-size:13px;line-height:1.45;text-align:center}'
    . '.rc-upg-page .rc-upg-warning{margin:16px 0 0;padding:12px 14px;border:1px solid rgba(240,120,80,.45);border-radius:8px;background:rgba(80,24,16,.35);color:#ffd8cc;font-size:13px;line-height:1.5}'
    . '.rc-upg-page .rc-upg-table td,.rc-upg-page .rc-upg-table th{text-align:center}'
    . '</style>'

    . '<script>(function(){'
    . 'document.querySelectorAll(".rc-tier-nav a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");'
    . 'if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);'
    . 'if(!el){return;}'
    . 'ev.preventDefault();'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+12;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",id);'
    . '});'
    . '});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var target=document.querySelector(hash);'
    . 'if(target){setTimeout(function(){'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+12;'
    . 'var top=target.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"auto"});'
    . '},50);}}'
    . '})();</script>'

    . '</div>';
