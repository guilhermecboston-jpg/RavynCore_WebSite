<?php

if (!empty($_POST['auction_price']) && !empty($_POST['auction_character'])) {
    require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

    $selectCharacter = (int)$_POST['auction_character'];
    $price = (int)$_POST['auction_price'];
    $accountId = (int)$account_logged->getId();

    $character = cbz_get_character_sale_data($db, $config, $selectCharacter);
    if (!$character) {
        header('Location: ' . BASE_URL . '?subtopic=createcharacterauction&step=1');
        return;
    }

    if ((int)$character['player']['account_id'] !== $accountId) {
        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">You can only create sales for your own characters.</p></div></div></div><br>';
        return;
    }

    if ($price < 1) {
        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">Please define a valid fixed price.</p></div></div></div><br>';
        return;
    }

    $account = $db->query('SELECT `coins_transferable` FROM `accounts` WHERE `id` = ' . $accountId)->fetch();
    $createFee = (int)($config['bazaar_create'] ?? 0);
    $taxPercent = (int)($config['bazaar_tax'] ?? 0);
    $taxValue = (int)floor(($price * $taxPercent) / 100);
    $sellerReceives = max(0, $price - $taxValue);

    ?>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Confirm Sale (4/4)</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer">
                <table style="width:100%;"><tbody>
                <tr>
                    <td style="width:180px;text-align:center;"><img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>"></td>
                    <td>
                        <div class="AuctionCharacterName"><?= htmlspecialchars($character['name']) ?></div>
                        Level: <?= (int)$character['level'] ?> | Vocation: <?= htmlspecialchars($character['vocation']) ?> | <?= htmlspecialchars($character['sex']) ?>
                    </td>
                </tr>
                </tbody></table>
            </div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sale Information</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer">
                <table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Fixed Price</td><td><?= number_format($price, 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td></tr>
                <tr><td class="LabelV">Tax (<?= $taxPercent ?>%)</td><td><?= number_format($taxValue, 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td></tr>
                <tr><td class="LabelV">You receive on sale</td><td><?= number_format($sellerReceives, 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td></tr>
                <tr><td class="LabelV">Create Fee</td><td><?= number_format($createFee, 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td></tr>
                <tr><td class="LabelV">Your Balance</td><td><?= number_format((int)$account['coins_transferable'], 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td></tr>
                </tbody></table>
            </div>
        </td></tr></tbody></table>
    </div>
    <br>

    <form method="post" action="?subtopic=createcharacterauction&step=5">
        <input type="hidden" name="auction_price" value="<?= $price ?>">
        <input type="hidden" name="auction_character" value="<?= $selectCharacter ?>">
        <table class="InnerTableButtonRow" cellspacing="0" cellpadding="0"><tbody><tr>
            <td>
                <div style="float: right;">
                    <a href="?subtopic=createcharacterauction&step=3">
                        <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_red.gif)">
                            <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_red_over.gif); visibility: hidden;"></div>
                                <input class="BigButtonText" type="button" value="Cancel">
                            </div>
                        </div>
                    </a>
                </div>
            </td>
            <td>
                <div style="float: left;">
                    <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)">
                        <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                            <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
                            <input name="auction_confirm" class="BigButtonText" type="submit" value="Confirm Sale">
                        </div>
                    </div>
                </div>
            </td>
        </tr></tbody></table>
    </form>

    <?php
} else {
    header('Location: ' . BASE_URL . '?subtopic=createcharacterauction&step=1');
}
