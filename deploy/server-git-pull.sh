#!/bin/bash
# Uso no VPS: bash deploy/server-git-pull.sh
# Preserva config.local.php (credenciais) fora do controle do git.
set -e
cd /var/www/html

BACKUP="/root/config.local.php.backup-$(date +%F-%H%M%S)"
CONFIG_SAFE="/root/config.local.php.deploy-safe"

if [ -f config.local.php ]; then
  cp -a config.local.php "$BACKUP"
  cp -a config.local.php "$CONFIG_SAFE"
  echo "Backup: $BACKUP"
fi

# Estado quebrado (stash pop / merge antigo em config.local.php)
git merge --abort 2>/dev/null || true
git rebase --abort 2>/dev/null || true
git cherry-pick --abort 2>/dev/null || true
git stash clear 2>/dev/null || true

# Tira config.local do índice git (versões antigas ainda rastreavam o arquivo)
git rm --cached -f config.local.php 2>/dev/null || true

git fetch origin main
git reset --hard origin/main

# Restaura credenciais do servidor
if [ -f "$CONFIG_SAFE" ]; then
  cp -a "$CONFIG_SAFE" config.local.php
  echo "config.local.php restaurado do servidor."
elif [ -f "$BACKUP" ]; then
  cp -a "$BACKUP" config.local.php
  echo "config.local.php restaurado do backup."
fi

if [ -f deploy/check-stripe.php ]; then
  php deploy/check-stripe.php 2>/dev/null || true
fi

php system/bin/clear_cache.php 2>/dev/null || true
rm -rf system/cache/twig/* 2>/dev/null || true
systemctl restart php8.2-fpm 2>/dev/null || true
echo "Deploy concluído. Commit: $(git rev-parse --short HEAD)"
