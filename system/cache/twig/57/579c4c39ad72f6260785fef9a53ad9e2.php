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

/* install.welcome.html.twig */
class __TwigTemplate_dc941789a19f4ac6fea19b0a39862bc1 extends \Twig\Template
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
        echo "install/\" method=\"post\">
\t<input type=\"hidden\" name=\"step\" id=\"step\" value=\"license\" />
\t<div class=\"input\"><p>";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["locale"] ?? null), "step_welcome_desc", [], "any", false, false, false, 3), "html", null, true);
        echo "</p>
\t\t<select name=\"lang\" class=\"form-select\">
\t\t\t";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["locales"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["locale_"]) {
            // line 6
            echo "\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["locale_"], "id", [], "any", false, false, false, 6), "html", null, true);
            echo "\"";
            if ((( !(null === ($context["detected_locale"] ?? null)) && (twig_get_attribute($this->env, $this->source, $context["locale_"], "id", [], "any", false, false, false, 6) == ($context["detected_locale"] ?? null))) || (($context["cookie_locale"] ?? null) == twig_get_attribute($this->env, $this->source, $context["locale_"], "id", [], "any", false, false, false, 6)))) {
                echo " selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["locale_"], "name", [], "any", false, false, false, 6), "html", null, true);
            echo "</option>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['locale_'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "\t\t</select>
\t</div>

\t";
        // line 11
        echo ($context["buttons"] ?? null);
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "install.welcome.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 11,  67 => 8,  52 => 6,  48 => 5,  43 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "install.welcome.html.twig", "/var/www/html/system/templates/install.welcome.html.twig");
    }
}
