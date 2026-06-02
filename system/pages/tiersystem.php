<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Tier System';

$tierToItem = [
    1 => 61607,
    2 => 61608,
    3 => 61609,
    4 => 61610,
    5 => 61611,
    6 => 61612,
    7 => 61613,
    8 => 61614,
    9 => 61615,
    10 => 61616,
];

$extractorItemId = 61606;

if (!function_exists('rc_tier_esc')) {
    function rc_tier_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_tier_item_html')) {
    function rc_tier_item_html($itemId, $large = false, $label = '')
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }

        $alt = $label !== '' ? $label : 'Item';
        $class = $large ? 'rc-tier-item-img rc-tier-item-img-lg' : 'rc-tier-item-img';
        $img = function_exists('getItemImage') ? getItemImage($itemId) : '';
        if ($img !== '') {
            $img = preg_replace('/<img\s+/', '<img class="' . $class . '" ', $img, 1);
            if (strpos($img, 'class="') === false) {
                $img = str_replace('<img ', '<img class="' . $class . '" ', $img);
            }
            $img = preg_replace('/alt="[^"]*"/', 'alt="' . rc_tier_esc($alt) . '"', $img, 1);
            $img = preg_replace('/title="[^"]*"/', '', $img);
            return $img;
        }

        $path = 'images/items/' . $itemId . '.gif';
        if (file_exists(BASE . $path)) {
            return '<img class="' . $class . '" src="' . rc_tier_esc($path) . '" width="32" height="32" alt="' . rc_tier_esc($alt) . '" loading="lazy">';
        }

        return '<span class="rc-tier-item-fallback">' . rc_tier_esc($alt) . '</span>';
    }
}

$tierRows = '';
foreach ($tierToItem as $tier => $itemId) {
    $tierRows .= '<tr>'
        . '<td><strong>Tier ' . (int)$tier . '</strong></td>'
        . '<td class="rc-tier-table-item">' . rc_tier_item_html($itemId, false, 'Tier ' . (int)$tier) . '</td>'
        . '</tr>';
}

echo '<div class="rc-st-page rc-tier-page">'
    . '<header class="rc-st-page-title"><h2>Tier System</h2></header>'
    . '<nav class="rc-tier-nav rc-tier-nav-below" aria-label="Seções do guia">'
    . '<a href="#rc-tier-sobre">Sobre</a>'
    . '<a href="#rc-tier-extracao">Extração</a>'
    . '<a href="#rc-tier-aplicacao">Aplicação</a>'
    . '<a href="#rc-tier-info">Informações</a>'
    . '<a href="#rc-tier-itens">Itens</a>'
    . '</nav>'

    . '<div class="rc-tier-grid">'

    . '<section class="rc-st-card rc-tier-anchor" id="rc-tier-sobre">'
    . '<h3>Sobre o Sistema de Tier</h3>'
    . '<p>No <strong>RavynCore</strong>, você pode remover e reaplicar o <em>Tier</em> dos seus equipamentos sempre que desejar.</p>'
    . '<p class="rc-tier-spaced">Isso permite:</p>'
    . '<ul class="rc-st-notes">'
    . '<li>Remover o Tier antes de uma nova tentativa de upgrade;</li>'
    . '<li>Vender o item sem o Tier aplicado;</li>'
    . '<li>Alterar sua build ou estilo de jogo;</li>'
    . '<li>Reaproveitar seus Tiers em outros equipamentos.</li>'
    . '</ul>'
    . '<p class="rc-tier-lead">O sistema foi desenvolvido para oferecer mais flexibilidade e liberdade na evolução dos seus itens.</p>'
    . '</section>'

    . '<section class="rc-st-card rc-tier-anchor" id="rc-tier-extracao">'
    . '<h3>Como Funciona a Extração?</h3>'
    . '<p>Ao utilizar um <strong>Extractor Tier</strong>:</p>'
    . '<ul class="rc-st-notes">'
    . '<li>O Tier é removido do equipamento;</li>'
    . '<li>O item original é enviado para a <strong>Store Inbox</strong> sem Tier;</li>'
    . '<li>O Tier removido é entregue na sua <strong>Store Inbox</strong> como um item.</li>'
    . '</ul>'
    . '</section>'

    . '<section class="rc-st-card rc-tier-anchor" id="rc-tier-aplicacao">'
    . '<h3>Como Funciona a Aplicação?</h3>'
    . '<p>Ao utilizar um Tier em um equipamento:</p>'
    . '<ul class="rc-st-notes">'
    . '<li>O Tier é aplicado normalmente;</li>'
    . '<li>O equipamento é enviado diretamente para a <strong>Store Inbox</strong> já com o Tier aplicado.</li>'
    . '</ul>'
    . '</section>'

    . '<section class="rc-st-card rc-tier-anchor" id="rc-tier-info">'
    . '<h3>Informações Importantes</h3>'
    . '<ul class="rc-st-notes">'
    . '<li>O Tier nunca é perdido durante a extração;</li>'
    . '<li>É possível extrair e reaplicar Tiers quantas vezes desejar;</li>'
    . '<li>Cada extração consome <strong>1 Extractor Tier</strong>;</li>'
    . '<li>O <strong>Extractor Tier</strong> está disponível na <strong>Game Store</strong> por <strong>2.000 Tibia Coins</strong>.</li>'
    . '</ul>'
    . '</section>'

    . '</div>'

    . '<section class="rc-st-card rc-tier-anchor" id="rc-tier-itens">'
    . '<h3>Itens do Sistema</h3>'
    . '<div class="rc-tier-items-center">'
    . '<div class="rc-tier-extractor">'
    . '<h4>Extractor Tier</h4>'
    . '<div class="rc-tier-item-spot">' . rc_tier_item_html($extractorItemId, true, 'Extractor Tier') . '</div>'
    . '</div>'
    . '<h4 class="rc-tier-h4">Tiers Disponíveis</h4>'
    . '<div class="rc-bf-table-wrap rc-tier-table-wrap">'
    . '<table class="rc-bf-table rc-tier-table">'
    . '<thead><tr><th>Tier</th><th>Item</th></tr></thead>'
    . '<tbody>' . $tierRows . '</tbody>'
    . '</table></div>'
    . '</div>'
    . '</section>'

    . '<script>(function(){'
    . 'function tierScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-tier-page a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");'
    . 'if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);'
    . 'if(!el){return;}'
    . 'ev.preventDefault();'
    . 'tierScrollTo(el);'
    . '});'
    . '});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var target=document.querySelector(hash);'
    . 'if(target){setTimeout(function(){tierScrollTo(target);},120);}}'
    . '})();</script>'

    . '</div>';
