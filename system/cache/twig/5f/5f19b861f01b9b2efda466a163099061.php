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

/* library/pig.html.twig */
class __TwigTemplate_14cb71b56d8f0a64823a6bfaf9a31862 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=piratebuccaneer\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=pigeon\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Pigs</h2>  <img src=\"images/library/pig.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Pigs are domestic animals which are kept by farmers. They stem from wild boars and have been raised by humans for a long time to gain meat. They are absolutely peaceable and eat or sleep the whole day. However, the farmers will be upset if you kill one of them.</p>  <p>Pigs have 25 hitpoints. It takes 255 mana to summon or convince these creatures.</p>  <p>Pigs yield 0 experience points. They carry meat and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/pig.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/pig.html.twig", "/var/www/html/system/templates/library/pig.html.twig");
    }
}
