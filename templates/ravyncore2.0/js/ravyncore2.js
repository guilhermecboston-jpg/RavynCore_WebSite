(function () {
    var carousels = document.querySelectorAll('[data-rc2-carousel]');

    carousels.forEach(function (carousel) {
        var slides = Array.prototype.slice.call(carousel.querySelectorAll('[data-rc2-slide]'));
        var previousButton = carousel.querySelector('[data-rc2-carousel-prev]');
        var nextButton = carousel.querySelector('[data-rc2-carousel-next]');
        var dotsContainer = carousel.querySelector('[data-rc2-carousel-dots]');
        var intervalMs = parseInt(carousel.getAttribute('data-interval') || '5600', 10);
        var currentIndex = 0;
        var timer = null;

        if (slides.length <= 1) {
            carousel.classList.add('has-single-slide');
            return;
        }

        function setSlide(nextIndex) {
            currentIndex = (nextIndex + slides.length) % slides.length;

            slides.forEach(function (slide, index) {
                slide.classList.toggle('is-active', index === currentIndex);
            });

            if (dotsContainer) {
                Array.prototype.slice.call(dotsContainer.children).forEach(function (dot, index) {
                    dot.classList.toggle('is-active', index === currentIndex);
                });
            }
        }

        function stopAutoplay() {
            if (timer) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        function startAutoplay() {
            stopAutoplay();
            timer = window.setInterval(function () {
                setSlide(currentIndex + 1);
            }, Number.isFinite(intervalMs) ? intervalMs : 5600);
        }

        if (dotsContainer) {
            slides.forEach(function (_, index) {
                var dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', 'Show banner ' + (index + 1));
                dot.addEventListener('click', function () {
                    setSlide(index);
                    startAutoplay();
                });
                dotsContainer.appendChild(dot);
            });
        }

        if (previousButton) {
            previousButton.addEventListener('click', function () {
                setSlide(currentIndex - 1);
                startAutoplay();
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', function () {
                setSlide(currentIndex + 1);
                startAutoplay();
            });
        }

        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);
        carousel.addEventListener('focusin', stopAutoplay);
        carousel.addEventListener('focusout', startAutoplay);

        setSlide(0);
        startAutoplay();
    });

    function storageGet(key) {
        try {
            return window.sessionStorage ? window.sessionStorage.getItem(key) : null;
        } catch (error) {
            return null;
        }
    }

    function storageSet(key, value) {
        try {
            if (window.sessionStorage) {
                window.sessionStorage.setItem(key, value);
            }
        } catch (error) {
            // Session storage can be unavailable in strict privacy modes.
        }
    }

    function prefersReducedMotion() {
        return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    }

    function initLaunchBannerIntro() {
        var banner = document.querySelector('[data-rc-launch-banner]');
        if (!banner) {
            return;
        }

        var introKey = banner.getAttribute('data-intro-key') || 'ravyncore2-launch-banner-intro';
        if (prefersReducedMotion()) {
            banner.classList.add('is-intro-skipped');
            return;
        }

        if (storageGet(introKey) === 'played') {
            banner.classList.add('is-intro-skipped');
            return;
        }

        storageSet(introKey, 'played');
        banner.classList.add('is-intro-ready');

        window.requestAnimationFrame(function () {
            banner.classList.add('is-intro-playing');
        });

        window.setTimeout(function () {
            banner.classList.add('is-impacting');
        }, 2250);

        window.setTimeout(function () {
            banner.classList.remove('is-impacting');
        }, 2720);

        window.setTimeout(function () {
            banner.classList.remove('is-intro-ready');
            banner.classList.remove('is-intro-playing');
            banner.classList.add('is-intro-complete');
        }, 3180);
    }

    initLaunchBannerIntro();
})();
