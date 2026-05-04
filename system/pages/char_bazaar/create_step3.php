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
    $titlesCount = '-';
    if (cbz_has_table($db, 'player_titles')) {
        $titlesCount = (int)($db->query('SELECT COUNT(*) FROM `player_titles` WHERE `player_id` = ' . $selectCharacter)->fetchColumn() ?? 0);
    }
    ?>

    <style>
        .rc-bazaar-view-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            min-width:64px;
            height:32px;
            padding:0 14px;
            border-radius:10px;
            border:1px solid rgba(136,159,214,.65);
            background:linear-gradient(180deg,#2b3858,#1c2743);
            color:#e6ecff;
            text-decoration:none;
            font-weight:700;
            font-size:12px;
            letter-spacing:.5px;
        }
        .rc-bazaar-view-btn:hover{
            border-color:rgba(236,188,92,.8);
            color:#fff1c8;
        }
    </style>

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
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Character Snapshot</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer">
                <table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
                    <tbody>
                    <tr><td class="LabelV">Health</td><td><?= (int)$character['player']['health'] ?> / <?= (int)$character['player']['healthmax'] ?></td></tr>
                    <tr><td class="LabelV">Mana</td><td><?= (int)$character['player']['mana'] ?> / <?= (int)$character['player']['manamax'] ?></td></tr>
                    <tr><td class="LabelV">Capacity</td><td><?= (int)$character['player']['cap'] ?></td></tr>
                    <tr><td class="LabelV">Soul</td><td><?= isset($character['player']['soul']) ? (int)$character['player']['soul'] : 0 ?></td></tr>
                    <tr><td class="LabelV">Blessings</td><td><?= (int)$character['blessings_count'] ?></td></tr>
                    <tr><td class="LabelV">Mounts</td><td><?= (int)$character['mounts_count'] ?></td></tr>
                    <tr><td class="LabelV">Outfits</td><td><?= (int)$character['addons_count'] ?></td></tr>
                    <tr><td class="LabelV">Titles</td><td><?= htmlspecialchars((string)$titlesCount) ?></td></tr>
                    <tr><td class="LabelV">Axe Fighting</td><td><?= (int)$character['player']['skill_axe'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Club Fighting</td><td><?= (int)$character['player']['skill_club'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Distance Fighting</td><td><?= (int)$character['player']['skill_dist'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Fishing</td><td><?= (int)$character['player']['skill_fishing'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Fist Fighting</td><td><?= (int)$character['player']['skill_fist'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Magic Level</td><td><?= (int)$character['player']['maglevel'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Shielding</td><td><?= (int)$character['player']['skill_shielding'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Sword Fighting</td><td><?= (int)$character['player']['skill_sword'] ?> (0%)</td></tr>
                    <tr><td class="LabelV">Creation Date</td><td><?= htmlspecialchars((string)$character['creation_date']) ?></td></tr>
                    <tr><td class="LabelV">Experience</td><td><?= number_format((int)$character['player']['experience'], 0, ',', '.') ?></td></tr>
                    <tr><td class="LabelV">Gold</td><td><?= number_format((int)$character['player']['balance'], 0, ',', '.') ?></td></tr>
                    <tr><td class="LabelV">Achievement Points</td><td><?= isset($character['player']['achievement_points']) ? (int)$character['player']['achievement_points'] : 0 ?></td></tr>
                    <tr><td class="LabelV">Charm Expansion</td><td><?= htmlspecialchars((string)$character['charm_expansion']) ?></td></tr>
                    <tr><td class="LabelV">Available Charm Points</td><td><?= htmlspecialchars((string)$character['charm_points']) ?></td></tr>
                    <tr><td class="LabelV">Spent Charm Points</td><td><?= htmlspecialchars((string)$character['spent_charm_points']) ?></td></tr>
                    </tbody>
                </table>
            </div>
        </td></tr></tbody></table>
    </div>
    <br>

    <div class="TableContainer">
        <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Character Overview</div></div></div>
        <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
            <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
                <tr><td class="LabelV">Full Addons</td><td><?= (int)$character['full_addons_count'] ?></td><td><a class="rc-bazaar-view-btn" href="#addons-preview">VIEW</a></td></tr>
                <tr><td class="LabelV">Full Mounts</td><td><?= (int)$character['mounts_count'] ?></td><td><a class="rc-bazaar-view-btn" href="#mounts-preview">VIEW</a></td></tr>
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
