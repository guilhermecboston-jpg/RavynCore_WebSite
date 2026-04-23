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
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                    <tbody>
                    <tr>
                      <style>
                        .premiumbenefits {
                          display: flex;
                          margin: 0px auto;
                        }

                        .premiumbenefits > div {
                          display: flex;
                          align-items: center;
                          flex: 1;
                          margin: auto 5x;
                        }
                      </style>
                      <td class=\"premiumbenefits\">
                        <div style=\"justify-content: flex-start\">
                          <img class=\"PremiumFeatureImage1\"
                               src=\"";
        // line 126
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/premiumfeatures/PremiumIcon-Travel.png\"
                               alt=\"premium feature 1\" style=\"margin:0px 5px\">
                          <div>use instant travel system</div>
                        </div>
                        <div style=\"justify-content: center\">
                          <img class=\"PremiumFeatureImage1\"
                               src=\"";
        // line 132
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/premiumfeatures/PremiumIcon-VIPGroups.png\"
                               alt=\"premium feature 1\" style=\"margin:0px 5px\">
                          <div>add groups to organise your VIP list</div>
                        </div>
                        <div style=\"justify-content: flex-end\">
                          <img class=\"PremiumFeatureImage1\"
                               src=\"";
        // line 138
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/premiumfeatures/PremiumIcon-Promotion.png\"
                               alt=\"premium feature 1\" style=\"margin:0px 5px\">
                          <div>get stronger with a promotion</div>
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
    </tbody>
  </table>
</div>

<br>

<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 164
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 166
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 168
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 170
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Download Client</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 173
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 175
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 177
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 179
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
                        <div style=\"height: 55px;\">
                          <div id=\"DowloadBox\" style=\"position: relative; float:right;\">
                            <a href=\"?downloadclient\"><img
                                style=\"width: 45px; height: 45px; border: 0px; margin-right: 10px;\"
                                src=\"";
        // line 200
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/account/download_windows.gif\"></a>
                            <br>
                            <a style=\"position: absolute; bottom: -5px; right: 0px;\" href=\"?downloadclient\">Download</a>
                          </div>
                          <span style=\"position: relative; top: 18px;\">Click <a href=\"?downloadclient\">here</a> to download the latest ";
        // line 204
        echo twig_escape_filter($this->env, (($__internal_compile_2 = (($__internal_compile_3 = ($context["config"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["lua"] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["serverName"] ?? null) : null), "html", null, true);
        echo " client!</span>
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
    </tbody>
  </table>
</div>

<br>

";
        // line 224
        if (twig_test_empty(($context["recovery_key"] ?? null))) {
            // line 225
            echo "  <div class=\"SmallBox\">
    <div class=\"MessageContainer\">
      <div class=\"BoxFrameHorizontal\"
           style=\"background-image:url(";
            // line 228
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-horizontal.gif);\"></div>
      <div class=\"BoxFrameEdgeLeftTop\"
           style=\"background-image:url(";
            // line 230
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"BoxFrameEdgeRightTop\"
           style=\"background-image:url(";
            // line 232
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"Message\">
        <div class=\"BoxFrameVerticalLeft\"
             style=\"background-image:url(";
            // line 235
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></div>
        <div class=\"BoxFrameVerticalRight\"
             style=\"background-image:url(";
            // line 237
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></div>
        <table>
          <tr>
            <td class=\"LabelV\">Your account is not registered!</td>
            <td>
              <form action=\"";
            // line 242
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/register"), "html", null, true);
            echo "\" method=\"post\" style=\"border:0;\">
                <td style=\"border:0;\">
                  ";
            // line 244
            echo twig_include($this->env, $context, "buttons.register_account.html.twig");
            echo "
                </td>
              </form>
            </td>
          </tr>
          <tr>
            <td style=\"width:100%;\">You can register your account for increased protection. Click on \"Register Account\"
              and get your free recovery key today!
            </td>
          </tr>
        </table>
      </div>
      <div class=\"BoxFrameHorizontal\"
           style=\"background-image:url(";
            // line 257
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-horizontal.gif);\"></div>
      <div class=\"BoxFrameEdgeRightBottom\"
           style=\"background-image:url(";
            // line 259
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"BoxFrameEdgeLeftBottom\"
           style=\"background-image:url(";
            // line 261
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
    </div>
  </div>
  <br />
";
        }
        // line 266
        echo "
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 270
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/back-to-top.gif\" />
    </a>
  </div>
</div>
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
      <div class=\"Text\">Characters</div>
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
                      <td style=\"text-align: center; font-weight: bold;\">Regular Characters</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>

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
        // line 334
        $context["i"] = 0;
        // line 335
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["players"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
            // line 336
            echo "                      ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 337
            echo "                      <tr style=\"background-color: ";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
            echo "; height: 50px;\">
                        <td style=\"font-weight: bold;\">";
            // line 338
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo ".</td>
                        <td>
                          <span style=\"white-space: nowrap; vertical-align: middle; line-height: 12px;\">
                            <span id=\"CharacterNameOf_0\"
                                  style=\"font-size:13pt; font-weight: bold;\">";
            // line 342
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "method", false, false, false, 342), "html", null, true);
            echo "
                              ";
            // line 343
            if (twig_get_attribute($this->env, $this->source, $context["player"], "isDeleted", [], "method", false, false, false, 343)) {
                // line 344
                echo "                                <span style=\"color: red\"><b> [ DELETED ] </b></span>
                              ";
            }
            // line 346
            echo "                              ";
            if (twig_get_attribute($this->env, $this->source, $context["player"], "isMain", [], "method", false, false, false, 346)) {
                // line 347
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                echo "/images//account/maincharacter.png\"
                                     alt=\"(Main Character)\" title=\"Main Character\">
                              ";
            }
            // line 350
            echo "\t\t\t\t\t\t\t\t\t\t        </span>
\t\t\t\t\t\t\t\t\t\t        <br>
                            <small>
                              <span
                                id=\"CharacterNameOf_0\">";
            // line 354
            echo twig_escape_filter($this->env, (($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "vocations", [], "any", false, false, false, 354)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["player"], "getVocation", [], "method", false, false, false, 354)] ?? null) : null), "html", null, true);
            echo " - Level ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "getLevel", [], "method", false, false, false, 354), "html", null, true);
            echo " - On ";
            echo twig_escape_filter($this->env, (($__internal_compile_5 = (($__internal_compile_6 = ($context["config"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["lua"] ?? null) : null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["serverName"] ?? null) : null), "html", null, true);
            echo "
                              <span style=\"position: relative; top: 3px; margin-left: 5px;\">
                                <span class=\"HelperDivIndicator\"
                                      onmouseover=\"ActivateHelperDiv(\$(this), 'BattlEye Protected Game World', '<p>This character lives on a game world which has been protected by BattleEye since April 19, 2018.</p>', '');\"
                                      onmouseout=\"\$('#HelperDivContainer').hide();\">
                                  <img style=\"border:0px;\"
                                       src=\"";
            // line 360
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/icon_battleye.gif\">
                                </span>
                              </span>
                              ";
            // line 363
            if ( !(null === twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 363))) {
                // line 364
                echo "                                <br>
                                <span>Guild Membership: ";
                // line 365
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 365), "html", null, true);
                echo " of the <a
                                    href=\"\">";
                // line 366
                echo twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "link", [], "any", false, false, false, 366);
                echo "</a></span>
                              ";
            }
            // line 368
            echo "                              </span>
                            </small>
                          </span>
                        </td>
                        <td>
                          <img id=\"DailyReawardState\"
                               src=\"";
            // line 374
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/icon-status-dailyreward-collected.png\"
                               alt=\"Daily Reward collected\" title=\"Daily Reward collected\">
                          ";
            // line 376
            if (twig_get_attribute($this->env, $this->source, $context["player"], "isOnline", [], "method", false, false, false, 376)) {
                // line 377
                echo "                            <img src=\"templates/tibiacom/images/on.gif\" title=\"Online\">
                          ";
            } else {
                // line 379
                echo "                            <img src=\"templates/tibiacom/images/off.gif\" title=\"Offline\">
                          ";
            }
            // line 381
            echo "                        </td>
                        <td align=\"center\">
                          <span id=\"CharacterOptionsOf_0\">
                            <span style=\"font-weight:normal;\">";
            // line 384
            if ( !twig_get_attribute($this->env, $this->source, $context["player"], "isDeleted", [], "method", false, false, false, 384)) {
                echo "[<a
                                href=\"";
                // line 385
                echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()(("account/character/comment/" . $this->env->getFilter('urlencode')->getCallable()(twig_get_attribute($this->env, $this->source, $context["player"], "getName", [], "any", false, false, false, 385)))), "html", null, true);
                echo "\">Edit</a>]";
            }
            echo "</span>
                            <br>
                            <span style=\"font-weight:normal;\">[<a href=\"";
            // line 387
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
        // line 392
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
              <div style=\"display: inline-flex; justify-content: center; margin: 2px 0 0 7px;\">
                <form action=\"";
        // line 410
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/create"), "html", null, true);
        echo "\" method=\"post\">
                  ";
        // line 411
        echo twig_include($this->env, $context, "buttons.create_character.html.twig");
        echo "
                </form>
                ";
        // line 413
        if ((twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_change_character_main", [], "any", false, false, false, 413) && (twig_length_filter($this->env, ($context["players"] ?? null)) >= 1))) {
            // line 414
            echo "                  <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/main"), "html", null, true);
            echo "\" method=\"post\" style=\"margin-left: 6px\">
                    ";
            // line 415
            echo twig_include($this->env, $context, "buttons.change_main.html.twig");
            echo "
                  </form>
                ";
        }
        // line 418
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_change_character_name", [], "any", false, false, false, 418)) {
            // line 419
            echo "                  <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/name"), "html", null, true);
            echo "\" method=\"post\" style=\"margin-left: 6px\">
                    ";
            // line 420
            echo twig_include($this->env, $context, "buttons.change_name.html.twig");
            echo "
                  </form>
                ";
        }
        // line 423
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_change_character_sex", [], "any", false, false, false, 423)) {
            // line 424
            echo "                  <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/character/sex"), "html", null, true);
            echo "\" method=\"post\" style=\"margin-left: 6px\">
                    ";
            // line 425
            echo twig_include($this->env, $context, "buttons.change_sex.html.twig");
            echo "
                  </form>
                ";
        }
        // line 428
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
        // line 442
        echo "
";
        // line 443
        if (($context["email_request"] ?? null)) {
            // line 444
            echo "  <div class=\"SmallBox\">
    <div class=\"MessageContainer\">
      <div class=\"BoxFrameHorizontal\"
           style=\"background-image:url(";
            // line 447
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-horizontal.gif);\"></div>
      <div class=\"BoxFrameEdgeLeftTop\"
           style=\"background-image:url(";
            // line 449
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"BoxFrameEdgeRightTop\"
           style=\"background-image:url(";
            // line 451
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"Message\">
        <div class=\"BoxFrameVerticalLeft\"
             style=\"background-image:url(";
            // line 454
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></div>
        <div class=\"BoxFrameVerticalRight\"
             style=\"background-image:url(";
            // line 456
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-vertical.gif);\"></div>
        <table>
          <tr>
            <td class=\"LabelV\">Note:</td>
            <td style=\"width:100%;\">A request has been submitted to change the email address of this account to
              <b>";
            // line 461
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
            // line 469
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/email"), "html", null, true);
            echo "\" method=\"post\">
              <tr>
                <td style=\"border:0px;\">
                  ";
            // line 472
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
            // line 480
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-horizontal.gif);\"></div>
      <div class=\"BoxFrameEdgeRightBottom\"
           style=\"background-image:url(";
            // line 482
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
      <div class=\"BoxFrameEdgeLeftBottom\"
           style=\"background-image:url(";
            // line 484
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/content/box-frame-edge.gif);\"></div>
    </div>
  </div>
  <br />
";
        }
        // line 489
        echo "<a name=\"General+Information\"></a>
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 493
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/back-to-top.gif\" />
    </a>
  </div>
</div>
<div class=\"TableContainer\">
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\"
              style=\"background-image:url(";
        // line 502
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
        // line 504
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
        // line 506
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
        // line 508
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">General Information</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
        // line 511
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
        // line 513
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
        // line 515
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
        // line 517
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
        // line 529
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 529), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">
                          Account ";
        // line 531
        if (twig_constant("USE_ACCOUNT_NAME")) {
            echo "Name";
        } else {
            echo "Number";
        }
        echo ":
                        </td>
                        <td style=\"width:90%;\">";
        // line 533
        echo twig_escape_filter($this->env, ($context["account"] ?? null), "html", null, true);
        echo "</td>
                      </tr>
                      <tr style=\"background-color: ";
        // line 535
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 535), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">Email Address:</td>
                        <td style=\"width:90%;\">";
        // line 537
        echo twig_escape_filter($this->env, (($context["account_email"] ?? null) . ($context["email_change"] ?? null)), "html", null, true);
        echo "</td>
                      </tr>
                      <tr style=\"background-color: ";
        // line 539
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 539), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">Created:</td>
                        <td>";
        // line 541
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["account_created"] ?? null), "M d Y, G:i:s"), "html", null, true);
        echo "</td>
                      </tr>
                      <tr style=\"background-color: ";
        // line 543
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 543), "html", null, true);
        echo ";\">
                        <td class=\"LabelV\">Last Login:</td>
                        <td>";
        // line 545
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["account_web_lastlogin"] ?? null), "M d Y, G:i:s"), "html", null, true);
        echo "</td>
                      </tr>
                      ";
        // line 548
        echo "                        <tr style=\"background-color: ";
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 548);
        echo ";\">
                          <td class=\"LabelV\">Account Status:</td>
                          <td>";
        // line 550
        echo ($context["account_status"] ?? null);
        echo "</td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 552
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 552);
        echo ";\">
                          <td class=\"LabelV\">Tibia Coins:</td>
                          <td>";
        // line 554
        echo ($context["account_coins"] ?? null);
        echo " <img src=\"";
        echo ($context["template_path"] ?? null);
        echo "/images/account/icon-tibiacoin.png\"
                                                       class=\"VSCCoinImages\" />
                            (Including: ";
        // line 556
        echo ($context["account_coins_transferable"] ?? null);
        echo " <img
                              src=\"";
        // line 557
        echo ($context["template_path"] ?? null);
        echo "/images/account/icon-tibiacointrusted.png\"
                              class=\"VSCCoinImages\">)
                          </td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 561
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lightborder", [], "any", false, false, false, 561);
        echo ";\">
                          <td class=\"LabelV\">Tournament Coins:</td>
                          <td>";
        // line 563
        echo ($context["tournament_coins"] ?? null);
        echo " <img
                              src=\"";
        // line 564
        echo ($context["template_path"] ?? null);
        echo "/images/account/icon-tournamentcoin.png\" class=\"VSCCoinImages\">
                          </td>
                        </tr>
                        <tr style=\"background-color: ";
        // line 567
        echo twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 567);
        echo ";\">
                          <td class=\"LabelV\">Registered:</td>
                          <td>";
        // line 569
        echo ($context["account_registered"] ?? null);
        echo "</td>
                        </tr>
                      ";
        // line 572
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
                      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                        <form action=\"";
        // line 583
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/password"), "html", null, true);
        echo "\" method=\"post\">
                          <tr>
                            <td style=\"border:0px;\">
                              ";
        // line 586
        echo twig_include($this->env, $context, "buttons.change_password.html.twig");
        echo "
                            </td>
                          </tr>
                        </form>
                      </table>
                    </td>
                    <td>
                      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                        <form action=\"";
        // line 594
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/email"), "html", null, true);
        echo "\" method=\"post\">
                          <tr>
                            <td style=\"border:0px;\">
                              <input type=\"hidden\" name=\"newemail\" value=\"\" />
                              <input type=\"hidden\" name=\"newemaildate\" value=\"0\">
                              ";
        // line 599
        echo twig_include($this->env, $context, "buttons.change_email.html.twig");
        echo "
                            </td>
                          </tr>
                        </form>
                      </table>
                    </td>
                    <td width=\"100%\"></td>
                    ";
        // line 607
        echo "                    ";
        if (twig_test_empty(($context["recovery_key"] ?? null))) {
            // line 608
            echo "                      <td>
                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                          <form action=\"";
            // line 610
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/register"), "html", null, true);
            echo "\" method=\"post\">
                            <tr>
                              <td style=\"border:0px;\">
                                ";
            // line 613
            echo twig_include($this->env, $context, "buttons.register_account.html.twig");
            echo "
                              </td>
                            </tr>
                          </form>
                        </table>
                      </td>
                    ";
        }
        // line 620
        echo "                  </tr>
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

<a name=\"Public+Information\"></a>
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 637
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
        // line 646
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
        // line 648
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
        // line 650
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
        // line 652
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Public Information</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
        // line 655
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
        // line 657
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
        // line 659
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
        // line 661
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
                      <tr>
                        <td>
                          <table style=\"width:100%;\">
                            <tr>
                              <td class=\"LabelV\">Real Name:</td>
                              <td style=\"width:90%;\">";
        // line 678
        echo twig_escape_filter($this->env, ($context["account_rlname"] ?? null), "html", null, true);
        echo "</td>
                            </tr>
                            <tr>
                              <td class=\"LabelV\">Address:</td>
                              <td style=\"width:90%;\">";
        // line 682
        echo twig_escape_filter($this->env, ($context["account_location"] ?? null), "html", null, true);
        echo "</td>
                            </tr>
                            <tr>
                              <td class=\"LabelV\">Phone:</td>
                              <td style=\"width:90%;\">";
        // line 686
        echo twig_escape_filter($this->env, ($context["account_phone"] ?? null), "html", null, true);
        echo "</td>
                            </tr>
                            ";
        // line 688
        if ((($context["account_show_rk"] ?? null) &&  !twig_test_empty(($context["recovery_key"] ?? null)))) {
            // line 689
            echo "                              <tr>
                                <td class=\"LabelV\">RK:</td>
                                <td style=\"width:90%;\">";
            // line 691
            echo twig_escape_filter($this->env, ($context["recovery_key"] ?? null), "html", null, true);
            echo "</td>
                              </tr>
                            ";
        }
        // line 694
        echo "                          </table>
                        </td>
                        ";
        // line 696
        if ( !($context["account_update_info_on_register"] ?? null)) {
            // line 697
            echo "                          <td align=right>
                            <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                              <form action=\"";
            // line 699
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/info"), "html", null, true);
            echo "\" method=\"post\">
                                <tr>
                                  <td style=\"border:0px;\">
                                    ";
            // line 702
            echo twig_include($this->env, $context, "buttons.edit.html.twig");
            echo "
                                  </td>
                                </tr>
                              </form>
                            </table>
                          </td>
                        ";
        }
        // line 709
        echo "                      </tr>
                    </table>
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
<br />

<a name=\"Account+Logs\"></a>
<div class=\"TopButtonContainer\">
  <div class=\"TopButton\">
    <a href=\"#top\">
      <img style=\"border:0px;\" src=\"";
        // line 727
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
        // line 736
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\"
              style=\"background-image:url(";
        // line 738
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\"
              style=\"background-image:url(";
        // line 740
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\"
              style=\"background-image:url(";
        // line 742
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Account logs</div>
        <span class=\"CaptionVerticalRight\"
              style=\"background-image:url(";
        // line 745
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\"
              style=\"background-image:url(";
        // line 747
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\"
              style=\"background-image:url(";
        // line 749
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\"
              style=\"background-image:url(";
        // line 751
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
        // line 769
        echo "                        ";
        $context["i"] = 0;
        // line 770
        echo "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
            // line 771
            echo "                          ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 772
            echo "                          <tr style=\"background-color: ";
            echo $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null));
            echo "\">
                            <td>";
            // line 773
            echo twig_get_attribute($this->env, $this->source, $context["action"], "action", [], "any", false, false, false, 773);
            echo "</td>
                            <td>";
            // line 774
            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["action"], "date", [], "any", false, false, false, 774), "d M Y, H:i:s");
            echo "</td>
                            <td title=\"";
            // line 775
            echo twig_get_attribute($this->env, $this->source, $context["action"], "ipv6", [], "any", false, false, false, 775);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["action"], "ip", [], "any", false, false, false, 775);
            echo "</td>
                          </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 778
        echo "                      ";
        // line 779
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
        return array (  1380 => 779,  1378 => 778,  1367 => 775,  1363 => 774,  1359 => 773,  1354 => 772,  1351 => 771,  1346 => 770,  1343 => 769,  1323 => 751,  1318 => 749,  1313 => 747,  1308 => 745,  1302 => 742,  1297 => 740,  1292 => 738,  1287 => 736,  1275 => 727,  1255 => 709,  1245 => 702,  1239 => 699,  1235 => 697,  1233 => 696,  1229 => 694,  1223 => 691,  1219 => 689,  1217 => 688,  1212 => 686,  1205 => 682,  1198 => 678,  1178 => 661,  1173 => 659,  1168 => 657,  1163 => 655,  1157 => 652,  1152 => 650,  1147 => 648,  1142 => 646,  1130 => 637,  1111 => 620,  1101 => 613,  1095 => 610,  1091 => 608,  1088 => 607,  1078 => 599,  1070 => 594,  1059 => 586,  1053 => 583,  1040 => 572,  1035 => 569,  1030 => 567,  1024 => 564,  1020 => 563,  1015 => 561,  1008 => 557,  1004 => 556,  997 => 554,  992 => 552,  987 => 550,  981 => 548,  976 => 545,  971 => 543,  966 => 541,  961 => 539,  956 => 537,  951 => 535,  946 => 533,  937 => 531,  932 => 529,  917 => 517,  912 => 515,  907 => 513,  902 => 511,  896 => 508,  891 => 506,  886 => 504,  881 => 502,  869 => 493,  863 => 489,  855 => 484,  850 => 482,  845 => 480,  834 => 472,  828 => 469,  815 => 461,  807 => 456,  802 => 454,  796 => 451,  791 => 449,  786 => 447,  781 => 444,  779 => 443,  776 => 442,  761 => 428,  755 => 425,  750 => 424,  747 => 423,  741 => 420,  736 => 419,  733 => 418,  727 => 415,  722 => 414,  720 => 413,  715 => 411,  711 => 410,  691 => 392,  680 => 387,  673 => 385,  669 => 384,  664 => 381,  660 => 379,  656 => 377,  654 => 376,  649 => 374,  641 => 368,  636 => 366,  632 => 365,  629 => 364,  627 => 363,  621 => 360,  608 => 354,  602 => 350,  595 => 347,  592 => 346,  588 => 344,  586 => 343,  582 => 342,  575 => 338,  570 => 337,  567 => 336,  562 => 335,  560 => 334,  516 => 293,  511 => 291,  506 => 289,  501 => 287,  495 => 284,  490 => 282,  485 => 280,  480 => 278,  469 => 270,  463 => 266,  455 => 261,  450 => 259,  445 => 257,  429 => 244,  424 => 242,  416 => 237,  411 => 235,  405 => 232,  400 => 230,  395 => 228,  390 => 225,  388 => 224,  365 => 204,  358 => 200,  334 => 179,  329 => 177,  324 => 175,  319 => 173,  313 => 170,  308 => 168,  303 => 166,  298 => 164,  269 => 138,  260 => 132,  251 => 126,  217 => 95,  213 => 94,  209 => 92,  201 => 87,  194 => 83,  190 => 81,  188 => 80,  181 => 77,  177 => 76,  174 => 75,  169 => 73,  164 => 69,  158 => 66,  155 => 65,  148 => 63,  144 => 62,  141 => 61,  139 => 60,  119 => 43,  114 => 41,  109 => 39,  104 => 37,  98 => 34,  93 => 32,  88 => 30,  83 => 28,  75 => 22,  67 => 17,  62 => 14,  60 => 13,  54 => 10,  49 => 8,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.management.html.twig", "/var/www/html/templates/tibiacom/account.management.html.twig");
    }
}
