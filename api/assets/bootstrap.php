<?php
/**
 * RavynCore Asset Engine — PHP bridge (safe fallback to legacy images).
 */

declare(strict_types=1);

const RAVYN_ASSET_ENGINE_LEGACY_MSG = 'Já estamos utilizando o sistema atual do cliente/assets.';

function ravyn_asset_engine_config(): array
{
    static $cfg = null;
    if ($cfg !== null) {
        return $cfg;
    }

    $defaults = [
        'enabled' => false,
        'base_url' => 'http://127.0.0.1:8765',
        'timeout' => 20,
        'legacy_library_url' => 'https://www.ravyncore.com/images/library/',
    ];

    $paths = [
        __DIR__ . '/config.php',
        dirname(__DIR__, 2) . '/asset-engine/config.json',
    ];

    foreach ($paths as $path) {
        if (!is_file($path)) {
            continue;
        }
        if (str_ends_with($path, '.php')) {
            $local = include $path;
            if (is_array($local)) {
                $cfg = array_merge($defaults, $local);
                return $cfg;
            }
        }
        $json = json_decode((string) file_get_contents($path), true);
        if (is_array($json)) {
            $cfg = array_merge($defaults, [
                'enabled' => (bool) ($json['asset_engine_enabled'] ?? false),
                'base_url' => sprintf(
                    'http://%s:%d',
                    $json['asset_engine_host'] ?? $json['host'] ?? '127.0.0.1',
                    (int) ($json['asset_engine_port'] ?? $json['port'] ?? 8765)
                ),
            ]);
            return $cfg;
        }
    }

    $cfg = $defaults;
    return $cfg;
}

function ravyn_asset_engine_proxy(string $endpoint, array $query): void
{
    $cfg = ravyn_asset_engine_config();
    if (empty($cfg['enabled'])) {
        ravyn_asset_engine_legacy_fallback($query);
        return;
    }

    $url = rtrim((string) $cfg['base_url'], '/') . $endpoint . '?' . http_build_query($query);
    $ctx = stream_context_create([
        'http' => [
            'timeout' => (float) ($cfg['timeout'] ?? 8),
            'ignore_errors' => true,
        ],
    ]);
    $body = @file_get_contents($url, false, $ctx);
    if ($body === false) {
        ravyn_asset_engine_legacy_fallback($query);
        return;
    }

    $headers = $http_response_header ?? [];
    $contentType = 'image/png';
    foreach ($headers as $line) {
        if (stripos($line, 'Content-Type:') === 0) {
            $contentType = trim(substr($line, 13));
        }
    }

    if (str_starts_with($contentType, 'text/')) {
        ravyn_asset_engine_legacy_fallback($query);
        return;
    }

    header('Content-Type: ' . $contentType);
    header('Cache-Control: public, max-age=86400');
    echo $body;
    exit;
}

function ravyn_asset_engine_legacy_fallback(array $query): void
{
    $cfg = ravyn_asset_engine_config();
    $library = rtrim((string) ($cfg['legacy_library_url'] ?? ''), '/');

    if (isset($query['id']) && is_string($query['id']) && !ctype_digit((string) $query['id'])) {
        $name = preg_replace('/[^a-z0-9_]/', '', strtolower((string) $query['id']));
        $gif = $library . '/' . $name . '.gif';
        header('Location: ' . $gif, true, 302);
        exit;
    }

    http_response_code(503);
    header('Content-Type: text/plain; charset=utf-8');
    echo RAVYN_ASSET_ENGINE_LEGACY_MSG;
    exit;
}
