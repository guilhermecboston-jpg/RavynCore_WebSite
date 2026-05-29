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

/* library/rat.html.twig */
class __TwigTemplate_9c65cbbe7e2f15da1cca75aa4e4a3c75 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=realityreaver\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=rabbit\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Rats</h2>  <img src=\"images/library/rat.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Rats live in the sewers of each town, in holes, and in dungeons. Cropping up in masses they are a real plague, and the governments pay head money for dead Rats. They are quite weak, but in packs they can be dangerous for badly equipped adventurers.</p>  <p>Rats have 20 hitpoints. They are strong against earth and holy damage. On the other hand, they are weak against death and ice damage. It takes 200 mana to summon or convince these creatures.</p>  <p>Rats yield 5 experience points. They carry cheese and gold coins with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/rat.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/rat.html.twig", "/var/www/html/system/templates/library/rat.html.twig");
    }
}
