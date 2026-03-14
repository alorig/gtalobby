<?php
/**
 * GtaLobby — Color System
 *
 * Manages color token overrides from admin settings.
 * Outputs dynamic CSS custom properties based on saved options.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the full color configuration (defaults + saved overrides).
 */
function gtalobby_get_color_overrides() {
    $saved_new    = get_option( 'gtalobby_color_options', array() );
    $saved_legacy = get_option( 'gtalobby_colors', array() );
    $saved        = wp_parse_args( $saved_new, $saved_legacy );

    if ( ! is_array( $saved ) || empty( $saved ) ) {
        return array();
    }

    $map = array(
        'color_background'      => 'bg',
        'color_surface'         => 'surface',
        'color_text_primary'    => 'text',
        'color_text_secondary'  => 'text_secondary',
        'color_accent'          => 'accent',
        'color_accent_secondary'=> 'secondary',
        'color_border'          => 'border',
        'color_divider'         => 'divider',
    );

    $overrides = array();
    foreach ( $saved as $key => $value ) {
        $value = sanitize_hex_color( $value );
        if ( empty( $value ) ) {
            continue;
        }

        if ( isset( $map[ $key ] ) ) {
            $overrides[ $map[ $key ] ] = $value;
            continue;
        }

        if ( strpos( $key, 'category_' ) === 0 ) {
            $slug = str_replace( 'category_', '', $key );
            if ( ! empty( $slug ) ) {
                $overrides[ 'cat_' . $slug ] = $value;
            }
            continue;
        }

        if ( strpos( $key, 'cat_' ) === 0 ) {
            $overrides[ $key ] = $value;
            continue;
        }

        $overrides[ $key ] = $value;
    }

    return $overrides;
}

function gtalobby_get_color_config() {
    $defaults = array(
        // Base (Vice Streets dark theme)
        'bg'              => '#060714',
        'bg_alt'          => '#0f1328',
        'surface'         => '#0c1030',
        'surface_raised'  => '#13183e',
        'border'          => '#2b3180',
        'divider'         => '#1b214f',

        // Text
        'text'            => '#EAF2FF',
        'text_secondary'  => '#A9B4DB',
        'text_tertiary'   => '#8E9ECC',
        'text_inverse'    => '#0D1223',

        // Primary Accent (neon magenta/purple)
        'accent'          => '#FF2C98',
        'accent_light'    => '#FF73C2',
        'accent_dark'     => '#A42877',
        'accent_tint'     => '#35245e',

        // Secondary Accent (neon cyan)
        'secondary'       => '#27D9FF',
        'secondary_light' => '#8CE9FF',
        'secondary_dark'  => '#00A6C8',
        'secondary_tint'  => '#1B4056',

        // Semantic
        'confirmed'       => '#00B894',
        'likely'          => '#0984E3',
        'rumored'         => '#FDCB6E',
        'speculative'     => '#E17055',
        'success'         => '#00B894',
        'warning'         => '#FDCB6E',
        'error'           => '#D63031',

        // Category Accents (vice neon palette)
        'cat_gta6'        => '#FF2C98',
        'cat_cheats'      => '#FF6A4E',
        'cat_online'      => '#27D9FF',
        'cat_mods'        => '#3BB79E',
        'cat_cars'        => '#FDD976',
        'cat_characters'  => '#E14ECF',
        'cat_locations'   => '#4F9BFF',
        'cat_money'       => '#F9C02D',
        'cat_news'        => '#8E98C6',
    );

    $overrides = gtalobby_get_color_overrides();
    return wp_parse_args( $overrides, $defaults );
}

/**
 * Generate a tint color (very light version) from a hex color.
 */
function gtalobby_generate_tint( $hex, $amount = 0.92 ) {
    $hex = ltrim( $hex, '#' );
    $r   = hexdec( substr( $hex, 0, 2 ) );
    $g   = hexdec( substr( $hex, 2, 2 ) );
    $b   = hexdec( substr( $hex, 4, 2 ) );

    $r = round( $r + ( 255 - $r ) * $amount );
    $g = round( $g + ( 255 - $g ) * $amount );
    $b = round( $b + ( 255 - $b ) * $amount );

    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

/**
 * Convert hex to RGB string.
 */
function gtalobby_hex_to_rgb( $hex ) {
    $hex = ltrim( $hex, '#' );
    return hexdec( substr( $hex, 0, 2 ) ) . ', '
         . hexdec( substr( $hex, 2, 2 ) ) . ', '
         . hexdec( substr( $hex, 4, 2 ) );
}

/**
 * Output dynamic color CSS custom properties in <head>.
 * Only outputs overrides — the static defaults are in design-tokens.css.
 */
function gtalobby_output_dynamic_colors() {
    $defaults  = gtalobby_get_color_config();
    $overrides = gtalobby_get_color_overrides();

    if ( empty( $overrides ) ) {
        return;
    }

    $css = ':root {' . PHP_EOL;

    $map = array(
        'bg'              => '--gl-color-bg',
        'bg_alt'          => '--gl-color-bg-alt',
        'surface'         => '--gl-color-surface',
        'surface_raised'  => '--gl-color-surface-raised',
        'border'          => '--gl-color-border',
        'divider'         => '--gl-color-divider',
        'text'            => '--gl-color-text',
        'text_secondary'  => '--gl-color-text-secondary',
        'text_tertiary'   => '--gl-color-text-tertiary',
        'text_inverse'    => '--gl-color-text-inverse',
        'accent'          => '--gl-color-accent',
        'accent_light'    => '--gl-color-accent-light',
        'accent_dark'     => '--gl-color-accent-dark',
        'accent_tint'     => '--gl-color-accent-tint',
        'secondary'       => '--gl-color-secondary',
        'secondary_light' => '--gl-color-secondary-light',
        'secondary_dark'  => '--gl-color-secondary-dark',
        'secondary_tint'  => '--gl-color-secondary-tint',
        'confirmed'       => '--gl-color-confirmed',
        'likely'          => '--gl-color-likely',
        'rumored'         => '--gl-color-rumored',
        'speculative'     => '--gl-color-speculative',
        'cat_gta6'        => '--gl-color-cat-gta6',
        'cat_cheats'      => '--gl-color-cat-cheats',
        'cat_online'      => '--gl-color-cat-online',
        'cat_mods'        => '--gl-color-cat-mods',
        'cat_cars'        => '--gl-color-cat-cars',
        'cat_characters'  => '--gl-color-cat-characters',
        'cat_locations'   => '--gl-color-cat-locations',
        'cat_money'       => '--gl-color-cat-money',
        'cat_news'        => '--gl-color-cat-news',
    );

    foreach ( $overrides as $key => $value ) {
        if ( isset( $map[ $key ] ) && $value ) {
            $css .= '    ' . $map[ $key ] . ': ' . esc_attr( $value ) . ';' . PHP_EOL;

            // Auto-generate tints for category colors
            if ( strpos( $key, 'cat_' ) === 0 ) {
                $tint_var = str_replace( 'cat_', 'cat_', $key ) . '-tint';
                $tint_css_var = $map[ $key ] . '-tint';
                $css .= '    ' . $tint_css_var . ': ' . gtalobby_generate_tint( $value ) . ';' . PHP_EOL;
            }
        }

        // RGB version for accent
        if ( $key === 'accent' && $value ) {
            $css .= '    --gl-color-accent-rgb: ' . gtalobby_hex_to_rgb( $value ) . ';' . PHP_EOL;
        }
    }

    $css .= '}' . PHP_EOL;

    echo '<style id="gtalobby-dynamic-colors">' . PHP_EOL . $css . '</style>' . PHP_EOL;
}
add_action( 'wp_head', 'gtalobby_output_dynamic_colors', 5 );

/**
 * Get the typography configuration.
 */
function gtalobby_get_typography_config() {
    $defaults = array(
        'font_display'  => 'Space Grotesk',
        'font_body'     => 'Inter',
        'font_mono'     => 'JetBrains Mono',
        'base_size'     => '17',      // px
        'scale'         => '1.25',    // type scale ratio
        'body_weight'   => '400',
        'heading_weight' => '700',
        'line_height'   => '1.7',
        'letter_spacing_headings' => '-0.02',  // em
    );

    $saved = get_option( 'gtalobby_typography', array() );
    return wp_parse_args( $saved, $defaults );
}

/**
 * Get Google Fonts URL based on typography config.
 */
function gtalobby_get_google_fonts_url() {
    $typo = gtalobby_get_typography_config();

    $families = array();

    // Display font
    $display = str_replace( ' ', '+', $typo['font_display'] );
    $families[] = "family={$display}:wght@400;500;600;700";

    // Body font
    $body = str_replace( ' ', '+', $typo['font_body'] );
    $families[] = "family={$body}:wght@400;500;600;700";

    // Mono font
    $mono = str_replace( ' ', '+', $typo['font_mono'] );
    $families[] = "family={$mono}:wght@400;500;700";

    $url = 'https://fonts.googleapis.com/css2?' . implode( '&', $families ) . '&display=swap';

    return $url;
}

/**
 * Output dynamic typography overrides.
 */
function gtalobby_output_dynamic_typography() {
    $saved = get_option( 'gtalobby_typography', array() );
    if ( empty( $saved ) ) {
        return;
    }

    $typo = gtalobby_get_typography_config();

    $css = ':root {' . PHP_EOL;

    if ( isset( $saved['font_display'] ) ) {
        $css .= "    --gl-font-display: '{$typo['font_display']}', -apple-system, BlinkMacSystemFont, sans-serif;" . PHP_EOL;
    }
    if ( isset( $saved['font_body'] ) ) {
        $css .= "    --gl-font-body: '{$typo['font_body']}', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;" . PHP_EOL;
    }
    if ( isset( $saved['font_mono'] ) ) {
        $css .= "    --gl-font-mono: '{$typo['font_mono']}', 'Consolas', monospace;" . PHP_EOL;
    }
    if ( isset( $saved['base_size'] ) ) {
        $size_rem = $typo['base_size'] / 16;
        $css .= "    --gl-text-base: {$size_rem}rem;" . PHP_EOL;
    }
    if ( isset( $saved['line_height'] ) ) {
        $css .= "    --gl-leading-relaxed: {$typo['line_height']};" . PHP_EOL;
    }

    $css .= '}' . PHP_EOL;

    echo '<style id="gtalobby-dynamic-typography">' . PHP_EOL . $css . '</style>' . PHP_EOL;
}
add_action( 'wp_head', 'gtalobby_output_dynamic_typography', 6 );
