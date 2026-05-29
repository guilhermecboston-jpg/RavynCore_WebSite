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

/* library/elf.html.twig */
class __TwigTemplate_633b3525d9fd43c63d7d5b7c7430c602 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=emeralddamselfly\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=elfscout\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Elves</h2>  <img src=\"images/library/elf.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Elves are a very ancient human-like race. They have a tall and beautiful figure. In former days they travelled all over Tibia, now they have retreated to an area in the north of Tibia where they live in dwellings made out of flourishing trees. Some of them are quite hospitable, but others are very suspicious towards any intruder and will try to repel him using their bows. Having a long history, the Elves are very skilled in magic, and almost every Elf knows some spells.</p>  <p>Elves have 100 hitpoints. They are strong against holy damage. On the other hand, they are weak against death damage. It takes 320 mana to convince these creatures but they cannot be summoned. In addition, they are able to sense invisible creatures.</p>  <p>Elves yield 42 experience points. They carry gold coins, leather boots, longswords, plums, studded helmets and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/elf.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/elf.html.twig", "/var/www/html/system/templates/library/elf.html.twig");
    }
}
