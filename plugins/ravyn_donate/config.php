<?php
/**
 * Pacotes oficiais RavynCore — fonte única para donate / MP / Stripe.
 */
defined('MYAAC') or die('Direct access not allowed!');

$ravynDonateDefaults = [
    'terms_version' => '2026-05-27',
    'pix' => [
        'enabled' => true,
        'mercadopago_key' => 'b63bc149-403d-4a76-b836-5ed34ef8ec84',
        'qr_image' => 'images/payments/qr-code10.png',
        'timeout_seconds' => 600,
        'final_delay_seconds' => 10,
        // Fallback estático (se API MP falhar) — idealmente um BR Code por valor
        'static_copy_paste' => '00020101021126330014br.gov.bcb.pix011142247700837520400005303986540510.005802BR5925GUILHERME COSTA FERREIRA 6009SAO PAULO622905251KSQ3511Y9Y978VTFEJBQ6MNW63047710',
    ],
    'packages' => [
        'pack_100' => ['coins' => 100, 'brl' => 10, 'label' => '100 Coins', 'popular' => false],
        'pack_1000' => ['coins' => 1000, 'brl' => 100, 'label' => '1.000 Coins', 'popular' => false],
        'pack_3150' => ['coins' => 3150, 'brl' => 300, 'label' => '3.150 Coins', 'popular' => true],
        'pack_10500' => ['coins' => 10500, 'brl' => 1000, 'label' => '10.500 Coins', 'popular' => false],
        'pack_73500' => ['coins' => 73500, 'brl' => 7000, 'label' => '73.500 Coins', 'popular' => false],
        'pack_135000' => ['coins' => 135000, 'brl' => 10000, 'label' => '135.000 Coins', 'popular' => false],
    ],
];

$config['ravynDonate'] = array_replace_recursive(
    $ravynDonateDefaults,
    isset($config['ravynDonate']) && is_array($config['ravynDonate']) ? $config['ravynDonate'] : []
);
