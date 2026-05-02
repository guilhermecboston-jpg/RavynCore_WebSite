<?php
defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('rc_is_staff_web_flag3')) {
    function rc_is_staff_web_flag3()
    {
        global $logged, $account_logged, $logged_flags;

        if (!$logged) {
            return false;
        }

        if (isset($account_logged) && $account_logged && method_exists($account_logged, 'getWebFlags')) {
            return (int)$account_logged->getWebFlags() === 3;
        }

        return isset($logged_flags) && (int)$logged_flags === 3;
    }
}

if (!function_exists('rc_ticket_status_map')) {
    function rc_ticket_status_map()
    {
        return [
            'open' => 'Aberto',
            'analysis' => 'Em analise',
            'in_progress' => 'Em andamento',
            'resolved' => 'Resolvido',
            'closed' => 'Finalizado',
        ];
    }
}

if (!function_exists('rc_ticket_filter_options')) {
    function rc_ticket_filter_options()
    {
        return [
            'all' => 'Todos',
            'open' => 'Aberto',
            'analysis' => 'Em analise',
            'in_progress' => 'Em andamento',
            'resolved' => 'Resolvido',
            'closed' => 'Finalizado',
        ];
    }
}

if (!function_exists('rc_ticket_type_options')) {
    function rc_ticket_type_options()
    {
        return [
            'bug' => 'Bug',
            'report' => 'Report',
            'suggestion' => 'Sugestao',
        ];
    }
}

if (!function_exists('rc_ticket_description_has_only_allowed_links')) {
    function rc_ticket_description_has_only_allowed_links($text)
    {
        $allowedHosts = [
            'youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtu.be',
            'imgur.com', 'www.imgur.com', 'i.imgur.com', 'm.imgur.com',
        ];

        preg_match_all('/https?:\/\/[^\s<>"\']+/i', (string)$text, $matches);
        foreach (($matches[0] ?? []) as $url) {
            $host = strtolower((string)parse_url($url, PHP_URL_HOST));
            if ($host === '' || !in_array($host, $allowedHosts, true)) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('rc_ensure_tickets_schema')) {
    function rc_ensure_tickets_schema($db)
    {
        $db->query("
            CREATE TABLE IF NOT EXISTS `myaac_tickets` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `account_id` INT NOT NULL,
                `player_id` INT NULL,
                `character_name` VARCHAR(120) NOT NULL DEFAULT '',
                `title` VARCHAR(120) NOT NULL,
                `summary` VARCHAR(255) NOT NULL,
                `ticket_type` VARCHAR(20) NOT NULL DEFAULT 'bug',
                `description` TEXT NOT NULL,
                `status` VARCHAR(20) NOT NULL DEFAULT 'open',
                `staff_reply` TEXT NULL,
                `staff_account_id` INT NULL,
                `staff_updated_at` INT NULL,
                `created_at` INT NOT NULL,
                `updated_at` INT NOT NULL,
                PRIMARY KEY (`id`),
                KEY `idx_ticket_account` (`account_id`),
                KEY `idx_ticket_status` (`status`),
                KEY `idx_ticket_created` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        if (!$db->hasColumn('myaac_tickets', 'staff_reply')) {
            $db->query("ALTER TABLE `myaac_tickets` ADD `staff_reply` TEXT NULL AFTER `status`");
        }
        if (!$db->hasColumn('myaac_tickets', 'staff_account_id')) {
            $db->query("ALTER TABLE `myaac_tickets` ADD `staff_account_id` INT NULL AFTER `staff_reply`");
        }
        if (!$db->hasColumn('myaac_tickets', 'staff_updated_at')) {
            $db->query("ALTER TABLE `myaac_tickets` ADD `staff_updated_at` INT NULL AFTER `staff_account_id`");
        }

        $db->query("
            CREATE TABLE IF NOT EXISTS `myaac_ticket_history` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `ticket_id` INT NOT NULL,
                `actor_account_id` INT NOT NULL DEFAULT 0,
                `actor_role` VARCHAR(20) NOT NULL DEFAULT 'player',
                `status` VARCHAR(20) NOT NULL DEFAULT 'open',
                `message` TEXT NULL,
                `created_at` INT NOT NULL,
                PRIMARY KEY (`id`),
                KEY `idx_ticket_history_ticket` (`ticket_id`),
                KEY `idx_ticket_history_created` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }
}

if (!function_exists('rc_ticket_add_history')) {
    function rc_ticket_add_history($db, $ticketId, $actorAccountId, $actorRole, $status, $message)
    {
        $messageValue = trim((string)$message);
        $db->query(
            'INSERT INTO `myaac_ticket_history` (`ticket_id`, `actor_account_id`, `actor_role`, `status`, `message`, `created_at`) VALUES (' .
            (int)$ticketId . ', ' .
            (int)$actorAccountId . ', ' .
            $db->quote((string)$actorRole) . ', ' .
            $db->quote((string)$status) . ', ' .
            ($messageValue === '' ? 'NULL' : $db->quote($messageValue)) . ', ' .
            (int)time() .
            ')'
        );
    }
}

if (!function_exists('rc_ticket_history_map')) {
    function rc_ticket_history_map($db, array $ticketIds)
    {
        $result = [];
        if (empty($ticketIds)) {
            return $result;
        }

        $ticketIds = array_values(array_unique(array_map('intval', $ticketIds)));
        if (empty($ticketIds)) {
            return $result;
        }

        $query = $db->query(
            'SELECT `id`, `ticket_id`, `actor_account_id`, `actor_role`, `status`, `message`, `created_at` FROM `myaac_ticket_history` WHERE `ticket_id` IN (' .
            implode(',', $ticketIds) .
            ') ORDER BY `id` ASC'
        );

        foreach ($query as $row) {
            $ticketId = (int)$row['ticket_id'];
            if (!isset($result[$ticketId])) {
                $result[$ticketId] = [];
            }
            $result[$ticketId][] = $row;
        }

        return $result;
    }
}
