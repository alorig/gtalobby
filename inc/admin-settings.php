<?php
/**
 * GtaLobby — Admin Settings
 *
 * Multi-tabbed admin settings panel:
 * - General (site identity, global toggles)
 * - Colors (design token overrides, per-category accents)
 * - Typography (font choices, sizes)
 * - Layout Engine (zone composer, data display rules)
 * - SEO (schema, breadcrumbs, interlinking)
 * - Monetization (ad slots, affiliate)
 * - GTA 6 Manager (confidence levels, anticipation)
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/* ================================================================
   1. ADMIN MENU REGISTRATION
   ================================================================ */

/**
 * Register top-level menu + submenu pages.
 */
function gtalobby_admin_menu() {
    // Top-level menu
    add_menu_page(
        esc_html__( 'GtaLobby Settings', 'gtalobby' ),
        esc_html__( 'GtaLobby', 'gtalobby' ),
        'manage_options',
        'gtalobby-settings',
        'gtalobby_settings_page',
        'dashicons-games',
        3
    );

    // Submenus
    add_submenu_page(
        'gtalobby-settings',
        esc_html__( 'General Settings', 'gtalobby' ),
        esc_html__( 'General', 'gtalobby' ),
        'manage_options',
        'gtalobby-settings',
        'gtalobby_settings_page'
    );

    add_submenu_page(
        'gtalobby-settings',
        esc_html__( 'Layout Engine', 'gtalobby' ),
        esc_html__( 'Layout Engine', 'gtalobby' ),
        'manage_options',
        'gtalobby-layout',
        'gtalobby_layout_page'
    );

    add_submenu_page(
        'gtalobby-settings',
        esc_html__( 'GTA 6 Manager', 'gtalobby' ),
        esc_html__( 'GTA 6 Manager', 'gtalobby' ),
        'manage_options',
        'gtalobby-gta6',
        'gtalobby_gta6_manager_page'
    );
}
add_action( 'admin_menu', 'gtalobby_admin_menu' );

/* ================================================================
   2. SETTINGS API — REGISTER ALL SETTINGS
   ================================================================ */

/**
 * Register all settings groups and fields.
 */
function gtalobby_register_settings() {

    /* --- General Settings Group --- */
    register_setting( 'gtalobby_general', 'gtalobby_general_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_general',
        'default'           => gtalobby_general_defaults(),
    ) );

    /* --- Color Settings Group --- */
    register_setting( 'gtalobby_colors', 'gtalobby_color_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_colors',
        'default'           => array(),
    ) );

    /* --- Typography Settings Group --- */
    register_setting( 'gtalobby_typography', 'gtalobby_typography_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_typography',
        'default'           => array(),
    ) );

    /* --- Layout Settings Group --- */
    register_setting( 'gtalobby_layout', 'gtalobby_layout_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_layout',
        'default'           => array(),
    ) );

    /* --- SEO Settings Group --- */
    register_setting( 'gtalobby_seo', 'gtalobby_seo_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_seo',
        'default'           => gtalobby_seo_defaults(),
    ) );

    /* --- Monetization Settings Group --- */
    register_setting( 'gtalobby_monetization', 'gtalobby_monetization_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_monetization',
        'default'           => array(),
    ) );

    /* --- GTA 6 Settings Group --- */
    register_setting( 'gtalobby_gta6', 'gtalobby_gta6_options', array(
        'type'              => 'array',
        'sanitize_callback' => 'gtalobby_sanitize_gta6',
        'default'           => gtalobby_gta6_defaults(),
    ) );

    /* --- Register Sections & Fields --- */
    gtalobby_register_general_fields();
    gtalobby_register_color_fields();
    gtalobby_register_typography_fields();
    gtalobby_register_seo_fields();
    gtalobby_register_monetization_fields();
    gtalobby_register_gta6_fields();
}
add_action( 'admin_init', 'gtalobby_register_settings' );

/* ================================================================
   3. DEFAULTS
   ================================================================ */

function gtalobby_general_defaults() {
    return array(
        'site_tagline_override' => '',
        'enable_hub_pages'      => true,
        'enable_breadcrumbs'    => true,
        'enable_schema'         => true,
        'enable_interlinking'   => true,
        'enable_gta6_mode'      => true,
        'posts_per_archive'     => 12,
        'posts_per_hub'         => 12,
        'enable_lazy_load'      => true,
        'enable_smooth_scroll'  => true,
        'show_post_type_badge'  => true,
        'show_reading_time'     => true,
        'show_author_box'       => true,
        'show_related_posts'    => true,
        'related_posts_count'   => 6,
        'enable_toc'            => true,
        'toc_min_headings'      => 3,
    );
}

function gtalobby_seo_defaults() {
    return array(
        'enable_json_ld'        => true,
        'enable_breadcrumb_schema' => true,
        'enable_faq_schema'     => true,
        'enable_howto_schema'   => true,
        'enable_article_schema' => true,
        'org_name'              => 'GtaLobby',
        'org_logo_url'          => '',
        'default_og_image'      => '',
        'enable_auto_internal_links' => true,
        'max_auto_links_per_post'    => 5,
        'link_density_target'        => 3,
    );
}

function gtalobby_gta6_defaults() {
    return array(
        'gta6_launch_date'           => '',
        'gta6_countdown_enabled'     => true,
        'gta6_show_confidence_badge' => true,
        'gta6_default_confidence'    => 'medium',
        'gta6_notice_text'           => esc_html__( 'This content is based on pre-release information and may change after GTA 6 launches.', 'gtalobby' ),
        'gta6_accent_override'       => '#6C5CE7',
        'gta6_banner_enabled'        => true,
        'gta6_banner_text'           => '',
        'gta6_banner_link'           => '',
    );
}

/* ================================================================
   4. GENERAL TAB — SECTIONS & FIELDS
   ================================================================ */

function gtalobby_register_general_fields() {
    // Section: Core Features
    add_settings_section(
        'gtalobby_general_core',
        esc_html__( 'Core Features', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Toggle core theme features on/off.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-settings'
    );

    $core_toggles = array(
        'enable_hub_pages'     => esc_html__( 'Enable Hub Pages', 'gtalobby' ),
        'enable_breadcrumbs'   => esc_html__( 'Enable Breadcrumbs', 'gtalobby' ),
        'enable_schema'        => esc_html__( 'Enable Schema / JSON-LD', 'gtalobby' ),
        'enable_interlinking'  => esc_html__( 'Enable Auto Interlinking', 'gtalobby' ),
        'enable_gta6_mode'     => esc_html__( 'Enable GTA 6 Mode', 'gtalobby' ),
        'enable_lazy_load'     => esc_html__( 'Enable Lazy Loading', 'gtalobby' ),
        'enable_smooth_scroll' => esc_html__( 'Enable Smooth Scroll', 'gtalobby' ),
        'show_post_type_badge' => esc_html__( 'Show Post Type Badge', 'gtalobby' ),
        'show_reading_time'    => esc_html__( 'Show Reading Time', 'gtalobby' ),
        'show_author_box'      => esc_html__( 'Show Author Box', 'gtalobby' ),
        'show_related_posts'   => esc_html__( 'Show Related Posts', 'gtalobby' ),
        'enable_toc'           => esc_html__( 'Enable Table of Contents', 'gtalobby' ),
    );

    foreach ( $core_toggles as $key => $label ) {
        add_settings_field(
            'gtalobby_' . $key,
            $label,
            'gtalobby_render_checkbox_field',
            'gtalobby-settings',
            'gtalobby_general_core',
            array(
                'option_group' => 'gtalobby_general_options',
                'field_key'    => $key,
                'label'        => $label,
            )
        );
    }

    // Section: Display Counts
    add_settings_section(
        'gtalobby_general_counts',
        esc_html__( 'Display Counts', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Control how many items appear in different contexts.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-settings'
    );

    $count_fields = array(
        'posts_per_archive'  => array( 'label' => esc_html__( 'Posts per Archive Page', 'gtalobby' ), 'min' => 1, 'max' => 48 ),
        'posts_per_hub'      => array( 'label' => esc_html__( 'Posts per Hub Page', 'gtalobby' ), 'min' => 1, 'max' => 50 ),
        'related_posts_count' => array( 'label' => esc_html__( 'Related Posts Count', 'gtalobby' ), 'min' => 2, 'max' => 12 ),
        'toc_min_headings'   => array( 'label' => esc_html__( 'TOC Minimum Headings', 'gtalobby' ), 'min' => 2, 'max' => 10 ),
    );

    foreach ( $count_fields as $key => $config ) {
        add_settings_field(
            'gtalobby_' . $key,
            $config['label'],
            'gtalobby_render_number_field',
            'gtalobby-settings',
            'gtalobby_general_counts',
            array(
                'option_group' => 'gtalobby_general_options',
                'field_key'    => $key,
                'min'          => $config['min'],
                'max'          => $config['max'],
            )
        );
    }
}

/* ================================================================
   5. COLOR TAB — SECTIONS & FIELDS
   ================================================================ */

function gtalobby_register_color_fields() {

    // Helper to register a group of color fields
    $register_group = function ( $section_id, $fields ) {
        foreach ( $fields as $key => $label ) {
            add_settings_field(
                'gtalobby_' . $key,
                $label,
                'gtalobby_render_color_field',
                'gtalobby-colors',
                $section_id,
                array(
                    'option_group' => 'gtalobby_color_options',
                    'field_key'    => $key,
                )
            );
        }
    };

    /* --- Section: Background & Surface Colors --- */
    add_settings_section(
        'gtalobby_colors_backgrounds',
        esc_html__( 'Background & Surface Colors', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Page backgrounds, card surfaces, and overlay colors. Leave empty to use defaults.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );
    $register_group( 'gtalobby_colors_backgrounds', array(
        'color_background'      => esc_html__( 'Background', 'gtalobby' ),
        'color_bg_alt'          => esc_html__( 'Background Alt', 'gtalobby' ),
        'color_surface'         => esc_html__( 'Surface (Cards)', 'gtalobby' ),
        'color_surface_raised'  => esc_html__( 'Surface Raised (Header)', 'gtalobby' ),
        'color_overlay'         => esc_html__( 'Overlay', 'gtalobby' ),
    ) );

    /* --- Section: Text Colors --- */
    add_settings_section(
        'gtalobby_colors_text',
        esc_html__( 'Text Colors', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Primary, secondary, and tertiary text colors for content hierarchy.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );
    $register_group( 'gtalobby_colors_text', array(
        'color_text_primary'    => esc_html__( 'Primary Text', 'gtalobby' ),
        'color_text_secondary'  => esc_html__( 'Secondary Text', 'gtalobby' ),
        'color_text_tertiary'   => esc_html__( 'Tertiary Text', 'gtalobby' ),
        'color_text_inverse'    => esc_html__( 'Inverse Text (on light bg)', 'gtalobby' ),
    ) );

    /* --- Section: Border & Divider Colors --- */
    add_settings_section(
        'gtalobby_colors_borders',
        esc_html__( 'Border & Divider Colors', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Borders for cards, inputs, and section dividers.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );
    $register_group( 'gtalobby_colors_borders', array(
        'color_border'          => esc_html__( 'Border', 'gtalobby' ),
        'color_divider'         => esc_html__( 'Divider', 'gtalobby' ),
    ) );

    /* --- Section: Primary Accent Colors --- */
    add_settings_section(
        'gtalobby_colors_accent',
        esc_html__( 'Primary Accent (Neon Magenta)', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Main accent color and its variants. Light/dark/tint are auto-generated if left empty.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );
    $register_group( 'gtalobby_colors_accent', array(
        'color_accent'          => esc_html__( 'Accent', 'gtalobby' ),
        'color_accent_light'    => esc_html__( 'Accent Light', 'gtalobby' ),
        'color_accent_dark'     => esc_html__( 'Accent Dark', 'gtalobby' ),
        'color_accent_tint'     => esc_html__( 'Accent Tint (bg tint)', 'gtalobby' ),
    ) );

    /* --- Section: Secondary Accent Colors --- */
    add_settings_section(
        'gtalobby_colors_secondary',
        esc_html__( 'Secondary Accent (Cyber Cyan)', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Secondary accent color and its variants. Light/dark/tint are auto-generated if left empty.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );
    $register_group( 'gtalobby_colors_secondary', array(
        'color_accent_secondary'       => esc_html__( 'Secondary', 'gtalobby' ),
        'color_secondary_light' => esc_html__( 'Secondary Light', 'gtalobby' ),
        'color_secondary_dark'  => esc_html__( 'Secondary Dark', 'gtalobby' ),
        'color_secondary_tint'  => esc_html__( 'Secondary Tint (bg tint)', 'gtalobby' ),
    ) );

    /* --- Section: Semantic / Status Colors --- */
    add_settings_section(
        'gtalobby_colors_semantic',
        esc_html__( 'Semantic / Status Colors', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Colors for confidence badges, alerts, and status indicators.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );
    $register_group( 'gtalobby_colors_semantic', array(
        'color_confirmed'       => esc_html__( 'Confirmed (green)', 'gtalobby' ),
        'color_likely'          => esc_html__( 'Likely (blue)', 'gtalobby' ),
        'color_rumored'         => esc_html__( 'Rumored (yellow)', 'gtalobby' ),
        'color_speculative'     => esc_html__( 'Speculative (orange)', 'gtalobby' ),
        'color_success'         => esc_html__( 'Success', 'gtalobby' ),
        'color_warning'         => esc_html__( 'Warning', 'gtalobby' ),
        'color_error'           => esc_html__( 'Error', 'gtalobby' ),
        'color_info'            => esc_html__( 'Info', 'gtalobby' ),
    ) );

    /* --- Section: Category Accent Colors --- */
    add_settings_section(
        'gtalobby_colors_categories',
        esc_html__( 'Category Accent Colors', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Override accent colors per SAG category. These tint the entire UI when viewing category content.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-colors'
    );

    $sag_categories = gtalobby_get_sag_categories();
    foreach ( $sag_categories as $slug => $name ) {
        add_settings_field(
            'gtalobby_cat_color_' . $slug,
            $name,
            'gtalobby_render_color_field',
            'gtalobby-colors',
            'gtalobby_colors_categories',
            array(
                'option_group' => 'gtalobby_color_options',
                'field_key'    => 'category_' . $slug,
            )
        );
    }
}

/* ================================================================
   6. TYPOGRAPHY TAB — SECTIONS & FIELDS
   ================================================================ */

function gtalobby_register_typography_fields() {
    add_settings_section(
        'gtalobby_typo_fonts',
        esc_html__( 'Font Families', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Choose fonts for display, body, and monospace contexts.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-typography'
    );

    $font_fields = array(
        'font_display' => array(
            'label'   => esc_html__( 'Display / Heading Font', 'gtalobby' ),
            'default' => 'Space Grotesk',
        ),
        'font_body' => array(
            'label'   => esc_html__( 'Body Font', 'gtalobby' ),
            'default' => 'Inter',
        ),
        'font_mono' => array(
            'label'   => esc_html__( 'Monospace / Data Font', 'gtalobby' ),
            'default' => 'JetBrains Mono',
        ),
    );

    foreach ( $font_fields as $key => $config ) {
        add_settings_field(
            'gtalobby_' . $key,
            $config['label'],
            'gtalobby_render_text_field',
            'gtalobby-typography',
            'gtalobby_typo_fonts',
            array(
                'option_group' => 'gtalobby_typography_options',
                'field_key'    => $key,
                'default'      => $config['default'],
                'placeholder'  => $config['default'],
            )
        );
    }

    // Section: Font Sizes
    add_settings_section(
        'gtalobby_typo_sizes',
        esc_html__( 'Font Sizing', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Base size and scale ratio for the modular type scale.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-typography'
    );

    add_settings_field(
        'gtalobby_font_base_size',
        esc_html__( 'Base Font Size (px)', 'gtalobby' ),
        'gtalobby_render_number_field',
        'gtalobby-typography',
        'gtalobby_typo_sizes',
        array(
            'option_group' => 'gtalobby_typography_options',
            'field_key'    => 'font_base_size',
            'min'          => 14,
            'max'          => 22,
        )
    );

    add_settings_field(
        'gtalobby_font_scale_ratio',
        esc_html__( 'Scale Ratio', 'gtalobby' ),
        'gtalobby_render_select_field',
        'gtalobby-typography',
        'gtalobby_typo_sizes',
        array(
            'option_group' => 'gtalobby_typography_options',
            'field_key'    => 'font_scale_ratio',
            'choices'      => array(
                '1.125' => '1.125 — Major Second',
                '1.200' => '1.200 — Minor Third',
                '1.250' => '1.250 — Major Third (default)',
                '1.333' => '1.333 — Perfect Fourth',
                '1.414' => '1.414 — Augmented Fourth',
            ),
        )
    );
}

/* ================================================================
   7. SEO TAB — SECTIONS & FIELDS
   ================================================================ */

function gtalobby_register_seo_fields() {
    add_settings_section(
        'gtalobby_seo_schema',
        esc_html__( 'Structured Data (Schema)', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Control JSON-LD schema output. Disable if using Yoast/RankMath schema.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-seo'
    );

    $seo_toggles = array(
        'enable_json_ld'          => esc_html__( 'Enable JSON-LD Output', 'gtalobby' ),
        'enable_breadcrumb_schema' => esc_html__( 'Breadcrumb Schema', 'gtalobby' ),
        'enable_faq_schema'       => esc_html__( 'FAQ Schema', 'gtalobby' ),
        'enable_howto_schema'     => esc_html__( 'HowTo Schema', 'gtalobby' ),
        'enable_article_schema'   => esc_html__( 'Article Schema', 'gtalobby' ),
    );

    foreach ( $seo_toggles as $key => $label ) {
        add_settings_field(
            'gtalobby_' . $key,
            $label,
            'gtalobby_render_checkbox_field',
            'gtalobby-seo',
            'gtalobby_seo_schema',
            array(
                'option_group' => 'gtalobby_seo_options',
                'field_key'    => $key,
                'label'        => $label,
            )
        );
    }

    // Section: Organization Info
    add_settings_section(
        'gtalobby_seo_org',
        esc_html__( 'Organization Info', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Used in Organization schema and as fallback for OG data.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-seo'
    );

    add_settings_field(
        'gtalobby_org_name',
        esc_html__( 'Organization Name', 'gtalobby' ),
        'gtalobby_render_text_field',
        'gtalobby-seo',
        'gtalobby_seo_org',
        array(
            'option_group' => 'gtalobby_seo_options',
            'field_key'    => 'org_name',
            'default'      => 'GtaLobby',
        )
    );

    // Section: Interlinking
    add_settings_section(
        'gtalobby_seo_linking',
        esc_html__( 'Internal Linking', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Control automatic internal link insertion.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-seo'
    );

    add_settings_field(
        'gtalobby_max_auto_links',
        esc_html__( 'Max Auto Links per Post', 'gtalobby' ),
        'gtalobby_render_number_field',
        'gtalobby-seo',
        'gtalobby_seo_linking',
        array(
            'option_group' => 'gtalobby_seo_options',
            'field_key'    => 'max_auto_links_per_post',
            'min'          => 0,
            'max'          => 20,
        )
    );
}

/* ================================================================
   8. MONETIZATION TAB
   ================================================================ */

function gtalobby_register_monetization_fields() {
    add_settings_section(
        'gtalobby_ads_section',
        esc_html__( 'Ad Placements', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Control ad slot visibility and code injection points.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-monetization'
    );

    $ad_slots = array(
        'ad_header_banner'   => esc_html__( 'Header Banner Ad', 'gtalobby' ),
        'ad_sidebar'         => esc_html__( 'Sidebar Ad', 'gtalobby' ),
        'ad_in_content'      => esc_html__( 'In-Content Ad', 'gtalobby' ),
        'ad_after_content'   => esc_html__( 'After Content Ad', 'gtalobby' ),
        'ad_hub_zone'        => esc_html__( 'Hub Page Ad Zone', 'gtalobby' ),
        'ad_archive_between' => esc_html__( 'Archive Between Posts Ad', 'gtalobby' ),
    );

    foreach ( $ad_slots as $key => $label ) {
        add_settings_field(
            'gtalobby_' . $key,
            $label,
            'gtalobby_render_textarea_field',
            'gtalobby-monetization',
            'gtalobby_ads_section',
            array(
                'option_group' => 'gtalobby_monetization_options',
                'field_key'    => $key,
                'rows'         => 4,
                'description'  => esc_html__( 'Paste ad code (HTML/JS). Leave empty to disable.', 'gtalobby' ),
            )
        );
    }
}

/* ================================================================
   9. GTA 6 TAB
   ================================================================ */

function gtalobby_register_gta6_fields() {
    add_settings_section(
        'gtalobby_gta6_section',
        esc_html__( 'GTA 6 Anticipation Settings', 'gtalobby' ),
        function () {
            echo '<p>' . esc_html__( 'Manage GTA 6 pre-launch content display and confidence system.', 'gtalobby' ) . '</p>';
        },
        'gtalobby-gta6'
    );

    add_settings_field(
        'gtalobby_gta6_launch_date',
        esc_html__( 'Expected Launch Date', 'gtalobby' ),
        'gtalobby_render_date_field',
        'gtalobby-gta6',
        'gtalobby_gta6_section',
        array(
            'option_group' => 'gtalobby_gta6_options',
            'field_key'    => 'gta6_launch_date',
        )
    );

    $gta6_toggles = array(
        'gta6_countdown_enabled'     => esc_html__( 'Show Countdown Timer', 'gtalobby' ),
        'gta6_show_confidence_badge' => esc_html__( 'Show Confidence Badge', 'gtalobby' ),
        'gta6_banner_enabled'        => esc_html__( 'Show GTA 6 Banner', 'gtalobby' ),
    );

    foreach ( $gta6_toggles as $key => $label ) {
        add_settings_field(
            'gtalobby_' . $key,
            $label,
            'gtalobby_render_checkbox_field',
            'gtalobby-gta6',
            'gtalobby_gta6_section',
            array(
                'option_group' => 'gtalobby_gta6_options',
                'field_key'    => $key,
                'label'        => $label,
            )
        );
    }

    add_settings_field(
        'gtalobby_gta6_default_confidence',
        esc_html__( 'Default Confidence Level', 'gtalobby' ),
        'gtalobby_render_select_field',
        'gtalobby-gta6',
        'gtalobby_gta6_section',
        array(
            'option_group' => 'gtalobby_gta6_options',
            'field_key'    => 'gta6_default_confidence',
            'choices'      => array(
                'confirmed'   => esc_html__( 'Confirmed', 'gtalobby' ),
                'high'        => esc_html__( 'High', 'gtalobby' ),
                'medium'      => esc_html__( 'Medium', 'gtalobby' ),
                'low'         => esc_html__( 'Low', 'gtalobby' ),
                'speculation' => esc_html__( 'Speculation', 'gtalobby' ),
            ),
        )
    );

    add_settings_field(
        'gtalobby_gta6_notice_text',
        esc_html__( 'Pre-Release Notice Text', 'gtalobby' ),
        'gtalobby_render_textarea_field',
        'gtalobby-gta6',
        'gtalobby_gta6_section',
        array(
            'option_group' => 'gtalobby_gta6_options',
            'field_key'    => 'gta6_notice_text',
            'rows'         => 3,
        )
    );

    add_settings_field(
        'gtalobby_gta6_accent_override',
        esc_html__( 'GTA 6 Accent Color', 'gtalobby' ),
        'gtalobby_render_color_field',
        'gtalobby-gta6',
        'gtalobby_gta6_section',
        array(
            'option_group' => 'gtalobby_gta6_options',
            'field_key'    => 'gta6_accent_override',
        )
    );
}

/* ================================================================
   10. FIELD RENDERERS — Reusable callbacks for Settings API
   ================================================================ */

/**
 * Render a checkbox toggle field.
 */
function gtalobby_render_checkbox_field( $args ) {
    $options = get_option( $args['option_group'], array() );
    $key     = $args['field_key'];
    $checked = isset( $options[ $key ] ) ? (bool) $options[ $key ] : true;
    printf(
        '<label><input type="checkbox" name="%s[%s]" value="1" %s /> %s</label>',
        esc_attr( $args['option_group'] ),
        esc_attr( $key ),
        checked( $checked, true, false ),
        isset( $args['label'] ) ? esc_html( $args['label'] ) : ''
    );
}

/**
 * Render a number input field.
 */
function gtalobby_render_number_field( $args ) {
    $options = get_option( $args['option_group'], array() );
    $key     = $args['field_key'];
    $value   = isset( $options[ $key ] ) ? intval( $options[ $key ] ) : '';
    printf(
        '<input type="number" name="%s[%s]" value="%s" min="%d" max="%d" class="small-text" />',
        esc_attr( $args['option_group'] ),
        esc_attr( $key ),
        esc_attr( $value ),
        isset( $args['min'] ) ? intval( $args['min'] ) : 0,
        isset( $args['max'] ) ? intval( $args['max'] ) : 999
    );
}

/**
 * Render a text input field.
 */
function gtalobby_render_text_field( $args ) {
    $options     = get_option( $args['option_group'], array() );
    $key         = $args['field_key'];
    $value       = isset( $options[ $key ] ) ? $options[ $key ] : ( isset( $args['default'] ) ? $args['default'] : '' );
    $placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
    printf(
        '<input type="text" name="%s[%s]" value="%s" placeholder="%s" class="regular-text" />',
        esc_attr( $args['option_group'] ),
        esc_attr( $key ),
        esc_attr( $value ),
        esc_attr( $placeholder )
    );
}

/**
 * Render a color picker field.
 */
function gtalobby_render_color_field( $args ) {
    $options = get_option( $args['option_group'], array() );
    $key     = $args['field_key'];
    $value   = isset( $options[ $key ] ) ? $options[ $key ] : '';

    $defaults = gtalobby_get_color_config();
    $default_color = '';

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
        // Borders
        'color_border'          => 'border',
        'color_divider'         => 'divider',
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

    if ( isset( $map[ $key ] ) && isset( $defaults[ $map[ $key ] ] ) ) {
        $default_color = $defaults[ $map[ $key ] ];
    } elseif ( strpos( $key, 'category_' ) === 0 ) {
        $slug = str_replace( 'category_', '', $key );
        if ( isset( $defaults[ 'cat_' . $slug ] ) ) {
            $default_color = $defaults[ 'cat_' . $slug ];
        }
    } elseif ( isset( $defaults[ $key ] ) ) {
        $default_color = $defaults[ $key ];
    }

    printf(
        '<input type="text" name="%s[%s]" value="%s" class="gl-color-picker" data-default-color="%s" placeholder="%s" />',
        esc_attr( $args['option_group'] ),
        esc_attr( $key ),
        esc_attr( $value ),
        esc_attr( $default_color ),
        esc_attr( $default_color )
    );
}

/**
 * Render a select dropdown field.
 */
function gtalobby_render_select_field( $args ) {
    $options = get_option( $args['option_group'], array() );
    $key     = $args['field_key'];
    $value   = isset( $options[ $key ] ) ? $options[ $key ] : '';
    $choices = isset( $args['choices'] ) ? $args['choices'] : array();

    printf( '<select name="%s[%s]">', esc_attr( $args['option_group'] ), esc_attr( $key ) );
    foreach ( $choices as $val => $label ) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr( $val ),
            selected( $value, $val, false ),
            esc_html( $label )
        );
    }
    echo '</select>';
}

/**
 * Render a textarea field.
 */
function gtalobby_render_textarea_field( $args ) {
    $options = get_option( $args['option_group'], array() );
    $key     = $args['field_key'];
    $value   = isset( $options[ $key ] ) ? $options[ $key ] : '';
    $rows    = isset( $args['rows'] ) ? intval( $args['rows'] ) : 5;
    printf(
        '<textarea name="%s[%s]" rows="%d" class="large-text">%s</textarea>',
        esc_attr( $args['option_group'] ),
        esc_attr( $key ),
        $rows,
        esc_textarea( $value )
    );
    if ( ! empty( $args['description'] ) ) {
        printf( '<p class="description">%s</p>', esc_html( $args['description'] ) );
    }
}

/**
 * Render a date input field.
 */
function gtalobby_render_date_field( $args ) {
    $options = get_option( $args['option_group'], array() );
    $key     = $args['field_key'];
    $value   = isset( $options[ $key ] ) ? $options[ $key ] : '';
    printf(
        '<input type="date" name="%s[%s]" value="%s" class="regular-text" />',
        esc_attr( $args['option_group'] ),
        esc_attr( $key ),
        esc_attr( $value )
    );
}

/* ================================================================
   11. SANITIZATION CALLBACKS
   ================================================================ */

function gtalobby_sanitize_general( $input ) {
    $defaults  = gtalobby_general_defaults();
    $sanitized = array();

    // Checkboxes — if key not present in $input, it means unchecked
    $checkboxes = array(
        'enable_hub_pages', 'enable_breadcrumbs', 'enable_schema',
        'enable_interlinking', 'enable_gta6_mode', 'enable_lazy_load',
        'enable_smooth_scroll', 'show_post_type_badge', 'show_reading_time',
        'show_author_box', 'show_related_posts', 'enable_toc',
    );
    foreach ( $checkboxes as $key ) {
        $sanitized[ $key ] = ! empty( $input[ $key ] );
    }

    // Numbers
    $sanitized['posts_per_archive']  = isset( $input['posts_per_archive'] ) ? absint( $input['posts_per_archive'] ) : $defaults['posts_per_archive'];
    $sanitized['posts_per_hub']      = isset( $input['posts_per_hub'] ) ? absint( $input['posts_per_hub'] ) : $defaults['posts_per_hub'];
    $sanitized['related_posts_count'] = isset( $input['related_posts_count'] ) ? absint( $input['related_posts_count'] ) : $defaults['related_posts_count'];
    $sanitized['toc_min_headings']   = isset( $input['toc_min_headings'] ) ? absint( $input['toc_min_headings'] ) : $defaults['toc_min_headings'];

    // Text
    $sanitized['site_tagline_override'] = isset( $input['site_tagline_override'] ) ? sanitize_text_field( $input['site_tagline_override'] ) : '';

    return $sanitized;
}

function gtalobby_sanitize_colors( $input ) {
    $sanitized = array();
    if ( is_array( $input ) ) {
        foreach ( $input as $key => $value ) {
            $sanitized[ sanitize_key( $key ) ] = sanitize_hex_color( $value );
        }
    }
    return $sanitized;
}

function gtalobby_sanitize_typography( $input ) {
    $sanitized = array();
    if ( is_array( $input ) ) {
        foreach ( $input as $key => $value ) {
            if ( in_array( $key, array( 'font_base_size' ), true ) ) {
                $sanitized[ $key ] = absint( $value );
            } else {
                $sanitized[ sanitize_key( $key ) ] = sanitize_text_field( $value );
            }
        }
    }
    return $sanitized;
}

function gtalobby_sanitize_layout( $input ) {
    // Layout data is complex (JSON zones) — decode and re-encode safely
    $sanitized = array();
    if ( is_array( $input ) ) {
        foreach ( $input as $key => $value ) {
            if ( is_string( $value ) ) {
                $decoded = json_decode( wp_unslash( $value ), true );
                if ( json_last_error() === JSON_ERROR_NONE ) {
                    $sanitized[ sanitize_key( $key ) ] = $decoded;
                } else {
                    $sanitized[ sanitize_key( $key ) ] = sanitize_text_field( $value );
                }
            } elseif ( is_array( $value ) ) {
                $sanitized[ sanitize_key( $key ) ] = array_map( 'sanitize_text_field', $value );
            }
        }
    }
    return $sanitized;
}

function gtalobby_sanitize_seo( $input ) {
    $sanitized = array();
    $checkboxes = array(
        'enable_json_ld', 'enable_breadcrumb_schema', 'enable_faq_schema',
        'enable_howto_schema', 'enable_article_schema', 'enable_auto_internal_links',
    );
    foreach ( $checkboxes as $key ) {
        $sanitized[ $key ] = ! empty( $input[ $key ] );
    }

    $sanitized['org_name']               = isset( $input['org_name'] ) ? sanitize_text_field( $input['org_name'] ) : '';
    $sanitized['org_logo_url']           = isset( $input['org_logo_url'] ) ? esc_url_raw( $input['org_logo_url'] ) : '';
    $sanitized['default_og_image']       = isset( $input['default_og_image'] ) ? esc_url_raw( $input['default_og_image'] ) : '';
    $sanitized['max_auto_links_per_post'] = isset( $input['max_auto_links_per_post'] ) ? absint( $input['max_auto_links_per_post'] ) : 5;
    $sanitized['link_density_target']    = isset( $input['link_density_target'] ) ? absint( $input['link_density_target'] ) : 3;

    return $sanitized;
}

function gtalobby_sanitize_monetization( $input ) {
    $sanitized = array();
    if ( is_array( $input ) ) {
        foreach ( $input as $key => $value ) {
            // Allow HTML/JS in ad slots but strip evil stuff
            $sanitized[ sanitize_key( $key ) ] = wp_kses( $value, array(
                'script' => array( 'src' => true, 'async' => true, 'defer' => true, 'type' => true ),
                'ins'    => array( 'class' => true, 'style' => true, 'data-ad-client' => true, 'data-ad-slot' => true, 'data-ad-format' => true ),
                'div'    => array( 'class' => true, 'id' => true, 'style' => true ),
                'iframe' => array( 'src' => true, 'width' => true, 'height' => true, 'frameborder' => true ),
            ) );
        }
    }
    return $sanitized;
}

function gtalobby_sanitize_gta6( $input ) {
    $sanitized = array();

    $sanitized['gta6_launch_date']           = isset( $input['gta6_launch_date'] ) ? sanitize_text_field( $input['gta6_launch_date'] ) : '';
    $sanitized['gta6_countdown_enabled']     = ! empty( $input['gta6_countdown_enabled'] );
    $sanitized['gta6_show_confidence_badge'] = ! empty( $input['gta6_show_confidence_badge'] );
    $sanitized['gta6_banner_enabled']        = ! empty( $input['gta6_banner_enabled'] );

    $valid_levels = array( 'confirmed', 'high', 'medium', 'low', 'speculation' );
    $sanitized['gta6_default_confidence'] = isset( $input['gta6_default_confidence'] ) && in_array( $input['gta6_default_confidence'], $valid_levels, true )
        ? $input['gta6_default_confidence']
        : 'medium';

    $sanitized['gta6_notice_text']      = isset( $input['gta6_notice_text'] ) ? sanitize_textarea_field( $input['gta6_notice_text'] ) : '';
    $sanitized['gta6_accent_override']  = isset( $input['gta6_accent_override'] ) ? sanitize_hex_color( $input['gta6_accent_override'] ) : '';
    $sanitized['gta6_banner_text']      = isset( $input['gta6_banner_text'] ) ? sanitize_text_field( $input['gta6_banner_text'] ) : '';
    $sanitized['gta6_banner_link']      = isset( $input['gta6_banner_link'] ) ? esc_url_raw( $input['gta6_banner_link'] ) : '';

    return $sanitized;
}

/* ================================================================
   12. SETTINGS PAGE RENDERERS
   ================================================================ */

/**
 * Main settings page with tabbed interface.
 */
function gtalobby_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
    $tabs = array(
        'general'       => esc_html__( 'General', 'gtalobby' ),
        'colors'        => esc_html__( 'Colors', 'gtalobby' ),
        'typography'    => esc_html__( 'Typography', 'gtalobby' ),
        'seo'           => esc_html__( 'SEO', 'gtalobby' ),
        'monetization'  => esc_html__( 'Monetization', 'gtalobby' ),
    );

    echo '<div class="wrap gl-admin-settings">';
    echo '<h1>' . esc_html( get_admin_page_title() ) . '</h1>';

    // Tab navigation
    echo '<nav class="nav-tab-wrapper gl-admin-tabs">';
    foreach ( $tabs as $slug => $label ) {
        $class = ( $active_tab === $slug ) ? 'nav-tab nav-tab-active' : 'nav-tab';
        $url   = add_query_arg( array( 'page' => 'gtalobby-settings', 'tab' => $slug ), admin_url( 'admin.php' ) );
        printf( '<a href="%s" class="%s">%s</a>', esc_url( $url ), esc_attr( $class ), esc_html( $label ) );
    }
    echo '</nav>';

    // Tab content
    echo '<div class="gl-admin-tab-content">';
    echo '<form method="post" action="options.php">';

    switch ( $active_tab ) {
        case 'colors':
            settings_fields( 'gtalobby_colors' );
            do_settings_sections( 'gtalobby-colors' );
            break;

        case 'typography':
            settings_fields( 'gtalobby_typography' );
            do_settings_sections( 'gtalobby-typography' );
            break;

        case 'seo':
            settings_fields( 'gtalobby_seo' );
            do_settings_sections( 'gtalobby-seo' );
            break;

        case 'monetization':
            settings_fields( 'gtalobby_monetization' );
            do_settings_sections( 'gtalobby-monetization' );
            break;

        default: // general
            settings_fields( 'gtalobby_general' );
            do_settings_sections( 'gtalobby-settings' );
            break;
    }

    submit_button();
    echo '</form>';
    echo '</div>'; // .gl-admin-tab-content
    echo '</div>'; // .wrap
}

/**
 * Layout Engine page — zone composer UI.
 */
function gtalobby_layout_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $layout_context = isset( $_GET['context'] ) ? sanitize_key( $_GET['context'] ) : 'hub';
    $category_override = isset( $_GET['category'] ) ? sanitize_key( $_GET['category'] ) : '';

    $contexts = array(
        'hub'      => esc_html__( 'Hub Page', 'gtalobby' ),
        'single'   => esc_html__( 'Single Post', 'gtalobby' ),
        'archive'  => esc_html__( 'Archive', 'gtalobby' ),
        'homepage' => esc_html__( 'Homepage', 'gtalobby' ),
    );

    echo '<div class="wrap gl-admin-layout">';
    echo '<h1>' . esc_html__( 'Layout Engine', 'gtalobby' ) . '</h1>';
    echo '<p class="description">' . esc_html__( 'Drag zones to reorder, toggle visibility, and configure display settings per page type.', 'gtalobby' ) . '</p>';

    // Context tabs
    echo '<nav class="nav-tab-wrapper">';
    foreach ( $contexts as $ctx => $label ) {
        $class = ( $layout_context === $ctx ) ? 'nav-tab nav-tab-active' : 'nav-tab';
        $url   = add_query_arg( array( 'page' => 'gtalobby-layout', 'context' => $ctx ), admin_url( 'admin.php' ) );
        printf( '<a href="%s" class="%s">%s</a>', esc_url( $url ), esc_attr( $class ), esc_html( $label ) );
    }
    echo '</nav>';

    // Category override selector
    echo '<div class="gl-layout-category-filter">';
    echo '<label for="gl-category-override">' . esc_html__( 'Category Override:', 'gtalobby' ) . '</label>';
    echo '<select id="gl-category-override" name="category_override">';
    echo '<option value="">' . esc_html__( '— Default (All Categories) —', 'gtalobby' ) . '</option>';
    $sag_cats = gtalobby_get_sag_categories();
    foreach ( $sag_cats as $slug => $name ) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr( $slug ),
            selected( $category_override, $slug, false ),
            esc_html( $name )
        );
    }
    echo '</select>';
    echo '</div>';

    // Get zones for current context
    $zones = gtalobby_get_layout( $layout_context, $category_override );

    // Zone composer — rendered as sortable list
    echo '<div class="gl-zone-composer" data-context="' . esc_attr( $layout_context ) . '" data-category="' . esc_attr( $category_override ) . '">';

    if ( ! empty( $zones ) ) {
        echo '<ul class="gl-zone-list" id="gl-sortable-zones">';
        foreach ( $zones as $zone_id => $zone ) {
            $enabled_class = ! empty( $zone['enabled'] ) ? 'gl-zone--enabled' : 'gl-zone--disabled';
            echo '<li class="gl-zone-item ' . esc_attr( $enabled_class ) . '" data-zone="' . esc_attr( $zone_id ) . '">';
            echo '<span class="gl-zone-handle dashicons dashicons-move"></span>';
            echo '<span class="gl-zone-name">' . esc_html( ucwords( str_replace( '_', ' ', $zone_id ) ) ) . '</span>';

            // Quick toggles
            echo '<span class="gl-zone-controls">';
            printf(
                '<label class="gl-zone-toggle"><input type="checkbox" name="zones[%s][enabled]" value="1" %s /> %s</label>',
                esc_attr( $zone_id ),
                checked( ! empty( $zone['enabled'] ), true, false ),
                esc_html__( 'Visible', 'gtalobby' )
            );

            // Width selector
            $width = isset( $zone['width'] ) ? $zone['width'] : 'contained';
            printf(
                '<select name="zones[%s][width]" class="gl-zone-width">
                    <option value="full" %s>%s</option>
                    <option value="contained" %s>%s</option>
                    <option value="narrow" %s>%s</option>
                </select>',
                esc_attr( $zone_id ),
                selected( $width, 'full', false ), esc_html__( 'Full', 'gtalobby' ),
                selected( $width, 'contained', false ), esc_html__( 'Contained', 'gtalobby' ),
                selected( $width, 'narrow', false ), esc_html__( 'Narrow', 'gtalobby' )
            );

            echo '</span>'; // .gl-zone-controls

            // Expandable settings
            echo '<div class="gl-zone-details">';
            if ( isset( $zone['items_count'] ) ) {
                printf(
                    '<label>%s <input type="number" name="zones[%s][items_count]" value="%d" min="1" max="50" class="small-text" /></label>',
                    esc_html__( 'Items:', 'gtalobby' ),
                    esc_attr( $zone_id ),
                    intval( $zone['items_count'] )
                );
            }
            if ( isset( $zone['columns'] ) ) {
                printf(
                    '<label>%s <input type="number" name="zones[%s][columns]" value="%d" min="1" max="6" class="small-text" /></label>',
                    esc_html__( 'Columns:', 'gtalobby' ),
                    esc_attr( $zone_id ),
                    intval( $zone['columns'] )
                );
            }
            if ( isset( $zone['card_variant'] ) ) {
                $variants = array( 'standard', 'compact', 'feature', 'hero', 'minimal', 'magazine' );
                printf( '<label>%s <select name="zones[%s][card_variant]">', esc_html__( 'Card Style:', 'gtalobby' ), esc_attr( $zone_id ) );
                foreach ( $variants as $v ) {
                    printf( '<option value="%s" %s>%s</option>', esc_attr( $v ), selected( $zone['card_variant'], $v, false ), esc_html( ucfirst( $v ) ) );
                }
                echo '</select></label>';
            }
            echo '</div>'; // .gl-zone-details

            echo '</li>';
        }
        echo '</ul>';
    }

    // Save button (AJAX)
    echo '<div class="gl-zone-actions">';
    echo '<button type="button" class="button button-primary" id="gl-save-layout">' . esc_html__( 'Save Layout', 'gtalobby' ) . '</button>';
    echo '<button type="button" class="button" id="gl-reset-layout">' . esc_html__( 'Reset to Default', 'gtalobby' ) . '</button>';
    wp_nonce_field( 'gtalobby_save_layout', 'gl_layout_nonce' );
    echo '</div>';

    echo '</div>'; // .gl-zone-composer
    echo '</div>'; // .wrap
}

/**
 * GTA 6 Manager page.
 */
function gtalobby_gta6_manager_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    echo '<div class="wrap gl-admin-gta6">';
    echo '<h1>' . esc_html__( 'GTA 6 Manager', 'gtalobby' ) . '</h1>';

    echo '<form method="post" action="options.php">';
    settings_fields( 'gtalobby_gta6' );
    do_settings_sections( 'gtalobby-gta6' );
    submit_button();
    echo '</form>';

    // GTA 6 Content audit table
    echo '<hr />';
    echo '<h2>' . esc_html__( 'GTA 6 Content Audit', 'gtalobby' ) . '</h2>';
    echo '<p class="description">' . esc_html__( 'Posts in the GTA 6 category that may need updating after launch.', 'gtalobby' ) . '</p>';

    $gta6_posts = new WP_Query( array(
        'category_name'  => 'gta6',
        'posts_per_page' => 50,
        'post_status'    => 'publish',
        'post_type'      => array_merge( array( 'post' ), gtalobby_get_post_types() ),
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'post_launch_update_needed',
                'value'   => '1',
                'compare' => '=',
            ),
            array(
                'key'     => 'confidence_level',
                'compare' => 'EXISTS',
            ),
        ),
    ) );

    if ( $gta6_posts->have_posts() ) {
        echo '<table class="widefat striped">';
        echo '<thead><tr>';
        echo '<th>' . esc_html__( 'Title', 'gtalobby' ) . '</th>';
        echo '<th>' . esc_html__( 'Type', 'gtalobby' ) . '</th>';
        echo '<th>' . esc_html__( 'Confidence', 'gtalobby' ) . '</th>';
        echo '<th>' . esc_html__( 'Needs Update', 'gtalobby' ) . '</th>';
        echo '<th>' . esc_html__( 'Last Modified', 'gtalobby' ) . '</th>';
        echo '</tr></thead><tbody>';

        while ( $gta6_posts->have_posts() ) {
            $gta6_posts->the_post();
            $confidence    = get_post_meta( get_the_ID(), 'confidence_level', true );
            $needs_update  = get_post_meta( get_the_ID(), 'post_launch_update_needed', true );

            echo '<tr>';
            echo '<td><a href="' . esc_url( get_edit_post_link() ) . '">' . esc_html( get_the_title() ) . '</a></td>';
            echo '<td>' . esc_html( get_post_type_object( get_post_type() )->labels->singular_name ) . '</td>';
            echo '<td><span class="gl-confidence gl-confidence--' . esc_attr( $confidence ) . '">' . esc_html( ucfirst( $confidence ?: 'none' ) ) . '</span></td>';
            echo '<td>' . ( $needs_update ? '<span class="dashicons dashicons-warning" style="color:#e17055;"></span>' : '—' ) . '</td>';
            echo '<td>' . esc_html( get_the_modified_date() ) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        wp_reset_postdata();
    } else {
        echo '<p>' . esc_html__( 'No GTA 6 content found.', 'gtalobby' ) . '</p>';
    }

    echo '</div>'; // .wrap
}

/* ================================================================
   13. AJAX: SAVE LAYOUT ZONES
   ================================================================ */

/**
 * AJAX handler for saving layout zone configuration.
 */
function gtalobby_ajax_save_layout() {
    check_ajax_referer( 'gtalobby_save_layout', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ) );
    }

    $context  = isset( $_POST['context'] ) ? sanitize_key( $_POST['context'] ) : '';
    $category = isset( $_POST['category'] ) ? sanitize_key( $_POST['category'] ) : '';
    $zones    = isset( $_POST['zones'] ) ? $_POST['zones'] : array();

    if ( empty( $context ) || empty( $zones ) ) {
        wp_send_json_error( array( 'message' => 'Missing data' ) );
    }

    // Sanitize zone data
    $sanitized_zones = array();
    foreach ( $zones as $zone_id => $zone_data ) {
        $safe_id = sanitize_key( $zone_id );
        $sanitized_zones[ $safe_id ] = array(
            'enabled'      => ! empty( $zone_data['enabled'] ),
            'order'        => isset( $zone_data['order'] ) ? intval( $zone_data['order'] ) : 0,
            'width'        => isset( $zone_data['width'] ) ? sanitize_key( $zone_data['width'] ) : 'contained',
            'items_count'  => isset( $zone_data['items_count'] ) ? absint( $zone_data['items_count'] ) : null,
            'columns'      => isset( $zone_data['columns'] ) ? absint( $zone_data['columns'] ) : null,
            'card_variant' => isset( $zone_data['card_variant'] ) ? sanitize_key( $zone_data['card_variant'] ) : null,
        );
        // Remove null values
        $sanitized_zones[ $safe_id ] = array_filter( $sanitized_zones[ $safe_id ], function( $v ) {
            return $v !== null;
        } );
    }

    gtalobby_save_layout( $context, $sanitized_zones, $category );
    wp_send_json_success( array( 'message' => 'Layout saved' ) );
}
add_action( 'wp_ajax_gtalobby_save_layout', 'gtalobby_ajax_save_layout' );

/**
 * AJAX handler for resetting layout to defaults.
 */
function gtalobby_ajax_reset_layout() {
    check_ajax_referer( 'gtalobby_save_layout', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ) );
    }

    $context  = isset( $_POST['context'] ) ? sanitize_key( $_POST['context'] ) : '';
    $category = isset( $_POST['category'] ) ? sanitize_key( $_POST['category'] ) : '';

    if ( $category ) {
        delete_option( "gtalobby_layout_{$context}_{$category}" );
    } else {
        delete_option( "gtalobby_layout_{$context}" );
    }

    wp_send_json_success( array( 'message' => 'Layout reset to defaults' ) );
}
add_action( 'wp_ajax_gtalobby_reset_layout', 'gtalobby_ajax_reset_layout' );

/* ================================================================
   14. HELPER: GET OPTION WITH DEFAULT FALLBACK
   ================================================================ */

/**
 * Get a single option value with fallback to defaults.
 */
function gtalobby_get_option( $group, $key, $default = '' ) {
    static $cache = array();

    if ( ! isset( $cache[ $group ] ) ) {
        $cache[ $group ] = get_option( $group, array() );
    }

    return isset( $cache[ $group ][ $key ] ) ? $cache[ $group ][ $key ] : $default;
}

/**
 * Check if a general feature is enabled.
 */
function gtalobby_is_enabled( $feature ) {
    $defaults = gtalobby_general_defaults();
    $default  = isset( $defaults[ $feature ] ) ? $defaults[ $feature ] : false;
    return (bool) gtalobby_get_option( 'gtalobby_general_options', $feature, $default );
}

/**
 * Get SEO option.
 */
function gtalobby_get_seo_option( $key ) {
    $defaults = gtalobby_seo_defaults();
    $default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
    return gtalobby_get_option( 'gtalobby_seo_options', $key, $default );
}

/**
 * Get GTA 6 option.
 */
function gtalobby_get_gta6_option( $key ) {
    $defaults = gtalobby_gta6_defaults();
    $default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
    return gtalobby_get_option( 'gtalobby_gta6_options', $key, $default );
}

/**
 * Get monetization ad code for a slot.
 */
function gtalobby_get_ad_slot( $slot ) {
    return gtalobby_get_option( 'gtalobby_monetization_options', $slot, '' );
}

/**
 * Render an ad slot if it has content.
 */
function gtalobby_render_ad_slot( $slot, $wrapper_class = 'gl-ad-slot' ) {
    $code = gtalobby_get_ad_slot( $slot );
    if ( empty( $code ) ) {
        return;
    }
    echo '<div class="' . esc_attr( $wrapper_class ) . ' gl-ad-slot--' . esc_attr( $slot ) . '">';
    echo $code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — ad code is sanitized on save
    echo '</div>';
}
