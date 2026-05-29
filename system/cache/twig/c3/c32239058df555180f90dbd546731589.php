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

/* content.html */
class __TwigTemplate_892612e33d77d17cb0e79d11ded46e3f extends \Twig\Template
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
        echo "<p>&nbsp;</p>
<p>&nbsp;</p>
<div style=\"text-align: center;\">We're using official Tibia Client <strong>";
        // line 3
        echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "client", [], "any", false, false, false, 3) / 100), "html", null, true);
        echo "</strong><br />
<p>Download Tibia Client <strong>";
        // line 4
        echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "client", [], "any", false, false, false, 4) / 100), "html", null, true);
        echo "</strong>&nbsp;for Windows <a href=\"https://drive.google.com/drive/folders/0B2-sMQkWYzhGSFhGVlY2WGk5czQ\" target=\"_blank\" rel=\"noopener\">HERE</a>.</p>
<h2>IP Changer:</h2>
<a href=\"https://static.otland.net/ipchanger.exe\" target=\"_blank\" rel=\"noopener\">HERE</a></div>";
    }

    public function getTemplateName()
    {
        return "content.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "content.html", "");
    }
}
