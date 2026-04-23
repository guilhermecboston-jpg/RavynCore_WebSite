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

/* buttons.base.html.twig */
class __TwigTemplate_c958c7782a64e8fe0a38a73b33ce2bb2 extends \Twig\Template
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
        ob_start(function () { return ''; });
        // line 2
        echo "  <div class=\"BigButton\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/buttons/sbutton.gif)\">
    <div onmouseover=\"MouseOverBigButton(this);\" onmouseout=\"MouseOutBigButton(this);\">
      <div class=\"BigButtonOver\"
           style=\"background-image: url(";
        // line 5
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/buttons/sbutton_over.gif); visibility: hidden;\"></div>
      <input class=\"BigButtonText\" type=\"submit\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["button_name"] ?? null), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, ($context["button_name"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["button_title"] ?? null), "html", null, true);
        echo "\">
    </div>
  </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "buttons.base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 6,  46 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "buttons.base.html.twig", "/var/www/html/templates/tibiacom/buttons.base.html.twig");
    }
}
