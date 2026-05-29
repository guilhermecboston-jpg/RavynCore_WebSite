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

/* library/caribbeancavespider.html.twig */
class __TwigTemplate_3e9e86c70509918e6f416845aa055fdf extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=eyelessdevourer\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=caribbeanbat\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Exotic Cave Spiders</h2> <img src=\"images/library/caribbeancavespider.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>Exotic cave spiders are stronger and more aggressive than <a href=\"?subtopic=creatures&race=giantspider\">Giant Spiders</a>.</p> <p>Exotic Cave Spiders have 1900 hitpoints. They are immune to earth damage and cannot be paralysed. Moreover, they are strong against energy and ice damage. On the other hand, they are weak against fire damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Exotic Cave Spiders yield 1400 experience points. They carry great health potions, platinum coins, poison arrows and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/caribbeancavespider.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/caribbeancavespider.html.twig", "/var/www/html/system/templates/library/caribbeancavespider.html.twig");
    }
}
