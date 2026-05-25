# Stripe — RavynCore MyAAC

## 1. Banco de dados

Execute no MySQL (mesmo DB do servidor):

```sql
-- conteúdo de plugins/stripe/install.sql
```

## 2. Conta Stripe

1. https://dashboard.stripe.com — criar conta / ativar pagamentos em BRL.
2. **API keys**: Developers → API keys → Secret key + Publishable key.
3. **Webhook**: Developers → Webhooks → Add endpoint  
   - URL: `https://ravyncore.com/payments/stripe.php`  
   - Evento: `checkout.session.completed`  
   - Copiar **Signing secret** (whsec_...).

## 3. Configuração

Em `plugins/stripe/config.php` ou `config.local.php`:

```php
$config['stripe']['enabled'] = true;
$config['stripe']['environment'] = 'production';
$config['stripe']['secretKey']['production'] = 'sk_live_...';
$config['stripe']['webhookSecret']['production'] = 'whsec_...';
```

Teste (sandbox): use `environment` => `sandbox` e chaves `sk_test_` / `whsec_` de test mode.

## 4. Teste

1. Logar no site → Donate → Pay with Stripe.
2. Cartão de teste: `4242 4242 4242 4242`.
3. Verificar `accounts.coins_transferable`, `accounts.loyalty_points`, log `loyalty_donation.log`.
