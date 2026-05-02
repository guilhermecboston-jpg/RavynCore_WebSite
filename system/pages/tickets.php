<?php
global $db, $twig;

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
                `created_at` INT NOT NULL,
                `updated_at` INT NOT NULL,
                PRIMARY KEY (`id`),
                KEY `idx_ticket_account` (`account_id`),
                KEY `idx_ticket_status` (`status`),
                KEY `idx_ticket_created` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }
}

rc_ensure_tickets_table($db);

$statusMap = [
    'open' => 'Aberto',
    'in_progress' => 'Em andamento',
    'resolved' => 'Resolvido',
    'closed' => 'Encerrado',
];

$tickets = [];
$query = $db->query(
    'SELECT `id`, `character_name`, `title`, `summary`, `status`, `created_at` FROM `myaac_tickets` ORDER BY `id` DESC LIMIT 300'
);
foreach ($query as $row) {
    $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
    $tickets[] = $row;
}

$twig->display('tickets.html.twig', [
    'tickets' => $tickets,
]);

