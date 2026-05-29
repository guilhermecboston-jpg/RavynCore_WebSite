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

/* gallery.get.html.twig */
class __TwigTemplate_f74b8c4e30989fbf65a28d2d6271f749 extends \Twig\Template
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
        echo "<div style=\"position: relative; height: 15px; width: 100%;\">
\t";
        // line 2
        if ( !(null === ($context["next"] ?? null))) {
            // line 3
            echo "\t<a style=\"float: right;\" href=\"";
            echo twig_escape_filter($this->env, (($this->env->getFunction('getLink')->getCallable()("gallery") . "/") . ($context["next"] ?? null)), "html", null, true);
            echo "\" >next <img src=\"images/arrow_right.gif\" width=15 height=11 border=0 ></a>
\t";
        }
        // line 5
        echo "\t";
        if ( !(null === ($context["previous"] ?? null))) {
            // line 6
            echo "\t<a style=\"position: absolute;\" href=\"";
            echo twig_escape_filter($this->env, (($this->env->getFunction('getLink')->getCallable()("gallery") . "/") . ($context["previous"] ?? null)), "html", null, true);
            echo "\"><img src=\"images/arrow_left.gif\" width=15 height=11 border=0 > previous</a>
\t";
        }
        // line 8
        echo "\t<div style=\"position: absolute; width: 80%; margin-left: 10%; margin-right: 10%; text-align: center;\">
\t\t<a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("gallery"), "html", null, true);
        echo "\" ><img src=\"images/arrow_up.gif\" width=11 height=15 border=0 > back</a>
\t</div>
</div>
<div style=\"position: relative; text-align: center; top: 20px; \">
\t<img src=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["image"] ?? null), "image", [], "any", false, false, false, 13), "html", null, true);
        echo "\" />
\t<div style=\"margin-top: 15px; margin-bottom: 35px; \">";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["image"] ?? null), "comment", [], "any", false, false, false, 14), "html", null, true);
        echo "</div>
</div>";
    }

    public function getTemplateName()
    {
        return "gallery.get.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 14,  67 => 13,  60 => 9,  57 => 8,  51 => 6,  48 => 5,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gallery.get.html.twig", "/var/www/html/system/templates/gallery.get.html.twig");
    }
}
