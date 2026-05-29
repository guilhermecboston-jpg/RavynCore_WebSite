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

/* library/lion.html.twig */
class __TwigTemplate_b014d2317c3d4ba9ec026e204257620b extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=lizardchosen\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=lich\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Lions</h2>  <img src=\"images/library/lion.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Lions are beasts of prey that live in the deserts and savannahs of Tibia. They are very quick and try to hunt their victim down to kill it with a single bite. It is recommended to attack them with distance fighting weapons.</p>  <p>Lions have 80 hitpoints. They are strong against earth and holy damage. On the other hand, they are weak against death and ice damage. It takes 320 mana to summon or convince these creatures.</p>  <p>Lions yield 30 experience points. They carry ham, meat and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/lion.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/lion.html.twig", "/var/www/html/system/templates/library/lion.html.twig");
    }
}
