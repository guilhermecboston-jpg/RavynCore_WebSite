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

/* characters.search_rc_dark.html.twig */
class __TwigTemplate_abdcf34376916211df4d5da0af19d772 extends \Twig\Template
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
body.rc-page-characters .rc-rich-content .rc-character-legacy {
    margin: 0 auto;
    max-width: 1100px;
    color: var(--rc-text-soft) !important;
    font-family: var(--rc-font-reading), Verdana, Arial, Helvetica, sans-serif !important;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy * {
    box-sizing: border-box;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-panel {
    border: 1px solid var(--rc-border-strong) !important;
    border-radius: 10px !important;
    margin: 0 0 12px !important;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(14, 20, 34, 0.9) 0%, rgba(10, 15, 26, 0.95) 100%) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.06), 0 10px 24px rgba(0, 0, 0, 0.35);
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-title {
    background: linear-gradient(180deg, rgba(41, 76, 121, 0.95) 0%, rgba(29, 58, 97, 0.95) 100%) !important;
    color: #f0c982 !important;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    font-weight: 700;
    font-size: 14px;
    line-height: 18px;
    font-family: var(--rc-font-title), Verdana, Arial, Helvetica, sans-serif !important;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.65);
    padding: 10px 14px !important;
    border-bottom: 1px solid rgba(196, 156, 86, 0.42);
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-body {
    background: rgba(17, 26, 43, 0.78) !important;
    padding: 12px !important;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-search-row {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 12px;
    align-items: center;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy input[type=\"text\"].rc-legacy-search-input {
    width: 100% !important;
    min-height: 40px !important;
    padding: 9px 12px !important;
    border-radius: 8px !important;
    font-size: 12px !important;
    font-family: var(--rc-font-ui), Verdana, Arial, Helvetica, sans-serif !important;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-search-button {
    min-width: 92px;
    min-height: 40px;
    border: 1px solid rgba(108, 140, 194, 0.55) !important;
    border-radius: 8px !important;
    background: linear-gradient(180deg, rgba(42, 69, 113, 0.95) 0%, rgba(35, 33, 66, 0.95) 100%) !important;
    color: #ffffff !important;
    font-weight: 700;
    font-size: 12px;
    font-family: var(--rc-font-ui), Verdana, Arial, Helvetica, sans-serif !important;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    cursor: pointer;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid rgba(150, 172, 216, 0.28) !important;
    background: rgba(16, 24, 41, 0.8) !important;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-table th,
body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-table td {
    border: 1px solid rgba(150, 172, 216, 0.2) !important;
    padding: 8px 10px !important;
    font-size: 11px;
    line-height: 1.25;
    color: #e7efff !important;
    background: rgba(22, 35, 58, 0.8) !important;
    text-align: left;
    vertical-align: middle;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-table thead th {
    background: rgba(18, 29, 47, 0.96) !important;
    color: #f0c982 !important;
    font-weight: 700;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-label {
    width: 22%;
    font-weight: 700;
    color: #f0c982 !important;
    background: rgba(18, 29, 47, 0.9) !important;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy a {
    color: #6ab4ff !important;
    text-decoration: none;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-status-vip {
    color: #18a24a !important;
    font-weight: 700;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-status-free {
    color: #b94040 !important;
    font-weight: 700;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-name-online {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #1cb24f !important;
    margin-left: 6px;
    vertical-align: middle;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-action {
    text-align: right;
    white-space: nowrap;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-view-button {
    min-width: 52px;
    min-height: 26px;
    padding: 3px 10px;
    border: 1px solid rgba(108, 140, 194, 0.55) !important;
    border-radius: 4px !important;
    background: linear-gradient(180deg, rgba(42, 69, 113, 0.95) 0%, rgba(35, 33, 66, 0.95) 100%) !important;
    color: #ffffff !important;
    font-size: 12px;
    font-weight: 700;
    font-family: var(--rc-font-ui), Verdana, Arial, Helvetica, sans-serif !important;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    cursor: pointer;
}

body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-viewing {
    color: #b8c7e0 !important;
    font-style: italic;
    font-size: 13px;
}

@media (max-width: 900px) {
    body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-search-row {
        grid-template-columns: 1fr;
    }

    body.rc-page-characters .rc-rich-content .rc-character-legacy .rc-legacy-table {
        display: block;
        overflow-x: auto;
    }
}
</style>

<div class=\"rc-character-legacy\">
  <form action=\"";
        // line 169
        echo twig_escape_filter($this->env, ($context["characters_link"] ?? null), "html", null, true);
        echo "\" method=\"post\">
    <div class=\"rc-legacy-panel\">
      <div class=\"rc-legacy-title\">Search Character</div>
      <div class=\"rc-legacy-body\">
        <div class=\"rc-legacy-search-row\">
          <input class=\"rc-legacy-search-input\" type=\"text\" name=\"name\" value=\"";
        // line 174
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getName", [], "method", false, false, false, 174), "html", null, true);
        echo "\" maxlength=\"29\" pattern=\"[A-Za-z\\s]+\" title=\"Use only letters and spaces\" data-rc-letters-only>
          <button type=\"submit\" class=\"rc-legacy-search-button\">Search</button>
        </div>
      </div>
    </div>
  </form>

  <div class=\"rc-legacy-panel\">
    <div class=\"rc-legacy-title\">Character Information</div>
    <div class=\"rc-legacy-body\">
      <table class=\"rc-legacy-table\">
        <tbody>
          <tr>
            <td class=\"rc-legacy-label\">Name:</td>
            <td>";
        // line 188
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getName", [], "method", false, false, false, 188), "html", null, true);
        echo "</td>
          </tr>
          ";
        // line 190
        if ((twig_length_filter($this->env, ($context["former_names"] ?? null)) > 0)) {
            // line 191
            echo "            <tr>
              <td class=\"rc-legacy-label\">Former Names:</td>
              <td>";
            // line 193
            echo twig_escape_filter($this->env, twig_join_filter(($context["former_names"] ?? null), ", "), "html", null, true);
            echo "</td>
            </tr>
          ";
        }
        // line 196
        echo "          <tr>
            <td class=\"rc-legacy-label\">Sex:</td>
            <td>";
        // line 198
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, ($context["sex"] ?? null)), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">Vocation:</td>
            <td>";
        // line 202
        echo twig_escape_filter($this->env, ($context["vocation"] ?? null), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">Level:</td>
            <td><b>";
        // line 206
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLevel", [], "method", false, false, false, 206), "html", null, true);
        echo "</b></td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">World:</td>
            <td>";
        // line 210
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 210), "serverName", [], "any", false, false, false, 210), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">Residence:</td>
            <td>";
        // line 214
        echo twig_escape_filter($this->env, ($context["town"] ?? null), "html", null, true);
        echo "</td>
          </tr>
          ";
        // line 216
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 216))) {
            // line 217
            echo "            <tr>
              <td class=\"rc-legacy-label\">Guild:</td>
              <td>";
            // line 219
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "rank", [], "any", false, false, false, 219), "html", null, true);
            echo " of ";
            echo twig_get_attribute($this->env, $this->source, ($context["guild"] ?? null), "link", [], "any", false, false, false, 219);
            echo "</td>
            </tr>
          ";
        }
        // line 222
        echo "          <tr>
            <td class=\"rc-legacy-label\">Last Login:</td>
            <td>";
        // line 224
        if ((twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLastLogin", [], "method", false, false, false, 224) == 0)) {
            echo "Never logged in.";
        } else {
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getLastLogin", [], "method", false, false, false, 224), "M j, Y, h:i A"), "html", null, true);
        }
        echo "</td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">Account Status:</td>
            <td>
              ";
        // line 229
        if (twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "isPremium", [], "method", false, false, false, 229)) {
            // line 230
            echo "                <span class=\"rc-legacy-status-vip\">VIP Account</span>
              ";
        } else {
            // line 232
            echo "                <span class=\"rc-legacy-status-free\">Free Account</span>
              ";
        }
        // line 234
        echo "            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  ";
        // line 241
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_BEFORE_DEATHS")), "html", null, true);
        echo "

  <div class=\"rc-legacy-panel\">
    <div class=\"rc-legacy-title\">Character Deaths</div>
    <div class=\"rc-legacy-body\">
      <table class=\"rc-legacy-table\">
        <thead>
          <tr>
            <th style=\"width: 24%;\">Date</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 254
        if ((twig_length_filter($this->env, ($context["deaths"] ?? null)) > 0)) {
            // line 255
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["deaths"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["death"]) {
                // line 256
                echo "              <tr>
                <td>";
                // line 257
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["death"], "time", [], "any", false, false, false, 257), "M j, Y, h:i A"), "html", null, true);
                echo "</td>
                <td>";
                // line 258
                echo twig_get_attribute($this->env, $this->source, $context["death"], "description", [], "any", false, false, false, 258);
                echo "</td>
              </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['death'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 261
            echo "          ";
        } else {
            // line 262
            echo "            <tr>
              <td colspan=\"2\">No deaths recorded for this character.</td>
            </tr>
          ";
        }
        // line 266
        echo "        </tbody>
      </table>
    </div>
  </div>

  <div class=\"rc-legacy-panel\">
    <div class=\"rc-legacy-title\">Account Information</div>
    <div class=\"rc-legacy-body\">
      <table class=\"rc-legacy-table\">
        <tbody>
          <tr>
            <td class=\"rc-legacy-label\">Loyalt Title:</td>
            <td>";
        // line 278
        echo twig_escape_filter($this->env, ((array_key_exists("loyaltyTitle", $context)) ? (_twig_default_filter(($context["loyaltyTitle"] ?? null), "None")) : ("None")), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">Loyalt Points:</td>
            <td>";
        // line 282
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ((array_key_exists("loyaltyPoints", $context)) ? (_twig_default_filter(($context["loyaltyPoints"] ?? null), 0)) : (0)), 0, ",", "."), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"rc-legacy-label\">Created:</td>
            <td>";
        // line 286
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "getCreated", [], "method", false, false, false, 286), "M j, Y, h:i A"), "html", null, true);
        echo "</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  ";
        // line 293
        if ( !($context["hidden"] ?? null)) {
            // line 294
            echo "    <div class=\"rc-legacy-panel\">
      <div class=\"rc-legacy-title\">Characters on this Account</div>
      <div class=\"rc-legacy-body\">
        <table class=\"rc-legacy-table\">
          <thead>
            <tr>
              <th style=\"width: 42%;\">Name</th>
              <th style=\"width: 24%;\">Vocation</th>
              <th style=\"width: 10%;\">Level</th>
              <th style=\"width: 16%;\">World</th>
              <th style=\"width: 8%;\"></th>
            </tr>
          </thead>
          <tbody>
            ";
            // line 308
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["account_players"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["accountPlayer"]) {
                // line 309
                echo "              ";
                if (( !twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "isHidden", [], "method", false, false, false, 309) && ((($__internal_compile_0 = $this->env->getFunction('config')->getCallable()("characters")) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["deleted"] ?? null) : null) ||  !twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "isDeleted", [], "method", false, false, false, 309)))) {
                    // line 310
                    echo "                <tr>
                  <td>
                    ";
                    // line 312
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "getName", [], "method", false, false, false, 312), "html", null, true);
                    echo "
                    ";
                    // line 313
                    if (twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "isOnline", [], "method", false, false, false, 313)) {
                        echo "<span class=\"rc-legacy-name-online\"></span>";
                    }
                    // line 314
                    echo "                  </td>
                  <td>";
                    // line 315
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "getVocationName", [], "method", false, false, false, 315), "html", null, true);
                    echo "</td>
                  <td>";
                    // line 316
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "getLevel", [], "method", false, false, false, 316), "html", null, true);
                    echo "</td>
                  <td>";
                    // line 317
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "lua", [], "any", false, false, false, 317), "serverName", [], "any", false, false, false, 317), "html", null, true);
                    echo "</td>
                  <td class=\"rc-legacy-action\">
                    ";
                    // line 319
                    if ((twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "getId", [], "method", false, false, false, 319) == twig_get_attribute($this->env, $this->source, ($context["player"] ?? null), "getId", [], "method", false, false, false, 319))) {
                        // line 320
                        echo "                      <span class=\"rc-legacy-viewing\">viewing</span>
                    ";
                    } else {
                        // line 322
                        echo "                      <form action=\"";
                        echo twig_escape_filter($this->env, ($context["characters_link"] ?? null), "html", null, true);
                        echo "\" method=\"post\" style=\"margin:0;\">
                        <input type=\"hidden\" name=\"name\" value=\"";
                        // line 323
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["accountPlayer"], "getName", [], "method", false, false, false, 323), "html", null, true);
                        echo "\">
                        <button type=\"submit\" class=\"rc-legacy-view-button\">View</button>
                      </form>
                    ";
                    }
                    // line 327
                    echo "                  </td>
                </tr>
              ";
                }
                // line 330
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['accountPlayer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 331
            echo "          </tbody>
        </table>
      </div>
    </div>
  ";
        }
        // line 336
        echo "
  ";
        // line 337
        echo twig_escape_filter($this->env, $this->env->getFunction('hook')->getCallable()($context, twig_constant("HOOK_CHARACTERS_AFTER_CHARACTERS")), "html", null, true);
        echo "
</div>

";
    }

    public function getTemplateName()
    {
        return "characters.search_rc_dark.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  513 => 337,  510 => 336,  503 => 331,  497 => 330,  492 => 327,  485 => 323,  480 => 322,  476 => 320,  474 => 319,  469 => 317,  465 => 316,  461 => 315,  458 => 314,  454 => 313,  450 => 312,  446 => 310,  443 => 309,  439 => 308,  423 => 294,  421 => 293,  411 => 286,  404 => 282,  397 => 278,  383 => 266,  377 => 262,  374 => 261,  365 => 258,  361 => 257,  358 => 256,  353 => 255,  351 => 254,  335 => 241,  326 => 234,  322 => 232,  318 => 230,  316 => 229,  304 => 224,  300 => 222,  292 => 219,  288 => 217,  286 => 216,  281 => 214,  274 => 210,  267 => 206,  260 => 202,  253 => 198,  249 => 196,  243 => 193,  239 => 191,  237 => 190,  232 => 188,  215 => 174,  207 => 169,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "characters.search_rc_dark.html.twig", "/var/www/html/system/templates/characters.search_rc_dark.html.twig");
    }
}
