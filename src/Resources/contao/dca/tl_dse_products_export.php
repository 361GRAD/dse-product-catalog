<?php

$GLOBALS['TL_DCA']['tl_dse_products_export'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'switchToEdit' => false,
        'enableVersioning' => true,
        'closed' => true,
        'notEditable' => true,
        'onload_callback' => array(
            array('tl_dse_products_export', 'loadExportConfigs'),
            array('tl_dse_products_export', 'checkPermission'),
        ),
        'sql' => array(
            'keys' => array(
                'id' => 'primary',
            )
        ),
    ),
    'fields' => array(
        'id' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_export']['id'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ),
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'type' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_export']['type'],
            'exclude' => true,
            'filter' => true,
            'inputType' => 'select',
            'options' => array(
                'type_csv'       => 'CSV',
            ),
            'eval' => array(
                'mandatory' => true,
                'includeBlankOption' => true,
                'multiple' => false,
                'chosen' => true,
                'submitOnChange' => true,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(32) NOT NULL default ''"
        ),
    ),
);

class tl_dse_products_export extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Check if a user has access to lead data.
     *
     * @param $dc
     */
    public function checkPermission($dc)
    {
        if ($this->User->isAdmin) {
            return;
        }

        if (!$this->User->hasAccess('tl_dse_products_export', 'tl_dse_products', 'alexf')) {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions');
        }
    }

    /**
     * Load the export configs.
     */
    public function loadExportConfigs()
    {
        $arrOperations['export_csv'] = array(
            'label'         => &$GLOBALS['TL_LANG']['tl_dse_products_export']['export_csv'],
            'href'          => 'key=export&amp;config=csv',
            'class'         => 'leads-export header_export_excel',
            'attributes'    => 'onclick="Backend.getScrollOffset();"',
        );
        
        array_insert($GLOBALS['TL_DCA']['tl_dse_products_export']['list']['global_operations'], 0, $arrOperations);
    }

    public function export()
    {
        $intConfig = \Input::get('config');
        
        if (!$intConfig) {
            \Controller::redirect('contao/main.php?act=error');
        }

        $this->exportAndCatchExceptions();
    }

    /**
     * Try to export and catch ExportFailedException.
     *
     * @param $intConfig
     * @param $arrIds
     */
    public function exportAndCatchExceptions()
    {
        try {
            Dse\ProductCatalogBundle\Model\DseProductsExport::export();
        } catch (\Leads\Exporter\ExportFailedException $e) {
            \Message::addError($e->getMessage());
            \Controller::redirect(\System::getReferer());
        }
    }
}
