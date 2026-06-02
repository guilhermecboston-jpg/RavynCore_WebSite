<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Boss Finder';

$data = require __DIR__ . '/bossfinder_data.php';

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
$rcBfImageBase = $rcTemplatePath . '/images/boss_finder';

if (!function_exists('rc_bf_esc')) {
    function rc_bf_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_bf_img_src')) {
    function rc_bf_img_src($relPath)
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

if (!function_exists('rc_bf_page_image')) {
    function rc_bf_page_image($templateRelBase, $fileName, $class, $alt)
    {
        $relPath = rtrim(ltrim(str_replace('\\', '/', (string)$templateRelBase), '/'), '/')
            . '/' . ltrim((string)$fileName, '/');
        if (!file_exists(BASE . $relPath)) {
            return '';
        }
        return '<img class="' . rc_bf_esc($class) . '" src="' . rc_bf_esc(rc_bf_img_src($relPath)) . '" alt="' . rc_bf_esc($alt) . '" loading="lazy">';
    }
}

$howHtml = '';
foreach ($data['how_it_works'] as $rule) {
    $howHtml .= '<li>' . $rule . '</li>';
}

$introHtml = '';
foreach ($data['progression_intro'] as $paragraph) {
    $introHtml .= '<p class="rc-bf-lead">' . rc_bf_esc($paragraph) . '</p>';
}

$progBossListHtml = '';
foreach ($data['progression_bosses'] as $boss) {
    $note = trim((string)($boss['note'] ?? ''));
    $line = rc_bf_esc($boss['name']);
    if ($note !== '') {
        $line .= ' <span class="rc-bf-prog-boss-note">(' . rc_bf_esc($note) . ')</span>';
    }
    $progBossListHtml .= '<li>' . $line . '</li>';
}

$tableRows = '';
foreach ($data['summary_table'] as $row) {
    $tableRows .= '<tr>'
        . '<td>' . rc_bf_esc($row['system']) . '</td>'
        . '<td>' . (int)$row['minis'] . '</td>'
        . '<td>' . rc_bf_esc($row['final']) . '</td>'
        . '<td class="rc-bf-reset-yes">' . rc_bf_esc($row['reset']) . '</td></tr>';
}

$rulesHtml = '';
foreach ($data['general_rules'] as $rule) {
    $rulesHtml .= '<li>' . $rule . '</li>';
}

$bossFinderImgHtml = rc_bf_page_image(
    $rcBfImageBase,
    'boss-finder.png',
    'rc-bf-preview',
    'Boss Finder'
);

echo '<div class="rc-st-page rc-bf-page">'
    . '<header class="rc-st-page-title"><h2>Boss Finder</h2></header>'
    . '<nav class="rc-bf-nav rc-bf-nav-below" aria-label="Seções do guia">'
    . '<a href="#rc-bf-como">Como funciona</a>'
    . '<a href="#rc-bf-progressao">Progressão</a>'
    . '<a href="#rc-bf-resumo">Resumo</a>'
    . '<a href="#rc-bf-regras">Regras gerais</a>'
    . '</nav>'

    . '<section class="rc-st-card rc-bf-anchor" id="rc-bf-como">'
    . '<h3>Como Funciona?</h3>'
    . '<ul class="rc-st-notes rc-bf-rules-list">' . $howHtml . '</ul>'
    . ($bossFinderImgHtml !== ''
        ? '<figure class="rc-bf-preview-wrap">' . $bossFinderImgHtml . '</figure>'
        : '')
    . '</section>'

    . '<section class="rc-st-card rc-bf-anchor" id="rc-bf-progressao">'
    . '<h3>Progressão de Bosses</h3>'
    . $introHtml
    . '<h4 class="rc-tier-h4">Bosses com Progressão</h4>'
    . '<ul class="rc-st-notes rc-bf-prog-boss-list">' . $progBossListHtml . '</ul>'
    . '</section>'

    . '<section class="rc-st-card rc-bf-anchor" id="rc-bf-resumo">'
    . '<h3>Resumo dos Sistemas</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table">'
    . '<thead><tr><th>Sistema</th><th>Mini Bosses</th><th>Boss Final</th><th>Reset após derrotar o final</th></tr></thead>'
    . '<tbody>' . $tableRows . '</tbody></table></div>'
    . '</section>'

    . '<section class="rc-st-card rc-bf-rules-card rc-bf-anchor" id="rc-bf-regras">'
    . '<h3>Regras Gerais</h3>'
    . '<ul class="rc-st-notes rc-bf-rules-list">' . $rulesHtml . '</ul>'
    . '</section>'

    . '<script>(function(){'
    . 'function bfScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-bf-page a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();bfScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){bfScrollTo(t);},120);}}'
    . '})();</script>'
    . '</div>';
