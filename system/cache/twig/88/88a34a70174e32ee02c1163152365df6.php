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

/* library/slime.html.twig */
class __TwigTemplate_f6978be5dfb4dbe6fce044cd346f4af1 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=slug\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=skunk\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Slimes</h2>  <img src=\"images/library/slime.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Slimes are not real creatures but very strange entities which occur in the dungeons of Tibia. They move by flowing rather than walking. Their favourite tactic is to enclose an enemy by separating and floating around him. Their attack is quite heavy, but their defence is weak. Upon their death, they turn into a cloud of poisonous gas that vanishes quickly into thin air.</p>  <p>Slimes have 150 hitpoints. They are immune to earth damage. Moreover, they are strong against ice damage. On the other hand, they are weak against energy and fire damage. These creatures can neither be summoned nor convinced.</p>  <p>Slimes yield 160 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/slime.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/slime.html.twig", "/var/www/html/system/templates/library/slime.html.twig");
    }
}
