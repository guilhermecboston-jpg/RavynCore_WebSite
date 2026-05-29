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

/* library/waterelemental.html.twig */
class __TwigTemplate_b2a23582f193a9806d2e53d0e7a008df extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=weeper\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=waterbuffalo\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Water Elementals</h2>  <img src=\"images/library/waterelemental.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Water Elementals are as powerful as a tidal wave and as moody as the sea that gave birth to them. Their interest in our existence is limited at best and they are usually summoned by sorcerers than materialising on their own. The apparently uncontrolled Water Elementals seem to follow no purpose that we mortals could comprehend. Some sorcerers believe that they react hostile to living creatures because they feel offended by all the water a living creature contains. Although enigmatic in their motivation, they are indisputably intelligent and possess an array of spells that centre around water, poison and cold.</p>  <p>Water Elementals have 550 hitpoints. They are immune to earth, fire and ice damage and cannot be paralyzed. Moreover, they are strong against death, holy and physical damage. On the other hand, they are weak against energy damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Water Elementals yield 650 experience points. They carry fish, gold coins, platinum coins, strong health potions, strong mana potions and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/waterelemental.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/waterelemental.html.twig", "/var/www/html/system/templates/library/waterelemental.html.twig");
    }
}
