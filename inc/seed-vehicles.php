<?php
/**
 * GtaLobby — GTA 5 Vehicle Database Seeder
 *
 * Creates comprehensive vehicle profiles, rankings, and database entries
 * for every GTA 5 / GTA Online vehicle organized by vehicle class.
 *
 * @package GtaLobby
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the complete GTA 5 vehicle database organized by class.
 * Each vehicle has: name, speed (top speed in mph), acceleration (0-100),
 * handling (1-10), braking (1-10), class, price, and drivetrain.
 */
function gtalobby_get_vehicle_database() {
    return array(

        /* =============================================================
           SUPERCARS
           ============================================================= */
        'supercars' => array(
            'label' => 'Supercars',
            'vehicles' => array(
                array( 'name' => 'Overflod Autarch',        'speed' => 127.50, 'acceleration' => 8.8, 'handling' => 8.5, 'braking' => 8.7, 'price' => 1955000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Grotti X80 Proto',        'speed' => 127.50, 'acceleration' => 9.0, 'handling' => 8.0, 'braking' => 8.5, 'price' => 2700000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Progen Emerus',           'speed' => 127.25, 'acceleration' => 9.0, 'handling' => 9.2, 'braking' => 9.0, 'price' => 2750000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Progen S80RR',            'speed' => 127.00, 'acceleration' => 8.5, 'handling' => 9.5, 'braking' => 9.3, 'price' => 2575000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor Krieger',      'speed' => 127.00, 'acceleration' => 9.2, 'handling' => 9.4, 'braking' => 9.2, 'price' => 2875000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Furia',            'speed' => 126.75, 'acceleration' => 8.7, 'handling' => 8.8, 'braking' => 8.6, 'price' => 2740000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Zorrusso',        'speed' => 126.50, 'acceleration' => 8.6, 'handling' => 8.3, 'braking' => 8.4, 'price' => 1925000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ocelot XA-21',            'speed' => 126.50, 'acceleration' => 8.9, 'handling' => 8.8, 'braking' => 8.8, 'price' => 2375000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Tezeract',        'speed' => 126.25, 'acceleration' => 9.3, 'handling' => 8.2, 'braking' => 8.6, 'price' => 2825000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Truffade Thrax',          'speed' => 126.00, 'acceleration' => 8.8, 'handling' => 8.5, 'braking' => 8.3, 'price' => 2325000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Dewbauchee Vagner',       'speed' => 126.00, 'acceleration' => 8.7, 'handling' => 9.3, 'braking' => 9.1, 'price' => 1535000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Turismo R',        'speed' => 126.00, 'acceleration' => 8.5, 'handling' => 8.6, 'braking' => 8.4, 'price' => 500000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Zentorno',        'speed' => 125.75, 'acceleration' => 8.8, 'handling' => 8.5, 'braking' => 8.3, 'price' => 725000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Osiris',          'speed' => 125.50, 'acceleration' => 8.6, 'handling' => 8.4, 'braking' => 8.5, 'price' => 1950000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Truffade Adder',          'speed' => 125.00, 'acceleration' => 8.4, 'handling' => 7.8, 'braking' => 7.9, 'price' => 1000000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Overflod Entity XF',      'speed' => 125.00, 'acceleration' => 8.5, 'handling' => 8.2, 'braking' => 8.0, 'price' => 795000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Itali RSX',        'speed' => 135.30, 'acceleration' => 9.1, 'handling' => 8.8, 'braking' => 8.7, 'price' => 3465000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Progen T20',              'speed' => 125.50, 'acceleration' => 8.7, 'handling' => 8.6, 'braking' => 8.5, 'price' => 2200000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Overflod Entity XXR',     'speed' => 128.00, 'acceleration' => 8.6, 'handling' => 8.3, 'braking' => 8.4, 'price' => 2305000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Tempesta',        'speed' => 125.75, 'acceleration' => 8.5, 'handling' => 8.5, 'braking' => 8.3, 'price' => 1329000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Principe Deveste Eight',  'speed' => 131.75, 'acceleration' => 8.4, 'handling' => 7.8, 'braking' => 8.0, 'price' => 1795000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Visione',          'speed' => 125.00, 'acceleration' => 8.2, 'handling' => 8.7, 'braking' => 8.6, 'price' => 2250000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Truffade Nero',           'speed' => 127.50, 'acceleration' => 8.3, 'handling' => 8.0, 'braking' => 8.1, 'price' => 1440000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Truffade Nero Custom',    'speed' => 127.50, 'acceleration' => 8.5, 'handling' => 8.2, 'braking' => 8.3, 'price' => 1740000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Coil Voltic',             'speed' => 120.00, 'acceleration' => 8.0, 'handling' => 7.8, 'braking' => 7.5, 'price' => 150000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Vacca',           'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 7.8, 'price' => 240000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Infernus',        'speed' => 121.50, 'acceleration' => 8.2, 'handling' => 7.9, 'braking' => 7.8, 'price' => 440000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Cheval Taipan',           'speed' => 125.00, 'acceleration' => 8.0, 'handling' => 7.5, 'braking' => 7.8, 'price' => 1980000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor Schlagen GT',  'speed' => 126.25, 'acceleration' => 8.3, 'handling' => 8.4, 'braking' => 8.5, 'price' => 1300000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Annis RE-7B',             'speed' => 125.75, 'acceleration' => 8.6, 'handling' => 9.0, 'braking' => 9.0, 'price' => 2475000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Progen GP1',              'speed' => 126.75, 'acceleration' => 8.4, 'handling' => 8.1, 'braking' => 8.2, 'price' => 1260000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid FMJ',               'speed' => 124.25, 'acceleration' => 8.0, 'handling' => 8.3, 'braking' => 8.2, 'price' => 1750000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Turismo Classic',  'speed' => 121.50, 'acceleration' => 8.1, 'handling' => 8.5, 'braking' => 8.3, 'price' => 705000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Torero',          'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 7.8, 'braking' => 7.6, 'price' => 998000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ocelot Penetrator',       'speed' => 121.00, 'acceleration' => 7.8, 'handling' => 8.2, 'braking' => 8.0, 'price' => 880000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Progen Tyrus',            'speed' => 125.00, 'acceleration' => 8.5, 'handling' => 9.0, 'braking' => 9.2, 'price' => 2550000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Progen Itali GTB',        'speed' => 125.50, 'acceleration' => 8.3, 'handling' => 8.4, 'braking' => 8.3, 'price' => 1189000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Progen Itali GTB Custom', 'speed' => 125.50, 'acceleration' => 8.5, 'handling' => 8.6, 'braking' => 8.5, 'price' => 1489000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Pfister 811',             'speed' => 132.50, 'acceleration' => 8.0, 'handling' => 7.5, 'braking' => 7.8, 'price' => 1135000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'BF Raptor',               'speed' => 121.00, 'acceleration' => 8.3, 'handling' => 8.0, 'braking' => 7.8, 'price' => 665000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Toros',           'speed' => 127.75, 'acceleration' => 8.5, 'handling' => 7.5, 'braking' => 7.8, 'price' => 498000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Lampadati Tigon',         'speed' => 127.00, 'acceleration' => 8.5, 'handling' => 8.6, 'braking' => 8.5, 'price' => 2310000, 'drivetrain' => 'RWD', 'seats' => 2 ),
            ),
        ),

        /* =============================================================
           SPORTS
           ============================================================= */
        'sports' => array(
            'label' => 'Sports',
            'vehicles' => array(
                array( 'name' => 'Ocelot Pariah',           'speed' => 136.00, 'acceleration' => 8.5, 'handling' => 8.0, 'braking' => 8.2, 'price' => 1420000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Itali GTO',        'speed' => 127.75, 'acceleration' => 8.8, 'handling' => 8.5, 'braking' => 8.3, 'price' => 1965000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pfister Comet SR',        'speed' => 126.50, 'acceleration' => 8.3, 'handling' => 8.4, 'braking' => 8.2, 'price' => 1145000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Banshee 900R',    'speed' => 131.00, 'acceleration' => 8.5, 'handling' => 7.8, 'braking' => 7.9, 'price' => 565000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dewbauchee Specter',      'speed' => 125.75, 'acceleration' => 8.2, 'handling' => 8.3, 'braking' => 8.1, 'price' => 599000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dewbauchee Specter Custom','speed' => 125.75, 'acceleration' => 8.4, 'handling' => 8.5, 'braking' => 8.3, 'price' => 799000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Annis Elegy RH8',         'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.5, 'braking' => 8.3, 'price' => 0,       'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Annis Elegy Retro Custom', 'speed' => 121.50, 'acceleration' => 8.2, 'handling' => 8.7, 'braking' => 8.5, 'price' => 904000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Jester',            'speed' => 121.50, 'acceleration' => 8.3, 'handling' => 8.5, 'braking' => 8.4, 'price' => 240000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Jester (Racecar)',  'speed' => 121.50, 'acceleration' => 8.5, 'handling' => 8.8, 'braking' => 8.7, 'price' => 350000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Jester RR',         'speed' => 124.25, 'acceleration' => 8.5, 'handling' => 8.8, 'braking' => 8.6, 'price' => 1970000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Carbonizzare',     'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.2, 'braking' => 8.0, 'price' => 195000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Invetero Coquette',       'speed' => 121.00, 'acceleration' => 7.8, 'handling' => 8.0, 'braking' => 7.8, 'price' => 138000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Obey 9F',                 'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 7.8, 'price' => 120000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Obey 9F Cabrio',          'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 7.9, 'braking' => 7.7, 'price' => 130000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Hijak Khamelion',         'speed' => 118.00, 'acceleration' => 8.0, 'handling' => 7.5, 'braking' => 7.5, 'price' => 100000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor Feltzer',      'speed' => 120.00, 'acceleration' => 7.8, 'handling' => 7.8, 'braking' => 7.6, 'price' => 145000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Bestia GTS',       'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 8.0, 'price' => 610000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor Schafter V12',  'speed' => 121.50, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 8.0, 'price' => 116000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Pfister Comet',           'speed' => 120.00, 'acceleration' => 7.8, 'handling' => 7.8, 'braking' => 7.7, 'price' => 100000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pfister Comet S2',        'speed' => 124.00, 'acceleration' => 8.4, 'handling' => 8.5, 'braking' => 8.3, 'price' => 1878000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Furore GT',     'speed' => 120.00, 'acceleration' => 7.8, 'handling' => 7.8, 'braking' => 7.5, 'price' => 448000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Tropos Rallye', 'speed' => 118.50, 'acceleration' => 7.5, 'handling' => 8.2, 'braking' => 8.0, 'price' => 616000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Karin Sultan',            'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 8.0, 'braking' => 7.5, 'price' => 12000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Karin Sultan RS',         'speed' => 121.00, 'acceleration' => 8.3, 'handling' => 8.5, 'braking' => 8.3, 'price' => 795000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Karin Sultan RS Classic',  'speed' => 120.50, 'acceleration' => 8.0, 'handling' => 8.3, 'braking' => 8.0, 'price' => 1718000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Annis ZR350',             'speed' => 120.50, 'acceleration' => 8.2, 'handling' => 8.5, 'braking' => 8.2, 'price' => 1615000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Obey Omnis',              'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 8.5, 'braking' => 8.0, 'price' => 701000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Ocelot Lynx',             'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 8.0, 'price' => 1735000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Schyster Deviant',        'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 7.5, 'braking' => 7.3, 'price' => 512000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Banshee',         'speed' => 120.00, 'acceleration' => 7.8, 'handling' => 7.5, 'braking' => 7.5, 'price' => 105000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Invetero Coquette D10',   'speed' => 126.00, 'acceleration' => 8.3, 'handling' => 8.0, 'braking' => 8.0, 'price' => 1510000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Corsita',       'speed' => 123.50, 'acceleration' => 8.0, 'handling' => 8.2, 'braking' => 8.0, 'price' => 1835000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor SM722',        'speed' => 124.50, 'acceleration' => 8.3, 'handling' => 8.3, 'braking' => 8.2, 'price' => 2115000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vysser Neo',              'speed' => 124.75, 'acceleration' => 8.0, 'handling' => 8.5, 'braking' => 8.4, 'price' => 1875000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ocelot Jugular',          'speed' => 123.50, 'acceleration' => 8.2, 'handling' => 8.0, 'braking' => 7.8, 'price' => 1225000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Dinka RT3000',            'speed' => 121.50, 'acceleration' => 7.8, 'handling' => 8.3, 'braking' => 8.0, 'price' => 1715000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Karin Calico GTF',        'speed' => 122.50, 'acceleration' => 8.5, 'handling' => 9.0, 'braking' => 8.8, 'price' => 1995000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Annis Euros',             'speed' => 121.00, 'acceleration' => 8.0, 'handling' => 8.3, 'braking' => 8.0, 'price' => 1800000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Cypher',        'speed' => 121.50, 'acceleration' => 8.2, 'handling' => 8.5, 'braking' => 8.3, 'price' => 1550000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Karin Futo GTX',          'speed' => 118.50, 'acceleration' => 7.5, 'handling' => 8.8, 'braking' => 8.0, 'price' => 1590000, 'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Dominator GTX',     'speed' => 121.00, 'acceleration' => 7.8, 'handling' => 7.8, 'braking' => 7.5, 'price' => 725000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Dominator ASP',     'speed' => 122.50, 'acceleration' => 8.2, 'handling' => 8.0, 'braking' => 8.0, 'price' => 1775000, 'drivetrain' => 'RWD', 'seats' => 2 ),
            ),
        ),

        /* =============================================================
           MUSCLE
           ============================================================= */
        'muscle' => array(
            'label' => 'Muscle',
            'vehicles' => array(
                array( 'name' => 'Bravado Gauntlet Hellfire', 'speed' => 125.50, 'acceleration' => 8.0, 'handling' => 7.0, 'braking' => 7.2, 'price' => 745000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Pisswasser Dominator', 'speed' => 121.00, 'acceleration' => 7.5, 'handling' => 7.0, 'braking' => 7.0, 'price' => 315000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Dominator',          'speed' => 118.00, 'acceleration' => 7.2, 'handling' => 6.8, 'braking' => 6.8, 'price' => 35000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Dominator GT',       'speed' => 120.50, 'acceleration' => 7.8, 'handling' => 7.2, 'braking' => 7.0, 'price' => 725000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Gauntlet',         'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 6.8, 'braking' => 6.5, 'price' => 32000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Gauntlet Classic',  'speed' => 117.50, 'acceleration' => 7.2, 'handling' => 7.0, 'braking' => 6.8, 'price' => 615000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Buffalo STX',      'speed' => 122.50, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 7.8, 'price' => 2150000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Declasse Sabre Turbo',     'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 15000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Sabre Turbo Custom','speed' => 115.50, 'acceleration' => 7.2, 'handling' => 6.8, 'braking' => 6.7, 'price' => 83000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Albany Virgo',             'speed' => 113.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.3, 'price' => 195000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Albany Buccaneer',         'speed' => 113.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.2, 'price' => 29000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Albany Buccaneer Custom',  'speed' => 113.50, 'acceleration' => 6.7, 'handling' => 6.7, 'braking' => 6.4, 'price' => 390000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Blade',             'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 160000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Slamvan',           'speed' => 113.00, 'acceleration' => 6.5, 'handling' => 6.0, 'braking' => 6.0, 'price' => 12000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Vigero',         'speed' => 114.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 21000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Vigero ZX',      'speed' => 123.00, 'acceleration' => 8.2, 'handling' => 7.8, 'braking' => 7.8, 'price' => 1947000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Tampa',          'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 6.5, 'price' => 375000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Imponte Dukes',           'speed' => 116.00, 'acceleration' => 7.0, 'handling' => 6.8, 'braking' => 6.5, 'price' => 62000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Imponte Duke O\'Death',    'speed' => 117.00, 'acceleration' => 7.2, 'handling' => 6.5, 'braking' => 6.5, 'price' => 665000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Imponte Phoenix',         'speed' => 114.00, 'acceleration' => 6.8, 'handling' => 6.5, 'braking' => 6.3, 'price' => 5000,    'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Imponte Ruiner',          'speed' => 114.00, 'acceleration' => 6.8, 'handling' => 6.5, 'braking' => 6.3, 'price' => 10000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Imponte Nightshade',      'speed' => 114.50, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 585000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Tulip',          'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 718000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Vamos',          'speed' => 120.00, 'acceleration' => 7.5, 'handling' => 6.8, 'braking' => 6.5, 'price' => 596000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Impaler',        'speed' => 117.00, 'acceleration' => 7.2, 'handling' => 6.8, 'braking' => 6.5, 'price' => 331000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Clique',            'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 7.0, 'braking' => 6.8, 'price' => 909000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Ellie',             'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 6.8, 'price' => 565000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Schyster Deviant',        'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 7.5, 'braking' => 7.3, 'price' => 512000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Hustler',           'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 6.0, 'braking' => 6.0, 'price' => 625000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Peyote Gasser',     'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 6.0, 'braking' => 6.0, 'price' => 805000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Yosemite',       'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 485000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Rat-Truck',       'speed' => 108.00, 'acceleration' => 6.0, 'handling' => 5.5, 'braking' => 5.5, 'price' => 37500,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Willard Faction',         'speed' => 113.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.3, 'price' => 36000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Willard Faction Custom',  'speed' => 113.50, 'acceleration' => 6.7, 'handling' => 6.7, 'braking' => 6.5, 'price' => 335000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Imponte Beater Dukes',    'speed' => 114.00, 'acceleration' => 6.8, 'handling' => 6.3, 'braking' => 6.0, 'price' => 378000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Dominator GTT',     'speed' => 121.00, 'acceleration' => 7.8, 'handling' => 7.5, 'braking' => 7.3, 'price' => 1220000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Buffalo',         'speed' => 116.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 6.8, 'price' => 35000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Bravado Buffalo S',       'speed' => 117.00, 'acceleration' => 7.2, 'handling' => 7.2, 'braking' => 7.0, 'price' => 96000,   'drivetrain' => 'RWD', 'seats' => 4 ),
            ),
        ),
        /* =============================================================
           COUPES
           ============================================================= */
        'coupes' => array(
            'label' => 'Coupes',
            'vehicles' => array(
                array( 'name' => 'Enus Paragon R',          'speed' => 124.25, 'acceleration' => 8.0, 'handling' => 8.2, 'braking' => 8.0, 'price' => 905000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Enus Paragon R (Armored)','speed' => 122.00, 'acceleration' => 7.5, 'handling' => 7.8, 'braking' => 7.5, 'price' => 905000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Zion',          'speed' => 118.00, 'acceleration' => 7.2, 'handling' => 7.5, 'braking' => 7.3, 'price' => 60000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Zion Cabrio',   'speed' => 118.00, 'acceleration' => 7.2, 'handling' => 7.4, 'braking' => 7.2, 'price' => 65000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Felon',         'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 90000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Lampadati Felon GT',      'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.4, 'braking' => 7.2, 'price' => 95000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Dewbauchee Exemplar',     'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.3, 'braking' => 7.0, 'price' => 205000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Ocelot Jackal',           'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.3, 'braking' => 7.0, 'price' => 60000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Ocelot F620',             'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.2, 'braking' => 7.0, 'price' => 80000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Ubermacht Sentinel',      'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 95000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Sentinel XS',   'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 60000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Sentinel Classic','speed' => 117.50, 'acceleration' => 7.2, 'handling' => 7.5, 'braking' => 7.3, 'price' => 650000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Enus Cognoscenti Cabrio', 'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 185000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Enus Windsor',            'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 6.8, 'braking' => 6.8, 'price' => 845000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Enus Windsor Drop',       'speed' => 116.50, 'acceleration' => 6.8, 'handling' => 6.8, 'braking' => 6.8, 'price' => 900000,  'drivetrain' => 'RWD', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           SEDANS
           ============================================================= */
        'sedans' => array(
            'label' => 'Sedans',
            'vehicles' => array(
                array( 'name' => 'Benefactor Schafter LWB', 'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 115000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor Schafter V12 (Armored)','speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.3, 'braking' => 7.0, 'price' => 325000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Enus Cognoscenti 55',    'speed' => 116.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 7.0, 'price' => 154000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Enus Cognoscenti 55 (Armored)','speed' => 114.00, 'acceleration' => 6.5, 'handling' => 6.8, 'braking' => 6.8, 'price' => 310000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Enus Cognoscenti',       'speed' => 116.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 7.0, 'price' => 254000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Albany Emperor',          'speed' => 110.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 10000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Albany Washington',       'speed' => 115.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 15000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Stanier',           'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 6.0, 'price' => 10000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Karin Intruder',          'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 16000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Dundreary Regina',        'speed' => 110.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 5000,    'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vulcar Ingot',            'speed' => 110.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 9000,    'drivetrain' => 'FWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Chino',             'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 6.0, 'price' => 225000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Chino Custom',      'speed' => 112.50, 'acceleration' => 6.2, 'handling' => 6.2, 'braking' => 6.2, 'price' => 365000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Chariot Romero Hearse',   'speed' => 107.00, 'acceleration' => 5.0, 'handling' => 5.0, 'braking' => 5.0, 'price' => 45000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Oracle',        'speed' => 115.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 7.0, 'price' => 80000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Ubermacht Oracle XS',     'speed' => 115.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 7.0, 'price' => 82000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Obey Tailgater',          'speed' => 115.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 7.0, 'price' => 55000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Obey Tailgater S',        'speed' => 120.00, 'acceleration' => 7.8, 'handling' => 8.0, 'braking' => 7.8, 'price' => 1495000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor Glendale',     'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.2, 'braking' => 6.0, 'price' => 200000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Karin Previon',           'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 7.8, 'braking' => 7.5, 'price' => 1490000, 'drivetrain' => 'FWD', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           SPORTS CLASSICS
           ============================================================= */
        'sports_classics' => array(
            'label' => 'Sports Classics',
            'vehicles' => array(
                array( 'name' => 'Grotti Stinger GT',       'speed' => 117.50, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 875000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Stinger',          'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.3, 'braking' => 7.0, 'price' => 850000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Monroe',          'speed' => 116.50, 'acceleration' => 6.8, 'handling' => 7.2, 'braking' => 7.0, 'price' => 490000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti GT500',            'speed' => 118.50, 'acceleration' => 7.2, 'handling' => 7.5, 'braking' => 7.3, 'price' => 785000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Grotti Cheetah Classic',  'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 865000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Torero',          'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 998000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Viseris',       'speed' => 123.75, 'acceleration' => 7.5, 'handling' => 7.0, 'braking' => 7.0, 'price' => 875000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ocelot Swinger',          'speed' => 117.50, 'acceleration' => 7.2, 'handling' => 7.5, 'braking' => 7.3, 'price' => 909000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dewbauchee Rapid GT Classic','speed' => 119.00, 'acceleration' => 7.2, 'handling' => 7.5, 'braking' => 7.3, 'price' => 885000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Casco',         'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 680000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Infernus Classic','speed' => 117.50, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.0, 'price' => 915000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Invetero Coquette Classic','speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.2, 'braking' => 7.0, 'price' => 665000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Mamba',          'speed' => 118.00, 'acceleration' => 7.2, 'handling' => 6.5, 'braking' => 6.5, 'price' => 995000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Tornado',        'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 6.0, 'braking' => 5.5, 'price' => 30000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Albany Manana',           'speed' => 106.00, 'acceleration' => 5.0, 'handling' => 5.5, 'braking' => 5.5, 'price' => 10000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Peyote',            'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 38000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dewbauchee JB 700',       'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 350000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor Stirling GT',  'speed' => 120.50, 'acceleration' => 7.5, 'handling' => 7.8, 'braking' => 7.5, 'price' => 975000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Lampadati Michelli GT',   'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.3, 'braking' => 7.0, 'price' => 1225000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ocelot Ardent',           'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 1150000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Retinue',           'speed' => 115.00, 'acceleration' => 6.5, 'handling' => 7.0, 'braking' => 6.8, 'price' => 615000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Retinue Mk II',     'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.3, 'braking' => 7.0, 'price' => 1620000, 'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Declasse Tornado Custom', 'speed' => 110.00, 'acceleration' => 5.8, 'handling' => 6.2, 'braking' => 5.8, 'price' => 375000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Clique',            'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 7.0, 'braking' => 6.8, 'price' => 909000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Ubermacht Zion Classic',  'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 812000,  'drivetrain' => 'RWD', 'seats' => 2 ),
            ),
        ),

        /* =============================================================
           COMPACTS
           ============================================================= */
        'compacts' => array(
            'label' => 'Compacts',
            'vehicles' => array(
                array( 'name' => 'Dinka Blista',            'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.5, 'braking' => 7.0, 'price' => 8000,    'drivetrain' => 'FWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Blista Kanjo',      'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 7.8, 'braking' => 7.5, 'price' => 580000,  'drivetrain' => 'FWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Blista Compact',    'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.5, 'braking' => 7.0, 'price' => 42000,   'drivetrain' => 'FWD', 'seats' => 2 ),
                array( 'name' => 'Bollokan Prairie',        'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.0, 'braking' => 7.0, 'price' => 4000,    'drivetrain' => 'FWD', 'seats' => 4 ),
                array( 'name' => 'Weeny Issi',              'speed' => 108.00, 'acceleration' => 6.0, 'handling' => 7.5, 'braking' => 7.5, 'price' => 18000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Weeny Issi Classic',      'speed' => 110.00, 'acceleration' => 6.2, 'handling' => 7.8, 'braking' => 7.5, 'price' => 360000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Weeny Issi Sport',        'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.8, 'braking' => 7.5, 'price' => 897000,  'drivetrain' => 'FWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Rhapsody',       'speed' => 108.00, 'acceleration' => 6.0, 'handling' => 7.0, 'braking' => 6.8, 'price' => 120000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'BF Club',                 'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.8, 'braking' => 7.5, 'price' => 1280000, 'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Karin Dilettante',        'speed' => 105.00, 'acceleration' => 5.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 25000,   'drivetrain' => 'FWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor Panto',        'speed' => 108.00, 'acceleration' => 6.0, 'handling' => 7.5, 'braking' => 7.5, 'price' => 85000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Sugoi',             'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.3, 'price' => 1224000, 'drivetrain' => 'FWD', 'seats' => 4 ),
                array( 'name' => 'Vulcar Warrener HKR',     'speed' => 114.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.0, 'price' => 1380000, 'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Karin Club',              'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.8, 'braking' => 7.5, 'price' => 1280000, 'drivetrain' => 'RWD', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           SUVs
           ============================================================= */
        'suvs' => array(
            'label' => 'SUVs',
            'vehicles' => array(
                array( 'name' => 'Pegassi Toros',           'speed' => 127.75, 'acceleration' => 8.5, 'handling' => 7.5, 'braking' => 7.8, 'price' => 498000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Ubermacht Rebla GTS',     'speed' => 121.50, 'acceleration' => 7.8, 'handling' => 7.8, 'braking' => 7.5, 'price' => 1175000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor XLS',          'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 253000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor XLS (Armored)','speed' => 115.00, 'acceleration' => 6.5, 'handling' => 6.8, 'braking' => 6.8, 'price' => 490000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Enus Huntley S',          'speed' => 116.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 195000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Gallivanter Baller',      'speed' => 116.00, 'acceleration' => 6.8, 'handling' => 6.8, 'braking' => 6.8, 'price' => 90000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Gallivanter Baller LE',   'speed' => 116.50, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 120000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Gallivanter Baller ST',   'speed' => 120.00, 'acceleration' => 7.5, 'handling' => 7.5, 'braking' => 7.5, 'price' => 890000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Obey Rocoto',             'speed' => 115.00, 'acceleration' => 6.8, 'handling' => 6.8, 'braking' => 6.8, 'price' => 85000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Contender',         'speed' => 116.00, 'acceleration' => 6.8, 'handling' => 6.5, 'braking' => 6.5, 'price' => 250000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Canis Seminole',          'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 30000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Canis Seminole Frontier',  'speed' => 112.50, 'acceleration' => 6.2, 'handling' => 6.5, 'braking' => 6.2, 'price' => 678000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Dundreary Landstalker',   'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 6.0, 'price' => 58000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Dundreary Landstalker XL', 'speed' => 115.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 1220000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Karin BeeJay XL',         'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 27000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Mammoth Patriot',         'speed' => 113.00, 'acceleration' => 6.2, 'handling' => 6.0, 'braking' => 6.0, 'price' => 40000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Albany Cavalcade',         'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 6.0, 'price' => 60000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Radius',            'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 32000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor Dubsta',       'speed' => 115.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 110000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Benefactor Dubsta 6x6',   'speed' => 113.00, 'acceleration' => 6.2, 'handling' => 7.0, 'braking' => 7.0, 'price' => 249000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Grotti Brioso 300',       'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.5, 'braking' => 7.0, 'price' => 610000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Karin Everon',            'speed' => 112.00, 'acceleration' => 6.5, 'handling' => 7.0, 'braking' => 6.8, 'price' => 1475000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Lampadati Novak',         'speed' => 115.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 608000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Ocelot Ardent',           'speed' => 117.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 1150000, 'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Vapid FQ 2',              'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 27500,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Caracara',          'speed' => 113.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 875000,  'drivetrain' => 'AWD', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           OFF-ROAD
           ============================================================= */
        'offroad' => array(
            'label' => 'Off-Road',
            'vehicles' => array(
                array( 'name' => 'Coil Brawler',           'speed' => 120.00, 'acceleration' => 7.5, 'handling' => 7.5, 'braking' => 7.0, 'price' => 715000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Trophy Truck',     'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.0, 'price' => 550000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Desert Raid',      'speed' => 116.00, 'acceleration' => 6.8, 'handling' => 7.5, 'braking' => 7.0, 'price' => 695000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Benefactor Dubsta 6x6',  'speed' => 113.00, 'acceleration' => 6.2, 'handling' => 7.0, 'braking' => 7.0, 'price' => 249000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Karin Rebel',            'speed' => 110.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 3000,    'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Karin Rebel (Custom)',   'speed' => 112.00, 'acceleration' => 6.2, 'handling' => 6.8, 'braking' => 6.2, 'price' => 108000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'BF Injection',           'speed' => 109.00, 'acceleration' => 6.0, 'handling' => 7.0, 'braking' => 6.5, 'price' => 16000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Canis Bodhi',            'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 6.0, 'braking' => 5.5, 'price' => 5000,    'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Canis Mesa',             'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 32000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Canis Kamacho',          'speed' => 115.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 7.0, 'price' => 345000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Canis Freecrawler',      'speed' => 110.00, 'acceleration' => 6.2, 'handling' => 7.0, 'braking' => 6.5, 'price' => 597000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Rancher XL',    'speed' => 110.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 30000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Sandking XL',      'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 6.0, 'price' => 38000,   'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Sandking SWB',     'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 6.0, 'price' => 40000,   'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Duneloader',     'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 6.0, 'braking' => 5.5, 'price' => 32000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Nagasaki Blazer',        'speed' => 106.00, 'acceleration' => 7.5, 'handling' => 6.5, 'braking' => 6.0, 'price' => 8000,    'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'BF Bifta',               'speed' => 110.00, 'acceleration' => 6.0, 'handling' => 7.0, 'braking' => 6.5, 'price' => 75000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dune Buggy',             'speed' => 108.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 6.0, 'price' => 20000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Maxwell Vagrant',        'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 7.0, 'price' => 2203000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Caracara 4x4',     'speed' => 115.00, 'acceleration' => 6.8, 'handling' => 7.0, 'braking' => 6.8, 'price' => 665000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Declasse Brutus',        'speed' => 115.00, 'acceleration' => 6.5, 'handling' => 6.0, 'braking' => 6.0, 'price' => 985000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Bravado Sasquatch',      'speed' => 110.00, 'acceleration' => 6.2, 'handling' => 5.5, 'braking' => 5.5, 'price' => 990000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Annis Hellion',          'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 6.8, 'braking' => 6.5, 'price' => 735000,  'drivetrain' => 'AWD', 'seats' => 4 ),
                array( 'name' => 'Maxwell Outlaw',         'speed' => 120.00, 'acceleration' => 7.5, 'handling' => 7.0, 'braking' => 7.0, 'price' => 1268000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Riata',            'speed' => 113.00, 'acceleration' => 6.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 380000,  'drivetrain' => 'AWD', 'seats' => 4 ),
            ),
        ),
        /* =============================================================
           MOTORCYCLES
           ============================================================= */
        'motorcycles' => array(
            'label' => 'Motorcycles',
            'vehicles' => array(
                array( 'name' => 'Pegassi Bati 801',       'speed' => 135.00, 'acceleration' => 9.5, 'handling' => 8.5, 'braking' => 8.0, 'price' => 15000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Bati 801RR',     'speed' => 135.00, 'acceleration' => 9.5, 'handling' => 8.5, 'braking' => 8.0, 'price' => 15000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Shitzu Hakuchou Drag',   'speed' => 141.25, 'acceleration' => 9.0, 'handling' => 7.5, 'braking' => 7.5, 'price' => 976000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Shitzu Hakuchou',        'speed' => 134.00, 'acceleration' => 9.0, 'handling' => 8.0, 'braking' => 7.8, 'price' => 82000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Western Shotaro',        'speed' => 131.00, 'acceleration' => 9.5, 'handling' => 9.0, 'braking' => 8.5, 'price' => 2225000, 'drivetrain' => 'RWD', 'seats' => 1 ),
                array( 'name' => 'Nagasaki Shotaro',       'speed' => 131.00, 'acceleration' => 9.5, 'handling' => 9.0, 'braking' => 8.5, 'price' => 2225000, 'drivetrain' => 'RWD', 'seats' => 1 ),
                array( 'name' => 'Principe Lectro',        'speed' => 130.00, 'acceleration' => 9.0, 'handling' => 8.5, 'braking' => 8.0, 'price' => 700000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Principe Nemesis',       'speed' => 130.00, 'acceleration' => 9.0, 'handling' => 8.5, 'braking' => 8.0, 'price' => 12000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Double-T',         'speed' => 131.50, 'acceleration' => 9.0, 'handling' => 8.0, 'braking' => 7.8, 'price' => 12000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Akuma',            'speed' => 130.00, 'acceleration' => 9.5, 'handling' => 8.5, 'braking' => 8.0, 'price' => 9000,    'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Vindicator',       'speed' => 130.00, 'acceleration' => 9.0, 'handling' => 8.5, 'braking' => 8.0, 'price' => 630000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Esskey',         'speed' => 118.00, 'acceleration' => 8.0, 'handling' => 7.5, 'braking' => 7.0, 'price' => 269000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Nagasaki Carbon RS',     'speed' => 130.00, 'acceleration' => 9.0, 'handling' => 8.5, 'braking' => 8.0, 'price' => 40000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Maibatsu Sanchez',       'speed' => 118.00, 'acceleration' => 8.5, 'handling' => 8.0, 'braking' => 7.5, 'price' => 7000,    'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Western Zombie Chopper',  'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 122000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Western Daemon',         'speed' => 118.00, 'acceleration' => 7.5, 'handling' => 6.5, 'braking' => 6.5, 'price' => 12500,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Western Bagger',         'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 20000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'LCC Hexer',              'speed' => 116.00, 'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 6.5, 'price' => 15000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'LCC Innovation',         'speed' => 120.00, 'acceleration' => 7.5, 'handling' => 6.8, 'braking' => 6.5, 'price' => 925000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Oppressor',      'speed' => 140.00, 'acceleration' => 9.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 3524500, 'drivetrain' => 'RWD', 'seats' => 1 ),
                array( 'name' => 'Pegassi Oppressor Mk II','speed' => 130.00, 'acceleration' => 9.5, 'handling' => 8.0, 'braking' => 7.5, 'price' => 3890250, 'drivetrain' => 'RWD', 'seats' => 1 ),
                array( 'name' => 'Western Reever',         'speed' => 133.00, 'acceleration' => 9.2, 'handling' => 8.0, 'braking' => 7.8, 'price' => 1900000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Shinobi',          'speed' => 130.50, 'acceleration' => 9.5, 'handling' => 8.8, 'braking' => 8.5, 'price' => 2480000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Nagasaki BF400',         'speed' => 125.00, 'acceleration' => 8.5, 'handling' => 8.0, 'braking' => 7.5, 'price' => 95000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Pegassi Vortex',         'speed' => 126.00, 'acceleration' => 8.5, 'handling' => 8.0, 'braking' => 7.8, 'price' => 353000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Dinka Enduro',           'speed' => 118.00, 'acceleration' => 8.0, 'handling' => 7.5, 'braking' => 7.0, 'price' => 48000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Principe Diabolus',      'speed' => 120.00, 'acceleration' => 8.0, 'handling' => 7.5, 'braking' => 7.5, 'price' => 169000,  'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Nagasaki Stryder',       'speed' => 121.00, 'acceleration' => 8.5, 'handling' => 8.0, 'braking' => 7.5, 'price' => 502000,  'drivetrain' => 'RWD', 'seats' => 1 ),
            ),
        ),

        /* =============================================================
           VANS
           ============================================================= */
        'vans' => array(
            'label' => 'Vans',
            'vehicles' => array(
                array( 'name' => 'Bravado Youga',           'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 16000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Bravado Youga Classic',   'speed' => 110.00, 'acceleration' => 5.8, 'handling' => 5.5, 'braking' => 5.5, 'price' => 195000,  'drivetrain' => 'RWD', 'seats' => 10 ),
                array( 'name' => 'Bravado Rumpo',           'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 13000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Speedo',            'speed' => 106.00, 'acceleration' => 5.0, 'handling' => 5.0, 'braking' => 5.0, 'price' => 12000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Speedo Custom',     'speed' => 112.00, 'acceleration' => 6.0, 'handling' => 5.5, 'braking' => 5.5, 'price' => 395000,  'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'BF Surfer',               'speed' => 105.00, 'acceleration' => 5.0, 'handling' => 5.5, 'braking' => 5.0, 'price' => 23000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Declasse Burrito',        'speed' => 106.00, 'acceleration' => 5.5, 'handling' => 5.0, 'braking' => 5.0, 'price' => 12000,   'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Minivan',           'speed' => 107.00, 'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 5.5, 'price' => 30000,   'drivetrain' => 'FWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Minivan Custom',    'speed' => 109.00, 'acceleration' => 5.8, 'handling' => 5.8, 'braking' => 5.5, 'price' => 294000,  'drivetrain' => 'FWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Gang Burrito',      'speed' => 108.00, 'acceleration' => 5.5, 'handling' => 5.0, 'braking' => 5.0, 'price' => 65000,   'drivetrain' => 'RWD', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           BOATS
           ============================================================= */
        'boats' => array(
            'label' => 'Boats',
            'vehicles' => array(
                array( 'name' => 'Shitzu Longfin',         'speed' => 82.00,  'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 4.0, 'price' => 2125000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Lampadati Toro',         'speed' => 80.00,  'acceleration' => 6.5, 'handling' => 6.0, 'braking' => 4.0, 'price' => 1750000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Pegassi Speeder',        'speed' => 75.00,  'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 3.5, 'price' => 325000,  'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Dinka Marquis',          'speed' => 45.00,  'acceleration' => 3.0, 'handling' => 3.5, 'braking' => 2.0, 'price' => 413000,  'drivetrain' => 'N/A', 'seats' => 10 ),
                array( 'name' => 'Speedophile Seashark',   'speed' => 68.00,  'acceleration' => 8.0, 'handling' => 7.0, 'braking' => 4.0, 'price' => 16899,   'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Shitzu Tropic',          'speed' => 60.00,  'acceleration' => 5.5, 'handling' => 5.5, 'braking' => 3.0, 'price' => 22000,   'drivetrain' => 'N/A', 'seats' => 6 ),
                array( 'name' => 'Shitzu Jetmax',          'speed' => 78.00,  'acceleration' => 7.0, 'handling' => 6.5, 'braking' => 3.5, 'price' => 299000,  'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Shitzu Suntrap',         'speed' => 55.00,  'acceleration' => 5.0, 'handling' => 5.0, 'braking' => 3.0, 'price' => 23000,   'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Dinka Avisa',            'speed' => 55.00,  'acceleration' => 5.0, 'handling' => 5.0, 'braking' => 3.0, 'price' => 1545000, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Kraken Kosatka',         'speed' => 40.00,  'acceleration' => 2.0, 'handling' => 3.0, 'braking' => 2.0, 'price' => 2200000, 'drivetrain' => 'N/A', 'seats' => 6 ),
                array( 'name' => 'Nagasaki Dinghy',        'speed' => 60.00,  'acceleration' => 6.5, 'handling' => 6.0, 'braking' => 3.5, 'price' => 125000,  'drivetrain' => 'N/A', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           HELICOPTERS
           ============================================================= */
        'helicopters' => array(
            'label' => 'Helicopters',
            'vehicles' => array(
                array( 'name' => 'Buckingham Swift',        'speed' => 158.75, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 5.0, 'price' => 1500000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Buckingham Swift Deluxe', 'speed' => 158.75, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 5.0, 'price' => 1650000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Buckingham Volatus',      'speed' => 155.00, 'acceleration' => 6.5, 'handling' => 7.5, 'braking' => 5.0, 'price' => 2295000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Buckingham SuperVolito',  'speed' => 155.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 5.0, 'price' => 2113000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Western Buzzard',         'speed' => 152.50, 'acceleration' => 6.5, 'handling' => 8.0, 'braking' => 5.0, 'price' => 1750000, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'FH-1 Hunter',            'speed' => 152.50, 'acceleration' => 6.5, 'handling' => 7.5, 'braking' => 5.0, 'price' => 4123000, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Nagasaki Havok',         'speed' => 150.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 5.0, 'price' => 2300900, 'drivetrain' => 'N/A', 'seats' => 1 ),
                array( 'name' => 'Savage',                 'speed' => 147.50, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 4.5, 'price' => 2593500, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Sparrow',                'speed' => 153.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 5.0, 'price' => 1815000, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Maibatsu Frogger',       'speed' => 150.00, 'acceleration' => 6.5, 'handling' => 7.5, 'braking' => 5.0, 'price' => 1300000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Buckingham Maverick',    'speed' => 148.00, 'acceleration' => 6.5, 'handling' => 7.0, 'braking' => 5.0, 'price' => 780000,  'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Nagasaki Buzzard',       'speed' => 152.50, 'acceleration' => 6.5, 'handling' => 8.0, 'braking' => 5.0, 'price' => 1750000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Western Cargobob',       'speed' => 108.50, 'acceleration' => 4.0, 'handling' => 5.0, 'braking' => 3.5, 'price' => 1790000, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Buckingham Akula',       'speed' => 155.00, 'acceleration' => 7.0, 'handling' => 7.5, 'braking' => 5.0, 'price' => 3704050, 'drivetrain' => 'N/A', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           PLANES
           ============================================================= */
        'planes' => array(
            'label' => 'Planes',
            'vehicles' => array(
                array( 'name' => 'Buckingham Pyro',        'speed' => 222.75, 'acceleration' => 8.0, 'handling' => 8.5, 'braking' => 5.0, 'price' => 4455500, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Western Rogue',          'speed' => 219.00, 'acceleration' => 7.5, 'handling' => 8.0, 'braking' => 5.0, 'price' => 1596000, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'V-65 Molotok',           'speed' => 217.00, 'acceleration' => 8.0, 'handling' => 8.0, 'braking' => 5.0, 'price' => 4788000, 'drivetrain' => 'N/A', 'seats' => 1 ),
                array( 'name' => 'P-996 LAZER',            'speed' => 195.00, 'acceleration' => 9.0, 'handling' => 9.0, 'braking' => 5.0, 'price' => 6500000, 'drivetrain' => 'N/A', 'seats' => 1 ),
                array( 'name' => 'Jobuilt P-45 Nokota',    'speed' => 209.00, 'acceleration' => 7.5, 'handling' => 8.0, 'braking' => 5.0, 'price' => 2653350, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Buckingham Alpha-Z1',    'speed' => 200.00, 'acceleration' => 7.5, 'handling' => 8.0, 'braking' => 5.0, 'price' => 2121350, 'drivetrain' => 'N/A', 'seats' => 1 ),
                array( 'name' => 'Mammoth Hydra',          'speed' => 209.25, 'acceleration' => 8.5, 'handling' => 8.5, 'braking' => 5.0, 'price' => 3990000, 'drivetrain' => 'N/A', 'seats' => 1 ),
                array( 'name' => 'B-11 Strikeforce',       'speed' => 195.50, 'acceleration' => 7.0, 'handling' => 9.0, 'braking' => 5.0, 'price' => 3800000, 'drivetrain' => 'N/A', 'seats' => 1 ),
                array( 'name' => 'Buckingham Luxor',       'speed' => 180.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 4.5, 'price' => 1625000, 'drivetrain' => 'N/A', 'seats' => 10 ),
                array( 'name' => 'Buckingham Luxor Deluxe', 'speed' => 180.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 4.5, 'price' => 10000000,'drivetrain' => 'N/A', 'seats' => 10 ),
                array( 'name' => 'Mammoth Dodo',           'speed' => 100.00, 'acceleration' => 4.0, 'handling' => 5.0, 'braking' => 3.5, 'price' => 500000,  'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Jobuilt Velum',          'speed' => 118.00, 'acceleration' => 5.0, 'handling' => 6.0, 'braking' => 4.0, 'price' => 1323350, 'drivetrain' => 'N/A', 'seats' => 4 ),
                array( 'name' => 'Western Besra',          'speed' => 195.00, 'acceleration' => 7.5, 'handling' => 8.5, 'braking' => 5.0, 'price' => 1150000, 'drivetrain' => 'N/A', 'seats' => 2 ),
                array( 'name' => 'Buckingham Miljet',      'speed' => 168.00, 'acceleration' => 6.0, 'handling' => 6.5, 'braking' => 4.5, 'price' => 1700000, 'drivetrain' => 'N/A', 'seats' => 10 ),
                array( 'name' => 'Mammoth Avenger',        'speed' => 155.00, 'acceleration' => 6.0, 'handling' => 6.0, 'braking' => 4.0, 'price' => 3450000, 'drivetrain' => 'N/A', 'seats' => 4 ),
            ),
        ),

        /* =============================================================
           UTILITY & COMMERCIAL
           ============================================================= */
        'utility' => array(
            'label' => 'Utility & Commercial',
            'vehicles' => array(
                array( 'name' => 'HVY Brickade',           'speed' => 98.00,  'acceleration' => 4.0, 'handling' => 4.0, 'braking' => 4.0, 'price' => 1110000, 'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'HVY Mule',               'speed' => 95.00,  'acceleration' => 3.5, 'handling' => 4.0, 'braking' => 3.5, 'price' => 38000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Brute Stockade',         'speed' => 100.00, 'acceleration' => 4.0, 'handling' => 4.0, 'braking' => 4.0, 'price' => 45000,   'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Brute Tipper',           'speed' => 90.00,  'acceleration' => 3.0, 'handling' => 3.5, 'braking' => 3.0, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Brute Bus',              'speed' => 95.00,  'acceleration' => 3.0, 'handling' => 3.5, 'braking' => 3.0, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 16 ),
                array( 'name' => 'JoBuilt Hauler',         'speed' => 98.00,  'acceleration' => 3.5, 'handling' => 3.5, 'braking' => 3.0, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'JoBuilt Phantom',        'speed' => 100.00, 'acceleration' => 3.5, 'handling' => 3.5, 'braking' => 3.0, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'MTL Flatbed',            'speed' => 90.00,  'acceleration' => 3.0, 'handling' => 3.0, 'braking' => 3.0, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 2 ),
                array( 'name' => 'Vapid Guardian',         'speed' => 105.00, 'acceleration' => 5.0, 'handling' => 5.5, 'braking' => 5.0, 'price' => 375000,  'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'MTL Brickade 6x6',       'speed' => 105.00, 'acceleration' => 4.5, 'handling' => 5.0, 'braking' => 4.5, 'price' => 1500000, 'drivetrain' => 'AWD', 'seats' => 2 ),
                array( 'name' => 'Brute Ambulance',        'speed' => 105.00, 'acceleration' => 4.5, 'handling' => 5.0, 'braking' => 4.5, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 4 ),
                array( 'name' => 'Vapid Police Cruiser',   'speed' => 118.00, 'acceleration' => 7.0, 'handling' => 7.0, 'braking' => 7.0, 'price' => 0,       'drivetrain' => 'RWD', 'seats' => 4 ),
            ),
        ),
    );
}

/**
 * Seed vehicle content — creates database, ranking, and profile posts.
 */
function gtalobby_seed_vehicle_content() {
    if ( ! function_exists( 'wp_insert_post' ) ) {
        return;
    }

    // Check if vehicle content was already seeded
    if ( get_option( 'gtalobby_vehicles_seeded' ) ) {
        return;
    }

    $all_vehicles = gtalobby_get_vehicle_database();
    $cars_cat     = get_category_by_slug( 'cars' );
    if ( ! $cars_cat ) {
        return;
    }
    $cars_cat_id = $cars_cat->term_id;
    $author_id   = get_current_user_id() ?: 1;

    // Count total vehicles
    $total = 0;
    foreach ( $all_vehicles as $class_data ) {
        $total += count( $class_data['vehicles'] );
    }

    /* ----------------------------------------------------------
       1. Create the master DATABASE post — all vehicles in one table
       ---------------------------------------------------------- */
    $table_headers = array(
        array( 'column_name' => 'Vehicle', 'sortable' => true, 'data_type' => 'text' ),
        array( 'column_name' => 'Class', 'sortable' => true, 'data_type' => 'text' ),
        array( 'column_name' => 'Top Speed (mph)', 'sortable' => true, 'data_type' => 'number' ),
        array( 'column_name' => 'Acceleration', 'sortable' => true, 'data_type' => 'number' ),
        array( 'column_name' => 'Handling', 'sortable' => true, 'data_type' => 'number' ),
        array( 'column_name' => 'Braking', 'sortable' => true, 'data_type' => 'number' ),
        array( 'column_name' => 'Price ($)', 'sortable' => true, 'data_type' => 'number' ),
        array( 'column_name' => 'Drivetrain', 'sortable' => true, 'data_type' => 'text' ),
    );

    $table_data = array();
    foreach ( $all_vehicles as $class_slug => $class_data ) {
        foreach ( $class_data['vehicles'] as $v ) {
            $table_data[] = array(
                'row_values' => implode( '|', array(
                    $v['name'],
                    $class_data['label'],
                    $v['speed'],
                    $v['acceleration'],
                    $v['handling'],
                    $v['braking'],
                    number_format( $v['price'] ),
                    $v['drivetrain'],
                ) ),
            );
        }
    }

    $db_content = '<!-- wp:heading -->' . "\n" . '<h2>Complete GTA 5 Vehicle Database</h2>' . "\n" . '<!-- /wp:heading -->' . "\n\n";
    $db_content .= '<!-- wp:paragraph -->' . "\n" . '<p>This comprehensive database contains every vehicle available in GTA 5 and GTA Online, with real tested stats including top speed, acceleration, handling, braking, price, and drivetrain type. Use the sortable table above to find the perfect vehicle for any situation — whether you need the fastest supercar for racing, the best handling sports car for corners, or a reliable off-roader for rough terrain.</p>' . "\n" . '<!-- /wp:paragraph -->' . "\n\n";

    foreach ( $all_vehicles as $class_slug => $class_data ) {
        $db_content .= '<!-- wp:heading -->' . "\n" . '<h2>' . $class_data['label'] . ' (' . count( $class_data['vehicles'] ) . ' vehicles)</h2>' . "\n" . '<!-- /wp:heading -->' . "\n\n";

        // Sort by speed desc
        $sorted = $class_data['vehicles'];
        usort( $sorted, function( $a, $b ) {
            return $b['speed'] <=> $a['speed'];
        } );

        $db_content .= '<!-- wp:paragraph -->' . "\n" . '<p>The ' . strtolower( $class_data['label'] ) . ' class features ' . count( $sorted ) . ' vehicles. The fastest is the <strong>' . $sorted[0]['name'] . '</strong> at ' . $sorted[0]['speed'] . ' mph';
        if ( count( $sorted ) > 1 ) {
            $db_content .= ', followed by the <strong>' . $sorted[1]['name'] . '</strong> at ' . $sorted[1]['speed'] . ' mph';
        }
        $db_content .= '.</p>' . "\n" . '<!-- /wp:paragraph -->' . "\n\n";
    }

    $database_id = wp_insert_post( array(
        'post_title'    => 'Every GTA 5 Vehicle — Complete Database with Speed, Stats & Prices (' . $total . '+ Vehicles)',
        'post_content'  => $db_content,
        'post_excerpt'  => 'The complete GTA 5 vehicle database with every car, bike, boat, helicopter, and plane. Sortable by top speed, acceleration, handling, braking, and price.',
        'post_status'   => 'publish',
        'post_type'     => 'database',
        'post_author'   => $author_id,
        'post_category' => array( $cars_cat_id ),
    ), true );

    if ( ! is_wp_error( $database_id ) && $database_id ) {
        wp_set_post_terms( $database_id, array( $cars_cat_id ), 'category', false );
        if ( function_exists( 'gtalobby_get_seed_image_url' ) ) {
            $cars_img = gtalobby_get_seed_image_url( 'cars' );
            if ( $cars_img ) {
                gtalobby_set_featured_image_from_url( $database_id, $cars_img, 'GTA 5 Vehicle Database' );
            }
        }
        update_post_meta( $database_id, 'data_source', 'Broughy1322 testing data + GTA Wiki + in-game testing' );
        update_post_meta( $database_id, 'data_last_updated', gmdate( 'Y-m-d' ) );
        update_post_meta( $database_id, 'column_headers', $table_headers );
        update_post_meta( $database_id, 'table_data', $table_data );
    }

    /* ----------------------------------------------------------
       2. Create RANKING posts — fastest vehicles per class
       ---------------------------------------------------------- */
    $ranking_classes = array( 'supercars', 'sports', 'muscle', 'motorcycles', 'sports_classics' );
    foreach ( $ranking_classes as $class_slug ) {
        if ( ! isset( $all_vehicles[ $class_slug ] ) ) continue;
        $class_data = $all_vehicles[ $class_slug ];
        $sorted     = $class_data['vehicles'];
        usort( $sorted, function( $a, $b ) { return $b['speed'] <=> $a['speed']; } );
        $top = array_slice( $sorted, 0, min( 20, count( $sorted ) ) );

        $ranked_items = array();
        foreach ( $top as $i => $v ) {
            $ranked_items[] = array(
                'rank'        => $i + 1,
                'name'        => $v['name'],
                'score'       => round( ( $v['speed'] / 145 ) * 10, 1 ),
                'description' => sprintf(
                    'Top speed: %s mph | Acceleration: %s/10 | Handling: %s/10 | Price: $%s | Drivetrain: %s',
                    $v['speed'], $v['acceleration'], $v['handling'], number_format( $v['price'] ), $v['drivetrain']
                ),
                'pros'        => $v['speed'] > 125 ? 'Excellent top speed' : 'Good value for money',
                'cons'        => $v['handling'] < 7.5 ? 'Challenging handling' : 'Expensive price tag',
            );
        }

        $ranking_content = '<!-- wp:paragraph -->' . "\n" . '<p>Here are the fastest ' . strtolower( $class_data['label'] ) . ' in GTA 5 and GTA Online, ranked by real tested top speed. All speeds are based on in-game testing by the community.</p>' . "\n" . '<!-- /wp:paragraph -->';

        $ranking_id = wp_insert_post( array(
            'post_title'    => 'Fastest ' . $class_data['label'] . ' in GTA 5 Online — Top Speed Rankings ' . gmdate( 'Y' ),
            'post_content'  => $ranking_content,
            'post_excerpt'  => 'Complete ranking of the fastest ' . strtolower( $class_data['label'] ) . ' in GTA 5 Online by top speed, with prices and stats.',
            'post_status'   => 'publish',
            'post_type'     => 'ranking',
            'post_author'   => $author_id,
            'post_category' => array( $cars_cat_id ),
        ), true );

        if ( ! is_wp_error( $ranking_id ) && $ranking_id ) {
            wp_set_post_terms( $ranking_id, array( $cars_cat_id ), 'category', false );
            update_post_meta( $ranking_id, 'ranking_criteria', 'Ranked by real tested top speed (mph) in GTA 5/GTA Online.' );
            update_post_meta( $ranking_id, 'total_items', count( $top ) );
            update_post_meta( $ranking_id, 'ranked_items', $ranked_items );

            // Assign vehicle_class taxonomy
            $tax_slug = str_replace( '_', '-', $class_slug );
            $term = get_term_by( 'slug', $tax_slug, 'vehicle_class' );
            if ( $term ) {
                wp_set_post_terms( $ranking_id, array( $term->term_id ), 'vehicle_class', false );
            }
        }
    }

    /* ----------------------------------------------------------
       3. Create PROFILE posts for top 3 vehicles per major class
       ---------------------------------------------------------- */
    $profile_classes = array( 'supercars', 'sports', 'muscle', 'motorcycles' );
    foreach ( $profile_classes as $class_slug ) {
        if ( ! isset( $all_vehicles[ $class_slug ] ) ) continue;
        $class_data = $all_vehicles[ $class_slug ];
        $sorted     = $class_data['vehicles'];
        usort( $sorted, function( $a, $b ) { return $b['speed'] <=> $a['speed']; } );
        $top3 = array_slice( $sorted, 0, 3 );

        foreach ( $top3 as $v ) {
            $profile_content = '<!-- wp:heading -->' . "\n" . '<h2>Overview</h2>' . "\n" . '<!-- /wp:heading -->' . "\n\n";
            $profile_content .= '<!-- wp:paragraph -->' . "\n" . '<p>The ' . $v['name'] . ' is a ' . strtolower( $class_data['label'] ) . ' class vehicle in GTA 5 and GTA Online. With a top speed of ' . $v['speed'] . ' mph and ' . $v['drivetrain'] . ' drivetrain, it is one of the top performers in its class.</p>' . "\n" . '<!-- /wp:paragraph -->' . "\n\n";
            $profile_content .= '<!-- wp:heading -->' . "\n" . '<h2>Performance</h2>' . "\n" . '<!-- /wp:heading -->' . "\n\n";
            $profile_content .= '<!-- wp:paragraph -->' . "\n" . '<p>Acceleration: ' . $v['acceleration'] . '/10 | Handling: ' . $v['handling'] . '/10 | Braking: ' . $v['braking'] . '/10</p>' . "\n" . '<!-- /wp:paragraph -->';

            $stats = array(
                array( 'stat_name' => 'Top Speed', 'stat_value' => $v['speed'] . ' mph', 'stat_bar' => min( 100, round( ( $v['speed'] / 145 ) * 100 ) ) ),
                array( 'stat_name' => 'Acceleration', 'stat_value' => $v['acceleration'] . '/10', 'stat_bar' => $v['acceleration'] * 10 ),
                array( 'stat_name' => 'Handling', 'stat_value' => $v['handling'] . '/10', 'stat_bar' => $v['handling'] * 10 ),
                array( 'stat_name' => 'Braking', 'stat_value' => $v['braking'] . '/10', 'stat_bar' => $v['braking'] * 10 ),
            );

            $profile_id = wp_insert_post( array(
                'post_title'    => $v['name'] . ' — GTA 5 Vehicle Stats, Top Speed & Price',
                'post_content'  => $profile_content,
                'post_excerpt'  => 'Complete stats for the ' . $v['name'] . ' in GTA 5: top speed ' . $v['speed'] . ' mph, price $' . number_format( $v['price'] ) . ', ' . $v['drivetrain'] . ' drivetrain.',
                'post_status'   => 'publish',
                'post_type'     => 'profile',
                'post_author'   => $author_id,
                'post_category' => array( $cars_cat_id ),
            ), true );

            if ( ! is_wp_error( $profile_id ) && $profile_id ) {
                wp_set_post_terms( $profile_id, array( $cars_cat_id ), 'category', false );
                update_post_meta( $profile_id, 'entity_type', 'vehicle' );
                update_post_meta( $profile_id, 'first_appearance', 'GTA 5 / GTA Online' );
                update_post_meta( $profile_id, 'stats_table', $stats );
            }
        }
    }

    update_option( 'gtalobby_vehicles_seeded', true );
}
add_action( 'after_switch_theme', 'gtalobby_seed_vehicle_content', 35 );

/**
 * Manual trigger for vehicle seeding.
 */
function gtalobby_manual_seed_vehicles() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized' );
    }
    delete_option( 'gtalobby_vehicles_seeded' );
    gtalobby_seed_vehicle_content();
    wp_safe_redirect( admin_url( 'edit.php?post_type=database&vehicles_seeded=1' ) );
    exit;
}
add_action( 'admin_post_gtalobby_seed_vehicles', 'gtalobby_manual_seed_vehicles' );
