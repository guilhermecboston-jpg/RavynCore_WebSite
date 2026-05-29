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

/* library/parrot.html.twig */
class __TwigTemplate_e8a248816b85ebfda62dbfc6a18f6b0b extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=penguin\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=panda\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Parrots</h2>  <img src=\"images/library/parrot.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The most intelligent bird in the known world is the colourful Parrot. It is even possible to teach it a few words. It is disputed if the bird is actually aware of what it is saying, after all a Parrot is at most as smart as an orc or a troll. The bird is usually unaggressive and in the wilderness it flees as soon as someone approaches it. Caught Parrots can be tamed and trained though. It takes some patience to teach them some simple sentences but the patience is ultimately rewarded with a funny companion whose buffoonery amuses its owner.</p>  <p>Parrots have 25 hitpoints. It takes 250 mana to summon or convince these creatures.</p>  <p>Parrots yield 0 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/parrot.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/parrot.html.twig", "/var/www/html/system/templates/library/parrot.html.twig");
    }
}
