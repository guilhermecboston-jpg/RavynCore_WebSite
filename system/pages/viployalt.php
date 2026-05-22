<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'VIP & Loyalt';

$benefits = [
    ['Wheel Cooldown', '30% lower cooldown on Gift of Life passive and Avatar spell. You can reset your points anywhere.'],
    ['Protected Imbuement', 'No imbuement will be consumed inside protection zones (including capacity).'],
    ['Familiar Optimization', 'Familiars will deal 30% more damage with their spells.'],
    ['EXP Bonus', 'Every monster defeated will grant a 10% experience bonus.'],
    ['Additional Critical', 'All characters on the account will have 3% more critical chance and 5% more critical damage.'],
    ['Exercise Speed', 'The speed and additional gain from all weapons exercises have been increased by 10%.'],
    ['Full Bless', 'When buying bless from the Inquisition NPC, the character will receive all 7 blessings.'],
    ['Health Regeneration', 'There is an additional regeneration of 10 health every 3 seconds.'],
    ['Mana Regeneration', 'There is an additional regeneration of 20 mana every 3 seconds.'],
    ['Login Priority', 'If the server has a queue, the player will have priority in the queue position.'],
    ['House Absence', 'Instead of 7 days offline, VIP players can stay offline for 10 days without losing their house.'],
    ['Proficiency Bonus', 'Receives an additional 10% experience on weapon proficiency.'],
];

$loyaltyTitles = [
    ['Scout of RavynCore', '360', '+1'],
    ['Sentinel of RavynCore', '720', '+2'],
    ['Steward of RavynCore', '1080', '+3'],
    ['Warden of RavynCore', '1440', '+4'],
    ['Squire of RavynCore', '1800', '+5'],
    ['Warrior of RavynCore', '2160', '+6'],
    ['Keeper of RavynCore', '2520', '+7'],
    ['Guardian of RavynCore', '2880', '+8'],
    ['Sage of RavynCore', '3240', '+9'],
    ['Supreme of RavynCore', '3600', '+10'],
    ['Legacy of RavynCore', '7200', '+20'],
];

$vocationBonuses = [
    ['Knights', 'axe, sword, club and shielding'],
    ['Paladins', 'distance and shielding'],
    ['Druids', 'magic level'],
    ['Sorcerers', 'magic level'],
    ['Monks', 'magic level and fist fighting'],
];

$vipMounts = [
    ['name' => 'VIP Mount 1', 'src' => getAssetImageById('mount', 232, ['base' => 128, 'direction' => 3])],
    ['name' => 'VIP Mount 2', 'src' => getAssetImageById('mount', 238, ['base' => 128, 'direction' => 3])],
    ['name' => 'VIP Mount 3', 'src' => getAssetImageById('mount', 239, ['base' => 128, 'direction' => 3])],
];
?>
<style>
body.rc-page-viployalt .rc-panel-content > h3 {
    display: none;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-page {
    max-width: 1260px;
    margin: 0 auto;
    display: grid;
    gap: 14px;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-section {
    border: 1px solid rgba(194, 157, 99, 0.7);
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(13, 21, 36, 0.92) 0%, rgba(9, 15, 27, 0.96) 100%);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05), 0 12px 26px rgba(0, 0, 0, 0.35);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-title {
    margin: 0;
    padding: 10px 14px;
    color: #f0c982;
    font-family: var(--rc-font-title), Verdana, Arial, Helvetica, sans-serif;
    font-size: 23px;
    font-weight: 800;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    background: linear-gradient(180deg, rgba(44, 79, 126, 0.96) 0%, rgba(32, 63, 103, 0.96) 100%);
    border-bottom: 1px solid rgba(194, 157, 99, 0.58);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-body {
    padding: 14px;
    display: grid;
    gap: 14px;
    background: rgba(15, 24, 40, 0.8);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid rgba(150, 172, 216, 0.32);
    background: rgba(15, 24, 40, 0.7);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-table th,
body.rc-page-viployalt .rc-rich-content .rc-vl-table td {
    border: 1px solid rgba(150, 172, 216, 0.22);
    padding: 8px 10px;
    text-align: left;
    vertical-align: middle;
    color: #dce8ff;
    font-size: 13px;
    line-height: 1.35;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-table thead th {
    color: #f0c982;
    font-weight: 700;
    background: rgba(18, 29, 47, 0.95);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-table td:first-child {
    width: 210px;
    color: #f0c982;
    font-weight: 700;
    background: rgba(19, 31, 51, 0.88);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-note {
    margin: 0;
    padding-left: 20px;
    display: grid;
    gap: 7px;
    color: #d8e5fc;
    font-size: 13px;
    line-height: 1.45;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-note strong {
    color: #f0c982;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-mount-title {
    margin: 4px 0 0;
    text-align: center;
    color: #c8d9f4;
    font-size: 13px;
    font-weight: 700;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-mount-grid {
    display: flex;
    justify-content: center;
    gap: 22px;
    flex-wrap: wrap;
    padding: 12px;
    border: 1px solid rgba(150, 172, 216, 0.26);
    border-radius: 8px;
    background: rgba(13, 22, 37, 0.75);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-mount-card {
    width: 82px;
    height: 82px;
    display: grid;
    place-items: center;
    border: 1px solid rgba(106, 144, 203, 0.4);
    border-radius: 9px;
    background: linear-gradient(180deg, rgba(15, 28, 45, 0.92) 0%, rgba(10, 18, 30, 0.92) 100%);
}

body.rc-page-viployalt .rc-rich-content .rc-vl-mount-card img {
    max-width: 70px;
    max-height: 70px;
    object-fit: contain;
    image-rendering: pixelated;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-footer-note {
    margin: 0;
    padding: 11px 12px;
    border: 1px solid rgba(150, 172, 216, 0.26);
    border-radius: 8px;
    background: rgba(18, 31, 51, 0.72);
    color: #d0def8;
    font-size: 13px;
    line-height: 1.45;
}

body.rc-page-viployalt .rc-rich-content .rc-vl-center {
    text-align: center !important;
}

@media (max-width: 900px) {
    body.rc-page-viployalt .rc-rich-content .rc-vl-table {
        display: block;
        overflow-x: auto;
    }

    body.rc-page-viployalt .rc-rich-content .rc-vl-title {
        font-size: 20px;
    }
}
</style>

<div class="rc-vl-page">
    <section class="rc-vl-section">
        <h2 class="rc-vl-title">VIP Account Benefits</h2>
        <div class="rc-vl-body">
            <table class="rc-vl-table">
                <thead>
                <tr>
                    <th>Benefit</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($benefits as $benefit) { ?>
                    <tr>
                        <td><?= htmlspecialchars($benefit[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($benefit[1], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <p class="rc-vl-mount-title">Mounts available for VIP</p>
            <div class="rc-vl-mount-grid">
                <?php foreach ($vipMounts as $mount) {
                    $mountSrc = trim((string)$mount['src']);
                    if ($mountSrc === '') {
                        $mountSrc = BASE_URL . 'templates/tibiacom/images/premiumfeatures/PremiumIcon-Mount.png';
                    }
                ?>
                    <div class="rc-vl-mount-card">
                        <img src="<?= htmlspecialchars($mountSrc, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($mount['name'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="rc-vl-section">
        <h2 class="rc-vl-title">Loyalty Information</h2>
        <div class="rc-vl-body">
            <ul class="rc-vl-note">
                <li>This bonus is linked to your <em>account</em>, therefore it is a <strong>non-transferable</strong> bonus.</li>
                <li>By purchasing the <strong>monthly</strong> VIP package in our store, your account will receive <strong>120 loyalty point</strong>.</li>
                <li>All characters on the account receive the skill bonus corresponding to the title.</li>
                <li>To check your loyalty level, just look at your <em>server log</em> when accessing any character in the game.</li>
            </ul>

            <table class="rc-vl-table">
                <thead>
                <tr>
                    <th>Title Name</th>
                    <th class="rc-vl-center">Required Points</th>
                    <th class="rc-vl-center">Skill Bonus</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($loyaltyTitles as $titleRow) { ?>
                    <tr>
                        <td><?= htmlspecialchars($titleRow[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-vl-center"><?= htmlspecialchars($titleRow[1], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="rc-vl-center"><strong><?= htmlspecialchars($titleRow[2], ENT_QUOTES, 'UTF-8') ?></strong></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <table class="rc-vl-table">
                <thead>
                <tr>
                    <th>Vocation</th>
                    <th>Affected Skills</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($vocationBonuses as $vocationBonus) { ?>
                    <tr>
                        <td><?= htmlspecialchars($vocationBonus[0], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($vocationBonus[1], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <p class="rc-vl-footer-note">
                The point for purchasing a <strong>30-day VIP</strong> in the store is automatically credited to your account, without
                needing the days to pass like on the global server. Additionally, we have a fixed and progressive bonus up to
                <strong>+20 skill</strong>. It is an eternal bonus for your account, which is why the cost is <em>progressive</em> -
                we do not want it to be easily accessible to players since many invest a lot of time in skill training.
            </p>
        </div>
    </section>
</div>
