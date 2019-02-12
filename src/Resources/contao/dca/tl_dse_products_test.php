<?php

$GLOBALS['TL_DCA']['tl_dse_products_test'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'ptable' => 'tl_dse_products_set',
        'ctable' => array('tl_content'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => array(
            'keys' => array(
                'id' => 'primary',
                'pid' => 'index',
            )
        ),
    ),

    'list' => array(
        'sorting' => array(
            'mode' => 4,
            'fields' => array('sorting'),
            'headerFields' => array('title'),
            'panelLayout' => 'filter;sort,search,limit',
            'disableGrouping' => true,
            'child_record_callback' => array('tl_dse_products_test', 'listRows'),
        ),
        'label' => array(
            'fields' => array(
                'sku',
                'type',
                'title'
            ),
            'showColumns' => true,
        ),
        'global_operations' => array(
            'all' => array(
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ),
        ),
        'operations' => array(
            'edit' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['edit'],
                'href' => 'table=tl_content',
                'icon' => 'edit.svg'
            ),
            'editheader' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ),
            'copy' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.svg'
            ),
            'cut' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['cut'],
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            ),
            'delete' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm']
                    . '\'))return false;Backend.getScrollOffset()"'
            ),
            'feature' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['feature'],
                'icon' => 'featured.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleFeatured(this,%s)"',
                'button_callback' => array('tl_dse_products_test', 'featureIcon')
            ),
            'toggle' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['toggle'],
                'icon' => 'visible.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_dse_products_test', 'toggleIcon')
            ),
            'show' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['show'],
                'href' => 'act=show',
                'icon' => 'show.svg',
                'attributes' => 'style="margin-right:3px;"'
            ),
        ),
    ),

    'fields' => array(
        'id' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['id'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ),
        'pid' => array(
            'foreignKey' => 'tl_dse_products_set.title',
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array(
                'type' => 'belongsTo',
                'load' => 'eager'
            )
        ),
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['title'],
            'exclude' => true,
            'sorting' => true,
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'alias' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['alias'],
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => array(
                'rgxp' => 'alias',
                'doNotCopy' => true,
                'readonly' => false,
                'unique' => true,
                'spaceToUnderscore' => true,
                'maxlength' => 128,
                'tl_class' => 'w50'
            ),
            'save_callback' => array(
                array('tl_dse_products_test', 'generateAlias')
            ),
            'sql' => "varbinary(128) NOT NULL default ''"
        ),
        'sku' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['sku'],
            'exclude' => true,
            'sorting' => true,
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'doNotCopy' => false,
                'unique' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'published' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['published'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true
            ),
            'sql' => "char(1) NOT NULL default '1'"
        ),
        'featured' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['featured'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'submitOnChange' => true,
            ),
            'sql' => "char(1) NOT NULL default ''"
        ),
        'start' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['start'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'datepicker' => true,
                'rgxp' => 'datim',
                'tl_class' => 'w50 wizard clr'
            ),
            'sql' => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['stop'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array(
                'datepicker' => true,
                'rgxp' => 'datim',
                'tl_class' => 'w50 wizard'
            ),
            'sql' => "varchar(10) NOT NULL default ''"
        )
    )
);

class tl_dse_products_test extends Backend
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
     * child_record_callback
     *
     * @param array $arrRow
     *
     * @return string
     */
    public function listRows($arrRow)
    {
        $strBuffer = '
        <div class="cte_type ' . (($arrRow['published']) ? 'published' : 'unpublished') . '">'
            . $arrRow['sku'] . ' - <strong>' . $arrRow['title'] . '</strong>
        </div>';

        return $strBuffer;
    }

    /**
     * Return the "toggle featured" button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function featureIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (\strlen(Input::get('tid')))
        {
            $this->toggleFeatured(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->hasAccess('tl_dse_products_test::featured', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.Input::get('id').'&amp;tid='.$row['id'].'&amp;state='.($row['featured'] ? '' : 1);

        if (!$row['featured'])
        {
            $icon = 'featured_.svg';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.StringUtil::specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label, 'data-state="' . ($row['featured'] ? 1 : '') . '"').'</a> ';
    }
    /**
     * Toggle the featured
     *
     * @param integer       $intId
     * @param boolean       $blnVisible
     * @param DataContainer $dc
     *
     * @throws Contao\CoreBundle\Exception\AccessDeniedException
     */
    public function toggleFeatured($intId, $blnVisible, DataContainer $dc=null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'feature');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        // Check the field access
        if (!$this->User->hasAccess('tl_dse_products_test::featured', 'alexf'))
        {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to show/hide content element ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $this->Database->prepare("SELECT * FROM tl_dse_products_test WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Versions('tl_dse_products_test', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_dse_products_test']['fields']['featured']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_dse_products_test']['fields']['featured']['save_callback'] as $callback)
            {
                if (\is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                }
                elseif (\is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_dse_products_test SET tstamp=$time, featured='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
    }

    /**
     * Return the "toggle visibility" button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (\strlen(Input::get('tid')))
        {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->hasAccess('tl_dse_products_test::published', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.Input::get('id').'&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.svg';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.StringUtil::specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : '') . '"').'</a> ';
    }
    /**
     * Toggle the visibility
     *
     * @param integer       $intId
     * @param boolean       $blnVisible
     * @param DataContainer $dc
     *
     * @throws Contao\CoreBundle\Exception\AccessDeniedException
     */
    public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        // Check the field access
        if (!$this->User->hasAccess('tl_dse_products_test::published', 'alexf'))
        {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to show/hide content element ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $this->Database->prepare("SELECT * FROM tl_dse_products_test WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Versions('tl_dse_products_test', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_dse_products_test']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_dse_products_test']['fields']['published']['save_callback'] as $callback)
            {
                if (\is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                }
                elseif (\is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_dse_products_test SET tstamp=$time, published='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
    }

    /**
     * Auto-generate the products alias if it has not been set yet
     * @param mixed
     * @param \DataContainer
     * @return string
     * @throws \Exception
     */
    public function generateAlias($varValue, DataContainer $dc) {
        $autoAlias = false;

        // Generate alias if there is none
        if ($varValue == '') {
            $autoAlias = true;
            $varValue = standardize(StringUtil::restoreBasicEntities($dc->activeRecord->title));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_dse_products_test WHERE alias=?")
            ->execute($varValue);

        // Check whether the project alias exists
        if ($objAlias->numRows > 1 && !$autoAlias) {
            throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        // Add ID to alias
        if ($objAlias->numRows && $autoAlias) {
            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }

    /**
     * Dynamically add flags to the "singleSRC" field
     *
     * @param mixed         $varValue
     * @param DataContainer $dc
     *
     * @return mixed
     */
    public function setSingleSrcFlags($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord)
        {
            switch ($dc->activeRecord->type)
            {
                case 'text':
                case 'hyperlink':
                case 'image':
                case 'accordionSingle':
                    $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('validImageTypes');
                    break;

                case 'download':
                    $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('allowedDownload');
                    break;
            }
        }

        return $varValue;
    }

    /**
     * Pre-fill the "alt" and "caption" fields with the file meta data
     *
     * @param mixed         $varValue
     * @param DataContainer $dc
     *
     * @return mixed
     */
    public function storeFileMetaInformation($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord->singleSRC != $varValue)
        {
            $this->addFileMetaInformationToRequest($varValue, ($dc->activeRecord->ptable ?: 'tl_article'), $dc->activeRecord->pid);
        }

        return $varValue;
    }
}
