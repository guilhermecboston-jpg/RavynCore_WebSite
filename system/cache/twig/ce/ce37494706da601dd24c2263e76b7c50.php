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

/* library/pirateskeleton.html.twig */
class __TwigTemplate_2f140d9f8f863d93d8fa764cdfdd1288 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=pixie\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=piratemarauder\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Pirate Skeletons</h2>  <img src=\"images/library/pirateskeleton.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>As cursed as the dreadful pirate ghosts but lacking their willpower, these unlucky former pirates float along the corridors as mindless undead killing machines. While personal guilt or curses of their victims might be the main reason for their sad existence, many of the Pirate Skeletons also own their being to their former captains who changed into powerful ghosts after they lost their human life. Again others are said to be the creation of necromancers or similar dark creatures.<br/>Still they seem more accustomed to killing and fighting than several other undead. Having constantly to fear to lose their lives a whole lifetime long seems to have created some fighting instincts that are still present in their old bones. More a mindless machine than anything else, they are rather weak when being on their own. Their threat increases significantly if being accompanied by a pirate ghost. Headed by a pirate ghost, Pirate Skeletons seem to obtain some of the malicious  intelligence of their leaders.</p>  <p>Pirate Skeletons have 190 hitpoints. They are immune to death damage. On the other hand, they are weak against holy damage. These creatures can neither be summoned nor convinced.</p>  <p>Pirate Skeletons yield 85 experience points. They carry gold coins and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/pirateskeleton.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/pirateskeleton.html.twig", "/var/www/html/system/templates/library/pirateskeleton.html.twig");
    }
}
