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

/* admin.statistics.html.twig */
class __TwigTemplate_d7a6b7112034eaf560dbedad7c676112 extends \Twig\Template
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
        echo "<style>
  a:link {
    color: #ffffff;
  }

  a:visited {
    color: #ffffff;
  }

  a:hover {
    color: #ffffff;
  }

  a:active {
    color: #ffffff;
  }
</style>
<div class=\"row\">
  <div class=\"col-md-3 col-sm-6 col-xs-12\">
    <div class=\"info-box\">
      <span class=\"info-box-icon bg-aqua\"><i class=\"fa-solid fa-users\"></i></span>
      <div class=\"info-box-content\">
        <span class=\"info-box-text\">Total accounts:</span>
        <span class=\"info-box-number\">";
        // line 24
        echo twig_escape_filter($this->env, ($context["total_accounts"] ?? null), "html", null, true);
        echo "</span>
      </div>
    </div>
  </div>
  <div class=\"col-md-3 col-sm-6 col-xs-12\">
    <div class=\"info-box\">
      <span class=\"info-box-icon bg-red\"><i class=\"fa-solid fa-user\"></i></span>
      <div class=\"info-box-content\">
        <span class=\"info-box-text\">Total players:</span>
        <span class=\"info-box-number\">";
        // line 33
        echo twig_escape_filter($this->env, ($context["total_players"] ?? null), "html", null, true);
        echo "</span>
      </div>
    </div>
  </div>
  <div class=\"col-md-3 col-sm-6 col-xs-12\">
    <div class=\"info-box\">
      <span class=\"info-box-icon bg-green\"><i class=\"fa-solid fa-user-shield\"></i></span>
      <div class=\"info-box-content\">
        <span class=\"info-box-text\">Total guilds:</span>
        <span class=\"info-box-number\">";
        // line 42
        echo twig_escape_filter($this->env, ($context["total_guilds"] ?? null), "html", null, true);
        echo "</span>
      </div>
    </div>
  </div>
  <div class=\"col-md-3 col-sm-6 col-xs-12\">
    <div class=\"info-box\">
      <span class=\"info-box-icon bg-yellow\"><i class=\"fa-solid fa-house-user\"></i></span>
      <div class=\"info-box-content\">
        <span class=\"info-box-text\">Total houses:</span>
        <span class=\"info-box-number\">";
        // line 51
        echo twig_escape_filter($this->env, ($context["total_houses"] ?? null), "html", null, true);
        echo "</span>
      </div>
    </div>
  </div>
  ";
        // line 55
        if ( !(null === ($context["total_donates"] ?? null))) {
            // line 56
            echo "    <div class=\"col-md-3 col-sm-6 col-xs-12\">
      <a href=\"?p=pag_transactions\">
        <div class=\"info-box\">
          <span class=\"info-box-icon bg-green-gradient\"><i class=\"fa-solid fa-money-bill\"></i></span>
          <div class=\"info-box-content\">
            <span class=\"info-box-text\">Total donates:</span>
            <span class=\"info-box-number\">";
            // line 62
            echo twig_escape_filter($this->env, ($context["total_donates"] ?? null), "html", null, true);
            echo "</span>
          </div>
        </div>
      </a>
    </div>
  ";
        }
        // line 68
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "admin.statistics.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 68,  115 => 62,  107 => 56,  105 => 55,  98 => 51,  86 => 42,  74 => 33,  62 => 24,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin.statistics.html.twig", "/var/www/html/system/templates/admin.statistics.html.twig");
    }
}
