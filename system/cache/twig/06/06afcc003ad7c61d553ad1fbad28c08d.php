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

/* library/cat.html.twig */
class __TwigTemplate_694e5eb12225a474553f8504073ec054 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=caverat\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=carrionworm\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Cats</h2>  <img src=\"images/library/cat.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Tibian Cats were bred from a huge, tiger-like species. It took many centuries and the help of alchemy and magic until the domestic Cat started to take shape. The first Cats that were small enough not to devour their owners were highly prized. For a long time, only the highest nobility could afford a Cat as a pet. In the following centuries wars, misfortunes and the  independent spirit of the Cats led to several escapes of this furry pet. In freedom, the Cats could rely on their old predatory instincts and though, they survived and prospered. Over the years, Cats became more and more common. Nowadays, it is not unusual that a farmer has one or two Cats on his property. Some loners even spend their lives on the city streets on their own. The Cats of the nobility are still highly prized and some pure breed can boast a more impressive and elaborate family tree than its owner.</p>  <p>Cats have 20 hitpoints. It takes 220 mana to summon or convince these creatures.</p>  <p>Cats yield 0 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/cat.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/cat.html.twig", "/var/www/html/system/templates/library/cat.html.twig");
    }
}
