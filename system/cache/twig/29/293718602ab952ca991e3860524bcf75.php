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

/* library/enslaveddwarf.html.twig */
class __TwigTemplate_691c3f002d7db54108e08d7d04b0dd64 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=execowtioner\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=crystalgolem\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Enslaved Dwarfs</h2>  <img src=\"images/library/enslaveddwarf.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Lost are some of the dwarfs that never joined one of the dwarven communities and aimlessly wandered the depths of the world in search of refuge. Sometimes in the ancient past they were found by 'those below' and cruelly enslaved by the masters of the depths. After generations of slavery and breeding, those dwarfs have lost all memory of their ancestry and culture, rendering them hardly more than aggressive animals of war. They lack a complicated language, communicating only with select gnarls and snarls. Their entire bitter lives are centred around battle and carnage. After their masters have completely broken their will, the Lost march in unquestioning obedience into battle whenever their cruel slavers order them to do so. It is hard to tell what motivation drives them. They seem not to revere to their masters in any way and show no joy in battle. The only emotion they are showing is incredible anger that rivals that of a rabid animal.</p>  <p>Enslaved Dwarfs have 3800 hitpoints. They are immune to fire damage and cannot be paralyzed. Moreover, they are strong against death, earth, energy and ice damage. On the other hand, they are weak against physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Enslaved Dwarfs yield 2700 experience points. They carry brown mushrooms, gold coins, iron ore, platinum coins, small amethysts, small emeralds and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/enslaveddwarf.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/enslaveddwarf.html.twig", "/var/www/html/system/templates/library/enslaveddwarf.html.twig");
    }
}
