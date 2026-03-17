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

    /* =============================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================= */

    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            var target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                var headerOffset = 80;
                var elementPosition = target.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
            }
        });
    });

    /* =============================================
       GALLERY LIGHTBOX (Simple Overlay)
       ============================================= */

    var galleryItems = document.querySelectorAll('.gl-gallery__item');
    if (galleryItems.length) {
        var lightbox = document.createElement('div');
        lightbox.className = 'gl-lightbox';
        lightbox.innerHTML = '<div class="gl-lightbox__backdrop"></div><div class="gl-lightbox__content"><img class="gl-lightbox__img" src="" alt=""/><button class="gl-lightbox__close" aria-label="Close">&times;</button></div>';
        document.body.appendChild(lightbox);

        var lightboxImg = lightbox.querySelector('.gl-lightbox__img');

        galleryItems.forEach(function (item) {
            item.style.cursor = 'pointer';
            item.addEventListener('click', function () {
                var img = this.querySelector('img');
                if (img) {
                    lightboxImg.src = img.src;
                    lightboxImg.alt = img.alt;
                    lightbox.classList.add('is-open');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        lightbox.querySelector('.gl-lightbox__backdrop').addEventListener('click', closeLightbox);
        lightbox.querySelector('.gl-lightbox__close').addEventListener('click', closeLightbox);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox.classList.contains('is-open')) {
                closeLightbox();
            }
        });

        function closeLightbox() {
            lightbox.classList.remove('is-open');
            document.body.style.overflow = '';
        }
    }

    /* =============================================
       SIDEBAR STICKY DETECTION
       ============================================= */

    var sidebar = document.querySelector('.gl-sidebar');
    if (sidebar && 'IntersectionObserver' in window) {
        var sentinel = document.createElement('div');
        sentinel.style.height = '1px';
        sentinel.style.marginTop = '-1px';
        if (sidebar.parentElement) {
            sidebar.parentElement.insertBefore(sentinel, sidebar);
        }

        var stickyObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    sidebar.classList.add('gl-sidebar--stuck');
                } else {
                    sidebar.classList.remove('gl-sidebar--stuck');
                }
            });
        }, { threshold: 0 });

        stickyObserver.observe(sentinel);
    }

    /* =============================================
       FAQ ACCORDION SMOOTH OPEN
       ============================================= */

    document.querySelectorAll('.gl-faq__item').forEach(function (item) {
        var question = item.querySelector('.gl-faq__question');
        if (question) {
            question.addEventListener('click', function (e) {
                /* Close other open items */
                document.querySelectorAll('.gl-faq__item[open]').forEach(function (other) {
                    if (other !== item) {
                        other.removeAttribute('open');
                    }
                });
            });
        }
    });

    /* =============================================
       PARALLAX SCROLL FOR HERO BACKGROUNDS
       ============================================= */

    var heroElements = document.querySelectorAll('.gl-cat-hero__bg, .gl-hub-hero__bg, .gl-404-hero__orb, .gl-search-hero__glow');
    if (heroElements.length) {
        var ticking = false;
        window.addEventListener('scroll', function () {
            if (!ticking) {
                requestAnimationFrame(function () {
                    var scrolled = window.pageYOffset;
                    heroElements.forEach(function (el) {
                        var speed = 0.3;
                        el.style.transform = 'translateY(' + (scrolled * speed) + 'px)';
                    });
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    /* =============================================
       READING PROGRESS FOR SINGLE ARTICLES
       ============================================= */

    var articleContent = document.querySelector('.gl-article__content');
    var readingProgress = document.querySelector('.gl-scroll-progress');
    if (articleContent && readingProgress) {
        window.addEventListener('scroll', function () {
            var rect = articleContent.getBoundingClientRect();
            var articleTop = rect.top + window.pageYOffset;
            var articleHeight = rect.height;
            var scrollPos = window.pageYOffset - articleTop + window.innerHeight * 0.5;
            var progress = Math.max(0, Math.min(100, (scrollPos / articleHeight) * 100));
            readingProgress.style.width = progress + '%';
        }, { passive: true });
    }

    /* =============================================
       PAGE TRANSITION EFFECT
       ============================================= */

    var pageTransition = document.querySelector('.gl-page-transition');
    if (pageTransition) {
        /* Fade out the transition overlay on page load */
        pageTransition.style.opacity = '1';
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                pageTransition.style.opacity = '0';
            });
        });
    }

    /* =============================================
       PARALLAX TILT ON CARDS (Mouse Move)
       ============================================= */

    var tiltCards = document.querySelectorAll('.gl-cat-card, .gl-gta6-card, .gl-hub-tile, .gl-category-tile');
    if (tiltCards.length && window.innerWidth > 991) {
        tiltCards.forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var y = e.clientY - rect.top;
                var centerX = rect.width / 2;
                var centerY = rect.height / 2;
                var rotateX = ((y - centerY) / centerY) * -3;
                var rotateY = ((x - centerX) / centerX) * 3;
                card.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-4px)';
            });

            card.addEventListener('mouseleave', function () {
                card.style.transform = '';
            });
        });
    }

    /* =============================================
       MAGNETIC BUTTON EFFECT
       ============================================= */

    var magneticBtns = document.querySelectorAll('.gl-btn--primary, .gl-hero-panel__cta, .gl-404-hero__cta');
    if (magneticBtns.length && window.innerWidth > 991) {
        magneticBtns.forEach(function (btn) {
            btn.addEventListener('mousemove', function (e) {
                var rect = btn.getBoundingClientRect();
                var x = e.clientX - rect.left - rect.width / 2;
                var y = e.clientY - rect.top - rect.height / 2;
                btn.style.transform = 'translate(' + (x * 0.15) + 'px, ' + (y * 0.15) + 'px)';
            });

            btn.addEventListener('mouseleave', function () {
                btn.style.transform = '';
            });
        });
    }

    /* =============================================
       TYPEWRITER EFFECT FOR HERO TITLES
       ============================================= */

    var typewriterEls = document.querySelectorAll('.gl-404-hero__code');
    if (typewriterEls.length) {
        typewriterEls.forEach(function (el) {
            var text = el.textContent;
            el.textContent = '';
            el.style.visibility = 'visible';
            var i = 0;
            function type() {
                if (i < text.length) {
                    el.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, 150);
                }
            }
            /* Delay start for dramatic effect */
            setTimeout(type, 500);
        });
    }

    /* =============================================
       STAGGER ANIMATION FOR GRID ITEMS
       ============================================= */

    var staggerGrids = document.querySelectorAll('.gl-cat-grid, .gl-guide-meta__grid, .gl-install-steps__list, .gl-gallery__grid, .gl-recap-grid, .gl-404-cats__grid');
    if (staggerGrids.length && 'IntersectionObserver' in window) {
        var staggerObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var children = entry.target.children;
                    for (var i = 0; i < children.length; i++) {
                        (function (child, index) {
                            child.style.opacity = '0';
                            child.style.transform = 'translateY(20px)';
                            child.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            setTimeout(function () {
                                child.style.opacity = '1';
                                child.style.transform = 'translateY(0)';
                            }, index * 80);
                        })(children[i], i);
                    }
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        staggerGrids.forEach(function (grid) {
            staggerObserver.observe(grid);
        });
    }

    /* =============================================
       GLOW FOLLOW CURSOR ON HERO SECTIONS
       ============================================= */

    var heroSections = document.querySelectorAll('.gl-cat-hero, .gl-arc-hero, .gl-search-hero, .gl-404-hero, .gl-hub-hero');
    if (heroSections.length && window.innerWidth > 767) {
        heroSections.forEach(function (hero) {
            hero.addEventListener('mousemove', function (e) {
                var rect = hero.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                hero.style.setProperty('--glow-x', x + '%');
                hero.style.setProperty('--glow-y', y + '%');
            });
        });
    }

    /* =============================================
       NUMBER COUNT UP ON STATS
       ============================================= */

    var arcMetaStrong = document.querySelectorAll('.gl-arc-hero__meta strong, .gl-cat-hero__count strong');
    if (arcMetaStrong.length && 'IntersectionObserver' in window) {
        var metaCountObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    metaCountObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        arcMetaStrong.forEach(function (el) {
            metaCountObserver.observe(el);
        });
    }

    /* =============================================
       SMOOTH REVEAL FOR INSTALL STEPS (Timeline)
       ============================================= */

    var installSteps = document.querySelectorAll('.gl-install-step');
    if (installSteps.length && 'IntersectionObserver' in window) {
        var stepObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('gl-visible');
                    stepObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -30px 0px' });

        installSteps.forEach(function (step, index) {
            step.style.opacity = '0';
            step.style.transform = 'translateX(-20px)';
            step.style.transition = 'opacity 0.5s ease ' + (index * 0.1) + 's, transform 0.5s ease ' + (index * 0.1) + 's';
            stepObserver.observe(step);
        });
    }

    /* Override gl-visible for install steps */
    document.querySelectorAll('.gl-install-step.gl-visible').length; /* force reflow */

    /* Reveal handler for install steps */
    var stepStyle = document.createElement('style');
    stepStyle.textContent = '.gl-install-step.gl-visible { opacity: 1 !important; transform: translateX(0) !important; }';
    document.head.appendChild(stepStyle);

})();
