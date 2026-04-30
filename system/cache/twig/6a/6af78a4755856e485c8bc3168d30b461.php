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

/* donate.html.twig */
class __TwigTemplate_9d89200dd2863b4481dd50fed56aa295 extends \Twig\Template
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
        echo "<table width=\"100%\" border=\"0\" cellpadding=\"4\" cellspacing=\"1\">
  <tbody>
  <tr>
    <td colspan=\"3\" bgcolor=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "vdarkborder", [], "any", false, false, false, 4), "html", null, true);
        echo "\" class=\"white\"><span
        class=\"style4\">Donate to receive your reward!</span></td>
  </tr>
  <tr bgcolor=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "vdarkborder", [], "any", false, false, false, 7), "html", null, true);
        echo "\">
    <td class=\"white\" width=\"35%\"><b>Donation</b></td>
    <td class=\"white\"><b>Reward</b></td>
  </tr>
  ";
        // line 11
        $context["i"] = 1;
        // line 12
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "pagSeguro", [], "any", false, false, false, 12), "donates", [], "any", false, false, false, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "    <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
            echo "\">
      <td>R\$";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "value", [], "any", false, false, false, 14), "html", null, true);
            echo "</td>
      <td><img alt src=\"images/content/bullet.gif\">
        ";
            // line 16
            if ((($context["is_double"] ?? null) && (twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 16) >= ($context["double_start"] ?? null)))) {
                echo " <span
          style=\"text-decoration: line-through;\">";
                // line 17
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 17), "html", null, true);
                echo "</span> ";
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 17) > 0)) {
                    echo "(+";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 17), "html", null, true);
                    echo " bonus)";
                }
                // line 18
                echo "          <strong>";
                echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 18) * 2), "html", null, true);
                echo "</strong>
        ";
            } else {
                // line 19
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 19), "html", null, true);
                echo " ";
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 19) > 0)) {
                    echo "(+";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 19), "html", null, true);
                    echo " bonus)";
                }
                echo " ";
            }
            // line 20
            echo "        Coins ";
            if ((($context["is_double"] ?? null) && (twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 20) >= ($context["double_start"] ?? null)))) {
                // line 21
                echo "          <strong>(double)</strong> ";
            }
            echo " ";
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 21) == "500")) {
                echo " (+1 Mega Roulette Coin) ";
            } elseif ((twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 21) == "1000")) {
                echo " (+3 Mega Roulette Coins) ";
            }
            // line 22
            echo "      </td>
    </tr>
    ";
            // line 24
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 25
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "  </tbody>
</table>
<br/>
<form target=\"pagseguro\" method=\"post\" action=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getFunction('getLink')->getCallable()("pagsegurodonate"), "html", null, true);
        echo "\">
  <input type=\"hidden\" name=\"reference\" value=\"";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["account_logged"] ?? null), "getId", [], "method", false, false, false, 30), "html", null, true);
        echo "\">
  <table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\">
    <tbody>
    <tr bgcolor=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "vdarkborder", [], "any", false, false, false, 33), "html", null, true);
        echo "\" class=\"white\">
      <th colspan=\"2\"><strong>Choose the number of coins you want to donate</strong></th>
    </tr>
    <tr bgcolor=\"";
        // line 36
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 36), "html", null, true);
        echo "\">
      <td width=\"15%\">Account Name</td>
      <td><strong>";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["account_logged"] ?? null), "getName", [], "method", false, false, false, 38), "html", null, true);
        echo "</strong></td>
    </tr>
    <tr bgcolor=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 40), "html", null, true);
        echo "\">
      <td width=\"15%\">Coins</td>
      <td>
        <select name=\"code\" required style=\"width: 250px\">
          ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "pagSeguro", [], "any", false, false, false, 44), "donates", [], "any", false, false, false, 44));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 45
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 45), "html", null, true);
            echo "\">R\$";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "value", [], "any", false, false, false, 45), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 45), "html", null, true);
            echo "
              Coins";
            // line 46
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 46) > 0)) {
                echo " +";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 46), "html", null, true);
                echo " bonus";
            }
            echo ")";
            if ((($context["is_double"] ?? null) && (twig_get_attribute($this->env, $this->source, $context["item"], "coins", [], "any", false, false, false, 46) >= ($context["double_start"] ?? null)))) {
                echo "(double)";
            }
            echo "</option>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "        </select>
      </td>
    </tr>
    <tr bgcolor=\"";
        // line 51
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 51), "html", null, true);
        echo "\">
      <td colspan=\"2\">
        <input type=\"image\" src=\"https://p.simg.uol.com.br/out/pagseguro/i/botoes/carrinhoproprio/btnFinalizar.jpg\"
               name=\"submit\" ";
        // line 54
        if ((($context["is_localhost"] ?? null) &&  !twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "enablePagseguroLocal", [], "any", false, false, false, 54))) {
            echo "disabled";
        }
        echo "/>
      </td>
    </tr>
    </tbody>
  </table>
</form>
<b><span style=\"color:#ff0000;\">OBS:</span></b> Coins are delivered <b>automatically</b> after
<u>approved</u> of your payment by PagSeguro.
";
    }

    public function getTemplateName()
    {
        return "donate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 54,  197 => 51,  192 => 48,  176 => 46,  167 => 45,  163 => 44,  156 => 40,  151 => 38,  146 => 36,  140 => 33,  134 => 30,  130 => 29,  125 => 26,  119 => 25,  117 => 24,  113 => 22,  104 => 21,  101 => 20,  90 => 19,  84 => 18,  76 => 17,  72 => 16,  67 => 14,  62 => 13,  57 => 12,  55 => 11,  48 => 7,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "donate.html.twig", "/var/www/html/system/templates/donate.html.twig");
    }
}
