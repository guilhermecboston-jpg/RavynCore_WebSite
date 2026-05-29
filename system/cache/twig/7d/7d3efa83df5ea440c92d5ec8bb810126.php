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

/* library/sandcrawler.html.twig */
class __TwigTemplate_700911646ce9a27b063334ddaf2bc8d2 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=sandstonescorpion\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=salamander\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Sandcrawlers</h2>  <img src=\"images/library/sandcrawler.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Sandcrawler originates from the coasts of some remote small isle. Once confined to this isle, the semi-aquatic insect became an accidental traveller on ships which restocked their supplies on this isle. This led to the spreading of  Sandcrawlers all over the known world. Extremely adaptive, they are mainly encountered in sand areas and despite their semi-aquatic nature, they are often found in the seemingly hostile climate of deserts and other desolate places. The Sandcrawler can endure extreme climates and periods of starvation with ease. They are not overly aggressive but they also know no fear. When they focus on one thing, their efforts are relentless and untiring. They usually do not prey on bigger creatures, and there is no aggression in their attacks, just frightening determination. Since they do not build huge colonies but rather live in small groups, it is wise to destroy each nest entirely to prevent further spreading of these creatures. Although they usually live in sandy areas, they often also move to more fertile areas. In their recklessness,  they often cause much harm, and only a few Sandcrawlers can destroy a whole field.</p>  <p>Sandcrawlers have 30 hitpoints. They are weak against fire damage. It takes 250 mana to summon or convince these creatures.</p>  <p>Sandcrawlers yield 20 experience points. They carry gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/sandcrawler.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/sandcrawler.html.twig", "/var/www/html/system/templates/library/sandcrawler.html.twig");
    }
}
