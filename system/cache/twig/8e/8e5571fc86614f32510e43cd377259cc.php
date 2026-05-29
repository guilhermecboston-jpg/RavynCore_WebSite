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

/* library/usurperwarlock.html.twig */
class __TwigTemplate_546493e560c722baf38b82fef4db4cdf extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\"> <a style=\"float: right;\" href=\"?subtopic=creatures&race=valkyrie\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a> <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=usurperknight\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a> <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\"> <h2 style=\"float: right;\">Usurper Warlocks</h2> <img src=\"images/library/usurperwarlock.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\"> <p>The usurpers to the throne of the Lion laid siege to the town of Bounac. Their main goal being the fall of king Kesar, they are trying everything in their might to breach the old walls of the castle. Shamefully disregarding the very life and well-being of its inhabitants. The warlocks are trained in battle-magic and well-versed in a variety of war tactics. There are fewer warlocks in the ranks of the usurpers but what they lack in numbers they make up for in ruthlessness.</p> <p>Usurper Warlocks have 7500 hitpoints. They cannot be paralysed. Moreover, they are strong against fire, holy, ice and physical damage. On the other hand, they are weak against death damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p> <p>Usurper Warlocks yield 7000 experience points. They carry gold ingots, platinum coins and sometimes other items with them.</p> </div></div>";
    }

    public function getTemplateName()
    {
        return "library/usurperwarlock.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/usurperwarlock.html.twig", "/var/www/html/system/templates/library/usurperwarlock.html.twig");
    }
}
