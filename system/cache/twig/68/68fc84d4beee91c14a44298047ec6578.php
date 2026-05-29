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

/* library/stalker.html.twig */
class __TwigTemplate_3e5db342e0ac2ed9e9bf40a5fcf0a8fa extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=stampor\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=squirrel\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Stalkers</h2>  <img src=\"images/library/stalker.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Stalkers are persons that are permanently invisible. They sneak up to their victim, and attack it suddenly. Some of these assassins have been spotted at Edron. They stab with their daggers and suck life energy out of their opponents, but if the first strike is not deadly, they are weak fighters.</p>  <p>Stalkers have 120 hitpoints. They are strong against death damage. On the other hand, they are weak against holy and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Stalkers yield 90 experience points. They carry gold coins, throwing knives and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/stalker.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/stalker.html.twig", "/var/www/html/system/templates/library/stalker.html.twig");
    }
}
