const API_BASE = (window.location.origin || 'http://177.55.153.178') + '/api/checkout';
const STEPS = ['packages', 'cart', 'gateway', 'identity', 'payment'];
const PACKAGES = [
  { id: 'pack_100', coins: 100, priceUsd: 10 },
  { id: 'pack_1000', coins: 1000, priceUsd: 100 },
  { id: 'pack_3150', coins: 3150, priceUsd: 300, popular: true },
  { id: 'pack_10500', coins: 10500, priceUsd: 1000 },
  { id: 'pack_73500', coins: 73500, priceUsd: 7000 },
  { id: 'pack_135000', coins: 135000, priceUsd: 10000 },
];
const MP_METHODS = [
  { id: 'credit_card', label: 'Novo Cartão (crédito ou pré-pago)' },
  { id: 'two_cards', label: '2 cartões de crédito' },
  { id: 'debit_card', label: 'Cartão de débito virtual CAIXA' },
  { id: 'pix', label: 'PIX' },
];
const STRIPE_METHODS = [
  { id: 'card', label: 'Cartão de crédito / débito' },
  { id: 'link', label: 'Link (Stripe)' },
];

const state = {
  step: 'packages',
  packageId: null,
  gateway: null,
  paymentMethod: null,
  isBrazil: true,
  fullName: '',
  birthDate: '',
  cpf: '',
  document: '',
  email: '',
  characterName: new URLSearchParams(location.search).get('char') || '',
};

const panel = document.getElementById('panel');
const errorEl = document.getElementById('error');
const stepNav = document.getElementById('stepNav');
const btnBack = document.getElementById('btnBack');
const btnNext = document.getElementById('btnNext');

function fmtCoins(n) {
  return n.toLocaleString('en-US');
}

function renderSteps() {
  const labels = ['Pacotes', 'Carrinho', 'Pagamento', 'Dados', 'Método'];
  const idx = STEPS.indexOf(state.step);
  stepNav.innerHTML = STEPS.map((s, i) => {
    let cls = '';
    if (i === idx) cls = 'active';
    else if (i < idx) cls = 'done';
    return `<span class="${cls}">${i + 1}. ${labels[i]}</span>`;
  }).join('');
  btnBack.style.visibility = idx > 0 && state.step !== 'processing' ? 'visible' : 'hidden';
  btnNext.textContent = state.step === 'payment' ? 'Pagar agora' : state.step === 'identity' ? 'Confirmar dados' : 'Continuar';
}

function render() {
  errorEl.textContent = '';
  renderSteps();
  const pack = PACKAGES.find((p) => p.id === state.packageId);

  if (state.step === 'packages') {
    panel.innerHTML = '<p>Selecione um pacote:</p>' + PACKAGES.map((p) => `
      <div class="package ${state.packageId === p.id ? 'selected' : ''}" data-id="${p.id}">
        <span>${fmtCoins(p.coins)} RavynCore Coins${p.popular ? ' ★' : ''}</span>
        <span>US$ ${p.priceUsd}</span>
      </div>`).join('');
    panel.querySelectorAll('.package').forEach((el) => {
      el.onclick = () => { state.packageId = el.dataset.id; render(); };
    });
  } else if (state.step === 'cart' && pack) {
    panel.innerHTML = `<div class="summary">
      <p><strong>Pacote:</strong> ${fmtCoins(pack.coins)} RavynCore Coins</p>
      <p><strong>Valor:</strong> US$ ${pack.priceUsd}</p>
      <p><strong>Personagem:</strong> ${state.characterName || '—'}</p>
    </div>`;
  } else if (state.step === 'gateway') {
    panel.innerHTML = `<p>Escolha o gateway:</p>
      <div class="gateway-row">
        <div class="gateway ${state.gateway === 'mercadopago' ? 'selected' : ''}" data-gw="mercadopago">Mercado Pago</div>
        <div class="gateway ${state.gateway === 'stripe' ? 'selected' : ''}" data-gw="stripe">Stripe</div>
      </div>`;
    panel.querySelectorAll('.gateway').forEach((el) => {
      el.onclick = () => { state.gateway = el.dataset.gw; state.paymentMethod = null; render(); };
    });
  } else if (state.step === 'identity') {
    panel.innerHTML = `
      <label><input type="radio" name="reg" ${state.isBrazil ? 'checked' : ''} /> Brasil (CPF)</label>
      <label><input type="radio" name="reg" ${!state.isBrazil ? 'checked' : ''} /> Internacional</label>
      <label>Nome completo</label><input id="fullName" type="text" value="${state.fullName}" />
      <label>Data de nascimento (DD/MM/AAAA)</label><input id="birthDate" type="text" value="${state.birthDate}" />
      ${state.isBrazil
        ? '<label>CPF</label><input id="cpf" type="text" value="' + state.cpf + '" />'
        : '<label>Documento</label><input id="document" type="text" value="' + state.document + '" />'}
      <label>E-mail</label><input id="email" type="email" value="${state.email}" />
    `;
    const radios = panel.querySelectorAll('input[name="reg"]');
    radios[0].onchange = () => { state.isBrazil = true; render(); };
    radios[1].onchange = () => { state.isBrazil = false; render(); };
  } else if (state.step === 'payment') {
    const methods = state.gateway === 'stripe' ? STRIPE_METHODS : MP_METHODS;
    panel.innerHTML = '<p>Forma de pagamento:</p>' + methods.map((m) => `
      <div class="pay-method ${state.paymentMethod === m.id ? 'selected' : ''}" data-mid="${m.id}">${m.label}</div>`).join('');
    panel.querySelectorAll('.pay-method').forEach((el) => {
      el.onclick = () => { state.paymentMethod = el.dataset.mid; render(); };
    });
  }
}

function validate() {
  const pack = PACKAGES.find((p) => p.id === state.packageId);
  if (state.step === 'packages' && !pack) return 'Selecione um pacote.';
  if (state.step === 'gateway' && !state.gateway) return 'Selecione o gateway.';
  if (state.step === 'identity') {
    state.fullName = document.getElementById('fullName')?.value || '';
    state.birthDate = document.getElementById('birthDate')?.value || '';
    state.email = document.getElementById('email')?.value || '';
    state.cpf = document.getElementById('cpf')?.value || '';
    state.document = document.getElementById('document')?.value || '';
    if (state.fullName.trim().length < 3) return 'Nome inválido.';
    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(state.birthDate)) return 'Data inválida.';
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(state.email)) return 'E-mail inválido.';
    if (state.isBrazil && state.cpf.replace(/\D/g, '').length !== 11) return 'CPF inválido.';
    if (!state.isBrazil && state.document.trim().length < 4) return 'Documento inválido.';
  }
  if (state.step === 'payment' && !state.paymentMethod) return 'Selecione o método.';
  return '';
}

async function pay() {
  const pack = PACKAGES.find((p) => p.id === state.packageId);
  panel.innerHTML = '<p>Redirecionando ao gateway...</p>';
  const res = await fetch(API_BASE + '/create.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      packageId: state.packageId,
      coins: pack.coins,
      amountUsd: pack.priceUsd,
      gateway: state.gateway,
      paymentMethod: state.paymentMethod,
      region: state.isBrazil ? 'BR' : 'INTL',
      fullName: state.fullName,
      birthDate: state.birthDate,
      cpf: state.cpf,
      document: state.document,
      email: state.email,
      characterName: state.characterName,
      accountId: 0,
    }),
  });
  const data = await res.json();
  if (data.error) {
    errorEl.textContent = data.error;
    state.step = 'payment';
    render();
    return;
  }
  location.href = data.redirectUrl || data.init_point;
}

btnBack.onclick = () => {
  const i = STEPS.indexOf(state.step);
  if (i > 0) { state.step = STEPS[i - 1]; render(); }
};

btnNext.onclick = async () => {
  const err = validate();
  if (err) { errorEl.textContent = err; return; }
  if (state.step === 'payment') {
    await pay();
    return;
  }
  const i = STEPS.indexOf(state.step);
  if (i < STEPS.length - 1) {
    state.step = STEPS[i + 1];
    render();
  }
};

render();
