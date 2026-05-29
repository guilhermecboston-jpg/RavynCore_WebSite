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

/* library/orc.html.twig */
class __TwigTemplate_a79d94850c819ef90dca7436f22e93e4 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=orewalker\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=orclopsravager\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Orcs</h2>  <img src=\"images/library/orc.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Orcs are a very ancient race that once ruled the whole of Tibia. Later, they were expelled from the upper world by other races, and now they live in the dungeons of Tibia. They are human-like and very wily. Organised as paramilitary squads they can be quite dangerous.</p>  <p>Orcs have 70 hitpoints. They are strong against energy and holy damage. On the other hand, they are weak against death and earth damage. It takes 300 mana to summon or convince these creatures.</p>  <p>Orcs yield 25 experience points. They carry gold coins, meat and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/orc.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/orc.html.twig", "/var/www/html/system/templates/library/orc.html.twig");
    }
}
