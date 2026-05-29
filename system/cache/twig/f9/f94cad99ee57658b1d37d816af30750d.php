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

/* library/flamingo.html.twig */
class __TwigTemplate_3f6bad1e03c42cb4a2fc4ac00e19f641 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=forestfury\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=fish\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Flamingos</h2>  <img src=\"images/library/flamingo.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Flamingo is a beautiful but rather useless bird. Its meat is not edible and only its feathers might have some value. Chasing this shy but fast bird is not recommended since you can quickly run in one of the predators of the jungle, and to expose yourself to this danger is not worth it. Some wealthy persons like to adorn their gardens with those lovely birds, and since it is quite difficult to catch a Flamingo alive, these animals achieve good prices on the market.</p>  <p>Flamingos have 25 hitpoints. It takes 250 mana to summon or convince these creatures.</p>  <p>Flamingos yield 0 experience points. They rarely carry items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/flamingo.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/flamingo.html.twig", "/var/www/html/system/templates/library/flamingo.html.twig");
    }
}
