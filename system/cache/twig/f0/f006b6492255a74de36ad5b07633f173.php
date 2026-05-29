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

/* library/minotaurarcher.html.twig */
class __TwigTemplate_238fff7559e01180fde879fe83cb4791 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=minotaurguard\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=minotauramazon\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Minotaur Archers</h2>  <img src=\"images/library/minotaurarcher.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Minotaur Archers form the artillery of the minotaurs' army. Using their crossbows they shoot bolts at their enemies. Many adventurers have died in the hail of missiles. Usually, they are accompanied by other types of minotaurs.</p>  <p>Minotaur Archers have 100 hitpoints. They are strong against fire and holy damage. On the other hand, they are weak against death and ice damage. It takes 390 mana to summon or convince these creatures.</p>  <p>Minotaur Archers yield 65 experience points. They carry bolts, broken crossbows, gold coins, piercing bolts and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/minotaurarcher.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/minotaurarcher.html.twig", "/var/www/html/system/templates/library/minotaurarcher.html.twig");
    }
}
