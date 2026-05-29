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

/* library/hideousfungus.html.twig */
class __TwigTemplate_ab2375f34eefffcf5861fc3fc24f75df extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=humongousfungus\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=hero\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Hideous Fungi</h2>  <img src=\"images/library/hideousfungus.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>With the Humongous Fungus being an example for a mushroom drawn to turn evil, the Hideous Fungus is the epitome of mushroom evil. In fact they originate as Humongous Fungi that are so evil that they begin to change and ultimately end in destroying themselves.Their evilness materialises as deformation and an inner rot that drives the fungus to the brink of insanity. Hideous Fungi seems to not care about planning and safety. They are by far more often encountered alone than their yet untainted kin. Sometimes they are found wandering aimlessly in remote tunnels, often chasing something that they forgot about a long time ago. While the Hideous Fungi use their physical and natural abilities as aptly as any of their kin, their attacks lack finesse and often seem utterly random and chaotic. Their only interest seems to be to do as much harm as possible. Where the Humongous Fungus simply evil, the Hideous Fungus is pure destruction. It is not known if the Hideous Fungus is aware of its demise getting closer or if it is pain that drives it to these merciless frenzies. What is certain is the fact that the fungus seems to be searching for death, almost provoking it. Only recently some daring explorers might have shed some light on this matter. Not only have they noticed that from the dead body of a Hideous Fungus a group of Humongous Fungi will grow after a while, but also that their victims often fall mysteriously ill and die, seemingly never recovering from the wound they got in a battle with a Hideous Fungus. So it might be entirely possible that the rampages of the Hideous Fungus, whether an act of planning or not, might be connected to the reproduction of the fungi of evil.</p>  <p>Hideous Fungi have 4600 hitpoints. They are immune to earth damage and cannot be paralyzed. Moreover, they are strong against death, energy, fire, holy and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Hideous Fungi yield 2900 experience points. They carry envenomed arrows, gold coins, hideous chunks, mushroom pies, platinum coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/hideousfungus.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/hideousfungus.html.twig", "/var/www/html/system/templates/library/hideousfungus.html.twig");
    }
}
