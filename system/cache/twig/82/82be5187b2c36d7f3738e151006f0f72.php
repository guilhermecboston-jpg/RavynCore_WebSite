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

/* donate-final.css */
class __TwigTemplate_34a11b1cab032d1d9c78f632666dea2b extends \Twig\Template
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
        echo ".rd-final-wrap {
  max-width: 640px;
  margin: 28px auto 40px;
  padding: 0 16px;
}

.rd-final-card {
  background: linear-gradient(145deg, rgba(20, 28, 52, 0.95), rgba(12, 16, 32, 0.98));
  border: 1px solid #3a4f7a;
  border-radius: 16px;
  padding: 32px 28px;
  text-align: center;
  color: #dce8ff;
  box-shadow: 0 0 32px rgba(60, 80, 140, 0.2);
}

.rd-final-card.rd-final-approved {
  border-color: #3ecf7a;
  box-shadow: 0 0 36px rgba(62, 207, 122, 0.22);
}

.rd-final-icon {
  font-size: 48px;
  line-height: 1;
  margin-bottom: 12px;
}

.rd-final-title {
  margin: 0 0 14px;
  font-size: 1.5rem;
  color: #f0c86a;
}

.rd-final-approved .rd-final-title {
  color: #7dffb0;
}

.rd-final-message {
  margin: 0 0 16px;
  font-size: 15px;
  line-height: 1.55;
  color: #c8d6f8;
}

.rd-final-order {
  margin: 0 0 10px;
  font-size: 13px;
  color: #9aabd4;
}

.rd-final-redirect {
  margin: 0 0 20px;
  font-size: 13px;
  color: #b8c7ef;
  min-height: 1.2em;
}

.rd-final-actions {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
}

.rd-final-btn {
  display: inline-block;
  padding: 11px 20px;
  border-radius: 8px;
  font-weight: 700;
  text-decoration: none;
  background: linear-gradient(180deg, #f5d282, #cd9b38);
  color: #1a1205;
  border: 1px solid #7d5b1a;
}

.rd-final-btn-secondary {
  background: transparent;
  color: #dce8ff;
  border: 1px solid #4a5f8a;
}
";
    }

    public function getTemplateName()
    {
        return "donate-final.css";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "donate-final.css", "/var/www/html/system/templates/donate-final.css");
    }
}
