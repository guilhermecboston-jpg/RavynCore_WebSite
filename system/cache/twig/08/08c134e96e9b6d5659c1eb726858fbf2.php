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

/* content.html */
class __TwigTemplate_f9b2f8927f702e78d6365d6fcd8fd0dc extends \Twig\Template
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
        echo "<table style=\"border-collapse: collapse; width: 87.8471%; height: 57px;\" border=\"1\">
<tbody>
<tr style=\"height: 18px;\">
<td style=\"width: 33.3333%; background-color: #505050; height: 18px;\"><span style=\"color: #ffffff;\"><strong>Words</strong></span></td>
<td style=\"width: 33.3333%; background-color: #505050; height: 18px;\"><span style=\"color: #ffffff;\"><strong>Description</strong></span></td>
</tr>
<tr style=\"height: 18px; background-color: #f1e0c6;\">
<td style=\"width: 33.3333%; height: 18px;\"><em>!example</em></td>
<td style=\"width: 33.3333%; height: 18px;\">This is just an example</td>
</tr>
<tr style=\"height: 18px; background-color: #d4c0a1;\">
<td style=\"width: 33.3333%; height: 18px;\"><em>!buyhouse</em></td>
<td style=\"width: 33.3333%; height: 18px;\">Buy house you are looking at</td>
</tr>
<tr style=\"height: 18px; background-color: #f1e0c6;\">
<td style=\"width: 33.3333%; height: 18px;\"><em>!aol</em></td>
<td style=\"width: 33.3333%; height: 18px;\">Buy AoL</td>
</tr>
</tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "content.html";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "content.html", "");
    }
}
