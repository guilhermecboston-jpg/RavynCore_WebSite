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

/* library/sheep.html.twig */
class __TwigTemplate_def04ad1bb490129ff3b60094467b789 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=shockhead\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=shark\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Sheep</h2>  <img src=\"images/library/sheep.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Sheep are domestic animals which are kept by farmers and herdsmen. They have been raised by humans for a long time to gain meat and wool. They are absolutely peaceable and live as herds in sheepfolds or on pastures. However, the owners will be upset if you kill one of them. A Tibian saying states that there is a black sheep in every herd.</p>  <p>Sheep have 20 hitpoints. They are weak against fire damage. It takes 250 mana to summon or convince these creatures.</p>  <p>Sheep yield 0 experience points. They carry meat and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/sheep.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/sheep.html.twig", "/var/www/html/system/templates/library/sheep.html.twig");
    }
}
