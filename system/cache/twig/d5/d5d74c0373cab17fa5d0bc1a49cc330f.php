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

/* buttons.create_character.html.twig */
class __TwigTemplate_daaf2402e976ed3aefbc646884a4c1fd extends \Twig\Template
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
        $context["button_name"] = "Create Character";
        // line 2
        $context["button_image"] = "_sbutton_createcharacter";
        // line 3
        $this->loadTemplate("buttons.base.html.twig", "buttons.create_character.html.twig", 3)->display($context);
    }

    public function getTemplateName()
    {
        return "buttons.create_character.html.twig";
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
        return new Source("", "buttons.create_character.html.twig", "/var/www/html/templates/tibiacom/buttons.create_character.html.twig");
    }
}
