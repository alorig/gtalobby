/**
 * GtaLobby — Premium Animation Engine
 *
 * Particle system, cursor effects, text animations, parallax,
 * magnetic buttons, tilt cards, ripple clicks, and 20+ features.
 *
 * @package GtaLobby
 */

(function () {
    'use strict';

    /* Respect reduced motion preferences */
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reducedMotion) {
        document.querySelectorAll('[data-animate]').forEach(function (el) {
            el.classList.add('gl-visible');
        });
        return;
    }

    /* ==========================================================================
       SHARED: RAF-throttled mousemove tracker
       ========================================================================== */

    var mouseX = 0, mouseY = 0, mouseMoveCallbacks = [];
    var mouseMoveTicking = false;

    document.addEventListener('mousemove', function (e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
        if (!mouseMoveTicking) {
            requestAnimationFrame(function () {
                for (var i = 0; i < mouseMoveCallbacks.length; i++) {
                    mouseMoveCallbacks[i](mouseX, mouseY);
                }
                mouseMoveTicking = false;
            });
            mouseMoveTicking = true;
        }
    });

    /* Helper: check if element is in viewport */
    function isInViewport(el) {
        var rect = el.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom > 0;
    }


    /* ==========================================================================
       SHARED: Inject all missing keyframes at once
       ========================================================================== */

    var keyframeSheet = document.createElement('style');
    keyframeSheet.textContent = [
        '@keyframes gl-ripple{0%{transform:scale(0);opacity:0.6;}100%{transform:scale(4);opacity:0;}}',
        '@keyframes gl-charReveal{from{opacity:0;transform:translateY(100%) rotateX(-80deg);}to{opacity:1;transform:translateY(0) rotateX(0);}}',
        '@keyframes gl-countGlow{0%{text-shadow:0 0 20px rgba(255,44,152,0.6);}100%{text-shadow:none;}}',
        '@keyframes gl-cursorBlink{0%,100%{border-color:transparent;}50%{border-color:var(--gl-color-accent,#FF2C98);}}',
        '@keyframes gl-neonBoxPulse{0%,100%{box-shadow:0 0 4px rgba(255,44,152,0.2);}50%{box-shadow:0 0 12px rgba(255,44,152,0.4);}}',
        '@keyframes gl-gradientShift{0%{background-position:0% 50%;}50%{background-position:100% 50%;}100%{background-position:0% 50%;}}',
        '@keyframes gl-glowOrbFloat{0%,100%{transform:translateY(0) scale(1);}50%{transform:translateY(-20px) scale(1.05);}}'
    ].join('');
    document.head.appendChild(keyframeSheet);


    /* ==========================================================================
       1. SCROLL-TRIGGERED REVEALS (IntersectionObserver)
       ========================================================================== */

    var animateElements = document.querySelectorAll('[data-animate]');

    if (animateElements.length && 'IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('gl-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.01,
            rootMargin: '50px 0px 0px 0px'
        });

        animateElements.forEach(function (el) {
            /* Immediately reveal elements already in the viewport */
            if (isInViewport(el)) {
                el.classList.add('gl-visible');
            } else {
                revealObserver.observe(el);
            }
        });
    } else {
        animateElements.forEach(function (el) {
            el.classList.add('gl-visible');
        });
    }


    /* ==========================================================================
       2. SCROLL PROGRESS BAR
       ========================================================================== */

    var progressBar = document.querySelector('.gl-scroll-progress');
    var articleContent = document.querySelector('.gl-article__content');

    if (progressBar) {
        window.addEventListener('scroll', function () {
            var progress;
            if (articleContent) {
                /* Article-aware progress: tracks reading position */
                var rect = articleContent.getBoundingClientRect();
                var articleTop = rect.top + window.pageYOffset;
                var articleHeight = rect.height;
                var scrollPos = window.pageYOffset - articleTop + window.innerHeight * 0.5;
                progress = Math.max(0, Math.min(100, (scrollPos / articleHeight) * 100));
            } else {
                /* Generic page progress */
                var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                var scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
            }
            progressBar.style.width = progress + '%';
        }, { passive: true });
    }


    /* ==========================================================================
       3. BACK TO TOP BUTTON
       ========================================================================== */

    var backToTop = document.querySelector('.gl-back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 400) {
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


    /* ==========================================================================
       4. FLOATING PARTICLE SYSTEM — Creates ambient floating particles
       ========================================================================== */

    function createParticles() {
        var canvas = document.createElement('canvas');
        canvas.className = 'gl-particle-canvas';
        canvas.style.cssText = 'position:fixed;inset:0;pointer-events:none;z-index:1;opacity:0.6;';
        document.body.appendChild(canvas);
        var ctx = canvas.getContext('2d');

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        var particles = [];
        /* Cap particle count for better performance */
        var particleCount = Math.min(35, Math.floor(window.innerWidth / 40));
        var colors = ['#FF2C98', '#27D9FF', '#6C5CE7', '#FF2C98'];
        var connectionDistance = 100;
        var connectionDistSq = connectionDistance * connectionDistance;

        for (var i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                radius: Math.random() * 2 + 0.5,
                color: colors[Math.floor(Math.random() * colors.length)],
                opacity: Math.random() * 0.5 + 0.1,
                pulse: Math.random() * Math.PI * 2
            });
        }

        /* Use shared mouse tracker (no extra listener) */

        var rafId;
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach(function (p, idx) {
                p.pulse += 0.02;
                p.x += p.vx;
                p.y += p.vy;

                /* Mouse interaction — particles drift away from cursor */
                var dx = p.x - mouseX;
                var dy = p.y - mouseY;
                var distSq = dx * dx + dy * dy;
                if (distSq < 22500 && distSq > 0) { /* 150^2 */
                    var dist = Math.sqrt(distSq);
                    var force = (150 - dist) / 150;
                    p.vx += (dx / dist) * force * 0.03;
                    p.vy += (dy / dist) * force * 0.03;
                }

                /* Damping */
                p.vx *= 0.99;
                p.vy *= 0.99;

                /* Wrap around edges */
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width) p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;

                /* Draw particle */
                var opacity = p.opacity * (0.7 + 0.3 * Math.sin(p.pulse));
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = p.color;
                ctx.globalAlpha = opacity;
                ctx.fill();

                /* Draw connections — use squared distance to avoid sqrt */
                for (var j = idx + 1; j < particles.length; j++) {
                    var p2 = particles[j];
                    var cdx = p.x - p2.x;
                    var cdy = p.y - p2.y;
                    var cdSq = cdx * cdx + cdy * cdy;
                    if (cdSq < connectionDistSq) {
                        var cd = Math.sqrt(cdSq);
                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(p2.x, p2.y);
                        ctx.strokeStyle = p.color;
                        ctx.globalAlpha = (1 - cd / connectionDistance) * 0.15;
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                }
            });

            ctx.globalAlpha = 1;
            rafId = requestAnimationFrame(animate);
        }

        /* Only animate when tab is visible */
        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                cancelAnimationFrame(rafId);
            } else {
                animate();
            }
        });

        animate();
    }

    /* Only create particles on desktop */
    if (window.innerWidth > 768) {
        createParticles();
    }


    /* ==========================================================================
       5. CURSOR GLOW TRAIL — Neon glow follows cursor (RAF-throttled)
       ========================================================================== */

    if (window.innerWidth > 768) {
        var cursorGlow = document.createElement('div');
        cursorGlow.style.cssText = 'position:fixed;width:400px;height:400px;border-radius:50%;pointer-events:none;z-index:0;background:radial-gradient(circle,rgba(255,44,152,0.06) 0%,rgba(39,217,255,0.03) 40%,transparent 70%);will-change:transform;';
        document.body.appendChild(cursorGlow);

        mouseMoveCallbacks.push(function (mx, my) {
            cursorGlow.style.transform = 'translate(' + (mx - 200) + 'px, ' + (my - 200) + 'px)';
        });
    }


    /* ==========================================================================
       6. PARALLAX TILT ON CARDS — 3D perspective on hover (RAF-throttled)
       ========================================================================== */

    var tiltCards = document.querySelectorAll('.gl-cat-card, .gl-gta6-card, .gl-hub-tile, .gl-category-tile, .gl-cat-hub-card, .gl-post-card, .gl-featured-card, .gl-hub-card-v2, .gl-sidebar__section, .gl-widget');
    if (tiltCards.length && window.innerWidth > 991) {
        tiltCards.forEach(function (card) {
            card.style.transition = 'transform 0.3s ease';
            card.style.willChange = 'transform';
            var tiltRaf = null;

            card.addEventListener('mousemove', function (e) {
                if (tiltRaf) return;
                tiltRaf = requestAnimationFrame(function () {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var centerX = rect.width / 2;
                    var centerY = rect.height / 2;
                    var rotateX = ((y - centerY) / centerY) * -4;
                    var rotateY = ((x - centerX) / centerX) * 4;
                    card.style.transform = 'perspective(800px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-6px) scale(1.02)';
                    tiltRaf = null;
                });
            });

            card.addEventListener('mouseleave', function () {
                if (tiltRaf) { cancelAnimationFrame(tiltRaf); tiltRaf = null; }
                card.style.transform = '';
            });
        });
    }


    /* ==========================================================================
       7. MAGNETIC BUTTON EFFECT — Buttons follow cursor (RAF-throttled)
       ========================================================================== */

    var magneticBtns = document.querySelectorAll('.gl-btn, .gl-btn--primary, .gl-hero-panel__cta, .gl-404-hero__cta, .gl-cat-featured__read, .gl-cat-card__link, .gl-back-to-top');
    if (magneticBtns.length && window.innerWidth > 991) {
        magneticBtns.forEach(function (btn) {
            var btnRaf = null;

            btn.addEventListener('mousemove', function (e) {
                if (btnRaf) return;
                btnRaf = requestAnimationFrame(function () {
                    var rect = btn.getBoundingClientRect();
                    var x = e.clientX - rect.left - rect.width / 2;
                    var y = e.clientY - rect.top - rect.height / 2;
                    btn.style.transform = 'translate(' + (x * 0.2) + 'px, ' + (y * 0.2) + 'px) scale(1.05)';
                    btnRaf = null;
                });
            });

            btn.addEventListener('mouseleave', function () {
                if (btnRaf) { cancelAnimationFrame(btnRaf); btnRaf = null; }
                btn.style.transform = '';
            });
        });
    }


    /* ==========================================================================
       8. RIPPLE CLICK EFFECT — Material-style ripple on clicks
       ========================================================================== */

    document.addEventListener('click', function (e) {
        var target = e.target.closest('a, button, .gl-btn, .gl-cat-card, .gl-post-card, .gl-cat-filter, .gl-hub-filter');
        if (!target) return;

        var ripple = document.createElement('span');
        var rect = target.getBoundingClientRect();
        var size = Math.max(rect.width, rect.height) * 2;
        var x = e.clientX - rect.left - size / 2;
        var y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = 'position:absolute;border-radius:50%;background:rgba(255,44,152,0.3);width:' + size + 'px;height:' + size + 'px;left:' + x + 'px;top:' + y + 'px;animation:gl-ripple 0.6s ease-out forwards;pointer-events:none;';

        var originalPosition = window.getComputedStyle(target).position;
        if (originalPosition === 'static') target.style.position = 'relative';
        target.style.overflow = 'hidden';
        target.appendChild(ripple);

        setTimeout(function () {
            ripple.remove();
            if (originalPosition === 'static') target.style.position = '';
        }, 600);
    });


    /* ==========================================================================
       9. TEXT REVEAL ANIMATION — Letters animate in one by one
       ========================================================================== */

    var textRevealEls = document.querySelectorAll('.gl-article__title, .gl-cat-hero__title, .gl-arc-hero__title, .gl-hub-hero__title, .gl-404-hero__title, .gl-search-hero__title');
    if (textRevealEls.length && 'IntersectionObserver' in window) {
        var textObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var text = el.textContent.trim();
                    if (!text || el.dataset.animated) return;
                    el.dataset.animated = 'true';

                    el.innerHTML = '';
                    var words = text.split(' ');
                    words.forEach(function (word, wi) {
                        var wordSpan = document.createElement('span');
                        wordSpan.style.cssText = 'display:inline-block;overflow:hidden;';

                        for (var ci = 0; ci < word.length; ci++) {
                            var charSpan = document.createElement('span');
                            charSpan.textContent = word[ci];
                            charSpan.style.cssText = 'display:inline-block;opacity:0;transform:translateY(100%) rotateX(-80deg);animation:gl-charReveal 0.5s cubic-bezier(0.25,0.46,0.45,0.94) ' + (wi * 0.08 + ci * 0.03) + 's forwards;';
                            wordSpan.appendChild(charSpan);
                        }

                        el.appendChild(wordSpan);
                        if (wi < words.length - 1) {
                            el.appendChild(document.createTextNode(' '));
                        }
                    });

                    textObserver.unobserve(el);
                }
            });
        }, { threshold: 0.3 });

        textRevealEls.forEach(function (el) { textObserver.observe(el); });
    }


    /* ==========================================================================
       10. PARALLAX SCROLL FOR BACKGROUNDS
       ========================================================================== */

    var parallaxElements = document.querySelectorAll('.gl-cat-hero__bg, .gl-hub-hero__bg, .gl-404-hero__orb, .gl-search-hero__glow, .gl-article__hero-img');
    if (parallaxElements.length) {
        var parallaxTicking = false;
        window.addEventListener('scroll', function () {
            if (!parallaxTicking) {
                requestAnimationFrame(function () {
                    var scrolled = window.pageYOffset;
                    parallaxElements.forEach(function (el) {
                        var rect = el.getBoundingClientRect();
                        if (rect.bottom > 0 && rect.top < window.innerHeight) {
                            var speed = parseFloat(el.dataset.parallaxSpeed) || 0.3;
                            el.style.transform = 'translateY(' + (scrolled * speed) + 'px) scale(1.05)';
                        }
                    });
                    parallaxTicking = false;
                });
                parallaxTicking = true;
            }
        }, { passive: true });
    }


    /* ==========================================================================
       11. COUNTER ANIMATION — Numbers count up with glow effect
       ========================================================================== */

    var allCounters = document.querySelectorAll('.gl-stats-bar__num[data-count], .gl-home-hero__stat-value, .gl-arc-hero__meta strong, .gl-cat-hero__count strong');
    if (allCounters.length && 'IntersectionObserver' in window) {
        var countObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    countObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        allCounters.forEach(function (el) { countObserver.observe(el); });
    }

    function animateCounter(el) {
        var text = el.textContent.replace(/,/g, '');
        var target = parseInt(el.getAttribute('data-count') || text, 10);
        if (isNaN(target)) return;

        var duration = 1500;
        var startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 4);
            var value = Math.floor(eased * target);
            el.textContent = value.toLocaleString();
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = target.toLocaleString();
                el.style.animation = 'gl-countGlow 1s ease-out';
            }
        }

        el.textContent = '0';
        requestAnimationFrame(step);
    }


    /* ==========================================================================
       12. TOC ACTIVE HEADING HIGHLIGHT
       ========================================================================== */

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
                    if (h.el.offsetTop <= scrollPos) { current = h; }
                });

                tocLinks.forEach(function (link) { link.parentElement.classList.remove('is-active'); });
                if (current) { current.link.classList.add('is-active'); }
            }, { passive: true });
        }
    }


    /* ==========================================================================
       13. LATEST CONTENT TAB SWITCHING
       ========================================================================== */

    var latestTabs = document.querySelectorAll('.gl-latest-tab');
    var latestPanels = document.querySelectorAll('.gl-latest-panel');

    if (latestTabs.length) {
        latestTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var target = this.getAttribute('data-tab');
                latestTabs.forEach(function (t) {
                    t.classList.remove('gl-latest-tab--active');
                    t.setAttribute('aria-selected', 'false');
                });
                this.classList.add('gl-latest-tab--active');
                this.setAttribute('aria-selected', 'true');

                latestPanels.forEach(function (p) { p.classList.remove('gl-latest-panel--active'); });
                var activePanel = document.querySelector('.gl-latest-panel[data-panel="' + target + '"]');
                if (activePanel) { activePanel.classList.add('gl-latest-panel--active'); }
            });
        });
    }


    /* ==========================================================================
       14. SMOOTH SCROLL FOR ANCHOR LINKS
       ========================================================================== */

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


    /* ==========================================================================
       15. GALLERY LIGHTBOX
       ========================================================================== */

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

        function closeLightbox() {
            lightbox.classList.remove('is-open');
            document.body.style.overflow = '';
        }
        lightbox.querySelector('.gl-lightbox__backdrop').addEventListener('click', closeLightbox);
        lightbox.querySelector('.gl-lightbox__close').addEventListener('click', closeLightbox);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox.classList.contains('is-open')) closeLightbox();
        });
    }


    /* ==========================================================================
       16. SIDEBAR STICKY DETECTION
       ========================================================================== */

    var sidebar = document.querySelector('.gl-sidebar, .gl-single__sidebar, .gl-archive__sidebar');
    if (sidebar && 'IntersectionObserver' in window) {
        var sentinel = document.createElement('div');
        sentinel.style.cssText = 'height:1px;margin-top:-1px;';
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


    /* ==========================================================================
       17. FAQ ACCORDION
       ========================================================================== */

    document.querySelectorAll('.gl-faq__item').forEach(function (item) {
        var question = item.querySelector('.gl-faq__question');
        if (question) {
            question.addEventListener('click', function () {
                document.querySelectorAll('.gl-faq__item[open]').forEach(function (other) {
                    if (other !== item) other.removeAttribute('open');
                });
            });
        }
    });


    /* ==========================================================================
       18. TYPEWRITER EFFECT — For hero/404 code elements
       Preserves original text for accessibility/SEO, types over it visually.
       ========================================================================== */

    var typewriterEls = document.querySelectorAll('.gl-404-hero__code, [data-typewriter]');
    if (typewriterEls.length) {
        typewriterEls.forEach(function (el) {
            var text = el.textContent;
            if (!text.trim()) return;

            el.textContent = '';
            el.style.visibility = 'visible';
            el.style.borderRight = '2px solid transparent';
            el.style.animation = 'gl-cursorBlink 0.8s infinite';
            var i = 0;
            function typeChar() {
                if (i < text.length) {
                    el.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeChar, 80 + Math.random() * 60);
                } else {
                    setTimeout(function () {
                        el.style.borderRight = 'none';
                        el.style.animation = '';
                    }, 2000);
                }
            }
            setTimeout(typeChar, 600);
        });
    }


    /* ==========================================================================
       19. STAGGER ANIMATION FOR GRID CHILDREN
       Uses single RAF instead of double, with visibility safety net.
       ========================================================================== */

    var staggerGrids = document.querySelectorAll('.gl-cat-grid, .gl-guide-meta__grid, .gl-install-steps__list, .gl-gallery__grid, .gl-recap-grid, .gl-404-cats__grid, .gl-cat-hubs__grid, .gl-cat-filters__bar');
    if (staggerGrids.length && 'IntersectionObserver' in window) {
        var staggerObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var children = entry.target.children;
                    for (var i = 0; i < children.length; i++) {
                        (function (child, index) {
                            child.style.opacity = '0';
                            child.style.transform = 'translateY(30px) scale(0.95)';
                            child.style.transition = 'opacity 0.6s cubic-bezier(0.25,0.46,0.45,0.94), transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94)';
                            child.style.transitionDelay = (index * 0.1) + 's';
                            requestAnimationFrame(function () {
                                child.style.opacity = '1';
                                child.style.transform = 'translateY(0) scale(1)';
                            });
                        })(children[i], i);
                    }
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05 });

        staggerGrids.forEach(function (grid) {
            /* Immediately trigger for grids already in viewport */
            if (isInViewport(grid)) {
                var children = grid.children;
                for (var i = 0; i < children.length; i++) {
                    (function (child, index) {
                        child.style.opacity = '0';
                        child.style.transform = 'translateY(30px) scale(0.95)';
                        child.style.transition = 'opacity 0.6s cubic-bezier(0.25,0.46,0.45,0.94), transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94)';
                        child.style.transitionDelay = (index * 0.1) + 's';
                        requestAnimationFrame(function () {
                            child.style.opacity = '1';
                            child.style.transform = 'translateY(0) scale(1)';
                        });
                    })(children[i], i);
                }
            } else {
                staggerObserver.observe(grid);
            }
        });
    }


    /* ==========================================================================
       20. GLOW FOLLOW CURSOR ON HERO SECTIONS (uses shared mousemove)
       ========================================================================== */

    var heroSections = document.querySelectorAll('.gl-cat-hero, .gl-arc-hero, .gl-search-hero, .gl-404-hero, .gl-hub-hero, .gl-article__header');
    if (heroSections.length && window.innerWidth > 767) {
        mouseMoveCallbacks.push(function (mx, my) {
            heroSections.forEach(function (hero) {
                var rect = hero.getBoundingClientRect();
                if (rect.bottom > 0 && rect.top < window.innerHeight) {
                    var x = ((mx - rect.left) / rect.width) * 100;
                    var y = ((my - rect.top) / rect.height) * 100;
                    hero.style.setProperty('--glow-x', x + '%');
                    hero.style.setProperty('--glow-y', y + '%');
                }
            });
        });
    }


    /* ==========================================================================
       21. SMOOTH REVEAL FOR INSTALL STEPS (Timeline)
       ========================================================================== */

    var installSteps = document.querySelectorAll('.gl-install-step');
    if (installSteps.length && 'IntersectionObserver' in window) {
        var stepObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('gl-visible');
                    stepObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        var stepStyle = document.createElement('style');
        stepStyle.textContent = '.gl-install-step.gl-visible{opacity:1!important;transform:translateX(0)!important;}';
        document.head.appendChild(stepStyle);

        installSteps.forEach(function (step, index) {
            /* Skip initial hiding for steps already in viewport */
            if (isInViewport(step)) {
                step.classList.add('gl-visible');
            } else {
                step.style.opacity = '0';
                step.style.transform = 'translateX(-30px)';
                step.style.transition = 'opacity 0.6s ease ' + (index * 0.12) + 's, transform 0.6s ease ' + (index * 0.12) + 's';
                stepObserver.observe(step);
            }
        });
    }


    /* ==========================================================================
       22. PAGE TRANSITION EFFECT
       ========================================================================== */

    var pageTransition = document.querySelector('.gl-page-transition');
    if (pageTransition) {
        pageTransition.style.opacity = '1';
        requestAnimationFrame(function () {
            pageTransition.style.transition = 'opacity 0.5s ease';
            pageTransition.style.opacity = '0';
        });
    }


    /* ==========================================================================
       23. IMAGE REVEAL ON SCROLL — removed clip-path animation
       The data-animate scroll reveal system already handles fade/scale reveals.
       The clip-path layer was redundant and caused images to stay invisible
       when the IntersectionObserver failed to fire on already-visible elements.
       ========================================================================== */


    /* ==========================================================================
       24. HOVER GLOW EFFECT ON SIDEBAR WIDGETS
       ========================================================================== */

    var sidebarSections = document.querySelectorAll('.gl-sidebar__section, .gl-widget, .gl-single__sidebar > *');
    sidebarSections.forEach(function (section) {
        section.addEventListener('mouseenter', function () {
            this.style.boxShadow = '0 0 30px rgba(255,44,152,0.15), 0 0 60px rgba(39,217,255,0.08), 0 8px 32px rgba(0,0,0,0.3)';
            this.style.borderColor = 'rgba(255,44,152,0.3)';
            this.style.transform = 'translateY(-2px)';
        });
        section.addEventListener('mouseleave', function () {
            this.style.boxShadow = '';
            this.style.borderColor = '';
            this.style.transform = '';
        });
    });


    /* ==========================================================================
       25. ANIMATED GRADIENT BORDERS — Rotating gradient on focused elements
       ========================================================================== */

    var gradientBorderEls = document.querySelectorAll('.gl-article__toc, .gl-cat-featured, .gl-author-box');
    gradientBorderEls.forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            this.style.background = 'linear-gradient(var(--gl-color-surface-raised), var(--gl-color-surface-raised)) padding-box, linear-gradient(135deg, #FF2C98, #27D9FF, #6C5CE7, #FF2C98) border-box';
            this.style.border = '2px solid transparent';
        });
        el.addEventListener('mouseleave', function () {
            this.style.background = '';
            this.style.border = '';
        });
    });


    /* ==========================================================================
       26. SCROLL-LINKED HEADER SHADOW
       ========================================================================== */

    var header = document.querySelector('.gl-header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 50) {
                header.style.boxShadow = '0 4px 30px rgba(0,0,0,0.4), 0 0 40px rgba(255,44,152,0.05)';
                header.style.backdropFilter = 'blur(20px)';
            } else {
                header.style.boxShadow = '';
                header.style.backdropFilter = '';
            }
        }, { passive: true });
    }


    /* ==========================================================================
       27. TYPING INDICATOR ON SEARCH INPUT
       ========================================================================== */

    var searchInputs = document.querySelectorAll('.gl-search-form__input, .gl-search-overlay input');
    searchInputs.forEach(function (input) {
        input.addEventListener('focus', function () {
            this.parentElement.style.boxShadow = '0 0 30px rgba(255,44,152,0.2), 0 0 60px rgba(39,217,255,0.1)';
            this.parentElement.style.borderColor = 'var(--gl-color-accent)';
        });
        input.addEventListener('blur', function () {
            this.parentElement.style.boxShadow = '';
            this.parentElement.style.borderColor = '';
        });
    });


    /* ==========================================================================
       28. AUTO-ADD ANIMATION CLASSES TO ELEMENTS
       Apply animation attributes to elements that should animate
       ========================================================================== */

    function autoAddAnimations() {
        /* Add light-sweep effect to cards */
        document.querySelectorAll('.gl-cat-card, .gl-post-card, .gl-hub-card-v2, .gl-cat-hub-card').forEach(function (card) {
            card.classList.add('gl-light-sweep');
        });

        /* Add neon glow to post type badges */
        document.querySelectorAll('.gl-pt-badge, .gl-badge').forEach(function (badge) {
            badge.style.animation = 'gl-neonBoxPulse 4s ease-in-out infinite';
        });

        /* Add gradient animation to accent bars */
        document.querySelectorAll('.gl-article__accent-bar, .gl-cat-hero__strip, .gl-arc-hero__strip').forEach(function (bar) {
            bar.style.background = 'linear-gradient(90deg, #FF2C98, #27D9FF, #6C5CE7, #FF2C98)';
            bar.style.backgroundSize = '300% 100%';
            bar.style.animation = 'gl-gradientShift 4s ease infinite';
        });

        /* Add glow-breathe to important sections */
        document.querySelectorAll('.gl-article__header, .gl-cat-hero, .gl-arc-hero, .gl-hub-hero').forEach(function (section) {
            section.style.position = 'relative';
        });

        /* Float animation on decorative orbs */
        document.querySelectorAll('.gl-arc-hero__orb, .gl-cat-hero__glow, .gl-article__header-glow').forEach(function (orb) {
            orb.style.animation = 'gl-glowOrbFloat 8s ease-in-out infinite';
        });
    }

    autoAddAnimations();


    /* ==========================================================================
       29. SMOOTH SCROLL SNAP ON SECTIONS
       ========================================================================== */

    /* Add scroll margin to all sections for smooth scrolling */
    document.querySelectorAll('section, [data-zone]').forEach(function (section) {
        section.style.scrollMarginTop = '80px';
    });


    /* ==========================================================================
       30. INTERSECTION ANIMATIONS FOR SIDEBAR ITEMS
       ========================================================================== */

    var sidebarItems = document.querySelectorAll('.gl-sidebar__section, .gl-widget, .gl-single__sidebar > div, .gl-single__sidebar > section, .gl-archive__sidebar > div');
    if (sidebarItems.length && 'IntersectionObserver' in window) {
        var sidebarObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var delay = Array.from(sidebarItems).indexOf(entry.target) * 0.15;
                    entry.target.style.transition = 'opacity 0.6s ease ' + delay + 's, transform 0.6s ease ' + delay + 's';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0)';
                    sidebarObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        sidebarItems.forEach(function (item) {
            /* Don't hide sidebar items already in viewport */
            if (isInViewport(item)) {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            } else {
                item.style.opacity = '0';
                item.style.transform = 'translateX(30px)';
                sidebarObserver.observe(item);
            }
        });
    }


    /* ==========================================================================
       31. HEADER NAV HOVER EFFECTS
       ========================================================================== */

    document.querySelectorAll('.gl-nav__list > li > a').forEach(function (link) {
        link.addEventListener('mouseenter', function () {
            this.style.color = 'var(--gl-color-accent)';
            this.style.textShadow = '0 0 20px rgba(255,44,152,0.4)';
        });
        link.addEventListener('mouseleave', function () {
            this.style.color = '';
            this.style.textShadow = '';
        });
    });

})();
