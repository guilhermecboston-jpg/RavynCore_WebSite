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

/* lastlogin.html.twig */
class __TwigTemplate_3e7812d8593d0e9ef93d250c2776c943 extends \Twig\Template
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
        if (twig_test_iterable(($context["players"] ?? null))) {
            // line 2
            echo "  <div class=\"col-4\">
    <div class=\"box\">
      <div class=\"box-header\">
        <h3 class=\"box-title\">Last 10 Logins</h3>
      </div>
      <div class=\"box-body no-padding\">
        <table class=\"table table-condensed\">
          <tbody>
          <tr>
            <th>#</th>
            <th>Player</th>
            <th>Login Date</th>
          </tr>
          ";
            // line 15
            $context["i"] = 0;
            // line 16
            echo "          ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["players"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
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
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["result"], "name", [], "any", false, false, false, 20), "html", null, true);
                echo "</td>
              <td>";
                // line 21
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["result"], "lastlogin", [], "any", false, false, false, 21), "M d Y, H:i:s"), "html", null, true);
                echo "</td>
            </tr>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['result'], $context['_parent'], $context['loop']);
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
        return "lastlogin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 24,  75 => 21,  71 => 20,  67 => 19,  64 => 18,  61 => 17,  56 => 16,  54 => 15,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "lastlogin.html.twig", "/var/www/html/admin/pages/modules/templates/lastlogin.html.twig");
    }
}
