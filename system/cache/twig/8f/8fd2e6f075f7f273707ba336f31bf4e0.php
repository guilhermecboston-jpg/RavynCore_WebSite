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

/* library/merlkin.html.twig */
class __TwigTemplate_dfeea6593bac2a1b36633c606f5a9e37 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=metalgargoyle\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=mercuryblob\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Merlkins</h2>  <img src=\"images/library/merlkin.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Even a few of the ape people are able to command some kind of strange magic. It is hard to say which role the Merlkins play in the ape society, but they are probably described best as some kind of primitive witch doctors. It is another mystery how those primitives were able to develop any kind of magic at all, but considering the fact that those apes raid the human settlements to steal their tools, it is very likely that they have also stolen their knowledge about magic. Their ability to wield magic hints at a greater intelligence than that of their cousins with whom they seem to live in an uneasy peace. Animosities between the different breeds have been reported, so it is unlikely that the Merlkin are a kind of elite among the apes. Still they work together with the other ape races and their strange magic combined with the skills of the others form very effective attack forces.</p>  <p>Merlkins have 235 hitpoints. They are strong against energy, fire and holy damage. On the other hand, they are weak against death and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Merlkins yield 145 experience points. They carry bananas, gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/merlkin.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/merlkin.html.twig", "/var/www/html/system/templates/library/merlkin.html.twig");
    }
}
