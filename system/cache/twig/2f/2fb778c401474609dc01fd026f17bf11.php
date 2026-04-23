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

/* install.installer.html.twig */
class __TwigTemplate_9c5ba6f9c9ba8e2256e7a18cbd0158b2 extends \Twig\Template
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
        echo "<div id=\"success-1\"></div>
<div id=\"spinner\">
  <img src=\"";
        // line 3
        echo twig_escape_filter($this->env, twig_constant("BASE_URL"), "html", null, true);
        echo "images/loading_spinner.gif\" height=\"32\" width=\"32\"/>
  ";
        // line 4
        echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
        echo "
</div>
<script type=\"text/javascript\" src=\"";
        // line 6
        echo twig_escape_filter($this->env, twig_constant("BASE_URL"), "html", null, true);
        echo "install/tools/installer.js\"></script>
<script type=\"text/javascript\">
  \$(function () {
    performInstall('";
        // line 9
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "');
  });
</script>
";
    }

    public function getTemplateName()
    {
        return "install.installer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 9,  50 => 6,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "install.installer.html.twig", "/var/www/html/system/templates/install.installer.html.twig");
    }
}
