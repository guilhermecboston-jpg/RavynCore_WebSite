<?php
// place for your configuration directives, so you can later easily update myaac
$config['installed'] = true;
$config['env'] = 'prod'; // dev or prod
$config['mail_enabled'] = true;
$config['server_path'] = '/home/RavynCore/';
$config['mail_admin'] = 'guilhermecboston@gmail.com';
$config['mail_address'] = 'guilhermecboston@gmail.com';
$config['date_timezone'] = 'America/Sao_Paulo';
$config['client'] = '1511';
$config['session_prefix'] = 'myaac_l4uzz89n_';
$config['cache_prefix'] = 'myaac_o8rlk44e_';
$config['things_assets_path'] = 'system/data/things/1524';
$config['things_assets_version'] = '1524';
$config['things_assets_cache_path'] = 'images/things-cache';
$config['outfits_xml_path'] = '/home/RavynCore/data/XML/outfits.xml';
$config['mounts_xml_path'] = '/home/RavynCore/data/XML/mounts.xml';

$config['highscores_ids_hidden'] = array(1, 2, 3, 4, 5, 6);
$config['public_url'] = 'https://ravyncore.com/';
$config['payment_public_url'] = 'https://ravyncore.com/';
$config['force_https_urls'] = true;

$config['mercadoPago']['enabled'] = true;
$config['mercadoPago']['environment'] = getenv('MP_ENV') ?: 'production';
$config['mercadoPago']['accessToken']['production'] = getenv('MP_ACCESS_TOKEN') ?: '';
$config['mercadoPago']['accessToken']['sandbox'] = getenv('MP_ACCESS_TOKEN_SANDBOX') ?: '';
