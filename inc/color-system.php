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
        // Backgrounds & Surfaces
        'color_background'      => 'bg',
        'color_bg_alt'          => 'bg_alt',
        'color_surface'         => 'surface',
        'color_surface_raised'  => 'surface_raised',
        'color_overlay'         => 'overlay',
        // Text
        'color_text_primary'    => 'text',
        'color_text_secondary'  => 'text_secondary',
        'color_text_tertiary'   => 'text_tertiary',
        'color_text_inverse'    => 'text_inverse',
        // Borders & Layout
        'color_border'          => 'border',
        'color_divider'         => 'divider',
        'color_footer_bg'       => 'footer_bg',
        // Primary Accent
        'color_accent'          => 'accent',
        'color_accent_light'    => 'accent_light',
        'color_accent_dark'     => 'accent_dark',
        'color_accent_tint'     => 'accent_tint',
        // Secondary Accent
        'color_accent_secondary'=> 'secondary',
        'color_secondary_light' => 'secondary_light',
        'color_secondary_dark'  => 'secondary_dark',
        'color_secondary_tint'  => 'secondary_tint',
        // Semantic
        'color_confirmed'       => 'confirmed',
        'color_likely'          => 'likely',
        'color_rumored'         => 'rumored',
        'color_speculative'     => 'speculative',
        'color_success'         => 'success',
        'color_warning'         => 'warning',
        'color_error'           => 'error',
        'color_info'            => 'info',
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
        'overlay'         => '#111635',
        'border'          => '#2b3180',
        'divider'         => '#1b214f',
        'footer_bg'       => '#181B22',

        // Text
        'text'            => '#EAF2FF',
        'text_secondary'  => '#A9B4DB',
        'text_tertiary'   => '#8E9ECC',
        'text_inverse'    => '#0D1223',

        // Primary Accent (neon magenta)
        'accent'          => '#FF2C98',
        'accent_light'    => '#FF88C3',
        'accent_dark'     => '#A41869',
        'accent_tint'     => '#371C4B',

        // Secondary Accent (cyber cyan)
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
        'info'            => '#0984E3',

        // Category Accents (synced with design-tokens.css)
        'cat_gta6'        => '#6C5CE7',
        'cat_cheats'      => '#E17055',
        'cat_online'      => '#00CEC9',
        'cat_mods'        => '#00B894',
        'cat_cars'        => '#FDCB6E',
        'cat_characters'  => '#E84393',
        'cat_locations'   => '#0984E3',
        'cat_money'       => '#F9A825',
        'cat_news'        => '#636E72',
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
 * Generate a darkened color from a hex (0..1, e.g. 0.20 = 20% darker).
 */
function gtalobby_darken_hex( $hex, $amount = 0.25 ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) !== 6 ) {
        return '#000000';
    }

    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );

    $r = (int) max( 0, min( 255, round( $r * ( 1 - $amount ) ) ) );
    $g = (int) max( 0, min( 255, round( $g * ( 1 - $amount ) ) ) );
    $b = (int) max( 0, min( 255, round( $b * ( 1 - $amount ) ) ) );

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
        // Backgrounds & Surfaces
        'bg'              => '--gl-color-bg',
        'bg_alt'          => '--gl-color-bg-alt',
        'surface'         => '--gl-color-surface',
        'surface_raised'  => '--gl-color-surface-raised',
        'overlay'         => '--gl-color-overlay',
        'border'          => '--gl-color-border',
        'divider'         => '--gl-color-divider',
        'footer_bg'       => '--gl-color-footer-bg',
        // Text
        'text'            => '--gl-color-text',
        'text_secondary'  => '--gl-color-text-secondary',
        'text_tertiary'   => '--gl-color-text-tertiary',
        'text_inverse'    => '--gl-color-text-inverse',
        // Primary Accent
        'accent'          => '--gl-color-accent',
        'accent_light'    => '--gl-color-accent-light',
        'accent_dark'     => '--gl-color-accent-dark',
        'accent_tint'     => '--gl-color-accent-tint',
        // Secondary Accent
        'secondary'       => '--gl-color-secondary',
        'secondary_light' => '--gl-color-secondary-light',
        'secondary_dark'  => '--gl-color-secondary-dark',
        'secondary_tint'  => '--gl-color-secondary-tint',
        // Semantic
        'confirmed'       => '--gl-color-confirmed',
        'likely'          => '--gl-color-likely',
        'rumored'         => '--gl-color-rumored',
        'speculative'     => '--gl-color-speculative',
        'success'         => '--gl-color-success',
        'warning'         => '--gl-color-warning',
        'error'           => '--gl-color-error',
        'info'            => '--gl-color-info',
        // Categories
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
            // Overlay needs rgba output (hex with 60% opacity)
            if ( $key === 'overlay' ) {
                $css .= '    ' . $map[ $key ] . ': rgba(' . gtalobby_hex_to_rgb( $value ) . ', 0.6);' . PHP_EOL;
            } else {
                $css .= '    ' . $map[ $key ] . ': ' . esc_attr( $value ) . ';' . PHP_EOL;
            }

            // Auto-generate tints for category colors
            if ( strpos( $key, 'cat_' ) === 0 ) {
                $tint_css_var = $map[ $key ] . '-tint';
                $css .= '    ' . $tint_css_var . ': ' . gtalobby_generate_tint( $value ) . ';' . PHP_EOL;
            }
        }

        // RGB versions for accent and secondary
        if ( $key === 'accent' && $value ) {
            $css .= '    --gl-color-accent-rgb: ' . gtalobby_hex_to_rgb( $value ) . ';' . PHP_EOL;
        }
        if ( $key === 'secondary' && $value ) {
            $css .= '    --gl-color-secondary-rgb: ' . gtalobby_hex_to_rgb( $value ) . ';' . PHP_EOL;
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
