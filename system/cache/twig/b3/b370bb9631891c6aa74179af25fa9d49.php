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

/* library/mummy.html.twig */
class __TwigTemplate_33638c379737b7b074187d54b01ebb11 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=mutatedbat\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=moohtant\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Mummies</h2>  <img src=\"images/library/mummy.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Mummies are undead monsters that can be found in the ancient pyramids and ruins in the north of Tibia. No one knows where they come from, but they guard the burial chambers and attack every adventurer trying to get the legendary treasures. Their scaring sight can paralyze the bravest fighters, and they try to drain life energy off their shocked victims. Be aware of their poisonous daggers!</p>  <p>Mummies have 240 hitpoints. They are immune to death and earth damage and cannot be paralyzed. Moreover, they are strong against ice damage. On the other hand, they are weak against holy damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Mummies yield 150 experience points. They carry flasks of embalming fluid, gauze bandages, gold coins, worms and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/mummy.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/mummy.html.twig", "/var/www/html/system/templates/library/mummy.html.twig");
    }
}
