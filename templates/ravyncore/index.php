<?php
global $config, $db, $template_path, $logged, $status, $content, $hooks, $twig_loader, $title, $template_name;

defined('MYAAC') or die('Direct access not allowed!');

if (isset($config['boxes'])) {
	$config['boxes'] = explode(',', $config['boxes']);
}

$menus = get_template_menus();
if (empty($menus)) {
	$previous_template_name = $template_name;
	$template_name = 'tibiacom';
	$menus = get_template_menus();
	$template_name = $previous_template_name;
}
?>
<!doctype html>
<html lang="en">
<head>
	<?= template_place_holder('head_start'); ?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL; ?>images/favicon.ico" />
	<link rel="stylesheet" href="<?= $template_path; ?>/basic.css" />
	<script src="admin/bootstrap/jquery-3.6.0.min.js"></script>
	<script src="tools/basic.js"></script>
	<?php if ($config['pace_load']) { ?>
		<script src="admin/bootstrap/pace/pace.js"></script>
		<link href="admin/bootstrap/pace/themes/<?= $config['pace_color'] ?>/pace-theme-<?= $config['pace_theme'] ?>.css" rel="stylesheet" />
	<?php } ?>
	<?= template_place_holder('head_end'); ?>
</head>
<body>
<?= template_place_holder('body_start'); ?>

<div class="rc-shell">
	<header class="rc-header">
		<div class="rc-header-row">
			<a class="rc-logo-link" href="<?= getLink('news'); ?>">
				<img class="rc-logo" src="<?= BASE_URL; ?>templates/tibiacom/images/header/<?= $config['logo_image']; ?>" alt="RavynCore" />
			</a>
			<div class="rc-header-actions">
				<a class="rc-btn rc-btn-secondary" href="<?= getLink('account/create'); ?>">Create Account</a>
				<a class="rc-btn" href="<?= getLink('account/manage'); ?>"><?= $logged ? 'My Account' : 'Login'; ?></a>
				<a class="rc-btn rc-btn-highlight" href="<?= getLink('downloadclient'); ?>">Play Now</a>
			</div>
		</div>
		<div class="rc-hero">
			<div class="rc-hero-content">
				<h1>RavynCore PvP</h1>
				<p>The ultimate dark fantasy battlefield. Fire and ice collide in a world built for legends.</p>
				<div class="rc-hero-cta">
					<a class="rc-btn rc-btn-highlight" href="<?= getLink('downloadclient'); ?>">Download</a>
					<a class="rc-btn" href="<?= getLink('account/create'); ?>">Create Account</a>
				</div>
			</div>
			<div class="rc-hero-status">
				<div class="rc-stat">
					<span>Server</span>
					<strong><?= $status['online'] ? 'Online' : 'Offline'; ?></strong>
				</div>
				<div class="rc-stat">
					<span>Players</span>
					<strong><?= $status['online'] ? (int) $status['players'] : 0; ?></strong>
				</div>
				<div class="rc-stat">
					<span>Uptime</span>
					<strong><?= $status['online'] ? 'Live' : 'N/A'; ?></strong>
				</div>
			</div>
		</div>
	</header>

	<div class="rc-layout">
		<aside class="rc-sidebar rc-left">
			<nav class="rc-nav">
				<?php foreach ($config['menu_categories'] as $id => $cat): ?>
					<?php if (!isset($menus[$id]) || ($id == MENU_CATEGORY_SHOP && !$config['gifts_system'])) continue; ?>
					<div class="rc-nav-group">
						<div class="rc-nav-title"><?= $cat['name']; ?></div>
						<?php foreach ($menus[$id] as $menu): ?>
							<a class="rc-nav-item" href="<?= $menu['link_full']; ?>"<?= $menu['blank'] ? ' target="_blank"' : ''; ?>><?= $menu['name']; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</nav>
		</aside>

		<main class="rc-main">
			<?= tickers(); ?>
			<section id="<?= PAGE; ?>" class="rc-content-box">
				<div class="rc-content-title"><?= ucfirst($title); ?></div>
				<div class="rc-content-inner">
					<?= template_place_holder('center_top') . $content; ?>
				</div>
			</section>
			<footer id="Footer" class="rc-footer">
				<div class="rc-footer-brand">RavynCore MyACC</div>
				<div><?= template_footer(); ?></div>
			</footer>
		</main>

		<aside class="rc-sidebar rc-right">
			<div id="Themeboxes">
				<?php
				$local_boxes_templates = __DIR__ . '/boxes/templates';
				if (is_dir($local_boxes_templates)) {
					$twig_loader->prependPath($local_boxes_templates);
				}
				$twig_loader->prependPath(TEMPLATES . 'tibiacom/boxes/templates');
				foreach ($config['boxes'] as $box) {
					$file = TEMPLATES . $template_name . '/boxes/' . $box . '.php';
					if (!file_exists($file)) {
						$file = TEMPLATES . 'tibiacom/boxes/' . $box . '.php';
					}
					if (file_exists($file)) {
						include $file;
					}
				}
				if ($config['template_allow_change']) {
					echo '<span class="rc-template-label">Template:</span><br />' . template_form();
				}
				?>
			</div>
		</aside>
	</div>
</div>

<?= template_place_holder('body_end'); ?>
</body>
</html>
