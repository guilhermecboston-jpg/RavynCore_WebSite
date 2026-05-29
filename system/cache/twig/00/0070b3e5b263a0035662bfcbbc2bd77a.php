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

/* library/redeemedsoul.html.twig */
class __TwigTemplate_5747338171613984f450a95f1ef4ecb3 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=renegadeknight\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=realityreaver\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Redeemed Souls</h2>  <img src=\"images/library/redeemedsoul.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>If someone knows how to free a tainted soul he may transform it into a redeemed soul. Souls delivered in such a way are by all means thankful towards their liberator. Unlike the aggressive tainted souls, they are not only peaceable but even timid, wherefore they leave quickly and vanish shortly after their liberation.</p>  <p>Redeemed Souls have 250 hitpoints. They are immune to holy damage and cannot be paralyzed. Moreover, they are strong against energy and physical damage. These creatures can neither be summoned nor convinced.</p>  <p>Redeemed Souls yield 0 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/redeemedsoul.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/redeemedsoul.html.twig", "/var/www/html/system/templates/library/redeemedsoul.html.twig");
    }
}
