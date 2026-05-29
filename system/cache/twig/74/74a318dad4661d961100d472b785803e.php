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

/* library/toad.html.twig */
class __TwigTemplate_fca0f5935d980c2b42d3f54acf2fd60a extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=tortoise\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=tiger\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Toads</h2>  <img src=\"images/library/toad.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Toads have little in common with harmless little frogs. Aggressive and poisonous, they seem to regard everything that is moving as some kind of lunch. They attack without hesitation and use their gluey and poisonous spittle to weaken the opponent before they challenge it in close combat. Ferocious like no other reptile, they develop a berserk rage in every battle. Even without teeth, they can bite with the crushing force of a giant clam or hit the enemy with there long tongues at lightning speed.<br/>They use their powerful legs to jump towards their opponents during which they are able to reach astonishing if not frightening speed. Given their ability to slow down opponents and to speed up themselves, it is quite likely that they can cope with almost every opponent in close combat.</p>  <p>Toads have 135 hitpoints. They are strong against earth and ice damage. On the other hand, they are weak against fire damage. It takes 400 mana to summon these creatures but they cannot be convinced.</p>  <p>Toads yield 60 experience points. They carry fish, gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/toad.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/toad.html.twig", "/var/www/html/system/templates/library/toad.html.twig");
    }
}
