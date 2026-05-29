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

/* library/cultbeliever.html.twig */
class __TwigTemplate_238d224acb5ca3310714a2991661c709 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=cultenforcer\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=crystalcrusher\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Cult Believers</h2> <img src=\"images/library/cultbeliever.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>The Cult Believer is a stronger version of <a href=\"?subtopic=creatures&race=cultadept\">Adepts Of The Cult</a>.</p> <p>Cult Believers have 975 hitpoints. They cannot be paralysed. Moreover, they are strong against earth, energy, fire, holy and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Cult Believers yield 850 experience points. They carry gold coins, meat and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/cultbeliever.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/cultbeliever.html.twig", "/var/www/html/system/templates/library/cultbeliever.html.twig");
    }
}
