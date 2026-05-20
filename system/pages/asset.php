<?php
defined('MYAAC') or die('Direct access not allowed!');

require_once LIBS . 'ravyncore_assets.php';

if (!function_exists('rc_asset_output_placeholder')) {
	function rc_asset_output_placeholder($httpCode = 404)
	{
		$code = (int)$httpCode;
		if ($code < 100 || $code > 599) {
			$code = 404;
		}

		http_response_code($code);
		header('Content-Type: image/gif');
		header('Cache-Control: public, max-age=300');
		echo base64_decode('R0lGODlhAQABAIABAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAICTAEAOw==');
		exit;
	}
}

if (!function_exists('rc_asset_output_file')) {
	function rc_asset_output_file($path, $maxAge = 2592000)
	{
		$path = (string)$path;
		if ($path === '' || !is_file($path)) {
			rc_asset_output_placeholder(404);
		}

		$maxAge = max(60, (int)$maxAge);
		header('Content-Type: ' . rc_assets_get_mime_by_extension($path));
		header('Content-Length: ' . (string)filesize($path));
		header('Cache-Control: public, max-age=' . $maxAge);
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $maxAge) . ' GMT');
		readfile($path);
		exit;
	}
}

if (!function_exists('rc_asset_normalize_renderer_url')) {
	function rc_asset_normalize_renderer_url($url)
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

if (!function_exists('rc_asset_renderer_redirect')) {
	function rc_asset_renderer_redirect($renderer, array $queryParams)
	{
		$renderer = rc_asset_normalize_renderer_url($renderer);
		if ($renderer === '') {
			rc_asset_output_placeholder(404);
		}

		$separator = strpos($renderer, '?') === false ? '?' : '&';
		$url = $renderer . $separator . http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);
		header('Location: ' . $url, true, 302);
		exit;
	}
}

$type = strtolower(trim((string)($_REQUEST['type'] ?? '')));
$id = (int)($_REQUEST['id'] ?? 0);

if ($type === '' || $id <= 0) {
	rc_asset_output_placeholder(404);
}

$cached = rc_assets_find_cached_file($type, $id);
if ($cached !== '') {
	rc_asset_output_file($cached);
}

$generated = rc_assets_generate_cached_file($type, $id, $_REQUEST);
if ($generated !== '') {
	rc_asset_output_file($generated);
}

global $config;

switch ($type) {
	case 'item':
	case 'items':
		require_once SYSTEM . 'item.php';
		$count = (int)($_REQUEST['count'] ?? 1);
		if ($count < 1) {
			$count = 1;
		}
		if ($count > 100) {
			$count = 100;
		}

		try {
			outputItem($id, $count);
			exit;
		} catch (Exception $e) {
			rc_asset_output_placeholder(404);
		} catch (Error $e) {
			rc_asset_output_placeholder(404);
		}
		break;

	case 'outfit':
	case 'outfits':
		$renderer = $config['outfit_images_url'] ?? '';
		rc_asset_renderer_redirect($renderer, [
			'id' => $id,
			'addons' => max(0, (int)($_REQUEST['addons'] ?? 0)),
			'head' => max(0, (int)($_REQUEST['head'] ?? 114)),
			'body' => max(0, (int)($_REQUEST['body'] ?? 95)),
			'legs' => max(0, (int)($_REQUEST['legs'] ?? 78)),
			'feet' => max(0, (int)($_REQUEST['feet'] ?? 69)),
			'mount' => max(0, (int)($_REQUEST['mount'] ?? 0)),
			'direction' => max(0, (int)($_REQUEST['direction'] ?? 2)),
		]);
		break;

	case 'mount':
	case 'mounts':
		$renderer = $config['outfit_images_url'] ?? '';
		rc_asset_renderer_redirect($renderer, [
			'id' => max(1, (int)($_REQUEST['base'] ?? 128)),
			'addons' => max(0, (int)($_REQUEST['addons'] ?? 3)),
			'head' => max(0, (int)($_REQUEST['head'] ?? 114)),
			'body' => max(0, (int)($_REQUEST['body'] ?? 95)),
			'legs' => max(0, (int)($_REQUEST['legs'] ?? 78)),
			'feet' => max(0, (int)($_REQUEST['feet'] ?? 69)),
			'mount' => $id,
			'direction' => max(0, (int)($_REQUEST['direction'] ?? 2)),
		]);
		break;

	case 'missile':
	case 'missiles':
	case 'effect':
	case 'effects':
		rc_asset_output_placeholder(404);
		break;

	default:
		rc_asset_output_placeholder(404);
}

rc_asset_output_placeholder(404);
