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

/* account.back_button.html.twig */
class __TwigTemplate_f48b3a4e13dbb7556940a175ea14c0d6 extends \Twig\Template
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
        if ((array_key_exists("new_line", $context) && ($context["new_line"] ?? null))) {
            // line 2
            echo "  <br/>
";
        }
        // line 4
        echo "<form action=\"";
        if ( !array_key_exists("action", $context)) {
            echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("account/manage"), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, ($context["action"] ?? null), "html", null, true);
        }
        echo "\"
      method=\"post\">
  ";
        // line 6
        echo twig_include($this->env, $context, "buttons.back.html.twig");
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "account.back_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 6,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.back_button.html.twig", "/var/www/html/system/templates/account.back_button.html.twig");
    }
}
