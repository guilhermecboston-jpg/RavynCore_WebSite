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
        'qr_image' => 'images/payments/qr-code0011.png',
        'timeout_seconds' => 600,
        'final_delay_seconds' => 15,
        'success_display_seconds' => 12,
        // Fallback estático (se API MP falhar) — idealmente um BR Code por valor
        'static_copy_paste' => '00020126580014br.gov.bcb.pix0136b63bc149-403d-4a76-b836-5ed34ef8ec8452040000530398654040.015802BR5924Guilherme Costa Ferreira6009Sao Paulo62240520daqr3426207160375087630480A3',
    ],
    'packages' => [
        'pack_1000_test' => ['coins' => 1000, 'brl' => 1.00, 'label' => '1.000 Coins (Teste R$ 1,00)', 'popular' => true],
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
