#!/bin/bash
# Uso UMA VEZ no VPS se aparecer "config.local.php: needs merge":
#   bash deploy/vps-unstick-git.sh
set -e
cd /var/www/html

echo "=== 1) Salvar config.local.php ==="
SAFE="/root/config.local.php.manual-$(date +%F-%H%M%S)"
if [ -f config.local.php ]; then
  cp -a config.local.php "$SAFE"
  echo "Salvo em: $SAFE"
else
  LATEST=$(ls -t /root/config.local.php.backup-* 2>/dev/null | head -1)
  if [ -n "$LATEST" ]; then
    cp -a "$LATEST" "$SAFE"
    echo "Recuperado do backup: $LATEST -> $SAFE"
  else
    echo "ERRO: não há config.local.php nem backup em /root/"
    exit 1
  fi
fi

echo "=== 2) Limpar merge/stash ==="
git merge --abort 2>/dev/null || true
git rebase --abort 2>/dev/null || true
git cherry-pick --abort 2>/dev/null || true
git stash clear 2>/dev/null || true

echo "=== 3) Sincronizar com GitHub ==="
git fetch origin main
git rm --cached -f config.local.php 2>/dev/null || true
git reset --hard origin/main

echo "=== 4) Restaurar config.local.php ==="
cp -a "$SAFE" config.local.php

echo "=== OK. Agora use: bash deploy/server-git-pull.sh ==="
git status -sb
