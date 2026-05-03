<?php
global $db, $twig, $account_logged;

defined('MYAAC') or die('Direct access not allowed!');
$title = 'Tickets';

require_once SYSTEM . 'libs/rc_tickets.php';

rc_ensure_tickets_schema($db);

$isStaff = rc_is_staff_web_flag3();
$statusMap = rc_ticket_status_map();
$filterOptions = rc_ticket_filter_options();
$allowedStatuses = array_keys($statusMap);

if (!$isStaff) {
    error('Access denied.');
    return;
}

$errors = [];
$success = '';

$filterStatus = trim((string)($_REQUEST['status'] ?? 'all'));
if (!isset($filterOptions[$filterStatus])) {
    $filterStatus = 'all';
}

if ($isStaff && isset($_POST['staff_update_ticket'])) {
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
                $staffAccountId = ($account_logged && $account_logged->isLoaded()) ? (int)$account_logged->getId() : 0;
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

$tickets = [];
$whereSql = '';
if ($filterStatus !== 'all') {
    $whereSql = ' WHERE `status` = ' . $db->quote($filterStatus) . ' ';
}

$query = $db->query(
    'SELECT `id`, `character_name`, `title`, `summary`, `description`, `status`, `staff_reply`, `staff_updated_at`, `created_at` FROM `myaac_tickets`' .
    $whereSql .
    'ORDER BY `id` DESC LIMIT 300'
);
foreach ($query as $row) {
    $row['status_label'] = $statusMap[$row['status']] ?? ucfirst(str_replace('_', ' ', (string)$row['status']));
    $tickets[] = $row;
}

$historyMap = rc_ticket_history_map($db, array_map(static function ($row) {
    return (int)$row['id'];
}, $tickets));
foreach ($tickets as &$row) {
    $row['history'] = $historyMap[(int)$row['id']] ?? [];
}
unset($row);

$openTicketsCount = (int)$db->query("SELECT COUNT(*) FROM `myaac_tickets` WHERE `status` = 'open'")->fetchColumn();

$twig->display('tickets.html.twig', [
    'errors' => $errors,
    'success' => $success,
    'tickets' => $tickets,
    'isStaff' => $isStaff,
    'statusMap' => $statusMap,
    'openTicketsCount' => $openTicketsCount,
    'filterStatus' => $filterStatus,
    'filterOptions' => $filterOptions,
]);
