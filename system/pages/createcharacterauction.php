<style>
    form {
        display: block;
        margin-top: 0;
        margin-block-end: 0;
    }

    .CVIcon.CVIconObject img {
        width: 32px;
        height: 32px;
    }
</style>

<?php
/**
 * Char Bazaar - Direct Sale
 */

defined('MYAAC') or die('Direct access not allowed!');
$title = 'Create Sale';

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

if ($logged) {
    require SYSTEM . 'pages/char_bazaar/coins_balance.php';
} else {
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

$charbazaar_create = (int)($config['bazaar_create'] ?? 0);
$charbazaar_tax = (int)($config['bazaar_tax'] ?? 0);
$charbazaar_newacc = (int)($config['bazaar_accountid'] ?? 1);

$getAuctionStep = (int)($_GET['step'] ?? 1);
if ($getAuctionStep < 1 || $getAuctionStep > 5) {
    header('Location: ' . BASE_URL . '?subtopic=createcharacterauction&step=1');
    return;
}

if ($getAuctionStep === 1) {
    require SYSTEM . 'pages/char_bazaar/create_step1.php';
    return;
}

if ($getAuctionStep === 2) {
    require SYSTEM . 'pages/char_bazaar/create_step2.php';
    return;
}

if ($getAuctionStep === 3) {
    require SYSTEM . 'pages/char_bazaar/create_step3.php';
    return;
}

if ($getAuctionStep === 4) {
    require SYSTEM . 'pages/char_bazaar/create_step4.php';
    return;
}

if ($getAuctionStep === 5) {
    if (!isset($_POST['auction_confirm'], $_POST['auction_price'], $_POST['auction_character'])) {
        header('Location: ' . BASE_URL . '?subtopic=createcharacterauction&step=1');
        return;
    }

    $auction_price = (int)$_POST['auction_price'];
    $auction_character = (int)$_POST['auction_character'];
    $accountId = (int)$account_logged->getId();

    if ($auction_price < 1 || $auction_character < 1) {
        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">You must set a valid fixed sale price.</p></div></div></div><br>';
        return;
    }

    try {
        $db->beginTransaction();

        $character = $db->query('SELECT `id`, `account_id` FROM `players` WHERE `id` = ' . $db->quote($auction_character) . ' FOR UPDATE')->fetch();
        if (!$character) {
            throw new Exception('Character not found.');
        }

        if ((int)$character['account_id'] !== $accountId) {
            throw new Exception('You can only create sales for your characters.');
        }

        $alreadySale = $db->query('SELECT `id` FROM `myaac_charbazaar` WHERE `player_id` = ' . $db->quote($auction_character) . ' AND `status` = 0 LIMIT 1 FOR UPDATE')->fetch();
        if ($alreadySale) {
            throw new Exception('This character is already listed for sale.');
        }

        $account = $db->query('SELECT `id`, `coins_transferable` FROM `accounts` WHERE `id` = ' . $db->quote($accountId) . ' FOR UPDATE')->fetch();
        if (!$account) {
            throw new Exception('Account not found.');
        }

        if ((int)$account['coins_transferable'] < $charbazaar_create) {
            throw new Exception('Insufficient transferable coins to create this sale.');
        }

        $newBalance = (int)$account['coins_transferable'] - $charbazaar_create;
        $db->exec('UPDATE `accounts` SET `coins_transferable` = ' . $db->quote($newBalance) . ' WHERE `id` = ' . $db->quote($accountId));

        $date_start = date('Y-m-d H:i:s');
        $date_end = '9999-12-31 23:59:59';

        $db->exec('INSERT INTO `myaac_charbazaar` (`account_old`, `account_new`, `player_id`, `price`, `date_end`, `date_start`, `bid_account`, `bid_price`, `status`) VALUES ('
            . $db->quote($accountId) . ', '
            . $db->quote($charbazaar_newacc) . ', '
            . $db->quote($auction_character) . ', '
            . $db->quote($auction_price) . ', '
            . $db->quote($date_end) . ', '
            . $db->quote($date_start) . ', 0, 0, 0)');

        $saleId = (int)$db->lastInsertId();

        $db->exec('UPDATE `players` SET `account_id` = ' . $db->quote($charbazaar_newacc) . ' WHERE `id` = ' . $db->quote($auction_character));

        $db->commit();

        ?>
        <div class="TableContainer">
            <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sale Created</div></div></div>
            <table class="Table5" cellspacing="0" cellpadding="0"><tbody><tr><td>
                <div class="InnerTableContainer">
                    <table style="width:100%;"><tbody><tr><td>
                        <div class="TableContentContainer">
                            <table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                                <tr>
                                    <td style="font-weight:normal;"><img src="<?= $template_path; ?>/images/charactertrade/confirm.gif"></td>
                                    <td style="font-weight:bold; font-size: 24px;">Sale created</td>
                                    <td>
                                        <a href="?subtopic=currentcharactertrades&details=<?= $saleId ?>">
                                            <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)">
                                                <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                                    <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
                                                    <input name="sale_confirm" class="BigButtonText" type="button" value="View sale">
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </td></tr></tbody></table>
                </div>
            </td></tr></tbody></table>
        </div>
        <?php
    } catch (Exception $e) {
        if ($db->inTransaction()) {
            $db->rollBack();
        }

        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">' . htmlspecialchars($e->getMessage()) . '</p></div></div></div><br>';
    }
}
?>
