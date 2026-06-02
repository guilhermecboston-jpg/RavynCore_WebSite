<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Skill Gem System';

global $template_path, $config;

$rcTemplateName = 'tibiacom';
if (isset($config['template']) && is_string($config['template']) && $config['template'] !== '') {
    $rcTemplateName = $config['template'];
}
if (function_exists('config')) {
    $configTemplate = config('template');
    if (is_string($configTemplate) && $configTemplate !== '') {
        $rcTemplateName = $configTemplate;
    }
}
$rcTemplatePath = '/' . ltrim((string)($template_path ?? ('templates/' . $rcTemplateName)), '/');
$rcSgImageBase = $rcTemplatePath . '/images/skill_gem';

$removeExtractItemId = 63475;
$ravynCoreTokenItemId = 61869;

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
    ['skill' => '+1', 'level' => 1, 'kk' => '50kk', 'tokens' => 5],
    ['skill' => '+2', 'level' => 2, 'kk' => '125kk', 'tokens' => 10],
    ['skill' => '+3', 'level' => 3, 'kk' => '200kk', 'tokens' => 15],
    ['skill' => '+4', 'level' => 4, 'kk' => '300kk', 'tokens' => 20],
    ['skill' => '+5', 'level' => 5, 'kk' => '400kk', 'tokens' => 30],
    ['skill' => '+6', 'level' => 6, 'kk' => '550kk', 'tokens' => 40],
    ['skill' => '+7', 'level' => 7, 'kk' => '750kk', 'tokens' => 50],
    ['skill' => '+8', 'level' => 8, 'kk' => '1,000kk', 'tokens' => 60],
    ['skill' => '+9', 'level' => 9, 'kk' => '1,250kk', 'tokens' => 70],
    ['skill' => '+10', 'level' => 10, 'kk' => '1,500kk', 'tokens' => 80],
    ['skill' => '+11', 'level' => 11, 'kk' => '2,000kk', 'tokens' => 90],
    ['skill' => '+12', 'level' => 12, 'kk' => '3,000kk', 'tokens' => 100],
];

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
    ['vocation' => 'Monk', 'skills' => 'Magic Level e Fist', 'note' => 'Bônus nas duas skills ao equipar (magic e fist).'],
];

if (!function_exists('rc_sg_esc')) {
    function rc_sg_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_sg_img_src')) {
    function rc_sg_img_src($relPath)
    {
        $relPath = ltrim(str_replace('\\', '/', (string)$relPath), '/');
        if ($relPath === '') {
            return '';
        }
        if (defined('BASE_URL')) {
            return BASE_URL . $relPath;
        }

        return '/' . $relPath;
    }
}

if (!function_exists('rc_sg_wiki_img_path')) {
    function rc_sg_wiki_img_path($itemId)
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }
        $candidates = [
            'imagens/creaturestibiawiki/' . $itemId . '.gif',
            'images/creaturetibiawiki/' . $itemId . '.gif',
        ];
        foreach ($candidates as $path) {
            if (file_exists(BASE . $path)) {
                return $path;
            }
        }
        return $candidates[0];
    }
}

if (!function_exists('rc_sg_item_html')) {
    function rc_sg_item_html($itemId, $large = false, $label = '')
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }
        $class = $large ? 'rc-tier-item-img rc-tier-item-img-lg' : 'rc-tier-item-img';
        $wikiPath = rc_sg_wiki_img_path($itemId);
        if ($wikiPath !== '') {
            $alt = $label !== '' ? rc_sg_esc($label) : '';
            return '<img class="' . $class . '" src="' . rc_sg_esc(rc_sg_img_src($wikiPath)) . '" width="32" height="32" alt="' . $alt . '" loading="lazy">';
        }
        $path = 'images/items/' . $itemId . '.gif';
        if (file_exists(BASE . $path)) {
            $alt = $label !== '' ? rc_sg_esc($label) : '';
            return '<img class="' . $class . '" src="' . rc_sg_esc(rc_sg_img_src($path)) . '" width="32" height="32" alt="' . $alt . '" loading="lazy">';
        }
        $img = function_exists('getItemImage') ? getItemImage($itemId) : '';
        if ($img !== '') {
            $img = preg_replace('/<img\s+/', '<img class="' . $class . '" ', $img, 1);
            if ($label !== '') {
                $img = preg_replace('/alt="[^"]*"/', 'alt="' . rc_sg_esc($label) . '"', $img, 1);
            }
            return $img;
        }
        if ($label !== '') {
            return '<span class="rc-tier-item-fallback">' . rc_sg_esc($label) . '</span>';
        }
        return '';
    }
}

if (!function_exists('rc_sg_page_image')) {
    function rc_sg_page_image($templateRelBase, $fileName, $class, $alt)
    {
        $relPath = rtrim(ltrim(str_replace('\\', '/', (string)$templateRelBase), '/'), '/')
            . '/' . ltrim((string)$fileName, '/');
        if (!file_exists(BASE . $relPath)) {
            return '';
        }
        return '<img class="' . rc_sg_esc($class) . '" src="' . rc_sg_esc(rc_sg_img_src($relPath)) . '" alt="' . rc_sg_esc($alt) . '" loading="lazy">';
    }
}

if (!function_exists('rc_sg_apply_cost_cell')) {
    function rc_sg_apply_cost_cell($row)
    {
        if (!$row) {
            return '—';
        }
        return '<strong>' . rc_sg_esc($row['kk']) . '</strong>';
    }
}

if (!function_exists('rc_sg_extract_cost_cell')) {
    function rc_sg_extract_cost_cell($row, $removeItemId, $tokenItemId)
    {
        if (!$row) {
            return '—';
        }
        $tokens = (int)($row['tokens'] ?? 0);
        $tokenImg = rc_sg_item_html((int)$tokenItemId, false, 'RavynCore Token');
        $removeImg = rc_sg_item_html((int)$removeItemId, false, 'Remove Upgrade Status');
        $tokenLabel = $tokens . ' RavynCore Token' . ($tokens === 1 ? '' : 's');
        $removeLabel = '1 Remove Upgrade Status';

        return '<div class="rc-sg-extract-cost">'
            . '<strong>' . rc_sg_esc($row['kk']) . '</strong>'
            . '<span class="rc-sg-extract-plus">+</span>'
            . ($tokenImg !== '' ? $tokenImg : '')
            . '<span>' . rc_sg_esc($tokenLabel) . '</span>'
            . '<span class="rc-sg-extract-plus">+</span>'
            . ($removeImg !== '' ? $removeImg : '')
            . '<span>' . rc_sg_esc($removeLabel) . '</span>'
            . '</div>';
    }
}

$lookSkillGemHtml = rc_sg_page_image(
    $rcSgImageBase,
    'look_skill-gem.png',
    'rc-sg-look-preview',
    'Look do item com Skill Gem'
);
$transferUiHtml = rc_sg_page_image(
    $rcSgImageBase,
    'skill_gem_transfer.png',
    'rc-sg-transfer-preview',
    'Remove Skill Gem — interface'
);

$gemRows = '';
foreach ($gems as $gem) {
    $gemRows .= '<tr><td class="rc-tier-table-item rc-sg-gem-cell">'
        . rc_sg_item_html($gem['id'], false, '')
        . '<strong class="rc-sg-gem-name">' . rc_sg_esc($gem['name']) . '</strong></td>'
        . '<td>Nível ' . (int)$gem['level'] . '</td><td>' . rc_sg_esc($gem['bonus']) . '</td>'
        . '<td>' . rc_sg_esc($gem['slots']) . '</td><td><strong>' . rc_sg_esc($gem['group']) . '</strong></td></tr>';
}

$tierByLevel = [];
foreach ($skillTierCrystals as $crystal) {
    $tierByLevel[(int)$crystal['level']] = (int)$crystal['id'];
}

$priceRows = '';
foreach ($tierServicePrices as $row) {
    $level = (int)$row['level'];
    $tierItemId = $tierByLevel[$level] ?? 0;
    $priceRows .= '<tr>'
        . '<td class="rc-tier-table-item rc-sg-tier-gem">' . rc_sg_item_html($tierItemId, false, '') . '</td>'
        . '<td>' . rc_sg_apply_cost_cell($row) . '</td>'
        . '<td>' . rc_sg_extract_cost_cell($row, $removeExtractItemId, $ravynCoreTokenItemId) . '</td>'
        . '</tr>';
}

$vocationRows = '';
foreach ($vocationBonuses as $row) {
    $vocationRows .= '<tr><td><strong>' . rc_sg_esc($row['vocation']) . '</strong></td>'
        . '<td>' . rc_sg_esc($row['skills']) . '</td>'
        . '<td>' . rc_sg_esc($row['note']) . '</td></tr>';
}

$removeItemHtml = rc_sg_item_html($removeExtractItemId, true, 'Remove Upgrade Status');

echo '<div class="rc-st-page rc-sg-page">'
    . '<header class="rc-st-page-title"><h2>Skill Gem System</h2></header>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-info">'
    . '<h3>Como funciona</h3>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Grupo A</strong>: '
    . '<span class="rc-sg-highlight">Amulet</span>, <span class="rc-sg-highlight">Ring</span>, '
    . '<span class="rc-sg-highlight">Weapon</span> e <span class="rc-sg-highlight">Helmet</span>.</li>'
    . '<li><strong>Grupo B</strong>: '
    . '<span class="rc-sg-highlight">Armor</span>, <span class="rc-sg-highlight">Legs</span>, '
    . '<span class="rc-sg-highlight">Boots</span> e '
    . '<span class="rc-sg-highlight">Shield / Spellbook / Quiver</span>.</li>'
    . '<li>Aplique uma Skill Gem em um equipamento que ainda não possua uma gema, conforme demonstrado na imagem abaixo e seguindo a '
    . '<a class="rc-sg-price-link" href="#rc-sg-prices">tabela de custos</a>.</li>'
    . '<li>Para extrair uma Skill Gem, é necessário utilizar um Remove Upgrade Status, além da quantidade de dinheiro e RavynCore Tokens indicada na '
    . '<a class="rc-sg-price-link" href="#rc-sg-prices">tabela de custos</a>.</li>'
    . '<li>Após aplicar ou extrair uma Skill Gem, tanto o equipamento quanto a gema serão enviados automaticamente para a <strong>Store Inbox</strong>.</li>'
    . '</ul>'
    . ($lookSkillGemHtml !== ''
        ? '<figure class="rc-sg-look-wrap">' . $lookSkillGemHtml . '</figure>'
        : '')
    . '<div class="rc-tier-extractor rc-sg-remove-card">'
    . '<h4>Remove Upgrade Status</h4>'
    . '<div class="rc-tier-item-spot">' . ($removeItemHtml !== '' ? $removeItemHtml : '') . '</div>'
    . '</div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-vocation">'
    . '<h3>Bônus por vocação (ao equipar)</h3>'
    . '<div class="rc-st-table-center rc-sg-table-center rc-sg-table-center--lg">'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Vocação</th><th>Skills com bônus</th><th>Observação</th></tr></thead>'
    . '<tbody>' . $vocationRows . '</tbody></table></div></div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-gems"><h3>Gemas de Skill</h3>'
    . '<div class="rc-st-table-center rc-sg-table-center rc-sg-table-center--xl">'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table">'
    . '<thead><tr><th>Skill Gem</th><th>Nível</th><th>Bônus</th><th>Slots</th><th>Grupo</th></tr></thead>'
    . '<tbody>' . $gemRows . '</tbody></table></div></div></section>'

    . '<section class="rc-st-card rc-sg-anchor" id="rc-sg-prices">'
    . '<h3>Tabela de custos</h3>'
    . ($transferUiHtml !== ''
        ? '<figure class="rc-sg-transfer-wrap">' . $transferUiHtml . '<figcaption>Remove Skill Gem</figcaption></figure>'
        : '')
    . '<div class="rc-st-table-center rc-sg-table-center rc-sg-table-center--xl">'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap"><table class="rc-bf-table rc-tier-table rc-sg-table rc-sg-price-table">'
    . '<thead><tr><th>Skill Tier Gem</th><th>Custo (aplicação)</th><th>Custo (extrair)</th></tr></thead>'
    . '<tbody>' . $priceRows . '</tbody></table></div></div>'
    . '</section>'

    . '<script>(function(){'
    . 'function sgScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-sg-page a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();sgScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){sgScrollTo(t);},120);}}'
    . '})();</script></div>';
