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

/* donate-final.html.twig */
class __TwigTemplate_87f748e5097e041a9ea0b1bf1c7c3d9f extends \Twig\Template
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
";
        // line 2
        $this->loadTemplate("donate-final.css", "donate-final.html.twig", 2)->display($context);
        // line 3
        echo "</style>

<div class=\"rd-final-wrap\">
  <div class=\"rd-final-card\" id=\"rdFinalCard\">
    <div class=\"rd-final-icon\" id=\"rdFinalIcon\">";
        // line 7
        if ((($context["ui_state"] ?? null) == "approved")) {
            echo "✅";
        } elseif ((($context["ui_state"] ?? null) == "rejected")) {
            echo "❌";
        } else {
            echo "🔄";
        }
        echo "</div>
    <h1 class=\"rd-final-title\" id=\"rdFinalTitle\">
      ";
        // line 9
        if ((($context["ui_state"] ?? null) == "approved")) {
            echo "Pagamento APROVADO!";
        } elseif ((($context["ui_state"] ?? null) == "rejected")) {
            echo "Pagamento não confirmado";
        } else {
            echo "Confirmando pagamento...";
        }
        // line 10
        echo "    </h1>
    <p class=\"rd-final-message\" id=\"rdFinalMessage\">
      ";
        // line 12
        if ((($context["ui_state"] ?? null) == "approved")) {
            // line 13
            echo "        Obrigado! Adicionado em sua account: ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["coins"] ?? null), 0, ",", "."), "html", null, true);
            echo " RavynCore Coins e ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["loyalty_points"] ?? null), 0, ",", "."), "html", null, true);
            echo " Loyalty Points.
      ";
        } elseif ((        // line 14
($context["ui_state"] ?? null) == "rejected")) {
            // line 15
            echo "        Não foi possível confirmar o pagamento. Se já pagou, aguarde alguns minutos ou entre em contato com o suporte.
      ";
        } else {
            // line 17
            echo "        Aguarde enquanto confirmamos seu pagamento com o gateway...
      ";
        }
        // line 19
        echo "    </p>
    <p class=\"rd-final-order\">Pedido: <strong>";
        // line 20
        echo twig_escape_filter($this->env, ($context["order_ref"] ?? null), "html", null, true);
        echo "</strong>";
        if (($context["gateway"] ?? null)) {
            echo " · ";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, ($context["gateway"] ?? null)), "html", null, true);
        }
        echo "</p>
    <p class=\"rd-final-redirect\" id=\"rdFinalRedirect\"></p>
    <div class=\"rd-final-actions\">
      <a class=\"rd-final-btn\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, ($context["account_manage_url"] ?? null), "html", null, true);
        echo "\">Minha conta</a>
      <a class=\"rd-final-btn rd-final-btn-secondary\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["donate_url"] ?? null), "html", null, true);
        echo "\">Nova doação</a>
    </div>
  </div>
</div>

<script>
(function () {
  const statusUrl = ";
        // line 31
        echo json_encode(((array_key_exists("status_url", $context)) ? (_twig_default_filter(($context["status_url"] ?? null), "")) : ("")));
        echo ";
  const initialState = ";
        // line 32
        echo json_encode(((array_key_exists("ui_state", $context)) ? (_twig_default_filter(($context["ui_state"] ?? null), "processing")) : ("processing")));
        echo ";
  const initialCoins = ";
        // line 33
        echo twig_escape_filter($this->env, ((array_key_exists("coins", $context)) ? (_twig_default_filter(($context["coins"] ?? null), 0)) : (0)), "html", null, true);
        echo ";
  const initialLoyalty = ";
        // line 34
        echo twig_escape_filter($this->env, ((array_key_exists("loyalty_points", $context)) ? (_twig_default_filter(($context["loyalty_points"] ?? null), 0)) : (0)), "html", null, true);
        echo ";
  const accountUrl = ";
        // line 35
        echo json_encode(($context["account_manage_url"] ?? null));
        echo ";

  const iconEl = document.getElementById('rdFinalIcon');
  const titleEl = document.getElementById('rdFinalTitle');
  const messageEl = document.getElementById('rdFinalMessage');
  const redirectEl = document.getElementById('rdFinalRedirect');
  const cardEl = document.getElementById('rdFinalCard');

  function formatNum(n) {
    return Number(n || 0).toLocaleString('pt-BR');
  }

  function showApproved(coins, loyalty) {
    cardEl.classList.add('rd-final-approved');
    iconEl.textContent = '✅';
    titleEl.textContent = 'Pagamento APROVADO!';
    messageEl.textContent = 'Obrigado! Adicionado em sua account: ' + formatNum(coins)
      + ' RavynCore Coins e ' + formatNum(loyalty) + ' Loyalty Points.';
  }

  function showProcessing() {
    cardEl.classList.remove('rd-final-approved');
    iconEl.textContent = '🔄';
    titleEl.textContent = 'Confirmando pagamento...';
    messageEl.textContent = 'Aguarde enquanto confirmamos seu pagamento com o gateway...';
  }

  let redirectTimer = null;
  function scheduleRedirect(seconds) {
    let left = Math.max(5, Number(seconds || 12));
    redirectEl.textContent = 'Redirecionando para sua conta em ' + left + 's...';
    redirectTimer = setInterval(function () {
      left -= 1;
      if (left <= 0) {
        clearInterval(redirectTimer);
        window.location.href = accountUrl;
        return;
      }
      redirectEl.textContent = 'Redirecionando para sua conta em ' + left + 's...';
    }, 1000);
  }

  async function poll() {
    if (!statusUrl) return;
    try {
      const url = statusUrl + (statusUrl.indexOf('?') >= 0 ? '&' : '?') + '_ts=' + Date.now();
      const res = await fetch(url, {
        credentials: 'same-origin',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        cache: 'no-store',
      });
      const data = await res.json();
      if (!data || !data.ok) return;
      if (data.ui_state === 'approved' || Number(data.delivered) === 1 || data.order_status === 'paid') {
        showApproved(data.coins ?? initialCoins, data.loyalty_points ?? initialLoyalty);
        if (!redirectTimer) scheduleRedirect(12);
        return true;
      }
      if (data.ui_state === 'rejected') {
        iconEl.textContent = '❌';
        titleEl.textContent = 'Pagamento não confirmado';
        messageEl.textContent = 'Não foi possível confirmar o pagamento.';
        return true;
      }
    } catch (e) { /* ignore */ }
    return false;
  }

  if (initialState === 'approved') {
    showApproved(initialCoins, initialLoyalty);
    scheduleRedirect(12);
  } else if (statusUrl) {
    poll();
    const timer = setInterval(async function () {
      const done = await poll();
      if (done) clearInterval(timer);
    }, 3000);
    setTimeout(function () { clearInterval(timer); }, 120000);
  }
})();
</script>
";
    }

    public function getTemplateName()
    {
        return "donate-final.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 35,  130 => 34,  126 => 33,  122 => 32,  118 => 31,  108 => 24,  104 => 23,  93 => 20,  90 => 19,  86 => 17,  82 => 15,  80 => 14,  73 => 13,  71 => 12,  67 => 10,  59 => 9,  48 => 7,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "donate-final.html.twig", "/var/www/html/system/templates/donate-final.html.twig");
    }
}
