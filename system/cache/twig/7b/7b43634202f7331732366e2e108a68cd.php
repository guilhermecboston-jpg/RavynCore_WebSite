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

/* library/witch.html.twig */
class __TwigTemplate_2113c97b8e766e875d02f164d00b9686 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=wolf\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=wisp\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Witches</h2>  <img src=\"images/library/witch.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Witches are magically skilled women that usually live deep in the forests and swamps of Tibia. There they collect herbs and other ingredients, e.g. parts of dead animals, from which they brew potions in their large iron cauldrons. Rumour has it that they can fly using their brooms. Most of them are quite malicious and short-tempered and attack adventurers by casting fireballs at them.</p>  <p>Witches have 300 hitpoints. They are immune to energy damage. Moreover, they are strong against earth damage. On the other hand, they are weak against death and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Witches yield 120 experience points. They carry cookies, gold coins, witch brooms, wolf tooth chains and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/witch.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/witch.html.twig", "/var/www/html/system/templates/library/witch.html.twig");
    }
}
