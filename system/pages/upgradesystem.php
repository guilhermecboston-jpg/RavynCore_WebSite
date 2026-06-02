<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Upgrade System';

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
$rcUpgImageBase = $rcTemplatePath . '/images/weapon_upgrade';

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

$failDowngradeRates = [
    ['level' => '+2', 'chance' => '10%'],
    ['level' => '+3', 'chance' => '15%'],
    ['level' => '+4', 'chance' => '20%'],
    ['level' => '+5', 'chance' => '25%'],
    ['level' => '+6', 'chance' => '28%'],
    ['level' => '+7', 'chance' => '30%'],
    ['level' => '+8', 'chance' => '32%'],
    ['level' => '+9', 'chance' => '35%'],
    ['level' => '+10', 'chance' => '40%'],
    ['level' => '+11', 'chance' => '45%'],
    ['level' => '+12', 'chance' => '50%'],
];

$attackBonuses = [];
for ($i = 1; $i <= 12; $i++) {
    $attackBonuses[] = [
        'level' => '+' . $i,
        'attack' => (string)($i <= 10 ? $i : ($i === 11 ? 12 : 13)),
    ];
}

$transferPrices = [
    ['level' => 1, 'label' => '+1', 'kk' => '50kk', 'tokens' => 1],
    ['level' => 2, 'label' => '+2', 'kk' => '125kk', 'tokens' => 2],
    ['level' => 3, 'label' => '+3', 'kk' => '200kk', 'tokens' => 3],
    ['level' => 4, 'label' => '+4', 'kk' => '300kk', 'tokens' => 4],
    ['level' => 5, 'label' => '+5', 'kk' => '400kk', 'tokens' => 5],
    ['level' => 6, 'label' => '+6', 'kk' => '550kk', 'tokens' => 6],
    ['level' => 7, 'label' => '+7', 'kk' => '750kk', 'tokens' => 7],
    ['level' => 8, 'label' => '+8', 'kk' => '1kkk', 'tokens' => 8],
    ['level' => 9, 'label' => '+9', 'kk' => '1,250kkk', 'tokens' => 9],
    ['level' => 10, 'label' => '+10', 'kk' => '1,5kkk', 'tokens' => 10],
    ['level' => 11, 'label' => '+11', 'kk' => '2kkk', 'tokens' => 20],
    ['level' => 12, 'label' => '+12', 'kk' => '3kkk', 'tokens' => 30],
];

$ravynCoreTokenItemId = 61869;

if (!function_exists('rc_upg_esc')) {
    function rc_upg_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_upg_img_src')) {
    function rc_upg_img_src($relPath)
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

if (!function_exists('rc_upg_wiki_img_path')) {
    function rc_upg_wiki_img_path($itemId)
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

if (!function_exists('rc_upg_item_html')) {
    function rc_upg_item_html($itemId, $large = false, $label = '')
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }

        $class = $large ? 'rc-tier-item-img rc-tier-item-img-lg' : 'rc-tier-item-img';
        $wikiPath = rc_upg_wiki_img_path($itemId);
        if ($wikiPath !== '') {
            $alt = $label !== '' ? rc_upg_esc($label) : '';
            return '<img class="' . $class . '" src="' . rc_upg_esc(rc_upg_img_src($wikiPath)) . '" width="32" height="32" alt="' . $alt . '" loading="lazy">';
        }

        $path = 'images/items/' . $itemId . '.gif';
        if (file_exists(BASE . $path)) {
            $alt = $label !== '' ? rc_upg_esc($label) : '';
            return '<img class="' . $class . '" src="' . rc_upg_esc(rc_upg_img_src($path)) . '" width="32" height="32" alt="' . $alt . '" loading="lazy">';
        }

        $img = function_exists('getItemImage') ? getItemImage($itemId) : '';
        if ($img !== '') {
            $img = preg_replace('/<img\s+/', '<img class="' . $class . '" ', $img, 1);
            if (strpos($img, 'class="') === false) {
                $img = str_replace('<img ', '<img class="' . $class . '" ', $img);
            }
            if ($label !== '') {
                $img = preg_replace('/alt="[^"]*"/', 'alt="' . rc_upg_esc($label) . '"', $img, 1);
            }
            $img = preg_replace('/title="[^"]*"/', '', $img);

            return $img;
        }

        if ($label !== '') {
            return '<span class="rc-tier-item-fallback">' . rc_upg_esc($label) . '</span>';
        }
        return '';
    }
}

if (!function_exists('rc_upg_page_image')) {
    function rc_upg_page_image($templateRelBase, $fileName, $class, $alt)
    {
        $relPath = rtrim(ltrim(str_replace('\\', '/', (string)$templateRelBase), '/'), '/')
            . '/' . ltrim((string)$fileName, '/');
        if (!file_exists(BASE . $relPath)) {
            return '';
        }
        return '<img class="' . rc_upg_esc($class) . '" src="' . rc_upg_esc(rc_upg_img_src($relPath)) . '" alt="' . rc_upg_esc($alt) . '" loading="lazy">';
    }
}

if (!function_exists('rc_upg_apply_cost_cell')) {
    function rc_upg_apply_cost_cell()
    {
        return '<strong>Grátis</strong>';
    }
}

if (!function_exists('rc_upg_extract_cost_cell')) {
    function rc_upg_extract_cost_cell($row, $tokenItemId)
    {
        if (!$row) {
            return '—';
        }
        $tokens = (int)($row['tokens'] ?? 0);
        $tokenImg = rc_upg_item_html((int)$tokenItemId, false, 'RavynCore Token');
        $tokenLabel = $tokens . ' RavynCore Token' . ($tokens === 1 ? '' : 's');

        return '<div class="rc-upg-transfer-cost">'
            . '<strong>' . rc_upg_esc($row['kk']) . '</strong>'
            . '<span class="rc-upg-cost-plus">+</span>'
            . ($tokenImg !== '' ? $tokenImg : '')
            . '<span>' . rc_upg_esc($tokenLabel) . '</span>'
            . '</div>';
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

$lookUpgradeHtml = rc_upg_page_image(
    $rcUpgImageBase,
    'look_upgrade-gem.png',
    'rc-upg-look-preview',
    'Look do item com Weapon Upgrade'
);

$successRows = '';
foreach ($successRates as $row) {
    $successRows .= '<tr>'
        . '<td><strong>' . rc_upg_esc($row['level']) . '</strong></td>'
        . '<td>' . rc_upg_esc($row['basic']) . '</td>'
        . '<td>' . rc_upg_esc($row['medium']) . '</td>'
        . '<td>' . rc_upg_esc($row['epic']) . '</td>'
        . '</tr>';
}

$failDowngradeRows = '';
foreach ($failDowngradeRates as $row) {
    $failDowngradeRows .= '<tr>'
        . '<td><strong>' . rc_upg_esc($row['level']) . '</strong></td>'
        . '<td>' . rc_upg_esc($row['chance']) . '</td>'
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
        . '<td><strong>' . rc_upg_esc($row['label']) . '</strong></td>'
        . '<td>' . rc_upg_apply_cost_cell() . '</td>'
        . '<td>' . rc_upg_extract_cost_cell($row, $ravynCoreTokenItemId) . '</td>'
        . '</tr>';
}

echo '<div class="rc-st-page rc-upg-page">'
    . '<header class="rc-st-page-title"><h2>Upgrade System</h2></header>'

    . '<section class="rc-st-card rc-upg-anchor" id="rc-upg-sobre">'
    . '<h3>Sobre o Upgrade System</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>O Upgrade System tem como objetivo aprimorar suas armas, aumentando o poder de ataque por meio do uso das <strong>Upgrade Stones</strong>.</li>'
    . '<li>Durante o processo de refinamento, é possível utilizar diferentes pedras de aprimoramento, cada uma com uma taxa de sucesso variável. Quanto maior o nível de refinamento, menor será a chance de sucesso.</li>'
    . '<li>Se o refinamento <strong>falhar</strong> e a arma já estiver em <strong>+1 ou superior</strong>, existe chance de <strong>perder 1 nível de upgrade</strong> — consulte <a class="rc-upg-link" href="#rc-upg-downgrade">Downgrade em Caso de Falha</a>.</li>'
    . '</ul>'
    . ($lookUpgradeHtml !== ''
        ? '<figure class="rc-upg-look-wrap">' . $lookUpgradeHtml . '<figcaption>Exemplo de look com Weapon Upgrade</figcaption></figure>'
        : '')
    . '<p class="rc-tier-spaced">Existem três tipos de Upgrade Stones disponíveis no jogo:</p>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Basic Upgrade Stones:</strong> permite melhorias em equipamentos até o nível 4.</li>'
    . '<li><strong>Medium Upgrade Stones:</strong> permite melhorias em equipamentos até o nível 7.</li>'
    . '<li><strong>Epic Upgrade Stones:</strong> permite melhorias em equipamentos até o nível máximo, que é 12.</li>'
    . '</ul>'
    . '<p class="rc-upg-warning"><strong>⚠️ Atenção!</strong> Ao utilizar a Fusion/Convergence Fusion no Forge System em um item com upgrade, todos os upgrades serão perdidos, pois o sistema cria um novo item, o que impossibilita manter quaisquer bônus.</p>'
    . '</section>'

    . '<section class="rc-st-card rc-upg-anchor" id="rc-upg-onde">'
    . '<h3>Onde Obter?</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>Comprando com o NPC <strong>Jorge Trambiqueiro</strong>, localizado no +1 do Templo.</li>'
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

    . '<section class="rc-st-card rc-upg-anchor" id="rc-upg-downgrade">'
    . '<h3>Downgrade em Caso de Falha</h3>'
    . '<p class="rc-tier-spaced">Ao falhar uma tentativa de upgrade, armas que já estejam no nível <strong>+1 ou superior</strong> possuem uma chance de perder <strong>1 nível de upgrade</strong> (ex.: de +5 para +4).</p>'
    . '<p class="rc-upg-important"><strong>Importante:</strong> Tentativas de upgrade de <strong>+0 para +1</strong> nunca resultam em perda de nível.</p>'
    . '<h4 class="rc-tier-h4">Chance de perder 1 nível ao falhar: conforme a tabela abaixo.</h4>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-upg-table">'
    . '<thead><tr><th>Tentando alcançar</th><th>Chance de downgrade</th></tr></thead>'
    . '<tbody>' . $failDowngradeRows . '</tbody>'
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

    . '<section class="rc-st-card rc-upg-anchor" id="rc-upg-transfer">'
    . '<h3>Transfer Upgrade to Catcher</h3>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table rc-upg-table rc-upg-price-table">'
    . '<thead><tr><th>Upgrade</th><th>Custo (aplicação)</th><th>Custo (extrair)</th></tr></thead>'
    . '<tbody>' . $transferRows . '</tbody>'
    . '</table></div>'
    . '</section>'

    . '<script>(function(){'
    . 'function upgScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-upg-page a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();upgScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){upgScrollTo(t);},120);}}'
    . '})();</script>'

    . '</div>';
