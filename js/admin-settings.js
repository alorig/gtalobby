/**
 * Admin Settings JS
 *
 * Tab switching, color pickers, and settings page interactions.
 *
 * @package GtaLobby
 */

(function ($) {
    'use strict';

    $(document).ready(function () {

        /* =============================================
           SETTINGS TABS
           ============================================= */

        var $tabs   = $('.gl-admin-tab');
        var $panels = $('.gl-admin-tab-panel');

        if ($tabs.length) {
            $tabs.on('click', function (e) {
                e.preventDefault();
                var target = $(this).data('tab');

                $tabs.removeClass('is-active');
                $(this).addClass('is-active');

                $panels.removeClass('is-active');
                $('#tab-' + target).addClass('is-active');

                // Save active tab in URL hash
                if (history.replaceState) {
                    history.replaceState(null, null, '#' + target);
                }
            });

            // Restore tab from hash
            var hash = window.location.hash.replace('#', '');
            if (hash) {
                var $targetTab = $tabs.filter('[data-tab="' + hash + '"]');
                if ($targetTab.length) {
                    $targetTab.trigger('click');
                }
            }
        }

        /* =============================================
           COLOR PICKERS
           ============================================= */

        if ($.fn.wpColorPicker) {
            $('.gl-color-picker').wpColorPicker();
        }

        /* =============================================
           FORM DIRTY STATE WARNING
           ============================================= */

        var formDirty = false;

        $('form.gl-admin-form :input').on('change input', function () {
            formDirty = true;
        });

        $('form.gl-admin-form').on('submit', function () {
            formDirty = false;
        });

        $(window).on('beforeunload', function () {
            if (formDirty) {
                return 'You have unsaved changes. Are you sure you want to leave?';
            }
        });

        /* =============================================
           CONDITIONAL FIELD VISIBILITY
           ============================================= */

        // Toggle GTA 6 fields based on enable_gta6_mode
        var $gta6Toggle = $('[name*="enable_gta6_mode"]');
        if ($gta6Toggle.length) {
            function toggleGta6Fields() {
                var enabled = $gta6Toggle.is(':checked');
                $('.gl-gta6-dependent').toggle(enabled);
            }
            $gta6Toggle.on('change', toggleGta6Fields);
            toggleGta6Fields();
        }

    });

})(jQuery);
