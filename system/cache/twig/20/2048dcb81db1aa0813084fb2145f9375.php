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

/* account.create_character.html.twig */
class __TwigTemplate_5d3471afaf54dcbb889c3c5a908e600e extends \Twig\Template
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
        echo "Please choose a name";
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 1)) > 1)) {
            echo ", vocation";
        }
        // line 2
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 2)) > 1)) {
            echo ", town";
        }
        echo " and sex for your character as well as the game world on which you want the character to live. If you cannot think of any fantasy names, click on the link below the name field to get some suggestions for a name.
<br>
<br>
In any case the name must not violate the naming conventions stated in the <a href=\"?subtopic=rules\"
                                                                              target=\"_blank\">";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 6), "serverName", [], "any", false, false, false, 6), "html", null, true);
        echo "
  Rules</a>, or your character might get deleted or name locked.
";
        // line 8
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["account_logged"] ?? null), "getPlayersList", [], "method", false, false, false, 8)) >= twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "characters_per_account", [], "any", false, false, false, 8))) {
            // line 9
            echo "  <b><span style=\"color: red\"> You have maximum number of characters per account on your account. Delete one before you make new.</span></b>
";
        }
        // line 11
        echo "<br>
<br>
<br>

<form action=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/create"), "html", null, true);
        echo "\" method=\"post\">
  <input type=\"hidden\" name=\"save\" value=\"1\">

  <div class=\"TableContainer\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
        // line 22
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
        // line 24
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span> <span
          class=\"CaptionBorderTop\"
          style=\"background-image:url(";
        // line 26
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
        // line 28
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Create Character</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
        // line 31
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
        // line 33
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
        // line 35
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span> <span
          class=\"CaptionEdgeRightBottom\"
          style=\"background-image:url(";
        // line 37
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span></div>
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
                      <tr class=\"LabelH\">
                        <td style=\"width:50%;\"><span>Name<span style=\"color: red;\">*</span></span></td>
                        <td><span>Sex </span style=\"color: red;\">*</span></span></td>
                      </tr>
                      <tr class=\"Even\">
                        <td><input name=\"name\" id=\"character_name\" value=\"";
        // line 56
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\"
                                   size=\"";
        // line 57
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_name_max_length", [], "any", false, false, false, 57), "html", null, true);
        echo "\"
                                   maxlength=\"";
        // line 58
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_name_max_length", [], "any", false, false, false, 58), "html", null, true);
        echo "\">
                                   onkeyup=\"checkName();\">
                          <img id=\"character_indicator\"
                               src=\"images/global/general/";
        // line 61
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 61))) {
            echo "n";
        }
        echo "ok.gif\"/>
                          <br>
                          <small>
                            <div
                              id=\"character_error\">";
        // line 65
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 65))) {
            echo "Please enter your character name.";
        }
        echo "</div>
                          </small>
                          <br>
                            <a href=\"#\" onclick=\"generateNewName(); return false;\" style=\"font-size: 0.9em; color: #0066cc; text-decoration: underline; cursor: pointer;\">
                              [suggest name]
                          </a>
                          </td>
                        <td>
                          ";
        // line 73
        $context["i"] = 0;
        // line 74
        echo "                          ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "genders", [], "any", false, false, false, 74), true));
        foreach ($context['_seq'] as $context["id"] => $context["gender"]) {
            // line 75
            echo "                            ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 76
            echo "                            <input type=\"radio\" name=\"sex\" id=\"sex";
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "\"
                                   value=\"";
            // line 77
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\"";
            if (( !(null === ($context["sex"] ?? null)) && (($context["sex"] ?? null) == $context["id"]))) {
                echo " checked=\"checked\"";
            }
            // line 78
            echo "                            ><label for=\"sex";
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, $context["gender"]), "html", null, true);
            echo "</label><br/>
                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['gender'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class=\"TableContentContainer\">
                    <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                      <tbody>
                      <tr class=\"LabelH\">
                        <td colspan=\"2\">Game World</td>
                      </tr>
                      <tr id=\"filterbox_servertype\" style=\"\">
                        <td style=\"padding: 1em\"><b>Filter by game world category</b><br>
                          <div style=\"text-align: justify\">There are different game world categories to choose from.
                            Regular game worlds are the default category, where all game features work as described in
                            the <a href=\"https://www.tibia.com/gameguides/?subtopic=manual\">manual</a>.<br>
                            Experimental game worlds are special game worlds, which are sometimes used to test new
                            features. Characters on these game worlds can be played normally, though they may be
                            affected by restrictions during tests.<br>
                            For details on experimental worlds, please see the corresponding <a
                              href=\"https://www.tibia.com/gameguides/?subtopic=manual\">manual</a> section.<br>
                            Finally, you can choose if you like to play on a game world which has been protected by
                            BattlEye from the start. BattlEye is a software that prevents the use of cheat software. It
                            is running in the background while you are playing Tibia. For more information, please have
                            a look at our <a
                              href=\"https://www.tibia.com/support/?subtopic=gethelp&amp;topicid=41\">FAQ</a>.<br>
                          </div>
                          <br>
                          <div align=\"center\">
                            <table>
                              <tbody>
                              <tr>
                                <td valign=\"top\" style=\"border:0px;\">
                                  <script>CreateFilterOption('server_type', 'REG', 'Regular Game World')</script>
                                  <div class=\"OptionContainer\">
                                    <label for=\"option_server_type_REG\" id=\"option_server_type_REG_label\">
                                      <input type=\"radio\" name=\"server_type\" id=\"option_server_type_REG\" checked
                                             value=\"REG\">
                                      Regular Game World</label>
                                  </div>
                                </td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr id=\"filterbox_location\" style=\"\">
                        <td style=\"padding: 1em\"><b>Filter by game world location</b><br>
                          <div style=\"text-align: justify\">For a good connection and with this the best possible gaming
                            experience, please select a game world that is situated nearest your own location.
                          </div>
                          <br>
                          <div align=\"center\">
                            <table>
                              <tbody>
                              <tr>
                                ";
        // line 141
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 141), "location", [], "any", false, false, false, 141) == "Europe")) {
            // line 142
            echo "                                  <td style=\"border:0px;width:20%;\">
                                    <div class=\"OptionContainer\">
                                      <label for=\"option_server_location_EUR\" id=\"option_server_location_EUR_label\"><img
                                          class=\"WorldLocationIcon\"
                                          src=\"";
            // line 146
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_location_eur.png\"
                                          alt=\"World Location\"><br>
                                        <input type=\"radio\" name=\"server_location\" id=\"option_server_location_EUR\"
                                               checked value=\"EUR\">
                                        Europe</label>
                                    </div>
                                    &nbsp;&nbsp;
                                  </td>
                                ";
        }
        // line 155
        echo "                                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 155), "location", [], "any", false, false, false, 155) == "North America")) {
            // line 156
            echo "                                  <td style=\"border:0px;width:20%;\">
                                    <div class=\"OptionContainer\">
                                      <label for=\"option_server_location_USA\" id=\"option_server_location_USA_label\"><img
                                          class=\"WorldLocationIcon\"
                                          src=\"";
            // line 160
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_location_usa.png\"
                                          alt=\"World Location\"><br>
                                        <input type=\"radio\" name=\"server_location\" id=\"option_server_location_USA\"
                                               checked value=\"USA\">
                                        North America</label>
                                    </div>
                                    &nbsp;&nbsp;
                                  </td>
                                ";
        }
        // line 169
        echo "                                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 169), "location", [], "any", false, false, false, 169) == "South America")) {
            // line 170
            echo "                                  <td style=\"border:0px;width:20%;\">
                                    <div class=\"OptionContainer\">
                                      <label for=\"option_server_location_BRA\" id=\"option_server_location_BRA_label\"><img
                                          class=\"WorldLocationIcon\"
                                          src=\"";
            // line 174
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_location_bra.png\"
                                          alt=\"World Location\"><br>
                                        <input type=\"radio\" name=\"server_location\" id=\"option_server_location_BRA\"
                                               checked value=\"BRA\">
                                        South&nbsp;America</label>
                                    </div>
                                    &nbsp;&nbsp;
                                  </td>
                                ";
        }
        // line 183
        echo "                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr id=\"filterbox_pvp\" style=\"display: block;\">
                        <td style=\"padding: 1em\"><b>Filter by game world PvP type</b><br>
                          <div style=\"text-align: justify\">There are five different game world types that differ in the
                            strictness of PvP rules. For a detailed description, please have a look at our <a href=\"\"
                                                                                                              target=\"_blank\">manual</a>.
                            If you cannot decide for a game world type, we recommend playing on optional PvP.
                          </div>
                          <br>
                          <div align=\"center\">
                            <table cellpadding=\"0\">
                              <tbody>
                              <tr>
                                ";
        // line 201
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 201), "worldType", [], "any", false, false, false, 201) == "no-pvp")) {
            // line 202
            echo "                                  <td width=\"33%\" align=\"center\" valign=\"top\" style=\"border:0px;\"><b>
                                      <div class=\"OptionContainer\">
                                        <label for=\"option_server_pvp_type_optional\"
                                               id=\"option_server_pvp_type_optional_label\"><img
                                            class=\"ServerInformationIcon\"
                                            src=\"";
            // line 207
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_pvp_type_optional.gif\"
                                            alt=\"Server PVP Type\" value=\"optional\"><br>
                                          <input type=\"radio\" name=\"server_pvp_type\"
                                                 id=\"option_server_pvp_type_optional\" onclick=\"UpdateServerList(this)\"
                                                 value=\"optional\">
                                          Optional PvP</label>
                                      </div>
                                    </b>&nbsp;&nbsp;Only if both sides agree, characters can be fought<br></td>
                                ";
        }
        // line 216
        echo "                                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 216), "worldType", [], "any", false, false, false, 216) == "pvp")) {
            // line 217
            echo "                                  <td width=\"33%\" align=\"center\" valign=\"top\" style=\"border:0px;\"><b>
                                      <div class=\"OptionContainer\">
                                        <label for=\"option_server_pvp_type_open\" id=\"option_server_pvp_type_open_label\"><img
                                            class=\"ServerInformationIcon\"
                                            src=\"";
            // line 221
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_pvp_type_open.gif\"
                                            alt=\"Server PVP Type\" value=\"open\"><br>
                                          <input type=\"radio\" name=\"server_pvp_type\" id=\"option_server_pvp_type_open\"
                                                 onclick=\"UpdateServerList(this)\" value=\"open\">
                                          Open PvP</label>
                                      </div>
                                    </b>&nbsp;&nbsp;Killing other characters is possible, but restricted<br></td>
                                ";
        }
        // line 229
        echo "                                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 229), "worldType", [], "any", false, false, false, 229) == "pvp-enforced")) {
            // line 230
            echo "                                  <td width=\"33%\" align=\"center\" valign=\"top\" style=\"border:0px;\"><b>
                                      <div class=\"OptionContainer\">
                                        <label for=\"option_server_pvp_type_hardcore\"
                                               id=\"option_server_pvp_type_hardcore_label\"
                                               style=\"color: rgb(90, 40, 0);\"><img class=\"ServerInformationIcon\"
                                                                                   src=\"";
            // line 235
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_pvp_type_hardcore.gif\"
                                                                                   alt=\"Server PVP Type\"
                                                                                   value=\"hardcore\"><br>
                                          <input type=\"radio\" name=\"server_pvp_type\"
                                                 id=\"option_server_pvp_type_hardcore\" onclick=\"UpdateServerList(this)\"
                                                 value=\"hardcore\">
                                          Hardcore PvP</label>
                                      </div>
                                    </b>&nbsp;&nbsp;Killing other characters is not restricted at all<br></td>
                                ";
        }
        // line 245
        echo "                              </tr>
                              <tr>
                                ";
        // line 247
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 247), "worldType", [], "any", false, false, false, 247) == "retro")) {
            // line 248
            echo "                                  <td width=\"33%\" align=\"center\" valign=\"top\" style=\"border:0px;\"></td>

                                  <td width=\"33%\" align=\"center\" valign=\"top\" style=\"border:0px;\"><b>
                                      <div class=\"OptionContainer\">
                                        <label for=\"option_server_pvp_type_retro\"
                                               id=\"option_server_pvp_type_retro_label\"><img
                                            class=\"ServerInformationIcon\"
                                            src=\"";
            // line 255
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_pvp_type_retro.gif\"
                                            alt=\"Server PVP Type\" value=\"retro\"><br>
                                          <input type=\"radio\" name=\"server_pvp_type\" id=\"option_server_pvp_type_retro\"
                                                 onclick=\"UpdateServerList(this)\" value=\"retro\">
                                          Retro Open PvP</label>
                                      </div>
                                    </b> &nbsp;&nbsp;Killing other characters is possible, but restricted (old PvP
                                    rules)<br></td>
                                ";
        }
        // line 264
        echo "                                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 264), "worldType", [], "any", false, false, false, 264) == "retro-enforced")) {
            // line 265
            echo "                                  <td width=\"33%\" align=\"center\" valign=\"top\" style=\"border:0px;\"><b>
                                      <div class=\"OptionContainer\">
                                        <label for=\"option_server_pvp_type_retrohardcore\"
                                               id=\"option_server_pvp_type_retrohardcore_label\"><img
                                            class=\"ServerInformationIcon\"
                                            src=\"";
            // line 270
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/option_server_pvp_type_retrohardcore.gif\"
                                            alt=\"Server PVP Type\" value=\"retrohardcore\"><br>
                                          <input type=\"radio\" name=\"server_pvp_type\"
                                                 id=\"option_server_pvp_type_retrohardcore\"
                                                 onclick=\"UpdateServerList(this)\" value=\"retrohardcore\">
                                          Retro Hardcore PvP</label>
                                      </div>
                                    </b>&nbsp;&nbsp;Killing other characters is not restricted at all (old PvP
                                    rules)<br></td>
                                ";
        }
        // line 280
        echo "                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr class=\"Even\">
                        <td colspan=\"2\">
                          <table id=\"js_world_box\" width=\"100%\">
                            <tbody>
                            <tr id=\"world_list_tr\">
                              <td style=\"border-style: none\" align=\"center\">
                                <div style=\"width: 15em; position: relative; text-align: left;\">
                                  <input type=\"radio\" name=\"world\" id=\"server_";
        // line 293
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 293), "serverName", [], "any", false, false, false, 293), "html", null, true);
        echo "\"
                                         value=\"server_";
        // line 294
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 294), "serverName", [], "any", false, false, false, 294), "html", null, true);
        echo "\" checked>
                                  <label for=\"server_";
        // line 295
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 295), "serverName", [], "any", false, false, false, 295), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 295), "serverName", [], "any", false, false, false, 295), "html", null, true);
        echo "</label>
                                  <span style=\"position:relative;top:0px;margin-left:5px;\"><a href=\"\"
                                                                                              target=\"_blank\"><span
                                        class=\"HelperDivIndicator\"
                                        onmouseover=\"ActivateHelperDiv(\$(this), '<b>BattlEye Protected Game World</b>', '<p>On this game world, BattlEye blocks cheats from the game. The game world has been protected by BattlEye since April 19, 2018.</p>', 'server_";
        // line 299
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 299), "serverName", [], "any", false, false, false, 299), "html", null, true);
        echo "_helper2');\"
                                        onmouseout=\"\$('#HelperDivContainer').hide();\"><img style=\"border:0px;\"
                                                                                           src=\"";
        // line 301
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/icon_battleye.gif\"
                                                                                           alt=\"special offer\"></span></a><span
                                      id=\"server_";
        // line 303
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 303), "serverName", [], "any", false, false, false, 303), "html", null, true);
        echo "_helper2\"></span></span></div>
                                &nbsp;<br></td>
                            </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
              ";
        // line 315
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 315)) > 1)) {
            // line 316
            echo "                <tr>
                  <td>
                    <div class=\"TableContentContainer\">
                      <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                        <tbody>
                        <tr class=\"LabelH\">
                          <td colspan=\"2\">Select your vocation <span style=\"color: red;\">*</span></td>
                        </tr>
                        <tr class=\"Even\">
                          ";
            // line 325
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 325));
            foreach ($context['_seq'] as $context["key"] => $context["sample_char"]) {
                // line 326
                echo "                            <td>
                              <input type=\"radio\" name=\"vocation\" id=\"vocation";
                // line 327
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\"
                                ";
                // line 328
                if (( !(null === ($context["vocation"] ?? null)) && (($context["vocation"] ?? null) == $context["key"]))) {
                    echo " checked=\"checked\"";
                }
                echo ">
                              <label for=\"vocation";
                // line 329
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (($__internal_compile_0 = (($__internal_compile_1 = ($context["config"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["vocations"] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[$context["key"]] ?? null) : null), "html", null, true);
                echo "</label>
                            </td>
                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['sample_char'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 332
            echo "                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
              ";
        }
        // line 339
        echo "
              ";
        // line 340
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 340)) > 1)) {
            // line 341
            echo "                <tr>
                  <td>
                    <div class=\"TableContentContainer\">
                      <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                        <tbody>
                        <tr class=\"LabelH\">
                          <td colspan=\"2\">Select your town <span style=\"color: red;\">*</span></td>
                        </tr>
                        <tr class=\"Odd\">
                          ";
            // line 350
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 350));
            foreach ($context['_seq'] as $context["_key"] => $context["town_id"]) {
                // line 351
                echo "                            <td>
                              <input type=\"radio\" name=\"town\" id=\"town";
                // line 352
                echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                echo "\"
                                ";
                // line 353
                if (( !(null === ($context["town"] ?? null)) && (($context["town"] ?? null) == $context["town_id"]))) {
                    echo " checked=\"checked\"";
                }
                echo ">
                              <label for=\"town";
                // line 354
                echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "towns", [], "any", false, false, false, 354)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[$context["town_id"]] ?? null) : null), "html", null, true);
                echo "</label>
                            </td>
                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['town_id'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 357
            echo "                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
              ";
        }
        // line 364
        echo "
              </tbody>
            </table>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>


  <br/>
  <table style=\"width:100%;\">
    <tr align=\"center\">
      <td>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td style=\"border:0px;\">
              ";
        // line 382
        echo twig_include($this->env, $context, "buttons.submit.html.twig");
        echo "
            </td>
          </tr>
</form>
</table>
</td>
<td>
  <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <form action=\"";
        // line 390
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/manage"), "html", null, true);
        echo "\" method=\"post\">
      <tr>
        <td style=\"border:0px;\">
          ";
        // line 393
        echo twig_include($this->env, $context, "buttons.back.html.twig");
        echo "
        </td>
      </tr>
    </form>
  </table>
</td>
</tr>
</table>
<script type=\"text/javascript\" src=\"tools/check_name.js\"></script>

<script type=\"text/javascript\">
\$(function () {
  \$('#character_name').keyup(function () {
    performValidation();
  });

  \$('#character_name').blur(function () {
    checkName();
  });
});

var eventId = 0;
var lastSend = 0;

function performValidation() {
  var name = document.getElementById('character_name').value;
  var \$characterError = \$('#character_error');
  var \$characterIndicator = \$('#character_indicator');

  if (name == '') {
    \$characterError.html(
      '<span style=\"color: red\">Please enter new character name.</span>',
    );
    \$characterIndicator.attr('src', 'images/global/general/nok.gif');
    \$characterIndicator.show();
    return;
  }

  \$.getJSON(
    'tools/validate.php',
    { name: name, uid: Math.random() },
    function (data) {
      if (data.hasOwnProperty('success')) {
        \$characterError.html(
          '<span style=\"color: green\">' + data.success + '</span>',
        );
        \$characterIndicator.attr('src', 'images/global/general/ok.gif');
      } else if (data.hasOwnProperty('error')) {
        \$characterError.html(
          '<span style=\"color: red\">' + data.error + '</span>',
        );
        \$characterIndicator.attr('src', 'images/global/general/nok.gif');
      }

      \$characterIndicator.show();
      lastSend = parseInt(new Date().getTime());
    },
  );
}

function checkName() {
  if (eventId != 0) {
    clearInterval(eventId);
    eventId = 0;
  }

  var timeNow = parseInt(new Date().getTime());
  if (lastSend != 0 && timeNow - lastSend < 1100) {
    eventId = setInterval('checkName()', 1100);
    return;
  }

  performValidation();
}

function generateNewName() {
  var prefixes = ['Ad', 'Al', 'Ar', 'Az', 'Be', 'Br', 'Ca', 'Ce', 'Ch', 'Cl', 'Co', 'Cr', 'Cu', 'Da', 'De', 'Di', 'Do', 'Dr', 'Du', 'El', 'Em', 'En', 'Er', 'Es', 'Et', 'Ex', 'Fa', 'Fe', 'Fi', 'Fl', 'Fo', 'Fr', 'Fu', 'Ga', 'Ge', 'Gi', 'Gl', 'Go', 'Gr', 'Gu', 'Ha', 'He', 'Hi', 'Ho', 'Hu', 'Hy', 'Ia', 'Id', 'If', 'Ig', 'Il', 'Im', 'In', 'Io', 'Ir', 'Is', 'It', 'Ja', 'Je', 'Ji', 'Jo', 'Ju', 'Ka', 'Ke', 'Ki', 'Ko', 'Ku', 'La', 'Le', 'Li', 'Lo', 'Lu', 'Ma', 'Me', 'Mi', 'Mo', 'Mu', 'Na', 'Ne', 'Ni', 'No', 'Nu', 'Oa', 'Oc', 'Od', 'Of', 'Og', 'Oh', 'Oi', 'Ok', 'Ol', 'Om', 'On', 'Oo', 'Op', 'Or', 'Os', 'Ot', 'Ou', 'Ov', 'Ow', 'Ox', 'Oy', 'Oz', 'Pa', 'Pe', 'Ph', 'Pi', 'Pl', 'Po', 'Pr', 'Pu', 'Qu', 'Ra', 'Re', 'Ri', 'Ro', 'Ru', 'Sa', 'Se', 'Sh', 'Si', 'Sk', 'Sl', 'Sm', 'Sn', 'So', 'Sp', 'St', 'Su', 'Sw', 'Ta', 'Te', 'Th', 'Ti', 'To', 'Tr', 'Tu', 'Tw', 'Ty', 'Un', 'Up', 'Ur', 'Us', 'Va', 'Ve', 'Vi', 'Vo', 'Wa', 'We', 'Wh', 'Wi', 'Wo', 'Wr', 'Xa', 'Xe', 'Xi', 'Xo', 'Xu', 'Ya', 'Ye', 'Yi', 'Yo', 'Yu', 'Za', 'Ze', 'Zi', 'Zo', 'Zu'];
  var middles = ['a', 'ae', 'ai', 'an', 'ar', 'as', 'at', 'au', 'e', 'ea', 'ed', 'ee', 'ef', 'eg', 'eh', 'ei', 'ek', 'el', 'em', 'en', 'er', 'es', 'et', 'eu', 'ev', 'ew', 'ex', 'ey', 'ez', 'i', 'ia', 'id', 'if', 'ig', 'ih', 'ik', 'il', 'im', 'in', 'ir', 'is', 'it', 'iu', 'ix', 'iy', 'o', 'oa', 'ob', 'od', 'of', 'og', 'oh', 'oi', 'ok', 'ol', 'om', 'on', 'op', 'or', 'os', 'ot', 'ou', 'ov', 'ox', 'oy', 'oz', 'u', 'ua', 'ub', 'ud', 'ue', 'ug', 'uh', 'ui', 'uk', 'ul', 'um', 'un', 'up', 'ur', 'us', 'ut', 'uu', 'uy', 'uz'];
  var suffixes = ['ad', 'af', 'ag', 'ah', 'ak', 'al', 'am', 'an', 'ap', 'ar', 'as', 'at', 'ax', 'ay', 'az', 'ed', 'ef', 'eg', 'eh', 'ek', 'el', 'em', 'en', 'ep', 'er', 'es', 'et', 'ex', 'ey', 'ez', 'id', 'if', 'ig', 'ih', 'ik', 'il', 'im', 'in', 'ip', 'ir', 'is', 'it', 'ix', 'iz', 'od', 'of', 'og', 'oh', 'ok', 'ol', 'om', 'on', 'op', 'or', 'os', 'ot', 'ox', 'oy', 'oz', 'ud', 'uf', 'ug', 'uh', 'uk', 'ul', 'um', 'un', 'up', 'ur', 'us', 'ut', 'ux', 'uy', 'uz'];

  var p = prefixes[Math.floor(Math.random() * prefixes.length)];
  var m = middles[Math.floor(Math.random() * middles.length)];
  var s = suffixes[Math.floor(Math.random() * suffixes.length)];

  document.getElementById('character_name').value = p + m + s;

  setTimeout(function () {
    performValidation();
  }, 100);

  return false;
}
</script>
";
    }

    public function getTemplateName()
    {
        return "account.create_character.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  664 => 393,  658 => 390,  647 => 382,  627 => 364,  618 => 357,  607 => 354,  601 => 353,  595 => 352,  592 => 351,  588 => 350,  577 => 341,  575 => 340,  572 => 339,  563 => 332,  552 => 329,  546 => 328,  540 => 327,  537 => 326,  533 => 325,  522 => 316,  520 => 315,  505 => 303,  500 => 301,  495 => 299,  486 => 295,  482 => 294,  478 => 293,  463 => 280,  450 => 270,  443 => 265,  440 => 264,  428 => 255,  419 => 248,  417 => 247,  413 => 245,  400 => 235,  393 => 230,  390 => 229,  379 => 221,  373 => 217,  370 => 216,  358 => 207,  351 => 202,  349 => 201,  329 => 183,  317 => 174,  311 => 170,  308 => 169,  296 => 160,  290 => 156,  287 => 155,  275 => 146,  269 => 142,  267 => 141,  204 => 80,  193 => 78,  187 => 77,  182 => 76,  179 => 75,  174 => 74,  172 => 73,  159 => 65,  150 => 61,  144 => 58,  140 => 57,  136 => 56,  114 => 37,  109 => 35,  104 => 33,  99 => 31,  93 => 28,  88 => 26,  83 => 24,  78 => 22,  68 => 15,  62 => 11,  58 => 9,  56 => 8,  51 => 6,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.create_character.html.twig", "/var/www/html/system/templates/account.create_character.html.twig");
    }
}
