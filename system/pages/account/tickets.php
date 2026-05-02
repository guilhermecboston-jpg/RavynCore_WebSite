<?php
global $db, $account_logged, $twig;

defined('MYAAC') or die('Direct access not allowed!');

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

rc_ensure_tickets_table($db);

$statusMap = [
    'open' => 'Aberto',
    'in_progress' => 'Em andamento',
    'resolved' => 'Resolvido',
    'closed' => 'Encerrado',
];

$typeOptions = [
    'bug' => 'Bug',
    'report' => 'Report',
    'suggestion' => 'Sugestao',
];

$errors = [];
$success = '';

$characters = [];
foreach ($account_logged->getPlayersList() as $player) {
    if ($player->isLoaded() && !$player->isDeleted()) {
        $characters[] = [
            'id' => (int)$player->getId(),
            'name' => $player->getName(),
        ];
    }
}

$selectedCharacterId = isset($_POST['character_id']) ? (int)$_POST['character_id'] : ($characters[0]['id'] ?? 0);
$ticketTitle = trim((string)($_POST['ticket_title'] ?? ''));
$ticketSummary = trim((string)($_POST['ticket_summary'] ?? ''));
$ticketType = trim((string)($_POST['ticket_type'] ?? 'bug'));
$ticketDescription = trim((string)($_POST['ticket_description'] ?? ''));

if (isset($_POST['create_ticket'])) {
    if (empty($characters)) {
        $errors[] = 'You need at least one character on your account to open a ticket.';
    }

    $selectedCharacter = null;
    foreach ($characters as $character) {
        if ((int)$character['id'] === $selectedCharacterId) {
            $selectedCharacter = $character;
            break;
        }
    }

    if (!$selectedCharacter) {
        $errors[] = 'Invalid character selected.';
    }

    if ($ticketTitle === '' || mb_strlen($ticketTitle) < 4) {
        $errors[] = 'Ticket title must contain at least 4 characters.';
    } elseif (mb_strlen($ticketTitle) > 120) {
        $errors[] = 'Ticket title cannot exceed 120 characters.';
    }

    if ($ticketSummary === '' || mb_strlen($ticketSummary) < 6) {
        $errors[] = 'Short problem description must contain at least 6 characters.';
    } elseif (mb_strlen($ticketSummary) > 255) {
        $errors[] = 'Short problem description cannot exceed 255 characters.';
    }

    if (!isset($typeOptions[$ticketType])) {
        $errors[] = 'Invalid ticket type selected.';
    }

    if ($ticketDescription === '' || mb_strlen($ticketDescription) < 10) {
        $errors[] = 'Complete description must contain at least 10 characters.';
    } elseif (!rc_ticket_description_has_only_allowed_links($ticketDescription)) {
        $errors[] = 'Only YouTube and Imgur links are allowed in the complete description.';
    }

    if (empty($errors) && $selectedCharacter) {
        $now = time();
        $db->query(
            'INSERT INTO `myaac_tickets` (`account_id`, `player_id`, `character_name`, `title`, `summary`, `ticket_type`, `description`, `status`, `created_at`, `updated_at`) VALUES (' .
            (int)$account_logged->getId() . ', ' .
            (int)$selectedCharacter['id'] . ', ' .
            $db->quote($selectedCharacter['name']) . ', ' .
            $db->quote($ticketTitle) . ', ' .
            $db->quote($ticketSummary) . ', ' .
            $db->quote($ticketType) . ', ' .
            $db->quote($ticketDescription) . ", 'open', " .
            (int)$now . ', ' . (int)$now .
            ')'
        );

        $success = 'Ticket created successfully.';
        $ticketTitle = '';
        $ticketSummary = '';
        $ticketType = 'bug';
        $ticketDescription = '';
    }
}

$myTickets = [];
$query = $db->query(
    'SELECT `id`, `character_name`, `title`, `summary`, `ticket_type`, `status`, `created_at` ' .
    'FROM `myaac_tickets` WHERE `account_id` = ' . (int)$account_logged->getId() . ' ORDER BY `id` DESC LIMIT 100'
);
foreach ($query as $row) {
    $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
    $myTickets[] = $row;
}

$twig->display('account.tickets.html.twig', [
    'errors' => $errors,
    'success' => $success,
    'characters' => $characters,
    'selectedCharacterId' => $selectedCharacterId,
    'ticketTitle' => $ticketTitle,
    'ticketSummary' => $ticketSummary,
    'ticketType' => $ticketType,
    'ticketDescription' => $ticketDescription,
    'typeOptions' => $typeOptions,
    'myTickets' => $myTickets,
]);
