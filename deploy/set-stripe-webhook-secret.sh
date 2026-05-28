#!/bin/bash
# Uso no VPS (uma vez), após copiar whsec_ do Stripe Dashboard:
#   bash deploy/set-stripe-webhook-secret.sh whsec_SEU_SIGNING_SECRET
set -e
cd /var/www/html
WH="${1:-}"
if [ -z "$WH" ] || [[ "$WH" != whsec_* ]]; then
  echo "Uso: bash deploy/set-stripe-webhook-secret.sh whsec_..."
  exit 1
fi
FILE="config/ravyncore.stripe.php"
if ! grep -q "webhookSecret\['production'\]" "$FILE"; then
  echo "Arquivo $FILE não encontrado. Rode git pull primeiro."
  exit 1
fi
sed -i "s|\\\$config\\['stripe'\\]\\['webhookSecret'\\]\\['production'\\] = '.*';|\\\$config['stripe']['webhookSecret']['production'] = '${WH}';|" "$FILE"
echo "webhookSecret gravado em $FILE"
php deploy/check-stripe.php
