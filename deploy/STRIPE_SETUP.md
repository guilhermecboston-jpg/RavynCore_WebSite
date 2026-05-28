# Stripe — RavynCore Donate

## 1. Chaves no servidor (`/var/www/html/config.local.php`)

```php
$config['stripe']['enabled'] = true;
$config['stripe']['environment'] = 'production'; // sandbox para teste
$config['stripe']['secretKey']['production'] = 'sk_live_...';
$config['stripe']['secretKey']['sandbox'] = 'sk_test_...';
$config['stripe']['webhookSecret']['production'] = 'whsec_...';
```

Obtenha em: [Stripe Dashboard → API keys](https://dashboard.stripe.com/apikeys)

## 2. Webhook

No [Stripe Workbench → Webhooks](https://dashboard.stripe.com/workbench/webhooks):

| Campo | Valor |
|--------|--------|
| Endpoint URL | `https://ravyncore.com/payments/stripe.php` |
| Eventos | `checkout.session.completed` |

Copie o **Signing secret** (`whsec_...`) para `webhookSecret` no `config.local.php`.

## 3. Deploy

```bash
cd /var/www/html
git pull origin main
php system/bin/clear_cache.php 2>/dev/null || true
rm -rf system/cache/twig/* 2>/dev/null || true
systemctl restart php8.2-fpm
```

## 4. Conferir se Stripe aparece na donate

```bash
php -r "
require 'common.php';
require_once SYSTEM . 'libs/ravyn_donate_checkout.php';
echo 'visible=' . (ravynDonateStripeVisible() ? 'yes' : 'no') . PHP_EOL;
echo 'ready=' . (ravynDonateStripeEnabled() ? 'yes' : 'no') . PHP_EOL;
"
```

- `visible=yes` → card Stripe na página
- `ready=yes` → pagamento funciona

## 5. Teste cartão (sandbox)

Número: `4242 4242 4242 4242` — qualquer validade/CVC.
