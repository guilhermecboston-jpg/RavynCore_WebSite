<?php
defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('rc_t') && defined('SYSTEM') && file_exists(SYSTEM . 'libs/rc_i18n.php')) {
    require_once SYSTEM . 'libs/rc_i18n.php';
    rc_i18n_init();
}

$title = 'Drops Important';

$ravynCoreTokenId = 61869;
$destructionRarityId = 64082;
$lesserFragmentId = 46625;
$greaterFragmentId = 46626;
$rcDiLang = function_exists('rc_current_language') ? rc_current_language() : 'pt-br';

$rcDiText = [
    'pt-br' => [
        'title' => 'Drops Importantes',
        'nav_sections' => 'Seções do guia',
        'nav_obtain' => 'Obtenção',
        'token_p1' => 'O <strong>RavynCore Token</strong> é uma moeda utilizada para <strong>crafting</strong>, <strong>quests</strong> e compras com NPCs (como o <strong>Jorge Trambiqueiro</strong>).',
        'token_p2' => 'Use tokens para adquirir bags of stone, fragments e outros itens importantes do servidor.',
        'obtain_title' => 'Modo de obtenção — Destruction Rarity',
        'rarity_p1' => '<strong>Destruction Rarity</strong> possui <strong>50 cargas</strong>. A cada uso consome <strong>1 carga</strong>; quando acabam, o item desaparece.',
        'use_on' => 'Use em:',
        'use_stone' => '<strong>Elemental stone</strong> nível <strong>0</strong> ou <strong>1</strong>',
        'use_classification' => 'Qualquer item com <strong>classification 3</strong> ou <strong>4</strong>',
        'reward_p' => 'O alvo é consumido e você recebe RavynCore Tokens conforme a tabela abaixo.',
        'target' => 'Alvo',
        'bag_lead' => 'Cada <span class="rc-di-highlight">Bag of Stone</span> contém pedras elementais. O <span class="rc-di-highlight">nível da bag</span> define a dificuldade do drop ou o custo em <span class="rc-di-highlight">RavynCore Token</span> no <span class="rc-di-highlight">Jorge Trambiqueiro</span>.',
        'level' => 'Nível',
        'how_get' => 'Como obter',
        'fragment_lead' => 'Usados na <a href="%s#rc-esb-conversion">conversão Stone Forge</a> (Elemental Stones) para gerar <span class="rc-di-highlight">Stone Fusion Dust</span>. Dropam em hunts <span class="rc-di-highlight">Hard</span> e <span class="rc-di-highlight">Epic</span> ou podem ser comprados com <span class="rc-di-highlight">RavynCore Token</span>.',
        'name' => 'Nome',
        'stone0' => 'Elemental stone nível 0',
        'stone1' => 'Elemental stone nível 1',
        'classification3' => 'Item classification 3',
        'classification4' => 'Item classification 4',
        'bag_name' => 'Bag of Stone nível %d',
        'bag_boss_source' => 'Chance de dropar de todos os <span class="rc-di-highlight">Bosses</span> ou comprar no NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span>, por <span class="rc-di-highlight">RavynCore Token</span>.',
        'bag_hunt_source' => 'Chance de dropar nas hunts <span class="rc-di-highlight">%s</span> ou comprar no NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span>, por <span class="rc-di-highlight">RavynCore Token</span>.',
        'fragment_source' => 'Chance de dropar nas hunts <span class="rc-di-highlight">Hard</span> e <span class="rc-di-highlight">Epic</span> ou comprar no NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span>, por <span class="rc-di-highlight">RavynCore Token</span>.',
    ],
    'en' => [
        'title' => 'Important Drops',
        'nav_sections' => 'Guide sections',
        'nav_obtain' => 'Obtaining',
        'token_p1' => '<strong>RavynCore Token</strong> is a currency used for <strong>crafting</strong>, <strong>quests</strong>, and purchases with NPCs (such as <strong>Jorge Trambiqueiro</strong>).',
        'token_p2' => 'Use tokens to buy bags of stone, fragments, and other important server items.',
        'obtain_title' => 'How to obtain — Destruction Rarity',
        'rarity_p1' => '<strong>Destruction Rarity</strong> has <strong>50 charges</strong>. Each use consumes <strong>1 charge</strong>; when the charges run out, the item disappears.',
        'use_on' => 'Use on:',
        'use_stone' => '<strong>Elemental stone</strong> level <strong>0</strong> or <strong>1</strong>',
        'use_classification' => 'Any item with <strong>classification 3</strong> or <strong>4</strong>',
        'reward_p' => 'The target is consumed and you receive RavynCore Tokens according to the table below.',
        'target' => 'Target',
        'bag_lead' => 'Each <span class="rc-di-highlight">Bag of Stone</span> contains elemental stones. The <span class="rc-di-highlight">bag level</span> defines the drop difficulty or the <span class="rc-di-highlight">RavynCore Token</span> cost at <span class="rc-di-highlight">Jorge Trambiqueiro</span>.',
        'level' => 'Level',
        'how_get' => 'How to obtain',
        'fragment_lead' => 'Used in <a href="%s#rc-esb-conversion">Stone Forge conversion</a> (Elemental Stones) to generate <span class="rc-di-highlight">Stone Fusion Dust</span>. They drop in <span class="rc-di-highlight">Hard</span> and <span class="rc-di-highlight">Epic</span> hunts or can be bought with <span class="rc-di-highlight">RavynCore Token</span>.',
        'name' => 'Name',
        'stone0' => 'Elemental stone level 0',
        'stone1' => 'Elemental stone level 1',
        'classification3' => 'Item classification 3',
        'classification4' => 'Item classification 4',
        'bag_name' => 'Bag of Stone level %d',
        'bag_boss_source' => 'Chance to drop from all <span class="rc-di-highlight">Bosses</span> or buy from NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span> for <span class="rc-di-highlight">RavynCore Token</span>.',
        'bag_hunt_source' => 'Chance to drop in <span class="rc-di-highlight">%s</span> hunts or buy from NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span> for <span class="rc-di-highlight">RavynCore Token</span>.',
        'fragment_source' => 'Chance to drop in <span class="rc-di-highlight">Hard</span> and <span class="rc-di-highlight">Epic</span> hunts or buy from NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span> for <span class="rc-di-highlight">RavynCore Token</span>.',
    ],
    'es' => [
        'title' => 'Drops importantes',
        'nav_sections' => 'Secciones de la guía',
        'nav_obtain' => 'Obtención',
        'token_p1' => '<strong>RavynCore Token</strong> es una moneda utilizada para <strong>crafting</strong>, <strong>quests</strong> y compras con NPCs (como <strong>Jorge Trambiqueiro</strong>).',
        'token_p2' => 'Usa tokens para comprar bags of stone, fragments y otros items importantes del servidor.',
        'obtain_title' => 'Modo de obtención — Destruction Rarity',
        'rarity_p1' => '<strong>Destruction Rarity</strong> tiene <strong>50 cargas</strong>. Cada uso consume <strong>1 carga</strong>; cuando se agotan, el item desaparece.',
        'use_on' => 'Usa en:',
        'use_stone' => '<strong>Elemental stone</strong> nivel <strong>0</strong> o <strong>1</strong>',
        'use_classification' => 'Cualquier item con <strong>classification 3</strong> o <strong>4</strong>',
        'reward_p' => 'El objetivo se consume y recibes RavynCore Tokens según la tabla de abajo.',
        'target' => 'Objetivo',
        'bag_lead' => 'Cada <span class="rc-di-highlight">Bag of Stone</span> contiene piedras elementales. El <span class="rc-di-highlight">nivel de la bag</span> define la dificultad del drop o el costo en <span class="rc-di-highlight">RavynCore Token</span> con <span class="rc-di-highlight">Jorge Trambiqueiro</span>.',
        'level' => 'Nivel',
        'how_get' => 'Cómo obtener',
        'fragment_lead' => 'Usados en la <a href="%s#rc-esb-conversion">conversión Stone Forge</a> (Elemental Stones) para generar <span class="rc-di-highlight">Stone Fusion Dust</span>. Dropean en hunts <span class="rc-di-highlight">Hard</span> y <span class="rc-di-highlight">Epic</span> o pueden comprarse con <span class="rc-di-highlight">RavynCore Token</span>.',
        'name' => 'Nombre',
        'stone0' => 'Elemental stone nivel 0',
        'stone1' => 'Elemental stone nivel 1',
        'classification3' => 'Item classification 3',
        'classification4' => 'Item classification 4',
        'bag_name' => 'Bag of Stone nivel %d',
        'bag_boss_source' => 'Probabilidad de dropear de todos los <span class="rc-di-highlight">Bosses</span> o comprar al NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span> por <span class="rc-di-highlight">RavynCore Token</span>.',
        'bag_hunt_source' => 'Probabilidad de dropear en hunts <span class="rc-di-highlight">%s</span> o comprar al NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span> por <span class="rc-di-highlight">RavynCore Token</span>.',
        'fragment_source' => 'Probabilidad de dropear en hunts <span class="rc-di-highlight">Hard</span> y <span class="rc-di-highlight">Epic</span> o comprar al NPC <span class="rc-di-highlight">Jorge Trambiqueiro</span> por <span class="rc-di-highlight">RavynCore Token</span>.',
    ],
];
$rcDi = $rcDiText[$rcDiLang] ?? $rcDiText['pt-br'];

$tokenRewardRows = [
    ['target' => $rcDi['stone0'], 'tokens' => 1],
    ['target' => $rcDi['stone1'], 'tokens' => 3],
    ['target' => $rcDi['classification3'], 'tokens' => 1],
    ['target' => $rcDi['classification4'], 'tokens' => 5],
];

$bagOfStoneRows = [
    ['level' => 0, 'id' => 63980, 'name' => sprintf($rcDi['bag_name'], 0), 'source' => $rcDi['bag_boss_source']],
    ['level' => 1, 'id' => 60576, 'name' => sprintf($rcDi['bag_name'], 1), 'source' => sprintf($rcDi['bag_hunt_source'], 'Medium')],
    ['level' => 2, 'id' => 60577, 'name' => sprintf($rcDi['bag_name'], 2), 'source' => sprintf($rcDi['bag_hunt_source'], 'Hard')],
    ['level' => 3, 'id' => 60578, 'name' => sprintf($rcDi['bag_name'], 3), 'source' => sprintf($rcDi['bag_hunt_source'], 'Epic')],
];

$fragmentRows = [
    ['id' => $lesserFragmentId, 'name' => 'Lesser Fragment', 'source' => $rcDi['fragment_source']],
    ['id' => $greaterFragmentId, 'name' => 'Greater Fragment', 'source' => $rcDi['fragment_source']],
];

if (!function_exists('rc_di_esc')) {
    function rc_di_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_di_item_html')) {
    function rc_di_item_html($itemId, $large = false, $label = '')
    {
        return rc_wiki_item_image((int)$itemId, [
            'class' => 'rc-tier-item-img',
            'large' => $large,
            'label' => (string)$label,
        ]);
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
$fragmentLink = rc_di_esc(BASE_URL . '?subtopic=elementalstonesbonuses');
$fragmentLead = sprintf($rcDi['fragment_lead'], $fragmentLink);

echo '<div class="rc-st-page rc-tier-page rc-di-page">'
    . '<header class="rc-st-page-title"><h2>' . rc_di_esc($rcDi['title']) . '</h2></header>'
    . '<nav class="rc-tier-nav rc-tier-nav-below" aria-label="' . rc_di_esc($rcDi['nav_sections']) . '">'
    . '<a href="#rc-di-token">RavynCore Token</a>'
    . '<a href="#rc-di-obtain">' . rc_di_esc($rcDi['nav_obtain']) . '</a>'
    . '<a href="#rc-di-bags">Bag of Stone</a>'
    . '<a href="#rc-di-fragments">Fragments</a>'
    . '</nav>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-token">'
    . '<h3>RavynCore Token</h3>'
    . '<div class="rc-di-hero-row">'
    . '<div class="rc-tier-item-spot">' . $tokenImg . '</div>'
    . '<div class="rc-di-hero-text">'
    . '<p>' . $rcDi['token_p1'] . '</p>'
    . '<p>' . rc_di_esc($rcDi['token_p2']) . '</p>'
    . '</div></div></section>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-obtain">'
    . '<h3>' . rc_di_esc($rcDi['obtain_title']) . '</h3>'
    . '<div class="rc-di-hero-row">'
    . '<div class="rc-tier-item-spot">' . $toolImg . '</div>'
    . '<div class="rc-di-hero-text">'
    . '<p>' . $rcDi['rarity_p1'] . '</p>'
    . '<p>' . rc_di_esc($rcDi['use_on']) . '</p>'
    . '<ul class="rc-st-notes">'
    . '<li>' . $rcDi['use_stone'] . '</li>'
    . '<li>' . $rcDi['use_classification'] . '</li>'
    . '</ul>'
    . '<p>' . rc_di_esc($rcDi['reward_p']) . '</p>'
    . '</div></div>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-di-table">'
    . '<thead><tr><th>' . rc_di_esc($rcDi['target']) . '</th><th>RavynCore Token</th></tr></thead>'
    . '<tbody>' . $tokenRewardTable . '</tbody></table></div>'
    . '</section>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-bags">'
    . '<h3>Bag of Stone</h3>'
    . '<p class="rc-di-lead">' . $rcDi['bag_lead'] . '</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-di-table">'
    . '<thead><tr><th>Item</th><th>' . rc_di_esc($rcDi['level']) . '</th><th>' . rc_di_esc($rcDi['how_get']) . '</th></tr></thead>'
    . '<tbody>' . $bagRowsHtml . '</tbody></table></div></section>'

    . '<section class="rc-st-card rc-di-anchor" id="rc-di-fragments">'
    . '<h3>Lesser &amp; Greater Fragments</h3>'
    . '<p class="rc-di-lead">' . $fragmentLead . '</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-di-table">'
    . '<thead><tr><th>Item</th><th>' . rc_di_esc($rcDi['name']) . '</th><th>' . rc_di_esc($rcDi['how_get']) . '</th></tr></thead>'
    . '<tbody>' . $fragmentRowsHtml . '</tbody></table></div></section>'

    . '<style>'
    . '.rc-di-page .rc-di-anchor{scroll-margin-top:140px}'
    . '.rc-di-page .rc-di-table td,.rc-di-page .rc-di-table th{text-align:center}'
    . '.rc-di-page .rc-di-text-left{text-align:left!important}'
    . '.rc-di-page .rc-di-item-cell{width:52px}'
    . '.rc-di-page .rc-di-hero-row{display:flex;flex-wrap:wrap;gap:16px;align-items:flex-start;margin-bottom:12px}'
    . '.rc-di-page .rc-di-hero-text{flex:1;min-width:240px;font-size:14px;line-height:1.55;color:#d6e4ff}'
    . '.rc-di-page .rc-di-hero-text p{margin:0 0 10px}'
    . '.rc-di-page .rc-di-lead{margin:0 0 14px;font-size:14px;line-height:1.6;color:#d6e4ff}'
    . '.rc-di-page .rc-di-highlight{color:#f2c16b;font-weight:700}'
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