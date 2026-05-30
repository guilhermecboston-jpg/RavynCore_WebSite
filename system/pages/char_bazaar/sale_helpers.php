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

if (!function_exists('cbz_row_value')) {
    function cbz_row_value(array $row, array $candidates, $default = null)
    {
        foreach ($candidates as $candidate) {
            if (array_key_exists($candidate, $row)) {
                return $row[$candidate];
            }
        }

        foreach ($candidates as $candidate) {
            $candidateLower = strtolower((string)$candidate);
            foreach ($row as $key => $value) {
                if (strtolower((string)$key) === $candidateLower) {
                    return $value;
                }
            }
        }

        return $default;
    }
}

if (!function_exists('cbz_parse_tracker_ids')) {
    function cbz_parse_tracker_ids($rawValue)
    {
        if ($rawValue === null) {
            return [];
        }

        if (is_resource($rawValue)) {
            $rawValue = stream_get_contents($rawValue);
        }

        $rawText = (string)$rawValue;
        if ($rawText === '') {
            return [];
        }

        $ids = [];
        $hasBinaryBytes = (bool)preg_match('/[^\x09\x0A\x0D\x20-\x7E]/', $rawText);
        if ($hasBinaryBytes) {
            $length = strlen($rawText);
            for ($i = 0; $i + 1 < $length; $i += 2) {
                $id = ord($rawText[$i]) | (ord($rawText[$i + 1]) << 8);
                if ($id > 0) {
                    $ids[$id] = true;
                }
            }
        }

        $rawText = trim($rawText);
        if ($rawText === '') {
            return array_map('intval', array_keys($ids));
        }

        $collectIds = static function ($source, array &$ids) use (&$collectIds) {
            if (is_array($source)) {
                foreach ($source as $key => $entry) {
                    if (is_numeric($key) && !is_array($entry) && !is_object($entry)) {
                        $numericKey = (int)$key;
                        $entryEnabled = is_numeric($entry) ? ((int)$entry > 0) : (bool)$entry;
                        if ($numericKey > 0 && $entryEnabled) {
                            $ids[$numericKey] = true;
                        }
                    }

                    if (is_array($entry) || is_object($entry)) {
                        $collectIds($entry, $ids);
                        continue;
                    }

                    $normalizedKey = strtolower((string)$key);
                    if (in_array($normalizedKey, ['id', 'race', 'raceid', 'race_id', 'monster_id', 'monsterid', 'boss_id', 'bossid'], true) && is_numeric($entry)) {
                        $id = (int)$entry;
                        if ($id > 0) {
                            $ids[$id] = true;
                        }
                    }
                }

                return;
            }

            if (is_object($source)) {
                $collectIds((array)$source, $ids);
            }
        };

        $decoded = json_decode($rawText, true);
        if (json_last_error() === JSON_ERROR_NONE && $decoded !== null) {
            $collectIds($decoded, $ids);
            if ($ids) {
                return array_map('intval', array_keys($ids));
            }
        }

        if (preg_match_all('/\d+/', $rawText, $matches)) {
            foreach ($matches[0] as $value) {
                $id = (int)$value;
                if ($id > 0 && $id < 1000000) {
                    $ids[$id] = true;
                }
            }
        }

        return array_map('intval', array_keys($ids));
    }
}

if (!function_exists('cbz_get_table_blob_tracker_ids')) {
    function cbz_get_table_blob_tracker_ids($db, $table, $playerId, array $blobCandidates)
    {
        if (!cbz_has_table($db, $table)) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid', 'player_guid']);
        $blobCol = cbz_find_first_column($db, $table, $blobCandidates);
        if (!$playerCol || !$blobCol) {
            return [];
        }

        try {
            $stmt = $db->query(
                'SELECT `' . $blobCol . '` AS `tracker_blob` FROM `' . $table . '` ' .
                'WHERE `' . $playerCol . '` = ' . (int)$playerId . ' LIMIT 1'
            );
            if (!$stmt) {
                return [];
            }

            $row = $stmt->fetch();
            if (!$row || !array_key_exists('tracker_blob', $row)) {
                return [];
            }

            return cbz_parse_tracker_ids($row['tracker_blob']);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('cbz_parse_uint16_id_stream')) {
    function cbz_parse_uint16_id_stream($rawValue)
    {
        if ($rawValue === null) {
            return [];
        }
        if (is_resource($rawValue)) {
            $rawValue = stream_get_contents($rawValue);
        }

        $raw = (string)$rawValue;
        if ($raw === '') {
            return [];
        }

        $ids = [];
        $length = strlen($raw);
        for ($i = 0; $i + 1 < $length; $i += 2) {
            $id = ord($raw[$i]) | (ord($raw[$i + 1]) << 8);
            if ($id > 0) {
                $ids[$id] = true;
            }
        }

        return array_map('intval', array_keys($ids));
    }
}

if (!function_exists('cbz_get_player_bestiary_kill_map')) {
    function cbz_get_player_bestiary_kill_map($db, $playerId)
    {
        $playerId = (int)$playerId;
        $map = [];
        if ($playerId <= 0 || !cbz_has_table($db, 'player_storage')) {
            return $map;
        }

        $baseKey = 61305000;
        $maxKey = $baseKey + 5000;
        $playerCol = cbz_find_first_column($db, 'player_storage', ['player_id', 'playerid']);
        $keyCol = cbz_find_first_column($db, 'player_storage', ['key', 'storage_key']);
        $valueCol = cbz_find_first_column($db, 'player_storage', ['value', 'storage_value']);
        if (!$playerCol || !$keyCol || !$valueCol) {
            return $map;
        }

        $sql =
            'SELECT `' . $keyCol . '` AS `storage_key`, `' . $valueCol . '` AS `storage_value` ' .
            'FROM `player_storage` ' .
            'WHERE `' . $playerCol . '` = ' . $playerId .
            ' AND `' . $keyCol . '` > ' . $baseKey .
            ' AND `' . $keyCol . '` < ' . $maxKey .
            ' AND `' . $valueCol . '` > 0';

        $query = $db->query($sql);
        if (!$query) {
            return $map;
        }

        foreach ($query as $row) {
            $storageKey = (int)($row['storage_key'] ?? 0);
            $raceId = $storageKey - $baseKey;
            if ($raceId <= 0 || $raceId >= 65535) {
                continue;
            }

            $map[$raceId] = (int)($row['storage_value'] ?? 0);
        }

        return $map;
    }
}

if (!function_exists('cbz_get_player_bestiary_entry_ids')) {
    function cbz_get_player_bestiary_entry_ids($db, $playerId, array $trackerIds = [])
    {
        $ids = [];
        foreach ($trackerIds as $id) {
            $id = (int)$id;
            if ($id > 0) {
                $ids[$id] = true;
            }
        }

        foreach (cbz_get_player_bestiary_kill_map($db, $playerId) as $raceId => $kills) {
            if ((int)$kills > 0) {
                $ids[(int)$raceId] = true;
            }
        }

        return array_map('intval', array_keys($ids));
    }
}

if (!function_exists('cbz_get_player_bosstiary_entry_ids')) {
    function cbz_get_player_bosstiary_entry_ids($db, $playerId)
    {
        $playerId = (int)$playerId;
        $ids = [];
        if ($playerId <= 0 || !cbz_has_table($db, 'player_bosstiary')) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, 'player_bosstiary', ['player_id', 'playerid']);
        if (!$playerCol) {
            return [];
        }

        try {
            $stmt = $db->query('SELECT * FROM `player_bosstiary` WHERE `' . $playerCol . '` = ' . $playerId . ' LIMIT 1');
            if (!$stmt) {
                return [];
            }

            $row = $stmt->fetch();
            if (!$row) {
                return [];
            }

            foreach (['bossIdSlotOne', 'bossIdSlotTwo', 'boss_id_slot_one', 'boss_id_slot_two'] as $slotCol) {
                if (array_key_exists($slotCol, $row) && (int)$row[$slotCol] > 0) {
                    $ids[(int)$row[$slotCol]] = true;
                }
            }

            $trackerRaw = cbz_row_value($row, ['tracker', 'tracker_list', 'trackerlist'], null);
            foreach (cbz_parse_uint16_id_stream($trackerRaw) as $bossId) {
                if ($bossId > 0) {
                    $ids[$bossId] = true;
                }
            }
        } catch (Exception $e) {
            return [];
        }

        return array_map('intval', array_keys($ids));
    }
}

if (!function_exists('cbz_count_unlocked_charms_by_category')) {
    function cbz_count_unlocked_charms_by_category($bitfield, $minor = false)
    {
        $minorBits = [6, 9, 10, 11, 12, 13, 14, 17, 18, 20, 21];
        $count = 0;
        $bitfield = (int)$bitfield;

        for ($bit = 0; $bit < 32; $bit++) {
            if (($bitfield & (1 << $bit)) === 0) {
                continue;
            }

            $isMinorBit = in_array($bit, $minorBits, true);
            if ($minor === $isMinorBit) {
                $count++;
            }
        }

        return $count;
    }
}

if (!function_exists('cbz_build_collection_rows_from_ids')) {
    function cbz_build_collection_rows_from_ids($db, array $ids, $fallbackPrefix = 'Entry', array $progressById = [])
    {
        if (!$ids) {
            return [];
        }

        $nameMap = cbz_get_collection_name_map($db);
        $rows = [];
        foreach (array_values(array_unique(array_map('intval', $ids))) as $id) {
            if ($id <= 0) {
                continue;
            }

            $entryName = $nameMap[$id] ?? ($fallbackPrefix . ' #' . $id);
            $rows[] = [
                'id' => $id,
                'name' => $entryName,
                'progress' => (int)($progressById[$id] ?? 0),
                'image' => cbz_resolve_creature_image($id, $entryName),
            ];
        }

        usort($rows, static function ($a, $b) {
            return strcasecmp((string)$a['name'], (string)$b['name']);
        });

        return $rows;
    }
}

if (!function_exists('cbz_resolve_candidate_path')) {
    function cbz_resolve_candidate_path($candidate)
    {
        $candidate = trim((string)$candidate);
        if ($candidate === '') {
            return '';
        }

        if (preg_match('/^[A-Za-z]:[\/\\\\]/', $candidate) || strpos($candidate, '/') === 0) {
            return $candidate;
        }

        return BASE . ltrim($candidate, '/\\');
    }
}

if (!function_exists('cbz_find_first_existing_path')) {
    function cbz_find_first_existing_path(array $candidates)
    {
        foreach ($candidates as $candidate) {
            $path = cbz_resolve_candidate_path($candidate);
            if ($path !== '' && is_file($path)) {
                return $path;
            }
        }

        return '';
    }
}

if (!function_exists('cbz_load_bonus_xml')) {
    function cbz_load_bonus_xml($path, $kind)
    {
        $path = trim((string)$path);
        if ($path === '' || !is_file($path)) {
            return null;
        }

        $raw = @file_get_contents($path);
        if ($raw === false || $raw === '') {
            return null;
        }

        $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);
        if ($kind === 'outfits') {
            // Some forks duplicate "type" attr in outfits (gender + store type).
            $raw = preg_replace_callback('/<outfit\b([^>]*)>/i', function ($matches) {
                $attributes = (string)$matches[1];
                $attributes = preg_replace('/\s+type="store"/i', ' storeType="store"', $attributes);
                return '<outfit' . $attributes . '>';
            }, $raw);
        }

        $xml = @simplexml_load_string($raw);
        return $xml !== false ? $xml : null;
    }
}

if (!function_exists('cbz_bonus_to_float')) {
    function cbz_bonus_to_float($value)
    {
        return (float)str_replace(',', '.', trim((string)$value));
    }
}

if (!function_exists('cbz_bonus_add_value')) {
    function cbz_bonus_add_value(array &$map, $label, $value, $suffix = '')
    {
        $label = trim((string)$label);
        if ($label === '') {
            return;
        }

        $number = cbz_bonus_to_float($value);
        if (abs($number) < 0.00001) {
            return;
        }

        if (!isset($map[$label])) {
            $map[$label] = ['value' => 0.0, 'suffix' => (string)$suffix];
        }
        $map[$label]['value'] += $number;
        if (!isset($map[$label]['suffix']) || $map[$label]['suffix'] === '') {
            $map[$label]['suffix'] = (string)$suffix;
        }
    }
}

if (!function_exists('cbz_collect_bonus_map_from_xml_entry')) {
    function cbz_collect_bonus_map_from_xml_entry($entry)
    {
        $map = [];
        if (!$entry) {
            return $map;
        }

        cbz_bonus_add_value($map, 'Speed', isset($entry['speed']) ? (string)$entry['speed'] : 0);
        cbz_bonus_add_value($map, 'Attack Speed', isset($entry['attackSpeed']) ? (string)$entry['attackSpeed'] : 0);

        $healthGain = isset($entry['healthGain']) ? cbz_bonus_to_float((string)$entry['healthGain']) : 0.0;
        $healthTicks = isset($entry['healthTicks']) ? (int)cbz_bonus_to_float((string)$entry['healthTicks']) : 0;
        if (abs($healthGain) > 0.00001) {
            $regenLabel = $healthTicks > 0 ? ('HP Regen / ' . $healthTicks . 's') : 'HP Regen';
            cbz_bonus_add_value($map, $regenLabel, $healthGain);
        }

        $manaGain = isset($entry['manaGain']) ? cbz_bonus_to_float((string)$entry['manaGain']) : 0.0;
        $manaTicks = isset($entry['manaTicks']) ? (int)cbz_bonus_to_float((string)$entry['manaTicks']) : 0;
        if (abs($manaGain) > 0.00001) {
            $regenLabel = $manaTicks > 0 ? ('MP Regen / ' . $manaTicks . 's') : 'MP Regen';
            cbz_bonus_add_value($map, $regenLabel, $manaGain);
        }

        $manaShield = strtolower(trim((string)($entry['manaShield'] ?? '')));
        if ($manaShield === 'yes' || $manaShield === 'true' || $manaShield === '1') {
            $map['Mana Shield'] = ['value' => 1.0, 'suffix' => 'flag'];
        }

        $skillsMap = [
            'fist' => 'Fist',
            'club' => 'Club',
            'axe' => 'Axe',
            'sword' => 'Sword',
            'distance' => 'Distance',
            'shielding' => 'Shielding',
            'fishing' => 'Fishing',
        ];
        if (isset($entry->skills)) {
            foreach ($skillsMap as $xmlName => $label) {
                if (isset($entry->skills->{$xmlName})) {
                    cbz_bonus_add_value($map, $label, (string)$entry->skills->{$xmlName}['value']);
                }
            }
        }

        $statsMap = [
            'maxHealth' => 'Max HP',
            'maxMana' => 'Max MP',
            'cap' => 'Cap',
            'magicLevel' => 'Magic Level',
        ];
        if (isset($entry->stats)) {
            foreach ($statsMap as $xmlName => $label) {
                if (isset($entry->stats->{$xmlName})) {
                    cbz_bonus_add_value($map, $label, (string)$entry->stats->{$xmlName}['value']);
                }
            }
        }

        $imbuingMap = [
            'lifeleechchance' => 'Life Leech Chance',
            'lifeleechamount' => 'Life Leech Amount',
            'manaleechchance' => 'Mana Leech Chance',
            'manaleechamount' => 'Mana Leech Amount',
            'criticalchance' => 'Critical Chance',
            'criticaldamage' => 'Critical Damage',
        ];
        if (isset($entry->imbuing)) {
            foreach ($imbuingMap as $xmlName => $label) {
                if (isset($entry->imbuing->{$xmlName})) {
                    cbz_bonus_add_value($map, $label, (string)$entry->imbuing->{$xmlName}['value'], '%');
                }
            }
        }

        $extraMap = [
            'onslaught' => 'Onslaught',
            'momentum' => 'Momentum',
            'ruse' => 'Ruse',
            'transcendence' => 'Transcendence',
        ];
        if (isset($entry->attributes)) {
            foreach ($extraMap as $xmlName => $label) {
                if (isset($entry->attributes->{$xmlName})) {
                    cbz_bonus_add_value($map, $label, (string)$entry->attributes->{$xmlName}['value'], '%');
                }
            }
        }

        return $map;
    }
}

if (!function_exists('cbz_merge_bonus_maps')) {
    function cbz_merge_bonus_maps(array &$target, array $source)
    {
        foreach ($source as $label => $row) {
            $value = (float)($row['value'] ?? 0);
            $suffix = (string)($row['suffix'] ?? '');
            if (!isset($target[$label])) {
                $target[$label] = ['value' => 0.0, 'suffix' => $suffix];
            }
            $target[$label]['value'] += $value;
            if (!isset($target[$label]['suffix']) || $target[$label]['suffix'] === '') {
                $target[$label]['suffix'] = $suffix;
            }
        }
    }
}

if (!function_exists('cbz_format_bonus_number')) {
    function cbz_format_bonus_number($value)
    {
        $number = (float)$value;
        if (abs($number - round($number)) < 0.00001) {
            return (string)(int)round($number);
        }

        $formatted = number_format($number, 2, '.', '');
        return rtrim(rtrim($formatted, '0'), '.');
    }
}

if (!function_exists('cbz_bonus_map_to_lines')) {
    function cbz_bonus_map_to_lines(array $map)
    {
        if (!$map) {
            return [];
        }

        ksort($map, SORT_NATURAL | SORT_FLAG_CASE);
        $lines = [];
        foreach ($map as $label => $row) {
            $value = (float)($row['value'] ?? 0);
            $suffix = (string)($row['suffix'] ?? '');
            if ($suffix === 'flag') {
                if ($value > 0) {
                    $lines[] = $label . ': Ativo';
                }
                continue;
            }

            if (abs($value) < 0.00001) {
                continue;
            }

            $sign = $value > 0 ? '+' : '';
            $lines[] = $label . ': ' . $sign . cbz_format_bonus_number($value) . $suffix;
        }

        return $lines;
    }
}

if (!function_exists('cbz_get_player_bonus_system_data')) {
    function cbz_get_player_bonus_system_data($db, $config, $playerId)
    {
        $result = [
            'outfits_used' => 0,
            'mounts_used' => 0,
            'bonus_lines' => [],
        ];

        $playerId = (int)$playerId;
        if ($playerId <= 0) {
            return $result;
        }

        $serverPath = isset($config['server_path']) ? trim((string)$config['server_path']) : '';
        if ($serverPath !== '' && !preg_match('/[\/\\\\]$/', $serverPath)) {
            $serverPath .= '/';
        }
        $ravynCoreCfg = (isset($config['ravyncore']) && is_array($config['ravyncore'])) ? $config['ravyncore'] : [];

        $outfitsPath = cbz_find_first_existing_path([
            $ravynCoreCfg['outfits_xml_path'] ?? ($config['outfits_xml_path'] ?? ''),
            $serverPath . 'data/XML/outfits.xml',
            $serverPath . 'data/xml/outfits.xml',
            'C:\\Users\\PICHAU\\Desktop\\DURVAL\\RavynCore\\data\\XML\\outfits.xml',
            'system/data/outfits.xml',
            'system/data/XML/outfits.xml',
            'outfits.xml',
        ]);
        $mountsPath = cbz_find_first_existing_path([
            $ravynCoreCfg['mounts_xml_path'] ?? ($config['mounts_xml_path'] ?? ''),
            $serverPath . 'data/XML/mounts.xml',
            $serverPath . 'data/xml/mounts.xml',
            'C:\\Users\\PICHAU\\Desktop\\DURVAL\\RavynCore\\data\\XML\\mounts.xml',
            'system/data/mounts.xml',
            'system/data/XML/mounts.xml',
            'mounts.xml',
        ]);

        $outfitsXml = cbz_load_bonus_xml($outfitsPath, 'outfits');
        $mountsXml = cbz_load_bonus_xml($mountsPath, 'mounts');

        $outfitBonusByLookType = [];
        if ($outfitsXml && isset($outfitsXml->outfit)) {
            foreach ($outfitsXml->outfit as $outfitNode) {
                $lookType = isset($outfitNode['looktype']) ? (int)cbz_bonus_to_float((string)$outfitNode['looktype']) : 0;
                if ($lookType <= 0) {
                    continue;
                }
                $outfitBonusByLookType[$lookType] = cbz_collect_bonus_map_from_xml_entry($outfitNode);
            }
        }

        $mountBonusById = [];
        if ($mountsXml && isset($mountsXml->mount)) {
            foreach ($mountsXml->mount as $mountNode) {
                $mountId = isset($mountNode['id']) ? (int)cbz_bonus_to_float((string)$mountNode['id']) : 0;
                if ($mountId <= 0) {
                    continue;
                }
                $mountBonusById[$mountId] = cbz_collect_bonus_map_from_xml_entry($mountNode);
            }
        }

        $outfitIds = [];
        if (cbz_has_table($db, 'player_outfits')) {
            $playerCol = cbz_find_first_column($db, 'player_outfits', ['player_id', 'playerid']);
            $outfitCol = cbz_find_first_column($db, 'player_outfits', ['outfit_id', 'outfitid', 'looktype']);
            $addonsCol = cbz_find_first_column($db, 'player_outfits', ['addons', 'addon']);
            if ($playerCol && $outfitCol && $addonsCol) {
                $query = $db->query(
                    'SELECT `' . $outfitCol . '` AS `outfit_id` FROM `player_outfits` ' .
                    'WHERE `' . $playerCol . '` = ' . $playerId . ' AND `' . $addonsCol . '` > 0'
                );
                if ($query) {
                    foreach ($query as $row) {
                        $outfitId = (int)($row['outfit_id'] ?? 0);
                        if ($outfitId > 0) {
                            $outfitIds[$outfitId] = true;
                        }
                    }
                }
            }
        }

        $mountIds = [];
        if (cbz_has_table($db, 'player_mounts')) {
            $playerCol = cbz_find_first_column($db, 'player_mounts', ['player_id', 'playerid']);
            $mountCol = cbz_find_first_column($db, 'player_mounts', ['mount_id', 'mountid', 'mount']);
            if ($playerCol && $mountCol) {
                $query = $db->query(
                    'SELECT DISTINCT `' . $mountCol . '` AS `mount_id` FROM `player_mounts` ' .
                    'WHERE `' . $playerCol . '` = ' . $playerId
                );
                if ($query) {
                    foreach ($query as $row) {
                        $mountId = (int)($row['mount_id'] ?? 0);
                        if ($mountId > 0) {
                            $mountIds[$mountId] = true;
                        }
                    }
                }
            }
        }

        $totalBonusMap = [];
        foreach (array_keys($outfitIds) as $outfitId) {
            if (!isset($outfitBonusByLookType[$outfitId])) {
                continue;
            }
            cbz_merge_bonus_maps($totalBonusMap, $outfitBonusByLookType[$outfitId]);
            $result['outfits_used']++;
        }

        foreach (array_keys($mountIds) as $mountId) {
            if (!isset($mountBonusById[$mountId])) {
                continue;
            }
            cbz_merge_bonus_maps($totalBonusMap, $mountBonusById[$mountId]);
            $result['mounts_used']++;
        }

        $result['bonus_lines'] = cbz_bonus_map_to_lines($totalBonusMap);
        if (!$result['bonus_lines']) {
            $result['bonus_lines'] = ['Sem bonus mapeado para outfits/mounts deste personagem.'];
        }

        return $result;
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
        $itemCol = cbz_find_first_column($db, 'player_items', ['itemtype', 'itemType', 'item_id', 'itemid', 'itemId']);
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
        if (!cbz_has_table($db, $table)) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid']);
        $itemCol = cbz_find_first_column($db, $table, ['itemtype', 'itemType', 'item_id', 'itemid', 'itemId', 'type']);
        $amountCol = cbz_find_first_column($db, $table, ['count', 'amount', 'item_count', 'itemcount', 'quantity']);
        if (!$playerCol || !$itemCol) {
            return [];
        }

        $amountSelect = $amountCol ? ('`' . $amountCol . '`') : '1';
        $query = $db->query(
            'SELECT `' . $itemCol . '` AS `item_id`, ' . $amountSelect . ' AS `amount` ' .
            'FROM `' . $table . '` WHERE `' . $playerCol . '` = ' . (int)$playerId
        );
        if (!$query) {
            return [];
        }

        $amountByItem = [];
        foreach ($query as $row) {
            $itemId = (int)$row['item_id'];
            $amount = (int)$row['amount'];
            if ($itemId <= 0) {
                continue;
            }

            if ($amount <= 0) {
                $amount = 1;
            }

            if (!isset($amountByItem[$itemId])) {
                $amountByItem[$itemId] = 0;
            }
            $amountByItem[$itemId] += $amount;
        }

        return cbz_format_item_amount_rows($amountByItem, $limit);
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

if (!function_exists('cbz_merge_item_bucket_row_sets')) {
    function cbz_merge_item_bucket_row_sets(array $rowSets, $limit = 120)
    {
        $amountByItem = [];
        foreach ($rowSets as $rows) {
            if (!is_array($rows)) {
                continue;
            }

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

if (!function_exists('cbz_get_player_items_flat_rows')) {
    function cbz_get_player_items_flat_rows($db, $playerId)
    {
        if (!cbz_has_table($db, 'player_items')) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, 'player_items', ['player_id', 'playerid']);
        $itemCol = cbz_find_first_column($db, 'player_items', ['itemtype', 'item_id', 'itemid', 'itemId']);
        $pidCol = cbz_find_first_column($db, 'player_items', ['pid']);
        $sidCol = cbz_find_first_column($db, 'player_items', ['sid', 'serial']);
        $amountCol = cbz_find_first_column($db, 'player_items', ['count', 'amount', 'item_count', 'itemcount', 'quantity']);
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

        $rows = [];
        foreach ($query as $row) {
            $rows[] = [
                'sid' => (int)($row['sid'] ?? 0),
                'pid' => (int)($row['pid'] ?? 0),
                'item_id' => (int)($row['item_id'] ?? 0),
                'amount' => (int)($row['amount'] ?? 1),
            ];
        }

        return $rows;
    }
}

if (!function_exists('cbz_get_player_items_bucket_rows_by_roots')) {
    function cbz_get_player_items_bucket_rows_by_roots($db, $playerId, array $rootPids, $limit = 120)
    {
        $rootPids = array_values(array_unique(array_map('intval', $rootPids)));
        if (!$rootPids) {
            return [];
        }

        $rows = cbz_get_player_items_flat_rows($db, $playerId);
        if (!$rows) {
            return [];
        }

        $childrenByPid = [];
        $rootNodes = [];
        foreach ($rows as $row) {
            $pid = (int)$row['pid'];
            if (!isset($childrenByPid[$pid])) {
                $childrenByPid[$pid] = [];
            }
            $childrenByPid[$pid][] = $row;

            if (in_array($pid, $rootPids, true)) {
                $rootNodes[] = $row;
            }
        }

        if (!$rootNodes) {
            return [];
        }

        $queue = $rootNodes;
        $visitedSids = [];
        $amountByItem = [];

        while (!empty($queue)) {
            $node = array_shift($queue);
            $sid = (int)($node['sid'] ?? 0);
            if ($sid > 0) {
                if (isset($visitedSids[$sid])) {
                    continue;
                }
                $visitedSids[$sid] = true;
            }

            $itemId = (int)($node['item_id'] ?? 0);
            $amount = (int)($node['amount'] ?? 1);
            if ($itemId > 0) {
                if ($amount <= 0) {
                    $amount = 1;
                }
                if (!isset($amountByItem[$itemId])) {
                    $amountByItem[$itemId] = 0;
                }
                $amountByItem[$itemId] += $amount;
            }

            if ($sid > 0 && isset($childrenByPid[$sid])) {
                foreach ($childrenByPid[$sid] as $childRow) {
                    $queue[] = $childRow;
                }
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
        $amountCol = cbz_find_first_column($db, 'player_items', ['count', 'amount', 'item_count', 'itemcount', 'quantity']);
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

        if (count($map) < 20) {
            $luaMap = cbz_get_monster_lua_race_name_map();
            foreach ($luaMap as $id => $name) {
                $id = (int)$id;
                $name = trim((string)$name);
                if ($id <= 0 || $name === '') {
                    continue;
                }

                if (!isset($map[$id])) {
                    $map[$id] = $name;
                }
            }
        }

        $cachedMap = $map;
        return $cachedMap;
    }
}

if (!function_exists('cbz_get_monster_lua_search_dirs')) {
    function cbz_get_monster_lua_search_dirs()
    {
        $dirs = [];

        if (function_exists('config')) {
            $dataPath = trim((string)config('data_path'));
            if ($dataPath !== '') {
                $dirs[] = rtrim($dataPath, "/\\") . DIRECTORY_SEPARATOR . 'monster';
            }

            $serverPath = trim((string)config('server_path'));
            if ($serverPath !== '') {
                $serverPath = rtrim($serverPath, "/\\");
                $dirs[] = $serverPath . DIRECTORY_SEPARATOR . 'data-global' . DIRECTORY_SEPARATOR . 'monster';
                $dirs[] = $serverPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'monster';
            }
        }

        $uniqueDirs = [];
        foreach ($dirs as $dir) {
            $normalized = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $dir);
            if ($normalized === '' || isset($uniqueDirs[$normalized])) {
                continue;
            }
            if (!is_dir($normalized) || !is_readable($normalized)) {
                continue;
            }

            $uniqueDirs[$normalized] = true;
        }

        return array_keys($uniqueDirs);
    }
}

if (!function_exists('cbz_get_monster_lua_race_meta_map')) {
    function cbz_get_monster_lua_race_meta_map()
    {
        static $cachedMap = null;
        if (is_array($cachedMap)) {
            return $cachedMap;
        }

        $map = [];
        $dirs = cbz_get_monster_lua_search_dirs();
        if (!$dirs) {
            $cachedMap = $map;
            return $cachedMap;
        }

        $namePattern = '/Game\\.createMonsterType\\(\\s*[\'"]([^\'"]+)[\'"]\\s*\\)/i';
        $racePatterns = [
            '/monster\\.raceId\\s*=\\s*(\\d+)/i',
            '/monster\\.bossRaceId\\s*=\\s*(\\d+)/i',
            '/bossRaceId\\s*=\\s*(\\d+)/i',
        ];
        $outfitPatterns = [
            'lookType' => '/lookType\\s*=\\s*(\\d+)/i',
            'lookAddons' => '/lookAddons\\s*=\\s*(\\d+)/i',
            'lookHead' => '/lookHead\\s*=\\s*(\\d+)/i',
            'lookBody' => '/lookBody\\s*=\\s*(\\d+)/i',
            'lookLegs' => '/lookLegs\\s*=\\s*(\\d+)/i',
            'lookFeet' => '/lookFeet\\s*=\\s*(\\d+)/i',
        ];

        foreach ($dirs as $dir) {
            try {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS | FilesystemIterator::FOLLOW_SYMLINKS)
                );
            } catch (Exception $e) {
                continue;
            }

            foreach ($iterator as $fileInfo) {
                /** @var SplFileInfo $fileInfo */
                if (!$fileInfo->isFile()) {
                    continue;
                }
                if (strtolower($fileInfo->getExtension()) !== 'lua') {
                    continue;
                }

                $content = @file_get_contents($fileInfo->getPathname());
                if ($content === false || $content === '') {
                    continue;
                }

                if (!preg_match($namePattern, $content, $nameMatch)) {
                    continue;
                }
                $raceId = 0;
                foreach ($racePatterns as $racePattern) {
                    if (preg_match($racePattern, $content, $raceMatch)) {
                        $raceId = (int)($raceMatch[1] ?? 0);
                        break;
                    }
                }
                if ($raceId <= 0) {
                    continue;
                }

                $name = trim((string)($nameMatch[1] ?? ''));
                if ($name === '') {
                    continue;
                }

                if (!isset($map[$raceId])) {
                    $meta = ['name' => $name];
                    foreach ($outfitPatterns as $key => $pattern) {
                        if (preg_match($pattern, $content, $outfitMatch)) {
                            $meta[$key] = (int)($outfitMatch[1] ?? 0);
                        }
                    }
                    $map[$raceId] = $meta;
                }
            }
        }

        $cachedMap = $map;
        return $cachedMap;
    }
}

if (!function_exists('cbz_get_monster_lua_race_name_map')) {
    function cbz_get_monster_lua_race_name_map()
    {
        $map = [];
        foreach (cbz_get_monster_lua_race_meta_map() as $raceId => $meta) {
            $name = trim((string)($meta['name'] ?? ''));
            if ($name !== '') {
                $map[(int)$raceId] = $name;
            }
        }

        return $map;
    }
}

if (!function_exists('cbz_slugify_name')) {
    function cbz_slugify_name($name)
    {
        $value = (string)$name;
        $ascii = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        if ($ascii !== false && $ascii !== '') {
            $value = $ascii;
        }

        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]+/', '', $value);
        return trim((string)$value);
    }
}

if (!function_exists('cbz_get_library_creature_image')) {
    function cbz_get_library_creature_image($name)
    {
        static $cache = [];
        $name = (string)$name;
        if (isset($cache[$name])) {
            return $cache[$name];
        }

        $slug = cbz_slugify_name($name);
        if ($slug === '') {
            $cache[$name] = '';
            return '';
        }

        $slugCandidates = [$slug];
        if (substr($slug, -1) === 's' && strlen($slug) > 3) {
            $slugCandidates[] = substr($slug, 0, -1);
        }
        if (substr($slug, -2) === 'es' && strlen($slug) > 4) {
            $slugCandidates[] = substr($slug, 0, -2);
        }
        $slugCandidates = array_values(array_unique($slugCandidates));

        $extCandidates = ['gif', 'png', 'jpg', 'webp'];
        foreach ($slugCandidates as $slugCandidate) {
            foreach ($extCandidates as $ext) {
                $relative = 'images/library/' . $slugCandidate . '.' . $ext;
                $absolute = BASE . $relative;
                if (is_file($absolute)) {
                    $cache[$name] = BASE_URL . str_replace('\\', '/', $relative);
                    return $cache[$name];
                }
            }
        }

        $cache[$name] = '';
        return '';
    }
}

if (!function_exists('cbz_resolve_creature_image')) {
    function cbz_resolve_creature_image($raceId, $name)
    {
        $raceId = (int)$raceId;
        $name = (string)$name;

        $libraryImage = cbz_get_library_creature_image($name);
        if ($libraryImage !== '') {
            return $libraryImage;
        }

        if ($raceId <= 0) {
            return '';
        }

        $meta = cbz_get_monster_lua_race_meta_map()[$raceId] ?? null;
        if (!is_array($meta) || empty($meta['lookType'])) {
            return '';
        }

        if (!function_exists('getAssetImageById')) {
            return '';
        }

        return getAssetImageById('outfit', (int)$meta['lookType'], [
            'addons' => (int)($meta['lookAddons'] ?? 0),
            'head' => (int)($meta['lookHead'] ?? 0),
            'body' => (int)($meta['lookBody'] ?? 0),
            'legs' => (int)($meta['lookLegs'] ?? 0),
            'feet' => (int)($meta['lookFeet'] ?? 0),
            'direction' => 3,
        ]);
    }
}

if (!function_exists('cbz_get_collection_rows')) {
    function cbz_get_collection_rows($db, $table, $playerId, $fallbackPrefix = 'Entry')
    {
        if (!cbz_has_table($db, $table)) {
            return [];
        }

        $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid']);
        $idCol = cbz_find_first_column($db, $table, ['monster_id', 'monster', 'raceid', 'race_id', 'race', 'classid', 'class_id', 'creature_id', 'creature', 'boss_id', 'bossid', 'boss', 'id']);
        $progressCol = cbz_find_first_column($db, $table, ['kills', 'kill_count', 'killcount', 'amount', 'progress', 'points', 'stage', 'value']);
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

            $progress = (int)($row['progress'] ?? 0);
            $completed = $row['completed'];
            if ($completed !== null && is_numeric($completed) && (int)$completed <= 0 && $progress <= 0) {
                continue;
            }

            $rows[] = [
                'id' => $entryId,
                'name' => $nameMap[$entryId] ?? ($fallbackPrefix . ' #' . $entryId),
                'progress' => $progress,
            ];
        }

        foreach ($rows as &$row) {
            $row['image'] = cbz_resolve_creature_image((int)($row['id'] ?? 0), (string)($row['name'] ?? ''));
        }
        unset($row);

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

if (!function_exists('cbz_kv_value_is_truthy')) {
    function cbz_kv_value_is_truthy($rawValue)
    {
        if ($rawValue === null) {
            return false;
        }
        if (is_resource($rawValue)) {
            $rawValue = stream_get_contents($rawValue);
        }

        $raw = (string)$rawValue;
        if ($raw === '') {
            return false;
        }

        // Protobuf deleted marker or empty wrapper — treat as unset.
        if (strpos($raw, 'deleted') !== false) {
            return false;
        }

        return true;
    }
}

if (!function_exists('cbz_get_player_wheel_kv_scroll_flags')) {
    function cbz_get_player_wheel_kv_scroll_flags($db, $playerId)
    {
        $playerId = (int)$playerId;
        $flags = [];
        if ($playerId <= 0 || !cbz_has_table($db, 'kv_store')) {
            return $flags;
        }

        $prefix = 'player.' . $playerId . '.wheel-of-destiny.scrolls.';
        $sql = 'SELECT `key_name`, `value` FROM `kv_store` WHERE `key_name` LIKE ' . $db->quote($prefix . '%');
        $query = $db->query($sql);
        if (!$query) {
            return $flags;
        }

        foreach ($query as $row) {
            $keyName = (string)($row['key_name'] ?? '');
            if ($keyName === '' || !cbz_kv_value_is_truthy($row['value'] ?? null)) {
                continue;
            }

            $scrollName = substr($keyName, strlen($prefix));
            if ($scrollName !== '') {
                $flags[$scrollName] = true;
            }
        }

        return $flags;
    }
}

if (!function_exists('cbz_get_wheel_destiny_scroll_data')) {
    function cbz_get_wheel_destiny_scroll_data($db, $playerId, array $player = [], array $storageValues = [])
    {
        $scrollDefinitions = [
            'abridged' => [
                'points' => 3,
                'legacy_storage' => 95121,
                'legacy_columns' => [
                    'initiate_promotion_scroll',
                    'promotion_points_initiate',
                    'promotion_point_initiate',
                    'wheel_promotion_initiate',
                    'promotion_initiate',
                ],
            ],
            'basic' => [
                'points' => 5,
                'legacy_storage' => 95122,
                'legacy_columns' => [
                    'ascendant_promotion_scroll',
                    'promotion_points_ascendant',
                    'promotion_point_ascendant',
                    'wheel_promotion_ascendant',
                    'promotion_ascendant',
                ],
            ],
            'revised' => [
                'points' => 9,
                'legacy_storage' => 95123,
                'legacy_columns' => [
                    'mythic_promotion_scroll',
                    'promotion_points_mythic',
                    'promotion_point_mythic',
                    'wheel_promotion_mythic',
                    'promotion_mythic',
                ],
            ],
            'extended' => [
                'points' => 13,
                'legacy_storage' => 0,
                'legacy_columns' => [
                    'extended_promotion_scroll',
                    'promotion_points_extended',
                    'promotion_point_extended',
                    'wheel_promotion_extended',
                    'promotion_extended',
                ],
            ],
            'advanced' => [
                'points' => 20,
                'legacy_storage' => 0,
                'legacy_columns' => [
                    'advanced_promotion_scroll',
                    'promotion_points_advanced',
                    'promotion_point_advanced',
                    'wheel_promotion_advanced',
                    'promotion_advanced',
                ],
            ],
        ];

        $epicScrollNames = [
            'destiny_points_61863_first' => 100,
            'destiny_points_61863_second' => 100,
        ];

        $kvScrollFlags = cbz_get_player_wheel_kv_scroll_flags($db, $playerId);
        $used = [];
        $scrollBonusPoints = 0;

        foreach ($scrollDefinitions as $scrollName => $definition) {
            $raw = 0;
            if (!empty($kvScrollFlags[$scrollName])) {
                $raw = 1;
            } elseif ($definition['legacy_storage'] > 0 && !empty($storageValues[$definition['legacy_storage']])) {
                $raw = (int)$storageValues[$definition['legacy_storage']];
            } else {
                $raw = cbz_player_numeric_value($player, $definition['legacy_columns'], 0);
            }

            $used[$scrollName] = ((int)$raw > 0);
            if ($used[$scrollName]) {
                $scrollBonusPoints += (int)$definition['points'];
            }
        }

        $epicUses = 0;
        foreach ($epicScrollNames as $epicName => $points) {
            if (!empty($kvScrollFlags[$epicName])) {
                $epicUses++;
            }
        }

        $epicStorageUses = max(0, (int)($storageValues[30062] ?? 0));
        if ($epicUses < $epicStorageUses) {
            $epicUses = min(2, $epicStorageUses);
        }

        $epicBonusPoints = $epicUses * 100;

        return [
            'promotion_scroll_abridged' => cbz_yes_no($used['abridged'] ?? false),
            'promotion_scroll_basic' => cbz_yes_no($used['basic'] ?? false),
            'promotion_scroll_revised' => cbz_yes_no($used['revised'] ?? false),
            'promotion_scroll_extended' => cbz_yes_no($used['extended'] ?? false),
            'promotion_scroll_advanced' => cbz_yes_no($used['advanced'] ?? false),
            'epic_points_wheel' => cbz_yes_no($epicUses > 0),
            'scroll_bonus_points' => $scrollBonusPoints,
            'epic_bonus_points' => $epicBonusPoints,
            'promotion_points_initiate' => cbz_yes_no($used['abridged'] ?? false),
            'promotion_points_ascendant' => cbz_yes_no($used['basic'] ?? false),
            'promotion_points_mythic' => cbz_yes_no($used['revised'] ?? false),
        ];
    }
}

if (!function_exists('cbz_sum_wheel_slot_blob_points')) {
    function cbz_sum_wheel_slot_blob_points($rawValue)
    {
        if ($rawValue === null) {
            return 0;
        }
        if (is_resource($rawValue)) {
            $rawValue = stream_get_contents($rawValue);
        }

        $raw = (string)$rawValue;
        $length = strlen($raw);
        if ($length < 3) {
            return 0;
        }

        $sum = 0;
        for ($i = 0; $i + 2 < $length; $i += 3) {
            $points = ord($raw[$i + 1]) | (ord($raw[$i + 2]) << 8);
            if ($points > 0) {
                $sum += $points;
            }
        }

        return (int)$sum;
    }
}

if (!function_exists('cbz_get_player_wheel_invested_points')) {
    function cbz_get_player_wheel_invested_points($db, $playerId)
    {
        if (!cbz_has_table($db, 'player_wheeldata')) {
            return 0;
        }

        $playerCol = cbz_find_first_column($db, 'player_wheeldata', ['player_id', 'playerid']);
        $slotCol = cbz_find_first_column($db, 'player_wheeldata', ['slot', 'slots', 'data']);
        if (!$playerCol || !$slotCol) {
            return 0;
        }

        try {
            $stmt = $db->query(
                'SELECT `' . $slotCol . '` AS `slot_blob` FROM `player_wheeldata` ' .
                'WHERE `' . $playerCol . '` = ' . (int)$playerId . ' LIMIT 1'
            );
            if (!$stmt) {
                return 0;
            }

            $row = $stmt->fetch();
            if (!$row || !array_key_exists('slot_blob', $row)) {
                return 0;
            }

            return cbz_sum_wheel_slot_blob_points($row['slot_blob']);
        } catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('cbz_get_player_storage_map')) {
    function cbz_get_player_storage_map($db, $playerId, array $keys)
    {
        $playerId = (int)$playerId;
        $result = [];
        $keys = array_values(array_unique(array_filter(array_map('intval', $keys), function ($key) {
            return $key !== 0;
        })));

        if ($playerId <= 0 || !$keys) {
            return $result;
        }

        if (!cbz_has_table($db, 'player_storage')) {
            return $result;
        }

        $playerCol = cbz_find_first_column($db, 'player_storage', ['player_id', 'playerid']);
        $keyCol = cbz_find_first_column($db, 'player_storage', ['key', 'storage_key']);
        $valueCol = cbz_find_first_column($db, 'player_storage', ['value', 'storage_value']);
        if (!$playerCol || !$keyCol || !$valueCol) {
            return $result;
        }

        $sql =
            'SELECT `' . $keyCol . '` AS `storage_key`, `' . $valueCol . '` AS `storage_value` ' .
            'FROM `player_storage` ' .
            'WHERE `' . $playerCol . '` = ' . $playerId . ' AND `' . $keyCol . '` IN (' . implode(',', $keys) . ')';
        $query = $db->query($sql);
        if (!$query) {
            return $result;
        }

        foreach ($query as $row) {
            $storageKey = (int)($row['storage_key'] ?? 0);
            if ($storageKey === 0) {
                continue;
            }

            $result[$storageKey] = (int)($row['storage_value'] ?? 0);
        }

        return $result;
    }
}

if (!function_exists('cbz_find_player_table_with_rows')) {
    function cbz_find_player_table_with_rows($db, array $tables, $playerId)
    {
        $playerId = (int)$playerId;
        if ($playerId <= 0) {
            return null;
        }

        foreach ($tables as $table) {
            if (!cbz_has_table($db, $table)) {
                continue;
            }

            $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid']);
            if (!$playerCol) {
                continue;
            }

            $count = (int)(cbz_scalar($db, 'SELECT COUNT(*) FROM `' . $table . '` WHERE `' . $playerCol . '` = ' . $playerId) ?? 0);
            if ($count > 0) {
                return $table;
            }
        }

        foreach ($tables as $table) {
            if (!cbz_has_table($db, $table)) {
                continue;
            }

            $playerCol = cbz_find_first_column($db, $table, ['player_id', 'playerid']);
            if ($playerCol) {
                return $table;
            }
        }

        return null;
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
        $addonMountBonusData = cbz_get_player_bonus_system_data($db, $config, $playerId);

        $charmPoints = 0;
        $spentCharmPoints = 0;
        $majorCharms = 0;
        $minorCharms = 0;
        $trackerIds = [];
        if (cbz_has_table($db, 'player_charms')) {
            $charmsPlayerCol = cbz_find_first_column($db, 'player_charms', ['player_id', 'playerid', 'player_guid']);
            if ($charmsPlayerCol) {
                $charms = $db->query("SELECT * FROM `player_charms` WHERE `{$charmsPlayerCol}` = {$playerId} LIMIT 1")->fetch();
                if ($charms) {
                    $charmPoints = (int)cbz_row_value($charms, ['charm_points', 'charmpoints'], 0);
                    $spentCharmPoints = (int)cbz_row_value($charms, ['spent_charm_points', 'spentcharmpoints'], 0);
                    $unlockedRunes = cbz_row_value($charms, ['UnlockedRunesBit', 'unlockedRunesBit', 'unlocked_runes_bit'], 0);
                    if ($unlockedRunes !== null && (int)$unlockedRunes > 0) {
                        $majorCharms = cbz_count_unlocked_charms_by_category($unlockedRunes, false);
                        $minorCharms = cbz_count_unlocked_charms_by_category($unlockedRunes, true);
                    }

                    $trackerRaw = cbz_row_value($charms, ['tracker_list', 'trackerlist', 'finished_monsters', 'finishedmonsters'], null);
                    $trackerIds = cbz_parse_tracker_ids($trackerRaw);
                }
            }
        }

        $bestiaryTables = ['player_bestiary', 'player_bestiaries', 'player_bestiary_kills', 'player_bestiarykills'];
        $bosstiaryTables = ['player_bosstiary', 'player_bosstiaries', 'player_bosstiary_kills', 'player_bosstiarykills'];
        $bestiaryTable = cbz_find_player_table_with_rows($db, $bestiaryTables, $playerId);
        $bosstiaryTable = cbz_find_player_table_with_rows($db, $bosstiaryTables, $playerId);

        if (!$trackerIds) {
            $trackerIds = cbz_get_table_blob_tracker_ids($db, 'player_charms', $playerId, ['tracker_list', 'trackerlist', 'finished_monsters', 'finishedmonsters']);
        }
        $bossTrackerIds = cbz_get_table_blob_tracker_ids($db, 'player_bosstiary', $playerId, ['tracker', 'tracker_list', 'trackerlist']);

        $bestiaryPoints = null;
        if ($bestiaryTable) {
            $bestiaryPlayerCol = cbz_find_first_column($db, $bestiaryTable, ['player_id', 'playerid']);
            if ($bestiaryPlayerCol) {
                if (cbz_has_column($db, $bestiaryTable, 'charm_points')) {
                    $bestiaryPoints = (int)(cbz_scalar($db, "SELECT SUM(`charm_points`) FROM `{$bestiaryTable}` WHERE `{$bestiaryPlayerCol}` = {$playerId}") ?? 0);
                } elseif (cbz_has_column($db, $bestiaryTable, 'points')) {
                    $bestiaryPoints = (int)(cbz_scalar($db, "SELECT SUM(`points`) FROM `{$bestiaryTable}` WHERE `{$bestiaryPlayerCol}` = {$playerId}") ?? 0);
                } else {
                    $bestiaryPoints = (int)(cbz_scalar($db, "SELECT COUNT(*) FROM `{$bestiaryTable}` WHERE `{$bestiaryPlayerCol}` = {$playerId}") ?? 0);
                }
            }
        }

        if ($bestiaryPoints === null && is_numeric($charmPoints)) {
            $bestiaryPoints = (int)$charmPoints;
        }
        if ($bestiaryPoints === null) {
            $bestiaryPoints = 0;
        }

        $bestiaryKillMap = cbz_get_player_bestiary_kill_map($db, $playerId);
        $bestiaryEntryIds = cbz_get_player_bestiary_entry_ids($db, $playerId, $trackerIds);
        $bestiaryList = [];
        if ($includeCollections) {
            if ($bestiaryTable) {
                $bestiaryList = cbz_get_collection_rows($db, $bestiaryTable, $playerId, 'Monster');
            }
            if (!$bestiaryList && $bestiaryEntryIds) {
                $bestiaryList = cbz_build_collection_rows_from_ids($db, $bestiaryEntryIds, 'Monster', $bestiaryKillMap);
            }
        }

        $bosstiaryEntryIds = cbz_get_player_bosstiary_entry_ids($db, $playerId);
        if (!$bosstiaryEntryIds && $bossTrackerIds) {
            $bosstiaryEntryIds = array_values(array_unique(array_map('intval', $bossTrackerIds)));
        }
        $bosstiaryKillMap = [];
        foreach ($bosstiaryEntryIds as $bossRaceId) {
            $kills = (int)($bestiaryKillMap[(int)$bossRaceId] ?? 0);
            if ($kills > 0) {
                $bosstiaryKillMap[(int)$bossRaceId] = $kills;
            }
        }
        $bosstiaryList = [];
        if ($includeCollections && $bosstiaryEntryIds) {
            $bosstiaryList = cbz_build_collection_rows_from_ids($db, $bosstiaryEntryIds, 'Boss', $bosstiaryKillMap);
        }

        $offenceStats = (int)$player['skill_sword'] + (int)$player['skill_axe'] + (int)$player['skill_club'] + (int)$player['skill_dist'] + (int)$player['maglevel'];
        $defenceStats = (int)$player['skill_shielding'] + (int)$player['skill_fist'];

        $wheelPoints = cbz_player_numeric_value($player, [
            'wheel_points',
            'wheelpoints',
            'wheel_point',
            'points_wheel',
            'wheel',
            'wheel_of_destiny_points',
            'wheelofdestiny_points',
            'wheel_destiny_points',
        ], 0);
        $availablePromotionPoints = cbz_player_numeric_value($player, [
            'available_promotion_points',
            'available_promotion_point',
            'available_promotions_points',
            'available_promotions_point',
            'promotion_points',
            'promotion_point',
            'wheel_available_points',
            'wheel_available_point',
            'wheel_points_available',
            'wheel_points_free',
        ], 0);

        $storeInboxTables = [];
        foreach ([
            'player_storeinboxitems',
            'player_storeinbox_items',
            'player_storeinbox',
            'player_storeinboxitem',
            'player_store_inboxitems',
            'player_store_inbox_items',
            'player_store_inbox',
            'player_storeinbox_item',
            'player_rewards',
            'player_rewarditems',
            'player_reward_items',
            'player_storeitems',
            'player_store_items',
        ] as $tableName) {
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
            $inventoryRows = cbz_get_player_items_bucket_rows_by_roots($db, $playerId, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
            if (!$inventoryRows) {
                $inventoryRows = cbz_get_backpack_item_bucket_rows($db, $playerId);
            }
            $depotRows = cbz_get_item_bucket_rows_multi($db, ['player_depotitems'], $playerId);
            $supplyStashRows = cbz_get_item_bucket_rows_multi($db, ['player_supplystash', 'player_stash'], $playerId);
            $inboxRows = cbz_get_item_bucket_rows_multi($db, ['player_inboxitems'], $playerId);
            $storeInboxDbRows = cbz_get_item_bucket_rows_multi($db, $storeInboxTables, $playerId);
            $storeInboxSlotRows = cbz_get_player_items_bucket_rows_by_roots($db, $playerId, [11, 12]);
            $storeInboxRows = cbz_merge_item_bucket_row_sets([$storeInboxDbRows, $storeInboxSlotRows]);
            if (!$storeInboxRows && $inboxRows) {
                // Fallback: some forks persist Store Inbox in inbox-like tables.
                $storeInboxRows = $inboxRows;
            }

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

        $storageValues = cbz_get_player_storage_map($db, $playerId, [
            95101, 95102, 95103, 95109, 95110, 95121, 95122, 95123, 95124, 30062,
        ]);

        $preyWildcards = cbz_player_numeric_value($player, ['prey_wildcard', 'wildcard', 'prey_wildcards', 'wildcards'], 0);
        $preySlotRaw = cbz_player_numeric_value($player, [
            'third_prey_slot',
            'prey_slot_3',
            'prey_third_slot',
            'prey_slot_bonus',
            'prey_slots',
            'prey_slot_count',
            'prey_slot',
            'prey_slot_unlocked',
            'permanent_prey_slot',
        ], 0);
        if ($preySlotRaw === 0) {
            $preySlotRaw = cbz_player_numeric_value($player, ['prey_unlocked'], 0);
        }

        $preyPermanentRaw = ($preySlotRaw >= 3 || $preySlotRaw === 1 || $preySlotRaw === 2) ? 1 : 0;
        if ($preyPermanentRaw === 0) {
            foreach ([95101, 95102, 95103, 95109] as $storageKey) {
                if (!empty($storageValues[$storageKey]) && (int)$storageValues[$storageKey] > 0) {
                    $preyPermanentRaw = 1;
                    break;
                }
            }
        }
        if ($preyPermanentRaw === 0 && $preyWildcards > 0) {
            // Fallback for forks where permanent prey unlock is not persisted in player columns.
            $preyPermanentRaw = 1;
        }
        $preyPermanent = cbz_yes_no($preyPermanentRaw);

        if ($availablePromotionPoints <= 0 && isset($storageValues[95124]) && (int)$storageValues[95124] > 0) {
            $availablePromotionPoints = (int)$storageValues[95124];
        }

        $wheelInvestedPoints = cbz_get_player_wheel_invested_points($db, $playerId);
        if (cbz_has_table($db, 'player_wheeldata')) {
            $wheelPlayerCol = cbz_find_first_column($db, 'player_wheeldata', ['player_id', 'playerid']);
            if ($wheelPlayerCol) {
                if ($availablePromotionPoints <= 0) {
                    $wheelAvailableCol = cbz_find_first_column($db, 'player_wheeldata', [
                        'available_promotion_points',
                        'available_promotions_points',
                        'available_points',
                        'free_points',
                        'points_available',
                        'available',
                    ]);
                    if ($wheelAvailableCol) {
                        $availablePromotionPoints = (int)(cbz_scalar($db, "SELECT SUM(`{$wheelAvailableCol}`) FROM `player_wheeldata` WHERE `{$wheelPlayerCol}` = {$playerId}") ?? 0);
                    }
                }

                if ($wheelPoints <= 0) {
                    $wheelPointsCol = cbz_find_first_column($db, 'player_wheeldata', [
                        'wheel_points',
                        'promotion_points',
                        'points',
                        'total_points',
                        'used_points',
                    ]);
                    if ($wheelPointsCol) {
                        $wheelPoints = (int)(cbz_scalar($db, "SELECT SUM(`{$wheelPointsCol}`) FROM `player_wheeldata` WHERE `{$wheelPlayerCol}` = {$playerId}") ?? 0);
                    }
                }
            }
        }
        if ($wheelPoints <= 0 && $wheelInvestedPoints > 0) {
            $wheelPoints = $wheelInvestedPoints;
        }

        $wheelScrollData = cbz_get_wheel_destiny_scroll_data($db, $playerId, $player, $storageValues);
        $scrollBonusPoints = (int)($wheelScrollData['scroll_bonus_points'] ?? 0);
        $epicBonusPoints = (int)($wheelScrollData['epic_bonus_points'] ?? 0);

        $baseWheelPoints = max(0, ((int)$player['level']) - 50);
        $estimatedTotalWheelPoints = $baseWheelPoints + $scrollBonusPoints + $epicBonusPoints;
        if ($estimatedTotalWheelPoints > $wheelPoints) {
            $wheelPoints = $estimatedTotalWheelPoints;
        }

        $calculatedAvailablePoints = max(0, $estimatedTotalWheelPoints - $wheelInvestedPoints);
        if ($calculatedAvailablePoints > 0) {
            $availablePromotionPoints = $calculatedAvailablePoints;
        } elseif ($availablePromotionPoints <= 0 && isset($storageValues[95124]) && (int)$storageValues[95124] > 0) {
            $availablePromotionPoints = (int)$storageValues[95124];
        }

        $promotionInitiate = (string)($wheelScrollData['promotion_scroll_abridged'] ?? 'No');
        $promotionAscendant = (string)($wheelScrollData['promotion_scroll_basic'] ?? 'No');
        $promotionMythic = (string)($wheelScrollData['promotion_scroll_revised'] ?? 'No');
        $promotionExtended = (string)($wheelScrollData['promotion_scroll_extended'] ?? 'No');
        $promotionAdvanced = (string)($wheelScrollData['promotion_scroll_advanced'] ?? 'No');
        $epicPointsWheel = (string)($wheelScrollData['epic_points_wheel'] ?? 'No');
        $jewelledPounch4Slot = cbz_yes_no((int)($storageValues[95110] ?? 0));

        $bosstiary = is_array($bosstiaryList) ? count($bosstiaryList) : 0;
        if ($bosstiary <= 0) {
            $bosstiary = count(cbz_get_player_bosstiary_entry_ids($db, $playerId));
        }
        $bossPoints = cbz_has_column($db, 'players', 'boss_points') ? (int)$player['boss_points'] : 0;

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
            $ravynCoreTotal = (int)($amountByItem[61869] ?? 0);

            if ($ravynCoreTotal <= 0) {
                foreach ($amountByItem as $itemId => $amount) {
                    $itemName = function_exists('getItemNameById') ? strtolower((string)getItemNameById((int)$itemId)) : '';
                    if ($itemName !== '' && strpos($itemName, 'ravyncore') !== false) {
                        $ravynCoreTotal += (int)$amount;
                    }
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
            'available_promotion_points' => $availablePromotionPoints,
            'promotion_points_initiate' => $promotionInitiate,
            'promotion_points_ascendant' => $promotionAscendant,
            'promotion_points_mythic' => $promotionMythic,
            'promotion_scroll_abridged' => $promotionInitiate,
            'promotion_scroll_basic' => $promotionAscendant,
            'promotion_scroll_revised' => $promotionMythic,
            'promotion_scroll_extended' => $promotionExtended,
            'promotion_scroll_advanced' => $promotionAdvanced,
            'epic_points_wheel' => $epicPointsWheel,
            'wheel_total_points' => $estimatedTotalWheelPoints,
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
            'jewelled_pounch_4_slot' => $jewelledPounch4Slot,
            'stones_total' => $stonesTotal,
            'stones_rows' => $stoneRows,
            'stone_dust_total' => $stoneDustTotal,
            'ravyncore_total' => $ravynCoreTotal,
            'addon_mount_bonus' => $addonMountBonusData,
            'full_addons_list' => cbz_get_full_addons_list($db, $config, $player),
            'full_mounts_list' => cbz_get_full_mounts_list($db, $config, $player),
            'equipped_inventory' => cbz_get_equipped_inventory($db, $playerId),
        ];
    }
}

