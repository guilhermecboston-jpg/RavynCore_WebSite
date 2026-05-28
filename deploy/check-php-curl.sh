#!/bin/bash
# Verifica se curl está disponível no CLI e no php-fpm
echo "=== PHP CLI ($(php -r 'echo PHP_VERSION;')) ==="
php -m 2>/dev/null | grep -i '^curl$' && echo "curl: SIM" || echo "curl: NÃO — sudo apt install -y php8.2-curl"

echo ""
echo "=== PHP-FPM 8.2 ==="
if command -v php-fpm8.2 >/dev/null 2>&1; then
  php-fpm8.2 -m 2>/dev/null | grep -i '^curl$' && echo "curl: SIM" || echo "curl: NÃO"
else
  echo "(php-fpm8.2 não encontrado no PATH)"
fi
