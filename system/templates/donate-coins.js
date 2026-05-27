(function () {
  const form = document.getElementById('rdDonateForm');
  if (!form) return;

  const err = document.getElementById('rdError');
  const panels = {
    packages: document.getElementById('rdStepPackages'),
    gateway: document.getElementById('rdStepGateway'),
    form: document.getElementById('rdStepForm'),
  };

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
    document.getElementById('rdBtnPay').disabled = !ok;
  });

  form.addEventListener('submit', (e) => {
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
    }
  });
})();
