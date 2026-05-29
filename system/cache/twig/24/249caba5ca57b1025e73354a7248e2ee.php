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

/* library/priestess.html.twig */
class __TwigTemplate_8534c11faf3880dae7b7dcb6164fd796 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=quaraconstrictor\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=pooka\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Priestesses</h2>  <img src=\"images/library/priestess.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Priestesses came to Edron together with the monks. They are also followers of the evil god Zathroth but they roam the dungeons instead of having a home. Like the monks, they will fiercely attack every intruder into their holy realm. They are weak fighters, but have a lot of magic abilities. They shoot magic missiles at their enemies and drain mana off them, summon ghouls as reinforcements, and heal themselves.</p>  <p>Priestesses have 390 hitpoints. They are strong against death, earth and fire damage. On the other hand, they are weak against holy and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Priestesses yield 420 experience points. They carry dark rosaries, goat grasses, sling herbs and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/priestess.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/priestess.html.twig", "/var/www/html/system/templates/library/priestess.html.twig");
    }
}
