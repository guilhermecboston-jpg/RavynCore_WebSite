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

/* buttons.change_password.html.twig */
class __TwigTemplate_37c81c635560dc903d8ab23aca616321 extends \Twig\Template
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
        $context["button_name"] = "Change Password";
        // line 2
        $context["button_image"] = "_sbutton_changepassword";
        // line 3
        $this->loadTemplate("buttons.base.html.twig", "buttons.change_password.html.twig", 3)->display($context);
    }

    public function getTemplateName()
    {
        return "buttons.change_password.html.twig";
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
        return new Source("", "buttons.change_password.html.twig", "/var/www/html/templates/tibiacom/buttons.change_password.html.twig");
    }
}
