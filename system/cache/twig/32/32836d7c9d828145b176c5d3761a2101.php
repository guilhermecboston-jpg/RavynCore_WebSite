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

/* library/humongousfungus.html.twig */
class __TwigTemplate_364a639464f6ed7382c7f977c344f100 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=hunter\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=hideousfungus\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Humongous Fungi</h2>  <img src=\"images/library/humongousfungus.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Gnomish lore tells us that fungi come in different variants. Some are huge, some are small. Some are colourful, some look dull. Some are bitter, some are sweet. And some are good while others are utterly evil. The Humongous Fungus belongs to the latter category. Each of them is driven by sinister impulses of malignant evil. Even a Humongous Fungus starts out small, though. Far too small for the evil they contain, they are mischievous creatures that enjoy harassing and tormenting other creatures. They often lay simple traps for the unwary, steal things or destroy food. While a nuisance as long as they are small, the true threat arises when they grow in size and strength. If that happens, the former loners band together in groups and become a destructive force to be reckoned with. There seems little that hey fear in numbers, although they seem to not care much about a fallen comrade. With no regard for their own safety, they attack everything that promises a good deal of destruction and pain. Through their raw powers they would be a formidable threat already, additionally they also have several disturbing mushroom powers at their disposal that are usually used more instinctively then planned. It actually seems unlikely that they can control their abilities at all. Though they enjoy killing and slaughtering, they sometimes take prisoners and torture them in their lairs that they often create in some remote caves. Only there they seem to pursue their only non-evil pastime: singing. With their lovely baritone voices they are able to produce melodies of astonishing beauty. Their lead singers are usually the most humongous of the bunch. Since they are highly territorial it has become common for underground explorers to mark caves in which fungi singing was heard as a warning to other travellers.</p>  <p>Humongous Fungi have 3400 hitpoints. They are immune to earth damage and cannot be paralyzed. Moreover, they are strong against death, energy, fire, holy and ice damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Humongous Fungi yield 2600 experience points. They carry brown pieces of cloth, drill bolts, gold coins, humongous chunks, mushroom pies, platinum coins, white pieces of cloth and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/humongousfungus.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/humongousfungus.html.twig", "/var/www/html/system/templates/library/humongousfungus.html.twig");
    }
}
