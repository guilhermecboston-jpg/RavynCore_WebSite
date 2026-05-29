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

/* library/cultacolyte.html.twig */
class __TwigTemplate_3c8146eb8657a37e2764bdff875c9410 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=cultadept\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=acidblob\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Acolytes Of The Cult</h2>  <img src=\"images/library/cultacolyte.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Acolytes of the Cult received some training in the dark arts, at disposal to the cult. They are proud of their status and are usually quite fanatic about the cult. Acolytes of the Cult feel superior to outsiders and often think the powers bestowed upon them make them invincible. They only respect higher ranks of the cult whom they obey like slaves their masters. Their magic is still fairly weak and does by far not match their ego. Having gained a glimpse at the work of the cult, it is not easy to sacrifice their curiosity and so they use their whole energy to strive for the higher ranks. Acolytes of the Cult are only involved in affairs if they are considered of importance for the cult.</p>  <p>Acolytes Of The Cult have 390 hitpoints. They are strong against earth, holy and ice damage. On the other hand, they are weak against death, energy and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Acolytes Of The Cult yield 300 experience points. They carry gold coins, rope belts and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/cultacolyte.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/cultacolyte.html.twig", "/var/www/html/system/templates/library/cultacolyte.html.twig");
    }
}
