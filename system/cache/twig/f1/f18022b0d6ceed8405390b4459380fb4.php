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

/* admin.dashboard.html.twig */
class __TwigTemplate_976dabae01cc94d0b5e105a5aa634070 extends \Twig\Template
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
        echo "<div class=\"row\">
  <div class=\"col-md-10 col-12\">
    <div class=\"box box-warning\">
      <div class=\"box-header with-border\">
        <h3 class=\"box-title\">Maintenance</h3>
        <div class=\"box-tools float-end\">
          <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i>
          </button>
        </div>
      </div>
      <div class=\"box-body\">
        <form action=\"?p=dashboard&maintenance\" method=\"post\" class=\"form-horizontal\">
          <div class=\"box-body\">
            <div class=\"form-group\">
              <label for=\"status\" class=\"col-sm-2 control-label\">Website:</label>
              <div class=\"col-sm-12\">
                <select class=\"form-control form-select\" id=\"status\" name=\"status\">
                  <option value=\"0\"";
        // line 18
        if ( !($context["is_closed"] ?? null)) {
            echo " selected";
        }
        echo ">Open</option>
                  <option value=\"1\"";
        // line 19
        if (($context["is_closed"] ?? null)) {
            echo " selected";
        }
        echo ">Closed</option>
                </select>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"message\" class=\"col-sm-2 control-label\">Message:<br>
                <small>(only if closed)</small>
              </label>
              <div class=\"col-sm-12\">
                <textarea name=\"message\" cols=\"40\" class=\"form-control\" rows=\"5\" maxlength=\"255\"
                          placeholder=\"Enter ...\">";
        // line 29
        echo twig_escape_filter($this->env, ($context["closed_message"] ?? null), "html", null, true);
        echo "</textarea>
              </div>
            </div>
          </div>
          <div class=\"box-footer\">
            <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#clearcacheModal\"><i
                class=\"fa-solid fa-trash-can\"></i> Clear Cache
            </button>
            <div class=\"float-end\">
              <button type=\"submit\" class=\"btn btn-success\"><i class=\"fa-solid fa-circle-check\"></i> Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class=\"modal fade\" id=\"clearcacheModal\" tabindex=\"-1\" aria-labelledby=\"clearcacheModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-sm\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"clearcacheModalLabel\">Clear Cache</h5>
          <button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
        </div>
        <div class=\"modal-body\">
          Are you sure?
        </div>
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\"><i class=\"fa-solid fa-circle-x\"></i>
            Close
          </button>
          <a href=\"?p=dashboard&clear_cache\"><span class=\"btn btn-success\"><i class=\"fa-solid fa-circle-check\"></i> Confirm</span></a>
        </div>
      </div>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin.dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 29,  62 => 19,  56 => 18,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin.dashboard.html.twig", "/var/www/html/system/templates/admin.dashboard.html.twig");
    }
}
