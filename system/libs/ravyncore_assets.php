<?php
defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('rc_assets_is_absolute_path')) {
	function rc_assets_is_absolute_path($path)
	{
		$path = (string)$path;
		return preg_match('/^[A-Za-z]:[\/\\\\]/', $path) === 1 || strpos($path, '/') === 0;
	}
}

if (!function_exists('rc_assets_resolve_path')) {
	function rc_assets_resolve_path($path)
	{
		$path = trim((string)$path);
		if ($path === '') {
			return '';
		}

		if (rc_assets_is_absolute_path($path)) {
			return $path;
		}

		return BASE . ltrim($path, '/\\');
	}
}

if (!function_exists('rc_assets_build_default_things_path')) {
	function rc_assets_build_default_things_path($version = '')
	{
		$version = trim((string)$version);
		if ($version === '') {
			$version = '1524';
		}

		return 'system/data/things/' . preg_replace('/[^0-9A-Za-z_\-]/', '', $version);
	}
}

if (!function_exists('rc_assets_get_things_root_path')) {
	function rc_assets_get_things_root_path($mustExist = false)
	{
		global $config;

		$version = isset($config['things_assets_version']) ? (string)$config['things_assets_version'] : '1524';
		$configured = isset($config['things_assets_path']) ? (string)$config['things_assets_path'] : '';
		if ($configured === '') {
			$configured = rc_assets_build_default_things_path($version);
		}

		$candidates = [rc_assets_resolve_path($configured)];
		$candidates[] = rc_assets_resolve_path(rc_assets_build_default_things_path($version));
		$candidates[] = rc_assets_resolve_path('system/data/things/1524');

		$seen = [];
		foreach ($candidates as $candidate) {
			if ($candidate === '' || isset($seen[$candidate])) {
				continue;
			}

			$seen[$candidate] = true;
			if (!$mustExist || is_dir($candidate)) {
				return $candidate;
			}
		}

		return $candidates[0] ?? '';
	}
}

if (!function_exists('rc_assets_get_catalog_path')) {
	function rc_assets_get_catalog_path()
	{
		$root = rc_assets_get_things_root_path(true);
		if ($root === '') {
			return '';
		}

		$catalog = rtrim($root, '/\\') . DIRECTORY_SEPARATOR . 'catalog-content.json';
		return is_file($catalog) ? $catalog : '';
	}
}

if (!function_exists('rc_assets_get_cache_root_path')) {
	function rc_assets_get_cache_root_path($mustExist = false)
	{
		global $config;

		$configured = isset($config['things_assets_cache_path']) ? (string)$config['things_assets_cache_path'] : '';
		if ($configured === '') {
			$configured = 'images/things-cache';
		}

		$cache = rc_assets_resolve_path($configured);
		if ($cache === '') {
			return '';
		}

		if ($mustExist && !is_dir($cache)) {
			return '';
		}

		return $cache;
	}
}

if (!function_exists('rc_assets_find_cached_file')) {
	function rc_assets_find_cached_file($type, $id)
	{
		$type = strtolower(trim((string)$type));
		$id = (int)$id;
		if ($type === '' || $id <= 0) {
			return '';
		}

		$cacheRoot = rc_assets_get_cache_root_path(true);
		if ($cacheRoot === '') {
			return '';
		}

		$aliases = [
			'item' => 'items',
			'items' => 'items',
			'missile' => 'missiles',
			'missiles' => 'missiles',
			'effect' => 'effects',
			'effects' => 'effects',
			'outfit' => 'outfits',
			'outfits' => 'outfits',
			'mount' => 'mounts',
			'mounts' => 'mounts',
		];

		if (!isset($aliases[$type])) {
			return '';
		}

		$dir = $cacheRoot . DIRECTORY_SEPARATOR . $aliases[$type];
		if (!is_dir($dir)) {
			return '';
		}

		$extensions = ['png', 'gif', 'webp', 'jpg', 'jpeg'];
		foreach ($extensions as $ext) {
			$file = $dir . DIRECTORY_SEPARATOR . $id . '.' . $ext;
			if (is_file($file)) {
				return $file;
			}
		}

		return '';
	}
}

if (!function_exists('rc_assets_get_mime_by_extension')) {
	function rc_assets_get_mime_by_extension($path)
	{
		$ext = strtolower(pathinfo((string)$path, PATHINFO_EXTENSION));
		switch ($ext) {
			case 'png':
				return 'image/png';
			case 'webp':
				return 'image/webp';
			case 'jpg':
			case 'jpeg':
				return 'image/jpeg';
			case 'gif':
			default:
				return 'image/gif';
		}
	}
}

if (!function_exists('rc_assets_get_proxy_url')) {
	function rc_assets_get_proxy_url($type, $id, array $params = [])
	{
		$query = array_merge([
			'subtopic' => 'asset',
			'type' => (string)$type,
			'id' => (int)$id,
		], $params);

		return BASE_URL . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
	}
}

if (!function_exists('rc_assets_get_status')) {
	function rc_assets_get_status()
	{
		$root = rc_assets_get_things_root_path(true);
		$catalog = rc_assets_get_catalog_path();
		$cacheRoot = rc_assets_get_cache_root_path(false);

		return [
			'ready' => $root !== '' && $catalog !== '',
			'root' => $root,
			'catalog' => $catalog,
			'cache' => $cacheRoot,
		];
	}
}
