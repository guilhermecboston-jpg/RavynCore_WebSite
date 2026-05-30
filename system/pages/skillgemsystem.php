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
    ['skill' => '+1',  'level' => 1,  'kk' => '50kk',   'gold' => '50.000.000'],
    ['skill' => '+2',  'level' => 2,  'kk' => '100kk',  'gold' => '100.000.000'],
    ['skill' => '+3',  'level' => 3,  'kk' => '150kk',  'gold' => '150.000.000'],
    ['skill' => '+4',  'level' => 4,  'kk' => '200kk',  'gold' => '200.000.000'],
    ['skill' => '+5',  'level' => 5,  'kk' => '250kk',  'gold' => '250.000.000'],
    ['skill' => '+6',  'level' => 6,  'kk' => '300kk',  'gold' => '300.000.000'],
    ['skill' => '+7',  'level' => 7,  'kk' => '350kk',  'gold' => '350.000.000'],
    ['skill' => '+8',  'level' => 8,  'kk' => '500kk',  'gold' => '500.000.000'],
    ['skill' => '+9',  'level' => 9,  'kk' => '600kk',  'gold' => '600.000.000'],
    ['skill' => '+10', 'level' => 10, 'kk' => '700kk',  'gold' => '700.000.000'],
    ['skill' => '+11', 'level' => 11, 'kk' => '800kk',  'gold' => '800.000.000'],
    ['skill' => '+12', 'level' => 12, 'kk' => '1000kk', 'gold' => '1.000.000.000'],
];

$priceByLevel = [];
foreach ($tierServicePrices as $row) {
    $priceByLevel[(int)$row['level']] = $row;
}

$skillTierCrystals = [
    ['id' => 63340, 'level' => 1],
    ['id' => 63341, 'level' => 2],
    ['id' => 63342, 'level' => 3],
    ['id' => 63343, 'level' => 4],
    ['id' => 63344, 'level' => 5],
    ['id' => 63345, 'level' => 6],
    ['id' => 63346, 'level' => 7],
    ['id' => 63347, 'level' => 8],
    ['id' => 63348, 'level' => 9],
    ['id' => 63349, 'level' => 10],
    ['id' => 63350, 'level' => 11],
    ['id' => 63339, 'level' => 12],
];

$vocationBonuses = [
    ['vocation' => 'Knight', 'skills' => 'Sword, Club e Axe', 'note' => 'Bônus nas três skills melee ao equipar.'],
    ['vocation' => 'Paladin', 'skills' => 'Distance e Shield', 'note' => ''],
    ['vocation' => 'Druid / Sorcerer', 'skills' => 'Magic Level', 'note' => ''],
    ['vocation' => 'Monk', 'skills' => 'Fist e Magic Level', 'note' => ''],
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

if (!function_exists('rc_sg_price_cell')) {
    function rc_sg_price_cell($row, $withRemove)
    {
        if (!$row) {
            return '—';
        }
        $kk = rc_sg_esc($row['kk']);
        $gold = rc_sg_esc($row['gold']);
        if ($withRemove) {
            return '<strong>1× Remove + ' . $kk . '</strong><br><span class="rc-sg-id">' . $gold . ' gold</span>';
        }
        return '<strong>' . $kk . '</strong><br><span class="rc-sg-id">' . $gold . ' gold</span>';
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
    $priceRows .= '<tr><td><strong>' . rc_sg_esc($row['skill']) . '</strong></td>'
        . '<td>' . rc_sg_price_cell($row, true) . '</td>'
        . '<td>' . rc_sg_price_cell($row, false) . '</td></tr>';
}

$tierRows = '';
foreach ($skillTierCrystals as $crystal) {
    $lvl = (int)$crystal['level'];
    $price = $priceByLevel[$lvl] ?? null;
    $skillLabel = $price ? $price['skill'] : ('+' . $lvl);
    $tierRows .= '<tr><td><strong>Skill ' . rc_sg_esc($skillLabel) . '</strong><br><span class="rc-sg-id">ID ' . (int)$crystal['id'] . '</span></td>'
        . '<td class="rc-tier-table-item">' . rc_sg_item_html($crystal['id'], false, 'Skill ' . $skillLabel) . '</td>'
        . '<td><strong>' . rc_sg_esc($skillLabel) . '</strong></td>'
        . '<td>' . rc_sg_price_cell($price, true) . '</td>'
        . '<td>' . rc_sg_price_cell($price, false) . '</td></tr>';
}

$vocationRows = '';
foreach ($vocationBonuses as $row) {
    $vocationRows .= '<tr><td><strong>' . rc_sg_esc($row['vocation']) . '</strong></td>'
        . '<td>' . rc_sg_esc($row['skills']) . '</td>'
        . '<td>' . rc_sg_esc($row['note']) . '</td></tr>';
}

$removeItemHtml = rc_sg_item_html($removeExtractItemId, true, 'Remove Upgrade Status');

echo '<div class="rc-st-page rc-tier-page rc-sg-page">'
    . '<header class="rc-st-page-title rc-tier-hero">'
    . '<h2>Skill Gem System</h2>'
    . '<p class="rc-tier-subtitle">Gemas nos equipamentos (Grupos A e B), bônus por vocação, extração com Remove + gold (kk) e reaplicação do cristal. Look do item: <strong>Skill Gem: +N</strong>.</p>'
    . '<nav class="rc-tier-nav" aria-label="Seções do guia">'
    . '<a href="#rc-sg-info">Informações</a>'
    . '<a href="#rc-sg-vocation">Vocação</a>'
    . '<a href="#rc-sg-gems">Gemas</a>'
    . '<a href="#rc-sg-tier">Skill Tier</a>'
    . '<a href="#rc-sg-prices">Preços (kk)</a>'
    . '</nav></header>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-info">'
    . '<h3>Como funciona</h3>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Grupo A</strong>: Amulet, Ring, Weapon, Helmet. <strong>Grupo B</strong>: Armor, Legs, Boots, Shield / Book / Quiver.</li>'
    . '<li><strong>Aplicar gema</strong> (61521–61528): no equipamento sem gem. Look: <strong>Skill Gem: +8</strong> (sem nome de skill no texto).</li>'
    . '<li><strong>Extrair (remover)</strong>: <strong>1× Remove Upgrade Status</strong> (ID ' . (int)$removeExtractItemId . ') + gold em <strong>kk</strong> (tabela abaixo).</li>'
    . '<li><strong>Aplicar cristal</strong>: só gold em <strong>kk</strong> do nível do cristal — <em>sem</em> Remove.</li>'
    . '<li>Equipamento e cristal vão para a <strong>Store Inbox</strong> após extrair ou aplicar cristal.</li>'
    . '</ul>'
    . '<h4 class="rc-sg-subhead">Tabela de preços (resumo)</h4>'
    . '<p class="rc-tier-spaced">Valores debitados do <strong>inventário + banco</strong>. Mesmo custo em kk para extrair e para aplicar; na extração soma o item Remove.</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table rc-sg-price-table">'
    . '<thead><tr><th>Skill</th><th>Extrair — Remove + kk</th><th>Aplicar cristal — kk</th></tr></thead>'
    . '<tbody>' . $priceRows . '</tbody></table></div>'
    . '<p class="rc-sg-more-prices"><a href="#rc-sg-prices">Ver seção Preços (kk)</a> com exemplos e lista completa.</p>'
    . '<div class="rc-tier-extractor rc-sg-remove-card">'
    . '<h4>Remove Upgrade Status</h4>'
    . '<div class="rc-tier-item-spot">' . ($removeItemHtml !== '' ? $removeItemHtml : '') . '</div>'
    . '<p class="rc-sg-desc">ID ' . (int)$removeExtractItemId . ' — só na <strong>extração</strong>.</p>'
    . '</div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-vocation">'
    . '<h3>Bônus por vocação (ao equipar)</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Vocação</th><th>Skills com bônus</th><th>Observação</th></tr></thead>'
    . '<tbody>' . $vocationRows . '</tbody></table></div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-gems"><h3>Gemas de Skill</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Gema</th><th>Item</th><th>Nível</th><th>Bônus</th><th>Slots</th><th>Grupo</th></tr></thead>'
    . '<tbody>' . $gemRows . '</tbody></table></div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-tier"><h3>Skill Tier Crystals</h3>'
    . '<p class="rc-tier-spaced">Cada cristal tem skill fixa (+1 a +12) e guarda o tipo de skill após extrair. Custos em <strong>kk</strong> por nível:</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Cristal</th><th>Item</th><th>Skill</th>'
    . '<th>Extrair equip.<br><span class="rc-sg-th-sub">Remove + kk</span></th>'
    . '<th>Aplicar cristal<br><span class="rc-sg-th-sub">somente kk</span></th></tr></thead>'
    . '<tbody>' . $tierRows . '</tbody></table></div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-prices"><h3>Preços em kk (gold)</h3>'
    . '<p class="rc-tier-spaced" id="rc-sg-prices-desc">Tabela oficial de serviço por <strong>nível da skill</strong> no item ou no cristal. Gold sai do inventário e do banco.</p>'
    . '<div class="rc-sg-cost-examples">'
    . '<p><strong>+10:</strong> extrair = 1× Remove + <strong>700kk</strong> (700.000.000) · aplicar = <strong>700kk</strong></p>'
    . '<p><strong>+12:</strong> extrair = 1× Remove + <strong>1000kk</strong> (1.000.000.000) · aplicar = <strong>1000kk</strong></p>'
    . '</div>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table rc-sg-price-table">'
    . '<thead><tr><th>Nível skill</th><th>Extrair (remoção)<br><span class="rc-sg-th-sub">1× Remove Upgrade Status + kk</span></th>'
    . '<th>Aplicar cristal<br><span class="rc-sg-th-sub">somente kk (sem Remove)</span></th></tr></thead>'
    . '<tbody>' . $priceRows . '</tbody></table></div>'
    . '<ul class="rc-st-notes rc-sg-price-notes">'
    . '<li>+1 = 50kk · +2 = 100kk · +3 = 150kk · +4 = 200kk · +5 = 250kk · +6 = 300kk</li>'
    . '<li>+7 = 350kk · +8 = 500kk · +9 = 600kk · +10 = 700kk · +11 = 800kk · +12 = 1000kk</li>'
    . '</ul></section>'

    . '<style>'
    . '.rc-sg-page .rc-sg-anchor{scroll-margin-top:140px}'
    . '.rc-sg-page .rc-sg-table td,.rc-sg-page .rc-sg-table th{text-align:center}'
    . '.rc-sg-page .rc-sg-id{font-size:11px;color:#9eb8e8}'
    . '.rc-sg-page .rc-sg-desc{margin-top:10px;font-size:13px;color:#d6e4ff;text-align:center}'
    . '.rc-sg-page .rc-sg-remove-card{max-width:320px;margin:16px auto 0}'
    . '.rc-sg-page .rc-sg-th-sub{font-size:11px;font-weight:400;color:#9eb8e8}'
    . '.rc-sg-page .rc-sg-subhead{margin:18px 0 8px;font-size:15px;color:#e8f0ff}'
    . '.rc-sg-page .rc-sg-more-prices{margin-top:12px;font-size:13px}'
    . '.rc-sg-page .rc-sg-cost-examples{margin:12px 0 16px;padding:12px 14px;border-radius:8px;background:rgba(20,40,80,.45);font-size:14px;line-height:1.5}'
    . '.rc-sg-page .rc-sg-cost-examples p{margin:0 0 8px}.rc-sg-page .rc-sg-cost-examples p:last-child{margin-bottom:0}'
    . '.rc-sg-page .rc-sg-price-notes{margin-top:14px;font-size:13px}'
    . '</style>'

    . '<script>(function(){'
    . 'function sgScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-sg-page .rc-tier-nav a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();sgScrollTo(el);});});'
    . 'document.querySelectorAll(".rc-sg-page a[href^=\'#\']").forEach(function(link){'
    . 'if(link.closest(".rc-tier-nav")){return;}'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();sgScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){sgScrollTo(t);},120);}}'
    . '})();</script></div>';
