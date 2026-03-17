/**
 * GtaLobby — Animation Controller
 *
 * Preloader, scroll-triggered reveals, scroll progress bar,
 * and interactive animation enhancements.
 *
 * @package GtaLobby
 */

(function () {
    'use strict';

    /* =============================================
       PRELOADER (3–5 seconds)
       ============================================= */

    var preloader = document.getElementById('gl-preloader');
    var progressBar = document.getElementById('gl-preloader-progress');

    if (preloader) {
        document.body.classList.add('gl-loading');

        var DURATION = 3500; /* 3.5 seconds base */
        var startTime = Date.now();
        var loaded = false;

        /* Animate progress bar with easing */
        function updateProgress() {
            var elapsed = Date.now() - startTime;
            var raw = Math.min(elapsed / DURATION, 1);
            /* Ease-out: fast start, slow finish */
            var eased = 1 - Math.pow(1 - raw, 3);
            var percent = Math.min(eased * 100, loaded ? 100 : 92);

            if (progressBar) {
                progressBar.style.width = percent + '%';
            }

            if (raw < 1 || !loaded) {
                requestAnimationFrame(updateProgress);
            } else {
                dismissPreloader();
            }
        }

        function dismissPreloader() {
            if (progressBar) {
                progressBar.style.width = '100%';
            }
            setTimeout(function () {
                preloader.classList.add('is-done');
                document.body.classList.remove('gl-loading');
                /* Remove from DOM after fade out */
                setTimeout(function () {
                    if (preloader.parentNode) {
                        preloader.parentNode.removeChild(preloader);
                    }
                }, 600);
            }, 300);
        }

        requestAnimationFrame(updateProgress);

        /* Mark as loaded when page finishes */
        window.addEventListener('load', function () {
            /* Ensure minimum 3s display */
            var elapsed = Date.now() - startTime;
            var remaining = Math.max(DURATION - elapsed, 0);
            setTimeout(function () {
                loaded = true;
            }, remaining);
        });

        /* Safety timeout — max 5 seconds no matter what */
        setTimeout(function () {
            loaded = true;
        }, 5000);
    }

    /* Respect reduced motion preferences */
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('[data-animate]').forEach(function (el) {
            el.classList.add('gl-visible');
        });
        /* Skip preloader immediately for reduced motion */
        if (preloader) {
            preloader.classList.add('is-done');
            document.body.classList.remove('gl-loading');
        }
        return;
    }

    /* =============================================
       SCROLL-TRIGGERED REVEALS (IntersectionObserver)
       ============================================= */

    var animateElements = document.querySelectorAll('[data-animate]');

    if (animateElements.length && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('gl-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        });

        animateElements.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        /* Fallback: show all immediately */
        animateElements.forEach(function (el) {
            el.classList.add('gl-visible');
        });
    }

    /* =============================================
       SCROLL PROGRESS INDICATOR
       ============================================= */

    var progressBar = document.querySelector('.gl-scroll-progress');
    if (progressBar) {
        window.addEventListener('scroll', function () {
            var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            var scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
            progressBar.style.width = progress + '%';
        }, { passive: true });
    }

    /* =============================================
       BACK TO TOP BUTTON
       ============================================= */

    var backToTop = document.querySelector('.gl-back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 500) {
                backToTop.classList.add('is-visible');
            } else {
                backToTop.classList.remove('is-visible');
            }
        }, { passive: true });

        backToTop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* =============================================
       TOC ACTIVE HEADING HIGHLIGHT
       ============================================= */

    var tocLinks = document.querySelectorAll('.gl-toc__item a');
    if (tocLinks.length) {
        var headings = [];
        tocLinks.forEach(function (link) {
            var id = link.getAttribute('href');
            if (id && id.startsWith('#')) {
                var heading = document.querySelector(id);
                if (heading) headings.push({ el: heading, link: link.parentElement });
            }
        });

        if (headings.length) {
            window.addEventListener('scroll', function () {
                var scrollPos = window.pageYOffset + 120;
                var current = null;

                headings.forEach(function (h) {
                    if (h.el.offsetTop <= scrollPos) {
                        current = h;
                    }
                });

                tocLinks.forEach(function (link) {
                    link.parentElement.classList.remove('is-active');
                });

                if (current) {
                    current.link.classList.add('is-active');
                }
            }, { passive: true });
        }
    }

    /* =============================================
       LATEST CONTENT — TAB SWITCHING
       ============================================= */

    var latestTabs = document.querySelectorAll('.gl-latest-tab');
    var latestPanels = document.querySelectorAll('.gl-latest-panel');

    if (latestTabs.length) {
        latestTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var target = this.getAttribute('data-tab');

                /* Update active tab */
                latestTabs.forEach(function (t) {
                    t.classList.remove('gl-latest-tab--active');
                    t.setAttribute('aria-selected', 'false');
                });
                this.classList.add('gl-latest-tab--active');
                this.setAttribute('aria-selected', 'true');

                /* Update active panel */
                latestPanels.forEach(function (p) {
                    p.classList.remove('gl-latest-panel--active');
                });
                var activePanel = document.querySelector('.gl-latest-panel[data-panel="' + target + '"]');
                if (activePanel) {
                    activePanel.classList.add('gl-latest-panel--active');
                }
            });
        });
    }

    /* =============================================
       COUNTER ANIMATION (Stats Numbers)
       ============================================= */

    var statValues = document.querySelectorAll('.gl-stats-bar__num[data-count], .gl-home-hero__stat-value');
    if (statValues.length && 'IntersectionObserver' in window) {
        var countObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    countObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        statValues.forEach(function (el) {
            countObserver.observe(el);
        });
    }

    function animateCounter(el) {
        var target = parseInt(el.getAttribute('data-count') || el.textContent, 10);
        if (isNaN(target)) return;

        var duration = 1200;
        var start = 0;
        var startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3); /* easeOutCubic */
            el.textContent = Math.floor(eased * target);
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = target;
            }
        }

        el.textContent = '0';
        requestAnimationFrame(step);
    }

})();
