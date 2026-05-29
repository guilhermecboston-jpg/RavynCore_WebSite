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

/* spell.html.twig */
class __TwigTemplate_3036f904b07636ef4c56431bb4e20c16 extends \Twig\Template
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
        echo "<div class=\"BoxContent\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/scroll.gif);\">
\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
\t\t<tbody>
\t\t<tr>
\t\t\t<td><img alt=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "name", [], "any", false, false, false, 5), "html", null, true);
        echo "\" src=\"images/icons-spells/";
        echo twig_escape_filter($this->env, ($context["imageName"] ?? null), "html", null, true);
        echo "\" width=\"32\" height=\"32\"></td>
\t\t\t<td width=\"90%\">
\t\t\t\t<center><h2>";
        // line 7
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</h2></center>
\t\t\t</td>
\t\t\t<td><img alt=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "name", [], "any", false, false, false, 9), "html", null, true);
        echo "\" src=\"images/icons-spells/";
        echo twig_escape_filter($this->env, ($context["imageName"] ?? null), "html", null, true);
        echo "\" width=\"32\" height=\"32\"></td>
\t\t</tr>
\t\t</tbody>
\t</table>
\t<br>";
        // line 13
        echo twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "description", [], "any", false, false, false, 13);
        echo "<br><br><br>
\t<div class=\"TableContainer\">
\t\t<div class=\"CaptionContainer\">
\t\t\t<div class=\"CaptionInnerContainer\">
\t\t\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
        // line 17
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
        // line 18
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
        // line 19
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
        // line 20
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t\t<div class=\"Text\">Spell Information</div>
\t\t\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
        // line 22
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
        // line 23
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
        // line 24
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
        // line 25
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t</div>
\t\t</div>
\t\t<table class=\"Table2\" cellpadding=\"0\" cellspacing=\"0\">
\t\t\t<tbody>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"15%\">Name:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "name", [], "any", false, false, false, 42), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"15%\">Formula:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 46
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "words", [], "any", false, false, false, 46), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Vocation:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 50
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "vocation", [], "any", false, false, false, 50), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Group:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 54
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "group", [], "any", false, false, false, 54)), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Type:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 58
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "type", [], "any", false, false, false, 58)), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"15%\">Cooldown:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "cooldown", [], "any", false, false, false, 62), "html", null, true);
        echo "s (Group: ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "groupCooldown", [], "any", false, false, false, 62), "html", null, true);
        echo "s)</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t";
        // line 64
        if ((twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "amount", [], "any", false, false, false, 64) > 0)) {
            // line 65
            echo "\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Amount:</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
            // line 67
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "amount", [], "any", false, false, false, 67), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 70
        echo "\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Exp Lvl:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 72
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "level", [], "any", false, false, false, 72), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Mana:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 76
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "mana", [], "any", false, false, false, 76), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Price:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 80
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "price", [], "any", false, false, false, 80), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>City:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 84
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "city", [], "any", false, false, false, 84), "html", null, true);
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<td>Premium:</td>
\t\t\t\t\t\t\t\t\t\t\t\t<td>";
        // line 88
        echo ((twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "isPremium", [], "any", false, false, false, 88)) ? ("yes") : ("no"));
        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t</tbody>
\t\t</table>
\t</div>
\t";
        // line 103
        if (twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "rune_information", [], "any", false, false, false, 103)) {
            // line 104
            echo "\t\t<br>
\t\t<div class=\"TableContainer\">
\t\t\t<div class=\"CaptionContainer\">
\t\t\t\t<div class=\"CaptionInnerContainer\">
\t\t\t\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
            // line 108
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
            // line 109
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
            // line 110
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t\t\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
            // line 111
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t\t\t<div class=\"Text\">Rune Information</div>
\t\t\t\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
            // line 113
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 114
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t\t\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
            // line 115
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
            // line 116
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<table class=\"Table2\" cellpadding=\"0\" cellspacing=\"0\">
\t\t\t\t<tbody>
\t\t\t\t<tr>
\t\t\t\t\t<td>
\t\t\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"15%\">Name:</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
            // line 133
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "rune_information", [], "any", false, false, false, 133), "name", [], "any", false, false, false, 133), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Vocation:</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
            // line 137
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "rune_information", [], "any", false, false, false, 137), "vocation", [], "any", false, false, false, 137), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Group:</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
            // line 141
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "rune_information", [], "any", false, false, false, 141), "group", [], "any", false, false, false, 141), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Exp Lvl:</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
            // line 145
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "rune_information", [], "any", false, false, false, 145), "level", [], "any", false, false, false, 145), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Mag Lvl:</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
            // line 149
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["dados"] ?? null), "rune_information", [], "any", false, false, false, 149), "magic_level", [], "any", false, false, false, 149), "html", null, true);
            echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t</div>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t";
        }
        // line 165
        echo "
\t<br>
\t<center>
\t\t<form action=\"?subtopic=spells\" method=\"post\" style=\"padding:0px;margin:0px;\">
\t\t\t<input type=\"hidden\" name=\"vocation\" value=\"\">
\t\t\t<input type=\"hidden\" name=\"group\" value=\"\">
\t\t\t<input type=\"hidden\" name=\"type\" value=\"\">
\t\t\t<input type=\"hidden\" name=\"premium\" value=\"\">
\t\t\t<input type=\"hidden\" name=\"sort\" value=\"name\">

\t\t\t<div class=\"BigButton\" style=\"background-image:url(";
        // line 175
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/buttons/sbutton.gif)\">
\t\t\t\t<div onmouseover=\"MouseOverBigButton(this);\" onmouseout=\"MouseOutBigButton(this);\"><div class=\"BigButtonOver\" style=\"background-image:url(";
        // line 176
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/buttons/sbutton_over.gif);\"></div><input class=\"BigButtonText\" type=\"submit\" value=\"Back\"></div>
\t\t\t</div>
\t\t</form>
\t</center>
</div>
";
    }

    public function getTemplateName()
    {
        return "spell.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  346 => 176,  342 => 175,  330 => 165,  311 => 149,  304 => 145,  297 => 141,  290 => 137,  283 => 133,  263 => 116,  259 => 115,  255 => 114,  251 => 113,  246 => 111,  242 => 110,  238 => 109,  234 => 108,  228 => 104,  226 => 103,  208 => 88,  201 => 84,  194 => 80,  187 => 76,  180 => 72,  176 => 70,  170 => 67,  166 => 65,  164 => 64,  157 => 62,  150 => 58,  143 => 54,  136 => 50,  129 => 46,  122 => 42,  102 => 25,  98 => 24,  94 => 23,  90 => 22,  85 => 20,  81 => 19,  77 => 18,  73 => 17,  66 => 13,  57 => 9,  52 => 7,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "spell.html.twig", "/var/www/html/system/templates/spell.html.twig");
    }
}
