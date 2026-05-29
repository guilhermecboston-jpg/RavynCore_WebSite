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

/* library/frosttroll.html.twig */
class __TwigTemplate_f1079fef033ebe8052a66e792b76713c extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=fury\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=frostgiant\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Frost Trolls</h2>  <img src=\"images/library/frosttroll.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Frost Trolls are a variety of normal trolls that live in the holes and dungeons of the ice islands in the north-west of Tibia. Like their cousins, they hunt animals and seek treasures. But they are a bit stronger than them and can be quite dangerous to inexperienced adventurers.</p>  <p>Frost Trolls have 55 hitpoints. They are strong against fire and holy damage. On the other hand, they are weak against death, earth and energy damage. It takes 300 mana to summon or convince these creatures.</p>  <p>Frost Trolls yield 23 experience points. They carry fish, gold coins, rapiers, spears, wooden shields and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/frosttroll.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/frosttroll.html.twig", "/var/www/html/system/templates/library/frosttroll.html.twig");
    }
}
