<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Skill Gem System';

$gemIds = [
    'green_l1' => 61521,
    'purple_l1' => 61522,
    'red_l1' => 61523,
    'yellow_l1' => 61524,
    'green_l2' => 61525,
    'purple_l2' => 61526,
    'red_l2' => 61527,
    'yellow_l2' => 61528,
];

$removeTransferItemId = 63475;

$levelTables = [
    [
        'title' => 'Nível 1',
        'rows' => [
            ['name' => 'Green Gem', 'key' => 'green_l1', 'bonus' => '+1~2 Skill Increase'],
            ['name' => 'Purple Gem', 'key' => 'purple_l1', 'bonus' => '+1~2 Skill Increase'],
            ['name' => 'Red Gem', 'key' => 'red_l1', 'bonus' => '+1~2 Skill Increase'],
            ['name' => 'Yellow Gem', 'key' => 'yellow_l1', 'bonus' => '+1~2 Skill Increase'],
        ],
    ],
    [
        'title' => 'Nível 2',
        'rows' => [
            ['name' => 'Green Stone', 'key' => 'green_l2', 'bonus' => '+2~4 Skill Increase'],
            ['name' => 'Purple Stone', 'key' => 'purple_l2', 'bonus' => '+2~4 Skill Increase'],
            ['name' => 'Red Stone', 'key' => 'red_l2', 'bonus' => '+2~4 Skill Increase'],
            ['name' => 'Yellow Stone', 'key' => 'yellow_l2', 'bonus' => '+2~4 Skill Increase'],
        ],
    ],
    [
        'title' => 'Nível 3',
        'rows' => [
            ['name' => 'Green Stone', 'bonus' => '+5~8 Skill Increase'],
            ['name' => 'Purple Stone', 'bonus' => '+5~8 Skill Increase'],
            ['name' => 'Red Stone', 'bonus' => '+5~8 Skill Increase'],
            ['name' => 'Yellow Stone', 'bonus' => '+5~8 Skill Increase'],
        ],
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

$levelSectionsHtml = '';
foreach ($levelTables as $section) {
    $rowsHtml = '';
    foreach ($section['rows'] as $row) {
        $itemId = isset($row['key'], $gemIds[$row['key']]) ? (int)$gemIds[$row['key']] : 0;
        $itemCell = $itemId > 0
            ? '<td class="rc-tier-table-item">' . rc_sg_item_html($itemId, false, $row['name']) . '</td>'
            : '<td>-</td>';
        $rowsHtml .= '<tr><td><strong>' . rc_sg_esc($row['name']) . '</strong></td>' . $itemCell
            . '<td>' . rc_sg_esc($row['bonus']) . '</td></tr>';
    }
    $levelSectionsHtml .= '<h4 class="rc-tier-h4">' . rc_sg_esc($section['title']) . '</h4>'
        . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
        . '<table class="rc-bf-table rc-tier-table rc-sg-table">'
        . '<thead><tr><th>Gema</th><th>Item</th><th>Bônus</th></tr></thead>'
        . '<tbody>' . $rowsHtml . '</tbody></table></div>';
}

$transferRows = '';
foreach ($transferPrices as $row) {
    $transferRows .= '<tr><td><strong>' . rc_sg_esc($row['skill']) . '</strong></td><td>' . rc_sg_esc($row['price']) . '</td></tr>';
}

$removeItemHtml = rc_sg_item_html($removeTransferItemId, true, 'Remove Upgrade Status');

echo '<div class="rc-st-page rc-tier-page rc-sg-page">'
    . '<header class="rc-st-page-title rc-tier-hero">'
    . '<h2>Skill Gem System</h2>'
    . '<p class="rc-tier-subtitle">Aplique Skill Gems em equipamentos, ganhe bônus na skill principal e transfira o bônus com o Remove Upgrade Status.</p>'
    . '<nav class="rc-tier-nav" aria-label="Seções do guia">'
    . '<a href="#rc-sg-info">Informações</a>'
    . '<a href="#rc-sg-ganhos">Ganhos</a>'
    . '<a href="#rc-sg-transfer">Transferência</a>'
    . '</nav>'
    . '</header>'

    . '<section class="rc-st-card" id="rc-sg-info">'
    . '<h3>Informações Gerais</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>No <strong>RavynCore</strong>, as Skill Gems podem ser usadas em: <strong>Helmet, Armor, Legs, Boots, Arma, Shield/Book, Ring e Amulet</strong> (um bônus por item).</li>'
    . '<li>Você pode adquirir as gemas por meio de <strong>Quests</strong>, <strong>NPCs</strong>, <strong>Craft</strong> e <strong>Store</strong>.</li>'
    . '<li>Para remover ou transferir o bônus, utilize o item <strong>Remove Upgrade Status</strong> (ID ' . (int)$removeTransferItemId . ') — uso único, abre a janela de transferência no cliente.</li>'
    . '<li>Apenas <strong>uma gema por item</strong>. Para trocar o bônus, use o Remove Upgrade Status antes de aplicar outra gema.</li>'
    . '<li>Ao aplicar uma Skill Gem, o equipamento recebe um bônus aleatório na <strong>skill principal</strong> do personagem no momento da aplicação.</li>'
    . '</ul>'
    . '<p class="rc-sg-warning"><strong>⚠️ Atenção!</strong> Ao utilizar Fusion/Convergence Fusion no Forge System em um item com gems, todas as gems serão perdidas, pois o sistema cria um novo item.</p>'
    . '<div class="rc-tier-extractor rc-sg-remove-card">'
    . '<h4>Remove Upgrade Status</h4>'
    . '<div class="rc-tier-item-spot">' . ($removeItemHtml !== '' ? $removeItemHtml : '<span class="rc-tier-item-fallback">Remove Upgrade Status</span>') . '</div>'
    . '<p class="rc-sg-desc">Abre a janela de transferência: escolha o item com gem, pague o valor em KK, escolha o destino e ambos os itens vão para a Store Inbox.</p>'
    . '</div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-sg-ganhos">'
    . '<h3>Ganho de Skill por Gem</h3>'
    . $levelSectionsHtml
    . '</section>'

    . '<section class="rc-st-card" id="rc-sg-transfer">'
    . '<h3>Transfer Skill to Catcher</h3>'
    . '<p class="rc-tier-spaced">Transfira o bônus de skill acumulado usando o <strong>Remove Upgrade Status</strong> e o valor em gold abaixo:</p>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Skill</th><th>Preço</th></tr></thead>'
    . '<tbody>' . $transferRows . '</tbody>'
    . '</table></div>'
    . '</section>'

    . '<style>'
    . '.rc-sg-page .rc-sg-table td,.rc-sg-page .rc-sg-table th{text-align:center}'
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
