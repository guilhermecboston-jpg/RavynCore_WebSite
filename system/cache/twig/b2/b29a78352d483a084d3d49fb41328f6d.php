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

/* coins.html.twig */
class __TwigTemplate_d811632ef25507b9d51a0a8caf320c25 extends \Twig\Template
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
        if (twig_test_iterable(($context["result"] ?? null))) {
            // line 2
            echo "  <div class=\"col-4\">
    <div class=\"box\">
      <div class=\"box-header\">
        <h3 class=\"box-title\">Top 10 - Most coins</h3>
      </div>
      <div class=\"box-body no-padding\">
        <table class=\"table table-condensed\">
          <tbody>
          <tr>
            <th>#</th>
            <th>Account ";
            // line 12
            echo twig_escape_filter($this->env, ($context["account_type"] ?? null), "html", null, true);
            echo "</th>
            <th>Coins</th>
          </tr>
          ";
            // line 15
            $context["i"] = 0;
            // line 16
            echo "          ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["result"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 17
                echo "            ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 18
                echo "            <tr>
              <td>";
                // line 19
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "</td>
              <td>";
                // line 20
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 20), "html", null, true);
                echo "</td>
              <td>";
                // line 21
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 21), "html", null, true);
                echo "</td>
            </tr>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "          </tbody>
        </table>
      </div>
    </div>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "coins.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 24,  78 => 21,  74 => 20,  70 => 19,  67 => 18,  64 => 17,  59 => 16,  57 => 15,  51 => 12,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "coins.html.twig", "/var/www/html/admin/pages/modules/templates/coins.html.twig");
    }
}
