<?php
global $config, $db, $template_path, $logged, $status, $content, $hooks, $title, $template, $account_logged;

defined('MYAAC') or die('Direct access not allowed!');

if (!function_exists('rc_is_staff_web_flag3')) {
    require_once SYSTEM . 'libs/rc_tickets.php';
}

if (!function_exists('rc_vocation_icon')) {
    function rc_vocation_icon($vocationName)
    {
        $name = strtolower((string)$vocationName);
        if (strpos($name, 'knight') !== false) {
            return BASE_URL . 'images/knight.png';
        }

        if (strpos($name, 'paladin') !== false) {
            return BASE_URL . 'images/paladin.png';
        }

        if (strpos($name, 'sorcerer') !== false) {
            return BASE_URL . 'images/sorcerer.png';
        }

        if (strpos($name, 'druid') !== false) {
            return BASE_URL . 'images/druid.png';
        }

        return BASE_URL . 'images/true.png';
    }
}

if (!function_exists('rc_rashid_city')) {
    function rc_rashid_city()
    {
        $weekDay = (int)date('w');
        $cities = [
            'Carlin',
            'Svargrond',
            'Liberty Bay',
            'Port Hope',
            'Ankrahmun',
            'Darashia',
            'Edron',
        ];

        return $cities[$weekDay] ?? 'Carlin';
    }
}

if (!function_exists('rc_t')) {
    require_once SYSTEM . 'libs/rc_i18n.php';
    rc_i18n_init();
}
$rcSupportedLanguages = rc_supported_languages($template_path);
$rcCurrentLang = rc_current_language();
$rcHtmlLang = rc_html_language();
$menuCategories = config('menu_categories') ?: [];
$menus = get_template_menus();
$templateLinks = isset($template) && is_array($template) ? $template : [];
$rcBuildPageUrl = static function($page, array $params = []) use ($rcCurrentLang): string {
    $params = array_merge(['subtopic' => (string)$page], $params);
    $params['lang'] = $rcCurrentLang;
    return BASE_URL . '?' . http_build_query($params);
};

if (!function_exists('rc2_extract_page_quick_links')) {
    function rc2_extract_page_quick_links($html): array
    {
        $html = (string)$html;
        $links = [];
        $seen = [];

        if ($html === '') {
            return [];
        }

        if (preg_match_all('/<nav\b([^>]*)>(.*?)<\/nav>/is', $html, $navMatches, PREG_SET_ORDER)) {
            foreach ($navMatches as $navMatch) {
                if (!preg_match_all('/<a\b([^>]*)>(.*?)<\/a>/is', $navMatch[2] ?? '', $anchorMatches, PREG_SET_ORDER)) {
                    continue;
                }

                foreach ($anchorMatches as $anchorMatch) {
                    $anchorAttrs = $anchorMatch[1] ?? '';
                    if (!preg_match('/\bhref\s*=\s*(["\'])(.*?)\1/i', $anchorAttrs, $hrefMatch)) {
                        continue;
                    }

                    $href = html_entity_decode(trim((string)$hrefMatch[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    if ($href === '' || $href[0] !== '#') {
                        continue;
                    }

                    $label = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string)$anchorMatch[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
                    if ($label === '' || isset($seen[$href])) {
                        continue;
                    }

                    $seen[$href] = true;
                    $links[] = [
                        'name' => $label,
                        'url' => $href,
                        'is_page_link' => true,
                    ];

                    if (count($links) >= 10) {
                        break 2;
                    }
                }
            }
        }

        return $links;
    }
}

$rcMenuGroups = [];
if (!empty($menus)) {
    foreach ($menus as $categoryId => $items) {
        $categoryName = strtolower((string)($menuCategories[$categoryId]['name'] ?? ''));
        $categoryKey = strtolower((string)($menuCategories[$categoryId]['id'] ?? $categoryName));
        $normalized = preg_replace('/[^a-z0-9]+/', '', $categoryKey . ' ' . $categoryName);
        $rcMenuGroups[] = [
            'normalized' => $normalized,
            'items' => $items,
        ];
    }
}

$rcGetMenuItemsByNeedles = static function(array $groups, array $needles): array {
    foreach ($groups as $group) {
        foreach ($needles as $needle) {
            if (strpos($group['normalized'], $needle) !== false) {
                return $group['items'];
            }
        }
    }
    return [];
};

$newsMenuItems = $rcGetMenuItemsByNeedles($rcMenuGroups, ['latestnews', 'news']);
$accountMenuItems = $rcGetMenuItemsByNeedles($rcMenuGroups, ['account']);
$libraryMenuItems = $rcGetMenuItemsByNeedles($rcMenuGroups, ['library']);
$libraryHiddenLinks = [
    'creatures',
    'spells',
    'commands',
    'gallery',
    'experiencetable',
];
$libraryMenuItems = array_values(array_filter($libraryMenuItems, static function(array $item) use ($libraryHiddenLinks): bool {
    $link = strtolower(trim((string)($item['link'] ?? '')));

    if ($link === '') {
        $linkFull = (string)($item['link_full'] ?? '');
        $query = parse_url($linkFull, PHP_URL_QUERY);
        if (is_string($query)) {
            parse_str($query, $queryParts);
            $link = strtolower(trim((string)($queryParts['subtopic'] ?? '')));
        }
    }

    return !in_array($link, $libraryHiddenLinks, true);
}));
foreach ($libraryMenuItems as &$libraryMenuItem) {
    $itemLink = strtolower(trim((string)($libraryMenuItem['link'] ?? '')));
    $itemLinkFull = strtolower((string)($libraryMenuItem['link_full'] ?? ''));
    if ($itemLink === 'viployalt' || strpos($itemLinkFull, 'subtopic=viployalt') !== false) {
        $libraryMenuItem['name'] = 'VIP & Loyalty';
    }
}
unset($libraryMenuItem);

$hasVipLoyalt = false;
foreach ($libraryMenuItems as $item) {
    $itemLink = strtolower(trim((string)($item['link'] ?? '')));
    $itemLinkFull = strtolower((string)($item['link_full'] ?? ''));
    if ($itemLink === 'viployalt' || strpos($itemLinkFull, 'subtopic=viployalt') !== false) {
        $hasVipLoyalt = true;
        break;
    }
}

if (!$hasVipLoyalt) {
    array_unshift($libraryMenuItems, [
        'name' => 'VIP & Loyalty',
        'link' => 'viployalt',
        'link_full' => BASE_URL . '?subtopic=viployalt',
        'blank' => false,
        'color' => '',
    ]);
}

$charBazaarMenuItems = $rcGetMenuItemsByNeedles($rcMenuGroups, ['charbazaar', 'charactertrade', 'charactertrades', 'bazaar']);
if (count($charBazaarMenuItems) < 2) {
    $charBazaarMenuItems = [
        ['name' => 'Current Bazaar', 'link_full' => BASE_URL . '?subtopic=currentcharactertrades', 'blank' => false],
        ['name' => 'Create Auction', 'link_full' => BASE_URL . '?subtopic=createcharacterauction', 'blank' => false],
        ['name' => 'Own Trades', 'link_full' => BASE_URL . '?subtopic=owncharactertrades', 'blank' => false],
        ['name' => 'Own Bids', 'link_full' => BASE_URL . '?subtopic=ownbids', 'blank' => false],
        ['name' => 'Past Trades', 'link_full' => BASE_URL . '?subtopic=pastcharactertrades', 'blank' => false],
    ];
}
$donateMenuItems = $rcGetMenuItemsByNeedles($rcMenuGroups, ['donate', 'shop']);
$systemMenuItems = [
    ['name' => 'Drops Important', 'link_full' => BASE_URL . '?subtopic=dropsimportant', 'blank' => false],
    ['name' => 'Box System', 'link_full' => BASE_URL . '?subtopic=boxsystem', 'blank' => false],
    ['name' => 'Roulette System', 'link_full' => BASE_URL . '?subtopic=roulettesystem', 'blank' => false],
    ['name' => 'Reflect Potion', 'link_full' => BASE_URL . '?subtopic=reflectpotion', 'blank' => false],
    ['name' => 'Exercise Weapons', 'link_full' => BASE_URL . '?subtopic=exerciseweapons', 'blank' => false],
    ['name' => 'Boss Finder', 'link_full' => BASE_URL . '?subtopic=bossfinder', 'blank' => false],
    ['name' => 'Hunt Finder', 'link_full' => BASE_URL . '?subtopic=huntfinder', 'blank' => false],
    ['name' => 'Tier System', 'link_full' => BASE_URL . '?subtopic=tiersystem', 'blank' => false],
    ['name' => 'Upgrade System', 'link_full' => BASE_URL . '?subtopic=upgradesystem', 'blank' => false],
    ['name' => 'Skill Gem System', 'link_full' => BASE_URL . '?subtopic=skillgemsystem', 'blank' => false],
    ['name' => 'Taskfinder', 'link_full' => BASE_URL . '?subtopic=supremetasks', 'blank' => false],
    ['name' => 'Addon&Mount Bonuses', 'link_full' => BASE_URL . '?subtopic=addonmountbonuses', 'blank' => false],
    ['name' => "Elemental's Stones Bonuses", 'link_full' => BASE_URL . '?subtopic=elementalstonesbonuses', 'blank' => false],
];

$serverName = $config['lua']['serverName'] ?? 'RavynCore';
$serverTagline = rc_t('Domine, Conquiste, Seja Lendário');
$headerSubtitle = rc_t('Custom Map');
$pageTitle = rc_t(!empty($title) ? $title : ucfirst((string)PAGE));
$rc2PageTitleOverrides = [
    'supremetasks' => 'Taskfinder',
    'viployalt' => 'VIP & Loyalty',
];
if (isset($rc2PageTitleOverrides[(string)PAGE])) {
    $pageTitle = $rc2PageTitleOverrides[(string)PAGE];
}
$launchTexts = [
    'pt-br' => [
        'eyebrow' => 'A contagem começou',
        'title' => 'Lançamento Oficial',
        'date' => '13 de junho de 2026, às 19:00',
        'timezone' => 'Horário de Brasília',
        'countdown' => 'Prepare-se. Sua jornada começa em:',
        'aria' => 'Contagem regressiva para o lançamento do RavynCore',
        'days' => 'Dias',
        'hours' => 'Horas',
        'minutes' => 'Minutos',
        'seconds' => 'Segundos',
        'live' => 'RavynCore está online. Sua jornada começa agora!',
    ],
    'en' => [
        'eyebrow' => 'The countdown has begun',
        'title' => 'Official Launch',
        'date' => 'June 13, 2026, at 7:00 PM',
        'timezone' => 'Brasília Time',
        'countdown' => 'Get ready. Your journey begins in:',
        'aria' => 'Countdown to the RavynCore launch',
        'days' => 'Days',
        'hours' => 'Hours',
        'minutes' => 'Minutes',
        'seconds' => 'Seconds',
        'live' => 'RavynCore is online. Your journey begins now!',
    ],
    'es' => [
        'eyebrow' => 'La cuenta regresiva comenzó',
        'title' => 'Lanzamiento Oficial',
        'date' => '13 de junio de 2026, a las 19:00',
        'timezone' => 'Horario de Brasilia',
        'countdown' => 'Prepárate. Tu aventura comienza en:',
        'aria' => 'Cuenta regresiva para el lanzamiento de RavynCore',
        'days' => 'Días',
        'hours' => 'Horas',
        'minutes' => 'Minutos',
        'seconds' => 'Segundos',
        'live' => 'RavynCore está online. ¡Tu aventura comienza ahora!',
    ],
];
$launchText = $launchTexts[$rcCurrentLang] ?? $launchTexts['pt-br'];

$brandDir = $template_path . '/images/brand';
$brandLogoPreferred = $brandDir . '/ravyncore-logo.png';
$brandBackgroundPreferred = $brandDir . '/ravyncore-background.png';
$brandBackgroundLegacy = $brandDir . '/ravyncore-background.jpg';
$brandSloganPreferred = $brandDir . '/sloganRC.png';

$logoFile = $config['logo_image'] ?? 'tibia-logo-artwork-top.gif';
$logoPath = $template_path . '/images/header/' . $logoFile;
if (file_exists(BASE . $brandLogoPreferred)) {
    $logoPath = $brandLogoPreferred;
}

if (!file_exists(BASE . $logoPath)) {
    $logoPath = $template_path . '/images/header/tibia-logo-artwork-top.gif';
}

$hasBrandBackground = file_exists(BASE . $brandBackgroundPreferred) || file_exists(BASE . $brandBackgroundLegacy);

$backgroundFile = $template_path . '/images/header/bgs/12.jpg';
if (file_exists(BASE . $brandBackgroundPreferred)) {
    $backgroundFile = $brandBackgroundPreferred;
} elseif (file_exists(BASE . $brandBackgroundLegacy)) {
    $backgroundFile = $brandBackgroundLegacy;
}

$configuredBackground = $config['background_image'] ?? '';
if (!$hasBrandBackground && !empty($configuredBackground)) {
    $candidate = $template_path . '/images/header/' . $configuredBackground;
    if (file_exists(BASE . $candidate)) {
        $backgroundFile = $candidate;
    }
}

$backgroundUrl = BASE_URL . ltrim($backgroundFile, '/');

$hasBrandSlogan = file_exists(BASE . $brandSloganPreferred);

$playersOnline = (int)($status['players'] ?? 0);
$playersMax = (int)($status['playersMax'] ?? 0);
$playersMaxSafe = max(1, $playersMax);
$onlinePercent = min(100, max(0, round(($playersOnline / $playersMaxSafe) * 100, 1)));

$serverSave = configLua('globalServerSaveTime') ?? '05:00:00';
if (!preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $serverSave)) {
    $serverSave = '05:00:00';
}

$serverSaveParts = explode(':', $serverSave);
$serverSaveDate = new DateTime();
$serverSaveDate->setTime((int)$serverSaveParts[0], (int)$serverSaveParts[1], (int)$serverSaveParts[2]);
$nowDate = new DateTime();
if ($serverSaveDate <= $nowDate) {
    $serverSaveDate->modify('+1 day');
}

$topPlayers = getTopPlayers(5);
foreach ($topPlayers as &$player) {
    $vocationName = $config['vocations'][$player['vocation']] ?? 'Adventurer';
    $player['vocation_name'] = $vocationName;
    $player['vocation_icon'] = rc_vocation_icon($vocationName);
    $player['outfit_html'] = '';
    if (!empty($config['online_outfit'])) {
        $lookAddons = isset($player['lookaddons']) ? (int)$player['lookaddons'] : 0;
        $outfitUrl = getAssetImageById('outfit', (int)$player['looktype'], [
            'addons' => $lookAddons,
            'head' => (int)$player['lookhead'],
            'body' => (int)$player['lookbody'],
            'legs' => (int)$player['looklegs'],
            'feet' => (int)$player['lookfeet'],
            'direction' => 3,
        ]);
        $player['outfit_html'] = '<img class="rc-rank-outfit" src="' . htmlspecialchars($outfitUrl, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($player['name'] . ' outfit', ENT_QUOTES, 'UTF-8') . '">';
    }
}
unset($player);

$quickLinks = [
    ['name' => 'Latest News', 'url' => $rcBuildPageUrl('news')],
    ['name' => 'Create Account', 'url' => $rcBuildPageUrl('createaccount')],
    ['name' => 'Highscores', 'url' => $rcBuildPageUrl('highscores')],
    ['name' => 'Guilds', 'url' => $rcBuildPageUrl('guilds')],
    ['name' => 'Server Info', 'url' => $rcBuildPageUrl('serverinfo')],
];

$accountManageUrl = $templateLinks['link_account_manage'] ?? getLink('account/manage');
$accountCreateUrl = $templateLinks['link_account_create'] ?? getLink('account/create');
$accountLogoutUrl = $templateLinks['link_account_logout'] ?? getLink('account/logout');
$downloadUrl = $templateLinks['link_downloads'] ?? getLink('downloads');
$recordOnline = (int)($status['playersPeak'] ?? $status['playersRecord'] ?? $status['record'] ?? 0);
if ($recordOnline <= 0 && $db->hasTable('server_config')) {
    $recordOnlineDb = $db->query("SELECT `value` FROM `server_config` WHERE `config` = 'players_record' LIMIT 1")->fetchColumn();
    if ($recordOnlineDb !== false) {
        $recordOnline = (int)$recordOnlineDb;
    }
}
$isStaffAccount = rc_is_staff_web_flag3();
$openTicketsCount = 0;
if ($isStaffAccount) {
    if (!$db->hasTable('myaac_tickets')) {
        $db->query("
            CREATE TABLE IF NOT EXISTS `myaac_tickets` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `account_id` INT NOT NULL,
                `player_id` INT NULL,
                `character_name` VARCHAR(120) NOT NULL DEFAULT '',
                `title` VARCHAR(120) NOT NULL,
                `summary` VARCHAR(255) NOT NULL,
                `ticket_type` VARCHAR(20) NOT NULL DEFAULT 'bug',
                `description` TEXT NOT NULL,
                `status` VARCHAR(20) NOT NULL DEFAULT 'open',
                `staff_reply` TEXT NULL,
                `staff_account_id` INT NULL,
                `staff_updated_at` INT NULL,
                `created_at` INT NOT NULL,
                `updated_at` INT NOT NULL,
                PRIMARY KEY (`id`),
                KEY `idx_ticket_account` (`account_id`),
                KEY `idx_ticket_status` (`status`),
                KEY `idx_ticket_created` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }
    $openTicketsCount = (int)$db->query("SELECT COUNT(*) FROM `myaac_tickets` WHERE `status` = 'open'")->fetchColumn();
}
$staffActionsUrl = BASE_URL . '?subtopic=accountmanagement&action=staff_actions';
if ($isStaffAccount) {
    $quickLinks[] = ['name' => rc_t('Staff Actions') . ' (' . (int)$openTicketsCount . ')', 'url' => $staffActionsUrl];
}
$discordUrl = !empty($config['discord_link']) ? $config['discord_link'] : null;
$tiktokUrl = 'https://www.tiktok.com/@ravyncore_';
$facebookUrl = 'https://www.facebook.com/profile.php?id=61560518895177';
$instagramUrl = 'https://www.instagram.com/ravyncore_/';
$socialIconBase = $template_path . '/images/global/header';

$donateUrl = $donateMenuItems[0]['link_full'] ?? getLink('donate');
$rc2HeroDescription = 'RavynCore Servers is a modern MMORPG project focused on custom adventures, active community, exclusive systems, seasonal events and a nostalgic Tibia-inspired experience with constant evolution.';
$rc2CarouselImageBase = $template_path . '/images/carousel';
$rc2Banners = [
    [
        'image' => $rc2CarouselImageBase . '/merrygarb_small.jpg',
        'eyebrow' => 'Seasonal Event',
        'title' => 'Exclusive adventures',
        'text' => 'Follow promotions, outfits, events and announcements from RavynCore Servers.',
    ],
    [
        'image' => $rc2CarouselImageBase . '/mothcape_small.jpg',
        'eyebrow' => 'Custom Systems',
        'title' => 'Evolve your legend',
        'text' => 'Discover custom systems, bosses, progression paths and rewards.',
    ],
    [
        'image' => $rc2CarouselImageBase . '/runemaster_small.jpg',
        'eyebrow' => 'Community',
        'title' => 'Play together',
        'text' => 'Join events, updates and community moments across every season.',
    ],
];
$rc2Banners = array_values(array_filter($rc2Banners, static function(array $banner): bool {
    return !empty($banner['image']) && file_exists(BASE . $banner['image']);
}));
if (empty($rc2Banners)) {
    $rc2Banners[] = [
        'image' => $brandBackgroundPreferred,
        'eyebrow' => 'RavynCore Servers',
        'title' => 'Custom map',
        'text' => 'A premium dark fantasy MMORPG experience.',
    ];
}

$youtubeUrl = $config['youtube_link'] ?? 'https://www.youtube.com/@ravyncore';
$xUrl = $config['twitter_link'] ?? $config['x_link'] ?? null;
$rc2CommunityLinks = [
    ['name' => 'Discord', 'url' => $discordUrl, 'icon' => 'fab fa-discord', 'icon_path' => $socialIconBase . '/icon-discord.png'],
    ['name' => 'Instagram', 'url' => $instagramUrl, 'icon' => 'fab fa-instagram', 'icon_path' => $socialIconBase . '/icon-instagram.png'],
    ['name' => 'YouTube', 'url' => $youtubeUrl, 'icon' => 'fab fa-youtube', 'icon_path' => $socialIconBase . '/icon-youtube.png'],
    ['name' => 'TikTok', 'url' => $tiktokUrl, 'icon' => 'fab fa-tiktok', 'icon_path' => ''],
    ['name' => 'Facebook', 'url' => $facebookUrl ?: $xUrl, 'icon' => $facebookUrl ? 'fab fa-facebook-f' : 'fab fa-x-twitter', 'icon_path' => $facebookUrl ? $socialIconBase . '/icon-facebook.png' : ''],
];
$rc2LandingPages = ['news', 'latestnews', 'lastnews', ''];
$rc2IsLandingPage = in_array((string)PAGE, $rc2LandingPages, true);
$rc2PageQuickLinks = $rc2IsLandingPage ? [] : rc2_extract_page_quick_links((string)$content);
$rc2QuickLinksArePageLinks = !empty($rc2PageQuickLinks);
$rc2SidebarQuickLinks = $rc2QuickLinksArePageLinks ? $rc2PageQuickLinks : $quickLinks;
?>
<!doctype html>
<html lang="<?= escapeHtml($rcHtmlLang); ?>">
<head>
    <?= template_place_holder('head_start'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico">
    <link rel="stylesheet" href="tools/fonts/fontawesome/all.css">
    <?php $rcCssVer = @filemtime(BASE . $template_path . '/css/ravyncore.css') ?: time(); ?>
    <link rel="stylesheet" href="<?= $template_path; ?>/css/ravyncore.css?v=<?= $rcCssVer; ?>">
    <?php $rc2CssVer = @filemtime(BASE . $template_path . '/css/ravyncore2.css') ?: time(); ?>
    <link rel="stylesheet" href="<?= $template_path; ?>/css/ravyncore2.css?v=<?= $rc2CssVer; ?>">
    <script src="tools/basic.js"></script>
    <?php $rcTickerVer = @filemtime(BASE . $template_path . '/ticker.js') ?: time(); ?>
    <script src="<?= $template_path; ?>/ticker.js?v=<?= $rcTickerVer; ?>"></script>
    <script>var JS_DIR_IMAGES = "<?= $template_path; ?>/images/";</script>
    <?= template_place_holder('head_end'); ?>
</head>
<body class="rc-page rc-template-ravyncore2 rc-page-<?= escapeHtml((string)PAGE); ?>" data-rc-lang="<?= escapeHtml($rcCurrentLang); ?>" style="--rc-bg-image: url('<?= $backgroundUrl; ?>')">
<?= template_place_holder('body_start'); ?>

<div class="rc2-page-transition" aria-hidden="true">
    <span class="rc2-page-transition__panel rc2-page-transition__panel--left rc2-page-transition__panel--left-gold"></span>
    <span class="rc2-page-transition__panel rc2-page-transition__panel--left rc2-page-transition__panel--left-dark"></span>
    <span class="rc2-page-transition__panel rc2-page-transition__panel--left rc2-page-transition__panel--left-panel"></span>
    <span class="rc2-page-transition__panel rc2-page-transition__panel--right rc2-page-transition__panel--right-dark"></span>
    <span class="rc2-page-transition__panel rc2-page-transition__panel--right rc2-page-transition__panel--right-gold"></span>
    <span class="rc2-page-transition__panel rc2-page-transition__panel--right rc2-page-transition__panel--right-panel"></span>
</div>

<div class="rc-atmosphere"></div>
<div class="rc-site">
    <header class="rc-header">
        <div class="rc-header-inner">
            <a class="rc-header-brand rc2-header-brand" href="<?= getLink('news'); ?>">
                <?php if ($hasBrandSlogan): ?>
                    <img class="rc-header-wordmark rc-logo-wordmark rc2-header-wordmark" src="<?= $brandSloganPreferred; ?>" alt="RavynCore">
                <?php else: ?>
                    <strong class="rc-header-title">RavynCore</strong>
                <?php endif; ?>
                <span class="rc-header-subtitle"><?= escapeHtml($headerSubtitle); ?></span>
            </a>

            <nav id="rcNav" class="rc-nav" aria-label="Primary">
                <ul>
                    <?php
                    $rcTopNav = [
                        [
                            'label' => 'Latest News',
                            'items' => $newsMenuItems,
                            'fallback' => getLink('news'),
                        ],
                        [
                            'label' => 'Account',
                            'items' => $accountMenuItems,
                            'fallback' => $accountManageUrl,
                        ],
                        [
                            'label' => 'Library',
                            'items' => $libraryMenuItems,
                            'fallback' => getLink('faq'),
                        ],
                        [
                            'label' => 'System',
                            'items' => $systemMenuItems,
                            'fallback' => BASE_URL . '?subtopic=supremetasks',
                        ],
                        [
                            'label' => 'Char Baazar',
                            'items' => $charBazaarMenuItems,
                            'fallback' => getLink('currentcharactertrades'),
                        ],
                        [
                            'label' => 'Donate',
                            'items' => $donateMenuItems,
                            'fallback' => getLink('donate'),
                        ],
                    ];
                    ?>
                    <?php foreach ($rcTopNav as $navItem): ?>
                        <?php
                        $items = $navItem['items'] ?? [];
                        $firstItem = $items[0] ?? null;
                        $categoryLink = $firstItem['link_full'] ?? $navItem['fallback'];
                        $showDropdown = count($items) > 1;
                        ?>
                        <li class="rc-nav-item">
                            <a href="<?= $categoryLink; ?>"><?= escapeHtml(rc_t($navItem['label'])); ?></a>
                            <?php if ($showDropdown): ?>
                                <div class="rc-nav-dropdown">
                                    <?php foreach ($items as $item): ?>
                                        <a href="<?= $item['link_full']; ?>"<?= $item['blank'] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                            <?= escapeHtml(rc_t($item['name'])); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="rc-nav-mobile-actions">
                    <?php if ($logged): ?>
                        <a class="rc-btn rc-btn-play" href="<?= $accountManageUrl; ?>">
                            <i class="fas fa-user"></i><span><?= escapeHtml(rc_t('My Account')); ?></span>
                        </a>
                        <div class="rc-nav-mobile-language rc-language-switcher" aria-label="<?= escapeHtml(rc_t('Languages')); ?>">
                            <?php foreach ($rcSupportedLanguages as $languageCode => $language): ?>
                                <a class="rc-language-option<?= $languageCode === $rcCurrentLang ? ' is-active' : ''; ?>"
                                   href="<?= escapeHtml(rc_lang_url($languageCode)); ?>"
                                   title="<?= escapeHtml($language['label']); ?>"
                                   aria-label="<?= escapeHtml($language['label']); ?>">
                                    <img src="<?= $language['flag']; ?>" alt="<?= escapeHtml($language['short']); ?>">
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <a class="rc-btn rc-btn-danger" href="<?= $accountLogoutUrl; ?>">
                            <i class="fas fa-right-from-bracket"></i><span><?= escapeHtml(rc_t('Logout')); ?></span>
                        </a>
                    <?php else: ?>
                        <a class="rc-btn rc-btn-play" href="<?= $accountManageUrl; ?>">
                            <i class="fas fa-right-to-bracket"></i><span><?= escapeHtml(rc_t('Login')); ?></span>
                        </a>
                        <div class="rc-nav-mobile-language rc-language-switcher" aria-label="<?= escapeHtml(rc_t('Languages')); ?>">
                            <?php foreach ($rcSupportedLanguages as $languageCode => $language): ?>
                                <a class="rc-language-option<?= $languageCode === $rcCurrentLang ? ' is-active' : ''; ?>"
                                   href="<?= escapeHtml(rc_lang_url($languageCode)); ?>"
                                   title="<?= escapeHtml($language['label']); ?>"
                                   aria-label="<?= escapeHtml($language['label']); ?>">
                                    <img src="<?= $language['flag']; ?>" alt="<?= escapeHtml($language['short']); ?>">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="rc-header-actions">
                <?php if ($logged): ?>
                    <a class="rc-btn rc-btn-ghost rc-btn-sm" href="<?= $accountManageUrl; ?>"><?= escapeHtml(rc_t('My Account')); ?></a>
                    <div class="rc-header-language rc-language-switcher" aria-label="<?= escapeHtml(rc_t('Languages')); ?>">
                        <?php foreach ($rcSupportedLanguages as $languageCode => $language): ?>
                            <a class="rc-language-option<?= $languageCode === $rcCurrentLang ? ' is-active' : ''; ?>"
                               href="<?= escapeHtml(rc_lang_url($languageCode)); ?>"
                               title="<?= escapeHtml($language['label']); ?>"
                               aria-label="<?= escapeHtml($language['label']); ?>">
                                <img src="<?= $language['flag']; ?>" alt="<?= escapeHtml($language['short']); ?>">
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <a class="rc-btn rc-btn-violet rc-btn-sm" href="<?= $accountLogoutUrl; ?>">
                        <i class="fas fa-right-from-bracket"></i><span><?= escapeHtml(rc_t('Logout')); ?></span>
                    </a>
                <?php else: ?>
                    <a class="rc-btn rc-btn-ghost rc-btn-sm" href="<?= $accountManageUrl; ?>"><?= escapeHtml(rc_t('Login')); ?></a>
                    <div class="rc-header-language rc-language-switcher" aria-label="<?= escapeHtml(rc_t('Languages')); ?>">
                        <?php foreach ($rcSupportedLanguages as $languageCode => $language): ?>
                            <a class="rc-language-option<?= $languageCode === $rcCurrentLang ? ' is-active' : ''; ?>"
                               href="<?= escapeHtml(rc_lang_url($languageCode)); ?>"
                               title="<?= escapeHtml($language['label']); ?>"
                               aria-label="<?= escapeHtml($language['label']); ?>">
                                <img src="<?= $language['flag']; ?>" alt="<?= escapeHtml($language['short']); ?>">
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <button id="rcNavToggle" class="rc-nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="rcNav">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <?php if ($rc2IsLandingPage): ?>
        <section class="rc2-hero" aria-label="RavynCore Servers">
            <div class="rc2-hero__backdrop" aria-hidden="true"></div>
            <div class="rc2-hero__inner">
                <div class="rc2-hero__copy">
                    <h1>
                        <span>WELCOME TO RAVYNCORE</span>
                        <span>SERVERS</span>
                    </h1>
                    <p class="rc2-hero__description"><?= escapeHtml($rc2HeroDescription); ?></p>
                    <div class="rc2-hero__actions" aria-label="Main actions">
                        <a class="rc-btn rc-btn-ghost rc-btn-lg rc2-btn-login" href="<?= $accountManageUrl; ?>">
                            <i class="fas fa-right-to-bracket"></i><span>LOGIN</span>
                        </a>
                        <a class="rc-btn rc-btn-play rc-btn-lg rc2-btn-donate" href="<?= $donateUrl; ?>">
                            <i class="fas fa-coins"></i><span>DONATE</span>
                        </a>
                    </div>
                </div>

                <div class="rc2-hero__media">
                    <a class="rc-btn rc-btn-lg rc2-btn-create" href="<?= $accountCreateUrl; ?>">
                        <i class="fas fa-user-plus"></i><span>CREATE ACCOUNT</span>
                    </a>

                    <div class="rc2-carousel" data-rc2-carousel data-interval="5600" aria-label="RavynCore promotional banners">
                        <div class="rc2-carousel__viewport">
                            <?php foreach ($rc2Banners as $bannerIndex => $banner): ?>
                                <article class="rc2-carousel__slide<?= $bannerIndex === 0 ? ' is-active' : ''; ?>" data-rc2-slide>
                                    <img src="<?= $banner['image']; ?>" alt="<?= escapeHtml($banner['title']); ?>">
                                    <div class="rc2-carousel__caption">
                                        <span><?= escapeHtml($banner['eyebrow']); ?></span>
                                        <strong><?= escapeHtml($banner['title']); ?></strong>
                                        <p><?= escapeHtml($banner['text']); ?></p>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                        <button class="rc2-carousel__nav rc2-carousel__nav--prev" type="button" data-rc2-carousel-prev aria-label="Previous banner">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="rc2-carousel__nav rc2-carousel__nav--next" type="button" data-rc2-carousel-next aria-label="Next banner">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <div class="rc2-carousel__dots" data-rc2-carousel-dots aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="rc2-page-heading" aria-label="<?= escapeHtml($pageTitle); ?>">
            <span>RavynCore Servers</span>
            <h1><?= escapeHtml($pageTitle); ?></h1>
        </section>
    <?php endif; ?>

    <?php if ($rc2IsLandingPage): ?>
        <section id="rcSocialLinks" class="rc2-community" aria-label="RavynCore community">
            <div class="rc2-section-heading">
                <span>RavynCore Servers</span>
                <h2>COMMUNITY</h2>
            </div>
            <div class="rc2-community-grid">
                <?php foreach ($rc2CommunityLinks as $community): ?>
                    <?php $isCommunityEnabled = !empty($community['url']); ?>
                    <?php if ($isCommunityEnabled): ?>
                    <a class="rc2-community-card" href="<?= escapeHtml($community['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= escapeHtml($community['name']); ?>">
                    <?php else: ?>
                    <span class="rc2-community-card is-disabled" aria-label="<?= escapeHtml($community['name']); ?>">
                    <?php endif; ?>
                        <span class="rc2-community-card__icon">
                            <?php if (!empty($community['icon_path']) && file_exists(BASE . $community['icon_path'])): ?>
                                <img src="<?= $community['icon_path']; ?>" alt="">
                            <?php else: ?>
                                <i class="<?= escapeHtml($community['icon']); ?>"></i>
                            <?php endif; ?>
                        </span>
                        <strong><?= escapeHtml($community['name']); ?></strong>
                    <?php if ($isCommunityEnabled): ?>
                    </a>
                    <?php else: ?>
                    </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($rc2IsLandingPage): ?>
        <section id="rcLaunchCountdown"
                 class="rc-launch-countdown rc2-launch-banner is-intro-standby"
                 data-target="2026-06-13T19:00:00-03:00"
                 data-live-text="<?= escapeHtml($launchText['live']); ?>"
                 data-rc-launch-banner
                 data-intro-key="ravyncore2-launch-banner-intro-2026-06-13">
            <div class="rc2-launch-banner__roll" aria-hidden="true"></div>
            <div class="rc2-launch-banner__arrows" aria-hidden="true">
                <span class="rc2-arrow-impact rc2-arrow-impact--one"></span>
                <span class="rc2-arrow-impact rc2-arrow-impact--two"></span>
                <span class="rc2-arrow-impact rc2-arrow-impact--three"></span>
                <span class="rc2-arrow-impact rc2-arrow-impact--flag"></span>
            </div>
            <div class="rc2-launch-date-flag" aria-hidden="true">
                <span>June 13, 2026, at 7:00 PM | Brasília Time</span>
            </div>
            <div class="rc-launch-countdown__inner">
                <div class="rc-launch-countdown__copy">
                    <span class="rc-launch-countdown__eyebrow"><?= escapeHtml($launchText['eyebrow']); ?></span>
                    <h2><?= escapeHtml($launchText['title']); ?></h2>
                    <p class="rc-launch-countdown__date">
                        <strong><?= escapeHtml($launchText['date']); ?></strong>
                        <span><?= escapeHtml($launchText['timezone']); ?></span>
                    </p>
                </div>
                <div class="rc-launch-countdown__timer">
                    <p class="rc-launch-countdown__status" data-rc-launch-status aria-live="polite"><?= escapeHtml($launchText['countdown']); ?></p>
                    <div class="rc-launch-countdown__units"
                         role="timer"
                         aria-label="<?= escapeHtml($launchText['aria']); ?>">
                        <div class="rc-launch-countdown__unit">
                            <strong data-rc-launch-days>00</strong>
                            <span><?= escapeHtml($launchText['days']); ?></span>
                        </div>
                        <div class="rc-launch-countdown__unit">
                            <strong data-rc-launch-hours>00</strong>
                            <span><?= escapeHtml($launchText['hours']); ?></span>
                        </div>
                        <div class="rc-launch-countdown__unit">
                            <strong data-rc-launch-minutes>00</strong>
                            <span><?= escapeHtml($launchText['minutes']); ?></span>
                        </div>
                        <div class="rc-launch-countdown__unit">
                            <strong data-rc-launch-seconds>00</strong>
                            <span><?= escapeHtml($launchText['seconds']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <main id="rcMain" class="rc-main-grid">
        <aside class="rc-sidebar">
            <section class="rc-panel">
                <h3><?= escapeHtml(rc_t('Server Status')); ?></h3>
                <div class="rc-status-line">
                    <span><?= escapeHtml(rc_t('State')); ?></span>
                    <strong class="<?= !empty($status['online']) ? 'is-online' : 'is-offline'; ?>">
                        <?= escapeHtml(rc_t(!empty($status['online']) ? 'Online' : 'Offline')); ?>
                    </strong>
                </div>
                <div class="rc-status-line">
                    <span><?= escapeHtml(rc_t('Players')); ?></span>
                    <strong><?= $playersOnline; ?></strong>
                </div>
                <div class="rc-status-line">
                    <span><?= escapeHtml(rc_t('Record Online')); ?></span>
                    <strong><?= $recordOnline; ?></strong>
                </div>
            </section>

            <section class="rc-panel rc-quick-panel<?= $rc2QuickLinksArePageLinks ? ' is-page-quick-links' : ''; ?>">
                <h3><?= escapeHtml(rc_t('Quick Links')); ?></h3>
                <ul class="rc-links rc-page-quick-links" data-rc-page-quick-links>
                    <?php foreach ($rc2SidebarQuickLinks as $link): ?>
                        <?php
                        $isPageQuickLink = !empty($link['is_page_link']);
                        $quickLinkLabel = $isPageQuickLink ? (string)$link['name'] : rc_t($link['name']);
                        ?>
                        <li>
                            <a href="<?= escapeHtml($link['url']); ?>"<?= $isPageQuickLink ? ' class="js-rc-page-anchor"' : ''; ?>><?= escapeHtml($quickLinkLabel); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>

        </aside>

        <section class="rc-content-column">
            <?php if ($rc2IsLandingPage): ?>
                <section class="rc-panel rc-panel-news">
                    <h3><?= escapeHtml(rc_t('Latest News')); ?></h3>
                    <div class="rc-panel-body">
                        <?= tickers(); ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="rc-panel rc-panel-content">
                <h3><?= escapeHtml($pageTitle); ?></h3>
                <div class="rc-panel-body rc-rich-content">
                    <?php $hooks->trigger(HOOK_TIBIACOM_BORDER_3); ?>
                    <?php
                    $rc2MainContentHtml = template_place_holder('center_top') . $content;
                    if (function_exists('rc_translate_html')) {
                        $rc2MainContentHtml = rc_translate_html($rc2MainContentHtml);
                    }
                    if ((string)PAGE === 'supremetasks') {
                        $rc2MainContentHtml = str_replace(['Supreme Tasks', 'Supreme tasks'], 'Taskfinder', $rc2MainContentHtml);
                    }
                    ?>
                    <?= $rc2MainContentHtml; ?>
                </div>
            </section>
        </section>

        <aside class="rc-sidebar">
            <section class="rc-panel">
                <h3><?= escapeHtml(rc_t('Top Players')); ?></h3>
                <div class="rc-ranking">
                    <?php foreach ($topPlayers as $player): ?>
                        <a class="rc-rank-row" href="<?= getPlayerLink($player['name'], false); ?>" aria-label="<?= escapeHtml(rc_t('View') . ' ' . $player['name']); ?>">
                            <span class="rc-rank-position">#<?= (int)$player['rank']; ?></span>
                            <?php if (!empty($player['outfit_html'])): ?>
                                <?= $player['outfit_html']; ?>
                            <?php else: ?>
                                <img class="rc-rank-outfit" src="<?= $player['vocation_icon']; ?>" alt="<?= escapeHtml($player['vocation_name']); ?>">
                            <?php endif; ?>
                            <div class="rc-rank-player">
                                <strong><?= escapeHtml($player['name']); ?></strong>
                                <small><?= escapeHtml(rc_t('Level')); ?> <?= (int)$player['level']; ?> - <?= escapeHtml($player['vocation_name']); ?></small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <a class="rc-btn rc-btn-subtle rc-btn-block" href="<?= escapeHtml($rcBuildPageUrl('highscores')); ?>"><?= escapeHtml(rc_t('Full Ranking')); ?></a>
            </section>

            <section class="rc-panel">
                <h3><?= escapeHtml(rc_t('Search Character')); ?></h3>
                <form method="post" action="<?= getLink('characters'); ?>" class="rc-search-form">
                    <input type="text" name="name" maxlength="29" placeholder="<?= escapeHtml(rc_t('Character name')); ?>" pattern="[A-Za-z\s]+" title="<?= escapeHtml(rc_t('Use only letters and spaces')); ?>" data-rc-letters-only>
                    <button type="submit" class="rc-btn rc-btn-subtle rc-btn-block"><?= escapeHtml(rc_t('Search')); ?></button>
                </form>
            </section>
        </aside>
    </main>

    <footer class="rc-footer">
        <div class="rc-footer-top">
            <a class="rc-footer-brand" href="<?= getLink('news'); ?>">
                <div class="rc-footer-brand-text rc-logo-text">
                    <?php if ($hasBrandSlogan): ?>
                        <img class="rc-footer-wordmark rc-logo-wordmark" src="<?= $brandSloganPreferred; ?>" alt="RavynCore">
                    <?php else: ?>
                        <strong>RavynCore</strong>
                    <?php endif; ?>
                    <span class="rc-footer-subtitle"><?= escapeHtml($headerSubtitle); ?></span>
                </div>
            </a>
        </div>
        <div class="rc-footer-bottom">
            <span>&copy; <?= date('Y'); ?> RavynCore. <?= escapeHtml(rc_t('All rights reserved.')); ?></span>
        </div>
    </footer>
</div>

<div id="HelperDivContainer" class="rc-helper-div">
    <div class="HelperDivArrow"></div>
    <div id="HelperDivHeadline"></div>
    <div id="HelperDivText"></div>
</div>

<?php $rcGenericJsVer = @filemtime(BASE . $template_path . '/js/generic.js') ?: time(); ?>
<script src="<?= $template_path; ?>/js/generic.js?v=<?= $rcGenericJsVer; ?>"></script>
<?php $rcJsVer = @filemtime(BASE . $template_path . '/js/ravyncore.js') ?: time(); ?>
<script src="<?= $template_path; ?>/js/ravyncore.js?v=<?= $rcJsVer; ?>"></script>
<?php $rc2JsVer = @filemtime(BASE . $template_path . '/js/ravyncore2.js') ?: time(); ?>
<script src="<?= $template_path; ?>/js/ravyncore2.js?v=<?= $rc2JsVer; ?>"></script>
<?= template_place_holder('body_end'); ?>
</body>
</html>
