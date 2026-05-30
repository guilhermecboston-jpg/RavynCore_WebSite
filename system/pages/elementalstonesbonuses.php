<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = "Elemental's Stones Bonuses";

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
    ['from' => 0, 'to' => 1, 'gold' => '2kk', 'stone_qty' => 3, 'dust_qty' => 1, 'chance' => 90],
    ['from' => 1, 'to' => 2, 'gold' => '5kk', 'stone_qty' => 3, 'dust_qty' => 2, 'chance' => 80],
    ['from' => 2, 'to' => 3, 'gold' => '10kk', 'stone_qty' => 3, 'dust_qty' => 3, 'chance' => 55],
    ['from' => 3, 'to' => 4, 'gold' => '20kk', 'stone_qty' => 3, 'dust_qty' => 4, 'chance' => 45],
    ['from' => 4, 'to' => 5, 'gold' => '40kk', 'stone_qty' => 3, 'dust_qty' => 5, 'chance' => 35],
    ['from' => 5, 'to' => 6, 'gold' => '75kk', 'stone_qty' => 3, 'dust_qty' => 6, 'chance' => 30],
    ['from' => 6, 'to' => 7, 'gold' => '200kk', 'stone_qty' => 3, 'dust_qty' => 7, 'chance' => 25],
    ['from' => 7, 'to' => 8, 'gold' => '600kk', 'stone_qty' => 3, 'dust_qty' => 8, 'chance' => 20],
    ['from' => 8, 'to' => 9, 'gold' => '800kk', 'stone_qty' => 3, 'dust_qty' => 9, 'chance' => 15],
];

$transformRows = [
    ['lesser' => 1, 'greater' => 1, 'dust' => 1],
    ['lesser' => 5, 'greater' => 5, 'dust' => 5],
    ['lesser' => 10, 'greater' => 10, 'dust' => 10],
];

$lesserFragmentId = 46625;
$greaterFragmentId = 46626;

if (!function_exists('esb_percent_value')) {
    function esb_percent_value($value)
    {
        return number_format((float)$value, 2, '.', '') . '%';
    }
}

if (!function_exists('esb_img_src')) {
    function esb_img_src($relPath)
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

if (!function_exists('esb_wiki_img_path')) {
    function esb_wiki_img_path($itemId)
    {
        $itemId = (int)$itemId;
        if ($itemId <= 0) {
            return '';
        }
        $candidates = [
            'imagens/creaturestibiawiki/' . $itemId . '.gif',
            'images/creaturetibiawiki/' . $itemId . '.gif',
        ];
        foreach ($candidates as $path) {
            if (file_exists(BASE . $path)) {
                return $path;
            }
        }
        return $candidates[0];
    }
}

if (!function_exists('esb_item_image')) {
    function esb_item_image($id, $tooltip = '')
    {
        $id = (int)$id;
        if ($id <= 0) {
            return '';
        }
        $tooltip = trim((string)$tooltip);
        $safeTooltip = htmlspecialchars($tooltip, ENT_QUOTES, 'UTF-8');
        $titleAttr = $safeTooltip !== '' ? ' title="' . $safeTooltip . '"' : '';

        $wikiPath = esb_wiki_img_path($id);
        if ($wikiPath !== '' && file_exists(BASE . $wikiPath)) {
            return '<img class="item_image esb-wiki-img" src="' . htmlspecialchars(esb_img_src($wikiPath), ENT_QUOTES, 'UTF-8') . '" width="32" height="32" alt=""' . $titleAttr . ' loading="lazy">';
        }

        $path = 'images/items/' . $id . '.gif';
        if (file_exists(BASE . $path)) {
            return '<img class="item_image esb-wiki-img" src="' . htmlspecialchars(esb_img_src($path), ENT_QUOTES, 'UTF-8') . '" width="32" height="32" alt=""' . $titleAttr . ' loading="lazy">';
        }

        $html = getItemImage($id);
        if ($tooltip === '') {
            return $html;
        }

        if (strpos($html, 'class="item_image"') !== false) {
            if (strpos($html, 'title="') !== false) {
                return preg_replace('/title="[^"]*"/', 'title="' . $safeTooltip . '"', $html, 1);
            }

            return str_replace('class="item_image"', 'class="item_image" title="' . $safeTooltip . '"', $html);
        }

        if (strpos($html, '<img ') !== false) {
            return preg_replace('/<img\s+/', '<img class="item_image" title="' . $safeTooltip . '" ', $html, 1);
        }

        return $html;
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
            case 'momentum':
            case 'critical_damage':
                return esb_percent_value($basePercent * 2);
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

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-level-col {
    min-width: 420px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-cost-col {
    min-width: 350px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-step {
    display: inline-block;
    margin-bottom: 8px;
    color: #f0c982;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-pairs {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-pair {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid rgba(150, 172, 216, 0.22);
    border-radius: 8px;
    background: rgba(10, 18, 33, 0.68);
    padding: 4px 6px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-item {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-arrow {
    color: #f0c982;
    font-size: 14px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-fusion-id {
    color: #a9bfe3;
    font-size: 11px;
    font-weight: 700;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-inline {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
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

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-cost-plus {
    color: #f0c982;
    font-weight: 800;
    font-size: 14px;
}

body.rc-page-elementalstonesbonuses .rc-rich-content .esb-center {
    text-align: center;
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

<div class="esb-page">
    <section class="esb-section">
        <h2 class="esb-title">Elemental Stones Bonuses</h2>
        <div class="esb-body">
            <p class="esb-text">Catalogo de stones por nivel.</p>
            <table class="esb-table">
                <thead>
                <tr>
                    <th class="esb-element-col">Element</th>
                    <th class="esb-stone-col">Level 0</th>
                    <th class="esb-stone-col">Level 1</th>
                    <th class="esb-stone-col">Level 2</th>
                    <th class="esb-stone-col">Level 3</th>
                    <th class="esb-stone-col">Level 4</th>
                    <th class="esb-stone-col">Level 5</th>
                    <th class="esb-stone-col">Level 6</th>
                    <th class="esb-stone-col">Level 7</th>
                    <th class="esb-stone-col">Level 8</th>
                    <th class="esb-stone-col">Level 9</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($stoneLevels as $color => $levels) {
                    $meta = $colorMeta[$color];
                ?>
                    <tr>
                        <td class="esb-element-cell">
                            <span class="esb-element-label">
                                <?= htmlspecialchars($meta['element'], ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </td>
                        <?php for ($level = 0; $level <= 9; $level++) {
                            $itemId = (int)$levels[$level];
                        ?>
                            <td class="esb-stone-cell">
                                <span class="esb-item-cell">
                                    <?= esb_item_image($itemId, $meta['element'] . ' Stone - Nivel ' . $level) ?>
                                </span>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="esb-section">
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
            <p class="esb-note"><strong>Nota:</strong> estes valores percentuais sao apresentados na pre-visualizacao da pagina e podem ser ajustados a qualquer momento para corresponder ao script final do servidor.</p>
            <ul class="esb-rules">
                <li>Cada personagem possui 1 slot gratuito para: Arma, Armadura, Capacete e Shield.</li>
                <li>Contas VIP Account desbloqueiam automaticamente +1 slot adicional por equipamento, totalizando 2 slots por equipamento.</li>
                <li>Para liberar 3 slots permanentes no personagem, adquira na Store: Unlocked Stones Sloots.</li>
                <li>Para obter a primeira Stone nivel 1, drope em Soul War, Gnomprona, Rotten Blood, Livrarias, Epic Hunts, ou compre na Store uma Stone Bag nivel 1, Stone Bag nivel 2, Stone Bag nivel 3.</li>
                <li>Algumas evolucoes possuem chance de falha; se falhar, o custo e perdido e as Stones permanecem no mesmo nivel.</li>
            </ul>
        </div>
    </section>

    <section class="esb-section">
        <h2 class="esb-title">Stone Evolution (Fusion)</h2>
        <div class="esb-body">
            <p class="esb-text">Custos e probabilidade de sucesso na evolucao de pedras.</p>
            <table class="esb-table">
                <thead>
                <tr>
                    <th class="esb-fusion-level-col">Nivel</th>
                    <th class="esb-fusion-cost-col">Custo</th>
                    <th class="esb-center">Chance</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fusionSteps as $step) { ?>
                    <tr>
                        <td>
                            <span class="esb-fusion-step"><strong><?= (int)$step['from'] ?> -> <?= (int)$step['to'] ?></strong></span>
                            <div class="esb-fusion-pairs">
                                <?php foreach ($colorMeta as $stoneColor => $meta) {
                                    $fromItemId = (int)$stoneLevels[$stoneColor][(int)$step['from']];
                                    $toItemId = (int)$stoneLevels[$stoneColor][(int)$step['to']];
                                    $fromName = getItemNameById($fromItemId);
                                    $toName = getItemNameById($toItemId);
                                    $fromTitle = !empty($fromName) ? $fromName : ($meta['element'] . ' Stone');
                                    $toTitle = !empty($toName) ? $toName : ($meta['element'] . ' Stone');
                                ?>
                                    <span class="esb-fusion-pair">
                                        <span class="esb-fusion-item">
                                            <?= esb_item_image($fromItemId, $fromTitle . ' - Nivel ' . (int)$step['from']) ?>
                                        </span>
                                        <span class="esb-fusion-arrow">&rarr;</span>
                                        <span class="esb-fusion-item">
                                            <?= esb_item_image($toItemId, $toTitle . ' - Nivel ' . (int)$step['to']) ?>
                                        </span>
                                    </span>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <?php
                            $fromIds = [];
                            foreach (array_keys($colorMeta) as $stoneColor) {
                                $fromIds[] = (int)$stoneLevels[$stoneColor][(int)$step['from']];
                            }
                            $fromPreviewId = (int)$fromIds[0];
                            ?>
                            <div class="esb-cost-inline">
                                <span class="esb-cost-item">
                                    <?= esb_item_image(3043, 'Crystal Coin') ?>
                                    <span class="esb-cost-meta">
                                        <strong><?= htmlspecialchars($step['gold'], ENT_QUOTES, 'UTF-8') ?></strong>
                                    </span>
                                </span>
                                <span class="esb-cost-plus">+</span>
                                <span class="esb-cost-item">
                                    <?= esb_item_image($fromPreviewId, 'Stone do nivel ' . (int)$step['from']) ?>
                                    <span class="esb-cost-meta">
                                        <strong>x<?= (int)$step['stone_qty'] ?></strong>
                                    </span>
                                </span>
                                <span class="esb-cost-plus">+</span>
                                <span class="esb-cost-item">
                                    <?= esb_item_image(60581, 'Stone Dust') ?>
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
    </section>

    <section class="esb-section" id="rc-esb-conversion">
        <h2 class="esb-title">Conversion</h2>
        <div class="esb-body">
            <p class="esb-text">Na Stone Forge, converta <strong>Lesser Fragment</strong> + <strong>Greater Fragment</strong> em <strong>Stone Fusion Dust</strong> (60581). Não utiliza gold (kk).</p>
            <table class="esb-table">
                <thead>
                <tr>
                    <th>Input</th>
                    <th>Output</th>
                    <th>Chance</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($transformRows as $row) { ?>
                    <tr>
                        <td>
                            <div class="esb-cost-inline">
                                <span class="esb-cost-item">
                                    <?= esb_item_image($lesserFragmentId, 'Lesser Fragment') ?>
                                    <span class="esb-cost-meta">
                                        <strong>x<?= (int)$row['lesser'] ?></strong>
                                    </span>
                                </span>
                                <span class="esb-cost-plus">+</span>
                                <span class="esb-cost-item">
                                    <?= esb_item_image($greaterFragmentId, 'Greater Fragment') ?>
                                    <span class="esb-cost-meta">
                                        <strong>x<?= (int)$row['greater'] ?></strong>
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="esb-cost-inline">
                                <span class="esb-cost-item">
                                    <?= esb_item_image(60581, 'Stone Fusion Dust') ?>
                                    <span class="esb-cost-meta">
                                        <strong>x<?= (int)$row['dust'] ?></strong>
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td><strong>100%</strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <p class="esb-note"><strong>Fluxo:</strong> o Stone Fusion Dust é gerado na conversão e enviado direto para o <strong>Store Inbox</strong>.</p>
        </div>
    </section>

</div>

<script>
(function() {
    if (window.Tipped && typeof window.Tipped.create === 'function') {
        window.Tipped.create('.item_image');
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
