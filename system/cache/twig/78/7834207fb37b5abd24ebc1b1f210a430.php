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

/* library/dwarfguard.html.twig */
class __TwigTemplate_57c10241f4cd0fe83c58f51f863b2ddb extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=dwarfminer\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=dwarfgeomancer\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Dwarf Guards</h2>  <img src=\"images/library/dwarfguard.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Dwarf Guards are a kind of militia among the dwarfs. They are very cunning and strong fighters and know the surroundings quite well. Their strategy is to lure small groups of intruders into traps that they have built using their astonishing craftsmanship.</p>  <p>Dwarf Guards have 245 hitpoints. They are strong against earth and physical damage. On the other hand, they are weak against death and fire damage. It takes 650 mana to summon or convince these creatures. In addition, they are able to sense invisible creatures.</p>  <p>Dwarf Guards yield 165 experience points. They carry gold coins, leather boots, white mushrooms and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/dwarfguard.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/dwarfguard.html.twig", "/var/www/html/system/templates/library/dwarfguard.html.twig");
    }
}
