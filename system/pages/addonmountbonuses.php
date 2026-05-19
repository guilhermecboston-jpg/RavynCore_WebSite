<?php
defined('MYAAC') or die('Direct access not allowed!');

$title = 'Addon&Mount Bonuses';
global $config;

if (!function_exists('rc_am_attr_string')) {
	function rc_am_attr_string($node, $attribute)
	{
		return isset($node[$attribute]) ? trim((string)$node[$attribute]) : '';
	}
}

if (!function_exists('rc_am_to_float')) {
	function rc_am_to_float($value)
	{
		return (float)str_replace(',', '.', trim((string)$value));
	}
}

if (!function_exists('rc_am_format_number')) {
	function rc_am_format_number($value)
	{
		$number = (float)$value;
		if (abs($number - round($number)) < 0.00001) {
			return (string)(int)round($number);
		}

		$formatted = number_format($number, 2, '.', '');
		return rtrim(rtrim($formatted, '0'), '.');
	}
}

if (!function_exists('rc_am_append_bonus')) {
	function rc_am_append_bonus(&$list, $label, $value, $suffix = '')
	{
		$number = rc_am_to_float($value);
		if (abs($number) < 0.00001) {
			return;
		}

		$sign = $number > 0 ? '+' : '';
		$list[] = $label . ': ' . $sign . rc_am_format_number($number) . $suffix;
	}
}

if (!function_exists('rc_am_collect_bonuses')) {
	function rc_am_collect_bonuses($entry)
	{
		$bonuses = [];

		$speed = rc_am_attr_string($entry, 'speed');
		$attackSpeed = rc_am_attr_string($entry, 'attackSpeed');
		$manaShield = strtolower(rc_am_attr_string($entry, 'manaShield'));
		$healthGain = rc_am_to_float(rc_am_attr_string($entry, 'healthGain'));
		$healthTicks = (int)rc_am_to_float(rc_am_attr_string($entry, 'healthTicks'));
		$manaGain = rc_am_to_float(rc_am_attr_string($entry, 'manaGain'));
		$manaTicks = (int)rc_am_to_float(rc_am_attr_string($entry, 'manaTicks'));

		rc_am_append_bonus($bonuses, 'Speed', $speed);
		rc_am_append_bonus($bonuses, 'Attack Speed', $attackSpeed);

		if (abs($healthGain) > 0.00001) {
			$line = 'HP Regen: +' . rc_am_format_number($healthGain);
			if ($healthTicks > 0) {
				$line .= ' / ' . $healthTicks . 's';
			}
			$bonuses[] = $line;
		}

		if (abs($manaGain) > 0.00001) {
			$line = 'MP Regen: +' . rc_am_format_number($manaGain);
			if ($manaTicks > 0) {
				$line .= ' / ' . $manaTicks . 's';
			}
			$bonuses[] = $line;
		}

		if ($manaShield === 'yes' || $manaShield === 'true' || $manaShield === '1') {
			$bonuses[] = 'Mana Shield: Ativo';
		}

		$skillLabels = [
			'fist' => 'Fist',
			'club' => 'Club',
			'axe' => 'Axe',
			'sword' => 'Sword',
			'distance' => 'Distance',
			'shielding' => 'Shielding',
			'fishing' => 'Fishing',
		];
		if (isset($entry->skills)) {
			foreach ($skillLabels as $nodeName => $label) {
				if (isset($entry->skills->{$nodeName})) {
					rc_am_append_bonus($bonuses, $label, rc_am_attr_string($entry->skills->{$nodeName}, 'value'));
				}
			}
		}

		$statsLabels = [
			'maxHealth' => 'Max HP',
			'maxMana' => 'Max MP',
			'cap' => 'Cap',
			'magicLevel' => 'Magic Level',
		];
		if (isset($entry->stats)) {
			foreach ($statsLabels as $nodeName => $label) {
				if (isset($entry->stats->{$nodeName})) {
					rc_am_append_bonus($bonuses, $label, rc_am_attr_string($entry->stats->{$nodeName}, 'value'));
				}
			}
		}

		$imbuingLabels = [
			'lifeleechchance' => 'Life Leech Chance',
			'lifeleechamount' => 'Life Leech Amount',
			'manaleechchance' => 'Mana Leech Chance',
			'manaleechamount' => 'Mana Leech Amount',
			'criticalchance' => 'Critical Chance',
			'criticaldamage' => 'Critical Damage',
		];
		if (isset($entry->imbuing)) {
			foreach ($imbuingLabels as $nodeName => $label) {
				if (isset($entry->imbuing->{$nodeName})) {
					rc_am_append_bonus($bonuses, $label, rc_am_attr_string($entry->imbuing->{$nodeName}, 'value'), '%');
				}
			}
		}

		$extraLabels = [
			'onslaught' => 'Onslaught',
			'momentum' => 'Momentum',
			'ruse' => 'Ruse',
			'transcendence' => 'Transcendence',
		];
		if (isset($entry->attributes)) {
			foreach ($extraLabels as $nodeName => $label) {
				if (isset($entry->attributes->{$nodeName})) {
					rc_am_append_bonus($bonuses, $label, rc_am_attr_string($entry->attributes->{$nodeName}, 'value'), '%');
				}
			}
		}

		if (empty($bonuses)) {
			$bonuses[] = 'Sem bonus adicional';
		}

		return $bonuses;
	}
}

if (!function_exists('rc_am_resolve_candidate_path')) {
	function rc_am_resolve_candidate_path($candidate)
	{
		$candidate = trim((string)$candidate);
		if ($candidate === '') {
			return '';
		}

		if (preg_match('/^[A-Za-z]:[\/\\\\]/', $candidate) || strpos($candidate, '/') === 0) {
			return $candidate;
		}

		return BASE . ltrim($candidate, '/\\');
	}
}

if (!function_exists('rc_am_find_xml_path')) {
	function rc_am_find_xml_path(array $candidates)
	{
		foreach ($candidates as $candidate) {
			$path = rc_am_resolve_candidate_path($candidate);
			if ($path !== '' && file_exists($path)) {
				return $path;
			}
		}

		return '';
	}
}

if (!function_exists('rc_am_normalize_renderer_url')) {
	function rc_am_normalize_renderer_url($url)
	{
		$url = trim((string)$url);
		if ($url === '') {
			return '';
		}

		if (preg_match('/^https?:\/\//i', $url)) {
			return $url;
		}

		return BASE_URL . ltrim($url, '/');
	}
}

if (!function_exists('rc_am_load_xml_from_path')) {
	function rc_am_load_xml_from_path($path, $kind = '')
	{
		$path = trim((string)$path);
		if ($path === '') {
			return null;
		}

		$raw = @file_get_contents($path);
		if ($raw === false) {
			return false;
		}

		$raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);

		if ($kind === 'outfits') {
			// outfits.xml can contain duplicated "type" attributes (gender + store type).
			// Rename store type to keep XML valid while preserving the data.
			$raw = preg_replace_callback('/<outfit\b([^>]*)>/i', function ($matches) {
				$attributes = $matches[1];
				$attributes = preg_replace('/\s+type="store"/i', ' storeType="store"', $attributes);
				return '<outfit' . $attributes . '>';
			}, $raw);
		}

		return simplexml_load_string($raw);
	}
}

if (!function_exists('rc_am_render_image_url')) {
	function rc_am_render_image_url($baseUrl, array $queryParams)
	{
		if ($baseUrl === '') {
			return '';
		}

		return $baseUrl . '?' . http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);
	}
}

if (!function_exists('rc_am_outfit_image_url')) {
	function rc_am_outfit_image_url($renderer, $lookType, $addons, array $colors, $mountId = 0)
	{
		if ((int)$lookType <= 0) {
			return '';
		}

		return rc_am_render_image_url($renderer, [
			'id' => (int)$lookType,
			'addons' => (int)$addons,
			'head' => (int)$colors['head'],
			'body' => (int)$colors['body'],
			'legs' => (int)$colors['legs'],
			'feet' => (int)$colors['feet'],
			'mount' => (int)$mountId,
			'direction' => 2,
		]);
	}
}

if (!function_exists('rc_am_bonus_html')) {
	function rc_am_bonus_html(array $bonusLines)
	{
		$html = '<ul class="rc-am-bonus-list">';
		foreach ($bonusLines as $line) {
			$html .= '<li>' . htmlspecialchars($line, ENT_QUOTES, 'UTF-8') . '</li>';
		}
		$html .= '</ul>';
		return $html;
	}
}

$outfitRenderer = rc_am_normalize_renderer_url($config['outfit_images_url'] ?? '');
$defaultColors = ['head' => 95, 'body' => 114, 'legs' => 39, 'feet' => 115];

$configuredOutfitsPath = $config['ravyncore']['outfits_xml_path'] ?? ($config['outfits_xml_path'] ?? '');
$configuredMountsPath = $config['ravyncore']['mounts_xml_path'] ?? ($config['mounts_xml_path'] ?? '');

$outfitsPath = rc_am_find_xml_path([
	$configuredOutfitsPath,
	'C:\\Users\\PICHAU\\Desktop\\DURVAL\\outfits.xml',
	'system/data/outfits.xml',
	'system/data/XML/outfits.xml',
	'outfits.xml',
]);
$mountsPath = rc_am_find_xml_path([
	$configuredMountsPath,
	'C:\\Users\\PICHAU\\Desktop\\DURVAL\\mounts.xml',
	'system/data/mounts.xml',
	'system/data/XML/mounts.xml',
	'mounts.xml',
]);

$warnings = [];
if ($outfitsPath === '') {
	$warnings[] = 'Arquivo outfits.xml nao encontrado.';
}
if ($mountsPath === '') {
	$warnings[] = 'Arquivo mounts.xml nao encontrado.';
}
if ($outfitRenderer === '') {
	$warnings[] = 'outfit_images_url nao configurado em config.php.';
}

libxml_use_internal_errors(true);

$outfitsXml = null;
if ($outfitsPath !== '') {
	$outfitsXml = rc_am_load_xml_from_path($outfitsPath, 'outfits');
	if ($outfitsXml === false) {
		$warnings[] = 'Nao foi possivel ler outfits.xml.';
	}
}

$mountsXml = null;
if ($mountsPath !== '') {
	$mountsXml = rc_am_load_xml_from_path($mountsPath, 'mounts');
	if ($mountsXml === false) {
		$warnings[] = 'Nao foi possivel ler mounts.xml.';
	}
}

$outfitsMap = [];
if ($outfitsXml !== null && isset($outfitsXml->outfit)) {
	foreach ($outfitsXml->outfit as $outfitNode) {
		$name = rc_am_attr_string($outfitNode, 'name');
		$lookType = (int)rc_am_to_float(rc_am_attr_string($outfitNode, 'looktype'));
		if ($name === '' || $lookType <= 0) {
			continue;
		}

		$typeRaw = strtolower(rc_am_attr_string($outfitNode, 'type'));
		$isFemale = ($typeRaw === '0' || $typeRaw === 'female');
		$key = strtolower($name);

		if (!isset($outfitsMap[$key])) {
			$outfitsMap[$key] = [
				'name' => $name,
				'femaleLookType' => 0,
				'maleLookType' => 0,
				'femaleBonus' => [],
				'maleBonus' => [],
			];
		}

		if ($isFemale) {
			$outfitsMap[$key]['femaleLookType'] = $lookType;
			$outfitsMap[$key]['femaleBonus'] = rc_am_collect_bonuses($outfitNode);
		} else {
			$outfitsMap[$key]['maleLookType'] = $lookType;
			$outfitsMap[$key]['maleBonus'] = rc_am_collect_bonuses($outfitNode);
		}
	}
}

$outfits = [];
foreach ($outfitsMap as $row) {
	$femaleBonus = $row['femaleBonus'];
	$maleBonus = $row['maleBonus'];

	if (!empty($femaleBonus) && !empty($maleBonus)) {
		$bonusLines = array_values(array_unique(array_merge($femaleBonus, $maleBonus)));
	} elseif (!empty($femaleBonus)) {
		$bonusLines = $femaleBonus;
	} else {
		$bonusLines = $maleBonus;
	}

	if (empty($bonusLines)) {
		$bonusLines = ['Sem bonus adicional'];
	}

	$outfits[] = [
		'name' => $row['name'],
		'femaleImage' => rc_am_outfit_image_url($outfitRenderer, $row['femaleLookType'], 3, $defaultColors, 0),
		'maleImage' => rc_am_outfit_image_url($outfitRenderer, $row['maleLookType'], 3, $defaultColors, 0),
		'bonus' => $bonusLines,
		'search' => strtolower($row['name'] . ' ' . implode(' ', $bonusLines)),
	];
}

usort($outfits, function ($a, $b) {
	return strnatcasecmp($a['name'], $b['name']);
});

$mounts = [];
if ($mountsXml !== null && isset($mountsXml->mount)) {
	foreach ($mountsXml->mount as $mountNode) {
		$mountId = (int)rc_am_to_float(rc_am_attr_string($mountNode, 'id'));
		$clientId = (int)rc_am_to_float(rc_am_attr_string($mountNode, 'clientid'));
		$name = rc_am_attr_string($mountNode, 'name');
		if ($mountId <= 0 || $name === '') {
			continue;
		}

		$bonusLines = rc_am_collect_bonuses($mountNode);
		$primaryImage = rc_am_outfit_image_url($outfitRenderer, $clientId, 0, $defaultColors, 0);
		$fallbackImage = rc_am_outfit_image_url($outfitRenderer, 128, 3, $defaultColors, $mountId);

		$mounts[] = [
			'id' => $mountId,
			'name' => $name,
			'primaryImage' => $primaryImage,
			'fallbackImage' => $fallbackImage,
			'bonus' => $bonusLines,
			'search' => strtolower($name . ' ' . implode(' ', $bonusLines)),
		];
	}
}

usort($mounts, function ($a, $b) {
	return strnatcasecmp($a['name'], $b['name']);
});

$outfitsRows = '';
foreach ($outfits as $row) {
	$femaleImageHtml = '<span class="rc-am-empty">N/A</span>';
	if ($row['femaleImage'] !== '') {
		$femaleImageHtml = '<img src="' . htmlspecialchars($row['femaleImage'], ENT_QUOTES, 'UTF-8') . '" alt="Female ' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" loading="lazy">';
	}

	$maleImageHtml = '<span class="rc-am-empty">N/A</span>';
	if ($row['maleImage'] !== '') {
		$maleImageHtml = '<img src="' . htmlspecialchars($row['maleImage'], ENT_QUOTES, 'UTF-8') . '" alt="Male ' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" loading="lazy">';
	}

	$outfitsRows .= '<tr data-search="' . htmlspecialchars($row['search'], ENT_QUOTES, 'UTF-8') . '">'
		. '<td class="rc-am-name-cell">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>'
		. '<td>'
		. '<div class="rc-am-outfit-pair">'
		. '<div class="rc-am-outfit-slot"><span>Female</span>' . $femaleImageHtml . '</div>'
		. '<div class="rc-am-outfit-slot"><span>Male</span>' . $maleImageHtml . '</div>'
		. '</div>'
		. '</td>'
		. '<td>' . rc_am_bonus_html($row['bonus']) . '</td>'
		. '</tr>';
}
if ($outfitsRows === '') {
	$outfitsRows = '<tr class="rc-am-empty-row"><td colspan="3">Nenhum outfit encontrado.</td></tr>';
}

$mountRows = '';
foreach ($mounts as $row) {
	$imageHtml = '<span class="rc-am-empty">N/A</span>';
	if ($row['primaryImage'] !== '') {
		$imageHtml = '<img src="' . htmlspecialchars($row['primaryImage'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" loading="lazy"'
			. ($row['fallbackImage'] !== '' ? ' data-fallback="' . htmlspecialchars($row['fallbackImage'], ENT_QUOTES, 'UTF-8') . '"' : '')
			. '>';
	}

	$mountRows .= '<tr data-search="' . htmlspecialchars($row['search'], ENT_QUOTES, 'UTF-8') . '">'
		. '<td class="rc-am-name-cell">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>'
		. '<td><div class="rc-am-mount-visual">' . $imageHtml . '</div></td>'
		. '<td>' . rc_am_bonus_html($row['bonus']) . '</td>'
		. '</tr>';
}
if ($mountRows === '') {
	$mountRows = '<tr class="rc-am-empty-row"><td colspan="3">Nenhuma mount encontrada.</td></tr>';
}

echo '<div class="rc-am-page">'
	. '<header class="rc-st-page-title"><h2>Addon&Mount Bonuses</h2></header>'
	. '<section class="rc-st-card">'
	. '<h3>Sobre</h3>'
	. '<p>Com o objetivo de valorizar outfits e mounts, esta pagina le os dados direto dos seus arquivos XML e gera as imagens pelo renderer de outfit do proprio site. Assim, nao e necessario manter colecoes de .gif/.png salvas para cada registro.</p>'
	. '</section>';

if (!empty($warnings)) {
	echo '<section class="rc-st-card rc-am-warning"><h3>Aviso</h3><ul class="rc-am-warning-list">';
	foreach ($warnings as $warning) {
		echo '<li>' . htmlspecialchars($warning, ENT_QUOTES, 'UTF-8') . '</li>';
	}
	echo '</ul></section>';
}

echo '<section class="rc-st-card">'
	. '<h3>Consulta</h3>'
	. '<div class="rc-am-toolbar">'
	. '<div class="rc-am-search-wrap"><input id="rcAmSearchInput" type="search" class="rc-am-search-input" placeholder="Pesquisar outfit..." autocomplete="off"></div>'
	. '<div class="rc-am-tabs" role="tablist" aria-label="Tipo de bonus">'
	. '<button type="button" class="rc-am-tab is-active" data-kind="outfits" role="tab" aria-selected="true">Outfits</button>'
	. '<button type="button" class="rc-am-tab" data-kind="mounts" role="tab" aria-selected="false">Mounts</button>'
	. '</div>'
	. '<div class="rc-am-results"><strong id="rcAmVisibleCount">0</strong> resultados</div>'
	. '</div>'
	. '<div class="rc-am-table-area is-active" data-kind="outfits">'
	. '<table class="rc-am-table">'
	. '<thead><tr><th>Nome do Outfit</th><th>Imagem (Female / Male)</th><th>Bonus</th></tr></thead>'
	. '<tbody id="rcAmOutfitsBody">' . $outfitsRows . '</tbody>'
	. '</table>'
	. '</div>'
	. '<div class="rc-am-table-area" data-kind="mounts">'
	. '<table class="rc-am-table">'
	. '<thead><tr><th>Nome da Mount</th><th>Imagem da Mount</th><th>Bonus</th></tr></thead>'
	. '<tbody id="rcAmMountsBody">' . $mountRows . '</tbody>'
	. '</table>'
	. '</div>'
	. '</section>'
	. '<script>(function(){'
	. 'var root=document.querySelector(".rc-am-page");if(!root){return;}'
	. 'var tabs=[].slice.call(root.querySelectorAll(".rc-am-tab"));'
	. 'var areas=[].slice.call(root.querySelectorAll(".rc-am-table-area"));'
	. 'var search=document.getElementById("rcAmSearchInput");'
	. 'var countNode=document.getElementById("rcAmVisibleCount");'
	. 'function activeKind(){var tab=root.querySelector(".rc-am-tab.is-active");return tab?tab.getAttribute("data-kind"):"outfits";}'
	. 'function applyFallbackImages(){var imgs=root.querySelectorAll("img[data-fallback]");imgs.forEach(function(img){img.addEventListener("error",function(){var fb=img.getAttribute("data-fallback");if(fb&&img.getAttribute("data-failed")!=="1"){img.setAttribute("data-failed","1");img.src=fb;}});});}'
	. 'function setTab(kind){tabs.forEach(function(tab){var active=tab.getAttribute("data-kind")===kind;tab.classList.toggle("is-active",active);tab.setAttribute("aria-selected",active?"true":"false");});areas.forEach(function(area){area.classList.toggle("is-active",area.getAttribute("data-kind")===kind);});if(search){search.placeholder=kind==="mounts"?"Pesquisar mount...":"Pesquisar outfit...";}filterRows();}'
	. 'function filterRows(){var kind=activeKind();var area=root.querySelector(".rc-am-table-area[data-kind=\\""+kind+"\\"]");if(!area){return;}var rows=[].slice.call(area.querySelectorAll("tbody tr"));var term=((search&&search.value)||"").toLowerCase().trim();var visible=0;rows.forEach(function(row){if(row.classList.contains("rc-am-empty-row")){return;}var text=(row.getAttribute("data-search")||"").toLowerCase();var ok=!term||text.indexOf(term)!==-1;row.style.display=ok?"":"none";if(ok){visible++;}});if(countNode){countNode.textContent=String(visible);}}'
	. 'tabs.forEach(function(tab){tab.addEventListener("click",function(){setTab(tab.getAttribute("data-kind")||"outfits");});});'
	. 'if(search){search.addEventListener("input",filterRows);}'
	. 'applyFallbackImages();'
	. 'setTab("outfits");'
	. '})();</script>'
	. '</div>';
