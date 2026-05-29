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

/* library/troll.html.twig */
class __TwigTemplate_6c2a6e83b81389e9af7aefe1765aecfa extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=twistedshaper\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=trollchampion\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Trolls</h2>  <img src=\"images/library/troll.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Trolls are a human-like race that lives in small tribes in the holes and dungeons of Tibia. There they hunt animals and seek treasures over which they keep a jealous watch. They are weak and silly fighters, but as a squad they can become quite dangerous.</p>  <p>Trolls have 50 hitpoints. They are strong against energy and holy damage. On the other hand, they are weak against death and earth damage. It takes 290 mana to summon or convince these creatures.</p>  <p>Trolls yield 20 experience points. They carry gold coins, hand axes, leather boots, leather helmets, meat, spears and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/troll.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/troll.html.twig", "/var/www/html/system/templates/library/troll.html.twig");
    }
}
