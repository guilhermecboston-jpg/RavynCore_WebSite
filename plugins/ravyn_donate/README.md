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
