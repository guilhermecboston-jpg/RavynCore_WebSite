#!/bin/bash
# Após deploy: limpa cache e reinicia PHP-FPM (+ nginx opcional)
set -e
cd /var/www/html
PHPCLI="/usr/bin/php8.2"
[ -x "$PHPCLI" ] || PHPCLI="php"

"$PHPCLI" system/bin/clear_cache.php 2>/dev/null || true
rm -rf system/cache/twig/* 2>/dev/null || true
systemctl restart php8.2-fpm
systemctl reload nginx 2>/dev/null || true
echo "php8.2-fpm e nginx recarregados."
