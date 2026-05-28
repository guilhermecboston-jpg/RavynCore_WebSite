# Stripe — RavynCore Donate

Credenciais de produção ficam em `config/ravyncore.stripe.php` (repositório privado). Esse arquivo é carregado **depois** de `config.local.php` e corrige chaves Stripe erradas no VPS.

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

| Chave no Stripe | Onde colocar | Usada no donate? |
|-----------------|--------------|------------------|
| **Secret key** `sk_live_...` | `secretKey['production']` | **Sim** (cria Checkout) |
| **Publishable key** `pk_live_...` | `publishableKey['production']` | Não (opcional; front-end futuro) |

Erro `Invalid API Key ...AQUI` = ainda está o texto de exemplo `sk_live_COLE_SUA_CHAVE_AQUI` no VPS, ou `pk_` no lugar de `sk_`.

Pull seguro (preserva `config.local.php`):

```bash
bash deploy/server-git-pull.sh
```

Se o pull falhar com `config.local.php: needs merge`:

```bash
bash deploy/vps-unstick-git.sh
bash deploy/server-git-pull.sh
```

## 2. Webhook

No [Stripe Workbench → Webhooks](https://dashboard.stripe.com/workbench/webhooks):

| Campo | Valor |
|--------|--------|
| Endpoint URL | `https://ravyncore.com/webhook/stripe` ou `https://ravyncore.com/payments/stripe.php` |
| Eventos | `checkout.session.completed` |

Copie o **Signing secret** (`whsec_...`) e grave no VPS:

```bash
php deploy/set-stripe-webhook-secret.php whsec_VALOR_REAL_DO_DASHBOARD
```

(Não use `whsec_COLE_AQUI...` — só o secret revelado no Stripe.)

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

## 6. Diagnóstico no VPS

```bash
cd /var/www/html
php deploy/check-stripe.php
```

Deve mostrar `chave usada` começando com `sk_live` e `ok: SIM`.

Se aparecer outro prefixo (`zwlt`, `pk_`, `AQUI`):

1. `nano config.local.php` — confira `environment` = `production`
2. Apague lixo em `secretKey['sandbox']` (deixe `''`)
3. Cole a **Secret key** só em `secretKey['production']`
4. `grep STRIPE /etc/php/8.2/fpm/pool.d/*.conf` — remova `env[STRIPE_SECRET_KEY]` se existir valor errado
5. `systemctl restart php8.2-fpm`

## 5. Teste cartão (sandbox)

Número: `4242 4242 4242 4242` — qualquer validade/CVC.
