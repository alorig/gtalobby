<?php
/**
 * Search Form Template
 *
 * @package GtaLobby
 */
?>
<form role="search" method="get" class="gl-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="gl-sr-only" for="gl-search-input"><?php esc_html_e( 'Search for:', 'gtalobby' ); ?></label>
    <div class="gl-search-form__wrapper">
        <input type="search" id="gl-search-input" class="gl-search-form__input" placeholder="<?php esc_attr_e( 'Search GtaLobby...', 'gtalobby' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="gl-search-form__btn">
            <svg class="gl-icon" width="18" height="18"><use href="#icon-search"/></svg>
            <span class="gl-sr-only"><?php esc_html_e( 'Search', 'gtalobby' ); ?></span>
        </button>
    </div>
</form>
