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

/* team.html.twig */
class __TwigTemplate_8f3305b370b0b69a86e3cb9b81741396 extends \Twig\Template
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
        echo "<div style=\"text-align: -webkit-center !important;\">
\t<table>
\t\t<tbody>
\t\t\t<tr>
\t\t\t\t<td><img src=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/headline-bracer-left.gif\"></td>
\t\t\t\t<td style=\"text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;\">Staff Team</td>
\t\t\t\t<td><img src=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/headline-bracer-right.gif\"></td>
\t\t\t</tr>
\t\t</tbody>
\t</table>
</div>

<br>

";
        // line 15
        $context["godMembersExist"] = false;
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 17
            echo "    ";
            if ( !($context["godMembersExist"] ?? null)) {
                // line 18
                echo "        ";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 18)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 18) == "god"))) {
                    // line 19
                    echo "            ";
                    $context["godMembersExist"] = true;
                    // line 20
                    echo "        ";
                }
                // line 21
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        if (($context["godMembersExist"] ?? null)) {
            // line 24
            echo "
<div class=\"TableContainer\">
<div class=\"CaptionContainer\">
\t<div class=\"CaptionInnerContainer\">
\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
            // line 28
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
            // line 29
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
            // line 30
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 31
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
            // line 32
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
            // line 33
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<div class=\"Text\" style=\"min-height: 17px\"><div style=\"float: left\">Administrator</div> </div>
\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
            // line 35
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 36
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\"></span>
\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
            // line 38
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t</div>
</div>
  
<table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\" align=\"\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)\">
\t<tbody>
\t\t<tr>
\t\t\t<td>
\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableContent\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent \" width=\"100%\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"#D4C0A1\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 56
            if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 56)) {
                echo "<td style=\"width: 5%;\"><b>#</b></td>";
            }
            // line 57
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Group</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"30%\"><b>Name</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Status</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Last Login</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>World</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Country</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 65
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 65)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 65) == "god"))) {
                    // line 66
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 66)));
                    foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                        // line 67
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        $context["i"] = (($context["i"] ?? null) + 1);
                        // line 68
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"";
                        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                        echo "\" style=\"height: 64px;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 69
                        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 69)) {
                            // line 70
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"text-align: center;\"><img src=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "outfit", [], "any", false, false, false, 70), "html", null, true);
                            echo "\" alt=\"player outfit\"/></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 72
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"20%\"><b><font style=\"font-family: Verdana; text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"red\">Administrator</font><b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                        // line 74
                        echo twig_get_attribute($this->env, $this->source, $context["member"], "link", [], "any", false, false, false, 74);
                        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 76
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "status", [], "any", false, false, false, 76)) {
                            // line 77
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"green\"> Online </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 79
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"red\"> Offline </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 81
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>

\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 84
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 84)) {
                            // line 85
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 85), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 87
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNot connected yet
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 89
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 91
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 91)) {
                            // line 92
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 92), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 94
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, (($__internal_compile_0 = (($__internal_compile_1 = ($context["config"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["lua"] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["serverName"] ?? null) : null), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 96
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 98
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 98)) {
                            // line 99
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 99);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 101
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNo Flag
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 103
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 106
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 107
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 108
            echo "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</td>
\t\t</tr>
\t</tbody>
</table></div>
<br><br>
";
        }
        // line 123
        echo "

";
        // line 125
        $context["cmMembersExist"] = false;
        // line 126
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 127
            echo "    ";
            if ( !($context["cmMembersExist"] ?? null)) {
                // line 128
                echo "        ";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 128)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 128) == "community manager"))) {
                    // line 129
                    echo "            ";
                    $context["cmMembersExist"] = true;
                    // line 130
                    echo "        ";
                }
                // line 131
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 133
        if (($context["cmMembersExist"] ?? null)) {
            // line 134
            echo "
<div class=\"TableContainer\">
<div class=\"CaptionContainer\">
\t<div class=\"CaptionInnerContainer\">
\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
            // line 138
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
            // line 139
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
            // line 140
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 141
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
            // line 142
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
            // line 143
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<div class=\"Text\" style=\"min-height: 17px\"><div style=\"float: left\">Community Manager</div> </div>
\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
            // line 145
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 146
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\"></span>
\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
            // line 148
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t</div>
</div>
<table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\" align=\"\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)\">
\t<tbody>
\t\t<tr>
\t\t\t<td>
\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableContent\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent \" width=\"100%\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"#D4C0A1\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 165
            if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 165)) {
                echo "<td style=\"width: 5%;\"><b>#</b></td>";
            }
            // line 166
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Group</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"30%\"><b>Name</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Status</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Last Login</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>World</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Country</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 173
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 174
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 174)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 174) == "community manager"))) {
                    // line 175
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 175)));
                    foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                        // line 176
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        $context["i"] = (($context["i"] ?? null) + 1);
                        // line 177
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"";
                        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                        echo "\" style=\"height: 64px;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 178
                        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 178)) {
                            // line 179
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"text-align: center;\"><img src=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "outfit", [], "any", false, false, false, 179), "html", null, true);
                            echo "\" alt=\"player outfit\"/></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 181
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"20%\"><b><font style=\"font-family: Verdana; text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"chocolate\">Community Manager</font><b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                        // line 183
                        echo twig_get_attribute($this->env, $this->source, $context["member"], "link", [], "any", false, false, false, 183);
                        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 185
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "status", [], "any", false, false, false, 185)) {
                            // line 186
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"green\"> Online </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 188
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"red\"> Offline </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 190
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>

\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 193
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 193)) {
                            // line 194
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 194), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 196
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNot connected yet
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 198
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 200
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 200)) {
                            // line 201
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 201), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 203
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, (($__internal_compile_2 = (($__internal_compile_3 = ($context["config"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["lua"] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["serverName"] ?? null) : null), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 205
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 207
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 207)) {
                            // line 208
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 208);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 210
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNo Flag
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 212
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 215
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 216
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 217
            echo "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</td>
\t\t</tr>
\t</tbody>
</table></div>
<br><br>
";
        }
        // line 232
        echo "
";
        // line 233
        $context["gmMembersExist"] = false;
        // line 234
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 235
            echo "    ";
            if ( !($context["gmMembersExist"] ?? null)) {
                // line 236
                echo "        ";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 236)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 236) == "gamemaster"))) {
                    // line 237
                    echo "            ";
                    $context["gmMembersExist"] = true;
                    // line 238
                    echo "        ";
                }
                // line 239
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 241
        if (($context["gmMembersExist"] ?? null)) {
            // line 242
            echo "
<div class=\"TableContainer\">
<div class=\"CaptionContainer\">
\t<div class=\"CaptionInnerContainer\">
\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
            // line 246
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
            // line 247
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
            // line 248
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 249
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
            // line 250
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
            // line 251
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<div class=\"Text\" style=\"min-height: 17px\"><div style=\"float: left\">GameMaster</div> </div>
\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
            // line 253
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 254
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\"></span>
\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
            // line 256
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t</div>
</div>
<table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\" align=\"\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)\">
\t<tbody>
\t\t<tr>
\t\t\t<td>
\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableContent\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent \" width=\"100%\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"#D4C0A1\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 273
            if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 273)) {
                echo "<td style=\"width: 5%;\"><b>#</b></td>";
            }
            // line 274
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Group</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"30%\"><b>Name</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Status</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Last Login</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>World</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Country</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 281
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 282
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 282)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 282) == "gamemaster"))) {
                    // line 283
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 283)));
                    foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                        // line 284
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        $context["i"] = (($context["i"] ?? null) + 1);
                        // line 285
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"";
                        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                        echo "\" style=\"height: 64px;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 286
                        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 286)) {
                            // line 287
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"text-align: center;\"><img src=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "outfit", [], "any", false, false, false, 287), "html", null, true);
                            echo "\" alt=\"player outfit\"/></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 289
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"20%\"><b><font style=\"font-family: Verdana; text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"royalblue\">GameMaster</font><b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                        // line 291
                        echo twig_get_attribute($this->env, $this->source, $context["member"], "link", [], "any", false, false, false, 291);
                        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 293
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "status", [], "any", false, false, false, 293)) {
                            // line 294
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"green\"> Online </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 296
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"red\"> Offline </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 298
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>

\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 301
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 301)) {
                            // line 302
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 302), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 304
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNot connected yet
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 306
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 308
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 308)) {
                            // line 309
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 309), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 311
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, (($__internal_compile_4 = (($__internal_compile_5 = ($context["config"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["lua"] ?? null) : null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["serverName"] ?? null) : null), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 313
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 315
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 315)) {
                            // line 316
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 316);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 318
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNo Flag
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 320
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 323
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 324
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 325
            echo "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</td>
\t\t</tr>
\t</tbody>
</table></div>
<br><br>
";
        }
        // line 340
        echo "
";
        // line 341
        $context["seniorMembersExist"] = false;
        // line 342
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 343
            echo "    ";
            if ( !($context["seniorMembersExist"] ?? null)) {
                // line 344
                echo "        ";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 344)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 344) == "senior tutor"))) {
                    // line 345
                    echo "            ";
                    $context["seniorMembersExist"] = true;
                    // line 346
                    echo "        ";
                }
                // line 347
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 349
        if (($context["seniorMembersExist"] ?? null)) {
            // line 350
            echo "
<div class=\"TableContainer\">
<div class=\"CaptionContainer\">
\t<div class=\"CaptionInnerContainer\">
\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
            // line 354
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
            // line 355
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
            // line 356
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 357
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
            // line 358
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
            // line 359
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<div class=\"Text\" style=\"min-height: 17px\"><div style=\"float: left\">Senior Tutor</div> </div>
\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
            // line 361
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 362
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\"></span>
\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
            // line 364
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t</div>
</div>
<table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\" align=\"\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)\">
\t<tbody>
\t\t<tr>
\t\t\t<td>
\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableContent\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent \" width=\"100%\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"#D4C0A1\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 381
            if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 381)) {
                echo "<td style=\"width: 5%;\"><b>#</b></td>";
            }
            // line 382
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Group</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"30%\"><b>Name</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Status</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Last Login</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>World</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Country</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 389
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 390
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 390)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 390) == "senior tutor"))) {
                    // line 391
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 391)));
                    foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                        // line 392
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        $context["i"] = (($context["i"] ?? null) + 1);
                        // line 393
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"";
                        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                        echo "\" style=\"height: 64px;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 394
                        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 394)) {
                            // line 395
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"text-align: center;\"><img src=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "outfit", [], "any", false, false, false, 395), "html", null, true);
                            echo "\" alt=\"player outfit\"/></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 397
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"20%\"><b><font style=\"font-family: Verdana; text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"seagreen\">Senior Tutor</font><b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                        // line 399
                        echo twig_get_attribute($this->env, $this->source, $context["member"], "link", [], "any", false, false, false, 399);
                        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 401
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "status", [], "any", false, false, false, 401)) {
                            // line 402
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"green\"> Online </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 404
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"red\"> Offline </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 406
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>

\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 409
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 409)) {
                            // line 410
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 410), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 412
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNot connected yet
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 414
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 416
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 416)) {
                            // line 417
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 417), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 419
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, (($__internal_compile_6 = (($__internal_compile_7 = ($context["config"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["lua"] ?? null) : null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["serverName"] ?? null) : null), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 421
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 423
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 423)) {
                            // line 424
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 424);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 426
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNo Flag
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 428
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 431
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 432
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 433
            echo "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</td>
\t\t</tr>
\t</tbody>
</table></div>
<br><br>
";
        }
        // line 448
        echo "
";
        // line 449
        $context["tutorMembersExist"] = false;
        // line 450
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 451
            echo "    ";
            if ( !($context["tutorMembersExist"] ?? null)) {
                // line 452
                echo "        ";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 452)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 452) == "tutor"))) {
                    // line 453
                    echo "            ";
                    $context["tutorMembersExist"] = true;
                    // line 454
                    echo "        ";
                }
                // line 455
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 457
        if (($context["tutorMembersExist"] ?? null)) {
            // line 458
            echo "
<div class=\"TableContainer\">
<div class=\"CaptionContainer\">
\t<div class=\"CaptionInnerContainer\">
\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
            // line 462
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
            // line 463
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
            // line 464
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 465
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
            // line 466
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
            // line 467
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<div class=\"Text\" style=\"min-height: 17px\"><div style=\"float: left\">Tutor</div> </div>
\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
            // line 469
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
            // line 470
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t<span class=\"CaptionEdgeLeftBottom\"></span>
\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
            // line 472
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
\t</div>
</div>
<table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\" align=\"\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)\">
\t<tbody>
\t\t<tr>
\t\t\t<td>
\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t<table style=\"width:100%;\">
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableContent\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent \" width=\"100%\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"#D4C0A1\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 489
            if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 489)) {
                echo "<td style=\"width: 5%;\"><b>#</b></td>";
            }
            // line 490
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Group</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"30%\"><b>Name</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Status</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Last Login</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>World</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td><b>Country</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 497
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["groupmember"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 498
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                if (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 498)) && (twig_get_attribute($this->env, $this->source, $context["group"], "group_name", [], "any", false, false, false, 498) == "tutor"))) {
                    // line 499
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "members", [], "any", false, false, false, 499)));
                    foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                        // line 500
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        $context["i"] = (($context["i"] ?? null) + 1);
                        // line 501
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr bgcolor=\"";
                        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                        echo "\" style=\"height: 64px;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 502
                        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "team_display_outfit", [], "any", false, false, false, 502)) {
                            // line 503
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"text-align: center;\"><img src=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "outfit", [], "any", false, false, false, 503), "html", null, true);
                            echo "\" alt=\"player outfit\"/></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 505
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t<td width=\"20%\"><b><font style=\"font-family: Verdana; text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"forestgreen\">Tutor</font><b></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                        // line 507
                        echo twig_get_attribute($this->env, $this->source, $context["member"], "link", [], "any", false, false, false, 507);
                        echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 509
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "status", [], "any", false, false, false, 509)) {
                            // line 510
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"green\"> Online </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 512
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<b><font style=\"font-family: Verdana; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);\" color=\"red\"> Offline </font><b>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 514
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>

\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 517
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 517)) {
                            // line 518
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "last_login", [], "any", false, false, false, 518), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 520
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNot connected yet
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 522
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 524
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 524)) {
                            // line 525
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["member"], "world_name", [], "any", false, false, false, 525), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 527
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, (($__internal_compile_8 = (($__internal_compile_9 = ($context["config"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["lua"] ?? null) : null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["serverName"] ?? null) : null), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 529
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td style=\"position: relative; text-align: center;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 531
                        if (twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 531)) {
                            // line 532
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_get_attribute($this->env, $this->source, $context["member"], "flag_image", [], "any", false, false, false, 532);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 534
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tNo Flag
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 536
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 539
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 540
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 541
            echo "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</td>
\t\t</tr>
\t</tbody>
</table></div>
<br><br>
";
        }
    }

    public function getTemplateName()
    {
        return "team.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1216 => 541,  1210 => 540,  1207 => 539,  1199 => 536,  1195 => 534,  1189 => 532,  1187 => 531,  1183 => 529,  1177 => 527,  1171 => 525,  1169 => 524,  1165 => 522,  1161 => 520,  1155 => 518,  1153 => 517,  1148 => 514,  1144 => 512,  1140 => 510,  1138 => 509,  1133 => 507,  1129 => 505,  1123 => 503,  1121 => 502,  1116 => 501,  1113 => 500,  1108 => 499,  1105 => 498,  1101 => 497,  1092 => 490,  1088 => 489,  1068 => 472,  1063 => 470,  1059 => 469,  1054 => 467,  1050 => 466,  1046 => 465,  1042 => 464,  1038 => 463,  1034 => 462,  1028 => 458,  1026 => 457,  1019 => 455,  1016 => 454,  1013 => 453,  1010 => 452,  1007 => 451,  1003 => 450,  1001 => 449,  998 => 448,  981 => 433,  975 => 432,  972 => 431,  964 => 428,  960 => 426,  954 => 424,  952 => 423,  948 => 421,  942 => 419,  936 => 417,  934 => 416,  930 => 414,  926 => 412,  920 => 410,  918 => 409,  913 => 406,  909 => 404,  905 => 402,  903 => 401,  898 => 399,  894 => 397,  888 => 395,  886 => 394,  881 => 393,  878 => 392,  873 => 391,  870 => 390,  866 => 389,  857 => 382,  853 => 381,  833 => 364,  828 => 362,  824 => 361,  819 => 359,  815 => 358,  811 => 357,  807 => 356,  803 => 355,  799 => 354,  793 => 350,  791 => 349,  784 => 347,  781 => 346,  778 => 345,  775 => 344,  772 => 343,  768 => 342,  766 => 341,  763 => 340,  746 => 325,  740 => 324,  737 => 323,  729 => 320,  725 => 318,  719 => 316,  717 => 315,  713 => 313,  707 => 311,  701 => 309,  699 => 308,  695 => 306,  691 => 304,  685 => 302,  683 => 301,  678 => 298,  674 => 296,  670 => 294,  668 => 293,  663 => 291,  659 => 289,  653 => 287,  651 => 286,  646 => 285,  643 => 284,  638 => 283,  635 => 282,  631 => 281,  622 => 274,  618 => 273,  598 => 256,  593 => 254,  589 => 253,  584 => 251,  580 => 250,  576 => 249,  572 => 248,  568 => 247,  564 => 246,  558 => 242,  556 => 241,  549 => 239,  546 => 238,  543 => 237,  540 => 236,  537 => 235,  533 => 234,  531 => 233,  528 => 232,  511 => 217,  505 => 216,  502 => 215,  494 => 212,  490 => 210,  484 => 208,  482 => 207,  478 => 205,  472 => 203,  466 => 201,  464 => 200,  460 => 198,  456 => 196,  450 => 194,  448 => 193,  443 => 190,  439 => 188,  435 => 186,  433 => 185,  428 => 183,  424 => 181,  418 => 179,  416 => 178,  411 => 177,  408 => 176,  403 => 175,  400 => 174,  396 => 173,  387 => 166,  383 => 165,  363 => 148,  358 => 146,  354 => 145,  349 => 143,  345 => 142,  341 => 141,  337 => 140,  333 => 139,  329 => 138,  323 => 134,  321 => 133,  314 => 131,  311 => 130,  308 => 129,  305 => 128,  302 => 127,  298 => 126,  296 => 125,  292 => 123,  275 => 108,  269 => 107,  266 => 106,  258 => 103,  254 => 101,  248 => 99,  246 => 98,  242 => 96,  236 => 94,  230 => 92,  228 => 91,  224 => 89,  220 => 87,  214 => 85,  212 => 84,  207 => 81,  203 => 79,  199 => 77,  197 => 76,  192 => 74,  188 => 72,  182 => 70,  180 => 69,  175 => 68,  172 => 67,  167 => 66,  164 => 65,  160 => 64,  151 => 57,  147 => 56,  126 => 38,  121 => 36,  117 => 35,  112 => 33,  108 => 32,  104 => 31,  100 => 30,  96 => 29,  92 => 28,  86 => 24,  84 => 23,  77 => 21,  74 => 20,  71 => 19,  68 => 18,  65 => 17,  61 => 16,  59 => 15,  48 => 7,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "team.html.twig", "/var/www/html/system/templates/team.html.twig");
    }
}
