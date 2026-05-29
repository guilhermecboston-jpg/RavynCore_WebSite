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

/* library/falconpaladin.html.twig */
class __TwigTemplate_6ad0e6ea8e2bfb5c7291c2effa8bccb0 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=faun\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=falconknight\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Falcon Paladins</h2> <img src=\"images/library/falconpaladin.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>Falcon Paladins are members of the Order of the Falcon. A once honourable and revered order of knights. They fell victim to a curse centuries ago and are now mere shadows of their former, noble self. The powerful paladins are masters of the bow and crossbow. Their arrows rarely miss and whatever still stands where one of them hits, is brought to fall by the other paladin you didn't see. Their will to protect the order is unbroken and they are formidable enemies on almost every account.</p> <p>Falcon Paladins have 8500 hitpoints. They cannot be paralysed. Moreover, they are strong against death and physical damage. On the other hand, they are weak against holy damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Falcon Paladins yield 6544 experience points. They carry assassin stars, great spirit potions, onyx arrows, platinum coins, small amethysts, small diamonds, small emeralds, small rubies, small topazes and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/falconpaladin.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/falconpaladin.html.twig", "/var/www/html/system/templates/library/falconpaladin.html.twig");
    }
}
