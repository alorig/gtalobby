<?php
/**
 * GtaLobby — Content Seeder
 *
 * Creates seed content across all 7 post types and 9 categories,
 * plus additional hub pages. Populates taxonomy terms, custom fields,
 * and wires up hub ↔ child post relationships.
 *
 * Triggered on theme activation (after_switch_theme) or via admin action.
 *
 * @package GtaLobby
 1*/

defined( 'ABSPATH' ) || exit;

/**
 * Seed content on theme switch if not already seeded.
 */
function gtalobby_seed_content() {
    if ( ! is_admin() && ! defined( 'WP_CLI' ) ) {
        return;
    }

    // Check if we already seeded.
    if ( get_option( 'gtalobby_content_seeded' ) ) {
        return;
    }

    // Seed additional hub pages first.
    $hub_ids = gtalobby_seed_additional_hubs();

    // Seed posts across all post types.
    $post_ids = gtalobby_seed_posts();

    // Ensure at least one visible GTA 6 article exists (quick sample content).
    $sample_post_id = gtalobby_seed_sample_post();
    if ( $sample_post_id ) {
        $post_ids[] = $sample_post_id;
    }

    // Wire up hub ↔ child relationships.
    gtalobby_wire_hub_children( $hub_ids, $post_ids );

    update_option( 'gtalobby_content_seeded', true );
}
add_action( 'after_switch_theme', 'gtalobby_seed_content', 30 );

/**
 * Manual trigger: /wp-admin/admin-post.php?action=gtalobby_seed_content
 */
function gtalobby_manual_seed_content() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized' );
    }
    delete_option( 'gtalobby_content_seeded' );
    gtalobby_seed_content();
    wp_safe_redirect( admin_url( 'edit.php?post_type=guide&seeded_content=1' ) );
    exit;
}
add_action( 'admin_post_gtalobby_seed_content', 'gtalobby_manual_seed_content' );

/* ==========================================================================
   HELPER: Get or create category by slug
   ========================================================================== */

function gtalobby_get_cat_id( $slug ) {
    $cat = get_category_by_slug( $slug );
    return $cat ? $cat->term_id : 0;
}

function gtalobby_get_term_id( $slug, $taxonomy ) {
    $term = get_term_by( 'slug', $slug, $taxonomy );
    return $term ? $term->term_id : 0;
}

/**
 * Ensure sample GTA 6 article exists so the UI has immediate visible content.
 */
function gtalobby_seed_sample_post() {
    if ( ! function_exists( 'wp_insert_post' ) ) {
        return 0;
    }

    $gta6_cat = get_category_by_slug( 'gta6' );
    if ( ! $gta6_cat ) {
        $cat_id = wp_create_category( 'GTA 6' );
        if ( is_wp_error( $cat_id ) || ! $cat_id ) {
            return 0;
        }
        $gta6_cat = get_category( $cat_id );
    }

    $existing = get_posts( array(
        'category'       => $gta6_cat->term_id,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
    ) );
    if ( ! empty( $existing ) ) {
        return 0;
    }

    $sample_id = wp_insert_post( array(
        'post_title'   => 'GTA 6 Release Date Update (Seeded Sample)',
        'post_content' => '<p>This is a seeded sample article for the GTA 6 hub. It displays content in the hub/category listing so the page no longer shows empty state.</p>',
        'post_excerpt' => 'Seeded GTA 6 release date update content',
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_author'  => get_current_user_id() ?: 1,
        'post_category'=> array( $gta6_cat->term_id ),
    ), true );

    if ( is_wp_error( $sample_id ) || ! $sample_id ) {
        return 0;
    }

    wp_set_post_terms( $sample_id, array( $gta6_cat->term_id ), 'category', false );

    $hub = get_page_by_path( 'gta-6-release-date' );
    if ( $hub && $hub->ID ) {
        $child_posts = get_post_meta( $hub->ID, 'hub_child_posts', true );
        if ( ! is_array( $child_posts ) ) {
            $child_posts = array();
        }
        if ( ! in_array( $sample_id, $child_posts, true ) ) {
            $child_posts[] = $sample_id;
            update_post_meta( $hub->ID, 'hub_child_posts', $child_posts );
        }
    }

    return $sample_id;
}

/* ==========================================================================
   ADDITIONAL HUB PAGES (7 more — one per remaining category)
   ========================================================================== */

function gtalobby_seed_additional_hubs() {
    $hub_ids = array();

    // First, collect existing hub page IDs.
    $existing_map = get_page_by_path( 'gta-6-map' );
    $existing_rd  = get_page_by_path( 'gta-6-release-date' );
    if ( $existing_map ) $hub_ids['gta-6-map'] = $existing_map->ID;
    if ( $existing_rd )  $hub_ids['gta-6-release-date'] = $existing_rd->ID;

    $hubs = array(

        /* --- CHEATS HUB --- */
        array(
            'slug'            => 'gta-5-cheats',
            'title'           => 'All GTA 5 Cheat Codes for PS5, PS4, Xbox, and PC — Complete List',
            'excerpt'         => 'The complete GTA 5 cheat codes list for every platform including PS5, PS4, Xbox Series X, Xbox One, and PC with button combinations and phone numbers.',
            'cluster_name'    => 'GTA 5 Cheats',
            'sector'          => 'cheats',
            'primary_keyword' => 'GTA 5 cheats',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>GTA 5 features over <strong>30 cheat codes</strong> across all platforms. On PS4/PS5, cheats are entered as button combinations during gameplay. On Xbox, similar button combos apply. PC players can use the tilde (~) console. Cheats include invincibility, all weapons, wanted level changes, vehicle spawns, and world modifiers. <strong>Cheats disable achievements/trophies</strong> for that session.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Total Cheats',  'fact_value' => '35+ codes' ),
                array( 'fact_label' => 'Platforms',     'fact_value' => 'PS, Xbox, PC' ),
                array( 'fact_label' => 'Input Method',  'fact_value' => 'Button combo / console' ),
                array( 'fact_label' => 'Trophies',      'fact_value' => 'Disabled when active' ),
            ),
            'faq_items' => array(
                array( 'question' => 'Do GTA 5 cheats disable achievements?', 'answer' => '<p>Yes. Activating any cheat code in GTA 5 will disable trophies and achievements for the current play session. You need to reload a save without cheats active to re-enable them.</p>' ),
                array( 'question' => 'Can you use cheats in GTA Online?', 'answer' => '<p>No. Cheat codes are completely disabled in GTA Online. They only work in Story Mode. Using external cheating tools in GTA Online can result in a permanent ban.</p>' ),
                array( 'question' => 'How do you enter cheats on PS5?', 'answer' => '<p>During gameplay (not in a menu or cutscene), press the button combination quickly. For example, the invincibility cheat is: Right, X, Right, Left, Right, R1, Right, Left, X, Triangle. You\'ll see a confirmation message on screen.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-5-best-cars' ),
            'content' => '<!-- wp:heading -->
<h2>Complete GTA 5 Cheat Codes List</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Grand Theft Auto 5 includes a comprehensive set of cheat codes that let you manipulate the game world in creative and often hilarious ways. Whether you want to become invincible, spawn a fighter jet, or make the world go into slow motion, there\'s a cheat for that.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Player Cheats</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Player cheats modify your character\'s abilities and status. The most popular is <strong>invincibility</strong>, which makes you immune to all damage for 5 minutes. Other player cheats include max health and armor, super jump, explosive melee attacks, and fast run/swim.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Vehicle Spawn Cheats</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Vehicle spawn cheats instantly create a vehicle right in front of you. Available spawns include the <strong>Buzzard Attack Helicopter</strong>, Comet sports car, Sanchez dirt bike, Trashmaster, BMX bicycle, Rapid GT, Duster plane, and the PCJ-600 motorcycle. These are perfect for quick getaways or just cruising the map.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>World Modifier Cheats</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>World cheats change the environment around you. You can cycle through weather states (sunny, rainy, thunderstorm, foggy, snowy), toggle slow motion, reduce gravity, or make all NPCs hostile. The <strong>moon gravity cheat</strong> is a fan favorite — vehicles float through the air after even small bumps.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Platform-Specific Input Methods</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Each platform has its own method for entering cheats. <strong>PlayStation</strong> and <strong>Xbox</strong> use button combinations entered during gameplay. <strong>PC</strong> players can press the tilde key (~) to open the console and type cheat codes directly. All platforms can also use the in-game phone dialer to enter cheat phone numbers.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Important Cheat Warnings</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Before you start entering cheats, keep these warnings in mind: cheats <strong>disable trophies and achievements</strong> for the current session, cheats cannot be used during missions, and some cheats (like invincibility) are timed and will expire after 5 minutes. Always save your game before activating cheats so you can reload a clean save afterward.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- GTA ONLINE HUB --- */
        array(
            'slug'            => 'gta-online-money-guide',
            'title'           => 'How to Make Money in GTA Online — Best Methods Ranked for 2026',
            'excerpt'         => 'The ultimate guide to making money in GTA Online in 2026, covering every business, heist, and passive income method ranked by profit per hour.',
            'cluster_name'    => 'GTA Online Money',
            'sector'          => 'online',
            'primary_keyword' => 'GTA Online money guide',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>The fastest way to make money in GTA Online in 2026 is through <strong>Cayo Perico Heist</strong> ($1.2-1.9M per run), followed by the <strong>Agency VIP Contract</strong> ($1M+), and <strong>Nightclub passive income</strong> ($800K+ AFK). For beginners, start with <strong>VIP Work</strong> (Headhunter/Sightseer) to build capital, then invest in a Kosatka submarine.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Best Solo',       'fact_value' => 'Cayo Perico Heist' ),
                array( 'fact_label' => 'Best Passive',    'fact_value' => 'Nightclub AFK' ),
                array( 'fact_label' => 'Startup Cost',    'fact_value' => '$2.2M (Kosatka)' ),
                array( 'fact_label' => 'Top $/Hour',      'fact_value' => '$1.5M+' ),
            ),
            'faq_items' => array(
                array( 'question' => 'What is the best solo money method in GTA Online?', 'answer' => '<p>The Cayo Perico Heist remains the best solo money method. With practice, you can complete the entire heist (setup + finale) in under 45 minutes for $1.2-1.9M depending on the primary target. The Kosatka submarine costs $2.2M to unlock access.</p>' ),
                array( 'question' => 'How much can you earn per hour in GTA Online?', 'answer' => '<p>Experienced players can earn $1.5M+ per hour through Cayo Perico grinding. With AFK Nightclub income running simultaneously, you can add another $50K-$100K per hour passively. Combined with daily objectives and weekly bonuses, $2M+ per hour is achievable.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-5-cheats' ),
            'content' => '<!-- wp:heading -->
<h2>Making Money in GTA Online: The 2026 Landscape</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>GTA Online\'s economy has evolved dramatically since 2013. What started as a simple grind of contact missions has expanded into a complex ecosystem of businesses, heists, and passive income streams. In 2026, there are dozens of ways to earn money, but not all methods are created equal. This guide ranks every major money-making method by efficiency.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Tier 1: Best Money Methods ($1M+ Per Hour)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <strong>Cayo Perico Heist</strong> stands unchallenged as the single best money maker in GTA Online. Launched in December 2020, this heist can be completed entirely solo, requires only the Kosatka submarine ($2.2M), and pays between $1.2M and $1.9M per completion depending on the primary target (Pink Diamond is the best at $1.43M base).</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The <strong>Agency VIP Contract</strong> is the second-best high-payout activity. Dr. Dre\'s VIP Contract pays $1M on first completion and can be replayed for slightly less. The Agency also generates passive income ($20K every 48 minutes) once you complete 201 security contracts.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Tier 2: Solid Earners ($500K-$1M Per Hour)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <strong>Diamond Casino Heist</strong> pays $900K-$2.1M but requires 2 players minimum. The <strong>Auto Shop contracts</strong> pay $170K-$300K per contract and can be chained quickly. <strong>Special Cargo</strong> large warehouse sales ($2.2M for a full warehouse) remain profitable but require significant time investment to fill.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Tier 3: Passive Income (AFK Methods)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <strong>Nightclub</strong> is the king of passive income. Link it to your MC businesses, Bunker, Cargo, and Hangar, and it accumulates stock while you play (or AFK). A fully upgraded Nightclub generates $800K+ per real-time day of AFK farming. The <strong>Bunker</strong> and <strong>MC Businesses</strong> (Cocaine, Meth) also generate passive product but require supply purchases.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Beginner Path: From $0 to Millionaire</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>New players should follow this progression: Start with <strong>VIP Work</strong> (free with $50K in the bank) doing Headhunter and Sightseer for $20K-$25K each. Save $2.2M for the <strong>Kosatka</strong>. Run Cayo Perico to build wealth. Invest in a Nightclub, Bunker, and Agency to diversify income streams.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- MODS HUB --- */
        array(
            'slug'            => 'best-gta-5-mods',
            'title'           => 'The Best GTA 5 Mods in 2026 — Graphics, Vehicles, Scripts, and Total Conversions',
            'excerpt'         => 'Curated list of the best GTA 5 mods including visual overhauls, vehicle packs, script mods, and total conversions with download links and installation guides.',
            'cluster_name'    => 'Best GTA 5 Mods',
            'sector'          => 'mods',
            'primary_keyword' => 'best GTA 5 mods',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>The best GTA 5 mods in 2026 include <strong>NaturalVision Evolved</strong> (graphics overhaul), <strong>LSPDFR</strong> (police roleplay), <strong>Simple Trainer</strong> (sandbox features), and <strong>Add-On Vehicle Packs</strong> (real-world cars). Most mods require <strong>OpenIV</strong> and <strong>Script Hook V</strong> as prerequisites and are PC-only.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Platform',     'fact_value' => 'PC only' ),
                array( 'fact_label' => 'Required Tool', 'fact_value' => 'OpenIV + Script Hook V' ),
                array( 'fact_label' => 'Top Graphics',  'fact_value' => 'NaturalVision Evolved' ),
                array( 'fact_label' => 'Top Script',    'fact_value' => 'LSPDFR' ),
            ),
            'faq_items' => array(
                array( 'question' => 'Can you get banned for using mods in GTA 5?', 'answer' => '<p>In Story Mode, no — Rockstar does not ban players for modding single-player. However, <strong>never use mods in GTA Online</strong>. Rockstar\'s anti-cheat will detect modified files and can result in a permanent ban. Always switch to a clean game install before going online.</p>' ),
                array( 'question' => 'What tools do I need to mod GTA 5?', 'answer' => '<p>The essential toolkit includes: <strong>OpenIV</strong> (file manager for game archives), <strong>Script Hook V</strong> (enables custom scripts), <strong>Script Hook V .NET</strong> (for C# mods), and optionally <strong>RAGE Plugin Hook</strong> (for LSPDFR). All are free and available from their respective websites.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-5-best-cars' ),
            'content' => '<!-- wp:heading -->
<h2>Why Mod GTA 5 in 2026?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Over a decade after launch, GTA 5 remains one of the most modded games in history. The modding community has produced everything from photorealistic graphics overhauls to complete gameplay transformations. With GTA 6 on the horizon, the modding scene is more active than ever — modders are pushing the RAGE engine to its absolute limits.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Graphics and Visual Mods</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>NaturalVision Evolved</strong> is the undisputed king of visual mods. This complete overhaul replaces weather systems, lighting, textures, and color grading to produce a photorealistic Los Santos. Combined with <strong>QuantV</strong> for advanced shader effects and <strong>LA Roads</strong> for high-resolution street textures, you can make GTA 5 look stunning by modern standards.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Script Mods That Transform Gameplay</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>LSPDFR (Los Santos Police Department First Response)</strong> turns GTA 5 into a police simulator. You patrol the streets, respond to calls, conduct traffic stops, and manage pursuits. It has its own plugin ecosystem with hundreds of add-ons. <strong>Simple Trainer</strong> gives you a menu-based sandbox with god mode, teleportation, vehicle spawning, and weather control.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Vehicle Mods</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The GTA 5 vehicle modding scene is enormous. Add-on vehicle packs bring real-world cars — Lamborghini Aventador, BMW M3, Toyota Supra — into the game with incredible detail. <strong>Replace</strong> mods swap existing vehicles, while <strong>add-on</strong> mods add entirely new slots. Popular sources include GTA5-Mods.com and Liberty City Modding.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Essential Modding Tools</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Before installing any mods, you need the core toolkit: <strong>OpenIV</strong> for managing game archives, <strong>Script Hook V</strong> for enabling script mods, and a <strong>mods folder</strong> setup to keep your original game files clean. Always back up your game before modding, and never take modded files into GTA Online.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- CARS HUB --- */
        array(
            'slug'            => 'gta-5-best-cars',
            'title'           => 'The Fastest Cars in GTA 5 Online — Top Speed and Lap Time Rankings 2026',
            'excerpt'         => 'Complete ranking of the fastest cars in GTA 5 Online by top speed and lap time, updated for 2026 with every DLC vehicle included.',
            'cluster_name'    => 'Fastest Cars',
            'sector'          => 'cars',
            'primary_keyword' => 'fastest cars GTA 5',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>The fastest car in GTA Online by top speed is the <strong>Ocelot Virtue</strong> at 141.25 mph, followed by the S80RR and Vigilante. For lap times (which matter more for racing), the <strong>Benefactor BR8</strong> leads open-wheel, while the <strong>Progen Emerus</strong> and <strong>Grotti Itali RSX</strong> dominate supers. The fastest overall vehicle is the <strong>Oppressor Mk II</strong> when considering flight.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Fastest (Speed)',  'fact_value' => 'Ocelot Virtue (141 mph)' ),
                array( 'fact_label' => 'Fastest (Lap)',    'fact_value' => 'Benefactor BR8' ),
                array( 'fact_label' => 'Total Vehicles',   'fact_value' => '700+' ),
                array( 'fact_label' => 'Vehicle Classes',   'fact_value' => '14 classes' ),
            ),
            'faq_items' => array(
                array( 'question' => 'What is the fastest car in GTA 5 Online?', 'answer' => '<p>By pure top speed, the <strong>Ocelot Virtue</strong> reaches 141.25 mph. However, for racing, lap time matters more than top speed. The <strong>Benefactor BR8</strong> (Open Wheel) and <strong>Progen Emerus</strong> (Super) have the best lap times due to superior handling and acceleration.</p>' ),
                array( 'question' => 'Is top speed or lap time more important?', 'answer' => '<p>Lap time is more important for racing because it accounts for acceleration, braking, and cornering — not just straight-line speed. A car with a lower top speed but better handling will beat a faster car on most tracks. Top speed only matters on long highway straights.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-online-money-guide' ),
            'content' => '<!-- wp:heading -->
<h2>GTA 5 Vehicle Performance Rankings Explained</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>With over 700 vehicles in GTA Online, finding the genuinely fastest cars requires systematic testing. This hub page compiles tested performance data for every competitive vehicle, organized by class and ranked by both top speed and lap time.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Super Cars: The Top Tier</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <strong>Super</strong> class is where the fastest cars live. The Progen Emerus, Ocelot Virtue, and Grotti Itali RSX compete for the top spot depending on the track. The Emerus excels at technical circuits, while the Virtue dominates on tracks with long straights. For all-around performance, the <strong>Dewbauchee Vagner</strong> remains excellent value at just $1.5M.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Sports Cars: Best Value Racing</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sports class racing offers the most competitive field in GTA Online. The <strong>Annis Calico GTF</strong> and <strong>Karin Sultan RS Classic</strong> dominate, with lap times surprisingly close to some super cars. At $1.9M and $1.7M respectively, they offer incredible racing performance without the multi-million dollar price tags of supers.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Muscle Cars and Classic Cruisers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The muscle class was revitalized with the Los Santos Tuners update. The <strong>Buffalo STX</strong> and <strong>Dominator ASP</strong> are the fastest muscle cars for racing. For cruising, classics like the <strong>Sabre Turbo Custom</strong> and <strong>Impaler</strong> offer style that no super car can match.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>How We Test Vehicle Performance</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>All vehicles are tested on a standardized circuit and drag strip using stock configurations. Top speed is measured on a straight highway section, while lap times are recorded on a mixed circuit with turns, straights, and elevation changes. Results are averaged across multiple runs to ensure accuracy.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- FASTEST CARS HUB --- */
        array(
            'slug'            => 'fastest-cars-gta-5',
            'title'           => 'The Fastest Cars in GTA 5 Ranked by Top Speed and Lap Time with Full Stats',
            'excerpt'         => 'Ultimate hub for the fastest cars in GTA 5 with rankings, guides, reviews, database, and updates.',
            'cluster_name'    => 'Fastest Car GTA 5',
            'sector'          => 'cars',
            'primary_keyword' => 'fastest car in gta 5',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>The fastest car in GTA 5 is the Ocelot Pariah at 136.0 mph stock. In GTA Online with HSW, the S80RR can hit 151.0 mph. This hub includes all key fast-car resources and comparisons.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Top Speed Leader',  'fact_value' => 'Ocelot Pariah (136.0 mph)' ),
                array( 'fact_label' => 'HSW Leader',       'fact_value' => 'S80RR (151.0 mph)' ),
                array( 'fact_label' => 'Best Acceleration','fact_value' => 'Grotti Itali RSX' ),
                array( 'fact_label' => 'Ranking Count',    'fact_value' => '20+ cars' ),
            ),
            'faq_items' => array(
                array( 'question' => 'What is the fastest car in GTA 5?', 'answer' => '<p>In stock GTA 5, the Ocelot Pariah is the fastest car by top speed at 136.0 mph. For online HSW tuning, the Pfister S80RR leads with 151.0 mph.</p>' ),
                array( 'question' => 'Is HSW required for the fastest car?', 'answer' => '<p>HSW is not required for story mode, where the Pariah is fastest stock. In online racing, HSW offers significant advantage, making cars like S80RR and Ocelot Virtue faster on straights.</p>' ),
                array( 'question' => 'What is the fastest drag car in GTA 5?', 'answer' => '<p>Top drag choices include the Ocelot Pariah, Pfister 811, and Benefactor Krieger. For pure 1/4 mile acceleration, consider the Grotti Itali RSX in stock lap races and HSW classes.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-5-best-cars', 'gta-online-money-guide' ),
            'content' => '<!-- wp:heading -->
<h2>The Fastest Cars in GTA 5 — Hub Overview</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This hub ranks the fastest cars in GTA 5 by top speed, lap time, and acceleration. It includes dedicated guides, database resources, and quick answers for the most common speed questions.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>How We Ranked These Cars</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Rankings are based on Broughy1322 testing data, stock vs HSW, and published lap times. We prioritize top speed first, then lap time and handling for racing contexts.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Articles in This Guide</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Includes child posts: Quick Answer, Database, Guide, Profile, Mod Listing, Weekly Recap, and No-HSW Ranking.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- CHARACTERS HUB --- */
        array(
            'slug'            => 'gta-6-characters',
            'title'           => 'GTA 6 Characters — Everything Known About Lucia, Jason, and the Full Cast',
            'excerpt'         => 'Complete guide to all confirmed and rumored GTA 6 characters including protagonists Lucia and Jason, supporting cast, and voice actors.',
            'cluster_name'    => 'GTA 6 Characters',
            'sector'          => 'characters',
            'primary_keyword' => 'GTA 6 characters',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>GTA 6 features <strong>two playable protagonists</strong>: <strong>Lucia</strong>, the series\' first female lead, and <strong>Jason</strong>, her criminal partner. They form a Bonnie-and-Clyde-inspired duo in modern-day Leonida (Florida). Lucia has a Latin American background and was shown in prison during the trailer. Supporting characters spotted in trailers include various gang members, law enforcement, and civilians.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Protagonists', 'fact_value' => 'Lucia & Jason' ),
                array( 'fact_label' => 'First Female Lead', 'fact_value' => 'Yes (Lucia)' ),
                array( 'fact_label' => 'Inspiration', 'fact_value' => 'Bonnie & Clyde' ),
                array( 'fact_label' => 'Setting Era', 'fact_value' => 'Modern day' ),
            ),
            'faq_items' => array(
                array( 'question' => 'Who is Lucia in GTA 6?', 'answer' => '<p>Lucia is one of two playable protagonists in GTA 6 and the first female lead in the mainline GTA series. She has a Latin American background, was shown in a prison scene in Trailer 1, and forms a criminal partnership with Jason. Her character appears to be central to the game\'s story of rising through Vice City\'s criminal underworld.</p>' ),
                array( 'question' => 'Can you switch between Lucia and Jason?', 'answer' => '<p>While not officially confirmed, the expectation is that GTA 6 will use a character-switching system similar to GTA 5\'s three-protagonist mechanic. Players will likely be able to switch between Lucia and Jason during free roam and certain missions.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-6-map', 'gta-6-release-date' ),
            'content' => '<!-- wp:heading -->
<h2>GTA 6 Protagonists: A New Kind of Story</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Grand Theft Auto VI breaks new ground with its dual-protagonist system featuring <strong>Lucia</strong> and <strong>Jason</strong>. Unlike GTA 5\'s three disconnected characters, Lucia and Jason share an intertwined story as partners in crime — and seemingly in romance. Their dynamic draws from real criminal duos throughout history, most notably Bonnie Parker and Clyde Barrow.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Lucia: The Series\' First Female Lead</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lucia is a groundbreaking character for the GTA franchise. She\'s Latina, has a criminal background (the trailer shows her in prison), and appears to be a fully realized protagonist — not a supporting character. Leaks suggest she\'s intelligent, resourceful, and the strategic mind of the duo. Voice acting leaks point to a nuanced performance that grounds the character in emotional reality.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Jason: The Other Half</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Jason appears to be a risk-taking, impulsive counterpart to Lucia\'s calculated approach. Trailer footage shows him in various criminal scenarios — armed robberies, high-speed chases, and tense standoffs. His character design suggests a working-class background with ties to Vice City\'s criminal ecosystem.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Supporting Cast and NPCs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trailer footage and leaks have revealed glimpses of a diverse supporting cast. Confirmed or likely characters include corrupt law enforcement, rival gang leaders, cartel figures tied to Vice City\'s drug trade, and civilian contacts. The leaked footage showed significantly more detailed NPC interactions than any previous GTA title, with context-aware dialogue and realistic behavior patterns.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- LOCATIONS HUB --- */
        array(
            'slug'            => 'gta-5-map-locations',
            'title'           => 'GTA 5 Map — All Locations, Hidden Spots, and Collectibles Guide',
            'excerpt'         => 'Complete guide to the GTA 5 map including all named locations, hidden spots, collectibles, and secret areas in Los Santos and Blaine County.',
            'cluster_name'    => 'GTA 5 Map Guide',
            'sector'          => 'locations',
            'primary_keyword' => 'GTA 5 map locations',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>The GTA 5 map covers the fictional state of <strong>San Andreas</strong>, featuring <strong>Los Santos</strong> (based on Los Angeles), <strong>Blaine County</strong> (rural desert and mountains), and <strong>Mount Chiliad</strong> as the highest point. The map is approximately 75-80 square kilometers and contains hundreds of points of interest, 50 spaceship parts, 50 letter scraps, and dozens of hidden easter eggs.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Map Size',        'fact_value' => '~80 sq km' ),
                array( 'fact_label' => 'Main City',       'fact_value' => 'Los Santos' ),
                array( 'fact_label' => 'Collectibles',    'fact_value' => '100+ items' ),
                array( 'fact_label' => 'Named Locations',  'fact_value' => '250+' ),
            ),
            'faq_items' => array(
                array( 'question' => 'How big is the GTA 5 map?', 'answer' => '<p>The GTA 5 map is approximately 75-80 square kilometers, making it one of the largest open worlds at the time of its release. It includes a major city (Los Santos), suburban areas, a desert region, forests, mountains, and ocean. For comparison, GTA 4\'s Liberty City was about 16 square kilometers.</p>' ),
                array( 'question' => 'Where is the UFO in GTA 5?', 'answer' => '<p>There are three UFOs in GTA 5, unlocked after achieving 100% completion. One appears above Mount Chiliad at 3:00 AM during rain. Another hovers over Fort Zancudo. The third is above Sandy Shores. They\'re part of the game\'s elaborate Epsilon/alien easter egg storyline.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-6-map' ),
            'content' => '<!-- wp:heading -->
<h2>The GTA 5 Map: Los Santos and Beyond</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When GTA 5 launched in 2013, its map was a revelation. Rockstar\'s recreation of Los Angeles as <strong>Los Santos</strong> — surrounded by the rural expanse of <strong>Blaine County</strong> — remains one of the most detailed open worlds in gaming. This guide covers every significant location, hidden area, and collectible across the entire map.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Los Santos Districts</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Los Santos is divided into distinct neighborhoods, each with unique character. <strong>Vinewood</strong> mirrors Hollywood with its famous sign and celebrity mansions. <strong>Downtown</strong> features the Maze Bank Tower (tallest building). <strong>South Los Santos</strong> is gang territory inspired by South Central LA. <strong>Vespucci Beach</strong> recreates Venice Beach\'s boardwalk culture. <strong>Rockford Hills</strong> channels Beverly Hills luxury.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Blaine County: The Wilderness</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>North of Los Santos lies Blaine County — a vast rural area featuring the desert town of <strong>Sandy Shores</strong>, <strong>Grapeseed</strong> farmland, <strong>Paleto Bay</strong> (a quiet coastal town), and the towering <strong>Mount Chiliad</strong>. The county is home to survivalists, meth labs, and some of the game\'s most memorable missions.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Collectibles and Hidden Items</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>GTA 5 is packed with collectibles. <strong>50 Spaceship Parts</strong> are scattered across the map for the Beyond the Stars mission. <strong>50 Letter Scraps</strong> reveal the story of a murdered writer. <strong>Nuclear Waste</strong> barrels lie on the ocean floor. <strong>Peyote Plants</strong> (in the enhanced edition) let you play as animals. Finding them all requires thorough exploration of every corner of San Andreas.</p>
<!-- /wp:paragraph -->',
        ),

        /* --- MONEY HUB --- */
        array(
            'slug'            => 'gta-online-nightclub-guide',
            'title'           => 'GTA Online Nightclub Guide — Setup, Upgrades, and Maximum Passive Income',
            'excerpt'         => 'Complete guide to the GTA Online Nightclub business including setup, best upgrades, technician assignments, and how to maximize passive income.',
            'cluster_name'    => 'Nightclub Business',
            'sector'          => 'money',
            'primary_keyword' => 'GTA Online nightclub guide',
            'hero_style'      => 'standard',
            'layout_style'    => 'micro_website',
            'quick_answer'    => '<p>The GTA Online Nightclub is the <strong>best passive income business</strong> in the game. Buy it ($1.08M-$1.7M), hire technicians, and it accumulates goods from your other businesses automatically — <strong>no supply runs needed</strong>. A fully upgraded Nightclub with 5 technicians generates $800K-$1M per day of AFK play. The <strong>Equipment Upgrade</strong> ($1.4M) is the most important purchase.</p>',
            'key_facts' => array(
                array( 'fact_label' => 'Base Price',   'fact_value' => '$1.08M-$1.7M' ),
                array( 'fact_label' => 'Max Technicians', 'fact_value' => '5' ),
                array( 'fact_label' => 'AFK Income',   'fact_value' => '$800K+/day' ),
                array( 'fact_label' => 'Key Upgrade',   'fact_value' => 'Equipment ($1.4M)' ),
            ),
            'faq_items' => array(
                array( 'question' => 'Do I need other businesses for the Nightclub?', 'answer' => '<p>Yes. The Nightclub\'s warehouse accumulates stock from your other businesses: Cargo/Hangar, Bunker, Cocaine, Meth, Weed, Cash, and Document Forgery. You need to <strong>own</strong> these businesses (they can be shut down and not producing), but the Nightclub technicians source goods independently.</p>' ),
                array( 'question' => 'What is the best Nightclub location?', 'answer' => '<p>The <strong>Del Perro</strong> location is the community favorite due to its central map position, easy access to highways, and proximity to popular CEO offices. The cheapest location (Elysian Island) works fine but is further from the action.</p>' ),
            ),
            'cross_cluster_slugs' => array( 'gta-online-money-guide' ),
            'content' => '<!-- wp:heading -->
<h2>Why the Nightclub Is the Best Business</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The Nightclub stands apart from every other business in GTA Online for one reason: <strong>it generates income without supply runs</strong>. While your MC businesses require buying or stealing supplies, and your Bunker needs regular resupplying, the Nightclub\'s warehouse technicians source goods automatically and independently. You literally make money while doing anything else in the game — or while AFK.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Setting Up Your Nightclub</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Purchase a Nightclub from the Maze Bank Foreclosures website. Prices range from $1.08M (Elysian Island) to $1.7M (West Vinewood). After purchase, complete the initial setup mission, hire your DJ, and begin assigning technicians to warehouse goods. The initial setup takes about 30 minutes.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Technician Assignments: What to Prioritize</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Assign technicians in this priority order for maximum profit: <strong>South American Imports</strong> (Cocaine - highest value per unit), <strong>Cargo and Shipments</strong> (CEO Cargo/Hangar), <strong>Pharmaceutical Research</strong> (Meth), <strong>Sporting Goods</strong> (Bunker), and <strong>Cash Creation</strong> (Counterfeit Cash). The top 5 goods generate the vast majority of income.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Essential Upgrades</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <strong>Equipment Upgrade</strong> ($1.4M) doubles production speed and is an absolute must-buy. <strong>Staff Upgrade</strong> ($475K) reduces the Nightclub\'s daily operating costs. <strong>Storage floors</strong> (up to 5 additional) increase maximum stock capacity. Skip cosmetic upgrades until you\'re profitable.</p>
<!-- /wp:paragraph -->',
        ),
    );

    foreach ( $hubs as $hub ) {
        $existing = get_page_by_path( $hub['slug'] );
        if ( $existing ) {
            $hub_ids[ $hub['slug'] ] = $existing->ID;
            continue;
        }

        $page_id = wp_insert_post( array(
            'post_title'    => $hub['title'],
            'post_name'     => $hub['slug'],
            'post_content'  => $hub['content'],
            'post_excerpt'  => $hub['excerpt'],
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'page_template' => 'page-hub.php',
        ) );

        if ( is_wp_error( $page_id ) || ! $page_id ) {
            continue;
        }

        update_post_meta( $page_id, '_wp_page_template', 'page-hub.php' );
        update_post_meta( $page_id, 'hub_cluster_name',    $hub['cluster_name'] );
        update_post_meta( $page_id, 'hub_sector',          $hub['sector'] );
        update_post_meta( $page_id, 'hub_primary_keyword',  $hub['primary_keyword'] );
        update_post_meta( $page_id, 'hub_quick_answer',     $hub['quick_answer'] );
        update_post_meta( $page_id, 'hub_hero_style',       $hub['hero_style'] );
        update_post_meta( $page_id, 'hub_layout_style',     $hub['layout_style'] );
        update_post_meta( $page_id, 'hub_key_facts',        $hub['key_facts'] );
        update_post_meta( $page_id, 'hub_faq_items',        $hub['faq_items'] );
        update_post_meta( $page_id, '_hub_cross_slugs',     $hub['cross_cluster_slugs'] );

        // Assign category.
        $cat_id = gtalobby_get_cat_id( $hub['sector'] );
        if ( $cat_id ) {
            wp_set_post_categories( $page_id, array( $cat_id ), true );
        }

        $hub_ids[ $hub['slug'] ] = $page_id;
    }

    // Resolve cross-cluster links for new hubs.
    gtalobby_resolve_hub_cross_links();

    return $hub_ids;
}

/* ==========================================================================
   SEED POSTS — Across all 7 post types and 9 categories
   ========================================================================== */

function gtalobby_seed_posts() {
    $post_ids = array();

    $posts = array(

        /* ===================== GTA 6 CATEGORY ===================== */

        array(
            'post_type'  => 'guide',
            'slug'       => 'gta-6-everything-we-know',
            'title'      => 'GTA 6 — Everything We Know So Far in 2026',
            'category'   => 'gta6',
            'excerpt'    => 'A comprehensive roundup of every confirmed detail about GTA 6 including setting, characters, gameplay, and release window.',
            'meta'       => array(
                'difficulty_rating'          => 'easy',
                'time_to_complete'           => '15 minutes read',
                'step_count'                 => 0,
                'gta6_confidence_level'      => 'confirmed',
                'confidence_level'           => 'confirmed',
                'source_type'                => 'official',
                'post_launch_update_needed'  => '1',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'hub_slug'   => 'gta-6-release-date',
            'content'    => '<!-- wp:paragraph -->
<p>Grand Theft Auto VI is the most anticipated game of the decade. After years of rumors, leaks, and speculation, Rockstar Games has officially confirmed that GTA 6 is set in the state of <strong>Leonida</strong> — a fictionalized Florida — with <strong>Vice City</strong> at its core. This guide compiles every confirmed fact and credible detail about the game.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Confirmed Setting and Location</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>GTA 6 is set in modern-day Leonida. The first trailer confirmed Vice City as the main urban center, with surrounding areas including swamplands (Grassrivers), rural towns, industrial ports, and a Florida Keys-inspired island chain. The map is expected to be significantly larger than GTA 5\'s San Andreas.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Dual Protagonists: Lucia and Jason</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For the first time in GTA history, the game features a female protagonist. <strong>Lucia</strong>, a Latin American woman, and <strong>Jason</strong>, her partner in crime, form a Bonnie-and-Clyde-inspired duo. The trailer showed Lucia in prison, suggesting a redemption or crime-escalation arc. Players are expected to switch between both characters similar to GTA 5.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Release Window and Platforms</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Rockstar confirmed GTA 6 for <strong>Fall 2025</strong> on PS5 and Xbox Series X|S. A PC release has not been announced but historically follows 12-18 months after console launch. No last-gen (PS4/Xbox One) version is planned, allowing Rockstar to fully leverage current-gen hardware capabilities.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Gameplay and Technology</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Based on trailer analysis and leaks, GTA 6 features the most advanced version of the RAGE engine ever built. Improvements include photorealistic lighting, dynamic weather systems (including hurricanes), vastly improved NPC AI with context-aware behavior, a social media system integrated into gameplay, and significantly more enterable interiors than GTA 5.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'answer',
            'slug'       => 'will-gta-6-be-on-pc',
            'title'      => 'Will GTA 6 Be on PC? Everything We Know About the PC Release',
            'category'   => 'gta6',
            'excerpt'    => 'Will GTA 6 come to PC? Based on Rockstar\'s track record, here\'s what we know about the PC release timeline.',
            'meta'       => array(
                'short_answer'               => 'Yes, GTA 6 will almost certainly come to PC, but not at launch. Based on Rockstar\'s pattern with GTA 5 (16-month delay) and RDR2 (13-month delay), expect a PC release in late 2026 or early 2027. The Fall 2025 launch is confirmed for PS5 and Xbox Series X|S only.',
                'gta6_confidence_level'      => 'likely',
                'confidence_level'           => 'likely',
                'source_type'                => 'press',
                'post_launch_update_needed'  => '1',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'pc' ) ),
            'hub_slug'   => 'gta-6-release-date',
            'content'    => '<!-- wp:paragraph -->
<p>The question every PC gamer asks: will GTA 6 be available on PC? The short answer is almost certainly yes — but not at the same time as consoles. Rockstar Games has a consistent history of releasing their major titles on consoles first, followed by a PC port 12-18 months later.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Rockstar\'s Console-First History</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>GTA 5 launched on PS3/Xbox 360 in September 2013. The PC version didn\'t arrive until January 2015 — a 16-month gap. Red Dead Redemption 2 followed a similar pattern: October 2018 console launch, November 2019 PC release (13 months). This staggered approach is deliberate, not accidental.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Why the Delay?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The console-first strategy serves two business purposes: it maximizes double-dip sales (players buy it on console at launch, then again on PC), and it gives the PC team time to optimize for the wide range of hardware configurations. The GTA 5 PC port was excellent quality, and Rockstar will want to maintain that standard.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Expected PC Release Timeline</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>With a Fall 2025 console launch, applying Rockstar\'s 12-18 month pattern suggests a <strong>PC release between Fall 2026 and Spring 2027</strong>. Rockstar has not confirmed or denied any PC plans. We\'ll update this page the moment any official announcement is made.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'profile',
            'slug'       => 'lucia-gta-6-character-profile',
            'title'      => 'Lucia — GTA 6 Protagonist Character Profile',
            'category'   => 'gta6',
            'excerpt'    => 'Everything known about Lucia, GTA 6\'s groundbreaking female protagonist — background, personality, and confirmed details from trailers and leaks.',
            'meta'       => array(
                'entity_type'                => 'character',
                'first_appearance'           => 'GTA 6 (2025)',
                'voice_actor'                => 'TBA',
                'gta6_confidence_level'      => 'confirmed',
                'confidence_level'           => 'confirmed',
                'source_type'                => 'trailer',
                'post_launch_update_needed'  => '1',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'hub_slug'   => 'gta-6-characters',
            'content'    => '<!-- wp:paragraph -->
<p><strong>Lucia</strong> is one of two playable protagonists in Grand Theft Auto VI and the first female lead in the mainline GTA series. Confirmed through the official Trailer 1, Lucia is a Latin American woman with a criminal background who partners with Jason in the state of Leonida.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Background and Origin</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trailer 1 opens with Lucia in a prison setting, shown through a visitation glass partition. This confirms she has a criminal history prior to the game\'s main story. Leaked footage suggests she was incarcerated for robbery. Her accent and cultural markers indicate a Latin American heritage, making her one of the most diverse protagonists in AAA gaming.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Personality and Role</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>From trailer footage and leaks, Lucia appears to be the more grounded and strategic half of the Lucia-Jason partnership. While Jason tends toward impulsive action, Lucia is shown making calculated decisions. Their dynamic echoes classic crime duos where contrasting personalities create both strength and conflict.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Cultural Significance</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lucia represents a landmark moment for the GTA franchise. After decades of exclusively male protagonists — from Claude to Tommy Vercetti to CJ to Niko to Michael, Franklin, and Trevor — GTA 6 finally tells a story from a woman\'s perspective. Rockstar\'s Jason Schreier reports and other inside sources suggest this wasn\'t a superficial decision but a fundamental reimagining of what a GTA story can be.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'ranking',
            'slug'       => 'most-anticipated-gta-6-features',
            'title'      => 'Top 10 Most Anticipated GTA 6 Features Based on Leaks and Trailers',
            'category'   => 'gta6',
            'excerpt'    => 'Ranking the 10 most anticipated GTA 6 features from improved AI to the new wanted system, based on confirmed leaks and trailer analysis.',
            'meta'       => array(
                'ranking_criteria'           => 'Based on community excitement, confirmed evidence, and potential gameplay impact.',
                'total_items'                => 10,
                'gta6_confidence_level'      => 'likely',
                'confidence_level'           => 'likely',
                'source_type'                => 'community',
                'post_launch_update_needed'  => '1',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'hub_slug'   => 'gta-6-release-date',
            'content'    => '<!-- wp:paragraph -->
<p>With GTA 6 approaching its Fall 2025 launch, the community has been analyzing every frame of trailer footage and every credible leak to piece together what the game will offer. Here are the 10 most anticipated features, ranked by community excitement and confirmed evidence.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>1. The Expanded Vice City and Leonida Map</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A massive, detailed open world set in fictionalized Florida tops every fan\'s wishlist. The diverse biomes — beaches, swamps, cities, keys — promise unprecedented variety in a single GTA map.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>2. Dual Protagonist System</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Playing as both Lucia and Jason, with a Bonnie-and-Clyde dynamic, offers fresh storytelling possibilities that GTA 5\'s three separate protagonists couldn\'t achieve.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>3. Advanced NPC AI and Routines</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Leaked footage showed NPCs with dramatically improved behavior — context-aware reactions, daily routines, and more realistic responses to player actions. This could make Leonida feel truly alive.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>4. Dynamic Weather Including Hurricanes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Florida without hurricanes wouldn\'t be Florida. Leaks suggest GTA 6 will feature full hurricane events that dynamically alter the game world — flooding streets, damaging structures, and creating unique gameplay moments.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>5. Social Media Integration</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trailer 1 prominently featured in-game social media posts, suggesting a satirical social media system woven into gameplay. This could affect wanted levels, missions, and the game\'s narrative.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== CHEATS CATEGORY ===================== */

        array(
            'post_type'  => 'guide',
            'slug'       => 'gta-5-cheats-ps5-ps4',
            'title'      => 'All GTA 5 Cheats for PS5 and PS4 — Button Combos and Phone Numbers',
            'category'   => 'cheats',
            'excerpt'    => 'Every GTA 5 cheat code for PlayStation 5 and PS4 with button combinations, phone numbers, and usage tips.',
            'meta'       => array( 'difficulty_rating' => 'easy', 'time_to_complete' => '5 minutes', 'step_count' => 0 ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'ps5', 'ps4' ), 'cheat_type' => array( 'all-cheats' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'   => 'gta-5-cheats',
            'content'    => '<!-- wp:paragraph -->
<p>GTA 5 on PlayStation features over 35 cheat codes entered via button combinations or the in-game phone dialer. This guide lists every cheat with its PS5/PS4 input sequence.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Invincibility (God Mode)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Button combo:</strong> Right, X, Right, Left, Right, R1, Right, Left, X, Triangle. Grants 5 minutes of invincibility. Must be re-entered after it expires. <strong>Phone:</strong> 1-999-724-654-5537 (1-999-PAINKILLER).</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Weapons and Ammo</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Button combo:</strong> Triangle, R2, Left, L1, X, Right, Triangle, Down, Square, L1, L1, L1. Gives all weapons with full ammo. <strong>Phone:</strong> 1-999-866-587 (1-999-TOOLUP).</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Vehicle Spawn Cheats</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Spawn a <strong>Buzzard helicopter</strong>: O, O, L1, O, O, O, L1, L2, R1, Triangle, O, Triangle. Spawn a <strong>Comet</strong>: R1, O, R2, Right, L1, L2, X, X, Square, R1. These work anywhere with enough flat ground for the vehicle to appear.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Fun Cheats</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Moon gravity:</strong> Left, Left, L1, R1, L1, Right, Left, L1, Left. Makes vehicles float after jumps. <strong>Explosive bullets:</strong> Right, Square, X, Left, R1, R2, Left, Right, Right, L1, L1, L1. <strong>Flaming bullets:</strong> L1, R1, Square, R1, Left, R2, R1, Left, Square, Right, L1, L1.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'answer',
            'slug'       => 'do-cheats-disable-trophies-gta-5',
            'title'      => 'Do Cheats Disable Trophies in GTA 5?',
            'category'   => 'cheats',
            'excerpt'    => 'Quick answer: Yes, using cheat codes in GTA 5 disables trophies and achievements for the current session.',
            'meta'       => array(
                'short_answer' => 'Yes, activating any cheat code in GTA 5 immediately disables trophies and achievements for your current play session. To re-enable them, you need to load a save that was created before cheats were activated. Cheats do not permanently affect your save file — they only apply to the current session.',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'all-platforms' ), 'cheat_type' => array( 'all-cheats' ) ),
            'hub_slug'   => 'gta-5-cheats',
            'content'    => '<!-- wp:paragraph -->
<p>One of the most common questions about GTA 5 cheats is whether they affect your ability to earn trophies and achievements. The answer is straightforward but has important nuances.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>How Cheats Affect Trophies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The moment you activate any cheat code during a play session, the game flags that session as "cheated." All trophies and achievements are disabled until you reload a clean save. This applies to all platforms — PS5, PS4, Xbox, and PC. The flag is session-based, not save-based, so your save file itself is not permanently marked.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>How to Re-Enable Trophies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Simply save your game before entering cheats, then reload that save when you want to earn trophies again. Alternatively, restart the game entirely. The cheat flag resets on every fresh game load. This is why experienced players always quick-save before a cheat session.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== GTA ONLINE CATEGORY ===================== */

        array(
            'post_type'  => 'guide',
            'slug'       => 'gta-online-cayo-perico-solo-guide',
            'title'      => 'GTA Online Cayo Perico Heist Solo Guide — Setup to Finale in Under 1 Hour',
            'category'   => 'online',
            'excerpt'    => 'Step-by-step guide to completing the Cayo Perico Heist solo in under one hour, from Intel to Finale.',
            'meta'       => array( 'difficulty_rating' => 'medium', 'time_to_complete' => '45-60 minutes', 'step_count' => 8 ),
            'taxonomies' => array( 'game_title' => array( 'gta-online' ), 'platform' => array( 'all-platforms' ), 'game_mode' => array( 'gta-online-mode' ) ),
            'hub_slug'   => 'gta-online-money-guide',
            'content'    => '<!-- wp:paragraph -->
<p>The Cayo Perico Heist is the most profitable solo activity in GTA Online. This guide walks you through the optimal route to complete it in under an hour for maximum payout.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 1: Start the Intel Mission</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Go to your Kosatka submarine and start the heist from the planning board. Fly to Cayo Perico for the mandatory scoping mission. You must photograph the primary target in El Rubio\'s compound. Optionally, scope secondary targets (cocaine is the most valuable at $220K per stack) and entry points.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 2: Choose Your Approach</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <strong>Kosatka approach</strong> is the fastest for solo players. Enter via the drainage tunnel (requires scoping it first), which puts you directly inside the compound near the primary target. For the weapon loadout, choose the <strong>Aggressor</strong> or <strong>Conspirator</strong> for suppressors.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 3: Prep Missions (Skip What You Can)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Required preps: Weapon loadout, Equipment (cutting torch or demolition charges for drainage tunnel). The Kosatka approach lets you skip the most tedious preps. Total prep time: 20-30 minutes for experienced players.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 4: The Finale</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Enter through drainage tunnel → swim to compound → eliminate 2-3 guards silently → access the vault → grab primary target → fill bags with secondary loot on the way out → exit compound → swim to the left and escape the island. Elite Challenge completion (under 15 minutes) gives a $100K bonus.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'recap',
            'slug'       => 'gta-online-weekly-update-march-2026',
            'title'      => 'GTA Online Weekly Update — March 6-13, 2026',
            'category'   => 'online',
            'excerpt'    => 'This week\'s GTA Online bonuses, discounts, and new content for March 6-13, 2026.',
            'meta'       => array( 'week_date_range' => 'March 6-13, 2026', 'podium_vehicle' => 'Grotti Turismo R', 'new_content' => 'New Acid Lab contract missions added. St. Patrick\'s Day themed clothing available at select stores.' ),
            'taxonomies' => array( 'game_title' => array( 'gta-online' ), 'platform' => array( 'all-platforms' ), 'game_mode' => array( 'gta-online-mode' ) ),
            'hub_slug'   => 'gta-online-money-guide',
            'content'    => '<!-- wp:paragraph -->
<p>Here\'s everything new in GTA Online for the week of March 6-13, 2026. This week brings double money on several popular activities and significant discounts on businesses.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Double and Triple Money Activities</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>3x GTA$ & RP:</strong> Acid Lab sell missions. <strong>2x GTA$ & RP:</strong> Agency Security Contracts, Bunker sell missions, and Survival modes. These bonuses make it an excellent week for grinding passive businesses.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Discounts This Week</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>40% off:</strong> All Nightclub locations and upgrades. <strong>30% off:</strong> Kosatka submarine and upgrades. <strong>25% off:</strong> Select supercars including the Ocelot Virtue and Grotti Itali RSX. If you don\'t own a Nightclub yet, this is the week to buy one.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Podium Vehicle</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This week\'s Lucky Wheel podium vehicle is the <strong>Grotti Turismo R</strong> — a solid super car worth $500K. Spin the Lucky Wheel at The Diamond Casino & Resort for a chance to win it for free.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== MODS CATEGORY ===================== */

        array(
            'post_type'  => 'mod',
            'slug'       => 'naturalvision-evolved-gta-5',
            'title'      => 'NaturalVision Evolved — Photorealistic Graphics Overhaul for GTA 5',
            'category'   => 'mods',
            'excerpt'    => 'NaturalVision Evolved transforms GTA 5 into a photorealistic experience with overhauled weather, lighting, and textures.',
            'meta'       => array(
                'download_url'   => '#',
                'mod_version'    => 'v2.4',
                'file_size'      => '1.2 GB',
                'author_name'    => 'Razed',
                'requirements'   => 'OpenIV, Script Hook V, QuantV (recommended)',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'pc' ), 'mod_category' => array( 'graphics-visual' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'   => 'best-gta-5-mods',
            'content'    => '<!-- wp:paragraph -->
<p><strong>NaturalVision Evolved</strong> is the definitive graphics mod for GTA 5. Created by Razed, this total visual overhaul replaces the game\'s weather system, time-of-day lighting, color correction, tonemapping, and environmental textures to produce a photorealistic Los Santos.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>What NaturalVision Evolved Changes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The mod overhauls every aspect of GTA 5\'s visual presentation: realistic sun positions, volumetric clouds, ray-traced-quality reflections on wet surfaces, natural color grading that eliminates GTA 5\'s yellowish filter, and over 400 custom weather variations. The result is a game that looks like it could have been released today.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Installation</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Install OpenIV and set up a mods folder first. Extract NaturalVision Evolved files into your GTA 5 directory following the included readme. The mod is compatible with most vehicle and map mods. For best results, pair it with QuantV for additional shader enhancements and LA Roads for high-resolution road textures.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Performance Impact</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Expect a 10-20% FPS reduction compared to vanilla GTA 5. A GTX 1070 / RX 5700 or better is recommended for 1080p 60fps. At 4K, you\'ll want an RTX 3070 or equivalent. The mod author provides a performance preset for lower-end systems.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'mod',
            'slug'       => 'lspdfr-police-mod-gta-5',
            'title'      => 'LSPDFR — Los Santos Police Department First Response Mod',
            'category'   => 'mods',
            'excerpt'    => 'LSPDFR transforms GTA 5 into a police roleplay simulator with patrol mechanics, traffic stops, and dispatch calls.',
            'meta'       => array(
                'download_url'   => '#',
                'mod_version'    => 'v0.4.9',
                'file_size'      => '85 MB',
                'author_name'    => 'G17 Media',
                'requirements'   => 'RAGE Plugin Hook, GTA 5 (latest version)',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'pc' ), 'mod_category' => array( 'lspdfr-police' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'   => 'best-gta-5-mods',
            'content'    => '<!-- wp:paragraph -->
<p><strong>LSPDFR</strong> (Los Santos Police Department First Response) is the most popular gameplay mod for GTA 5. It transforms the game from a criminal sandbox into a police roleplay simulator where you patrol the streets of Los Santos as a law enforcement officer.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Core Gameplay</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>LSPDFR gives you access to police vehicles, uniforms, and equipment. You\'ll respond to dispatch calls (robberies, pursuits, accidents), conduct traffic stops with realistic procedures, arrest suspects, and manage a patrol area. The mod features a callout system with dozens of scenario types.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Plugin Ecosystem</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What makes LSPDFR truly special is its massive plugin ecosystem. <strong>Stop The Ped</strong> adds detailed pedestrian interactions. <strong>Ultimate Backup</strong> lets you call for AI police support. <strong>Compulite CAD</strong> simulates a police computer. There are hundreds of community plugins that expand the experience into one of the deepest roleplaying systems ever built for a game.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== CARS CATEGORY ===================== */

        array(
            'post_type'  => 'profile',
            'slug'       => 'ocelot-virtue-gta-online',
            'title'      => 'Ocelot Virtue — GTA Online\'s Fastest Car by Top Speed',
            'category'   => 'cars',
            'excerpt'    => 'Complete profile of the Ocelot Virtue including performance stats, price, customization, and racing analysis.',
            'meta'       => array(
                'entity_type'       => 'vehicle',
                'first_appearance'  => 'GTA Online: San Andreas Mercenaries (2023)',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars' ), 'game_mode' => array( 'gta-online-mode' ) ),
            'hub_slug'   => 'gta-5-best-cars',
            'content'    => '<!-- wp:paragraph -->
<p>The <strong>Ocelot Virtue</strong> holds the crown as the fastest car in GTA Online by top speed, clocking in at an impressive 141.25 mph. Introduced in the San Andreas Mercenaries update, this electric hypercar is based on the real-world Rimac Nevera and has quickly become a favorite for speed enthusiasts.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Performance Specifications</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Top Speed:</strong> 141.25 mph (fastest in game). <strong>Lap Time:</strong> 0:58.8 (competitive but not the best). <strong>Acceleration:</strong> Excellent electric torque off the line. <strong>Handling:</strong> Slightly tail-happy at high speed but very controllable. <strong>Braking:</strong> Above average. The Virtue excels on tracks with long straights but loses to better-handling supers on technical circuits.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Price and Availability</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The Ocelot Virtue costs <strong>$3,200,000</strong> from Legendary Motorsport. Trade price is not available. Customization options include HSW upgrades (PS5/Xbox Series X only) for even higher performance, as well as extensive body kits, liveries, and wheel options at Los Santos Customs.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'ranking',
            'slug'       => 'top-10-fastest-super-cars-gta-online',
            'title'      => 'Top 10 Fastest Super Cars in GTA Online — Lap Time Rankings 2026',
            'category'   => 'cars',
            'excerpt'    => 'The definitive ranking of the 10 fastest super cars in GTA Online by lap time for competitive racing.',
            'meta'       => array( 'ranking_criteria' => 'Lap times tested on a standardized circuit with stock vehicle configuration.', 'total_items' => 10 ),
            'taxonomies' => array( 'game_title' => array( 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars' ), 'game_mode' => array( 'online-racing' ) ),
            'hub_slug'   => 'gta-5-best-cars',
            'content'    => '<!-- wp:paragraph -->
<p>Super cars are the pinnacle of GTA Online racing. This ranking covers the 10 fastest supers by lap time on our standardized test track, giving you the data you need to make the right purchase for competitive racing.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>1. Progen Emerus — Lap Time: 0:57.1</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The Emerus remains the king of super car racing. Its exceptional handling, consistent cornering grip, and competitive top speed make it the most well-rounded super car in the game. At $2.75M, it\'s also reasonable value compared to flashier alternatives.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>2. Grotti Itali RSX — Lap Time: 0:57.6</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The Itali RSX offers slightly better top speed than the Emerus but marginally worse handling. On tracks with long straights, it can beat the Emerus. Price: $3.46M.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>3. Ocelot Virtue — Lap Time: 0:58.8</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Despite having the highest top speed in the game, the Virtue\'s heavier weight and electric power delivery put it third in lap times. Still an excellent racer and the undisputed drag strip champion. Price: $3.2M.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== FASTEST CARS CATEGORY ===================== */

        array(
            'post_type'  => 'ranking',
            'slug'       => 'fastest-cars-in-gta-5-ranked',
            'title'      => 'The Fastest Cars in GTA 5 Ranked by Top Speed and Lap Time',
            'category'   => 'cars',
            'excerpt'    => 'The definitive hub ranking for the fastest cars in GTA 5 (stock + HSW) with key performance stats and recommendations.',
            'meta'       => array( 'ranking_criteria' => 'Top speed (primary) + lap time (secondary) + acceleration (tertiary)', 'total_items' => 20 ),
            'taxonomies' => array( 'game_title' => array( 'gta-5', 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars', 'sports' ), 'game_mode' => array( 'story-mode', 'gta-online-mode' ), 'difficulty' => array( 'beginner' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>Our flagship ranking for the fastest GTA 5 cars. Includes stock and HSW tiers, plus quick calls on which rides to use for drag, circuit, and open-world speed. The Ocelot Pariah leads stock, while the S80RR leads HSW.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'answer',
            'slug'       => 'what-is-the-fastest-car-in-gta-5',
            'title'      => 'What Is the Fastest Car in GTA 5?',
            'category'   => 'cars',
            'excerpt'    => 'Quick answer for the fastest GTA 5 car with stock and HSW distinctions.',
            'meta'       => array( 'short_answer' => 'The fastest car in GTA 5 stock is the Ocelot Pariah (136.0 mph). In GTA Online with HSW, the Pfister S80RR can reach 151.0 mph.' ),
            'taxonomies' => array( 'game_title' => array( 'gta-5', 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars' ), 'game_mode' => array( 'story-mode', 'gta-online-mode' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>The current fastest car in GTA 5 is the Ocelot Pariah in stock mode (136.0 mph). If you run HSW in Online, the S80RR and Ocelot Virtue move to the top ranks with 150+ mph capabilities.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'guide',
            'slug'       => 'how-to-make-any-car-faster-gta-5',
            'title'      => 'How to Make Any Car Faster in GTA 5 — Upgrade and Tuning Guide',
            'category'   => 'cars',
            'excerpt'    => 'Step-by-step upgrade guide for improving car speed in Story Mode and Online with HSW and tuning.',
            'meta'       => array( 'difficulty_rating' => 'beginner', 'time_to_complete' => '15-30 minutes', 'step_count' => 8 ),
            'taxonomies' => array( 'game_title' => array( 'gta-5', 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars', 'sports', 'muscle' ), 'game_mode' => array( 'story-mode', 'gta-online-mode' ), 'business_type' => array( 'auto-shop' ), 'content_tags' => array( 'HSW', 'performance', 'tuning' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>Learn the absolute best upgrade path for speed: engine/transmission/turbo in Story Mode and HSW conversions in Online. Includes top drag/loadout recipes and recommended tuning settings.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'profile',
            'slug'       => 'ocelot-pariah-gta-5-profile',
            'title'      => 'Ocelot Pariah — Complete Speed Stats, Location, and Review',
            'category'   => 'cars',
            'excerpt'    => 'Full profile of the Ocelot Pariah, GTA 5’s stock fastest car with stats, price, and tuning advice.',
            'meta'       => array( 'entity_type' => 'vehicle', 'first_appearance' => 'GTA Online (Doomsday Heist, 2017)' ),
            'taxonomies' => array( 'game_title' => array( 'gta-5', 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'sports' ), 'game_mode' => array( 'story-mode', 'gta-online-mode' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>The Ocelot Pariah is the stock fastest car in GTA 5. It offers great handling, good acceleration, and is affordable for competitive racing in both story and online modes.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'database',
            'slug'       => 'gta-5-car-speed-database',
            'title'      => 'GTA 5 Complete Car Speed Database — Every Vehicle Ranked',
            'category'   => 'cars',
            'excerpt'    => 'Comprehensive sortable speed database for GTA 5 vehicles with top speed, lap times, price, and class filters.',
            'meta'       => array( 'data_source' => 'Broughy1322 + GTA Wiki + testing', 'last_updated' => 'March 2026' ),
            'taxonomies' => array( 'game_title' => array( 'gta-5', 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'all' ), 'game_mode' => array( 'story-mode', 'gta-online-mode' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>Database table includes 100+ vehicles sorted by top speed, lap time, and acceleration. Use the filters to find the best car for your class and race type.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'mod',
            'slug'       => 'real-top-speed-mod-gta-5',
            'title'      => 'Real Top Speed Mod for GTA 5 — Unlock True Vehicle Speeds',
            'category'   => 'cars',
            'excerpt'    => 'Mod listing for the real top speed mod that removes speed caps and enables authentic performance data.',
            'meta'       => array( 'download_url' => '#', 'mod_version' => '2.1', 'file_size' => '45 KB', 'author_name' => 'ikt', 'requirements' => 'Script Hook V, OpenIV' ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'pc' ), 'mod_category' => array( 'vehicle-mods', 'script-mods' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>This mod unlocks true max speeds for GTA 5 vehicles and is essential for realistic performance testing beyond the vanilla speed cap.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'recap',
            'slug'       => 'gta-online-weekly-march-13-19-2026',
            'title'      => 'GTA Online This Week — Podium Car, Double Money & Speed Discounts (Mar 13–19, 2026)',
            'category'   => 'cars',
            'excerpt'    => 'Weekly recap with podium car focus on the Ocelot Pariah and car discounts for March 13–19, 2026.',
            'meta'       => array( 'week_date_range' => 'March 13-19, 2026', 'podium_vehicle' => 'Ocelot Pariah', 'new_content' => 'Speed discounts and racing bonuses' ),
            'taxonomies' => array( 'game_title' => array( 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars' ), 'game_mode' => array( 'gta-online-mode' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>This week’s GTA Online update highlights the Ocelot Pariah as the Lucky Wheel podium car plus new speed-focused discounts on supercars.</p>
<!-- /wp:paragraph -->',
        ),

        array(
            'post_type'  => 'ranking',
            'slug'       => 'fastest-cars-gta-5-no-hsw',
            'title'      => 'Fastest Cars in GTA 5 Without HSW — Top 10 Stock Speed Ranking',
            'category'   => 'cars',
            'excerpt'    => 'Top 10 fastest cars in GTA 5 without HSW upgrades, focused on ready-to-run stock performance.',
            'meta'       => array( 'ranking_criteria' => 'Top speed (stock, no HSW)', 'total_items' => 10 ),
            'taxonomies' => array( 'game_title' => array( 'gta-5', 'gta-online' ), 'platform' => array( 'all-platforms' ), 'vehicle_class' => array( 'supercars', 'sports' ), 'game_mode' => array( 'story-mode', 'gta-online-mode' ), 'difficulty' => array( 'beginner' ) ),
            'hub_slug'   => 'fastest-cars-gta-5',
            'content'    => '<!-- wp:paragraph -->
<p>Stock speed ranking for players who want the fastest cars without requiring HSW tuning. Ocelot Pariah leads, followed by Pfister 811 and Benefactor Krieger.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== CHARACTERS CATEGORY ===================== */

        array(
            'post_type'  => 'profile',
            'slug'       => 'trevor-philips-character-profile',
            'title'      => 'Trevor Philips — GTA 5 Character Profile and Story Analysis',
            'category'   => 'characters',
            'excerpt'    => 'Complete character profile of Trevor Philips from GTA 5 — personality, backstory, voice actor, and role in the story.',
            'meta'       => array(
                'entity_type'       => 'character',
                'first_appearance'  => 'GTA 5 (2013)',
                'voice_actor'       => 'Steven Ogg',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'all-platforms' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'   => 'gta-6-characters',
            'content'    => '<!-- wp:paragraph -->
<p><strong>Trevor Philips</strong> is one of three playable protagonists in Grand Theft Auto V, voiced by Steven Ogg. He is perhaps the most memorable and controversial character in GTA history — a volatile, unpredictable force of nature living in the desert town of Sandy Shores.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Background</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trevor is a former military pilot who was discharged for psychological issues. He was Michael De Santa\'s criminal partner in their bank-robbing days until a heist in Ludendorff went wrong in 2004. Believing Michael was dead, Trevor retreated to Blaine County where he built a methamphetamine operation under Trevor Philips Industries (TPI).</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Personality</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trevor is GTA at its most unhinged. He\'s prone to explosive rage, has virtually no impulse control, and views violence as a first resort. Yet beneath the chaos lies a surprisingly loyal and emotionally vulnerable person. His relationship with Michael — built on betrayal, resentment, and genuine affection — is the emotional core of GTA 5\'s story.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Steven Ogg\'s Performance</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Steven Ogg\'s motion-capture and voice performance as Trevor is widely regarded as one of the best in gaming history. Ogg brought physicality, intensity, and unexpected humor to every scene. His career took off after GTA 5, with roles in The Walking Dead, Westworld, and Better Call Saul.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== MAP & LOCATIONS CATEGORY ===================== */

        array(
            'post_type'  => 'guide',
            'slug'       => 'gta-5-hidden-locations-secrets',
            'title'      => 'GTA 5 Hidden Locations and Secrets — 25 Places Most Players Never Find',
            'category'   => 'locations',
            'excerpt'    => '25 hidden locations and secret spots in GTA 5 that most players miss, from underwater UFOs to hidden caves.',
            'meta'       => array( 'difficulty_rating' => 'medium', 'time_to_complete' => '3-4 hours (all locations)', 'step_count' => 25 ),
            'taxonomies' => array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'all-platforms' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'   => 'gta-5-map-locations',
            'content'    => '<!-- wp:paragraph -->
<p>GTA 5\'s map is packed with secrets that even veteran players might have missed. From sunken UFOs to hidden caves and developer easter eggs, this guide covers 25 of the most interesting hidden locations in Los Santos and Blaine County.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>1. Underwater UFO (North of Procopio Beach)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Dive to the ocean floor north of Procopio Beach to discover a crashed UFO sitting on the seabed. It\'s partially buried in sand and covered in barnacles, suggesting it\'s been there for a very long time. You\'ll need a scuba suit or submarine to reach it.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>2. Mount Gordo Ghost</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Visit the peak of Mount Gordo between 11 PM and midnight to witness the ghost of Jolene Cranley-Evans floating above the rocks. The word "JOCK" is written in blood on the stones below — referencing her husband Jock Cranley who pushed her off the cliff. This is one of GTA 5\'s most chilling easter eggs.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>3. Altruist Camp</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Hidden in the Chiliad Mountain State Wilderness, the Altruist Camp is home to a cannibalistic cult. Trevor can deliver hitchhikers here for cash rewards. After four deliveries, a shootout triggers where you can earn a $100K briefcase and several weapon pickups.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>4. Abandoned Mine Shaft</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In the hills of Great Chaparral, there\'s a boarded-up mine shaft entrance. While you can\'t enter it normally, it\'s part of the Murder Mystery collectible quest and connects to the Infinite 8 Killer storyline that spans multiple collectible locations across the map.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== MONEY CATEGORY ===================== */

        array(
            'post_type'  => 'guide',
            'slug'       => 'gta-online-beginner-money-guide',
            'title'      => 'GTA Online Beginner Money Guide — From $0 to Your First Million',
            'category'   => 'money',
            'excerpt'    => 'Complete beginner guide to making your first million in GTA Online without spending real money.',
            'meta'       => array( 'difficulty_rating' => 'easy', 'time_to_complete' => '4-6 hours', 'step_count' => 6 ),
            'taxonomies' => array( 'game_title' => array( 'gta-online' ), 'platform' => array( 'all-platforms' ), 'game_mode' => array( 'gta-online-mode' ), 'difficulty' => array( 'beginner' ) ),
            'hub_slug'   => 'gta-online-nightclub-guide',
            'content'    => '<!-- wp:paragraph -->
<p>Starting GTA Online with no money can feel overwhelming. This guide gives you a clear, step-by-step path from $0 to your first million — and then shows you how to invest that million wisely.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 1: Complete the Tutorial and Collect Free Money</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Complete the GTA Online introduction tutorial to earn your first ~$50K. Check the PS Store or Xbox Store for any active GTA Online starter bonuses (Rockstar frequently gives free $1M+ to new players). Link your Social Club account for additional bonuses.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 2: VIP Work (Free Money Machine)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Once you have $50K, register as a VIP from the Interaction Menu → SecuroServ → Register as VIP. This is free (temporarily) and unlocks <strong>VIP Work</strong>: Headhunter ($20K per completion, 5 minutes) and Sightseer ($25K, 10 minutes). Chain these with no cooldown and earn $150K-$200K per hour with zero investment.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 3: Save for the Kosatka ($2.2M)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your first major purchase should be the <strong>Kosatka submarine</strong> for $2.2M. This unlocks the Cayo Perico Heist — the single best money maker in the game at $1.2-1.9M per completion. It takes roughly 10-15 hours of VIP Work grinding to afford it. It\'s worth every minute.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Step 4: Your First Cayo Perico Heist</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>With the Kosatka unlocked, complete your first Cayo Perico run. The first time takes longer (60-90 minutes including learning the layout), but subsequent runs take 45 minutes or less. After 2-3 runs, you\'ll have crossed the $1M threshold and be on your way to real wealth.</p>
<!-- /wp:paragraph -->',
        ),

        /* ===================== NEWS CATEGORY ===================== */

        array(
            'post_type'  => 'guide',
            'slug'       => 'gta-6-trailer-2-analysis',
            'title'      => 'GTA 6 Trailer 2 Analysis — Every Detail, Easter Egg, and Hidden Clue',
            'category'   => 'news',
            'excerpt'    => 'Frame-by-frame analysis of GTA 6 Trailer 2 covering every confirmed detail, hidden easter egg, and gameplay clue.',
            'meta'       => array(
                'difficulty_rating'     => 'easy',
                'time_to_complete'      => '10 minutes read',
            ),
            'taxonomies' => array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'hub_slug'   => 'gta-6-release-date',
            'content'    => '<!-- wp:paragraph -->
<p>Rockstar\'s second official trailer for GTA 6 delivered a deeper look at the game\'s world, characters, and gameplay mechanics. This analysis breaks down every significant frame, confirms new details, and highlights what the trailer tells us about the final game.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>New Gameplay Mechanics Revealed</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Trailer 2 showed several gameplay systems not seen in previous GTA titles. A robbery planning screen appeared briefly, suggesting heist-like mission planning is more integrated into the main game. Vehicle customization appears more detailed than GTA 5, with real-time visual changes shown. A new wanted system was hinted at with more realistic police behavior.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>New Locations Confirmed</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Several new Vice City districts were visible that weren\'t in Trailer 1: a university campus area, a theme park resembling Walt Disney World, and what appears to be a horse racing track. The trailer also showed more of the rural interior, including farming communities and what looks like sugar cane fields.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Character Deep Dive</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>More of Lucia and Jason\'s relationship was shown — domestic scenes, planning sessions, heated arguments, and tender moments. Supporting characters were more prominently featured, including what appears to be a mentor/boss figure and a rival criminal organization. The narrative seems to follow their rise from small-time criminals to major players.</p>
<!-- /wp:paragraph -->',
        ),

    );

    foreach ( $posts as $post_data ) {
        // Skip if post with this slug already exists.
        $existing = get_page_by_path( $post_data['slug'], OBJECT, $post_data['post_type'] );
        if ( $existing ) {
            $post_ids[ $post_data['slug'] ] = $existing->ID;
            continue;
        }

        $insert_args = array(
            'post_title'   => $post_data['title'],
            'post_name'    => $post_data['slug'],
            'post_content' => $post_data['content'],
            'post_excerpt' => $post_data['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => $post_data['post_type'],
            'post_author'  => 1,
        );

        $post_id = wp_insert_post( $insert_args );

        if ( is_wp_error( $post_id ) || ! $post_id ) {
            continue;
        }

        // Assign category.
        $cat_id = gtalobby_get_cat_id( $post_data['category'] );
        if ( $cat_id ) {
            wp_set_post_categories( $post_id, array( $cat_id ), true );
        }

        // Set custom meta fields.
        if ( ! empty( $post_data['meta'] ) ) {
            foreach ( $post_data['meta'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }

        // Assign taxonomy terms.
        if ( ! empty( $post_data['taxonomies'] ) ) {
            foreach ( $post_data['taxonomies'] as $taxonomy => $term_slugs ) {
                $term_ids = array();
                foreach ( $term_slugs as $slug ) {
                    $tid = gtalobby_get_term_id( $slug, $taxonomy );
                    if ( $tid ) {
                        $term_ids[] = (int) $tid;
                    }
                }
                if ( ! empty( $term_ids ) ) {
                    wp_set_object_terms( $post_id, $term_ids, $taxonomy );
                }
            }
        }

        $post_ids[ $post_data['slug'] ] = $post_id;
    }

    return $post_ids;
}

/* ==========================================================================
   WIRE UP HUB ↔ CHILD RELATIONSHIPS
   ========================================================================== */

function gtalobby_wire_hub_children( $hub_ids, $post_ids ) {

    // Map: hub slug → array of child post slugs.
    $hub_children = array(
        'gta-6-map' => array(
            'gta-6-everything-we-know',
            'lucia-gta-6-character-profile',
        ),
        'gta-6-release-date' => array(
            'gta-6-everything-we-know',
            'will-gta-6-be-on-pc',
            'most-anticipated-gta-6-features',
            'gta-6-trailer-2-analysis',
        ),
        'gta-5-cheats' => array(
            'gta-5-cheats-ps5-ps4',
            'do-cheats-disable-trophies-gta-5',
        ),
        'gta-online-money-guide' => array(
            'gta-online-cayo-perico-solo-guide',
            'gta-online-weekly-update-march-2026',
            'gta-online-beginner-money-guide',
        ),
        'best-gta-5-mods' => array(
            'naturalvision-evolved-gta-5',
            'lspdfr-police-mod-gta-5',
        ),
        'gta-5-best-cars' => array(
            'ocelot-virtue-gta-online',
            'top-10-fastest-super-cars-gta-online',
        ),
        'fastest-cars-gta-5' => array(
            'fastest-cars-in-gta-5-ranked',
            'what-is-the-fastest-car-in-gta-5',
            'how-to-make-any-car-faster-gta-5',
            'ocelot-pariah-gta-5-profile',
            'gta-5-car-speed-database',
            'real-top-speed-mod-gta-5',
            'gta-online-weekly-march-13-19-2026',
            'fastest-cars-gta-5-no-hsw',
        ),
        'gta-6-characters' => array(
            'lucia-gta-6-character-profile',
            'trevor-philips-character-profile',
        ),
        'gta-5-map-locations' => array(
            'gta-5-hidden-locations-secrets',
        ),
        'gta-online-nightclub-guide' => array(
            'gta-online-beginner-money-guide',
        ),
    );

    // Featured post per hub (first child).
    $hub_featured = array(
        'gta-6-map'              => 'gta-6-everything-we-know',
        'gta-6-release-date'     => 'will-gta-6-be-on-pc',
        'gta-5-cheats'           => 'gta-5-cheats-ps5-ps4',
        'gta-online-money-guide' => 'gta-online-cayo-perico-solo-guide',
        'best-gta-5-mods'        => 'naturalvision-evolved-gta-5',
        'gta-5-best-cars'        => 'ocelot-virtue-gta-online',
        'fastest-cars-gta-5'      => 'fastest-cars-in-gta-5-ranked',
        'gta-6-characters'       => 'lucia-gta-6-character-profile',
        'gta-5-map-locations'    => 'gta-5-hidden-locations-secrets',
        'gta-online-nightclub-guide' => 'gta-online-beginner-money-guide',
    );

    foreach ( $hub_children as $hub_slug => $child_slugs ) {
        if ( ! isset( $hub_ids[ $hub_slug ] ) ) {
            continue;
        }
        $hub_id    = $hub_ids[ $hub_slug ];
        $child_ids = array();

        foreach ( $child_slugs as $child_slug ) {
            if ( isset( $post_ids[ $child_slug ] ) ) {
                $child_ids[] = $post_ids[ $child_slug ];

                // Set hub_page_assignment on child.
                update_post_meta( $post_ids[ $child_slug ], 'hub_page_assignment', $hub_id );
            }
        }

        if ( ! empty( $child_ids ) ) {
            update_post_meta( $hub_id, 'hub_child_posts', $child_ids );
        }

        // Set featured post.
        if ( isset( $hub_featured[ $hub_slug ] ) && isset( $post_ids[ $hub_featured[ $hub_slug ] ] ) ) {
            update_post_meta( $hub_id, 'hub_featured_post', $post_ids[ $hub_featured[ $hub_slug ] ] );
        }
    }
}
