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

# Garante bloco Stripe se faltar (não sobrescreve chaves existentes)
if [ -f config.local.php ] && ! grep -q "stripe\]['enabled\]" config.local.php && ! grep -q '\$config\['"'"'stripe'"'"'\]\['"'"'enabled'"'"'\]' config.local.php; then
  cat >> config.local.php <<'PHP'

$config['stripe']['enabled'] = true;
$config['stripe']['environment'] = 'production';
$config['stripe']['secretKey']['production'] = '';
$config['stripe']['secretKey']['sandbox'] = '';
$config['stripe']['webhookSecret']['production'] = '';
$config['stripe']['webhookSecret']['sandbox'] = '';
PHP
  echo "Bloco Stripe adicionado em config.local.php — preencha sk_live_ e whsec_"
fi

php system/bin/clear_cache.php 2>/dev/null || true
rm -rf system/cache/twig/* 2>/dev/null || true
systemctl restart php8.2-fpm 2>/dev/null || true
echo "Deploy concluído."
