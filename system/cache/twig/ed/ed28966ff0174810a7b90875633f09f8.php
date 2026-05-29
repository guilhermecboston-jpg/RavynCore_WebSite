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

/* library/northernpike.html.twig */
class __TwigTemplate_7175d42db199e07ac2bab5defb13619d extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=cultnovice\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=nomad\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Northern Pikes</h2>  <img src=\"images/library/northernpike.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>This very rare fish is not a common sight, not even to the eyes of experienced fishermen. With a healthy dose of luck, the Northern Pike can be caught in many lakes across Tibia. Given the ability of going underwater, the adventurous explorer can also experience these frail creatures in their natural habitats. Catching them without a fishing rod, however, can be a challenging task.</p>  <p>Northern Pikes have 95 hitpoints. They are immune to earth and fire damage. On the other hand, they are weak against energy and physical damage. It takes 0 mana to convince these creatures but they cannot be summoned. In addition, they are able to sense invisible creatures.</p>  <p>Northern Pikes yield 0 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/northernpike.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/northernpike.html.twig", "/var/www/html/system/templates/library/northernpike.html.twig");
    }
}
