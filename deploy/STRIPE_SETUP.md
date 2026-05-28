# Stripe — RavynCore Donate

**Importante:** chaves `sk_live_` / `pk_live_` **não podem** ir no GitHub (push protection). Use só `config.local.php` no VPS (arquivo ignorado pelo git).

## 1. Chaves no servidor (`/var/www/html/config.local.php`)

Edite o arquivo no VPS (não commite no repositório):

```php
$config['stripe']['enabled'] = true;
$config['stripe']['environment'] = 'production'; // sandbox para teste
$config['stripe']['secretKey']['production'] = 'sk_live_SUA_CHAVE';
$config['stripe']['secretKey']['sandbox'] = '';
$config['stripe']['publishableKey']['production'] = 'pk_live_SUA_CHAVE';
$config['stripe']['publishableKey']['sandbox'] = '';
$config['stripe']['webhookSecret']['production'] = 'whsec_...';
$config['stripe']['webhookSecret']['sandbox'] = '';
```

Obtenha em: [Stripe Dashboard → API keys](https://dashboard.stripe.com/apikeys)

Pull seguro (preserva `config.local.php`):

```bash
bash deploy/server-git-pull.sh
```

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
