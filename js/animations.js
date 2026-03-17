/**
 * GtaLobby — Animation Controller
 *
 * Scroll-triggered reveals, scroll progress bar,
 * and interactive animation enhancements.
 *
 * @package GtaLobby
 */

(function () {
    'use strict';

    /* Respect reduced motion preferences */
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('[data-animate]').forEach(function (el) {
            el.classList.add('gl-visible');
        });
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
       COUNTER ANIMATION (Stats Numbers)
       ============================================= */

    var statValues = document.querySelectorAll('.gl-home-hero__stat-value');
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
        var target = parseInt(el.textContent, 10);
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
