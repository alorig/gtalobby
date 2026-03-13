<?php
/**
 * GtaLobby — Custom Post Types
 *
 * Registers 7 custom post types for the SAG architecture:
 * Mod Listing, Guide, Ranking, Profile, Quick Answer, Database, Weekly Recap
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all 7 custom post types.
 */
function gtalobby_register_post_types() {

    /* -------------------------------------------------------
       1. Mod Listing (slug: mod)
       ------------------------------------------------------- */
    register_post_type( 'mod', array(
        'labels' => array(
            'name'               => esc_html__( 'Mods', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Mod Listing', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Mod', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Mod Listing', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Mod Listing', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Mod Listing', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Mod Listing', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Mods', 'gtalobby' ),
            'not_found'          => esc_html__( 'No mods found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No mods found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Mods', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'mod', 'with_front' => false ),
        'menu_icon'          => 'dashicons-admin-plugins',
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'mod_category', 'game_mode', 'difficulty', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );

    /* -------------------------------------------------------
       2. Guide (slug: guide)
       ------------------------------------------------------- */
    register_post_type( 'guide', array(
        'labels' => array(
            'name'               => esc_html__( 'Guides', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Guide', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Guide', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Guide', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Guide', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Guide', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Guide', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Guides', 'gtalobby' ),
            'not_found'          => esc_html__( 'No guides found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No guides found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Guides', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'guide', 'with_front' => false ),
        'menu_icon'          => 'dashicons-book-alt',
        'menu_position'      => 6,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'cheat_type', 'game_mode', 'business_type', 'difficulty', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );

    /* -------------------------------------------------------
       3. Ranking (slug: ranking)
       ------------------------------------------------------- */
    register_post_type( 'ranking', array(
        'labels' => array(
            'name'               => esc_html__( 'Rankings', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Ranking', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Ranking', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Ranking', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Ranking', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Ranking', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Ranking', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Rankings', 'gtalobby' ),
            'not_found'          => esc_html__( 'No rankings found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No rankings found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Rankings', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'ranking', 'with_front' => false ),
        'menu_icon'          => 'dashicons-awards',
        'menu_position'      => 7,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'vehicle_class', 'mod_category', 'game_mode', 'difficulty', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );

    /* -------------------------------------------------------
       4. Profile (slug: profile)
       ------------------------------------------------------- */
    register_post_type( 'profile', array(
        'labels' => array(
            'name'               => esc_html__( 'Profiles', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Profile', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Profile', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Profile', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Profile', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Profile', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Profile', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Profiles', 'gtalobby' ),
            'not_found'          => esc_html__( 'No profiles found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No profiles found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Profiles', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'profile', 'with_front' => false ),
        'menu_icon'          => 'dashicons-id-alt',
        'menu_position'      => 8,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'vehicle_class', 'game_mode', 'business_type', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );

    /* -------------------------------------------------------
       5. Quick Answer (slug: answer)
       ------------------------------------------------------- */
    register_post_type( 'answer', array(
        'labels' => array(
            'name'               => esc_html__( 'Quick Answers', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Quick Answer', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Answer', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Quick Answer', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Quick Answer', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Quick Answer', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Quick Answer', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Answers', 'gtalobby' ),
            'not_found'          => esc_html__( 'No answers found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No answers found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Quick Answers', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'answer', 'with_front' => false ),
        'menu_icon'          => 'dashicons-format-status',
        'menu_position'      => 9,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'cheat_type', 'game_mode', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );

    /* -------------------------------------------------------
       6. Database (slug: database)
       ------------------------------------------------------- */
    register_post_type( 'database', array(
        'labels' => array(
            'name'               => esc_html__( 'Databases', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Database', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Database', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Database', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Database', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Database', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Database', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Databases', 'gtalobby' ),
            'not_found'          => esc_html__( 'No databases found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No databases found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Databases', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'database', 'with_front' => false ),
        'menu_icon'          => 'dashicons-database',
        'menu_position'      => 10,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'cheat_type', 'vehicle_class', 'game_mode', 'business_type', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );

    /* -------------------------------------------------------
       7. Weekly Recap (slug: recap)
       ------------------------------------------------------- */
    register_post_type( 'recap', array(
        'labels' => array(
            'name'               => esc_html__( 'Weekly Recaps', 'gtalobby' ),
            'singular_name'      => esc_html__( 'Weekly Recap', 'gtalobby' ),
            'add_new'            => esc_html__( 'Add New Recap', 'gtalobby' ),
            'add_new_item'       => esc_html__( 'Add New Weekly Recap', 'gtalobby' ),
            'edit_item'          => esc_html__( 'Edit Weekly Recap', 'gtalobby' ),
            'new_item'           => esc_html__( 'New Weekly Recap', 'gtalobby' ),
            'view_item'          => esc_html__( 'View Weekly Recap', 'gtalobby' ),
            'search_items'       => esc_html__( 'Search Recaps', 'gtalobby' ),
            'not_found'          => esc_html__( 'No recaps found.', 'gtalobby' ),
            'not_found_in_trash' => esc_html__( 'No recaps found in Trash.', 'gtalobby' ),
            'all_items'          => esc_html__( 'All Weekly Recaps', 'gtalobby' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'recap', 'with_front' => false ),
        'menu_icon'          => 'dashicons-calendar-alt',
        'menu_position'      => 11,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields' ),
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'query_var'          => true,
        'delete_with_user'   => false,
        'taxonomies'         => array( 'category', 'game_title', 'platform', 'game_mode', 'content_tags' ),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
    ) );
}
add_action( 'init', 'gtalobby_register_post_types' );

/**
 * Flush rewrite rules on theme activation.
 */
function gtalobby_rewrite_flush() {
    gtalobby_register_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'gtalobby_rewrite_flush' );

/**
 * Add custom columns to post type admin tables.
 */
function gtalobby_custom_admin_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        if ( $key === 'title' ) {
            $new_columns['gl_category']  = esc_html__( 'Category', 'gtalobby' );
            $new_columns['gl_hub']       = esc_html__( 'Hub Page', 'gtalobby' );
            $new_columns['gl_game']      = esc_html__( 'Game', 'gtalobby' );
        }
    }
    return $new_columns;
}

/**
 * Populate custom admin columns.
 */
function gtalobby_custom_admin_columns_content( $column, $post_id ) {
    switch ( $column ) {
        case 'gl_category':
            $cat = gtalobby_get_primary_category( $post_id );
            echo $cat ? esc_html( $cat->name ) : '—';
            break;

        case 'gl_hub':
            $hub_id = get_post_meta( $post_id, 'hub_page_assignment', true );
            if ( $hub_id ) {
                echo '<a href="' . esc_url( get_edit_post_link( $hub_id ) ) . '">' . esc_html( get_the_title( $hub_id ) ) . '</a>';
            } else {
                echo '—';
            }
            break;

        case 'gl_game':
            $terms = get_the_terms( $post_id, 'game_title' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                $names = wp_list_pluck( $terms, 'name' );
                echo esc_html( implode( ', ', $names ) );
            } else {
                echo '—';
            }
            break;
    }
}

// Apply columns to all custom post types
$gtalobby_post_types = array( 'mod', 'guide', 'ranking', 'profile', 'answer', 'database', 'recap' );
foreach ( $gtalobby_post_types as $pt ) {
    add_filter( "manage_{$pt}_posts_columns", 'gtalobby_custom_admin_columns' );
    add_action( "manage_{$pt}_posts_custom_column", 'gtalobby_custom_admin_columns_content', 10, 2 );
}

/**
 * Get all registered GtaLobby post types.
 */
function gtalobby_get_post_types() {
    return array( 'mod', 'guide', 'ranking', 'profile', 'answer', 'database', 'recap' );
}

/**
 * Get post type display info (label, icon, color).
 */
function gtalobby_get_post_type_info( $post_type = null ) {
    $post_type = $post_type ?: get_post_type();

    $types = array(
        'mod' => array(
            'label' => esc_html__( 'Mod', 'gtalobby' ),
            'icon'  => 'download',
            'color' => '#00B894',
        ),
        'guide' => array(
            'label' => esc_html__( 'Guide', 'gtalobby' ),
            'icon'  => 'book',
            'color' => '#6C5CE7',
        ),
        'ranking' => array(
            'label' => esc_html__( 'Ranking', 'gtalobby' ),
            'icon'  => 'trophy',
            'color' => '#FDCB6E',
        ),
        'profile' => array(
            'label' => esc_html__( 'Profile', 'gtalobby' ),
            'icon'  => 'user',
            'color' => '#E84393',
        ),
        'answer' => array(
            'label' => esc_html__( 'Answer', 'gtalobby' ),
            'icon'  => 'zap',
            'color' => '#0984E3',
        ),
        'database' => array(
            'label' => esc_html__( 'Database', 'gtalobby' ),
            'icon'  => 'grid',
            'color' => '#00CEC9',
        ),
        'recap' => array(
            'label' => esc_html__( 'Recap', 'gtalobby' ),
            'icon'  => 'calendar',
            'color' => '#636E72',
        ),
    );

    return isset( $types[ $post_type ] ) ? $types[ $post_type ] : array(
        'label' => esc_html__( 'Post', 'gtalobby' ),
        'icon'  => 'file',
        'color' => '#718096',
    );
}
