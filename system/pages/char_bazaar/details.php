<?php

global $config, $db, $template_path;
require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

$saleId = (int)($getPageDetails ?? 0);
$cbzBackSubtopic = isset($cbzBackSubtopic) ? (string)$cbzBackSubtopic : 'currentcharactertrades';
$saleStmt = $db->query("SELECT * FROM `myaac_charbazaar` WHERE `id` = {$saleId}");
$sale = $saleStmt->fetch();
if (!$sale) {
    echo 'We can not find sale with this id!';
    return;
}

$character = cbz_get_character_sale_data($db, $config, (int)$sale['player_id']);
if (!$character) {
    echo 'Character not found.';
    return;
}

$statusLabel = cbz_sale_status_label($sale['status']);
$createdAt = !empty($sale['date_start']) ? date('d M Y, H:i:s', strtotime($sale['date_start'])) : '-';
$soldAt = ((int)$sale['status'] === 1 && !empty($sale['date_end'])) ? date('d M Y, H:i:s', strtotime($sale['date_end'])) : '-';
$deathRows = [];
if (cbz_has_table($db, 'player_deaths')) {
    $deathPlayerCol = cbz_find_first_column($db, 'player_deaths', ['player_id', 'playerid']);
    $deathDateCol = cbz_find_first_column($db, 'player_deaths', ['date', 'time']);
    $deathLevelCol = cbz_find_first_column($db, 'player_deaths', ['level']);
    if ($deathPlayerCol && $deathDateCol && $deathLevelCol) {
        try {
            $deaths = $db->query(
                "SELECT `{$deathDateCol}` AS `death_date`, `{$deathLevelCol}` AS `death_level` " .
                "FROM `player_deaths` WHERE `{$deathPlayerCol}` = " . (int)$sale['player_id'] . " " .
                "ORDER BY `{$deathDateCol}` DESC LIMIT 10"
            );
            if ($deaths) {
                $deathRows = $deaths->fetchAll();
            }
        } catch (Exception $e) {
            $deathRows = [];
        }
    }
}

$equipped = $character['equipped_inventory'] ?? [];
$addonsList = $character['full_addons_list'] ?? [];
$mountsList = $character['full_mounts_list'] ?? [];
$itemSummaryRows = $character['item_summary_rows'] ?? [];
?>

<div class="TableContainer rc-cbz-host">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sale Details</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer">
            <div class="rc-cbz-layout">
                <aside class="rc-cbz-profile">
                    <div class="rc-cbz-outfit">
                        <img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>" alt="Character outfit">
                        <h4><?= htmlspecialchars($character['name']) ?></h4>
                        <p>Level <?= (int)$character['level'] ?> | <?= htmlspecialchars($character['vocation']) ?></p>
                        <p><?= htmlspecialchars($character['sex']) ?> | <?= htmlspecialchars($character['world']) ?></p>
                        <p class="rc-cbz-price">Price: <?= number_format((int)$sale['price'], 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></p>
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
                            <div><span>Achievement Points</span><strong><?= isset($character['player']['achievement_points']) ? (int)$character['player']['achievement_points'] : 0 ?></strong></div>
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
                            <div><span>Bestiary Points</span><strong><?= htmlspecialchars((string)$character['bestiary_points']) ?></strong></div>
                            <div><span>Charm Points</span><strong><?= htmlspecialchars((string)$character['charm_points']) ?></strong></div>
                            <div><span>Major Charms unlocked</span><strong><?= htmlspecialchars((string)$character['major_charms']) ?></strong></div>
                            <div><span>Minor Charms unlocked</span><strong><?= htmlspecialchars((string)$character['minor_charms']) ?></strong></div>
                        </div>
                    </div>

                    <div class="rc-cbz-section">
                        <h3>Items Summary</h3>
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
                                                    <strong>Item #<?= (int)$row['item_id'] ?></strong>
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
                            <div><span>Permanent prey slots</span><strong><?= htmlspecialchars((string)$character['prey_permanent']) ?></strong></div>
                            <div><span>Prey wildcards</span><strong><?= htmlspecialchars((string)$character['prey_wildcards']) ?></strong></div>
                            <div><span>Bosstiary</span><strong><?= htmlspecialchars((string)$character['bosstiary']) ?></strong></div>
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
                        <h3>Sale Information</h3>
                        <div class="rc-cbz-grid-two">
                            <div><span>Status</span><strong><?= htmlspecialchars($statusLabel) ?></strong></div>
                            <div><span>Created at</span><strong><?= htmlspecialchars($createdAt) ?></strong></div>
                            <div><span>Sold at</span><strong><?= htmlspecialchars($soldAt) ?></strong></div>
                            <div><span>Fixed Price</span><strong><?= number_format((int)$sale['price'], 0, ',', ',') ?></strong></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer rc-cbz-host">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Death List</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer">
            <table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php if (!$deathRows): ?>
                <tr><td>No deaths</td></tr>
            <?php else: ?>
                <tr class="Odd"><td class="LabelV">Date</td><td class="LabelV">Description</td></tr>
                <?php $i = 0; foreach ($deathRows as $death): $i++; ?>
                    <tr class="<?= ($i % 2 === 0) ? 'Even' : 'Odd' ?>">
                        <td><?= date('d M Y, H:i', (int)$death['death_date']) ?></td>
                        <td>Died at level <?= (int)$death['death_level'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody></table>
        </div>
    </td></tr></tbody></table>
</div>

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

<script>
    (function() {
        if (document && document.body) {
            document.body.classList.add('rc-page-currentcharactertrades');
        }
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

        var escapeHtml = function(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        };

        document.querySelectorAll('.rc-cbz-section').forEach(function(section) {
            var titleNode = section.querySelector('h3');
            if (!titleNode) {
                return;
            }

            var sectionTitle = (titleNode.textContent || '').trim();
            if (/items summary/i.test(sectionTitle)) {
                return; // requested: no tooltip in items summary / inventory section
            }

            section.querySelectorAll('.rc-cbz-grid-two > div, .rc-cbz-skills-grid > div').forEach(function(row) {
                row.classList.add('rc-cbz-helper-target');
                row.addEventListener('mouseenter', function() {
                    if (typeof ActivateHelperDiv !== 'function' || typeof window.jQuery !== 'function') {
                        return;
                    }

                    var labelNode = row.querySelector('span');
                    var valueNode = row.querySelector('strong');
                    var label = (labelNode ? labelNode.textContent : sectionTitle) || sectionTitle;
                    var value = (valueNode ? valueNode.textContent : '') || '-';
                    var helperHtml = '<b>' + escapeHtml(label.trim()) + ':</b> ' + escapeHtml(value.trim());
                    ActivateHelperDiv(window.jQuery(row), escapeHtml(sectionTitle), helperHtml, '');
                });

                row.addEventListener('mouseleave', function() {
                    if (typeof window.jQuery === 'function') {
                        window.jQuery('#HelperDivContainer').hide();
                    }
                });
            });
        });
    })();
</script>

<br>
<div class="rc-cbz-back-wrap">
    <a href="?subtopic=<?= urlencode($cbzBackSubtopic) ?>" class="rc-cbz-back-btn">Back to Char Bazaar</a>
</div>


