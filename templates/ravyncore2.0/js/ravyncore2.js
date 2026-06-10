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

    function isTransitionableNavClick(link, event) {
        if (!link || !event) {
            return false;
        }

        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return false;
        }

        if (link.target && link.target.toLowerCase() !== '_self') {
            return false;
        }

        if (link.hasAttribute('download')) {
            return false;
        }

        var href = link.getAttribute('href');
        if (!href || href.charAt(0) === '#' || href.indexOf('javascript:') === 0 || href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) {
            return false;
        }

        var nextUrl;
        try {
            nextUrl = new URL(link.href, window.location.href);
        } catch (error) {
            return false;
        }

        if (nextUrl.origin !== window.location.origin) {
            return false;
        }

        return nextUrl.href !== window.location.href;
    }

    function initPageTransitions() {
        var navLinks = document.querySelectorAll('.rc-nav a');
        if (!navLinks.length) {
            return;
        }

        Array.prototype.forEach.call(navLinks, function (link) {
            link.addEventListener('click', function (event) {
                if (!isTransitionableNavClick(link, event)) {
                    return;
                }

                event.preventDefault();

                if (prefersReducedMotion()) {
                    window.location.href = link.href;
                    return;
                }

                if (document.body.classList.contains('rc2-page-transition-exit')) {
                    return;
                }

                document.body.classList.add('rc2-page-transition-exit');

                window.setTimeout(function () {
                    window.location.href = link.href;
                }, 840);
            });
        });
    }

    function getPageAnchorTarget(link) {
        var href = link ? link.getAttribute('href') : '';
        if (!href || href.charAt(0) !== '#') {
            return null;
        }

        var id = href.slice(1);
        try {
            id = decodeURIComponent(id);
        } catch (error) {
            // Keep the raw id when the hash is not URI encoded.
        }

        return id ? document.getElementById(id) : null;
    }

    function getPageScrollOffset() {
        var header = document.querySelector('.rc-header');
        return (header ? header.offsetHeight : 0) + 18;
    }

    function scrollToPageAnchor(target) {
        if (!target) {
            return;
        }

        var top = target.getBoundingClientRect().top + window.pageYOffset - getPageScrollOffset();
        window.scrollTo({
            top: Math.max(0, top),
            behavior: prefersReducedMotion() ? 'auto' : 'smooth'
        });

        if (target.id) {
            window.history.replaceState(null, '', '#' + target.id);
        }
    }

    function cleanQuickLinkLabel(label) {
        return (label || '').replace(/\s+/g, ' ').trim();
    }

    function shouldSkipGeneratedQuickLinks() {
        return document.body.classList.contains('rc-page-news')
            || document.body.classList.contains('rc-page-latestnews')
            || document.body.classList.contains('rc-page-lastnews');
    }

    function buildGeneratedQuickLinks(list) {
        var content = document.querySelector('.rc-rich-content');
        if (!content || shouldSkipGeneratedQuickLinks()) {
            return [];
        }

        var candidates = Array.prototype.slice.call(content.querySelectorAll('section[id], article[id], details[id], div[id]'));
        var seen = {};
        var generated = [];

        candidates.forEach(function (node) {
            if (generated.length >= 10 || !node.id || seen[node.id]) {
                return;
            }

            if (node.closest('table') || node.classList.contains('rc-st-page-title')) {
                return;
            }

            var titleNode = node.querySelector(':scope > h2, :scope > h3, :scope > h4, :scope > summary, :scope .rc-vl-title, :scope .esb-title, :scope .rc-si-title');
            var label = cleanQuickLinkLabel(titleNode ? titleNode.textContent : '');

            if (!label && node.classList.contains('rc-am-table-area')) {
                label = node.getAttribute('data-kind') === 'mounts' ? 'Mounts' : 'Outfits';
            }

            if (!label || label.length > 48) {
                return;
            }

            seen[node.id] = true;
            generated.push({
                label: label,
                href: '#' + node.id,
                target: node
            });
        });

        if (!generated.length) {
            Array.prototype.slice.call(content.querySelectorAll('h2, h3')).forEach(function (heading, index) {
                var label = cleanQuickLinkLabel(heading.textContent);
                if (generated.length >= 8 || !label || label.length > 48 || heading.closest('table')) {
                    return;
                }

                if (heading.closest('.rc-st-page-title')) {
                    return;
                }

                if (!heading.id) {
                    heading.id = 'rc2-generated-section-' + index;
                }

                generated.push({
                    label: label,
                    href: '#' + heading.id,
                    target: heading
                });
            });
        }

        if (!generated.length) {
            return [];
        }

        list.innerHTML = '';
        generated.forEach(function (entry) {
            var item = document.createElement('li');
            var link = document.createElement('a');
            link.href = entry.href;
            link.className = 'js-rc-page-anchor';
            link.textContent = entry.label;
            item.appendChild(link);
            list.appendChild(item);
        });

        var panel = list.closest('.rc-quick-panel');
        if (panel) {
            panel.classList.add('is-page-quick-links');
        }

        return Array.prototype.slice.call(list.querySelectorAll('a[href^="#"]'));
    }

    function initPageQuickLinks() {
        var list = document.querySelector('[data-rc-page-quick-links]');
        if (!list) {
            return;
        }

        var links = Array.prototype.slice.call(list.querySelectorAll('a[href^="#"]'));
        if (!links.length) {
            links = buildGeneratedQuickLinks(list);
        }

        var targets = links.map(function (link) {
            return {
                link: link,
                target: getPageAnchorTarget(link)
            };
        }).filter(function (entry) {
            return !!entry.target;
        });

        if (!targets.length) {
            return;
        }

        function setActive(activeLink) {
            targets.forEach(function (entry) {
                entry.link.classList.toggle('is-active', entry.link === activeLink);
            });
        }

        function syncActiveLink() {
            var edge = window.pageYOffset + getPageScrollOffset() + 24;
            var active = targets[0];

            targets.forEach(function (entry) {
                if (entry.target.offsetTop <= edge) {
                    active = entry;
                }
            });

            setActive(active ? active.link : null);
        }

        targets.forEach(function (entry) {
            entry.link.addEventListener('click', function (event) {
                event.preventDefault();
                setActive(entry.link);
                scrollToPageAnchor(entry.target);
            });
        });

        var scrollTicking = false;
        window.addEventListener('scroll', function () {
            if (scrollTicking) {
                return;
            }

            scrollTicking = true;
            window.requestAnimationFrame(function () {
                syncActiveLink();
                scrollTicking = false;
            });
        }, { passive: true });

        syncActiveLink();
    }

    function initLaunchBannerIntro() {
        var banner = document.querySelector('[data-rc-launch-banner]');
        if (!banner) {
            return;
        }

        var introKey = banner.getAttribute('data-intro-key') || 'ravyncore2-launch-banner-intro';
        if (prefersReducedMotion()) {
            banner.classList.remove('is-intro-standby');
            banner.classList.add('is-intro-skipped');
            return;
        }

        if (storageGet(introKey) === 'played') {
            banner.classList.remove('is-intro-standby');
            banner.classList.add('is-intro-skipped');
            return;
        }

        storageSet(introKey, 'played');
        banner.classList.add('is-intro-ready');
        banner.classList.remove('is-intro-standby');

        window.requestAnimationFrame(function () {
            banner.classList.add('is-intro-playing');
        });

        window.setTimeout(function () {
            banner.classList.add('is-impacting');
        }, 2580);

        window.setTimeout(function () {
            banner.classList.remove('is-impacting');
        }, 3040);

        window.setTimeout(function () {
            banner.classList.remove('is-intro-ready');
            banner.classList.remove('is-intro-playing');
            banner.classList.add('is-intro-complete');
        }, 3420);
    }

    initPageTransitions();
    initPageQuickLinks();
    initLaunchBannerIntro();
})();
