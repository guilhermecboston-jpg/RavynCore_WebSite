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

/* characters.html.twig */
class __TwigTemplate_7ec5f365af0fd8a4294cf799b50a61a2 extends \Twig\Template
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
        echo "<script type=\"text/javascript\" src=\"tools/js/tipped.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"tools/css/tipped.css\"/>
<script>
  \$(document).ready(function () {
    Tipped.create('.item_image');
  });
</script>
";
        // line 8
        $context["rows"] = 0;
        // line 9
        echo "
";
        // line 10
        if (($context["canEdit"] ?? null)) {
            // line 11
            echo "  <a href=\"admin/?p=players&id=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getId", [], "method", false, false, false, 11), "html", null, true);
            echo "\" title=\"Edit in Admin Panel\" target=\"_blank\">
    ";
            // line 12
            $context["button_name"] = "Edit Character";
            // line 13
            echo "    ";
            $this->loadTemplate("buttons.base.html.twig", "characters.html.twig", 13)->display($context);
            // line 14
            echo "  </a>
  <br>
";
        }
        // line 17
        echo "
<!-- CHARACTER INFORMATION -->
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
  <tr>
    <td>
      <div class=\"TableContainer\">
        <div class=\"CaptionContainer\">
          <div class=\"CaptionInnerContainer\">
            <span class=\"CaptionEdgeLeftTop\"
                  style=\"background-image:url(";
        // line 26
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightTop\"
                  style=\"background-image:url(";
        // line 28
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionBorderTop\"
                  style=\"background-image:url(";
        // line 30
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionVerticalLeft\"
                  style=\"background-image:url(";
        // line 32
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
            <div class=\"Text\">Character Information</div>
            <span class=\"CaptionVerticalRight\"
                  style=\"background-image:url(";
        // line 35
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
            <span class=\"CaptionBorderBottom\"
                  style=\"background-image:url(";
        // line 37
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionEdgeLeftBottom\"
                  style=\"background-image:url(";
        // line 39
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightBottom\"
                  style=\"background-image:url(";
        // line 41
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
          </div>
        </div>
        <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
          <tbody>
          <tr>
            <td>
              <div class=\"InnerTableContainer\">
                <table style=\"width:100%;\">
                  <tbody>
                  <tr>
                    <td>
                      <div class=\"TableContentContainer\">
                        <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                          <tbody>

                          ";
        // line 57
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 58
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td width=\"20%\" class=\"LabelV175\">Name:</td>
                            <td>";
        // line 60
        if ( !(null === ($context["skull"] ?? null))) {
            echo "<img
                                src=\"images/";
            // line 61
            echo twig_escape_filter($this->env, ($context["skull"] ?? null), "html", null, true);
            echo ".gif\">";
        }
        echo " ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getName", [], "method", false, false, false, 61), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["oldName"] ?? null), "html", null, true);
        echo " ";
        if (twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "isOnline", [], "method", false, false, false, 61)) {
            // line 62
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/on.gif\" title=\"Online\">";
        } else {
            echo "<img
                                src=\"";
            // line 63
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/off.gif\" title=\"Offline\">";
        }
        // line 64
        echo "                              <div style=\"float: right\"></div>
                            </td>
                          </tr>

                          ";
        // line 68
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 69
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Country:</td>
                            <td>";
        // line 71
        echo twig_escape_filter($this->env, ($context["country"] ?? null), "html", null, true);
        echo " ";
        echo ($context["flag"] ?? null);
        echo "</td>
                          </tr>

                          ";
        // line 74
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 75
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Sex:</td>
                            <td>";
        // line 77
        echo twig_escape_filter($this->env, ($context["sex"] ?? null), "html", null, true);
        echo "</td>
                          </tr>

                          ";
        // line 80
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 81
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Vocation:</td>
                            <td>";
        // line 83
        echo twig_escape_filter($this->env, ($context["vocation"] ?? null), "html", null, true);
        echo "</td>
                          </tr>

                          ";
        // line 86
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 87
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Level:</td>
                            <td>";
        // line 89
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLevel", [], "method", false, false, false, 89), "html", null, true);
        echo "</td>
                          </tr>

                          ";
        // line 92
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 93
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Achievement Points:</td>
                            <td>";
        // line 95
        echo twig_escape_filter($this->env, ($context["achievementPoints"] ?? null), "html", null, true);
        echo "</td>
                          </tr>

                          ";
        // line 98
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 99
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Residence:</td>
                            <td>";
        // line 101
        echo twig_escape_filter($this->env, ($context["town"] ?? null), "html", null, true);
        echo "</td>
                          </tr>

                          ";
        // line 104
        if (($context["frags_enabled"] ?? null)) {
            // line 105
            echo "                            ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 106
            echo "                            <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                              <td class=\"LabelV175\">Frags:</td>
                              <td>";
            // line 108
            echo twig_escape_filter($this->env, ($context["frags_count"] ?? null), "html", null, true);
            echo "</td>
                            </tr>
                          ";
        }
        // line 111
        echo "
                          ";
        // line 112
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "characters", [], "any", false, false, false, 112), "balance", [], "any", false, false, false, 112)) {
            // line 113
            echo "                            ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 114
            echo "                            <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                              <td class=\"LabelV175\">Balance:</td>
                              <td>
                                <strong style=\"color: green\">\$</strong>
                                ";
            // line 118
            if ( !twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "isHidden", [], "method", false, false, false, 118)) {
                echo " ";
                echo twig_escape_filter($this->env, ($context["balance"] ?? null), "html", null, true);
                echo " Gold Coins.
                                ";
            } else {
                // line 119
                echo " <strike>Hidden</strike> ";
            }
            // line 120
            echo "                              </td>
                            </tr>
                          ";
        }
        // line 123
        echo "
                          ";
        // line 124
        if (twig_get_attribute($this->env, $this->source, ($context["house"] ?? null), "found", [], "any", false, false, false, 124)) {
            // line 125
            echo "                            ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 126
            echo "                            <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                              <td class=\"LabelV175\">House:</td>
                              <td><a href=\"\">";
            // line 128
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["house"] ?? null), "name", [], "any", false, false, false, 128) . twig_get_attribute($this->env, $this->source, ($context["house"] ?? null), "town", [], "any", false, false, false, 128)) . twig_get_attribute($this->env, $this->source, ($context["house"] ?? null), "add", [], "any", false, false, false, 128)), "html", null, true);
            echo "</a></td>
                            </tr>
                          ";
        }
        // line 131
        echo "
                          ";
        // line 132
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 132))) {
            // line 133
            echo "                            ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 134
            echo "                            <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                              <td class=\"LabelV175\">Guild membership:</td>
                              <td>";
            // line 136
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 136), "html", null, true);
            echo " of the <a href=\"\">";
            echo twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "link", [], "any", false, false, false, 136);
            echo "</a></td>
                            </tr>
                          ";
        }
        // line 139
        echo "
                          ";
        // line 140
        if (($context["marriage_enabled"] ?? null)) {
            // line 141
            echo "                            ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 142
            echo "                            <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                              <td class=\"LabelV175\">Marital status:</td>
                              <td><a href=\"\">";
            // line 144
            echo twig_escape_filter($this->env, ($context["marital_status"] ?? null), "html", null, true);
            echo "</a></td>
                            </tr>
                          ";
        }
        // line 147
        echo "
                          ";
        // line 148
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 149
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Last Login:</td>
                            <td>";
        // line 151
        if ((twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLastLogin", [], "method", false, false, false, 151) == 0)) {
            echo "Never logged in.";
        } else {
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLastLogin", [], "method", false, false, false, 151), "M d Y, H:i:s"), "html", null, true);
            echo " CEST";
        }
        echo "</td>
                          </tr>

                          ";
        // line 154
        if ( !(null === ($context["comment"] ?? null))) {
            // line 155
            echo "                            ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 156
            echo "                            <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                              <td class=\"LabelV175\">Comment:</td>
                              <td style=\"word-break: break-all\">";
            // line 158
            echo ($context["comment"] ?? null);
            echo "</td>
                            </tr>
                          ";
        }
        // line 161
        echo "
                          ";
        // line 162
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 163
        echo "                          <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                            <td class=\"LabelV175\">Account Status:</td>
                            <td>
                              ";
        // line 166
        if (($context["vip_enabled"] ?? null)) {
            // line 167
            echo "                                VIP
                                ";
            // line 168
            if (twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "isPremium", [], "method", false, false, false, 168)) {
                // line 169
                echo "                                  <strong
                                    style=\"color:green\">actived</strong> until ";
                // line 170
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "getExpirePremiumTime", [], "method", false, false, false, 170), "j M Y, H:i"), "html", null, true);
                echo "
                                ";
            } else {
                // line 172
                echo "                                  <strong style=\"color:red\">desactivated</strong>
                                ";
            }
            // line 174
            echo "                              ";
        } else {
            // line 175
            echo "                                ";
            if (twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "isPremium", [], "method", false, false, false, 175)) {
                // line 176
                echo "                                  <font color=\"green\"><b>Premium Account</b></font>
                                ";
            } else {
                // line 178
                echo "                                  <font color=\"red\">Free Account</font>
                                ";
            }
            // line 180
            echo "                              ";
        }
        // line 181
        echo "                            </td>
                          </tr>

                          </tbody>
                        </table>
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
    </td>
  </tr>
</table>

<br>

<!-- ACCOUNT INFORMATION -->
<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 208
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 210
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 212
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 214
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Account Information</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 217
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 219
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 221
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 223
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
    <tr>
      <td>
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tbody>
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                    <tbody>
                    ";
        // line 238
        $context["group"] = twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getGroup", [], "method", false, false, false, 238);
        // line 239
        echo "                    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["group"] ?? null), "isLoaded", [], "method", false, false, false, 239) && (twig_get_attribute($this->env, $this->source, ($context["group"] ?? null), "getId", [], "method", false, false, false, 239) != 1))) {
            // line 240
            echo "                      ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 241
            echo "                      <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                        <td class=\"LabelV175\">Position:</td>
                        <td>";
            // line 243
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["group"] ?? null), "getName", [], "method", false, false, false, 243)), "html", null, true);
            echo "</td>
                      </tr>
                    ";
        }
        // line 246
        echo "                    ";
        $context["rows"] = (($context["rows"] ?? null) + 1);
        // line 247
        echo "                    <tr bgcolor=\"";
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
        echo "\">
                      <td class=\"LabelV175\">Created:</td>
                      <td>";
        // line 249
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "getCreated", [], "method", false, false, false, 249), "M d Y, g:i:s"), "html", null, true);
        echo " CET
                        ";
        // line 250
        if ((preg_match("/^\\d+\$/", ($context["bannedUntil"] ?? null)) || (($context["bannedUntil"] ?? null) == "-1"))) {
            // line 251
            echo "                          <span
                            style=\"color: red\">[Banished ";
            // line 252
            if ((($context["bannedUntil"] ?? null) == "-1")) {
                echo "forever";
            } else {
                echo "until ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["bannedUntil"] ?? null), "d F Y, h:s"), "html", null, true);
            }
            echo "]</span>
                        ";
        } else {
            // line 254
            echo "                          ";
            echo ($context["bannedUntil"] ?? null);
            echo "
                        ";
        }
        // line 255
        echo "</td>
                    </tr>
                    </tbody>
                  </table>
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

<!-- CHARACTER DETAILS -->
<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 278
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 280
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 282
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 284
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Character Details</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 287
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 289
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 291
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 293
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
    <tr>
      <td style=\"width: 10rem;\">
        <!-- OUTFIT -->
        ";
        // line 301
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "characters", [], "any", false, false, false, 301), "outfit", [], "any", false, false, false, 301)) {
            // line 302
            echo "          <div class=\"InnerTableContainer\">
            <table style=\"width: 98%;\">
              <tbody>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      <tr bgcolor=\"";
            // line 310
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
            echo "\">
                        <td align=\"center\" style=\"border:0; width: 64px;\">
                          <b>Current outfit:</b>
                        </td>
                        <td style=\"border:0;\">
                          <div style=\"width:64px; height:64px;\">
                            <img
                              style=\"margin-left:";
            // line 317
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLookType", [], "method", false, false, false, 317), [0 => 75, 1 => 266, 2 => 302])) {
                echo "5px;margin-top:0;width:60px;height:60px;";
            } else {
                echo "-18px;margin-top:-28px;width:80px;height:80px;";
            }
            echo "\"
                              src=\"";
            // line 318
            echo twig_escape_filter($this->env, ($context["outfit"] ?? null), "html", null, true);
            echo "\" alt=\"player outfit\"/>
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
          <!-- OUTFIT END -->
        ";
        }
        // line 332
        echo "
        ";
        // line 333
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_AFTER_QUESTS")), "html", null, true);
        echo "

        ";
        // line 335
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "characters", [], "any", false, false, false, 335), "equipment", [], "any", false, false, false, 335)) {
            // line 336
            echo "          <!-- EQUIPMENT -->
          <div class=\"InnerTableContainer\">
            <table>
              <tbody>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      <tr bgcolor=\"";
            // line 345
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
            echo "\">
                        <td align=\"center\">
                          <b>Inventory:</b>
                        </td>
                      </tr>
                      <tr bgcolor=\"";
            // line 350
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
            echo "\">
                        <td>
                          <table width=\"100\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
                            <tr>
                              <td style=\"border:0px; padding:0px;\">
                                <table cellspacing=\"0\" style=\"background: #292929;\">
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 357
            echo (($__internal_compile_0 = ($context["equipment"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[2] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 360
            echo (($__internal_compile_1 = ($context["equipment"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[6] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 363
            echo (($__internal_compile_2 = ($context["equipment"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[9] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"color: #fff; text-align: center; font-size: 10px;\">Soul: ";
            // line 366
            echo twig_escape_filter($this->env, ($context["soul"] ?? null), "html", null, true);
            echo "</td>
                                  </tr>
                                </table>
                              </td>
                              <td style=\"border:0px; padding:0px;\">
                                <table cellspacing=\"0\" style=\"background: #292929;\">
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 373
            echo (($__internal_compile_3 = ($context["equipment"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[1] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 376
            echo (($__internal_compile_4 = ($context["equipment"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[4] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 379
            echo (($__internal_compile_5 = ($context["equipment"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[7] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 382
            echo (($__internal_compile_6 = ($context["equipment"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[8] ?? null) : null);
            echo "</td>
                                  </tr>
                                </table>
                              </td>
                              <td style=\"border:0px; padding:0px;\">
                                <table cellspacing=\"0\" style=\"background: #292929;\">
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 389
            echo (($__internal_compile_7 = ($context["equipment"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[3] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 392
            echo (($__internal_compile_8 = ($context["equipment"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[5] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"border:1px solid #808080;\">";
            // line 395
            echo (($__internal_compile_9 = ($context["equipment"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[10] ?? null) : null);
            echo "</td>
                                  </tr>
                                  <tr>
                                    <td style=\"color: #fff; text-align: center; font-size: 10px;\">Cap: ";
            // line 398
            echo twig_escape_filter($this->env, ($context["cap"] ?? null), "html", null, true);
            echo "</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
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
          <!-- EQUIPMENT_END -->
        ";
        }
        // line 416
        echo "
        ";
        // line 417
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_AFTER_EQUIPMENT")), "html", null, true);
        echo "
      </td>

      <!-- LIFE MANA -->
      <td>
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tbody>
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                    <tbody>
                    <tr bgcolor=\"";
        // line 430
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
        echo "\">
                      <td style=\"border:0px; width:15%; text-align: right;\"><b>Health:</b></td>
                      <td style=\"border:0px; text-align: center;\">
                        ";
        // line 433
        echo twig_escape_filter($this->env, ($context["health_current"] ?? null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, ($context["health_max"] ?? null), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, ($context["health_percent"] ?? null), "html", null, true);
        echo "%)
                        <div class=\"progress\">
                          <div class=\"progress-bar bg-danger\" role=\"progressbar\" aria-valuenow=\"";
        // line 435
        echo twig_escape_filter($this->env, ($context["health_percent"] ?? null), "html", null, true);
        echo "\"
                               aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ";
        // line 436
        echo twig_escape_filter($this->env, ($context["health_percent"] ?? null), "html", null, true);
        echo "%;\"></div>
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor=\"";
        // line 440
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
        echo "\">
                      <td style=\"border:0px; width:15%; text-align: right;\"><b>Mana:</b></td>
                      <td style=\"border:0px; text-align: center;\">
                        ";
        // line 443
        echo twig_escape_filter($this->env, ($context["mana_current"] ?? null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, ($context["mana_max"] ?? null), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, ($context["mana_percent"] ?? null), "html", null, true);
        echo "%)
                        <div class=\"progress\">
                          <div class=\"progress-bar bg-default\" role=\"progressbar\" aria-valuenow=\"";
        // line 445
        echo twig_escape_filter($this->env, ($context["mana_percent"] ?? null), "html", null, true);
        echo "\"
                               aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ";
        // line 446
        echo twig_escape_filter($this->env, ($context["mana_percent"] ?? null), "html", null, true);
        echo "%;\"></div>
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
        <!-- LIFE MANA END -->

        <!-- EXPERIENCE -->
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tbody>
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                    <tbody>
                    <tr bgcolor=\"";
        // line 469
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
        echo "\">
                      <td style=\"border:0px; width:15%; text-align: right;\"><b>Experience:</b></td>
                      <td style=\"border:0px; text-align: center;\">
                        Have <b>";
        // line 472
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getExperience", [], "method", false, false, false, 472), "html", null, true);
        echo "</b> and need <b>";
        echo twig_escape_filter($this->env, ($context["expLeft"] ?? null), "html", null, true);
        echo "</b> to Level
                        <b>";
        // line 473
        echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLevel", [], "method", false, false, false, 473) + 1), "html", null, true);
        echo "</b>.
                      </td>
                    </tr>
                    <tr bgcolor=\"";
        // line 476
        echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
        echo "\">
                      <td style=\"border:0px; width:15%; text-align: right;\"><b>Percent:</b></td>
                      <td style=\"border:0px; text-align: center;\">
                        ";
        // line 479
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getExperience", [], "method", false, false, false, 479), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, ($context["expNext"] ?? null), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, ($context["expLeftPercent"] ?? null), "html", null, true);
        echo "%)
                        <div class=\"progress\">
                          <div class=\"progress-bar bg-success\" role=\"progressbar\" aria-valuenow=\"";
        // line 481
        echo twig_escape_filter($this->env, ($context["expLeftPercent"] ?? null), "html", null, true);
        echo "\"
                               aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:";
        // line 482
        echo twig_escape_filter($this->env, ($context["expLeftPercent"] ?? null), "html", null, true);
        echo "%\"></div>
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
        <!-- EXPERIENCE END -->

        ";
        // line 496
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_BEFORE_SKILLS")), "html", null, true);
        echo "

        ";
        // line 498
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "characters", [], "any", false, false, false, 498), "skills", [], "any", false, false, false, 498)) {
            // line 499
            echo "          <!-- SKILLS -->
          <div class=\"InnerTableContainer\">
            <table style=\"width:100%;\">
              <tbody>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      <tr bgcolor=\"";
            // line 508
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
            echo "\" style=\"text-align: center;\">
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/0/05/Journal_Shield.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/3/31/Lasting_Exercise_Rod.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/8/8a/Pair_of_Iron_Fists.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/3/3b/Lasting_Exercise_Club.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/d/db/Lasting_Exercise_Sword.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/4/44/Lasting_Exercise_Axe.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/7/7c/Lasting_Exercise_Bow.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/2/2f/Broken_Wooden_Shield.gif\"/>
                        </td>
                        <td style=\"border:0px;\"><img style=\"\"
                                                     src=\"https://www.tibiawiki.com.br/images/1/1f/Fishing_Rod.gif\"/>
                        </td>
                      </tr>
                      <tr bgcolor=\"";
            // line 537
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
            echo "\" style=\"text-align: center;\">
                        <td style=\"border:0px;\"><b>Level</b></td>
                        <td style=\"border:0px;\"><b>ML</b></td>
                        <td style=\"border:0px;\"><b>Fist</b></td>
                        <td style=\"border:0px;\"><b>Club</b></td>
                        <td style=\"border:0px;\"><b>Sword</b></td>
                        <td style=\"border:0px;\"><b>Axe</b></td>
                        <td style=\"border:0px;\"><b>Dist</b></td>
                        <td style=\"border:0px;\"><b>Def</b></td>
                        <td style=\"border:0px;\"><b>Fish</b></td>
                      </tr>
                      <tr bgcolor=\"";
            // line 548
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(2), "html", null, true);
            echo "\" style=\"text-align: center;\">
                        <td style=\"border:0px;\">";
            // line 549
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLevel", [], "method", false, false, false, 549), "html", null, true);
            echo "</td>
                        ";
            // line 550
            $context["i"] = 0;
            // line 551
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["skills"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["skill"]) {
                // line 552
                echo "                          ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 553
                echo "                          <td style=\"border:0px;\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "value", [], "any", false, false, false, 553), "html", null, true);
                echo "</td>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['skill'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 555
            echo "                      </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- SKILLS END -->
        ";
        }
        // line 566
        echo "
        ";
        // line 567
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_AFTER_SKILLS")), "html", null, true);
        echo "
      </td>
    </tr>
    </tbody>
  </table>
</div>

<br>

<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 580
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 582
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 584
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 586
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Character Quests</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 589
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 591
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 593
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 595
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <div style=\"top: 15px;\" id=\"QuestsCollapse\" class=\"BigToggleButton\"
       onclick=\"CollapseTable('QuestsCollapseContainer'); \$('#labelshow').html(\$('#labelshow').html() == 'show' ? 'hide' : 'show');\"
       onmouseover=\"ActivateHelperDiv(\$(this), '', 'Click here to expand the list of Quests.', '');\"
       onmouseout=\"\$('#HelperDivContainer').hide();\">
    <div id=\"Indicator_QuestsCollapseContainer\" class=\"CircleSymbolMinus\"
         style=\"position: absolute; height: 18px; width: 18px; top: -8px; right: -8px; z-index: 99; cursor: pointer; background-image: url(";
        // line 603
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "templates/tibiacom/images/global/content/circle-symbol-plus.gif);\"></div>
  </div>
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
    <tr>
      <td>
        <div class=\"InnerTableContainer\" id=\"QuestsCollapseContainer\" style=\"display: none\">
          <table style=\"width:100%;\">
            <tbody>
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                    <tbody>
                    ";
        // line 617
        $context["i"] = 0;
        // line 618
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["quests"] ?? null));
        foreach ($context['_seq'] as $context["name"] => $context["done"]) {
            // line 619
            echo "                      ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 620
            echo "                      ";
            $context["rows"] = (($context["rows"] ?? null) + 1);
            // line 621
            echo "                      <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                        <td style=\"width: 90%;\" class=\"LabelV175\">";
            // line 622
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "</td>
                        <td><img
                            src=\"templates/tibiacom/images/premiumfeatures/icon_";
            // line 624
            if ($context["done"]) {
                echo "yes";
            } else {
                echo "no";
            }
            echo ".png\"
                            title=\"";
            // line 625
            if ($context["done"]) {
                echo "Completed";
            } else {
                echo "Incomplete";
            }
            echo "\"></td>
                      </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['done'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 628
        echo "                    </tbody>
                  </table>
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
<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 646
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 648
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 650
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 652
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Account Achievements</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 655
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 657
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 659
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 661
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <div style=\"top: 15px;\" id=\"AchievementsCollapse\" class=\"BigToggleButton\"
       onclick=\"CollapseTable('AchievementsCollapseContainer'); \$('#labelshow').html(\$('#labelshow').html() == 'show' ? 'hide' : 'show');\"
       onmouseover=\"ActivateHelperDiv(\$(this), '', 'Click here to expand the Achievements list.', '');\"
       onmouseout=\"\$('#HelperDivContainer').hide();\">
    <div id=\"Indicator_AchievementsCollapseContainer\" class=\"CircleSymbolMinus\"
         style=\"position: absolute; height: 18px; width: 18px; top: -8px; right: -8px; z-index: 99; cursor: pointer; background-image: url(";
        // line 669
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "templates/tibiacom/images/global/content/circle-symbol-plus.gif);\"></div>
  </div>
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
    <tr>
      <td>
        <div class=\"InnerTableContainer\" id=\"AchievementsCollapseContainer\" style=\"display: none\">
          <table style=\"width:100%;\">
            <tbody>
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                    <tbody>
                    ";
        // line 683
        $context["i"] = 0;
        // line 684
        echo "                    ";
        if ((($context["achievementPoints"] ?? null) > 0)) {
            // line 685
            echo "                      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["achievements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["achievement"]) {
                // line 686
                echo "                        ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 687
                echo "                        ";
                $context["rows"] = (($context["rows"] ?? null) + 1);
                // line 688
                echo "                        <tr bgcolor=\"";
                echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
                echo "\">
                          <td style=\"width: 100px\">
                            ";
                // line 690
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, twig_get_attribute($this->env, $this->source, $context["achievement"], "grade", [], "any", false, false, false, 690)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 691
                    echo "                              <img src=\"";
                    echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
                    echo "images/global/general/achievement-grade-symbol.gif\"
                                   alt=\"Tibia Achievement\">
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 694
                echo "                          </td>
                          <td>
                            ";
                // line 696
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["achievement"], "name", [], "any", false, false, false, 696), "html", null, true);
                echo "
                            ";
                // line 697
                if ((twig_get_attribute($this->env, $this->source, $context["achievement"], "secret", [], "any", false, false, false, 697) == 1)) {
                    // line 698
                    echo "                              <img class=\"SecretAchievementIcon\"
                                   src=\"";
                    // line 699
                    echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
                    echo "images/global/general/achievement-secret-symbol.gif\"
                                   alt=\"Tibia Secret Achievement\">
                            ";
                }
                // line 702
                echo "                          </td>
                        </tr>
                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['achievement'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 705
            echo "                    ";
        } else {
            // line 706
            echo "                      <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
            echo "\">
                        <td style=\"text-align: center;\">This character has no achievement.</td>
                      </tr>
                    ";
        }
        // line 710
        echo "                    </tbody>
                  </table>
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

";
        // line 725
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_BEFORE_DEATHS")), "html", null, true);
        echo "

";
        // line 727
        if ((twig_length_filter($this->env, ($context["deaths"] ?? null)) > 0)) {
            // line 728
            echo "  <!-- DEATHS -->
  <div class=\"TableContainer\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
            // line 733
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
            // line 735
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
            // line 737
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
            // line 739
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Character Deaths</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
            // line 742
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
            // line 744
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
            // line 746
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
            // line 748
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <div style=\"top: 15px;\" id=\"DeathsCollapse\" class=\"BigToggleButton\"
         onclick=\"CollapseTable('DeathsCollapseContainer'); \$('#labelshow').html(\$('#labelshow').html() == 'show' ? 'hide' : 'show');\"
         onmouseover=\"ActivateHelperDiv(\$(this), '', 'Click here to expand the list of Deaths.', '');\"
         onmouseout=\"\$('#HelperDivContainer').hide();\">
      <div id=\"Indicator_DeathsCollapseContainer\" class=\"CircleSymbolMinus\"
           style=\"position: absolute; height: 18px; width: 18px; top: -8px; right: -8px; z-index: 99; cursor: pointer; background-image: url(";
            // line 756
            echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
            echo "templates/tibiacom/images/global/content/circle-symbol-plus.gif);\"></div>
    </div>
    <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
      <tbody>
      <tr>
        <td>
          <div class=\"InnerTableContainer\" id=\"DeathsCollapseContainer\" style=\"display: none\">
            <table style=\"width:100%;\">
              <tbody>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      ";
            // line 770
            $context["i"] = 0;
            // line 771
            echo "                      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["deaths"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["death"]) {
                // line 772
                echo "                        ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 773
                echo "                        ";
                $context["rows"] = (($context["rows"] ?? null) + 1);
                // line 774
                echo "                        <tr bgcolor=\"";
                echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["rows"] ?? null)), "html", null, true);
                echo "\">
                          <td>";
                // line 775
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["death"], "time", [], "any", false, false, false, 775), "j M Y, H:i"), "html", null, true);
                echo "</td>
                          <td>";
                // line 776
                echo twig_get_attribute($this->env, $this->source, $context["death"], "description", [], "any", false, false, false, 776);
                echo "</td>
                        </tr>
                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['death'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 779
            echo "                      </tbody>
                    </table>
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
  <!-- DEATHS_END -->
";
        }
        // line 795
        echo "


";
        // line 798
        if ((twig_length_filter($this->env, ($context["frags"] ?? null)) > 0)) {
            // line 799
            echo "  <!-- FRAGS -->
  <div class=\"TableContainer\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
            // line 804
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
            // line 806
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
            // line 808
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
            // line 810
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Character Frags</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
            // line 813
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
            // line 815
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
            // line 817
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
            // line 819
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <div style=\"top: 15px;\" id=\"FragsCollapse\" class=\"BigToggleButton\"
         onclick=\"CollapseTable('FragsCollapseContainer'); \$('#labelshow').html(\$('#labelshow').html() == 'show' ? 'hide' : 'show');\"
         onmouseover=\"ActivateHelperDiv(\$(this), '', 'Click here to expand the list of Frags.', '');\"
         onmouseout=\"\$('#HelperDivContainer').hide();\">
      <div id=\"Indicator_FragsCollapseContainer\" class=\"CircleSymbolMinus\"
           style=\"position: absolute; height: 18px; width: 18px; top: -8px; right: -8px; z-index: 99; cursor: pointer; background-image: url(";
            // line 827
            echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
            echo "templates/tibiacom/images/global/content/circle-symbol-plus.gif);\"></div>
    </div>
    <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
      <tbody>
      <tr>
        <td>
          <div class=\"InnerTableContainer\" id=\"FragsCollapseContainer\" style=\"display: none\">
            <table style=\"width:100%;\">
              <tbody>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      ";
            // line 841
            $context["i"] = 0;
            // line 842
            echo "                      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["frags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["frag"]) {
                // line 843
                echo "                        ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 844
                echo "                        <tr bgcolor=\"";
                echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                echo "\">
                          <td width=\"20%\" align=\"center\">";
                // line 845
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["frag"], "time", [], "any", false, false, false, 845), "j M Y, H:i"), "html", null, true);
                echo "</td>
                          <td>";
                // line 846
                echo twig_get_attribute($this->env, $this->source, $context["frag"], "description", [], "any", false, false, false, 846);
                echo "(";
                if (twig_get_attribute($this->env, $this->source, $context["frag"], "unjustified", [], "any", false, false, false, 846)) {
                    echo "<span
                            style=\"color: red; font-size: 10px\">Unjustified</span>";
                } else {
                    // line 847
                    echo "<span
                            style=\"color: green; font-size: 10px\">Justified</span>";
                }
                // line 848
                echo ")
                          </td>
                        </tr>
                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['frag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 852
            echo "                      </tbody>
                    </table>
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
  <!-- FRAGS_END -->
";
        }
        // line 868
        echo "

";
        // line 870
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_BEFORE_SIGNATURE")), "html", null, true);
        echo "
";
        // line 871
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "signature_enabled", [], "any", false, false, false, 871)) {
            // line 872
            echo "  <!-- SIGNATURE -->
  <div class=\"TableContainer\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
            // line 877
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
            // line 879
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
            // line 881
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
            // line 883
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Character Signature</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
            // line 886
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
            // line 888
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
            // line 890
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
            // line 892
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <div style=\"top: 15px;\" id=\"FragsCollapse\" class=\"BigToggleButton\"
         onclick=\"CollapseTable('FragsCollapseContainer'); \$('#labelshow').html(\$('#labelshow').html() == 'show' ? 'hide' : 'show');\"
         onmouseover=\"ActivateHelperDiv(\$(this), '', 'Click here to view the Signature.', '');\"
         onmouseout=\"\$('#HelperDivContainer').hide();\">
      <div id=\"Indicator_FragsCollapseContainer\" class=\"CircleSymbolMinus\"
           style=\"position: absolute; height: 18px; width: 18px; top: -8px; right: -8px; z-index: 99; cursor: pointer; background-image: url(";
            // line 900
            echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
            echo "templates/tibiacom/images/global/content/circle-symbol-plus.gif);\"></div>
    </div>
    <table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\">
      <tbody>
      <tr>
        <td>
          <div class=\"InnerTableContainer\" id=\"FragsCollapseContainer\" style=\"display: none\">
            <table style=\"width:100%;\">
              <tbody>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      <tr>
                        <td align=\"center\">
                          <script type=\"text/javascript\">
                            function copyData(containerid) {
                              var range = document.createRange();

                              range.selectNode(containerid);
                              window.getSelection().removeAllRanges();
                              window.getSelection().addRange(range);
                              document.execCommand(\"copy\");
                              window.getSelection().removeAllRanges();
                            }
                          </script>
                          <img src=\"";
            // line 927
            echo twig_escape_filter($this->env, ($context["signature_url"] ?? null), "html", null, true);
            echo "\" alt=\"Signature for player ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getName", [], "method", false, false, false, 927), "html", null, true);
            echo "\">
                        </td>
                        <td>
                          <table class=\"TableContent\" width=\"100%\">
                            <tr>
                              <td class=\"LabelV80\">Website:</td>
                              <td><input type=\"text\" id=\"inputSignatureWebsite\" class=\"input_clipboard\"
                                         value=\"<a href=&quot;";
            // line 934
            echo twig_escape_filter($this->env, ($context["player_link"] ?? null), "html", null, true);
            echo "&quot;><img src=&quot;";
            echo twig_escape_filter($this->env, ($context["signature_url"] ?? null), "html", null, true);
            echo "&quot;></a>\"
                                         style=\"width: 100%;\" onclick=\"this.select()\"></td>
                              <td>
                                <button onclick=\"copyData(inputSignatureWebsite)\" class=\"btn_clipboard\">Copy</button>
                              </td>
                            </tr>
                            <tr>
                              <td class=\"LabelV80\">Forum:</td>
                              <td><input type=\"text\" id=\"inputSignatureForum\" class=\"input_clipboard\"
                                         value=\"[URL=";
            // line 943
            echo twig_escape_filter($this->env, ($context["player_link"] ?? null), "html", null, true);
            echo "][IMG]";
            echo twig_escape_filter($this->env, ($context["signature_url"] ?? null), "html", null, true);
            echo "[/IMG][/URL]\"
                                         style=\"width: 100%;\"></td>
                              <td>
                                <button onclick=\"copyData(inputSignatureForum)\" class=\"btn_clipboard\">Copy</button>
                              </td>
                            </tr>
                            <tr>
                              <td class=\"LabelV80\">Direct link:</td>
                              <td><input type=\"text\" id=\"inputSignatureDirectLink\" class=\"input_clipboard\"
                                         value=\"";
            // line 952
            echo twig_escape_filter($this->env, ($context["signature_url"] ?? null), "html", null, true);
            echo "\" style=\"width: 100%;\"></td>
                              <td>
                                <button onclick=\"copyData(inputSignatureDirectLink)\" class=\"btn_clipboard\">Copy</button>
                              </td>
                            </tr>
                          </table>
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
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <br>
  <!-- SIGNATURE_END -->
";
        }
        // line 976
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_AFTER_SIGNATURE")), "html", null, true);
        echo "


<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
  <tr>
    <td>
      ";
        // line 982
        if ( !($context["hidden"] ?? null)) {
            // line 983
            echo "        ";
            $context["rows"] = 0;
            // line 984
            echo "        <div class=\"TableContainer\">
          <div class=\"CaptionContainer\">
            <div class=\"CaptionInnerContainer\">
              <span class=\"CaptionEdgeLeftTop\"
                    style=\"background-image:url(";
            // line 988
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
              <span class=\"CaptionEdgeRightTop\"
                    style=\"background-image:url(";
            // line 990
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
              <span class=\"CaptionBorderTop\"
                    style=\"background-image:url(";
            // line 992
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
              <span class=\"CaptionVerticalLeft\"
                    style=\"background-image:url(";
            // line 994
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
              <div class=\"Text\">Characters</div>
              <span class=\"CaptionVerticalRight\"
                    style=\"background-image:url(";
            // line 997
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
              <span class=\"CaptionBorderBottom\"
                    style=\"background-image:url(";
            // line 999
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
              <span class=\"CaptionEdgeLeftBottom\"
                    style=\"background-image:url(";
            // line 1001
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
              <span class=\"CaptionEdgeRightBottom\"
                    style=\"background-image:url(";
            // line 1003
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
            </div>
          </div>
          <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
            <tbody>
            <tr>
              <td>
                <div class=\"InnerTableContainer\">
                  <table style=\"width:100%;\">
                    <tbody>
                    <tr>
                      <td>
                        <div class=\"TableContentContainer\">
                          <table class=\"TableContent\" width=\"100%\">
                            <tbody>
                            <tr bgcolor=\"";
            // line 1018
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 1018), "html", null, true);
            echo "\">
                              <td width=\"40%\"><B>Name</b></td>
                              <td width=\"15%\"><B>Level</b></td>
                              <td width=\"20%\"><B>Vocation</b></td>
                              <td width=\"25%\"><b>Status</b></td>
                              <td><b>&#160;</b></td>
                            </tr>
                            ";
            // line 1025
            $context["i"] = 0;
            // line 1026
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["account_players"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
                // line 1027
                echo "                              ";
                if (( !twig_get_attribute($this->env, $this->source, $context["player"], "isHidden", [], "method", false, false, false, 1027) && ((($__internal_compile_10 = $this->env->getFunction('config')->getCallable()("characters")) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["deleted"] ?? null) : null) ||  !twig_get_attribute($this->env, $this->source, $context["player"], "isDeleted", [], "method", false, false, false, 1027)))) {
                    // line 1028
                    echo "                                ";
                    $context["i"] = (($context["i"] ?? null) + 1);
                    // line 1029
                    echo "                                <tr bgcolor=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                    echo "\">
                                  <td>
                                    <nobr>";
                    // line 1031
                    echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                    echo ".&#160;";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "method", false, false, false, 1031), "html", null, true);
                    if (twig_get_attribute($this->env, $this->source, $context["player"], "isDeleted", [], "method", false, false, false, 1031)) {
                        echo "<span
                                        style=\"color: red\"> [DELETED]</span>";
                    }
                    // line 1032
                    echo "</nobr>
                                  </td>
                                  <td>";
                    // line 1034
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getLevel", [], "method", false, false, false, 1034), "html", null, true);
                    echo "</td>
                                  <td>";
                    // line 1035
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getVocationName", [], "method", false, false, false, 1035), "html", null, true);
                    echo "</td>
                                  <td>";
                    // line 1036
                    if (twig_get_attribute($this->env, $this->source, $context["player"], "isOnline", [], "method", false, false, false, 1036)) {
                        echo "<img src=\"";
                        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                        echo "/images/on.gif\"
                                                                     title=\"Online\">";
                    } else {
                        // line 1037
                        echo "<img
                                      src=\"";
                        // line 1038
                        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                        echo "/images/off.gif\" title=\"Offline\">";
                    }
                    echo "</td>
                                  <td>
                                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                      <form action=\"";
                    // line 1041
                    echo twig_escape_filter($this->env, ($context["characters_link"] ?? null), "html", null, true);
                    echo "\" method=post>
                                        <tr>
                                          <td style=\"border: 0;\">
                                            <input type=\"hidden\" name=\"name\" value=\"";
                    // line 1044
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "method", false, false, false, 1044), "html", null, true);
                    echo "\"/>
                                            ";
                    // line 1045
                    $context["button_name"] = "View";
                    // line 1046
                    echo "                                            ";
                    $context["button_title"] = twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "method", false, false, false, 1046);
                    // line 1047
                    echo "                                            ";
                    echo twig_include($this->env, $context, "buttons.base.html.twig");
                    echo "

                                            ";
                    // line 1049
                    if (($context["canEdit"] ?? null)) {
                        // line 1050
                        echo "                                              <a href=\"admin/?p=players&id=";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getId", [], "method", false, false, false, 1050), "html", null, true);
                        echo "\"
                                                 title=\"Edit in Admin Panel\" target=\"_blank\">
                                                <div class=\"BigButton\"
                                                     style=\"background-image:url(";
                        // line 1053
                        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                        echo "/images/global/buttons/sbutton.gif)\">
                                                  <div onmouseover=\"MouseOverBigButton(this);\"
                                                       onmouseout=\"MouseOutBigButton(this);\">
                                                    <div class=\"BigButtonOver\"
                                                         style=\"background-image: url(";
                        // line 1057
                        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                        echo "/images/global/buttons/sbutton_over.gif); visibility: hidden;\"></div>
                                                    <input class=\"BigButtonText\" type=\"text\" name=\"Edit\" alt=\"Edit\"
                                                           value=\"Edit\"></div>
                                                </div>
                                              </a>
                                            ";
                    }
                    // line 1063
                    echo "                                          </td>
                                        </tr>
                                      </form>
                                    </table>
                                  </td>
                                </tr>
                              ";
                }
                // line 1070
                echo "                            ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['player'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1071
            echo "                            </tbody>
                          </table>
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
      ";
        }
        // line 1085
        echo "
      ";
        // line 1086
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_AFTER_CHARACTERS")), "html", null, true);
        echo "

      ";
        // line 1088
        if (($context["canEdit"] ?? null)) {
            // line 1089
            echo "        <br>
        <a href=\"admin/?p=players&id=";
            // line 1090
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getId", [], "method", false, false, false, 1090), "html", null, true);
            echo "\" title=\"Edit in Admin Panel\" target=\"_blank\">
          ";
            // line 1091
            $context["button_name"] = "Edit Character";
            // line 1092
            echo "          ";
            $this->loadTemplate("buttons.base.html.twig", "characters.html.twig", 1092)->display($context);
            // line 1093
            echo "        </a>
      ";
        }
        // line 1095
        echo "    </td>
  </tr>
</table>
<br/>";
        // line 1098
        echo ($context["search_form"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "characters.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2089 => 1098,  2084 => 1095,  2080 => 1093,  2077 => 1092,  2075 => 1091,  2071 => 1090,  2068 => 1089,  2066 => 1088,  2061 => 1086,  2058 => 1085,  2042 => 1071,  2028 => 1070,  2019 => 1063,  2010 => 1057,  2003 => 1053,  1996 => 1050,  1994 => 1049,  1988 => 1047,  1985 => 1046,  1983 => 1045,  1979 => 1044,  1973 => 1041,  1965 => 1038,  1962 => 1037,  1955 => 1036,  1951 => 1035,  1947 => 1034,  1943 => 1032,  1935 => 1031,  1929 => 1029,  1926 => 1028,  1923 => 1027,  1905 => 1026,  1903 => 1025,  1893 => 1018,  1875 => 1003,  1870 => 1001,  1865 => 999,  1860 => 997,  1854 => 994,  1849 => 992,  1844 => 990,  1839 => 988,  1833 => 984,  1830 => 983,  1828 => 982,  1819 => 976,  1792 => 952,  1778 => 943,  1764 => 934,  1752 => 927,  1722 => 900,  1711 => 892,  1706 => 890,  1701 => 888,  1696 => 886,  1690 => 883,  1685 => 881,  1680 => 879,  1675 => 877,  1668 => 872,  1666 => 871,  1662 => 870,  1658 => 868,  1640 => 852,  1631 => 848,  1627 => 847,  1620 => 846,  1616 => 845,  1611 => 844,  1608 => 843,  1603 => 842,  1601 => 841,  1584 => 827,  1573 => 819,  1568 => 817,  1563 => 815,  1558 => 813,  1552 => 810,  1547 => 808,  1542 => 806,  1537 => 804,  1530 => 799,  1528 => 798,  1523 => 795,  1505 => 779,  1496 => 776,  1492 => 775,  1487 => 774,  1484 => 773,  1481 => 772,  1476 => 771,  1474 => 770,  1457 => 756,  1446 => 748,  1441 => 746,  1436 => 744,  1431 => 742,  1425 => 739,  1420 => 737,  1415 => 735,  1410 => 733,  1403 => 728,  1401 => 727,  1396 => 725,  1379 => 710,  1371 => 706,  1368 => 705,  1360 => 702,  1354 => 699,  1351 => 698,  1349 => 697,  1345 => 696,  1341 => 694,  1331 => 691,  1327 => 690,  1321 => 688,  1318 => 687,  1315 => 686,  1310 => 685,  1307 => 684,  1305 => 683,  1288 => 669,  1277 => 661,  1272 => 659,  1267 => 657,  1262 => 655,  1256 => 652,  1251 => 650,  1246 => 648,  1241 => 646,  1221 => 628,  1208 => 625,  1200 => 624,  1195 => 622,  1190 => 621,  1187 => 620,  1184 => 619,  1179 => 618,  1177 => 617,  1160 => 603,  1149 => 595,  1144 => 593,  1139 => 591,  1134 => 589,  1128 => 586,  1123 => 584,  1118 => 582,  1113 => 580,  1097 => 567,  1094 => 566,  1081 => 555,  1072 => 553,  1069 => 552,  1064 => 551,  1062 => 550,  1058 => 549,  1054 => 548,  1040 => 537,  1008 => 508,  997 => 499,  995 => 498,  990 => 496,  973 => 482,  969 => 481,  960 => 479,  954 => 476,  948 => 473,  942 => 472,  936 => 469,  910 => 446,  906 => 445,  897 => 443,  891 => 440,  884 => 436,  880 => 435,  871 => 433,  865 => 430,  849 => 417,  846 => 416,  825 => 398,  819 => 395,  813 => 392,  807 => 389,  797 => 382,  791 => 379,  785 => 376,  779 => 373,  769 => 366,  763 => 363,  757 => 360,  751 => 357,  741 => 350,  733 => 345,  722 => 336,  720 => 335,  715 => 333,  712 => 332,  695 => 318,  687 => 317,  677 => 310,  667 => 302,  665 => 301,  654 => 293,  649 => 291,  644 => 289,  639 => 287,  633 => 284,  628 => 282,  623 => 280,  618 => 278,  593 => 255,  587 => 254,  577 => 252,  574 => 251,  572 => 250,  568 => 249,  562 => 247,  559 => 246,  553 => 243,  547 => 241,  544 => 240,  541 => 239,  539 => 238,  521 => 223,  516 => 221,  511 => 219,  506 => 217,  500 => 214,  495 => 212,  490 => 210,  485 => 208,  456 => 181,  453 => 180,  449 => 178,  445 => 176,  442 => 175,  439 => 174,  435 => 172,  430 => 170,  427 => 169,  425 => 168,  422 => 167,  420 => 166,  413 => 163,  411 => 162,  408 => 161,  402 => 158,  396 => 156,  393 => 155,  391 => 154,  380 => 151,  374 => 149,  372 => 148,  369 => 147,  363 => 144,  357 => 142,  354 => 141,  352 => 140,  349 => 139,  341 => 136,  335 => 134,  332 => 133,  330 => 132,  327 => 131,  321 => 128,  315 => 126,  312 => 125,  310 => 124,  307 => 123,  302 => 120,  299 => 119,  292 => 118,  284 => 114,  281 => 113,  279 => 112,  276 => 111,  270 => 108,  264 => 106,  261 => 105,  259 => 104,  253 => 101,  247 => 99,  245 => 98,  239 => 95,  233 => 93,  231 => 92,  225 => 89,  219 => 87,  217 => 86,  211 => 83,  205 => 81,  203 => 80,  197 => 77,  191 => 75,  189 => 74,  181 => 71,  175 => 69,  173 => 68,  167 => 64,  163 => 63,  156 => 62,  146 => 61,  142 => 60,  136 => 58,  134 => 57,  115 => 41,  110 => 39,  105 => 37,  100 => 35,  94 => 32,  89 => 30,  84 => 28,  79 => 26,  68 => 17,  63 => 14,  60 => 13,  58 => 12,  53 => 11,  51 => 10,  48 => 9,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "characters.html.twig", "/var/www/html/system/templates/characters.html.twig");
    }
}
