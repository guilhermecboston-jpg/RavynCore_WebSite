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

/* most_donates.html.twig */
class __TwigTemplate_a857a62952729b1959d6c5aae592be1a extends \Twig\Template
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
            echo "  <div class=\"col-8\">
    <div class=\"box\">
      <div class=\"box-header\">
        <h3 class=\"box-title\">Top 10 - Most donates</h3>
      </div>
      <div class=\"box-body no-padding\">
        <table class=\"table table-condensed\">
          <tbody>
          <tr>
            <th style=\"width: 40px\">#</th>
            <th style=\"width: 100px;\">Account ";
            // line 12
            echo twig_escape_filter($this->env, ($context["account_type"] ?? null), "html", null, true);
            echo "</th>
            <th style=\"width: 100px;\">E-mail</th>
            <th>Characters</th>
            <th style=\"width: 100px;\">Total</th>
          </tr>
          ";
            // line 17
            $context["i"] = 0;
            // line 18
            echo "          ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["result"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 19
                echo "            ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 20
                echo "            <tr>
              <td>";
                // line 21
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "</td>
              <td>";
                // line 22
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 22), "html", null, true);
                echo "</td>
              <td>";
                // line 23
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "email", [], "any", false, false, false, 23), "html", null, true);
                echo "</td>
              <td>";
                // line 24
                echo twig_get_attribute($this->env, $this->source, $context["item"], "players", [], "any", false, false, false, 24);
                echo "</td>
              <td>";
                // line 25
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "value", [], "any", false, false, false, 25), "html", null, true);
                echo "</td>
            </tr>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
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
        return "most_donates.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 28,  88 => 25,  84 => 24,  80 => 23,  76 => 22,  72 => 21,  69 => 20,  66 => 19,  61 => 18,  59 => 17,  51 => 12,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "most_donates.html.twig", "/var/www/html/admin/pages/modules/templates/most_donates.html.twig");
    }
}
