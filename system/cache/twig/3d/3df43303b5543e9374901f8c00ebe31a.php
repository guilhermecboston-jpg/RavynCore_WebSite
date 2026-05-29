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

/* library/gazer.html.twig */
class __TwigTemplate_b708e80ee30348bee882482e815ebf5e extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=ghastlydragon\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=gargoyle\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Gazers</h2>  <img src=\"images/library/gazer.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Gazers are the spawn of the bonelords. Sometimes a bonelord splits up a part of itself that functions like a slimy egg which evolves into a Gazer at incredible speed. Right from its 'birth', the Gazer owns some basic intelligence which it has been inherited by its parent bonelord. Still it has only vague memories, and also no concrete knowledge but rather some instinct of an underdeveloped magic. It is said that elder bonelords can spawn Gazers even without producing an egg, but this offspring is usually flawed and dies rather quickly.</p>  <p>Gazers have 120 hitpoints. They are immune to earth damage. Moreover, they are strong against energy and ice damage. On the other hand, they are weak against fire damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Gazers yield 90 experience points. They carry gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/gazer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/gazer.html.twig", "/var/www/html/system/templates/library/gazer.html.twig");
    }
}
