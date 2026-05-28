<?php
/**
 * phpMyAdmin runtime config
 * Force cookie authentication so login form is shown.
 */
$cfg['blowfish_secret'] = 'ravyncore_pma_cookie_secret_2026_change_me';

$i = 0;
$i++;
$cfg['Servers'][$i]['host'] = 'localhost';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['auth_type'] = 'cookie';
$cfg['Servers'][$i]['AllowNoPassword'] = false;
$cfg['Servers'][$i]['compress'] = false;

$cfg['LoginCookieValidity'] = 3600;
$cfg['ShowPhpInfo'] = true;
$cfg['SendErrorReports'] = 'never';
