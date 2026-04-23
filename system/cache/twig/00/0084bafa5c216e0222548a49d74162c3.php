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

/* buttons.register_account.html.twig */
class __TwigTemplate_0d5e5d6cc3f422179d23349c3df00a1c extends \Twig\Template
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
        $context["button_name"] = "Register Account";
        // line 2
        $context["button_image"] = "_sbutton_registeraccount";
        // line 3
        $this->loadTemplate("buttons.base.html.twig", "buttons.register_account.html.twig", 3)->display($context);
    }

    public function getTemplateName()
    {
        return "buttons.register_account.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "buttons.register_account.html.twig", "/var/www/html/templates/tibiacom/buttons.register_account.html.twig");
    }
}
