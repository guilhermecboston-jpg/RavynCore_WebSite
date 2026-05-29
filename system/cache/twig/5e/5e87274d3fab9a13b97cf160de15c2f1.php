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

/* library/minotaurmage.html.twig */
class __TwigTemplate_b6a02110c849a2fbcc98953e9a42f56b extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=minotaur\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=minotaurhunter\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Minotaur Mages</h2>  <img src=\"images/library/minotaurmage.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Minotaur Mages are the elite of the minotaurs' army. With their magic they support the other troops in a fight. They can create energy fields and shoot fireballs or magic missiles.  As they are weak short-range fighters, guards will protect them while they operate from the second row.</p>  <p>Minotaur Mages have 155 hitpoints. They are strong against earth, energy and holy damage. On the other hand, they are weak against death and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Minotaur Mages yield 150 experience points. They carry carrots, gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/minotaurmage.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/minotaurmage.html.twig", "/var/www/html/system/templates/library/minotaurmage.html.twig");
    }
}
