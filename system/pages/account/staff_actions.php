<?php
global $db, $twig, $account_logged;

defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/rc_tickets.php';

if (!rc_is_staff_web_flag3()) {
    error('Access denied.');
    return;
}

rc_ensure_tickets_schema($db);

$statusMap = rc_ticket_status_map();
$filterOptions = rc_ticket_filter_options();
$allowedStatuses = array_keys($statusMap);

$errors = [];
$success = '';

$filterStatus = trim((string)($_REQUEST['status'] ?? 'all'));
if (!isset($filterOptions[$filterStatus])) {
    $filterStatus = 'all';
}

if (isset($_POST['staff_update_ticket'])) {
    $ticketId = (int)($_POST['ticket_id'] ?? 0);
    $staffStatus = trim((string)($_POST['staff_status'] ?? 'open'));
    $staffReply = trim((string)($_POST['staff_reply'] ?? ''));

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
                $staffAccountId = (int)$account_logged->getId();
                $latestReply = $hasReply ? $staffReply : (string)($current['staff_reply'] ?? '');
                $db->query(
                    'UPDATE `myaac_tickets` SET ' .
                    '`status` = ' . $db->quote($staffStatus) . ', ' .
                    '`staff_reply` = ' . ($latestReply === '' ? 'NULL' : $db->quote($latestReply)) . ', ' .
                    '`staff_account_id` = ' . $staffAccountId . ', ' .
                    '`staff_updated_at` = ' . (int)$now . ', ' .
                    '`updated_at` = ' . (int)$now . ' ' .
                    'WHERE `id` = ' . (int)$ticketId . ' LIMIT 1'
                );

                $historyMessage = $hasReply ? $staffReply : ('Status changed to "' . ($statusMap[$staffStatus] ?? $staffStatus) . '".');
                rc_ticket_add_history($db, $ticketId, $staffAccountId, 'staff', $staffStatus, $historyMessage);
                $success = 'Ticket #' . $ticketId . ' updated successfully.';
            }
        }
    }
}

$whereSql = '';
if ($filterStatus !== 'all') {
    $whereSql = ' WHERE `status` = ' . $db->quote($filterStatus) . ' ';
}

$tickets = [];
$ticketsQuery = $db->query(
    'SELECT `id`, `account_id`, `character_name`, `title`, `summary`, `description`, `status`, `staff_reply`, `staff_updated_at`, `created_at` FROM `myaac_tickets` ' .
    $whereSql .
    ' ORDER BY `id` DESC LIMIT 300'
);
foreach ($ticketsQuery as $row) {
    $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
    $tickets[] = $row;
}
$historyMap = rc_ticket_history_map($db, array_map(static function ($row) {
    return (int)$row['id'];
}, $tickets));
foreach ($tickets as &$ticketRow) {
    $ticketRow['history'] = $historyMap[(int)$ticketRow['id']] ?? [];
}
unset($ticketRow);

$openTicketsCount = (int)$db->query("SELECT COUNT(*) FROM `myaac_tickets` WHERE `status` = 'open'")->fetchColumn();

$characterSearch = trim((string)($_REQUEST['character_name'] ?? ''));
$searchedCharacter = null;
$characterActions = [];

if ($characterSearch !== '') {
    if (!preg_match('/^[A-Za-z ]+$/', $characterSearch)) {
        $errors[] = 'Character search accepts only letters and spaces.';
    } else {
        $characterData = $db->query(
            'SELECT `p`.`name`, `p`.`account_id`, `a`.`name` as `account_name` ' .
            'FROM `players` `p` LEFT JOIN `accounts` `a` ON `a`.`id` = `p`.`account_id` ' .
            'WHERE `p`.`name` = ' . $db->quote($characterSearch) . ' LIMIT 1'
        )->fetch();

        if ($characterData) {
            $searchedCharacter = $characterData;
            $actionsQuery = $db->query(
                'SELECT `action`, `date`, `ip`, `ipv6` FROM `' . TABLE_PREFIX . 'account_actions` ' .
                'WHERE `account_id` = ' . (int)$characterData['account_id'] . ' ORDER BY `date` DESC LIMIT 150'
            );
            foreach ($actionsQuery as $actionRow) {
                $ipValue = '-';
                if (!empty($actionRow['ip']) && (int)$actionRow['ip'] !== 0) {
                    $ipValue = long2ip((int)$actionRow['ip']);
                } elseif (!empty($actionRow['ipv6'])) {
                    $rawIpv6 = $actionRow['ipv6'];
                    $decoded = @inet_ntop($rawIpv6);
                    $ipValue = $decoded ?: '-';
                }

                $characterActions[] = [
                    'action' => $actionRow['action'],
                    'date' => $actionRow['date'],
                    'ip' => $ipValue,
                ];
            }
        } else {
            $errors[] = 'Character not found.';
        }
    }
}

$twig->display('account.staff_actions.html.twig', [
    'errors' => $errors,
    'success' => $success,
    'tickets' => $tickets,
    'statusMap' => $statusMap,
    'filterStatus' => $filterStatus,
    'filterOptions' => $filterOptions,
    'openTicketsCount' => $openTicketsCount,
    'characterSearch' => $characterSearch,
    'searchedCharacter' => $searchedCharacter,
    'characterActions' => $characterActions,
]);
