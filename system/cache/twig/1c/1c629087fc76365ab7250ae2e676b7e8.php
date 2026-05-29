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

/* library/silencer.html.twig */
class __TwigTemplate_131b0059adfbb5dfdf457b3ac257f766 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=silverrabbit\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=sightofsurrender\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Silencers</h2>  <img src=\"images/library/silencer.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The silencers are roaming in packs and will hunt down everything which is too loud for their sensitive ears and does not belong to their kin. Of course, only if their victim is smaller or weaker. It is rumoured that they actually communicate with each other. They seem to call other silencers for help or even organise themselves in some way. However, if they are aggravated in any way, they are extremely tough and unpredictable adversaries.</p>  <p>Silencers have 5400 hitpoints. They are immune to earth damage. Moreover, they are strong against death, energy, fire, ice and physical damage. On the other hand, they are weak against holy damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Silencers yield 5100 experience points. They carry gold coins, platinum coins, silencer claws and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/silencer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/silencer.html.twig", "/var/www/html/system/templates/library/silencer.html.twig");
    }
}
