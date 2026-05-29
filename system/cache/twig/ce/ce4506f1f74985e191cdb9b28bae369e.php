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

/* rules.html.twig */
class __TwigTemplate_36c34cdb687b6dace0cf510feeaf7193 extends \Twig\Template
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
        echo "<div class=\"BoxContent\" style=\"background-image:url(";
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/scroll.gif);\">
    <div style=\"text-align: -webkit-center !important;\">
        <table>
            <tbody>
                <tr>
                    <td><img src=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/headline-bracer-left.gif\"></td>
                    <td>
                        <form action=\"#\" method=\"get\" id=\"language-form\"><br>
                            <label for=\"language-select\"></label>
                            <select name=\"option\" id=\"option-select\" onchange=\"changeOption()\">
                                <option value=\"1\">EN</option>
                                <option value=\"2\">PT-BR</option>
                            </select>
                        </form>
                    </td>
                    <td><img src=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/headline-bracer-right.gif\"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id=\"content1\">
        <div class=\"BoxContent\" style=\"background-image:url(";
        // line 23
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/scroll.gif);\">
\t<div class=\"TableContainer\">
\t\t<div class=\"CaptionContainer\">
\t\t\t<div class=\"CaptionInnerContainer\">
\t\t\t\t<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
        // line 27
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
        // line 28
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t<span class=\"CaptionBorderTop\" style=\"background-image:url(";
        // line 29
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t\t\t<span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
        // line 30
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t\t<div class=\"Text\">Rules</div>
\t\t\t\t<span class=\"CaptionVerticalRight\" style=\"background-image:url(";
        // line 32
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
\t\t\t\t<span class=\"CaptionBorderBottom\" style=\"background-image:url(";
        // line 33
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
\t\t\t\t<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
        // line 34
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t\t<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
        // line 35
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
\t\t\t</div>
\t\t</div>
\t\t<table class=\"Table1\" cellpadding=\"0\" cellspacing=\"0\">  <tbody><tr> <td> <div class=\"InnerTableContainer\" style=\"max-width: unset;\"> <table style=\"width:100%;\"><tbody><tr><td>";
        // line 38
        echo twig_escape_filter($this->env, (($__internal_compile_0 = (($__internal_compile_1 = ($context["config"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["lua"] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["serverName"] ?? null) : null), "html", null, true);
        echo " is an online role-playing game in which thousands of players from all over the world meet everyday. In order to ensure that the game is fun for everyone, ";
        echo twig_escape_filter($this->env, (($__internal_compile_2 = (($__internal_compile_3 = ($context["config"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["lua"] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["serverName"] ?? null) : null), "html", null, true);
        echo " expects all players to behave in a reasonable and respectful manner.<br><br>
\t\t";
        // line 39
        echo twig_escape_filter($this->env, (($__internal_compile_4 = (($__internal_compile_5 = ($context["config"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["lua"] ?? null) : null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["serverName"] ?? null) : null), "html", null, true);
        echo " reserves the right to stop destructive behaviour in the game, on the official website or in any other part of ";
        echo twig_escape_filter($this->env, (($__internal_compile_6 = (($__internal_compile_7 = ($context["config"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["lua"] ?? null) : null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["serverName"] ?? null) : null), "html", null, true);
        echo "'s services. Such behaviour includes, but is not limited to, the following offences:<br><br>
\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tbody><tr><td width=\"15\"></td><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"2\" width=\"100%\">
\t\t<tbody><tr><td><b>1.</b></td><td><b>Names</b></td></tr>
\t\t<tr><td></td><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
\t\t<tbody><tr><td valign=\"top\"><b>a)</b></td><td><b>Offensive Name</b><br>
\t\tNames that are insulting, racist, sexually related, drug-related, harassing or generally objectionable.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>b)</b></td><td><b>Name Containing Forbidden Advertising</b><br>
\t\tNames that advertise brands, products or services of third parties, content which is not related to the game or trades for real money.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>c)</b></td><td><b>Unsuitable Name</b><br>
\t\tNames that express religious or political views.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>d)</b></td><td><b>Name Supporting Rule Violation</b><br>
\t\tNames that support, incite, announce or imply a violation of the ";
        // line 53
        echo twig_escape_filter($this->env, (($__internal_compile_8 = (($__internal_compile_9 = ($context["config"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["lua"] ?? null) : null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["serverName"] ?? null) : null), "html", null, true);
        echo " Rules.
\t\t</td></tr>
\t\t</tbody></table></td></tr>
\t\t<tr><td colspan=\"2\">&nbsp;</td></tr>
\t\t<tr><td><b>2.</b></td><td><b>Statements</b></td></tr>
\t\t<tr><td></td><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
\t\t<tbody><tr><td valign=\"top\"><b>a)</b></td><td><b>Offensive Statement</b><br>
\t\tInsulting, racist, sexually related, drug-related, harassing or generally objectionable statements.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>b)</b></td><td><b>Spamming</b><br>
\t\tExcessively repeating identical or similar statements or using badly formatted or nonsensical text.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>c)</b></td><td><b>Forbidden Advertising</b><br>
\t\tAdvertising brands, products or services of third parties, content which is not related to the game or trades for real money.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>d)</b></td><td><b>Off-Topic Public Statement</b><br>
\t\tReligious or political public statements or other public statements which are not related to the topic of the used channel or board.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>e)</b></td><td><b>Violating Language Restriction</b><br>
\t\tNon-English statements in boards and channels where the use of English is explicitly required.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>f)</b></td><td><b>Disclosing Personal Data of Others</b><br>
\t\tDisclosing personal data of other people.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>g)</b></td><td><b>Supporting Rule Violation</b><br>
\t\tStatements that support, incite, announce or imply a violation of the ";
        // line 78
        echo twig_escape_filter($this->env, (($__internal_compile_10 = (($__internal_compile_11 = ($context["config"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["lua"] ?? null) : null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["serverName"] ?? null) : null), "html", null, true);
        echo " Rules.
\t\t</td></tr>
\t\t</tbody></table></td></tr>
\t\t<tr><td colspan=\"2\">&nbsp;</td></tr>
\t\t<tr><td><b>3.</b></td><td><b>Cheating</b></td></tr>
\t\t<tr><td></td><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
\t\t<tbody><tr><td valign=\"top\"><b>a)</b></td><td><b>Bug Abuse</b><br>
\t\tExploiting obvious errors of the game or any other part of ";
        // line 85
        echo twig_escape_filter($this->env, (($__internal_compile_12 = (($__internal_compile_13 = ($context["config"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["lua"] ?? null) : null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["serverName"] ?? null) : null), "html", null, true);
        echo "'s services.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>b)</b></td><td><b>Using Unofficial Software to Play</b><br>
\t\tManipulating the official client program or using additional software to play the game.
\t\t</td></tr>
\t\t</tbody></table></td></tr>
\t\t<tr><td colspan=\"2\">&nbsp;</td></tr>
\t\t<tr><td><b>4.</b></td><td><b>";
        // line 92
        echo twig_escape_filter($this->env, (($__internal_compile_14 = (($__internal_compile_15 = ($context["config"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["lua"] ?? null) : null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["serverName"] ?? null) : null), "html", null, true);
        echo "</b></td></tr>
\t\t<tr><td></td><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
\t\t<tbody><tr><td valign=\"top\"><b>a)</b></td><td><b>Pretending to be ";
        // line 94
        echo twig_escape_filter($this->env, (($__internal_compile_16 = (($__internal_compile_17 = ($context["config"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["lua"] ?? null) : null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
\t\tPretending to be a representative of ";
        // line 95
        echo twig_escape_filter($this->env, (($__internal_compile_18 = (($__internal_compile_19 = ($context["config"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["lua"] ?? null) : null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["serverName"] ?? null) : null), "html", null, true);
        echo " or to have their legitimation or powers.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>b)</b></td><td><b>Slandering or Agitating against ";
        // line 97
        echo twig_escape_filter($this->env, (($__internal_compile_20 = (($__internal_compile_21 = ($context["config"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["lua"] ?? null) : null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
\t\tPublishing clearly wrong information about or calling a boycott against ";
        // line 98
        echo twig_escape_filter($this->env, (($__internal_compile_22 = (($__internal_compile_23 = ($context["config"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["lua"] ?? null) : null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["serverName"] ?? null) : null), "html", null, true);
        echo " or its services.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>c)</b></td><td><b>False Information to ";
        // line 100
        echo twig_escape_filter($this->env, (($__internal_compile_24 = (($__internal_compile_25 = ($context["config"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["lua"] ?? null) : null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
\t\tIntentionally giving wrong or misleading information to ";
        // line 101
        echo twig_escape_filter($this->env, (($__internal_compile_26 = (($__internal_compile_27 = ($context["config"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["lua"] ?? null) : null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["serverName"] ?? null) : null), "html", null, true);
        echo " in reports about rule violations, complaints, bug reports or support requests.
\t\t</td></tr>
\t\t</tbody></table></td></tr>
\t\t<tr><td colspan=\"2\">&nbsp;</td></tr>
\t\t<tr><td><b>5.</b></td><td><b>Legal Issues</b></td></tr>
\t\t<tr><td></td><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
\t\t<tbody><tr><td valign=\"top\"><b>a)</b></td><td><b>Hacking</b><br>
\t\tStealing other players' account or personal data.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>b)</b></td><td><b>Attacking ";
        // line 110
        echo twig_escape_filter($this->env, (($__internal_compile_28 = (($__internal_compile_29 = ($context["config"] ?? null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["lua"] ?? null) : null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["serverName"] ?? null) : null), "html", null, true);
        echo " Service</b><br>
\t\tAttacking, disrupting or damaging the operation of any ";
        // line 111
        echo twig_escape_filter($this->env, (($__internal_compile_30 = (($__internal_compile_31 = ($context["config"] ?? null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["lua"] ?? null) : null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["serverName"] ?? null) : null), "html", null, true);
        echo " server, the game or any other part of ";
        echo twig_escape_filter($this->env, (($__internal_compile_32 = (($__internal_compile_33 = ($context["config"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["lua"] ?? null) : null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["serverName"] ?? null) : null), "html", null, true);
        echo "'s services.
\t\t</td></tr>
\t\t<tr><td valign=\"top\"><b>c)</b></td><td><b>Violating Law or Regulations</b><br>
\t\tViolating any applicable law, the ";
        // line 114
        echo twig_escape_filter($this->env, (($__internal_compile_34 = (($__internal_compile_35 = ($context["config"] ?? null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["lua"] ?? null) : null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["serverName"] ?? null) : null), "html", null, true);
        echo " Service Agreement or rights of third parties.
\t\t</td></tr>
\t\t</tbody></table></td></tr>
\t\t<tr><td colspan=\"2\">&nbsp;</td></tr>
\t\t</tbody></table></td><td width=\"15\"></td></tr></tbody></table><br>
\t\tViolating or attempting to violate the ";
        // line 119
        echo twig_escape_filter($this->env, (($__internal_compile_36 = (($__internal_compile_37 = ($context["config"] ?? null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["lua"] ?? null) : null)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["serverName"] ?? null) : null), "html", null, true);
        echo " Rules may lead to a temporary suspension of characters and accounts. In severe cases the removal or modification of character skills, attributes and belongings, as well as the permanent removal of characters and accounts without any compensation may be considered. The sanction is based on the seriousness of the rule violation and the previous record of the player. It is determined at the sole discretion of ";
        echo twig_escape_filter($this->env, (($__internal_compile_38 = (($__internal_compile_39 = ($context["config"] ?? null)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["lua"] ?? null) : null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["serverName"] ?? null) : null), "html", null, true);
        echo " and can be imposed without any previous warning.<br><br>
\t\tThese rules may be changed at any time. All changes will be announced on the official website.
\t\t</td></tr> </tbody></table> </div> </td> </tr> </tbody></table>
\t</div>
</div>
    </div>

    <div id=\"content2\" style=\"display: none;\">
<div class=\"BoxContent\" style=\"background-image:url(";
        // line 127
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/scroll.gif);\">
  <div class=\"TableContainer\">
    <div class=\"CaptionContainer\">
      <div class=\"CaptionInnerContainer\">
        <span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(";
        // line 131
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightTop\" style=\"background-image:url(";
        // line 132
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionBorderTop\" style=\"background-image:url(";
        // line 133
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionVerticalLeft\" style=\"background-image:url(";
        // line 134
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <div class=\"Text\">Regras</div>
        <span class=\"CaptionVerticalRight\" style=\"background-image:url(";
        // line 136
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-vertical.gif);\"></span>
        <span class=\"CaptionBorderBottom\" style=\"background-image:url(";
        // line 137
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/table-headline-border.gif);\"></span>
        <span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(";
        // line 138
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
        <span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(";
        // line 139
        echo twig_escape_filter($this->env, ($context["template_path"] ?? null), "html", null, true);
        echo "/images/global/content/box-frame-edge.gif);\"></span>
      </div>
    </div>
    <table class=\"Table1\" cellpadding=\"0\" cellspacing=\"0\">
      <tbody>
        <tr>
          <td>
            <div class=\"InnerTableContainer\" style=\"max-width: unset;\">
              <table style=\"width:100%;\">
                <tbody>
                  <tr>
                    <td>
                      ";
        // line 151
        echo twig_escape_filter($this->env, (($__internal_compile_40 = (($__internal_compile_41 = ($context["config"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["lua"] ?? null) : null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["serverName"] ?? null) : null), "html", null, true);
        echo " e um jogo de interpretacao de personagens online no qual milhares de jogadores do mundo todo se encontram diariamente. Para garantir que o jogo seja divertido para todos, o Global Nova Era espera que todos os jogadores se comportem de maneira razoavel e respeitosa.<br><br>
                      O(a) ";
        // line 152
        echo twig_escape_filter($this->env, (($__internal_compile_42 = (($__internal_compile_43 = ($context["config"] ?? null)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["lua"] ?? null) : null)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["serverName"] ?? null) : null), "html", null, true);
        echo " reserva o direito de interromper comportamentos destrutivos no jogo, no site oficial ou em qualquer outra parte dos servicos oferecidos. Tais comportamentos incluem, mas nao se limitam aos seguintes delitos:<br><br>
                      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                        <tbody>
                          <tr>
                            <td width=\"15\"></td>
                            <td>
                              <table border=\"0\" cellpadding=\"0\" cellspacing=\"2\" width=\"100%\">
                                <tbody>
                                  <tr>
                                    <td><b>1.</b></td>
                                    <td><b>Nomes</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>
                                      <table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
                                        <tbody>
                                          <tr>
                                            <td valign=\"top\"><b>a)</b></td>
                                            <td><b>Nome Ofensivo</b><br>
                                              Nomes que sao insultuosos, racistas, sexualmente explicitos, relacionados a drogas, hostis ou geralmente objetaveis.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>b)</b></td>
                                            <td><b>Nome com Publicidade Proibida</b><br>
                                              Nomes que fazem publicidade de marcas, produtos ou servicos de terceiros, conteudo que nao esta relacionado ao jogo ou negociacoes com dinheiro real.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>c)</b></td>
                                            <td><b>Nome Inadequado</b><br>
                                              Nomes que expressam visoes religiosas ou politicas.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>d)</b></td>
                                            <td><b>Nome Apoiando Violacao de Regras</b><br>
                                              Nomes que apoiam, incitam, anunciam ou implicam uma violacao das Regras do Servidor.
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr><td colspan=\"2\">&nbsp;</td></tr>
                                  <tr>
                                    <td><b>2.</b></td>
                                    <td><b>Declaracoes</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>
                                      <table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
                                        <tbody>
                                          <tr>
                                            <td valign=\"top\"><b>a)</b></td>
                                            <td><b>Declaracao Ofensiva</b><br>
                                              Declaracoes insultuosas, racistas, sexualmente explicitas, relacionadas a drogas, hostis ou geralmente objetaveis.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>b)</b></td>
                                            <td><b>Spam</b><br>
                                              Repeticao excessiva de declaracoes identicas ou semelhantes ou uso de texto mal formatado ou sem sentido.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>c)</b></td>
                                            <td><b>Publicidade Proibida</b><br>
                                              Publicidade de marcas, produtos ou servicos de terceiros, conteudo que nao esta relacionado ao jogo ou negociacoes com dinheiro real.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>d)</b></td>
                                            <td><b>Declaracao Publica Fora do Topico</b><br>
                                              Declaracoes publicas religiosas ou politicas ou outras declaracoes publicas que nao estao relacionadas ao topico do canal ou quadro utilizado.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>e)</b></td>
                                            <td><b>Violacao da Restricao de Idioma</b><br>
                                              Declaracoes nao em portugues em quadros e canais onde o uso do portugues e explicitamente exigido
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>f)</b></td>
                                            <td><b>Divulgar Dados Pessoais de Outros</b><br>
                                              Divulgar dados pessoais de outras pessoas.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>g)</b></td>
                                            <td><b>Apoiar Violacao de Regras</b><br>
                                              Declaracoes que apoiam, incitam, anunciam ou implicam uma violacao das Regras do ";
        // line 246
        echo twig_escape_filter($this->env, (($__internal_compile_44 = (($__internal_compile_45 = ($context["config"] ?? null)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["lua"] ?? null) : null)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["serverName"] ?? null) : null), "html", null, true);
        echo ".
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr><td colspan=\"2\">&nbsp;</td></tr>
                                  <tr>
                                    <td><b>3.</b></td>
                                    <td><b>Fraude</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>
                                      <table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
                                        <tbody>
                                          <tr>
                                            <td valign=\"top\"><b>a)</b></td>
                                            <td><b>Exploracao de Bugs</b><br>
                                              Explorar erros obvios do jogo ou de qualquer outra parte dos servicos do(a) ";
        // line 266
        echo twig_escape_filter($this->env, (($__internal_compile_46 = (($__internal_compile_47 = ($context["config"] ?? null)) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["lua"] ?? null) : null)) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["serverName"] ?? null) : null), "html", null, true);
        echo ".
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>b)</b></td>
                                            <td><b>Uso de Software Nao Oficial para Jogar</b><br>
                                              Manipular o programa cliente oficial ou usar software adicional para jogar o jogo.
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr><td colspan=\"2\">&nbsp;</td></tr>
                                  <tr>
                                    <td><b>4.</b></td>
                                    <td><b>";
        // line 282
        echo twig_escape_filter($this->env, (($__internal_compile_48 = (($__internal_compile_49 = ($context["config"] ?? null)) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49["lua"] ?? null) : null)) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["serverName"] ?? null) : null), "html", null, true);
        echo "</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>
                                      <table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
                                        <tbody>
                                          <tr>
                                            <td valign=\"top\"><b>a)</b></td>
                                            <td><b>Fingir ser ";
        // line 291
        echo twig_escape_filter($this->env, (($__internal_compile_50 = (($__internal_compile_51 = ($context["config"] ?? null)) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51["lua"] ?? null) : null)) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
                                              Fingir ser um representante do(a) ";
        // line 292
        echo twig_escape_filter($this->env, (($__internal_compile_52 = (($__internal_compile_53 = ($context["config"] ?? null)) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53["lua"] ?? null) : null)) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52["serverName"] ?? null) : null), "html", null, true);
        echo " ou ter sua legitimacao ou poderes.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>b)</b></td>
                                            <td><b>Difamar ou Agitar Contra o(a) ";
        // line 297
        echo twig_escape_filter($this->env, (($__internal_compile_54 = (($__internal_compile_55 = ($context["config"] ?? null)) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55["lua"] ?? null) : null)) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
                                              Publicar informacoes claramente incorretas ou convocar um boicote contra o(a) ";
        // line 298
        echo twig_escape_filter($this->env, (($__internal_compile_56 = (($__internal_compile_57 = ($context["config"] ?? null)) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57["lua"] ?? null) : null)) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56["serverName"] ?? null) : null), "html", null, true);
        echo " ou seus servicos.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>c)</b></td>
                                            <td><b>Fornecer Informacoes Falsas o(a) ";
        // line 303
        echo twig_escape_filter($this->env, (($__internal_compile_58 = (($__internal_compile_59 = ($context["config"] ?? null)) && is_array($__internal_compile_59) || $__internal_compile_59 instanceof ArrayAccess ? ($__internal_compile_59["lua"] ?? null) : null)) && is_array($__internal_compile_58) || $__internal_compile_58 instanceof ArrayAccess ? ($__internal_compile_58["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
                                              Dar intencionalmente informacoes erradas ou enganosas o(a) ";
        // line 304
        echo twig_escape_filter($this->env, (($__internal_compile_60 = (($__internal_compile_61 = ($context["config"] ?? null)) && is_array($__internal_compile_61) || $__internal_compile_61 instanceof ArrayAccess ? ($__internal_compile_61["lua"] ?? null) : null)) && is_array($__internal_compile_60) || $__internal_compile_60 instanceof ArrayAccess ? ($__internal_compile_60["serverName"] ?? null) : null), "html", null, true);
        echo " em relatorios sobre violacoes de regras, reclamacoes, relatos de bugs ou solicitacoes de suporte.
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr><td colspan=\"2\">&nbsp;</td></tr>
                                  <tr>
                                    <td><b>5.</b></td>
                                    <td><b>Questoes Legais</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>
                                      <table border=\"0\" cellpadding=\"0\" cellspacing=\"3\" width=\"100%\">
                                        <tbody>
                                          <tr>
                                            <td valign=\"top\"><b>a)</b></td>
                                            <td><b>Hackeamento</b><br>
                                              Roubar a conta ou dados pessoais de outros jogadores.
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>b)</b></td>
                                            <td><b>Atacar o Servico do(a) ";
        // line 329
        echo twig_escape_filter($this->env, (($__internal_compile_62 = (($__internal_compile_63 = ($context["config"] ?? null)) && is_array($__internal_compile_63) || $__internal_compile_63 instanceof ArrayAccess ? ($__internal_compile_63["lua"] ?? null) : null)) && is_array($__internal_compile_62) || $__internal_compile_62 instanceof ArrayAccess ? ($__internal_compile_62["serverName"] ?? null) : null), "html", null, true);
        echo "</b><br>
                                              Atacar, perturbar ou danificar a operacao de qualquer servidor do(a) ";
        // line 330
        echo twig_escape_filter($this->env, (($__internal_compile_64 = (($__internal_compile_65 = ($context["config"] ?? null)) && is_array($__internal_compile_65) || $__internal_compile_65 instanceof ArrayAccess ? ($__internal_compile_65["lua"] ?? null) : null)) && is_array($__internal_compile_64) || $__internal_compile_64 instanceof ArrayAccess ? ($__internal_compile_64["serverName"] ?? null) : null), "html", null, true);
        echo ", o jogo ou qualquer outra parte dos servicos do(a) ";
        echo twig_escape_filter($this->env, (($__internal_compile_66 = (($__internal_compile_67 = ($context["config"] ?? null)) && is_array($__internal_compile_67) || $__internal_compile_67 instanceof ArrayAccess ? ($__internal_compile_67["lua"] ?? null) : null)) && is_array($__internal_compile_66) || $__internal_compile_66 instanceof ArrayAccess ? ($__internal_compile_66["serverName"] ?? null) : null), "html", null, true);
        echo ".
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign=\"top\"><b>c)</b></td>
                                            <td><b>Violar Leis ou Regulamentos</b><br>
                                              Violar qualquer lei aplicavel, o Contrato de Servico do(a) ";
        // line 336
        echo twig_escape_filter($this->env, (($__internal_compile_68 = (($__internal_compile_69 = ($context["config"] ?? null)) && is_array($__internal_compile_69) || $__internal_compile_69 instanceof ArrayAccess ? ($__internal_compile_69["lua"] ?? null) : null)) && is_array($__internal_compile_68) || $__internal_compile_68 instanceof ArrayAccess ? ($__internal_compile_68["serverName"] ?? null) : null), "html", null, true);
        echo " ou direitos de terceiros.
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr><td colspan=\"2\">&nbsp;</td></tr>
                                </tbody>
                              </table>
                            </td>
                            <td width=\"15\"></td>
                          </tr>
                        </tbody>
                      </table><br>
                      Violar ou tentar violar as Regras do(a) ";
        // line 351
        echo twig_escape_filter($this->env, (($__internal_compile_70 = (($__internal_compile_71 = ($context["config"] ?? null)) && is_array($__internal_compile_71) || $__internal_compile_71 instanceof ArrayAccess ? ($__internal_compile_71["lua"] ?? null) : null)) && is_array($__internal_compile_70) || $__internal_compile_70 instanceof ArrayAccess ? ($__internal_compile_70["serverName"] ?? null) : null), "html", null, true);
        echo " pode levar a uma suspensao temporaria de personagens e contas. Em casos graves, a remocao ou modificacao das habilidades, atributos e pertences do personagem, assim como a remocao permanente de personagens e contas sem qualquer compensacao, pode ser considerada. A sancao e baseada na gravidade da violacao das regras e no historico anterior do jogador. E determinada a criterio exclusivo do(a) ";
        echo twig_escape_filter($this->env, (($__internal_compile_72 = (($__internal_compile_73 = ($context["config"] ?? null)) && is_array($__internal_compile_73) || $__internal_compile_73 instanceof ArrayAccess ? ($__internal_compile_73["lua"] ?? null) : null)) && is_array($__internal_compile_72) || $__internal_compile_72 instanceof ArrayAccess ? ($__internal_compile_72["serverName"] ?? null) : null), "html", null, true);
        echo " e pode ser imposta sem aviso previo.<br><br>
                      Essas regras podem ser alteradas a qualquer momento. Todas as alteracoes serao anunciadas no site oficial.
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
</div>

    </div>

    <script>
        function changeOption() {
            var optionSelect = document.getElementById(\"option-select\");
            var selectedOption = optionSelect.options[optionSelect.selectedIndex].value;

            // Exiba o conteúdo correspondente com base na opção selecionada
\t\t\tif (selectedOption === \"1\") {
                document.getElementById(\"content1\").style.display = \"block\";
                document.getElementById(\"content2\").style.display = \"none\";
            } else if (selectedOption === \"2\") {
                document.getElementById(\"content1\").style.display = \"none\";
                document.getElementById(\"content2\").style.display = \"block\";
            }
        }
    </script>
</div>
";
    }

    public function getTemplateName()
    {
        return "rules.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  551 => 351,  533 => 336,  522 => 330,  518 => 329,  490 => 304,  486 => 303,  478 => 298,  474 => 297,  466 => 292,  462 => 291,  450 => 282,  431 => 266,  408 => 246,  311 => 152,  307 => 151,  292 => 139,  288 => 138,  284 => 137,  280 => 136,  275 => 134,  271 => 133,  267 => 132,  263 => 131,  256 => 127,  243 => 119,  235 => 114,  227 => 111,  223 => 110,  211 => 101,  207 => 100,  202 => 98,  198 => 97,  193 => 95,  189 => 94,  184 => 92,  174 => 85,  164 => 78,  136 => 53,  117 => 39,  111 => 38,  105 => 35,  101 => 34,  97 => 33,  93 => 32,  88 => 30,  84 => 29,  80 => 28,  76 => 27,  69 => 23,  59 => 16,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "rules.html.twig", "/var/www/html/system/templates/rules.html.twig");
    }
}
