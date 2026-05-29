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

/* online.form.html.twig */
class __TwigTemplate_161825124032c76ece0934b7deb722e9 extends \Twig\Template
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
        echo "<div class=\"TableContainer\">
\t<div class=\"CaptionContainer\">
\t\t<div class=\"CaptionInnerContainer\">
\t\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(templates/tibiacom/images/global/content/table-headline-border.gif);\"></span>
\t\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t<div class=\"Text\">Search Character</div>
\t\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(templates/tibiacom/images/global/content/table-headline-border.gif);\"></span>
\t\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
\t\t</div></div>
\t<table class=\"Table1\" cellpadding=\"0\" cellspacing=\"0\">
\t\t<tbody><tr>
\t\t\t<td>
\t\t\t\t<div class=\"InnerTableContainer\">
\t\t\t\t\t<table style=\"width: 100%\">
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<form action=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("characters"), "html", null, true);
        echo "\" method=post>
\t\t\t\t\t\t\t\t\t<td style=\"vertical-align:middle;\" class=\"LabelV150\">Character Name:</td>
\t\t\t\t\t\t\t\t\t<td style=\"width: 80%\"><input name=\"name\" style=\"width: 100%\" size=29 maxlength=29></td>
\t\t\t\t\t\t\t\t\t<td>";
        // line 24
        $context["button_name"] = "Submit";
        // line 25
        echo "\t\t\t\t\t\t\t\t\t";
        $this->loadTemplate("buttons.base.html.twig", "online.form.html.twig", 25)->display($context);
        echo "</td>
\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</td>
\t\t</tr></tbody>
\t</table>
</div>
";
    }

    public function getTemplateName()
    {
        return "online.form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 25,  65 => 24,  59 => 21,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "online.form.html.twig", "/var/www/html/system/templates/online.form.html.twig");
    }
}
