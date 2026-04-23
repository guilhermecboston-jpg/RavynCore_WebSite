<?php
defined('MYAAC') or die('Direct access not allowed!');
?>
<div class="rank">
	<div class="rank_header">Top Players</div>
	<div class="rank_content">
		<?php
		$topPlayers = getTopPlayers(5);
		foreach ($topPlayers as $player) {
			$outfit_url = '';
			if ($config['online_outfit']) {
				$outfit_url = $config['outfit_images_url'] . '?id=' . $player['looktype']
					. (!empty($player['lookaddons']) ? '&addons=' . $player['lookaddons'] : '')
					. '&head=' . $player['lookhead']
					. '&body=' . $player['lookbody']
					. '&legs=' . $player['looklegs']
					. '&feet=' . $player['lookfeet'];
				$player['outfit'] = $outfit_url;
			}
			$player_voc = $config['vocations'][$player['vocation']];
		?>
		<div class="rank_player">
			<?php if (!empty($player['outfit'])): ?>
				<img src="<?php echo $player['outfit']; ?>" alt="" style="width:32px;height:32px;margin-right:8px;">
			<?php endif; ?>
			<div class="rank_text">
				<a href="<?php echo getPlayerLink($player['name'], false); ?>"><b><?php echo $player['name']; ?></b></a><br>
				<small>Level <?php echo $player['level']; ?> - <?php echo $player_voc; ?></small>
			</div>
		</div>
		<?php } ?>
		<a href="<?php echo BASE_URL; ?>?highscores"><button type="button" class="rank_button">View Ranking</button></a>
	</div>
</div>
