# Mercado Pago — RavynCore (MyAAC)

## Métodos de pagamento (Pix, cartão, boleto…)

Por padrão o Checkout Pro **não exclui** nenhum método. O que aparece no checkout depende da **conta Mercado Pago**:

| Método | Requisito |
|--------|-----------|
| **Pix** | Chave Pix cadastrada no app MP (Área Pix → Minhas chaves). Sem chave, o Pix **não aparece**. |
| **2 cartões de crédito** | Conta habilitada + valor mínimo do MP; `maxInstallments` ≥ 2 no config. |
| **Boleto / cartão / débito CAIXA** | Conta de vendedor ativa e verificada. |

Documentação: [meios de pagamento Checkout Pro](https://www.mercadopago.com.br/developers/pt/docs/checkout-pro/additional-settings/payment-methods).

### Ativar Pix (painel Mercado Pago)

1. App Mercado Pago → **Área Pix** → cadastrar chave (CPF, e-mail ou aleatória).
2. [Suas integrações](https://www.mercadopago.com.br/developers/panel/app) → app **RavynCore Website** → Checkout Pro ativo.
3. Faça um novo teste de doação (nova preferência de pagamento).

### Ajustar métodos no site (opcional)

Em `config.local.php`:

```php
$config['mercadoPago']['paymentMethods']['maxInstallments'] = 12;
// Ocultar boleto, por exemplo:
// $config['mercadoPago']['paymentMethods']['excludedPaymentTypes'] = ['ticket'];
```

---

## Webhook (obrigatório para coins + loyalty)

1. [Webhooks](https://www.mercadopago.com.br/developers/panel/app) → sua aplicação.
2. URL: `https://ravyncore.com/payments/mercadopago.php`
3. Evento: **Pagamentos** (`payment`).

Sem webhook aprovado, o jogador paga mas **coins/loyalty não entram** automaticamente.

---

## Teste completo (produção)

Use uma conta de teste com pouco valor (ex.: pacote R$ 10).

### Antes do pagamento

Anote o **ID da account** (número em “Reference” na página Donate = `accounts.id`).

No MySQL (`rctest`):

```sql
SELECT id, name, coins_transferable, loyalty_points
FROM accounts WHERE id = SEU_ACCOUNT_ID;
```

### Pagamento

1. Login no site → **Donate** → pacote → **Pay with Mercado Pago**.
2. Pague com **Pix** (ou cartão). Aguarde status **aprovado**.
3. Volte ao site (URL de retorno).

### Depois do pagamento (1–2 min)

```sql
SELECT id, payment_id, payment_status, delivered, coins_amount, amount_brl, created_at
FROM mercadopago_transactions
WHERE account_id = SEU_ACCOUNT_ID
ORDER BY id DESC LIMIT 5;

SELECT id, coins_transferable, loyalty_points
FROM accounts WHERE id = SEU_ACCOUNT_ID;
```

**Esperado:**

- `mercadopago_transactions.delivered` = `1`
- `payment_status` = `approved`
- `coins_transferable` += coins do pacote
- `loyalty_points` += valor em reais (R$ 10 → +10 pontos)

### Logs no servidor

```bash
tail -30 /var/www/html/system/logs/mercadopago_webhook.log
tail -30 /var/www/html/system/logs/loyalty_donation.log
tail -30 /var/www/html/system/logs/mercadopago_donate_errors.log
```

Linha de sucesso em `loyalty_donation.log`:

`[DONATION LOYALTY] account 123 +10 (R$ 10.00)`

### Webhook não chegou?

No painel MP: **Suas vendas** → abrir o pagamento → ver se notificação foi enviada.

Reprocessar manualmente (substitua `PAYMENT_ID` do MP):

```bash
curl -s "https://ravyncore.com/payments/mercadopago.php?id=PAYMENT_ID"
```

---

## Sandbox (opcional)

1. Credenciais de **teste** em [developers](https://www.mercadopago.com.br/developers/panel/credentials).
2. `config.local.php`:

```php
$config['mercadoPago']['environment'] = 'sandbox';
$config['mercadoPago']['accessToken']['sandbox'] = 'TEST-...';
```

3. Usuários de teste: [contas de teste](https://www.mercadopago.com.br/developers/pt/docs/checkout-pro/additional-content/test-users).

---

## Credenciais (`config.local.php`)

```php
$config['mercadoPago']['enabled'] = true;
$config['mercadoPago']['environment'] = 'production';
$config['mercadoPago']['accessToken']['production'] = 'APP_USR-...';
$config['force_https_urls'] = true;
$config['public_url'] = 'https://ravyncore.com/';
```

Nunca commite o Access Token no Git.
