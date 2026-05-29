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

/* donate-coins.html.twig */
class __TwigTemplate_25d562f6f647627356c3696ab8fc5e10 extends \Twig\Template
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
        $this->loadTemplate("donate-coins.css", "donate-coins.html.twig", 2)->display($context);
        // line 3
        echo "</style>

<div class=\"rd-donate-wrap\">
  <a class=\"rd-fixed-back\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, twig_constant("BASE_URL"), "html", null, true);
        echo "\">← Voltar ao Site</a>

  <header class=\"rd-donate-header rd-fade-in\">
    <h1 class=\"rd-title\">COMPRAR RAVYNCORE COINS</h1>
    <p class=\"rd-subtitle\">As coins são entregues automaticamente após a confirmação do pagamento.</p>
    <div class=\"rd-account-bar\">Conta: <strong>";
        // line 11
        echo twig_escape_filter($this->env, ($context["account_name"] ?? null), "html", null, true);
        echo "</strong></div>
  </header>

  <div id=\"rdError\" class=\"rd-error\" style=\"display:none\"></div>

  <form id=\"rdDonateForm\" method=\"post\" action=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["pay_url"] ?? null), "html", null, true);
        echo "\" data-stripe-ready=\"";
        echo ((($context["stripe_ready"] ?? null)) ? ("1") : ("0"));
        echo "\">
    <input type=\"hidden\" name=\"package_id\" id=\"rdPackageId\" value=\"\" />
    <input type=\"hidden\" name=\"gateway\" id=\"rdGateway\" value=\"\" />
    <input type=\"hidden\" name=\"terms_agree\" id=\"rdTermsAgree\" value=\"0\" />

    <section id=\"rdStepPackages\" class=\"rd-panel active rd-fade-in\">
      <h2 class=\"rd-panel-title\">Escolha seu pacote</h2>
      <div class=\"rd-packages\">
        ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["packages"] ?? null));
        foreach ($context['_seq'] as $context["id"] => $context["pack"]) {
            // line 25
            echo "          <button type=\"button\" class=\"rd-package-card";
            if (twig_get_attribute($this->env, $this->source, $context["pack"], "popular", [], "any", false, false, false, 25)) {
                echo " popular";
            }
            echo "\" data-package=\"";
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\" data-coins=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pack"], "coins", [], "any", false, false, false, 25), "html", null, true);
            echo "\" data-brl=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pack"], "brl", [], "any", false, false, false, 25), "html", null, true);
            echo "\">
            ";
            // line 26
            if (twig_get_attribute($this->env, $this->source, $context["pack"], "popular", [], "any", false, false, false, 26)) {
                echo "<span class=\"rd-badge\">Popular</span>";
            }
            // line 27
            echo "            <span class=\"rd-selected-tag\">Selecionado</span>
            <div class=\"rd-coin-icon\"><img src=\"images/payments/coins.png\" alt=\"Coins\" /></div>
            <div class=\"rd-coins\">";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pack"], "label", [], "any", false, false, false, 29), "html", null, true);
            echo "</div>
            <div class=\"rd-price\">R\$ ";
            // line 30
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pack"], "brl", [], "any", false, false, false, 30), 0, ",", "."), "html", null, true);
            echo "</div>
          </button>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['pack'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "      </div>
    </section>

    <section id=\"rdStepGateway\" class=\"rd-panel rd-fade-in\">
      <div class=\"rd-card-box rd-pay-box\">
        <h2 class=\"rd-panel-title\">Selecione o método de pagamento</h2>
        <div class=\"rd-gateways\">
          ";
        // line 40
        if (($context["has_mercado_pago"] ?? null)) {
            // line 41
            echo "          <button type=\"button\" class=\"rd-gateway-card\" data-gateway=\"mercadopago\">
            <div class=\"rd-gw-logo rd-gw-logo-mp\"><img class=\"rd-gw-logo-img rd-gw-logo-img-mp\" src=\"images/payments/mercadopago.png\" alt=\"MercadoPago\" /></div>
            <div class=\"rd-gw-name\">MercadoPago</div>
          </button>
          ";
        }
        // line 46
        echo "          ";
        if (($context["has_stripe"] ?? null)) {
            // line 47
            echo "          <button type=\"button\" class=\"rd-gateway-card";
            if ( !($context["stripe_ready"] ?? null)) {
                echo " rd-gateway-card-disabled";
            }
            echo "\" data-gateway=\"stripe\"";
            if ( !($context["stripe_ready"] ?? null)) {
                echo " title=\"Stripe: configure secretKey em config.local.php\"";
            }
            echo ">
            <div class=\"rd-gw-logo\"><img class=\"rd-gw-logo-img\" src=\"images/payments/stripe.svg\" alt=\"Stripe\" style=\"max-height:46px;max-width:140px;width:auto;height:auto;object-fit:contain;display:block;margin:0 auto;\" /></div>
            <div class=\"rd-gw-name\">Stripe</div>
            <div class=\"rd-gw-sub\">Cartão internacional</div>
          </button>
          ";
        }
        // line 53
        echo "          ";
        if (($context["has_pix"] ?? null)) {
            // line 54
            echo "          <button type=\"button\" class=\"rd-gateway-card\" data-gateway=\"pix\">
            <div class=\"rd-gw-logo\"><img class=\"rd-gw-logo-img\" src=\"images/payments/pix.svg\" alt=\"Pix\" style=\"max-height:46px;max-width:140px;width:auto;height:auto;object-fit:contain;display:block;margin:0 auto;\" /></div>
            <div class=\"rd-gw-name\">PIX</div>
            <small class=\"rd-pix-note\">Pagamento instantâneo</small>
          </button>
          ";
        }
        // line 60
        echo "        </div>
      </div>
    </section>

    <section id=\"rdStepForm\" class=\"rd-panel rd-fade-in\">
      <div class=\"rd-card-box rd-buyer-box\">
        <div class=\"rd-box-title\">Dados do Comprador</div>
        <div class=\"rd-form-grid\">
          <label class=\"rd-radio\"><input type=\"radio\" name=\"region\" value=\"BR\" checked /> Brasil (CPF)</label>
          <label class=\"rd-radio\"><input type=\"radio\" name=\"region\" value=\"INTL\" /> Internacional (documento)</label>
          <label>Nome completo<input type=\"text\" name=\"full_name\" required maxlength=\"128\" /></label>
          <label id=\"rdLabelCpf\">CPF<input type=\"text\" name=\"cpf\" id=\"rdCpf\" placeholder=\"000.000.000-00\" maxlength=\"18\" /></label>
          <label id=\"rdLabelDoc\" style=\"display:none\">Documento<input type=\"text\" name=\"document\" id=\"rdDocument\" maxlength=\"64\" /></label>
          <label>Data de nascimento<input type=\"text\" name=\"birth_date\" id=\"rdBirthDate\" placeholder=\"DD/MM/AAAA\" required maxlength=\"10\" /></label>
          <label>E-mail<input type=\"email\" name=\"email\" required maxlength=\"128\" /></label>
        </div>
      </div>

      <div class=\"rd-card-box rd-terms-box\">
        <div class=\"rd-box-title\">Termos e Condições</div>
        <p class=\"rd-terms-warn\">Se você não concorda com estes termos, não está autorizado a realizar doações/pagamentos.</p>
        <p>Ao realizar uma doação/pagamento, você reconhece e concorda integralmente com estes Termos e Condições.</p>
        <ul>
          <li>Se você tiver menos de 18 anos, deverá possuir autorização de um responsável legal antes de realizar qualquer doação/pagamento.</li>
          <li>Você somente poderá realizar doações/pagamentos utilizando fundos que pertençam legalmente a você ou que esteja autorizado a utilizar.</li>
          <li>Todos os pagamentos são contribuições voluntárias destinadas ao suporte do servidor. Nenhum bem físico será enviado, e nenhum direito de propriedade será transferido.</li>
          <li>Quaisquer benefícios, recompensas, cargos, moedas virtuais ou itens fornecidos são considerados incentivos bônus e não produtos ou serviços garantidos.</li>
          <li>Todas as recompensas de doações/pagamentos são entregues automaticamente e, na maioria dos casos, instantaneamente após a confirmação do pagamento.</li>
          <li>Ao concluir um pagamento, você reconhece que receberá suas recompensas imediatamente e renuncia ao direito de alegar que o produto/serviço não foi entregue.</li>
          <li>Recompensas de doações/pagamentos poderão ser modificadas, substituídas, atrasadas ou removidas a qualquer momento, sem aviso prévio.</li>
          <li>O servidor poderá ser resetado, reiniciado, alterado ou sofrer wipe a qualquer momento por motivos operacionais ou de manutenção. Nesses casos, as recompensas poderão ser restauradas a critério da administração, sem garantia obrigatória.</li>
          <li>Você reconhece que itens digitais, cargos, benefícios ou moedas virtuais podem sofrer alterações, perder valor ou tornar-se indisponíveis ao longo do tempo.</li>
          <li>Caso recompensas sejam perdidas devido à jogabilidade, bugs, atualizações ou resets do servidor, a restauração não é garantida.</li>
          <li>Reservamo-nos o direito de suspender ou encerrar contas que violem as regras do servidor, sem direito a reembolso.</li>
          <li>Todas as doações/pagamentos são finais e não reembolsáveis, salvo quando exigido pela legislação aplicável.</li>
          <li>Ao concluir um pagamento, você renuncia ao direito de solicitar chargeback, contestação ou disputa de pagamento após o recebimento das recompensas virtuais.</li>
          <li>Tentativas de chargeback, disputa ou fraude após o recebimento das recompensas poderão resultar em suspensão permanente da conta e revogação de todos os benefícios associados.</li>
          <li>Reservamo-nos o direito de atualizar ou modificar estes Termos e Condições a qualquer momento, sem aviso prévio.</li>
        </ul>
        <p class=\"rd-lgpd\">RavynCore Games declara que segue os princípios e padrões de segurança estabelecidos pela Lei Geral de Proteção de Dados (LGPD – Lei nº 13.709/2018), adotando medidas voltadas à proteção dos dados pessoais, privacidade e segurança das informações de seus usuários.</p>
        <p class=\"rd-terms-version\">Versão dos termos: ";
        // line 100
        echo twig_escape_filter($this->env, ($context["terms_version"] ?? null), "html", null, true);
        echo "</p>
      </div>

      <label class=\"rd-terms-check\">
        <input type=\"checkbox\" id=\"rdTermsCheckbox\" />
        Eu aceito os Termos e Condições
      </label>

      <div class=\"rd-actions rd-actions-pay\">
        <button type=\"submit\" class=\"rd-btn rd-btn-primary\" id=\"rdBtnPay\" disabled>PAGAR AGORA</button>
      </div>
    </section>
  </form>

  <div id=\"rdPixModal\" class=\"rd-pix-modal\" hidden aria-hidden=\"true\">
    <div class=\"rd-pix-modal-backdrop\" data-close-pix-modal></div>
    <div class=\"rd-pix-modal-panel\" role=\"dialog\" aria-labelledby=\"rdPixModalTitle\">
      <button type=\"button\" class=\"rd-pix-modal-close\" data-close-pix-modal aria-label=\"Fechar\">&times;</button>
      <h2 id=\"rdPixModalTitle\" class=\"rd-pix-modal-title\">Pagamento PIX</h2>
      <p class=\"rd-pix-modal-sub\">Escaneie o QR Code ou copie o código abaixo.</p>
      <div class=\"rd-pix-modal-summary\">
        <div><span>Pedido</span><strong id=\"rdPixOrderRef\">—</strong></div>
        <div><span>Coins</span><strong id=\"rdPixCoins\">—</strong></div>
        <div><span>Valor</span><strong id=\"rdPixAmount\" class=\"rd-pix-modal-amount\">—</strong></div>
      </div>
      <div class=\"rd-pix-modal-qr-wrap\">
        <img id=\"rdPixQrImg\" class=\"rd-pix-modal-qr\" src=\"\" alt=\"QR Code PIX\" />
      </div>
      <div class=\"rd-pix-success-panel\" id=\"rdPixSuccessPanel\" hidden>
        <div class=\"rd-pix-success-icon\">✅</div>
        <h3 class=\"rd-pix-success-title\">Pagamento APROVADO!</h3>
        <p class=\"rd-pix-success-text\" id=\"rdPixSuccessText\"></p>
        <p class=\"rd-pix-success-redirect\" id=\"rdPixSuccessRedirect\"></p>
      </div>
      <div class=\"rd-pix-status-box\" id=\"rdPixStatusBox\">
        <div class=\"rd-pix-status-icon\" id=\"rdPixStatusIcon\">⏳</div>
        <div>
          <div class=\"rd-pix-status-title\" id=\"rdPixStatusTitle\">Aguardando pagamento</div>
          <div class=\"rd-pix-status-message\" id=\"rdPixStatusMessage\">Escaneie o QR Code ou use o código Copia e Cola.</div>
        </div>
      </div>
      <div class=\"rd-pix-modal-code-wrap\">
        <span>Código Pix Copia e Cola</span>
        <textarea id=\"rdPixCodeText\" readonly rows=\"4\"></textarea>
        <button type=\"button\" class=\"rd-btn rd-btn-primary rd-pix-copy-btn\" data-copy=\"rdPixCodeText\">Copiar código PIX</button>
      </div>
      <p class=\"rd-pix-modal-hint\">Após pagar, a confirmação é automática (até 2 minutos).</p>
    </div>
  </div>
</div>

<script>
";
        // line 152
        $this->loadTemplate("donate-coins.js", "donate-coins.html.twig", 152)->display($context);
        // line 153
        echo "</script>
";
    }

    public function getTemplateName()
    {
        return "donate-coins.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  261 => 153,  259 => 152,  204 => 100,  162 => 60,  154 => 54,  151 => 53,  135 => 47,  132 => 46,  125 => 41,  123 => 40,  114 => 33,  105 => 30,  101 => 29,  97 => 27,  93 => 26,  80 => 25,  76 => 24,  63 => 16,  55 => 11,  47 => 6,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "donate-coins.html.twig", "/var/www/html/system/templates/donate-coins.html.twig");
    }
}
