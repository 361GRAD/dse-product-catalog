<?php

$GLOBALS['TL_DCA']['tl_dse_products_set_test'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'ctable' => array('tl_dse_products'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'onload_callback' => array(
            array('tl_dse_products_set_test', 'loadExportConfigs'),
            array('tl_dse_products_set_test', 'checkPermission'),
        ),
        'sql' => array(
            'keys' => array(
                'id' => 'primary'
            )
        ),
    ),

    'list' => array(
        'sorting' => array(
            'mode' => 1,
            'fields' => array(
                'title',
            ),
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('title'),
            'group_callback'          => array('tl_dse_products_set_test', 'getGroupLabel')
        ),
        'global_operations' => array(
            'all' => array(
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ),
            'import' => array(
                'label' => &$GLOBALS['TL_LANG']['MSC']['import'],
                'href' => 'key=import',
                'class' => 'header_export_excel',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            )
        ),
        'operations' => array(
            'edit'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['edit'],
                'href' => 'table=tl_dse_products',
                'icon' => 'edit.svg'
            ),
            'editheader' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ),
            'copy' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.svg'
            ),
            'delete' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm']
                    . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['show'],
                'href' => 'act=show',
                'icon' => 'show.svg',
                'attributes' => 'style="margin-right:3px;"'
            ),
        ),
    ),

    'palettes' => array(
        'default' => '{title_legend},title,jumpTo;',
    ),

    'fields' => array(
        'id' => [
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['id'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ],
        'tstamp'         => [
            'sql' => "int(10) unsigend NOT NULL default '0'"
        ],
        'sorting' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['title'],
            'exclude' => true,
            'sorting' => true,
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class'  => 'w50 clr',
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'jumpTo' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['jumpTo'],
            'exclude' => true,
            'inputType' => 'pageTree',
            'foreignKey' => 'tl_page.title',
            'eval' => array(
                'mandatory' => true,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array(
                'type' => 'hasOne',
                'load' => 'eager'
            )
        ),
    )
);

class tl_dse_products_set_test extends Backend
{
    /**
     * Succsess Message
     * @var string
     */
    protected $errorMessage = '';

    /**
     * Forse update
     * @var string
     */
    protected $forceUpdate = '';

    /**
     * CSV header array
     * @var string
     */
    protected $headerKeys;

    /**
     * CSV header array
     * @var string
     */
    protected $headerKeysFlip;

    /**
     * Items data
     * @var array
     */
    protected $itemsData = array(
        'created' => 0,
        'changed' => 0,
        'unchanged' => 0,
        'hidden' => 0,
        'skipped' => 0,
        'deleted_variants' => 0
    );

    /**
     * Logger service
     * @var object
     */
    protected $logger;

    /**
     * Error Message
     * @var string
     */
    protected $succsessMesssage = '';

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
        $this->logger = $this->getContainer()->get('monolog.logger.contao');
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

        if (!$this->User->hasAccess('tl_dse_products_set_test', 'tl_dse_products', 'alexf')) {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions');
        }
    }

    /**
     * Label callback
     *
     * @param string         $strLabel
     *
     * @return string
     */
    public function getGroupLabel($strLabel)
    {
        return $strLabel;
    }

    /**
     * Load the export configs.
     */
    public function loadExportConfigs()
    {
        $arrOperations['export_csv'] = array(
            'label'         => &$GLOBALS['TL_LANG']['tl_dse_products_set']['export_csv'],
            'href'          => 'key=export&amp;config=csv',
            'class'         => 'header_export_excel',
            'attributes'    => 'onclick="Backend.getScrollOffset();"',
        );
        
        array_insert($GLOBALS['TL_DCA']['tl_dse_products_set_test']['list']['global_operations'], count($GLOBALS['TL_DCA']['tl_dse_products_set_test']['list']['global_operations']), $arrOperations);
    }

    /**
     * Get database column names as array keys
     * @return array
     */
    protected function getDatabaseColNames()
    {
        $arrColNames = array();
        $arrCols = Database::getInstance()
            ->prepare("SELECT distinct(column_name) FROM information_schema.COLUMNS WHERE table_name='tl_dse_products_test'")
            ->execute();

        while($arrCols->next()) {
            $arrColNames[] = $arrCols->column_name;
        }
        $this->headerKeysFlip = array_flip($arrColNames);

        return $arrColNames;
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

    /**
     * Initiate products import
     * @return string
     */
    public function initiateImport()
    {

        if (Input::get('key') != 'import') {
            return '';
        }

        if (Input::post('FORM_SUBMIT') == 'tl_dse_products_import') {

            $this->processFormData();

        }

        $objTemplate = new FrontendTemplate('be_dse_products_import_form');
        $objTemplate->setData([
            'backLink' => ampersand(str_replace('&key=import', '', Environment::get('request'))),
            'formAction' => ampersand(Environment::get('request'), true),
            'langMsc' => $GLOBALS['TL_LANG']['MSC'],
            'successMessage' => $this->successMessage,
            'errorMessage' => $this->errorMessage,
            'requestToken' => REQUEST_TOKEN
        ]);

        return $objTemplate->parse();

    }

    /**
     * Process submitted form data.
     *
     * @throws Exception
     */
    protected function processFormData()
    {

        $files = Files::getInstance();

        // Environment::get('documentRoot') in C4 will return the path to web directory,
        // kernel.root_dir gives app path and Files is hardcoded to TL_ROOT path,
        // so we have to strip "/app" from base path and add it to the relative path for Files methods to work
        $basePath = str_replace(DIRECTORY_SEPARATOR . 'app', '', $this->getContainer()->getParameter('kernel.root_dir')) . DIRECTORY_SEPARATOR;
        $relativeTmpPath = 'system' . DIRECTORY_SEPARATOR . 'tmp';

        // handle tmp directory
        if (!$files->is_writeable($relativeTmpPath)) {
            $files->mkdir($relativeTmpPath);
        } else {
            $files->rrdir($relativeTmpPath, true);
        }

        // process upload
        try {

            // undefined | Multiple Files | $_FILES Corruption Attack
            // if this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['source_file']['error']) ||
                is_array($_FILES['source_file']['error'])
            ) {
                throw new Exception('Invalid parameters.');
            }
            switch ($_FILES['source_file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception('Exceeded filesize limit.');
                default:
                    throw new Exception('Unknown errors.');
            }

            $ext = 'csv';
            $allowedTypes = [
                'text/csv',
                'application/vnd.ms-excel'
            ];

            // Check passed type

            if (!in_array($_FILES['source_file']['type'], $allowedTypes)) {
                throw new Exception('Invalid file format.');
            }

            // obtain safe unique name from binary data.
            $newPath = sprintf($relativeTmpPath . DIRECTORY_SEPARATOR . '%s.%s', sha1_file($_FILES['source_file']['tmp_name']), $ext);

            if (!$files->move_uploaded_file($_FILES['source_file']['tmp_name'], $newPath)) {
                throw new Exception('Failed to move uploaded file.');
            }

            $this->handleUploadedFile($newPath, $basePath);

        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }

    /**
     * Handle uploaded file
     *
     * @param $relativePath string
     * @param $basePath
     *
     * @throws Exception
     *
     * @return void
     */
    public function handleUploadedFile($relativePath, $basePath)
    {

        $path = $basePath . $relativePath;

        $this->forceUpdate = Input::post('force_update');

        try {

            $allowedExtensions = ['csv'];

            if (!in_array(pathinfo($path, PATHINFO_EXTENSION), $allowedExtensions)) {
                throw new Exception('Wrong type of CSV file.');
            }
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
            return;
        }

        try {

            //$csvData = str_getcsv(file_get_contents($path), "\n");
            // map str_getcsv here instead of calling rowToArray on each row
            $csvData = array_map(function($row) { return str_getcsv($row, ","); }, file($path));

            $csvData = $this->stripHeaderKeys($csvData);

            $this->validateHeaders($this->headerKeysFlip);

            // group rows into products
            $csvData = $this->groupRows($csvData);

            // parse fields inside each row
            foreach ($csvData as $index => $row) {
                $this->processEntry($index, $row);
            }
            die();
            $this->cleanUpDbEntries();

        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
        }

        if (empty($this->errorMessage)) {
            // hardcoded in DE, we can move this to lang if needed
            $this->successMessage = 'Produktimport erfolgreich durchgeführt. Produkt Stats: ' .
                $this->itemsData['created']
                . ' erstellt, ' .
                $this->itemsData['changed']
                . ' geändert, ' .
                $this->itemsData['unchanged']
                . ' unverändert, ' .
                $this->itemsData['hidden']
                . ' ausgeblendet, ' .
                $this->itemsData['deleted_variants']
                . ' Varianten entfernt.';
        }
    }

    /**
     * Set the first row of the CSV data as headerKeys field
     * and remove it from the data array. Return updated data array.
     *
     * @param array $csvData Data parsed from the input file.
     *
     * @return array
     */
    private function stripHeaderKeys($csvData)
    {
        $this->headerKeys = array_map("trim", $csvData[0]);
        unset($csvData[0]);

        return $csvData;
    }

    /**
     * Check if the first header fields from the CSV file match the reference format from the database.
     *
     * @param array $csvHeaderRow
     *
     * @throws Exception
     *
     * @return void
     */
    private function validateHeaders($csvHeaderRow)
    {
        if (count(array_intersect_key($this->headerKeysFlip, $csvHeaderRow)) !== count($csvHeaderRow)) {
            throw new Exception('Wrong format of the CSV file header row.');
        } else {
            return;
        }
    }

    /**
     * Process passed CSV array to join separate rows into products.
     *
     * @param array $rows
     *
     * @return array
     *
     * @return ProductsModel
     */
    private function groupRows($rows)
    {
        $this->logger->info('Grouping the ' . count($rows) . ' CSV rows', [__METHOD__]);

        $keyColumn = "sku";

        $data = [];
        foreach ($rows as $index => $row) {

            $variant = $this->composeRow($row);

            $key = $variant[$keyColumn];

            if (empty($key)) {

                $this->logger->notice("Row number $index has empty '$keyColumn' column, skipping this row", [__METHOD__]);
                $this->incrementCounter('skipped');
                continue;

            }

            if ($data[$key]) {
                // add to existing group
                $data[$key][] = $variant;
            } else {
                // create a group with variants array
                $data[$key] = [$variant];
            }

//            $this->saveVariant($variant);

        }

        $this->logger->info('CSV rows grouped into ' . count($data) . ' products', [__METHOD__]);

        return $data;

    }

    /**
     * Increment one of internal counters.
     *
     * @param string $index Counter index, possible values: "created", "changed", "unchanged", "skipped"
     *
     * @throws Exception
     *
     * @return void
     */
    private function incrementCounter($index)
    {

        if (!array_key_exists($index, $this->itemsData)) {
            throw new Exception("Got incorrect counter index: $index");
        }

        $this->itemsData[$index]++;

    }

    /**
     * Compose a row array using header field as keys.
     *
     * @param array $csvRow CSV data row
     *
     * @return array
     */
    private function composeRow($csvRow)
    {
        return array_combine($this->headerKeys, $csvRow);
    }

    /**
     * Create / update entry
     *
     * @param string $identifier External id of the item by which the rows were grouped
     * @param array $row Array with keys generated from the header row and all the row's data
     *
     * @throws Exception
     *
     * @return void
     */
    private function processEntry($identifier, $row)
    {

        $this->logger->info("Processing entry $identifier", [__METHOD__]);

        $currentItem = Dse\ProductCatalogBundle\Model\DseProductsTestModel::findMultipleProductsByIds(array('1'));

        if (empty($currentItem)) {
            $this->logger->info("Entry $identifier not found in the database, creating", [__METHOD__]);
            $currentItem = new Dse\ProductCatalogBundle\Model\DseProductsTestModel();
            $counterIndex = 'created';
        } else if (($this->forceUpdate == '1') || (sha1(serialize($row)) !== ($currentItem->external_data_hash))) {
            $this->logger->info("Entry $identifier found in the database, but was updated or force update active - changing", [__METHOD__]);
            $counterIndex = 'changed';
        } else {
            $this->logger->info("Entry $identifier found in the database, and has up to date data, no change needed", [__METHOD__]);
            $counterIndex = 'unchanged';
        }
        
        if ($counterIndex !== 'unchanged') {
            // $currentItem = $this->setItemData($currentItem, $identifier, $row);
            $currentItem->save();
        }
        die();
        $this->incrementCounter($counterIndex);

        $this->processedIds[] = $identifier;

        $this->logger->info("Done processing entry $identifier", [__METHOD__]);

        return;
    }

    /**
     * Set model data using passed CSV array if needed and return it.
     *
     * @param ProductsModel $model Product model
     * @param string $identifier Item's external id
     * @param array $row Array with keys generated from the header row and all the row's data
     *
     * @throws Exception
     *
     * @return ProductsModel
     */
    private function setItemData($model, $identifier, $productRows)
    {

        // $strProduct = serialize($productRows);

        // service fields
        // $model->tstamp = time();
        // $model->sku = $identifier;
        // $model->external_data = $strProduct;
        // $model->external_data_hash = sha1($strProduct);
        // $model->title = "Produkt $identifier";
        // $model->alias = $this->generateAlias("product-$identifier", $identifier, $model);
        // $model->published = "1";

        var_dump($model);
        die();
        // handle category
        $model->csv_category = $productRows[0]["Rubrik DE"]; // fetch the first variant's column since they must be identical for all variants
        $model->csv_category_slug = $this->makeSlug($productRows[0]["Rubrik DE"]);

        // fetch distinct variant values for each product fields using the set string separator
        // $model->csv_lamp = $this->fetchDistinctValues($productRows, "Leuchtmittel", $this->stringSeparator);
        // $model->csv_power = $this->fetchDistinctValues($productRows, "Leistung", $this->stringSeparator);
        // $model->csv_voltage = $this->fetchDistinctValues($productRows, "Spannung", $this->stringSeparator);
        // $model->csv_color_temp = $this->fetchDistinctValues($productRows, "Farbtemperatur", $this->stringSeparator);
        // $model->csv_beam_angle = $this->fetchDistinctValues($productRows, "Ausstrahlwinkel", $this->stringSeparator);
        // $model->csv_cable = $this->fetchDistinctValues($productRows, "Kabel", $this->stringSeparator);
        // $model->csv_luminous_flux = $this->fetchDistinctValues($productRows, "Lichtstrom", $this->stringSeparator);
        // $model->csv_material = $this->fetchDistinctValues($productRows, "Material Text", $this->stringSeparator);
        // $model->csv_pool_size = $this->fetchDistinctValues($productRows, "Poolgroesse", $this->stringSeparator);

        return $model;

    }

    /**
     * Auto-generate the products alias
     *
     * Use model id to sort out existing model when checking for uniqueness
     * since this alias is only "editable" here and should not get any temporary suffixes.
     *
     * @param string $strAlias
     * @param integer $identifier
     * @param object $model
     *
     * @return string
     * @throws Exception
     */
    private function generateAlias($strAlias, $identifier, $model)
    {
        $strAlias = $this->makeSlug($strAlias);

        $objAlias = $this->Database->prepare("SELECT id FROM tl_products WHERE alias=?")
            ->execute($strAlias);

        // Add external ID to alias
        if ($objAlias->numRows && ($objAlias->id !== $model->id)) {
            $strAlias .= '-' . $this->makeSlug($identifier);
        }

        return $strAlias;
    }

    /**
     * Generate a URL safe slug from string
     *
     * @param string $string
     *
     * @return string
     */
    private function makeSlug($string)
    {
        return standardize(StringUtil::restoreBasicEntities($string));
    }
}
