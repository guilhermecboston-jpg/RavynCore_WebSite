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

/* library/fireelemental.html.twig */
class __TwigTemplate_9cc928a97221ef9efd87923df67328cf extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=firestarter\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=firedevil\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Fire Elementals</h2>  <img src=\"images/library/fireelemental.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Fire Elementals are entities consisting only of fire. They have been spotted in the wake of demons, and nobody knows whether they are summoned by them or whether they are independent creatures rising out of fire. They are very dangerous fighters and create fire fields or shoot fireballs at their opponents.</p>  <p>Fire Elementals have 280 hitpoints. They are immune to death and fire damage and cannot be paralyzed. On the other hand, they are weak against ice damage. It takes 690 mana to summon these creatures but they cannot be convinced. In addition, they are able to sense invisible creatures.</p>  <p>Fire Elementals yield 220 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/fireelemental.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/fireelemental.html.twig", "/var/www/html/system/templates/library/fireelemental.html.twig");
    }
}
