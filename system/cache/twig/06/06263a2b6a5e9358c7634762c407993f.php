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

/* library/lumberingcarnivor.html.twig */
class __TwigTemplate_3a9a3d4e79fbdb704dd8fb63cf86a290 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=madscientist\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=lostthrower\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Lumbering Carnivors</h2> <img src=\"images/library/lumberingcarnivor.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>This species as the name already says exclusively feeds on raw meat. The very special way of digesting its prey leads to very unique products a hunter can obtain. The items of interest are little glass plates that arise in the so called process of glassification. They are coveted materials for craftsmanship.<br/>During their development, they go through various stages which ultimately manifest in specific habits and appearance.<br/><br/>The early stage of development is called lumbering carnivor. At that point this species is not very robust and its shell is still quite weak. Nevertheless it is already able to hurt careless adventurers. </p> <p>Lumbering Carnivors have 2600 hitpoints. They cannot be paralysed. Moreover, they are strong against physical damage. On the other hand, they are weak against fire damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Lumbering Carnivors yield 1452 experience points. They carry axes, blue glass plates, platinum coins and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/lumberingcarnivor.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/lumberingcarnivor.html.twig", "/var/www/html/system/templates/library/lumberingcarnivor.html.twig");
    }
}
