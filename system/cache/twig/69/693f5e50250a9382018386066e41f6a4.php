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

/* forum.boards.html.twig */
class __TwigTemplate_8211d69ec371c89281b00c4905b7d787 extends \Twig\Template
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
        echo "
<div class=\"ForumHead\">
\t";
        // line 3
        if (twig_get_attribute($this->env, $this->source, ($context["account"] ?? null), "logged", [], "any", false, false, false, 3)) {
            echo "<p class=\"ForumWelcome\">You are <b>not</b> logged in.<br><a href=\"?account/manage\">Log in</a> to post on the forum.</p>";
        }
        // line 4
        echo "\t<div class=\"ForumTimes\"><div class=\"CurrentTime\">Current Time: <i>";
        echo twig_escape_filter($this->env, ($context["currentTime"] ?? null), "html", null, true);
        echo " </i></div>
</div>
</div>

<div class=\"TableContainer\">
  <div class=\"CaptionContainer\">
    <div class=\"CaptionInnerContainer\"> <span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
        // line 10
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span> <span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span> <span class=\"CaptionBorderTop\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span> <span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
      <div class=\"Text\">Boards</div>
      <span class=\"CaptionVerticalRight\" style=\"background-image:url(";
        // line 12
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span> <span class=\"CaptionBorderBottom\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span> <span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span> <span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span> </div>
  </div>
  <table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
      <tr>
        <td><div class=\"InnerTableContainer\">
            <table style=\"width:100%;\">
              <tbody>
                <tr>
                  <td><div class=\"TableContentContainer\">
                      <table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
                        <tbody>
                          <tr class=\"LabelH\">
                            <td class=\"BoardListFirstColumn\"></td>
                            <td>Board</td>
                            <td>Posts</td>
                            <td>Threads</td>
                            <td>Last Post</td>
                            ";
        // line 30
        if (($context["canEdit"] ?? null)) {
            // line 31
            echo "                            <td style=\"width: 10%;\">Options</td>
                            ";
        }
        // line 33
        echo "                          </tr>
";
        // line 34
        $context["i"] = 0;
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["boards"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["board"]) {
            // line 36
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 37
            echo "                          <tr bgcolor=\"";
            echo twig_escape_filter($this->env, $this->env->getFunction('getStyle')->getCallable()(($context["i"] ?? null)), "html", null, true);
            echo "\">
                            <td class=\"BoardListFirstColumn\"><img src=\"";
            // line 38
            echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
            echo "/images/global/forum/";
            echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
            echo ".png\"></td>
                            <td><a href=\"";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "link", [], "any", false, false, false, 39), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "name", [], "any", false, false, false, 39), "html", null, true);
            echo "</a><br>
                              <font class=\"ff_info\">";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "description", [], "any", false, false, false, 40), "html", null, true);
            echo "</font></td>
                            <td class=\"TextRight\">";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "posts", [], "any", false, false, false, 41), "html", null, true);
            echo "</td>
                            <td class=\"TextRight\">";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "threads", [], "any", false, false, false, 42), "html", null, true);
            echo "</td>
                            <td><div class=\"LastPostInfo\">
\t\t\t\t\t\t\t";
            // line 44
            if ( !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["board"], "last_post", [], "any", false, false, false, 44), "name", [], "any", false, false, false, 44))) {
                // line 45
                echo "\t\t\t\t\t\t\t<img src=\"";
                echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                echo "/images/global/forum/logo_lastpost.gif\"> ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["board"], "last_post", [], "any", false, false, false, 45), "date", [], "any", false, false, false, 45), "d.m.y H:i:s"), "html", null, true);
                echo "<br/>by ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["board"], "last_post", [], "any", false, false, false, 45), "player_link", [], "any", false, false, false, 45);
                echo "
\t\t\t\t\t\t\t";
            } else {
                // line 47
                echo "\t\t\t\t\t\t\tNo posts
\t\t\t\t\t\t\t";
            }
            // line 48
            echo "</div></td>
\t\t\t\t\t\t\t";
            // line 49
            if (($context["canEdit"] ?? null)) {
                // line 50
                echo "\t\t\t\t\t\t\t<td><a data-bs-toggle=\"collapse\" href=\"#forum";
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "\" role=\"button\" aria-expanded=\"false\" aria-controls=\"forum";
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "\"><div class=\"BigButton\" style=\"background-image:url(";
                echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                echo "/images/global/buttons/sbutton.gif)\"><div onmouseover=\"MouseOverBigButton(this);\" onmouseout=\"MouseOutBigButton(this);\"><div class=\"BigButtonOver\" style=\"background-image: url(";
                echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
                echo "/images/global/buttons/sbutton_over.gif); visibility: hidden;\"></div><input class=\"BigButtonText\" type=\"button\" value=\"Options\"></div></div></a>
\t\t\t\t\t\t\t<div class=\"collapse\" id=\"forum";
                // line 51
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t  <div class=\"card card-body\">
\t\t\t\t\t\t\t\t<a href=\"?subtopic=forum&action=edit_board&id=";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "id", [], "any", false, false, false, 53), "html", null, true);
                echo "\" title=\"Edit\">
\t\t\t\t\t\t\t\t\t\t<img src=\"images/edit.png\"/>Edit
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<a id=\"delete\" href=\"?subtopic=forum&action=delete_board&id=";
                // line 56
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "id", [], "any", false, false, false, 56), "html", null, true);
                echo "\" onclick=\"return confirm('Are you sure?');\" title=\"Delete\">
\t\t\t\t\t\t\t\t\t\t<img src=\"images/del.png\"/>Delete
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<a href=\"?subtopic=forum&action=hide_board&id=";
                // line 59
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "id", [], "any", false, false, false, 59), "html", null, true);
                echo "\" title=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["board"], "hidden", [], "any", false, false, false, 59) != 1)) {
                    echo "Hide";
                } else {
                    echo "Show";
                }
                echo "\">
\t\t\t\t\t\t\t\t\t\t<img src=\"images/";
                // line 60
                if ((twig_get_attribute($this->env, $this->source, $context["board"], "hidden", [], "any", false, false, false, 60) != 1)) {
                    echo "success";
                } else {
                    echo "error";
                }
                echo ".png\"/>";
                if ((twig_get_attribute($this->env, $this->source, $context["board"], "hidden", [], "any", false, false, false, 60) != 1)) {
                    echo "Hide";
                } else {
                    echo "Show";
                }
                // line 61
                echo "\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
                // line 62
                if ((($context["i"] ?? null) != 1)) {
                    // line 63
                    echo "\t\t\t\t\t\t\t\t\t\t<a href=\"?subtopic=forum&action=moveup_board&id=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "id", [], "any", false, false, false, 63), "html", null, true);
                    echo "\" title=\"Move up\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"images/icons/arrow_up.gif\"/>Move up
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
                }
                // line 67
                echo "\t\t\t\t\t\t\t\t\t";
                if ((($context["i"] ?? null) != ($context["last"] ?? null))) {
                    // line 68
                    echo "\t\t\t\t\t\t\t\t\t\t<a href=\"?subtopic=forum&action=movedown_board&id=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["board"], "id", [], "any", false, false, false, 68), "html", null, true);
                    echo "\" title=\"Move down\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"images/icons/arrow_down.gif\"/>Move down
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
                }
                // line 72
                echo "\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t";
            }
            // line 76
            echo "                          </tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['board'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "                        </tbody>
                      </table>
                    </div></td>
                </tr>
              </tbody>
            </table>
          </div></td>
      </tr>
    </tbody>
  </table>
</div>


<center>
  <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\">
    <tbody>
      <tr>
        <td class=\"ff_info\" colspan=\"1\" align=\"center\" valign=\"middle\" nowrap=\"\"><img src=\"";
        // line 95
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/forum/logo_newposts.gif\" border=\"0\" width=\"31\" height=\"31\"></td>
        <td class=\"ff_info\" colspan=\"1\" align=\"center\" valign=\"middle\" nowrap=\"\"><b>New Posts</b></td>
        <td class=\"ff_info\" colspan=\"1\" align=\"center\" valign=\"middle\" nowrap=\"\"><img src=\"";
        // line 97
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/general/blank.gif\" width=\"12\" height=\"1\" border=\"0\"></td>
        <td class=\"ff_info\" colspan=\"1\" align=\"center\" valign=\"middle\" nowrap=\"\"><img src=\"";
        // line 98
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/forum/logo_closed.gif\" border=\"0\" width=\"22\" height=\"22\"></td>
        <td class=\"ff_info\" colspan=\"1\" align=\"center\" valign=\"middle\" nowrap=\"\"><b>Closed Board</b></td>
      </tr>
    </tbody>
  </table>
</center>";
    }

    public function getTemplateName()
    {
        return "forum.boards.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  276 => 98,  272 => 97,  267 => 95,  248 => 78,  241 => 76,  235 => 72,  227 => 68,  224 => 67,  216 => 63,  214 => 62,  211 => 61,  199 => 60,  189 => 59,  183 => 56,  177 => 53,  172 => 51,  161 => 50,  159 => 49,  156 => 48,  152 => 47,  142 => 45,  140 => 44,  135 => 42,  131 => 41,  127 => 40,  121 => 39,  115 => 38,  110 => 37,  108 => 36,  104 => 35,  102 => 34,  99 => 33,  95 => 31,  93 => 30,  66 => 12,  55 => 10,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "forum.boards.html.twig", "/var/www/html/system/templates/forum.boards.html.twig");
    }
}
