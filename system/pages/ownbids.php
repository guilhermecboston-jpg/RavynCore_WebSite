<?php
/**
 * Char Bazaar - My Purchases
 * (kept under ownbids route for backward compatibility)
 */
defined('MYAAC') or die('Direct access not allowed!');
$title = 'My Purchases';

require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

if (!$logged) {
	echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p><b>Log in</b> to see characters you bought.</p></div></div></div><br>';
	return;
}

$rows = $db->query('SELECT * FROM `myaac_charbazaar` WHERE `status` = 1 AND `account_new` = ' . (int)$account_logged->getId() . ' ORDER BY `id` DESC')->fetchAll();
?>

<div class="TableContainer">
	<div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">My Purchases</div></div></div>
	<table class="Table3" cellpadding="0" cellspacing="0">
		<tbody><tr><td><div class="InnerTableContainer">
			<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
				<tbody>
				<tr class="Odd">
					<td class="LabelV">Character</td>
					<td class="LabelV">Price</td>
					<td class="LabelV">Purchased At</td>
					<td class="LabelV">Details</td>
				</tr>
				<?php if (!$rows): ?>
					<tr><td colspan="4" style="text-align:center;padding:14px;">You have not purchased any characters yet.</td></tr>
				<?php else: ?>
					<?php $i = 0; foreach ($rows as $sale): $i++; ?>
						<?php $char = $db->query('SELECT `name`, `level` FROM `players` WHERE `id` = ' . (int)$sale['player_id'])->fetch(); ?>
						<tr bgcolor="<?= getStyle($i) ?>">
							<td><?= htmlspecialchars(($char['name'] ?? 'Unknown') . ' (Lv ' . (int)($char['level'] ?? 0) . ')') ?></td>
							<td><?= number_format((int)$sale['price'], 0, ',', ',') ?></td>
							<td><?= !empty($sale['date_end']) ? date('d M Y, H:i', strtotime($sale['date_end'])) : '-' ?></td>
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
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		</div></td></tr></tbody>
	</table>
</div>

