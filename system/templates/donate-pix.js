(function () {
  document.querySelectorAll('[data-copy-target]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-copy-target');
      const el = document.getElementById(id);
      if (!el) return;
      const text = el.value !== undefined ? el.value : el.textContent;
      navigator.clipboard.writeText(text).then(() => {
        const old = btn.textContent;
        btn.textContent = 'Copiado!';
        setTimeout(() => {
          btn.textContent = old;
        }, 1600);
      }).catch(() => {
        if (el.select) {
          el.select();
          document.execCommand('copy');
        }
      });
    });
  });

  const statusEl = document.getElementById('rdPixStatus');
  if (!statusEl || statusEl.classList.contains('rd-pix-status-paid')) {
    return;
  }

  const params = new URLSearchParams(window.location.search);
  const order = params.get('order');
  if (!order) return;

  setInterval(() => {
    fetch(window.location.href, { credentials: 'same-origin', cache: 'no-store' })
      .then((r) => r.text())
      .then((html) => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        const next = doc.getElementById('rdPixStatus');
        if (!next) return;
        if (next.classList.contains('rd-pix-status-paid')) {
          window.location.reload();
        }
      })
      .catch(() => {});
  }, 15000);
})();
