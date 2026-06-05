<?php
defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('rc_t') && defined('SYSTEM') && file_exists(SYSTEM . 'libs/rc_i18n.php')) {
    require_once SYSTEM . 'libs/rc_i18n.php';
    rc_i18n_init();
}

$title = 'Reflect Potion';
$rcReflectLang = function_exists('rc_current_language') ? rc_current_language() : 'pt-br';

$rcReflectText = [
    'pt-br' => [
        'page_title' => 'Reflect Damage',
        'nav_about' => 'Sobre o Sistema',
        'nav_potions' => 'Reflect Potions',
        'nav_example' => 'Exemplo Prático',
        'nav_limits' => 'Limites e Skills',
        'nav_obtain' => 'Onde Obter',
        'about_title' => 'Sobre o Sistema',
        'about_p1' => 'O <strong>Reflect System</strong> visa melhorar suas habilidades defensivas e ofensivas tanto no <strong>PvP</strong> quanto no <strong>PvE</strong>. Por meio do uso de <strong>Reflect Stones</strong>, você tem <strong>20% de chance de ativação</strong> para cada ataque que receber.',
        'about_p2' => 'Ao usar poções, você tem <strong>70% de chance</strong> de aumentar o nível da sua habilidade Reflect. Se a ativação falhar, o nível não sobe, mas também <strong>não há chance de redução</strong> no nível atual.',
        'potions_title' => 'Reflect Potions',
        'potions_p1' => 'Este sistema melhora a jogabilidade porque o dano refletido pelo jogador ou monstro é baseado na porcentagem de Reflect que o jogador possui.',
        'potions_p2' => 'As <strong>Reflect Potions</strong> podem ser usadas para melhorar as habilidades de defesa do seu personagem em qualquer categoria de item.',
        'potions_p3' => 'Para verificar seu percentual de Reflect, basta dar <strong>look</strong> no seu personagem ou em outros personagens. No <strong>server log</strong>, você também poderá ver o dano refletido e o skill de Reflect ao lado.',
        'potions_gain' => 'A cada Reflect Potion utilizada, seu percentual de Reflect aumenta em <strong>0,50%</strong>.',
        'example_title' => 'Exemplo Prático',
        'example_p1' => 'Imagine que um monstro ataca seu personagem com <strong>1000 de dano</strong>. Se você tiver <strong>10% de Reflect</strong> ativo graças ao uso de Reflect Potions, o atacante receberá <strong>100 de dano refletido</strong>.',
        'example_p2' => 'Esse valor possui proteção, então o impacto real pode ser reduzido. O limite máximo de dano refletido é de <strong>10.000</strong>.',
        'limits_title' => 'Limites e Skills',
        'max_percent_label' => 'Porcentagem Máxima',
        'max_percent_desc' => 'Limite máximo de Reflect acumulável',
        'max_skill_label' => 'Skill Máximo',
        'max_skill_desc' => '100 de skill de Reflect máximo',
        'obtain_title' => 'Onde Obter',
        'obtain_intro' => 'As Reflect Potions podem ser obtidas das seguintes formas:',
        'obtain_npc' => '<strong>NPC Dealer:</strong> 50kk',
        'obtain_casino' => 'Através do sistema de <strong>Cassino</strong>.',
        'obtain_bosses' => 'Como recompensa de <strong>bosses custom</strong> e de <strong>invasão</strong>.',
        'stat_attack' => 'Ativação por ataque recebido',
        'stat_potion' => 'Chance de upgrade por potion',
        'stat_gain' => 'Ganho por potion usada',
        'stat_cap' => 'Dano refletido máximo',
        'safe_fail' => 'Falhou? Sem downgrade',
        'safe_fail_desc' => 'Falha não aumenta o nível, mas também não reduz sua skill atual.',
        'flow_hit' => 'Dano recebido',
        'flow_reflect' => 'Reflect ativo',
        'flow_return' => 'Dano refletido',
        'guide_sections' => 'Seções do guia',
    ],
    'en' => [
        'page_title' => 'Reflect Damage',
        'nav_about' => 'About the System',
        'nav_potions' => 'Reflect Potions',
        'nav_example' => 'Practical Example',
        'nav_limits' => 'Limits and Skills',
        'nav_obtain' => 'Where to Obtain',
        'about_title' => 'About the System',
        'about_p1' => 'The <strong>Reflect System</strong> improves your defensive and offensive abilities in both <strong>PvP</strong> and <strong>PvE</strong>. By using <strong>Reflect Stones</strong>, you have a <strong>20% activation chance</strong> for each attack you receive.',
        'about_p2' => 'When using potions, you have a <strong>70% chance</strong> to increase your Reflect skill level. If activation fails, the level does not increase, but there is also <strong>no chance of reduction</strong> to your current level.',
        'potions_title' => 'Reflect Potions',
        'potions_p1' => 'This system improves gameplay because the damage reflected by the player or monster is based on the player\'s Reflect percentage.',
        'potions_p2' => '<strong>Reflect Potions</strong> can be used to improve your character\'s defensive abilities in any item category.',
        'potions_p3' => 'To check your Reflect percentage, simply <strong>look</strong> at your character or other characters. In the <strong>server log</strong>, you can also see your reflected damage and Reflect skill next to it.',
        'potions_gain' => 'Each Reflect Potion used increases your Reflect percentage by <strong>0.50%</strong>.',
        'example_title' => 'Practical Example',
        'example_p1' => 'Imagine a monster attacks your character for <strong>1000 damage</strong>. If you have <strong>10% Reflect</strong> active thanks to Reflect Potions, the attacker receives <strong>100 reflected damage</strong>.',
        'example_p2' => 'This value has protection, so the real impact can be reduced. The maximum reflected damage limit is <strong>10,000</strong>.',
        'limits_title' => 'Limits and Skills',
        'max_percent_label' => 'Maximum Percentage',
        'max_percent_desc' => 'Maximum stackable Reflect limit',
        'max_skill_label' => 'Maximum Skill',
        'max_skill_desc' => 'Maximum Reflect skill is 100',
        'obtain_title' => 'Where to Obtain',
        'obtain_intro' => 'Reflect Potions can be obtained in the following ways:',
        'obtain_npc' => '<strong>NPC Dealer:</strong> 50kk',
        'obtain_casino' => 'Through the <strong>Casino</strong> system.',
        'obtain_bosses' => 'As a reward from <strong>custom bosses</strong> and <strong>invasion bosses</strong>.',
        'stat_attack' => 'Activation per received attack',
        'stat_potion' => 'Upgrade chance per potion',
        'stat_gain' => 'Gain per potion used',
        'stat_cap' => 'Maximum reflected damage',
        'safe_fail' => 'Failed? No downgrade',
        'safe_fail_desc' => 'Failure does not increase the level, but it also does not reduce your current skill.',
        'flow_hit' => 'Damage received',
        'flow_reflect' => 'Active Reflect',
        'flow_return' => 'Reflected damage',
        'guide_sections' => 'Guide sections',
    ],
    'es' => [
        'page_title' => 'Daño Reflect',
        'nav_about' => 'Sobre el Sistema',
        'nav_potions' => 'Reflect Potions',
        'nav_example' => 'Ejemplo Práctico',
        'nav_limits' => 'Límites y Skills',
        'nav_obtain' => 'Dónde Obtener',
        'about_title' => 'Sobre el Sistema',
        'about_p1' => 'El <strong>Reflect System</strong> mejora tus habilidades defensivas y ofensivas tanto en <strong>PvP</strong> como en <strong>PvE</strong>. Al usar <strong>Reflect Stones</strong>, tienes <strong>20% de chance de activación</strong> por cada ataque recibido.',
        'about_p2' => 'Al usar potions, tienes <strong>70% de chance</strong> de aumentar el nivel de tu skill Reflect. Si la activación falla, el nivel no sube, pero tampoco hay <strong>chance de reducción</strong> en el nivel actual.',
        'potions_title' => 'Reflect Potions',
        'potions_p1' => 'Este sistema mejora la jugabilidad porque el daño reflejado por el jugador o monstruo se basa en el porcentaje de Reflect que tiene el jugador.',
        'potions_p2' => 'Las <strong>Reflect Potions</strong> pueden usarse para mejorar las habilidades defensivas de tu personaje en cualquier categoría de item.',
        'potions_p3' => 'Para verificar tu porcentaje de Reflect, solo debes dar <strong>look</strong> en tu personaje o en otros personajes. En el <strong>server log</strong>, también podrás ver el daño reflejado y tu skill de Reflect al lado.',
        'potions_gain' => 'Cada Reflect Potion utilizada aumenta tu porcentaje de Reflect en <strong>0,50%</strong>.',
        'example_title' => 'Ejemplo Práctico',
        'example_p1' => 'Imagina que un monstruo ataca tu personaje con <strong>1000 de daño</strong>. Si tienes <strong>10% de Reflect</strong> activo gracias al uso de Reflect Potions, el atacante recibirá <strong>100 de daño reflejado</strong>.',
        'example_p2' => 'Este valor tiene protección, por lo que el impacto real puede reducirse. El límite máximo de daño reflejado es <strong>10.000</strong>.',
        'limits_title' => 'Límites y Skills',
        'max_percent_label' => 'Porcentaje Máximo',
        'max_percent_desc' => 'Límite máximo de Reflect acumulable',
        'max_skill_label' => 'Skill Máximo',
        'max_skill_desc' => '100 de skill Reflect máximo',
        'obtain_title' => 'Dónde Obtener',
        'obtain_intro' => 'Las Reflect Potions pueden obtenerse de las siguientes formas:',
        'obtain_npc' => '<strong>NPC Dealer:</strong> 50kk',
        'obtain_casino' => 'A través del sistema de <strong>Casino</strong>.',
        'obtain_bosses' => 'Como recompensa de <strong>bosses custom</strong> y de <strong>invasión</strong>.',
        'stat_attack' => 'Activación por ataque recibido',
        'stat_potion' => 'Chance de upgrade por potion',
        'stat_gain' => 'Ganancia por potion usada',
        'stat_cap' => 'Daño reflejado máximo',
        'safe_fail' => '¿Falló? Sin downgrade',
        'safe_fail_desc' => 'La falla no aumenta el nivel, pero tampoco reduce tu skill actual.',
        'flow_hit' => 'Daño recibido',
        'flow_reflect' => 'Reflect activo',
        'flow_return' => 'Daño reflejado',
        'guide_sections' => 'Secciones de la guía',
    ],
];
$rcReflect = $rcReflectText[$rcReflectLang] ?? $rcReflectText['pt-br'];

if (!function_exists('rc_reflect_esc')) {
    function rc_reflect_esc($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

$statCards = [
    ['value' => '20%', 'label' => $rcReflect['stat_attack']],
    ['value' => '70%', 'label' => $rcReflect['stat_potion']],
    ['value' => '+0,50%', 'label' => $rcReflect['stat_gain']],
    ['value' => '10.000', 'label' => $rcReflect['stat_cap']],
];

$statCardsHtml = '';
foreach ($statCards as $card) {
    $statCardsHtml .= '<article class="rc-reflect-stat"><strong>' . rc_reflect_esc($card['value']) . '</strong><span>' . rc_reflect_esc($card['label']) . '</span></article>';
}

$obtainItems = [$rcReflect['obtain_npc'], $rcReflect['obtain_casino'], $rcReflect['obtain_bosses']];
$obtainHtml = '';
foreach ($obtainItems as $item) {
    $obtainHtml .= '<li>' . $item . '</li>';
}

echo '<div class="rc-st-page rc-reflect-page">'
    . '<header class="rc-st-page-title"><h2>' . rc_reflect_esc($rcReflect['page_title']) . '</h2></header>'
    . '<nav class="rc-tier-nav rc-tier-nav-below" aria-label="' . rc_reflect_esc($rcReflect['guide_sections']) . '">'
    . '<a href="#rc-reflect-about">' . rc_reflect_esc($rcReflect['nav_about']) . '</a>'
    . '<a href="#rc-reflect-potions">' . rc_reflect_esc($rcReflect['nav_potions']) . '</a>'
    . '<a href="#rc-reflect-example">' . rc_reflect_esc($rcReflect['nav_example']) . '</a>'
    . '<a href="#rc-reflect-limits">' . rc_reflect_esc($rcReflect['nav_limits']) . '</a>'
    . '<a href="#rc-reflect-obtain">' . rc_reflect_esc($rcReflect['nav_obtain']) . '</a>'
    . '</nav>'

    . '<section class="rc-st-card rc-reflect-anchor rc-reflect-hero" id="rc-reflect-about">'
    . '<div class="rc-reflect-orb" aria-hidden="true"><span></span></div>'
    . '<div class="rc-reflect-hero-copy">'
    . '<h3>' . rc_reflect_esc($rcReflect['about_title']) . '</h3>'
    . '<p>' . $rcReflect['about_p1'] . '</p>'
    . '<p>' . $rcReflect['about_p2'] . '</p>'
    . '</div>'
    . '</section>'

    . '<section class="rc-reflect-stat-grid">' . $statCardsHtml . '</section>'

    . '<section class="rc-st-card rc-reflect-anchor" id="rc-reflect-potions">'
    . '<h3>' . rc_reflect_esc($rcReflect['potions_title']) . '</h3>'
    . '<p class="rc-reflect-lead">' . $rcReflect['potions_p1'] . '</p>'
    . '<p class="rc-reflect-lead">' . $rcReflect['potions_p2'] . '</p>'
    . '<p class="rc-reflect-lead">' . $rcReflect['potions_p3'] . '</p>'
    . '<div class="rc-reflect-note"><strong>' . $rcReflect['potions_gain'] . '</strong><span>' . rc_reflect_esc($rcReflect['safe_fail_desc']) . '</span></div>'
    . '</section>'

    . '<section class="rc-st-card rc-reflect-anchor" id="rc-reflect-example">'
    . '<h3>' . rc_reflect_esc($rcReflect['example_title']) . '</h3>'
    . '<p class="rc-reflect-lead">' . $rcReflect['example_p1'] . '</p>'
    . '<div class="rc-reflect-flow">'
    . '<div><small>' . rc_reflect_esc($rcReflect['flow_hit']) . '</small><strong>1000</strong></div>'
    . '<span>×</span>'
    . '<div><small>' . rc_reflect_esc($rcReflect['flow_reflect']) . '</small><strong>10%</strong></div>'
    . '<span>=</span>'
    . '<div><small>' . rc_reflect_esc($rcReflect['flow_return']) . '</small><strong>100</strong></div>'
    . '</div>'
    . '<p class="rc-reflect-lead">' . $rcReflect['example_p2'] . '</p>'
    . '</section>'

    . '<section class="rc-st-card rc-reflect-anchor" id="rc-reflect-limits">'
    . '<h3>' . rc_reflect_esc($rcReflect['limits_title']) . '</h3>'
    . '<div class="rc-reflect-limit-grid">'
    . '<article><span>' . rc_reflect_esc($rcReflect['max_percent_label']) . '</span><strong>50%</strong><small>' . rc_reflect_esc($rcReflect['max_percent_desc']) . '</small></article>'
    . '<article><span>' . rc_reflect_esc($rcReflect['max_skill_label']) . '</span><strong>100</strong><small>' . rc_reflect_esc($rcReflect['max_skill_desc']) . '</small></article>'
    . '<article><span>' . rc_reflect_esc($rcReflect['safe_fail']) . '</span><strong>0%</strong><small>' . rc_reflect_esc($rcReflect['safe_fail_desc']) . '</small></article>'
    . '</div>'
    . '</section>'

    . '<section class="rc-st-card rc-reflect-anchor" id="rc-reflect-obtain">'
    . '<h3>' . rc_reflect_esc($rcReflect['obtain_title']) . '</h3>'
    . '<p class="rc-reflect-lead">' . rc_reflect_esc($rcReflect['obtain_intro']) . '</p>'
    . '<ul class="rc-st-notes rc-reflect-obtain-list">' . $obtainHtml . '</ul>'
    . '</section>'

    . '<style>'
    . '.rc-reflect-page .rc-reflect-anchor{scroll-margin-top:140px}'
    . '.rc-reflect-page .rc-reflect-hero{display:flex;gap:22px;align-items:center;overflow:hidden;position:relative}'
    . '.rc-reflect-page .rc-reflect-hero:before{content:"";position:absolute;inset:-120px auto auto -120px;width:260px;height:260px;background:radial-gradient(circle,rgba(65,210,255,.22),transparent 62%);pointer-events:none}'
    . '.rc-reflect-page .rc-reflect-orb{width:112px;height:112px;min-width:112px;border-radius:50%;display:grid;place-items:center;background:radial-gradient(circle at 38% 30%,#d7fbff,#3cc9ff 32%,#0b4072 66%,#061222);box-shadow:0 0 26px rgba(52,202,255,.34),inset 0 0 24px rgba(255,255,255,.2);border:1px solid rgba(133,220,255,.45)}'
    . '.rc-reflect-page .rc-reflect-orb span{width:54px;height:54px;border-radius:50%;border:2px solid rgba(255,255,255,.68);box-shadow:0 0 0 9px rgba(255,255,255,.08),0 0 24px rgba(255,255,255,.42)}'
    . '.rc-reflect-page .rc-reflect-hero-copy{position:relative;z-index:1;flex:1;min-width:240px}'
    . '.rc-reflect-page .rc-reflect-hero-copy p,.rc-reflect-page .rc-reflect-lead{font-size:14px;line-height:1.65;color:#d6e4ff;margin:0 0 12px}'
    . '.rc-reflect-page .rc-reflect-stat-grid,.rc-reflect-page .rc-reflect-limit-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px;margin:16px 0}'
    . '.rc-reflect-page .rc-reflect-stat,.rc-reflect-page .rc-reflect-limit-grid article{border:1px solid rgba(77,152,236,.42);border-radius:12px;background:linear-gradient(145deg,rgba(9,22,42,.92),rgba(14,35,63,.72));padding:16px;text-align:center;box-shadow:inset 0 1px 0 rgba(255,255,255,.06)}'
    . '.rc-reflect-page .rc-reflect-stat strong,.rc-reflect-page .rc-reflect-limit-grid strong{display:block;color:#ffd469;font-size:34px;line-height:1;font-family:monospace;letter-spacing:.04em;text-shadow:0 0 16px rgba(255,196,72,.24)}'
    . '.rc-reflect-page .rc-reflect-stat span,.rc-reflect-page .rc-reflect-limit-grid span{display:block;margin-top:9px;color:#dce8ff;font-size:12px;text-transform:uppercase;letter-spacing:.08em;font-weight:800}'
    . '.rc-reflect-page .rc-reflect-limit-grid small{display:block;margin-top:8px;color:#aebdde;font-size:12px;line-height:1.35}'
    . '.rc-reflect-page .rc-reflect-note{display:flex;flex-direction:column;gap:6px;margin-top:14px;padding:14px 16px;border:1px solid rgba(255,212,105,.45);border-radius:12px;background:rgba(255,190,70,.08);color:#d6e4ff}'
    . '.rc-reflect-page .rc-reflect-note strong{color:#ffd469}'
    . '.rc-reflect-page .rc-reflect-flow{display:flex;align-items:stretch;justify-content:center;gap:10px;flex-wrap:wrap;margin:18px 0}'
    . '.rc-reflect-page .rc-reflect-flow div{min-width:140px;border:1px solid rgba(77,152,236,.38);border-radius:12px;background:#071224;padding:14px;text-align:center}'
    . '.rc-reflect-page .rc-reflect-flow small{display:block;color:#aebdde;text-transform:uppercase;letter-spacing:.08em;font-size:11px}'
    . '.rc-reflect-page .rc-reflect-flow strong{display:block;color:#ffd469;font-size:28px;font-family:monospace;margin-top:5px}'
    . '.rc-reflect-page .rc-reflect-flow>span{display:grid;place-items:center;color:#62d9ff;font-size:26px;font-weight:900}'
    . '.rc-reflect-page .rc-reflect-obtain-list li{font-size:14px;line-height:1.55}'
    . '@media (max-width:640px){.rc-reflect-page .rc-reflect-hero{align-items:flex-start}.rc-reflect-page .rc-reflect-orb{width:82px;height:82px;min-width:82px}.rc-reflect-page .rc-reflect-orb span{width:40px;height:40px}.rc-reflect-page .rc-reflect-flow>span{width:100%}}'
    . '</style>'

    . '<script>(function(){'
    . 'function reflectScrollTo(el){if(!el){return;}'
    . 'var header=document.querySelector(".rc-header");'
    . 'var offset=(header?header.offsetHeight:0)+16;'
    . 'var top=el.getBoundingClientRect().top+window.pageYOffset-offset;'
    . 'window.scrollTo({top:Math.max(0,top),behavior:"smooth"});'
    . 'history.replaceState(null,"",el.id?"#"+el.id:"");}'
    . 'document.querySelectorAll(".rc-reflect-page .rc-tier-nav a[href^=\'#\']").forEach(function(link){'
    . 'link.addEventListener("click",function(ev){'
    . 'var id=link.getAttribute("href");if(!id||id.charAt(0)!=="#"){return;}'
    . 'var el=document.querySelector(id);if(!el){return;}'
    . 'ev.preventDefault();reflectScrollTo(el);});});'
    . 'var hash=window.location.hash;'
    . 'if(hash){var t=document.querySelector(hash);if(t){setTimeout(function(){reflectScrollTo(t);},120);}}'
    . '})();</script></div>';