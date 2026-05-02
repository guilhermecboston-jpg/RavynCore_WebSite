<?php
global $db, $twig, $account_logged;

defined('MYAAC') or die('Direct access not allowed!');
$title = 'Tickets';

if (!function_exists('rc_ensure_tickets_table')) {
    function rc_ensure_tickets_table($db)
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
    }
}

rc_ensure_tickets_table($db);

$isStaff = function_exists('admin') && admin();

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

$statusMap = [
    'open' => 'Aberto',
    'analysis' => 'Em analise',
    'in_progress' => 'Em andamento',
    'resolved' => 'Resolvido',
    'closed' => 'Finalizado',
];

$errors = [];
$success = '';

if ($isStaff && isset($_POST['staff_update_ticket'])) {
    $ticketId = (int)($_POST['ticket_id'] ?? 0);
    $staffStatus = trim((string)($_POST['staff_status'] ?? 'open'));
    $staffReply = trim((string)($_POST['staff_reply'] ?? ''));
    $allowedStatuses = array_keys($statusMap);

    if ($ticketId <= 0) {
        $errors[] = 'Invalid ticket selected.';
    } elseif (!in_array($staffStatus, $allowedStatuses, true)) {
        $errors[] = 'Invalid status selected.';
    } elseif ($staffReply === '' || mb_strlen($staffReply) < 2) {
        $errors[] = 'Staff reply must contain at least 2 characters.';
    } elseif (!rc_ticket_description_has_only_allowed_links($staffReply)) {
        $errors[] = 'Only YouTube and Imgur links are allowed in staff reply.';
    } else {
        $exists = $db->query('SELECT `id` FROM `myaac_tickets` WHERE `id` = ' . $ticketId . ' LIMIT 1')->fetch();
        if (!$exists) {
            $errors[] = 'Ticket not found.';
        } else {
            $now = time();
            $staffAccountId = ($account_logged && $account_logged->isLoaded()) ? (int)$account_logged->getId() : 0;
            $db->query(
                'UPDATE `myaac_tickets` SET ' .
                '`status` = ' . $db->quote($staffStatus) . ', ' .
                '`staff_reply` = ' . $db->quote($staffReply) . ', ' .
                '`staff_account_id` = ' . $staffAccountId . ', ' .
                '`staff_updated_at` = ' . (int)$now . ', ' .
                '`updated_at` = ' . (int)$now . ' ' .
                'WHERE `id` = ' . (int)$ticketId . ' LIMIT 1'
            );
            $success = 'Ticket #' . $ticketId . ' updated successfully.';
        }
    }
}

$tickets = [];
$query = $db->query(
    'SELECT `id`, `character_name`, `title`, `summary`, `description`, `status`, `staff_reply`, `staff_updated_at`, `created_at` FROM `myaac_tickets` ORDER BY `id` DESC LIMIT 300'
);
foreach ($query as $row) {
    $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
    $tickets[] = $row;
}

$openTicketsCount = (int)$db->query("SELECT COUNT(*) FROM `myaac_tickets` WHERE `status` = 'open'")->fetchColumn();

$twig->display('tickets.html.twig', [
    'errors' => $errors,
    'success' => $success,
    'tickets' => $tickets,
    'isStaff' => $isStaff,
    'statusMap' => $statusMap,
    'openTicketsCount' => $openTicketsCount,
]);
