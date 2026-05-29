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

/* library/behemoth.html.twig */
class __TwigTemplate_b44b0d3c3a0f2e053aa8919c0de151a8 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=wraith\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=bear\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Behemoths</h2>  <img src=\"images/library/behemoth.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Behemoths are giant monsters that live in the ancient town deep below Edron. They look a bit like cross-breeds of humans and bulls and even talk in human language, but nobody knows yet where they come from. Although they are of minor intelligence, they are very strong fighters and throw huge stones at their opponents.</p>  <p>Behemoths have 4000 hitpoints. They cannot be paralyzed. Moreover, they are strong against earth, energy, fire, holy and physical damage. On the other hand, they are weak against death and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Behemoths yield 2500 experience points. They carry assassin stars, battle stones, double axes, gold coins, meat, platinum coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/behemoth.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/behemoth.html.twig", "/var/www/html/system/templates/library/behemoth.html.twig");
    }
}
