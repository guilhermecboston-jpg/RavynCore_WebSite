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

/* library/islandtroll.html.twig */
class __TwigTemplate_a00275b5558d4ce94f07d654b000fb74 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=jellyfish\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=ironblight\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Island Trolls</h2>  <img src=\"images/library/islandtroll.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Island Trolls are by no means more courageous than their cousins all over the world. Quite weak, they are usually easily defeated. However, their existence on remote isles is a clear proof for the versatility of the troll race. Their lifestyle does not differ much from that of other trolls. They prefer to roam in caves and form small tribes and clans.The only notable difference to other trolls might be their habit to collect all sorts of things and to hoard them. This might come from the lack of resources on the isles or, as some suggest, from some religious background. Considering the disinterest in the topic trolls, no one bothered yet to investigate that further.</p>  <p>Island Trolls have 50 hitpoints. It takes 290 mana to summon or convince these creatures.</p>  <p>Island Trolls yield 20 experience points. They carry gold coins, hand axes, leather boots, leather helmets, spears, wood, wooden shields and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/islandtroll.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/islandtroll.html.twig", "/var/www/html/system/templates/library/islandtroll.html.twig");
    }
}
