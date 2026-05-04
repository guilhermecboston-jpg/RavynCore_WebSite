<?php

global $config, $db, $template_path;
require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

$saleId = (int)($getPageDetails ?? 0);
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

$player = $character['player'];
$statusLabel = cbz_sale_status_label($sale['status']);
$createdAt = !empty($sale['date_start']) ? date('d M Y, H:i:s', strtotime($sale['date_start'])) : '-';
$soldAt = ((int)$sale['status'] === 1 && !empty($sale['date_end'])) ? date('d M Y, H:i:s', strtotime($sale['date_end'])) : '-';

$deathRows = [];
if (cbz_has_table($db, 'player_deaths')) {
    $deaths = $db->query("SELECT `date`, `level` FROM `player_deaths` WHERE `player_id` = " . (int)$sale['player_id'] . " ORDER BY `date` DESC LIMIT 10");
    if ($deaths) {
        $deathRows = $deaths->fetchAll();
    }
}

$outfits = [];
if (cbz_has_table($db, 'player_outfits')) {
    $outfitsStmt = $db->query("SELECT `outfit_id`, `addons` FROM `player_outfits` WHERE `player_id` = " . (int)$sale['player_id'] . " ORDER BY `outfit_id` ASC");
    if ($outfitsStmt) {
        $outfits = $outfitsStmt->fetchAll();
    }
}

$mounts = [];
if (cbz_has_table($db, 'player_mounts')) {
    $mountsStmt = $db->query("SELECT `mount_id` FROM `player_mounts` WHERE `player_id` = " . (int)$sale['player_id'] . " ORDER BY `mount_id` ASC");
    if ($mountsStmt) {
        $mounts = $mountsStmt->fetchAll();
    }
}

function cbz_row($label, $value)
{
    echo '<tr><td class="LabelV" style="width:230px;">' . htmlspecialchars($label) . '</td><td>' . $value . '</td></tr>';
}
?>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Character Sale Details</div></div></div>
    <table class="Table5" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer">
            <table style="width:100%;"><tbody><tr><td>
                <div class="TableContentContainer">
                    <table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
                        <tbody>
                        <tr>
                            <td style="width:180px;text-align:center;">
                                <img class="AuctionOutfitImage" src="<?= $character['outfit_url'] ?>" alt="outfit">
                            </td>
                            <td>
                                <div class="AuctionCharacterName"><?= htmlspecialchars($character['name']) ?></div>
                                Level: <?= (int)$character['level'] ?> | Vocation: <?= htmlspecialchars($character['vocation']) ?> | <?= htmlspecialchars($character['sex']) ?> | World: <?= htmlspecialchars($character['world']) ?>
                                <br>
                                <b>Fixed Price:</b> <?= number_format((int)$sale['price'], 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png">
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
            <?php cbz_row('Name', htmlspecialchars($character['name'])); ?>
            <?php cbz_row('Vocation', htmlspecialchars($character['vocation'])); ?>
            <?php cbz_row('Level', (int)$character['level']); ?>
            <?php cbz_row('Loyalty Title', htmlspecialchars((string)$character['loyalty_title'])); ?>
            <?php cbz_row('Defence Stats', (int)$character['defence_stats']); ?>
            <?php cbz_row('Offence Stats', (int)$character['offence_stats']); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Skills</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php cbz_row('Magic Level', (int)$player['maglevel']); ?>
            <?php cbz_row('Sword / Axe / Club', (int)$player['skill_sword'] . ' / ' . (int)$player['skill_axe'] . ' / ' . (int)$player['skill_club']); ?>
            <?php cbz_row('Distance / Shielding / Fist', (int)$player['skill_dist'] . ' / ' . (int)$player['skill_shielding'] . ' / ' . (int)$player['skill_fist']); ?>
            <?php cbz_row('Fishing', (int)$player['skill_fishing']); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Charms & Bestiary</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php cbz_row('Bestiary Points', htmlspecialchars((string)$character['bestiary_points'])); ?>
            <?php cbz_row('Charm Points', htmlspecialchars((string)$character['charm_points'])); ?>
            <?php cbz_row('Major Charms unlocked', htmlspecialchars((string)$character['major_charms'])); ?>
            <?php cbz_row('Minor Charms unlocked', htmlspecialchars((string)$character['minor_charms'])); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Items Summary</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php cbz_row('Inventory', htmlspecialchars((string)$character['item_summary']['inventory'])); ?>
            <?php cbz_row('Depot', htmlspecialchars((string)$character['item_summary']['depot'])); ?>
            <?php cbz_row('Supply Stash', htmlspecialchars((string)$character['item_summary']['supply_stash'])); ?>
            <?php cbz_row('Inbox', htmlspecialchars((string)$character['item_summary']['inbox'])); ?>
            <?php cbz_row('Store Inbox', htmlspecialchars((string)$character['item_summary']['store_inbox'])); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Prey & Bosstiary</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php cbz_row('Permanent prey slots', htmlspecialchars((string)$character['prey_permanent'])); ?>
            <?php cbz_row('Prey wildcards', htmlspecialchars((string)$character['prey_wildcards'])); ?>
            <?php cbz_row('Bosstiary', htmlspecialchars((string)$character['bosstiary'])); ?>
            <?php cbz_row('Boss Points', htmlspecialchars((string)$character['boss_points'])); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Task Board</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php cbz_row('Task Board entries', htmlspecialchars((string)$character['task_board'])); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer" id="addons-view">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sale Information</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php cbz_row('Status', htmlspecialchars($statusLabel)); ?>
            <?php cbz_row('Created At', htmlspecialchars($createdAt)); ?>
            <?php cbz_row('Sold At', htmlspecialchars($soldAt)); ?>
            <?php cbz_row('Addons count', (int)$character['addons_count'] . ' <a href="#addons-list">View</a>'); ?>
            <?php cbz_row('Mounts count', (int)$character['mounts_count'] . ' <a href="#mounts-list">View</a>'); ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer" id="addons-list">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Addons</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php if (!$outfits): ?>
                <tr><td>No complete addons found.</td></tr>
            <?php else: ?>
                <tr class="Odd"><td class="LabelV">Outfit ID</td><td class="LabelV">Addons</td></tr>
                <?php $i = 0; foreach ($outfits as $outfit): $i++; ?>
                    <tr bgcolor="<?= getStyle($i) ?>"><td><?= (int)$outfit['outfit_id'] ?></td><td><?= (int)$outfit['addons'] ?></td></tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer" id="mounts-list">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Mounts</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php if (!$mounts): ?>
                <tr><td>No mounts found.</td></tr>
            <?php else: ?>
                <tr class="Odd"><td class="LabelV">Mount ID</td></tr>
                <?php $i = 0; foreach ($mounts as $mount): $i++; ?>
                    <tr bgcolor="<?= getStyle($i) ?>"><td><?= (int)$mount['mount_id'] ?></td></tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Death List</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer"><table class="TableContent" style="border:1px solid #faf0d7;" width="100%"><tbody>
            <?php if (!$deathRows): ?>
                <tr><td>No deaths</td></tr>
            <?php else: ?>
                <tr class="Odd"><td class="LabelV">Date</td><td class="LabelV">Description</td></tr>
                <?php $i = 0; foreach ($deathRows as $death): $i++; ?>
                    <tr bgcolor="<?= getStyle($i) ?>">
                        <td><?= date('d M Y, H:i', (int)$death['date']) ?></td>
                        <td>Died at level <?= (int)$death['level'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody></table></div>
    </td></tr></tbody></table>
</div>

<br>
<div class="TopButtonContainer">
    <div class="TopButton">
        <a href="?subtopic=currentcharactertrades"><img style="border:0;" src="<?= $template_path; ?>/images/global/content/back-to-top.gif"></a>
    </div>
</div>
