<?php
global $config, $db, $template_path, $logged, $status, $content, $hooks, $title, $template;

defined('MYAAC') or die('Direct access not allowed!');

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
    $player['outfit_url'] = '';

    if (!empty($config['online_outfit'])) {
        $lookAddons = isset($player['lookaddons']) ? (int)$player['lookaddons'] : 0;
        $player['outfit_url'] = $config['outfit_images_url']
            . '?id=' . (int)$player['looktype']
            . ($lookAddons > 0 ? '&addons=' . $lookAddons : '')
            . '&head=' . (int)$player['lookhead']
            . '&body=' . (int)$player['lookbody']
            . '&legs=' . (int)$player['looklegs']
            . '&feet=' . (int)$player['lookfeet'];
    }
}
unset($player);

$quickLinks = [
    ['name' => 'Latest News', 'url' => $templateLinks['link_news'] ?? getLink('news')],
    ['name' => 'Create Account', 'url' => $templateLinks['link_account_create'] ?? getLink('account/create')],
    ['name' => 'Downloads', 'url' => $templateLinks['link_downloads'] ?? getLink('downloads')],
    ['name' => 'Highscores', 'url' => $templateLinks['link_highscores'] ?? getLink('highscores')],
    ['name' => 'Guilds', 'url' => $templateLinks['link_guilds'] ?? getLink('guilds')],
    ['name' => 'Powergamers', 'url' => $templateLinks['link_powergamers'] ?? getLink('powergamers')],
    ['name' => 'Server Info', 'url' => $templateLinks['link_serverInfo'] ?? getLink('serverInfo')],
];

$accountManageUrl = $templateLinks['link_account_manage'] ?? getLink('account/manage');
$accountCreateUrl = $templateLinks['link_account_create'] ?? getLink('account/create');
$accountLogoutUrl = $templateLinks['link_account_logout'] ?? getLink('account/logout');
$downloadUrl = $templateLinks['link_downloads'] ?? getLink('downloads');
$discordUrl = !empty($config['discord_link']) ? $config['discord_link'] : null;
?>
<!doctype html>
<html lang="en">
<head>
    <?= template_place_holder('head_start'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        <div class="rc-header-top">
            <a class="rc-logo-link" href="<?= getLink('news'); ?>">
                <img class="rc-logo-image header-logo" src="<?= $logoPath; ?>" alt="RavynCore">
                <div class="rc-logo-text">
                    <?php if ($hasBrandSlogan): ?>
                        <img class="rc-logo-wordmark header-slogan" src="<?= $brandSloganPreferred; ?>" alt="RavynCore">
                    <?php else: ?>
                        <strong class="header-title">RavynCore</strong>
                    <?php endif; ?>
                    <span class="header-subtitle"><?= escapeHtml($headerSubtitle); ?></span>
                </div>
            </a>

            <div class="rc-header-actions">
                <?php if ($logged): ?>
                    <a class="rc-btn rc-btn-subtle" href="<?= $accountManageUrl; ?>">My Account</a>
                    <a class="rc-btn rc-btn-danger" href="<?= $accountLogoutUrl; ?>">Logout</a>
                <?php else: ?>
                    <a class="rc-btn rc-btn-subtle" href="<?= $accountManageUrl; ?>">Login</a>
                    <a class="rc-btn rc-btn-primary" href="<?= $accountCreateUrl; ?>">Create Account</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="rc-nav-wrap">
            <button id="rcNavToggle" class="rc-nav-toggle" type="button" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            <nav id="rcNav" class="rc-nav">
                <ul>
                    <?php if (!empty($menus)): ?>
                        <?php foreach ($menus as $categoryId => $items): ?>
                            <?php
                            $categoryName = $menuCategories[$categoryId]['name'] ?? 'Menu';
                            $firstItem = $items[0] ?? null;
                            ?>
                            <li class="rc-nav-item">
                                <a href="<?= $firstItem ? $firstItem['link_full'] : '#'; ?>"><?= escapeHtml($categoryName); ?></a>
                                <?php if (count($items) > 1): ?>
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
                    <?php else: ?>
                        <li class="rc-nav-item"><a href="<?= getLink('news'); ?>">News</a></li>
                        <li class="rc-nav-item"><a href="<?= getLink('downloads'); ?>">Downloads</a></li>
                        <li class="rc-nav-item"><a href="<?= getLink('highscores'); ?>">Ranking</a></li>
                        <li class="rc-nav-item"><a href="<?= getLink('guilds'); ?>">Guilds</a></li>
                        <li class="rc-nav-item"><a href="<?= getLink('serverInfo'); ?>">Info</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="rc-hero hero-ravyncore">
        <div class="rc-hero-fire"></div>
        <div class="rc-hero-ice"></div>
        <div class="rc-hero-content hero-ravyncore-content">
            <?php if ($hasBrandSlogan): ?>
                <img class="rc-hero-wordmark hero-logo-text hero-main-slogan" src="<?= $brandSloganPreferred; ?>" alt="<?= escapeHtml($serverName); ?>">
                <img class="rc-hero-emblem hero-logo-round hero-main-emblem" src="<?= $logoPath; ?>" alt="RavynCore Emblem">
            <?php else: ?>
                <img class="rc-hero-logo" src="<?= $logoPath; ?>" alt="RavynCore">
            <?php endif; ?>

            <div class="rc-hero-ctas">
                <a class="rc-btn rc-btn-play" href="<?= $downloadUrl; ?>">Play Now</a>
                <a class="rc-btn rc-btn-violet" href="<?= $accountCreateUrl; ?>">Create Account</a>
                <a class="rc-btn rc-btn-outline" href="<?= getLink('highscores'); ?>">View Ranking</a>
            </div>
        </div>

        <div class="rc-hero-stats">
            <div class="rc-stat">
                <span>Online</span>
                <strong><?= $playersOnline; ?></strong>
                <small>players</small>
            </div>
            <div class="rc-stat">
                <span>Uptime</span>
                <strong><?= escapeHtml((string)($status['uptimeReadable'] ?? 'Unknown')); ?></strong>
                <small><?= !empty($status['online']) ? 'Server Online' : 'Server Offline'; ?></small>
            </div>
            <div class="rc-stat">
                <span>Server Save</span>
                <strong id="rcServerSaveCountdown" data-target="<?= $serverSaveDate->format('c'); ?>">--:--:--</strong>
                <small>Daily reset</small>
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
                        <div class="rc-rank-row">
                            <span class="rc-rank-position">#<?= (int)$player['rank']; ?></span>
                            <?php if (!empty($player['outfit_url'])): ?>
                                <img class="rc-rank-outfit" src="<?= $player['outfit_url']; ?>" alt="<?= escapeHtml($player['name']); ?>">
                            <?php else: ?>
                                <img class="rc-rank-outfit" src="<?= $player['vocation_icon']; ?>" alt="<?= escapeHtml($player['vocation_name']); ?>">
                            <?php endif; ?>
                            <div class="rc-rank-player">
                                <a href="<?= getPlayerLink($player['name'], false); ?>"><?= escapeHtml($player['name']); ?></a>
                                <small>Level <?= (int)$player['level']; ?> - <?= escapeHtml($player['vocation_name']); ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="rc-btn rc-btn-subtle rc-btn-block" href="<?= getLink('highscores'); ?>">Full Ranking</a>
            </section>

            <section class="rc-panel">
                <h3>Search Character</h3>
                <form method="post" action="<?= getLink('characters'); ?>" class="rc-search-form">
                    <input type="text" name="name" maxlength="29" placeholder="Character name">
                    <button type="submit" class="rc-btn rc-btn-primary rc-btn-block">Search</button>
                </form>
            </section>

            <section class="rc-panel">
                <h3>Community</h3>
                <a class="rc-btn rc-btn-subtle rc-btn-block" href="<?= getLink('guilds'); ?>">Guilds</a>
                <a class="rc-btn rc-btn-subtle rc-btn-block" href="<?= getLink('powergamers'); ?>">Powergamers</a>
                <?php if ($discordUrl): ?>
                    <a class="rc-btn rc-btn-subtle rc-btn-block" href="<?= $discordUrl; ?>" target="_blank" rel="noopener noreferrer">Discord</a>
                <?php endif; ?>
                <a class="rc-btn rc-btn-primary rc-btn-block" href="<?= getLink('donate'); ?>">Donate</a>
            </section>
        </aside>
    </main>

    <footer class="rc-footer">
        <div class="rc-footer-top">
            <a class="rc-footer-brand" href="<?= getLink('news'); ?>">
                <img class="rc-footer-logo" src="<?= $logoPath; ?>" alt="RavynCore">
                <div class="rc-footer-brand-text rc-logo-text hero-brand-bottom">
                    <?php if ($hasBrandSlogan): ?>
                        <img class="rc-footer-wordmark rc-logo-wordmark" src="<?= $brandSloganPreferred; ?>" alt="RavynCore">
                    <?php else: ?>
                        <strong>RavynCore</strong>
                    <?php endif; ?>
                    <span class="rc-footer-subtitle"><?= escapeHtml($headerSubtitle); ?></span>
                </div>
            </a>

            <nav class="rc-footer-links">
                <a href="<?= getLink('news'); ?>">News</a>
                <a href="<?= getLink('downloads'); ?>">Download</a>
                <a href="<?= getLink('highscores'); ?>">Ranking</a>
                <a href="<?= getLink('guilds'); ?>">Guilds</a>
                <a href="<?= getLink('serverInfo'); ?>">Server Info</a>
            </nav>
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

<script src="<?= $template_path; ?>/js/generic.js"></script>
<script src="<?= $template_path; ?>/js/ravyncore.js"></script>
<?= template_place_holder('body_end'); ?>
</body>
</html>
