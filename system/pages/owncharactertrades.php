<?php
/**
 * My Character Sales
 */
defined('MYAAC') or die('Direct access not allowed!');
$title = 'My Sales';

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';
$errors = [];

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
                    $saleId = (int)$sale['id'];
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
                            <a href="?subtopic=currentcharactertrades&details=<?= $saleId ?>">
                                <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif);display:inline-block;">
                                    <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                        <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
                                        <input class="BigButtonText" type="button" value="View">
                                    </div>
                                </div>
                            </a>
                            <?php if ((int)$sale['status'] === 0): ?>
                                <button class="rc-bazaar-view-btn rc-cbz-buy-open rc-cbz-buy-btn" type="button" data-target="rc-cbz-cancel-modal-<?= $saleId ?>" style="margin-left: 4px;">Cancel</button>

                                <div id="rc-cbz-cancel-modal-<?= $saleId ?>" class="rc-cbz-modal" aria-hidden="true">
                                    <div class="rc-cbz-modal-card rc-cbz-buy-modal">
                                        <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-cancel-modal-<?= $saleId ?>">&times;</button>
                                        <h4>Are you cancelling this sale?</h4>
                                        <p><?= htmlspecialchars(($char['name'] ?? 'Unknown') . ' - ' . number_format((int)$sale['price'], 0, ',', ',') . ' TC') ?></p>
                                        <div class="rc-cbz-buy-actions">
                                            <form method="post" action="?subtopic=owncharactertrades&action=cancel" style="margin:0;">
                                                <input type="hidden" name="sale_id" value="<?= $saleId ?>">
                                                <button class="rc-bazaar-view-btn rc-cbz-buy-btn" type="submit">YES, CANCEL</button>
                                            </form>
                                            <button class="rc-bazaar-view-btn rc-cbz-modal-close" data-close="rc-cbz-cancel-modal-<?= $saleId ?>" type="button">No</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </td></tr></tbody></table>
</div>

<script>
    (function() {
        if (document && document.body) {
            document.body.classList.add('rc-page-owncharactertrades');
        }
        document.querySelectorAll('.rc-cbz-buy-open').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var id = btn.getAttribute('data-target');
                var modal = document.getElementById(id);
                if (!modal) return;
                modal.classList.add('is-visible');
                modal.setAttribute('aria-hidden', 'false');
            });
        });
        document.querySelectorAll('.rc-cbz-modal-close').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var id = btn.getAttribute('data-close');
                var modal = document.getElementById(id);
                if (!modal) return;
                modal.classList.remove('is-visible');
                modal.setAttribute('aria-hidden', 'true');
            });
        });
        document.querySelectorAll('.rc-cbz-modal').forEach(function(modal) {
            modal.addEventListener('click', function(ev) {
                if (ev.target === modal) {
                    modal.classList.remove('is-visible');
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        });
    })();
</script>
