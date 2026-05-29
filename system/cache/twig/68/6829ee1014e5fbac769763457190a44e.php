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

/* guilds.view.html.twig */
class __TwigTemplate_b51de8e57efcff77092f2a4d01f3f59f extends \Twig\Template
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
        echo "<table border=\"0\" width=\"100%\">
  <tbody>
  <tr>
    <td width=\"64\">
      <img src=\"images/guilds/";
        // line 5
        echo twig_escape_filter($this->env, ($context["logo"] ?? null), "html", null, true);
        echo "\" width=\"64\" height=\"64\">
    </td>

    <td align=\"center\" width=\"100%\"><h1>";
        // line 8
        echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
        echo "</h1></td>

    <td width=\"64\">
      <img src=\"images/guilds/";
        // line 11
        echo twig_escape_filter($this->env, ($context["logo"] ?? null), "html", null, true);
        echo "\" width=\"64\" height=\"64\">
    </td>
  </tr>
  </tbody>
</table>
<br>
<table width=\"100%\">
  <colgroup>
    <col width=\"90%\">
    <col width=\"10%\">
  </colgroup>
  <tbody>
  <tr>
    <td style=\"vertical-align:top; padding-right: 5px;\">
      <div class=\"TableContainer\">
        <div class=\"CaptionContainer\">
          <div class=\"CaptionInnerContainer\">
            <span class=\"CaptionEdgeLeftTop\"
                  style=\"background-image:url(";
        // line 29
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightTop\"
                  style=\"background-image:url(";
        // line 31
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionBorderTop\"
                  style=\"background-image:url(";
        // line 33
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionVerticalLeft\"
                  style=\"background-image:url(";
        // line 35
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
            <div class=\"Text\">Guild Information</div>
            <span class=\"CaptionVerticalRight\"
                  style=\"background-image:url(";
        // line 38
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
            <span class=\"CaptionBorderBottom\"
                  style=\"background-image:url(";
        // line 40
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionEdgeLeftBottom\"
                  style=\"background-image:url(";
        // line 42
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightBottom\"
                  style=\"background-image:url(";
        // line 44
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
          </div>
        </div>
        <table class=\"Table1\" cellpadding=\"0\" cellspacing=\"0\">
          <tbody>
          <tr>
            <td>
              <div class=\"InnerTableContainer\">
                <table style=\"width:100%;\">
                  <tbody>
                  <tr>
                    <td style=\"word-break: break-all\">
                      <div id=\"GuildInformationContainer\">
                        ";
        // line 57
        if ( !twig_test_empty(($context["description"] ?? null))) {
            // line 58
            echo "                          ";
            echo ($context["description"] ?? null);
            echo "
                          <br><br>
                        ";
        }
        // line 61
        echo "                        ";
        if ( !twig_test_empty(($context["guild_owner"] ?? null))) {
            // line 62
            echo "                          ";
            $context["guildOwnerName"] = twig_get_attribute($this->env, $this->source, ($context["guild_owner"] ?? null), "getName", [], "method", false, false, false, 62);
            // line 63
            echo "                          <i class=\"far fa-crown\"></i> <a
                          href=\"";
            // line 64
            echo twig_escape_filter($this->env, $this->env->getFunction('getPlayerLink')->getCallable()(($context["guildOwnerName"] ?? null), false), "html", null, true);
            echo "\"><b>";
            echo twig_escape_filter($this->env, ($context["guildOwnerName"] ?? null), "html", null, true);
            echo "</b></a> is guild leader of ";
            echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
            echo ".
                          <br>
                        ";
        }
        // line 67
        echo "                        <i class=\"far fa-calendar-star\"></i> The guild was founded on ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 67), "serverName", [], "any", false, false, false, 67), "html", null, true);
        echo "
                        on ";
        // line 68
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["guild_creation_date"] ?? null), "j F Y"), "html", null, true);
        echo ".<br>
                        <b><i class=\"far fa-sack-dollar\"></i> Guild Bank Account Balance: ";
        // line 69
        echo twig_escape_filter($this->env, ($context["guild_balance"] ?? null), "html", null, true);
        echo "
                          Gold</b><br>
                        ";
        // line 71
        if ((($context["guild_house"] ?? null) && ($context["isVice"] ?? null))) {
            // line 72
            echo "                          <i
                            class=\"far fa-house-user\"></i> Their home on ";
            // line 73
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 73), "serverName", [], "any", false, false, false, 73), "html", null, true);
            echo " is ";
            echo twig_escape_filter($this->env, ($context["guild_house"] ?? null), "html", null, true);
            echo "
                          <br>
                        ";
        }
        // line 76
        echo "                      </div>
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
    <td style=\"vertical-align:top;\">
      <div class=\"TableContainer\">
        <div class=\"CaptionContainer\">
          <div class=\"CaptionInnerContainer\">
            <span class=\"CaptionEdgeLeftTop\"
                  style=\"background-image:url(";
        // line 93
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightTop\"
                  style=\"background-image:url(";
        // line 95
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionBorderTop\"
                  style=\"background-image:url(";
        // line 97
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionVerticalLeft\"
                  style=\"background-image:url(";
        // line 99
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
            <div class=\"Text\">Navigation</div>
            <span class=\"CaptionVerticalRight\"
                  style=\"background-image:url(";
        // line 102
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
            <span class=\"CaptionBorderBottom\"
                  style=\"background-image:url(";
        // line 104
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
            <span class=\"CaptionEdgeLeftBottom\"
                  style=\"background-image:url(";
        // line 106
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
            <span class=\"CaptionEdgeRightBottom\"
                  style=\"background-image:url(";
        // line 108
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
          </div>
        </div>
        <table class=\"Table1\" cellpadding=\"0\" cellspacing=\"0\">
          <tbody>
          <tr>
            <td>
              <div class=\"InnerTableContainer\">
                <table style=\"width:100%;\">
                  <tbody>
                  <tr>
                    <td align=\"center\">
                      <div id=\"NavigationContainer\" style=\"height: 112px;\">
                        <div style=\"font-size:1px;height:4px;\"></div>
                        ";
        // line 122
        if (($context["isLeader"] ?? null)) {
            // line 123
            echo "                          <a href=\"?subtopic=guilds&action=manager&guild=";
            echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
            echo "\"
                             style=\"padding:0px;margin:0px;\">
                            ";
            // line 125
            $context["button_name"] = "Edit Ranks";
            // line 126
            echo "                            ";
            $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 126)->display($context);
            // line 127
            echo "                          </a>
                          <div style=\"font-size:1px;height:4px;\"></div>
                          <a href=\"?subtopic=guilds&guild=";
            // line 129
            echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
            echo "&action=change_logo\"
                             style=\"padding:0px;margin:0px;\">
                            ";
            // line 131
            $context["button_name"] = "Change Banner";
            // line 132
            echo "                            ";
            $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 132)->display($context);
            // line 133
            echo "                          </a>
                        ";
        }
        // line 135
        echo "                        <div style=\"font-size:1px;height:4px;\"></div>
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

    ";
        // line 149
        if (($context["isLeader"] ?? null)) {
            // line 150
            echo "      <td style=\"vertical-align:top;\">
        <div class=\"TableContainer\">
          <div class=\"CaptionContainer\">
            <div class=\"CaptionInnerContainer\">
              <span class=\"CaptionEdgeLeftTop\"
                    style=\"background-image:url(";
            // line 155
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
              <span class=\"CaptionEdgeRightTop\"
                    style=\"background-image:url(";
            // line 157
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
              <span class=\"CaptionBorderTop\"
                    style=\"background-image:url(";
            // line 159
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
              <span class=\"CaptionVerticalLeft\"
                    style=\"background-image:url(";
            // line 161
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
              <div class=\"Text\">Administration</div>
              <span class=\"CaptionVerticalRight\"
                    style=\"background-image:url(";
            // line 164
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-vertical.gif);\"></span>
              <span class=\"CaptionBorderBottom\"
                    style=\"background-image:url(";
            // line 166
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-headline-border.gif);\"></span>
              <span class=\"CaptionEdgeLeftBottom\"
                    style=\"background-image:url(";
            // line 168
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
              <span class=\"CaptionEdgeRightBottom\"
                    style=\"background-image:url(";
            // line 170
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/box-frame-edge.gif);\"></span>
            </div>
          </div>
          <table class=\"Table1\" cellpadding=\"0\" cellspacing=\"0\">
            <tbody>
            <tr>
              <td>
                <div class=\"InnerTableContainer\">
                  <table style=\"width:100%;\">
                    <tbody>
                    <tr>
                      <td align=\"center\">
                        <div id=\"NavigationContainer\" style=\"height: 112px;\">
                          <a href=\"?subtopic=guilds&guild=";
            // line 183
            echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
            echo "&action=change_description\"
                             style=\"padding:0px;margin:0px;\">
                            ";
            // line 185
            $context["button_name"] = "Edit Description";
            // line 186
            echo "                            ";
            $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 186)->display($context);
            // line 187
            echo "                          </a>
                          <div style=\"font-size:1px;height:4px;\"></div>
                          ";
            // line 189
            if (twig_constant("MOTD_EXISTS")) {
                // line 190
                echo "                            <a href=\"?subtopic=guilds&guild=";
                echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
                echo "&action=change_motd\"
                               style=\"padding:0px;margin:0px;\">
                              ";
                // line 192
                $context["button_name"] = "Create Board";
                // line 193
                echo "                              ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 193)->display($context);
                // line 194
                echo "                            </a>
                          ";
            }
            // line 196
            echo "                          <div style=\"font-size:1px;height:4px;\"></div>
                          <a href=\"?subtopic=guilds&guild=";
            // line 197
            echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
            echo "&action=delete_guild\"
                             style=\"padding:0px;margin:0px;\">
                            ";
            // line 199
            $context["button_name"] = "Disband Guild";
            // line 200
            echo "                            ";
            $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 200)->display($context);
            // line 201
            echo "                          </a>
                          <div style=\"font-size:1px;height:4px;\"></div>
                          <a href=\"?subtopic=guilds&guild=";
            // line 203
            echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
            echo "&action=pass_leadership\"
                             style=\"padding:0px;margin:0px;\">
                            ";
            // line 205
            $context["button_name"] = "Resign Leadership";
            // line 206
            echo "                            ";
            $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 206)->display($context);
            // line 207
            echo "                          </a>
                          <div style=\"font-size:1px;height:4px;\"></div>
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
    ";
        }
        // line 222
        echo "  </tr>
  </tbody>
</table>

<br>

<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 232
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 234
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 236
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 238
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Guild Members</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 241
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 243
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 245
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 247
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
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
                <div class=\"TableContentAndRightShadow\">
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\">
                      <tbody>
                      <tr class=\"LabelH\">
                        <td>Rank</td>
                        <td>Name";
        // line 265
        if (($context["useGuildNick"] ?? null)) {
            echo " and Title";
        }
        echo "</td>
                        <td>Vocation</td>
                        <td>Level</td>
                        <td>Status</td>
                      </tr>

                      ";
        // line 271
        list($context["showedRank"], $context["i"]) =         [false, 0];
        // line 272
        echo "                      ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["guild_members"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["rank"]) {
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rank"], "members", [], "any", false, false, false, 272)) > 0)) {
                // line 273
                echo "                        ";
                list($context["rankStyle"], $context["i"]) =                 [$this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), (($context["i"] ?? null) + 1)];
                // line 274
                echo "
                        ";
                // line 275
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["rank"], "members", [], "any", false, false, false, 275));
                foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
                    // line 276
                    echo "                          <tr bgcolor=\"";
                    echo twig_escape_filter($this->env, ($context["rankStyle"] ?? null), "html", null, true);
                    echo "\">
                            <td>
                              ";
                    // line 278
                    if ( !($context["showedRank"] ?? null)) {
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["rank"], "rank_name", [], "any", false, false, false, 278), "html", null, true);
                    }
                    // line 279
                    echo "                              ";
                    $context["showedRank"] = true;
                    // line 280
                    echo "                            </td>

                            <td>
                              ";
                    // line 283
                    $context["playerName"] = twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "method", false, false, false, 283);
                    // line 284
                    echo "                              <form
                                action=\"?subtopic=guilds&action=change_nick&name=";
                    // line 285
                    echo twig_escape_filter($this->env, ($context["playerName"] ?? null), "html", null, true);
                    echo "&guild=";
                    echo twig_escape_filter($this->env, ($context["guild_name"] ?? null), "html", null, true);
                    echo "\"
                                method=\"post\">
                                ";
                    // line 287
                    echo $this->env->getFunction('getPlayerLink')->getCallable()(($context["playerName"] ?? null), true);
                    echo "

                                ";
                    // line 289
                    $context["showGuildNick"] = false;
                    // line 290
                    echo "                                ";
                    if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["player"], "getGuildNick", [], "method", false, false, false, 290))) {
                        // line 291
                        echo "                                  ";
                        $context["showGuildNick"] = true;
                        // line 292
                        echo "                                  ";
                        $context["guildNickRaw"] = twig_get_attribute($this->env, $this->source, $context["player"], "getGuildNick", [], "method", false, false, false, 292);
                        // line 293
                        echo "                                ";
                    }
                    // line 294
                    echo "
                                ";
                    // line 295
                    if (($context["logged"] ?? null)) {
                        // line 296
                        echo "                                  ";
                        if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["player"], "getId", [], "method", false, false, false, 296), ($context["players_from_account_ids"] ?? null))) {
                            // line 297
                            echo "                                    <span class=\"rc-guild-nick-wrap\">
                                      <input type=\"text\" class=\"input_nick\" name=\"nick\" value=\"";
                            // line 298
                            echo twig_escape_filter($this->env, ($context["guildNickRaw"] ?? null), "html", null, true);
                            echo "\">
                                      <input type=\"submit\" class=\"btn_nick rc-guild-change-btn\" value=\"Change\">
                                    </span>
                                  ";
                        } else {
                            // line 302
                            echo "                                    ";
                            if (($context["showGuildNick"] ?? null)) {
                                echo "<span class=\"rc-guild-nick-text\">";
                                echo twig_escape_filter($this->env, ($context["guildNickRaw"] ?? null), "html", null, true);
                                echo "</span>";
                            }
                            // line 303
                            echo "                                  ";
                        }
                        // line 304
                        echo "
                                  ";
                        // line 305
                        if (((($context["level_in_guild"] ?? null) > twig_get_attribute($this->env, $this->source, $context["rank"], "rank_level", [], "any", false, false, false, 305)) || ($context["isLeader"] ?? null))) {
                            // line 306
                            echo "                                    ";
                            if ((($context["guildOwnerName"] ?? null) != ($context["playerName"] ?? null))) {
                                // line 307
                                echo "                                      <span style=\"font-size: 10px; float: right\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t{<a
                                          href=\"?subtopic=guilds&action=kick_player&guild=";
                                // line 309
                                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                                echo "&name=";
                                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["playerName"] ?? null)), "html", null, true);
                                echo "\">KICK</a>}
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>
                                    ";
                            }
                            // line 312
                            echo "                                  ";
                        }
                        // line 313
                        echo "                                ";
                    } else {
                        // line 314
                        echo "                                  ";
                        if (($context["showGuildNick"] ?? null)) {
                            echo "<span class=\"rc-guild-nick-text\">";
                            echo twig_escape_filter($this->env, ($context["guildNickRaw"] ?? null), "html", null, true);
                            echo "</span>";
                        }
                        // line 315
                        echo "                                ";
                    }
                    // line 316
                    echo "                              </form>
                            </td>

                            <td>";
                    // line 319
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getVocationName", [], "method", false, false, false, 319), "html", null, true);
                    echo "</td>
                            <td>";
                    // line 320
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getLevel", [], "method", false, false, false, 320), "html", null, true);
                    echo "</td>
                            <td>
                              <span
                                style=\"color: ";
                    // line 323
                    if (twig_get_attribute($this->env, $this->source, $context["player"], "isOnline", [], "method", false, false, false, 323)) {
                        echo " green;\">Online";
                    } else {
                        echo " red;\">Offline";
                    }
                    echo "</span>
                            </td>
                          </tr>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['player'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 327
                echo "
                        ";
                // line 328
                $context["showedRank"] = false;
                // line 329
                echo "                      ";
                $context['_iterated'] = true;
            }
        }
        if (!$context['_iterated']) {
            // line 330
            echo "                        <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
            echo "\">
                          <td colspan=\"5\">No guild members found.</td>
                        </tr>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rank'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 334
        echo "                      </tbody>
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

";
        // line 349
        if (($context["logged"] ?? null)) {
            // line 350
            echo "  <table border=\"0\" class=\"fixed\">
    <tbody>
    <tr></tr>
    </tbody>
    <colgroup>
      <col width=\"140px\">
      <col width=\"140px\">
      <col width=\"140px\">
      <col width=\"140px\">
      <col width=\"140px\">
      <col width=\"140px\">
    </colgroup>
    <tbody>
    <tr>
      ";
            // line 364
            if (($context["isVice"] ?? null)) {
                // line 365
                echo "        <td>
          <form action=\"?subtopic=guilds&action=invite&guild=";
                // line 366
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                echo "\" method=\"post\">
            ";
                // line 367
                $context["button_name"] = "Invite Character";
                // line 368
                echo "            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 368)->display($context);
                // line 369
                echo "          </form>
        </td>
        <td>
          <form action=\"?subtopic=guilds&action=change_rank&guild=";
                // line 372
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                echo "\" method=\"post\">
            ";
                // line 373
                $context["button_name"] = "Edit Members";
                // line 374
                echo "            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 374)->display($context);
                // line 375
                echo "          </form>
        </td>
        <td>
          <form action=\"?subtopic=guilds&action=accept_invite&guild=";
                // line 378
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                echo "\" method=\"post\">
            ";
                // line 379
                $context["button_name"] = "Accept Guild";
                // line 380
                echo "            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 380)->display($context);
                // line 381
                echo "          </form>
        </td>
        <td>
          <form action=\"?subtopic=guilds&action=leave_guild&guild=";
                // line 384
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                echo "\" method=\"post\">
            ";
                // line 385
                $context["button_name"] = "Leave Guild";
                // line 386
                echo "            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 386)->display($context);
                // line 387
                echo "          </form>
        </td>
      ";
            }
            // line 390
            echo "      ";
            if ( !($context["isLeader"] ?? null)) {
                // line 391
                echo "        <td>
          <form action=\"?subtopic=guilds&action=accept_invite&guild=";
                // line 392
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                echo "\" method=\"post\">
            ";
                // line 393
                $context["button_name"] = "Accept Guild";
                // line 394
                echo "            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 394)->display($context);
                // line 395
                echo "          </form>
        </td>
        <td>
          <form action=\"?subtopic=guilds&action=leave_guild&guild=";
                // line 398
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                echo "\" method=\"post\">
            ";
                // line 399
                $context["button_name"] = "Leave Guild";
                // line 400
                echo "            ";
                $this->loadTemplate("buttons.base.html.twig", "guilds.view.html.twig", 400)->display($context);
                // line 401
                echo "          </form>
        </td>
      ";
            }
            // line 404
            echo "    </tr>
    </tbody>
  </table>
";
        } else {
            // line 408
            echo "  <td>
    <form action=\"?subtopic=accountmanagement&redirect=";
            // line 409
            echo twig_escape_filter($this->env, $this->env->getFunction('getGuildLink')->getCallable()(twig_urlencode_filter(($context["guild_name"] ?? null)), false), "html", null, true);
            echo "\" method=\"post\">
      ";
            // line 410
            echo twig_include($this->env, $context, "buttons.login.html.twig");
            echo "
    </form>
  </td>
";
        }
        // line 414
        echo "
<div class=\"TableContainer\">
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
      <div class=\"Text\">Invited Characters</div>
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
                    ";
        // line 449
        if ((twig_length_filter($this->env, ($context["invited_list"] ?? null)) > 0)) {
            // line 450
            echo "                      <tr class=\"LabelH\">
                        <td><b>Name</b></td>
                      </tr>
                    ";
        }
        // line 454
        echo "                    ";
        $context["i"] = 0;
        // line 455
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invited_list"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invited_player"]) {
            if ((twig_length_filter($this->env, ($context["invited_list"] ?? null)) > 0)) {
                // line 456
                echo "                      ";
                if (twig_get_attribute($this->env, $this->source, $context["invited_player"], "isLoaded", [], "method", false, false, false, 456)) {
                    // line 457
                    echo "                        <tr bgcolor=\"";
                    echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
                    echo "\">
                          ";
                    // line 458
                    $context["i"] = (($context["i"] ?? null) + 1);
                    // line 459
                    echo "
                          <td>
                            ";
                    // line 461
                    echo $this->env->getFunction('getPlayerLink')->getCallable()(twig_get_attribute($this->env, $this->source, $context["invited_player"], "getName", [], "method", false, false, false, 461), true);
                    echo "

                            ";
                    // line 463
                    if (($context["isVice"] ?? null)) {
                        // line 464
                        echo "                              <div style=\"float: right\">
                                {<a
                                  href=\"?subtopic=guilds&action=delete_invite&guild=";
                        // line 466
                        echo twig_escape_filter($this->env, twig_urlencode_filter(($context["guild_name"] ?? null)), "html", null, true);
                        echo "&name=";
                        echo twig_escape_filter($this->env, twig_urlencode_filter(twig_get_attribute($this->env, $this->source, $context["invited_player"], "getName", [], "method", false, false, false, 466)), "html", null, true);
                        echo "\">Cancel
                                  Invitation</a>}
                              </div>
                            ";
                    }
                    // line 470
                    echo "                          </td>
                        </tr>
                      ";
                }
                // line 473
                echo "                    ";
                $context['_iterated'] = true;
            }
        }
        if (!$context['_iterated']) {
            // line 474
            echo "                      <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
            echo "\">
                        <td>
                          No invited characters found.
                        </td>
                      </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invited_player'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 480
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

<table border=\"0\" width=\"100%\">
  <tbody>
  <tr>
    <td align=\"center\"><img src=\"";
        // line 499
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/general/blank.gif\" width=\"80\" height=\"1\"
                            border=\"0<BR\"></td>
    <td align=\"center\">
      <form action=\"";
        // line 502
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("guilds"), "html", null, true);
        echo "\" method=\"post\">
        ";
        // line 503
        echo twig_include($this->env, $context, "buttons.back.html.twig");
        echo "
      </form>
    </td>
    <td align=\"center\"><img src=\"";
        // line 506
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/general/blank.gif\" width=\"80\" height=\"1\"
                            border=\"0<BR\"></td>
  </tr>
  </tbody>
</table>
";
    }

    public function getTemplateName()
    {
        return "guilds.view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1025 => 506,  1019 => 503,  1015 => 502,  1009 => 499,  988 => 480,  975 => 474,  969 => 473,  964 => 470,  955 => 466,  951 => 464,  949 => 463,  944 => 461,  940 => 459,  938 => 458,  933 => 457,  930 => 456,  923 => 455,  920 => 454,  914 => 450,  912 => 449,  894 => 434,  889 => 432,  884 => 430,  879 => 428,  873 => 425,  868 => 423,  863 => 421,  858 => 419,  851 => 414,  844 => 410,  840 => 409,  837 => 408,  831 => 404,  826 => 401,  823 => 400,  821 => 399,  817 => 398,  812 => 395,  809 => 394,  807 => 393,  803 => 392,  800 => 391,  797 => 390,  792 => 387,  789 => 386,  787 => 385,  783 => 384,  778 => 381,  775 => 380,  773 => 379,  769 => 378,  764 => 375,  761 => 374,  759 => 373,  755 => 372,  750 => 369,  747 => 368,  745 => 367,  741 => 366,  738 => 365,  736 => 364,  720 => 350,  718 => 349,  701 => 334,  690 => 330,  684 => 329,  682 => 328,  679 => 327,  665 => 323,  659 => 320,  655 => 319,  650 => 316,  647 => 315,  640 => 314,  637 => 313,  634 => 312,  626 => 309,  622 => 307,  619 => 306,  617 => 305,  614 => 304,  611 => 303,  604 => 302,  597 => 298,  594 => 297,  591 => 296,  589 => 295,  586 => 294,  583 => 293,  580 => 292,  577 => 291,  574 => 290,  572 => 289,  567 => 287,  560 => 285,  557 => 284,  555 => 283,  550 => 280,  547 => 279,  543 => 278,  537 => 276,  533 => 275,  530 => 274,  527 => 273,  520 => 272,  518 => 271,  507 => 265,  486 => 247,  481 => 245,  476 => 243,  471 => 241,  465 => 238,  460 => 236,  455 => 234,  450 => 232,  438 => 222,  421 => 207,  418 => 206,  416 => 205,  411 => 203,  407 => 201,  404 => 200,  402 => 199,  397 => 197,  394 => 196,  390 => 194,  387 => 193,  385 => 192,  379 => 190,  377 => 189,  373 => 187,  370 => 186,  368 => 185,  363 => 183,  347 => 170,  342 => 168,  337 => 166,  332 => 164,  326 => 161,  321 => 159,  316 => 157,  311 => 155,  304 => 150,  302 => 149,  286 => 135,  282 => 133,  279 => 132,  277 => 131,  272 => 129,  268 => 127,  265 => 126,  263 => 125,  257 => 123,  255 => 122,  238 => 108,  233 => 106,  228 => 104,  223 => 102,  217 => 99,  212 => 97,  207 => 95,  202 => 93,  183 => 76,  175 => 73,  172 => 72,  170 => 71,  165 => 69,  161 => 68,  156 => 67,  146 => 64,  143 => 63,  140 => 62,  137 => 61,  130 => 58,  128 => 57,  112 => 44,  107 => 42,  102 => 40,  97 => 38,  91 => 35,  86 => 33,  81 => 31,  76 => 29,  55 => 11,  49 => 8,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "guilds.view.html.twig", "/var/www/html/system/templates/guilds.view.html.twig");
    }
}
