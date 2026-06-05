-- RavynCore homepage news refresh.
-- Run this on the website database to replace copied Tyron/other-server homepage texts.
-- MyAAC stores homepage news in myaac_news:
--   type 1 = main news, type 2 = ticker, type 3 = featured article.
-- After running, clear the MyAAC news cache (system/cache) or wait for cache expiration.

SET NAMES utf8;

SET @rc_news_title := 'Conheça o RavynCore';
SET @rc_ticker_title := 'Bem-vindo ao RavynCore';
SET @rc_article_title := 'RavynCore: sua nova jornada custom';

SET @rc_ticker_body := 'RavynCore é um servidor Custom Map com progressão inicial fluida, evolução cada vez mais competitiva, sistemas próprios e foco em estabilidade, segurança e comunidade.';

SET @rc_article_text := 'Servidor Custom Map com progressão inicial fluida e evolução cada vez mais competitiva. Projeto novo, construído junto aos jogadores, com foco em estabilidade, segurança, sistemas próprios e suporte comprometido.';

SET @rc_news_body := CONCAT(
'<p><strong>RavynCore chegou para construir uma nova jornada custom junto com a comunidade.</strong></p>',
'<p>Somos um servidor <strong>Custom Map</strong>, criado para oferecer uma progressão agradável no início e cada vez mais estratégica conforme o personagem evolui. A proposta é que os primeiros passos sejam fluidos, permitindo que novos jogadores entendam o mundo, façam suas primeiras hunts e avancem com consistência; com o tempo, skills, itens, sistemas e desafios passam a exigir mais planejamento, tornando a experiência mais competitiva e recompensadora.</p>',
'<p>O RavynCore nasce como um projeto novo, com a intenção de crescer ao lado dos jogadores. Queremos ouvir feedbacks reais, ajustar rotas quando necessário e manter uma evolução constante, sem perder de vista aquilo que sustenta um servidor saudável: estabilidade, proteção, segurança e respeito ao tempo de quem joga.</p>',
'<p>Nosso ecossistema conta com sistemas pensados para facilitar a gameplay e abrir caminhos de progressão, como <strong>HuntFinder</strong>, <strong>TaskFinder</strong>, <strong>BossFinder</strong>, <strong>Supreme Tasks</strong>, <strong>Stone Forge</strong>, transferências de upgrade e conteúdos customizados espalhados pelo mapa.</p>',
'<p>A Staff do RavynCore trabalha com uma postura justa, presente e comprometida. Nosso objetivo é manter comunicação clara, análise responsável dos casos e tempo de resposta para resolução de problemas em até <strong>24 horas</strong>, sempre priorizando a saúde do servidor e a segurança dos jogadores.</p>',
'<p>Se você procura um servidor custom para começar uma nova história, evoluir no seu ritmo e participar de um projeto que será construído lado a lado com a comunidade, sua jornada começa aqui.</p>',
'<p><strong>Bem-vindo ao RavynCore.</strong></p>'
);

START TRANSACTION;

-- Main homepage news.
UPDATE `myaac_news`
SET
    `title` = @rc_news_title,
    `body` = @rc_news_body,
    `date` = UNIX_TIMESTAMP(),
    `hidden` = 0,
    `last_modified_date` = UNIX_TIMESTAMP()
WHERE `type` = 1
  AND (
      `title` LIKE '%Tyron%'
      OR `title` LIKE '%TYRON%'
      OR `title` LIKE '%TyronOT%'
      OR `body` LIKE '%Tyron%'
      OR `body` LIKE '%TYRON%'
      OR `body` LIKE '%TyronOT%'
  );

INSERT INTO `myaac_news` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`)
SELECT 1, UNIX_TIMESTAMP(), 2, @rc_news_title, @rc_news_body, 0, '', 0
WHERE NOT EXISTS (
    SELECT 1 FROM `myaac_news` WHERE `type` = 1 AND `title` = @rc_news_title
);

-- News ticker shown above the main news list.
UPDATE `myaac_news`
SET
    `title` = @rc_ticker_title,
    `body` = @rc_ticker_body,
    `date` = UNIX_TIMESTAMP(),
    `hidden` = 0,
    `last_modified_date` = UNIX_TIMESTAMP()
WHERE `type` = 2
  AND (
      `title` LIKE '%Tyron%'
      OR `title` LIKE '%TYRON%'
      OR `title` LIKE '%TyronOT%'
      OR `body` LIKE '%Tyron%'
      OR `body` LIKE '%TYRON%'
      OR `body` LIKE '%TyronOT%'
      OR `body` LIKE '%Contentbox headline%'
  );

INSERT INTO `myaac_news` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`)
SELECT 2, UNIX_TIMESTAMP(), 4, @rc_ticker_title, @rc_ticker_body, 0, '', 0
WHERE NOT EXISTS (
    SELECT 1 FROM `myaac_news` WHERE `type` = 2 AND `title` = @rc_ticker_title
);

-- Featured article. Existing article image is preserved if one already exists.
UPDATE `myaac_news`
SET
    `title` = @rc_article_title,
    `body` = @rc_news_body,
    `article_text` = @rc_article_text,
    `date` = UNIX_TIMESTAMP(),
    `hidden` = 0,
    `last_modified_date` = UNIX_TIMESTAMP()
WHERE `type` = 3
  AND (
      `title` LIKE '%Tyron%'
      OR `title` LIKE '%TYRON%'
      OR `title` LIKE '%TyronOT%'
      OR `body` LIKE '%Tyron%'
      OR `body` LIKE '%TYRON%'
      OR `body` LIKE '%TyronOT%'
      OR `article_text` LIKE '%Tyron%'
      OR `article_text` LIKE '%TYRON%'
      OR `article_text` LIKE '%TyronOT%'
  );

COMMIT;

SELECT `id`, `type`, `title`, `hidden`, FROM_UNIXTIME(`date`) AS `updated_at`
FROM `myaac_news`
WHERE `title` IN (@rc_news_title, @rc_ticker_title, @rc_article_title)
ORDER BY `type`, `date` DESC;