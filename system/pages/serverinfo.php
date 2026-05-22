<?php
defined('MYAAC') or die('Direct access not allowed!');

global $config;

$title = 'Server Info';

$configLuaValue = static function (array $keys, $default = null) {
    foreach ($keys as $key) {
        $value = configLua($key);
        if ($value !== null && $value !== '') {
            return $value;
        }
    }

    return $default;
};

$formatMultiplier = static function ($value): string {
    if (!is_numeric($value)) {
        return '-';
    }

    $number = (float)$value;
    if (abs($number - floor($number)) < 0.00001) {
        return (int)$number . 'x';
    }

    return rtrim(rtrim(number_format($number, 2, '.', ''), '0'), '.') . 'x';
};

$formatDuration = static function ($seconds): string {
    if (!is_numeric($seconds)) {
        return '-';
    }

    $seconds = max(0, (int)$seconds);
    if ($seconds === 0) {
        return '0';
    }

    $units = [
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second',
    ];

    foreach ($units as $unitSeconds => $unitName) {
        if ($seconds >= $unitSeconds && $seconds % $unitSeconds === 0) {
            $value = (int)($seconds / $unitSeconds);
            return $value . ' ' . $unitName . ($value === 1 ? '' : 's');
        }
    }

    return $seconds . ' seconds';
};

$formatRentPeriod = static function ($value) use ($formatDuration): string {
    if ($value === null || $value === '') {
        return '7 days';
    }

    if (is_numeric($value)) {
        $numeric = (float)$value;
        if ($numeric <= 31) {
            $days = (int)max(1, round($numeric));
            return $days . ' day' . ($days === 1 ? '' : 's');
        }

        return $formatDuration((int)$numeric);
    }

    $normalized = strtolower(trim((string)$value));
    $map = [
        'daily' => '1 day',
        'day' => '1 day',
        'weekly' => '7 days',
        'week' => '7 days',
        'monthly' => '30 days',
        'month' => '30 days',
        'yearly' => '365 days',
        'year' => '365 days',
        'never' => 'Never',
    ];

    if (isset($map[$normalized])) {
        return $map[$normalized];
    }

    return (string)$value;
};

$serverSaveRaw = trim((string)$configLuaValue(['globalServerSaveTime', 'serverSaveTime'], '10:00:00'));
if (!preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', $serverSaveRaw)) {
    $serverSaveRaw = '10:00:00';
}

$serverSave = DateTime::createFromFormat('H:i:s', strlen($serverSaveRaw) === 5 ? ($serverSaveRaw . ':00') : $serverSaveRaw);
if (!$serverSave) {
    $serverSave = DateTime::createFromFormat('H:i:s', '10:00:00');
}

$houseBidLevel = (int)$configLuaValue(['houseBuyLevel', 'houseRequiredLevel'], 300);
$houseBidDuration = $formatDuration((int)$configLuaValue(['houseBidTime', 'houseBiddingTime'], 2 * 86400));
$houseRentInterval = $formatRentPeriod($configLuaValue(['houseRentPeriod', 'houserentperiod'], '7 days'));
$generalServerSaveText = $serverSave ? $serverSave->format('h:i A') : '10:00 AM';

$rateStages = $config['lua']['rateStages'] ?? [];
$experienceRates = [];
$skillRates = [];
$magicRates = [];

if (!empty($rateStages['experienceStages']) && is_array($rateStages['experienceStages'])) {
    foreach ($rateStages['experienceStages'] as $stage) {
        if (!isset($stage['minlevel'], $stage['multiplier'])) {
            continue;
        }

        $experienceRates[] = [
            (string)(int)$stage['minlevel'],
            isset($stage['maxlevel']) && $stage['maxlevel'] !== null && $stage['maxlevel'] !== 0
                ? (string)(int)$stage['maxlevel']
                : '&infin;',
            $formatMultiplier($stage['multiplier']),
        ];
    }
}

if (!empty($rateStages['skillsStages']) && is_array($rateStages['skillsStages'])) {
    foreach ($rateStages['skillsStages'] as $stage) {
        if (!isset($stage['minlevel'], $stage['multiplier'])) {
            continue;
        }

        $skillRates[] = [
            (string)(int)$stage['minlevel'],
            isset($stage['maxlevel']) && $stage['maxlevel'] !== null && $stage['maxlevel'] !== 0
                ? (string)(int)$stage['maxlevel']
                : '&infin;',
            $formatMultiplier($stage['multiplier']),
        ];
    }
}

if (!empty($rateStages['magicLevelStages']) && is_array($rateStages['magicLevelStages'])) {
    foreach ($rateStages['magicLevelStages'] as $stage) {
        if (!isset($stage['minlevel'], $stage['multiplier'])) {
            continue;
        }

        $magicRates[] = [
            (string)(int)$stage['minlevel'],
            isset($stage['maxlevel']) && $stage['maxlevel'] !== null && $stage['maxlevel'] !== 0
                ? (string)(int)$stage['maxlevel']
                : '&infin;',
            $formatMultiplier($stage['multiplier']),
        ];
    }
}

if (empty($experienceRates)) {
    $experienceRates[] = ['1', '&infin;', $formatMultiplier($configLuaValue(['rateExperience', 'rateExp'], 1))];
}
if (empty($skillRates)) {
    $skillRates[] = ['1', '&infin;', $formatMultiplier($configLuaValue(['rateSkill'], 1))];
}
if (empty($magicRates)) {
    $magicRates[] = ['0', '&infin;', $formatMultiplier($configLuaValue(['rateMagic'], 1))];
}

$lootRate = $formatMultiplier($configLuaValue(['rateLoot'], 2.5));
$bestiaryRate = $formatMultiplier($configLuaValue(['rateBestiary', 'rateBestiaryExperience', 'rateBestiaryKill'], 2));

$houseCommands = [
    ['aleta sio', 'Opens the list of characters invited to enter your house'],
    ['aleta som', 'Opens the list of co-owners of your house'],
    ['aleta grav', 'Use while facing the door you want to grant access to and add the player to the list (<em>add "nickname"</em>)'],
    ['alana sio "name"', 'Kicks a player out of your house'],
];

$playerCommands = [
    ['!b', 'Send a red message to all online guild members'],
    ['!outfit', 'Change the outfit of all online guild members (5 minute cooldown)'],
    ['!target', 'Mark a target with a yellow frame visible only to guild members'],
    ['!carpet', 'Move the carpet below you in your character\'s direction'],
];

$partyBonuses = [
    ['Party with <strong>same</strong> vocations', '+20%'],
    ['Party with <strong>2 different vocations</strong>', '+30%'],
    ['Party with <strong>3 different vocations</strong>', '+60%'],
    ['Party with <strong>4 different vocations</strong>', '+100%'],
];

$staminaEffects = [
    ['42:00 ~ 39:00', '<span class="rc-si-good">Bonus EXP (+50% of level rate)</span>'],
    ['38:59 ~ 14:00', 'Normal EXP (Level rate)'],
    ['13:59 ~ 00:00', '<span class="rc-si-warn">Reduced EXP (-50% of level rate)</span>'],
    ['08:00 ~ 00:00', '<span class="rc-si-danger">Creatures drop no loot</span>'],
];

$orangeStamina = [
    ['Every 3 minutes offline or sleeping', '+1 minute'],
    ['Every 6 minutes attacking a trainer', '+1 minute'],
    ['Every 3 minutes in protection zone', '+1 minute'],
];

$greenStamina = [
    ['Every 6 minutes offline or sleeping', '+1 minute'],
    ['Every 6 minutes attacking a trainer', '+1 minute'],
    ['Every 5 minutes in protection zone', '+1 minute'],
];

$regenerationRows = [
    ['Knight', '20', '5', '20', '5'],
    ['Paladin', '10', '10', '10', '10'],
    ['Sorcerer', '5', '20', '5', '20'],
    ['Druid', '5', '20', '5', '20'],
    ['Monk', '8', '10', '8', '10'],
];

$fragDurations = [
    ['Frag', $formatDuration((int)$configLuaValue(['timeToDecreaseFrags'], 12 * 3600))],
    ['Red Skull', $formatDuration((int)$configLuaValue(['redSkullLength', 'redSkullDuration'], 5 * 86400))],
    ['Black Skull', $formatDuration((int)$configLuaValue(['blackSkullLength', 'blackSkullDuration'], 14 * 86400))],
];

$fragKills = [
    [
        'Red Skull',
        (string)(int)$configLuaValue(['killsDayRedSkull', 'dailyFragsToRedSkull'], 7),
        (string)(int)$configLuaValue(['killsWeekRedSkull', 'weeklyFragsToRedSkull'], 14),
        (string)(int)$configLuaValue(['killsMonthRedSkull', 'monthlyFragsToRedSkull'], 21),
    ],
    [
        'Black Skull',
        (string)(int)$configLuaValue(['killsDayBlackSkull', 'dailyFragsToBlackSkull'], 14),
        (string)(int)$configLuaValue(['killsWeekBlackSkull', 'weeklyFragsToBlackSkull'], 28),
        (string)(int)$configLuaValue(['killsMonthBlackSkull', 'monthlyFragsToBlackSkull'], 42),
    ],
];
?>
<style>
body.rc-page-serverinfo .rc-panel-content > h3 {
    display: none;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-page {
    max-width: 1260px;
    margin: 0 auto;
    display: grid;
    gap: 14px;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-section {
    border: 1px solid rgba(194, 157, 99, 0.7);
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(13, 21, 36, 0.92) 0%, rgba(9, 15, 27, 0.96) 100%);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05), 0 12px 26px rgba(0, 0, 0, 0.35);
}

body.rc-page-serverinfo .rc-rich-content .rc-si-title {
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

body.rc-page-serverinfo .rc-rich-content .rc-si-body {
    padding: 14px;
    display: grid;
    gap: 12px;
    background: rgba(15, 24, 40, 0.8);
}

body.rc-page-serverinfo .rc-rich-content .rc-si-text {
    margin: 0;
    color: #d8e5fc;
    font-size: 13px;
    line-height: 1.45;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-text em {
    color: #f0c982;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-note {
    margin: 0;
    padding: 10px 12px;
    border: 1px solid rgba(150, 172, 216, 0.24);
    border-radius: 8px;
    background: rgba(19, 31, 51, 0.72);
    color: #d0def8;
    font-size: 13px;
    line-height: 1.45;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-note strong {
    color: #f0c982;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-note .rc-si-danger {
    color: #ff7676;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid rgba(150, 172, 216, 0.32);
    background: rgba(15, 24, 40, 0.7);
}

body.rc-page-serverinfo .rc-rich-content .rc-si-table th,
body.rc-page-serverinfo .rc-rich-content .rc-si-table td {
    border: 1px solid rgba(150, 172, 216, 0.22);
    padding: 8px 10px;
    text-align: left;
    vertical-align: middle;
    color: #dce8ff;
    font-size: 13px;
    line-height: 1.35;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-table thead th {
    color: #f0c982;
    font-weight: 700;
    background: rgba(18, 29, 47, 0.95);
}

body.rc-page-serverinfo .rc-rich-content .rc-si-table .rc-si-label {
    width: 182px;
    color: #f0c982;
    font-weight: 700;
    background: rgba(19, 31, 51, 0.88);
}

body.rc-page-serverinfo .rc-rich-content .rc-si-table .rc-si-center {
    text-align: center;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-subtitle {
    margin: 0;
    color: #f0c982;
    font-size: 15px;
    font-weight: 700;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-good {
    color: #4de58f;
    font-weight: 700;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-warn {
    color: #ff9e54;
    font-weight: 700;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-danger {
    color: #ff7777;
    font-weight: 700;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-stat-hp {
    color: #ff6f6f;
    font-weight: 700;
}

body.rc-page-serverinfo .rc-rich-content .rc-si-stat-mp {
    color: #5ca3ff;
    font-weight: 700;
}

@media (max-width: 900px) {
    body.rc-page-serverinfo .rc-rich-content .rc-si-title {
        font-size: 20px;
    }

    body.rc-page-serverinfo .rc-rich-content .rc-si-table {
        display: block;
        overflow-x: auto;
    }
}
</style>

<div class="rc-si-page">
    <section class="rc-si-section">
        <h2 class="rc-si-title">General Information</h2>
        <div class="rc-si-body">
            <p class="rc-si-text">Daily server save occurs at <?= htmlspecialchars($generalServerSaveText, ENT_QUOTES, 'UTF-8') ?> (<em>UTC-3 / Brasilia Time</em>).</p>
            <p class="rc-si-text">The 5 <em>Inquisition Blessings</em> are free until level 50.</p>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Server Rates</h2>
        <div class="rc-si-body">
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th class="rc-si-label"></th>
                    <th>From Level</th>
                    <th>To Level</th>
                    <th>Multiplier</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($experienceRates as $index => $row) { ?>
                    <tr>
                        <?php if ($index === 0) { ?>
                            <td class="rc-si-label" rowspan="<?= count($experienceRates) ?>">Experience</td>
                        <?php } ?>
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td><strong><?= $row[2] ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <table class="rc-si-table">
                <thead>
                <tr>
                    <th class="rc-si-label"></th>
                    <th>From Skill</th>
                    <th>To Skill</th>
                    <th>Multiplier</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($skillRates as $index => $row) { ?>
                    <tr>
                        <?php if ($index === 0) { ?>
                            <td class="rc-si-label" rowspan="<?= count($skillRates) ?>">Skill</td>
                        <?php } ?>
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td><strong><?= $row[2] ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <table class="rc-si-table">
                <thead>
                <tr>
                    <th class="rc-si-label"></th>
                    <th>From Magic</th>
                    <th>To Magic</th>
                    <th>Multiplier</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($magicRates as $index => $row) { ?>
                    <tr>
                        <?php if ($index === 0) { ?>
                            <td class="rc-si-label" rowspan="<?= count($magicRates) ?>">Magic</td>
                        <?php } ?>
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td><strong><?= $row[2] ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <table class="rc-si-table">
                <tbody>
                <tr>
                    <td class="rc-si-label">Loot</td>
                    <td class="rc-si-center"><strong><?= htmlspecialchars($lootRate, ENT_QUOTES, 'UTF-8') ?></strong></td>
                </tr>
                <tr>
                    <td class="rc-si-label">Bestiary</td>
                    <td class="rc-si-center"><strong><?= htmlspecialchars($bestiaryRate, ENT_QUOTES, 'UTF-8') ?></strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Houses</h2>
        <div class="rc-si-body">
            <table class="rc-si-table">
                <tbody>
                <tr>
                    <td class="rc-si-label">Required level for house bidding</td>
                    <td><?= (int)$houseBidLevel ?></td>
                </tr>
                <tr>
                    <td class="rc-si-label">Bid duration (<em>auction time</em>)</td>
                    <td><?= htmlspecialchars($houseBidDuration, ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
                <tr>
                    <td class="rc-si-label">Rent payment interval</td>
                    <td><?= htmlspecialchars($houseRentInterval, ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
                </tbody>
            </table>

            <p class="rc-si-note">Note: If you stay <span class="rc-si-danger">offline</span> for more than 7 days (Free) or 10 days (VIP), you will lose your house.</p>

            <h3 class="rc-si-subtitle">House Commands</h3>
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Command</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($houseCommands as $command) { ?>
                    <tr>
                        <td class="rc-si-label"><?= htmlspecialchars($command[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= $command[1] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Player Commands</h2>
        <div class="rc-si-body">
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Command</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($playerCommands as $command) { ?>
                    <tr>
                        <td class="rc-si-label"><?= htmlspecialchars($command[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($command[1], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Party Bonus</h2>
        <div class="rc-si-body">
            <p class="rc-si-note">Note: Experience bonus based on party composition with different vocations.</p>
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Party Composition</th>
                    <th class="rc-si-center">Bonus</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($partyBonuses as $bonus) { ?>
                    <tr>
                        <td><?= $bonus[0] ?></td>
                        <td class="rc-si-center"><strong><?= $bonus[1] ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Stamina</h2>
        <div class="rc-si-body">
            <h3 class="rc-si-subtitle">Stamina Effects</h3>
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Stamina Range</th>
                    <th>Effect</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($staminaEffects as $effect) { ?>
                    <tr>
                        <td><?= htmlspecialchars($effect[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= $effect[1] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <h3 class="rc-si-subtitle"><span class="rc-si-warn">Orange Stamina</span> Regeneration</h3>
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Condition</th>
                    <th>Regeneration</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orangeStamina as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><strong><?= htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <h3 class="rc-si-subtitle"><span class="rc-si-good">Green Stamina</span> Regeneration</h3>
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Condition</th>
                    <th>Regeneration</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($greenStamina as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><strong><?= htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Regeneration</h2>
        <div class="rc-si-body">
            <table class="rc-si-table">
                <thead>
                <tr>
                    <th rowspan="2">#</th>
                    <th colspan="2" class="rc-si-center">Common Vocation</th>
                    <th colspan="2" class="rc-si-center">Promoted Vocation</th>
                </tr>
                <tr>
                    <th class="rc-si-center">HP/each 4 sec.</th>
                    <th class="rc-si-center">MP/each 4 sec.</th>
                    <th class="rc-si-center">HP/each 3 sec.</th>
                    <th class="rc-si-center">MP/each 3 sec.</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($regenerationRows as $row) { ?>
                    <tr>
                        <td class="rc-si-label"><?= htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-si-center"><span class="rc-si-stat-hp"><?= htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') ?></span></td>
                        <td class="rc-si-center"><span class="rc-si-stat-mp"><?= htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8') ?></span></td>
                        <td class="rc-si-center"><span class="rc-si-stat-hp"><?= htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8') ?></span></td>
                        <td class="rc-si-center"><span class="rc-si-stat-mp"><?= htmlspecialchars($row[4], ENT_QUOTES, 'UTF-8') ?></span></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rc-si-section">
        <h2 class="rc-si-title">Frags</h2>
        <div class="rc-si-body">
            <p class="rc-si-note">Note: Skull system only applies to Retro and Open PvP worlds. Optional PvP worlds do not have skull system.</p>

            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Category</th>
                    <th class="rc-si-center">Duration</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fragDurations as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-si-center"><?= htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <table class="rc-si-table">
                <thead>
                <tr>
                    <th>Kills Required</th>
                    <th class="rc-si-center">Daily</th>
                    <th class="rc-si-center">Weekly</th>
                    <th class="rc-si-center">Monthly</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fragKills as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-si-center"><?= htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-si-center"><?= htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-si-center"><?= htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
