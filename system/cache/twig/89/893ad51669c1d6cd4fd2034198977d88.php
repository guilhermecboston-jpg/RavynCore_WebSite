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

/* library/weakenedfrazzlemaw.html.twig */
class __TwigTemplate_834349531b3cb3c3288199dcd9c71537 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=weeper\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=waterelemental\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Weakened Frazzlemaws</h2> <img src=\"images/library/weakenedfrazzlemaw.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>The Weakened Frazzlemaw is a weaker version of <a href=\"?subtopic=creatures&race=frazzlemaw\">Frazzlemaws</a>.</p> <p>Weakened Frazzlemaws have 1200 hitpoints. They cannot be paralysed. Moreover, they are strong against death, earth, energy, fire, ice and physical damage. On the other hand, they are weak against holy damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Weakened Frazzlemaws yield 1000 experience points. They carry bones, fairy wings, frazzle skins, frazzle tongues, gold coins, great health potions, great mana potions, platinum coins, remains of a fish, skulls and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/weakenedfrazzlemaw.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/weakenedfrazzlemaw.html.twig", "/var/www/html/system/templates/library/weakenedfrazzlemaw.html.twig");
    }
}
