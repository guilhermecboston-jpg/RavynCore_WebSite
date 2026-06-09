(function () {
    var navToggle = document.getElementById('rcNavToggle');
    var nav = document.getElementById('rcNav');
    var header = document.querySelector('.rc-header');
    var mobileQuery = window.matchMedia('(max-width: 1140px)');

    function syncNavTop() {
        if (!nav || !header) return;
        if (mobileQuery.matches) {
            nav.style.setProperty('--rc-nav-top', header.offsetHeight + 'px');
        } else {
            nav.style.removeProperty('--rc-nav-top');
        }
    }

    function setToggleIcon(isOpen) {
        if (!navToggle) return;
        var icon = navToggle.querySelector('i');
        if (!icon) return;
        icon.classList.toggle('fa-bars', !isOpen);
        icon.classList.toggle('fa-xmark', isOpen);
    }

    function closeNav() {
        if (!nav) return;
        nav.classList.remove('is-open');
        document.body.classList.remove('rc-nav-locked');
        if (navToggle) {
            navToggle.classList.remove('is-active');
            navToggle.setAttribute('aria-expanded', 'false');
        }
        setToggleIcon(false);
    }

    function openNav() {
        if (!nav) return;
        syncNavTop();
        nav.classList.add('is-open');
        document.body.classList.add('rc-nav-locked');
        if (navToggle) {
            navToggle.classList.add('is-active');
            navToggle.setAttribute('aria-expanded', 'true');
        }
        setToggleIcon(true);
    }

    if (navToggle && nav) {
        navToggle.setAttribute('aria-controls', 'rcNav');
        navToggle.setAttribute('aria-expanded', 'false');

        navToggle.addEventListener('click', function () {
            if (nav.classList.contains('is-open')) {
                closeNav();
            } else {
                openNav();
            }
        });

        nav.addEventListener('click', function (event) {
            var target = event.target;
            while (target && target !== nav) {
                if (target.tagName === 'A') {
                    closeNav();
                    return;
                }
                target = target.parentNode;
            }
        });

        window.addEventListener('resize', function () {
            if (!mobileQuery.matches) {
                closeNav();
            } else if (nav.classList.contains('is-open')) {
                syncNavTop();
            }
        });
    }

    var communityLinks = document.querySelectorAll('[data-rc-community-link]');
    var socialContainer = document.getElementById('rcSocialLinks');
    if (communityLinks.length && socialContainer) {
        communityLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                socialContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                socialContainer.classList.add('is-highlight');
                setTimeout(function () {
                    socialContainer.classList.remove('is-highlight');
                }, 1200);
            });
        });
    }

    document.querySelectorAll('[data-rc-letters-only]').forEach(function (input) {
        input.addEventListener('input', function () {
            input.value = input.value.replace(/[^A-Za-z\s]/g, '');
        });
    });

    if (document.body.classList.contains('rc-page-accountmanagement')) {
        document.querySelectorAll('.rc-rich-content input[type="text"]').forEach(function (input) {
            var row = input.closest('tr');
            var cell = input.closest('td');
            if (!row || !cell) {
                return;
            }

            var rowText = (row.textContent || '').toLowerCase();
            var cellText = (cell.textContent || '').toLowerCase();
            if (rowText.indexOf('character name') !== -1 || cellText.indexOf('suggest name') !== -1) {
                input.classList.add('rc-charname-input');
                var hint = cell.querySelector('small');
                if (hint && (hint.textContent || '').toLowerCase().indexOf('suggest') !== -1) {
                    hint.classList.add('rc-charname-suggest');
                }
            }
        });
    }

    if (document.body.classList.contains('rc-page-lostaccount')) {
        var backImageInputs = document.querySelectorAll('input[type="image"][src*="back"], input[type="image"][alt*="Back"], input[type="image"][name*="back"]');
        backImageInputs.forEach(function (input) {
            var form = input.closest('form');
            if (!form) {
                return;
            }

            var button = document.createElement('button');
            button.type = 'submit';
            button.className = 'rc-btn rc-btn-subtle';
            button.textContent = 'Back';
            button.value = input.value || 'Back';
            if (input.name) {
                button.name = input.name;
            }

            var wrapper = document.createElement('div');
            wrapper.style.display = 'inline-flex';
            wrapper.style.alignItems = 'center';
            wrapper.style.justifyContent = 'center';
            wrapper.appendChild(button);

            input.parentNode.replaceChild(wrapper, input);
        });
    }

    var loc = window.location;
    var pathPart = loc.pathname.replace(/\/+$/, '').split('/').pop().toLowerCase();
    var qs = new URLSearchParams(loc.search);
    var subtopicParam = (qs.get('subtopic') || '').toLowerCase();
    var queryFirst = loc.search.length > 1
        ? loc.search.slice(1).split('&')[0].split('=')[0].toLowerCase()
        : '';
    var marker = subtopicParam || pathPart || queryFirst;
    var homeMarkers = ['', 'index.php', 'home'];
    if (homeMarkers.indexOf(marker) === -1 && !loc.hash) {
        var main = document.getElementById('rcMain');
        if (main) {
            var headerOffset = header ? (header.offsetHeight + 12) : 16;
            window.scrollTo(0, Math.max(0, main.offsetTop - headerOffset));
        }
    }

    function pad(value) {
        return value < 10 ? '0' + value : String(value);
    }

    var launchNode = document.getElementById('rcLaunchCountdown');
    if (launchNode) {
        var launchTarget = new Date(launchNode.getAttribute('data-target')).getTime();
        var launchStatus = launchNode.querySelector('[data-rc-launch-status]');
        var launchFields = {
            days: launchNode.querySelector('[data-rc-launch-days]'),
            hours: launchNode.querySelector('[data-rc-launch-hours]'),
            minutes: launchNode.querySelector('[data-rc-launch-minutes]'),
            seconds: launchNode.querySelector('[data-rc-launch-seconds]')
        };

        function setLaunchField(field, value) {
            if (launchFields[field]) {
                launchFields[field].textContent = pad(value);
            }
        }

        function updateLaunchCountdown() {
            var diff = launchTarget - Date.now();

            if (!Number.isFinite(launchTarget) || diff <= 0) {
                setLaunchField('days', 0);
                setLaunchField('hours', 0);
                setLaunchField('minutes', 0);
                setLaunchField('seconds', 0);
                launchNode.classList.add('is-live');
                if (launchStatus) {
                    launchStatus.textContent = launchNode.getAttribute('data-live-text') || '';
                }
                return false;
            }

            setLaunchField('days', Math.floor(diff / (1000 * 60 * 60 * 24)));
            setLaunchField('hours', Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
            setLaunchField('minutes', Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)));
            setLaunchField('seconds', Math.floor((diff % (1000 * 60)) / 1000));
            return true;
        }

        if (updateLaunchCountdown()) {
            var launchInterval = setInterval(function () {
                if (!updateLaunchCountdown()) {
                    clearInterval(launchInterval);
                }
            }, 1000);
        }
    }

    var countdownNode = document.getElementById('rcServerSaveCountdown');
    if (!countdownNode) {
        return;
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
