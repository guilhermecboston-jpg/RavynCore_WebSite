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

/* library/sibang.html.twig */
class __TwigTemplate_705bd6cc6bf7daff99eb9d3f509ca5e7 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=sightofsurrender\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=shockhead\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Sibangs</h2>  <img src=\"images/library/sibang.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Sibang seems playful and harmless but this impression is misleading. They use their incredible agility to attack enemies from a safe distance and to swiftly evade counter-attacks. Their hit-and-run tactic proves especially effective in the familiar territory of the jungle. Attacking suddenly from the cover of trees, they throw volleys of different projectiles and then retreat to safety to prepare for their next attack. Ever curious and adventurous, they are the apes that are most often away from their homes. Sometimes they serve as scouts and spies to prepare a bigger assault. Using trees like humans are using roads, it is nearly impossible to catch them.</p>  <p>Sibangs have 225 hitpoints. They are strong against fire and holy damage. On the other hand, they are weak against death and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Sibangs yield 105 experience points. They carry bananas, gold coins, oranges, small stones and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/sibang.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/sibang.html.twig", "/var/www/html/system/templates/library/sibang.html.twig");
    }
}
