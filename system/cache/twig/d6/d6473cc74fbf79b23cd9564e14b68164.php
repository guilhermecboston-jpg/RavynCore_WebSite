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

/* news.tickers.html.twig */
class __TwigTemplate_16f045614195c44a04c4db032fa633ff extends \Twig\Template
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
        echo "<div id=\"newsticker\" class=\"Box\">
\t<div class=\"Corner-tl\" style=\"background-image: url(";
        // line 2
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/corner-tl.gif);\"></div>
\t<div class=\"Corner-tr\" style=\"background-image: url(";
        // line 3
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/corner-tr.gif);\"></div>
\t<div class=\"Border_1\" style=\"background-image: url(";
        // line 4
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/border-1.gif);\"></div>
\t<div class=\"BorderTitleText\" style=\"background-image: url(";
        // line 5
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/title-background-green.gif);\"></div>
\t<img class=\"Title\" src=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/header/headline-newsticker.gif\" alt=\"Contentbox headline\">
\t<div class=\"Border_2\">
\t\t<div class=\"Border_3\">
\t\t\t<div class=\"BoxContent\" style=\"background-image: url(";
        // line 9
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/scroll.gif);\">
\t\t\t\t";
        // line 10
        if ( !array_key_exists("i", $context)) {
            // line 11
            echo "\t\t\t\t";
            $context["i"] = 0;
            // line 12
            echo "\t\t\t\t";
        }
        // line 13
        echo "\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tickers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["ticker"]) {
            // line 14
            echo "\t\t\t\t<div id=\"TickerEntry-";
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "\" class=\"Row\" onclick='TickerAction(\"TickerEntry-";
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "\")'>
\t\t\t\t\t<div class=\"";
            // line 15
            if (preg_match("/^\\d+\$/", (($context["i"] ?? null) / 2))) {
                echo "Odd";
            } else {
                echo "Even";
            }
            echo "\">
\t\t\t\t\t<div class=\"NewsTickerIcon\" style=\"background-image: url(";
            // line 16
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/news/icon_";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticker"], "icon", [], "any", false, false, false, 16), "html", null, true);
            echo "_small.gif);\"></div>
\t\t\t\t\t<div id=\"TickerEntry-";
            // line 17
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "-Button\" class=\"NewsTickerExtend\" style=\"background-image: url(";
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/general/plus.gif);\"></div>
\t\t\t\t\t<div class=\"NewsTickerText\">
\t\t\t\t\t\t<span class=\"NewsTickerDate\">";
            // line 19
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticker"], "date", [], "any", false, false, false, 19), "j M Y"), "html", null, true);
            echo " -</span>
\t\t\t\t\t\t<div id=\"TickerEntry-";
            // line 20
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "-ShortText\" class=\"NewsTickerShortText\">";
            echo twig_get_attribute($this->env, $this->source, $context["ticker"], "body_short", [], "any", false, false, false, 20);
            echo "</div>
\t\t\t\t\t\t<div id=\"TickerEntry-";
            // line 21
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo "-FullText\" class=\"NewsTickerFullText\">";
            echo twig_get_attribute($this->env, $this->source, $context["ticker"], "body", [], "any", false, false, false, 21);
            echo "
\t\t\t\t\t\t\t";
            // line 22
            if (($context["canEdit"] ?? null)) {
                // line 23
                echo "\t\t\t\t\t\t\t<a href=\"admin/?p=news&action=edit&id=";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticker"], "id", [], "any", false, false, false, 23), "html", null, true);
                echo "\" title=\"Edit\">
\t\t\t\t\t\t\t\t<img src=\"images/edit.png\"/>
\t\t\t\t\t\t\t\tEdit
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<a id=\"delete\" href=\"admin/?p=news&action=delete&id=";
                // line 27
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticker"], "id", [], "any", false, false, false, 27), "html", null, true);
                echo "\" onclick=\"return confirm('Are you sure?');\" title=\"Delete\">
\t\t\t\t\t\t\t\t<img src=\"images/del.png\"/>
\t\t\t\t\t\t\t\tDelete
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<a href=\"admin/?p=news&action=hide&id=";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ticker"], "id", [], "any", false, false, false, 31), "html", null, true);
                echo "\" title=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["ticker"], "hidden", [], "any", false, false, false, 31) != 1)) {
                    echo "Hide";
                } else {
                    echo "Show";
                }
                echo "\">
\t\t\t\t\t\t\t\t<img src=\"images/";
                // line 32
                if ((twig_get_attribute($this->env, $this->source, $context["ticker"], "hidden", [], "any", false, false, false, 32) != 1)) {
                    echo "success";
                } else {
                    echo "error";
                }
                echo ".png\"/>
\t\t\t\t\t\t\t\t";
                // line 33
                if ((twig_get_attribute($this->env, $this->source, $context["ticker"], "hidden", [], "any", false, false, false, 33) != 1)) {
                    echo "Hide";
                } else {
                    echo "Show";
                }
                // line 34
                echo "\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
            }
            // line 36
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
            // line 40
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 41
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ticker'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "\t\t\t</div>
\t</div>
</div>
<div class=\"Border_1\" style=\"background-image: url(";
        // line 45
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/border-1.gif);\"></div>
<div class=\"CornerWrapper-b\"><div class=\"Corner-bl\" style=\"background-image: url(";
        // line 46
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/corner-bl.gif);\"></div></div>
<div class=\"CornerWrapper-b\"><div class=\"Corner-br\" style=\"background-image: url(";
        // line 47
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/content/corner-br.gif);\"></div></div>
</div>";
    }

    public function getTemplateName()
    {
        return "news.tickers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 47,  191 => 46,  187 => 45,  182 => 42,  176 => 41,  174 => 40,  168 => 36,  164 => 34,  158 => 33,  150 => 32,  140 => 31,  133 => 27,  125 => 23,  123 => 22,  117 => 21,  111 => 20,  107 => 19,  100 => 17,  94 => 16,  86 => 15,  79 => 14,  74 => 13,  71 => 12,  68 => 11,  66 => 10,  62 => 9,  56 => 6,  52 => 5,  48 => 4,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "news.tickers.html.twig", "/var/www/html/templates/tibiacom/news.tickers.html.twig");
    }
}
