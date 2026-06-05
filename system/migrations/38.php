<?php
// Refresh homepage news with the polished RavynCore presentation layout.
$newsTable = TABLE_PREFIX . 'news';

$mainTitle = 'Conheça o RavynCore';
$tickerTitle = 'RavynCore em destaque';
$articleTitle = 'RavynCore: sua nova jornada custom';

$tickerBody = 'Custom Map novo: progressão fluida, sistemas próprios e staff presente.';
$articleText = 'Custom Map com progressão fluida, sistemas próprios, estabilidade e staff presente. Um projeto novo para crescer junto com a comunidade.';
$mainBody = '<div class="rc-news-story">'
  . '<section class="rc-news-hero-card">'
  . '<div><span class="rc-news-kicker">Custom Map</span><h2>RavynCore nasce para ser construído com os jogadores.</h2><p>Progressão inicial fluida, sistemas próprios e desafios que ficam mais estratégicos com o tempo.</p></div>'
  . '<img class="rc-news-brand" src="templates/tibiacom/images/brand/ravyncore-logo.png" alt="RavynCore" loading="lazy">'
  . '</section>'
  . '<img class="rc-news-divider" src="templates/tibiacom/images/news/ravyncore-divider.png" alt="" loading="lazy">'
  . '<div class="rc-news-card-grid">'
  . '<article class="rc-news-card"><img src="templates/tibiacom/images/hunt_finder/hunt-finder.png" alt="HuntFinder" loading="lazy"><h3>Progressão planejada</h3><p>Começo mais rápido para entrar no jogo; depois skills, itens e hunts exigem mais estratégia.</p></article>'
  . '<article class="rc-news-card"><img src="templates/tibiacom/images/supreme_tasks/taskfinder-mini.png" alt="TaskFinder" loading="lazy"><h3>Sistemas próprios</h3><p>HuntFinder, TaskFinder, BossFinder, Supreme Tasks e Stone Forge criam caminhos claros de evolução.</p></article>'
  . '<article class="rc-news-card"><img src="templates/tibiacom/images/supreme_tasks/rank2.png" alt="RavynCore" loading="lazy"><h3>Comunidade e suporte</h3><p>Servidor novo, foco em estabilidade, proteções e atendimento justo com resposta em até 24 horas.</p></article>'
  . '</div>'
  . '<p class="rc-news-final">A proposta é simples: crescer com a comunidade, ouvir feedbacks e manter uma experiência competitiva sem perder a essência clássica.</p>'
  . '</div>';

$db->exec('SET NAMES utf8');

$mainWhere = "(`title` = " . $db->quote($mainTitle) . " OR `title` = 'Hello!' OR `title` LIKE '%Tyron%' OR `title` LIKE '%TYRON%' OR `body` LIKE '%RavynCore chegou para construir%' OR `body` LIKE '%MyAAC is just READY to use%' OR `body` LIKE '%github.com/zimbadev/crystalserver-aac%')";
$tickerWhere = "(`title` = " . $db->quote('Bem-vindo ao RavynCore') . " OR `title` = " . $db->quote($tickerTitle) . " OR `title` = 'Hello tickets!' OR `title` LIKE '%Tyron%' OR `title` LIKE '%TYRON%' OR `body` LIKE '%progressão inicial fluida%' OR `body` LIKE '%github.com/zimbadev/crystalserver-aac%')";
$articleWhere = "(`title` = " . $db->quote($articleTitle) . " OR `title` LIKE '%Tyron%' OR `title` LIKE '%TYRON%' OR `article_text` LIKE '%Servidor Custom Map com progressão inicial fluida%')";

$db->exec('UPDATE `' . $newsTable . '` SET '
  . '`title` = ' . $db->quote($mainTitle) . ', '
  . '`body` = ' . $db->quote($mainBody) . ', '
  . '`date` = UNIX_TIMESTAMP(), '
  . '`hidden` = 0, '
  . '`last_modified_date` = UNIX_TIMESTAMP() '
  . 'WHERE `type` = ' . NEWS . ' AND ' . $mainWhere);

$db->exec('INSERT INTO `' . $newsTable . '` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`) '
  . 'SELECT ' . NEWS . ', UNIX_TIMESTAMP(), 2, ' . $db->quote($mainTitle) . ', ' . $db->quote($mainBody) . ', 0, \'\', 0 '
  . 'WHERE NOT EXISTS (SELECT 1 FROM `' . $newsTable . '` WHERE `type` = ' . NEWS . ' AND `title` = ' . $db->quote($mainTitle) . ')');

$db->exec('UPDATE `' . $newsTable . '` SET '
  . '`title` = ' . $db->quote($tickerTitle) . ', '
  . '`body` = ' . $db->quote($tickerBody) . ', '
  . '`date` = UNIX_TIMESTAMP(), '
  . '`hidden` = 0, '
  . '`last_modified_date` = UNIX_TIMESTAMP() '
  . 'WHERE `type` = ' . TICKER . ' AND ' . $tickerWhere);

$db->exec('INSERT INTO `' . $newsTable . '` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`) '
  . 'SELECT ' . TICKER . ', UNIX_TIMESTAMP(), 4, ' . $db->quote($tickerTitle) . ', ' . $db->quote($tickerBody) . ', 0, \'\', 0 '
  . 'WHERE NOT EXISTS (SELECT 1 FROM `' . $newsTable . '` WHERE `type` = ' . TICKER . ' AND `title` = ' . $db->quote($tickerTitle) . ')');

$db->exec('UPDATE `' . $newsTable . '` SET '
  . '`title` = ' . $db->quote($articleTitle) . ', '
  . '`body` = ' . $db->quote($mainBody) . ', '
  . '`article_text` = ' . $db->quote($articleText) . ', '
  . '`date` = UNIX_TIMESTAMP(), '
  . '`hidden` = 0, '
  . '`last_modified_date` = UNIX_TIMESTAMP() '
  . 'WHERE `type` = ' . ARTICLE . ' AND ' . $articleWhere);