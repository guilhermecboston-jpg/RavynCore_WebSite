<?php global $db, $config;
/**
 * Highscores
 *
 * @package   MyAAC
 * @author    Gesior <jerzyskalski@wp.pl>
 * @author    Slawkens <slawkens@gmail.com>
 * @copyright 2023 MyAAC
 */
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Highscores';

if ($config['account_country'] && $config['highscores_country_box']) {
    require SYSTEM . 'countries.conf.php';
}

define('SKILL_FRAGS', -1);
define('SKILL_BALANCE', -2);
define('SKILL_CUSTOM_COLUMN', -3);

$findFirstExistingColumn = static function (string $table, array $candidates) use ($db) {
    foreach ($candidates as $column) {
        if ($db->hasColumn($table, $column)) {
            return $column;
        }
    }

    return null;
};

$normalizeWorldType = static function ($value) {
    $raw = strtolower(trim((string)$value));
    if ($raw === '') {
        return null;
    }

    if (is_numeric($raw)) {
        $num = (int)$raw;
        if ($num === 1 || $num === 2) {
            return 'open';
        }

        if ($num === 3) {
            return 'optional';
        }

        if ($num >= 4) {
            return 'retro';
        }
    }

    if (strpos($raw, 'optional') !== false) {
        return 'optional';
    }

    if (strpos($raw, 'retro') !== false) {
        return 'retro';
    }

    if (strpos($raw, 'open') !== false || strpos($raw, 'pvp') !== false) {
        return 'open';
    }

    return null;
};

$formatRankingNumber = static function ($value) {
    return number_format((int)$value, 0, ',', '.');
};

$listRaw = strtolower(trim((string)($_GET['list'] ?? ($_GET['category'] ?? 'experience'))));
$vocationRaw = strtolower(trim((string)($_GET['vocation'] ?? ($_GET['profession'] ?? 'all'))));
$selectedWorld = isset($_GET['world']) && is_numeric($_GET['world']) ? (int)$_GET['world'] : 0;
$_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 0;
if ($_page < 0) {
    $_page = 0;
}

$selectedWorldTypes = [];
if (isset($_GET['world_type'])) {
    $worldTypes = is_array($_GET['world_type']) ? $_GET['world_type'] : [$_GET['world_type']];
    foreach ($worldTypes as $worldType) {
        $normalized = strtolower(trim((string)$worldType));
        if (in_array($normalized, ['open', 'optional', 'retro'], true) && !in_array($normalized, $selectedWorldTypes, true)) {
            $selectedWorldTypes[] = $normalized;
        }
    }
}

$categoryAliases = [
    '' => 'experience',
    'level' => 'experience',
    'experience' => 'experience',
    'magic' => 'magic',
    'magic level' => 'magic',
    'shield' => 'shielding',
    'shielding' => 'shielding',
    'distance' => 'distance',
    'dist' => 'distance',
    'sword' => 'sword',
    'axe' => 'axe',
    'club' => 'club',
    'fist' => 'fist',
    'fishing' => 'fishing',
    'frags' => 'frags',
    'balance' => 'balance',
    'achievement_points' => 'loyalty_points',
    'achievement points' => 'loyalty_points',
    'loyalty' => 'loyalty_points',
    'loyalty_points' => 'loyalty_points',
    'loyalty points' => 'loyalty_points',
];

$categoryDefinitions = [
    'experience' => ['label' => 'Experience', 'type' => 'experience'],
    'magic' => ['label' => 'Magic Level', 'type' => 'magic'],
    'shielding' => ['label' => 'Shielding', 'type' => 'skill', 'skill_id' => POT::SKILL_SHIELD],
    'distance' => ['label' => 'Distance', 'type' => 'skill', 'skill_id' => POT::SKILL_DIST],
    'sword' => ['label' => 'Sword', 'type' => 'skill', 'skill_id' => POT::SKILL_SWORD],
    'axe' => ['label' => 'Axe', 'type' => 'skill', 'skill_id' => POT::SKILL_AXE],
    'club' => ['label' => 'Club', 'type' => 'skill', 'skill_id' => POT::SKILL_CLUB],
    'fist' => ['label' => 'Fist', 'type' => 'skill', 'skill_id' => POT::SKILL_FIST],
    'fishing' => ['label' => 'Fishing', 'type' => 'skill', 'skill_id' => POT::SKILL_FISH],
    'drome_level' => ['label' => 'Drome Level', 'type' => 'column', 'column' => 'drome_level'],
    'linked_tasks' => ['label' => 'Linked Tasks', 'type' => 'column', 'column' => 'linked_tasks'],
    'exp_today' => ['label' => 'Exp Today', 'type' => 'column', 'column' => 'exp_today'],
    'loyalty_points' => ['label' => 'Loyalty Points', 'type' => 'account_loyalty'],
    'battle_pass_points' => ['label' => 'Battle Pass Points', 'type' => 'column', 'column' => 'battle_pass_points'],
    'charm_unlock_points' => ['label' => 'Charm Unlock Points', 'type' => 'column', 'column' => 'charm_unlock_points'],
    'prestige_points' => ['label' => 'Prestige Points', 'type' => 'column', 'column' => 'prestige_points'],
    'total_weekly_tasks' => ['label' => 'Total Weekly Tasks', 'type' => 'column', 'column' => 'total_weekly_tasks'],
    'total_bounty_points' => ['label' => 'Total Bounty Points', 'type' => 'column', 'column' => 'total_bounty_points'],
    'charm_total_points' => ['label' => 'Charm Total Points', 'type' => 'column', 'column' => 'charm_total_points'],
    'boss_total_points' => ['label' => 'Boss Total Points', 'type' => 'column', 'column' => 'boss_total_points'],
];

if (isset($categoryAliases[$listRaw])) {
    $listRaw = $categoryAliases[$listRaw];
}

if (!isset($categoryDefinitions[$listRaw])) {
    $listRaw = 'experience';
}

$activeCategory = $listRaw;
if (
    $categoryDefinitions[$activeCategory]['type'] === 'column' &&
    !$db->hasColumn('players', $categoryDefinitions[$activeCategory]['column'])
) {
    $activeCategory = 'experience';
}

$vocationDefinitions = [
    'all' => ['label' => 'All Vocations', 'ids' => []],
    'none' => ['label' => 'None', 'ids' => [0]],
    'sorcerers' => ['label' => 'Sorcerers', 'ids' => [1, 5]],
    'sorcerer' => ['label' => 'Sorcerers', 'ids' => [1, 5]],
    'druids' => ['label' => 'Druids', 'ids' => [2, 6]],
    'druid' => ['label' => 'Druids', 'ids' => [2, 6]],
    'paladins' => ['label' => 'Paladins', 'ids' => [3, 7]],
    'paladin' => ['label' => 'Paladins', 'ids' => [3, 7]],
    'knights' => ['label' => 'Knights', 'ids' => [4, 8]],
    'knight' => ['label' => 'Knights', 'ids' => [4, 8]],
    'monks' => ['label' => 'Monks', 'ids' => [9, 10]],
    'monk' => ['label' => 'Monks', 'ids' => [9, 10]],
];
if (!isset($vocationDefinitions[$vocationRaw])) {
    $vocationRaw = 'all';
}

$worldIdColumnExists = $db->hasColumn('players', 'world_id');
$worldNameMap = is_array($config['worlds']) ? $config['worlds'] : [];
$worldTypeMap = [];

if ($db->hasTable('worlds')) {
    $worldIdColumn = $findFirstExistingColumn('worlds', ['id', 'world_id']);
    $worldNameColumn = $findFirstExistingColumn('worlds', ['name', 'world_name']);
    $worldTypeColumn = $findFirstExistingColumn('worlds', ['pvp_type', 'world_type', 'worldtype', 'type']);

    if ($worldIdColumn && $worldNameColumn) {
        $selectColumns = '`' . $worldIdColumn . '` AS `id`, `' . $worldNameColumn . '` AS `name`';
        if ($worldTypeColumn) {
            $selectColumns .= ', `' . $worldTypeColumn . '` AS `world_type`';
        }

        foreach ($db->query('SELECT ' . $selectColumns . ' FROM `worlds`') as $worldRow) {
            $worldId = (int)$worldRow['id'];
            $worldNameMap[$worldId] = (string)$worldRow['name'];

            if (isset($worldRow['world_type'])) {
                $normalizedType = $normalizeWorldType($worldRow['world_type']);
                if ($normalizedType !== null) {
                    $worldTypeMap[$worldId] = $normalizedType;
                }
            }
        }
    }
}

if ($worldIdColumnExists && empty($worldNameMap)) {
    $distinctWorlds = $db->query('SELECT DISTINCT `world_id` FROM `players` ORDER BY `world_id` ASC')->fetchAll();
    foreach ($distinctWorlds as $worldRow) {
        $worldId = (int)$worldRow['world_id'];
        if ($worldId <= 0) {
            continue;
        }

        $worldNameMap[$worldId] = 'World ' . $worldId;
    }
}

$promotion = '';
if ($db->hasColumn('players', 'promotion')) {
    $promotion = ', promotion';
}

$online = '';
if ($db->hasColumn('players', 'online')) {
    $online = ', online';
}

$deleted = 'deleted';
if ($db->hasColumn('players', 'deletion')) {
    $deleted = 'deletion';
}

$conditions = [];
$conditions[] = 'players.id NOT IN (' . implode(', ', $config['highscores_ids_hidden']) . ')';
$conditions[] = 'players.' . $deleted . ' = 0';
$conditions[] = 'players.group_id < ' . (int)$config['highscores_groups_hidden'];

if (!empty($vocationDefinitions[$vocationRaw]['ids'])) {
    $conditions[] = 'players.vocation IN (' . implode(', ', $vocationDefinitions[$vocationRaw]['ids']) . ')';
}

if ($selectedWorld > 0 && $worldIdColumnExists) {
    $conditions[] = 'players.world_id = ' . $selectedWorld;
}

if (!empty($selectedWorldTypes) && $worldIdColumnExists && !empty($worldTypeMap)) {
    $allowedWorldIds = [];
    foreach ($worldTypeMap as $worldId => $worldType) {
        if (in_array($worldType, $selectedWorldTypes, true)) {
            $allowedWorldIds[] = (int)$worldId;
        }
    }

    if (!empty($allowedWorldIds)) {
        $conditions[] = 'players.world_id IN (' . implode(', ', $allowedWorldIds) . ')';
    } else {
        $conditions[] = '1 = 0';
    }
}

$whereSql = implode(' AND ', $conditions);
$worldSelect = $worldIdColumnExists ? ', players.world_id' : '';

$accountLoyaltySelect = ', accounts.id AS account_id';

$limit = $config['highscores_length'] ?? 50;
if (!is_int($limit) && !ctype_digit((string)$limit)) {
    $limit = 50;
}
$limit = max(1, (int)$limit);
$limit_ = $limit + 1;
$offset = $_page * $limit;

$skill = POT::SKILL_LEVEL;
$customColumn = null;
$activeType = $categoryDefinitions[$activeCategory]['type'];

if ($activeType === 'skill') {
    $skill = $categoryDefinitions[$activeCategory]['skill_id'];
} elseif ($activeType === 'magic') {
    $skill = POT::SKILL_MAGLEVEL;
} elseif ($activeType === 'frags') {
    $skill = SKILL_FRAGS;
} elseif ($activeType === 'balance') {
    $skill = SKILL_BALANCE;
} elseif ($activeType === 'column') {
    $skill = SKILL_CUSTOM_COLUMN;
    $customColumn = $categoryDefinitions[$activeCategory]['column'];
} else {
    $skill = POT::SKILL_LEVEL;
}

$skills = [];
if ($activeType === 'account_loyalty') {
    $skills = $db->query(
        'SELECT accounts.country, players.id, players.name' . $online . ', level, experience, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ' ' .
        'FROM accounts, players ' .
        'WHERE ' . $whereSql . ' AND accounts.id = players.account_id '
    )->fetchAll();

    $accountIds = [];
    foreach ($skills as $playerRow) {
        $accountId = (int)($playerRow['account_id'] ?? 0);
        if ($accountId > 0) {
            $accountIds[] = $accountId;
        }
    }
    $loyaltyByAccount = getAccountLoyaltyPointsBatch($accountIds);

    foreach ($skills as &$playerRow) {
        $accountId = (int)($playerRow['account_id'] ?? 0);
        $playerRow['__loyalty_points'] = (int)($loyaltyByAccount[$accountId] ?? 0);
    }
    unset($playerRow);

    usort($skills, static function (array $a, array $b): int {
        $loyaltyA = (int)($a['__loyalty_points'] ?? 0);
        $loyaltyB = (int)($b['__loyalty_points'] ?? 0);
        if ($loyaltyA !== $loyaltyB) {
            return $loyaltyB <=> $loyaltyA;
        }

        $levelA = (int)($a['level'] ?? 0);
        $levelB = (int)($b['level'] ?? 0);
        if ($levelA !== $levelB) {
            return $levelB <=> $levelA;
        }

        return strcasecmp((string)($a['name'] ?? ''), (string)($b['name'] ?? ''));
    });

    $skills = array_slice($skills, $offset, $limit_);
} elseif ($skill === SKILL_CUSTOM_COLUMN && $customColumn !== null) {
    $skills = $db->query(
        'SELECT accounts.country, players.id, players.name' . $online . ', level, experience, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ', players.`' . $customColumn . '` AS value ' .
        'FROM accounts, players ' .
        'WHERE ' . $whereSql . ' AND accounts.id = players.account_id ' .
        'ORDER BY value DESC, level DESC, players.name ASC ' .
        'LIMIT ' . $limit_ . ' OFFSET ' . $offset
    )->fetchAll();
} elseif ($skill >= POT::SKILL_FIRST && $skill <= POT::SKILL_LAST) {
    if ($db->hasColumn('players', 'skill_fist')) {
        $skillIds = [
            POT::SKILL_FIST => 'skill_fist',
            POT::SKILL_CLUB => 'skill_club',
            POT::SKILL_SWORD => 'skill_sword',
            POT::SKILL_AXE => 'skill_axe',
            POT::SKILL_DIST => 'skill_dist',
            POT::SKILL_SHIELD => 'skill_shielding',
            POT::SKILL_FISH => 'skill_fishing',
        ];
        $skills = $db->query(
            'SELECT accounts.country, players.id, players.name' . $online . ', level, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ', ' . $skillIds[$skill] . ' AS value ' .
            'FROM accounts, players ' .
            'WHERE ' . $whereSql . ' AND accounts.id = players.account_id ' .
            'ORDER BY ' . $skillIds[$skill] . ' DESC, players.name ASC ' .
            'LIMIT ' . $limit_ . ' OFFSET ' . $offset
        )->fetchAll();
    } else {
        $skills = $db->query(
            'SELECT accounts.country, players.id, players.name' . $online . ', player_skills.value, level, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ' ' .
            'FROM accounts, players, player_skills ' .
            'WHERE ' . $whereSql . ' AND players.id = player_skills.player_id AND player_skills.skillid = ' . $skill . ' AND accounts.id = players.account_id ' .
            'ORDER BY player_skills.value DESC, player_skills.count DESC, players.name ASC ' .
            'LIMIT ' . $limit_ . ' OFFSET ' . $offset
        )->fetchAll();
    }
} elseif ($skill === SKILL_FRAGS && $config['otserv_version'] == TFS_03 && $config['highscores_frags']) {
    $skills = $db->query(
        'SELECT accounts.country, players.id, players.name' . $online . ', level, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ', COUNT(player_killers.player_id) AS value ' .
        'FROM accounts, players, player_killers ' .
        'WHERE ' . $whereSql . ' AND players.id = player_killers.player_id AND accounts.id = players.account_id ' .
        'GROUP BY player_id ORDER BY value DESC LIMIT ' . $limit_ . ' OFFSET ' . $offset
    )->fetchAll();
} elseif ($skill === SKILL_BALANCE && $config['highscores_balance']) {
    $skills = $db->query(
        'SELECT accounts.country, players.id, players.name' . $online . ', level, balance AS value, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ' ' .
        'FROM accounts, players ' .
        'WHERE ' . $whereSql . ' AND accounts.id = players.account_id ' .
        'ORDER BY value DESC, name ASC LIMIT ' . $limit_ . ' OFFSET ' . $offset
    )->fetchAll();
} elseif ($skill === POT::SKILL_MAGLEVEL) {
    $skills = $db->query(
        'SELECT accounts.country, players.id, players.name' . $online . ', maglevel, level, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ' ' .
        'FROM accounts, players ' .
        'WHERE ' . $whereSql . ' AND accounts.id = players.account_id ' .
        'ORDER BY maglevel DESC, manaspent DESC, players.name ASC LIMIT ' . $limit_ . ' OFFSET ' . $offset
    )->fetchAll();
} else {
    $activeCategory = 'experience';
    $skills = $db->query(
        'SELECT accounts.country, players.id, players.name' . $online . ', level, experience, vocation' . $promotion . $worldSelect . $accountLoyaltySelect . ' ' .
        'FROM accounts, players ' .
        'WHERE ' . $whereSql . ' AND accounts.id = players.account_id ' .
        'ORDER BY level DESC, experience DESC, players.name ASC LIMIT ' . $limit_ . ' OFFSET ' . $offset
    )->fetchAll();
}

$loyaltyByAccount = [];
if (!empty($skills)) {
    $accountIds = [];
    foreach ($skills as $playerRow) {
        $accountId = (int)($playerRow['account_id'] ?? 0);
        if ($accountId > 0) {
            $accountIds[] = $accountId;
        }
    }
    $loyaltyByAccount = getAccountLoyaltyPointsBatch($accountIds);
}

$countRow = $db->query('SELECT COUNT(*) AS total FROM players WHERE ' . $whereSql)->fetch();
$totalCharacters = (int)($countRow['total'] ?? 0);
$showLinkToNextPage = false;

$baseUrl = getLink('highscores');
$buildHighscoresUrl = static function (int $page) use ($baseUrl, $activeCategory, $vocationRaw, $selectedWorld, $selectedWorldTypes) {
    $params = [
        'list' => $activeCategory,
        'page' => max(0, $page),
    ];

    if ($vocationRaw !== 'all') {
        $params['vocation'] = $vocationRaw;
    }

    if ($selectedWorld > 0) {
        $params['world'] = $selectedWorld;
    }

    if (!empty($selectedWorldTypes)) {
        $params['world_type'] = $selectedWorldTypes;
    }

    $query = http_build_query($params);
    $glue = strpos($baseUrl, '?') !== false ? '&' : '?';

    return $baseUrl . ($query !== '' ? $glue . $query : '');
};

$currentPage = $_page + 1;
$totalPages = max(1, (int)ceil(($totalCharacters > 0 ? $totalCharacters : 1) / $limit));
if ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

$rowStart = $totalCharacters > 0 ? ($offset + 1) : 0;
$rowEnd = min($offset + $limit, $totalCharacters);
$lastUpdateText = date('d/m/Y, H:i:s');
$valueColumnLabel = $categoryDefinitions[$activeCategory]['label'] ?? 'Experience';
?>

<style>
body.rc-page-highscores .rc-rich-content .rc-hs-page {
    max-width: 1260px;
    margin: 0 auto;
    padding: 8px 0;
}

body.rc-page-highscores .rc-rich-content .rc-hs-card {
    border: 1px solid rgba(108, 140, 194, 0.38);
    border-radius: 12px;
    background: linear-gradient(160deg, rgba(13, 20, 34, 0.92) 0%, rgba(9, 14, 24, 0.96) 100%);
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.03);
    overflow: hidden;
}

body.rc-page-highscores .rc-rich-content .rc-hs-title {
    margin: 0;
    padding: 16px 18px 8px;
    color: #f4c95f;
    font-family: var(--rc-font-title), Verdana, Arial, Helvetica, sans-serif;
    font-size: 18px;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

body.rc-page-highscores .rc-rich-content .rc-hs-divider {
    height: 2px;
    width: 136px;
    margin: 0 18px 14px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(242, 184, 75, 0.95), rgba(242, 184, 75, 0.2));
}

body.rc-page-highscores .rc-rich-content .rc-hs-filter-wrap {
    margin: 0 14px 12px;
    border: 1px solid rgba(91, 124, 183, 0.45);
    border-radius: 10px;
    background: rgba(8, 16, 31, 0.65);
    padding: 12px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-filter-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-field label {
    display: block;
    margin-bottom: 6px;
    color: #c3d4f0;
    font-size: 12px;
    font-weight: 700;
}

body.rc-page-highscores .rc-rich-content .rc-hs-field select {
    width: 100%;
}

body.rc-page-highscores .rc-rich-content .rc-hs-world-type {
    margin-top: 12px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    color: #cddcf4;
    font-size: 12px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-world-type strong {
    color: #f0c982;
    font-weight: 700;
}

body.rc-page-highscores .rc-rich-content .rc-hs-world-type label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
}

body.rc-page-highscores .rc-rich-content .rc-hs-world-type input[type="checkbox"] {
    width: 12px;
    height: 12px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-toolbar {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid rgba(154, 176, 224, 0.2);
    display: flex;
    justify-content: space-between;
    gap: 10px;
    font-size: 12px;
    color: #9fb4d8;
}

body.rc-page-highscores .rc-rich-content .rc-hs-meta-left,
body.rc-page-highscores .rc-rich-content .rc-hs-meta-right {
    display: inline-flex;
    gap: 5px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-meta-value {
    color: #f4c95f;
    font-weight: 700;
}

body.rc-page-highscores .rc-rich-content .rc-hs-table-wrap {
    margin: 0 14px 14px;
    border: 1px solid rgba(91, 124, 183, 0.45);
    border-radius: 10px;
    background: rgba(8, 16, 31, 0.65);
    overflow: hidden;
}

body.rc-page-highscores .rc-rich-content .rc-hs-table {
    width: 100%;
    border-collapse: collapse;
}

body.rc-page-highscores .rc-rich-content .rc-hs-table th,
body.rc-page-highscores .rc-rich-content .rc-hs-table td {
    padding: 8px 10px;
    border-bottom: 1px solid rgba(154, 176, 224, 0.18);
    color: #d7e4fb;
    font-size: 12px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-table th {
    background: rgba(17, 30, 51, 0.95);
    color: #f0c982;
    font-weight: 700;
    text-align: left;
}

body.rc-page-highscores .rc-rich-content .rc-hs-table tr:last-child td {
    border-bottom: 0;
}

body.rc-page-highscores .rc-rich-content .rc-hs-rank-col {
    width: 56px;
    text-align: right;
    color: #b8c9e8;
}

body.rc-page-highscores .rc-rich-content .rc-hs-rank-top1 {
    color: #f5c44d !important;
    font-weight: 700;
}

body.rc-page-highscores .rc-rich-content .rc-hs-rank-top2 {
    color: #a9c1e8 !important;
    font-weight: 700;
}

body.rc-page-highscores .rc-rich-content .rc-hs-rank-top3 {
    color: #db9a54 !important;
    font-weight: 700;
}

body.rc-page-highscores .rc-rich-content .rc-hs-name a {
    color: #66b4ff !important;
    text-decoration: none;
}

body.rc-page-highscores .rc-rich-content .rc-hs-name a:hover {
    color: #8ec9ff !important;
}

body.rc-page-highscores .rc-rich-content .rc-hs-right {
    text-align: right;
}

body.rc-page-highscores .rc-rich-content .rc-hs-footer {
    margin: 10px 14px 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-showing {
    color: #b6c8e7;
    font-size: 12px;
}

body.rc-page-highscores .rc-rich-content .rc-hs-pagination {
    display: inline-flex;
    gap: 4px;
    flex-wrap: wrap;
    justify-content: center;
}

body.rc-page-highscores .rc-rich-content .rc-hs-page-btn {
    min-width: 30px;
    height: 28px;
    padding: 0 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(98, 137, 197, 0.72);
    border-radius: 4px;
    background: linear-gradient(180deg, rgba(49, 87, 135, 0.95) 0%, rgba(29, 64, 112, 0.95) 100%);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
}

body.rc-page-highscores .rc-rich-content .rc-hs-page-btn:hover {
    filter: brightness(1.08);
}

body.rc-page-highscores .rc-rich-content .rc-hs-page-btn.is-current {
    border-color: rgba(232, 189, 104, 0.9);
    background: linear-gradient(180deg, rgba(71, 109, 156, 0.98) 0%, rgba(41, 78, 126, 0.98) 100%);
}

body.rc-page-highscores .rc-rich-content .rc-hs-empty {
    text-align: center;
    color: #b9cbe8;
    padding: 16px !important;
}

@media (max-width: 900px) {
    body.rc-page-highscores .rc-rich-content .rc-hs-filter-grid {
        grid-template-columns: 1fr;
    }

    body.rc-page-highscores .rc-rich-content .rc-hs-toolbar {
        flex-direction: column;
    }

    body.rc-page-highscores .rc-rich-content .rc-hs-table-wrap {
        overflow-x: auto;
    }
}
</style>

<div class="rc-hs-page">
    <div class="rc-hs-card">
        <h2 class="rc-hs-title">Highscores</h2>
        <div class="rc-hs-divider"></div>

        <form class="rc-hs-filter-wrap" method="get" action="<?= htmlspecialchars(getLink('highscores'), ENT_QUOTES, 'UTF-8') ?>">
            <input type="hidden" name="page" value="0">
            <div class="rc-hs-filter-grid">
                <div class="rc-hs-field">
                    <label for="hs_world">World</label>
                    <select id="hs_world" name="world">
                        <option value="0" <?= $selectedWorld === 0 ? 'selected' : '' ?>>All Worlds</option>
                        <?php
                        if (!empty($worldNameMap)) {
                            asort($worldNameMap, SORT_NATURAL | SORT_FLAG_CASE);
                            foreach ($worldNameMap as $worldId => $worldName) {
                                echo '<option value="' . (int)$worldId . '"' . ($selectedWorld === (int)$worldId ? ' selected' : '') . '>' . htmlspecialchars($worldName, ENT_QUOTES, 'UTF-8') . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="rc-hs-field">
                    <label for="hs_category">Category</label>
                    <select id="hs_category" name="list">
                        <?php foreach ($categoryDefinitions as $categoryKey => $categoryData) { ?>
                            <option value="<?= htmlspecialchars($categoryKey, ENT_QUOTES, 'UTF-8') ?>" <?= $activeCategory === $categoryKey ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categoryData['label'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="rc-hs-field">
                    <label for="hs_vocation">Vocation</label>
                    <select id="hs_vocation" name="vocation">
                        <?php foreach ($vocationDefinitions as $vocationKey => $vocationData) {
                            if (in_array($vocationKey, ['sorcerer', 'druid', 'paladin', 'knight', 'monk'], true)) {
                                continue;
                            }
                        ?>
                            <option value="<?= htmlspecialchars($vocationKey, ENT_QUOTES, 'UTF-8') ?>" <?= $vocationRaw === $vocationKey ? 'selected' : '' ?>>
                                <?= htmlspecialchars($vocationData['label'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="rc-hs-world-type">
                <strong>World Type:</strong>
                <label><input type="checkbox" name="world_type[]" value="open" <?= in_array('open', $selectedWorldTypes, true) ? 'checked' : '' ?>>Open PvP</label>
                <label><input type="checkbox" name="world_type[]" value="optional" <?= in_array('optional', $selectedWorldTypes, true) ? 'checked' : '' ?>>Optional PvP</label>
                <label><input type="checkbox" name="world_type[]" value="retro" <?= in_array('retro', $selectedWorldTypes, true) ? 'checked' : '' ?>>Retro PvP</label>
                <button type="submit" class="rc-btn rc-btn-subtle" style="margin-left:auto;">Apply</button>
            </div>

            <div class="rc-hs-toolbar">
                <div class="rc-hs-meta-left">
                    <span>Total:</span>
                    <span class="rc-hs-meta-value"><?= $formatRankingNumber($totalCharacters) ?> characters</span>
                </div>
                <div class="rc-hs-meta-right">
                    <span>Last update:</span>
                    <span class="rc-hs-meta-value"><?= htmlspecialchars($lastUpdateText, ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            </div>
        </form>

        <div class="rc-hs-table-wrap">
            <table class="rc-hs-table">
                <thead>
                <tr>
                    <th class="rc-hs-rank-col">Rank</th>
                    <th>Name</th>
                    <th>Vocation</th>
                    <th>World</th>
                    <th>Loyalty Title</th>
                    <th class="rc-hs-right">Loyalty Points</th>
                    <th class="rc-hs-right">Level</th>
                    <th class="rc-hs-right"><?= htmlspecialchars($valueColumnLabel, ENT_QUOTES, 'UTF-8') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $rowsShown = 0;

                foreach ($skills as $player) {
                    $rowsShown++;
                    if ($rowsShown > $limit) {
                        $showLinkToNextPage = true;
                        break;
                    }

                    $rankNumber = $offset + $rowsShown;
                    $rankClass = '';
                    if ($rankNumber === 1) {
                        $rankClass = ' rc-hs-rank-top1';
                    } elseif ($rankNumber === 2) {
                        $rankClass = ' rc-hs-rank-top2';
                    } elseif ($rankNumber === 3) {
                        $rankClass = ' rc-hs-rank-top3';
                    }

                    $playerVocationId = (int)$player['vocation'];
                    if (isset($player['promotion']) && (int)$player['promotion'] > 0) {
                        $playerVocationId += ((int)$player['promotion'] * (int)$config['vocations_amount']);
                    }
                    $vocationName = $config['vocations'][$playerVocationId] ?? 'Unknown';

                    $worldName = $config['lua']['serverName'];
                    if ($worldIdColumnExists && isset($player['world_id'])) {
                        $worldId = (int)$player['world_id'];
                        $worldName = $worldNameMap[$worldId] ?? $worldName;
                    }

                    $playerAccountId = isset($player['account_id']) ? (int)$player['account_id'] : 0;
                    $playerLoyaltyPoints = isset($player['__loyalty_points'])
                        ? (int)$player['__loyalty_points']
                        : (int)($loyaltyByAccount[$playerAccountId] ?? 0);
                    $playerLoyaltyTitle = getAccountLoyaltyTitle($playerLoyaltyPoints);

                    $playerLevel = (int)($player['level'] ?? 0);
                    $valueNumber = 0;
                    if ($activeCategory === 'experience') {
                        $valueNumber = (int)($player['experience'] ?? 0);
                    } elseif ($activeCategory === 'magic') {
                        $valueNumber = (int)($player['maglevel'] ?? 0);
                    } elseif ($activeCategory === 'loyalty_points') {
                        $valueNumber = $playerLoyaltyPoints;
                    } else {
                        $valueNumber = (int)($player['value'] ?? 0);
                    }
                    ?>
                    <tr>
                        <td class="rc-hs-rank-col<?= $rankClass ?>"><?= $rankNumber ?>.</td>
                        <td class="rc-hs-name">
                            <a href="<?= htmlspecialchars(getPlayerLink($player['name'], false), ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($player['name'], ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($vocationName, ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars((string)$worldName, ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($playerLoyaltyTitle, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-hs-right"><?= $formatRankingNumber($playerLoyaltyPoints) ?></td>
                        <td class="rc-hs-right"><?= $formatRankingNumber($playerLevel) ?></td>
                        <td class="rc-hs-right"><strong><?= $formatRankingNumber($valueNumber) ?></strong></td>
                    </tr>
                <?php } ?>

                <?php if ($rowsShown === 0) { ?>
                    <tr>
                        <td colspan="8" class="rc-hs-empty">No records found.</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?php
        $windowSize = 5;
        $startPage = max(1, $currentPage - 2);
        $endPage = min($totalPages, $startPage + $windowSize - 1);
        if (($endPage - $startPage + 1) < $windowSize) {
            $startPage = max(1, $endPage - $windowSize + 1);
        }
        ?>
        <div class="rc-hs-footer">
            <div class="rc-hs-showing">
                Showing <?= $formatRankingNumber($rowStart) ?>-<?= $formatRankingNumber($rowEnd) ?> of <?= $formatRankingNumber($totalCharacters) ?> characters
            </div>

            <div class="rc-hs-pagination">
                <?php if ($currentPage > 1) { ?>
                    <a class="rc-hs-page-btn" href="<?= htmlspecialchars($buildHighscoresUrl(0), ENT_QUOTES, 'UTF-8') ?>">&laquo;</a>
                    <a class="rc-hs-page-btn" href="<?= htmlspecialchars($buildHighscoresUrl($currentPage - 2), ENT_QUOTES, 'UTF-8') ?>">&lsaquo;</a>
                <?php } ?>

                <?php for ($page = $startPage; $page <= $endPage; $page++) { ?>
                    <a class="rc-hs-page-btn<?= $page === $currentPage ? ' is-current' : '' ?>" href="<?= htmlspecialchars($buildHighscoresUrl($page - 1), ENT_QUOTES, 'UTF-8') ?>">
                        <?= $page ?>
                    </a>
                <?php } ?>

                <?php if ($showLinkToNextPage || $currentPage < $totalPages) { ?>
                    <a class="rc-hs-page-btn" href="<?= htmlspecialchars($buildHighscoresUrl($currentPage), ENT_QUOTES, 'UTF-8') ?>">&rsaquo;</a>
                    <a class="rc-hs-page-btn" href="<?= htmlspecialchars($buildHighscoresUrl($totalPages - 1), ENT_QUOTES, 'UTF-8') ?>">&raquo;</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
