<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Exercise Weapons';

$tierCompare = [
    [
        'key' => 'durable',
        'name' => 'Durable',
        'charges' => '1.800',
        'interval' => '2.000 ms',
        'mode' => 'Treino contínuo no dummy',
    ],
    [
        'key' => 'lasting',
        'name' => 'Lasting',
        'charges' => '14.400',
        'interval' => '1.500 ms',
        'mode' => 'Treino contínuo no dummy',
    ],
    [
        'key' => 'mystic',
        'name' => 'Mystic',
        'charges' => '14.400',
        'interval' => '375 ms',
        'mode' => '4× mais rápido que Lasting',
    ],
    [
        'key' => 'legendary',
        'name' => 'Legendary',
        'charges' => '14.400',
        'interval' => 'Uso instantâneo',
        'mode' => 'Máx. 3× por server save',
    ],
];

$weaponTiers = [
    'durable' => [
        'title' => 'Durable Exercise Weapons',
        'desc' => '1.800 cargas · 2.000 ms por hit · treino contínuo',
        'items' => [
            ['slug' => 'sword', 'name' => 'durable exercise sword', 'id' => 35279],
            ['slug' => 'axe', 'name' => 'durable exercise axe', 'id' => 35280],
            ['slug' => 'club', 'name' => 'durable exercise club', 'id' => 35281],
            ['slug' => 'bow', 'name' => 'durable exercise bow', 'id' => 35282],
            ['slug' => 'rod', 'name' => 'durable exercise rod', 'id' => 35283],
            ['slug' => 'wand', 'name' => 'durable exercise wand', 'id' => 35284],
            ['slug' => 'shield', 'name' => 'durable exercise shield', 'id' => 44066],
            ['slug' => 'wraps', 'name' => 'durable exercise wraps', 'id' => 50294],
        ],
    ],
    'lasting' => [
        'title' => 'Lasting Exercise Weapons',
        'desc' => '14.400 cargas · 1.500 ms por hit · treino contínuo',
        'items' => [
            ['slug' => 'sword', 'name' => 'lasting exercise sword', 'id' => 35285],
            ['slug' => 'axe', 'name' => 'lasting exercise axe', 'id' => 35286],
            ['slug' => 'club', 'name' => 'lasting exercise club', 'id' => 35287],
            ['slug' => 'bow', 'name' => 'lasting exercise bow', 'id' => 35288],
            ['slug' => 'rod', 'name' => 'lasting exercise rod', 'id' => 35289],
            ['slug' => 'wand', 'name' => 'lasting exercise wand', 'id' => 35290],
            ['slug' => 'shield', 'name' => 'lasting exercise shield', 'id' => 44067],
            ['slug' => 'wraps', 'name' => 'lasting exercise wraps', 'id' => 50295],
        ],
    ],
    'mystic' => [
        'title' => 'Mystic Exercise Weapons',
        'desc' => '14.400 cargas · 375 ms por hit · 4× mais rápido que Lasting',
        'items' => [
            ['slug' => 'club', 'name' => 'mystic exercise club', 'id' => 63277],
            ['slug' => 'rod', 'name' => 'mystic exercise rod', 'id' => 63278],
            ['slug' => 'shield', 'name' => 'mystic exercise shield', 'id' => 63279],
            ['slug' => 'sword', 'name' => 'mystic exercise sword', 'id' => 63280],
            ['slug' => 'wand', 'name' => 'mystic exercise wand', 'id' => 63281],
            ['slug' => 'axe', 'name' => 'mystic exercise axe', 'id' => 63282],
            ['slug' => 'bow', 'name' => 'mystic exercise bow', 'id' => 63283],
            ['slug' => 'wraps', 'name' => 'mystic exercise wraps', 'id' => 63285],
        ],
    ],
    'legendary' => [
        'title' => 'Legendary Exercise Weapons',
        'desc' => '14.400 cargas · uso único instantâneo · máx. 3× por server save',
        'items' => [
            ['slug' => 'club', 'name' => 'legendary exercise club', 'id' => 63286],
            ['slug' => 'rod', 'name' => 'legendary exercise rod', 'id' => 63287],
            ['slug' => 'shield', 'name' => 'legendary exercise shield', 'id' => 63288],
            ['slug' => 'sword', 'name' => 'legendary exercise sword', 'id' => 63289],
            ['slug' => 'wand', 'name' => 'legendary exercise wand', 'id' => 63290],
            ['slug' => 'axe', 'name' => 'legendary exercise axe', 'id' => 63291],
            ['slug' => 'bow', 'name' => 'legendary exercise bow', 'id' => 63292],
            ['slug' => 'wraps', 'name' => 'legendary exercise wraps', 'id' => 63294],
        ],
    ],
    'boxes' => [
        'title' => 'Exercise Boxes',
        'desc' => 'Abra para receber 1 arma aleatória da categoria, sempre com 14.400 cargas.',
        'items' => [
            ['slug' => 'mystic-box', 'name' => 'mystic exercise box', 'id' => 63284, 'folder' => 'boxes'],
            ['slug' => 'legendary-box', 'name' => 'legendary exercise box', 'id' => 63293, 'folder' => 'boxes'],
        ],
    ],
];

if (!function_exists('rc_exercise_esc')) {
    function rc_exercise_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_exercise_pretty_name')) {
    function rc_exercise_pretty_name($name)
    {
        $name = trim((string)$name);
        if ($name === '') {
            return $name;
        }
        return ucwords($name);
    }
}

if (!function_exists('rc_exercise_item_html')) {
    function rc_exercise_item_html($tier, array $weapon)
    {
        $slug = (string)($weapon['slug'] ?? 'item');
        $folder = (string)($weapon['folder'] ?? $tier);
        $label = rc_exercise_pretty_name($weapon['name'] ?? $slug);
        $itemId = (int)($weapon['id'] ?? 0);

        $customPath = 'imagens/exercise-weapons/' . $folder . '/' . $slug . '.png';
        if (file_exists(BASE . $customPath)) {
            return '<div class="rc-exercise-img-wrap has-custom">'
                . '<img class="rc-exercise-item-img" src="' . rc_exercise_esc($customPath) . '" alt="' . rc_exercise_esc($label) . '" loading="lazy">'
                . '</div>';
        }

        if ($itemId > 0 && function_exists('rc_wiki_item_image')) {
            return '<div class="rc-exercise-img-wrap has-wiki">'
                . rc_wiki_item_image($itemId, ['class' => 'rc-exercise-item-img', 'label' => $label])
                . '</div>';
        }

        return '<div class="rc-exercise-img-wrap is-placeholder" title="Adicione imagens/exercise-weapons/' . rc_exercise_esc($folder . '/' . $slug) . '.png">'
            . '<span>' . rc_exercise_esc($slug) . '.png</span>'
            . '</div>';
    }
}

if (!function_exists('rc_exercise_render_cards')) {
    function rc_exercise_render_cards($tier, array $items)
    {
        $html = '';
        foreach ($items as $weapon) {
            $name = rc_exercise_pretty_name($weapon['name'] ?? '');
            $itemId = (int)($weapon['id'] ?? 0);
            $html .= '<article class="rc-exercise-card">'
                . rc_exercise_item_html($tier, $weapon)
                . '<h4>' . rc_exercise_esc($name) . '</h4>'
                . '<p class="rc-exercise-meta">' . ($itemId > 0 ? 'ID ' . $itemId : '—') . '</p>'
                . '</article>';
        }
        return $html;
    }
}

$compareHtml = '';
foreach ($tierCompare as $tier) {
    $compareHtml .= '<article class="rc-exercise-compare rc-exercise-compare-' . rc_exercise_esc($tier['key']) . '">'
        . '<h4>' . rc_exercise_esc($tier['name']) . '</h4>'
        . '<ul>'
        . '<li><strong>' . rc_exercise_esc($tier['charges']) . '</strong> cargas</li>'
        . '<li><strong>' . rc_exercise_esc($tier['interval']) . '</strong> por hit</li>'
        . '<li>' . rc_exercise_esc($tier['mode']) . '</li>'
        . '</ul>'
        . '</article>';
}

$tierSections = '';
foreach ($weaponTiers as $tierKey => $tierData) {
    $tierSections .= '<section class="rc-st-card rc-exercise-tier" id="rc-exercise-' . rc_exercise_esc($tierKey) . '">'
        . '<div class="rc-exercise-tier-head">'
        . '<span class="rc-exercise-pill rc-exercise-pill-' . rc_exercise_esc($tierKey) . '">' . rc_exercise_esc(ucfirst($tierKey)) . '</span>'
        . '<div><h3>' . rc_exercise_esc($tierData['title']) . '</h3>'
        . '<p>' . rc_exercise_esc($tierData['desc']) . '</p></div>'
        . '</div>'
        . '<div class="rc-exercise-grid">' . rc_exercise_render_cards($tierKey, $tierData['items']) . '</div>'
        . '</section>';
}

echo '<div class="rc-st-page rc-exercise-page">'
    . '<header class="rc-st-page-title"><h2>Exercise Weapons</h2></header>'
    . '<nav class="rc-tier-nav rc-tier-nav-below" aria-label="Seções do guia">'
    . '<a href="#rc-exercise-about">Como funciona</a>'
    . '<a href="#rc-exercise-compare">Tiers</a>'
    . '<a href="#rc-exercise-rules">Regras</a>'
    . '<a href="#rc-exercise-durable">Durable</a>'
    . '<a href="#rc-exercise-lasting">Lasting</a>'
    . '<a href="#rc-exercise-mystic">Mystic</a>'
    . '<a href="#rc-exercise-legendary">Legendary</a>'
    . '<a href="#rc-exercise-boxes">Boxes</a>'
    . '<a href="#rc-exercise-faq">FAQ</a>'
    . '</nav>'

    . '<section class="rc-st-card rc-exercise-anchor" id="rc-exercise-about">'
    . '<h3>Como funciona</h3>'
    . '<p>No <strong>RavynCore</strong>, use uma <strong>Exercise Weapon</strong> em um <strong>Exercise Dummy</strong> dentro de <strong>Protection Zone</strong> para treinar skills sem caçar monstros.</p>'
    . '<ol class="rc-st-notes rc-exercise-steps">'
    . '<li>Tenha a exercise weapon na backpack.</li>'
    . '<li>Clique na arma e use no Exercise Dummy.</li>'
    . '<li>O treino consome <strong>1 carga por hit</strong> e concede progresso de skill ou mana spent.</li>'
    . '<li>Cooldown de <strong>10 segundos</strong> entre inícios de treino no mesmo dummy.</li>'
    . '</ol>'
    . '<p class="rc-exercise-note">Tiers de <strong>50</strong> e <strong>500 cargas</strong> estão <strong>desativados</strong>. Ativos: Durable (1800), Lasting (14400), Mystic e Legendary.</p>'
    . '</section>'

    . '<section class="rc-st-card rc-exercise-anchor" id="rc-exercise-compare">'
    . '<h3>Comparativo dos tiers</h3>'
    . '<div class="rc-exercise-compare-grid">' . $compareHtml . '</div>'
    . '</section>'

    . '<section class="rc-st-card rc-exercise-anchor" id="rc-exercise-rules">'
    . '<h3>Regras gerais</h3>'
    . '<ul class="rc-st-notes">'
    . '<li><strong>Protection Zone</strong> obrigatória para iniciar e manter o treino.</li>'
    . '<li><strong>Melee, shield e fist:</strong> 1 sqm do dummy. <strong>Bow, rod e wand:</strong> uso à distância.</li>'
    . '<li><strong>Dummy em house:</strong> só quem está na mesma house pode treinar.</li>'
    . '<li><strong>Limite:</strong> até 10 jogadores no mesmo dummy (em house).</li>'
    . '<li><strong>Ganho por hit:</strong> skills físicas <code>7 × rate</code> · rod/wand <code>500 × rate</code> mana spent.</li>'
    . '<li><strong>VIP:</strong> +10% ganho de skill e +10% velocidade de treino.</li>'
    . '</ul>'
    . '</section>'

    . $tierSections

    . '<section class="rc-st-card rc-exercise-anchor" id="rc-exercise-faq">'
    . '<h3>FAQ</h3>'
    . '<div class="rc-exercise-faq">'
    . '<details><summary>Como funciona a Legendary?</summary><p>Um clique no dummy consome todas as 14.400 cargas de uma vez, aplica o ganho completo e remove a arma. Limite de 3 usos por personagem a cada server save.</p></details>'
    . '<details><summary>Qual a diferença entre Mystic e Lasting?</summary><p>Ambas têm 14.400 cargas e treino contínuo. A Mystic bate a cada 375 ms (4× mais rápido que a Lasting, que usa 1.500 ms).</p></details>'
    . '<details><summary>Como adiciono as imagens no site?</summary><p>Envie PNGs para <code>imagens/exercise-weapons/{tier}/{arma}.png</code> (ex.: <code>mystic/sword.png</code>). Enquanto não houver imagem custom, o site tenta o sprite do TibiaWiki pelo ID do item.</p></details>'
    . '</div>'
    . '</section>'

    . '<style>'
    . '.rc-exercise-page .rc-exercise-anchor{scroll-margin-top:140px}'
    . '.rc-exercise-page .rc-exercise-steps{margin:12px 0 0;padding-left:20px}'
    . '.rc-exercise-page .rc-exercise-note{margin:14px 0 0;padding:12px 14px;border:1px solid rgba(255,212,105,.35);border-radius:10px;background:rgba(255,190,70,.08);color:#d6e4ff;font-size:14px}'
    . '.rc-exercise-page .rc-exercise-compare-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px}'
    . '.rc-exercise-page .rc-exercise-compare{border:1px solid rgba(77,152,236,.35);border-radius:12px;padding:14px;background:linear-gradient(145deg,rgba(9,22,42,.92),rgba(14,35,63,.72))}'
    . '.rc-exercise-page .rc-exercise-compare h4{margin:0 0 10px;color:#ffd469;font-size:18px}'
    . '.rc-exercise-page .rc-exercise-compare ul{margin:0;padding-left:18px;color:#d6e4ff;font-size:14px;line-height:1.55}'
    . '.rc-exercise-page .rc-exercise-compare-durable{border-top:3px solid #5dade2}'
    . '.rc-exercise-page .rc-exercise-compare-lasting{border-top:3px solid #58d68d}'
    . '.rc-exercise-page .rc-exercise-compare-mystic{border-top:3px solid #7b5cff}'
    . '.rc-exercise-page .rc-exercise-compare-legendary{border-top:3px solid #ff9f43}'
    . '.rc-exercise-page .rc-exercise-tier{margin-top:18px}'
    . '.rc-exercise-page .rc-exercise-tier-head{display:flex;flex-wrap:wrap;gap:12px;align-items:flex-start;margin-bottom:14px}'
    . '.rc-exercise-page .rc-exercise-tier-head h3{margin:0 0 4px}'
    . '.rc-exercise-page .rc-exercise-tier-head p{margin:0;color:#aebdde;font-size:14px}'
    . '.rc-exercise-page .rc-exercise-pill{font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:5px 10px;border-radius:999px;border:1px solid transparent}'
    . '.rc-exercise-page .rc-exercise-pill-durable{color:#5dade2;border-color:rgba(93,173,226,.35);background:rgba(93,173,226,.1)}'
    . '.rc-exercise-page .rc-exercise-pill-lasting{color:#58d68d;border-color:rgba(88,214,141,.35);background:rgba(88,214,141,.1)}'
    . '.rc-exercise-page .rc-exercise-pill-mystic{color:#9f86ff;border-color:rgba(123,92,255,.35);background:rgba(123,92,255,.1)}'
    . '.rc-exercise-page .rc-exercise-pill-legendary{color:#ff9f43;border-color:rgba(255,159,67,.35);background:rgba(255,159,67,.1)}'
    . '.rc-exercise-page .rc-exercise-pill-boxes{color:#ffd469;border-color:rgba(255,212,105,.35);background:rgba(255,212,105,.08)}'
    . '.rc-exercise-page .rc-exercise-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:12px}'
    . '.rc-exercise-page .rc-exercise-card{border:1px solid rgba(77,152,236,.28);border-radius:12px;padding:12px;background:rgba(7,18,36,.65)}'
    . '.rc-exercise-page .rc-exercise-card h4{margin:10px 0 4px;font-size:14px;line-height:1.35;color:#e8f0ff}'
    . '.rc-exercise-page .rc-exercise-meta{margin:0;font-size:12px;color:#9eb4d8}'
    . '.rc-exercise-page .rc-exercise-img-wrap{width:100%;aspect-ratio:1;border-radius:10px;border:1px dashed rgba(120,150,190,.35);background:#0a1220;display:flex;align-items:center;justify-content:center;overflow:hidden}'
    . '.rc-exercise-page .rc-exercise-img-wrap.has-custom,.rc-exercise-page .rc-exercise-img-wrap.has-wiki{border-style:solid}'
    . '.rc-exercise-page .rc-exercise-item-img{width:72%;height:72%;object-fit:contain;image-rendering:pixelated}'
    . '.rc-exercise-page .rc-exercise-img-wrap.is-placeholder span{font-size:11px;color:#6d7688;text-align:center;padding:8px;line-height:1.3}'
    . '.rc-exercise-page .rc-exercise-faq details{border:1px solid rgba(77,152,236,.28);border-radius:10px;padding:10px 12px;margin-bottom:8px;background:rgba(7,18,36,.5)}'
    . '.rc-exercise-page .rc-exercise-faq summary{cursor:pointer;font-weight:700;color:#dce8ff}'
    . '.rc-exercise-page .rc-exercise-faq p{margin:10px 0 0;color:#aebdde;font-size:14px;line-height:1.55}'
    . '@media (max-width:640px){.rc-exercise-page .rc-exercise-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}'
    . '</style>'

    . '<script>(function(){'
    . 'function exScroll(el){if(!el)return;var h=document.querySelector(".rc-header");var o=(h?h.offsetHeight:0)+16;'
    . 'var t=el.getBoundingClientRect().top+window.pageYOffset-o;window.scrollTo({top:Math.max(0,t),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-exercise-page .rc-tier-nav a[href^=\'#\']").forEach(function(a){'
    . 'a.addEventListener("click",function(e){var id=a.getAttribute("href");if(!id||id.charAt(0)!=="#")return;'
    . 'var el=document.querySelector(id);if(!el)return;e.preventDefault();exScroll(el);});});'
    . 'var hash=window.location.hash;if(hash){var target=document.querySelector(hash);if(target)setTimeout(function(){exScroll(target);},120);}'
    . '})();</script></div>';
