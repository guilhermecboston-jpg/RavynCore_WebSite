<?php
/**
 * Copie para config.local.php no servidor e preencha os valores.
 * NUNCA commite tokens reais no GitHub.
 */

$config['installed'] = true;
$config['env'] = 'prod';

// URL pública com HTTPS (obrigatório para Mercado Pago)
$config['payment_public_url'] = 'https://SEU_DOMINIO/';
$config['force_https_urls'] = true;

// Mercado Pago — https://www.mercadopago.com.br/developers/panel/credentials
$config['mercadoPago']['enabled'] = true;
$config['mercadoPago']['environment'] = 'production'; // production | sandbox
$config['mercadoPago']['accessToken']['production'] = 'APP_USR-COLE_SEU_TOKEN_AQUI';
$config['mercadoPago']['accessToken']['sandbox'] = 'TEST-COLE_SEU_TOKEN_TESTE_AQUI';

// PIX Mercado Pago (chave + QR estático de fallback)
$config['ravynDonate']['pix']['enabled'] = true;
$config['ravynDonate']['pix']['mercadopago_key'] = 'b63bc149-403d-4a76-b836-5ed34ef8ec84';
$config['ravynDonate']['pix']['qr_image'] = 'images/payments/pix-qrcode-mercadopago.png';

// Stripe (opcional)
// $config['stripe']['enabled'] = true;
// $config['stripe']['environment'] = 'production';
// $config['stripe']['secretKey']['production'] = 'sk_live_...';
