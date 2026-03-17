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
    );
}

