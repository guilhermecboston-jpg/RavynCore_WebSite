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

/* news.back_button.html.twig */
class __TwigTemplate_7ccca4f2f4ff61ac2835030e82eb1c36 extends \Twig\Template
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
  <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
    <form method=\"post\" action=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("news/archive"), "html", null, true);
        echo "\">
      <tbody>
      <tr>
        <td>
          ";
        // line 7
        $context["button_name"] = "Back";
        // line 8
        echo "          ";
        echo twig_include($this->env, $context, "buttons.base.html.twig");
        echo "
        </td>
      </tr>
      </tbody>
    </form>
  </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "news.back_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 8,  48 => 7,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "news.back_button.html.twig", "/var/www/html/system/templates/news.back_button.html.twig");
    }
}
