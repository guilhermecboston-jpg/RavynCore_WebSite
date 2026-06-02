<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Hunt Finder';

$data = require __DIR__ . '/huntfinder_data.php';

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
$rcHfImageBase = $rcTemplatePath . '/images/hunt_finder';

if (!function_exists('rc_hf_esc')) {
    function rc_hf_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_hf_img_src')) {
    function rc_hf_img_src($relPath)
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

if (!function_exists('rc_hf_page_image')) {
    function rc_hf_page_image($templateRelBase, $fileName, $class, $alt)
    {
        $relPath = rtrim(ltrim(str_replace('\\', '/', (string)$templateRelBase), '/'), '/')
            . '/' . ltrim((string)$fileName, '/');
        if (!file_exists(BASE . $relPath)) {
            return '';
        }
        return '<img class="' . rc_hf_esc($class) . '" src="' . rc_hf_esc(rc_hf_img_src($relPath)) . '" alt="' . rc_hf_esc($alt) . '" loading="lazy">';
    }
}

$howHtml = '';
foreach ($data['how_it_works'] as $rule) {
    $howHtml .= '<li>' . $rule . '</li>';
}

$featuresHtml = '';
foreach ($data['features'] as $feature) {
    $featuresHtml .= '<li>' . $feature . '</li>';
}

$difficultyRows = '';
foreach ($data['difficulties'] as $row) {
    $difficultyRows .= '<tr>'
        . '<td><span class="rc-hf-diff-badge ' . rc_hf_esc($row['class']) . '">' . rc_hf_esc($row['name']) . '</span></td>'
        . '<td class="rc-hf-text-left">' . $row['desc'] . '</td></tr>';
}

$locationRows = '';
foreach ($data['locations'] as $row) {
    $locationRows .= '<tr>'
        . '<td><strong>' . rc_hf_esc($row['name']) . '</strong></td>'
        . '<td class="rc-hf-text-left">' . rc_hf_esc($row['desc']) . '</td></tr>';
}

$returnHtml = '';
foreach ($data['return_teleport'] as $paragraph) {
    $returnHtml .= '<p class="rc-hf-lead">' . $paragraph . '</p>';
}

$boatsHtml = '';
foreach ($data['return_boats'] as $boat) {
    $boatsHtml .= '<li>' . $boat . '</li>';
}

$huntFinderImgHtml = rc_hf_page_image(
    $rcHfImageBase,
    'hunt-finder.png',
    'rc-hf-preview',
    'Hunt Finder'
);

$teleportBackImgHtml = rc_hf_page_image(
    $rcHfImageBase,
    'teleport-back.png',
    'rc-hf-teleport-img',
    'Teleport de retorno'
);

echo '<div class="rc-st-page rc-hf-page">'
    . '<header class="rc-st-page-title"><h2>Hunt Finder</h2></header>'
    . '<nav class="rc-hf-nav rc-hf-nav-below" aria-label="Seções do guia">'
    . '<a href="#rc-hf-como">Como funciona</a>'
    . '<a href="#rc-hf-funcoes">Funcionalidades</a>'
    . '<a href="#rc-hf-dificuldade">Dificuldades</a>'
    . '<a href="#rc-hf-instancias">Instâncias</a>'
    . '<a href="#rc-hf-retorno">Teleport de retorno</a>'
    . '</nav>'

    . '<section class="rc-st-card rc-hf-anchor" id="rc-hf-como">'
    . '<h3>Como Funciona?</h3>'
    . '<ul class="rc-st-notes rc-hf-rules-list">' . $howHtml . '</ul>'
    . ($huntFinderImgHtml !== ''
        ? '<figure class="rc-hf-preview-wrap">' . $huntFinderImgHtml . '</figure>'
        : '')
    . '</section>'

    . '<section class="rc-st-card rc-hf-anchor" id="rc-hf-funcoes">'
    . '<h3>Funcionalidades</h3>'
    . '<p class="rc-hf-lead">Ao utilizar o HuntFinder, o jogador poderá:</p>'
    . '<ul class="rc-st-notes rc-hf-rules-list">' . $featuresHtml . '</ul>'
    . '</section>'

    . '<section class="rc-st-card rc-hf-anchor" id="rc-hf-dificuldade">'
    . '<h3>Dificuldades</h3>'
    . '<p class="rc-hf-lead">Filtre as hunts pelo nível de dificuldade no menu superior da janela do HuntFinder.</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-hf-table">'
    . '<thead><tr><th>Dificuldade</th><th>Descrição</th></tr></thead>'
    . '<tbody>' . $difficultyRows . '</tbody></table></div>'
    . '</section>'

    . '<section class="rc-st-card rc-hf-anchor" id="rc-hf-instancias">'
    . '<h3>Instâncias — Ravyn Depths</h3>'
    . '<p class="rc-hf-lead">Alguns respawns possuem mais de uma localização. Ao abrir os <strong>detalhes</strong> de uma hunt, selecione a instância desejada antes de teleportar.</p>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table rc-tier-table rc-hf-table">'
    . '<thead><tr><th>Instância</th><th>Descrição</th></tr></thead>'
    . '<tbody>' . $locationRows . '</tbody></table></div>'
    . '</section>'

    . '<section class="rc-st-card rc-hf-rules-card rc-hf-anchor" id="rc-hf-retorno">'
    . '<h3>Teleport de Retorno</h3>'
    . '<div class="rc-hf-return-row">'
    . '<div class="rc-hf-return-text">' . $returnHtml
    . '<ul class="rc-st-notes rc-hf-rules-list rc-hf-boats-list">' . $boatsHtml . '</ul>'
    . '<p class="rc-hf-note">' . rc_hf_esc($data['return_note']) . '</p>'
    . '</div>'
    . ($teleportBackImgHtml !== ''
        ? '<figure class="rc-hf-teleport-wrap">' . $teleportBackImgHtml . '<figcaption>Teleport de retorno (sem PZ)</figcaption></figure>'
        : '')
    . '</div></section>'

    . '<script>(function(){'
    . 'function hfScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-hf-page a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();hfScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){hfScrollTo(t);},120);}}'
    . '})();</script>'
    . '</div>';
