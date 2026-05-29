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

/* library/winterwolf.html.twig */
class __TwigTemplate_d99190a16533b7ba00d1b9bbb1c77517 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=wisp\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=wiltingleafgolem\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Winter Wolves</h2>  <img src=\"images/library/winterwolf.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Winter Wolves are related to normal wolves, but they have a thicker, white coat and are a bit stronger. They live at the ice islands in the north-west of Tibia, where they hunt small animals. A single Winter Wolf is rather shy, but as a pride they can be quite dangerous. And when they are hungry they even attack humans.</p>  <p>Winter Wolves have 30 hitpoints. They are strong against fire, holy and ice damage. On the other hand, they are weak against death and energy damage. It takes 260 mana to summon or convince these creatures.</p>  <p>Winter Wolves yield 20 experience points. They carry meat and winter wolf fur with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/winterwolf.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/winterwolf.html.twig", "/var/www/html/system/templates/library/winterwolf.html.twig");
    }
}
