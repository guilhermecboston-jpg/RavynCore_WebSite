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

/* account.create.html.twig */
class __TwigTemplate_b68af5f282bcfdfb30117142d42f68f2 extends \Twig\Template
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
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BEFORE_FORM"), "html", null, true);
        echo "
<form action=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/create"), "html", null, true);
        echo "\" method=\"post\" id=\"createaccount\">
\t<div class=\"TableContainer\" >
\t\t<table class=\"Table5\" cellpadding=\"0\" cellspacing=\"0\" >
\t\t\t<div class=\"CaptionContainer\" >
\t\t\t\t<div class=\"CaptionInnerContainer\" >
\t\t\t\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
        // line 7
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\" /></span>
\t\t\t\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
        // line 8
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\" /></span>
\t\t\t\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
        // line 9
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\" ></span>
\t\t\t\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
        // line 10
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\" /></span>
\t\t\t\t\t<div class=\"Text\" >Create ";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 11), "serverName", [], "any", false, false, false, 11), "html", null, true);
        echo " Account</div>
\t\t\t\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
        // line 12
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-vertical.gif);\" /></span>
\t\t\t\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
        // line 13
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/table-headline-border.gif);\" ></span>
\t\t\t\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
        // line 14
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\" /></span>
\t\t\t\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
        // line 15
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/box-frame-edge.gif);\" /></span>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"InnerTableContainer\" >
\t\t\t\t\t\t<table style=\"width:100%;\" >
\t\t\t\t\t\t\t";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BEFORE_BOXES"), "html", null, true);
        echo "
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableShadowContainerRightTop\"> <div class=\"TableShadowRightTop\" style=\"background-image:url(";
        // line 25
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-rt.gif);\"></div></div>
\t\t\t\t\t\t\t\t\t<div class=\"TableContentAndRightShadow\" style=\"background-image:url(";
        // line 26
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-rm.gif);\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>

\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BEFORE_ACCOUNT"), "html", null, true);
        echo "

\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 33
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_login_by_email", [], "any", false, false, false, 33)) {
            // line 34
            echo "\t\t\t\t\t\t\t\t\t\t\t\t<tr class=\"rc-hidden-account-row\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<td colspan=\"2\" style=\"display:none !important; border:0 !important; padding:0 !important;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"account\" id=\"account_input\" value=\"";
            // line 36
            echo twig_escape_filter($this->env, ((array_key_exists("account", $context)) ? (_twig_default_filter(($context["account"] ?? null), "")) : ("")), "html", null, true);
            echo "\" maxlength=\"";
            if (twig_constant("USE_ACCOUNT_NAME")) {
                echo "30";
            } else {
                echo "10";
            }
            echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img id=\"account_indicator\" src=\"images/global/general/";
            // line 37
            if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "account", [], "any", true, true, false, 37))) {
                echo "n";
            }
            echo "ok.gif\" style=\"display: none;\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"SuggestAccountNumber\" style=\"display:none !important;\">[<a href=\"#\">suggest number</a>]</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 42
        echo "\t\t\t\t\t\t\t\t\t\t\t\t<tr class=\"rc-hidden-account-row\"><td colspan=\"2\" style=\"display:none !important;\"><span id=\"account_error\" class=\"FormFieldError\">";
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "account", [], "any", true, true, false, 42)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "account", [], "any", false, false, false, 42), "html", null, true);
        }
        echo "</span></td></tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_ACCOUNT"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
        // line 46
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", true, true, false, 46)) {
            echo " class=\"red\"";
        }
        echo ">Email Address: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"email\" id=\"email\" size=\"30\" maxlength=\"50\" value=\"";
        // line 49
        echo twig_escape_filter($this->env, ($context["email"] ?? null), "html", null, true);
        echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img id=\"email_indicator\" src=\"images/global/general/";
        // line 50
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", true, true, false, 50))) {
            echo "n";
        }
        echo "ok.gif\" style=\"display: none;\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td></td><td><span id=\"email_error\" class=\"FormFieldError\">";
        // line 54
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", true, true, false, 54)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", false, false, false, 54), "html", null, true);
        }
        echo "</span></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 57
        if ((twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "mail_enabled", [], "any", false, false, false, 57) && twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_mail_verify", [], "any", false, false, false, 57))) {
            // line 58
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr><td></td><td><span><strong>Please use real address!<br/>We will send a link to validate your Email.</strong></span></td></tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 60
        echo "
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_EMAIL"), "html", null, true);
        echo "

                                                ";
        // line 63
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_country", [], "any", false, false, false, 63)) {
            // line 64
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
            // line 66
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "country", [], "any", false, true, false, 66), 0, [], "array", true, true, false, 66)) {
                echo " class=\"red\"";
            }
            echo ">Country: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"country\" id=\"account_country\">
                                                                ";
            // line 70
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
            foreach ($context['_seq'] as $context["code"] => $context["country_"]) {
                // line 71
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $context["code"], "html", null, true);
                echo "\"";
                if (((array_key_exists("country", $context) && (($context["country"] ?? null) == $context["code"])) || ((null === ($context["country"] ?? null)) && (($context["country_recognized"] ?? null) == $context["code"])))) {
                    echo "selected";
                }
                echo ">";
                echo twig_escape_filter($this->env, $context["country_"], "html", null, true);
                echo "</option>
                                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['code'], $context['country_'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img src=\"\" id=\"account_country_img\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
                                                    ";
            // line 77
            if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "country", [], "any", true, true, false, 77)) {
                // line 78
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr><td></td><td><span class=\"FormFieldError\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "country", [], "any", false, false, false, 78), "html", null, true);
                echo "</span></td></tr>
                                                    ";
            }
            // line 80
            echo "                                                ";
        }
        // line 81
        echo "
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_COUNTRY"), "html", null, true);
        echo "

\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
        // line 86
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 86)) {
            echo " class=\"red\"";
        }
        echo ">Password: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"rc-password-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password\" id=\"password\" value=\"\" size=\"30\" maxlength=\"29\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"rc-btn rc-btn-subtle rc-password-toggle\" data-target=\"password\">Show</button>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img id=\"password_indicator\" src=\"images/global/general/";
        // line 92
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 92))) {
            echo "n";
        }
        echo "ok.gif\" style=\"display: none;\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr><td></td><td><span id=\"password_error\" class=\"FormFieldError\">";
        // line 96
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 96)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", false, false, false, 96), "html", null, true);
        }
        echo "</span></td></tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
        // line 99
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 99)) {
            echo " class=\"red\"";
        }
        echo ">Repeat password: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"rc-password-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password2\" id=\"password2\" value=\"\" size=\"30\" maxlength=\"29\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"rc-btn rc-btn-subtle rc-password-toggle\" data-target=\"password2\">Show</button>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img id=\"password2_indicator\" src=\"images/global/general/";
        // line 105
        if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 105))) {
            echo "n";
        }
        echo "ok.gif\" style=\"display: none;\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr><td></td><td><span id=\"password2_error\" class=\"FormFieldError\">";
        // line 109
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 109)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", false, false, false, 109), "html", null, true);
        }
        echo "</span></td></tr>

\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 111
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_PASSWORDS"), "html", null, true);
        echo "

                                                ";
        // line 113
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "recaptcha_enabled", [], "any", false, false, false, 113)) {
            // line 114
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
            // line 116
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "verification", [], "any", false, true, false, 116), 0, [], "array", true, true, false, 116)) {
                echo " class=\"red\"";
            }
            echo ">Verification:</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"g-recaptcha\" data-sitekey=\"";
            // line 119
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "recaptcha_site_key", [], "any", false, false, false, 119), "html", null, true);
            echo "\" data-theme=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "recaptcha_theme", [], "any", false, false, false, 119), "html", null, true);
            echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
                                                    ";
            // line 122
            if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "verification", [], "any", true, true, false, 122)) {
                // line 123
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr><td></td><td><span class=\"FormFieldError\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "verification", [], "any", false, false, false, 123), "html", null, true);
                echo "</span></td></tr>
                                                    ";
            }
            // line 125
            echo "                                                ";
        }
        // line 126
        echo "
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 127
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_RECAPTCHA"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"TableShadowContainer\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableBottomShadow\" style=\"background-image:url(";
        // line 133
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-bm.gif);\"> <div class=\"TableBottomLeftShadow\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-bl.gif);\"></div> <div class=\"TableBottomRightShadow\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-br.gif);\"></div> </div></div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BETWEEN_BOXES_1"), "html", null, true);
        echo "

\t\t\t\t\t\t\t";
        // line 139
        if ((( !twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "mail_enabled", [], "any", false, false, false, 139) ||  !twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_mail_verify", [], "any", false, false, false, 139)) && twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_create_character_create", [], "any", false, false, false, 139))) {
            // line 140
            echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableShadowContainerRightTop\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableShadowRightTop\" style=\"background-image:url(";
            // line 143
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-shadow-rt.gif);\"></div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"TableContentAndRightShadow\" style=\"background-image:url(";
            // line 145
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-shadow-rm.gif);\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>

\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 150
            echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BEFORE_CHARACTER_NAME"), "html", null, true);
            echo "

\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
            // line 154
            if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 154)) {
                echo " class=\"red\"";
            }
            echo ">Character Name: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input id=\"character_name\" class=\"rc-charname-input\" name=\"name\" size=\"";
            // line 157
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_name_max_length", [], "any", false, false, false, 157), "html", null, true);
            echo "\" maxlength=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_name_max_length", [], "any", false, false, false, 157), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" onkeyup=\"checkName();\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img id=\"character_indicator\" src=\"images/global/general/";
            // line 158
            if (( !($context["save"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 158))) {
                echo "n";
            }
            echo "ok.gif\" style=\"display: none;\" />\t\t\t\t\t\t\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"SuggestCharacterName\">[<a href=\"#\">suggest name</a>]</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span id=\"character_error\" class=\"FormFieldError\">";
            // line 165
            if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 165)) {
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", false, false, false, 165), "html", null, true);
            }
            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 169
            echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_CHARACTER_NAME"), "html", null, true);
            echo "

\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
            // line 173
            if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "sex", [], "any", true, true, false, 173)) {
                echo " class=\"red\"";
            }
            echo ">Sex: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<table width=\"100%\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
                                                                    ";
            // line 180
            $context["i"] = 0;
            // line 181
            echo "                                                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "genders", [], "any", false, false, false, 181), true));
            foreach ($context['_seq'] as $context["id"] => $context["gender"]) {
                // line 182
                echo "                                                                        ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 183
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"margin-right:15px;\" class=\"OptionContainer\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"sex\" id=\"sex";
                // line 184
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["id"], "html", null, true);
                echo "\"";
                if (( !(null === ($context["sex"] ?? null)) && (($context["sex"] ?? null) == $context["id"]))) {
                    echo " checked=\"checked\"";
                }
                echo ">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"sex";
                // line 185
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_lower_filter($this->env, $context["gender"]), "html", null, true);
                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>
                                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['id'], $context['gender'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 188
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span id=\"sex_error\" class=\"FormFieldError\">";
            // line 199
            if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "sex", [], "any", true, true, false, 199)) {
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "sex", [], "any", false, false, false, 199), "html", null, true);
            }
            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 203
            echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_SEX"), "html", null, true);
            echo "

                                                ";
            // line 205
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 205)) > 1)) {
                // line 206
                echo "\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
                // line 208
                if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "vocation", [], "any", true, true, false, 208)) {
                    echo " class=\"red\"";
                }
                echo ">Vocation: <span style=\"color: red;\">*</span></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<table width=\"100%\" >
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
                                                           \t\t";
                // line 215
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_samples", [], "any", false, false, false, 215));
                foreach ($context['_seq'] as $context["key"] => $context["sample_char"]) {
                    // line 216
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"margin-right:15px;\" class=\"OptionContainer\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"vocation\" id=\"vocation";
                    // line 217
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\" value=\"";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\"
                                                                                ";
                    // line 218
                    if (( !(null === ($context["vocation"] ?? null)) && (($context["vocation"] ?? null) == $context["key"]))) {
                        echo " checked=\"checked\"";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"vocation";
                    // line 219
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (($__internal_compile_0 = (($__internal_compile_1 = ($context["config"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["vocations"] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[$context["key"]] ?? null) : null), "html", null, true);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>
                                                            \t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['sample_char'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 222
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td></td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span id=\"vocation_error\" class=\"FormFieldError\">";
                // line 231
                if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "vocation", [], "any", true, true, false, 231)) {
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "vocation", [], "any", false, false, false, 231), "html", null, true);
                }
                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 235
            echo "
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 236
            echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_VOCATION"), "html", null, true);
            echo "

                                                ";
            // line 238
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 238)) > 1)) {
                // line 239
                echo "\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td class=\"LabelV\" style=\"width: 150px\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span";
                // line 241
                if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "town", [], "any", true, true, false, 241)) {
                    echo " class=\"red\"";
                }
                echo ">Select your town:</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<table width=\"100%\" >
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 248
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "character_towns", [], "any", false, false, false, 248));
                foreach ($context['_seq'] as $context["_key"] => $context["town_id"]) {
                    // line 249
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"margin-right:15px;\" class=\"OptionContainer\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"town\" id=\"town";
                    // line 250
                    echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                    echo "\" value=\"";
                    echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 251
                    if (( !(null === ($context["town"] ?? null)) && (($context["town"] ?? null) == $context["town_id"]))) {
                        echo " checked=\"checked\"";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"town";
                    // line 252
                    echo twig_escape_filter($this->env, $context["town_id"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "towns", [], "any", false, false, false, 252)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[$context["town_id"]] ?? null) : null), "html", null, true);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['town_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 255
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
                                                ";
            }
            // line 262
            echo "
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 263
            echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_TOWNS"), "html", null, true);
            echo "

\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"TableShadowContainer\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableBottomShadow\" style=\"background-image:url(";
            // line 270
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-shadow-bm.gif);\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"TableBottomLeftShadow\" style=\"background-image:url(";
            // line 271
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-shadow-bl.gif);\"></div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"TableBottomRightShadow\" style=\"background-image:url(";
            // line 272
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/content/table-shadow-br.gif);\"></div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
        }
        // line 278
        echo "
\t\t\t\t\t\t\t";
        // line 279
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BETWEEN_BOXES_2"), "html", null, true);
        echo "

\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"TableShadowContainerRightTop\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableShadowRightTop\" style=\"background-image:url(";
        // line 284
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-rt.gif);\"></div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"TableContentAndRightShadow\" style=\"background-image:url(";
        // line 286
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-rm.gif);\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableContentContainer\">
\t\t\t\t\t\t\t\t\t\t\t<table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
\t\t\t\t\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td colspan=\"2\" ><b>Please select the following check box:</b></td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td colspan=\"2\" >
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span><input type=\"checkbox\" id=\"accept_rules\" name=\"accept_rules\" value=\"true\"";
        // line 295
        if (($context["accept_rules"] ?? null)) {
            echo "checked";
        }
        echo "/> <label for=\"accept_rules\">I agree to the <a href=\"?subtopic=rules\" target=\"_blank\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 295), "serverName", [], "any", false, false, false, 295), "html", null, true);
        echo " Rules</a>. <span style=\"color: red;\">*</span></label></span>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>
                                                ";
        // line 298
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "accept_rules", [], "any", true, true, false, 298)) {
            // line 299
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td colspan=\"2\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"FormFieldError\">";
            // line 301
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "accept_rules", [], "any", false, false, false, 301), "html", null, true);
            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>
                                                ";
        }
        // line 305
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"TableShadowContainer\">
\t\t\t\t\t\t\t\t\t\t<div class=\"TableBottomShadow\" style=\"background-image:url(";
        // line 310
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-bm.gif);\"> <div class=\"TableBottomLeftShadow\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-bl.gif);\"></div> <div class=\"TableBottomRightShadow\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-shadow-br.gif);\"></div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>

\t\t\t\t\t\t\t";
        // line 316
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_BOXES"), "html", null, true);
        echo "

\t\t\t\t\t\t</table>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t</table>
\t</div>
\t<br/>
\t";
        // line 325
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_BEFORE_SUBMIT_BUTTON"), "html", null, true);
        echo "
\t<table width=\"100%\">
\t\t<tr align=\"center\">
\t\t\t<td>
\t\t\t\t<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td style=\"border:0px;\" >
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"save\" value=\"1\" >
\t\t\t\t\t\t\t";
        // line 333
        echo twig_include($this->env, $context, "buttons.submit.html.twig");
        echo "
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t</td>
\t\t</tr>
\t</table>
</form>
";
        // line 341
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, "HOOK_ACCOUNT_CREATE_AFTER_FORM"), "html", null, true);
        echo "
<script type=\"text/javascript\" src=\"tools/check_name.js\"></script>
<style>
\t#SuggestAccountNumber {
\t\tfont-size: 7pt;
\t}
\t#SuggestCharacterName {
\t\tfont-size: 7pt;
\t}
</style>
";
    }

    public function getTemplateName()
    {
        return "account.create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  790 => 341,  779 => 333,  768 => 325,  756 => 316,  743 => 310,  736 => 305,  729 => 301,  725 => 299,  723 => 298,  713 => 295,  701 => 286,  696 => 284,  688 => 279,  685 => 278,  676 => 272,  672 => 271,  668 => 270,  658 => 263,  655 => 262,  646 => 255,  635 => 252,  629 => 251,  623 => 250,  620 => 249,  616 => 248,  604 => 241,  600 => 239,  598 => 238,  593 => 236,  590 => 235,  581 => 231,  570 => 222,  559 => 219,  553 => 218,  547 => 217,  544 => 216,  540 => 215,  528 => 208,  524 => 206,  522 => 205,  517 => 203,  508 => 199,  495 => 188,  484 => 185,  474 => 184,  471 => 183,  468 => 182,  463 => 181,  461 => 180,  449 => 173,  442 => 169,  433 => 165,  421 => 158,  413 => 157,  405 => 154,  398 => 150,  390 => 145,  385 => 143,  380 => 140,  378 => 139,  373 => 137,  362 => 133,  353 => 127,  350 => 126,  347 => 125,  341 => 123,  339 => 122,  331 => 119,  323 => 116,  319 => 114,  317 => 113,  312 => 111,  305 => 109,  296 => 105,  285 => 99,  277 => 96,  268 => 92,  257 => 86,  250 => 82,  247 => 81,  244 => 80,  238 => 78,  236 => 77,  230 => 73,  215 => 71,  211 => 70,  202 => 66,  198 => 64,  196 => 63,  191 => 61,  188 => 60,  184 => 58,  182 => 57,  174 => 54,  165 => 50,  161 => 49,  153 => 46,  147 => 43,  140 => 42,  130 => 37,  120 => 36,  116 => 34,  114 => 33,  109 => 31,  101 => 26,  97 => 25,  91 => 22,  81 => 15,  77 => 14,  73 => 13,  69 => 12,  65 => 11,  61 => 10,  57 => 9,  53 => 8,  49 => 7,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.create.html.twig", "/var/www/html/system/templates/account.create.html.twig");
    }
}
