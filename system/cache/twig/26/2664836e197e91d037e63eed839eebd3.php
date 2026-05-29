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

/* library/giantspider.html.twig */
class __TwigTemplate_ae82cb1e804d75eb02ced996bfc3cddd extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=gladiator\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=ghoul\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Giant Spiders</h2>  <img src=\"images/library/giantspider.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Giant Spiders live in holes in the mountains of Tibia. They are among the most powerful monsters and are so fast that it is nearly impossible to flee. They can summon poison spiders and throw poison fields.</p>  <p>Giant Spiders have 1300 hitpoints. They are immune to earth damage. Moreover, they are strong against energy and ice damage. On the other hand, they are weak against fire damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Giant Spiders yield 900 experience points. They carry gold coins, plate armors, poison arrows and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/giantspider.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/giantspider.html.twig", "/var/www/html/system/templates/library/giantspider.html.twig");
    }
}
