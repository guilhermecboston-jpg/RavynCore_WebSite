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

/* library/monk.html.twig */
class __TwigTemplate_a87e77a78e2066a8f6cdf876b13878bd extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=moohtahwarrior\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=misguidedranged\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Monks</h2>  <img src=\"images/library/monk.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>In ancient times, long before Edron has been re-discovered, some Monks, followers of the evil god Zathroth, founded a monastery in the dungeons deep below the surface. They are not well disposed towards the explorers that are now coming there, and will attack every intruder fiercely. They are skilled fist fighters and can heal themselves.</p>  <p>Monks have 240 hitpoints. They are strong against death and holy damage. On the other hand, they are weak against physical damage. It takes 600 mana to summon these creatures but they cannot be convinced. In addition, they are able to sense invisible creatures.</p>  <p>Monks yield 200 experience points. They carry breads, gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/monk.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/monk.html.twig", "/var/www/html/system/templates/library/monk.html.twig");
    }
}
