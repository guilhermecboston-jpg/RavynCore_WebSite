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

/* library/squirrel.html.twig */
class __TwigTemplate_2fba5121b838fe4ab35cd36137e32055 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=stalker\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=spitter\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Squirrels</h2>  <img src=\"images/library/squirrel.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The impish Squirrel is said to be a distant relative of skunks and leprechauns. The original diminutive Squirrels grew to enormous proportions after eating nuts from Crunor's blessed trees of life. The legend goes that the first Squirrels who ate the nuts became immortal and grew to Squirrels as large as houses over the time. Hunters avoid preying on Squirrels. The little rodents are not only extremely swift, but there is also a legend that says that the giant Squirrels take bloody revenge on all killers of their descendants. Anyway, Squirrels are also considered as force of good which puts them in opposition to the evil penguins. There seems to be a blood feud between Squirrels and penguins which is proven by the fact that you never encounter Squirrels and penguins in the same area.</p>  <p>Squirrels have 20 hitpoints. It takes 220 mana to summon or convince these creatures.</p>  <p>Squirrels yield 0 experience points. They carry acorns and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/squirrel.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/squirrel.html.twig", "/var/www/html/system/templates/library/squirrel.html.twig");
    }
}
