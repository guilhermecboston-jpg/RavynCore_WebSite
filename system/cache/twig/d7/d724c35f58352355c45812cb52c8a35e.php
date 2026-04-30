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

/* admin.pages.links.html.twig */
class __TwigTemplate_13d7d6049653449481952429cfefdc8d extends \Twig\Template
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
        echo "<div style=\"text-align: right;\">
\t<a href=\"admin/?p=pages&action=edit&id=";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "id", [], "any", false, false, false, 2), "html", null, true);
        echo "\" title=\"Edit in Admin Panel\" target=\"_blank\">
\t\t<img src=\"images/edit.png\"/>Edit
\t</a>
\t<a id=\"delete\" href=\"admin/?p=pages&action=delete&id=";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "id", [], "any", false, false, false, 5), "html", null, true);
        echo "\" onclick=\"return confirm('Are you sure?');\"
\t   title=\"Delete in Admin Panel\" target=\"_blank\">
\t\t<img src=\"images/del.png\"/>Delete
\t</a>
\t<a href=\"admin/?p=pages&action=hide&id=";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "id", [], "any", false, false, false, 9), "html", null, true);
        echo "\"
\t   title=\"";
        // line 10
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "hidden", [], "any", false, false, false, 10) != 1)) {
            echo "Hide";
        } else {
            echo "Show";
        }
        echo " in Admin Panel\" target=\"_blank\">
\t\t<img src=\"images/";
        // line 11
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "hidden", [], "any", false, false, false, 11) != 1)) {
            echo "success";
        } else {
            echo "error";
        }
        echo ".png\"/>";
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "hidden", [], "any", false, false, false, 11) != 1)) {
            echo "Hide";
        } else {
            echo "Show";
        }
        // line 12
        echo "\t</a>
\t<br/>
</div>";
    }

    public function getTemplateName()
    {
        return "admin.pages.links.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 12,  65 => 11,  57 => 10,  53 => 9,  46 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin.pages.links.html.twig", "/var/www/html/system/templates/admin.pages.links.html.twig");
    }
}
