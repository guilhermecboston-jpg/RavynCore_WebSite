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

/* hint.html.twig */
class __TwigTemplate_bab82880ac874d66e201da849d9bb0a6 extends \Twig\Template
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
        echo "To play on ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 1), "serverName", [], "any", false, false, false, 1), "html", null, true);
        echo " you need an account.
All you have to do to create your new account is to enter an account ";
        // line 2
        if (twig_constant("USE_ACCOUNT_NAME")) {
            echo "name";
        } else {
            echo "number";
        }
        echo ", password";
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "recaptcha_enabled", [], "any", false, false, false, 2)) {
            echo ", confirm reCAPTCHA";
        }
        if (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "account_country", [], "any", false, false, false, 2)) {
            echo ", country";
        }
        echo " and your email address.
Also you have to agree to the terms presented below. If you have done so, your account ";
        // line 3
        if (twig_constant("USE_ACCOUNT_NAME")) {
            echo "name";
        } else {
            echo "number";
        }
        echo " will be shown on the following page and your account password will be sent to your email address along with further instructions. If you do not receive the email with your password, please check your spam filter.<br/><br/>
";
    }

    public function getTemplateName()
    {
        return "hint.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "hint.html.twig", "/var/www/html/plugins/account-create-hint/hint.html.twig");
    }
}
