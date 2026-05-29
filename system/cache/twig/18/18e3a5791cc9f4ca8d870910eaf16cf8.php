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

/* library/bogfrog.html.twig */
class __TwigTemplate_3b32d278e60330ee423e4957cec5b361 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=bograider\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=boar\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Bog Frogs</h2>  <img src=\"images/library/bogfrog.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Bog Frogs came with the rise of the bog temple in Shadowthorn. Formerly normal animals, these vicious little critters have transformed into an abomination of the bog. They are quick and ugly but should not pose a much greater threat than normal frogs. They usually appear in swarms in close vicinity to swamps and lakes.</p>  <p>Bog Frogs have 25 hitpoints. These creatures can neither be summoned nor convinced.</p>  <p>Bog Frogs yield 0 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/bogfrog.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/bogfrog.html.twig", "/var/www/html/system/templates/library/bogfrog.html.twig");
    }
}
