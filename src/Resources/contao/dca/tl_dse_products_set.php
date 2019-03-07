<?php

$GLOBALS['TL_DCA']['tl_dse_products_set'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'ctable' => array('tl_dse_products'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'onload_callback' => array(
            array('tl_dse_products_set', 'loadExportConfigs'),
            array('tl_dse_products_set', 'checkPermission'),
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
//        'sorting' => array(
//            'mode' => 1,
//            'fields' => array('id', 'title'),
//            'flag' => 1,
//            'panelLayout' => 'sort,search,limit'
//        ),
        'label' => array
        (
            'fields'                  => array('title'),
            'group_callback'          => array('tl_dse_products_set', 'getGroupLabel')
        ),
        'global_operations' => array(
            'all' => array(
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ),
            'import' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['import_csv'],
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
        'default' => '{title_legend},title,filterfields,jumpTo;',
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
        'filterfields' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_set']['filterfields'],
            'exclude' => true,
            'inputType' => 'select',
            'options_callback' => array('Dse\ProductCatalogBundle\Model\DseProductsModel', 'getDbColNamesArray'),
            'eval' => array(
                'maxlength'=>255,
                'includeBlankOption'=>true,
                'multiple'=>true,
                'chosen'=>true,
                'tl_class'  => 'clr',
            ),
            'sql' => "blob NULL"
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

class tl_dse_products_set extends Backend
{
    /**
     * Category Id
     * @var string
     */
    protected $catId = '';

    /**
     * DB category header array flipped
     * @var array
     */
    protected $categoryDbHeaderKeysFlip = '';

    /**
     * Error Message
     * @var string
     */
    protected $errorMessage = '';

    /**
     * CSV header array
     * @var array
     */
    protected $headerKeys;

    /**
     * Existing CSV ids
     * @var array
     */
    protected $processedIds = array();

    /**
     * DB product header array flipped
     * @var array
     */
    protected $productDbHeaderKeysFlip;

    /**
     * Items data
     * @var array
     */
    protected $itemsData = array(
        'created' => 0,
        'changed' => 0,
        'unchanged' => 0,
        'deleted' => 0,
        'skipped' => 0
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

        if (!$this->User->hasAccess('dse_products_set', 'modules')) {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions');
        }
    }

    /**
     * Load the export configs.
     */
    public function loadExportConfigs()
    {
        $arrOperations['export_csv'] = array(
            'label'         => &$GLOBALS['TL_LANG']['tl_dse_products_set']['export_csv'],
            'href'          => 'key=export&amp;config=csv',
            'class'         => 'leads-export header_export_excel',
            'attributes'    => 'onclick="Backend.getScrollOffset();"',
        );

        array_insert($GLOBALS['TL_DCA']['tl_dse_products_set']['list']['global_operations'], count($GLOBALS['TL_DCA']['tl_dse_products_set']['list']['global_operations']), $arrOperations);
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
            $this->catId = Input::post('cat_type');
            $this->processFormData();
        }

        $productCategoriesQuery = $this->Database->prepare("SELECT id, title FROM tl_dse_products_set")->execute()->fetchAllAssoc();

        $objTemplate = new FrontendTemplate('be_dse_products_import_form');
        $objTemplate->setData([
            'backLink' => ampersand(str_replace('&key=import', '', Environment::get('request'))),
            'formAction' => ampersand(Environment::get('request'), true),
            'langMsc' => $GLOBALS['TL_LANG']['MSC'],
            'successMessage' => $this->successMessage,
            'errorMessage' => $this->errorMessage,
            'requestToken' => REQUEST_TOKEN,
            'categories' => $productCategoriesQuery
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
            $files->delete($newPath);

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

            $this->getProductDbColNames();
            $this->validateHeaders($this->productDbHeaderKeysFlip);

            // group rows into entries
            $csvData = $this->groupRows($csvData);

            // parse fields inside each row
            foreach ($csvData as $index => $row) {
                $this->processEntry($index, $row);
            }

            $this->cleanUpDbEntries();

        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
        }

        if (empty($this->errorMessage)) {
            $this->successMessage = $GLOBALS['TL_LANG']['tl_dse_products_set']['IMPORT']['successMessage'][0] . ' ' .
                $this->itemsData['created']
                . ' ' . $GLOBALS['TL_LANG']['tl_dse_products_set']['IMPORT']['successMessage']['created'] . ', ' .
                $this->itemsData['changed']
                . ' ' . $GLOBALS['TL_LANG']['tl_dse_products_set']['IMPORT']['successMessage']['changed'] . ', '.
                // $this->itemsData['unchanged']
                // . ' ' . $GLOBALS['TL_LANG']['tl_dse_products_set']['IMPORT']['successMessage']['unchanged'] . ', '.
                $this->itemsData['deleted']
                . ' ' . $GLOBALS['TL_LANG']['tl_dse_products_set']['IMPORT']['successMessage']['deleted'] . '.';
        }
    }

    /**
     * Set the first row of the CSV data as csvHeaderKeys field
     * and remove it from the data array. Return updated data array.
     *
     * @param array $csvData Data parsed from the input file.
     *
     * @return array
     */
    private function stripHeaderKeys($csvData)
    {
        $this->csvHeaderKeys = array_map("trim", $csvData[0]);
        unset($csvData[0]);

        return $csvData;
    }

    /**
     * Get database column names as array keys
     * @return array
     */
    protected function getProductDbColNames()
    {
        $arrColNames = array();
        $arrCols = Database::getInstance()
            ->prepare("SELECT distinct(column_name) FROM information_schema.COLUMNS WHERE table_name='tl_dse_products'")
            ->execute();

        while($arrCols->next()) {
            $arrColNames[] = $arrCols->column_name;
        }
        $this->productDbHeaderKeysFlip = array_flip($arrColNames);

        return $arrColNames;
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
        if (count(array_intersect_key($this->productDbHeaderKeysFlip, $csvHeaderRow)) !== count($csvHeaderRow)) {
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
     * @param string $index Counter index, possible values: "created", "changed", "unchanged", "skipped", "deleted"
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
        return array_combine($this->csvHeaderKeys, $csvRow);
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

        $currentItem = Dse\ProductCatalogBundle\Model\DseProductsModel::findBySku($identifier);

        if (empty($currentItem)) {
            $this->logger->info("Entry $identifier not found in the database, creating", [__METHOD__]);
            $currentItem = new Dse\ProductCatalogBundle\Model\DseProductsModel();
            $counterIndex = 'created';
        } else if ($currentItem->sku === $identifier) {
            $this->logger->info("Entry $identifier found in the database - changing", [__METHOD__]);
            $counterIndex = 'changed';
        } else {
            $this->logger->info("Entry $identifier found in the database, and has up to date data, no change needed", [__METHOD__]);
            $counterIndex = 'unchanged';
        }

        if ($counterIndex !== 'unchanged') {
            $currentItem = $this->setItemData($currentItem, $identifier, $row);
            $currentItem->save();
        }

        $this->incrementCounter($counterIndex);

        $this->processedIds[] = $identifier;

        $this->logger->info("Done processing entry $identifier", [__METHOD__]);

        return;
    }

    /**
     * Delete entries that were not in the import file.
     *
     * @return void
     */
    private function cleanUpDbEntries()
    {
        // process products
        $this->logger->info("Cleaning up the data - hiding every currently active product that was not processed during the import", [__METHOD__]);

        // hide products that were not in the source file
        if (count($this->processedIds)) {
            $objRemovedActiveEntries = $this->Database
                ->prepare("SELECT sku FROM tl_dse_products WHERE pid=$this->catId AND sku NOT IN(" . implode(', ', array_map(function($item) {return "'$item'";}, $this->processedIds)) . ")")
                ->execute();
        } else {
            $this->logger->info("No entries processed, cancelling data cleanup", [__METHOD__]);
            return;
        }

        $this->logger->info("Found " . $objRemovedActiveEntries->count() . " active products that were not processed during the import", [__METHOD__]);
        $arrRemovedActiveEntries = $objRemovedActiveEntries->fetchAllAssoc();

        foreach ($arrRemovedActiveEntries as $entry) {
            $model = Dse\ProductCatalogBundle\Model\DseProductsModel::findBySku($entry['sku']);
            if (!empty($model)) {
                $this->logger->info("Deleting entry with SKU: $model->sku.", [__METHOD__]);
                $model->delete();
                $this->incrementCounter('deleted');
            }
        }

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
        foreach ($this->productDbHeaderKeysFlip as $key => $value) {
            switch ($key) {
                case "id":
                    break;
                case "pid":
                    $model->$key = $this->catId;
                    break;
                case "tstamp":
                    $model->$key = time();
                    break;
                case "alias":
                    $model->$key = $this->generateAlias($productRows[0]["title"], $identifier, $model);
                    break;
                case "published":
                    $model->$key = 1;
                    break;
                case "singleSRC":
                    $model->$key = $this->getFileUuid($productRows[0]["singleSRC"]);
                    break;
                // ToDo: Remove TEMP fixes
                case strpos($key, '_coord') !== false:
                    if (is_null($productRows[0][$key]) && empty($productRows[0][$key])) {
                        $model->$key = 0;
                    }
                    break;
                default:
                    if (is_null($productRows[0][$key])) {
                        $model->$key = "";
                    } else {
                        $model->$key = $productRows[0][$key];
                    }
                    break;
            }
        }

        return $model;

    }

    /**
     * Get UUID from previously uploaded file
     *
     *
     * @param string $strName
     *
     * @return binary
     */
    private function getFileUuid($strName)
    {
        $uploadPath = "";
        if (preg_match('/(\.jpg|\.png|\.bmp)$/', $strName)) {
            $uploadPath = "files/public/products/import/images/";
        } elseif (preg_match('/(\.pdf)$/', $strName)) {
            $uploadPath = "files/public/products/import/pdf/";
        }

        $fileUuid = $fileUuid = \FilesModel::findByPath($uploadPath.$strName)->uuid;

        if($fileUuid) {
            return $fileUuid;
        }
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

        $objAlias = $this->Database->prepare("SELECT id FROM tl_dse_products WHERE alias=?")
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
