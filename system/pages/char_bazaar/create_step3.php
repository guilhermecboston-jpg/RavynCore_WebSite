<?php

$selectCharacter = 0;
if (isset($_POST['auction_character'])) {
    $selectCharacter = (int)$_POST['auction_character'];
} elseif (isset($_GET['auction_character'])) {
    $selectCharacter = (int)$_GET['auction_character'];
}

if ($selectCharacter > 0) {
    require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

    $accountId = (int)$account_logged->getId();
    $verifiedCharacter = (int)($_SESSION['cbz_verified_character'] ?? 0);
    $verifiedAccount = (int)($_SESSION['cbz_verified_account'] ?? 0);
    $verifiedAt = (int)($_SESSION['cbz_verified_recovery_at'] ?? 0);
    $verificationExpired = ($verifiedAt < (time() - 1800)); // 30 minutes
    if ($verifiedCharacter !== $selectCharacter || $verifiedAccount !== $accountId || $verificationExpired) {
        header('Location: ' . BASE_URL . '?subtopic=createcharacterauction&step=2&auction_character=' . $selectCharacter);
        return;
    }

    $character = cbz_get_character_sale_data($db, $config, $selectCharacter);

    if (!$character) {
        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">Character not found.</p></div></div></div><br>';
        return;
    }

    if ((int)$character['player']['account_id'] !== $accountId) {
        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">You can only create sales for your own characters.</p></div></div></div><br>';
        return;
    }

    $alreadySale = $db->query("SELECT `id` FROM `myaac_charbazaar` WHERE `player_id` = {$selectCharacter} AND `status` = 0 LIMIT 1")->fetch();
    if ($alreadySale) {
        echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">This character is already listed for sale.</p></div></div></div><br>';
        return;
    }

    $account = $db->query('SELECT `coins_transferable` FROM `accounts` WHERE `id` = ' . $accountId)->fetch();
    $equipped = $character['equipped_inventory'] ?? [];
    $addonsList = $character['full_addons_list'] ?? [];
    $mountsList = $character['full_mounts_list'] ?? [];
    $itemSummaryRows = $character['item_summary_rows'] ?? [];
    $bestiaryList = $character['bestiary_list'] ?? [];
    $bosstiaryList = $character['bosstiary_list'] ?? [];
    $stonesRows = $character['stones_rows'] ?? [];
    ?>

    <div class="rc-cbz-stepper">
        <div class="rc-cbz-stepper-item is-done">
            <img src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-1-green.gif" alt="step 1">
            <span>Select character</span>
        </div>
        <div class="rc-cbz-stepper-item is-done">
            <img src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-2-green.gif" alt="step 2">
            <span>Check character</span>
        </div>
        <div class="rc-cbz-stepper-item is-active">
            <img src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-3-blue.gif" alt="step 3">
            <span>Set character price</span>
        </div>
        <div class="rc-cbz-stepper-item">
            <img src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-4-blue.gif" alt="step 4">
            <span>Confirm sale</span>
        </div>
    </div>

    <div class="TableContainer rc-cbz-host rc-cbz-step3-main">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Setup Sale (3/4)</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer">
                <div class="rc-cbz-layout">
                    <aside class="rc-cbz-profile">
                        <div class="rc-cbz-outfit">
                            <img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>" alt="Character outfit">
                            <h4><?= htmlspecialchars($character['name']) ?></h4>
                            <p>Level <?= (int)$character['level'] ?> | <?= htmlspecialchars($character['vocation']) ?></p>
                            <p><?= htmlspecialchars($character['sex']) ?> | <?= htmlspecialchars($character['world']) ?></p>
                        </div>
                        <div class="rc-cbz-equip">
                            <h5>Inventory</h5>
                            <div class="rc-cbz-equip-grid">
                                <div><?= $equipped[2] ?? '' ?></div>
                                <div><?= $equipped[1] ?? '' ?></div>
                                <div><?= $equipped[3] ?? '' ?></div>
                                <div><?= $equipped[6] ?? '' ?></div>
                                <div><?= $equipped[4] ?? '' ?></div>
                                <div><?= $equipped[5] ?? '' ?></div>
                                <div><?= $equipped[9] ?? '' ?></div>
                                <div><?= $equipped[7] ?? '' ?></div>
                                <div><?= $equipped[10] ?? '' ?></div>
                                <div class="rc-cbz-equip-slot-empty"></div>
                                <div><?= $equipped[8] ?? '' ?></div>
                                <div class="rc-cbz-equip-slot-empty"></div>
                            </div>
                        </div>
                    </aside>

                    <section class="rc-cbz-content">
                        <div class="rc-cbz-section">
                            <h3>Character Overview</h3>
                            <div class="rc-cbz-grid-two">
                                <div><span>Health</span><strong><?= (int)$character['player']['health'] ?> / <?= (int)$character['player']['healthmax'] ?></strong></div>
                                <div><span>Mana</span><strong><?= (int)$character['player']['mana'] ?> / <?= (int)$character['player']['manamax'] ?></strong></div>
                                <div><span>Capacity</span><strong><?= (int)$character['player']['cap'] ?></strong></div>
                                <div><span>Soul</span><strong><?= isset($character['player']['soul']) ? (int)$character['player']['soul'] : 0 ?></strong></div>
                                <div><span>Blessings</span><strong><?= (int)$character['blessings_count'] ?></strong></div>
                                <div><span>Creation Date</span><strong><?= htmlspecialchars((string)$character['creation_date']) ?></strong></div>
                                <div><span>Wheel Points</span><strong><?= number_format((int)$character['wheel_points'], 0, ',', '.') ?></strong></div>
                                <div class="rc-cbz-inline-action"><span>Full Addons</span><strong><?= (int)$character['full_addons_count'] ?> <a href="#" class="rc-bazaar-view-btn rc-cbz-modal-open rc-cbz-inline-btn" data-target="rc-cbz-modal-addons">View</a></strong></div>
                                <div class="rc-cbz-inline-action"><span>Mounts</span><strong><?= (int)$character['mounts_count'] ?> <a href="#" class="rc-bazaar-view-btn rc-cbz-modal-open rc-cbz-inline-btn" data-target="rc-cbz-modal-mounts">View</a></strong></div>
                            </div>
                        </div>

                        <div class="rc-cbz-section">
                            <h3>Skills</h3>
                            <div class="rc-cbz-skills-grid">
                                <div><span>Axe</span><strong><?= (int)$character['player']['skill_axe'] ?></strong></div>
                                <div><span>Club</span><strong><?= (int)$character['player']['skill_club'] ?></strong></div>
                                <div><span>Distance</span><strong><?= (int)$character['player']['skill_dist'] ?></strong></div>
                                <div><span>Fishing</span><strong><?= (int)$character['player']['skill_fishing'] ?></strong></div>
                                <div><span>Fist</span><strong><?= (int)$character['player']['skill_fist'] ?></strong></div>
                                <div><span>Magic Level</span><strong><?= (int)$character['player']['maglevel'] ?></strong></div>
                                <div><span>Shielding</span><strong><?= (int)$character['player']['skill_shielding'] ?></strong></div>
                                <div><span>Sword</span><strong><?= (int)$character['player']['skill_sword'] ?></strong></div>
                            </div>
                        </div>

                        <div class="rc-cbz-section">
                            <h3>Charms & Bestiary</h3>
                            <div class="rc-cbz-grid-two">
                                <div class="rc-cbz-inline-action"><span>Bestiary Points</span><strong><?= htmlspecialchars((string)$character['bestiary_points']) ?> <a href="#" class="rc-bazaar-view-btn rc-cbz-modal-open rc-cbz-inline-btn" data-target="rc-cbz-modal-bestiary">View</a></strong></div>
                                <div><span>Major Charms unlocked</span><strong><?= htmlspecialchars((string)$character['major_charms']) ?></strong></div>
                                <div><span>Minor Charms unlocked</span><strong><?= htmlspecialchars((string)$character['minor_charms']) ?></strong></div>
                            </div>
                        </div>

                        <div class="rc-cbz-section">
                            <h3>Item Summary</h3>
                            <div class="rc-cbz-item-tabs">
                                <button type="button" class="rc-cbz-tab is-active" data-target="inventory">Inventory (<?= htmlspecialchars((string)$character['item_summary']['inventory']) ?>)</button>
                                <button type="button" class="rc-cbz-tab" data-target="depot">Depot (<?= htmlspecialchars((string)$character['item_summary']['depot']) ?>)</button>
                                <button type="button" class="rc-cbz-tab" data-target="supply_stash">Supply Stash (<?= htmlspecialchars((string)$character['item_summary']['supply_stash']) ?>)</button>
                                <button type="button" class="rc-cbz-tab" data-target="inbox">Inbox (<?= htmlspecialchars((string)$character['item_summary']['inbox']) ?>)</button>
                                <button type="button" class="rc-cbz-tab" data-target="store_inbox">Store Inbox (<?= htmlspecialchars((string)$character['item_summary']['store_inbox']) ?>)</button>
                            </div>

                            <?php
                            $itemTabs = ['inventory', 'depot', 'supply_stash', 'inbox', 'store_inbox'];
                            foreach ($itemTabs as $tab):
                                $rows = $itemSummaryRows[$tab] ?? [];
                                $activeClass = $tab === 'inventory' ? ' is-active' : '';
                            ?>
                                <div class="rc-cbz-item-panel<?= $activeClass ?>" data-panel="<?= $tab ?>">
                                    <?php if (empty($rows)): ?>
                                        <div class="rc-cbz-empty">No items found in this category.</div>
                                    <?php else: ?>
                                        <div class="rc-cbz-items-grid">
                                            <?php foreach ($rows as $row): ?>
                                                <div class="rc-cbz-item-card">
                                                    <div class="rc-cbz-item-icon"><?= $row['image'] ?></div>
                                                    <div class="rc-cbz-item-meta">
                                                        <strong><?= htmlspecialchars((string)($row['name'] ?? ('Item #' . (int)$row['item_id']))) ?></strong>
                                                        <small>x<?= (int)$row['amount'] ?></small>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="rc-cbz-section">
                            <h3>Prey & Bosstiary</h3>
                            <div class="rc-cbz-grid-two">
                                <div><span>Permanent 3rd Prey Slots</span><strong><?= htmlspecialchars((string)$character['prey_permanent']) ?></strong></div>
                                <div><span>Prey wildcards</span><strong><?= htmlspecialchars((string)$character['prey_wildcards']) ?></strong></div>
                                <div class="rc-cbz-inline-action"><span>Bosstiary</span><strong><?= htmlspecialchars((string)$character['bosstiary']) ?> <a href="#" class="rc-bazaar-view-btn rc-cbz-modal-open rc-cbz-inline-btn" data-target="rc-cbz-modal-bosstiary">View</a></strong></div>
                                <div><span>Boss Points</span><strong><?= htmlspecialchars((string)$character['boss_points']) ?></strong></div>
                            </div>
                        </div>

                        <div class="rc-cbz-section">
                            <h3>Task Board</h3>
                            <div class="rc-cbz-grid-two">
                                <div><span>Task board entries</span><strong><?= htmlspecialchars((string)$character['task_board']) ?></strong></div>
                            </div>
                        </div>

                        <div class="rc-cbz-section">
                            <h3>Elemental Stones System</h3>
                            <div class="rc-cbz-grid-two">
                                <div><span>3rd Sloot</span><strong><?= htmlspecialchars((string)$character['third_stone_slot']) ?></strong></div>
                                <div class="rc-cbz-inline-action"><span>Stones</span><strong><?= (int)$character['stones_total'] ?> <a href="#" class="rc-bazaar-view-btn rc-cbz-modal-open rc-cbz-inline-btn" data-target="rc-cbz-modal-stones">View</a></strong></div>
                                <div><span>Stone Dust</span><strong><?= number_format((int)$character['stone_dust_total'], 0, ',', '.') ?></strong></div>
                                <div><span>RavynCore</span><strong><?= number_format((int)$character['ravyncore_total'], 0, ',', '.') ?></strong></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </td></tr></tbody></table>
    </div>
    <br>

    <form method="post" action="?subtopic=createcharacterauction&step=4">
        <input type="hidden" name="auction_character" value="<?= $selectCharacter; ?>">

        <div class="TableContainer rc-cbz-host rc-cbz-price-host">
            <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sale Information</div></div></div>
            <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
                <div class="InnerTableContainer">
                    <table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                        <tr>
                            <td style="vertical-align:middle; text-align:right;" class="LabelV150">Price:</td>
                            <td class="GreedyCell">
                                <input
                                    class="rc-cbz-price-input"
                                    name="auction_price"
                                    type="text"
                                    inputmode="numeric"
                                    pattern="[0-9]+"
                                    maxlength="10"
                                    autocomplete="off"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    required
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="LabelV150">Your Balance:</td>
                            <td><?= (int)$account['coins_transferable'] ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td>
                        </tr>
                        <tr>
                            <td class="LabelV150">Create Fee:</td>
                            <td><?= (int)$charbazaar_create ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td>
                        </tr>
                        <tr>
                            <td class="LabelV150">Tax on sale:</td>
                            <td><?= (int)$charbazaar_tax ?>%</td>
                        </tr>
                    </tbody></table>
                </div>
            </td></tr></tbody></table>
        </div>
        <br>

        <table class="InnerTableButtonRow" cellspacing="0" cellpadding="0"><tbody><tr>
            <td><div style="float:right;"><a href="?subtopic=createcharacterauction&step=1"><div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_over.gif); visibility: hidden;"></div><input class="BigButtonText" type="button" value="Back"></div></div></a></div></td>
            <td><div style="float:left;"><div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)"><div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div><input name="auction_submit" class="BigButtonText" type="submit" value="Next"></div></div></div></td>
        </tr></tbody></table>
    </form>

    <div id="rc-cbz-modal-addons" class="rc-cbz-modal" aria-hidden="true">
        <div class="rc-cbz-modal-card">
            <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-modal-addons">&times;</button>
            <h4>Full Addons</h4>
            <div class="rc-cbz-modal-grid">
                <?php if (!$addonsList): ?>
                    <p class="rc-cbz-empty">No complete addons found.</p>
                <?php else: foreach ($addonsList as $addon): ?>
                    <article class="rc-cbz-collect-card">
                        <div class="rc-cbz-collect-image"><img src="<?= htmlspecialchars($addon['image']) ?>" alt="<?= htmlspecialchars($addon['name']) ?>"></div>
                        <strong><?= htmlspecialchars($addon['name']) ?></strong>
                        <small>Outfit #<?= (int)$addon['id'] ?></small>
                    </article>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

    <div id="rc-cbz-modal-mounts" class="rc-cbz-modal" aria-hidden="true">
        <div class="rc-cbz-modal-card">
            <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-modal-mounts">&times;</button>
            <h4>Full Mounts</h4>
            <div class="rc-cbz-modal-grid">
                <?php if (!$mountsList): ?>
                    <p class="rc-cbz-empty">No mounts found.</p>
                <?php else: foreach ($mountsList as $mount): ?>
                    <article class="rc-cbz-collect-card">
                        <div class="rc-cbz-collect-image"><img src="<?= htmlspecialchars($mount['image']) ?>" alt="<?= htmlspecialchars($mount['name']) ?>"></div>
                        <strong><?= htmlspecialchars($mount['name']) ?></strong>
                        <small>Mount #<?= (int)$mount['id'] ?></small>
                    </article>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

    <div id="rc-cbz-modal-bestiary" class="rc-cbz-modal" aria-hidden="true">
        <div class="rc-cbz-modal-card">
            <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-modal-bestiary">&times;</button>
            <h4>Bestiary</h4>
            <div class="rc-cbz-modal-grid">
                <?php if (!$bestiaryList): ?>
                    <p class="rc-cbz-empty">No bestiary entries found.</p>
                <?php else: foreach ($bestiaryList as $entry): ?>
                    <article class="rc-cbz-collect-card">
                        <strong><?= htmlspecialchars((string)$entry['name']) ?></strong>
                        <small>ID #<?= (int)$entry['id'] ?><?php if ((int)$entry['progress'] > 0): ?> - <?= (int)$entry['progress'] ?><?php endif; ?></small>
                    </article>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

    <div id="rc-cbz-modal-bosstiary" class="rc-cbz-modal" aria-hidden="true">
        <div class="rc-cbz-modal-card">
            <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-modal-bosstiary">&times;</button>
            <h4>Bosstiary</h4>
            <div class="rc-cbz-modal-grid">
                <?php if (!$bosstiaryList): ?>
                    <p class="rc-cbz-empty">No bosstiary entries found.</p>
                <?php else: foreach ($bosstiaryList as $entry): ?>
                    <article class="rc-cbz-collect-card">
                        <strong><?= htmlspecialchars((string)$entry['name']) ?></strong>
                        <small>ID #<?= (int)$entry['id'] ?><?php if ((int)$entry['progress'] > 0): ?> - <?= (int)$entry['progress'] ?><?php endif; ?></small>
                    </article>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

    <div id="rc-cbz-modal-stones" class="rc-cbz-modal" aria-hidden="true">
        <div class="rc-cbz-modal-card">
            <button type="button" class="rc-cbz-modal-close" data-close="rc-cbz-modal-stones">&times;</button>
            <h4>Elemental Stones</h4>
            <div class="rc-cbz-modal-grid">
                <?php if (!$stonesRows): ?>
                    <p class="rc-cbz-empty">No stones found in depot, inbox or store inbox.</p>
                <?php else: foreach ($stonesRows as $row): ?>
                    <article class="rc-cbz-collect-card">
                        <div class="rc-cbz-collect-image"><?= $row['image'] ?></div>
                        <strong><?= htmlspecialchars((string)($row['name'] ?? ('Item #' . (int)$row['item_id']))) ?></strong>
                        <small>x<?= (int)$row['amount'] ?></small>
                    </article>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

    <script>
        (function() {
            document.querySelectorAll('.rc-cbz-tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var root = tab.closest('.rc-cbz-section');
                    if (!root) return;
                    root.querySelectorAll('.rc-cbz-tab').forEach(function(t){ t.classList.remove('is-active'); });
                    root.querySelectorAll('.rc-cbz-item-panel').forEach(function(p){ p.classList.remove('is-active'); });
                    tab.classList.add('is-active');
                    var panel = root.querySelector('.rc-cbz-item-panel[data-panel="' + tab.getAttribute('data-target') + '"]');
                    if (panel) panel.classList.add('is-active');
                });
            });

            document.querySelectorAll('.rc-cbz-modal-open').forEach(function(btn) {
                btn.addEventListener('click', function(ev) {
                    ev.preventDefault();
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
    <?php
} else {
    header('Location: ' . BASE_URL . '?subtopic=createcharacterauction&step=1');
    exit;
}
?>


