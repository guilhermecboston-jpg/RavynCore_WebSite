(function () {
    var navToggle = document.getElementById('rcNavToggle');
    var nav = document.getElementById('rcNav');
    var mainGrid = document.querySelector('.rc-main-grid');

    if (navToggle && nav) {
        navToggle.addEventListener('click', function () {
            nav.classList.toggle('is-open');
        });
    }

    if (nav && mainGrid) {
        var topNavLinks = nav.querySelectorAll('.rc-nav-item > a');

        function isModifiedClick(event) {
            return event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey;
        }

        topNavLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                if (isModifiedClick(event)) {
                    return;
                }

                if (link.getAttribute('target') === '_blank') {
                    return;
                }

                var href = link.getAttribute('href');
                if (!href || href === '#') {
                    event.preventDefault();
                    mainGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    return;
                }

                var targetUrl;
                try {
                    targetUrl = new URL(href, window.location.href);
                } catch (error) {
                    return;
                }

                var currentUrl = new URL(window.location.href);
                var sameDocument = targetUrl.origin === currentUrl.origin &&
                    targetUrl.pathname === currentUrl.pathname &&
                    targetUrl.search === currentUrl.search &&
                    targetUrl.hash === currentUrl.hash;

                if (sameDocument) {
                    event.preventDefault();
                    mainGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    var countdownNode = document.getElementById('rcServerSaveCountdown');
    if (!countdownNode) {
        return;
    }

    function pad(value) {
        return value < 10 ? '0' + value : String(value);
    }

    function formatLeft(ms) {
        var hours = Math.floor(ms / (1000 * 60 * 60));
        var minutes = Math.floor((ms % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((ms % (1000 * 60)) / 1000);

        return pad(hours) + ':' + pad(minutes) + ':' + pad(seconds);
    }

    var targetIso = countdownNode.getAttribute('data-target');
    if (!targetIso) {
        return;
    }

    var target = new Date(targetIso).getTime();

    function updateCountdown() {
        var now = Date.now();
        var diff = target - now;

        if (diff <= 0) {
            target += 24 * 60 * 60 * 1000;
            diff = target - now;
        }

        countdownNode.textContent = formatLeft(diff);
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
