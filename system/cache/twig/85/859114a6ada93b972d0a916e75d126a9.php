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

/* library/demonskeleton.html.twig */
class __TwigTemplate_aba25ba25a2d9f40599217a875c76b47 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=demon\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=demonoutcast\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Demon Skeletons</h2>  <img src=\"images/library/demonskeleton.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Demon Skeletons are undead monsters that live in the deepest dungeons of Tibia. Nobody knows where these creatures come from. They are much stronger and faster than normal skeletons - from which they differ externally only by colour. Like them, they can drain life energy off their opponents.</p>  <p>Demon Skeletons have 400 hitpoints. They are immune to death, earth and fire damage and cannot be paralyzed. On the other hand, they are weak against holy damage. It takes 620 mana to summon or convince these creatures.</p>  <p>Demon Skeletons yield 240 experience points. They carry demonic skeletal hands, gold coins, throwing stars and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/demonskeleton.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/demonskeleton.html.twig", "/var/www/html/system/templates/library/demonskeleton.html.twig");
    }
}
