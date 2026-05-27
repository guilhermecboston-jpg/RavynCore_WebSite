<?php
/**
 * RavynCore checkout — configure no servidor (variáveis de ambiente recomendadas).
 */
return [
    'db' => [
        'host' => getenv('RAVYN_DB_HOST') ?: '127.0.0.1',
        'name' => getenv('RAVYN_DB_NAME') ?: 'ravyncore',
        'user' => getenv('RAVYN_DB_USER') ?: 'root',
        'pass' => getenv('RAVYN_DB_PASS') ?: '',
    ],
    'site_url' => getenv('RAVYN_SITE_URL') ?: 'http://177.55.153.178',
    'mercadopago' => [
        'access_token' => getenv('MP_ACCESS_TOKEN') ?: '',
        'public_key' => getenv('MP_PUBLIC_KEY') ?: '',
        'webhook_secret' => getenv('MP_WEBHOOK_SECRET') ?: '',
    ],
    'stripe' => [
        'secret_key' => getenv('STRIPE_SECRET_KEY') ?: '',
        'webhook_secret' => getenv('STRIPE_WEBHOOK_SECRET') ?: '',
    ],
    'packages' => [
        'pack_100' => ['coins' => 100, 'amount_usd' => 10.00],
        'pack_1000' => ['coins' => 1000, 'amount_usd' => 100.00],
        'pack_3150' => ['coins' => 3150, 'amount_usd' => 300.00],
        'pack_10500' => ['coins' => 10500, 'amount_usd' => 1000.00],
        'pack_73500' => ['coins' => 73500, 'amount_usd' => 7000.00],
        'pack_135000' => ['coins' => 135000, 'amount_usd' => 10000.00],
    ],
    // payment_method => excluded_payment_types / MP preference hints
    'mp_methods' => [
        'credit_card' => ['payment_method_id' => null, 'label' => 'Novo Cartão'],
        'two_cards' => ['payment_method_id' => null, 'label' => '2 cartões'],
        'debit_card' => ['payment_method_id' => 'debit_card', 'label' => 'Débito CAIXA'],
        'pix' => ['payment_method_id' => 'pix', 'label' => 'PIX'],
    ],
];
