<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Boss Finder';

$data = require __DIR__ . '/bossfinder_data.php';

if (!function_exists('rc_bf_esc')) {
    function rc_bf_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rc_bf_monster_image')) {
    function rc_bf_monster_image($slug)
    {
        $slug = preg_replace('/[^a-z0-9_-]/i', '', (string)$slug);
        if ($slug === '') {
            return '';
        }
        foreach (['gif', 'png'] as $ext) {
            $path = '/images/library/' . $slug . '.' . $ext;
            if (file_exists(BASE . $path)) {
                return $path;
            }
        }
        return '';
    }
}

if (!function_exists('rc_bf_render_solo_card')) {
    function rc_bf_render_solo_card(array $boss)
    {
        $search = strtolower($boss['visual'] . ' ' . $boss['real']);
        $img = rc_bf_monster_image($boss['slug'] ?? '');
        $imgHtml = $img !== ''
            ? '<img class="rc-bf-card-img" src="' . rc_bf_esc($img) . '" alt="" loading="lazy">'
            : '';

        $notes = trim((string)($boss['notes'] ?? ''));
        $notesHtml = $notes !== ''
            ? '<p class="rc-bf-card-notes"><span class="rc-bf-lbl">Observações</span> ' . rc_bf_esc($notes) . '</p>'
            : '';

        return '<article class="rc-bf-boss-card" data-search="' . rc_bf_esc($search) . '">'
            . '<header class="rc-bf-boss-head">'
            . $imgHtml
            . '<div class="rc-bf-boss-head-text">'
            . '<h4>' . rc_bf_esc($boss['visual']) . '</h4>'
            . '<span class="rc-bf-badge rc-bf-badge-solo">Solo Boss</span>'
            . '<p class="rc-bf-boss-real">Nome real: <strong>' . rc_bf_esc($boss['real']) . '</strong></p>'
            . '</div></header>'
            . '<div class="rc-bf-boss-body">'
            . '<p><span class="rc-bf-lbl rc-bf-lbl-cd">Cooldown</span> <span class="rc-bf-badge rc-bf-badge-cd">CD</span> '
            . rc_bf_esc($boss['cooldown']) . '</p>'
            . '<p><span class="rc-bf-lbl">Mecânica</span> ' . rc_bf_esc($boss['mechanic']) . '</p>'
            . '<p><span class="rc-bf-lbl">Funcionamento</span> ' . rc_bf_esc($boss['flow']) . '</p>'
            . $notesHtml
            . '</div></article>';
    }
}

if (!function_exists('rc_bf_render_progression')) {
    function rc_bf_render_progression(array $sys)
    {
        $miniCount = (int)($sys['mini_count'] ?? count($sys['minis'] ?? []));
        $total = max(1, $miniCount + 1);
        $pct = (int)round(($miniCount / $total) * 100);

        $timeline = '';
        foreach ($sys['minis'] as $i => $mini) {
            if ($i > 0) {
                $timeline .= '<span class="rc-bf-tl-arrow" aria-hidden="true">→</span>';
            }
            $timeline .= '<span class="rc-bf-tl-mini">' . rc_bf_esc($mini) . '</span>';
        }
        $timeline .= '<span class="rc-bf-tl-arrow" aria-hidden="true">⇒</span>';
        $timeline .= '<span class="rc-bf-tl-final">' . rc_bf_esc($sys['final']) . '</span>';

        $rules = '';
        foreach ($sys['rules'] as $rule) {
            $rules .= '<li>' . rc_bf_esc($rule) . '</li>';
        }

        return '<article class="rc-bf-prog-card" id="rc-bf-' . rc_bf_esc($sys['id']) . '">'
            . '<h4>' . rc_bf_esc($sys['name']) . ' <span class="rc-bf-badge rc-bf-badge-prog">Progressão</span></h4>'
            . '<div class="rc-bf-progress-wrap">'
            . '<div class="rc-bf-progress-labels"><span>Minis</span><span>' . $miniCount . ' → Final</span></div>'
            . '<div class="rc-bf-progress-track" role="progressbar" aria-valuenow="' . $pct . '" aria-valuemin="0" aria-valuemax="100">'
            . '<div class="rc-bf-progress-fill" style="width:' . $pct . '%"></div></div></div>'
            . '<div class="rc-bf-timeline">' . $timeline . '</div>'
            . '<details class="rc-bf-accordion"><summary>Regras completas</summary>'
            . '<ul class="rc-bf-prog-rules">' . $rules . '</ul></details></article>';
    }
}

$rulesHtml = '';
foreach ($data['general_rules'] as $rule) {
    $rulesHtml .= '<li>' . rc_bf_esc($rule) . '</li>';
}

$iconsHtml = '';
foreach ($data['rule_icons'] as $icon) {
    $iconsHtml .= '<span class="rc-bf-icon-pill" title="' . rc_bf_esc($icon['label']) . '">'
        . '<span class="rc-bf-icon-symbol">' . rc_bf_esc($icon['symbol']) . '</span> '
        . rc_bf_esc($icon['label']) . '</span>';
}

$soloHtml = '';
foreach ($data['solo_bosses'] as $boss) {
    $soloHtml .= rc_bf_render_solo_card($boss);
}

$progHtml = '';
foreach ($data['progression_systems'] as $sys) {
    $progHtml .= rc_bf_render_progression($sys);
}

$tableRows = '';
foreach ($data['summary_table'] as $row) {
    $tableRows .= '<tr>'
        . '<td>' . rc_bf_esc($row['system']) . '</td>'
        . '<td>' . (int)$row['minis'] . '</td>'
        . '<td>' . rc_bf_esc($row['final']) . '</td>'
        . '<td class="rc-bf-reset-yes">' . rc_bf_esc($row['reset']) . '</td></tr>';
}

echo '<div class="rc-st-page rc-bf-page">'
    . '<header class="rc-st-page-title rc-bf-hero">'
    . '<h2>Boss Finder</h2>'
    . '<p class="rc-bf-subtitle">Entenda como funciona o sistema de bosses do RavynCore, cooldowns, progressões e desbloqueios.</p>'
    . '<nav class="rc-bf-nav" aria-label="Seções do guia">'
    . '<a href="#rc-bf-regras">Regras gerais</a>'
    . '<a href="#rc-bf-solo">Bosses solo</a>'
    . '<a href="#rc-bf-progressao">Progressão</a>'
    . '<a href="#rc-bf-resumo">Resumo</a>'
    . '</nav></header>'

    . '<section class="rc-st-card rc-bf-rules-card" id="rc-bf-regras">'
    . '<h3>Regras gerais</h3>'
    . '<ul class="rc-st-notes rc-bf-rules-list">' . $rulesHtml . '</ul>'
    . '<div class="rc-bf-icon-row">' . $iconsHtml . '</div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-bf-solo">'
    . '<h3>Bosses solo</h3>'
    . '<div class="rc-bf-filter">'
    . '<label class="rc-bf-sr-only" for="rcBfBossSearch">Buscar boss</label>'
    . '<input type="search" id="rcBfBossSearch" class="rc-bf-search" placeholder="Buscar por nome visual ou real…" autocomplete="off">'
    . '</div>'
    . '<div class="rc-bf-solo-grid" id="rcBfSoloGrid">' . $soloHtml . '</div>'
    . '<p class="rc-bf-empty" id="rcBfEmpty" hidden>Nenhum boss encontrado para esta busca.</p>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-bf-progressao">'
    . '<h3>Sistemas de progressão</h3>'
    . '<p class="rc-bf-lead">Cadeias de minis com boss final. Complete todos os minis para liberar o confronto final.</p>'
    . '<div class="rc-bf-prog-wrap">' . $progHtml . '</div>'
    . '</section>'

    . '<section class="rc-st-card" id="rc-bf-resumo">'
    . '<h3>Resumo dos sistemas</h3>'
    . '<div class="rc-bf-table-wrap"><table class="rc-bf-table">'
    . '<thead><tr><th>Sistema</th><th>Quantidade de minis</th><th>Boss final</th><th>Reset após final?</th></tr></thead>'
    . '<tbody>' . $tableRows . '</tbody></table></div>'
    . '</section>'

    . '<script>(function(){'
    . 'var input=document.getElementById("rcBfBossSearch");'
    . 'var grid=document.getElementById("rcBfSoloGrid");'
    . 'var empty=document.getElementById("rcBfEmpty");'
    . 'if(!input||!grid){return;}'
    . 'input.addEventListener("input",function(){'
    . 'var q=(input.value||"").toLowerCase().trim();'
    . 'var cards=grid.querySelectorAll(".rc-bf-boss-card");'
    . 'var visible=0;'
    . 'cards.forEach(function(card){'
    . 'var ok=!q||(card.getAttribute("data-search")||"").indexOf(q)!==-1;'
    . 'card.style.display=ok?"":"none";'
    . 'if(ok){visible++;}'
    . '});'
    . 'if(empty){empty.hidden=visible>0;}'
    . '});'
    . 'document.querySelectorAll(".rc-bf-nav a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");'
    . 'if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);'
    . 'if(!el){return;}'
    . 'ev.preventDefault();'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+12;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . '});'
    . '});'
    . '})();</script>'
    . '</div>';
