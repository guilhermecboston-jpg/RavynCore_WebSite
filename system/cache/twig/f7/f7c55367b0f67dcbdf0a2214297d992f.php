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

/* library/swamptroll.html.twig */
class __TwigTemplate_a8785b51156e3b5f727ea664bb95b46c extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=swampling\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=stonerhino\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Swamp Trolls</h2>  <img src=\"images/library/swamptroll.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Swamp Trolls are a variety of normal trolls that live in the swamps in the east of Tibia. Like the other tribes of trolls, they hunt animals and seek treasures. But they are a bit stronger and they soak their claws with the extracts of some poisonous herbs they collect in the swamps in order to envenom their opponents. So they can be quite dangerous to inexperienced adventurers.</p>  <p>Swamp Trolls have 55 hitpoints. They are strong against earth damage. On the other hand, they are weak against fire damage. It takes 320 mana to summon these creatures but they cannot be convinced.</p>  <p>Swamp Trolls yield 25 experience points. They carry fish, gold coins, leather boots, mouldy cheeses, spears, torches and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/swamptroll.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/swamptroll.html.twig", "/var/www/html/system/templates/library/swamptroll.html.twig");
    }
}
