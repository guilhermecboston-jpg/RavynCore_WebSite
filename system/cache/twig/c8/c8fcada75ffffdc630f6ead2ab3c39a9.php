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

/* library/cursedprospector.html.twig */
class __TwigTemplate_2610776f5bc6d2be199922d76ceedf8f extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=cyclops\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=cursedbook\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Cursed Prospectors</h2> <img src=\"images/library/cursedprospector.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>Long deceased miners, cursed to roam the hollows of drifts and mines. Some of them humble and diligent in life, others greedy and ungrateful until death and beyond. They are ghost-like creatures with devious attacks and tend to call for the aid of other ghosts when in distress.</p> <p>Cursed Prospectors have 3900 hitpoints. They cannot be paralysed. Moreover, they are strong against holy and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Cursed Prospectors yield 5250 experience points. They carry flash arrows, great spirit potions, platinum coins, spectral silver nuggets and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/cursedprospector.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/cursedprospector.html.twig", "/var/www/html/system/templates/library/cursedprospector.html.twig");
    }
}
