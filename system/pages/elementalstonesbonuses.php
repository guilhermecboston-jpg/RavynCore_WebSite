<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Elemental Stones';

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
$rcEsbImagePath = $rcTemplatePath . '/images/elemental_stones';

$stoneLevels = [
    'Blue' => [0 => 61826, 1 => 61833, 2 => 61840, 3 => 61772, 4 => 61777, 5 => 61783, 6 => 61789, 7 => 61795, 8 => 61801, 9 => 61807],
    'Red' => [0 => 61829, 1 => 61836, 2 => 61843, 3 => 61767, 4 => 61773, 5 => 61779, 6 => 61785, 7 => 61791, 8 => 61797, 9 => 61803],
    'Black' => [0 => 61832, 1 => 61839, 2 => 61846, 3 => 61809, 4 => 61810, 5 => 61811, 6 => 61812, 7 => 61813, 8 => 61814, 9 => 61815],
    'Purple' => [0 => 61828, 1 => 61835, 2 => 61842, 3 => 61769, 4 => 61775, 5 => 61781, 6 => 61787, 7 => 61793, 8 => 61799, 9 => 61805],
    'Green' => [0 => 61827, 1 => 61834, 2 => 61841, 3 => 61768, 4 => 61774, 5 => 61780, 6 => 61786, 7 => 61792, 8 => 61798, 9 => 61804],
    'Yellow' => [0 => 61831, 1 => 61838, 2 => 61845, 3 => 61771, 4 => 61778, 5 => 61784, 6 => 61790, 7 => 61796, 8 => 61802, 9 => 61806],
    'White' => [0 => 61830, 1 => 61837, 2 => 61844, 3 => 61770, 4 => 61776, 5 => 61782, 6 => 61788, 7 => 61794, 8 => 61800, 9 => 61808],
];

$colorMeta = [
    'Blue' => ['element' => 'Ice', 'hex' => '#3a74ff'],
    'Red' => ['element' => 'Fire', 'hex' => '#f04444'],
    'Black' => ['element' => 'Death', 'hex' => '#6e7582'],
    'Purple' => ['element' => 'Energy', 'hex' => '#8b4dff'],
    'Green' => ['element' => 'Earth', 'hex' => '#26b54c'],
    'Yellow' => ['element' => 'Holy', 'hex' => '#d3b21a'],
    'White' => ['element' => 'Physical', 'hex' => '#d3d9e0'],
];

$damageRows = [
    ['label' => 'Death Extra Damage', 'color' => 'Black'],
    ['label' => 'Energy Extra Damage', 'color' => 'Purple'],
    ['label' => 'Fire Extra Damage', 'color' => 'Red'],
    ['label' => 'Physical Extra Damage', 'color' => 'White'],
    ['label' => 'Holy Extra Damage', 'color' => 'Yellow'],
    ['label' => 'Earth Extra Damage', 'color' => 'Green'],
    ['label' => 'Ice Extra Damage', 'color' => 'Blue'],
];

$protectionRows = [
    ['label' => 'Death Protection', 'color' => 'Black'],
    ['label' => 'Energy Protection', 'color' => 'Purple'],
    ['label' => 'Fire Protection', 'color' => 'Red'],
    ['label' => 'Physical Protection', 'color' => 'White'],
    ['label' => 'Holy Protection', 'color' => 'Yellow'],
    ['label' => 'Earth Protection', 'color' => 'Green'],
    ['label' => 'Ice Protection', 'color' => 'Blue'],
];

$increaseRows = [
    ['label' => 'Skill', 'color' => 'Black', 'key' => 'skill'],
    ['label' => 'Momentum', 'color' => 'Purple', 'key' => 'momentum'],
    ['label' => 'Ruse', 'color' => 'Red', 'key' => 'ruse'],
    ['label' => 'Critical Damage', 'color' => 'White', 'key' => 'critical_damage'],
    ['label' => 'Onslaught', 'color' => 'Yellow', 'key' => 'onslaught'],
    ['label' => 'Critical Chance', 'color' => 'Green', 'key' => 'critical_chance'],
    ['label' => 'Transcendence', 'color' => 'Blue', 'key' => 'transcendence'],
];

$fusionSteps = [
    ['from' => 0, 'to' => 1, 'gold' => '15kk', 'stone_qty' => 3, 'dust_qty' => 2, 'chance' => 90],
    ['from' => 1, 'to' => 2, 'gold' => '35kk', 'stone_qty' => 3, 'dust_qty' => 3, 'chance' => 80],
    ['from' => 2, 'to' => 3, 'gold' => '85kk', 'stone_qty' => 3, 'dust_qty' => 4, 'chance' => 65],
    ['from' => 3, 'to' => 4, 'gold' => '150kk', 'stone_qty' => 3, 'dust_qty' => 5, 'chance' => 50],
    ['from' => 4, 'to' => 5, 'gold' => '250kk', 'stone_qty' => 3, 'dust_qty' => 6, 'chance' => 45],
    ['from' => 5, 'to' => 6, 'gold' => '400kk', 'stone_qty' => 3, 'dust_qty' => 7, 'chance' => 35],
    ['from' => 6, 'to' => 7, 'gold' => '500kk', 'stone_qty' => 3, 'dust_qty' => 8, 'chance' => 25],
    ['from' => 7, 'to' => 8, 'gold' => '600kk', 'stone_qty' => 3, 'dust_qty' => 9, 'chance' => 15],
    ['from' => 8, 'to' => 9, 'gold' => '800kk', 'stone_qty' => 3, 'dust_qty' => 10, 'chance' => 10],
];

$fusionDemoColor = 'Blue';

if (!function_exists('esb_percent_value')) {
    function esb_percent_value($value)
    {
        return number_format((float)$value, 2, '.', '') . '%';
    }
}

if (!function_exists('esb_item_image')) {
    function esb_item_image($id, $tooltip = '')
    {
        $id = (int)$id;
        $tooltipText = trim((string)$tooltip);
        if ($tooltipText === '' && function_exists('getItemNameById')) {
            $tooltipText = (string)getItemNameById($id);
        }

        return rc_wiki_item_image($id, [
            'class' => 'item_image esb-wiki-img',
            'label' => $tooltipText,
        ]);
    }
}

if (!function_exists('esb_flow_arrow')) {
    function esb_flow_arrow()
    {
        return '<span class="esb-flow-arrow" aria-hidden="true">'
            . '<svg viewBox="0 0 24 24" width="22" height="22" focusable="false">'
            . '<path d="M5 12h11M14 8l4 4-4 4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
            . '</svg></span>';
    }
}

if (!function_exists('esb_guide_image')) {
    function esb_guide_image($fileName, $alt, $class = 'rc-esb-guide-img')
    {
        global $rcEsbImagePath;

        $relPath = rtrim(ltrim(str_replace('\\', '/', (string)$rcEsbImagePath), '/'), '/')
            . '/' . ltrim((string)$fileName, '/');
        $exists = function_exists('rc_wiki_item_path_exists')
            ? rc_wiki_item_path_exists($relPath)
            : (defined('BASE') && is_readable(BASE . ltrim($relPath, '/')));

        if (!$exists) {
            return '';
        }

        return '<img class="' . htmlspecialchars((string)$class, ENT_QUOTES, 'UTF-8') . '" src="'
            . htmlspecialchars($relPath, ENT_QUOTES, 'UTF-8') . '" alt="'
            . htmlspecialchars((string)$alt, ENT_QUOTES, 'UTF-8') . '" loading="lazy">';
    }
}

if (!function_exists('esb_level_percent')) {
    function esb_level_percent($level)
    {
        static $values = [
            0 => 1.00,
            1 => 1.40,
            2 => 2.00,
            3 => 2.75,
            4 => 4.00,
            5 => 6.00,
            6 => 10.00,
            7 => 16.00,
            8 => 20.00,
            9 => 28.00,
        ];

        $level = (int)$level;
        return isset($values[$level]) ? (float)$values[$level] : 0.0;
    }
}

if (!function_exists('esb_increase_value')) {
    function esb_increase_value($key, $level)
    {
        $level = (int)$level;
        $basePercent = esb_level_percent($level);
        switch ($key) {
            case 'skill':
                $skillIncrease = [
                    0 => 1,
                    1 => 2,
                    2 => 4,
                    3 => 6,
                    4 => 8,
                    5 => 10,
                    6 => 12,
                    7 => 16,
                    8 => 20,
                    9 => 28,
                ];

                return '+' . (int)($skillIncrease[$level] ?? 0);
            default:
                return esb_percent_value($basePercent);
        }
    }
}
?>
<script type="text/javascript" src="tools/js/tipped.js"></script>
<link rel="stylesheet" type="text/css" href="tools/css/tipped.css"/>
<style>
body.rc-page-elementalstonesbonuses .rc-panel-content > h3 {
    display: none;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-page {
    max-width: 1260px;
    margin: 0 auto;
    display: grid;
    gap: 14px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-section {
    border: 1px solid rgba(194, 157, 99, 0.7);
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(13, 21, 36, 0.92) 0%, rgba(9, 15, 27, 0.96) 100%);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05), 0 12px 26px rgba(0, 0, 0, 0.35);
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-title {
    margin: 0;
    padding: 10px 14px;
    color: #f0c982;
    font-family: var(--rc-font-title), Verdana, Arial, Helvetica, sans-serif;
    font-size: 23px;
    font-weight: 800;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    background: linear-gradient(180deg, rgba(44, 79, 126, 0.96) 0%, rgba(32, 63, 103, 0.96) 100%);
    border-bottom: 1px solid rgba(194, 157, 99, 0.58);
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-body {
    padding: 14px;
    background: rgba(15, 24, 40, 0.8);
    display: grid;
    gap: 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-subtitle {
    margin: 0;
    color: #f0c982;
    font-size: 16px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-text {
    margin: 0;
    color: #d6e4ff;
    font-size: 13px;
    line-height: 1.45;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-chip-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid rgba(163, 186, 231, 0.3);
    border-radius: 999px;
    background: rgba(14, 27, 45, 0.84);
    color: #d8e6ff;
    padding: 5px 10px;
    font-size: 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid rgba(150, 172, 216, 0.32);
    background: rgba(15, 24, 40, 0.7);
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-table th,
body.rc-page-elementalstonesbonuses .rc-rich-content .esb-table td {
    border: 1px solid rgba(150, 172, 216, 0.22);
    padding: 8px 10px;
    text-align: left;
    vertical-align: middle;
    color: #dce8ff;
    font-size: 13px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-table thead th {
    color: #f0c982;
    font-weight: 700;
    background: rgba(18, 29, 47, 0.95);
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-element-label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-item-cell {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
    min-width: 52px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-item-id {
    color: #9eb3d6;
    font-size: 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-item-qty {
    color: #f0c982;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.1;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-item-code {
    color: #95a9cb;
    font-size: 11px;
    line-height: 1.1;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-element-col,
body.rc-page-elementalstonesbonuses .rc-rich-content .esb-element-cell {
    text-align: center;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-stone-col,
body.rc-page-elementalstonesbonuses .rc-rich-content .esb-stone-cell {
    text-align: center;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-box {
    border: 1px solid rgba(91, 124, 183, 0.45);
    border-radius: 10px;
    background: rgba(8, 16, 31, 0.65);
    overflow: hidden;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-head {
    padding: 10px 12px;
    border-bottom: 1px solid rgba(150, 172, 216, 0.25);
    color: #f0c982;
    font-size: 14px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding: 10px 12px 0;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-btn {
    border: 1px solid rgba(132, 154, 198, 0.36);
    border-radius: 10px;
    background: rgba(17, 29, 49, 0.96);
    color: #d6e4ff;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    padding: 8px 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-btn.is-active {
    border-color: rgba(232, 189, 104, 0.9);
    color: #f0c982;
    background: linear-gradient(180deg, rgba(49, 78, 118, 0.95) 0%, rgba(29, 56, 93, 0.95) 100%);
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-table-wrap {
    padding: 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-table-wrap[data-level-table] {
    display: none;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-level-table-wrap.is-active {
    display: block;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-attr-cell {
    display: flex;
    align-items: center;
    gap: 8px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-note {
    margin: 0;
    padding: 10px 12px;
    border: 1px solid rgba(150, 172, 216, 0.24);
    border-radius: 8px;
    background: rgba(19, 31, 51, 0.72);
    color: #d0def8;
    font-size: 13px;
    line-height: 1.45;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-note strong {
    color: #f0c982;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-rules {
    margin: 0;
    padding-left: 20px;
    color: #d0def8;
    font-size: 13px;
    line-height: 1.5;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-rules li {
    margin-bottom: 5px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-rules strong {
    color: #f0c982;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-compact-table-wrap {
    max-width: 760px;
    margin: 0 auto;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-compact-table-wrap .esb-table {
    width: 100%;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-compact-table-wrap .esb-table th,
body.rc-page-elementalstonesbonuses .rc-rich-content .esb-compact-table-wrap .esb-table td {
    text-align: center;
    vertical-align: middle;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-table-wrap {
    max-width: 100%;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-level-col {
    width: 30%;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-cost-col {
    width: 58%;
    min-width: 340px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-evolution {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: nowrap;
    padding: 6px 8px;
    border: 1px solid rgba(150, 172, 216, 0.22);
    border-radius: 10px;
    background: rgba(10, 18, 33, 0.68);
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-flow-arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    color: #f2c16b;
    filter: drop-shadow(0 0 6px rgba(242, 193, 107, 0.35));
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-flow-arrow svg {
    display: block;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-id {
    color: #a9bfe3;
    font-size: 11px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-inline {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    gap: 10px;
    justify-content: center;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border: 1px solid rgba(150, 172, 216, 0.25);
    border-radius: 8px;
    background: rgba(10, 18, 33, 0.72);
    padding: 4px 7px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-meta {
    display: inline-flex;
    flex-direction: column;
    gap: 1px;
    line-height: 1.1;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-meta strong {
    color: #f0c982;
    font-size: 12px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-meta span {
    color: #9db3d7;
    font-size: 11px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-center {
    text-align: center;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .rc-esb-page {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

body.rc-page-elementalstonesbonuses .rc-esb-nav-below {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0 0 4px;
}

body.rc-page-elementalstonesbonuses .rc-esb-nav a {
    text-decoration: none;
    padding: 7px 12px;
    border-radius: 8px;
    border: 1px solid rgba(122, 154, 210, 0.42);
    background: rgba(11, 23, 41, 0.75);
    color: #e8efff;
    font-size: 13px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-esb-nav a:hover {
    border-color: rgba(242, 193, 107, 0.55);
    color: #f2c16b;
}

body.rc-page-elementalstonesbonuses .rc-esb-anchor {
    scroll-margin-top: 140px;
}

body.rc-page-elementalstonesbonuses .rc-st-card h3 {
    margin: 0 0 12px;
    color: #efd39b;
    font-size: 27px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-st-card > p,
body.rc-page-elementalstonesbonuses .rc-st-card .rc-st-notes li {
    color: #d4deef;
    font-size: 17px;
    line-height: 1.65;
}

body.rc-page-elementalstonesbonuses .rc-st-card strong,
body.rc-page-elementalstonesbonuses .rc-esb-highlight {
    color: #f2c16b;
}

body.rc-page-elementalstonesbonuses .rc-esb-figure-duo {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin: 16px 0 0;
    padding: 14px;
    border-radius: 10px;
    border: 1px solid rgba(120, 168, 236, 0.35);
    background: rgba(10, 18, 33, 0.55);
}

body.rc-page-elementalstonesbonuses .rc-esb-guide-img {
    max-width: min(100%, 280px);
    height: auto;
    border-radius: 8px;
    border: 1px solid rgba(120, 168, 236, 0.3);
}

body.rc-page-elementalstonesbonuses .rc-esb-guide-img--wide {
    max-width: min(100%, 900px);
    display: block;
    margin: 14px auto 0;
}

body.rc-page-elementalstonesbonuses .rc-esb-figure-caption {
    flex: 1 1 100%;
    margin: 0;
    text-align: center;
    color: #b8c8e4;
    font-size: 14px;
}

body.rc-page-elementalstonesbonuses .esb-catalog-list {
    display: grid;
    gap: 10px;
}

body.rc-page-elementalstonesbonuses .esb-element-details {
    border: 1px solid rgba(104, 150, 225, 0.32);
    border-radius: 10px;
    background: rgba(9, 18, 34, 0.72);
    overflow: hidden;
}

body.rc-page-elementalstonesbonuses .esb-element-details[open] {
    border-color: rgba(242, 193, 107, 0.45);
}

body.rc-page-elementalstonesbonuses .esb-element-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 14px;
    cursor: pointer;
    list-style: none;
    color: #e8efff;
    font-weight: 700;
    font-size: 16px;
}

body.rc-page-elementalstonesbonuses .esb-element-summary::-webkit-details-marker {
    display: none;
}

body.rc-page-elementalstonesbonuses .esb-element-summary-left {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

body.rc-page-elementalstonesbonuses .esb-element-name {
    font-size: 17px;
    font-weight: 700;
    color: #f2e8d4;
    min-width: 72px;
}

body.rc-page-elementalstonesbonuses .esb-element-stone {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

body.rc-page-elementalstonesbonuses .esb-element-toggle {
    color: #f2c16b;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
}

body.rc-page-elementalstonesbonuses .esb-stone-level-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 10px;
    padding: 12px 14px 14px;
    border-top: 1px solid rgba(104, 150, 225, 0.22);
}

body.rc-page-elementalstonesbonuses .esb-stone-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 10px 8px;
    border-radius: 8px;
    border: 1px solid rgba(120, 168, 236, 0.25);
    background: rgba(8, 16, 31, 0.65);
}

body.rc-page-elementalstonesbonuses .esb-stone-tile-label {
    color: #c5d6f5;
    font-size: 12px;
    font-weight: 700;
    text-align: center;
}

body.rc-page-elementalstonesbonuses .tpd-skin-dark .tpd-content,
body.rc-page-elementalstonesbonuses .tpd-skin-dark .tpd-title {
    font-size: 12px;
    line-height: 1.4;
}

body.rc-page-elementalstonesbonuses .tpd-skin-dark .tpd-background-content {
    background: linear-gradient(160deg, rgba(18, 32, 54, 0.98), rgba(10, 18, 33, 0.98));
    border: 1px solid rgba(242, 193, 107, 0.45);
}

@media (max-width: 900px) {
    body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-cost-col {
        min-width: 0;
    }

    body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-inline {
        flex-wrap: wrap;
    }
}

@media (max-width: 900px) {
    body.rc-page-elementalstonesbonuses .esb-stone-level-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 1024px) {
    body.rc-page-elementalstonesbonuses .rc-rich-content .esb-grid-3 {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 900px) {
    body.rc-page-elementalstonesbonuses .rc-rich-content .esb-table {
        display: block;
        overflow-x: auto;
    }
}
</style>

<div class="esb-page rc-st-page rc-esb-page">
    <header class="rc-st-page-title"><h2>Elemental Stones</h2></header>
    <nav class="rc-esb-nav rc-esb-nav-below" aria-label="Seções do guia">
        <a href="#rc-esb-sobre">Sobre</a>
        <a href="#rc-esb-percent">Bônus</a>
        <a href="#rc-esb-catalog">Catálogo</a>
        <a href="#rc-esb-fusion">Fusão</a>
        <a href="#rc-esb-conversion">Conversão</a>
    </nav>

    <section class="rc-st-card rc-esb-anchor" id="rc-esb-sobre">
        <h3>Sobre</h3>
        <p>As <strong>Elemental Stones</strong> permitem que o jogador personalize e fortaleça seu personagem com poderes elementais, oferecendo bônus de dano, defesa e outros aprimoramentos.</p>
        <ul class="rc-st-notes">
            <li>Elas podem ser utilizadas na <strong>Jewelled Pouch</strong>, que fica em sua <strong>Store Inbox</strong>. Ao pressionar <strong>Ctrl + clique direito</strong>, abre o <strong>Craft Stones</strong>, possibilitando crafting em qualquer lugar do mapa.</li>
            <li>Quanto maior o nível da Elemental Stone, mais poderosos se tornam seus bônus, podendo realizar troca das stones em qualquer lugar do mapa — tornando esse sistema uma parte essencial da evolução do seu personagem. O nível máximo de uma Elemental Stone é <strong>9</strong>.</li>
        </ul>
        <figure class="rc-esb-figure-duo">
            <?= esb_guide_image('jewelled-pouch.png', 'Jewelled Pouch', 'rc-esb-guide-img') ?>
            <?= esb_guide_image('clickdireito.png', 'Ctrl + clique direito', 'rc-esb-guide-img') ?>
            <figcaption class="rc-esb-figure-caption">Jewelled Pouch na Store Inbox — use <strong>Ctrl + clique direito</strong> para abrir o Craft Stones.</figcaption>
        </figure>
    </section>

    <section class="esb-section rc-esb-anchor" id="rc-esb-percent">
        <h2 class="esb-title">Percentages - Stones by Level</h2>
        <div class="esb-body">
            <p class="esb-text">Selecione um nivel de pedra para visualizar os bonus com 1 pedra equipada.</p>

            <div class="esb-grid-3">
                <?php
                $groupDefinitions = [
                    'damage' => ['title' => 'Percentages - Weapons (Extra Damage)', 'rows' => $damageRows],
                    'protection' => ['title' => 'Percentages - Armors (Protection)', 'rows' => $protectionRows],
                    'increase' => ['title' => 'Percentages - Helmets (Increase)', 'rows' => $increaseRows],
                ];

                foreach ($groupDefinitions as $groupKey => $group) {
                ?>
                    <article class="esb-level-box">
                        <header class="esb-level-head"><?= htmlspecialchars($group['title'], ENT_QUOTES, 'UTF-8') ?></header>
                        <div class="esb-level-tabs" data-level-tabs="<?= htmlspecialchars($groupKey, ENT_QUOTES, 'UTF-8') ?>">
                            <?php for ($level = 0; $level <= 9; $level++) { ?>
                                <button type="button" class="esb-level-btn<?= $level === 0 ? ' is-active' : '' ?>" data-level-btn="<?= htmlspecialchars($groupKey, ENT_QUOTES, 'UTF-8') ?>" data-level="<?= $level ?>">
                                    Nivel <?= $level ?>
                                </button>
                            <?php } ?>
                        </div>

                        <?php for ($level = 0; $level <= 9; $level++) { ?>
                            <div class="esb-level-table-wrap<?= $level === 0 ? ' is-active' : '' ?>" data-level-table="<?= htmlspecialchars($groupKey, ENT_QUOTES, 'UTF-8') ?>" data-level="<?= $level ?>">
                                <table class="esb-table">
                                    <thead>
                                    <tr>
                                        <th>Atributo</th>
                                        <th style="width: 120px;">1 Stone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($group['rows'] as $row) {
                                        $itemId = (int)$stoneLevels[$row['color']][$level];
                                        $value = '';
                                        if ($groupKey === 'increase') {
                                            $value = esb_increase_value($row['key'], $level);
                                        } else {
                                            $value = esb_percent_value(esb_level_percent($level));
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="esb-attr-cell">
                                                    <?= esb_item_image($itemId, $row['label'] . ' - Nivel ' . $level) ?>
                                                    <span><?= htmlspecialchars($row['label'], ENT_QUOTES, 'UTF-8') ?></span>
                                                </div>
                                            </td>
                                            <td><strong><?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?></strong></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </article>
                <?php } ?>
            </div>
            <p class="esb-note"><strong>Nota:</strong> estes valores percentuais são apresentados na pré-visualização da página e podem ser ajustados a qualquer momento para corresponder ao script final do servidor.</p>
            <ul class="esb-rules">
                <li>Cada personagem possui 1 slot gratuito para: <strong>Arma</strong>, <strong>Armadura</strong>, <strong>Capacete</strong>.</li>
                <li>Contas <strong>VIP Account</strong> desbloqueiam automaticamente +1 slot adicional por equipamento, totalizando 2 slots por equipamento.</li>
                <li>Para liberar 3 slots permanentes no personagem, adquira na Store: <strong>Unlocked Stones Sloots</strong>.</li>
                <li>Possível obter <strong>Bag of Stones</strong> 0, 1, 2, 3 a partir de bosses, hunt medium, hard, epic e na <strong>Game Store</strong>.</li>
                <li>Algumas evoluções possuem chance de falha; se falhar, o custo é perdido e as Stones permanecem no mesmo nível.</li>
            </ul>
        </div>
    </section>

    <section class="rc-st-card rc-esb-anchor" id="rc-esb-catalog">
        <h3>Elemental Stones Bonuses</h3>
        <div class="esb-catalog-list">
            <?php foreach ($stoneLevels as $color => $levels) {
                $meta = $colorMeta[$color];
                $previewLow = (int)$levels[0];
            ?>
                <details class="esb-element-details">
                    <summary class="esb-element-summary">
                        <span class="esb-element-summary-left">
                            <span class="esb-element-name"><?= htmlspecialchars($meta['element'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="esb-element-stone">
                                <?= esb_item_image($previewLow, $meta['element'] . ' Stone - Nível 0') ?>
                            </span>
                        </span>
                        <span class="esb-element-toggle">Abrir / fechar</span>
                    </summary>
                    <div class="esb-stone-level-grid">
                        <?php for ($level = 0; $level <= 9; $level++) {
                            $itemId = (int)$levels[$level];
                        ?>
                            <div class="esb-stone-tile">
                                <?= esb_item_image($itemId, $meta['element'] . ' Stone - Nível ' . $level) ?>
                                <span class="esb-stone-tile-label">Nível <?= $level ?></span>
                            </div>
                        <?php } ?>
                    </div>
                </details>
            <?php } ?>
        </div>
    </section>

    <section class="esb-section rc-esb-anchor" id="rc-esb-fusion">
        <h2 class="esb-title">Stone Evolution (Fusion)</h2>
        <div class="esb-body">
            <?= esb_guide_image('stone-forge.png', 'Stone Forge', 'rc-esb-guide-img rc-esb-guide-img--wide') ?>
            <div class="esb-fusion-table-wrap">
            <table class="esb-table">
                <thead>
                <tr>
                    <th class="esb-fusion-level-col">Evolução</th>
                    <th class="esb-fusion-cost-col">Custo</th>
                    <th class="esb-center">Chance</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fusionSteps as $step) {
                    $fromItemId = (int)$stoneLevels[$fusionDemoColor][(int)$step['from']];
                    $toItemId = (int)$stoneLevels[$fusionDemoColor][(int)$step['to']];
                    $fromName = getItemNameById($fromItemId);
                    $toName = getItemNameById($toItemId);
                    $fromTitle = !empty($fromName) ? $fromName : ($colorMeta[$fusionDemoColor]['element'] . ' Stone');
                    $toTitle = !empty($toName) ? $toName : ($colorMeta[$fusionDemoColor]['element'] . ' Stone');
                    $fromPreviewId = $fromItemId;
                ?>
                    <tr>
                        <td>
                            <div class="esb-fusion-evolution">
                                <span class="esb-fusion-item">
                                    <?= esb_item_image($fromItemId, $fromTitle . ' - Nível ' . (int)$step['from']) ?>
                                </span>
                                <?= esb_flow_arrow() ?>
                                <span class="esb-fusion-item">
                                    <?= esb_item_image($toItemId, $toTitle . ' - Nível ' . (int)$step['to']) ?>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="esb-cost-inline">
                                <span class="esb-cost-item">
                                    <?= esb_item_image(3043, 'Crystal Coin') ?>
                                    <span class="esb-cost-meta">
                                        <strong><?= htmlspecialchars($step['gold'], ENT_QUOTES, 'UTF-8') ?></strong>
                                    </span>
                                </span>
                                <span class="esb-cost-item">
                                    <?= esb_item_image($fromPreviewId, $fromTitle . ' - Nível ' . (int)$step['from']) ?>
                                    <span class="esb-cost-meta">
                                        <strong>x<?= (int)$step['stone_qty'] ?></strong>
                                    </span>
                                </span>
                                <span class="esb-cost-item">
                                    <?= esb_item_image(60581, 'Stone Fusion Dust') ?>
                                    <span class="esb-cost-meta">
                                        <strong>x<?= (int)$step['dust_qty'] ?></strong>
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td class="esb-center"><strong><?= (int)$step['chance'] ?>%</strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </section>

    <section class="esb-section rc-esb-anchor" id="rc-esb-conversion">
        <h2 class="esb-title">Conversion</h2>
        <div class="esb-body">
            <p class="esb-text">Na Stone Forge, converta <strong>Lesser Fragment</strong> + <strong>Greater Fragment</strong> em <strong>Stone Fusion Dust</strong>.</p>
            <?= esb_guide_image('stone-convers.png', 'Stone Conversion', 'rc-esb-guide-img rc-esb-guide-img--wide') ?>
            <p class="esb-note"><strong>Fluxo:</strong> o Stone Fusion Dust é gerado na conversão e enviado direto para a <strong>Store Inbox</strong>.</p>
        </div>
    </section>

</div>

<script>
(function() {
    if (window.Tipped && typeof window.Tipped.create === 'function') {
        window.Tipped.create('.rc-esb-page .item_image', {
            skin: 'dark',
            size: 'medium',
            radius: { size: 6, position: 'border' },
            hideOn: false,
            showOn: { element: 'mouseenter' }
        });
    }

    function esbScrollTo(el) {
        if (!el) {
            return;
        }
        var header = document.querySelector('.rc-header');
        var offset = (header ? header.offsetHeight : 0) + 16;
        var top = el.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
        if (el.tagName === 'DETAILS') {
            el.open = true;
        }
    }

    document.querySelectorAll('.rc-esb-page a[href^="#"]').forEach(function(link) {
        link.addEventListener('click', function(ev) {
            var id = link.getAttribute('href');
            if (!id || id.charAt(0) !== '#') {
                return;
            }
            var target = document.querySelector(id);
            if (!target) {
                return;
            }
            ev.preventDefault();
            esbScrollTo(target);
        });
    });

    var hash = window.location.hash;
    if (hash) {
        var hashTarget = document.querySelector(hash);
        if (hashTarget) {
            setTimeout(function() {
                esbScrollTo(hashTarget);
            }, 120);
        }
    }

    function setupLevelTabs(groupKey) {
        var buttons = document.querySelectorAll('[data-level-btn="' + groupKey + '"]');
        var tables = document.querySelectorAll('[data-level-table="' + groupKey + '"]');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var level = button.getAttribute('data-level');

                buttons.forEach(function(btn) {
                    btn.classList.remove('is-active');
                });
                tables.forEach(function(table) {
                    table.classList.remove('is-active');
                });

                button.classList.add('is-active');
                var target = document.querySelector('[data-level-table="' + groupKey + '"][data-level="' + level + '"]');
                if (target) {
                    target.classList.add('is-active');
                }
            });
        });
    }

    ['damage', 'protection', 'increase'].forEach(setupLevelTabs);
})();
</script>
