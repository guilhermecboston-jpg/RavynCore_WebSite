<?php
/**
 * My Character Sales
 */
defined('MYAAC') or die('Direct access not allowed!');
$title = 'My Sales';

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';
$errors = [];
if ($logged) {
    require SYSTEM . 'pages/char_bazaar/coins_balance.php';
}

if (!$logged) {
    if (!empty($errors)) {
        $twig->display('error_box.html.twig', array('errors' => $errors));
    }

    $twig->display('account.login.html.twig', array(
        'redirect' => isset($_REQUEST['redirect']) ? $_REQUEST['redirect'] : null,
        'account' => USE_ACCOUNT_NAME ? 'Name' : 'Number',
        'account_login_by' => getAccountLoginByLabel(),
        'error' => isset($errors[0]) ? $errors[0] : null
    ));
    return;
}

$messages = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'cancel') {
    $saleId = (int)($_POST['sale_id'] ?? 0);
    $accountId = (int)$account_logged->getId();

    if ($saleId <= 0) {
        $errors[] = 'Invalid sale id.';
    } else {
        try {
            $db->beginTransaction();
            $saleStmt = $db->query("SELECT * FROM `myaac_charbazaar` WHERE `id` = {$saleId} FOR UPDATE");
            $sale = $saleStmt->fetch();

            if (!$sale || (int)$sale['status'] !== 0) {
                throw new Exception('Sale is not available for cancellation.');
            }

            if ((int)$sale['account_old'] !== $accountId) {
                throw new Exception('You can only cancel your own sales.');
            }

            $playerId = (int)$sale['player_id'];
            $playerStmt = $db->query("SELECT `id`, `account_id` FROM `players` WHERE `id` = {$playerId} FOR UPDATE");
            $player = $playerStmt->fetch();
            if (!$player) {
                throw new Exception('Character not found.');
            }

            if ((int)$player['account_id'] !== (int)$sale['account_new']) {
                throw new Exception('Character transfer state changed. Please refresh and try again.');
            }

            $now = date('Y-m-d H:i:s');

            $db->exec("UPDATE `players` SET `account_id` = {$accountId} WHERE `id` = {$playerId}");
            $db->exec("UPDATE `myaac_charbazaar` SET `status` = 2, `account_new` = {$accountId}, `date_end` = " . $db->quote($now) . " WHERE `id` = {$saleId}");

            $db->commit();
            $messages[] = 'Sale cancelled successfully. Character returned to your account.';
        } catch (Exception $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            $errors[] = $e->getMessage();
        }
    }
}

foreach ($messages as $message) {
    echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#2f7a2f;font-weight:bold;">' . htmlspecialchars($message) . '</p></div></div></div><br>';
}
foreach ($errors as $error) {
    echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">' . htmlspecialchars($error) . '</p></div></div></div><br>';
}

$sales = $db->query("SELECT * FROM `myaac_charbazaar` WHERE `account_old` = " . (int)$account_logged->getId() . " ORDER BY `id` DESC");
?>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">My Character Sales</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer">
            <table class="TableContent" style="width:100%;border:1px solid #faf0d7;">
                <tbody>
                <tr class="Odd">
                    <td class="LabelV">Character</td>
                    <td class="LabelV">Price</td>
                    <td class="LabelV">Status</td>
                    <td class="LabelV">Updated</td>
                    <td class="LabelV">Actions</td>
                </tr>
                <?php
                $rows = $sales->fetchAll();
                if (!$rows) {
                    echo '<tr><td colspan="5" style="text-align:center;padding:14px;">You have no sales yet.</td></tr>';
                }
                $i = 0;
                foreach ($rows as $sale) {
                    $i++;
                    $char = $db->query("SELECT `name`,`level` FROM `players` WHERE `id` = " . (int)$sale['player_id'])->fetch();
                    $statusText = cbz_sale_status_label($sale['status']);
                    $updatedAt = !empty($sale['date_end']) ? date('d M Y, H:i', strtotime($sale['date_end'])) : date('d M Y, H:i', strtotime($sale['date_start']));
                    ?>
                    <tr bgcolor="<?= getStyle($i) ?>">
                        <td><?= htmlspecialchars(($char['name'] ?? 'Unknown') . ' (Lv ' . (int)($char['level'] ?? 0) . ')') ?></td>
                        <td><?= number_format((int)$sale['price'], 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td>
                        <td><?= htmlspecialchars($statusText) ?></td>
                        <td><?= $updatedAt ?></td>
                        <td>
                            <a href="?subtopic=currentcharactertrades&details=<?= (int)$sale['id'] ?>">
                                <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif);display:inline-block;">
                                    <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                        <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
                                        <input class="BigButtonText" type="button" value="View">
                                    </div>
                                </div>
                            </a>
                            <?php if ((int)$sale['status'] === 0): ?>
                            <form method="post" action="?subtopic=owncharactertrades&action=cancel" style="display:inline-block;margin:0 0 0 4px;">
                                <input type="hidden" name="sale_id" value="<?= (int)$sale['id'] ?>">
                                <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_red.gif);display:inline-block;">
                                    <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                        <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_red_over.gif); visibility: hidden;"></div>
                                        <input class="BigButtonText" type="submit" value="Cancel" onclick="return confirm('Cancel this sale?');">
                                    </div>
                                </div>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </td></tr></tbody></table>
</div>
