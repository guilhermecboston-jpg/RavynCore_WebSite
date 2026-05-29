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

/* account.lost.form.html.twig */
class __TwigTemplate_bed4df6f7007d76a6a5a317964579cd5 extends \Twig\Template
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
        echo "<h2>Welcome to the Lost Account Interface!</h2>

<p>If you have lost access to your account, this interface can help you. Of course, you need to prove that your claim to
  the account is justified. Enter the requested data and follow the instructions carefully. Please understand there is
  no way to get access to your lost account if the interface cannot help you. Further options to change account data are
  available if you have a registered account.</p>

<p>By using the Lost Account Interface you can</p>

<ul class=\"CustomBulletPointList\"
    style=\"list-style-image: url(https://static.tibia.com/images/global/content/bullet.gif);\">
  <li>get a new password if you have lost the current password,</li>
  <li>get your account back if it has been hacked,</li>
  <li>change the email address of your account instantly (only possible with a valid recovery key or a valid recovery
    TAN),
  </li>
  <li>request a new recovery key/recovery TAN (only available to registered accounts),</li>
  <li>remove an authenticator app from your account (only possible with a valid recovery key or a valid recovery TAN),
  </li>
  <li>disable email code authentication for your account (only available to accounts with a valid recovery key).</li>
</ul>

<p>As a first step to use the Lost Account Interface, please enter the name of a character or the email address of your
  account and click on \"Submit\".</p>

<br/>

<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\">
      <span class=\"CaptionEdgeLeftTop\"
            style=\"background-image:url(";
        // line 32
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightTop\"
            style=\"background-image:url(";
        // line 34
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionBorderTop\"
            style=\"background-image:url(";
        // line 36
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionVerticalLeft\"
            style=\"background-image:url(";
        // line 38
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Lost account</div>
      <span class=\"CaptionVerticalRight\"
            style=\"background-image:url(";
        // line 41
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <span class=\"CaptionBorderBottom\"
            style=\"background-image:url(";
        // line 43
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
      <span class=\"CaptionEdgeLeftBottom\"
            style=\"background-image:url(";
        // line 45
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      <span class=\"CaptionEdgeRightBottom\"
            style=\"background-image:url(";
        // line 47
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
    </div>
  </div>
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
    <tr>
      <td>
        <div class=\"InnerTableContainer\">
          <table style=\"width:100%;\">
            <tbody>
            <tr>
              <td>
                <div class=\"TableContentContainer\">
                  <form action=\"?subtopic=lostaccount&action=step1\" method=post>
                    <input type=\"hidden\" name=\"character\" value=\"\">
                    <table cellspacing=\"1\" cellpadding=\"4\" border=\"0\" width=\"100%\">
                      <tr>
                        <td bgcolor=\"";
        // line 64
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 64), "html", null, true);
        echo "\"><b>Please enter your character name</b></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 67), "html", null, true);
        echo "\">
                          <input type=\"text\" name=\"nick\" size=\"40\" pattern=\"[A-Za-z\\s]+\" title=\"Use only letters and spaces\" data-rc-letters-only autofocus/><br>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor=\"";
        // line 72
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 72), "html", null, true);
        echo "\"><b>Or enter your e-mail</b></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"";
        // line 75
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 75), "html", null, true);
        echo "\">
                          <input type=\"text\" name=\"email_rcv\" size=\"40\" autofocus/><br>
                        </td>
                      </tr>
                    </table>
                    <table cellspacing=\"1\" cellpadding=\"4\" border=\"0\" width=\"100%\">
                      <tr>
                        <td bgcolor=\"";
        // line 82
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 82), "html", null, true);
        echo "\"><b>What do you want?</b></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"";
        // line 85
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "darkborder", [], "any", false, false, false, 85), "html", null, true);
        echo "\">
                          <input type=\"radio\" name=\"action_type\" id=\"action_type_email\" value=\"email\">
                          <label for=\"action_type_email\"> Send me new password and my account name to account e-mail
                            adress.</label><br/>
                          <input type=radio name=\"action_type\" id=\"action_type_key\" value=\"reckey\">
                          <label for=\"action_type_key\"> I got <b>recovery key</b> and want set new password and e-mail
                            adress to my account.</label><br/>
                          <input type=\"radio\" name=\"action_type\" id=\"action_type_no_char\" value=\"no_char\">
                          <label for=\"action_type_no_char\"> I don't have character created and want to recovery my
                            account.</label><br/>
                        </td>
                      </tr>
                    </table>
                    <br/>
                    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                      <tr>
                        <td align=\"center\">
                          ";
        // line 102
        echo twig_include($this->env, $context, "buttons.submit.html.twig");
        echo "
                        </td>
                      </tr>
                    </table>
                  </form>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </td>
    </tr>
    </tbody>
  </table>
</div>



";
    }

    public function getTemplateName()
    {
        return "account.lost.form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 102,  162 => 85,  156 => 82,  146 => 75,  140 => 72,  132 => 67,  126 => 64,  106 => 47,  101 => 45,  96 => 43,  91 => 41,  85 => 38,  80 => 36,  75 => 34,  70 => 32,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.lost.form.html.twig", "/var/www/html/system/templates/account.lost.form.html.twig");
    }
}
