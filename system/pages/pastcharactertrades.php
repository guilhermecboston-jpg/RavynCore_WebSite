<?php
/**
 * Character Sales History
 */
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Sales History';

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';
if ($logged) {
    require SYSTEM . 'pages/char_bazaar/coins_balance.php';
}

$getPageDetails = isset($_GET['details']) ? (int)$_GET['details'] : 0;
if ($getPageDetails > 0) {
    $cbzBackSubtopic = 'pastcharactertrades';
    require SYSTEM . 'pages/char_bazaar/details.php';
    return;
}

$sales = $db->query("SELECT * FROM `myaac_charbazaar` WHERE `status` IN (1,2) ORDER BY `id` DESC LIMIT 100");
?>

<div class="SmallBox">
    <div class="MessageContainer">
        <div class="Message">
            <p>Below you find character sales that were <b>sold</b> or <b>cancelled</b>.</p>
        </div>
    </div>
</div>
<br>

<div class="TableContainer">
    <div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Sales History</div></div></div>
    <table class="Table3" cellspacing="0" cellpadding="0"><tbody><tr><td>
        <div class="InnerTableContainer">
            <table class="TableContent" style="width:100%;border:1px solid #faf0d7;">
                <tbody>
                <tr class="Odd">
                    <td class="LabelV">Character</td>
                    <td class="LabelV">Price</td>
                    <td class="LabelV">Status</td>
                    <td class="LabelV">Updated</td>
                    <td class="LabelV">Details</td>
                </tr>
                <?php
                $rows = $sales->fetchAll();
                if (!$rows) {
                    echo '<tr><td colspan="5" style="text-align:center;padding:14px;">No historical sales found.</td></tr>';
                }
                $i = 0;
                foreach ($rows as $sale) {
                    $i++;
                    $char = $db->query("SELECT `name`,`level` FROM `players` WHERE `id` = " . (int)$sale['player_id'])->fetch();
                    ?>
                    <tr bgcolor="<?= getStyle($i) ?>">
                        <td><?= htmlspecialchars(($char['name'] ?? 'Unknown') . ' (Lv ' . (int)($char['level'] ?? 0) . ')') ?></td>
                        <td><?= number_format((int)$sale['price'], 0, ',', ',') ?> <img src="<?= $template_path; ?>/images/account/icon-tibiacointrusted.png"></td>
                        <td><?= htmlspecialchars(cbz_sale_status_label($sale['status'])) ?></td>
                        <td><?= date('d M Y, H:i', strtotime($sale['date_end'] ?: $sale['date_start'])) ?></td>
                        <td>
                            <a href="?subtopic=pastcharactertrades&details=<?= (int)$sale['id'] ?>">
                                <div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton.gif);display:inline-block;">
                                    <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                        <div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_over.gif); visibility: hidden;"></div>
                                        <input class="BigButtonText" type="button" value="View">
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </td></tr></tbody></table>
</div>
