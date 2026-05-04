<?php

defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('cbz_has_table')) {
    function cbz_has_table($db, $table)
    {
        static $cache = [];
        if (isset($cache[$table])) {
            return $cache[$table];
        }

        try {
            if (method_exists($db, 'hasTable')) {
                $cache[$table] = (bool)$db->hasTable($table);
                return $cache[$table];
            }

            $stmt = $db->query("SHOW TABLES LIKE " . $db->quote($table));
            $cache[$table] = $stmt && $stmt->rowCount() > 0;
        } catch (Exception $e) {
            $cache[$table] = false;
        }

        return $cache[$table];
    }
}

if (!function_exists('cbz_has_column')) {
    function cbz_has_column($db, $table, $column)
    {
        static $cache = [];
        $key = $table . ':' . $column;
        if (isset($cache[$key])) {
            return $cache[$key];
        }

        if (!cbz_has_table($db, $table)) {
            $cache[$key] = false;
            return false;
        }

        try {
            $stmt = $db->query("SHOW COLUMNS FROM `{$table}` LIKE " . $db->quote($column));
            $cache[$key] = $stmt && $stmt->rowCount() > 0;
        } catch (Exception $e) {
            $cache[$key] = false;
        }

        return $cache[$key];
    }
}

if (!function_exists('cbz_scalar')) {
    function cbz_scalar($db, $sql)
    {
        try {
            $stmt = $db->query($sql);
            if (!$stmt) {
                return null;
            }

            $value = $stmt->fetchColumn();
            return $value === false ? null : $value;
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('cbz_count_bits')) {
    function cbz_count_bits($value)
    {
        if (!is_numeric($value)) {
            return 0;
        }

        return substr_count(decbin((int)$value), '1');
    }
}

if (!function_exists('cbz_sale_status_label')) {
    function cbz_sale_status_label($status)
    {
        switch ((int)$status) {
            case 1:
                return 'Sold';
            case 2:
                return 'Cancelled';
            default:
                return 'Open';
        }
    }
}

if (!function_exists('cbz_get_character_sale_data')) {
    function cbz_get_character_sale_data($db, $config, $playerId)
    {
        $playerId = (int)$playerId;
        $player = $db->query("SELECT * FROM `players` WHERE `id` = {$playerId}")->fetch();
        if (!$player) {
            return null;
        }

        $vocationName = $config['vocations'][$player['vocation']] ?? 'None';
        $genderName = $config['genders'][$player['sex']] ?? ($player['sex'] == 0 ? 'Female' : 'Male');

        $lookAddonsCount = 0;
        if (cbz_has_table($db, 'player_outfits')) {
            $lookAddonsCount = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_outfits` WHERE `player_id` = {$playerId} AND `addons` > 0") ?? 0);
        }

        $mountCount = 0;
        if (cbz_has_table($db, 'player_mounts')) {
            $mountCount = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_mounts` WHERE `player_id` = {$playerId}") ?? 0);
        }

        $charmPoints = '-';
        $majorCharms = '-';
        $minorCharms = '-';
        if (cbz_has_table($db, 'player_charms')) {
            $charms = $db->query("SELECT * FROM `player_charms` WHERE `player_id` = {$playerId} LIMIT 1")->fetch();
            if ($charms) {
                $charmPoints = $charms['charm_points'] ?? '-';
                $usedRunes = $charms['UsedRunesBit'] ?? null;
                if ($usedRunes !== null) {
                    $unlocked = cbz_count_bits($usedRunes);
                    $majorCharms = $unlocked;
                    $minorCharms = $unlocked;
                }
            }
        }

        $bestiaryPoints = '-';
        if (cbz_has_table($db, 'player_bestiary')) {
            if (cbz_has_column($db, 'player_bestiary', 'charm_points')) {
                $bestiaryPoints = (int)(cbz_scalar($db, "SELECT SUM(`charm_points`) FROM `player_bestiary` WHERE `player_id` = {$playerId}") ?? 0);
            } else {
                $bestiaryPoints = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_bestiary` WHERE `player_id` = {$playerId}") ?? 0);
            }
        }

        $offenceStats = (int)$player['skill_sword'] + (int)$player['skill_axe'] + (int)$player['skill_club'] + (int)$player['skill_dist'] + (int)$player['maglevel'];
        $defenceStats = (int)$player['skill_shielding'] + (int)$player['skill_fist'];

        $loyaltyTitle = '-';
        if (cbz_has_column($db, 'players', 'loyalty_title')) {
            $loyaltyTitle = $player['loyalty_title'] ?: '-';
        }

        $summary = [
            'inventory' => (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_items` WHERE `player_id` = {$playerId} AND `pid` BETWEEN 1 AND 10") ?? 0),
            'depot' => cbz_has_table($db, 'player_depotitems') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_depotitems` WHERE `player_id` = {$playerId}") ?? 0) : '-',
            'supply_stash' => cbz_has_table($db, 'player_supplystash') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_supplystash` WHERE `player_id` = {$playerId}") ?? 0) : '-',
            'inbox' => cbz_has_table($db, 'player_inboxitems') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_inboxitems` WHERE `player_id` = {$playerId}") ?? 0) : '-',
            'store_inbox' => cbz_has_table($db, 'player_storeinboxitems') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_storeinboxitems` WHERE `player_id` = {$playerId}") ?? 0) : '-',
        ];

        $taskBoard = '-';
        if (cbz_has_table($db, 'task_hunting')) {
            $taskBoard = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `task_hunting` WHERE `player_id` = {$playerId}") ?? 0);
        } elseif (cbz_has_table($db, 'player_taskhunt')) {
            $taskBoard = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_taskhunt` WHERE `player_id` = {$playerId}") ?? 0);
        }

        $preyPermanent = cbz_has_column($db, 'players', 'prey_wildcard') ? (int)$player['prey_wildcard'] : '-';
        $preyWildcards = cbz_has_column($db, 'players', 'wildcard') ? (int)$player['wildcard'] : '-';

        $bosstiary = cbz_has_table($db, 'player_bosstiary') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_bosstiary` WHERE `player_id` = {$playerId}") ?? 0) : '-';
        $bossPoints = cbz_has_column($db, 'players', 'boss_points') ? (int)$player['boss_points'] : '-';

        $outfitUrl = "{$config['outfit_images_url']}?id={$player['looktype']}" . (!empty($player['lookaddons']) ? "&addons={$player['lookaddons']}" : '') . "&head={$player['lookhead']}&body={$player['lookbody']}&legs={$player['looklegs']}&feet={$player['lookfeet']}";

        return [
            'player' => $player,
            'name' => $player['name'],
            'level' => (int)$player['level'],
            'vocation' => $vocationName,
            'sex' => $genderName,
            'world' => $config['lua']['serverName'] ?? '-',
            'outfit_url' => $outfitUrl,
            'addons_count' => $lookAddonsCount,
            'mounts_count' => $mountCount,
            'bestiary_points' => $bestiaryPoints,
            'charm_points' => $charmPoints,
            'major_charms' => $majorCharms,
            'minor_charms' => $minorCharms,
            'defence_stats' => $defenceStats,
            'offence_stats' => $offenceStats,
            'loyalty_title' => $loyaltyTitle,
            'item_summary' => $summary,
            'task_board' => $taskBoard,
            'prey_permanent' => $preyPermanent,
            'prey_wildcards' => $preyWildcards,
            'bosstiary' => $bosstiary,
            'boss_points' => $bossPoints,
        ];
    }
}
