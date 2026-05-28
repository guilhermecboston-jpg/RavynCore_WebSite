# Ravyn Donate (Coins)

Fluxo: login → pacote → gateway → dados + termos → pagamento → entrega automática.

## Configurar URL de retorno (evitar ravyncore.com)

Em `config.local.php`:

```php
$config['payment_public_url'] = 'https://177.55.153.178/';
$config['force_https_urls'] = true;
```

Se `public_url` apontar para `ravyncore.com` sem servidor ativo, o sistema usa o host da requisição ou IP acima.

## Tabela

`ravyn_donate_orders` — criada automaticamente no primeiro pedido.

Registra: termos aceitos, IP, user-agent, gateway, payment_id, status, entrega.

## Stripe

1. Em `config.local.php`:
   - `secretKey` (sk_live_ ou sk_test_)
   - `webhookSecret` (whsec_...)
2. No [Stripe Dashboard](https://dashboard.stripe.com/webhooks), crie endpoint:
   - URL: `https://ravyncore.com/payments/stripe.php`
   - Evento: `checkout.session.completed`
3. Na página Donate, selecione **Stripe** → preenche dados → redireciona ao Checkout Stripe.
4. Após pagar, retorna para `?subtopic=donate&action=final&gateway=stripe` com confirmação e entrega automática de coins + loyalty (R$ 1 = 1 ponto).
