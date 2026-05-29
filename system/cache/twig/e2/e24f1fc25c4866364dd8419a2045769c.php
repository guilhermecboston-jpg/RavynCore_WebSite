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

/* gallery.html.twig */
class __TwigTemplate_c37ad3298dd8c0a1e40fa07db55bf5e9 extends \Twig\Template
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
        echo "<div class=\"SmallBox\">
\t<div class=\"MessageContainer\">
\t\t<div class=\"BoxFrameHorizontal\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-horizontal.gif);\"></div>
\t\t<div class=\"BoxFrameEdgeLeftTop\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></div>
\t\t<div class=\"BoxFrameEdgeRightTop\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></div>
\t\t<div class=\"Message\">
\t\t\t<div class=\"BoxFrameVerticalLeft\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-vertical.gif);\"></div>
\t\t\t<div class=\"BoxFrameVerticalRight\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-vertical.gif);\"></div>
\t\t\t<table style=\"width:100%;\">
\t\t\t\t<tbody>
\t\t\t\t<tr><td style=\"width:100%;text-align:center;\"><nobr>Click on the image to enlarge.</nobr></td></tr>
\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t\t<div class=\"BoxFrameHorizontal\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-horizontal.gif);\"></div>
\t\t<div class=\"BoxFrameEdgeRightBottom\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></div>
\t\t<div class=\"BoxFrameEdgeLeftBottom\" style=\"background-image:url(templates/tibiacom/images/global/content/box-frame-edge.gif);\"></div>
\t</div>
</div>
<br>
<div style=\"display: flex;\">
\t<div style=\"box-shadow: 3px 3px 2px #875f3e; border: 1px solid #5f4d41;\">
\t\t";
        // line 23
        $context["i"] = 0;
        // line 24
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["images"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 25
            echo "\t\t\t";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 26
            echo "\t\t\t<table>
\t\t\t\t<tr>
\t\t\t\t\t<td style=\"height: 120px;\" >
\t\t\t\t\t\t<a href=\"";
            // line 29
            echo twig_escape_filter($this->env, (($this->env->getFunction('getLink')->getCallable()("gallery") . "/") . twig_get_attribute($this->env, $this->source, $context["image"], "id", [], "any", false, false, false, 29)), "html", null, true);
            echo "\" >
\t\t\t\t\t\t\t<img src=\"";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "thumb", [], "any", false, false, false, 30), "html", null, true);
            echo "\" border=\"0\" />
\t\t\t\t\t\t</a>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr style=\"text-align: center;\">
\t\t\t\t\t<td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "comment", [], "any", false, false, false, 35), "html", null, true);
            echo "</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t";
            // line 38
            if (($context["canEdit"] ?? null)) {
                // line 39
                echo "\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"?subtopic=gallery&action=edit&id=";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "id", [], "any", false, false, false, 40), "html", null, true);
                echo "\" title=\"Edit\">
\t\t\t\t\t\t\t\t<img src=\"images/edit.png\"/>Edit
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<a id=\"delete\" href=\"?subtopic=gallery&action=delete&id=";
                // line 43
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "id", [], "any", false, false, false, 43), "html", null, true);
                echo "\" onclick=\"return confirm('Are you sure?');\" title=\"Delete\">
\t\t\t\t\t\t\t\t<img src=\"images/del.png\"/>Delete
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<a href=\"?subtopic=gallery&action=hide&id=";
                // line 46
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "id", [], "any", false, false, false, 46), "html", null, true);
                echo "\" title=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["image"], "hidden", [], "any", false, false, false, 46) != 1)) {
                    echo "Hide";
                } else {
                    echo "Show";
                }
                echo "\">
\t\t\t\t\t\t\t\t<img src=\"images/";
                // line 47
                if ((twig_get_attribute($this->env, $this->source, $context["image"], "hidden", [], "any", false, false, false, 47) != 1)) {
                    echo "success";
                } else {
                    echo "error";
                }
                echo ".png\"/>";
                if ((twig_get_attribute($this->env, $this->source, $context["image"], "hidden", [], "any", false, false, false, 47) != 1)) {
                    echo "Hide";
                } else {
                    echo "Show";
                }
                // line 48
                echo "\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                // line 49
                if ((($context["i"] ?? null) != 1)) {
                    // line 50
                    echo "\t\t\t\t\t\t\t\t<a href=\"?subtopic=gallery&action=moveup&id=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "id", [], "any", false, false, false, 50), "html", null, true);
                    echo "\" title=\"Move up\">
\t\t\t\t\t\t\t\t\t<img src=\"images/icons/arrow_up.gif\"/>Move up
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                }
                // line 54
                echo "\t\t\t\t\t\t\t";
                if ((($context["i"] ?? null) != ($context["last"] ?? null))) {
                    // line 55
                    echo "\t\t\t\t\t\t\t\t<a href=\"?subtopic=gallery&action=movedown&id=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "id", [], "any", false, false, false, 55), "html", null, true);
                    echo "\" title=\"Move down\">
\t\t\t\t\t\t\t\t\t<img src=\"images/icons/arrow_down.gif\"/>Move down
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                }
                // line 59
                echo "\t\t\t\t\t\t</td>
\t\t\t\t\t";
            }
            // line 61
            echo "\t\t\t\t</tr>
\t\t\t</table>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "gallery.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 64,  161 => 61,  157 => 59,  149 => 55,  146 => 54,  138 => 50,  136 => 49,  133 => 48,  121 => 47,  111 => 46,  105 => 43,  99 => 40,  96 => 39,  94 => 38,  88 => 35,  80 => 30,  76 => 29,  71 => 26,  68 => 25,  63 => 24,  61 => 23,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gallery.html.twig", "/var/www/html/system/templates/gallery.html.twig");
    }
}
