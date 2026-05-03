<?php
global $db, $account_logged, $twig;

defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/rc_tickets.php';

rc_ensure_tickets_schema($db);

$isStaff = rc_is_staff_web_flag3();
$statusMap = rc_ticket_status_map();
$typeOptions = rc_ticket_type_options();

if (!$isStaff) {
    error('Access denied.');
    return;
}

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

if ($isStaff && isset($_POST['staff_update_ticket'])) {
    $ticketId = (int)($_POST['ticket_id'] ?? 0);
    $staffStatus = trim((string)($_POST['staff_status'] ?? 'open'));
    $staffReply = trim((string)($_POST['staff_reply'] ?? ''));
    $allowedStatuses = array_keys($statusMap);

    if ($ticketId <= 0) {
        $errors[] = 'Invalid ticket selected.';
    } elseif (!in_array($staffStatus, $allowedStatuses, true)) {
        $errors[] = 'Invalid status selected.';
    } elseif ($staffReply !== '' && !rc_ticket_description_has_only_allowed_links($staffReply)) {
        $errors[] = 'Only YouTube and Imgur links are allowed in staff reply.';
    } else {
        $current = $db->query('SELECT `id`, `status`, `staff_reply` FROM `myaac_tickets` WHERE `id` = ' . $ticketId . ' LIMIT 1')->fetch();
        if (!$current) {
            $errors[] = 'Ticket not found.';
        } else {
            $changedStatus = ((string)$current['status'] !== $staffStatus);
            $hasReply = ($staffReply !== '');
            if (!$changedStatus && !$hasReply) {
                $errors[] = 'Update at least the status or add a staff reply.';
            } else {
                $now = time();
                $latestReply = $hasReply ? $staffReply : (string)($current['staff_reply'] ?? '');
                $db->query(
                    'UPDATE `myaac_tickets` SET ' .
                    '`status` = ' . $db->quote($staffStatus) . ', ' .
                    '`staff_reply` = ' . ($latestReply === '' ? 'NULL' : $db->quote($latestReply)) . ', ' .
                    '`staff_account_id` = ' . (int)$account_logged->getId() . ', ' .
                    '`staff_updated_at` = ' . (int)$now . ', ' .
                    '`updated_at` = ' . (int)$now . ' ' .
                    'WHERE `id` = ' . (int)$ticketId . ' LIMIT 1'
                );

                $historyMessage = $hasReply ? $staffReply : ('Status changed to "' . ($statusMap[$staffStatus] ?? $staffStatus) . '".');
                rc_ticket_add_history($db, $ticketId, (int)$account_logged->getId(), 'staff', $staffStatus, $historyMessage);
                $success = 'Ticket #' . $ticketId . ' updated successfully.';
            }
        }
    }
}

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

        $ticketId = (int)$db->lastInsertId();
        rc_ticket_add_history($db, $ticketId, (int)$account_logged->getId(), 'player', 'open', $ticketDescription);

        $success = 'Ticket created successfully.';
        $ticketTitle = '';
        $ticketSummary = '';
        $ticketType = 'bug';
        $ticketDescription = '';
    }
}

$myTickets = [];
$myQuery = $db->query(
    'SELECT `id`, `character_name`, `title`, `summary`, `ticket_type`, `description`, `status`, `staff_reply`, `staff_updated_at`, `created_at` ' .
    'FROM `myaac_tickets` WHERE `account_id` = ' . (int)$account_logged->getId() . ' ORDER BY `id` DESC LIMIT 100'
);
foreach ($myQuery as $row) {
    $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
    $myTickets[] = $row;
}
$myHistoryMap = rc_ticket_history_map($db, array_map(static function ($row) {
    return (int)$row['id'];
}, $myTickets));
foreach ($myTickets as &$row) {
    $row['history'] = $myHistoryMap[(int)$row['id']] ?? [];
}
unset($row);

$staffTickets = [];
$openTicketsCount = 0;
if ($isStaff) {
    $openTicketsCount = (int)$db->query("SELECT COUNT(*) FROM `myaac_tickets` WHERE `status` = 'open'")->fetchColumn();
    $staffQuery = $db->query(
        'SELECT `id`, `account_id`, `character_name`, `title`, `summary`, `description`, `ticket_type`, `status`, `staff_reply`, `staff_updated_at`, `created_at` ' .
        'FROM `myaac_tickets` ORDER BY `id` DESC LIMIT 300'
    );
    foreach ($staffQuery as $row) {
        $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
        $staffTickets[] = $row;
    }
    $staffHistoryMap = rc_ticket_history_map($db, array_map(static function ($row) {
        return (int)$row['id'];
    }, $staffTickets));
    foreach ($staffTickets as &$row) {
        $row['history'] = $staffHistoryMap[(int)$row['id']] ?? [];
    }
    unset($row);
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
    'statusMap' => $statusMap,
    'isStaff' => $isStaff,
    'staffTickets' => $staffTickets,
    'openTicketsCount' => $openTicketsCount,
]);
