<?php

if (isset($_POST['auction_submit']) && isset($_POST['auction_character'])) {
    require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

    $selectCharacter = (int)$_POST['auction_character'];
    $accountId = (int)$account_logged->getId();
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

    $account = $db->query('SELECT `coins`, `coins_transferable` FROM `accounts` WHERE `id` = ' . $accountId)->fetch();
    ?>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Setup Sale (3/4)</div></div></div>
        <table class="Table5" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer">
                <table style="width:100%;"><tbody><tr><td>
                    <div class="TableContentContainer">
                        <table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                            <tr>
                                <td style="width:180px;text-align:center;">
                                    <img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>">
                                </td>
                                <td>
                                    <div class="AuctionCharacterName"><?= htmlspecialchars($character['name']) ?></div>
                                    Level: <?= (int)$character['level'] ?> | Vocation: <?= htmlspecialchars($character['vocation']) ?> | <?= htmlspecialchars($character['sex']) ?>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                </td></tr></tbody></table>
            </div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Character Overview</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Addons count</td><td><?= (int)$character['addons_count'] ?></td><td><a href="#addons-preview">View</a></td></tr>
                <tr><td class="LabelV">Mounts count</td><td><?= (int)$character['mounts_count'] ?></td><td><a href="#mounts-preview">View</a></td></tr>
                <tr><td class="LabelV">Loyalty Title</td><td colspan="2"><?= htmlspecialchars((string)$character['loyalty_title']) ?></td></tr>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Skills</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Magic Level</td><td><?= (int)$character['player']['maglevel'] ?></td></tr>
                <tr><td class="LabelV">Defence Stats</td><td><?= (int)$character['defence_stats'] ?></td></tr>
                <tr><td class="LabelV">Offence Stats</td><td><?= (int)$character['offence_stats'] ?></td></tr>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Charms & Bestiary</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Bestiary Points</td><td><?= htmlspecialchars((string)$character['bestiary_points']) ?></td></tr>
                <tr><td class="LabelV">Charm Points</td><td><?= htmlspecialchars((string)$character['charm_points']) ?></td></tr>
                <tr><td class="LabelV">Major Charms unlocked</td><td><?= htmlspecialchars((string)$character['major_charms']) ?></td></tr>
                <tr><td class="LabelV">Minor Charms unlocked</td><td><?= htmlspecialchars((string)$character['minor_charms']) ?></td></tr>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Items Summary</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Inventory</td><td><?= htmlspecialchars((string)$character['item_summary']['inventory']) ?></td></tr>
                <tr><td class="LabelV">Depot</td><td><?= htmlspecialchars((string)$character['item_summary']['depot']) ?></td></tr>
                <tr><td class="LabelV">Supply Stash</td><td><?= htmlspecialchars((string)$character['item_summary']['supply_stash']) ?></td></tr>
                <tr><td class="LabelV">Inbox</td><td><?= htmlspecialchars((string)$character['item_summary']['inbox']) ?></td></tr>
                <tr><td class="LabelV">Store Inbox</td><td><?= htmlspecialchars((string)$character['item_summary']['store_inbox']) ?></td></tr>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Prey & Bosstiary</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Permanent prey slots</td><td><?= htmlspecialchars((string)$character['prey_permanent']) ?></td></tr>
                <tr><td class="LabelV">Prey wildcards</td><td><?= htmlspecialchars((string)$character['prey_wildcards']) ?></td></tr>
                <tr><td class="LabelV">Bosstiary</td><td><?= htmlspecialchars((string)$character['bosstiary']) ?></td></tr>
                <tr><td class="LabelV">Boss Points</td><td><?= htmlspecialchars((string)$character['boss_points']) ?></td></tr>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Task Board</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Task Board</td><td><?= htmlspecialchars((string)$character['task_board']) ?></td></tr>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <form method="post" action="?subtopic=createcharacterauction&step=4">
        <input type="hidden" name="auction_character" value="<?= $selectCharacter; ?>">

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sale Information</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr>
                    <td style="vertical-align:middle; text-align: right;" class="LabelV150">Price:</td>
                    <td class="GreedyCell"><input style="width: 100%;" name="auction_price" type="number" placeholder="Fixed price in Tibia Coins" min="1" step="1" required></td>
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
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <?php
    $outfits = [];
    if (cbz_has_table($db, 'player_outfits')) {
        $stmt = $db->query('SELECT `outfit_id`, `addons` FROM `player_outfits` WHERE `player_id` = ' . $selectCharacter . ' AND `addons` > 0 ORDER BY `outfit_id` ASC');
        $outfits = $stmt ? $stmt->fetchAll() : [];
    }
    $mounts = [];
    if (cbz_has_table($db, 'player_mounts')) {
        $stmt = $db->query('SELECT `mount_id` FROM `player_mounts` WHERE `player_id` = ' . $selectCharacter . ' ORDER BY `mount_id` ASC');
        $mounts = $stmt ? $stmt->fetchAll() : [];
    }
    ?>

    <div class="TableContainer" id="addons-preview">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Addons Preview</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <?php if (!$outfits): ?>
                    <tr><td>No complete addons found.</td></tr>
                <?php else: ?>
                    <tr class="Odd"><td class="LabelV">Outfit ID</td><td class="LabelV">Addons</td></tr>
                    <?php $i = 0; foreach ($outfits as $outfit): $i++; ?>
                        <tr bgcolor="<?= getStyle($i) ?>">
                            <td><?= (int)$outfit['outfit_id'] ?></td>
                            <td><?= (int)$outfit['addons'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer" id="mounts-preview">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Mounts Preview</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <?php if (!$mounts): ?>
                    <tr><td>No mounts found.</td></tr>
                <?php else: ?>
                    <tr class="Odd"><td class="LabelV">Mount ID</td></tr>
                    <?php $i = 0; foreach ($mounts as $mount): $i++; ?>
                        <tr bgcolor="<?= getStyle($i) ?>">
                            <td><?= (int)$mount['mount_id'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody></table></div>
        </td></tr></tbody></table>
    </div>
    <br>

        <table class="InnerTableButtonRow" cellspacing="0" cellpadding="0"><tbody><tr>
            <td><div style="float: right;"><a href="?subtopic=createcharacterauction&step=1"><div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_over.gif); visibility: hidden;"></div><input class="BigButtonText" type="button" value="Back"></div></div></a></div></td>
            <td><div style="float: left;"><div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)"><div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div><input name="auction_submit" class="BigButtonText" type="submit" value="Next"></div></div></div></td>
        </tr></tbody></table>
    </form>

    <?php
}
?>
