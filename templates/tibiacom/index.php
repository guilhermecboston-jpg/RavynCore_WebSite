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

$menuCategories = config('menu_categories') ?: [];
$menus = get_template_menus();
$templateLinks = isset($template) && is_array($template) ? $template : [];

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
    ['name' => 'Supreme Tasks', 'link_full' => BASE_URL . '?subtopic=supremetasks', 'blank' => false],
    ['name' => 'Addon&Mount Bonuses', 'link_full' => BASE_URL . '?subtopic=addonmountbonuses', 'blank' => false],
    ['name' => "Elemental's Stones Bonuses", 'link_full' => BASE_URL . '?subtopic=elementalstonesbonuses', 'blank' => false],
    ['name' => "Loyalt's Bonuses", 'link_full' => BASE_URL . '?subtopic=loyaltbonuses', 'blank' => false],
];

$serverName = $config['lua']['serverName'] ?? 'RavynCore';
$serverTagline = 'Domine, Conquiste, Seja Lendario';
$headerSubtitle = 'Custom Map';
$pageTitle = !empty($title) ? $title : ucfirst((string)PAGE);

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
            'direction' => 2,
        ]);
        $player['outfit_html'] = '<img class="rc-rank-outfit" src="' . htmlspecialchars($outfitUrl, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($player['name'] . ' outfit', ENT_QUOTES, 'UTF-8') . '">';
    }
}
unset($player);

$quickLinks = [
    ['name' => 'Latest News', 'url' => $templateLinks['link_news'] ?? getLink('news')],
    ['name' => 'Create Account', 'url' => $templateLinks['link_account_create'] ?? getLink('account/create')],
    ['name' => 'Highscores', 'url' => $templateLinks['link_highscores'] ?? getLink('highscores')],
    ['name' => 'Guilds', 'url' => $templateLinks['link_guilds'] ?? getLink('guilds')],
    ['name' => 'Server Info', 'url' => $templateLinks['link_serverInfo'] ?? getLink('serverInfo')],
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
    $quickLinks[] = ['name' => 'Staff Actions (' . (int)$openTicketsCount . ')', 'url' => $staffActionsUrl];
}
$discordUrl = !empty($config['discord_link']) ? $config['discord_link'] : null;
$tiktokUrl = 'https://www.tiktok.com/@ravyncore_';
$whatsappUrl = 'https://chat.whatsapp.com/D1D7BPj6I7l5tN2QzSSPmQ';
$facebookUrl = 'https://www.facebook.com/profile.php?id=61560518895177';
$instagramUrl = 'https://www.instagram.com/ravyncore_/';
$socialIconBase = $template_path . '/images/social';
$socialLinks = [
    ['name' => 'Discord', 'url' => $discordUrl, 'icon' => 'fab fa-discord', 'icon_path' => $socialIconBase . '/discord.png', 'tooltip' => 'Join the RavynCore Discord community.'],
    ['name' => 'WhatsApp', 'url' => $whatsappUrl, 'icon' => 'fab fa-whatsapp', 'icon_path' => $socialIconBase . '/whatsapp.png', 'tooltip' => 'Join the official RavynCore WhatsApp group.'],
    ['name' => 'Instagram', 'url' => $instagramUrl, 'icon' => 'fab fa-instagram', 'icon_path' => $socialIconBase . '/instagram.png', 'tooltip' => 'Follow RavynCore on Instagram.'],
    ['name' => 'TikTok', 'url' => $tiktokUrl, 'icon' => 'fab fa-tiktok', 'icon_path' => $socialIconBase . '/tiktok.png', 'tooltip' => 'Watch RavynCore videos on TikTok.'],
    ['name' => 'Facebook', 'url' => $facebookUrl, 'icon' => 'fab fa-facebook-f', 'icon_path' => $socialIconBase . '/facebook.png', 'tooltip' => 'Follow RavynCore updates on Facebook.'],
];
?>
<!doctype html>
<html lang="en">
<head>
    <?= template_place_holder('head_start'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico">
    <link rel="stylesheet" href="tools/fonts/fontawesome/all.css">
    <?php $rcCssVer = @filemtime(BASE . $template_path . '/css/ravyncore.css') ?: time(); ?>
    <link rel="stylesheet" href="<?= $template_path; ?>/css/ravyncore.css?v=<?= $rcCssVer; ?>">
    <script src="tools/basic.js"></script>
    <?php $rcTickerVer = @filemtime(BASE . $template_path . '/ticker.js') ?: time(); ?>
    <script src="<?= $template_path; ?>/ticker.js?v=<?= $rcTickerVer; ?>"></script>
    <script>var JS_DIR_IMAGES = "<?= $template_path; ?>/images/";</script>
    <?= template_place_holder('head_end'); ?>
</head>
<body class="rc-page rc-page-<?= escapeHtml((string)PAGE); ?>" style="--rc-bg-image: url('<?= $backgroundUrl; ?>')">
<?= template_place_holder('body_start'); ?>

<div class="rc-atmosphere"></div>
<div class="rc-site">
    <header class="rc-header">
        <div class="rc-header-inner">
            <a class="rc-header-brand" href="<?= getLink('news'); ?>">
                <?php if ($hasBrandSlogan): ?>
                    <img class="rc-header-wordmark" src="<?= $brandSloganPreferred; ?>" alt="RavynCore">
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
                            <a href="<?= $categoryLink; ?>"><?= escapeHtml($navItem['label']); ?></a>
                            <?php if ($showDropdown): ?>
                                <div class="rc-nav-dropdown">
                                    <?php foreach ($items as $item): ?>
                                        <a href="<?= $item['link_full']; ?>"<?= $item['blank'] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                            <?= escapeHtml($item['name']); ?>
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
                            <i class="fas fa-user"></i><span>My Account</span>
                        </a>
                        <a class="rc-btn rc-btn-danger" href="<?= $accountLogoutUrl; ?>">
                            <i class="fas fa-right-from-bracket"></i><span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a class="rc-btn rc-btn-play" href="<?= $accountManageUrl; ?>">
                            <i class="fas fa-right-to-bracket"></i><span>Login</span>
                        </a>
                        <a class="rc-btn rc-btn-violet" href="<?= $accountCreateUrl; ?>">
                            <i class="fas fa-user-plus"></i><span>Create Account</span>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="rc-header-actions">
                <?php if ($logged): ?>
                    <a class="rc-btn rc-btn-ghost rc-btn-sm" href="<?= $accountManageUrl; ?>">My Account</a>
                    <a class="rc-btn rc-btn-violet rc-btn-sm" href="<?= $accountLogoutUrl; ?>">
                        <i class="fas fa-right-from-bracket"></i><span>Logout</span>
                    </a>
                <?php else: ?>
                    <a class="rc-btn rc-btn-ghost rc-btn-sm" href="<?= $accountManageUrl; ?>">Login</a>
                    <a class="rc-btn rc-btn-violet rc-btn-sm" href="<?= $accountCreateUrl; ?>">
                        <i class="fas fa-user-plus"></i><span>Create Account</span>
                    </a>
                <?php endif; ?>
            </div>

            <button id="rcNavToggle" class="rc-nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="rcNav">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <section class="rc-hero hero-ravyncore">
        <div class="rc-hero-bg" aria-hidden="true"></div>
        <div class="rc-hero-overlay" aria-hidden="true"></div>
        <div class="rc-hero-vignette" aria-hidden="true"></div>

        <div class="rc-hero-inner hero-ravyncore-content">
            <?php if ($hasBrandSlogan): ?>
                <img class="rc-hero-wordmark hero-logo-text hero-main-slogan" src="<?= $brandSloganPreferred; ?>" alt="<?= escapeHtml($serverName); ?>">
            <?php else: ?>
                <img class="rc-hero-logo" src="<?= $logoPath; ?>" alt="RavynCore">
            <?php endif; ?>

            <p class="rc-hero-eyebrow">Custom MMORPG Experience</p>

            <div class="rc-hero-ctas">
                <a class="rc-btn rc-btn-play rc-btn-lg" href="<?= $downloadUrl; ?>">
                    <i class="fas fa-gavel"></i><span>Play Now</span>
                </a>
                <a class="rc-btn rc-btn-violet rc-btn-lg" href="<?= $accountCreateUrl; ?>">
                    <i class="fas fa-user-plus"></i><span>Create Account</span>
                </a>
            </div>

            <p class="rc-hero-support">Join thousands of players in an epic adventure!</p>
        </div>
    </section>

    <section class="rc-features" aria-label="Server highlights">
        <div class="rc-features-inner">
            <article class="rc-feature">
                <div class="rc-feature-icon"><i class="fas fa-scroll"></i></div>
                <h3>Custom Content</h3>
                <p>Exclusive maps, quests, and systems designed for a unique experience.</p>
            </article>
            <article class="rc-feature">
                <div class="rc-feature-icon"><i class="fas fa-balance-scale"></i></div>
                <h3>Fair Play</h3>
                <p>Balanced gameplay, active staff and a dedicated anti-cheat system.</p>
            </article>
            <article class="rc-feature">
                <div class="rc-feature-icon"><i class="fas fa-users"></i></div>
                <h3>Active Community</h3>
                <p>Friendly players, events, tournaments and constant updates.</p>
            </article>
            <article class="rc-feature">
                <div class="rc-feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Secure &amp; Stable</h3>
                <p>Protected server, daily backups and 24/7 monitoring for the best performance.</p>
            </article>
        </div>
    </section>

    <section id="rcSocialLinks" class="rc-social-strip" aria-label="RavynCore social links">
        <div class="rc-social-strip-inner">
            <h6 class="rc-social-strip-label">Connect with the Community</h6>
            <div class="rc-social-icons">
                <?php foreach ($socialLinks as $social): ?>
                    <?php if (!empty($social['url'])): ?>
                        <?php $helperTitle = addslashes((string)$social['name']); ?>
                        <?php $helperText = addslashes((string)$social['tooltip']); ?>
                        <span class="HelperDivIndicator"
                              onmouseover="ActivateHelperDiv($(this), '<?= $helperTitle; ?>', '<?= $helperText; ?>', '');"
                              onmouseout="$('#HelperDivContainer').hide();">
                            <a href="<?= $social['url']; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= escapeHtml($social['name']); ?>" title="<?= escapeHtml($social['name']); ?>">
                                <?php if (!empty($social['icon_path']) && file_exists(BASE . $social['icon_path'])): ?>
                                    <img src="<?= $social['icon_path']; ?>" alt="<?= escapeHtml($social['name']); ?>">
                                <?php else: ?>
                                    <i class="<?= escapeHtml($social['icon']); ?>"></i>
                                <?php endif; ?>
                            </a>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <main id="rcMain" class="rc-main-grid">
        <aside class="rc-sidebar">
            <section class="rc-panel">
                <h3>Server Status</h3>
                <div class="rc-status-line">
                    <span>State</span>
                    <strong class="<?= !empty($status['online']) ? 'is-online' : 'is-offline'; ?>">
                        <?= !empty($status['online']) ? 'Online' : 'Offline'; ?>
                    </strong>
                </div>
                <div class="rc-status-line">
                    <span>Players</span>
                    <strong><?= $playersOnline; ?></strong>
                </div>
                <div class="rc-status-line">
                    <span>Record Online</span>
                    <strong><?= $recordOnline; ?></strong>
                </div>
            </section>

            <section class="rc-panel">
                <h3>Quick Links</h3>
                <ul class="rc-links">
                    <?php foreach ($quickLinks as $link): ?>
                        <li>
                            <a href="<?= $link['url']; ?>"><?= escapeHtml($link['name']); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>

        </aside>

        <section class="rc-content-column">
            <?php if (PAGE === 'news'): ?>
                <section class="rc-panel rc-panel-news">
                    <h3>Latest News</h3>
                    <div class="rc-panel-body">
                        <?= tickers(); ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="rc-panel rc-panel-content">
                <h3><?= escapeHtml($pageTitle); ?></h3>
                <div class="rc-panel-body rc-rich-content">
                    <?php $hooks->trigger(HOOK_TIBIACOM_BORDER_3); ?>
                    <?= template_place_holder('center_top') . $content; ?>
                </div>
            </section>
        </section>

        <aside class="rc-sidebar">
            <section class="rc-panel">
                <h3>Top Players</h3>
                <div class="rc-ranking">
                    <?php foreach ($topPlayers as $player): ?>
                        <a class="rc-rank-row" href="<?= getPlayerLink($player['name'], false); ?>" aria-label="View <?= escapeHtml($player['name']); ?>">
                            <span class="rc-rank-position">#<?= (int)$player['rank']; ?></span>
                            <?php if (!empty($player['outfit_html'])): ?>
                                <?= $player['outfit_html']; ?>
                            <?php else: ?>
                                <img class="rc-rank-outfit" src="<?= $player['vocation_icon']; ?>" alt="<?= escapeHtml($player['vocation_name']); ?>">
                            <?php endif; ?>
                            <div class="rc-rank-player">
                                <strong><?= escapeHtml($player['name']); ?></strong>
                                <small>Level <?= (int)$player['level']; ?> - <?= escapeHtml($player['vocation_name']); ?></small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <a class="rc-btn rc-btn-subtle rc-btn-block" href="<?= getLink('highscores'); ?>">Full Ranking</a>
            </section>

            <section class="rc-panel">
                <h3>Search Character</h3>
                <form method="post" action="<?= getLink('characters'); ?>" class="rc-search-form">
                    <input type="text" name="name" maxlength="29" placeholder="Character name" pattern="[A-Za-z\s]+" title="Use only letters and spaces" data-rc-letters-only>
                    <button type="submit" class="rc-btn rc-btn-subtle rc-btn-block">Search</button>
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
            <span>&copy; <?= date('Y'); ?> RavynCore. All rights reserved.</span>
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
<?= template_place_holder('body_end'); ?>
</body>
</html>
