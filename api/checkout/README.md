# API Checkout OTC (RavynCore)

Endpoints usados pelo cliente OTC (`game_ravyn_checkout`):

- `POST /api/checkout/create.php` — cria pedido e retorna `redirectUrl` (MP/Stripe)
- `POST /api/checkout/webhook_mercadopago.php`
- `POST /api/checkout/webhook_stripe.php`

Página web opcional: `/checkout/`

## Credenciais

Usa automaticamente `plugins/mercadopago` e `plugins/stripe` do MyAAC (`config.local.php`).

## Deploy VPS

Copiar pastas `api/checkout` e `checkout` para a raiz do site (junto de `index.php`).

Webhook MP: `https://SEU-DOMINIO/api/checkout/webhook_mercadopago.php`
