<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Drops Important';

$ravynCoreTokenId = 61869;
$destructionRarityId = 64082;
$lesserFragmentId = 46625;
$greaterFragmentId = 46626;

$tokenRewardRows = [
    ['target' => 'Elemental stone nível 0', 'tokens' => 1],
    ['target' => 'Elemental stone nível 1', 'tokens' => 3],
    ['target' => 'Item classification 3', 'tokens' => 1],
    ['target' => 'Item classification 4', 'tokens' => 5],
];

$bagOfStoneRows = [
    ['level' => 0, 'id' => 63980, 'name' => 'Bag of Stone nível 0', 'source' => 'Chance de dropar de todos os Bosses ou comprar no NPC <strong>Jorge Trambiqueiro</strong>, por RavynCore Token.'],
    ['level' => 1, 'id' => 60576, 'name' => 'Bag of Stone nível 1', 'source' => 'Chance de dropar nas hunts <strong>Medium</strong> ou comprar no NPC <strong>Jorge Trambiqueiro</strong>, por RavynCore Token.'],
    ['level' => 2, 'id' => 60577, 'name' => 'Bag of Stone nível 2', 'source' => 'Chance de dropar nas hunts <strong>Hard</strong> ou comprar no NPC <strong>Jorge Trambiqueiro</strong>, por RavynCore Token.'],
    ['level' => 3, 'id' => 60578, 'name' => 'Bag of Stone nível 3', 'source' => 'Chance de dropar nas hunts <strong>Epic</strong> ou comprar no NPC <strong>Jorge Trambiqueiro</strong>, por RavynCore Token.'],
];

$fragmentRows = [
    ['id' => $lesserFragmentId, 'name' => 'Lesser Fragment', 'source' => 'Chance de dropar nas hunts <strong>Hard</strong> e <strong>Epic</strong> ou comprar no NPC <strong>Jorge Trambiqueiro</strong>, por RavynCore Token.'],
    ['id' => $greaterFragmentId, 'name' => 'Greater Fragment', 'source' => 'Chance de dropar nas hunts <strong>Hard</strong> e <strong>Epic</strong> ou comprar no NPC <strong>Jorge Trambiqueiro</strong>, por RavynCore Token.'],
];

if (!function_exists('rc_di_esc')) {
    function rc_di_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_di_img_src')) {
    function rc_di_img_src($relPath)
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

if (!function_exists('rc_di_item_html')) {
    function rc_di_item_html($itemId, $large = false, $label = '')
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }
        $class = $large ? 'rc-tier-item-img rc-tier-item-img-lg' : 'rc-tier-item-img';
        $candidates = [
            'imagens/creaturestibiawiki/' . $itemId . '.gif',
            'images/creaturetibiawiki/' . $itemId . '.gif',
            'images/items/' . $itemId . '.gif',
        ];
        foreach ($candidates as $path) {
            if (file_exists(BASE . $path)) {
                $alt = $label !== '' ? rc_di_esc($label) : '';
                return '<img class="' . $class . '" src="' . rc_di_esc(rc_di_img_src($path)) . '" width="32" height="32" alt="' . $alt . '" loading="lazy">';
            }
        }

        if (function_exists('getItemImage')) {
            $html = getItemImage($itemId);
            if ($html !== '') {
                if ($label !== '') {
                    $html = preg_replace('/<img\s+/', '<img class="' . $class . '" ', $html, 1);
                }
                return $html;
            }
        }

        return '';
    }
}

$tokenRewardTable = '';
foreach ($tokenRewardRows as $row) {
    $tokenRewardTable .= '<tr><td>' . rc_di_esc($row['target']) . '</td>'
        . '<td><strong>' . (int)$row['tokens'] . '</strong></td></tr>';
}

$bagRowsHtml = '';
foreach ($bagOfStoneRows as $row) {
    $bagRowsHtml .= '<tr><td class="rc-di-item-cell">' . rc_di_item_html($row['id'], false, $row['name']) . '</td>'
        . '<td><strong>' . rc_di_esc($row['name']) . '</strong></td>'
        . '<td class="rc-di-text-left">' . $row['source'] . '</td></tr>';
}

$fragmentRowsHtml = '';
foreach ($fragmentRows as $row) {
    $fragmentRowsHtml .= '<tr><td class="rc-di-item-cell">' . rc_di_item_html($row['id'], false, $row['name']) . '</td>'
        . '<td><strong>' . rc_di_esc($row['name']) . '</strong></td>'
        . '<td class="rc-di-text-left">' . $row['source'] . '</td></tr>';
}

$tokenImg = rc_di_item_html($ravynCoreTokenId, true, 'RavynCore Token');
$toolImg = rc_di_item_html($destructionRarityId, true, 'Destruction Rarity');

echo '<div class="rc-st-page rc-tier-page rc-di-page">'
    . '<header class="rc-st-page-title rc-tier-hero">'
    . '<h2>Drops Important</h2>'
    . '<p class="rc-tier-subtitle">RavynCore Token, destruction rarity, bags of stone e fragments — onde conseguir e como usar.</p>'
    . '<nav class="rc-tier-nav" aria-label="Seções do guia">'
    . '<a href="#rc-di-token">RavynCore Token</a>'
    . '<a href="#rc-di-obtain">Obtenção</a>'
    . '<a href="#rc-di-bags">Bag of Stone</a>'
    . '<a href="#rc-di-fragments">Fragments</a>'
    . '</nav></header>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-token">'
    . '<h3>RavynCore Token</h3>'
    . '<div class="rc-di-hero-row">'
    . '<div class="rc-tier-item-spot">' . $tokenImg . '</div>'
    . '<div class="rc-di-hero-text">'
    . '<p>O <strong>RavynCore Token</strong> é uma moeda utilizada para <strong>crafting</strong>, <strong>quests</strong> e compras com NPCs (como o <strong>Jorge Trambiqueiro</strong>).</p>'
    . '<p>Use tokens para adquirir bags of stone, fragments e outros itens importantes do servidor.</p>'
    . '</div></div></section>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-obtain">'
    . '<h3>Modo de obtenção — Destruction Rarity</h3>'
    . '<div class="rc-di-hero-row">'
    . '<div class="rc-tier-item-spot">' . $toolImg . '</div>'
    . '<div class="rc-di-hero-text">'
    . '<p><strong>Destruction Rarity</strong> possui <strong>50 cargas</strong>. A cada uso consome <strong>1 carga</strong>; quando acabam, o item desaparece.</p>'
    . '<p>Use em:</p>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Elemental stone</strong> nível <strong>0</strong> ou <strong>1</strong></li>'
    . '<li>Qualquer item com <strong>classification 3</strong> ou <strong>4</strong></li>'
    . '</ul>'
    . '<p>O alvo é consumido e você recebe RavynCore Tokens conforme a tabela abaixo.</p>'
    . '</div></div>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-di-table">'
    . '<thead><tr><th>Alvo</th><th>RavynCore Token</th></tr></thead>'
    . '<tbody>' . $tokenRewardTable . '</tbody></table></div>'
    . '<p class="rc-di-note">Prioridade: classification <strong>4</strong> → 5 tokens · classification <strong>3</strong> → 1 token · stone nível <strong>1</strong> → 3 · stone nível <strong>0</strong> → 1.</p>'
    . '</section>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-bags">'
    . '<h3>Bag of Stone</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-di-table">'
    . '<thead><tr><th>Item</th><th>Nível</th><th>Como obter</th></tr></thead>'
    . '<tbody>' . $bagRowsHtml . '</tbody></table></div></section>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-fragments">'
    . '<h3>Lesser &amp; Greater Fragments</h3>'
    . '<p class="rc-tier-spaced">Usados na <a href="' . rc_di_esc(BASE_URL . '?subtopic=elementalstonesbonuses') . '#rc-esb-conversion">conversão Stone Forge</a> (Elemental Stones) para gerar Stone Fusion Dust.</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-di-table">'
    . '<thead><tr><th>Item</th><th>Nome</th><th>Como obter</th></tr></thead>'
    . '<tbody>' . $fragmentRowsHtml . '</tbody></table></div></section>'

    . '<style>'
    . '.rc-di-page .rc-di-anchor{scroll-margin-top:140px}'
    . '.rc-di-page .rc-di-table td,.rc-di-page .rc-di-table th{text-align:center}'
    . '.rc-di-page .rc-di-text-left{text-align:left!important}'
    . '.rc-di-page .rc-di-item-cell{width:52px}'
    . '.rc-di-page .rc-di-hero-row{display:flex;flex-wrap:wrap;gap:16px;align-items:flex-start;margin-bottom:12px}'
    . '.rc-di-page .rc-di-hero-text{flex:1;min-width:240px;font-size:14px;line-height:1.55;color:#d6e4ff}'
    . '.rc-di-page .rc-di-hero-text p{margin:0 0 10px}'
    . '.rc-di-page .rc-di-note{margin-top:12px;font-size:13px;color:#9eb8e8;text-align:center}'
    . '</style>'

    . '<script>(function(){'
    . 'function diScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-di-page .rc-tier-nav a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();diScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){diScrollTo(t);},120);}}'
    . '})();</script></div>';
