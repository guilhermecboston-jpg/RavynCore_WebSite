<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Roulette System';
$data = require SYSTEM . 'libs/casino_roulette_data.php';

if (!function_exists('rc_roulette_esc')) {
    function rc_roulette_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_roulette_item_html')) {
    function rc_roulette_item_html($itemId, $label = '')
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

if (!function_exists('rc_roulette_pretty_name')) {
    function rc_roulette_pretty_name($name)
    {
        $name = trim((string)$name);
        if ($name === '' || preg_match('/^item \d+$/i', $name)) {
            return $name;
        }
        return ucwords($name);
    }
}

if (!function_exists('rc_roulette_render_pool')) {
    function rc_roulette_render_pool(array $items)
    {
        $html = '';
        foreach ($items as $item) {
            $name = rc_roulette_pretty_name($item['name'] ?? '');
            $html .= '<li class="rc-casino-loot-item">'
                . '<span class="rc-casino-loot-icon">' . rc_roulette_item_html((int)$item['id'], $name) . '</span>'
                . '<span class="rc-casino-loot-name">' . rc_roulette_esc($name) . '</span>'
                . '</li>';
        }
        return $html;
    }
}

$tokenId = (int)($data['tokenId'] ?? 64087);
$tokenName = rc_roulette_pretty_name($data['tokenName'] ?? 'Roulette Token');
$spinOptions = $data['spinOptions'] ?? [1, 5, 10, 25, 50, 100];

$bonusRows = '';
foreach ($data['spinningBonus'] ?? [] as $row) {
    $rewardName = rc_roulette_pretty_name($row['reward'] ?? '');
    $itemId = (int)($row['itemId'] ?? 0);
    $bonusRows .= '<tr><td><strong>' . (int)$row['spins'] . ' giros</strong></td><td>'
        . '<span class="rc-casino-bonus-reward">'
        . '<span class="rc-casino-loot-icon">' . rc_roulette_item_html($itemId, $rewardName) . '</span>'
        . '<span>' . rc_roulette_esc($rewardName) . '</span>'
        . '</span></td></tr>';
}

$spinList = implode(', ', array_map(static function ($n) {
    return (int)$n . 'x';
}, $spinOptions));

$commons = $data['commons'] ?? [];
$rouletteColumns = '';
foreach ($data['roulettes'] ?? [] as $roleta) {
    $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower((string)($roleta['id'] ?? '')));
    $pool = array_merge($roleta['exclusive'] ?? [], $commons);
    $poolHtml = rc_roulette_render_pool($pool);
    $rouletteColumns .= '<section class="rc-st-card rc-casino-roleta-col" id="rc-roleta-' . rc_roulette_esc($slug) . '">'
        . '<h3>' . rc_roulette_esc($roleta['name'] ?? '') . '</h3>'
        . '<p class="rc-casino-roleta-note">Prêmios exclusivos desta roleta + itens comuns do cassino.</p>'
        . '<ul class="rc-casino-loot-grid">' . $poolHtml . '</ul>'
        . '</section>';
}

echo '<div class="rc-st-page rc-tier-page rc-casino-page">'
    . '<header class="rc-st-page-title"><h2>Roulette System</h2></header>'
    . '<nav class="rc-tier-nav rc-tier-nav-below" aria-label="Seções">'
    . '<a href="#rc-roulette-intro">Sistema</a>'
    . '<a href="#rc-roulette-casino">Cassino</a>'
    . '<a href="#rc-roulette-bonus">Spinning Bonus</a>'
    . '<a href="#rc-roulette-prizes">Prêmios</a>'
    . '</nav>'

    . '<section class="rc-st-card rc-casino-anchor" id="rc-roulette-intro">'
    . '<h3>Como funciona</h3>'
    . '<div class="rc-casino-hero-row">'
    . '<div class="rc-tier-item-spot">' . rc_roulette_item_html($tokenId, $tokenName) . '</div>'
    . '<div class="rc-casino-hero-text">'
    . '<p>No RavynCore o sistema de roleta é baseado em aleatoriedade do sorteio dos itens, porém a probabilidade de ganhar raros é mais baixa: quanto mais raro o prêmio, menor a chance de parar no centro.</p>'
    . '<p>O jogador <strong>sempre recebe uma premiação</strong> ao rodar a roleta, desde as mais comuns até as mais raras. A ideia do sistema <strong>não é pay to win</strong> — é preciso sorte para conseguir bons itens; não se ganha tudo em 10 spins.</p>'
    . '<p>Para rodar é necessário <strong>1x ' . rc_roulette_esc($tokenName) . '</strong> por giro (ou lote: ' . rc_roulette_esc($spinList) . ' via modal da alavanca). Prêmios vão para a <strong>Store Inbox</strong>.</p>'
    . '<p>Boxes do <a href="' . rc_roulette_esc(BASE_URL . '?subtopic=boxsystem') . '">Box System</a> também podem sair como prêmio raro.</p>'
    . '</div></div></section>'

    . '<section class="rc-st-card rc-casino-anchor" id="rc-roulette-casino">'
    . '<h3>RavynCore Cassino</h3>'
    . '<p>Entrada pelo templo (andar +6) → teleporte para o cassino. Três roletas: <strong>Norte</strong>, <strong>Esquerda</strong> e <strong>Sul</strong>.</p>'
    . '</section>'

    . '<section class="rc-st-card rc-casino-anchor" id="rc-roulette-bonus">'
    . '<h3>Spinning Bonus</h3>'
    . '<p>O <span class="rc-di-highlight">Spinning Bonus</span> oferece recompensa garantida a cada quantidade de giros. Após <strong>100 giros</strong>, o bônus reseta e você acumula novamente.</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table">'
    . '<thead><tr><th>Giros acumulados</th><th>Recompensa</th></tr></thead>'
    . '<tbody>' . $bonusRows . '</tbody></table></div>'
    . '</section>'

    . '<section class="rc-casino-roleta-wrap rc-casino-anchor" id="rc-roulette-prizes">'
    . '<h3 class="rc-casino-section-title">Roletas e prêmios</h3>'
    . '<div class="rc-casino-roleta-grid">' . $rouletteColumns . '</div>'
    . '</section>'

    . '<style>'
    . '.rc-casino-page .rc-casino-anchor{scroll-margin-top:140px}'
    . '.rc-casino-page .rc-casino-hero-row{display:flex;flex-wrap:wrap;gap:16px;align-items:flex-start}'
    . '.rc-casino-page .rc-casino-hero-text{flex:1;min-width:260px;font-size:14px;line-height:1.55;color:#d6e4ff}'
    . '.rc-casino-page .rc-casino-hero-text p{margin:0 0 10px}'
    . '.rc-casino-page .rc-di-highlight{color:#f2c16b;font-weight:700}'
    . '.rc-casino-page .rc-casino-section-title{margin:0 0 12px 4px;color:#f2c16b}'
    . '.rc-casino-page .rc-casino-roleta-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:14px}'
    . '.rc-casino-page .rc-casino-roleta-note{font-size:13px;color:#9eb4d8;margin:0 0 10px}'
    . '.rc-casino-page .rc-casino-loot-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:6px 10px;list-style:none;margin:0 0 8px;padding:0}'
    . '.rc-casino-page .rc-casino-loot-item{display:flex;align-items:center;gap:8px;font-size:12px;color:#e8f0ff}'
    . '.rc-casino-page .rc-casino-loot-icon{width:32px;height:32px;display:flex;align-items:center;justify-content:center;flex-shrink:0}'
    . '.rc-casino-page .rc-casino-bonus-reward{display:inline-flex;align-items:center;gap:8px}'
    . '</style>'

    . '<script>(function(){function rs(a){if(!a)return;var h=document.querySelector(".rc-header"),o=(h?h.offsetHeight:0)+16,t=a.getBoundingClientRect().top+window.pageYOffset-o;window.scrollTo({top:Math.max(0,t),behavior:"smooth"});history.replaceState(null,"",a.id?"#"+a.id:"");}'
    . 'document.querySelectorAll(".rc-casino-page .rc-tier-nav a[href^=\'#\']").forEach(function(l){l.addEventListener("click",function(e){var id=l.getAttribute("href");if(!id||id[0]!=="#")return;var el=document.querySelector(id);if(!el)return;e.preventDefault();rs(el);});});'
    . 'var h=window.location.hash;if(h){var t=document.querySelector(h);if(t)setTimeout(function(){rs(t);},120);}})();</script></div>';
