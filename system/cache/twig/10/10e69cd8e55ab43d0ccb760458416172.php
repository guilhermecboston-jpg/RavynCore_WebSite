<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* library/ancientscarab.html.twig */
class __TwigTemplate_4f62665f0ee52d46dffd76029d9a45be extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=armadile\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=amazon\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Ancient Scarabs</h2>  <img src=\"images/library/ancientscarab.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Ancient Scarab is ancient indeed - it is said that there are specimens that are aeons old. Rumours say that unless killed, a scarab will not die of old age but continue to grow and grow to enormous proportions. Their usual pace of movement is not impressively fast, but they are capable of doing sudden charges to catch their opponents off guard. Even more dangerous, their poison is strong enough to allow these creatures to emit large clouds of stinking death and mayhem around themselves. Ancient Scarabs are said to be the keepers of mysterious secrets swallowed by the sands long time ago. So don't be surprised if some of them might display even more cunning tactics and devastating magic.</p>  <p>Ancient Scarabs have 1000 hitpoints. They are immune to earth damage and cannot be paralyzed. Moreover, they are strong against energy and physical damage. On the other hand, they are weak against fire and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Ancient Scarabs yield 720 experience points. They carry gold coins, magic light wands and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/ancientscarab.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/ancientscarab.html.twig", "/var/www/html/system/templates/library/ancientscarab.html.twig");
    }
}
