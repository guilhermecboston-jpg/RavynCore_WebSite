<?php

if (isset($_POST['auction_submit']) && isset($_POST['auction_character'])) {
	require_once SYSTEM . 'pages/char_bazaar/sale_helpers.php';

	$selectedCharacter = (int)$_POST['auction_character'];
	$accountId = (int)$account_logged->getId();
	$character = $db->query('SELECT `id`, `account_id`, `name`, `level` FROM `players` WHERE `id` = ' . $db->quote($selectedCharacter))->fetch();

	if (!$character) {
		echo '<div class="SmallBox"><div class="MessageContainer"><div class="Message"><p style="color:#b32d2d;font-weight:bold;">Character not found.</p></div></div></div><br>';
		return;
	}

	$checks = [];
	$checks[] = [
		'valid' => ((int)$character['account_id'] === $accountId),
		'text' => 'You can only create sales for your own characters.'
	];

	$account = $db->query('SELECT `coins_transferable`, `key` FROM `accounts` WHERE `id` = ' . $db->quote($accountId))->fetch();
	$checks[] = [
		'valid' => ((int)$character['level'] >= 8),
		'text' => 'The character must be at least level 8.'
	];
	$checks[] = [
		'valid' => (!empty($account['key'])),
		'text' => 'Your account must be registered.'
	];
	$checks[] = [
		'valid' => ((int)($account['coins_transferable'] ?? 0) >= (int)$charbazaar_create),
		'text' => 'You need enough transferable Tibia Coins to create this sale.'
	];

	$alreadySale = $db->query('SELECT `id` FROM `myaac_charbazaar` WHERE `player_id` = ' . $db->quote($selectedCharacter) . ' AND `status` = 0 LIMIT 1')->fetch();
	$checks[] = [
		'valid' => (!$alreadySale),
		'text' => 'The character may not already be listed in Char Bazaar.'
	];

	$isOnline = cbz_has_table($db, 'players_online')
		? (int)($db->query('SELECT COUNT(*) FROM `players_online` WHERE `player_id` = ' . $db->quote($selectedCharacter))->fetchColumn())
		: 0;
	$checks[] = [
		'valid' => ($isOnline === 0),
		'text' => 'The character must be offline.'
	];

	$hasHouse = cbz_has_table($db, 'houses')
		? (int)($db->query('SELECT COUNT(*) FROM `houses` WHERE `owner` = ' . $db->quote($selectedCharacter))->fetchColumn())
		: 0;
	$checks[] = [
		'valid' => ($hasHouse === 0),
		'text' => 'The character may not own any house.'
	];

	$guildOwner = cbz_has_table($db, 'guilds')
		? (int)($db->query('SELECT COUNT(*) FROM `guilds` WHERE `ownerid` = ' . $db->quote($selectedCharacter))->fetchColumn())
		: 0;
	$guildMember = cbz_has_table($db, 'guild_membership')
		? (int)($db->query('SELECT COUNT(*) FROM `guild_membership` WHERE `player_id` = ' . $db->quote($selectedCharacter))->fetchColumn())
		: 0;
	$guildInvited = cbz_has_table($db, 'guild_invites')
		? (int)($db->query('SELECT COUNT(*) FROM `guild_invites` WHERE `player_id` = ' . $db->quote($selectedCharacter))->fetchColumn())
		: 0;
	$checks[] = [
		'valid' => ($guildOwner === 0 && $guildMember === 0 && $guildInvited === 0),
		'text' => 'The character may not be in a guild or have pending guild invites.'
	];

	$hasMarketOffer = cbz_has_table($db, 'market_offers')
		? (int)($db->query('SELECT COUNT(*) FROM `market_offers` WHERE `player_id` = ' . $db->quote($selectedCharacter))->fetchColumn())
		: 0;
	$checks[] = [
		'valid' => ($hasMarketOffer === 0),
		'text' => 'The character may not have running market offers.'
	];

	$allValid = true;
	foreach ($checks as $check) {
		if (!$check['valid']) {
			$allValid = false;
			break;
		}
	}
	?>
	<div id="ProgressBar">
		<div id="MainContainer">
			<div id="BackgroundContainer">
				<img id="BackgroundContainerLeftEnd" src="<?= $template_path; ?>/images/global/content/stonebar-left-end.gif">
				<div id="BackgroundContainerCenter">
					<div id="BackgroundContainerCenterImage" style="background-image:url(<?= $template_path; ?>/images/global/content/stonebar-center.gif);"></div>
				</div>
				<img id="BackgroundContainerRightEnd" src="<?= $template_path; ?>/images/global/content/stonebar-right-end.gif">
			</div>
			<img id="TubeLeftEnd" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-tube-left-green.gif">
			<img id="TubeRightEnd" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-tube-right-blue.gif">
			<div id="FirstStep" class="Steps">
				<div class="SingleStepContainer">
					<img class="StepIcon" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-1-green.gif">
					<div class="StepText" style="font-weight:normal;">Select character</div>
				</div>
			</div>
			<div id="StepsContainer1">
				<div id="StepsContainer2">
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-2-green.gif">
							<div class="StepText" style="font-weight:bold;">Check character</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-tube-green-blue.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-3-blue.gif">
							<div class="StepText" style="font-weight:normal;">Set character price</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-tube-blue.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="<?= $template_path; ?>/images/global/content/progressbar/progress-bar-icon-4-blue.gif">
							<div class="StepText" style="font-weight:normal;">Confirm sale</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<form method="post" action="?subtopic=createcharacterauction&step=3">
		<input type="hidden" name="auction_character" value="<?= $selectedCharacter ?>">
		<div class="TableContainer">
			<div class="CaptionContainer"><div class="CaptionInnerContainer"><div class="Text">Check Character (2/4)</div></div></div>
			<table class="Table3" cellspacing="0" cellpadding="0">
				<tbody><tr><td>
					<div class="InnerTableContainer">
						<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
							<tbody>
							<?php foreach ($checks as $check): ?>
								<tr>
									<td style="vertical-align: middle; width: 36px;"><?= $check['valid'] ? '<img src="' . $template_path . '/images/premiumfeatures/icon_yes.png">' : '<img src="' . $template_path . '/images/premiumfeatures/icon_no.png">' ?></td>
									<td><?= htmlspecialchars($check['text']) ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</td></tr></tbody>
			</table>
		</div>
		<br>
		<table class="InnerTableButtonRow" cellspacing="0" cellpadding="0">
			<tbody><tr>
				<td>
					<div style="float: right;">
						<a href="?subtopic=createcharacterauction&step=1">
							<div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton.gif)">
								<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
									<div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_over.gif); visibility: hidden;"></div>
									<input class="BigButtonText" type="button" value="Back">
								</div>
							</div>
						</a>
					</div>
				</td>
				<td>
					<div style="float: left;">
						<?php if ($allValid): ?>
							<div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_green.gif)">
								<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
									<div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_green_over.gif); visibility: hidden;"></div>
									<input name="auction_submit" class="BigButtonText" type="submit" value="Next">
								</div>
							</div>
						<?php else: ?>
							<div class="BigButton" style="background-image:url(<?= $template_path; ?>/images/global/buttons/sbutton_red.gif)">
								<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
									<div class="BigButtonOver" style="background-image: url(<?= $template_path; ?>/images/global/buttons/sbutton_red_over.gif); visibility: hidden;"></div>
									<input class="BigButtonText" type="button" value="Fix requirements">
								</div>
							</div>
						<?php endif; ?>
					</div>
				</td>
			</tr></tbody>
		</table>
	</form>
	<?php
}

