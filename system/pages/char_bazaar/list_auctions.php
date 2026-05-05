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
    $equipped = $character['equipped_inventory'] ?? [];
    ?>
    <tr>
        <td>
            <div class="TableContentContainer rc-cbz-list-card">
                <table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
                    <tbody>
                    <tr>
                        <td>
                            <div class="rc-cbz-list-head">
                                <div>
                                    <div class="AuctionCharacterName">
                                        <?= htmlspecialchars($character['name']) ?>
                                    </div>
                                    <div class="rc-cbz-list-meta">
                                        Level: <?= (int)$character['level'] ?> |
                                        Vocation: <?= htmlspecialchars($character['vocation']) ?> |
                                        <?= htmlspecialchars($character['sex']) ?> |
                                        World: <?= htmlspecialchars($character['world']) ?>
                                    </div>
                                </div>
                                <a class="rc-cbz-details-link" href="?subtopic=currentcharactertrades&details=<?= $saleId ?>" title="View full details">
                                    <img alt="details" src="<?= $template_path; ?>/images/global/content/button-details-idle.png">
                                </a>
                            </div>

                            <div class="rc-cbz-list-body">
                                <div class="rc-cbz-list-left">
                                    <div class="AuctionOutfit">
                                        <img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>" alt="outfit">
                                    </div>
                                    <div class="rc-cbz-mini-equip">
                                        <div><?= $equipped[2] ?? '' ?></div>
                                        <div><?= $equipped[1] ?? '' ?></div>
                                        <div><?= $equipped[4] ?? '' ?></div>
                                        <div><?= $equipped[7] ?? '' ?></div>
                                    </div>
                                </div>

                                <div class="rc-cbz-list-middle">
                                    <div class="rc-cbz-list-row"><span>Sale created:</span><strong><?= date('M d Y, H:i:s', strtotime($sale['date_start'])) ?></strong></div>
                                    <div class="rc-cbz-list-row"><span>Status:</span><strong><?= htmlspecialchars($statusText) ?></strong></div>
                                    <div class="rc-cbz-list-row"><span>Full Addons:</span><strong><?= (int)$character['full_addons_count'] ?></strong></div>
                                    <div class="rc-cbz-list-row"><span>Mounts:</span><strong><?= (int)$character['mounts_count'] ?></strong></div>
                                    <div class="rc-cbz-list-row"><span>Charm Points:</span><strong><?= htmlspecialchars((string)$character['charm_points']) ?></strong></div>
                                </div>

                                <div class="rc-cbz-list-right">
                                    <div class="rc-cbz-price-box">
                                        <small>Fixed Price</small>
                                        <strong><?= number_format((int)$sale['price'], 0, ',', ',') ?> TC</strong>
                                    </div>

                                    <?php if (!$logged): ?>
                                        <a class="rc-bazaar-view-btn" href="?account/manage&redirect=<?= urlencode('?subtopic=currentcharactertrades&action=buy&sale_id=' . $saleId) ?>">Buy Character</a>
                                    <?php elseif ($isOwner): ?>
                                        <div class="MyMaxBidLabel" style="font-weight: normal;">My sale.</div>
                                    <?php else: ?>
                                        <button class="rc-bazaar-view-btn rc-cbz-buy-open" type="button" data-target="rc-cbz-buy-modal-<?= $saleId ?>">Buy Character</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <?php if ($logged && !$isOwner): ?>
            <div id="rc-cbz-buy-modal-<?= $saleId ?>" class="rc-cbz-modal" aria-hidden="true">
                <div class="rc-cbz-modal-card rc-cbz-buy-modal">
                    <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-buy-modal-<?= $saleId ?>">×</button>
                    <h4>Are you buying this character?</h4>
                    <p><?= htmlspecialchars($character['name']) ?> - <?= number_format((int)$sale['price'], 0, ',', ',') ?> TC</p>
                    <div class="rc-cbz-buy-actions">
                        <form action="?subtopic=currentcharactertrades&action=buyfinish" method="post">
                            <input type="hidden" name="sale_id" value="<?= $saleId ?>">
                            <button class="rc-bazaar-view-btn" type="submit">Yes, Buy</button>
                        </form>
                        <button class="rc-bazaar-view-btn rc-cbz-modal-close" data-close="rc-cbz-buy-modal-<?= $saleId ?>" type="button">No</button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </td>
    </tr>
    <?php
}
?>

<script>
    (function() {
        document.querySelectorAll('.rc-cbz-buy-open').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var target = btn.getAttribute('data-target');
                var modal = document.getElementById(target);
                if (!modal) return;
                modal.classList.add('is-visible');
                modal.setAttribute('aria-hidden', 'false');
            });
        });

        document.querySelectorAll('.rc-cbz-modal-close').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var target = btn.getAttribute('data-close');
                if (!target) return;
                var modal = document.getElementById(target);
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
