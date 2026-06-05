<?php
// Replace copied/default homepage news with RavynCore's own introduction.
$newsTable = TABLE_PREFIX . 'news';

$mainTitle = 'Conheça o RavynCore';
$tickerTitle = 'Bem-vindo ao RavynCore';
$articleTitle = 'RavynCore: sua nova jornada custom';

$tickerBody = 'RavynCore é um servidor Custom Map com progressão inicial fluida, evolução cada vez mais competitiva, sistemas próprios e foco em estabilidade, segurança e comunidade.';
$articleText = 'Servidor Custom Map com progressão inicial fluida e evolução cada vez mais competitiva. Projeto novo, construído junto aos jogadores, com foco em estabilidade, segurança, sistemas próprios e suporte comprometido.';
$mainBody = '<p><strong>RavynCore chegou para construir uma nova jornada custom junto com a comunidade.</strong></p>'
  . '<p>Somos um servidor <strong>Custom Map</strong>, criado para oferecer uma progressão agradável no início e cada vez mais estratégica conforme o personagem evolui. A proposta é que os primeiros passos sejam fluidos, permitindo que novos jogadores entendam o mundo, façam suas primeiras hunts e avancem com consistência; com o tempo, skills, itens, sistemas e desafios passam a exigir mais planejamento, tornando a experiência mais competitiva e recompensadora.</p>'
  . '<p>O RavynCore nasce como um projeto novo, com a intenção de crescer ao lado dos jogadores. Queremos ouvir feedbacks reais, ajustar rotas quando necessário e manter uma evolução constante, sem perder de vista aquilo que sustenta um servidor saudável: estabilidade, proteção, segurança e respeito ao tempo de quem joga.</p>'
  . '<p>Nosso ecossistema conta com sistemas pensados para facilitar a gameplay e abrir caminhos de progressão, como <strong>HuntFinder</strong>, <strong>TaskFinder</strong>, <strong>BossFinder</strong>, <strong>Supreme Tasks</strong>, <strong>Stone Forge</strong>, transferências de upgrade e conteúdos customizados espalhados pelo mapa.</p>'
  . '<p>A Staff do RavynCore trabalha com uma postura justa, presente e comprometida. Nosso objetivo é manter comunicação clara, análise responsável dos casos e tempo de resposta para resolução de problemas em até <strong>24 horas</strong>, sempre priorizando a saúde do servidor e a segurança dos jogadores.</p>'
  . '<p>Se você procura um servidor custom para começar uma nova história, evoluir no seu ritmo e participar de um projeto que será construído lado a lado com a comunidade, sua jornada começa aqui.</p>'
  . '<p><strong>Bem-vindo ao RavynCore.</strong></p>';

$matchesCopiedMain = "(`title` LIKE '%Tyron%' OR `title` LIKE '%TYRON%' OR `title` LIKE '%TyronOT%' OR `title` = 'Hello!' OR `body` LIKE '%Tyron%' OR `body` LIKE '%TYRON%' OR `body` LIKE '%TyronOT%' OR `body` LIKE '%MyAAC is just READY to use%' OR `body` LIKE '%github.com/zimbadev/crystalserver-aac%')";
$matchesCopiedTicker = "(`title` LIKE '%Tyron%' OR `title` LIKE '%TYRON%' OR `title` LIKE '%TyronOT%' OR `title` = 'Hello tickets!' OR `body` LIKE '%Tyron%' OR `body` LIKE '%TYRON%' OR `body` LIKE '%TyronOT%' OR `body` LIKE '%Contentbox headline%' OR `body` LIKE '%github.com/zimbadev/crystalserver-aac%')";
$matchesCopiedArticle = "(`title` LIKE '%Tyron%' OR `title` LIKE '%TYRON%' OR `title` LIKE '%TyronOT%' OR `body` LIKE '%Tyron%' OR `body` LIKE '%TYRON%' OR `body` LIKE '%TyronOT%' OR `article_text` LIKE '%Tyron%' OR `article_text` LIKE '%TYRON%' OR `article_text` LIKE '%TyronOT%')";

$db->exec('SET NAMES utf8');

$db->exec('UPDATE `' . $newsTable . '` SET '
  . '`title` = ' . $db->quote($mainTitle) . ', '
  . '`body` = ' . $db->quote($mainBody) . ', '
  . '`date` = UNIX_TIMESTAMP(), '
  . '`hidden` = 0, '
  . '`last_modified_date` = UNIX_TIMESTAMP() '
  . 'WHERE `type` = ' . NEWS . ' AND ' . $matchesCopiedMain);

$db->exec('INSERT INTO `' . $newsTable . '` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`) '
  . 'SELECT ' . NEWS . ', UNIX_TIMESTAMP(), 2, ' . $db->quote($mainTitle) . ', ' . $db->quote($mainBody) . ', 0, \'\', 0 '
  . 'WHERE NOT EXISTS (SELECT 1 FROM `' . $newsTable . '` WHERE `type` = ' . NEWS . ' AND `title` = ' . $db->quote($mainTitle) . ')');

$db->exec('UPDATE `' . $newsTable . '` SET '
  . '`title` = ' . $db->quote($tickerTitle) . ', '
  . '`body` = ' . $db->quote($tickerBody) . ', '
  . '`date` = UNIX_TIMESTAMP(), '
  . '`hidden` = 0, '
  . '`last_modified_date` = UNIX_TIMESTAMP() '
  . 'WHERE `type` = ' . TICKER . ' AND ' . $matchesCopiedTicker);

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
  . 'WHERE `type` = ' . ARTICLE . ' AND ' . $matchesCopiedArticle);