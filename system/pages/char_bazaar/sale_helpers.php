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

if (!function_exists('cbz_find_first_column')) {
    function cbz_find_first_column($db, $table, array $candidates)
    {
        foreach ($candidates as $column) {
            if (cbz_has_column($db, $table, $column)) {
                return $column;
            }
        }

        return null;
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

if (!function_exists('cbz_get_full_addons_list')) {
    function cbz_get_full_addons_list($db, $config, array $player)
    {
        $list = [];
        if (!cbz_has_table($db, 'player_outfits')) {
            return $list;
        }

        $playerIdCol = cbz_find_first_column($db, 'player_outfits', ['player_id', 'playerid']);
        $outfitIdCol = cbz_find_first_column($db, 'player_outfits', ['outfit_id', 'outfitid', 'looktype']);
        $addonsCol = cbz_find_first_column($db, 'player_outfits', ['addons', 'addon']);
        if (!$playerIdCol || !$outfitIdCol || !$addonsCol) {
            return $list;
        }

        $catalog = [];
        if (cbz_has_table($db, 'outfits')) {
            $catalogIdCol = cbz_find_first_column($db, 'outfits', ['id', 'outfit_id', 'looktype']);
            $catalogNameCol = cbz_find_first_column($db, 'outfits', ['name', 'outfit_name']);
            if ($catalogIdCol && $catalogNameCol) {
                foreach ($db->query('SELECT `' . $catalogIdCol . '` AS `id`, `' . $catalogNameCol . '` AS `name` FROM `outfits`') as $row) {
                    $catalog[(int)$row['id']] = (string)$row['name'];
                }
            }
        }

        $query = $db->query(
            'SELECT `' . $outfitIdCol . '` AS `outfit_id`, `' . $addonsCol . '` AS `addons` ' .
            'FROM `player_outfits` ' .
            'WHERE `' . $playerIdCol . '` = ' . (int)$player['id'] . ' AND `' . $addonsCol . '` >= 3 ' .
            'ORDER BY `' . $outfitIdCol . '` ASC'
        );

        if (!$query) {
            return $list;
        }

        foreach ($query as $row) {
            $outfitId = (int)$row['outfit_id'];
            $list[] = [
                'id' => $outfitId,
                'name' => $catalog[$outfitId] ?? ('Outfit #' . $outfitId),
                'addons' => (int)$row['addons'],
                'image' => getAssetImageById('outfit', $outfitId, [
                    'addons' => 3,
                    'head' => (int)$player['lookhead'],
                    'body' => (int)$player['lookbody'],
                    'legs' => (int)$player['looklegs'],
                    'feet' => (int)$player['lookfeet'],
                    'direction' => 3,
                ]),
            ];
        }

        return $list;
    }
}

if (!function_exists('cbz_get_full_mounts_list')) {
    function cbz_get_full_mounts_list($db, $config, array $player)
    {
        $list = [];
        if (!cbz_has_table($db, 'player_mounts')) {
            return $list;
        }

        $playerIdCol = cbz_find_first_column($db, 'player_mounts', ['player_id', 'playerid']);
        $mountIdCol = cbz_find_first_column($db, 'player_mounts', ['mount_id', 'mountid', 'mount']);
        if (!$playerIdCol || !$mountIdCol) {
            return $list;
        }

        $catalog = [];
        if (cbz_has_table($db, 'mounts')) {
            $catalogIdCol = cbz_find_first_column($db, 'mounts', ['id', 'mount_id']);
            $catalogNameCol = cbz_find_first_column($db, 'mounts', ['name', 'mount_name']);
            if ($catalogIdCol && $catalogNameCol) {
                foreach ($db->query('SELECT `' . $catalogIdCol . '` AS `id`, `' . $catalogNameCol . '` AS `name` FROM `mounts`') as $row) {
                    $catalog[(int)$row['id']] = (string)$row['name'];
                }
            }
        }

        $query = $db->query(
            'SELECT DISTINCT `' . $mountIdCol . '` AS `mount_id` FROM `player_mounts` ' .
            'WHERE `' . $playerIdCol . '` = ' . (int)$player['id'] . ' ' .
            'ORDER BY `' . $mountIdCol . '` ASC'
        );

        if (!$query) {
            return $list;
        }

        foreach ($query as $row) {
            $mountId = (int)$row['mount_id'];
            $list[] = [
                'id' => $mountId,
                'name' => $catalog[$mountId] ?? ('Mount #' . $mountId),
                'image' => getAssetImageById('mount', $mountId, [
                    'base' => (int)$player['looktype'],
                    'addons' => max(3, (int)($player['lookaddons'] ?? 0)),
                    'head' => (int)$player['lookhead'],
                    'body' => (int)$player['lookbody'],
                    'legs' => (int)$player['looklegs'],
                    'feet' => (int)$player['lookfeet'],
                    'direction' => 3,
                ]),
            ];
        }

        return $list;
    }
}

if (!function_exists('cbz_get_equipped_inventory')) {
    function cbz_get_equipped_inventory($db, $playerId)
    {
        $playerId = (int)$playerId;
        $emptySlots = [
            1 => 'no_helmet',
            2 => 'no_necklace',
            3 => 'no_backpack',
            4 => 'no_armor',
            5 => 'no_handleft',
            6 => 'no_handright',
            7 => 'no_legs',
            8 => 'no_boots',
            9 => 'no_ring',
            10 => 'no_ammo',
        ];
        $slots = [];
        foreach ($emptySlots as $pid => $fallback) {
            $slots[$pid] = '<img src="images/items/' . $fallback . '.gif" width="40" height="40" border="0" alt="' . $fallback . '" />';
        }

        if (!cbz_has_table($db, 'player_items')) {
            return $slots;
        }

        $pidCol = cbz_find_first_column($db, 'player_items', ['pid']);
        $itemCol = cbz_find_first_column($db, 'player_items', ['itemtype', 'item_id', 'itemid']);
        $playerCol = cbz_find_first_column($db, 'player_items', ['player_id', 'playerid']);
        if (!$pidCol || !$itemCol || !$playerCol) {
            return $slots;
        }

        $query = $db->query(
            'SELECT `' . $pidCol . '` AS `pid`, `' . $itemCol . '` AS `item` ' .
            'FROM `player_items` ' .
            'WHERE `' . $playerCol . '` = ' . $playerId . ' AND `' . $pidCol . '` BETWEEN 1 AND 10'
        );
        if (!$query) {
            return $slots;
        }

        foreach ($query as $row) {
            $pid = (int)$row['pid'];
            $itemId = (int)$row['item'];
            if ($pid < 1 || $pid > 10 || $itemId <= 0) {
                continue;
            }

            if (function_exists('getItemImage')) {
                $slots[$pid] = getItemImage($itemId);
            } else {
                $slots[$pid] = '<span class="rc-cbz-item-fallback">' . $itemId . '</span>';
            }
        }

        return $slots;
    }
}

if (!function_exists('cbz_get_item_bucket_rows')) {
    function cbz_get_item_bucket_rows($db, $table, $playerId, $limit = 120)
    {
        $rows = [];
        if (!cbz_has_table($db, $table)) {
            return $rows;
        }

        $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid']);
        $itemCol = cbz_find_first_column($db, $table, ['itemtype', 'item_id', 'itemid', 'sid']);
        $amountCol = cbz_find_first_column($db, $table, ['count', 'amount', 'item_count', 'itemcount']);
        if (!$playerCol || !$itemCol) {
            return $rows;
        }

        $amountSelect = $amountCol ? ('SUM(`' . $amountCol . '`)') : 'COUNT(*)';
        $query = $db->query(
            'SELECT `' . $itemCol . '` AS `item_id`, ' . $amountSelect . ' AS `amount` ' .
            'FROM `' . $table . '` ' .
            'WHERE `' . $playerCol . '` = ' . (int)$playerId . ' ' .
            'GROUP BY `' . $itemCol . '` ' .
            'ORDER BY `amount` DESC, `item_id` ASC ' .
            'LIMIT ' . (int)$limit
        );
        if (!$query) {
            return $rows;
        }

        foreach ($query as $row) {
            $itemId = (int)$row['item_id'];
            $amount = (int)$row['amount'];
            if ($itemId <= 0) {
                continue;
            }

            $rows[] = [
                'item_id' => $itemId,
                'amount' => max(1, $amount),
                'image' => function_exists('getItemImage') ? getItemImage($itemId) : '<span class="rc-cbz-item-fallback">' . $itemId . '</span>',
            ];
        }

        return $rows;
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
        $fullAddonsCount = 0;
        if (cbz_has_table($db, 'player_outfits')) {
            $lookAddonsCount = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_outfits` WHERE `player_id` = {$playerId} AND `addons` > 0") ?? 0);
            $fullAddonsCount = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_outfits` WHERE `player_id` = {$playerId} AND `addons` >= 3") ?? 0);
        }

        $mountCount = 0;
        if (cbz_has_table($db, 'player_mounts')) {
            $mountCount = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_mounts` WHERE `player_id` = {$playerId}") ?? 0);
        }

        $charmPoints = '-';
        $spentCharmPoints = '-';
        $majorCharms = '-';
        $minorCharms = '-';
        if (cbz_has_table($db, 'player_charms')) {
            $charms = $db->query("SELECT * FROM `player_charms` WHERE `player_id` = {$playerId} LIMIT 1")->fetch();
            if ($charms) {
                $charmPoints = $charms['charm_points'] ?? '-';
                if (isset($charms['spent_charm_points'])) {
                    $spentCharmPoints = $charms['spent_charm_points'];
                }
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

        $loyaltyPoints = ravynLoyaltyPoints((int)($player['account_id'] ?? 0));
        $loyaltyTitle = ravynLoyaltyTitle($loyaltyPoints);

        $summary = [
            'inventory' => (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_items` WHERE `player_id` = {$playerId} AND `pid` BETWEEN 1 AND 10") ?? 0),
            'depot' => cbz_has_table($db, 'player_depotitems') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_depotitems` WHERE `player_id` = {$playerId}") ?? 0) : '-',
            'supply_stash' => cbz_has_table($db, 'player_supplystash') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_supplystash` WHERE `player_id` = {$playerId}") ?? 0) : '-',
            'inbox' => cbz_has_table($db, 'player_inboxitems') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_inboxitems` WHERE `player_id` = {$playerId}") ?? 0) : '-',
            'store_inbox' => cbz_has_table($db, 'player_storeinboxitems') ? (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_storeinboxitems` WHERE `player_id` = {$playerId}") ?? 0) : '-',
        ];

        $itemSummaryRows = [
            'inventory' => cbz_get_item_bucket_rows($db, 'player_items', $playerId),
            'depot' => cbz_get_item_bucket_rows($db, 'player_depotitems', $playerId),
            'supply_stash' => cbz_get_item_bucket_rows($db, 'player_supplystash', $playerId),
            'inbox' => cbz_get_item_bucket_rows($db, 'player_inboxitems', $playerId),
            'store_inbox' => cbz_get_item_bucket_rows($db, 'player_storeinboxitems', $playerId),
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

        $outfitUrl = getAssetImageById('outfit', (int)$player['looktype'], [
            'addons' => !empty($player['lookaddons']) ? (int)$player['lookaddons'] : 0,
            'head' => (int)$player['lookhead'],
            'body' => (int)$player['lookbody'],
            'legs' => (int)$player['looklegs'],
            'feet' => (int)$player['lookfeet'],
            'direction' => 3,
        ]);

        $creationDate = '-';
        if (!empty($player['created']) && is_numeric($player['created'])) {
            $creationDate = date('M d Y, H:i:s', (int)$player['created']);
        } elseif (!empty($player['creation']) && is_numeric($player['creation'])) {
            $creationDate = date('M d Y, H:i:s', (int)$player['creation']);
        } elseif (!empty($player['created'])) {
            $creationDate = date('M d Y, H:i:s', strtotime($player['created']));
        } elseif (!empty($player['creation'])) {
            $creationDate = date('M d Y, H:i:s', strtotime($player['creation']));
        }

        $blessingsCount = 0;
        if (isset($player['blessings'])) {
            $blessingsCount = cbz_count_bits((int)$player['blessings']);
        }

        $charmExpansion = 'no';
        if (isset($player['charm_expansion']) && (int)$player['charm_expansion'] > 0) {
            $charmExpansion = 'yes';
        }

        return [
            'player' => $player,
            'name' => $player['name'],
            'level' => (int)$player['level'],
            'vocation' => $vocationName,
            'sex' => $genderName,
            'world' => $config['lua']['serverName'] ?? '-',
            'outfit_url' => $outfitUrl,
            'addons_count' => $lookAddonsCount,
            'full_addons_count' => $fullAddonsCount,
            'mounts_count' => $mountCount,
            'bestiary_points' => $bestiaryPoints,
            'charm_points' => $charmPoints,
            'spent_charm_points' => $spentCharmPoints,
            'major_charms' => $majorCharms,
            'minor_charms' => $minorCharms,
            'defence_stats' => $defenceStats,
            'offence_stats' => $offenceStats,
            'loyalty_points' => $loyaltyPoints,
            'loyalty_title' => $loyaltyTitle,
            'item_summary' => $summary,
            'item_summary_rows' => $itemSummaryRows,
            'task_board' => $taskBoard,
            'prey_permanent' => $preyPermanent,
            'prey_wildcards' => $preyWildcards,
            'bosstiary' => $bosstiary,
            'boss_points' => $bossPoints,
            'creation_date' => $creationDate,
            'blessings_count' => $blessingsCount,
            'charm_expansion' => $charmExpansion,
            'full_addons_list' => cbz_get_full_addons_list($db, $config, $player),
            'full_mounts_list' => cbz_get_full_mounts_list($db, $config, $player),
            'equipped_inventory' => cbz_get_equipped_inventory($db, $playerId),
        ];
    }
}

