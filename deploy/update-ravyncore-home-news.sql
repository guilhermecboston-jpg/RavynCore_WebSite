-- RavynCore homepage news refresh.
-- Run this on the website database to replace copied/default homepage texts.
-- MyAAC stores homepage news in myaac_news:
--   type 1 = main news, type 2 = ticker, type 3 = featured article.
-- After running, clear the MyAAC news cache (system/cache) or wait for cache expiration.

SET NAMES utf8;

SET @rc_news_title := 'Conheça o RavynCore';
SET @rc_ticker_title := 'RavynCore em destaque';
SET @rc_article_title := 'RavynCore: sua nova jornada custom';

SET @rc_ticker_body := 'Custom Map novo: progressão fluida, sistemas próprios e staff presente.';
SET @rc_article_text := 'Custom Map com progressão fluida, sistemas próprios, estabilidade e staff presente. Um projeto novo para crescer junto com a comunidade.';

SET @rc_news_body := CONCAT(
'<div class="rc-news-story">',
'<section class="rc-news-hero-card">',
'<div><span class="rc-news-kicker">Custom Map</span><h2>RavynCore nasce para ser construído com os jogadores.</h2><p>Progressão inicial fluida, sistemas próprios e desafios que ficam mais estratégicos com o tempo.</p></div>',
'<img class="rc-news-brand" src="templates/tibiacom/images/brand/ravyncore-logo.png" alt="RavynCore" loading="lazy">',
'</section>',
'<img class="rc-news-divider" src="templates/tibiacom/images/news/ravyncore-divider.png" alt="" loading="lazy">',
'<div class="rc-news-card-grid">',
'<article class="rc-news-card"><img src="templates/tibiacom/images/hunt_finder/hunt-finder.png" alt="HuntFinder" loading="lazy"><h3>Progressão planejada</h3><p>Começo mais rápido para entrar no jogo; depois skills, itens e hunts exigem mais estratégia.</p></article>',
'<article class="rc-news-card"><img src="templates/tibiacom/images/supreme_tasks/taskfinder-mini.png" alt="TaskFinder" loading="lazy"><h3>Sistemas próprios</h3><p>HuntFinder, TaskFinder, BossFinder, Supreme Tasks e Stone Forge criam caminhos claros de evolução.</p></article>',
'<article class="rc-news-card"><img src="templates/tibiacom/images/supreme_tasks/rank2.png" alt="RavynCore" loading="lazy"><h3>Comunidade e suporte</h3><p>Servidor novo, foco em estabilidade, proteções e atendimento justo com resposta em até 24 horas.</p></article>',
'</div>',
'<p class="rc-news-final">A proposta é simples: crescer com a comunidade, ouvir feedbacks e manter uma experiência competitiva sem perder a essência clássica.</p>',
'</div>'
);

START TRANSACTION;

UPDATE `myaac_news`
SET `title` = @rc_news_title,
    `body` = @rc_news_body,
    `date` = UNIX_TIMESTAMP(),
    `hidden` = 0,
    `last_modified_date` = UNIX_TIMESTAMP()
WHERE `type` = 1
  AND (`title` = @rc_news_title
    OR `title` = 'Hello!'
    OR `title` LIKE '%Tyron%'
    OR `title` LIKE '%TYRON%'
    OR `body` LIKE '%RavynCore chegou para construir%'
    OR `body` LIKE '%MyAAC is just READY to use%'
    OR `body` LIKE '%github.com/zimbadev/crystalserver-aac%');

INSERT INTO `myaac_news` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`)
SELECT 1, UNIX_TIMESTAMP(), 2, @rc_news_title, @rc_news_body, 0, '', 0
WHERE NOT EXISTS (SELECT 1 FROM `myaac_news` WHERE `type` = 1 AND `title` = @rc_news_title);

UPDATE `myaac_news`
SET `title` = @rc_ticker_title,
    `body` = @rc_ticker_body,
    `date` = UNIX_TIMESTAMP(),
    `hidden` = 0,
    `last_modified_date` = UNIX_TIMESTAMP()
WHERE `type` = 2
  AND (`title` = 'Bem-vindo ao RavynCore'
    OR `title` = @rc_ticker_title
    OR `title` = 'Hello tickets!'
    OR `title` LIKE '%Tyron%'
    OR `title` LIKE '%TYRON%'
    OR `body` LIKE '%progressão inicial fluida%'
    OR `body` LIKE '%github.com/zimbadev/crystalserver-aac%');

INSERT INTO `myaac_news` (`type`, `date`, `category`, `title`, `body`, `player_id`, `comments`, `hidden`)
SELECT 2, UNIX_TIMESTAMP(), 4, @rc_ticker_title, @rc_ticker_body, 0, '', 0
WHERE NOT EXISTS (SELECT 1 FROM `myaac_news` WHERE `type` = 2 AND `title` = @rc_ticker_title);

UPDATE `myaac_news`
SET `title` = @rc_article_title,
    `body` = @rc_news_body,
    `article_text` = @rc_article_text,
    `date` = UNIX_TIMESTAMP(),
    `hidden` = 0,
    `last_modified_date` = UNIX_TIMESTAMP()
WHERE `type` = 3
  AND (`title` = @rc_article_title
    OR `title` LIKE '%Tyron%'
    OR `title` LIKE '%TYRON%'
    OR `article_text` LIKE '%Servidor Custom Map com progressão inicial fluida%');

COMMIT;

SELECT `id`, `type`, `title`, `hidden`, FROM_UNIXTIME(`date`) AS `updated_at`
FROM `myaac_news`
WHERE `title` IN (@rc_news_title, @rc_ticker_title, @rc_article_title)
ORDER BY `type`, `date` DESC;