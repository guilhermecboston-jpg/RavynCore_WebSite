<?php

$topPlayers = getTopPlayers(5);
foreach($topPlayers as &$player) {
	$player['outfit_html'] = '';
	if($config['online_outfit']) {
		$outfitUrl = getAssetImageById('outfit', (int)$player['looktype'], [
			'addons' => !empty($player['lookaddons']) ? (int)$player['lookaddons'] : 0,
			'head' => (int)$player['lookhead'],
			'body' => (int)$player['lookbody'],
			'legs' => (int)$player['looklegs'],
			'feet' => (int)$player['lookfeet'],
			'direction' => 3,
		]);
		$player['outfit_html'] = '<img class="rc-themebox-outfit" src="' . htmlspecialchars($outfitUrl, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($player['name'] . ' outfit', ENT_QUOTES, 'UTF-8') . '">';
	}
}

$twig->display('highscores.html.twig', array(
	'topPlayers' => $topPlayers
));

