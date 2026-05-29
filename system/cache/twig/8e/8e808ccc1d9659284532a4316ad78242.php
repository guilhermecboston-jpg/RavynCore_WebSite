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

/* library/hyaena.html.twig */
class __TwigTemplate_6bdb949d81932493f9efc178b325a188 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=hydra\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=husky\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Hyaenas</h2>  <img src=\"images/library/hyaena.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Long regarded only as a scavenger, the Hyaena is quite capable of bringing down prey as large as a deer. This strong, stocky beast is found in the Daramian deserts. Its jaws are powerful, in proportion to its size, and quite dangerous. Being truly the craven cowards they have often been depicted as, they are fast to abandon a fight and flee. They usually hunt in packs, mostly at night. They chase their prey until it is exhausted, then the pack sets upon its victim and disembowels it. These noisy animals have several types of cries and bloodcurdling howls. They make a maniacal laughing sound when attacking which turns rapidly into a miserable whimper if they suffered from too many counterattacks and see their lives endangered.</p>  <p>Hyaenas have 60 hitpoints. It takes 275 mana to summon or convince these creatures.</p>  <p>Hyaenas yield 20 experience points. They carry meat and worms with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/hyaena.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/hyaena.html.twig", "/var/www/html/system/templates/library/hyaena.html.twig");
    }
}
