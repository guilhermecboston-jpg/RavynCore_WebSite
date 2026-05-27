(function () {
  const form = document.getElementById('rdDonateForm');
  if (!form) return;

  const err = document.getElementById('rdError');
  const panels = {
    packages: document.getElementById('rdStepPackages'),
    gateway: document.getElementById('rdStepGateway'),
    form: document.getElementById('rdStepForm'),
  };

  const pixModal = document.getElementById('rdPixModal');
  const payBtn = document.getElementById('rdBtnPay');

  function showError(msg) {
    err.textContent = msg;
    err.style.display = msg ? 'block' : 'none';
  }

  function setStep(step) {
    Object.keys(panels).forEach((k) => panels[k].classList.toggle('active', k === step));
    showError('');
  }

  function formatBirthDateInput(raw) {
    const digits = String(raw || '').replace(/\D/g, '');
    if (digits.length === 8) {
      return digits.slice(0, 2) + '/' + digits.slice(2, 4) + '/' + digits.slice(4, 8);
    }
    if (/^\d{2}\/\d{2}\/\d{4}$/.test(String(raw || '').trim())) {
      return String(raw).trim();
    }
    return String(raw || '').trim();
  }

  const birthInput = document.getElementById('rdBirthDate');
  if (birthInput) {
    birthInput.addEventListener('blur', () => {
      birthInput.value = formatBirthDateInput(birthInput.value);
    });
  }

  document.querySelectorAll('.rd-package-card').forEach((btn) => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.rd-package-card').forEach((b) => b.classList.remove('selected'));
      btn.classList.add('selected');
      document.getElementById('rdPackageId').value = btn.dataset.package;
      setStep('gateway');
    });
  });

  document.querySelectorAll('.rd-gateway-card').forEach((btn) => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.rd-gateway-card').forEach((b) => b.classList.remove('selected'));
      btn.classList.add('selected');
      document.getElementById('rdGateway').value = btn.dataset.gateway;
      setStep('form');
    });
  });

  document.querySelectorAll('input[name="region"]').forEach((radio) => {
    radio.addEventListener('change', () => {
      const br = document.querySelector('input[name="region"]:checked').value === 'BR';
      document.getElementById('rdLabelCpf').style.display = br ? '' : 'none';
      document.getElementById('rdLabelDoc').style.display = br ? 'none' : '';
      document.getElementById('rdCpf').required = br;
      document.getElementById('rdDocument').required = !br;
    });
  });

  document.getElementById('rdTermsCheckbox').addEventListener('change', (e) => {
    const ok = e.target.checked;
    document.getElementById('rdTermsAgree').value = ok ? '1' : '0';
    payBtn.disabled = !ok;
  });

  function openPixModal(data) {
    document.getElementById('rdPixOrderRef').textContent = data.order_ref || '—';
    document.getElementById('rdPixCoins').textContent = data.coins != null ? String(data.coins) : '—';
    document.getElementById('rdPixAmount').textContent = data.amount_label || '—';

    const qrImg = document.getElementById('rdPixQrImg');
    if (data.qr_code_base64) {
      qrImg.src = 'data:image/png;base64,' + data.qr_code_base64;
    } else if (data.qr_image) {
      qrImg.src = data.qr_image;
    } else {
      qrImg.removeAttribute('src');
    }

    const keyWrap = document.getElementById('rdPixKeyWrap');
    const keyText = document.getElementById('rdPixKeyText');
    if (data.pix_key) {
      keyWrap.hidden = false;
      keyText.textContent = data.pix_key;
    } else {
      keyWrap.hidden = true;
    }

    document.getElementById('rdPixCodeText').value = data.qr_code || '';

    pixModal.hidden = false;
    pixModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closePixModal() {
    pixModal.hidden = true;
    pixModal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('[data-close-pix-modal]').forEach((el) => {
    el.addEventListener('click', closePixModal);
  });

  document.querySelectorAll('.rd-pix-copy-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-copy');
      const el = document.getElementById(targetId);
      if (!el) return;
      const text = el.value !== undefined ? el.value : el.textContent;
      navigator.clipboard.writeText(text).then(() => {
        const old = btn.textContent;
        btn.textContent = 'Copiado!';
        setTimeout(() => { btn.textContent = old; }, 1500);
      }).catch(() => {
        if (el.select) {
          el.select();
          document.execCommand('copy');
        }
      });
    });
  });

  form.addEventListener('submit', async (e) => {
    if (birthInput) {
      birthInput.value = formatBirthDateInput(birthInput.value);
    }
    if (!document.getElementById('rdPackageId').value || !document.getElementById('rdGateway').value) {
      e.preventDefault();
      showError('Selecione pacote e método de pagamento.');
      return;
    }
    if (document.getElementById('rdTermsAgree').value !== '1') {
      e.preventDefault();
      showError('Você precisa aceitar os termos para pagar.');
      return;
    }

    const gateway = document.getElementById('rdGateway').value;
    if (gateway !== 'pix') {
      return;
    }

    e.preventDefault();
    showError('');
    payBtn.classList.add('rd-btn-pay-loading');
    payBtn.disabled = true;

    const fd = new FormData(form);
    fd.append('response_format', 'json');

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        body: fd,
        credentials: 'same-origin',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      });
      const data = await res.json();
      if (!data.ok) {
        showError(data.error || 'Não foi possível gerar o PIX.');
        return;
      }
      openPixModal(data);
    } catch (ex) {
      showError('Erro ao processar PIX. Tente novamente.');
    } finally {
      payBtn.classList.remove('rd-btn-pay-loading');
      payBtn.disabled = document.getElementById('rdTermsAgree').value !== '1';
    }
  });
})();
