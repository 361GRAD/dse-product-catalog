<?php

/**
 * BACK END MODULES
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'dse-products' => array
    (
        'dse_products_set' => array
        (
            'tables' => array('tl_dse_products_set', 'tl_dse_products', 'tl_content'),
            'export' => array('tl_dse_products_set', 'export'),
        ),
        // 'dse_products_export' => array
        // (
        //     'tables' => array('tl_dse_products_export'),
        //     'export' => array('tl_dse_products_export', 'export'),
        // )
    )
));

// Load icon in Contao 4.2 backend
if ('BE' === TL_MODE) {
    if (version_compare(VERSION, '4.4', '<')) {
        $GLOBALS['TL_CSS'][] = 'bundles/dseproductcatalog/css/be_dse-product-catalog.css';
    } else {
        $GLOBALS['TL_CSS'][] = 'bundles/dseproductcatalog/css/be_dse-product-catalog.css';
    }
}

// Register hooks
$GLOBALS['TL_HOOKS']['getSearchablePages'][] = [
    'Dse\ProductCatalogBundle\EventListener\SearchIndexListener',
    'getSearchablePages'
];
// change alias hook
$GLOBALS['TL_HOOKS']['changelanguageNavigation'][] = [
    'Dse\ProductCatalogBundle\EventListener\ChangelanguageNavigationListener',
    'onChangelanguageNavigation'
];

/**
 * FRONT END MODULES
 */
$GLOBALS['TL_MODELS']['tl_dse_products'] = 'Dse\ProductCatalogBundle\Model\DseProductsModel';
$GLOBALS['TL_MODELS']['tl_dse_products_set'] = 'Dse\ProductCatalogBundle\Model\DseProductsSetModel';

array_insert($GLOBALS['FE_MOD'], 2, array
(
    'dse-modules' => array
    (
//        'dse_products_list' => Dse\ProductCatalogBundle\Module\ModuleProductsList::class
        'dse_products_list' => 'Dse\ProductCatalogBundle\Module\ModuleProductsList',
        'dse_products_reader' => 'Dse\ProductCatalogBundle\Module\ModuleProductsReader',
        'dse_products_compare' => 'Dse\ProductCatalogBundle\Module\ModuleProductsCompare',
        'dse_products_notelist' => 'Dse\ProductCatalogBundle\Module\ModuleProductsNotelist'
    )
));
