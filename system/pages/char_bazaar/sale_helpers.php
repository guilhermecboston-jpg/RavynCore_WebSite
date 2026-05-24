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
        $sql =
            'SELECT `' . $itemCol . '` AS `item_id`, ' . $amountSelect . ' AS `amount` ' .
            'FROM `' . $table . '` ' .
            'WHERE `' . $playerCol . '` = ' . (int)$playerId . ' ' .
            'GROUP BY `' . $itemCol . '` ' .
            'ORDER BY `amount` DESC, `item_id` ASC';
        if ((int)$limit > 0) {
            $sql .= ' LIMIT ' . (int)$limit;
        }

        $query = $db->query($sql);
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

if (!function_exists('cbz_format_item_amount_rows')) {
    function cbz_format_item_amount_rows(array $amountByItem, $limit = 120)
    {
        if (!$amountByItem) {
            return [];
        }

        arsort($amountByItem);
        if ((int)$limit > 0) {
            $amountByItem = array_slice($amountByItem, 0, (int)$limit, true);
        }

        $rows = [];
        foreach ($amountByItem as $itemId => $amount) {
            $itemId = (int)$itemId;
            $amount = (int)$amount;
            if ($itemId <= 0 || $amount <= 0) {
                continue;
            }

            $rows[] = [
                'item_id' => $itemId,
                'amount' => $amount,
                'image' => function_exists('getItemImage') ? getItemImage($itemId) : '<span class="rc-cbz-item-fallback">' . $itemId . '</span>',
                'name' => function_exists('getItemNameById') ? (string)getItemNameById($itemId) : ('Item #' . $itemId),
            ];
        }

        return $rows;
    }
}

if (!function_exists('cbz_get_bucket_total_amount')) {
    function cbz_get_bucket_total_amount(array $rows)
    {
        $total = 0;
        foreach ($rows as $row) {
            $total += (int)($row['amount'] ?? 0);
        }

        return $total;
    }
}

if (!function_exists('cbz_get_item_bucket_rows_multi')) {
    function cbz_get_item_bucket_rows_multi($db, array $tables, $playerId, $limit = 120)
    {
        $amountByItem = [];
        foreach ($tables as $table) {
            if (!cbz_has_table($db, $table)) {
                continue;
            }

            $rows = cbz_get_item_bucket_rows($db, $table, $playerId, 0);
            foreach ($rows as $row) {
                $itemId = (int)($row['item_id'] ?? 0);
                $amount = (int)($row['amount'] ?? 0);
                if ($itemId <= 0 || $amount <= 0) {
                    continue;
                }

                if (!isset($amountByItem[$itemId])) {
                    $amountByItem[$itemId] = 0;
                }
                $amountByItem[$itemId] += $amount;
            }
        }

        return cbz_format_item_amount_rows($amountByItem, $limit);
    }
}

if (!function_exists('cbz_collect_amounts_by_item_from_rows')) {
    function cbz_collect_amounts_by_item_from_rows(array $rows)
    {
        $result = [];
        foreach ($rows as $row) {
            $itemId = (int)($row['item_id'] ?? 0);
            $amount = (int)($row['amount'] ?? 0);
            if ($itemId <= 0 || $amount <= 0) {
                continue;
            }

            if (!isset($result[$itemId])) {
                $result[$itemId] = 0;
            }
            $result[$itemId] += $amount;
        }

        return $result;
    }
}

if (!function_exists('cbz_get_backpack_item_bucket_rows')) {
    function cbz_get_backpack_item_bucket_rows($db, $playerId, $limit = 120)
    {
        if (!cbz_has_table($db, 'player_items')) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, 'player_items', ['player_id', 'playerid']);
        $itemCol = cbz_find_first_column($db, 'player_items', ['itemtype', 'item_id', 'itemid']);
        $pidCol = cbz_find_first_column($db, 'player_items', ['pid']);
        $sidCol = cbz_find_first_column($db, 'player_items', ['sid', 'serial']);
        $amountCol = cbz_find_first_column($db, 'player_items', ['count', 'amount', 'item_count', 'itemcount']);
        if (!$playerCol || !$itemCol || !$pidCol || !$sidCol) {
            return [];
        }

        $amountSelect = $amountCol ? ('`' . $amountCol . '`') : '1';
        $query = $db->query(
            'SELECT `' . $sidCol . '` AS `sid`, `' . $pidCol . '` AS `pid`, `' . $itemCol . '` AS `item_id`, ' . $amountSelect . ' AS `amount` ' .
            'FROM `player_items` WHERE `' . $playerCol . '` = ' . (int)$playerId
        );
        if (!$query) {
            return [];
        }

        $childrenByPid = [];
        $backpackRootSids = [];
        foreach ($query as $row) {
            $sid = (int)($row['sid'] ?? 0);
            $pid = (int)($row['pid'] ?? 0);

            if ($pid === 3 && $sid > 0) {
                $backpackRootSids[] = $sid;
            }

            if (!isset($childrenByPid[$pid])) {
                $childrenByPid[$pid] = [];
            }

            $childrenByPid[$pid][] = [
                'sid' => $sid,
                'item_id' => (int)($row['item_id'] ?? 0),
                'amount' => max(1, (int)($row['amount'] ?? 1)),
            ];
        }

        if (!$backpackRootSids) {
            return [];
        }

        $queue = array_values(array_unique($backpackRootSids));
        $visitedParents = [];
        $amountByItem = [];

        while ($queue) {
            $parentSid = (int)array_shift($queue);
            if ($parentSid <= 0 || isset($visitedParents[$parentSid])) {
                continue;
            }
            $visitedParents[$parentSid] = true;

            $children = $childrenByPid[$parentSid] ?? [];
            foreach ($children as $child) {
                $itemId = (int)$child['item_id'];
                $amount = (int)$child['amount'];
                if ($itemId > 0 && $amount > 0) {
                    if (!isset($amountByItem[$itemId])) {
                        $amountByItem[$itemId] = 0;
                    }
                    $amountByItem[$itemId] += $amount;
                }

                $childSid = (int)$child['sid'];
                if ($childSid > 0) {
                    $queue[] = $childSid;
                }
            }
        }

        return cbz_format_item_amount_rows($amountByItem, $limit);
    }
}

if (!function_exists('cbz_get_collection_name_map')) {
    function cbz_get_collection_name_map($db)
    {
        static $cachedMap = null;
        if (is_array($cachedMap)) {
            return $cachedMap;
        }

        $sources = [
            ['table' => 'myaac_monsters', 'id' => ['id'], 'name' => ['name']],
            ['table' => 'monsters', 'id' => ['id', 'raceid', 'monster_id'], 'name' => ['name']],
            ['table' => 'bestiary_creatures', 'id' => ['id', 'raceid', 'monster_id', 'classid'], 'name' => ['name', 'monster_name']],
            ['table' => 'bosstiary_creatures', 'id' => ['id', 'raceid', 'boss_id', 'monster_id'], 'name' => ['name', 'monster_name', 'boss_name']],
            ['table' => 'bosstiary_bosses', 'id' => ['id', 'boss_id', 'monster_id'], 'name' => ['name', 'boss_name', 'monster_name']],
        ];

        $map = [];
        foreach ($sources as $source) {
            $table = (string)$source['table'];
            if (!cbz_has_table($db, $table)) {
                continue;
            }

            $idCol = cbz_find_first_column($db, $table, $source['id']);
            $nameCol = cbz_find_first_column($db, $table, $source['name']);
            if (!$idCol || !$nameCol) {
                continue;
            }

            try {
                $query = $db->query('SELECT `' . $idCol . '` AS `id`, `' . $nameCol . '` AS `name` FROM `' . $table . '`');
                if (!$query) {
                    continue;
                }

                foreach ($query as $row) {
                    $id = (int)($row['id'] ?? 0);
                    $name = trim((string)($row['name'] ?? ''));
                    if ($id <= 0 || $name === '') {
                        continue;
                    }

                    if (!isset($map[$id])) {
                        $map[$id] = $name;
                    }
                }
            } catch (Exception $e) {
                continue;
            }
        }

        $cachedMap = $map;
        return $cachedMap;
    }
}

if (!function_exists('cbz_get_collection_rows')) {
    function cbz_get_collection_rows($db, $table, $playerId, $fallbackPrefix = 'Entry')
    {
        if (!cbz_has_table($db, $table)) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid']);
        $idCol = cbz_find_first_column($db, $table, ['monster_id', 'raceid', 'race_id', 'classid', 'class_id', 'creature_id', 'boss_id', 'bossid', 'id']);
        $progressCol = cbz_find_first_column($db, $table, ['kills', 'kill_count', 'killcount', 'amount', 'progress', 'points', 'stage']);
        $completedCol = cbz_find_first_column($db, $table, ['completed', 'is_completed', 'done', 'finished', 'status']);
        if (!$playerCol || !$idCol) {
            return [];
        }

        $selectColumns = ['`' . $idCol . '` AS `entry_id`'];
        if ($progressCol) {
            $selectColumns[] = '`' . $progressCol . '` AS `progress`';
        } else {
            $selectColumns[] = 'NULL AS `progress`';
        }

        if ($completedCol) {
            $selectColumns[] = '`' . $completedCol . '` AS `completed`';
        } else {
            $selectColumns[] = 'NULL AS `completed`';
        }

        $query = $db->query(
            'SELECT ' . implode(', ', $selectColumns) . ' FROM `' . $table . '` ' .
            'WHERE `' . $playerCol . '` = ' . (int)$playerId . ' ORDER BY `' . $idCol . '` ASC'
        );
        if (!$query) {
            return [];
        }

        $nameMap = cbz_get_collection_name_map($db);
        $rows = [];
        foreach ($query as $row) {
            $entryId = (int)($row['entry_id'] ?? 0);
            if ($entryId <= 0) {
                continue;
            }

            $completed = $row['completed'];
            if ($completed !== null && is_numeric($completed) && (int)$completed <= 0) {
                continue;
            }

            $progress = (int)($row['progress'] ?? 0);
            $rows[] = [
                'id' => $entryId,
                'name' => $nameMap[$entryId] ?? ($fallbackPrefix . ' #' . $entryId),
                'progress' => $progress,
            ];
        }

        return $rows;
    }
}

if (!function_exists('cbz_player_numeric_value')) {
    function cbz_player_numeric_value(array $player, array $candidates, $default = 0)
    {
        foreach ($candidates as $column) {
            if (array_key_exists($column, $player) && is_numeric($player[$column])) {
                return (int)$player[$column];
            }
        }

        return (int)$default;
    }
}

if (!function_exists('cbz_yes_no')) {
    function cbz_yes_no($value)
    {
        return ((int)$value > 0) ? 'Yes' : 'No';
    }
}

if (!function_exists('cbz_get_character_sale_data')) {
    function cbz_get_character_sale_data($db, $config, $playerId, array $options = [])
    {
        $playerId = (int)$playerId;
        $player = $db->query("SELECT * FROM `players` WHERE `id` = {$playerId}")->fetch();
        if (!$player) {
            return null;
        }

        $vocationName = $config['vocations'][$player['vocation']] ?? 'None';
        $genderName = $config['genders'][$player['sex']] ?? ($player['sex'] == 0 ? 'Female' : 'Male');
        $includeCollections = !array_key_exists('include_collections', $options) || (bool)$options['include_collections'];
        $includeItemSummary = !array_key_exists('include_item_summary', $options) || (bool)$options['include_item_summary'];
        $includeStones = !array_key_exists('include_stones', $options) || (bool)$options['include_stones'];

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

        $bestiaryList = $includeCollections ? cbz_get_collection_rows($db, 'player_bestiary', $playerId, 'Monster') : [];
        $bosstiaryList = $includeCollections ? cbz_get_collection_rows($db, 'player_bosstiary', $playerId, 'Boss') : [];

        $offenceStats = (int)$player['skill_sword'] + (int)$player['skill_axe'] + (int)$player['skill_club'] + (int)$player['skill_dist'] + (int)$player['maglevel'];
        $defenceStats = (int)$player['skill_shielding'] + (int)$player['skill_fist'];

        $wheelPoints = cbz_player_numeric_value($player, ['wheel_points', 'wheelpoints', 'wheel_point', 'points_wheel', 'wheel'], 0);

        $storeInboxTables = [];
        foreach (['player_storeinboxitems', 'player_storeinbox_items', 'player_storeinbox', 'player_storeinboxitem'] as $tableName) {
            if (cbz_has_table($db, $tableName)) {
                $storeInboxTables[] = $tableName;
            }
        }
        $storeInboxTables = array_values(array_unique($storeInboxTables));

        $inventoryRows = [];
        $depotRows = [];
        $supplyStashRows = [];
        $inboxRows = [];
        $storeInboxRows = [];
        $itemSummaryRows = [
            'inventory' => [],
            'depot' => [],
            'supply_stash' => [],
            'inbox' => [],
            'store_inbox' => [],
        ];
        $summary = [
            'inventory' => 0,
            'depot' => 0,
            'supply_stash' => 0,
            'inbox' => 0,
            'store_inbox' => 0,
        ];

        if ($includeItemSummary) {
            $inventoryRows = cbz_get_backpack_item_bucket_rows($db, $playerId);
            $depotRows = cbz_get_item_bucket_rows_multi($db, ['player_depotitems'], $playerId);
            $supplyStashRows = cbz_get_item_bucket_rows_multi($db, ['player_supplystash'], $playerId);
            $inboxRows = cbz_get_item_bucket_rows_multi($db, ['player_inboxitems'], $playerId);
            $storeInboxRows = cbz_get_item_bucket_rows_multi($db, $storeInboxTables, $playerId);

            $itemSummaryRows = [
                'inventory' => $inventoryRows,
                'depot' => $depotRows,
                'supply_stash' => $supplyStashRows,
                'inbox' => $inboxRows,
                'store_inbox' => $storeInboxRows,
            ];

            $summary = [
                'inventory' => cbz_get_bucket_total_amount($inventoryRows),
                'depot' => cbz_get_bucket_total_amount($depotRows),
                'supply_stash' => cbz_get_bucket_total_amount($supplyStashRows),
                'inbox' => cbz_get_bucket_total_amount($inboxRows),
                'store_inbox' => cbz_get_bucket_total_amount($storeInboxRows),
            ];
        }

        $taskBoard = '-';
        if (cbz_has_table($db, 'task_hunting')) {
            $taskBoard = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `task_hunting` WHERE `player_id` = {$playerId}") ?? 0);
        } elseif (cbz_has_table($db, 'player_taskhunt')) {
            $taskBoard = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_taskhunt` WHERE `player_id` = {$playerId}") ?? 0);
        }

        $preyWildcards = cbz_player_numeric_value($player, ['prey_wildcard', 'wildcard', 'prey_wildcards', 'wildcards'], 0);
        $preySlotRaw = cbz_player_numeric_value($player, [
            'third_prey_slot',
            'prey_slot_3',
            'prey_third_slot',
            'prey_slot_bonus',
            'prey_slots',
            'prey_slot_count',
            'prey_slot',
        ], 0);
        if ($preySlotRaw === 0) {
            $preySlotRaw = cbz_player_numeric_value($player, ['prey_unlocked'], 0);
        }
        $preyPermanent = cbz_yes_no($preySlotRaw >= 3 ? 1 : $preySlotRaw);

        $bosstiary = is_array($bosstiaryList) ? count($bosstiaryList) : 0;
        if (!$includeCollections && cbz_has_table($db, 'player_bosstiary')) {
            $bosstiary = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `player_bosstiary` WHERE `player_id` = {$playerId}") ?? 0);
        }
        $bossPoints = cbz_has_column($db, 'players', 'boss_points') ? (int)$player['boss_points'] : '-';

        $stonesTotal = 0;
        $stoneRows = [];
        $stoneDustTotal = 0;
        $ravynCoreTotal = 0;
        if ($includeStones && $includeItemSummary) {
            $stoneLevels = [
                [61826, 61833, 61840, 61772, 61777, 61783, 61789, 61795, 61801, 61807],
                [61829, 61836, 61843, 61767, 61773, 61779, 61785, 61791, 61797, 61803],
                [61832, 61839, 61846, 61809, 61810, 61811, 61812, 61813, 61814, 61815],
                [61828, 61835, 61842, 61769, 61775, 61781, 61787, 61793, 61799, 61805],
                [61827, 61834, 61841, 61768, 61774, 61780, 61786, 61792, 61798, 61804],
                [61831, 61838, 61845, 61771, 61778, 61784, 61790, 61796, 61802, 61806],
                [61830, 61837, 61844, 61770, 61776, 61782, 61788, 61794, 61800, 61808],
            ];
            $stoneIds = array_values(array_unique(array_merge(...$stoneLevels)));

            $stoneSourcesRows = [];
            foreach (['depot', 'inbox', 'store_inbox'] as $sourceKey) {
                foreach (($itemSummaryRows[$sourceKey] ?? []) as $row) {
                    $stoneSourcesRows[] = $row;
                }
            }

            $amountByItem = cbz_collect_amounts_by_item_from_rows($stoneSourcesRows);
            $stoneAmounts = [];
            foreach ($stoneIds as $stoneId) {
                $stoneAmounts[(int)$stoneId] = (int)($amountByItem[(int)$stoneId] ?? 0);
            }

            foreach ($stoneAmounts as $amount) {
                $stonesTotal += (int)$amount;
            }

            $stoneRows = cbz_format_item_amount_rows(array_filter($stoneAmounts), 0);
            $stoneDustTotal = (int)($amountByItem[60581] ?? 0);

            foreach ($amountByItem as $itemId => $amount) {
                $itemName = function_exists('getItemNameById') ? strtolower((string)getItemNameById((int)$itemId)) : '';
                if ($itemName !== '' && strpos($itemName, 'ravyncore') !== false) {
                    $ravynCoreTotal += (int)$amount;
                }
            }
        }

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

        $thirdStoneSlotRaw = cbz_player_numeric_value($player, [
            'stone_slot_3',
            'third_stone_slot',
            'stones_slot_3',
            'stone_slot3',
            'stones_slot3',
            'charm_expansion',
        ], 0);
        $thirdStoneSlot = cbz_yes_no($thirdStoneSlotRaw);

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
            'wheel_points' => $wheelPoints,
            'item_summary' => $summary,
            'item_summary_rows' => $itemSummaryRows,
            'task_board' => $taskBoard,
            'prey_permanent' => $preyPermanent,
            'prey_wildcards' => $preyWildcards,
            'bosstiary' => $bosstiary,
            'boss_points' => $bossPoints,
            'bestiary_list' => $bestiaryList,
            'bosstiary_list' => $bosstiaryList,
            'creation_date' => $creationDate,
            'blessings_count' => $blessingsCount,
            'third_stone_slot' => $thirdStoneSlot,
            'stones_total' => $stonesTotal,
            'stones_rows' => $stoneRows,
            'stone_dust_total' => $stoneDustTotal,
            'ravyncore_total' => $ravynCoreTotal,
            'full_addons_list' => cbz_get_full_addons_list($db, $config, $player),
            'full_mounts_list' => cbz_get_full_mounts_list($db, $config, $player),
            'equipped_inventory' => cbz_get_equipped_inventory($db, $playerId),
        ];
    }
}

