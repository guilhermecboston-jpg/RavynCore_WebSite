<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Skill Gem System';

$removeTransferItemId = 63475;

$gems = [
    [
        'id' => 61521,
        'name' => 'Green Gem',
        'level' => 1,
        'color' => 'Green',
        'bonus' => '+1~2',
        'slot' => 'Amulet',
        'group' => 'A (Amulet, Ring, Weapon, Helmet)',
    ],
    [
        'id' => 61522,
        'name' => 'Blue Gem',
        'level' => 1,
        'color' => 'Blue',
        'bonus' => '+1~2',
        'slot' => 'Armor',
        'group' => 'B (Armor, Legs, Boots, Shield/Book/Quiver)',
    ],
    [
        'id' => 61523,
        'name' => 'Yellow Gem',
        'level' => 2,
        'color' => 'Yellow',
        'bonus' => '+2~4',
        'slot' => 'Ring',
        'group' => 'A',
    ],
    [
        'id' => 61524,
        'name' => 'Red Gem',
        'level' => 2,
        'color' => 'Red',
        'bonus' => '+2~4',
        'slot' => 'Legs',
        'group' => 'B',
    ],
    [
        'id' => 61525,
        'name' => 'Orange Gem',
        'level' => 3,
        'color' => 'Orange',
        'bonus' => '+5~8',
        'slot' => 'Weapon',
        'group' => 'A',
    ],
    [
        'id' => 61526,
        'name' => 'White Gem',
        'level' => 3,
        'color' => 'White',
        'bonus' => '+5~8',
        'slot' => 'Boots',
        'group' => 'B',
    ],
    [
        'id' => 61527,
        'name' => 'Black Gem',
        'level' => 4,
        'color' => 'Black',
        'bonus' => '+9~12',
        'slot' => 'Helmet',
        'group' => 'A',
    ],
    [
        'id' => 61528,
        'name' => 'Pink Gem',
        'level' => 4,
        'color' => 'Pink',
        'bonus' => '+9~12',
        'slot' => 'Shield / Book / Quiver',
        'group' => 'B',
    ],
];

$transferPrices = [
    ['skill' => '+1', 'price' => '50kk'],
    ['skill' => '+2', 'price' => '100kk'],
    ['skill' => '+3', 'price' => '150kk'],
    ['skill' => '+4', 'price' => '200kk'],
    ['skill' => '+5', 'price' => '250kk'],
    ['skill' => '+6', 'price' => '300kk'],
    ['skill' => '+7', 'price' => '350kk'],
    ['skill' => '+8', 'price' => '400kk'],
    ['skill' => '+9', 'price' => '450kk'],
    ['skill' => '+10', 'price' => '500kk'],
    ['skill' => '+11', 'price' => '550kk'],
    ['skill' => '+12', 'price' => '600kk'],
];

if (!function_exists('rc_sg_esc')) {
    function rc_sg_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_sg_item_html')) {
    function rc_sg_item_html($itemId, $large = false, $label = '')
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }

        $alt = $label !== '' ? $label : 'Item';
        $class = $large ? 'rc-tier-item-img rc-tier-item-img-lg' : 'rc-tier-item-img';
        $wikiPath = 'images/creaturetibiawiki/' . $itemId . '.gif';
        if (file_exists(BASE . $wikiPath)) {
            return '<img class="' . $class . '" src="' . rc_sg_esc($wikiPath) . '" width="32" height="32" alt="' . rc_sg_esc($alt) . '" loading="lazy">';
        }

        $img = function_exists('getItemImage') ? getItemImage($itemId) : '';
        if ($img !== '') {
            $img = preg_replace('/<img\s+/', '<img class="' . $class . '" ', $img, 1);
            if (strpos($img, 'class="') === false) {
                $img = str_replace('<img ', '<img class="' . $class . '" ', $img);
            }
            $img = preg_replace('/alt="[^"]*"/', 'alt="' . rc_sg_esc($alt) . '"', $img, 1);
            $img = preg_replace('/title="[^"]*"/', '', $img);
            return $img;
        }

        $path = 'images/items/' . $itemId . '.gif';
        if (file_exists(BASE . $path)) {
            return '<img class="' . $class . '" src="' . rc_sg_esc($path) . '" width="32" height="32" alt="' . rc_sg_esc($alt) . '" loading="lazy">';
        }

        return '<span class="rc-tier-item-fallback">' . rc_sg_esc($alt) . '</span>';
    }
}

$gemRows = '';
foreach ($gems as $gem) {
    $gemRows .= '<tr>'
        . '<td><strong>' . rc_sg_esc($gem['name']) . '</strong><br><span class="rc-sg-id">ID ' . (int)$gem['id'] . '</span></td>'
        . '<td class="rc-tier-table-item">' . rc_sg_item_html($gem['id'], false, $gem['name']) . '</td>'
        . '<td>Nível ' . (int)$gem['level'] . '</td>'
        . '<td>' . rc_sg_esc($gem['bonus']) . '</td>'
        . '<td><strong>' . rc_sg_esc($gem['slot']) . '</strong></td>'
        . '<td>' . rc_sg_esc($gem['group']) . '</td>'
        . '</tr>';
}

$transferRows = '';
foreach ($transferPrices as $row) {
    $transferRows .= '<tr><td><strong>' . rc_sg_esc($row['skill']) . '</strong></td><td>' . rc_sg_esc($row['price']) . '</td></tr>';
}

$removeItemHtml = rc_sg_item_html($removeTransferItemId, true, 'Remove Upgrade Status');

echo '<div class="rc-st-page rc-tier-page rc-sg-page">'
    . '<header class="rc-st-page-title rc-tier-hero">'
    . '<h2>Skill Gem System</h2>'
    . '<p class="rc-tier-subtitle">8 gemas, 4 níveis — cada ID aplica em <strong>um único slot</strong> de equipamento. Backpack e Trinket não são válidos.</p>'
    . '<nav class="rc-tier-nav" aria-label="Seções do guia">'
    . '<a href="#rc-sg-info">Informações</a>'
    . '<a href="#rc-sg-slots">Mapa de IDs</a>'
    . '<a href="#rc-sg-transfer">Transferência</a>'
    . '</nav>'
    . '</header>'

    . '<section class="rc-st-card" id="rc-sg-info">'
    . '<h3>Informações Gerais</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>Slots permitidos: <strong>Amulet, Ring, Weapon, Helmet, Armor, Legs, Boots, Shield/Book/Quiver</strong>.</li>'
    . '<li><strong>Não</strong> funciona em Backpack, Trinket ou munição comum.</li>'
    . '<li>Grupo <strong>A</strong> (gemas Green / Yellow / Orange / Black): Amulet, Ring, Weapon, Helmet — cada nível em um slot fixo.</li>'
    . '<li>Grupo <strong>B</strong> (gemas Blue / Red / White / Pink): Armor, Legs, Boots, Shield/Book/Quiver — cada nível em um slot fixo.</li>'
    . '<li>Uma gema por item. Para transferir, use <strong>Remove Upgrade Status</strong> (ID ' . (int)$removeTransferItemId . ') no cliente OTC.</li>'
    . '<li>Bônus na <strong>skill principal</strong> do personagem no momento da aplicação.</li>'
    . '</ul>'
    . '<p class="rc-sg-warning"><strong>⚠️ Atenção!</strong> Fusion/Convergence no Forge remove as gems do item.</p>'
    . '<div class="rc-tier-extractor rc-sg-remove-card">'
    . '<h4>Remove Upgrade Status</h4>'
    . '<div class="rc-tier-item-spot">' . ($removeItemHtml !== '' ? $removeItemHtml : '<span class="rc-tier-item-fallback">Remove Upgrade Status</span>') . '</div>'
    . '<p class="rc-sg-desc">Use o item no jogo (OTC) para abrir a janela de transferência. Destino deve ser o <strong>mesmo tipo de slot</strong> do item origem.</p>'
    . '</div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-sg-slots">'
    . '<h3>Mapa: ID → Nome → Slot</h3>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Gema</th><th>Item</th><th>Nível</th><th>Bônus</th><th>Slot exclusivo</th><th>Grupo</th></tr></thead>'
    . '<tbody>' . $gemRows . '</tbody></table></div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-sg-transfer">'
    . '<h3>Transfer Skill to Catcher</h3>'
    . '<p class="rc-tier-spaced">Preços ao transferir com Remove Upgrade Status:</p>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Skill</th><th>Preço</th></tr></thead>'
    . '<tbody>' . $transferRows . '</tbody>'
    . '</table></div>'
    . '</section>'

    . '<style>'
    . '.rc-sg-page .rc-sg-table td,.rc-sg-page .rc-sg-table th{text-align:center}'
    . '.rc-sg-page .rc-sg-id{font-size:11px;color:#9eb8e8;font-weight:normal}'
    . '.rc-sg-page .rc-sg-desc{margin:10px 0 0;color:#d6e4ff;font-size:13px;line-height:1.45;text-align:center}'
    . '.rc-sg-page .rc-sg-warning{margin:16px 0;padding:12px 14px;border:1px solid rgba(240,120,80,.45);border-radius:8px;background:rgba(80,24,16,.35);color:#ffd8cc;font-size:13px;line-height:1.5}'
    . '.rc-sg-page .rc-sg-remove-card{max-width:320px;margin:16px auto 0}'
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
    . '})();</script>'

    . '</div>';
