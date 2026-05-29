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

/* account.management.html.twig */
class __TwigTemplate_5817ec95a537c9dbb0f5b482671a99df extends \Twig\Template
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
        echo "<div style=\"text-align:center\">
  <table style=\"margin-left: auto; margin-right: auto;\">
    <tr>
      <td>
        <img src=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/headline-bracer-left.gif\" />
      </td>
      <td
        style=\"text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;\">";
        // line 8
        echo ($context["welcome_message"] ?? null);
        echo "
      </td>
      <td><img src=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/headline-bracer-right.gif\" /></td>
    </tr>
  </table>
  ";
        // line 13
        if ( !twig_test_empty(($context["verify_message"] ?? null))) {
            // line 14
            echo "    <table style=\"margin: 7px auto 1px auto\">
      <tr>
        <td
          style=\"text-align:center;vertical-align:middle;horizontal-align:center;font-size:20px;font-weight:bold;\">";
            // line 17
            echo ($context["verify_message"] ?? null);
            echo "
        </td>
      </tr>
    </table>
  ";
        }
        // line 22
        echo "  <br />
</div>
<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 28
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 30
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 32
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 34
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Account Status</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 37
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 39
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 41
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 43
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\">
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
                    <tr>
                      <td>
                        ";
        // line 60
        if (twig_get_attribute($this->env, $this->source, ($context["account_logged"] ?? null), "isPremium", [], "method", false, false, false, 60)) {
            // line 61
            echo "                          <img class=\"AccountStatusImage\"
                               src=\"";
            // line 62
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/account/account-status_green.gif\"
                               title=\"";
            // line 63
            echo twig_escape_filter($this->env, ($context["tag"] ?? null), "html", null, true);
            echo " Account\" alt=\"";
            echo twig_escape_filter($this->env, ($context["tag"] ?? null), "html", null, true);
            echo " account\">
                        ";
        } else {
            // line 65
            echo "                          <img class=\"AccountStatusImage\"
                               src=\"";
            // line 66
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/account/account-status_red.gif\"
                               title=\"Free Account\" alt=\"free account\">
                        ";
        }
        // line 69
        echo "                      </td>
                      <td width=\"100%\" valign=\"middle\">
                        <span class=\"BigBoldText\" style=\"font-size: 24px;\">
                        ";
        // line 73
        echo "                          ";
        echo ($context["account_status"] ?? null);
        echo "
                        ";
        // line 75
        echo "                        </span>
                        <small><br>";
        // line 76
        echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["account_expire_time"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[0] ?? null) : null), "html", null, true);
        echo " ";
        if ((($__internal_compile_1 = ($context["account_expire_time"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[1] ?? null) : null)) {
            // line 77
            echo "                            (<a href=\"?donate\">donate now</a>) ";
        }
        echo "</small>
                      </td>
                      <td>
                        ";
        // line 80
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "gifts_system", [], "any", false, false, false, 80)) {
            // line 81
            echo "                          <a href=\"?donate\" target=\"blank\">
                            <div class=\"BigButton\"
                                 style=\"background-image:url(";
            // line 83
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/buttons/sbutton_green.gif)\">
                              <div onmouseover=\"MouseOverBigButton('GetCoinsButton');\"
                                   onmouseout=\"MouseOutBigButton('GetCoinsButton');\">
                                <div id=\"GetCoinsButton\" class=\"BigButtonOver\"
                                     style=\"background-image:url(";
            // line 87
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/buttons/sbutton_green_over.gif); visibility: hidden;\"></div>
                                <input class=\"BigButtonText\" type=\"submit\" value=\"Get Coins\"></div>
                            </div>
                          </a>
                        ";
        }
        // line 92
        echo "                        <div style=\"font-size:1px;height:4px;\"></div>

                        <form action=\"";
        // line 94
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/logout"), "html", null, true);
        echo "\" method=\"post\" style=\"padding:0px;margin:0px;\">
                          ";
        // line 95
        echo twig_include($this->env, $context, "buttons.logout.html.twig");
        echo "
                        </form>
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

<h2 class=\"rc-title-ornate\">Support Ticket</h2>
<div class=\"TableContainer rc-am-support-ticket\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 120
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 122
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 124
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 126
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text rc-caption-title-force\">Support Ticket</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 129
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 131
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 133
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 135
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\">
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
                    <tr>
                      <td>
                        <div class=\"rc-ticket-manage-table-wrap\">
                          <table class=\"rc-ticket-manage-table\">
                            <thead>
                            <tr>
                              <th style=\"width: 70px;\">ID</th>
                              <th style=\"width: 140px;\">Category</th>
                              <th>Subject</th>
                              <th style=\"width: 170px;\">Status</th>
                              <th style=\"width: 170px;\">Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            ";
        // line 164
        if ((array_key_exists("my_tickets_preview", $context) && (twig_length_filter($this->env, ($context["my_tickets_preview"] ?? null)) > 0))) {
            // line 165
            echo "                              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["my_tickets_preview"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["ticket"]) {
                // line 166
                echo "                                <tr>
                                  <td>#";
                // line 167
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "id", [], "any", false, false, false, 167), "html", null, true);
                echo "</td>
                                  <td>";
                // line 168
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "ticket_type_label", [], "any", false, false, false, 168), "html", null, true);
                echo "</td>
                                  <td>
                                    <a href=\"?subtopic=accountmanagement&action=tickets&view_ticket=";
                // line 170
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "id", [], "any", false, false, false, 170), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "title", [], "any", false, false, false, 170), "html", null, true);
                echo "</a>
                                  </td>
                                  <td><span class=\"rc-ticket-status rc-ticket-status-";
                // line 172
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "status", [], "any", false, false, false, 172), "html_attr");
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "status_label", [], "any", false, false, false, 172), "html", null, true);
                echo "</span></td>
                                  <td>";
                // line 173
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticket"], "updated_at", [], "any", false, false, false, 173), "d/m/Y H:i"), "html", null, true);
                echo "</td>
                                </tr>
                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ticket'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 176
            echo "                            ";
        } else {
            // line 177
            echo "                              <tr>
                                <td colspan=\"5\">No tickets found.</td>
                              </tr>
                            ";
        }
        // line 181
        echo "                            </tbody>
                          </table>
                        </div>

                        <div class=\"rc-ticket-manage-toolbar\">
                          <a href=\"?subtopic=accountmanagement&action=tickets\" class=\"rc-btn rc-btn-primary\">Add Ticket</a>
                          <a href=\"?subtopic=accountmanagement&action=tickets\" class=\"rc-btn rc-btn-subtle\">Show All</a>
                          ";
        // line 188
        if ((array_key_exists("open_tickets_count", $context) && (($context["open_tickets_count"] ?? null) > 0))) {
            // line 189
            echo "                            <span class=\"rc-ticket-admin-reminder rc-ticket-admin-reminder-inline\">";
            echo twig_escape_filter($this->env, ($context["open_tickets_count"] ?? null), "html", null, true);
            echo "</span>
                          ";
        }
        // line 191
        echo "                        </div>
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

<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 213
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/back-to-top.gif\" />
    </a>
  </div>
</div>
<h2 class=\"rc-title-ornate\">Character List</h2>
<div class=\"TableContainer rc-am-character-list\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 222
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 224
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 226
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 228
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text rc-caption-title-force\">Character List</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 231
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 233
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 235
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 237
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\">
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
                    <tr class=\"LabelH\">
                      <td style=\"width: 15px !important;\"></td>
                      <td>Name</td>
                      <td style=\"width: 100px !important;\">Status</td>
                      <td style=\"width: 100px !important;\"></td>
                    </tr>
                    ";
        // line 258
        $context["i"] = 0;
        // line 259
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["players"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
            // line 260
            echo "                      ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 261
            echo "                      <tr style=\"background-color: ";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
            echo "; height: 50px;\">
                        <td style=\"font-weight: bold;\">";
            // line 262
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo ".</td>
                        <td>
                          <span style=\"white-space: nowrap; vertical-align: middle; line-height: 12px;\">
                            <span id=\"CharacterNameOf_0\"
                                  style=\"font-size:13pt; font-weight: bold;\">";
            // line 266
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "method", false, false, false, 266), "html", null, true);
            echo "
                              ";
            // line 267
            if (twig_get_attribute($this->env, $this->source, $context["player"], "isDeleted", [], "method", false, false, false, 267)) {
                // line 268
                echo "                                <span style=\"color: red\"><b> [ DELETED ] </b></span>
                              ";
            }
            // line 270
            echo "                              ";
            if (twig_get_attribute($this->env, $this->source, $context["player"], "isMain", [], "method", false, false, false, 270)) {
                // line 271
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                echo "/images//account/maincharacter.png\"
                                     alt=\"(Main Character)\" title=\"Main Character\">
                              ";
            }
            // line 274
            echo "\t\t\t\t\t\t\t\t\t\t        </span>
\t\t\t\t\t\t\t\t\t\t        <br>
                            <small>
                              <span
                                id=\"CharacterNameOf_0\">";
            // line 278
            echo twig_escape_filter($this->env, (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "vocations", [], "any", false, false, false, 278)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["player"], "getVocation", [], "method", false, false, false, 278)] ?? null) : null), "html", null, true);
            echo " - Level ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getLevel", [], "method", false, false, false, 278), "html", null, true);
            echo " - On ";
            echo twig_escape_filter($this->env, (($__internal_compile_3 = (($__internal_compile_4 = ($context["config"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["lua"] ?? null) : null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["serverName"] ?? null) : null), "html", null, true);
            echo "
                              ";
            // line 279
            if ( !(null === twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 279))) {
                // line 280
                echo "                                <br>
                                <span>Guild Membership: ";
                // line 281
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 281), "html", null, true);
                echo " of the <a
                                    href=\"\">";
                // line 282
                echo twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "link", [], "any", false, false, false, 282);
                echo "</a></span>
                              ";
            }
            // line 284
            echo "                              </span>
                            </small>
                          </span>
                        </td>
                        <td>
                          <img id=\"DailyReawardState\"
                               src=\"";
            // line 290
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/icon-status-dailyreward-collected.png\"
                               alt=\"Daily Reward collected\" title=\"Daily Reward collected\">
                          ";
            // line 292
            if (twig_get_attribute($this->env, $this->source, $context["player"], "isOnline", [], "method", false, false, false, 292)) {
                // line 293
                echo "                            <img src=\"templates/tibiacom/images/on.gif\" title=\"Online\">
                          ";
            } else {
                // line 295
                echo "                            <img src=\"templates/tibiacom/images/off.gif\" title=\"Offline\">
                          ";
            }
            // line 297
            echo "                        </td>
                        <td align=\"center\">
                          <span id=\"CharacterOptionsOf_0\">
                            <span style=\"font-weight:normal;\">";
            // line 300
            if ( !twig_get_attribute($this->env, $this->source, $context["player"], "isDeleted", [], "method", false, false, false, 300)) {
                echo "[<a
                                href=\"";
                // line 301
                echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()(("account/character/comment/" . $this->env->getFilter('urlencode')->getCallable()(twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "any", false, false, false, 301)))), "html", null, true);
                echo "\">Edit</a>]";
            }
            echo "</span>
                            <br>
                            <span style=\"font-weight:normal;\">[<a href=\"";
            // line 303
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/delete"), "html", null, true);
            echo "\">Delete</a>]</span>
                          </span>
                        </td>
                      </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['player'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 308
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
    <tr>
      <td>
        <table class=\"InnerTableButtonRow\" cellpadding=\"0\" cellspacing=\"0\"
               style=\"padding-bottom: 0; margin-bottom: -6px\">
          <tbody>
          <tr>
            <td>
              <div class=\"rc-account-character-actions\">
                <form action=\"";
        // line 326
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/create"), "html", null, true);
        echo "\" method=\"post\" class=\"rc-inline-form\">
                  <button type=\"submit\" class=\"rc-btn rc-btn-primary\">Create New Character</button>
                </form>
                ";
        // line 329
        if ((twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_change_character_main", [], "any", false, false, false, 329) && (twig_length_filter($this->env, ($context["players"] ?? null)) >= 1))) {
            // line 330
            echo "                  <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/main"), "html", null, true);
            echo "\" method=\"post\" class=\"rc-inline-form\">
                    <button type=\"submit\" class=\"rc-btn rc-btn-subtle\">Change Main</button>
                  </form>
                ";
        }
        // line 334
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_change_character_name", [], "any", false, false, false, 334)) {
            // line 335
            echo "                  <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/name"), "html", null, true);
            echo "\" method=\"post\" class=\"rc-inline-form\">
                    ";
            // line 336
            echo twig_include($this->env, $context, "buttons.change_name.html.twig");
            echo "
                  </form>
                ";
        }
        // line 339
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_change_character_sex", [], "any", false, false, false, 339)) {
            // line 340
            echo "                  <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/sex"), "html", null, true);
            echo "\" method=\"post\" class=\"rc-inline-form\">
                    ";
            // line 341
            echo twig_include($this->env, $context, "buttons.change_sex.html.twig");
            echo "
                  </form>
                ";
        }
        // line 344
        echo "              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </tr>
    </tbody>
  </table>
</div>

<br>

";
        // line 358
        echo "
";
        // line 359
        if (($context["email_request"] ?? null)) {
            // line 360
            echo "  <div class=\"SmallBox\">
    <div class=\"MessageContainer\">
      <div class=\"BoxFrameHorizontal\"
           style=\"background-image:url(";
            // line 363
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-horizontal.gif);\"></div>
      <div class=\"BoxFrameEdgeLeftTop\"
           style=\"background-image:url(";
            // line 365
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"BoxFrameEdgeRightTop\"
           style=\"background-image:url(";
            // line 367
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"Message\">
        <div class=\"BoxFrameVerticalLeft\"
             style=\"background-image:url(";
            // line 370
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></div>
        <div class=\"BoxFrameVerticalRight\"
             style=\"background-image:url(";
            // line 372
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></div>
        <table>
          <tr>
            <td class=\"LabelV\">Note:</td>
            <td style=\"width:100%;\">A request has been submitted to change the email address of this account to
              <b>";
            // line 377
            echo twig_escape_filter($this->env, ($context["email_new"] ?? null), "html", null, true);
            echo "</b>. After <b>";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["email_new_time"] ?? null), "j F Y, G:i:s"), "html", null, true);
            echo "</b> you can accept the new
              email address and finish the process. Please cancel the request if you do not want your email address to
              be changed! Also cancel the request if you have no access to the new email address!
            </td>
          </tr>
        </table>
        <div style=\"text-align:center\">
          <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
            <form action=\"";
            // line 385
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/email"), "html", null, true);
            echo "\" method=\"post\">
              <tr>
                <td style=\"border:0px;\">
                  ";
            // line 388
            echo twig_include($this->env, $context, "buttons.edit.html.twig");
            echo "
                </td>
              </tr>
            </form>
          </table>
        </div>
      </div>
      <div class=\"BoxFrameHorizontal\"
           style=\"background-image:url(";
            // line 396
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-horizontal.gif);\"></div>
      <div class=\"BoxFrameEdgeRightBottom\"
           style=\"background-image:url(";
            // line 398
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"BoxFrameEdgeLeftBottom\"
           style=\"background-image:url(";
            // line 400
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
    </div>
  </div>
  <br />
";
        }
        // line 405
        echo "<a name=\"General+Information\"></a>
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 409
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/back-to-top.gif\" />
    </a>
  </div>
</div>
<h2 class=\"rc-title-ornate\">Account Information</h2>
<div class=\"TableContainer rc-am-account-information\">
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
        // line 419
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
        // line 421
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
        // line 423
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
        // line 425
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text rc-caption-title-force\">Account Information</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
        // line 428
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
        // line 430
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
        // line 432
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
        // line 434
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <tr>
      <td>
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tr>
              <td>
                <div class=\"TableContentAndRightShadow\">
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\">
                      <tr style=\"background-color: ";
        // line 446
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 446), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">
                          Account ";
        // line 448
        if (twig_constant("USE_ACCOUNT_NAME")) {
            echo "Name";
        } else {
            echo "Number";
        }
        echo ":
                        </td>
                        <td style=\"width:90%;\">";
        // line 450
        echo twig_escape_filter($this->env, ($context["account"] ?? null), "html", null, true);
        echo "</td>
                      </tr>
                      <tr style=\"background-color: ";
        // line 452
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 452), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">Email Address:</td>
                        <td style=\"width:90%;\">";
        // line 454
        echo twig_escape_filter($this->env, (($context["account_email"] ?? null) . ($context["email_change"] ?? null)), "html", null, true);
        echo "</td>
                      </tr>
                      <tr style=\"background-color: ";
        // line 456
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 456), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">Created:</td>
                        <td>";
        // line 458
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["account_created"] ?? null), "M d Y, G:i:s"), "html", null, true);
        echo "</td>
                      </tr>
                      <tr style=\"background-color: ";
        // line 460
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 460), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">Last Login:</td>
                        <td>";
        // line 462
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["account_web_lastlogin"] ?? null), "M d Y, G:i:s"), "html", null, true);
        echo "</td>
                      </tr>
                      ";
        // line 465
        echo "                        <tr style=\"background-color: ";
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 465);
        echo ";\">
                          <td class=\"LabelV\">Account Status:</td>
                          <td>";
        // line 467
        echo ($context["account_status"] ?? null);
        echo "</td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 469
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 469);
        echo ";\">
                          <td class=\"LabelV\">Tibia Coins:</td>
                          <td>";
        // line 471
        echo ($context["account_coins"] ?? null);
        echo " <img src=\"";
        echo ($context["template_path"] ?? null);
        echo "/images/account/icon-tibiacoin.png\"
                                                       class=\"VSCCoinImages\" />
                            (Including: ";
        // line 473
        echo ($context["account_coins_transferable"] ?? null);
        echo " <img
                              src=\"";
        // line 474
        echo ($context["template_path"] ?? null);
        echo "/images/account/icon-tibiacointrusted.png\"
                            class=\"VSCCoinImages\">)
                          </td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 478
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 478);
        echo ";\">
                          <td class=\"LabelV\">Tournament Coins:</td>
                          <td>";
        // line 480
        echo ($context["tournament_coins"] ?? null);
        echo " <img
                              src=\"";
        // line 481
        echo ($context["template_path"] ?? null);
        echo "/images/account/icon-tournamentcoin.png\" class=\"VSCCoinImages\">
                          </td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 484
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 484);
        echo ";\">
                          <td class=\"LabelV\">Loyalt Title:</td>
                          <td>";
        // line 486
        echo ($context["account_loyalty_title"] ?? null);
        echo "</td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 488
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 488);
        echo ";\">
                          <td class=\"LabelV\">Loyalt Points:</td>
                          <td>";
        // line 490
        echo twig_number_format_filter($this->env, ($context["account_loyalty_points"] ?? null), 0, ",", ".");
        echo "</td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 492
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 492);
        echo ";\">
                          <td class=\"LabelV\">Registered:</td>
                          <td>";
        // line 494
        echo ($context["account_registered"] ?? null);
        echo "</td>
                        </tr>
                      ";
        // line 497
        echo "                    </table>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <table class=\"InnerTableButtonRow\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td>
                      <form action=\"";
        // line 507
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/password"), "html", null, true);
        echo "\" method=\"post\" class=\"rc-inline-form\">
                        <button type=\"submit\" class=\"rc-btn rc-btn-primary\">Change Password</button>
                      </form>
                    </td>
                    <td>
                      <form action=\"";
        // line 512
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/email"), "html", null, true);
        echo "\" method=\"post\" class=\"rc-inline-form\">
                        <input type=\"hidden\" name=\"newemail\" value=\"\" />
                        <input type=\"hidden\" name=\"newemaildate\" value=\"0\">
                        <button type=\"submit\" class=\"rc-btn rc-btn-subtle\">Change Email</button>
                      </form>
                    </td>
                    <td width=\"100%\"></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</div>

<br />

<a name=\"Register+Account\"></a>
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 536
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/back-to-top.gif\" />
    </a>
  </div>
</div>
<h2 class=\"rc-title-ornate\">Register Account</h2>
<div class=\"TableContainer rc-am-register-account\">
  <table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
          <span class=\"CaptionEdgeLeftTop\"
                style=\"background-image:url(";
        // line 546
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
        // line 548
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
        // line 550
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
        // line 552
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text rc-caption-title-force\">Register Account</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
        // line 555
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
        // line 557
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
        // line 559
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
        // line 561
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <tr>
      <td>
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tr>
              <td>
                <div class=\"TableContentAndRightShadow\">
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\">
                      ";
        // line 573
        if (twig_test_empty(($context["recovery_key"] ?? null))) {
            // line 574
            echo "                        <tr>
                          <td class=\"LabelV\">Your account is not registered!</td>
                          <td style=\"text-align:right;\">
                            <form action=\"";
            // line 577
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/register"), "html", null, true);
            echo "\" method=\"post\" class=\"rc-inline-form\">
                              <button type=\"submit\" class=\"rc-btn rc-btn-primary\">Register Account</button>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <td colspan=\"2\">You can register your account for increased protection. Click on \"Register Account\" and get your free recovery key today!</td>
                        </tr>
                      ";
        } else {
            // line 586
            echo "                        <tr>
                          <td class=\"LabelV\">Real Name:</td>
                          <td style=\"width:90%;\">";
            // line 588
            (( !twig_test_empty(($context["account_rlname"] ?? null))) ? (print (twig_escape_filter($this->env, ($context["account_rlname"] ?? null), "html", null, true))) : (print ("-")));
            echo "</td>
                        </tr>
                        <tr>
                          <td class=\"LabelV\">Address:</td>
                          <td style=\"width:90%;\">";
            // line 592
            (( !twig_test_empty(($context["account_location"] ?? null))) ? (print (twig_escape_filter($this->env, ($context["account_location"] ?? null), "html", null, true))) : (print ("-")));
            echo "</td>
                        </tr>
                        <tr>
                          <td class=\"LabelV\">Phone:</td>
                          <td style=\"width:90%;\">";
            // line 596
            (( !twig_test_empty(($context["account_phone"] ?? null))) ? (print (twig_escape_filter($this->env, ($context["account_phone"] ?? null), "html", null, true))) : (print ("-")));
            echo "</td>
                        </tr>
                        <tr>
                          <td class=\"LabelV\">Location:</td>
                          <td style=\"width:90%;\">";
            // line 600
            (( !twig_test_empty(($context["account_location"] ?? null))) ? (print (twig_escape_filter($this->env, ($context["account_location"] ?? null), "html", null, true))) : (print ("-")));
            echo "</td>
                        </tr>
                        ";
            // line 602
            if ((($context["account_show_rk"] ?? null) &&  !twig_test_empty(($context["recovery_key"] ?? null)))) {
                // line 603
                echo "                          <tr>
                            <td class=\"LabelV\">RK:</td>
                            <td style=\"width:90%;\">";
                // line 605
                echo twig_escape_filter($this->env, ($context["recovery_key"] ?? null), "html", null, true);
                echo "</td>
                          </tr>
                        ";
            }
            // line 608
            echo "                      ";
        }
        // line 609
        echo "                    </table>
                  </div>
                </div>
              </td>
            </tr>
            ";
        // line 614
        if (( !twig_test_empty(($context["recovery_key"] ?? null)) &&  !($context["account_update_info_on_register"] ?? null))) {
            // line 615
            echo "              <tr>
                <td>
                  <table class=\"InnerTableButtonRow\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                      <td width=\"100%\"></td>
                      <td>
                        <form action=\"";
            // line 621
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/info"), "html", null, true);
            echo "\" method=\"post\" class=\"rc-inline-form\">
                          <button type=\"submit\" class=\"rc-btn rc-btn-subtle\">Edit Contact Info</button>
                        </form>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            ";
        }
        // line 630
        echo "          </table>
        </div>
      </td>
    </tr>
  </table>
</div>
<br />

";
        // line 638
        if (($context["is_staff_webflag3"] ?? null)) {
            // line 639
            echo "<a name=\"Account+Logs\"></a>
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
            // line 643
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/back-to-top.gif\" />
    </a>
  </div>
</div>
<div class=\"TableContainer\">
  <table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
            // line 652
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
            // line 654
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
            // line 656
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
            // line 658
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Account logs</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
            // line 661
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
            // line 663
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
            // line 665
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
            // line 667
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <tr>
      <td>
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tr>
              <td>
                <div class=\"TableContent\">
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\">
                      <tr class=\"LabelH\">
                        <td style=\"width:60%\">Action</td>
                        <td style=\"width:30%\">Date</td>
                        <td style=\"width:10%\">IP</td>
                      </tr>
                      ";
            // line 685
            echo "                        ";
            $context["i"] = 0;
            // line 686
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                // line 687
                echo "                          ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 688
                echo "                          <tr style=\"background-color: ";
                echo $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null));
                echo "\">
                            <td>";
                // line 689
                echo twig_get_attribute($this->env, $this->source, $context["action"], "action", [], "any", false, false, false, 689);
                echo "</td>
                            <td>";
                // line 690
                echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["action"], "date", [], "any", false, false, false, 690), "d M Y, H:i:s");
                echo "</td>
                            <td title=\"";
                // line 691
                echo twig_get_attribute($this->env, $this->source, $context["action"], "ipv6", [], "any", false, false, false, 691);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["action"], "ip", [], "any", false, false, false, 691);
                echo "</td>
                          </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 694
            echo "                      ";
            // line 695
            echo "                    </table>
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</div>
";
        }
        // line 707
        echo "
";
    }

    public function getTemplateName()
    {
        return "account.management.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1301 => 707,  1287 => 695,  1285 => 694,  1274 => 691,  1270 => 690,  1266 => 689,  1261 => 688,  1258 => 687,  1253 => 686,  1250 => 685,  1230 => 667,  1225 => 665,  1220 => 663,  1215 => 661,  1209 => 658,  1204 => 656,  1199 => 654,  1194 => 652,  1182 => 643,  1176 => 639,  1174 => 638,  1164 => 630,  1152 => 621,  1144 => 615,  1142 => 614,  1135 => 609,  1132 => 608,  1126 => 605,  1122 => 603,  1120 => 602,  1115 => 600,  1108 => 596,  1101 => 592,  1094 => 588,  1090 => 586,  1078 => 577,  1073 => 574,  1071 => 573,  1056 => 561,  1051 => 559,  1046 => 557,  1041 => 555,  1035 => 552,  1030 => 550,  1025 => 548,  1020 => 546,  1007 => 536,  980 => 512,  972 => 507,  960 => 497,  955 => 494,  950 => 492,  945 => 490,  940 => 488,  935 => 486,  930 => 484,  924 => 481,  920 => 480,  915 => 478,  908 => 474,  904 => 473,  897 => 471,  892 => 469,  887 => 467,  881 => 465,  876 => 462,  871 => 460,  866 => 458,  861 => 456,  856 => 454,  851 => 452,  846 => 450,  837 => 448,  832 => 446,  817 => 434,  812 => 432,  807 => 430,  802 => 428,  796 => 425,  791 => 423,  786 => 421,  781 => 419,  768 => 409,  762 => 405,  754 => 400,  749 => 398,  744 => 396,  733 => 388,  727 => 385,  714 => 377,  706 => 372,  701 => 370,  695 => 367,  690 => 365,  685 => 363,  680 => 360,  678 => 359,  675 => 358,  660 => 344,  654 => 341,  649 => 340,  646 => 339,  640 => 336,  635 => 335,  632 => 334,  624 => 330,  622 => 329,  616 => 326,  596 => 308,  585 => 303,  578 => 301,  574 => 300,  569 => 297,  565 => 295,  561 => 293,  559 => 292,  554 => 290,  546 => 284,  541 => 282,  537 => 281,  534 => 280,  532 => 279,  524 => 278,  518 => 274,  511 => 271,  508 => 270,  504 => 268,  502 => 267,  498 => 266,  491 => 262,  486 => 261,  483 => 260,  478 => 259,  476 => 258,  452 => 237,  447 => 235,  442 => 233,  437 => 231,  431 => 228,  426 => 226,  421 => 224,  416 => 222,  404 => 213,  380 => 191,  374 => 189,  372 => 188,  363 => 181,  357 => 177,  354 => 176,  345 => 173,  339 => 172,  332 => 170,  327 => 168,  323 => 167,  320 => 166,  315 => 165,  313 => 164,  281 => 135,  276 => 133,  271 => 131,  266 => 129,  260 => 126,  255 => 124,  250 => 122,  245 => 120,  217 => 95,  213 => 94,  209 => 92,  201 => 87,  194 => 83,  190 => 81,  188 => 80,  181 => 77,  177 => 76,  174 => 75,  169 => 73,  164 => 69,  158 => 66,  155 => 65,  148 => 63,  144 => 62,  141 => 61,  139 => 60,  119 => 43,  114 => 41,  109 => 39,  104 => 37,  98 => 34,  93 => 32,  88 => 30,  83 => 28,  75 => 22,  67 => 17,  62 => 14,  60 => 13,  54 => 10,  49 => 8,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.management.html.twig", "/var/www/html/templates/tibiacom/account.management.html.twig");
    }
}
