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

/* install.config.html.twig */
class __TwigTemplate_cfa0152a2e72925db22462fa91622000 extends \Twig\Template
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
        echo "<form action=\"";
        echo twig_escape_filter($this->env, twig_constant("BASE_URL"), "html", null, true);
        echo "install/\" method=\"post\" autocomplete=\"off\">
  <input type=\"hidden\" name=\"step\" id=\"step\" value=\"database\"/>
  <table>
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "server_path", 1 => "mail_admin", 2 => "mail_address"]);
        foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
            // line 5
            echo "      <tr>
        <td class=\"pb-3\">
          <label for=\"vars_";
            // line 7
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\">
            <span class=\"fw-bold\">";
            // line 8
            echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["locale"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[("step_config_" . $context["value"])] ?? null) : null), "html", null, true);
            echo "</span>
          </label>
          <br>
          <input type=\"text\" class=\"form-control\" name=\"vars[";
            // line 11
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "]\"
                 id=\"vars_";
            // line 12
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\"";
            if ( !(null === (($__internal_compile_1 = ($context["session"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[("var_" . $context["value"])] ?? null) : null))) {
                echo " value=\"";
                echo twig_escape_filter($this->env, (($__internal_compile_2 = ($context["session"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[("var_" . $context["value"])] ?? null) : null), "html", null, true);
                echo "\"";
            }
            echo "/>
          <label class=\"small\">";
            // line 13
            echo twig_escape_filter($this->env, (($__internal_compile_3 = ($context["locale"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[(("step_config_" . $context["value"]) . "_desc")] ?? null) : null), "html", null, true);
            echo "</label>
        </td>
      </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "    <tr>
      <td class=\"pb-3\">
        <label for=\"vars_date_timezone\">
          <span class=\"fw-bold\">";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["locale"] ?? null), "step_config_timezone", [], "any", false, false, false, 20), "html", null, true);
        echo "</span>
        </label>
        <br/>
        <select class=\"form-select select_timezone\" name=\"vars[date_timezone]\" id=\"vars_date_timezone\">
          ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["timezones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["timezone"]) {
            // line 25
            echo "            <option
              value=\"";
            // line 26
            echo twig_escape_filter($this->env, $context["timezone"], "html", null, true);
            echo "\"";
            if ((( !(null === (($__internal_compile_4 = ($context["session"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["var_date_timezone"] ?? null) : null)) && ((($__internal_compile_5 = ($context["session"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["var_date_timezone"] ?? null) : null) == $context["timezone"])) || ((null === (($__internal_compile_6 = ($context["session"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["var_date_timezone"] ?? null) : null)) && ($context["timezone"] == "America/Sao_Paulo")))) {
                echo " selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["timezone"], "html", null, true);
            echo "</option>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['timezone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "        </select>
        <label class=\"small\">";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["locale"] ?? null), "step_config_timezone_desc", [], "any", false, false, false, 29), "html", null, true);
        echo "</label>
      </td>
    </tr>
    <tr>
      <td class=\"pb-3\">
        <label for=\"vars_client\">
          <span class=\"fw-bold\">";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["locale"] ?? null), "step_config_client", [], "any", false, false, false, 35), "html", null, true);
        echo "</span>
        </label>
        <br/>
        <select class=\"form-select\" name=\"vars[client]\" id=\"vars_client\">
          ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["clients"] ?? null));
        foreach ($context['_seq'] as $context["id"] => $context["version"]) {
            // line 40
            echo "            <option
              value=\"";
            // line 41
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\"";
            if ((( !(null === (($__internal_compile_7 = ($context["session"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["var_client"] ?? null) : null)) && ((($__internal_compile_8 = ($context["session"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["var_client"] ?? null) : null) == $context["id"])) || ((null === (($__internal_compile_9 = ($context["session"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["var_client"] ?? null) : null)) && ($context["id"] == "13.16")))) {
                echo " selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["version"], "html", null, true);
            echo "</option>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['version'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "        </select>
        <label class=\"small\">";
        // line 44
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["locale"] ?? null), "step_config_client_desc", [], "any", false, false, false, 44), "html", null, true);
        echo "</label>
      </td>
    </tr>
  </table>

  ";
        // line 49
        if (array_key_exists("errors", $context)) {
            // line 50
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 51
                echo "      <p class=\"error\">";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</p>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            echo "  ";
        }
        // line 54
        echo "  ";
        echo ($context["buttons"] ?? null);
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "install.config.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 54,  186 => 53,  177 => 51,  172 => 50,  170 => 49,  162 => 44,  159 => 43,  145 => 41,  142 => 40,  138 => 39,  131 => 35,  122 => 29,  119 => 28,  105 => 26,  102 => 25,  98 => 24,  91 => 20,  86 => 17,  76 => 13,  66 => 12,  62 => 11,  56 => 8,  52 => 7,  48 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "install.config.html.twig", "/var/www/html/system/templates/install.config.html.twig");
    }
}
