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
                      <tr class=\"LabelH rc-createchar-title\">
                        <td style=\"width:50%; text-align:center;\"><span>Name <span style=\"color: red;\">*</span></span></td>
                        <td style=\"text-align:center;\"><span>Sex <span style=\"color: red;\">*</span></span></td>
                      </tr>
                      <tr class=\"Even\">
                        <td class=\"rc-createchar-name-cell\">
                          <div class=\"rc-createchar-name-wrap\">
                            <input name=\"name\" id=\"character_name\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\" class=\"rc-charname-input\"
                                   size=\"";
        // line 59
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_name_max_length", [], "any", false, false, false, 59), "html", null, true);
        echo "\"
                                   maxlength=\"";
        // line 60
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_name_max_length", [], "any", false, false, false, 60), "html", null, true);
        echo "\"
                                   onkeyup=\"checkName();\">
                            <img id=\"character_indicator\"
                                 src=\"images/global/general/";
        // line 63
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 63))) {
            echo "n";
        }
        echo "ok.gif\"/>
                            <small>
                              <div id=\"character_error\">";
        // line 65
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 65))) {
            echo "Please enter your character name.";
        }
        echo "</div>
                            </small>
                            <a href=\"#\" onclick=\"generateNewName(); return false;\" class=\"rc-suggest-link\">
                              [suggest name]
                            </a>
                          </div>
                        </td>
                        <td class=\"rc-createchar-sex-cell\">
                          <div class=\"rc-createchar-sex-wrap\">
                            ";
        // line 74
        $context["i"] = 0;
        // line 75
        echo "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "genders", [], "any", false, false, false, 75), true));
        foreach ($context['_seq'] as $context["id"] => $context["gender"]) {
            // line 76
            echo "                              ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 77
            echo "                              <div class=\"rc-createchar-sex-option\">
                                <input type=\"radio\" name=\"sex\" id=\"sex";
            // line 78
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "\"
                                       value=\"";
            // line 79
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\"";
            if (( !(null === ($context["sex"] ?? null)) && (($context["sex"] ?? null) == $context["id"]))) {
                echo " checked=\"checked\"";
            }
            echo ">
                                <label for=\"sex";
            // line 80
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, $context["gender"]), "html", null, true);
            echo "</label>
                              </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['gender'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 83
        echo "                          </div>
                        </td>
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
                      <tr class=\"LabelH rc-createchar-title rc-createchar-title-no-icon\">
                        <td colspan=\"2\">Game World</td>
                      </tr>
                      <tr class=\"Even\">
                        <td colspan=\"2\">
                          ";
        // line 101
        $context["rawWorldType"] = twig_lower_filter($this->env, ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "worldType", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "worldType", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "world_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "world_type", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))))))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "world_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "world_type", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvpType", [], "any", false, false, false, 101), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", true, true, false, 101)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 101), "pvp_type", [], "any", false, false, false, 101), "Open PvP")) : ("Open PvP")))))))));
        // line 102
        echo "                          ";
        $context["worldTypeKey"] = "open";
        // line 103
        echo "                          ";
        if ((twig_in_filter("optional", ($context["rawWorldType"] ?? null)) || twig_in_filter("no pvp", ($context["rawWorldType"] ?? null)))) {
            // line 104
            echo "                            ";
            $context["worldTypeKey"] = "optional";
            // line 105
            echo "                          ";
        } elseif (twig_in_filter("retro hardcore", ($context["rawWorldType"] ?? null))) {
            // line 106
            echo "                            ";
            $context["worldTypeKey"] = "retrohardcore";
            // line 107
            echo "                          ";
        } elseif (twig_in_filter("retro", ($context["rawWorldType"] ?? null))) {
            // line 108
            echo "                            ";
            $context["worldTypeKey"] = "retro";
            // line 109
            echo "                          ";
        } elseif ((twig_in_filter("hardcore", ($context["rawWorldType"] ?? null)) || twig_in_filter("enforced", ($context["rawWorldType"] ?? null)))) {
            // line 110
            echo "                            ";
            $context["worldTypeKey"] = "hardcore";
            // line 111
            echo "                          ";
        }
        // line 112
        echo "                          ";
        $context["worldTypeLabel"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "worldType", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "worldType", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "world_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "world_type", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))))))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "world_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "world_type", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvpType", [], "any", false, false, false, 112), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP")))) : (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", true, true, false, 112)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, true, false, 112), "pvp_type", [], "any", false, false, false, 112), "Open PvP")) : ("Open PvP"))))))));
        // line 113
        echo "                          <table class=\"rc-world-type-filter\" width=\"100%\">
                            <tbody>
                            <tr>
                              <td>
                                <label class=\"rc-world-type-option";
        // line 117
        if ((($context["worldTypeKey"] ?? null) == "optional")) {
            echo " is-active";
        }
        echo "\">
                                  <input type=\"radio\" name=\"world_type_filter\" value=\"optional\"";
        // line 118
        if ((($context["worldTypeKey"] ?? null) == "optional")) {
            echo " checked";
        }
        echo ">
                                  <img src=\"";
        // line 119
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/option_server_pvp_type_optional.gif\" alt=\"Optional PvP\">
                                  <span>Optional PvP</span>
                                </label>
                                <label class=\"rc-world-type-option";
        // line 122
        if ((($context["worldTypeKey"] ?? null) == "open")) {
            echo " is-active";
        }
        echo "\">
                                  <input type=\"radio\" name=\"world_type_filter\" value=\"open\"";
        // line 123
        if ((($context["worldTypeKey"] ?? null) == "open")) {
            echo " checked";
        }
        echo ">
                                  <img src=\"";
        // line 124
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/option_server_pvp_type_open.gif\" alt=\"Open PvP\">
                                  <span>Open PvP</span>
                                </label>
                                <label class=\"rc-world-type-option";
        // line 127
        if ((($context["worldTypeKey"] ?? null) == "hardcore")) {
            echo " is-active";
        }
        echo "\">
                                  <input type=\"radio\" name=\"world_type_filter\" value=\"hardcore\"";
        // line 128
        if ((($context["worldTypeKey"] ?? null) == "hardcore")) {
            echo " checked";
        }
        echo ">
                                  <img src=\"";
        // line 129
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/option_server_pvp_type_hardcore.gif\" alt=\"Hardcore PvP\">
                                  <span>Hardcore PvP</span>
                                </label>
                                <label class=\"rc-world-type-option";
        // line 132
        if ((($context["worldTypeKey"] ?? null) == "retro")) {
            echo " is-active";
        }
        echo "\">
                                  <input type=\"radio\" name=\"world_type_filter\" value=\"retro\"";
        // line 133
        if ((($context["worldTypeKey"] ?? null) == "retro")) {
            echo " checked";
        }
        echo ">
                                  <img src=\"";
        // line 134
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/option_server_pvp_type_retro.gif\" alt=\"Retro Open PvP\">
                                  <span>Retro Open PvP</span>
                                </label>
                                <label class=\"rc-world-type-option";
        // line 137
        if ((($context["worldTypeKey"] ?? null) == "retrohardcore")) {
            echo " is-active";
        }
        echo "\">
                                  <input type=\"radio\" name=\"world_type_filter\" value=\"retrohardcore\"";
        // line 138
        if ((($context["worldTypeKey"] ?? null) == "retrohardcore")) {
            echo " checked";
        }
        echo ">
                                  <img src=\"";
        // line 139
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/option_server_pvp_type_retrohardcore.png\" alt=\"Retro Hardcore PvP\">
                                  <span>Retro Hardcore PvP</span>
                                </label>
                              </td>
                            </tr>
                            </tbody>
                          </table>
                          <table id=\"js_world_box\" width=\"100%\">
                            <tbody>
                            <tr class=\"LabelH rc-createchar-world-head\">
                              <td style=\"border-style:none; text-align:center; width:70%;\">World</td>
                              <td style=\"border-style:none; text-align:center;\">Type</td>
                            </tr>
                            <tr id=\"world_list_tr\" data-pvp-type=\"";
        // line 152
        echo twig_escape_filter($this->env, ($context["worldTypeKey"] ?? null), "html", null, true);
        echo "\">
                              <td style=\"border-style: none\" align=\"center\">
                                <div style=\"width: 15em; position: relative; text-align: left;\">
                                  <input type=\"radio\" name=\"world\" id=\"server_";
        // line 155
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 155), "serverName", [], "any", false, false, false, 155), "html", null, true);
        echo "\"
                                         value=\"server_";
        // line 156
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 156), "serverName", [], "any", false, false, false, 156), "html", null, true);
        echo "\" checked>
                                  <label for=\"server_";
        // line 157
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 157), "serverName", [], "any", false, false, false, 157), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 157), "serverName", [], "any", false, false, false, 157), "html", null, true);
        echo "</label>
                                </div>
                              </td>
                              <td style=\"border-style: none; text-align: center;\">
                                <span class=\"rc-world-type\">
                                  <img class=\"rc-world-type-icon\" src=\"";
        // line 162
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/option_server_pvp_type_";
        (((($context["worldTypeKey"] ?? null) == "retrohardcore")) ? (print ("retrohardcore.png")) : (print (twig_escape_filter($this->env, (($context["worldTypeKey"] ?? null) . ".gif"), "html", null, true))));
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["worldTypeLabel"] ?? null), "html", null, true);
        echo "\">
                                  ";
        // line 163
        echo twig_escape_filter($this->env, ($context["worldTypeLabel"] ?? null), "html", null, true);
        echo "
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td colspan=\"2\" style=\"border-style:none;\">&nbsp;</td>
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
        // line 179
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 179)) > 1)) {
            // line 180
            echo "                <tr>
                  <td>
                    <div class=\"TableContentContainer\">
                      <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                        <tbody>
                        <tr class=\"LabelH rc-createchar-title rc-createchar-title-no-icon\">
                          <td colspan=\"";
            // line 186
            echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 186)), "html", null, true);
            echo "\">Select your vocation <span style=\"color: red;\">*</span></td>
                        </tr>
                        <tr class=\"Even rc-createchar-vocations\">
                          ";
            // line 189
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 189));
            foreach ($context['_seq'] as $context["key"] => $context["sample_char"]) {
                // line 190
                echo "                            <td class=\"rc-createchar-vocation-option\">
                              <input type=\"radio\" name=\"vocation\" id=\"vocation";
                // line 191
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\"
                                ";
                // line 192
                if (( !(null === ($context["vocation"] ?? null)) && (($context["vocation"] ?? null) == $context["key"]))) {
                    echo " checked=\"checked\"";
                }
                echo ">
                              <label for=\"vocation";
                // line 193
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
            // line 196
            echo "                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
              ";
        }
        // line 203
        echo "
              ";
        // line 204
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 204)) > 1)) {
            // line 205
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
            // line 214
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 214));
            foreach ($context['_seq'] as $context["_key"] => $context["town_id"]) {
                // line 215
                echo "                            <td>
                              <input type=\"radio\" name=\"town\" id=\"town";
                // line 216
                echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                echo "\"
                                ";
                // line 217
                if (( !(null === ($context["town"] ?? null)) && (($context["town"] ?? null) == $context["town_id"]))) {
                    echo " checked=\"checked\"";
                }
                echo ">
                              <label for=\"town";
                // line 218
                echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "towns", [], "any", false, false, false, 218)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[$context["town_id"]] ?? null) : null), "html", null, true);
                echo "</label>
                            </td>
                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['town_id'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 221
            echo "                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
              ";
        }
        // line 228
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
  <table class=\"rc-form-actions\" style=\"width:100%;\">
    <tr align=\"center\">
      <td>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td style=\"border:0px;\">
              ";
        // line 246
        echo twig_include($this->env, $context, "buttons.submit.html.twig");
        echo "
            </td>
          </tr>
        </table>
      </td>
    </form>
      <td>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <form action=\"";
        // line 254
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/manage"), "html", null, true);
        echo "\" method=\"post\">
            <tr>
              <td style=\"border:0px;\">
                ";
        // line 257
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

  \$('input[name=\"world_type_filter\"]').on('change', function () {
    filterWorldRowsByType(\$(this).val());
  });
  filterWorldRowsByType(\$('input[name=\"world_type_filter\"]:checked').val());
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

function filterWorldRowsByType(type) {
  if(!type) {
    \$('#js_world_box tbody tr').show();
    return;
  }

  \$('#js_world_box tbody tr').each(function() {
    var \$row = \$(this);
    var rowType = (\$row.data('pvp-type') || '').toString();
    if(!rowType) {
      return;
    }
    \$row.toggle(rowType === type);
  });
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
        return array (  568 => 257,  562 => 254,  551 => 246,  531 => 228,  522 => 221,  511 => 218,  505 => 217,  499 => 216,  496 => 215,  492 => 214,  481 => 205,  479 => 204,  476 => 203,  467 => 196,  456 => 193,  450 => 192,  444 => 191,  441 => 190,  437 => 189,  431 => 186,  423 => 180,  421 => 179,  402 => 163,  394 => 162,  384 => 157,  380 => 156,  376 => 155,  370 => 152,  354 => 139,  348 => 138,  342 => 137,  336 => 134,  330 => 133,  324 => 132,  318 => 129,  312 => 128,  306 => 127,  300 => 124,  294 => 123,  288 => 122,  282 => 119,  276 => 118,  270 => 117,  264 => 113,  261 => 112,  258 => 111,  255 => 110,  252 => 109,  249 => 108,  246 => 107,  243 => 106,  240 => 105,  237 => 104,  234 => 103,  231 => 102,  229 => 101,  209 => 83,  198 => 80,  190 => 79,  186 => 78,  183 => 77,  180 => 76,  175 => 75,  173 => 74,  159 => 65,  152 => 63,  146 => 60,  142 => 59,  138 => 58,  114 => 37,  109 => 35,  104 => 33,  99 => 31,  93 => 28,  88 => 26,  83 => 24,  78 => 22,  68 => 15,  62 => 11,  58 => 9,  56 => 8,  51 => 6,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.create_character.html.twig", "/var/www/html/system/templates/account.create_character.html.twig");
    }
}
