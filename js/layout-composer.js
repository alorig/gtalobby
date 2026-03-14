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

        var ajaxUrl = gtalobbyLayout.ajaxUrl;
        var nonce   = gtalobbyLayout.nonce;
        var i18n    = gtalobbyLayout.i18n || {};

        /* =============================================
           SORTABLE ZONES
           ============================================= */

        var $zoneList = $composer.find('.gl-zone-list');

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
           ZONE ENABLE/DISABLE VISUAL FEEDBACK
           ============================================= */

        $composer.on('change', '.gl-zone-item__enabled input', function () {
            var $item = $(this).closest('.gl-zone-item');
            if ($(this).is(':checked')) {
                $item.removeClass('gl-zone-item--disabled').addClass('gl-zone-item--enabled');
            } else {
                $item.removeClass('gl-zone-item--enabled').addClass('gl-zone-item--disabled');
            }
        });

        /* =============================================
           CONTEXT SWITCH (via nav tabs — page reload)
           ============================================= */

        var $categorySelect = $composer.find('.gl-layout-composer__category');
        if (!$categorySelect.length) {
            $categorySelect = $('#gl-category-override');
        }

        $categorySelect.on('change', function () {
            var category = $(this).val() || '';
            // Read current context from the composer data attribute
            var context = $composer.data('context') || 'hub';
            var url = window.location.pathname + '?page=gtalobby-layout&context=' + context;
            if (category) {
                url += '&category=' + category;
            }
            window.location.href = url;
        });

        /* =============================================
           DIRTY STATE
           ============================================= */

        var isDirty = false;

        function markDirty() {
            isDirty = true;
            $composer.find('.gl-layout-save-btn').addClass('button-primary');
            $composer.find('.gl-layout-status').text('');
        }

        // Any input change marks dirty
        $composer.on('change', '.gl-zone-item :input', function () {
            markDirty();
        });

        /* =============================================
           COLLECT ZONE DATA
           ============================================= */

        function collectZones() {
            var zones = {};
            var orderIndex = 0;

            $zoneList.find('.gl-zone-item').each(function () {
                var $zone  = $(this);
                var zoneId = $zone.data('zone-id');
                if (!zoneId) return;

                orderIndex += 10;

                var zoneData = {
                    order:   orderIndex,
                    enabled: $zone.find('.gl-zone-item__enabled input').is(':checked') ? true : false
                };

                // Collect all data-field inputs from the body
                $zone.find('[data-field]').each(function () {
                    var field = $(this).data('field');
                    var val   = $(this).val();

                    // Convert numeric fields
                    if (field === 'columns' || field === 'count' || field === 'per_page') {
                        val = parseInt(val, 10) || 0;
                    }

                    zoneData[field] = val;
                });

                zones[zoneId] = zoneData;
            });

            return zones;
        }

        /* =============================================
           SAVE LAYOUT
           ============================================= */

        $composer.on('click', '.gl-layout-save-btn', function (e) {
            e.preventDefault();
            var $btn = $(this);
            $btn.prop('disabled', true).text(i18n.saving || 'Saving…');

            var context  = $composer.data('context') || 'hub';
            var category = $composer.data('category') || '';
            var zones    = collectZones();

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
                        $btn.removeClass('button-primary');
                        $composer.find('.gl-layout-status')
                            .text(i18n.saved || 'Layout saved!')
                            .css('color', '#00a32a');
                        setTimeout(function () {
                            $btn.text('Save Layout');
                            $composer.find('.gl-layout-status').text('');
                        }, 2500);
                    } else {
                        alert('Save failed: ' + (response.data || 'Unknown error'));
                        $btn.text('Save Layout');
                    }
                },
                error: function () {
                    alert(i18n.error || 'Error saving layout.');
                    $btn.text('Save Layout');
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
            if (!confirm(i18n.resetConfirm || 'Reset layout to defaults? This cannot be undone.')) return;

            var $btn     = $(this);
            var context  = $composer.data('context') || 'hub';
            var category = $composer.data('category') || '';

            $btn.prop('disabled', true).text('Resetting…');

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
                    $btn.prop('disabled', false).text('Reset to Default');
                }
            });
        });

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
