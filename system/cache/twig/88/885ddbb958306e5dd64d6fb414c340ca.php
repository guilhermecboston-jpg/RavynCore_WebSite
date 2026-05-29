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

/* library/fox.html.twig */
class __TwigTemplate_1bc8831c2f12b7725bba3012726a4737 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=frazzlemaw\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=forestfury\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Foxes</h2> <img src=\"images/library/fox.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>Foxes are medium-sized, omnivorous mammals that live in the forests and mountains of Tibia. They are smaller than wolves and unlike many canids, foxes are not always pack animals. Typically, they live in small family groups, but some are known to be solitary. They eat insects, small reptiles, birds, mice, eggs and berries.</p> <p>Foxes have 22 hitpoints. They are strong against earth and holy damage. On the other hand, they are weak against fire damage. It takes 255 mana to summon or convince these creatures.</p> <p>Foxes yield 15 experience points. They carry meat and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/fox.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/fox.html.twig", "/var/www/html/system/templates/library/fox.html.twig");
    }
}
