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

/* forum.add_board.html.twig */
class __TwigTemplate_ca7fccc9a8f5e2434139428ec873aaa9 extends \Twig\Template
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
        echo "<div style=\"width: 135px;\"><a data-bs-toggle=\"collapse\" href=\"#forumcreate\" role=\"button\" aria-expanded=\"false\" aria-controls=\"forumcreate\"><div class=\"BigButton\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/buttons/sbutton.gif)\"><div onmouseover=\"MouseOverBigButton(this);\" onmouseout=\"MouseOutBigButton(this);\"><div class=\"BigButtonOver\" style=\"background-image: url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/buttons/sbutton_over.gif); visibility: hidden;\"></div><input class=\"BigButtonText\" type=\"button\" value=\"Create Board\"></div></div></a></div>

<div class=\"collapse\" id=\"forumcreate\">
  
<form method=\"post\" action=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["link"] ?? null), "html", null, true);
        echo "\">
\t";
        // line 6
        if ((($context["action"] ?? null) == "edit_board")) {
            // line 7
            echo "\t<input type=\"hidden\" name=\"id\" value=\"";
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\" />
\t";
        }
        // line 9
        echo "\t<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
\t\t<tr>
\t\t\t<td bgcolor=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "vdarkborder", [], "any", false, false, false, 11), "html", null, true);
        echo "\" class=\"white\"><b>";
        if ((($context["action"] ?? null) == "edit")) {
            echo "Edit";
        } else {
            echo "Add";
        }
        echo " board</b></td>
\t\t</tr>
\t\t<tr>
\t\t\t<td bgcolor=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 14), "html", null, true);
        echo "\">
\t\t\t\t<table border=\"0\" cellpadding=\"1\" style=\"width: 100%;\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"LabelH\">Name:</td>
\t\t\t\t\t\t<td><input name=\"name\" value=\"";
        // line 18
        if ( !(null === ($context["name"] ?? null))) {
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        }
        echo "\" size=\"29\" maxlength=\"29\"/></td>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"LabelH\">Description:</td>
\t\t\t\t\t\t<td><textarea name=\"description\" maxlength=\"300\" cols=\"50\" rows=\"5\">";
        // line 21
        if ( !(null === ($context["description"] ?? null))) {
            echo twig_escape_filter($this->env, ($context["description"] ?? null), "html", null, true);
        }
        echo "</textarea></td>
\t\t\t\t\t<tr/>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"LabelH\">Access:</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<select name=\"access\">
\t\t\t\t\t\t\t\t";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["id"] => $context["group"]) {
            // line 28
            echo "\t\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "getId", [], "method", false, false, false, 28), "html", null, true);
            echo "\"";
            if ((($context["access"] ?? null) == twig_get_attribute($this->env, $this->source, $context["group"], "getId", [], "method", false, false, false, 28))) {
                echo " selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["group"], "getName", [], "method", false, false, false, 28), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"LabelH\">Guild:</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<select name=\"guild\">
\t\t\t\t\t\t\t\t<option value=\"0\"";
        // line 37
        if ((($context["guild"] ?? null) == 0)) {
            echo " selected";
        }
        echo ">----</option>
\t\t\t\t\t\t\t\t";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["guilds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["guild_"]) {
            // line 39
            echo "\t\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["guild_"], "id", [], "any", false, false, false, 39), "html", null, true);
            echo "\"";
            if ((($context["guild"] ?? null) == twig_get_attribute($this->env, $this->source, $context["guild_"], "id", [], "any", false, false, false, 39))) {
                echo " selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["guild_"], "name", [], "any", false, false, false, 39), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guild_'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td colspan=\"2\" align=\"center\">
\t\t\t\t\t\t<div class=\"BigButton\" style=\"background-image:url(templates/tibiacom/images/global/buttons/sbutton.gif)\"><div onmouseover=\"MouseOverBigButton(this);\" onmouseout=\"MouseOutBigButton(this);\"><div class=\"BigButtonOver\" style=\"background-image: url(&quot;templates/tibiacom/images/global/buttons/sbutton_over.gif&quot;); visibility: hidden;\"></div><input class=\"BigButtonText\" type=\"submit\" value=\"Submit\"></div></div>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t</td>
\t\t</tr>
\t</table>
</form>
</div>

";
    }

    public function getTemplateName()
    {
        return "forum.add_board.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 41,  139 => 39,  135 => 38,  129 => 37,  120 => 30,  105 => 28,  101 => 27,  90 => 21,  82 => 18,  75 => 14,  63 => 11,  59 => 9,  53 => 7,  51 => 6,  47 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "forum.add_board.html.twig", "/var/www/html/system/templates/forum.add_board.html.twig");
    }
}
