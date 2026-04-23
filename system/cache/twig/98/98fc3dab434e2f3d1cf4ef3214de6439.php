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

/* install.admin.html.twig */
class __TwigTemplate_a5b2acb8ced12d36a24ce0a50195e0ad extends \Twig\Template
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
        echo "<style>
\ttr, td {
\t\tborder-bottom: 1px solid #ddd;
\t\tpadding: 15px;
\t}
</style>
<form action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("BASE_URL"), "html", null, true);
        echo "install/\" method=\"post\" autocomplete=\"off\">
\t<input type=\"hidden\" name=\"step\" id=\"step\" value=\"finish\" />
\t<table>
\t\t";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "email", 1 => ($context["account"] ?? null), 2 => "password", 3 => "player_name"]);
        foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
            // line 11
            echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t<label for=\"vars_";
            // line 13
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\">
\t\t\t\t\t<span class=\"fw-bold\">";
            // line 14
            echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["locale"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[("step_admin_" . $context["value"])] ?? null) : null), "html", null, true);
            echo "</span>
\t\t\t\t</label>
\t\t\t\t<br/>
\t\t\t\t<input class=\"form-control\" type=\"text\" name=\"vars[";
            // line 17
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "]\" id=\"vars_";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\"";
            if ( !(null === (($__internal_compile_1 = ($context["session"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[("var_" . $context["value"])] ?? null) : null))) {
                echo " value=\"";
                echo twig_escape_filter($this->env, (($__internal_compile_2 = ($context["session"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[("var_" . $context["value"])] ?? null) : null), "html", null, true);
                echo "\"";
            }
            echo "/>
\t\t\t\t<label class=\"small\">";
            // line 18
            echo (($__internal_compile_3 = ($context["locale"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[(("step_admin_" . $context["value"]) . "_desc")] ?? null) : null);
            echo "</label>
\t\t\t</td>
\t\t</tr>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "\t</table>

\t";
        // line 24
        if (array_key_exists("errors", $context)) {
            // line 25
            echo "\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 26
                echo "\t\t\t<p class=\"error\">";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</p>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
            echo "\t";
        }
        // line 29
        echo "\t";
        echo ($context["buttons"] ?? null);
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "install.admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 29,  111 => 28,  102 => 26,  97 => 25,  95 => 24,  91 => 22,  81 => 18,  69 => 17,  63 => 14,  59 => 13,  55 => 11,  51 => 10,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "install.admin.html.twig", "/var/www/html/system/templates/install.admin.html.twig");
    }
}
