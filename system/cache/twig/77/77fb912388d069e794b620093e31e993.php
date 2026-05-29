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

/* library/hunter.html.twig */
class __TwigTemplate_5508f702d59dbcedabf1454b7c30b406 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=husky\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=humongousfungus\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Hunters</h2>  <img src=\"images/library/hunter.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Hunters are outlaws that dwell in the large forests of Tibia. They do not only hunt animals but also attack travellers and adventurers. Although they are not strong, they are very deadly due to their quickness and their bows.</p>  <p>Hunters have 150 hitpoints. They are strong against holy damage. On the other hand, they are weak against physical damage. It takes 530 mana to convince these creatures but they cannot be summoned.</p>  <p>Hunters yield 150 experience points. They carry arrows, hunter's quivers, oranges, rolls and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/hunter.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/hunter.html.twig", "/var/www/html/system/templates/library/hunter.html.twig");
    }
}
