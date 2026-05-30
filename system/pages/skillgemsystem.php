<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Skill Gem System';

$removeExtractItemId = 63475;

$gems = [
    ['id' => 61521, 'name' => 'Green Gem', 'level' => 1, 'bonus' => '+1~2', 'slots' => 'Amulet, Ring, Weapon ou Helmet', 'group' => 'A'],
    ['id' => 61522, 'name' => 'Blue Gem', 'level' => 1, 'bonus' => '+1~2', 'slots' => 'Armor, Legs, Boots ou Shield/Book/Quiver', 'group' => 'B'],
    ['id' => 61523, 'name' => 'Yellow Gem', 'level' => 2, 'bonus' => '+2~4', 'slots' => 'Amulet, Ring, Weapon ou Helmet', 'group' => 'A'],
    ['id' => 61524, 'name' => 'Red Gem', 'level' => 2, 'bonus' => '+2~4', 'slots' => 'Armor, Legs, Boots ou Shield/Book/Quiver', 'group' => 'B'],
    ['id' => 61525, 'name' => 'Orange Gem', 'level' => 3, 'bonus' => '+5~8', 'slots' => 'Amulet, Ring, Weapon ou Helmet', 'group' => 'A'],
    ['id' => 61526, 'name' => 'White Gem', 'level' => 3, 'bonus' => '+5~8', 'slots' => 'Armor, Legs, Boots ou Shield/Book/Quiver', 'group' => 'B'],
    ['id' => 61527, 'name' => 'Black Gem', 'level' => 4, 'bonus' => '+9~12', 'slots' => 'Amulet, Ring, Weapon ou Helmet', 'group' => 'A'],
    ['id' => 61528, 'name' => 'Pink Gem', 'level' => 4, 'bonus' => '+9~12', 'slots' => 'Armor, Legs, Boots ou Shield/Book/Quiver', 'group' => 'B'],
];

$tierServicePrices = [
    ['skill' => '+1', 'price' => '50kk'],
    ['skill' => '+2', 'price' => '100kk'],
    ['skill' => '+3', 'price' => '150kk'],
    ['skill' => '+4', 'price' => '200kk'],
    ['skill' => '+5', 'price' => '250kk'],
    ['skill' => '+6', 'price' => '300kk'],
    ['skill' => '+7', 'price' => '350kk'],
    ['skill' => '+8', 'price' => '500kk'],
    ['skill' => '+9', 'price' => '600kk'],
    ['skill' => '+10', 'price' => '700kk'],
    ['skill' => '+11', 'price' => '800kk'],
    ['skill' => '+12', 'price' => '1000kk'],
];

$skillTierCrystals = [
    ['id' => 63340, 'skill' => '+1'],
    ['id' => 63341, 'skill' => '+2'],
    ['id' => 63342, 'skill' => '+3'],
    ['id' => 63343, 'skill' => '+4'],
    ['id' => 63344, 'skill' => '+5'],
    ['id' => 63345, 'skill' => '+6'],
    ['id' => 63346, 'skill' => '+7'],
    ['id' => 63347, 'skill' => '+8'],
    ['id' => 63348, 'skill' => '+9'],
    ['id' => 63349, 'skill' => '+10'],
    ['id' => 63350, 'skill' => '+11'],
    ['id' => 63339, 'skill' => '+12'],
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
            $img = preg_replace('/alt="[^"]*"/', 'alt="' . rc_sg_esc($alt) . '"', $img, 1);
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
    $gemRows .= '<tr><td><strong>' . rc_sg_esc($gem['name']) . '</strong><br><span class="rc-sg-id">ID ' . (int)$gem['id'] . '</span></td>'
        . '<td class="rc-tier-table-item">' . rc_sg_item_html($gem['id'], false, $gem['name']) . '</td>'
        . '<td>Nível ' . (int)$gem['level'] . '</td><td>' . rc_sg_esc($gem['bonus']) . '</td>'
        . '<td>' . rc_sg_esc($gem['slots']) . '</td><td><strong>' . rc_sg_esc($gem['group']) . '</strong></td></tr>';
}

$priceRows = '';
foreach ($tierServicePrices as $row) {
    $priceRows .= '<tr><td><strong>' . rc_sg_esc($row['skill']) . '</strong></td><td>' . rc_sg_esc($row['price']) . '</td></tr>';
}

$tierRows = '';
foreach ($skillTierCrystals as $row) {
    $tierRows .= '<tr><td><strong>Skill ' . rc_sg_esc($row['skill']) . '</strong><br><span class="rc-sg-id">ID ' . (int)$row['id'] . '</span></td>'
        . '<td class="rc-tier-table-item">' . rc_sg_item_html($row['id'], false, 'Skill ' . $row['skill']) . '</td>'
        . '<td>' . rc_sg_esc($row['skill']) . '</td></tr>';
}

$removeItemHtml = rc_sg_item_html($removeExtractItemId, true, 'Remove Upgrade Status');

echo '<div class="rc-st-page rc-tier-page rc-sg-page">'
    . '<header class="rc-st-page-title rc-tier-hero">'
    . '<h2>Skill Gem System</h2>'
    . '<p class="rc-tier-subtitle">Aplique gemas nos equipamentos. Extraia skill com Remove Upgrade Status (estilo Tier Extractor). Aplique o cristal Skill Tier em qualquer slot do Grupo A ou B.</p>'
    . '<nav class="rc-tier-nav" aria-label="Seções do guia">'
    . '<a href="#rc-sg-info">Informações</a>'
    . '<a href="#rc-sg-gems">Gemas</a>'
    . '<a href="#rc-sg-tier">Skill Tier</a>'
    . '<a href="#rc-sg-prices">Preços</a>'
    . '</nav></header>'

    . '<section class="rc-st-card" id="rc-sg-info">'
    . '<h3>Como funciona</h3>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Aplicar gema</strong> (61521–61528): use a gema no equipamento ou pela janela do cliente OTC.</li>'
    . '<li><strong>Extrair skill</strong>: use <strong>Remove Upgrade Status</strong> (ID ' . (int)$removeExtractItemId . ') <em>no equipamento que já tem skill gem</em> — igual ao extrator de Tier. O item vai para a Store Inbox e você recebe um <strong>Skill Tier Crystal</strong>.</li>'
    . '<li><strong>Aplicar cristal</strong>: use o Skill Tier (63339–63350) em qualquer equipamento vazio do <strong>Grupo A ou B</strong>. Mantém o tipo de skill extraído (ex.: Sword, Distance).</li>'
    . '<li>Backpack e Trinket não são válidos.</li>'
    . '</ul>'
    . '<div class="rc-tier-extractor rc-sg-remove-card">'
    . '<h4>Remove Upgrade Status</h4>'
    . '<div class="rc-tier-item-spot">' . ($removeItemHtml !== '' ? $removeItemHtml : '') . '</div>'
  . '<p class="rc-sg-desc">Use no item com gem equipada (não abre janela — ação direta no item).</p>'
    . '</div></section>'

    . '<section class="rc-st-card" id="rc-sg-gems"><h3>Gemas de Skill</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Gema</th><th>Item</th><th>Nível</th><th>Bônus</th><th>Slots</th><th>Grupo</th></tr></thead>'
    . '<tbody>' . $gemRows . '</tbody></table></div></section>'

    . '<section class="rc-st-card" id="rc-sg-tier"><h3>Skill Tier Crystals (extraídos)</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Cristal</th><th>Item</th><th>Skill</th></tr></thead>'
    . '<tbody>' . $tierRows . '</tbody></table></div></section>'

    . '<style>.rc-sg-page .rc-sg-table td,.rc-sg-page .rc-sg-table th{text-align:center}'
    . '.rc-sg-page .rc-sg-id{font-size:11px;color:#9eb8e8}.rc-sg-page .rc-sg-desc{margin-top:10px;font-size:13px;color:#d6e4ff;text-align:center}'
    . '.rc-sg-page .rc-sg-remove-card{max-width:320px;margin:16px auto 0}</style></div>';
