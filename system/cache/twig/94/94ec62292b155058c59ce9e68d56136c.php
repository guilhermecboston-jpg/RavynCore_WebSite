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

/* library/orccultpriest.html.twig */
class __TwigTemplate_7375510d1dd4d8f95af3aa4a3958d8cd extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=orccultist\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=orccultminion\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Orc Cult Priests</h2> <img src=\"images/library/orccultpriest.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>The Orc Cult Priest is a stronger version of <a href=\"?subtopic=creatures&race=orcshaman\">Orc Shamans</a>.</p> <p>Orc Cult Priests have 1300 hitpoints. They are strong against energy and holy damage. On the other hand, they are weak against death and earth damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Orc Cult Priests yield 1000 experience points. They carry broken shamanic staffs, cultish robes, gold coins, green pieces of cloth, shamanic hoods, small rubies, strong health potions and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/orccultpriest.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/orccultpriest.html.twig", "/var/www/html/system/templates/library/orccultpriest.html.twig");
    }
}
