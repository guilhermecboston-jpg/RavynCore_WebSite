<?php

$topPlayers = getTopPlayers(5);
foreach($topPlayers as &$player) {
	$player['outfit_html'] = '';
	if($config['online_outfit']) {
		$player['outfit_html'] = getThingCanvasHtml('outfits', (int)$player['looktype'], [
			'addons' => !empty($player['lookaddons']) ? (int)$player['lookaddons'] : 0,
			'head' => (int)$player['lookhead'],
			'body' => (int)$player['lookbody'],
			'legs' => (int)$player['looklegs'],
			'feet' => (int)$player['lookfeet'],
			'width' => 64,
			'height' => 64,
			'class' => 'rc-themebox-outfit',
			'label' => $player['name'] . ' outfit',
		]);
	}
}

$twig->display('highscores.html.twig', array(
	'topPlayers' => $topPlayers
));
