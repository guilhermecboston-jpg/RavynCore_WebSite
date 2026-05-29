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

/* library/cyclops.html.twig */
class __TwigTemplate_2c60bf02adca16e693b263d602adca1a extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=cyclopsdrone\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=crystalcrusher\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Cyclopes</h2>  <img src=\"images/library/cyclops.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Cyclopes are a human-like race but with only one eye and minor intelligence. They even talk in a similar language. They live in holes where they prospect for gold and other metals. Be warned that they get very angry about adventurers entering their claim. They will slay every intruder using their incredible power.</p>  <p>Cyclopes have 260 hitpoints. They are strong against energy and holy damage. On the other hand, they are weak against death and earth damage. It takes 490 mana to summon or convince these creatures.</p>  <p>Cyclopes yield 150 experience points. They carry gold coins, meat and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/cyclops.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/cyclops.html.twig", "/var/www/html/system/templates/library/cyclops.html.twig");
    }
}
