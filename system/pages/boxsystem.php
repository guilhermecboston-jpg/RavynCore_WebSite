<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Box System';
$boxes = require SYSTEM . 'libs/casino_boxes_data.php';

if (!function_exists('rc_box_esc')) {
    function rc_box_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_box_item_html')) {
    function rc_box_item_html($itemId, $label = '')
    {
        if (!function_exists('rc_wiki_item_image')) {
            return '';
        }
        return rc_wiki_item_image((int)$itemId, [
            'class' => 'rc-tier-item-img',
            'large' => false,
            'label' => (string)$label,
        ]);
    }
}

if (!function_exists('rc_box_pretty_name')) {
    function rc_box_pretty_name($name)
    {
        $name = trim((string)$name);
        if ($name === '' || preg_match('/^item \d+$/i', $name)) {
            return $name;
        }
        return ucwords($name);
    }
}

uksort($boxes, static function ($a, $b) {
    return strcmp((string)$a, (string)$b);
});

$boxCards = '';
foreach ($boxes as $boxId => $box) {
    $boxName = rc_box_pretty_name($box['name'] ?? ('Box ' . $boxId));
    $lootItems = '';
    foreach ($box['loot'] ?? [] as $loot) {
        $lootName = rc_box_pretty_name($loot['name'] ?? '');
        $lootItems .= '<li class="rc-casino-loot-item">'
            . '<span class="rc-casino-loot-icon">' . rc_box_item_html((int)$loot['id'], $lootName) . '</span>'
            . '<span class="rc-casino-loot-name">' . rc_box_esc($lootName) . '</span>'
            . '</li>';
    }
    if ($lootItems === '') {
        $lootItems = '<li class="rc-casino-loot-empty">Loot em configuração no servidor.</li>';
    }

    $boxCards .= '<section class="rc-st-card rc-casino-box-card" id="rc-box-' . (int)$boxId . '">'
        . '<div class="rc-casino-box-head">'
        . '<div class="rc-tier-item-spot rc-casino-box-icon">' . rc_box_item_html((int)$boxId, $boxName) . '</div>'
        . '<div><h3>' . rc_box_esc($boxName) . '</h3>'
        . '<p class="rc-casino-box-meta">ID ' . (int)$boxId . ' · ' . count($box['loot'] ?? []) . ' itens possíveis</p></div>'
        . '</div>'
        . '<p class="rc-casino-box-desc">Use com clique direito para receber <strong>1 item aleatório</strong> na <strong>Store Inbox</strong>.</p>'
        . '<ul class="rc-casino-loot-grid">' . $lootItems . '</ul>'
        . '</section>';
}

echo '<div class="rc-st-page rc-tier-page rc-casino-page">'
    . '<header class="rc-st-page-title"><h2>Box System</h2></header>'
    . '<section class="rc-st-card">'
    . '<p>Um problema comum que pode afetar qualquer jogador é o excesso de certos itens raros e falta de outros. '
    . 'Foi pensando nesse problema que desenvolvemos nosso <span class="rc-di-highlight">sistema de boxes</span>, '
    . 'para que você sempre tenha uma chance de conseguir aquele item raro que ainda falta no seu set. '
    . 'Todas essas boxes podem ser encontradas na nossa <a href="' . rc_box_esc(BASE_URL . '?subtopic=roulettesystem') . '">roleta</a>.</p>'
    . '<p>Cada box entrega <strong>um prêmio aleatório</strong> entre os itens listados abaixo.</p>'
    . '</section>'
    . $boxCards
    . '<style>'
    . '.rc-casino-page .rc-casino-box-head{display:flex;gap:14px;align-items:flex-start;margin-bottom:10px}'
    . '.rc-casino-page .rc-casino-box-icon{flex:0 0 auto}'
    . '.rc-casino-page .rc-casino-box-meta{margin:4px 0 0;font-size:12px;color:#9eb4d8}'
    . '.rc-casino-page .rc-casino-box-desc{margin:0 0 12px;font-size:14px;line-height:1.55;color:#d6e4ff}'
    . '.rc-casino-page .rc-casino-loot-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:8px 12px;list-style:none;margin:0;padding:0}'
    . '.rc-casino-page .rc-casino-loot-item{display:flex;align-items:center;gap:8px;font-size:13px;color:#e8f0ff}'
    . '.rc-casino-page .rc-casino-loot-icon{width:36px;height:36px;display:flex;align-items:center;justify-content:center}'
    . '.rc-casino-page .rc-casino-loot-empty{color:#9eb4d8;font-style:italic}'
    . '.rc-casino-page .rc-di-highlight{color:#f2c16b;font-weight:700}'
    . '</style></div>';
