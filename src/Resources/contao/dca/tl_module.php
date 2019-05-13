<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['dse_products_list'] = '{title_legend},name,headline,type;{config_legend},products_sets,numberOfItems,products_featured,perPage,full_details,comparable;{template_legend:hide},products_template,products_wrapper_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dse_products_reader'] = '{title_legend},name,headline,type;{config_legend},products_sets,full_details;{template_legend:hide},products_template,products_wrapper_template,related_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dse_products_compare'] = '{title_legend},name,headline,type;{template_legend:hide},products_template,products_wrapper_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dse_products_notelist'] = '{title_legend},name,headline,type;{template_legend:hide},products_template,products_wrapper_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['products_sets'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['products_sets'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'options_callback' => array(
        'tl_module_dse_products',
        'getProductsSets'
    ),
    'eval' => array(
        'multiple' => true,
        'mandatory' => true,
        'tl_class' => 'clr'
    ),
    'sql' => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['products_featured'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['products_featured'],
    'default' => 'all_items',
    'exclude' => true,
    'inputType' => 'select',
    'options' => array(
        'all_items',
        'featured',
        'unfeatured'
    ),
    'reference' => &$GLOBALS['TL_LANG']['tl_module'],
    'eval' => array(
        'tl_class' => 'w50 clr'
    ),
    'sql' => "varchar(16) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['full_details'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['full_details'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array(
        'tl_class' => 'w50'
    ),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['comparable'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['comparable'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array(
        'tl_class' => 'w50'
    ),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['products_template'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['products_template'],
    'default' => 'products_list',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array(
        'tl_module_dse_products', 'getProductsTemplates'
    ),
    'eval' => array(
        'tl_class' => 'w50 clr'
    ),
    'sql' => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['products_wrapper_template'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['products_wrapper_template'],
    'default' => 'mod_dse_products_list',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array(
        'tl_module_dse_products', 'getProductsWrapperTemplates'
    ),
    'eval' => array(
        'tl_class' => 'w50'
    ),
    'sql' => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['related_template'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['related_template'],
    'default' => 'mod_dse_products_list',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array(
        'tl_module_dse_products', 'getRelatedProductsTemplates'
    ),
    'eval' => array(
        'tl_class' => 'w50 clr'
    ),
    'sql' => "varchar(64) NOT NULL default ''"
);


class tl_module_dse_products extends Backend {

    /**
     * Import the back end user object
     */
    public function __construct() {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Get all products sets and return them as array
     * @return array
     */
    public function getProductsSets() {
        if($this->User->hasAccess("dse_products_set", "modules") == false) {
            return array();
        }

        $arrSets = array();
        $objSets = $this->Database->execute("SELECT id, title FROM tl_dse_products_set ORDER BY title");

        while ($objSets->next()) {
            $arrSets[$objSets->id] = $objSets->title;
        }

        return $arrSets;
    }

    /**
     * Return all products templates as array
     * @return array
     */
    public function getProductsTemplates() {
        return $this->getTemplateGroup('dse_products_');
    }

    /**
     * Return all products wrapper templates as array
     * @return array
     */
    public function getProductsWrapperTemplates() {
        return $this->getTemplateGroup('mod_dse_products_');
    }

    /**
     * Return all products wrapper templates as array
     * @return array
     */
    public function getRelatedProductsTemplates() {
        return$this->getTemplateGroup('dse_related_');
    }
}
