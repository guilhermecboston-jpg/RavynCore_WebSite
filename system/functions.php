<?php
/**
 * Useful functions
 *
 * @package   MyAAC
 * @author    Slawkens <slawkens@gmail.com>
 * @copyright 2023 MyAAC
 */

defined('MYAAC') or die('Direct access not allowed!');

use Twig\Loader\ArrayLoader as Twig_ArrayLoader;

function message($message, $type, $return)
{
  if (IS_CLI) {
    if ($return) {
      return $message;
    }

    echo $message;
    return true;
  }

  if ($return) {
    return '<div class="' . $type . '" style="margin-bottom:10px;">' . $message . '</div>';
  }

  echo '<div class="' . $type . '" style="margin-bottom:10px;">' . $message . '</div>';
  return true;
}

function success($message, $return = false)
{
  return message($message, 'success', $return);
}

function warning($message, $return = false)
{
  return message($message, 'warning', $return);
}

function note($message, $return = false)
{
  return message($message, 'note', $return);
}

function error($message, $return = false)
{
  return message($message, 'error', $return);
}

function message1($head, $message, $type, $icon, $return)
{
  //return '<div class="' . $type . '">' . $message . '</div>';
  if ($return) {
    return '<div class="alert alert-' .
      $type .
      ' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-' .
      $icon .
      '"></i>  ' .
      $head .
      ':</h4>' .
      $message .
      '</div>';
  }

  echo '<div class="alert alert-' .
    $type .
    ' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-' .
    $icon .
    '"></i> ' .
    $head .
    ':</h4>' .
    $message .
    '</div>';
  return true;
}

function success1($message, $return = false)
{
  return message('Info', $message, 'success', 'success', $return);
}

function warning1($message, $return = false)
{
  return message('Warning', $message, 'warning', 'ban', $return);
}

function note1($message, $return = false)
{
  return message('Info', $message, 'info', 'info', $return);
}

function error1($message, $return = false)
{
  return message('Alert', $message, 'danger', 'check', $return);
}

function longToIp($ip)
{
  $exp = explode('.', long2ip($ip));
  return $exp[3] . '.' . $exp[2] . '.' . $exp[1] . '.' . $exp[0];
}

function generateLink($url, $name, $blank = false)
{
  return '<a href="' . $url . '"' . ($blank ? ' target="_blank"' : '') . '>' . $name . '</a>';
}

function getFullLink($page, $name, $blank = false)
{
  return generateLink(getLink($page), $name, $blank);
}

function getLink($page, $action = null)
{
  global $config;
  return BASE_URL . ($config['friendly_urls'] ? '' : '?') . $page . ($action ? '/' . $action : '');
}

function internalLayoutLink($page, $action = null)
{
  return getLink($page, $action);
}

function getForumThreadLink($thread_id, $page = null)
{
  global $config;
  return BASE_URL .
    ($config['friendly_urls'] ? '' : '?') .
    'forum/thread/' .
    (int) $thread_id .
    (isset($page) ? '/' . $page : '');
}

function getForumBoardLink($board_id, $page = null)
{
  global $config;
  return BASE_URL .
    ($config['friendly_urls'] ? '' : '?') .
    'forum/board/' .
    (int) $board_id .
    (isset($page) ? '/' . $page : '');
}

function getPlayerLink($name, $generate = true, $blank = false)
{
  global $config;

  if (is_numeric($name)) {
    $player = new OTS_Player();
    $player->load((int) $name);
    if ($player->isLoaded()) {
      $name = $player->getName();
    }
  }

  $url = BASE_URL . ($config['friendly_urls'] ? '' : '?') . 'characters/' . urlencode($name);

  if (!$generate) {
    return $url;
  }
  return generateLink($url, $name, $blank);
}

function getHouseLink($name, $generate = true)
{
  global $db, $config;

  if (is_numeric($name)) {
    $house = $db->query('SELECT `name` FROM `houses` WHERE `id` = ' . (int) $name);
    if ($house->rowCount() > 0) {
      $name = $house->fetchColumn();
    }
  }

  $url = BASE_URL . ($config['friendly_urls'] ? '' : '?') . 'houses/' . urlencode($name);

  if (!$generate) {
    return $url;
  }
  return generateLink($url, $name);
}

function getGuildLink($name, $generate = true)
{
  global $db, $config;

  if (is_numeric($name)) {
    $guild = $db->query('SELECT `name` FROM `guilds` WHERE `id` = ' . (int) $name);
    if ($guild->rowCount() > 0) {
      $name = $guild->fetchColumn();
    }
  }

  $url = BASE_URL . ($config['friendly_urls'] ? '' : '?') . 'guilds/' . urlencode($name);

  if (!$generate) {
    return $url;
  }
  return generateLink($url, $name);
}

function getItemNameById($id)
{
  require_once LIBS . 'items.php';
  $item = Items::get($id);
  return !empty($item['name']) ? $item['name'] : '';
}

function getItemImage($id, $count = 1)
{
  $tooltip = '';
  $id = (int)$id;
  $count = max(1, (int)$count);

  $name = getItemNameById($id);
  if (!empty($name)) {
    $tooltip = ' class="item_image" title="' . $name . '"';
  }

  return '<img src="' .
    getAssetImageById('item', $id, ['count' => $count]) .
    '"' .
    $tooltip .
    ' width="32" height="32" border="0" alt="' .
    $id .
    '" />';
}

if (!function_exists('rc_wiki_item_public_url')) {
  function rc_wiki_item_public_url($relPath)
  {
    $relPath = ltrim(str_replace('\\', '/', (string)$relPath), '/');
    if ($relPath === '') {
      return '';
    }
    if (defined('BASE_URL')) {
      return BASE_URL . $relPath;
    }

    return '/' . $relPath;
  }
}

if (!function_exists('rc_wiki_item_path_exists')) {
  function rc_wiki_item_path_exists($relPath)
  {
    $relPath = ltrim(str_replace('\\', '/', (string)$relPath), '/');
    if ($relPath === '') {
      return false;
    }

    if (defined('BASE') && is_readable(BASE . $relPath)) {
      return true;
    }

    if (!empty($_SERVER['DOCUMENT_ROOT'])) {
      $docPath = rtrim(str_replace('\\', '/', (string)$_SERVER['DOCUMENT_ROOT']), '/') . '/' . $relPath;
      if (is_readable($docPath)) {
        return true;
      }
    }

    return false;
  }
}

if (!function_exists('rc_wiki_item_resolve_path')) {
  function rc_wiki_item_resolve_path($itemId)
  {
    $itemId = (int)$itemId;
    if ($itemId <= 0) {
      return '';
    }

    $candidates = [
      'imagens/creaturestibiawiki/' . $itemId . '.gif',
      'images/creaturetibiawiki/' . $itemId . '.gif',
      'images/items/' . $itemId . '.gif',
    ];

    foreach ($candidates as $path) {
      if (rc_wiki_item_path_exists($path)) {
        return $path;
      }
    }

    return '';
  }
}

if (!function_exists('rc_wiki_item_image')) {
  function rc_wiki_item_image($itemId, array $options = [])
  {
    $itemId = (int)$itemId;
    if ($itemId <= 0) {
      return '';
    }

    $class = trim((string)($options['class'] ?? 'rc-tier-item-img'));
    if (!empty($options['large'])) {
      $class .= ' rc-tier-item-img-lg';
    }
    if (!empty($options['extraClass'])) {
      $class .= ' ' . trim((string)$options['extraClass']);
    }
    $class = trim($class);

    $label = trim((string)($options['label'] ?? ''));
    $wikiPath = rc_wiki_item_resolve_path($itemId);

    if ($wikiPath !== '') {
      $titleAttr = $label !== '' ? ' title="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '"' : '';
      $alt = $label !== '' ? htmlspecialchars($label, ENT_QUOTES, 'UTF-8') : '';
      $safeClass = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');
      $safeSrc = htmlspecialchars(rc_wiki_item_public_url($wikiPath), ENT_QUOTES, 'UTF-8');

      return '<img class="' . $safeClass . '" src="' . $safeSrc . '" width="32" height="32" alt="' . $alt . '"' . $titleAttr . ' loading="lazy">';
    }

    if (function_exists('getItemImage')) {
      $html = getItemImage($itemId);
      if ($html !== '') {
        if ($class !== '') {
          $html = preg_replace('/<img\s+/', '<img class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" ', $html, 1);
        }
        if ($label !== '') {
          if (strpos($html, 'title="') !== false) {
            $html = preg_replace('/title="[^"]*"/', 'title="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '"', $html, 1);
          } else {
            $html = preg_replace('/<img\s+/', '<img title="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '" ', $html, 1);
          }
          $html = preg_replace('/alt="[^"]*"/', 'alt="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '"', $html, 1);
        }
        return $html;
      }
    }

    return '';
  }
}

function getAssetImageById($type, $id, array $params = [])
{
  global $config;

  $type = trim((string)$type);
  $normalizedType = strtolower($type);
  $id = (int)$id;
  if ($type === '' || $id <= 0) {
    return '';
  }

  if (in_array($normalizedType, ['outfit', 'outfits', 'mount', 'mounts'], true)) {
    $renderer = trim((string)($config['outfit_images_url'] ?? ''));
    if ($renderer !== '') {
      $rendererParams = [
        'id' => $normalizedType === 'mount' || $normalizedType === 'mounts'
          ? max(1, (int)($params['base'] ?? 128))
          : $id,
        'addons' => max(0, (int)($params['addons'] ?? 0)),
        'head' => max(0, (int)($params['head'] ?? 114)),
        'body' => max(0, (int)($params['body'] ?? 95)),
        'legs' => max(0, (int)($params['legs'] ?? 78)),
        'feet' => max(0, (int)($params['feet'] ?? 69)),
        'mount' => $normalizedType === 'mount' || $normalizedType === 'mounts'
          ? $id
          : max(0, (int)($params['mount'] ?? 0)),
        'direction' => max(0, (int)($params['direction'] ?? 3)),
      ];

      $delimiter = (strpos($renderer, '?') === false) ? '?' : '&';
      return $renderer . $delimiter . http_build_query($rendererParams, '', '&', PHP_QUERY_RFC3986);
    }
  }

  $query = array_merge(
    [
      'subtopic' => 'asset',
      'type' => $normalizedType,
      'id' => $id,
    ],
    $params
  );

  return BASE_URL . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
}

function getThingManifestUrl()
{
  $relativePath = 'images/things-web/manifest.json';
  $absolutePath = BASE . $relativePath;
  $version = is_file($absolutePath) ? (string)filemtime($absolutePath) : (string)time();

  return BASE_URL . $relativePath . '?v=' . rawurlencode($version);
}

function getThingCanvasHtml($category, $id, array $params = [])
{
  $category = strtolower(trim((string)$category));
  $id = (int)$id;
  if ($id <= 0) {
    return '';
  }

  $aliases = [
    'outfit' => 'outfits',
    'outfits' => 'outfits',
    'mount' => 'outfits',
    'mounts' => 'outfits',
    'item' => 'items',
    'items' => 'items',
  ];
  $category = $aliases[$category] ?? $category;

  $width = max(16, (int)($params['width'] ?? 96));
  $height = max(16, (int)($params['height'] ?? 96));
  $addons = max(0, (int)($params['addons'] ?? ($category === 'outfits' ? 3 : 0)));
  $direction = max(0, (int)($params['direction'] ?? ($category === 'outfits' ? 3 : 0)));
  $class = trim('rc-thing-canvas ' . (string)($params['class'] ?? ''));
  $label = (string)($params['label'] ?? ('Asset ' . $id));

  $colors = [
    'head' => max(0, (int)($params['head'] ?? 95)),
    'body' => max(0, (int)($params['body'] ?? 114)),
    'legs' => max(0, (int)($params['legs'] ?? 39)),
    'feet' => max(0, (int)($params['feet'] ?? 115)),
  ];

  return '<canvas class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" width="' . $width . '" height="' . $height . '" data-rc-thing="asset"'
    . ' data-category="' . htmlspecialchars($category, ENT_QUOTES, 'UTF-8') . '"'
    . ' data-manifest="' . htmlspecialchars(getThingManifestUrl(), ENT_QUOTES, 'UTF-8') . '"'
    . ' data-looktype="' . $id . '"'
    . ' data-addons="' . $addons . '"'
    . ' data-head="' . $colors['head'] . '"'
    . ' data-body="' . $colors['body'] . '"'
    . ' data-legs="' . $colors['legs'] . '"'
    . ' data-feet="' . $colors['feet'] . '"'
    . ' data-direction="' . $direction . '"'
    . ' aria-label="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '"></canvas>'
    . '<span class="rc-thing-fallback" hidden>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>';
}

function getFlagImage($country)
{
  if (!isset($country[0])) {
    return '';
  }

  global $config;
  if (!isset($config['countries'])) {
    require SYSTEM . 'countries.conf.php';
  }

  if (!isset($config['countries'][$country])) {
    return '';
  }

  return '<img src="images/flags/' .
    $country .
    '.gif" title="' .
    $config['countries'][$country] .
    '"/>';
}

/**
 * Performs a boolean check on the value.
 *
 * @param mixed $v Variable to check.
 * @return bool Value boolean status.
 */
function getBoolean($v)
{
  if (is_bool($v)) {
    return $v;
  }

  if (is_numeric($v)) {
    return (int) $v > 0;
  }

  $v = strtolower($v);
  return $v === 'yes' || $v === 'true';
}

/**
 * Generates random string.
 *
 * @param int $length Length of the generated string.
 * @param bool $lowCase Should lower case characters be used?
 * @param bool $upCase Should upper case characters be used?
 * @param bool $numeric Should numbers by used too?
 * @param bool $special Should special characters by used?
 * @return string Generated string.
 */
function generateRandomString(
  $length,
  $lowCase = true,
  $upCase = false,
  $numeric = false,
  $special = false
) {
  $characters = '';
  if ($lowCase) {
    $characters .= 'abcdefghijklmnopqrstuxyvwz';
  }

  if ($upCase) {
    $characters .= 'ABCDEFGHIJKLMNPQRSTUXYVWZ';
  }

  if ($numeric) {
    $characters .= '123456789';
  }

  if ($special) {
    $characters .= '+-*#&@!?';
  }

  $characters_length = strlen($characters) - 1;
  if ($characters_length <= 0) {
    return '';
  }

  $ret = '';
  for ($i = 0; $i < $length; $i++) {
    $ret .= $characters[mt_rand(0, $characters_length)];
  }

  return $ret;
}

/**
 * Get forum sections
 *
 * @return array Forum sections.
 */
function getForumBoards()
{
  global $db, $canEdit;
  $sections = $db->query(
    'SELECT `id`, `name`, `description`, `closed`, `guild`, `access`' .
      ($canEdit ? ', `hidden`, `ordering`' : '') .
      ' FROM `' .
      TABLE_PREFIX .
      'forum_boards` ' .
      (!$canEdit ? ' WHERE `hidden` != 1' : '') .
      ' ORDER BY `ordering`;'
  );
  if ($sections) {
    return $sections->fetchAll();
  }

  return [];
}

/**
 * Retrieves data from myaac database config.
 *
 * @param string $name Key.
 * @param string &$value Reference where requested data will be set to.
 * @return bool False if value was not found in table, otherwise true.
 */
function fetchDatabaseConfig($name, &$value)
{
  global $db;

  $query = $db->query(
    'SELECT `value` FROM `' . TABLE_PREFIX . 'config` WHERE `name` = ' . $db->quote($name)
  );
  if ($query->rowCount() <= 0) {
    return false;
  }

  $value = $query->fetchColumn();
  return true;
}

/**
 * Retrieves data from database config.
 *
 * $param string $name Key.
 * @return string Requested data.
 */
function getDatabaseConfig($name)
{
  $value = null;
  fetchDatabaseConfig($name, $value);
  return $value;
}

/**
 * Register a new key pair in myaac database config.
 *
 * @param string $name Key name.
 * @param string $value Data to be associated with key.
 */
function registerDatabaseConfig($name, $value)
{
  global $db;
  $db->insert(TABLE_PREFIX . 'config', ['name' => $name, 'value' => $value]);
}

/**
 * Updates a value in myaac database config.
 *
 * @param string $name Key name.
 * @param string $value New data.
 */
function updateDatabaseConfig($name, $value)
{
  global $db;
  $db->update(TABLE_PREFIX . 'config', ['value' => $value], ['name' => $name]);
}

/**
 * Encrypt text using method specified in config.lua (encryptionType or passwordType)
 */
function encrypt($str)
{
  global $config;
  if (isset($config['database_salt'])) {
    // otserv
    $str .= $config['database_salt'];
  }

  $encryptionType = $config['database_encryption'];
  if (isset($encryptionType) && strtolower($encryptionType) !== 'plain') {
    if ($encryptionType === 'vahash') {
      return base64_encode(hash('sha256', $str));
    }

    return hash($encryptionType, $str);
  }

  return $str;
}

//delete player with name
function delete_player($name)
{
  global $db;
  $player = new OTS_Player();
  $player->find($name);
  if ($player->isLoaded()) {
    try {
      $db->exec("DELETE FROM player_skills WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM guild_invites WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_items WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_depotitems WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_spells WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_storage WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_viplist WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_deaths WHERE player_id = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    try {
      $db->exec("DELETE FROM player_deaths WHERE killed_by = '" . $player->getId() . "';");
    } catch (PDOException $error) {
    }
    $rank = $player->getRank();
    if ($rank->isLoaded()) {
      $guild = $rank->getGuild();
      if ($guild->getOwner()->getId() == $player->getId()) {
        $rank_list = $guild->getGuildRanksList();
        if (count($rank_list) > 0) {
          $rank_list->orderBy('level');
          foreach ($rank_list as $rank_in_guild) {
            $players_with_rank = $rank_in_guild->getPlayersList();
            $players_with_rank->orderBy('name');
            $players_with_rank_number = count($players_with_rank);
            if ($players_with_rank_number > 0) {
              foreach ($players_with_rank as $player_in_guild) {
                $player_in_guild->setRank();
                $player_in_guild->save();
              }
            }
            $rank_in_guild->delete();
          }
          $guild->delete();
        }
      }
    }
    $player->delete();
    return true;
  }

  return false;
}

//delete guild with id
function delete_guild($id)
{
  $guild = new OTS_Guild();
  $guild->load($id);
  if (!$guild->isLoaded()) {
    return false;
  }

  $rank_list = $guild->getGuildRanksList();
  if (count($rank_list) > 0) {
    $rank_list->orderBy('level');

    global $db, $ots;
    foreach ($rank_list as $rank_in_guild) {
      if ($db->hasTable('guild_members')) {
        $players_with_rank = $db->query(
          'SELECT `players`.`id` as `id`, `guild_members`.`rank_id` as `rank_id` FROM `players`, `guild_members` WHERE `guild_members`.`rank_id` = ' .
            $rank_in_guild->getId() .
            ' AND `players`.`id` = `guild_members`.`player_id` ORDER BY `name`;'
        );
      } elseif ($db->hasTable('guild_membership')) {
        $players_with_rank = $db->query(
          'SELECT `players`.`id` as `id`, `guild_membership`.`rank_id` as `rank_id` FROM `players`, `guild_membership` WHERE `guild_membership`.`rank_id` = ' .
            $rank_in_guild->getId() .
            ' AND `players`.`id` = `guild_membership`.`player_id` ORDER BY `name`;'
        );
      } else {
        $players_with_rank = $db->query(
          'SELECT `id`, `rank_id` FROM `players` WHERE `rank_id` = ' .
            $rank_in_guild->getId() .
            ' AND `deleted` = 0;'
        );
      }

      $players_with_rank_number = $players_with_rank->rowCount();
      if ($players_with_rank_number > 0) {
        foreach ($players_with_rank as $result) {
          $player = new OTS_Player();
          $player->load($result['id']);
          if (!$player->isLoaded()) {
            continue;
          }

          $player->setRank();
          $player->save();
        }
      }
      $rank_in_guild->delete();
    }
  }

  $guild->delete();
  return true;
}

//################### DISPLAY FUNCTIONS #####################
//return shorter text (news ticker)
function short_text($text, $limit)
{
  if (strlen($text) > $limit) {
    return substr($text, 0, strrpos(substr($text, 0, $limit), ' ')) . '...';
  }

  return $text;
}

function tickers()
{
  global $tickers_content, $featured_article;

  if (PAGE === 'news') {
    if (isset($tickers_content)) {
      return $tickers_content . $featured_article;
    }
  }

  return '';
}

/**
 * Template place holder
 *
 * Types: head_start, head_end, body_start, body_end, center_top
 *
 */
function template_place_holder($type)
{
  global $twig, $template_place_holders;
  $ret = '';

  if (
    array_key_exists($type, $template_place_holders) &&
    is_array($template_place_holders[$type])
  ) {
    $ret = implode($template_place_holders[$type]);
  }

  if ($type === 'head_start') {
    $ret .= template_header();
  } elseif ($type === 'body_start') {
    $ret .= $twig->render('browsehappy.html.twig');
  } elseif ($type === 'body_end') {
    $ret .= template_ga_code();
  }

  return $ret;
}

/**
 * Returns <head> content to be used by templates.
 */
function template_header($is_admin = false)
{
  global $title_full, $config;
  $charset = isset($config['charset']) ? $config['charset'] : 'utf-8';

  $ret =
    '
	<meta charset="' .
    $charset .
    '">
	<meta http-equiv="content-language" content="' .
    $config['language'] .
    '" />
	<meta http-equiv="content-type" content="text/html; charset=' .
    $charset .
    '" />';
  if (!$is_admin) {
    $ret .=
      '
	<base href="' .
      BASE_URL .
      '" />
	<title>' .
      $title_full .
      '</title>';
  }

  $ret .=
    '
	<meta name="description" content="' .
    $config['meta_description'] .
    '" />
	<meta name="keywords" content="' .
    $config['meta_keywords'] .
    ', myaac, wodzaac" />
	<meta name="generator" content="MyAAC" />
	<link rel="stylesheet" type="text/css" href="' .
    BASE_URL .
    'tools/css/messages.css" />
	<script type="text/javascript" src="' .
    BASE_URL .
    'tools/js/jquery.min.js"></script>
	<noscript>
		<div class="warning" style="text-align: center; font-size: 14px;">Your browser does not support JavaScript or its disabled!<br/>
			Please turn it on, or be aware that some features on this website will not work correctly.</div>
	</noscript>
';

  if ($config['recaptcha_enabled']) {
    $ret .= "<script src='https://www.google.com/recaptcha/api.js'></script>";
  }
  return $ret;
}

/**
 * Returns footer content to be used by templates.
 */
function template_footer()
{
  global $config, $views_counter;
  $ret = '';
  if (admin()) {
    $ret .= generateLink(ADMIN_URL, 'Admin Panel', true);
  }

  if ($config['visitors_counter']) {
    global $visitors;
    $amount = $visitors->getAmountVisitors();
    $ret .=
      '<br/>Currently there ' .
      ($amount > 1 ? 'are' : 'is') .
      ' ' .
      $amount .
      ' visitor' .
      ($amount > 1 ? 's' : '') .
      '. • ';
  }

  if ($config['views_counter']) {
    $ret .= 'Page has been viewed ' . $views_counter . ' times. • ';
  }

  if (config('footer_show_load_time')) {
    $ret .= 'Load time: ' . round(microtime(true) - START_TIME, 4) . ' seconds.';
  }

  if (isset($config['footer'][0])) {
    $ret .= '<br/>' . $config['footer'];
  }

  // please respect my work and help spreading the word, thanks!
  return $ret .
    '<br/>' .
    base64_decode(
      'Q29weXJpZ2h0IGJ5IE15YWFjIDxzdHJvbmc+JmNvcHk7IENyeXN0YWwgU2VydmVyPC9zdHJvbmc+LiBBbGwgcmlnaHRzIHJlc2VydmVkLg=='
    );
}

function template_ga_code()
{
  global $config, $twig;
  if (!isset($config['google_analytics_id'][0])) {
    return '';
  }

  return $twig->render('google_analytics.html.twig');
}

function template_form()
{
  global $template_name;

  $cache = Cache::getInstance();
  if ($cache->enabled()) {
    $tmp = '';
    if ($cache->fetch('templates', $tmp)) {
      $templates = unserialize($tmp);
    } else {
      $templates = get_templates();
      $cache->set('templates', serialize($templates), 30);
    }
  } else {
    $templates = get_templates();
  }

  $options = '';
  foreach ($templates as $key => $value) {
    $options .=
      '<option ' . ($template_name == $value ? 'SELECTED' : '') . '>' . $value . '</option>';
  }

  return '<form method="get" action="' .
    BASE_URL .
    '">
				<hidden name="subtopic" value="' .
    PAGE .
    '"/>
				<select name="template" onchange="this.form.submit()">' .
    $options .
    '</select>
			</form>';
}

function getStyle($i)
{
  global $config;
  return is_int($i / 2) ? $config['darkborder'] : $config['lightborder'];
}

$vowels = ['e', 'y', 'u', 'i', 'o', 'a'];
function getCreatureName($killer, $showStatus = false, $extendedInfo = false)
{
  global $vowels, $ots, $config;
  $str = '';
  $players_rows = '';

  if (is_numeric($killer)) {
    $player = new OTS_Player();
    $player->load($killer);
    if ($player->isLoaded()) {
      $str .= '<a href="' . getPlayerLink($player->getName(), false) . '">';
      if (!$showStatus) {
        return $str . '<b>' . $player->getName() . '</b></a>';
      }

      $str .=
        '<span style="color: ' .
        ($player->isOnline() ? 'green' : 'red') .
        '">' .
        $player->getName() .
        '</span></b></a>';
      if ($extendedInfo) {
        $str .= '<br><small>' . $player->getLevel() . ' ' . $player->getVocationName() . '</small>';
      }
      return $str;
    }
  } else {
    if ($killer == '-1') {
      $players_rows .= 'item or field';
    } else {
      if (in_array(strtolower($killer[0]), $vowels)) {
        $players_rows .= 'an ';
      } else {
        $players_rows .= 'a ';
      }
      $players_rows .= $killer;
    }
  }

  return $players_rows;
}

/**
 * Find skill name using skill id.
 *
 * @param int $skillId Skill id.
 * @param bool $suffix Should suffix also be added?
 * @return string Skill name or 'unknown' if not found.
 */
function getSkillName($skillId, $suffix = true)
{
  switch ($skillId) {
    case POT::SKILL_FIST:
      $tmp = 'fist';
      if ($suffix) {
        $tmp .= ' fighting';
      }

      return $tmp;
    case POT::SKILL_CLUB:
      $tmp = 'club';
      if ($suffix) {
        $tmp .= ' fighting';
      }

      return $tmp;
    case POT::SKILL_SWORD:
      $tmp = 'sword';
      if ($suffix) {
        $tmp .= ' fighting';
      }

      return $tmp;
    case POT::SKILL_AXE:
      $tmp = 'axe';
      if ($suffix) {
        $tmp .= ' fighting';
      }

      return $tmp;
    case POT::SKILL_DIST:
      $tmp = 'distance';
      if ($suffix) {
        $tmp .= ' fighting';
      }

      return $tmp;
    case POT::SKILL_SHIELD:
      return 'shielding';
    case POT::SKILL_FISH:
      return 'fishing';
    case POT::SKILL__MAGLEVEL:
      return 'magic level';
    case POT::SKILL__LEVEL:
      return 'level';
    default:
      break;
  }

  return 'unknown';
}

/**
 * Performs flag check on the current logged in user.
 * Table in database: accounts, field: website_flags
 *
 * @param int @flag Flag to be verified.
 * @return bool If user got flag.
 */
function hasFlag($flag)
{
  global $logged, $logged_flags;
  return $logged && ($logged_flags & $flag) == $flag;
}

/**
 * Check if current logged user have got admin flag set.
 */
function admin()
{
  return hasFlag(FLAG_ADMIN) || superAdmin();
}

/**
 * Check if current logged user have got super admin flag set.
 */
function superAdmin()
{
  return hasFlag(FLAG_SUPER_ADMIN);
}

/**
 * Format experience according to its amount (natural/negative number).
 *
 * @param int $exp Experience amount.
 * @param bool $color Should result be colorized?
 * @return string Resulted message attached in <span> tag.
 */
function formatExperience($exp, $color = true)
{
  $ret = '';
  if ($color) {
    $ret .= '<span';
    if ($exp != 0) {
      $ret .= ' style="color: ' . ($exp > 0 ? 'green' : 'red') . '">';
    } else {
      $ret .= '>';
    }
  }

  $ret .= '<b>' . ($exp > 0 ? '+' : '') . number_format($exp) . '</b>';
  if ($color) {
    $ret .= '</span>';
  }

  return $ret;
}

function get_locales()
{
  $ret = [];

  $path = LOCALE;
  foreach (scandir($path, 0) as $file) {
    if ($file[0] != '.' && $file != '..' && is_dir($path . $file)) {
      $ret[] = $file;
    }
  }

  return $ret;
}

function get_browser_languages()
{
  $ret = [];

  if (!($acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null)) {
    return $ret;
  }

  $languages = strtolower($acceptLang);
  // $languages = 'pl,en-us;q=0.7,en;q=0.3 ';
  // need to remove spaces from strings to avoid error
  $languages = str_replace(' ', '', $languages);

  foreach (explode(',', $languages) as $language_list) {
    $ret[] .= substr($language_list, 0, 2);
  }

  return $ret;
}

/**
 * Generates list of templates, according to templates/ dir.
 */
function get_templates()
{
  $ret = [];

  $path = TEMPLATES;
  foreach (scandir($path, 0) as $file) {
    if ($file[0] !== '.' && $file !== '..' && is_dir($path . $file)) {
      $ret[] = $file;
    }
  }

  return $ret;
}

/**
 * Generates list of installed plugins
 * @return array $plugins
 */
function get_plugins()
{
  $ret = [];

  $path = PLUGINS;
  foreach (scandir($path, SCANDIR_SORT_ASCENDING) as $file) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);
    $file_name = pathinfo($file, PATHINFO_FILENAME);
    if (
      $file === '.' ||
      $file === '..' ||
      $file === 'disabled' ||
      $file === 'example.json' ||
      $file_ext !== 'json' ||
      is_dir($path . $file)
    ) {
      continue;
    }

    $ret[] = str_replace('.json', '', $file_name);
  }

  return $ret;
}

function getWorldName($id)
{
  global $config;
  if (isset($config['worlds'][$id])) {
    return $config['worlds'][$id];
  }

  return $config['lua']['serverName'];
}

/**
 * Mailing users.
 * $config['mail_enabled'] have to be enabled.
 *
 * @param string $to Recipient email address.
 * @param string $subject Subject of the message.
 * @param string $body Message body in html format.
 * @param string $altBody Alternative message body, plain text.
 * @return bool PHPMailer status returned (success/failure).
 */
function _mail($to, $subject, $body, $altBody = '', $add_html_tags = true)
{
  /** @var PHPMailer $mailer */
  global $mailer, $config;
  if (!$mailer) {
    require SYSTEM . 'libs/phpmailer/PHPMailerAutoload.php';
    $mailer = new PHPMailer();
    $mailer->setLanguage('en', LIBS . 'phpmailer/language/');
  } else {
    $mailer->clearAllRecipients();
  }

  $signature_html = '';
  if (isset($config['mail_signature']['html'])) {
    $signature_html = $config['mail_signature']['html'];
  }

  if ($add_html_tags && isset($body[0])) {
    $tmp_body =
      '<html><head></head><body>' . $body . '<br/><br/>' . $signature_html . '</body></html>';
  } else {
    $tmp_body = $body . '<br/><br/>' . $signature_html;
  }

  if ($config['smtp_enabled']) {
    $mailer->isSMTP();
    $mailer->Host = $config['smtp_host'];
    $mailer->Port = (int) $config['smtp_port'];
    $mailer->SMTPAuth = $config['smtp_auth'];
    $mailer->Username = $config['smtp_user'];
    $mailer->Password = $config['smtp_pass'];
    $mailer->SMTPSecure = isset($config['smtp_secure']) ? $config['smtp_secure'] : '';
  } else {
    $mailer->isMail();
  }

  $mailer->isHTML(isset($body[0]) > 0);
  $mailer->From = $config['mail_address'];
  $mailer->Sender = $config['mail_address'];
  $mailer->CharSet = 'utf-8';
  $mailer->FromName = $config['lua']['serverName'];
  $mailer->Subject = $subject;
  $mailer->addAddress($to);
  $mailer->Body = $tmp_body;

  if (config('smtp_debug')) {
    $mailer->SMTPDebug = 2;
    $mailer->Debugoutput = 'echo';
  }

  $signature_plain = '';
  if (isset($config['mail_signature']['plain'])) {
    $signature_plain = $config['mail_signature']['plain'];
  }

  if (isset($altBody[0])) {
    $mailer->AltBody = $altBody . $signature_plain;
  } else {
    // automatically generate plain html
    $mailer->AltBody =
      strip_tags(preg_replace('/<a(.*)href="([^"]*)"(.*)>/', '$2', $body)) .
      "\n" .
      $signature_plain;
  }

  ob_start();
  if (!$mailer->Send()) {
    log_append('mailer-error.log', PHP_EOL . $mailer->ErrorInfo . PHP_EOL . ob_get_clean());
    return false;
  }

  ob_end_clean();
  return true;
}

function convert_bytes($size)
{
  $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
  return @round($size / pow(1024, $i = floor(log($size, 1024))), 2) . ' ' . $unit[$i];
}

function log_append($file, $str, array $params = [])
{
  if (count($params) > 0) {
    $str .= print_r($params, true);
  }

  if (!is_dir(LOGS)) {
    @mkdir(LOGS, 0775, true);
  }

  $f = @fopen(LOGS . $file, 'ab');
  if ($f === false) {
    return;
  }

  fwrite($f, '[' . date(DateTime::RFC1123) . '] ' . $str . PHP_EOL);
  fclose($f);
}

function load_config_lua($filename)
{
  global $config;

  $config_file = $filename;
  if (!@file_exists($config_file)) {
    log_append('error.log', "[load_config_file] Fatal error: Cannot load config.lua ($filename).");
    throw new RuntimeException("ERROR: Cannot find $filename file.");
  }

  $result = [];
  $config_string = str_replace(["\r\n", "\r"], "\n", file_get_contents($filename));
  $lines = explode("\n", $config_string);
  $luaTableDepth = 0;
  if (count($lines) > 0) {
    foreach ($lines as $ln => $line) {
      $line = trim($line);
      if ($line === '' || strpos($line, '--') === 0) {
        continue;
      }

      if ($luaTableDepth > 0) {
        $luaTableDepth += substr_count($line, '{') - substr_count($line, '}');
        if ($luaTableDepth <= 0) {
          $luaTableDepth = 0;
        }
        continue;
      }

      if (@$line[0] === '{' || @$line[0] === '}') {
        continue;
      }
      $tmp_exp = explode('=', $line, 2);
      if (strpos($line, 'dofile') !== false) {
        $delimiter = '"';
        if (strpos($line, $delimiter) === false) {
          $delimiter = "'";
        }

        $tmp = explode($delimiter, $line);
        $result = array_merge($result, load_config_lua($config['server_path'] . $tmp[1]));
      } elseif (count($tmp_exp) >= 2) {
        $key = trim($tmp_exp[0]);
        if (0 !== strpos($key, '--')) {
          $value = trim($tmp_exp[1]);
          if (strpos($value, '--') !== false) {
            // found some deep comment
            $value = preg_replace('/--.*$/i', '', $value);
          }

          if (is_numeric($value)) {
            $result[$key] = (float) $value;
          } elseif (
            in_array(@$value[0], ["'", '"']) &&
            in_array(@$value[strlen($value) - 1], ["'", '"'])
          ) {
            $result[$key] = (string) substr(substr($value, 1), 0, -1);
          } elseif (in_array($value, ['true', 'false'])) {
            $result[$key] = $value === 'true';
          } elseif (strpos($value, '{') !== false) {
            // Lua tables (ex.: loyaltySystem = { ... }) — ignorar bloco
            $luaTableDepth = substr_count($value, '{') - substr_count($value, '}');
            if ($luaTableDepth <= 0) {
              $luaTableDepth = 0;
            }
            continue;
          } else {
            foreach (
              $result
              as $tmp_key =>
                $tmp_value // load values definied by other keys, like: dailyFragsToBlackSkull = dailyFragsToRedSkull
            ) {
              $value = str_replace($tmp_key, $tmp_value, $value);
            }
            $ret = @eval("return $value;");
            if ((string) $ret == '' && trim($value) !== '""') {
              // = parser error
              throw new RuntimeException(
                'ERROR: Loading config.lua file. Line <b>' .
                  ($ln + 1) .
                  '</b> of LUA config file is not valid [key: <b>' .
                  $key .
                  '</b>]'
              );
            }
            $result[$key] = $ret;
          }
        }
      }
    }
  }

  $result = array_merge($result, $config['lua'] ?? []);
  return $result;
}

function str_replace_first($search, $replace, $subject)
{
  $pos = strpos($subject, $search);
  if ($pos !== false) {
    return substr_replace($subject, $replace, $pos, strlen($search));
  }

  return $subject;
}

function get_browser_real_ip()
{
  if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
  }

  if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
    return $_SERVER['REMOTE_ADDR'];
  } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
    return $_SERVER['HTTP_CLIENT_IP'];
  } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  return '0';
}

function setSession($key, $data)
{
  $_SESSION[config('session_prefix') . $key] = $data;
}

function getSession($key)
{
  $key = config('session_prefix') . $key;
  return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
}

function unsetSession($key)
{
  unset($_SESSION[config('session_prefix') . $key]);
}

function getTopPlayers($limit = 5)
{
  global $db;

  $cache = Cache::getInstance();
  if ($cache->enabled()) {
    $tmp = '';
    if ($cache->fetch('top_' . $limit . '_level', $tmp)) {
      $players = unserialize($tmp);
    }
  }

  if (!isset($players)) {
    $deleted = 'deleted';
    if ($db->hasColumn('players', 'deletion')) {
      $deleted = 'deletion';
    }

    $is_tfs10 = $db->hasTable('players_online');
    $players = $db
      ->query(
        'SELECT `id`, `name`, `level`, `vocation`, `experience`, `looktype`' .
          ($db->hasColumn('players', 'lookaddons') ? ', `lookaddons`' : '') .
          ', `lookhead`, `lookbody`, `looklegs`, `lookfeet`' .
          ($is_tfs10 ? '' : ', `online`') .
          ' FROM `players` WHERE `group_id` < ' .
          config('highscores_groups_hidden') .
          ' AND `id` NOT IN (' .
          implode(', ', config('highscores_ids_hidden')) .
          ') AND `' .
          $deleted .
          '` = 0 AND `account_id` != 1 ORDER BY `experience` DESC LIMIT ' .
          (int) $limit
      )
      ->fetchAll();

    if ($is_tfs10) {
      foreach ($players as &$player) {
        $query = $db->query(
          'SELECT `player_id` FROM `players_online` WHERE `player_id` = ' . $player['id']
        );
        $player['online'] = $query->rowCount() > 0 ? 1 : 0;
      }
      unset($player);
    }

    $i = 0;
    foreach ($players as &$player) {
      $player['rank'] = ++$i;
    }
    unset($player);

    if ($cache->enabled()) {
      $cache->set('top_' . $limit . '_level', serialize($players), 120);
    }
  }

  return $players;
}

function deleteDirectory($dir, $ignore = [], $contentOnly = false)
{
  if (!file_exists($dir)) {
    return true;
  }

  if (!is_dir($dir)) {
    return unlink($dir);
  }

  foreach (scandir($dir, 0) as $item) {
    if ($item === '.' || $item === '..' || in_array($item, $ignore, true)) {
      continue;
    }

    if (!in_array($item, $ignore, true) && !deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
      return false;
    }
  }

  if ($contentOnly) {
    return true;
  }

  return rmdir($dir);
}

function config($key)
{
  global $config;
  if (is_array($key)) {
    return $config[$key[0]] = $key[1];
  }

  return @$config[$key];
}

function configLua($key)
{
  global $config;
  if (is_array($key)) {
    return $config['lua'][$key[0]] = $key[1];
  }

  return @$config['lua'][$key] ?? null;
}

function clearCache()
{
  require_once LIBS . 'news.php';
  News::clearCache();

  $cache = Cache::getInstance();

  if ($cache->enabled()) {
    $tmp = '';

    if ($cache->fetch('status', $tmp)) {
      $cache->delete('status');
    }

    if ($cache->fetch('templates', $tmp)) {
      $cache->delete('templates');
    }

    if ($cache->fetch('config_lua', $tmp)) {
      $cache->delete('config_lua');
    }

    if ($cache->fetch('vocations', $tmp)) {
      $cache->delete('vocations');
    }

    if ($cache->fetch('towns', $tmp)) {
      $cache->delete('towns');
    }

    if ($cache->fetch('groups', $tmp)) {
      $cache->delete('groups');
    }

    if ($cache->fetch('visitors', $tmp)) {
      $cache->delete('visitors');
    }

    if ($cache->fetch('views_counter', $tmp)) {
      $cache->delete('views_counter');
    }

    if ($cache->fetch('failed_logins', $tmp)) {
      $cache->delete('failed_logins');
    }

    foreach (get_templates() as $template) {
      if ($cache->fetch('template_ini_' . $template, $tmp)) {
        $cache->delete('template_ini_' . $template);
      }
    }

    if ($cache->fetch('template_menus', $tmp)) {
      $cache->delete('template_menus');
    }
    if ($cache->fetch('database_tables', $tmp)) {
      $cache->delete('database_tables');
    }
    if ($cache->fetch('database_columns', $tmp)) {
      $cache->delete('database_columns');
    }
    if ($cache->fetch('database_checksum', $tmp)) {
      $cache->delete('database_checksum');
    }
    if ($cache->fetch('hooks', $tmp)) {
      $cache->delete('hooks');
    }
    if ($cache->fetch('last_kills', $tmp)) {
      $cache->delete('last_kills');
    }
  }

  deleteDirectory(CACHE . 'signatures', ['index.html'], true);
  deleteDirectory(CACHE . 'twig', ['index.html'], true);
  deleteDirectory(CACHE . 'plugins', ['index.html'], true);
  deleteDirectory(CACHE, ['signatures', 'twig', 'plugins', 'index.html'], true);

  return true;
}

function getCustomPageInfo($page)
{
  global $db, $logged_access;
  $query = $db->query(
    'SELECT `id`, `title`, `body`, `php`, `hidden`' .
      ' FROM `' .
      TABLE_PREFIX .
      'pages`' .
      ' WHERE `name` LIKE ' .
      $db->quote($page) .
      ' AND `hidden` != 1 AND `access` <= ' .
      $db->quote($logged_access)
  );
  if ($query->rowCount() > 0) {
    // found page
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  return null;
}

function getCustomPage($page, &$success)
{
  global $db, $twig, $title, $ignore, $logged_access;

  $success = false;
  $content = '';
  $query = $db->query(
    'SELECT `id`, `title`, `body`, `php`, `hidden`' .
      ' FROM `' .
      TABLE_PREFIX .
      'pages`' .
      ' WHERE `name` LIKE ' .
      $db->quote($page) .
      ' AND `hidden` != 1 AND `access` <= ' .
      $db->quote($logged_access)
  );
  if ($query->rowCount() > 0) {
    // found page
    $success = $ignore = true;
    $query = $query->fetch();
    $title = $query['title'];

    if ($query['php'] == '1') {
      // execute it as php code
      $tmp = substr($query['body'], 0, 10);
      if (($pos = strpos($tmp, '<?php')) !== false) {
        $tmp = preg_replace('/<\?php/', '', $query['body'], 1);
      } elseif (($pos = strpos($tmp, '<?')) !== false) {
        $tmp = preg_replace('/<\?/', '', $query['body'], 1);
      } else {
        $tmp = $query['body'];
      }

      $php_errors = [];
      function error_handler($errno, $errstr)
      {
        global $php_errors;
        $php_errors[] = ['errno' => $errno, 'errstr' => $errstr];
      }

      set_error_handler('error_handler');

      global $config;
      if ($config['backward_support']) {
        global $SQL, $main_content, $subtopic;
      }

      ob_start();
      eval($tmp);
      $content .= ob_get_contents();
      ob_end_clean();

      restore_error_handler();
      if (isset($php_errors[0]) && superAdmin()) {
        var_dump($php_errors);
      }
    } else {
      $oldLoader = $twig->getLoader();

      $twig_loader_array = new Twig_ArrayLoader([
        'content.html' => $query['body'],
      ]);

      $twig->setLoader($twig_loader_array);

      $content .= $twig->render('content.html');

      $twig->setLoader($oldLoader);
    }
  }

  return $content;
}

function getAccountLoginByLabel()
{
  $ret = '';
  if (config('account_login_by_email')) {
    $ret = 'Email Address';
    if (config('account_login_by_email_fallback')) {
      $ret .= ' or ';
    }
  }
  if (!config('account_login_by_email') || config('account_login_by_email_fallback')) {
    $ret .= 'Account ' . (USE_ACCOUNT_NAME ? 'Name' : 'Number');
  }
  return $ret;
}

function escapeHtml($html)
{
  return htmlentities($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function displayErrorBoxWithBackButton($errors, $action = null)
{
  global $twig;
  $twig->display('error_box.html.twig', ['errors' => $errors]);
  $twig->display('account.back_button.html.twig', [
    'action' => $action ?: getLink(''),
  ]);
}

function getDatabasePages($withHidden = false): array
{
  global $db, $logged_access;

  if (!isset($logged_access)) {
    $logged_access = 1;
  }

  $pages = $db->query(
    'SELECT `name` FROM ' .
      TABLE_PREFIX .
      'pages WHERE ' .
      ($withHidden ? '' : '`hidden` != 1 AND ') .
      '`access` <= ' .
      $db->quote($logged_access)
  );
  if ($pages->rowCount() < 1) {
    return [];
  }

  $ret = [];
  foreach ($pages->fetchAll() as $page) {
    $ret[] = $page['name'];
  }

  return $ret;
}

/**
 * @return bool
 */
function isVipSystemEnabled(): bool
{
  return getBoolean(configLua('vipSystemEnabled'));
}

function getAccountLoyaltyApprovedStatuses(): array
{
  return [
    'pagseguro' => ['paid', 'available', 'approved', 'confirmed', 'completed'],
    'mercadopago' => ['approved', 'paid', 'confirmed', 'completed'],
  ];
}

/**
 * Base URL for payment callbacks (Mercado Pago / Stripe require HTTPS).
 */
function ravynDetectPublicBaseUrl(): string
{
  global $config;

  if (!empty($config['payment_public_url'])) {
    return rtrim((string)$config['payment_public_url'], '/') . '/';
  }

  $scheme = 'http';
  if (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
  ) {
    $scheme = 'https';
  }

  $host = $_SERVER['HTTP_HOST'] ?? '177.55.153.178';
  if (stripos($host, 'ravyncore.com') !== false) {
    $host = '177.55.153.178';
  }

  return $scheme . '://' . $host . '/';
}

function ravynPublicBaseUrl(): string
{
  global $config;

  if (!empty($config['payment_public_url'])) {
    $url = rtrim((string)$config['payment_public_url'], '/') . '/';
  } elseif (!empty($config['public_url'])) {
    $public = rtrim((string)$config['public_url'], '/');
    if (stripos($public, 'ravyncore.com') !== false) {
      $url = ravynDetectPublicBaseUrl();
    } else {
      $url = $public . '/';
    }
  } elseif (defined('BASE_URL')) {
    $url = BASE_URL;
    if (stripos($url, 'ravyncore.com') !== false) {
      $url = ravynDetectPublicBaseUrl();
    }
  } else {
    $url = ravynDetectPublicBaseUrl();
  }

  if (
    (!empty($config['force_https_urls']) || ($config['env'] ?? '') === 'prod')
    && stripos($url, 'http://') === 0
  ) {
    $url = 'https' . substr($url, 4);
  }

  return $url;
}

function ravynGetLoyaltyServerName(): string
{
  global $config;
  if (!empty($config['lua']['serverName'])) {
    return (string)$config['lua']['serverName'];
  }
  return 'RavynCore';
}

function getRavynCoreLoyaltyTierDefinitions(): array
{
  global $config;

  if (isset($config['ravyncore_loyalty_tiers']) && is_array($config['ravyncore_loyalty_tiers']) && count($config['ravyncore_loyalty_tiers']) > 0) {
    return $config['ravyncore_loyalty_tiers'];
  }

  return [
    ['name' => 'Scout', 'points' => 100, 'bonus' => 1],
    ['name' => 'Sentinel', 'points' => 300, 'bonus' => 2],
    ['name' => 'Steward', 'points' => 600, 'bonus' => 3],
    ['name' => 'Warden', 'points' => 1000, 'bonus' => 4],
    ['name' => 'Squire', 'points' => 1500, 'bonus' => 5],
    ['name' => 'Warrior', 'points' => 2000, 'bonus' => 7],
    ['name' => 'Keeper', 'points' => 2500, 'bonus' => 8],
    ['name' => 'Guardian', 'points' => 3000, 'bonus' => 10],
    ['name' => 'Sage', 'points' => 4000, 'bonus' => 15],
    ['name' => 'Supreme', 'points' => 5000, 'bonus' => 20],
    ['name' => 'Legacy', 'points' => 7200, 'bonus' => 30],
  ];
}

/**
 * Linhas para tabelas do site: título, pontos, bônus skill.
 */
function getRavynLoyaltyDisplayTiers(): array
{
  $serverName = ravynGetLoyaltyServerName();
  $rows = [];

  foreach (getRavynCoreLoyaltyTierDefinitions() as $tier) {
    if (!is_array($tier)) {
      continue;
    }
    $name = trim((string)($tier['name'] ?? ''));
    $points = (int)($tier['points'] ?? 0);
    $bonus = (int)($tier['bonus'] ?? 0);
    if ($name === '' || $points <= 0) {
      continue;
    }
    $title = trim((string)($tier['title'] ?? ''));
    if ($title === '') {
      $title = $name . ' of ' . $serverName;
    }
    $rows[] = [$title, (string)$points, '+' . $bonus];
  }

  usort($rows, static function (array $a, array $b): int {
    return (int)$a[1] <=> (int)$b[1];
  });

  return $rows;
}

function getAccountLoyaltyTitleTiers(): array
{
  global $config;

  $parsed = [];
  foreach (getRavynCoreLoyaltyTierDefinitions() as $tier) {
    if (!is_array($tier)) {
      continue;
    }
    $points = (int)($tier['points'] ?? 0);
    if ($points <= 0) {
      continue;
    }
    $title = trim((string)($tier['title'] ?? ''));
    if ($title === '') {
      $name = trim((string)($tier['name'] ?? ''));
      if ($name === '') {
        continue;
      }
      $title = $name . ' of ' . ravynGetLoyaltyServerName();
    }
    $parsed[$points] = $title;
  }

  if (!isset($config['ravyncore_loyalty_titles']) || !is_array($config['ravyncore_loyalty_titles'])) {
    krsort($parsed, SORT_NUMERIC);
    return $parsed;
  }

  foreach ($config['ravyncore_loyalty_titles'] as $key => $value) {
    if (is_array($value)) {
      $required = isset($value['points']) ? (int)$value['points'] : 0;
      $title = isset($value['title']) ? trim((string)$value['title']) : '';
    } else {
      $required = (int)$key;
      $title = trim((string)$value);
    }

    if ($required <= 0 || $title === '') {
      continue;
    }

    $parsed[$required] = $title;
  }

  krsort($parsed, SORT_NUMERIC);
  return $parsed;
}

function getAccountLoyaltyTitle($loyaltyPoints): string
{
  $points = max(0, (int)$loyaltyPoints);
  $titleByRequiredPoints = getAccountLoyaltyTitleTiers();
  foreach ($titleByRequiredPoints as $requiredPoints => $title) {
    if ($points >= (int)$requiredPoints) {
      return $title;
    }
  }

  return 'None';
}

function getAccountLegacyLoyaltyPointsBatch(array $accountIds = []): array
{
  global $db, $config;

  $ids = [];
  foreach ($accountIds as $accountId) {
    $accountId = (int)$accountId;
    if ($accountId > 0) {
      $ids[$accountId] = true;
    }
  }
  $ids = array_keys($ids);

  if (empty($ids)) {
    return [];
  }

  $result = [];
  foreach ($ids as $accountId) {
    $result[$accountId] = 0;
  }

  if (
    !isset($db) ||
    !method_exists($db, 'hasTable') ||
    !method_exists($db, 'hasColumn') ||
    !$db->hasTable('accounts')
  ) {
    return $result;
  }

  $findFirstExistingColumn = static function (string $table, array $candidates) use ($db): ?string {
    foreach ($candidates as $column) {
      if ($db->hasColumn($table, $column)) {
        return $column;
      }
    }

    return null;
  };

  $loyaltyPointsColumn = $findFirstExistingColumn('accounts', ['loyalty_points', 'loyaltyPoints', 'loyaltypoints']);
  $premdaysColumn = $findFirstExistingColumn('accounts', ['premdays_purchased', 'premdaysPurchased', 'premium_days_purchased', 'premiumDaysPurchased']);
  $createdColumn = $findFirstExistingColumn('accounts', ['created', 'creation', 'created_at', 'registered_at']);

  if (!$loyaltyPointsColumn && !$premdaysColumn && !$createdColumn) {
    return $result;
  }

  $columns = ['`id`'];
  if ($loyaltyPointsColumn) {
    $columns[] = '`' . $loyaltyPointsColumn . '` AS `legacy_loyalty_points`';
  }
  if ($premdaysColumn) {
    $columns[] = '`' . $premdaysColumn . '` AS `legacy_premdays_purchased`';
  }
  if ($createdColumn) {
    $columns[] = '`' . $createdColumn . '` AS `legacy_created_at`';
  }

  $placeholders = implode(', ', array_fill(0, count($ids), '?'));
  $sql = 'SELECT ' . implode(', ', $columns) . ' FROM `accounts` WHERE `id` IN (' . $placeholders . ')';
  $legacyFormulaEnabled = !isset($config['ravyncore_loyalty_use_legacy_fallback']) ||
    getBoolean($config['ravyncore_loyalty_use_legacy_fallback']);

  try {
    $stmt = $db->prepare($sql);
    foreach ($ids as $index => $accountId) {
      $stmt->bindValue($index + 1, (int)$accountId, PDO::PARAM_INT);
    }
    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $accountId = (int)($row['id'] ?? 0);
      if ($accountId <= 0) {
        continue;
      }

      $explicitPoints = isset($row['legacy_loyalty_points']) ? max(0, (int)$row['legacy_loyalty_points']) : 0;
      $legacyFormulaPoints = 0;

      if ($legacyFormulaEnabled) {
        $premdaysPurchased = isset($row['legacy_premdays_purchased']) ? max(0, (int)$row['legacy_premdays_purchased']) : 0;
        $createdTimestamp = 0;

        if (array_key_exists('legacy_created_at', $row)) {
          $createdValue = $row['legacy_created_at'];
          if (is_numeric($createdValue)) {
            $createdTimestamp = (int)$createdValue;
          } elseif (is_string($createdValue) && trim($createdValue) !== '') {
            $parsed = strtotime($createdValue);
            if ($parsed !== false) {
              $createdTimestamp = (int)$parsed;
            }
          }
        }

        $accountAgeDays = $createdTimestamp > 0
          ? (int)floor(max(0, time() - $createdTimestamp) / 86400)
          : 0;
        $legacyFormulaPoints = max(0, $accountAgeDays + ($premdaysPurchased * 4));
      }

      $result[$accountId] = max($explicitPoints, $legacyFormulaPoints);
    }
  } catch (\Exception $e) {
    log_append('loyalty_errors.log', date('Y-m-d H:i:s') . ' accounts legacy query error: ' . $e->getMessage());
  }

  return $result;
}

function getAccountLoyaltyPointsBatch(array $accountIds = []): array
{
  global $db, $config;

  $filterIds = [];
  foreach ($accountIds as $accountId) {
    $accountId = (int)$accountId;
    if ($accountId > 0) {
      $filterIds[$accountId] = true;
    }
  }
  $filterIds = array_keys($filterIds);

  $pointsByAccount = [];
  foreach ($filterIds as $accountId) {
    $pointsByAccount[$accountId] = 0;
  }

  if (!isset($db) || !method_exists($db, 'hasTable') || !method_exists($db, 'hasColumn')) {
    return $pointsByAccount;
  }

  if ($db->hasColumn('accounts', 'loyalty_points')) {
    if (empty($filterIds)) {
      return $pointsByAccount;
    }

    try {
      $placeholders = implode(', ', array_fill(0, count($filterIds), '?'));
      $stmt = $db->prepare('SELECT `id`, `loyalty_points` FROM `accounts` WHERE `id` IN (' . $placeholders . ')');
      foreach ($filterIds as $index => $filterId) {
        $stmt->bindValue($index + 1, (int)$filterId, PDO::PARAM_INT);
      }
      $stmt->execute();
      foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $accountId = (int)($row['id'] ?? 0);
        if ($accountId > 0) {
          $pointsByAccount[$accountId] = max(0, (int)($row['loyalty_points'] ?? 0));
        }
      }
      return $pointsByAccount;
    } catch (\Exception $e) {
      log_append('loyalty_errors.log', date('Y-m-d H:i:s') . ' accounts.loyalty_points read error: ' . $e->getMessage());
    }
  }

  $statuses = getAccountLoyaltyApprovedStatuses();
  $pagSeguroCodeValues = [];
  $mercadoPagoCodeValues = [];

  if (isset($config['pagSeguro']['donates']) && is_array($config['pagSeguro']['donates'])) {
    foreach ($config['pagSeguro']['donates'] as $code => $row) {
      $value = isset($row['value']) ? (float)$row['value'] : 0.0;
      if ($value > 0) {
        $pagSeguroCodeValues[(string)$code] = $value;
      }
    }
  }

  if (isset($config['mercadoPago']['donates']) && is_array($config['mercadoPago']['donates'])) {
    foreach ($config['mercadoPago']['donates'] as $code => $row) {
      $value = isset($row['value']) ? (float)$row['value'] : 0.0;
      if ($value > 0) {
        $mercadoPagoCodeValues[(string)$code] = $value;
      }
    }
  }

  $totalsByAccount = [];
  $placeholders = static function (int $count): string {
    return implode(', ', array_fill(0, $count, '?'));
  };

  if (
    $db->hasTable('pagseguro_transactions') &&
    $db->hasColumn('pagseguro_transactions', 'account_id') &&
    $db->hasColumn('pagseguro_transactions', 'transaction_code') &&
    $db->hasColumn('pagseguro_transactions', 'payment_status') &&
    $db->hasColumn('pagseguro_transactions', 'code')
  ) {
    $hasAmountBrl = $db->hasColumn('pagseguro_transactions', 'amount_brl');
    $hasDelivered = $db->hasColumn('pagseguro_transactions', 'delivered');
    $params = [];
    $sql = 'SELECT `account_id`, `transaction_code`, `code`' .
      ($hasAmountBrl ? ', `amount_brl`' : '') .
      ' FROM `pagseguro_transactions` WHERE LOWER(`payment_status`) IN (' . $placeholders(count($statuses['pagseguro'])) . ')';

    foreach ($statuses['pagseguro'] as $status) {
      $params[] = strtolower($status);
    }

    if ($hasDelivered) {
      $sql .= " AND `delivered` = '1'";
    }

    if (!empty($filterIds)) {
      $sql .= ' AND `account_id` IN (' . $placeholders(count($filterIds)) . ')';
      foreach ($filterIds as $filterId) {
        $params[] = (int)$filterId;
      }
    }

    try {
      $stmt = $db->prepare($sql);
      foreach ($params as $index => $paramValue) {
        $stmt->bindValue($index + 1, $paramValue, is_int($paramValue) ? PDO::PARAM_INT : PDO::PARAM_STR);
      }
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $seenTransactions = [];
      foreach ($rows as $row) {
        $accountId = (int)($row['account_id'] ?? 0);
        if ($accountId <= 0) {
          continue;
        }

        $transactionCode = (string)($row['transaction_code'] ?? '');
        if ($transactionCode === '') {
          continue;
        }

        $seenKey = $accountId . ':' . $transactionCode;
        if (isset($seenTransactions[$seenKey])) {
          continue;
        }
        $seenTransactions[$seenKey] = true;

        $amountBrl = $hasAmountBrl ? (float)($row['amount_brl'] ?? 0) : 0.0;
        if ($amountBrl <= 0) {
          $code = (string)($row['code'] ?? '');
          $amountBrl = $pagSeguroCodeValues[$code] ?? 0.0;
        }

        if ($amountBrl <= 0) {
          continue;
        }

        if (!isset($totalsByAccount[$accountId])) {
          $totalsByAccount[$accountId] = 0.0;
        }
        $totalsByAccount[$accountId] += $amountBrl;
      }
    } catch (\Exception $e) {
      log_append('loyalty_errors.log', date('Y-m-d H:i:s') . ' pagseguro query error: ' . $e->getMessage());
    }
  }

  if (
    $db->hasTable('mercadopago_transactions') &&
    $db->hasColumn('mercadopago_transactions', 'account_id') &&
    $db->hasColumn('mercadopago_transactions', 'payment_id') &&
    $db->hasColumn('mercadopago_transactions', 'payment_status') &&
    $db->hasColumn('mercadopago_transactions', 'code')
  ) {
    $hasAmountBrl = $db->hasColumn('mercadopago_transactions', 'amount_brl');
    $hasDelivered = $db->hasColumn('mercadopago_transactions', 'delivered');
    $params = [];
    $sql = 'SELECT `account_id`, `payment_id`, `code`' .
      ($hasAmountBrl ? ', `amount_brl`' : '') .
      ' FROM `mercadopago_transactions` WHERE LOWER(`payment_status`) IN (' . $placeholders(count($statuses['mercadopago'])) . ')';

    foreach ($statuses['mercadopago'] as $status) {
      $params[] = strtolower($status);
    }

    if ($hasDelivered) {
      $sql .= " AND `delivered` = '1'";
    }

    if (!empty($filterIds)) {
      $sql .= ' AND `account_id` IN (' . $placeholders(count($filterIds)) . ')';
      foreach ($filterIds as $filterId) {
        $params[] = (int)$filterId;
      }
    }

    try {
      $stmt = $db->prepare($sql);
      foreach ($params as $index => $paramValue) {
        $stmt->bindValue($index + 1, $paramValue, is_int($paramValue) ? PDO::PARAM_INT : PDO::PARAM_STR);
      }
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $seenPayments = [];
      foreach ($rows as $row) {
        $accountId = (int)($row['account_id'] ?? 0);
        if ($accountId <= 0) {
          continue;
        }

        $paymentId = (string)($row['payment_id'] ?? '');
        if ($paymentId === '') {
          continue;
        }

        $seenKey = $accountId . ':' . $paymentId;
        if (isset($seenPayments[$seenKey])) {
          continue;
        }
        $seenPayments[$seenKey] = true;

        $amountBrl = $hasAmountBrl ? (float)($row['amount_brl'] ?? 0) : 0.0;
        if ($amountBrl <= 0) {
          $code = (string)($row['code'] ?? '');
          $amountBrl = $mercadoPagoCodeValues[$code] ?? 0.0;
        }

        if ($amountBrl <= 0) {
          continue;
        }

        if (!isset($totalsByAccount[$accountId])) {
          $totalsByAccount[$accountId] = 0.0;
        }
        $totalsByAccount[$accountId] += $amountBrl;
      }
    } catch (\Exception $e) {
      log_append('loyalty_errors.log', date('Y-m-d H:i:s') . ' mercadopago query error: ' . $e->getMessage());
    }
  }

  $legacyPointsByAccount = getAccountLegacyLoyaltyPointsBatch($filterIds);

  $result = [];
  if (!empty($filterIds)) {
    foreach ($filterIds as $accountId) {
      $purchasePoints = max(0, (int)floor((float)($totalsByAccount[$accountId] ?? 0)));
      $legacyPoints = max(0, (int)($legacyPointsByAccount[$accountId] ?? 0));
      $result[$accountId] = $purchasePoints > 0 ? $purchasePoints : $legacyPoints;
    }
    return $result;
  }

  foreach ($totalsByAccount as $accountId => $totalBrl) {
    $accountId = (int)$accountId;
    if ($accountId <= 0) {
      continue;
    }
    $result[$accountId] = max(0, (int)floor((float)$totalBrl));
  }

  foreach ($legacyPointsByAccount as $accountId => $legacyPoints) {
    $accountId = (int)$accountId;
    if ($accountId <= 0) {
      continue;
    }

    $legacyPoints = max(0, (int)$legacyPoints);
    if (!isset($result[$accountId]) || (int)$result[$accountId] <= 0) {
      $result[$accountId] = $legacyPoints;
    }
  }

  return $result;
}

/**
 * Verifica assinatura do webhook Stripe (Stripe-Signature).
 */
function stripeVerifyWebhookSignature(string $payload, string $sigHeader, string $secret, int $tolerance = 300): bool
{
  $timestamp = null;
  $signatures = [];

  foreach (explode(',', $sigHeader) as $part) {
    $part = trim($part);
    if (strpos($part, '=') === false) {
      continue;
    }
    [$key, $value] = explode('=', $part, 2);
    if ($key === 't') {
      $timestamp = $value;
    } elseif ($key === 'v1') {
      $signatures[] = $value;
    }
  }

  if ($timestamp === null || empty($signatures)) {
    return false;
  }

  if (abs(time() - (int)$timestamp) > $tolerance) {
    return false;
  }

  $signedPayload = $timestamp . '.' . $payload;
  $expected = hash_hmac('sha256', $signedPayload, $secret);

  foreach ($signatures as $signature) {
    if (hash_equals($expected, $signature)) {
      return true;
    }
  }

  return false;
}

/**
 * Doação aprovada: R$ 1,00 = 1 loyalty point na account (accounts.loyalty_points).
 * Chamado por PagSeguro, Mercado Pago e Stripe ao entregar coins.
 */
function ravynGrantDonationLoyaltyPoints(int $accountId, float $amountBrl): int
{
  global $db, $config;

  $accountId = (int)$accountId;
  if ($accountId <= 0 || $amountBrl <= 0) {
    return 0;
  }

  if (isset($config['ravyn_loyalty_donation_enabled']) && $config['ravyn_loyalty_donation_enabled'] === false) {
    return 0;
  }

  if (!isset($db) || !method_exists($db, 'hasColumn') || !$db->hasColumn('accounts', 'loyalty_points')) {
    return 0;
  }

  $perReal = 1;
  if (isset($config['ravyn_loyalty_points_per_real']) && (int)$config['ravyn_loyalty_points_per_real'] > 0) {
    $perReal = (int)$config['ravyn_loyalty_points_per_real'];
  }

  $points = (int)floor($amountBrl * $perReal);
  if ($points <= 0) {
    return 0;
  }

  try {
    $stmt = $db->prepare('UPDATE `accounts` SET `loyalty_points` = `loyalty_points` + ? WHERE `id` = ? LIMIT 1');
    $stmt->execute([$points, $accountId]);
    log_append('loyalty_donation.log', date('Y-m-d H:i:s') . " [DONATION LOYALTY] account {$accountId} +{$points} (R$ " . number_format($amountBrl, 2, '.', '') . ')');
    return $points;
  } catch (\Exception $e) {
    log_append('loyalty_errors.log', date('Y-m-d H:i:s') . ' ravynGrantDonationLoyaltyPoints: ' . $e->getMessage());
    return 0;
  }
}

function getAccountLoyaltyPoints($accountId): int
{
  $accountId = (int)$accountId;
  if ($accountId <= 0) {
    return 0;
  }

  $batch = getAccountLoyaltyPointsBatch([$accountId]);
  return (int)($batch[$accountId] ?? 0);
}

function ravynLoyaltyPoints($accountData = null): int
{
  $accountId = 0;

  if (is_array($accountData)) {
    if (isset($accountData['id'])) {
      $accountId = (int)$accountData['id'];
    } elseif (isset($accountData['account_id'])) {
      $accountId = (int)$accountData['account_id'];
    }
  } elseif (is_object($accountData)) {
    if (method_exists($accountData, 'getId')) {
      $accountId = (int)$accountData->getId();
    }
  } elseif (is_numeric($accountData)) {
    $accountId = (int)$accountData;
  }

  return getAccountLoyaltyPoints($accountId);
}

function ravynLoyaltyTitle($loyaltyPoints): string
{
  return getAccountLoyaltyTitle((int)$loyaltyPoints);
}

/**
 * @param $configFile
 * @return array
 *
 * Function to get stages.lua from crystal server.
 */
function loadStagesData($configFile)
{
  if (!@file_exists($configFile)) {
    log_append('error.log', "[loadStagesData] Warning: Cannot load stages.lua ($configFile).");
    return [];
  }

  $result = [];
  $config_string = str_replace(["\r\n", "\r"], "\n", file_get_contents($configFile));
  $lines = explode("\n", $config_string);

  $lastKey = '';
  if (count($lines) > 0) {
    for ($ln = 0; $ln < count($lines); $ln++) {
      $line = str_replace(' ', '', trim($lines[$ln]));
      if (strpos($line, '--') !== false || empty($line)) {
        continue;
      }

      if (strpos($line, 'experienceStages') !== false) {
        $lastKey = 'experienceStages';
        $result[$lastKey] = [];
      } elseif (strpos($line, 'skillsStages') !== false) {
        $lastKey = 'skillsStages';
        $result[$lastKey] = [];
      } elseif (strpos($line, 'magicLevelStages') !== false) {
        $lastKey = 'magicLevelStages';
        $result[$lastKey] = [];
      }

      if (strpos($line, '{') !== false) {
        $checks = [
          'min' => @explode('=', $lines[$ln + 1]),
          'max' => @explode('=', $lines[$ln + 2]),
          'mul' => @explode('=', $lines[$ln + 3]),
        ];
        $minlevel =
          isset($checks['min'][0]) && trim($checks['min'][0]) == 'minlevel'
            ? $checks['min'][1]
            : null;
        $maxlevel = !isset($checks['mul'][1])
          ? null
          : (trim($checks['max'][0]) == 'maxlevel'
            ? $checks['max'][1]
            : null);
        $multiplier =
          isset($checks['mul'][0]) && trim($checks['mul'][0]) == 'multiplier'
            ? $checks['mul'][1]
            : (trim($checks['max'][0]) == 'multiplier'
              ? $checks['max'][1]
              : null);

        if (!$minlevel && !$maxlevel && !$multiplier) {
          continue;
        }

        $result[$lastKey][] = [
          'minlevel' => $minlevel ? (int) str_replace([' ', ','], '', $minlevel) : null,
          'maxlevel' => $maxlevel ? (int) str_replace([' ', ','], '', $maxlevel) : null,
          'multiplier' => $multiplier
            ? (float)str_replace(',', '.', str_replace(' ', '', $multiplier))
            : null,
        ];
      }
    }
  }
  return $result;
}

function getPlayerByAccountId($accountId, $orderBy = 'id')
{
  global $db;
  if (is_numeric($accountId)) {
    $players = [];
    $playersQuery = $db
      ->query(
        "SELECT `id`, `lastlogin` FROM `players` WHERE `account_id` = {$accountId} ORDER BY `{$orderBy}` DESC;"
      )
      ->fetchAll();
    foreach ($playersQuery as $q) {
      $player = new OTS_Player();
      $player->load($q['id']);
      if ($player->isLoaded()) {
        $players[] = getPlayerLink($player->getName(), true, true);
      }
    }
    return implode(', ', $players);
  }
  return '';
}

function getPlayerNameByAccount($id, $name = null, $only = true, $orderBy = 'id')
{
  global $db;
  if (is_numeric($id)) {
    $player = new OTS_Player();
    $player->load($id);
    if ($player->isLoaded()) {
      return $player->getName();
    } else {
      $account = new OTS_Account();
      $account->load($id);
      if ($account->isLoaded()) {
        $playerQuery = $db
          ->query(
            "SELECT `id` FROM `players` WHERE `account_id` = {$id} ORDER BY `lastlogin` DESC LIMIT 1;"
          )
          ->fetch();
      }

      $player = new OTS_Player();
      $player->load($playerQuery['id']);
      return $player->isLoaded() ? $player->getName() : '';
    }
  } elseif (is_string($name)) {
    if (
      $id =
        $db
          ->query("SELECT `id` FROM `accounts` WHERE `name` = {$db->quote($name)} LIMIT 1;")
          ->fetch()['id'] ?? null
    ) {
      if ($only) {
        $playerQuery = $db
          ->query(
            "SELECT `id` FROM `players` WHERE `account_id` = {$id} ORDER BY `lastlogin` DESC LIMIT 1;"
          )
          ->fetch();
        $player = new OTS_Player();
        $player->load($playerQuery['id']);
        return $player->isLoaded() ? $player->getName() : '';
      } else {
        $players = [];
        $playersQuery = $db
          ->query(
            "SELECT `id`, `lastlogin` FROM `players` WHERE `account_id` = {$id} ORDER BY `{$orderBy}` DESC;"
          )
          ->fetchAll();
        foreach ($playersQuery as $q) {
          $player = new OTS_Player();
          $player->load($q['id']);
          if ($player->isLoaded()) {
            if ($orderBy == 'lastlogin') {
              return $player->getLastLogin();
            }
            $players[] = getPlayerLink($player->getName());
          }
        }
        return implode(', ', $players);
      }
    }
  }
  return '';
}

// validator functions
require_once LIBS . 'validator.php';
require_once SYSTEM . 'compat/base.php';
