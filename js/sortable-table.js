/**
 * Sortable Table
 *
 * Click column headers to sort tables. Supports string and number sorting.
 * Also provides live search/filter for database tables.
 *
 * @package GtaLobby
 */

(function () {
    'use strict';

    /* =============================================
       SORTABLE TABLES
       ============================================= */

    document.querySelectorAll('[data-sortable]').forEach(function (table) {
        const headers = table.querySelectorAll('th[data-sort]');
        let currentSort = { col: -1, dir: 'asc' };

        headers.forEach(function (th, colIndex) {
            th.style.cursor = 'pointer';
            th.setAttribute('role', 'columnheader');
            th.setAttribute('aria-sort', 'none');

            // Add sort indicator
            const indicator = document.createElement('span');
            indicator.className = 'gl-sort-indicator';
            indicator.textContent = ' ↕';
            indicator.style.opacity = '0.4';
            th.appendChild(indicator);

            th.addEventListener('click', function () {
                const sortType = th.getAttribute('data-sort');
                const tbody    = table.querySelector('tbody');
                if (!tbody) return;

                const rows = Array.from(tbody.querySelectorAll('tr'));

                // Determine direction
                let dir = 'asc';
                if (currentSort.col === colIndex && currentSort.dir === 'asc') {
                    dir = 'desc';
                }
                currentSort = { col: colIndex, dir: dir };

                // Reset all indicators
                headers.forEach(function (h) {
                    const ind = h.querySelector('.gl-sort-indicator');
                    if (ind) {
                        ind.textContent = ' ↕';
                        ind.style.opacity = '0.4';
                    }
                    h.setAttribute('aria-sort', 'none');
                });

                // Set current indicator
                indicator.textContent = dir === 'asc' ? ' ↑' : ' ↓';
                indicator.style.opacity = '1';
                th.setAttribute('aria-sort', dir === 'asc' ? 'ascending' : 'descending');

                // Sort rows
                rows.sort(function (a, b) {
                    const cellA = a.querySelectorAll('td')[colIndex];
                    const cellB = b.querySelectorAll('td')[colIndex];
                    if (!cellA || !cellB) return 0;

                    let valA = cellA.textContent.trim();
                    let valB = cellB.textContent.trim();

                    if (sortType === 'number') {
                        valA = parseFloat(valA.replace(/[^0-9.-]/g, '')) || 0;
                        valB = parseFloat(valB.replace(/[^0-9.-]/g, '')) || 0;
                        return dir === 'asc' ? valA - valB : valB - valA;
                    }

                    // String comparison
                    valA = valA.toLowerCase();
                    valB = valB.toLowerCase();
                    if (valA < valB) return dir === 'asc' ? -1 : 1;
                    if (valA > valB) return dir === 'asc' ? 1 : -1;
                    return 0;
                });

                // Re-append sorted rows
                rows.forEach(function (row) {
                    tbody.appendChild(row);
                });
            });
        });
    });

    /* =============================================
       TABLE SEARCH / FILTER
       ============================================= */

    document.querySelectorAll('[data-table-search]').forEach(function (input) {
        const wrapper = input.closest('.gl-database');
        if (!wrapper) return;

        const table   = wrapper.querySelector('table');
        const counter = wrapper.querySelector('[data-table-count]');
        if (!table) return;

        const tbody = table.querySelector('tbody');
        if (!tbody) return;

        input.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows  = tbody.querySelectorAll('tr');
            let visible = 0;

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                if (!query || text.includes(query)) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (counter) {
                counter.textContent = visible;
            }
        });
    });

})();
