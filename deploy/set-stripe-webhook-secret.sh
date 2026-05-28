#!/bin/bash
# Uso: bash deploy/set-stripe-webhook-secret.sh whsec_xxxxxxxx
# (preferir: php deploy/set-stripe-webhook-secret.php whsec_...)
set -e
cd /var/www/html
PHPCLI="/usr/bin/php8.2"
[ -x "$PHPCLI" ] || PHPCLI="php"
exec "$PHPCLI" deploy/set-stripe-webhook-secret.php "$@"
