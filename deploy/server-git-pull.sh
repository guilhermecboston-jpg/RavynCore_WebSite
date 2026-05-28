#!/bin/bash
# Uso no VPS: bash deploy/server-git-pull.sh
set -e
cd /var/www/html

BACKUP="/root/config.local.php.backup-$(date +%F-%H%M%S)"
if [ -f config.local.php ]; then
  cp config.local.php "$BACKUP"
  echo "Backup: $BACKUP"
fi

# Impede conflito: config.local.php fica só no servidor
git update-index --assume-unchanged config.local.php 2>/dev/null || true
git stash push -m "vps-config-local-$(date +%F)" -- config.local.php 2>/dev/null || true

git pull origin main

git stash pop 2>/dev/null || true
git update-index --no-assume-unchanged config.local.php 2>/dev/null || true

# Aviso se Stripe estiver sem secretKey (não altera config.local.php automaticamente)
if [ -f config.local.php ] && ! grep -qE "secretKey.*production.*sk_(live|test)_" config.local.php; then
  echo "AVISO: Stripe secretKey não encontrada em config.local.php — veja deploy/STRIPE_SETUP.md"
fi

php system/bin/clear_cache.php 2>/dev/null || true
rm -rf system/cache/twig/* 2>/dev/null || true
systemctl restart php8.2-fpm 2>/dev/null || true
echo "Deploy concluído."
