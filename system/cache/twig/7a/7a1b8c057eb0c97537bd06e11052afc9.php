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

/* library/boogy.html.twig */
class __TwigTemplate_bac3f63bc8d940adabefbba04e22757b extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">  <a style=\"float: right;\" href=\"?subtopic=creatures&race=braindeath\">next <img src=\"images/arrow_right.gif\" width=\"15\" height=\"11\" border=\"0\"/></a>  <a style=\"position: absolute;\" href=\"?subtopic=creatures&race=bonelord\"><img src=\"images/arrow_left.gif\" width=\"15\" height=\"11\" border=\"0\"/> previous</a>  <div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\"><a href=\"?subtopic=creatures\"><img src=\"images/arrow_up.gif\" width=\"11\" height=\"15\" border=\"0\"/> back</a></div></div><div style=\"position: relative; top: 25px; clear: both; \"><div style=\"height: 64px; margin-bottom: 5px;\">  <h2 style=\"float: right;\">Boogies</h2>  <img src=\"images/library/boogy.gif\"/></div><div style=\"margin-bottom: 35px; clear: both;\">  <p>Boogies are a rather twisted kind of fae. They have a chubby body covered in shaggy fur, a tasseled tail, short legs and very long, clawed arms that are almost touching the floor. Their maw is huge compared to their body and a spiky, menacing horn protrudes from their foreheads. Other than pixies, nymphs or fauns they favour underground caves and tunnels over forests or lush meadows. Only at night, they are roaming the surface, chasing other fae and visitors to Feyrist alike. Boogies devour smaller animals like squirrels, rabbits or badgers but on the quiet the fae tell that they also feed on fairies or pookas if they catch them. As the fae emerge from mortals' pleasant dreams the boogies don't really fit into the mould. In fact they were once clumsy yet peaceful fae, but they are now twisted and tainted by a mysterious, sinister force that is threatening Feyrist as well as the rest of Tibia. Boogies initially emerged from mortals' dreams about tasty food.</p>  <p>Boogies have 1300 hitpoints. They cannot be paralyzed. Moreover, they are strong against death, earth, holy, ice and physical damage. These creatures can neither be summoned nor convinced. In addition, they are able to sense invisible creatures.</p>  <p>Boogies yield 950 experience points. They carry fairy wings, gold coins, shimmering beetles, strong health potions and sometimes other items with them.</p>  </div></div>";
    }

    public function getTemplateName()
    {
        return "library/boogy.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "library/boogy.html.twig", "/var/www/html/system/templates/library/boogy.html.twig");
    }
}
