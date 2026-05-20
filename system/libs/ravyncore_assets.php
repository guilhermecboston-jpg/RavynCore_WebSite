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

if (!function_exists('rc_assets_normalize_type')) {
	function rc_assets_normalize_type($type)
	{
		$type = strtolower(trim((string)$type));
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

		return $aliases[$type] ?? '';
	}
}

if (!function_exists('rc_assets_get_python_path')) {
	function rc_assets_get_python_path()
	{
		global $config;

		$candidates = [];
		if (!empty($config['things_assets_python_path']) && (string)$config['things_assets_python_path'] !== 'python') {
			$candidates[] = (string)$config['things_assets_python_path'];
		}
		if (getenv('RAVYNCORE_PYTHON')) {
			$candidates[] = (string)getenv('RAVYNCORE_PYTHON');
		}
		if (getenv('USERPROFILE')) {
			$candidates[] = rtrim((string)getenv('USERPROFILE'), '/\\') . '\\.cache\\codex-runtimes\\codex-primary-runtime\\dependencies\\python\\python.exe';
		}
		if (!empty($config['things_assets_python_path'])) {
			$candidates[] = (string)$config['things_assets_python_path'];
		}
		$candidates[] = 'python';

		foreach ($candidates as $candidate) {
			$candidate = trim((string)$candidate);
			if ($candidate === '') {
				continue;
			}
			if (rc_assets_is_absolute_path($candidate) && !is_file($candidate)) {
				continue;
			}

			return $candidate;
		}

		return '';
	}
}

if (!function_exists('rc_assets_cache_key')) {
	function rc_assets_cache_key($type, $id, array $params = [])
	{
		$normalizedType = rc_assets_normalize_type($type);
		$id = (int)$id;
		if ($normalizedType === 'outfits' || $normalizedType === 'mounts') {
			return $id
				. '_a' . max(0, (int)($params['addons'] ?? 3))
				. '_h' . max(0, (int)($params['head'] ?? 95))
				. '_b' . max(0, (int)($params['body'] ?? 114))
				. '_l' . max(0, (int)($params['legs'] ?? 39))
				. '_f' . max(0, (int)($params['feet'] ?? 115))
				. '_d' . max(0, (int)($params['direction'] ?? 3));
		}

		if ($normalizedType === 'items') {
			$count = max(1, min(100, (int)($params['count'] ?? 1)));
			return $count > 1 ? $id . '_c' . $count : (string)$id;
		}

		return (string)$id;
	}
}

if (!function_exists('rc_assets_generate_cached_file')) {
	function rc_assets_generate_cached_file($type, $id, array $params = [])
	{
		$normalizedType = rc_assets_normalize_type($type);
		$id = (int)$id;
		if ($id <= 0 || $normalizedType === '') {
			return '';
		}

		if (!in_array($normalizedType, ['items', 'outfits', 'effects', 'missiles'], true)) {
			return '';
		}

		$root = rc_assets_get_things_root_path(true);
		$cacheRoot = rc_assets_get_cache_root_path(false);
		$python = rc_assets_get_python_path();
		$generator = BASE . 'tools' . DIRECTORY_SEPARATOR . 'generate_things_cache.py';
		if ($root === '' || $cacheRoot === '' || $python === '' || !is_file($generator)) {
			return '';
		}

		$targetDir = $cacheRoot . DIRECTORY_SEPARATOR . $normalizedType;
		if (!is_dir($targetDir)) {
			@mkdir($targetDir, 0775, true);
		}

		$target = $targetDir . DIRECTORY_SEPARATOR . rc_assets_cache_key($normalizedType, $id, $params) . '.png';
		if (is_file($target)) {
			return $target;
		}

		$args = [
			escapeshellarg($python),
			escapeshellarg($generator),
			'--type',
			escapeshellarg($normalizedType),
			'--ids',
			escapeshellarg((string)$id),
			'--things',
			escapeshellarg($root),
			'--cache',
			escapeshellarg($cacheRoot),
			'--addons',
			escapeshellarg((string)max(0, (int)($params['addons'] ?? 3))),
			'--head',
			escapeshellarg((string)max(0, (int)($params['head'] ?? 95))),
			'--body',
			escapeshellarg((string)max(0, (int)($params['body'] ?? 114))),
			'--legs',
			escapeshellarg((string)max(0, (int)($params['legs'] ?? 39))),
			'--feet',
			escapeshellarg((string)max(0, (int)($params['feet'] ?? 115))),
			'--direction',
			escapeshellarg((string)max(0, (int)($params['direction'] ?? 3))),
		];

		$command = implode(' ', $args);
		$output = [];
		$exitCode = 1;
		@exec($command, $output, $exitCode);
		$generated = $targetDir . DIRECTORY_SEPARATOR . $id . '.png';
		if ($exitCode === 0 && is_file($generated) && $generated !== $target) {
			@rename($generated, $target);
		}

		return ($exitCode === 0 && is_file($target)) ? $target : '';
	}
}

if (!function_exists('rc_assets_find_cached_file')) {
	function rc_assets_find_cached_file($type, $id, array $params = [])
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

		$normalizedType = rc_assets_normalize_type($type);
		if ($normalizedType === '') {
			return '';
		}

		$dir = $cacheRoot . DIRECTORY_SEPARATOR . $normalizedType;
		if (!is_dir($dir)) {
			return '';
		}

		$extensions = ['png', 'gif', 'webp', 'jpg', 'jpeg'];
		$cacheKey = rc_assets_cache_key($normalizedType, $id, $params);
		foreach ($extensions as $ext) {
			$file = $dir . DIRECTORY_SEPARATOR . $cacheKey . '.' . $ext;
			if (is_file($file)) {
				return $file;
			}
		}

		if ($cacheKey !== (string)$id && !in_array($normalizedType, ['outfits', 'mounts'], true)) {
			foreach ($extensions as $ext) {
				$file = $dir . DIRECTORY_SEPARATOR . $id . '.' . $ext;
				if (is_file($file)) {
					return $file;
				}
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
