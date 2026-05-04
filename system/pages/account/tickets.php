<?php
global $db, $account_logged, $twig;

defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/rc_tickets.php';

rc_ensure_tickets_schema($db);

$isStaff = rc_is_staff_web_flag3();
$statusMap = rc_ticket_status_map();
$typeOptions = rc_ticket_type_options();
$allowedStatuses = array_keys($statusMap);

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
$ticketType = trim((string)($_POST['ticket_type'] ?? 'bug'));
$ticketDescription = trim((string)($_POST['ticket_description'] ?? ''));
$viewTicketId = (int)($_REQUEST['view_ticket'] ?? 0);
$accountId = (int)$account_logged->getId();

$loadTicketQuery = static function ($ticketId) use ($db, $isStaff, $accountId) {
    $whereSql = ' WHERE `id` = ' . (int)$ticketId;
    if (!$isStaff) {
        $whereSql .= ' AND `account_id` = ' . (int)$accountId;
    }

    return $db->query(
        'SELECT `id`, `account_id`, `player_id`, `character_name`, `title`, `summary`, `ticket_type`, `description`, `status`, `staff_reply`, `staff_account_id`, `staff_updated_at`, `created_at`, `updated_at` ' .
        'FROM `myaac_tickets`' . $whereSql . ' LIMIT 1'
    )->fetch();
};

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
        $ticketSummary = mb_substr($ticketDescription !== '' ? $ticketDescription : $ticketTitle, 0, 255);
        $db->query(
            'INSERT INTO `myaac_tickets` (`account_id`, `player_id`, `character_name`, `title`, `summary`, `ticket_type`, `description`, `status`, `created_at`, `updated_at`) VALUES (' .
            $accountId . ', ' .
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
        rc_ticket_add_history($db, $ticketId, $accountId, 'player', 'open', $ticketDescription);
        $viewTicketId = $ticketId;
        $success = 'Ticket created successfully.';

        $ticketTitle = '';
        $ticketType = 'bug';
        $ticketDescription = '';
    }
}

if (isset($_POST['ticket_add_reply'])) {
    $ticketId = (int)($_POST['ticket_id'] ?? 0);
    $replyMessage = trim((string)($_POST['reply_message'] ?? ''));
    $staffStatus = trim((string)($_POST['staff_status'] ?? ''));
    $viewTicketId = $ticketId;

    if ($ticketId <= 0) {
        $errors[] = 'Invalid ticket selected.';
    } elseif ($replyMessage === '' || mb_strlen($replyMessage) < 3) {
        $errors[] = 'Reply must contain at least 3 characters.';
    } elseif (!rc_ticket_description_has_only_allowed_links($replyMessage)) {
        $errors[] = 'Only YouTube and Imgur links are allowed in replies.';
    } else {
        $currentTicket = $loadTicketQuery($ticketId);
        if (!$currentTicket) {
            $errors[] = 'Ticket not found.';
        } else {
            $now = time();
            $nextStatus = (string)$currentTicket['status'];
            if ($isStaff && $staffStatus !== '' && in_array($staffStatus, $allowedStatuses, true)) {
                $nextStatus = $staffStatus;
            }

            $updateSql = 'UPDATE `myaac_tickets` SET ' .
                '`updated_at` = ' . (int)$now . ', ' .
                '`status` = ' . $db->quote($nextStatus) . ', ';

            if ($isStaff) {
                $updateSql .=
                    '`staff_reply` = ' . $db->quote($replyMessage) . ', ' .
                    '`staff_account_id` = ' . $accountId . ', ' .
                    '`staff_updated_at` = ' . (int)$now . ' ';
            } else {
                $updateSql .=
                    '`staff_reply` = `staff_reply`, ' .
                    '`staff_account_id` = `staff_account_id`, ' .
                    '`staff_updated_at` = `staff_updated_at` ';
            }

            $updateSql .= 'WHERE `id` = ' . (int)$ticketId . ' LIMIT 1';
            $db->query($updateSql);

            rc_ticket_add_history(
                $db,
                $ticketId,
                $accountId,
                $isStaff ? 'staff' : 'player',
                $nextStatus,
                $replyMessage
            );

            $success = 'Reply sent successfully.';
        }
    }
}

$myTickets = [];
$myQuery = $db->query(
    'SELECT `id`, `character_name`, `title`, `summary`, `ticket_type`, `description`, `status`, `staff_reply`, `staff_updated_at`, `created_at`, `updated_at` ' .
    'FROM `myaac_tickets` WHERE `account_id` = ' . $accountId . ' ORDER BY `id` DESC LIMIT 100'
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

$selectedTicket = null;
if ($viewTicketId > 0) {
    $selectedTicket = $loadTicketQuery($viewTicketId);
    if ($selectedTicket) {
        $selectedTicket['status_label'] = $statusMap[$selectedTicket['status']] ?? ucfirst(str_replace('_', ' ', (string)$selectedTicket['status']));
        $selectedHistoryMap = rc_ticket_history_map($db, [(int)$selectedTicket['id']]);
        $selectedTicket['history'] = $selectedHistoryMap[(int)$selectedTicket['id']] ?? [];
    } else {
        $errors[] = 'Ticket not found or you do not have permission to view it.';
    }
}

$openTicketsCount = $isStaff ? (int)$db->query("SELECT COUNT(*) FROM `myaac_tickets` WHERE `status` = 'open'")->fetchColumn() : 0;

$twig->display('account.tickets.html.twig', [
    'errors' => $errors,
    'success' => $success,
    'characters' => $characters,
    'selectedCharacterId' => $selectedCharacterId,
    'ticketTitle' => $ticketTitle,
    'ticketType' => $ticketType,
    'ticketDescription' => $ticketDescription,
    'typeOptions' => $typeOptions,
    'myTickets' => $myTickets,
    'statusMap' => $statusMap,
    'isStaff' => $isStaff,
    'openTicketsCount' => $openTicketsCount,
    'selectedTicket' => $selectedTicket,
    'allowedStatuses' => $allowedStatuses,
]);
