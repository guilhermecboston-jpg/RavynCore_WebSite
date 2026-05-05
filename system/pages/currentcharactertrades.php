<?php
/**
 * Char Bazaar - Direct Sale Mode
 */
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Char Bazaar';

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';
// Intentionally not showing coins balance block here to keep bazaar pages clean.

$errors = [];

$charbazaar_tax = (int)($config['bazaar_tax'] ?? 0);
$getPageDetails = isset($_GET['details']) ? (int)$_GET['details'] : 0;
$getPageAction = isset($_GET['action']) ? $_GET['action'] : null;
$saleIdFromRequest = 0;
if (isset($_POST['sale_id'])) {
    $saleIdFromRequest = (int)$_POST['sale_id'];
} elseif (isset($_GET['sale_id'])) {
    $saleIdFromRequest = (int)$_GET['sale_id'];
}

if ($getPageDetails > 0) {
    $cbzBackSubtopic = 'currentcharactertrades';
    require SYSTEM . 'pages/char_bazaar/details.php';
    return;
}

if (!$logged && ($getPageAction === 'buy' || $getPageAction === 'buyfinish')) {
    $redirectTarget = '?subtopic=currentcharactertrades';
    if ($saleIdFromRequest > 0) {
        $redirectTarget .= '&action=buy&sale_id=' . $saleIdFromRequest;
    }

    if (!empty($errors)) {
        $twig->display('error_box.html.twig', array('errors' => $errors));
    }

    $twig->display('account.login.html.twig', array(
        'redirect' => $redirectTarget,
        'account' => USE_ACCOUNT_NAME ? 'Name' : 'Number',
        'account_login_by' => getAccountLoginByLabel(),
        'error' => isset($errors[0]) ? $errors[0] : null
    ));
    return;
}

$messages = [];

if ($logged && $_SERVER['REQUEST_METHOD'] === 'POST' && $getPageAction === 'buyfinish') {
    $saleId = (int)($_POST['sale_id'] ?? 0);
    $buyerId = (int)$account_logged->getId();

    if ($saleId <= 0) {
        $errors[] = 'Invalid sale id.';
    } else {
        try {
            $db->beginTransaction();

            $saleStmt = $db->query("SELECT * FROM `myaac_charbazaar` WHERE `id` = {$saleId} FOR UPDATE");
            $sale = $saleStmt->fetch();

            if (!$sale || (int)$sale['status'] !== 0) {
                throw new Exception('This character is no longer available.');
            }

            if ((int)$sale['account_old'] === $buyerId) {
                throw new Exception('You cannot buy your own character.');
            }

            $buyerStmt = $db->query("SELECT `id`, `coins_transferable` FROM `accounts` WHERE `id` = {$buyerId} FOR UPDATE");
            $buyer = $buyerStmt->fetch();
            if (!$buyer) {
                throw new Exception('Buyer account not found.');
            }

            $sellerId = (int)$sale['account_old'];
            $sellerStmt = $db->query("SELECT `id`, `coins_transferable` FROM `accounts` WHERE `id` = {$sellerId} FOR UPDATE");
            $seller = $sellerStmt->fetch();
            if (!$seller) {
                throw new Exception('Seller account not found.');
            }

            $price = (int)$sale['price'];
            if ((int)$buyer['coins_transferable'] < $price) {
                throw new Exception('Insufficient balance to complete this purchase.');
            }

            $playerId = (int)$sale['player_id'];
            $playerStmt = $db->query("SELECT `id`, `account_id` FROM `players` WHERE `id` = {$playerId} FOR UPDATE");
            $player = $playerStmt->fetch();
            if (!$player) {
                throw new Exception('Character not found.');
            }

            if ((int)$player['account_id'] !== (int)$sale['account_new']) {
                throw new Exception('Character is not available for transfer anymore.');
            }

            $sellerCredit = $price;
            if ($charbazaar_tax > 0) {
                $sellerCredit = (int)floor($price - (($price * $charbazaar_tax) / 100));
                if ($sellerCredit < 0) {
                    $sellerCredit = 0;
                }
            }

            $newBuyerBalance = (int)$buyer['coins_transferable'] - $price;
            $newSellerBalance = (int)$seller['coins_transferable'] + $sellerCredit;

            $db->exec("UPDATE `accounts` SET `coins_transferable` = {$newBuyerBalance} WHERE `id` = {$buyerId}");
            $db->exec("UPDATE `accounts` SET `coins_transferable` = {$newSellerBalance} WHERE `id` = {$sellerId}");

            $db->exec("UPDATE `players` SET `account_id` = {$buyerId} WHERE `id` = {$playerId}");

            $now = date('Y-m-d H:i:s');
            $db->exec("UPDATE `myaac_charbazaar` SET `status` = 1, `account_new` = {$buyerId}, `bid_account` = {$buyerId}, `bid_price` = {$price}, `date_end` = " . $db->quote($now) . " WHERE `id` = {$saleId}");

            $db->commit();
            $messages[] = 'Character purchased successfully and transferred to your account.';
        } catch (Exception $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            $errors[] = $e->getMessage();
        }
    }
}

if ($logged && $getPageAction === 'buy') {
    $saleId = $saleIdFromRequest;
    $sale = null;
    if ($saleId > 0) {
        $saleStmt = $db->query("SELECT * FROM `myaac_charbazaar` WHERE `id` = {$saleId}");
        $sale = $saleStmt->fetch();
    }

    if (!$sale || (int)$sale['status'] !== 0) {
        $errors[] = 'This character is no longer available.';
    } elseif ((int)$sale['account_old'] === (int)$account_logged->getId()) {
        $errors[] = 'You cannot buy your own character.';
    } else {
        $characterData = cbz_get_character_sale_data($db, $config, (int)$sale['player_id']);
        ?>
        <div class="TableContainer">
            <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Confirm Purchase</div></div></div>
            <table class="Table5" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer">
                <table style="width:100%;"><tbody>
                    <tr><td><b>Character:</b> <?= htmlspecialchars($characterData['name']) ?></td></tr>
                    <tr><td><b>Vocation:</b> <?= htmlspecialchars($characterData['vocation']) ?> | <b>Level:</b> <?= (int)$characterData['level'] ?></td></tr>
                    <tr><td><b>Fixed Price:</b> <?= number_format((int)$sale['price'], 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td></tr>
                    <tr><td style="padding-top:10px;">
                        <form method="post" action="?subtopic=currentcharactertrades&action=buyfinish">
                            <input type="hidden" name="sale_id" value="<?= (int)$sale['id'] ?>">
                            <div style="display:flex;gap:10px;">
                                <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)">
                                    <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                        <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
                                        <input class="BigButtonText" type="submit" value="Buy Now">
                                    </div>
                                </div>
                                <a href="?subtopic=currentcharactertrades" class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_red.gif)">
                                    <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                        <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_red_over.gif); visibility: hidden;"></div>
                                        <input class="BigButtonText" type="button" value="Cancel">
                                    </div>
                                </a>
                            </div>
                        </form>
                    </td></tr>
                </tbody></table>
            </div>
            </td></tr></tbody></table>
        </div>
        <br>
        <?php
    }
}

foreach ($messages as $message) {
    echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#2f7a2f;font-weight:bold;">' . htmlspecialchars($message) . '</p></div></div></div><br>';
}
foreach ($errors as $error) {
    echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">' . htmlspecialchars($error) . '</p></div></div></div><br>';
}

$subtopic = 'currentcharactertrades';
$sales = $db->query("SELECT `id`, `account_old`, `account_new`, `player_id`, `price`, `date_end`, `date_start`, `bid_account`, `bid_price`, `status` FROM `myaac_charbazaar` WHERE `status` = 0 ORDER BY `date_start` DESC");

?>

<div class="SmallBox">
    <div class="MessageContainer">
        <div class="Message">
            <p><b>Direct Sale Bazaar:</b> Characters are sold instantly for a fixed price.</p>
            <p>No bids, no timers. A sale stays active until purchased or cancelled by the owner.</p>
        </div>
    </div>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer">
        <div class="CaptionInnerContainer">
            <div class="Text">Current Character Sales</div>
        </div>
    </div>
    <table class="Table3" cellspacing="0" cellpadding="0">
        <tbody>
        <tr><td>
            <div class="InnerTableContainer">
                <table style="width:100%;"><tbody>
                <?php
                if ($sales->rowCount() === 0) {
                    echo '<tr><td style="text-align:center;padding:20px;">No active character sales at the moment.</td></tr>';
                } else {
                    $auctions = $sales->fetchAll();
                    require SYSTEM . 'pages/char_bazaar/list_auctions.php';
                }
                ?>
                </tbody></table>
            </div>
        </td></tr>
        </tbody>
    </table>
</div>
