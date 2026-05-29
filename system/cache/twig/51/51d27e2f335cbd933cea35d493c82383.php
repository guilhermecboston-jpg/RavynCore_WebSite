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

/* library/skunk.html.twig */
class __TwigTemplate_fab2acec7d0001b0029694b4a30f172a extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=slime\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=skeleton\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Skunks</h2>  <img src=\"images/library/skunk.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Legend has it there was once a race of mischievous black rodents who were close cousins of the squirrels. They loved to fool around and to tease others all day long. However, one day they went too far. Angered by one of their tricks, a powerful fairy cursed the whole race. From that fateful moment on, these creatures were marked with a white stripe and,more importantly, with an overwhelming stench that was unbearable to most creatures who live and breathe. However, it did not take the clever critters long to work out that they could use their nauseating stench as a weapon of self-defence. Today, these rodents are known as Skunks, and few creatures dare to anger them because of their feared smell.</p>  <p>Skunks have 20 hitpoints. It takes 200 mana to summon or convince these creatures.</p>  <p>Skunks yield 3 experience points. They rarely carry items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/skunk.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/skunk.html.twig", "/var/www/html/system/templates/library/skunk.html.twig");
    }
}
