<?php

$GLOBALS['TL_DCA']['tl_dse_products_variants'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'sql' => array(
            'keys' => array(
                'id' => 'primary',
            )
        ),
    ),

    'fields' => array(
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'language' => array(
            'sql' => 'TEXT NULL'
        ),
        'category' => array(
            'sql' => 'TEXT NULL'
        ),
        'id' => array(
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ),
        'psku' => array(
            // 'foreignKey' => 'tl_dse_products.sku',
            'sql' => "TEXT NULL",
            // 'relation' => array(
            //     'type' => 'belongsTo',
            //     'load' => 'eager'
            // )
        ),
        'sku' => array(
            'sql' => "TEXT NULL"
        ),
        // Covertec
        'covertec_input' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_output' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_length1' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_length2' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_diameter1' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_magnet_version' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_ct_version' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_spare_part_housing' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_screw_head' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_diameter_d' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_diameter_ds' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_deep' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_bit' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_exit_size' => array(
            'sql' => "TEXT NULL"
        ),
        'covertec_manufacture_number' => array(
            'sql' => "TEXT NULL"
        ),
        // Crowfeet
        'crowfeet_ct_version' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_extension_measure' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_tightening_modell' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_torque' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_angle' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_zvg_version' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_width' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_height' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_number_of_wheels' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_radius' => array(
            'sql' => "TEXT NULL"
        ),
        'crowfeet_max_torque' => array(
            'sql' => "TEXT NULL"
        ),
        // Assembly technology
        'assembly_technology_input' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_output1' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_output2' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_length1' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_length2' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_diameter_d1' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_diameter_d2' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_diameter_magnet_version' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_ct_version' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_spare_part_housing' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_screw_head' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_rivet' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_bit_size' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_extension_measure' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_spring_loaded_travel' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_tightening_model' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_torque' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_angle' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_roll_width' => array(
            'sql' => "TEXT NULL"
        ),
        'assembly_technology_max_troque' => array(
            'sql' => "TEXT NULL"
        ),
    )
);
