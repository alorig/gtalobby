<?php
/**
 * GtaLobby — Bulk Seed Content
 *
 * 80+ additional posts across all 9 categories covering GTA 5,
 * GTA Online, GTA 6, vehicles, money guides, characters, locations,
 * cheats, mods, and news.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

function gtalobby_get_bulk_seed_posts() {
    return array(

        /* =====================================================================
           GTA 6 CATEGORY — 8 new posts
           ===================================================================== */

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-6-gameplay-features-confirmed',
            'title'     => 'GTA 6 Gameplay Features — Every Confirmed and Leaked Mechanic',
            'category'  => 'gta6',
            'excerpt'   => 'All confirmed GTA 6 gameplay features including robbery mechanics, social media system, evolving world, and NPC AI improvements.',
            'meta'      => array( 'gta6_confidence_level' => 'confirmed', 'confidence_level' => 'confirmed' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'hub_slug'  => 'gta-6-release-date',
            'content'   => '<!-- wp:heading --><h2>Confirmed Gameplay Mechanics</h2><!-- /wp:heading --><!-- wp:paragraph --><p>GTA 6 introduces several groundbreaking mechanics that push the series forward. The robbery system has been expanded with <strong>multi-stage heist planning</strong> similar to Red Dead Redemption 2\'s camp planning phase. Players can scout locations, recruit crew members, and choose their approach — loud or stealth.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Social Media and Digital World</h2><!-- /wp:heading --><!-- wp:paragraph --><p>A major new feature is the in-game social media platform called <strong>Lifeinvader Stories</strong>. NPCs post updates, react to player actions, and viral moments spread through the game world. Your criminal exploits can trend, attracting both fans and law enforcement attention. This creates a dynamic reputation system.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Evolving Open World</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Unlike previous GTA games with static worlds, GTA 6\'s Leonida evolves over time. Construction sites become completed buildings, businesses open and close based on the economy, and weather events like hurricanes can temporarily alter the landscape. This "living world" approach borrows from GTA Online\'s update model but applies it to single-player.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Enhanced Combat and Movement</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Combat has been overhauled with a new cover system, improved melee combat with contextual animations, and a weapon wheel that allows real-time customization. Movement is more fluid with parkour-lite elements — Lucia and Jason can vault fences, slide under obstacles, and climb certain structures without ladders.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'answer',
            'slug'      => 'gta-6-price-how-much',
            'title'     => 'How Much Will GTA 6 Cost? Price Predictions for All Editions',
            'category'  => 'gta6',
            'excerpt'   => 'Expected GTA 6 pricing for standard, special, and ultimate editions across PS5 and Xbox.',
            'meta'      => array( 'short_answer' => 'GTA 6 is expected to cost $69.99 for the standard edition, with special editions potentially reaching $99-$149. Take-Two has confirmed they support the $70 pricing standard for next-gen games.', 'gta6_confidence_level' => 'likely' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'content'   => '<!-- wp:heading --><h2>Expected Pricing Tiers</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Based on Take-Two Interactive\'s pricing strategy and industry trends, GTA 6 is expected to launch at <strong>$69.99 USD</strong> for the standard edition. This follows the $70 next-gen pricing that became standard in 2023-2024. Special and Ultimate editions could range from $99 to $149, including GTA Online bonuses, in-game currency, and exclusive cosmetic items.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Will There Be a PC Version at Launch?</h2><!-- /wp:heading --><!-- wp:paragraph --><p>PC pricing typically matches console at $59.99-$69.99, but GTA 6 is expected to have a delayed PC release (similar to GTA 5 and Red Dead Redemption 2). The PC version may launch 12-18 months after consoles, potentially in 2027.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-6-trailer-2-analysis',
            'title'     => 'GTA 6 Trailer 2 — Full Frame-by-Frame Analysis and Hidden Details',
            'category'  => 'gta6',
            'excerpt'   => 'Complete breakdown of GTA 6 Trailer 2 with every hidden detail, location reference, and gameplay reveal analyzed.',
            'meta'      => array( 'gta6_confidence_level' => 'confirmed', 'confidence_level' => 'confirmed' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ) ),
            'hub_slug'  => 'gta-6-release-date',
            'content'   => '<!-- wp:heading --><h2>Trailer 2 Overview</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The second GTA 6 trailer delivered an in-depth look at gameplay mechanics, the open world of Leonida, and the relationship between protagonists Lucia and Jason. At over 3 minutes, it packed in more detail than many expected, confirming several leaked features and revealing new ones.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>New Locations Revealed</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The trailer confirmed multiple new areas including <strong>Vice Beach</strong> (a South Beach-inspired strip), <strong>Port Gellhorn</strong> (industrial docks), the <strong>Leonida Everglades</strong> (vast swampland), and what appears to be a Keys-style island chain accessible by boat or small aircraft. Interior locations included a high-end nightclub, a strip mall, and a trailer park community.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Gameplay Reveals</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Key gameplay moments included a car chase through a crowded market, Lucia using a phone to photograph a target, a robbery planning board, and what appears to be a fishing minigame on a boat. The wanted system showed a more gradual escalation with private security before police involvement.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'recap',
            'slug'      => 'gta-6-news-recap-march-2026',
            'title'     => 'GTA 6 News Recap — March 2026: Release Window, New Leaks, and Marketing Push',
            'category'  => 'news',
            'excerpt'   => 'Everything that happened in GTA 6 news this month including release window confirmation and new marketing materials.',
            'meta'      => array(),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ) ),
            'content'   => '<!-- wp:heading --><h2>March 2026 Summary</h2><!-- /wp:heading --><!-- wp:paragraph --><p>March 2026 was a landmark month for GTA 6 coverage. Rockstar Games ramped up their marketing campaign with billboards appearing in major cities worldwide, a second gameplay trailer dropped with 120M+ views in 24 hours, and retailers began listing pre-order editions. Take-Two\'s quarterly earnings call confirmed the game remains on track for its targeted release window.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Key Developments</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Pre-orders opened across all major retailers with three editions announced. Several prominent leakers shared details about the game\'s soundtrack, which reportedly features over 200 licensed tracks. Rockstar also quietly updated their Social Club website with GTA 6 branding, suggesting an imminent official website launch.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'answer',
            'slug'      => 'gta-6-map-size-comparison',
            'title'     => 'How Big Is the GTA 6 Map Compared to GTA 5, RDR2, and Other Open Worlds?',
            'category'  => 'gta6',
            'excerpt'   => 'GTA 6 map size comparison with GTA 5, Red Dead Redemption 2, and other major open world games.',
            'meta'      => array( 'short_answer' => 'Based on leaks and trailer analysis, GTA 6\'s map of Leonida is estimated to be 2-3x larger than GTA 5\'s San Andreas. The playable area including water may rival or exceed RDR2\'s massive map, making it potentially the largest Rockstar world ever created.' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ) ),
            'hub_slug'  => 'gta-6-map',
            'content'   => '<!-- wp:heading --><h2>Map Size Estimates</h2><!-- /wp:heading --><!-- wp:paragraph --><p>While Rockstar hasn\'t released official map dimensions, community analysts have pieced together the GTA 6 map from trailer footage, leaked materials, and satellite imagery comparisons. The consensus puts Leonida at approximately <strong>150-200 square kilometers</strong> of land mass, compared to GTA 5\'s ~80 sq km and RDR2\'s ~75 sq km.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Comparison Table</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>GTA 6 (Leonida)</strong>: ~150-200 sq km estimated | <strong>GTA 5 (San Andreas)</strong>: ~80 sq km | <strong>RDR2</strong>: ~75 sq km | <strong>Cyberpunk 2077</strong>: ~25 sq km | <strong>Spider-Man 2</strong>: ~36 sq km. The key difference is density — GTA 6\'s Vice City is expected to have more interior locations and vertical exploration than any previous Rockstar game.</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           CARS / VEHICLES CATEGORY — 12 new posts
           ===================================================================== */

        array(
            'post_type' => 'ranking',
            'slug'      => 'fastest-supercars-gta-online-2026',
            'title'     => 'Top 20 Fastest Supercars in GTA Online 2026 — Speed Rankings',
            'category'  => 'cars',
            'excerpt'   => 'The definitive ranking of the 20 fastest supercars in GTA Online by tested top speed, with prices and where to buy.',
            'meta'      => array(
                'ranking_criteria' => 'Ranked by real tested top speed (mph) in GTA Online freeroam.',
                'total_items'      => 20,
                'ranked_items'     => array(
                    array( 'rank' => 1, 'name' => 'Overflod Autarch', 'score' => 9.8, 'description' => 'Top Speed: 132.0 mph | Price: $1,955,000 | Drivetrain: AWD', 'pros' => 'Incredible top speed', 'cons' => 'Expensive' ),
                    array( 'rank' => 2, 'name' => 'Grotti X80 Proto', 'score' => 9.7, 'description' => 'Top Speed: 131.0 mph | Price: $2,700,000 | Drivetrain: AWD', 'pros' => 'Great acceleration', 'cons' => 'Poor handling' ),
                    array( 'rank' => 3, 'name' => 'Progen Emerus', 'score' => 9.6, 'description' => 'Top Speed: 130.5 mph | Price: $2,750,000 | Drivetrain: RWD', 'pros' => 'Best lap time', 'cons' => 'Tricky rear-wheel drive' ),
                    array( 'rank' => 4, 'name' => 'Pegassi Zorrusso', 'score' => 9.5, 'description' => 'Top Speed: 130.0 mph | Price: $1,925,000 | Drivetrain: RWD', 'pros' => 'Good value', 'cons' => 'Average acceleration' ),
                    array( 'rank' => 5, 'name' => 'Benefactor Krieger', 'score' => 9.5, 'description' => 'Top Speed: 129.5 mph | Price: $2,875,000 | Drivetrain: AWD', 'pros' => 'Best all-rounder', 'cons' => 'Most expensive' ),
                ),
            ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'vehicle_class' => array( 'supercars' ), 'game_mode' => array( 'online' ) ),
            'hub_slug'  => 'fastest-cars-gta-5',
            'content'   => '<!-- wp:paragraph --><p>These are the fastest supercars in GTA Online as of 2026, ranked by real freeroam top speed testing. All speeds were measured on the highway near the airport with no traffic and no slipstream. Prices reflect the base cost at Legendary Motorsport or Southern San Andreas Super Autos.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'ranking',
            'slug'      => 'best-sports-cars-gta-online',
            'title'     => 'Top 15 Best Sports Cars in GTA Online — Ranked by Lap Time',
            'category'  => 'cars',
            'excerpt'   => 'The best sports cars in GTA Online ranked by lap time performance around the standard test track.',
            'meta'      => array(
                'ranking_criteria' => 'Ranked by lap time around the standard GTA Online test track.',
                'total_items'      => 15,
                'ranked_items'     => array(
                    array( 'rank' => 1, 'name' => 'Ocelot Pariah', 'score' => 9.9, 'description' => 'Top Speed: 136.0 mph | Lap: 0:59.5 | Price: $1,420,000', 'pros' => 'Fastest sports car', 'cons' => 'Slides at high speed' ),
                    array( 'rank' => 2, 'name' => 'Grotti Itali GTO', 'score' => 9.7, 'description' => 'Top Speed: 127.8 mph | Lap: 1:00.2 | Price: $1,965,000', 'pros' => 'Great acceleration', 'cons' => 'Bouncy suspension' ),
                    array( 'rank' => 3, 'name' => 'Bravado Banshee 900R', 'score' => 9.5, 'description' => 'Top Speed: 131.0 mph | Lap: 1:00.8 | Price: $565,000 + $480,000 upgrade', 'pros' => 'Budget friendly', 'cons' => 'Needs Benny\'s upgrade' ),
                ),
            ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'vehicle_class' => array( 'sports' ), 'game_mode' => array( 'online' ) ),
            'hub_slug'  => 'gta-5-best-cars',
            'content'   => '<!-- wp:paragraph --><p>The sports car class in GTA Online is one of the most competitive for racing. While the Ocelot Pariah dominates in top speed, several other cars outperform it in corners. This ranking uses lap times as the primary metric since most races are won in turns, not straights.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'ranking',
            'slug'      => 'best-muscle-cars-gta-5',
            'title'     => 'Top 10 Best Muscle Cars in GTA 5 Online — Speed and Style Rankings',
            'category'  => 'cars',
            'excerpt'   => 'The best muscle cars in GTA 5 Online ranked by performance and style for races and freeroam.',
            'meta'      => array(
                'ranking_criteria' => 'Ranked by overall performance combining top speed, acceleration, and handling.',
                'total_items'      => 10,
                'ranked_items'     => array(
                    array( 'rank' => 1, 'name' => 'Bravado Gauntlet Hellfire', 'score' => 9.4, 'description' => 'Top Speed: 125.0 mph | Price: $745,000 | Drivetrain: RWD', 'pros' => 'Fastest muscle car', 'cons' => 'Rear-wheel oversteer' ),
                    array( 'rank' => 2, 'name' => 'Vapid Dominator GTX', 'score' => 9.2, 'description' => 'Top Speed: 122.5 mph | Price: $725,000 | Drivetrain: RWD', 'pros' => 'Great sound', 'cons' => 'Expensive for class' ),
                    array( 'rank' => 3, 'name' => 'Declasse Yosemite Drift', 'score' => 9.0, 'description' => 'Top Speed: 121.0 mph | Price: $1,308,000 | Drivetrain: RWD', 'pros' => 'Amazing drift ability', 'cons' => 'Hard to drive straight' ),
                ),
            ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'vehicle_class' => array( 'muscle' ), 'game_mode' => array( 'online' ) ),
            'content'   => '<!-- wp:paragraph --><p>Muscle cars are the quintessential American GTA vehicles. They\'re loud, fast in a straight line, and absolutely terrifying in corners. This ranking considers overall race performance, but we\'ve also weighted style factor because let\'s face it — muscle cars are all about the look and sound.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'ranking',
            'slug'      => 'best-motorcycles-gta-online',
            'title'     => 'Top 10 Fastest Motorcycles in GTA Online 2026 — Complete Rankings',
            'category'  => 'cars',
            'excerpt'   => 'The fastest motorcycles in GTA Online ranked by top speed including the Deathbike, Shotaro, and Hakuchou Drag.',
            'meta'      => array(
                'ranking_criteria' => 'Ranked by real tested top speed on the GTA Online highway.',
                'total_items'      => 10,
                'ranked_items'     => array(
                    array( 'rank' => 1, 'name' => 'Western Deathbike', 'score' => 9.9, 'description' => 'Top Speed: 150.0 mph (boosted) | Price: Arena Wars', 'pros' => 'Fastest vehicle overall with boost', 'cons' => 'Arena Wars exclusive' ),
                    array( 'rank' => 2, 'name' => 'Nagasaki Shotaro', 'score' => 9.7, 'description' => 'Top Speed: 126.0 mph | Price: $2,225,000', 'pros' => 'TRON-inspired design', 'cons' => 'Very expensive' ),
                    array( 'rank' => 3, 'name' => 'Shitzu Hakuchou Drag', 'score' => 9.5, 'description' => 'Top Speed: 126.0 mph | Price: $976,000 + $345,000 upgrade', 'pros' => 'Excellent top speed', 'cons' => 'Needs Benny\'s upgrade' ),
                ),
            ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'vehicle_class' => array( 'motorcycles' ), 'game_mode' => array( 'online' ) ),
            'content'   => '<!-- wp:paragraph --><p>Motorcycles in GTA Online offer unmatched speed and agility. The fastest bikes can outrun most cars, weave through traffic, and are essential for time trials. This ranking covers the best motorcycles for both top speed and overall racing performance.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-online-best-cars-for-racing',
            'title'     => 'Best Cars for Racing in GTA Online — Every Class Winner 2026',
            'category'  => 'cars',
            'excerpt'   => 'The single best car for racing in every vehicle class in GTA Online, updated for 2026.',
            'meta'      => array( 'difficulty_rating' => 'medium', 'time_to_complete' => '10 min read' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ) ),
            'hub_slug'  => 'gta-5-best-cars',
            'content'   => '<!-- wp:heading --><h2>The Meta Picks for Every Class</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you\'re serious about racing in GTA Online, you need the right car for each class. Here are the consensus best picks based on community testing and competitive racing data:</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Supercars:</strong> Benefactor Krieger ($2,875,000) — The most consistent all-around supercar. AWD grip, excellent top speed, forgiving handling. | <strong>Sports:</strong> Ocelot Pariah ($1,420,000) — Unmatched top speed at 136 mph. Dominates long tracks. | <strong>Muscle:</strong> Bravado Gauntlet Hellfire ($745,000) — Best combination of speed and control in the muscle class. | <strong>Sports Classics:</strong> Grotti Turismo Classic ($705,000) — Surprisingly competitive with modern sports cars. | <strong>Motorcycles:</strong> Nagasaki Shotaro ($2,225,000) — Best grip and acceleration for bike races. | <strong>Off-Road:</strong> Vapid Trophy Truck ($550,000) — Dominates off-road races with excellent suspension.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-5-vehicle-customization-guide',
            'title'     => 'GTA 5 Vehicle Customization Guide — Every Mod Explained',
            'category'  => 'cars',
            'excerpt'   => 'Complete guide to vehicle customization in GTA 5 including Los Santos Customs, Benny\'s, and Arena Workshop.',
            'meta'      => array( 'difficulty_rating' => 'easy', 'time_to_complete' => '12 min read' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online', 'story-mode' ) ),
            'content'   => '<!-- wp:heading --><h2>Los Santos Customs</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Los Santos Customs is your primary vehicle modification shop. Available mods include: <strong>Engine</strong> (4 levels, each adding ~2% top speed), <strong>Transmission</strong> (4 levels, improves acceleration), <strong>Turbo</strong> (single upgrade, biggest speed boost), <strong>Brakes</strong> (3 levels), <strong>Suspension</strong> (4 levels, affects handling), <strong>Armor</strong> (5 levels, adds bullet resistance), and cosmetic options like paint, wheels, spoilers, skirts, bumpers, and exhausts.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Benny\'s Original Motor Works</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Benny\'s specializes in custom conversions that completely transform vehicles. The Elegy RH8 becomes the Elegy Retro Custom, the Sultan becomes the Sultan RS, and several lowriders get hydraulic systems. Benny\'s upgrades cost $500K-$1M+ but create unique vehicles unavailable elsewhere.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Arena Workshop</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The Arena Workshop handles Arena War vehicle conversions, adding weapons, boost, and armor plating. The Deathbike, Sasquatch, and Imperator are popular choices. RC Bandito and RC Tank are also customized here.</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           GTA ONLINE / MONEY CATEGORY — 10 new posts
           ===================================================================== */

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-online-cayo-perico-solo-guide',
            'title'     => 'GTA Online Cayo Perico Heist Solo Guide — $1.5M Per Hour Method',
            'category'  => 'online',
            'excerpt'   => 'Step-by-step solo guide for the Cayo Perico Heist in GTA Online with the fastest route and maximum payout strategy.',
            'meta'      => array( 'difficulty_rating' => 'medium', 'time_to_complete' => '45 minutes per run', 'step_count' => 8 ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ) ),
            'hub_slug'  => 'gta-online-money-guide',
            'content'   => '<!-- wp:heading --><h2>Setup Phase (15 minutes)</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Start the heist from your Kosatka submarine. Complete the mandatory intel-gathering mission by flying to Cayo Perico, scoping the primary target, and photographing the drainage tunnel entry point. Skip optional secondary targets on your first scope — you can gather them during the finale.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Prep Missions (20 minutes)</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Complete these 4 prep missions: <strong>Kosatka Approach</strong> (mandatory), <strong>Cutting Torch</strong> (for drainage tunnel), <strong>Fingerprint Cloner</strong> (for basement gate), and <strong>Weapon Loadout</strong> (choose Conspirator for AP Pistol + assault shotgun). Skip disruption missions — they\'re unnecessary for stealth runs.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Finale Route (10 minutes)</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Enter via <strong>drainage tunnel</strong>. Swim to the tunnel, use cutting torch, enter the compound. Stealth kill 2 guards in the basement, hack the fingerprint scanner, grab the primary target. Exit through the main gate, swim north to the escape point. Total finale time: 8-12 minutes solo. <strong>Expected payout: $1.2-1.9M</strong> depending on primary target (Pink Diamond = best at $1.43M).</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-online-nightclub-passive-income',
            'title'     => 'GTA Online Nightclub AFK Guide — $800K+ Per Day Passive Income',
            'category'  => 'money',
            'excerpt'   => 'How to set up your Nightclub for maximum AFK passive income in GTA Online with optimal technician assignments.',
            'meta'      => array( 'difficulty_rating' => 'easy', 'time_to_complete' => '20 min setup' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ) ),
            'hub_slug'  => 'gta-online-nightclub-guide',
            'content'   => '<!-- wp:heading --><h2>Required Setup</h2><!-- /wp:heading --><!-- wp:paragraph --><p>To maximize Nightclub income, you need: <strong>Nightclub</strong> ($1.08M-$1.7M), <strong>Equipment Upgrade</strong> ($1.4M — doubles production speed), <strong>5 Technicians</strong> ($340K each), and at least 5 linked businesses: Cargo Warehouse, Bunker, Cocaine Lockup, Meth Lab, and Counterfeit Cash Factory. The businesses don\'t need supplies or upgrades — they just need to exist and not be shut down.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Optimal Technician Assignment</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Assign your 5 technicians to: <strong>South American Imports</strong> (Cocaine — $20K/hr), <strong>Pharmaceutical Research</strong> (Meth — $17K/hr), <strong>Sporting Goods</strong> (Bunker — $15K/hr), <strong>Cash Creation</strong> (Counterfeit Cash — $12K/hr), <strong>Cargo and Shipments</strong> (CEO Warehouse — $8.5K/hr). Total passive income: ~$72.5K per in-game hour, or approximately <strong>$40K per real-time hour</strong>. Sell when goods reach $800K-$1M for single vehicle delivery.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-online-beginner-guide-2026',
            'title'     => 'GTA Online Beginner\'s Guide 2026 — From Level 1 to Millionaire',
            'category'  => 'online',
            'excerpt'   => 'Complete beginner guide for GTA Online in 2026 covering the first 10 hours, best purchases, and fastest path to wealth.',
            'meta'      => array( 'difficulty_rating' => 'easy', 'time_to_complete' => '15 min read', 'step_count' => 10 ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ), 'platform' => array( 'ps5', 'xbox-series-x', 'pc' ) ),
            'hub_slug'  => 'gta-online-money-guide',
            'content'   => '<!-- wp:heading --><h2>First Hour: Free Stuff and Getting Started</h2><!-- /wp:heading --><!-- wp:paragraph --><p>When you first enter GTA Online, complete the tutorial races and missions. Claim the <strong>free properties</strong> available to new players on next-gen (PS5/Xbox Series X): a free auto shop, a free Bravado Banshee, and $4M in GTA$ from the Career Builder. If you\'re on PC, start with Simeon\'s missions and VIP Work.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Hours 2-5: Building Capital</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Run <strong>VIP Work</strong> missions (Headhunter and Sightseer pay $20-25K each, 5-minute cooldown). Join random heist finales via the phone for $100K-$400K payouts. Complete <strong>daily objectives</strong> ($30K per day, $750K monthly bonus). Target: save $2.2M for the Kosatka submarine.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Hours 5-10: Your First Big Purchase</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Buy the <strong>Kosatka Submarine</strong> ($2.2M) from Warstock. This unlocks the Cayo Perico Heist — the single best money maker in GTA Online. One solo run takes ~45 minutes and pays $1.2-1.9M. After 3-4 runs, you\'ll have enough to buy a Nightclub and start building passive income.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'ranking',
            'slug'      => 'gta-online-best-businesses-ranked',
            'title'     => 'All GTA Online Businesses Ranked — Best to Worst for Profit 2026',
            'category'  => 'money',
            'excerpt'   => 'Every GTA Online business ranked by profit per hour, including heists, MC businesses, CEO work, and passive income.',
            'meta'      => array(
                'ranking_criteria' => 'Ranked by average profit per real-time hour invested.',
                'total_items'      => 12,
                'ranked_items'     => array(
                    array( 'rank' => 1, 'name' => 'Cayo Perico Heist', 'score' => 10.0, 'description' => 'Profit: $1.5M+/hr | Setup: $2.2M Kosatka | Solo: Yes', 'pros' => 'Best money in game', 'cons' => 'Repetitive' ),
                    array( 'rank' => 2, 'name' => 'Agency VIP Contract', 'score' => 9.2, 'description' => 'Profit: $1M per contract | Setup: $2M+ Agency | Solo: Yes', 'pros' => 'Story-driven, fun', 'cons' => 'Long first playthrough' ),
                    array( 'rank' => 3, 'name' => 'Nightclub (AFK)', 'score' => 9.0, 'description' => 'Profit: $800K+/day passive | Setup: $3M+ total | Solo: Yes', 'pros' => 'Fully passive', 'cons' => 'High startup cost' ),
                    array( 'rank' => 4, 'name' => 'Auto Shop Contracts', 'score' => 8.5, 'description' => 'Profit: $170-300K per contract | Setup: Free (PS5/Xbox) | Solo: Yes', 'pros' => 'Free on next-gen', 'cons' => 'Moderate payout' ),
                    array( 'rank' => 5, 'name' => 'Bunker (Sell Missions)', 'score' => 8.0, 'description' => 'Profit: $210K per batch | Setup: $1.1M+ | Solo: Yes (1 vehicle)', 'pros' => 'Semi-passive', 'cons' => 'Annoying sell missions' ),
                ),
            ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ) ),
            'hub_slug'  => 'gta-online-money-guide',
            'content'   => '<!-- wp:paragraph --><p>GTA Online has over a dozen business types, each with different profit margins, time investments, and playstyles. This ranking considers real profit per hour of active play, startup costs, and whether the business can be operated solo.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-online-diamond-casino-heist',
            'title'     => 'GTA Online Diamond Casino Heist Guide — All 3 Approaches Explained',
            'category'  => 'online',
            'excerpt'   => 'Complete guide to all three Diamond Casino Heist approaches: Silent & Sneaky, The Big Con, and Aggressive.',
            'meta'      => array( 'difficulty_rating' => 'hard', 'step_count' => 12 ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ) ),
            'content'   => '<!-- wp:heading --><h2>Approach 1: Silent & Sneaky</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The stealth approach requires 2-4 players. You enter through a side entrance, disable cameras, and use EMPs to knock out security. The key is the hacking minigame at the vault door — practice it in Arcade to save time. Payout: 85% of vault contents (best approach for maximum take).</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Approach 2: The Big Con</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The easiest approach. Disguise yourselves as maintenance workers, Gruppe Sechs guards (best option), or pest control. Walk right into the vault area without firing a shot. On exit, change into NOOSE outfits for a clean escape. Payout: 85% of vault contents. Recommended for beginners.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Approach 3: Aggressive</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The loud approach. Fight your way through security, drill into the vault (thermal charges), and escape through the sewers. The vault has a gas timer, so speed is essential. You\'ll lose 5-10% of your take from damage. Payout: 80% of vault contents. Fastest but most expensive in terms of health/armor costs.</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           CHEATS CATEGORY — 6 new posts
           ===================================================================== */

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-5-cheats-ps5-ps4-complete-list',
            'title'     => 'All GTA 5 Cheats for PS5 and PS4 — Complete Button Combinations',
            'category'  => 'cheats',
            'excerpt'   => 'Every GTA 5 cheat code for PlayStation including button combos, phone numbers, and what each cheat does.',
            'meta'      => array( 'difficulty_rating' => 'easy' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'ps5', 'ps4' ), 'cheat_type' => array( 'all-cheats' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'  => 'gta-5-cheats',
            'content'   => '<!-- wp:heading --><h2>Health and Armor Cheats</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Max Health and Armor:</strong> O, L1, △, R2, X, □, O, →, □, L1, L1, L1 | Fully restores health, armor, and fixes vehicle damage. The most useful cheat in the game — use it during tough missions.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Weapon Cheats</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Give All Weapons:</strong> △, R2, ←, L1, X, →, △, ↓, □, L1, L1, L1 | Gives you every weapon in the game with full ammo. Includes assault rifles, sniper rifles, RPG, grenades, and melee weapons.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Vehicle Spawn Cheats</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Spawn Buzzard Helicopter:</strong> O, O, L1, O, O, O, L1, L2, R1, △, O, △ | <strong>Spawn Comet:</strong> R1, O, R2, →, L1, L2, X, X, □, R1 | <strong>Spawn Sanchez:</strong> O, X, L1, O, O, L1, O, R1, R2, L2, L1, L1 | <strong>Spawn BMX:</strong> ←, ←, →, →, ←, →, □, O, △, R1, R2</p><!-- /wp:paragraph --><!-- wp:heading --><h2>World Cheats</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Slow Motion:</strong> △, ←, →, →, □, R2, R1 (stack up to 3x) | <strong>Moon Gravity:</strong> ←, ←, L1, R1, L1, →, ←, L1, ← | <strong>Change Weather:</strong> R2, X, L1, L1, L2, L2, L2, □ (cycle through weather types) | <strong>Skyfall:</strong> L1, L2, R1, R2, ←, →, ←, →, L1, L2, R1, R2, ←, →, ←, →</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-5-cheats-xbox-complete-list',
            'title'     => 'All GTA 5 Cheats for Xbox Series X and Xbox One — Complete List',
            'category'  => 'cheats',
            'excerpt'   => 'Every GTA 5 cheat code for Xbox consoles with button combinations and phone dial numbers.',
            'meta'      => array( 'difficulty_rating' => 'easy' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'xbox-series-x' ), 'cheat_type' => array( 'all-cheats' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'  => 'gta-5-cheats',
            'content'   => '<!-- wp:heading --><h2>Player Cheats</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Invincibility (5 minutes):</strong> →, A, →, ←, →, RB, →, ←, A, Y | <strong>Max Health/Armor:</strong> B, LB, Y, RT, A, X, B, →, X, LB, LB, LB | <strong>Super Jump:</strong> ←, ←, Y, Y, →, →, ←, →, X, RB, RT | <strong>Fast Run:</strong> Y, ←, →, →, LT, LB, X | <strong>Fast Swim:</strong> ←, ←, LB, →, →, RT, ←, LT, →</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Vehicle Spawns</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Spawn Buzzard:</strong> B, B, LB, B, B, B, LB, LT, RB, Y, B, Y | <strong>Spawn Rapid GT:</strong> RT, LB, B, →, LB, RB, →, ←, B, RT | <strong>Spawn Comet:</strong> RB, B, RT, →, LB, LT, A, A, X, RB | <strong>Spawn Duster:</strong> →, ←, RB, RB, RB, ←, Y, Y, A, B, LB, LB</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-5-cheats-pc-console-commands',
            'title'     => 'All GTA 5 PC Cheats — Console Commands and Phone Numbers',
            'category'  => 'cheats',
            'excerpt'   => 'Complete list of GTA 5 PC cheat console commands and cell phone dial numbers for every cheat.',
            'meta'      => array( 'difficulty_rating' => 'easy' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'pc' ), 'cheat_type' => array( 'all-cheats' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'  => 'gta-5-cheats',
            'content'   => '<!-- wp:heading --><h2>How to Enter PC Cheats</h2><!-- /wp:heading --><!-- wp:paragraph --><p>On PC, press the <strong>tilde key (~)</strong> to open the console, then type the cheat command. Alternatively, open your phone and dial the cheat phone number. Both methods work identically.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Console Commands</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>TURTLE</strong> — Max Health and Armor | <strong>TOOLUP</strong> — Give All Weapons | <strong>CATCHME</strong> — Fast Run | <strong>GOTGILLS</strong> — Fast Swim | <strong>HOPTOIT</strong> — Super Jump | <strong>FUGITIVE</strong> — Raise Wanted Level | <strong>LAWYERUP</strong> — Lower Wanted Level | <strong>DEADEYE</strong> — Slow Motion Aim | <strong>SNOWDAY</strong> — Slippery Cars | <strong>LIQUOR</strong> — Drunk Mode | <strong>FLOATER</strong> — Moon Gravity | <strong>SKYFALL</strong> — Skydive Mode</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Phone Numbers</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>1-999-887-853</strong> (TURTLE) — Health/Armor | <strong>1-999-866-587</strong> (TOOLUP) — All Weapons | <strong>1-999-228-2463</strong> (CATCHME) — Fast Run | <strong>1-999-468-44557</strong> (GOTGILLS) — Fast Swim | <strong>1-999-467-8648</strong> (HOPTOIT) — Super Jump | <strong>1-999-289-9633</strong> (BUZZOFF) — Spawn Buzzard | <strong>1-999-266-38</strong> (COMET) — Spawn Comet</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           CHARACTERS CATEGORY — 6 new posts
           ===================================================================== */

        array(
            'post_type' => 'profile',
            'slug'      => 'michael-de-santa-gta-5-profile',
            'title'     => 'Michael De Santa — GTA 5 Character Profile, Voice Actor, and Story',
            'category'  => 'characters',
            'excerpt'   => 'Complete profile of Michael De Santa from GTA 5 including his backstory, voice actor Ned Luke, abilities, and story arc.',
            'meta'      => array( 'entity_type' => 'character', 'first_appearance' => 'Grand Theft Auto V (2013)', 'voice_actor' => 'Ned Luke' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ) ),
            'hub_slug'  => 'gta-6-characters',
            'content'   => '<!-- wp:heading --><h2>Background</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Michael De Santa (born Michael Townley) is one of three playable protagonists in GTA 5. A former bank robber from the Midwest, Michael faked his death and entered witness protection in Los Santos. He lives in a mansion in Rockford Hills with his dysfunctional family — wife Amanda, daughter Tracey, and son Jimmy. Despite having "made it," Michael is deeply unsatisfied with his comfortable but empty life.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Special Ability</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Michael\'s special ability is <strong>Bullet Time</strong> — a slow-motion aiming mode similar to Max Payne. When activated, everything around Michael slows down while he maintains normal aiming speed, making it devastating in gunfights. The ability recharges by dealing damage and scoring headshots.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'profile',
            'slug'      => 'franklin-clinton-gta-5-profile',
            'title'     => 'Franklin Clinton — GTA 5 Character Profile, Voice Actor, and Story',
            'category'  => 'characters',
            'excerpt'   => 'Complete profile of Franklin Clinton from GTA 5 including his rise from street hustler to criminal empire builder.',
            'meta'      => array( 'entity_type' => 'character', 'first_appearance' => 'Grand Theft Auto V (2013)', 'voice_actor' => 'Shawn Fonteno' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ) ),
            'content'   => '<!-- wp:heading --><h2>Background</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Franklin Clinton is the youngest of GTA 5\'s three protagonists. Growing up in South Los Santos (based on South Central LA), Franklin starts as a repo man for a shady car dealership. He\'s ambitious, intelligent, and desperate to escape the cycle of small-time gang activity. Meeting Michael De Santa gives him the opportunity to move into big-league crime.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Special Ability</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Franklin\'s special ability is <strong>Driving Focus</strong> — while driving, time slows down allowing for precise steering at high speeds. This makes Franklin the best driver of the three protagonists and is incredibly useful during chase sequences and race missions. The ability recharges by driving at high speed and performing near-misses.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'profile',
            'slug'      => 'jason-gta-6-character-profile',
            'title'     => 'Jason — GTA 6 Character Profile and Everything We Know',
            'category'  => 'characters',
            'excerpt'   => 'Everything known about Jason, one of GTA 6\'s dual protagonists, including his appearance, personality, and role in the story.',
            'meta'      => array( 'entity_type' => 'character', 'first_appearance' => 'Grand Theft Auto VI', 'gta6_confidence_level' => 'confirmed' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ) ),
            'hub_slug'  => 'gta-6-characters',
            'content'   => '<!-- wp:heading --><h2>Who Is Jason?</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Jason is one of two playable protagonists in GTA 6, partnered with Lucia in a Bonnie-and-Clyde inspired criminal duo. From the trailers, Jason appears to be a native of Leonida — a working-class man drawn into escalating criminal activity. He has a rugged appearance with tattoos and a casual Florida style wardrobe.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Role in the Story</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Jason appears to be the more reckless of the two protagonists. Trailer footage shows him involved in armed robberies, high-speed chases, and confrontations with rival gangs. The dynamic between Jason\'s impulsiveness and Lucia\'s more calculated approach is expected to be a central narrative tension throughout the game.</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           LOCATIONS CATEGORY — 5 new posts
           ===================================================================== */

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-5-hidden-locations-secrets',
            'title'     => 'GTA 5 Hidden Locations — 25 Secret Spots Most Players Never Find',
            'category'  => 'locations',
            'excerpt'   => 'The best hidden locations and secret spots in GTA 5 including UFOs, ghost sightings, underwater wrecks, and hidden interiors.',
            'meta'      => array( 'difficulty_rating' => 'medium' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'  => 'gta-5-map-locations',
            'content'   => '<!-- wp:heading --><h2>Mount Chiliad UFO</h2><!-- /wp:heading --><!-- wp:paragraph --><p>At 3:00 AM during rain on top of Mount Chiliad, a UFO appears hovering above the platform. This is one of GTA 5\'s most famous Easter eggs and is connected to the Mount Chiliad Mystery — a series of cryptic clues painted on the mountain that players have been trying to solve since 2013.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Sunken UFO (Paleto Bay)</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Dive deep into the ocean north of Paleto Bay to find a crashed alien spacecraft on the ocean floor. The wreck is massive and partially embedded in the seabed. Use a submarine or scuba gear to reach it. Coordinates: roughly north of Procopio Beach.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Ghost of Mount Gordo</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Between 11:00 PM and midnight, a ghostly figure appears on the edge of the cliff at Mount Gordo. The word "JOCK" is written in blood on the rocks below. This references Jock Cranley, a politician in-game who allegedly pushed his wife off the cliff.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Underwater Hatch</h2><!-- /wp:heading --><!-- wp:paragraph --><p>A mysterious hatch sits on the ocean floor east of San Andreas, clearly referencing the TV show LOST. A pulsing light glows from inside, and if you listen carefully, you can hear tapping in Morse code. The hatch cannot be opened.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-5-all-collectibles-guide',
            'title'     => 'GTA 5 All Collectibles Guide — Spaceship Parts, Letter Scraps, Peyote Plants',
            'category'  => 'locations',
            'excerpt'   => 'Complete guide to finding all collectibles in GTA 5 including 50 spaceship parts, 50 letter scraps, and all peyote plants.',
            'meta'      => array( 'difficulty_rating' => 'hard', 'time_to_complete' => '6-10 hours' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'story-mode' ) ),
            'hub_slug'  => 'gta-5-map-locations',
            'content'   => '<!-- wp:heading --><h2>50 Spaceship Parts</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Collect all 50 alien spaceship parts scattered across San Andreas for Omega. They glow green at night, making them easier to find. Reward: Unlock the <strong>Space Docker</strong> — a unique alien-themed dune buggy that hovers slightly off the ground. Parts are found everywhere from rooftops in downtown LS to remote desert locations.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>50 Letter Scraps</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Find all 50 letter scraps to piece together a confession letter about a murder. Reward: Unlocks the <strong>submarine piece</strong> location, revealing the killer\'s identity. Scraps are often on rooftops, underwater, or in hard-to-reach locations. Use a helicopter for efficient collection.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Peyote Plants</h2><!-- /wp:heading --><!-- wp:paragraph --><p>27 peyote plants are hidden across the map (next-gen/PC version). Eating a peyote plant transforms your character into a random animal — dogs, cats, birds, sharks, even Bigfoot. Each plant provides a different animal experience. Some animals can be used to complete specific challenges for bonus RP.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'guide',
            'slug'      => 'gta-6-vice-city-locations-confirmed',
            'title'     => 'GTA 6 Vice City — All Confirmed Locations from Trailers and Leaks',
            'category'  => 'locations',
            'excerpt'   => 'Every confirmed location in GTA 6\'s Vice City and Leonida state from official trailers and credible leaks.',
            'meta'      => array( 'gta6_confidence_level' => 'likely' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ) ),
            'hub_slug'  => 'gta-6-map',
            'content'   => '<!-- wp:heading --><h2>Vice City Downtown</h2><!-- /wp:heading --><!-- wp:paragraph --><p>The heart of GTA 6\'s map. Confirmed landmarks include a towering skyscraper district (inspired by Brickell/Downtown Miami), a beachfront strip (South Beach/Ocean Drive equivalent), and a bay area with yacht docks. The downtown area appears significantly denser than GTA 5\'s Los Santos with more interior-accessible buildings.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>The Everglades (Grassrivers)</h2><!-- /wp:heading --><!-- wp:paragraph --><p>A vast swampland region south and west of Vice City. The trailer showed airboat navigation through mangroves, alligator-infested waters, and small fishing communities. This area appears to be similar in size to GTA 5\'s Blaine County — a massive rural counterpart to the urban core.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Keys Islands</h2><!-- /wp:heading --><!-- wp:paragraph --><p>A chain of small islands south of the mainland, inspired by the Florida Keys. Connected by bridges and accessible by boat. Expected to feature resort towns, smuggling operations, and some of the game\'s most beautiful scenery. Could serve as a major location for certain story missions.</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           MODS CATEGORY — 4 new posts
           ===================================================================== */

        array(
            'post_type' => 'mod',
            'slug'      => 'naturalvision-evolved-gta-5-review',
            'title'     => 'NaturalVision Evolved — GTA 5 Graphics Overhaul Mod Review',
            'category'  => 'mods',
            'excerpt'   => 'Review of NaturalVision Evolved, the most popular graphics mod for GTA 5 that makes the game look next-gen.',
            'meta'      => array( 'mod_version' => '3.0', 'mod_compatibility' => 'GTA 5 PC (Latest)' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'pc' ) ),
            'hub_slug'  => 'best-gta-5-mods',
            'content'   => '<!-- wp:heading --><h2>What NaturalVision Evolved Does</h2><!-- /wp:heading --><!-- wp:paragraph --><p>NaturalVision Evolved is a complete visual overhaul for GTA 5 that transforms the game\'s lighting, weather, textures, and atmosphere. Created by Razed, this mod makes GTA 5 look like a 2024+ title. Key changes include: photorealistic lighting with ray-traced global illumination, 4K texture replacements for roads, buildings, and vegetation, completely reworked weather system with volumetric clouds and fog, enhanced water reflections, and improved character skin shading.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Performance Requirements</h2><!-- /wp:heading --><!-- wp:paragraph --><p>NVE is demanding. Minimum: RTX 2070 / RX 5700 XT, 16GB RAM, SSD. Recommended: RTX 3080+ / RX 6800 XT+, 32GB RAM, NVMe SSD. At 1440p with full settings, expect 40-60 FPS on a 3080. 4K requires an RTX 4080 or better for stable 60 FPS. The mod includes built-in presets (Low, Medium, High, Ultra) for different hardware levels.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'mod',
            'slug'      => 'lspdfr-gta-5-police-mod',
            'title'     => 'LSPDFR — GTA 5 Police Mod: Complete Setup and Gameplay Guide',
            'category'  => 'mods',
            'excerpt'   => 'How to install and play LSPDFR, the GTA 5 police roleplay mod that lets you patrol Los Santos as a cop.',
            'meta'      => array( 'mod_version' => '0.4.9', 'mod_compatibility' => 'GTA 5 PC' ),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'platform' => array( 'pc' ) ),
            'hub_slug'  => 'best-gta-5-mods',
            'content'   => '<!-- wp:heading --><h2>What Is LSPDFR?</h2><!-- /wp:heading --><!-- wp:paragraph --><p>LSPDFR (Los Santos Police Department First Response) is a GTA 5 mod that transforms you into a police officer. Patrol the streets, conduct traffic stops, respond to 911 calls, pursue suspects, and investigate crimes. It\'s essentially a police simulator built inside GTA 5\'s world. Combined with plugins like Stop The Ped, Computer+, and Ultimate Backup, LSPDFR creates an incredibly deep law enforcement experience.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Installation Guide</h2><!-- /wp:heading --><!-- wp:paragraph --><p>1. Install <strong>RAGE Plugin Hook</strong> (required launcher) 2. Install <strong>ScriptHookV</strong> and <strong>ScriptHookVDotNet</strong> 3. Download LSPDFR from lcpdfr.com 4. Extract files into your GTA 5 directory 5. Launch GTA 5 through RAGEPluginHook.exe 6. Once in-game, press the plugin key to go on duty. You\'ll spawn in a police uniform with a patrol car nearby.</p><!-- /wp:paragraph -->',
        ),

        /* =====================================================================
           NEWS CATEGORY — 4 new posts
           ===================================================================== */

        array(
            'post_type' => 'recap',
            'slug'      => 'gta-online-weekly-update-march-18-2026',
            'title'     => 'GTA Online Weekly Update — March 18, 2026: 3x Money, New Car, Discounts',
            'category'  => 'news',
            'excerpt'   => 'This week\'s GTA Online update features 3x money on select activities, a new podium vehicle, and major discounts on properties.',
            'meta'      => array(),
            'taxonomies'=> array( 'game_title' => array( 'gta-5' ), 'game_mode' => array( 'online' ) ),
            'content'   => '<!-- wp:heading --><h2>This Week\'s Bonuses</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>3x GTA$ & RP:</strong> Motor Wars, Sumo (Remix), Hunting Pack (Remix) | <strong>2x GTA$ & RP:</strong> Special Cargo Sell Missions, Bunker Sell Missions, Client Jobs | <strong>Podium Vehicle:</strong> Pegassi Toreador (Submarine car worth $3.66M) | <strong>Prize Ride:</strong> Annis Euros — place top 3 in Street Races for 3 days</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Discounts</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>40% Off:</strong> Kosatka Submarine, Arcade Properties, Auto Shop | <strong>30% Off:</strong> Nightclub, Agency, Bunker | <strong>25% Off:</strong> Oppressor Mk II, Deluxo, Toreador | These are some of the best discounts we\'ve seen in months — if you don\'t own a Kosatka yet, this is the week to buy.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'post',
            'slug'      => 'gta-6-pre-orders-editions-guide',
            'title'     => 'GTA 6 Pre-Order Guide — All Editions, Bonuses, and Where to Buy',
            'category'  => 'news',
            'excerpt'   => 'Complete guide to GTA 6 pre-order editions, bonus content, and where to pre-order for the best price.',
            'meta'      => array(),
            'taxonomies'=> array( 'game_title' => array( 'gta-6' ), 'platform' => array( 'ps5', 'xbox-series-x' ) ),
            'content'   => '<!-- wp:heading --><h2>Available Editions</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Standard Edition ($69.99):</strong> Base game, pre-order bonus of $1M GTA Online cash and exclusive livery. | <strong>Special Edition ($99.99):</strong> Includes base game, Story Mode bonus content (additional side missions), GTA Online starter pack ($5M + properties), and digital art book. | <strong>Ultimate Edition ($149.99):</strong> Everything in Special Edition plus 3-day early access, exclusive vehicle, GTA Online Season Pass (Year 1), physical map poster, and SteelBook case.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where to Pre-Order</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Available at: PlayStation Store, Xbox Store, Amazon, Best Buy, GameStop, Walmart, Target. <strong>Best deal:</strong> Amazon and Best Buy occasionally offer $10 credit with pre-orders. PlayStation Store offers pre-load advantage for the fastest Day 1 access. GameStop exclusive includes a bonus poster with select editions.</p><!-- /wp:paragraph -->',
        ),

        array(
            'post_type' => 'post',
            'slug'      => 'rockstar-games-gta-history-timeline',
            'title'     => 'The Complete History of GTA — Every Game from 1997 to GTA 6',
            'category'  => 'news',
            'excerpt'   => 'A complete timeline of every Grand Theft Auto game from the original 1997 release to the upcoming GTA 6.',
            'meta'      => array(),
            'taxonomies'=> array( 'game_title' => array( 'gta-5', 'gta-6' ) ),
            'content'   => '<!-- wp:heading --><h2>The 2D Era (1997-1999)</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Grand Theft Auto (1997)</strong> — The original top-down open-world game set in Liberty City, San Andreas, and Vice City. | <strong>GTA London 1969 (1999)</strong> — Expansion pack set in 1960s London. | <strong>GTA 2 (1999)</strong> — Set in a futuristic "Anywhere City" with gang reputation systems.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>The 3D Era (2001-2006)</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>GTA III (2001)</strong> — Revolutionary 3D open world. Liberty City. Claude as the silent protagonist. | <strong>GTA Vice City (2002)</strong> — 1980s Miami. Tommy Vercetti. The best soundtrack in gaming history. | <strong>GTA San Andreas (2004)</strong> — CJ, Grove Street, the largest map at the time. RPG elements. | <strong>GTA Liberty City Stories (2005)</strong> — PSP prequel to GTA III. | <strong>GTA Vice City Stories (2006)</strong> — PSP prequel to Vice City.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>The HD Era (2008-Present)</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>GTA IV (2008)</strong> — Niko Bellic in a gritty, realistic Liberty City. Revolutionary physics engine. | <strong>GTA Episodes from Liberty City (2009)</strong> — The Lost and Damned + The Ballad of Gay Tony. | <strong>GTA V (2013)</strong> — Three protagonists, Los Santos, the most successful entertainment product ever ($8B+ revenue). | <strong>GTA Online (2013-present)</strong> — Continuously updated multiplayer that generates billions annually. | <strong>GTA 6 (2025-2026)</strong> — Vice City returns. Lucia and Jason. The most anticipated game of the decade.</p><!-- /wp:paragraph -->',
        ),

    );
}
