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

/* library/evilprospector.html.twig */
class __TwigTemplate_c8fdbe068d79f0d87787f5f034bbbefd extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=execowtioner\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=enslaveddwarf\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Evil Prospectors</h2> <img src=\"images/library/evilprospector.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>Ghost-like remnants of individuals full of greed and evil to the core. Many of them foremen and overseers in life, they still come to check on their spectral workforce from time to time and help out lesser ghosts with their aggressive charges and furious attacks.</p> <p>Evil Prospectors have 8500 hitpoints. They cannot be paralysed. Moreover, they are strong against energy, holy and physical damage. On the other hand, they are weak against death damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Evil Prospectors yield 9000 experience points. They carry platinum coins, spectral silver nuggets and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/evilprospector.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/evilprospector.html.twig", "/var/www/html/system/templates/library/evilprospector.html.twig");
    }
}
