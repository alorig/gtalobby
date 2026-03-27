/**
 * Navigation & UI Interactions
 *
 * Mobile nav toggle, search overlay, post type filter tabs,
 * scroll behavior, and announcement bar dismiss.
 *
 * @package GtaLobby
 */

(function () {
    'use strict';

    /* =============================================
       MOBILE NAV
       ============================================= */

    const mobileToggle = document.querySelector('.gl-header__mobile-toggle');
    const mobileNav    = document.querySelector('.gl-mobile-nav');
    const mobileClose  = document.querySelector('.gl-mobile-nav__close');

    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function () {
            mobileNav.classList.add('is-open');
            document.body.style.overflow = 'hidden';
            mobileClose && mobileClose.focus();
        });

        if (mobileClose) {
            mobileClose.addEventListener('click', closeMobileNav);
        }

        // Close on overlay click (outside nav)
        document.addEventListener('click', function (e) {
            if (mobileNav.classList.contains('is-open') &&
                !mobileNav.contains(e.target) &&
                !mobileToggle.contains(e.target)) {
                closeMobileNav();
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && mobileNav.classList.contains('is-open')) {
                closeMobileNav();
            }
        });
    }

    function closeMobileNav() {
        if (mobileNav) {
            mobileNav.classList.remove('is-open');
            document.body.style.overflow = '';
            mobileToggle && mobileToggle.focus();
        }
    }

    /* --- Focus Trap for Mobile Nav --- */
    if (mobileNav) {
        mobileNav.addEventListener('keydown', function (e) {
            if (e.key !== 'Tab' || !mobileNav.classList.contains('is-open')) return;

            var focusable = mobileNav.querySelectorAll(
                'a[href], button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
            );
            if (focusable.length === 0) return;

            var first = focusable[0];
            var last  = focusable[focusable.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                if (document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        });
    }

    /* =============================================
       SEARCH OVERLAY
       ============================================= */

    const searchToggle  = document.querySelector('.gl-header__search-toggle');
    const searchOverlay = document.querySelector('.gl-search-overlay');
    const searchClose   = document.querySelector('.gl-search-overlay__close');
    const searchInput   = document.querySelector('.gl-search-overlay__input');

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function () {
            searchOverlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
            searchInput && searchInput.focus();
        });

        if (searchClose) {
            searchClose.addEventListener('click', closeSearch);
        }

        searchOverlay.addEventListener('click', function (e) {
            if (e.target === searchOverlay) {
                closeSearch();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('is-open')) {
                closeSearch();
            }
        });
    }

    function closeSearch() {
        if (searchOverlay) {
            searchOverlay.classList.remove('is-open');
            document.body.style.overflow = '';
            searchToggle && searchToggle.focus();
        }
    }

    /* =============================================
       POST TYPE FILTER TABS
       ============================================= */

    const filterBtns = document.querySelectorAll('.gl-hub-filter, [data-filter]');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');
            const parent = this.closest('.gl-hub-filters, .gl-archive-filters');
            const grid   = parent ? parent.nextElementSibling : null;

            if (!grid) return;

            // Update active state
            if (parent) {
                parent.querySelectorAll('.gl-hub-filter').forEach(function (b) {
                    b.classList.remove('gl-hub-filter--active');
                });
            }
            this.classList.add('gl-hub-filter--active');

            // Filter cards
            const items = grid.querySelectorAll('[data-post-type]');
            items.forEach(function (item) {
                if (filter === 'all' || item.getAttribute('data-post-type') === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    /* =============================================
       GTA 6 ANNOUNCEMENT BAR DISMISS
       ============================================= */

    const gta6Bar     = document.querySelector('.gl-gta6-bar');
    const gta6Dismiss = document.querySelector('.gl-gta6-bar__dismiss');

    if (gta6Bar && gta6Dismiss) {
        // Check if already dismissed
        if (sessionStorage.getItem('gl_gta6_bar_dismissed') === '1') {
            gta6Bar.style.display = 'none';
        }

        gta6Dismiss.addEventListener('click', function () {
            gta6Bar.style.display = 'none';
            sessionStorage.setItem('gl_gta6_bar_dismissed', '1');
        });
    }

    /* =============================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================= */

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || targetId.length < 2) return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const offset = 80; // account for sticky header
                const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });

                // Update URL without jump
                history.pushState(null, null, targetId);
            }
        });
    });

    /* =============================================
       COPY LINK (share button)
       ============================================= */

    document.querySelectorAll('.gl-share__link--copy').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.getAttribute('data-url') || window.location.href;

            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(function () {
                    btn.setAttribute('title', 'Copied!');
                    setTimeout(function () {
                        btn.setAttribute('title', 'Copy Link');
                    }, 2000);
                });
            }
        });
    });

    /* =============================================
       BACK TO TOP (optional, if element exists)
       ============================================= */

    const backToTop = document.querySelector('.gl-back-to-top');
    if (backToTop) {
        backToTop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* =============================================
       SCROLL: Header state + Progress bar + Back to top
       Combined into single scroll listener for performance
       ============================================= */

    var header         = document.querySelector('.gl-header');
    var scrollProgress = document.querySelector('.gl-scroll-progress');
    var ticking        = false;

    function onScroll() {
        var scrollY    = window.pageYOffset;
        var docHeight  = document.documentElement.scrollHeight - window.innerHeight;

        // Header scroll state
        if (header) {
            if (scrollY > 50) {
                header.classList.add('gl-header--scrolled');
            } else {
                header.classList.remove('gl-header--scrolled');
            }
        }

        // Scroll progress bar
        if (scrollProgress && docHeight > 0) {
            var progress = Math.min((scrollY / docHeight) * 100, 100);
            scrollProgress.style.width = progress + '%';
        }

        // Back to top visibility
        if (backToTop) {
            if (scrollY > 400) {
                backToTop.classList.add('is-visible');
            } else {
                backToTop.classList.remove('is-visible');
            }
        }

        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            requestAnimationFrame(onScroll);
            ticking = true;
        }
    }, { passive: true });

    /* =============================================
       TRENDING NOW — Scroll Strip
       ============================================= */

    const trendingTrack = document.querySelector('[data-trending-track]');
    if (trendingTrack) {
        const prevBtn = document.querySelector('.gl-trending__arrow--prev');
        const nextBtn = document.querySelector('.gl-trending__arrow--next');
        const scrollAmount = 300; // px per click
        let autoScrollTimer = null;
        let autoScrollPaused = false;

        // Arrow navigation
        function scrollTrack(direction) {
            const offset = direction === 'next' ? scrollAmount : -scrollAmount;
            trendingTrack.scrollBy({ left: offset, behavior: 'smooth' });
        }

        if (prevBtn) prevBtn.addEventListener('click', function () { scrollTrack('prev'); });
        if (nextBtn) nextBtn.addEventListener('click', function () { scrollTrack('next'); });

        // Update arrow disabled states
        function updateArrows() {
            if (!prevBtn || !nextBtn) return;
            const { scrollLeft, scrollWidth, clientWidth } = trendingTrack;
            prevBtn.disabled = scrollLeft <= 2;
            nextBtn.disabled = scrollLeft + clientWidth >= scrollWidth - 2;
        }

        trendingTrack.addEventListener('scroll', updateArrows, { passive: true });
        updateArrows();

        // Auto-scroll every 4 seconds, pause on hover / touch
        function startAutoScroll() {
            if (autoScrollTimer) return;
            autoScrollTimer = setInterval(function () {
                if (autoScrollPaused) return;
                const { scrollLeft, scrollWidth, clientWidth } = trendingTrack;
                if (scrollLeft + clientWidth >= scrollWidth - 2) {
                    // Wrap back to start
                    trendingTrack.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    trendingTrack.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            }, 4000);
        }

        function pauseAutoScroll() { autoScrollPaused = true; }
        function resumeAutoScroll() { autoScrollPaused = false; }

        trendingTrack.addEventListener('mouseenter', pauseAutoScroll);
        trendingTrack.addEventListener('mouseleave', resumeAutoScroll);
        trendingTrack.addEventListener('touchstart', pauseAutoScroll, { passive: true });
        trendingTrack.addEventListener('touchend', function () {
            // Resume after a brief delay so the user can finish scrolling
            setTimeout(resumeAutoScroll, 3000);
        });

        // Respect reduced motion
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            startAutoScroll();
        }

        // Pause when tab is not visible
        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                pauseAutoScroll();
            } else {
                resumeAutoScroll();
            }
        });
    }

})();
