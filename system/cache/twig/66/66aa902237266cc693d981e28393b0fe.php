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

/* library/stonegolem.html.twig */
class __TwigTemplate_d30935db7e25da8628be8cd994d777d3 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=stonerhino\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=stonedevourer\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Stone Golems</h2>  <img src=\"images/library/stonegolem.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Stone Golems are kind of living rocks. All their limbs are out of stone, and they live on stones. They live in the dungeons of Edron, where they find their favourite food, granite with quartz. Normally, they are peaceful, but they can get very angry about adventurers trampling on their food and try to slay the intruder using their incredible power.</p>  <p>Stone Golems have 270 hitpoints. They are immune to earth damage and cannot be paralyzed. Moreover, they are strong against death, energy, fire and physical damage. On the other hand, they are weak against ice damage. It takes 590 mana to summon or convince these creatures.</p>  <p>Stone Golems yield 160 experience points. They carry gold coins, small stones, sulphurous stones and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/stonegolem.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/stonegolem.html.twig", "/var/www/html/system/templates/library/stonegolem.html.twig");
    }
}
