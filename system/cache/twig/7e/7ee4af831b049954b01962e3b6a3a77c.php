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

/* library/lizardtemplar.html.twig */
class __TwigTemplate_52ec9c17902fa379542c70c5e7e9e0a7 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=lizardzaogun\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=lizardsnakecharmer\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Lizard Templars</h2>  <img src=\"images/library/lizardtemplar.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The proud holy warriors of the lizard race follow a strange code of honour which cannot be understood by the other races. Part of this code seems to be fighting valiantly the warm-blooded races which they regard as intruders in their realm. Their thick scale skin, their incredible toughness and their unwavering determination to win a fight had made the lizard people the dominating race in Tiquanda for a long time. Even their enemies must credit them skilfulness and elegance in the usage of their exotic weapons. Probably, lizards see a fight as a religious experience. Their fighting style is obviously very formalised yet very efficient. The snake-like blade-dance that they perform in combat is only clouded by their overconfidence and their inability to accept defeat.</p>  <p>Lizard Templars have 410 hitpoints. They are immune to earth damage. Moreover, they are strong against energy and ice damage. On the other hand, they are weak against fire damage. These creatures can neither be summoned nor convinced.</p>  <p>Lizard Templars yield 155 experience points. They carry gold coins, short swords and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/lizardtemplar.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/lizardtemplar.html.twig", "/var/www/html/system/templates/library/lizardtemplar.html.twig");
    }
}
