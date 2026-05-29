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

/* library/dragon.html.twig */
class __TwigTemplate_bcc87f0c39738f1f08883aa20c6cb322 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=drakenabomination\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=dragonling\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Dragons</h2>  <img src=\"images/library/dragon.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Dragons were among the first creatures of Tibia and once ruled the whole continent. Nowadays, there are only a few of them left which live deep in the dungeons. Nevertheless, they are very powerful monsters and will strive for killing every intruder. Besides their immense strength, they shoot fireballs at their victims and spit fire. Moreover, they can heal themselves.</p>  <p>Dragons have 1000 hitpoints. They are immune to fire damage and cannot be paralyzed. Moreover, they are strong against earth and energy damage. On the other hand, they are weak against ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Dragons yield 700 experience points. They carry crossbows, dragon ham, dragon's tails, gold coins, steel shields and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/dragon.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/dragon.html.twig", "/var/www/html/system/templates/library/dragon.html.twig");
    }
}
