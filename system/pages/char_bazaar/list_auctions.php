<?php
if (!$auctions || !is_array($auctions)) {
    $auctions = [];
}

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

foreach ($auctions as $sale) {
    $saleId = (int)$sale['id'];
    $character = cbz_get_character_sale_data($db, $config, (int)$sale['player_id']);
    if (!$character) {
        continue;
    }

    $statusText = cbz_sale_status_label($sale['status']);
    $isOwner = $logged && (int)$sale['account_old'] === (int)$account_logged->getId();
    ?>
    <tr>
        <td>
            <div class="TableContentContainer">
                <table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
                    <tbody>
                    <tr>
                        <td>
                            <div class="Auction">
                                <div class="AuctionHeader">
                                    <div class="AuctionLinks">
                                        <a href="?subtopic=currentcharactertrades&details=<?= $saleId ?>">
                                            <img title="show character details" src="<?= $template_path; ?>/images/global/content/button-details-idle.png">
                                        </a>
                                    </div>
                                    <div class="AuctionCharacterName">
                                        <a href="?subtopic=currentcharactertrades&details=<?= $saleId ?>"><?= htmlspecialchars($character['name']) ?></a>
                                    </div>
                                    Level: <?= (int)$character['level'] ?> | Vocation: <?= htmlspecialchars($character['vocation']) ?> | <?= htmlspecialchars($character['sex']) ?> | World: <?= htmlspecialchars($character['world']) ?><br>
                                </div>
                                <div class="AuctionBody">
                                    <div class="AuctionBodyBlock AuctionDisplay AuctionOutfit">
                                        <img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>">
                                    </div>
                                    <div class="AuctionBodyBlock ShortAuctionData">
                                        <div class="ShortAuctionDataLabel">Sale created:</div>
                                        <div class="ShortAuctionDataValue"><?= date('M d Y, H:i:s', strtotime($sale['date_start'])) ?></div>
                                        <div class="ShortAuctionDataBidRow">
                                            <div class="ShortAuctionDataLabel">Fixed Price:</div>
                                            <div class="ShortAuctionDataValue">
                                                <b><?= number_format((int)$sale['price'], 0, ',', ',') ?></b>
                                                <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png" class="VSCCoinImages" title="Transferable Tibia Coins">
                                            </div>
                                        </div>
                                        <div class="ShortAuctionDataBidRow">
                                            <div class="ShortAuctionDataLabel">Status:</div>
                                            <div class="ShortAuctionDataValue"><b><?= htmlspecialchars($statusText) ?></b></div>
                                        </div>
                                        <div class="ShortAuctionDataBidRow">
                                            <div class="ShortAuctionDataLabel">Addons:</div>
                                            <div class="ShortAuctionDataValue"><?= (int)$character['addons_count'] ?> (<a href="?subtopic=currentcharactertrades&details=<?= $saleId ?>#addons-list">View</a>)</div>
                                        </div>
                                        <div class="ShortAuctionDataBidRow">
                                            <div class="ShortAuctionDataLabel">Mounts:</div>
                                            <div class="ShortAuctionDataValue"><?= (int)$character['mounts_count'] ?> (<a href="?subtopic=currentcharactertrades&details=<?= $saleId ?>#mounts-list">View</a>)</div>
                                        </div>
                                    </div>
                                    <div class="AuctionBodyBlock CurrentBid">
                                        <div class="Container">
                                            <?php if (!$logged): ?>
                                                <div class="MyMaxBidLabel" style="font-weight: normal;">Please login first.</div>
                                            <?php elseif ($isOwner): ?>
                                                <div class="MyMaxBidLabel" style="font-weight: normal;">My sale.</div>
                                            <?php else: ?>
                                                <form action="?subtopic=currentcharactertrades&action=buy" method="post">
                                                    <input type="hidden" name="sale_id" value="<?= $saleId ?>">
                                                    <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)">
                                                        <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                                            <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
                                                            <input name="sale_confirm" class="BigButtonText" type="submit" value="Buy">
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    <?php
}
?>
