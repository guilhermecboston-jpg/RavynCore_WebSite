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

/* library/cryptshambler.html.twig */
class __TwigTemplate_a19308be37c46351ca7007e088d188e3 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=crystalspider\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=cryptdefiler\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Crypt Shamblers</h2>  <img src=\"images/library/cryptshambler.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>For a long time it was believed that the Crypt Shambler was a mere myth, and even though today most scholars agree that this undead abomination exists, little else is known about it. A common theory holds that Crypt Shamblers are created from the bodies of lesser necromancers and death cultists who were turned into undead creatures while they were still alive! Although this theory remains unconfirmed, it would help to explain the burning rage that seems to be a common trait of all Crypt Shamblers. Whatever the truth, Crypt Shamblers are dangerous undead that far exceed many other undead in power and ferocity.</p>  <p>Crypt Shamblers have 330 hitpoints. They are immune to death and earth damage and cannot be paralyzed. On the other hand, they are weak against holy damage. It takes 580 mana to convince these creatures but they cannot be summoned.</p>  <p>Crypt Shamblers yield 195 experience points. They carry gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/cryptshambler.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/cryptshambler.html.twig", "/var/www/html/system/templates/library/cryptshambler.html.twig");
    }
}
