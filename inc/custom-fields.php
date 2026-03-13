<?php
/**
 * GtaLobby — Custom Fields (ACF)
 *
 * Registers all ACF field groups for every post type + hub pages + GTA 6.
 * Falls back to native meta boxes when ACF is not active.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if ACF is active.
 */
function gtalobby_acf_active() {
    return class_exists( 'ACF' ) || function_exists( 'acf_add_local_field_group' );
}

/**
 * Register all ACF field groups.
 */
function gtalobby_register_acf_fields() {
    if ( ! gtalobby_acf_active() ) {
        return;
    }

    /* -------------------------------------------------------
       MOD LISTING FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_mod_listing',
        'title'    => 'Mod Listing Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'mod',
                ),
            ),
        ),
        'position'    => 'normal',
        'style'       => 'default',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'   => 'field_mod_download_url',
                'label' => 'Download URL',
                'name'  => 'download_url',
                'type'  => 'url',
                'instructions' => 'External download link for this mod.',
                'required' => 0,
            ),
            array(
                'key'   => 'field_mod_version',
                'label' => 'Mod Version',
                'name'  => 'mod_version',
                'type'  => 'text',
                'instructions' => 'Current version (e.g. v2.1).',
                'placeholder' => 'v1.0',
            ),
            array(
                'key'   => 'field_mod_file_size',
                'label' => 'File Size',
                'name'  => 'file_size',
                'type'  => 'text',
                'instructions' => 'File size (e.g. 45 MB).',
                'placeholder' => '45 MB',
            ),
            array(
                'key'   => 'field_mod_author_name',
                'label' => 'Mod Author',
                'name'  => 'author_name',
                'type'  => 'text',
                'instructions' => 'Original mod creator name.',
            ),
            array(
                'key'   => 'field_mod_last_tested',
                'label' => 'Last Tested',
                'name'  => 'last_tested',
                'type'  => 'date_picker',
                'instructions' => 'When this mod was last verified working.',
                'display_format' => 'F j, Y',
                'return_format'  => 'Y-m-d',
            ),
            array(
                'key'   => 'field_mod_requirements',
                'label' => 'Requirements',
                'name'  => 'requirements',
                'type'  => 'textarea',
                'instructions' => 'Required tools (OpenIV, Script Hook V, etc.).',
                'rows'  => 3,
            ),
            array(
                'key'   => 'field_mod_compatibility',
                'label' => 'Compatibility',
                'name'  => 'compatibility',
                'type'  => 'checkbox',
                'instructions' => 'Compatible game versions.',
                'choices' => array(
                    'gta5_latest' => 'GTA 5 (Latest Patch)',
                    'gta5_1604'   => 'GTA 5 (v1.0.1604)',
                    'gta5_2612'   => 'GTA 5 (v1.0.2612)',
                    'fivem'       => 'FiveM',
                    'ragemp'      => 'RAGE:MP',
                ),
                'layout' => 'horizontal',
            ),
            array(
                'key'   => 'field_mod_install_steps',
                'label' => 'Install Steps',
                'name'  => 'install_steps',
                'type'  => 'repeater',
                'instructions' => 'Step-by-step installation instructions.',
                'min'   => 0,
                'max'   => 20,
                'layout' => 'row',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_mod_step_number',
                        'label' => 'Step #',
                        'name'  => 'step_number',
                        'type'  => 'number',
                        'wrapper' => array( 'width' => '15' ),
                    ),
                    array(
                        'key'   => 'field_mod_step_text',
                        'label' => 'Step Text',
                        'name'  => 'step_text',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'wrapper' => array( 'width' => '85' ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_mod_screenshots',
                'label' => 'Screenshots',
                'name'  => 'screenshots',
                'type'  => 'gallery',
                'instructions' => 'Mod screenshot gallery.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ),
        ),
    ) );

    /* -------------------------------------------------------
       GUIDE FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_guide',
        'title'    => 'Guide Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'guide',
                ),
            ),
        ),
        'position'    => 'normal',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'     => 'field_guide_difficulty',
                'label'   => 'Difficulty Rating',
                'name'    => 'difficulty_rating',
                'type'    => 'select',
                'choices' => array(
                    'easy'   => 'Easy',
                    'medium' => 'Medium',
                    'hard'   => 'Hard',
                ),
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'         => 'field_guide_time',
                'label'       => 'Time to Complete',
                'name'        => 'time_to_complete',
                'type'        => 'text',
                'placeholder' => '15 minutes',
                'wrapper'     => array( 'width' => '33' ),
            ),
            array(
                'key'     => 'field_guide_step_count',
                'label'   => 'Step Count',
                'name'    => 'step_count',
                'type'    => 'number',
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'   => 'field_guide_tools',
                'label' => 'Tools Needed',
                'name'  => 'tools_needed',
                'type'  => 'text',
                'instructions' => 'Required software or in-game items.',
            ),
            array(
                'key'   => 'field_guide_video',
                'label' => 'Video Embed URL',
                'name'  => 'video_embed',
                'type'  => 'url',
                'instructions' => 'YouTube/Vimeo embed URL.',
            ),
        ),
    ) );

    /* -------------------------------------------------------
       RANKING FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_ranking',
        'title'    => 'Ranking Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'ranking',
                ),
            ),
        ),
        'position'    => 'normal',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'   => 'field_ranking_criteria',
                'label' => 'Ranking Criteria',
                'name'  => 'ranking_criteria',
                'type'  => 'textarea',
                'instructions' => 'How items were evaluated.',
                'rows'  => 3,
            ),
            array(
                'key'   => 'field_ranking_total',
                'label' => 'Total Items Ranked',
                'name'  => 'total_items',
                'type'  => 'number',
            ),
            array(
                'key'   => 'field_ranking_last_tested',
                'label' => 'Last Tested Date',
                'name'  => 'last_tested_date',
                'type'  => 'date_picker',
                'display_format' => 'F j, Y',
                'return_format'  => 'Y-m-d',
            ),
            array(
                'key'   => 'field_ranking_items',
                'label' => 'Ranked Items',
                'name'  => 'ranked_items',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 50,
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_ri_rank',
                        'label' => 'Rank',
                        'name'  => 'rank',
                        'type'  => 'number',
                        'wrapper' => array( 'width' => '10' ),
                    ),
                    array(
                        'key'   => 'field_ri_name',
                        'label' => 'Name',
                        'name'  => 'name',
                        'type'  => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),
                    array(
                        'key'   => 'field_ri_image',
                        'label' => 'Image',
                        'name'  => 'image',
                        'type'  => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                        'wrapper' => array( 'width' => '15' ),
                    ),
                    array(
                        'key'   => 'field_ri_score',
                        'label' => 'Score',
                        'name'  => 'score',
                        'type'  => 'number',
                        'min'   => 0,
                        'max'   => 100,
                        'wrapper' => array( 'width' => '10' ),
                    ),
                    array(
                        'key'   => 'field_ri_description',
                        'label' => 'Description',
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'wrapper' => array( 'width' => '35' ),
                    ),
                    array(
                        'key'   => 'field_ri_pros',
                        'label' => 'Pros',
                        'name'  => 'pros',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'wrapper' => array( 'width' => '50' ),
                    ),
                    array(
                        'key'   => 'field_ri_cons',
                        'label' => 'Cons',
                        'name'  => 'cons',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'wrapper' => array( 'width' => '50' ),
                    ),
                ),
            ),
        ),
    ) );

    /* -------------------------------------------------------
       PROFILE FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_profile',
        'title'    => 'Profile Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'profile',
                ),
            ),
        ),
        'position'    => 'normal',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'     => 'field_profile_entity_type',
                'label'   => 'Entity Type',
                'name'    => 'entity_type',
                'type'    => 'select',
                'choices' => array(
                    'character' => 'Character',
                    'vehicle'   => 'Vehicle',
                    'location'  => 'Location',
                    'business'  => 'Business',
                ),
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'   => 'field_profile_first_appearance',
                'label' => 'First Appearance',
                'name'  => 'first_appearance',
                'type'  => 'text',
                'instructions' => 'Game/mission where entity first appears.',
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'   => 'field_profile_voice_actor',
                'label' => 'Voice Actor',
                'name'  => 'voice_actor',
                'type'  => 'text',
                'instructions' => 'Voice actor name (characters only).',
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'   => 'field_profile_stats',
                'label' => 'Stats Table',
                'name'  => 'stats_table',
                'type'  => 'repeater',
                'instructions' => 'Key stats for this entity.',
                'min'   => 0,
                'max'   => 20,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_stat_name',
                        'label' => 'Stat Name',
                        'name'  => 'stat_name',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_stat_value',
                        'label' => 'Stat Value',
                        'name'  => 'stat_value',
                        'type'  => 'text',
                    ),
                    array(
                        'key'     => 'field_stat_bar',
                        'label'   => 'Bar Value (0-100)',
                        'name'    => 'stat_bar',
                        'type'    => 'number',
                        'min'     => 0,
                        'max'     => 100,
                        'instructions' => 'Optional visual bar percentage.',
                    ),
                ),
            ),
            array(
                'key'   => 'field_profile_gallery',
                'label' => 'Gallery',
                'name'  => 'gallery',
                'type'  => 'gallery',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ),
            array(
                'key'   => 'field_profile_related',
                'label' => 'Related Profiles',
                'name'  => 'related_profiles',
                'type'  => 'relationship',
                'post_type' => array( 'profile' ),
                'filters'   => array( 'search', 'post_type' ),
                'max'       => 6,
                'return_format' => 'object',
            ),
        ),
    ) );

    /* -------------------------------------------------------
       QUICK ANSWER FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_answer',
        'title'    => 'Quick Answer Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'answer',
                ),
            ),
        ),
        'position'    => 'acf_after_title',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'   => 'field_answer_short',
                'label' => 'Short Answer (Featured Snippet)',
                'name'  => 'short_answer',
                'type'  => 'textarea',
                'instructions' => '2-3 sentence direct answer for featured snippet targeting.',
                'rows'  => 3,
                'required' => 1,
            ),
            array(
                'key'   => 'field_answer_sources',
                'label' => 'Sources',
                'name'  => 'sources',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 10,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_source_name',
                        'label' => 'Source Name',
                        'name'  => 'source_name',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_source_url',
                        'label' => 'Source URL',
                        'name'  => 'source_url',
                        'type'  => 'url',
                    ),
                ),
            ),
            array(
                'key'   => 'field_answer_related_questions',
                'label' => 'Related Questions',
                'name'  => 'related_questions',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 8,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_rq_question',
                        'label' => 'Question',
                        'name'  => 'question',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_rq_link',
                        'label' => 'Link',
                        'name'  => 'link',
                        'type'  => 'url',
                    ),
                ),
            ),
        ),
    ) );

    /* -------------------------------------------------------
       DATABASE FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_database',
        'title'    => 'Database Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'database',
                ),
            ),
        ),
        'position'    => 'normal',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'   => 'field_db_data_source',
                'label' => 'Data Source',
                'name'  => 'data_source',
                'type'  => 'text',
                'instructions' => 'Where the data comes from (e.g. In-Game Testing, Rockstar).',
            ),
            array(
                'key'   => 'field_db_last_updated',
                'label' => 'Data Last Updated',
                'name'  => 'data_last_updated',
                'type'  => 'date_picker',
                'display_format' => 'F j, Y',
                'return_format'  => 'Y-m-d',
            ),
            array(
                'key'   => 'field_db_column_headers',
                'label' => 'Table Column Headers',
                'name'  => 'column_headers',
                'type'  => 'repeater',
                'instructions' => 'Define table columns. The first column is the primary identifier.',
                'min'   => 1,
                'max'   => 12,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_col_name',
                        'label' => 'Column Name',
                        'name'  => 'column_name',
                        'type'  => 'text',
                    ),
                    array(
                        'key'     => 'field_col_sortable',
                        'label'   => 'Sortable?',
                        'name'    => 'sortable',
                        'type'    => 'true_false',
                        'ui'      => 1,
                    ),
                    array(
                        'key'     => 'field_col_type',
                        'label'   => 'Data Type',
                        'name'    => 'data_type',
                        'type'    => 'select',
                        'choices' => array(
                            'text'    => 'Text',
                            'number'  => 'Number',
                            'code'    => 'Code/Cheat',
                            'image'   => 'Image',
                            'link'    => 'Link',
                            'badge'   => 'Badge/Tag',
                        ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_db_table_data',
                'label' => 'Table Data',
                'name'  => 'table_data',
                'type'  => 'repeater',
                'instructions' => 'Each row in the database table. Enter values matching column order.',
                'min'   => 0,
                'max'   => 500,
                'layout' => 'row',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_row_values',
                        'label' => 'Row Values (comma-separated)',
                        'name'  => 'row_values',
                        'type'  => 'textarea',
                        'instructions' => 'Pipe-separated values matching column order. E.g: Buzzard|Helicopter|1,925,000|Military',
                        'rows'  => 1,
                    ),
                ),
            ),
            array(
                'key'   => 'field_db_filter_taxonomies',
                'label' => 'Filter Taxonomies',
                'name'  => 'filter_taxonomies',
                'type'  => 'select',
                'instructions' => 'Which taxonomy to offer as a filter above the table.',
                'choices'   => array(
                    'none'          => 'None',
                    'platform'      => 'Platform',
                    'vehicle_class' => 'Vehicle Class',
                    'cheat_type'    => 'Cheat Type',
                    'game_title'    => 'Game Title',
                    'business_type' => 'Business Type',
                ),
                'multiple'  => 1,
                'ui'        => 1,
            ),
        ),
    ) );

    /* -------------------------------------------------------
       WEEKLY RECAP FIELDS
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_recap',
        'title'    => 'Weekly Recap Details',
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'recap',
                ),
            ),
        ),
        'position'    => 'normal',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'         => 'field_recap_date_range',
                'label'       => 'Week Date Range',
                'name'        => 'week_date_range',
                'type'        => 'text',
                'placeholder' => 'March 6-13, 2026',
            ),
            array(
                'key'   => 'field_recap_podium',
                'label' => 'Podium/Prize Vehicle',
                'name'  => 'podium_vehicle',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_recap_bonuses',
                'label' => 'Bonuses',
                'name'  => 'bonuses',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 20,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_bonus_name',
                        'label' => 'Activity/Mission',
                        'name'  => 'bonus_name',
                        'type'  => 'text',
                    ),
                    array(
                        'key'     => 'field_bonus_multiplier',
                        'label'   => 'Multiplier',
                        'name'    => 'multiplier',
                        'type'    => 'select',
                        'choices' => array(
                            '1.5x' => '1.5x',
                            '2x'   => '2x',
                            '3x'   => '3x',
                            '4x'   => '4x',
                        ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_recap_discounts',
                'label' => 'Discounts',
                'name'  => 'discounts',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 20,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_discount_item',
                        'label' => 'Item',
                        'name'  => 'item',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_discount_pct',
                        'label' => 'Discount %',
                        'name'  => 'discount_percentage',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'key'   => 'field_recap_new_content',
                'label' => 'New Content This Week',
                'name'  => 'new_content',
                'type'  => 'textarea',
                'rows'  => 4,
            ),
        ),
    ) );

    /* -------------------------------------------------------
       HUB PAGE FIELDS (applied to pages using hub template)
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_hub_page',
        'title'    => 'Hub Page (SAG Cluster) Settings',
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-hub.php',
                ),
            ),
        ),
        'position'    => 'normal',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'   => 'field_hub_cluster_name',
                'label' => 'Cluster Name',
                'name'  => 'hub_cluster_name',
                'type'  => 'text',
                'instructions' => 'Cluster name from SAG niche definition.',
            ),
            array(
                'key'     => 'field_hub_sector',
                'label'   => 'Sector',
                'name'    => 'hub_sector',
                'type'    => 'select',
                'choices' => array(
                    'gta6'       => 'GTA 6',
                    'cheats'     => 'Cheat Codes & Cheats',
                    'online'     => 'GTA Online',
                    'mods'       => 'Mods & Modding',
                    'cars'       => 'Cars & Vehicles',
                    'characters' => 'Characters & Story',
                    'locations'  => 'Map & Locations',
                    'money'      => 'Money & Business',
                    'news'       => 'News & Updates',
                ),
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'   => 'field_hub_attribute_intersection',
                'label' => 'Attribute Intersection',
                'name'  => 'hub_attribute_intersection',
                'type'  => 'text',
                'instructions' => 'e.g. "Class: All × Criteria: Top Speed"',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'   => 'field_hub_primary_keyword',
                'label' => 'Primary Keyword',
                'name'  => 'hub_primary_keyword',
                'type'  => 'text',
                'instructions' => 'Main target keyword for SEO.',
            ),
            array(
                'key'   => 'field_hub_quick_answer',
                'label' => 'Quick Answer (Featured Snippet)',
                'name'  => 'hub_quick_answer',
                'type'  => 'textarea',
                'instructions' => '2-3 sentence direct answer for the featured snippet box at the top of the page.',
                'rows'  => 3,
            ),
            array(
                'key'     => 'field_hub_hero_style',
                'label'   => 'Hero Section Style',
                'name'    => 'hub_hero_style',
                'type'    => 'select',
                'choices' => array(
                    'minimal'       => 'Minimal (title + quick answer)',
                    'image_overlay' => 'Image Overlay (featured image with gradient)',
                    'gradient'      => 'Gradient Background',
                    'video'         => 'Video Background',
                ),
                'default_value' => 'image_overlay',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'     => 'field_hub_layout_style',
                'label'   => 'Hub Page Layout Style',
                'name'    => 'hub_layout_style',
                'type'    => 'select',
                'choices' => array(
                    'micro_website' => 'Micro Website (landing page sections)',
                    'magazine'      => 'Magazine (editorial grid + features)',
                    'default'       => 'Default (standard hub layout)',
                ),
                'default_value' => 'micro_website',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'   => 'field_hub_key_facts',
                'label' => 'Key Facts Strip',
                'name'  => 'hub_key_facts',
                'type'  => 'repeater',
                'instructions' => 'Quick stat cards shown below the hero. Max 4.',
                'min'   => 0,
                'max'   => 4,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_fact_value',
                        'label' => 'Value',
                        'name'  => 'fact_value',
                        'type'  => 'text',
                        'placeholder' => '~4x GTA 5',
                    ),
                    array(
                        'key'   => 'field_fact_label',
                        'label' => 'Label',
                        'name'  => 'fact_label',
                        'type'  => 'text',
                        'placeholder' => 'EST MAP SIZE',
                    ),
                ),
            ),
            array(
                'key'   => 'field_hub_child_posts',
                'label' => 'Child Posts',
                'name'  => 'hub_child_posts',
                'type'  => 'relationship',
                'instructions' => 'All posts belonging to this hub cluster.',
                'post_type' => array( 'mod', 'guide', 'ranking', 'profile', 'answer', 'database', 'recap', 'post' ),
                'filters'   => array( 'search', 'post_type', 'taxonomy' ),
                'max'       => 50,
                'return_format' => 'object',
            ),
            array(
                'key'   => 'field_hub_featured_post',
                'label' => 'Featured Child Post',
                'name'  => 'hub_featured_post',
                'type'  => 'post_object',
                'instructions' => 'Which child post gets the large hero card in the magazine grid.',
                'post_type' => array( 'mod', 'guide', 'ranking', 'profile', 'answer', 'database', 'recap' ),
                'return_format' => 'object',
            ),
            array(
                'key'   => 'field_hub_cross_cluster_links',
                'label' => 'Cross-Cluster Hub Links',
                'name'  => 'hub_cross_cluster_links',
                'type'  => 'relationship',
                'instructions' => 'Select 2-3 related hub pages from other clusters.',
                'post_type' => array( 'page' ),
                'filters'   => array( 'search' ),
                'max'       => 5,
                'return_format' => 'object',
            ),
            array(
                'key'   => 'field_hub_faq',
                'label' => 'FAQ Section',
                'name'  => 'hub_faq_items',
                'type'  => 'repeater',
                'instructions' => 'Q&A pairs for the FAQ section (also used for FAQPage schema).',
                'min'   => 0,
                'max'   => 15,
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_faq_question',
                        'label' => 'Question',
                        'name'  => 'question',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_faq_answer',
                        'label' => 'Answer',
                        'name'  => 'answer',
                        'type'  => 'wysiwyg',
                        'tabs'  => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                    ),
                ),
            ),
        ),
    ) );

    /* -------------------------------------------------------
       GTA 6 ANTICIPATION FIELDS (cross-post-type)
       Applied to any post in GTA 6 category
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_gta6_anticipation',
        'title'    => 'GTA 6 Content Settings',
        'location' => array(
            array(
                array(
                    'param'    => 'post_category',
                    'operator' => '==',
                    'value'    => 'category:gta6',
                ),
            ),
        ),
        'position'    => 'side',
        'menu_order'  => 0,
        'fields'      => array(
            array(
                'key'     => 'field_gta6_confidence',
                'label'   => 'Confidence Level',
                'name'    => 'confidence_level',
                'type'    => 'select',
                'choices' => array(
                    'confirmed'   => '✓ Confirmed',
                    'likely'      => '◐ Likely',
                    'rumored'     => '? Rumored',
                    'speculative' => '⚡ Speculative',
                ),
                'default_value' => 'rumored',
            ),
            array(
                'key'   => 'field_gta6_source_url',
                'label' => 'Source URL',
                'name'  => 'source_url',
                'type'  => 'url',
                'instructions' => 'Link to original source.',
            ),
            array(
                'key'     => 'field_gta6_source_type',
                'label'   => 'Source Type',
                'name'    => 'source_type',
                'type'    => 'select',
                'choices' => array(
                    'official'  => 'Official Rockstar',
                    'trailer'   => 'Trailer Analysis',
                    'datamine'  => 'Datamine',
                    'leaker'    => 'Reputable Leaker',
                    'community' => 'Community',
                    'press'     => 'Press',
                    'speculation' => 'Speculation',
                ),
            ),
            array(
                'key'   => 'field_gta6_last_verified',
                'label' => 'Last Verified',
                'name'  => 'last_verified',
                'type'  => 'date_picker',
                'display_format' => 'F j, Y',
                'return_format'  => 'Y-m-d',
            ),
            array(
                'key'   => 'field_gta6_update_needed',
                'label' => 'Needs Post-Launch Update',
                'name'  => 'post_launch_update_needed',
                'type'  => 'true_false',
                'ui'    => 1,
                'default_value' => 1,
            ),
            array(
                'key'   => 'field_gta6_replaces_url',
                'label' => 'Replaces URL',
                'name'  => 'replaces_url',
                'type'  => 'url',
                'instructions' => 'Post-launch replacement URL if applicable.',
            ),
        ),
    ) );

    /* -------------------------------------------------------
       UNIVERSAL POST FIELDS (hub assignment + internal linking)
       Applied to all custom post types
       ------------------------------------------------------- */
    acf_add_local_field_group( array(
        'key'      => 'group_universal_post',
        'title'    => 'Hub & Linking Settings',
        'location' => array(
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'mod' ) ),
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'guide' ) ),
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'ranking' ) ),
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'profile' ) ),
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'answer' ) ),
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'database' ) ),
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'recap' ) ),
        ),
        'position'    => 'side',
        'menu_order'  => 5,
        'fields'      => array(
            array(
                'key'   => 'field_hub_page_assignment',
                'label' => 'Parent Hub Page',
                'name'  => 'hub_page_assignment',
                'type'  => 'post_object',
                'instructions' => 'Which hub page this post belongs to.',
                'post_type' => array( 'page' ),
                'return_format' => 'id',
            ),
            array(
                'key'   => 'field_hub_link_inserted',
                'label' => 'Hub Link Inserted?',
                'name'  => 'hub_link_inserted',
                'type'  => 'true_false',
                'ui'    => 1,
                'instructions' => 'Check when you\'ve added a link to the parent hub in the first 2 paragraphs.',
            ),
        ),
    ) );
}
add_action( 'acf/init', 'gtalobby_register_acf_fields' );

/* -------------------------------------------------------
   FALLBACK META BOXES (when ACF is not active)
   Provides basic meta fields via native WordPress meta boxes.
   ------------------------------------------------------- */
function gtalobby_register_fallback_meta_boxes() {
    if ( gtalobby_acf_active() ) {
        return;
    }

    // Register meta keys for all post types
    $meta_keys = array(
        'hub_page_assignment',
        'download_url',
        'mod_version',
        'file_size',
        'author_name',
        'difficulty_rating',
        'time_to_complete',
        'step_count',
        'video_embed',
        'ranking_criteria',
        'total_items',
        'entity_type',
        'first_appearance',
        'voice_actor',
        'short_answer',
        'data_source',
        'week_date_range',
        'podium_vehicle',
        'hub_cluster_name',
        'hub_sector',
        'hub_primary_keyword',
        'hub_quick_answer',
        'hub_hero_style',
        'hub_layout_style',
        'confidence_level',
        'source_url',
        'source_type',
        'last_verified',
        'post_launch_update_needed',
    );

    foreach ( $meta_keys as $key ) {
        register_meta( 'post', $key, array(
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => function() {
                return current_user_can( 'edit_posts' );
            },
        ) );
    }
}
add_action( 'init', 'gtalobby_register_fallback_meta_boxes' );
