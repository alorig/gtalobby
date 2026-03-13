/**
 * Social Share Buttons
 *
 * Opens share popups in centered windows and provides
 * native Web Share API fallback on supported devices.
 *
 * @package GtaLobby
 */

(function () {
    'use strict';

    /* Share popup links */
    document.querySelectorAll('.gl-share__link[data-share]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var url = this.getAttribute('href');
            if (!url || url === '#') return;

            var width  = 600;
            var height = 400;
            var left   = (screen.width - width) / 2;
            var top    = (screen.height - height) / 2;

            window.open(
                url,
                'share',
                'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top + ',menubar=no,toolbar=no,status=no'
            );
        });
    });

    /* Native share (mobile) */
    var nativeShareBtn = document.querySelector('.gl-share__link--native');
    if (nativeShareBtn && navigator.share) {
        nativeShareBtn.style.display = 'inline-flex';
        nativeShareBtn.addEventListener('click', function (e) {
            e.preventDefault();
            navigator.share({
                title: document.title,
                url: window.location.href,
            }).catch(function () {
                // User cancelled — do nothing
            });
        });
    }

})();
