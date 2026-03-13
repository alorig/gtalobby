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
function gtalobby_get_color_config() {
    $defaults = array(
        // Base
        'bg'              => '#FAFBFC',
        'bg_alt'          => '#F1F3F5',
        'surface'         => '#F6F8FA',
        'surface_raised'  => '#FFFFFF',
        'border'          => '#E2E6EA',
        'divider'         => '#DEE2E6',

        // Text
        'text'            => '#1A1D23',
        'text_secondary'  => '#4A5568',
        'text_tertiary'   => '#718096',
        'text_inverse'    => '#FFFFFF',

        // Primary Accent
        'accent'          => '#6C5CE7',
        'accent_light'    => '#A29BFE',
        'accent_dark'     => '#4834D4',
        'accent_tint'     => '#F0EDFF',

        // Secondary Accent
        'secondary'       => '#00CEC9',
        'secondary_light' => '#81ECEC',
        'secondary_dark'  => '#00A8A4',
        'secondary_tint'  => '#E8FFFE',

        // Semantic
        'confirmed'       => '#00B894',
        'likely'          => '#0984E3',
        'rumored'         => '#FDCB6E',
        'speculative'     => '#E17055',
        'success'         => '#00B894',
        'warning'         => '#FDCB6E',
        'error'           => '#D63031',

        // Category Accents
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

    $saved = get_option( 'gtalobby_colors', array() );

    return wp_parse_args( $saved, $defaults );
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
    $colors = gtalobby_get_color_config();

    // Only output if there are saved overrides
    $saved = get_option( 'gtalobby_colors', array() );
    if ( empty( $saved ) ) {
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

    foreach ( $saved as $key => $value ) {
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
