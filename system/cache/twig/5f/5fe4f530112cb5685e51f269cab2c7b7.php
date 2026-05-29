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

/* library/lizardsnakecharmer.html.twig */
class __TwigTemplate_5a5ed2fe4fc783539c0bfba1221500a8 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=lizardtemplar\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=lizardsentinel\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Lizard Snakecharmers</h2>  <img src=\"images/library/lizardsnakecharmer.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Half priest and half wizard, Lizard Snakecharmers seem to be the spiritual leaders of the lizard people. They are skilled in casting several spells and show a strong affinity to snakes and poison. Like snakes, which they are assumed to worship, they like to wait until their victim shows a weakness that allows them to strike. Keeping their enemies at distance, their sudden attacks often take the victims by surprise which gives the Lizard Snakecharmers an edge in combat. Recently, they have settled their quarrels with the warriors of their race to form a formidable team to fight against their common enemy and to fend off any intruders in their territory.</p>  <p>Lizard Snakecharmers have 325 hitpoints. They are immune to earth damage. Moreover, they are strong against energy and ice damage. On the other hand, they are weak against fire and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Lizard Snakecharmers yield 210 experience points. They carry dead snakes, gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/lizardsnakecharmer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/lizardsnakecharmer.html.twig", "/var/www/html/system/templates/library/lizardsnakecharmer.html.twig");
    }
}
