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

/* library/pigeon.html.twig */
class __TwigTemplate_2e4d1f5662ebec6356398931778f15b9 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=pig\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=phantasm\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Pigeons</h2>  <img src=\"images/library/pigeon.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>The Pigeon has turned into a massive nuisance that plagues most cities. Apparently drawn to the centres of civilisation, Pigeons prosper on the garbage often thoughtlessly thrown away. Every attempt to exterminate the Pigeon has proven futile in the end. The only successful attempt has been made by the Thaian magic guild that had giant crystal spheres hovering atop the Thaian guard towers. The crystal spheres pulsed periodically in all colours of the spectrum and scared the Pigeons away. But the inhabitants of Thais grew deeply annoyed by the flashing lights, and even the claim that the crystals added a unique sight to Thais could not prevent the people demanding their being removed. In the end, the crystal spheres were dismantled and returned to the guild house. Still people complained to the king to do something against the pressing pigeon problem. Yet no bounty nor poison campaigns yielded the result they hoped for. Meanwhile, the people have begun to accuse each other of feeding pigeons, and the term 'pigeon friend' has become a common insult. King Tibianus had several people flogged who had claimed the king might be in league with the pigeons, and things are increasingly getting out of hand. The situation escalated so drastically that priests have even claimed that pigeons might be the eyes of Zathroth, spying on people and sowing hatred into their hearts.</p>  <p>Pigeons have 30 hitpoints. They are weak against death and earth damage. These creatures can neither be summoned nor convinced.</p>  <p>Pigeons yield 0 experience points. They carry nothing with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/pigeon.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/pigeon.html.twig", "/var/www/html/system/templates/library/pigeon.html.twig");
    }
}
