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

/* library/filthtoad.html.twig */
class __TwigTemplate_0e082d2d7eadad65e2ccc5497138aaea extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=firedevil\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=feversleep\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Filth Toads</h2>  <img src=\"images/library/filthtoad.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The swamps, bogs and ponds of Tibia are not exactly known to be the cleanest of places. Of course you can also find a lot of frogs, snakes and toads in those areas - but none of them is as vicious as the Filth Toad. It is a creature attracted by extremely dirty waters and it is somewhat tougher than a normal toad. Filth Toads are generally very old and quite possibly they have already fought for their survival since several decades.</p>  <p>Filth Toads have 185 hitpoints. They are strong against earth and ice damage. On the other hand, they are weak against fire damage. These creatures can neither be summoned nor convinced.</p>  <p>Filth Toads yield 90 experience points. They carry fish, gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/filthtoad.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/filthtoad.html.twig", "/var/www/html/system/templates/library/filthtoad.html.twig");
    }
}
