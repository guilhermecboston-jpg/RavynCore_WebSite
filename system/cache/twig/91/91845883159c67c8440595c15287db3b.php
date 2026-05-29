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

/* guilds.list.html.twig */
class __TwigTemplate_277ab82ad71322cd01542aa60ec8a58a extends \Twig\Template
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
        echo "Please select the game world of your choice to see the list of all existing guilds on it. Click on any view button to get more information about a guild. See the manual for a detailed description about guilds and their benefits.
<br>
<br>
<br>
<div class=\"TableContainer\">
    <div class=\"CaptionContainer\">
        <div class=\"CaptionInnerContainer\">
            <span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
        // line 8
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
        // line 9
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionBorderTop\" style=\"background-image:url(";
        // line 10
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
        // line 11
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
            <div class=\"Text\">Active Guilds on ";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 12), "serverName", [], "any", false, false, false, 12), "html", null, true);
        echo "</div>
            <span class=\"CaptionVerticalRight\" style=\"background-image:url(";
        // line 13
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
            <span class=\"CaptionBorderBottom\" style=\"background-image:url(";
        // line 14
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
        // line 15
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
        // line 16
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        </div>
    </div>

    <table class=\"Table3\">
        <tbody>
            <tr>
                <td>
                    <div class=\"InnerTableContainer\">
                        <table style=\"width:100%;\">
                            <tbody>
                                <tr>
                                    <td>

                                        <div class=\"TableContentAndRightShadow\">
                                            <div class=\"TableContentContainer\">
                                                <table class=\"TableContent\" width=\"100%\">
                                                    <tbody>
                                                        ";
        // line 34
        if ((twig_length_filter($this->env, ($context["guilds"] ?? null)) > 0)) {
            // line 35
            echo "                                                        <tr bgcolor=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 35), "html", null, true);
            echo "\">
                                                            <td width=\"64\"><b>Logo</b></td>
                                                            <td><b>Description</b></td>
                                                            <td width=\"12%\"><b>&nbsp;</b></td>
                                                        </tr>

                                                            ";
            // line 41
            $context["i"] = 0;
            // line 42
            echo "                                                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["guilds"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["guild"]) {
                // line 43
                echo "                                                            ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 44
                echo "                                                            <tr bgcolor=\"";
                echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                echo "\">
                                                                <td>
                                                                    <img src=\"images/guilds/";
                // line 46
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["guild"], "logo", [], "any", false, false, false, 46), "html", null, true);
                echo "\" width=\"64\" height=\"64\">
                                                                </td>

                                                                <td style=\"word-break: break-all\">
                                                                    <span";
                // line 50
                if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["guild"], "description", [], "any", false, false, false, 50))) {
                    echo " valign=\"top\"";
                }
                echo ">
                                                                        <b>";
                // line 51
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["guild"], "name", [], "any", false, false, false, 51), "html", null, true);
                echo "</b>";
                if (($context["isAdmin"] ?? null)) {
                    echo "<a href=\"?subtopic=guilds&action=delete_by_admin&guild=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["guild"], "name", [], "any", false, false, false, 51), "html", null, true);
                    echo "\"> [DELETE]</a>";
                }
                // line 52
                echo "                                                                    </span>

                                                                    ";
                // line 54
                if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["guild"], "description", [], "any", false, false, false, 54))) {
                    // line 55
                    echo "                                                                    <br>
                                                                    <span>";
                    // line 56
                    echo twig_get_attribute($this->env, $this->source, $context["guild"], "description", [], "any", false, false, false, 56);
                    echo "</span>
                                                                    ";
                }
                // line 58
                echo "                                                                </td>

                                                                <td>
                                                                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style=\"border:0;\">
                                                                                    <form action=\"";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["guild"], "link", [], "any", false, false, false, 65), "html", null, true);
                echo "\" method=\"post\">
                                                                                        ";
                // line 66
                echo twig_include($this->env, $context, "buttons.view.html.twig");
                echo "
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guild'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 75
            echo "                                                        ";
        } else {
            // line 76
            echo "                                                        <tr bgcolor=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 76), "html", null, true);
            echo "\">
                                                            <td valign=\"top\">
                                                                <b>Create Guild</b>
                                                                <br/>
                                                                Actually there is no guild on server.";
            // line 80
            if (($context["logged"] ?? null)) {
                echo " Create first! Press button \"Create Guild\"";
            }
            // line 81
            echo "                                                            </td>

                                                            ";
            // line 83
            if (($context["logged"] ?? null)) {
                // line 84
                echo "                                                            <td>
                                                                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                                                                    <form action=\"?subtopic=guilds&action=create\" method=\"post\">
                                                                        <form action=\"?subtopic=guilds&action=create\" method=\"post\">
                                                                            ";
                // line 88
                $context["button_name"] = "Found Guild";
                // line 89
                echo "                                                                            ";
                $context["button_image"] = "_sbutton_foundguild";
                // line 90
                echo "                                                                            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.list.html.twig", 90)->display($context);
                // line 91
                echo "                                                                        </form>
                                                                    </form>
                                                                </table>
                                                            </td>
                                                            ";
            }
            // line 96
            echo "                                                        </tr>
                                                        ";
        }
        // line 98
        echo "                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>

<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\">
    <tbody>
        <tr>
            <td align=\"center\">
                <img src=\"";
        // line 119
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "images/general/blank.gif\" width=\"80\" height=\"1\" border=\"0\">
            </td>

            <td align=\"center\">
                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tbody>
                        ";
        // line 125
        if (($context["logged"] ?? null)) {
            // line 126
            echo "                        No guild found that suits your needs?
                        <form action=\"?subtopic=guilds&action=create\" method=\"post\">
                            ";
            // line 128
            $context["button_name"] = "Found Guild";
            // line 129
            echo "                            ";
            $context["button_image"] = "_sbutton_foundguild";
            // line 130
            echo "                            ";
            $this->loadTemplate("buttons.base.html.twig", "guilds.list.html.twig", 130)->display($context);
            // line 131
            echo "                        </form>
                        ";
        } else {
            // line 133
            echo "                        <b>Before you can create a guild you must login.</b>
                        <br/>
                        <form action=\"?subtopic=accountmanagement&redirect=";
            // line 135
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("guilds"), "html", null, true);
            echo "\" method=\"post\">
                            ";
            // line 136
            $this->loadTemplate("buttons.login.html.twig", "guilds.list.html.twig", 136)->display($context);
            // line 137
            echo "                        </form>
                        ";
        }
        // line 139
        echo "                    </tbody>
                </table>

                ";
        // line 142
        if (($context["logged"] ?? null)) {
            // line 143
            echo "                    <br/>
                    If you have any problem with guilds try:
                    <br/>
                    <a href=\"?subtopic=guilds&action=cleanup_players\">Cleanup players</a> - can't join guild/be invited? Can't create guild? Try cleanup players.
                    <br/>
                    <a href=\"?subtopic=guilds&action=cleanup_guilds\">Cleanup guilds</a> - made guild, you are a leader, but you are not on players list? Cleanup guilds!
                ";
        }
        // line 150
        echo "            </td>

            <td align=\"center\">
                <img src=\"";
        // line 153
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/general/blank.gif\" width=\"80\" height=\"1\" border=\"0\">
            </td>
        </tr>
    </tbody>
</table>




";
    }

    public function getTemplateName()
    {
        return "guilds.list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  342 => 153,  337 => 150,  328 => 143,  326 => 142,  321 => 139,  317 => 137,  315 => 136,  311 => 135,  307 => 133,  303 => 131,  300 => 130,  297 => 129,  295 => 128,  291 => 126,  289 => 125,  280 => 119,  257 => 98,  253 => 96,  246 => 91,  243 => 90,  240 => 89,  238 => 88,  232 => 84,  230 => 83,  226 => 81,  222 => 80,  214 => 76,  211 => 75,  188 => 66,  184 => 65,  175 => 58,  170 => 56,  167 => 55,  165 => 54,  161 => 52,  153 => 51,  147 => 50,  140 => 46,  134 => 44,  131 => 43,  113 => 42,  111 => 41,  101 => 35,  99 => 34,  78 => 16,  74 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 10,  50 => 9,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "guilds.list.html.twig", "/var/www/html/system/templates/guilds.list.html.twig");
    }
}
