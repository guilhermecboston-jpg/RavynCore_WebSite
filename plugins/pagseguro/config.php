<?php
/**
 * Automatic PagSeguro payment system gateway.
 *
 * @name      myaac-pagseguro
 * @author    Ivens Pontes <ivenscardoso@hotmail.com>
 * @author    Slawkens <slawkens@gmail.com>
 * @author    Elson <elsongabriel@hotmail.com>
 * @copyright 2023 MyAAC
 */

$config['pagSeguro'] = [
    'enabled'           => false, // PagSeguro desativado — use Mercado Pago / Stripe
    'email'             => '', // your pagseguro e-mail
    'environment'       => 'production', // production, sandbox
    'token'             => [
        'production'    => '',
        'sandbox'       => '',
    ],
    'urlRedirect'       => '?subtopic=donate&action=final', // default should be good
    'productName'       => 'My Coins', // Your coins name, ex: Server Name, Coins, Premium Points, etc..
    'value'             => 0.10,
    'doubleCoins'       => false, // should coins be doubled? for example: for 5 coins donated you become 10.
    'doubleCoinsStart'  => 300, // if doubleCoins is activated, what is min value to activate double coins
    'donationType'      => 'coins_transferable', // what should be added to player account? coins/coins_transferable
    'donates'           => [], // desativado — pacotes em mercadopago/stripe config
    'boxes' => [ // if you want to sell boxes in site
        'xxxxx' => [ // put crystalserver box item id
            'id'          => 'xxxxx', // the same id
            'name'        => 'My Basic Box', // box name
            'value'       => 1.00, // value
            'image'       => 'box_basic.png', // your image
            'border'      => '#1fc939', // border color
            'description' => 'Com essa box, você economiza R$ xx,00', // some description
        ],
    ]
];
