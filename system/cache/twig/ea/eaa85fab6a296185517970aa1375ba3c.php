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

/* library/werelioness.html.twig */
class __TwigTemplate_dd66b9ad6be8ce4de3d10d478d30f884 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=werelion\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=werehyaena\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Werelionesses</h2> <img src=\"images/library/werelioness.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>The werelions are fundamentally different from all other known were creatures: They have learned to control the curse. This means that in their were form they don't turn into wild beasts that mindlessly attack anyone who comes close. Rather, they have the same control over themselves in this form as they have as humans. They can also control their transformation and consciously turn into their werelion form or back into human shape. Gradually, the werelions got so used to the curse that they saw it as a gift rather than a burden. They therefore began to deliberately pass the curse on to others whom they considered worthy - and from then on no longer called it \"the Curse\" but \"the Gift\".</p> <p>Werelionesses have 3000 hitpoints. They cannot be paralysed. Moreover, they are strong against death, earth and fire damage. On the other hand, they are weak against holy and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Werelionesses yield 2300 experience points. They carry gold coins, ham, lion's manes, meat, platinum coins, rapiers, soul orbs and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/werelioness.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/werelioness.html.twig", "/var/www/html/system/templates/library/werelioness.html.twig");
    }
}
