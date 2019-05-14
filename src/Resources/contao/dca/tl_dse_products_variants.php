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
        'id' => array(
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ),
        'psku' => array(
            'sql' => "TEXT NULL",
        ),
        'sku' => array(
            'sql' => "TEXT NULL"
        ),
        'length_1' => array(
            'sql' => "TEXT NULL"
        ),
    )
);
