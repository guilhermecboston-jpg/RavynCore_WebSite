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

/* library/necromancer.html.twig */
class __TwigTemplate_2e6d3af8f6afde1b7516befd83fce620 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=nightfiend\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=mutatedtiger\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Necromancers</h2>  <img src=\"images/library/necromancer.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Necromancers are powerful magicians who pursue studies on undead creatures in the haunted ruins of Drefia on Darama.Nobody knows what they intend to use their perilous knowledge for and which dreadful secrets they already have discovered, but adventurers, who have managed to escape from their realm, report that they are able to summon several kinds of undead creatures like skeletons, ghouls, and mummies. They can heal themselves and they know how to drain life energy off their opponents. Although they are quite strong fighters, they prefer distance fighting, namely shooting magic missiles and letting their summoned servants fight for them.</p>  <p>Necromancers have 580 hitpoints. They are immune to earth damage. Moreover, they are strong against death, energy and ice damage. On the other hand, they are weak against fire, holy and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Necromancers yield 580 experience points. They carry books of necromantic rituals, gold coins, poison arrows and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/necromancer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/necromancer.html.twig", "/var/www/html/system/templates/library/necromancer.html.twig");
    }
}
