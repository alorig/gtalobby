/**
 * Layout Composer JS
 *
 * Drag-and-drop zone ordering, zone toggle, expand/collapse,
 * category override switching, AJAX save/reset.
 *
 * @package GtaLobby
 */

(function ($) {
    'use strict';

    $(document).ready(function () {

        var $composer = $('.gl-layout-composer');
        if (!$composer.length) return;

        var ajaxUrl  = (typeof gtalobbyLayout !== 'undefined') ? gtalobbyLayout.ajaxUrl : ajaxurl;
        var nonce    = (typeof gtalobbyLayout !== 'undefined') ? gtalobbyLayout.nonce : '';

        /* =============================================
           SORTABLE ZONES
           ============================================= */

        var $zoneList = $('.gl-zone-list');

        if ($zoneList.length && $.fn.sortable) {
            $zoneList.sortable({
                handle: '.gl-zone-item__drag',
                placeholder: 'gl-zone-item--placeholder',
                opacity: 0.8,
                revert: 150,
                update: function () {
                    markDirty();
                }
            });
        }

        /* =============================================
           ZONE EXPAND / COLLAPSE
           ============================================= */

        $composer.on('click', '.gl-zone-item__toggle', function (e) {
            e.preventDefault();
            var $item = $(this).closest('.gl-zone-item');
            $item.toggleClass('is-expanded');
            $(this).text($item.hasClass('is-expanded') ? 'Collapse' : 'Expand');
        });

        /* =============================================
           CONTEXT SWITCH
           ============================================= */

        var $contextSelect  = $('.gl-layout-composer__context');
        var $categorySelect = $('.gl-layout-composer__category');

        $contextSelect.on('change', function () {
            loadLayout();
        });

        $categorySelect.on('change', function () {
            loadLayout();
        });

        /* =============================================
           SAVE LAYOUT
           ============================================= */

        var isDirty = false;

        function markDirty() {
            isDirty = true;
            $('.gl-layout-save-btn').addClass('button-primary');
        }

        $composer.on('change', '.gl-zone-item :input', function () {
            markDirty();
        });

        $composer.on('click', '.gl-layout-save-btn', function (e) {
            e.preventDefault();
            var $btn = $(this);
            $btn.prop('disabled', true).text('Saving...');

            var context  = $contextSelect.val() || 'hub';
            var category = $categorySelect.val() || '';
            var zones    = [];

            $zoneList.find('.gl-zone-item').each(function () {
                var $zone = $(this);
                zones.push({
                    id:          $zone.data('zone-id'),
                    enabled:     $zone.find('.gl-zone-item__enabled input').is(':checked'),
                    card_variant: $zone.find('[name*="card_variant"]').val() || 'standard',
                    per_page:    $zone.find('[name*="per_page"]').val() || '',
                    columns:     $zone.find('[name*="columns"]').val() || '',
                });
            });

            $.ajax({
                url: ajaxUrl,
                method: 'POST',
                data: {
                    action:   'gtalobby_save_layout',
                    nonce:    nonce,
                    context:  context,
                    category: category,
                    zones:    JSON.stringify(zones),
                },
                success: function (response) {
                    if (response.success) {
                        isDirty = false;
                        $btn.removeClass('button-primary').text('Saved ✓');
                        setTimeout(function () {
                            $btn.text('Save Layout');
                        }, 2000);
                    } else {
                        alert('Save failed: ' + (response.data || 'Unknown error'));
                    }
                },
                error: function () {
                    alert('Save failed: Network error');
                },
                complete: function () {
                    $btn.prop('disabled', false);
                }
            });
        });

        /* =============================================
           RESET LAYOUT
           ============================================= */

        $composer.on('click', '.gl-layout-reset-btn', function (e) {
            e.preventDefault();
            if (!confirm('Reset layout to defaults? This cannot be undone.')) return;

            var $btn     = $(this);
            var context  = $contextSelect.val() || 'hub';
            var category = $categorySelect.val() || '';

            $btn.prop('disabled', true).text('Resetting...');

            $.ajax({
                url: ajaxUrl,
                method: 'POST',
                data: {
                    action:   'gtalobby_reset_layout',
                    nonce:    nonce,
                    context:  context,
                    category: category,
                },
                success: function (response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Reset failed.');
                    }
                },
                error: function () {
                    alert('Reset failed: Network error');
                },
                complete: function () {
                    $btn.prop('disabled', false).text('Reset to Defaults');
                }
            });
        });

        /* =============================================
           LOAD LAYOUT (for context/category switch)
           ============================================= */

        function loadLayout() {
            // Reload the page with new params for simplicity
            var context  = $contextSelect.val() || 'hub';
            var category = $categorySelect.val() || '';
            var url = window.location.pathname + '?page=gtalobby-layout&context=' + context;
            if (category) {
                url += '&category=' + category;
            }
            window.location.href = url;
        }

        /* =============================================
           UNSAVED CHANGES WARNING
           ============================================= */

        $(window).on('beforeunload', function () {
            if (isDirty) {
                return 'You have unsaved layout changes.';
            }
        });

    });

})(jQuery);
