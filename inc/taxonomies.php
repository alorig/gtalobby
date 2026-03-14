<?php
/**
 * GtaLobby — Taxonomies
 *
 * Registers 9 custom taxonomies and sets up the 9 SAG categories.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all 9 custom taxonomies.
 */
function gtalobby_register_taxonomies() {

    $all_post_types = array( 'post', 'mod', 'guide', 'ranking', 'profile', 'answer', 'database', 'recap' );

    /* -------------------------------------------------------
       1. Game Title (slug: game_title)
       Critical — distinguishes GTA 5 vs GTA 6 content
       ------------------------------------------------------- */
    register_taxonomy( 'game_title', $all_post_types, array(
        'labels' => array(
            'name'          => esc_html__( 'Game Title', 'gtalobby' ),
            'singular_name' => esc_html__( 'Game Title', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Game Titles', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Game Titles', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Game Title', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Game Title', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Game Title', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Game Title Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Game Titles', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'game', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       2. Platform (slug: platform)
       ------------------------------------------------------- */
    register_taxonomy( 'platform', $all_post_types, array(
        'labels' => array(
            'name'          => esc_html__( 'Platforms', 'gtalobby' ),
            'singular_name' => esc_html__( 'Platform', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Platforms', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Platforms', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Platform', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Platform', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Platform', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Platform Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Platforms', 'gtalobby' ),
        ),
        'hierarchical'      => false,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'platform', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       3. Cheat Type (slug: cheat_type)
       ------------------------------------------------------- */
    register_taxonomy( 'cheat_type', array( 'guide', 'database', 'answer' ), array(
        'labels' => array(
            'name'          => esc_html__( 'Cheat Types', 'gtalobby' ),
            'singular_name' => esc_html__( 'Cheat Type', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Cheat Types', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Cheat Types', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Cheat Type', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Cheat Type', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Cheat Type', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Cheat Type Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Cheat Types', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'cheat-type', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       4. Vehicle Class (slug: vehicle_class)
       ------------------------------------------------------- */
    register_taxonomy( 'vehicle_class', array( 'profile', 'ranking', 'database' ), array(
        'labels' => array(
            'name'          => esc_html__( 'Vehicle Classes', 'gtalobby' ),
            'singular_name' => esc_html__( 'Vehicle Class', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Vehicle Classes', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Vehicle Classes', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Vehicle Class', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Vehicle Class', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Vehicle Class', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Vehicle Class Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Vehicle Classes', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'vehicle-class', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       5. Mod Category (slug: mod_category)
       ------------------------------------------------------- */
    register_taxonomy( 'mod_category', array( 'mod', 'ranking', 'guide' ), array(
        'labels' => array(
            'name'          => esc_html__( 'Mod Categories', 'gtalobby' ),
            'singular_name' => esc_html__( 'Mod Category', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Mod Categories', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Mod Categories', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Mod Category', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Mod Category', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Mod Category', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Mod Category Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Mod Categories', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'mod-category', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       6. Game Mode (slug: game_mode)
       ------------------------------------------------------- */
    register_taxonomy( 'game_mode', $all_post_types, array(
        'labels' => array(
            'name'          => esc_html__( 'Game Modes', 'gtalobby' ),
            'singular_name' => esc_html__( 'Game Mode', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Game Modes', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Game Modes', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Game Mode', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Game Mode', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Game Mode', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Game Mode Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Game Modes', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => false,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'game-mode', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       7. Business Type (slug: business_type)
       ------------------------------------------------------- */
    register_taxonomy( 'business_type', array( 'guide', 'ranking', 'database', 'profile' ), array(
        'labels' => array(
            'name'          => esc_html__( 'Business Types', 'gtalobby' ),
            'singular_name' => esc_html__( 'Business Type', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Business Types', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Business Types', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Business Type', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Business Type', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Business Type', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Business Type Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Business Types', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => false,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'business-type', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       8. Difficulty Level (slug: difficulty)
       ------------------------------------------------------- */
    register_taxonomy( 'difficulty', array( 'guide', 'ranking' ), array(
        'labels' => array(
            'name'          => esc_html__( 'Difficulty Levels', 'gtalobby' ),
            'singular_name' => esc_html__( 'Difficulty Level', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Difficulty Levels', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Difficulty Levels', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Difficulty Level', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Difficulty Level', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Difficulty Level', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Difficulty Level Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Difficulty', 'gtalobby' ),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'difficulty', 'with_front' => false ),
    ) );

    /* -------------------------------------------------------
       9. Content Tags (slug: content_tags)
       Catch-all for dimensional attributes
       ------------------------------------------------------- */
    register_taxonomy( 'content_tags', $all_post_types, array(
        'labels' => array(
            'name'          => esc_html__( 'Content Tags', 'gtalobby' ),
            'singular_name' => esc_html__( 'Content Tag', 'gtalobby' ),
            'search_items'  => esc_html__( 'Search Content Tags', 'gtalobby' ),
            'all_items'     => esc_html__( 'All Content Tags', 'gtalobby' ),
            'edit_item'     => esc_html__( 'Edit Content Tag', 'gtalobby' ),
            'update_item'   => esc_html__( 'Update Content Tag', 'gtalobby' ),
            'add_new_item'  => esc_html__( 'Add New Content Tag', 'gtalobby' ),
            'new_item_name' => esc_html__( 'New Content Tag Name', 'gtalobby' ),
            'menu_name'     => esc_html__( 'Content Tags', 'gtalobby' ),
        ),
        'hierarchical'      => false,
        'public'            => true,
        'show_admin_column' => false,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_quick_edit' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'tag', 'with_front' => false ),
    ) );
}
add_action( 'init', 'gtalobby_register_taxonomies' );

/**
 * Pre-populate taxonomy terms on theme activation.
 */
function gtalobby_setup_default_terms() {

    // Game Titles
    $game_titles = array(
        'GTA 5'                => 'gta-5',
        'GTA Online'           => 'gta-online',
        'GTA 6'                => 'gta-6',
        'GTA Series'           => 'gta-series',
        'GTA San Andreas DE'   => 'gta-san-andreas-de',
        'GTA Vice City DE'     => 'gta-vice-city-de',
        'GTA 3 DE'             => 'gta-3-de',
    );
    foreach ( $game_titles as $name => $slug ) {
        if ( ! term_exists( $slug, 'game_title' ) ) {
            wp_insert_term( $name, 'game_title', array( 'slug' => $slug ) );
        }
    }

    // Platforms
    $platforms = array(
        'PS5'            => 'ps5',
        'PS4'            => 'ps4',
        'Xbox Series X'  => 'xbox-series-x',
        'Xbox One'       => 'xbox-one',
        'PC'             => 'pc',
        'All Platforms'  => 'all-platforms',
        'Mobile'         => 'mobile',
        'Nintendo Switch' => 'nintendo-switch',
        'Cross-Platform' => 'cross-platform',
        'FiveM'          => 'fivem',
        'RAGEMP'         => 'ragemp',
    );
    foreach ( $platforms as $name => $slug ) {
        if ( ! term_exists( $slug, 'platform' ) ) {
            wp_insert_term( $name, 'platform', array( 'slug' => $slug ) );
        }
    }

    // Cheat Types
    $cheat_types = array(
        'Vehicle Spawn'               => 'vehicle-spawn',
        'Weapon'                      => 'weapon',
        'Player (Health/Armor)'  => 'player',
        'World (Weather/Gravity)'     => 'world',
        'Wanted Level'                => 'wanted-level',
        'Money/Exploit'               => 'money-exploit',
        'Phone Number'                => 'phone-number',
        'All Cheats'                  => 'all-cheats',
    );
    foreach ( $cheat_types as $name => $slug ) {
        if ( ! term_exists( $slug, 'cheat_type' ) ) {
            wp_insert_term( $name, 'cheat_type', array( 'slug' => $slug ) );
        }
    }

    // Vehicle Classes
    $vehicle_classes = array(
        'Supercars'      => 'supercars',
        'Sports'         => 'sports',
        'Muscle'         => 'muscle',
        'JDM/Tuner'      => 'jdm-tuner',
        'SUV'            => 'suv',
        'Bikes/Motorcycles' => 'bikes',
        'Off-Road'       => 'off-road',
        'Luxury'         => 'luxury',
        'Classic'        => 'classic',
        'Emergency'      => 'emergency',
        'Military'       => 'military',
        'Boats'          => 'boats',
        'Aircraft'       => 'aircraft',
        'Weaponized'     => 'weaponized',
    );
    foreach ( $vehicle_classes as $name => $slug ) {
        if ( ! term_exists( $slug, 'vehicle_class' ) ) {
            wp_insert_term( $name, 'vehicle_class', array( 'slug' => $slug ) );
        }
    }

    // Mod Categories
    $mod_categories = array(
        'Vehicle Mods'      => 'vehicle-mods',
        'Script Mods'       => 'script-mods',
        'Graphics/Visual'   => 'graphics-visual',
        'Map/World'         => 'map-world',
        'Player/Character'  => 'player-character',
        'Weapon'            => 'weapon-mods',
        'Sound/Audio'       => 'sound-audio',
        'Menu/Trainer'      => 'menu-trainer',
        'LSPDFR/Police'     => 'lspdfr-police',
        'Total Conversion'  => 'total-conversion',
    );
    foreach ( $mod_categories as $name => $slug ) {
        if ( ! term_exists( $slug, 'mod_category' ) ) {
            wp_insert_term( $name, 'mod_category', array( 'slug' => $slug ) );
        }
    }

    // Game Modes
    $game_modes = array(
        'Story Mode'       => 'story-mode',
        'GTA Online'       => 'gta-online-mode',
        'FiveM/RP'         => 'fivem-rp',
        'Both'             => 'both',
        'Online Racing'    => 'online-racing',
        'Online Freemode'  => 'online-freemode',
    );
    foreach ( $game_modes as $name => $slug ) {
        if ( ! term_exists( $slug, 'game_mode' ) ) {
            wp_insert_term( $name, 'game_mode', array( 'slug' => $slug ) );
        }
    }

    // Business Types
    $business_types = array(
        'CEO Office'   => 'ceo-office',
        'MC Club'      => 'mc-club',
        'Bunker'       => 'bunker',
        'Nightclub'    => 'nightclub',
        'Acid Lab'     => 'acid-lab',
        'Agency'       => 'agency',
        'Auto Shop'    => 'auto-shop',
        'Salvage Yard' => 'salvage-yard',
        'Arcade'       => 'arcade',
        'Hangar'       => 'hangar',
        'Facility'     => 'facility',
        'Casino'       => 'casino',
    );
    foreach ( $business_types as $name => $slug ) {
        if ( ! term_exists( $slug, 'business_type' ) ) {
            wp_insert_term( $name, 'business_type', array( 'slug' => $slug ) );
        }
    }

    // Difficulty Levels
    $difficulties = array(
        'Beginner'     => 'beginner',
        'Intermediate' => 'intermediate',
        'Advanced'     => 'advanced',
    );
    foreach ( $difficulties as $name => $slug ) {
        if ( ! term_exists( $slug, 'difficulty' ) ) {
            wp_insert_term( $name, 'difficulty', array( 'slug' => $slug ) );
        }
    }

    // SAG Categories (9 sectors)
    $sag_categories = array(
        'GTA 6'              => 'gta6',
        'Cheat Codes & Cheats' => 'cheats',
        'GTA Online'         => 'online',
        'Mods & Modding'     => 'mods',
        'Cars & Vehicles'    => 'cars',
        'Characters & Story' => 'characters',
        'Map & Locations'    => 'locations',
        'Money & Business'   => 'money',
        'News & Updates'     => 'news',
    );
    foreach ( $sag_categories as $name => $slug ) {
        if ( ! term_exists( $slug, 'category' ) ) {
            wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'gtalobby_setup_default_terms' );

/**
 * Get all GtaLobby taxonomy slugs.
 */
function gtalobby_get_taxonomy_slugs() {
    return array(
        'game_title',
        'platform',
        'cheat_type',
        'vehicle_class',
        'mod_category',
        'game_mode',
        'business_type',
        'difficulty',
        'content_tags',
    );
}
