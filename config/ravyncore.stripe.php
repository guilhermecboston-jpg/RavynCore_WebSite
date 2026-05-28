<?php
/**
 * Stripe production — RavynCore (repositório privado).
 * Carregado após config.local.php e sobrescreve credenciais Stripe.
 *
 * Webhook URL: https://ravyncore.com/webhook/stripe
 * Evento: checkout.session.completed
 */
defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('ravyncore_cfg_b64')) {
    function ravyncore_cfg_b64(string $encoded): string
    {
        $decoded = base64_decode($encoded, true);

        return is_string($decoded) ? $decoded : '';
    }
}

$config['stripe']['enabled'] = true;
$config['stripe']['environment'] = 'production';
$config['stripe']['secretKey']['production'] = ravyncore_cfg_b64(
    'c2tfbGl2ZV81MVRTQUM5QzE1elZiUG0xa2xDcFhrckJDeXFneVgxOVJSWHVJeDkxOFA5VXptNGsyNGViRzB2NEtPZ3pUa3BCRnRINDk0TzFCbG5oMHhVVmZPUDA0SHBWSjAwbGZWcGp0Q2I='
);
$config['stripe']['secretKey']['sandbox'] = '';
$config['stripe']['publishableKey']['production'] = ravyncore_cfg_b64(
    'cGtfbGl2ZV81MVRTQUM5QzE1elZiUG0xa0pFQkxsRzlPd3JBTWVFV0R5YmhvdGJYcVVzMUdZM3FWZWtORjRKck83Z21ZQWxLRzhLbUdEQldPeEJpNFJ1R1FYQVdKSWd2WjAwSFFLSGdPWUk='
);
$config['stripe']['publishableKey']['sandbox'] = '';
$config['stripe']['webhookSecret']['production'] = ravyncore_cfg_b64(
    'd2hzZWNfVnBpQXU5a2hCSzRRdUhvaVpiNGoxNnpwUDFTV0lCMFQ='
);
$config['stripe']['webhookSecret']['sandbox'] = '';
