<?php

$GLOBALS['TL_DCA']['tl_dse_products_tag'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => array(
            'keys' => array(
                'id' => 'primary',
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
            'group_callback'          => array('tl_dse_products_tag', 'getGroupLabel')
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
            'editheader' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['editheader'],
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ),
            'copy' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.svg'
            ),
            'delete' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm']
                    . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['toggle'],
                'icon' => 'visible.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_dse_products_tag', 'toggleIcon')
            ),
            'show' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['show'],
                'href' => 'act=show',
                'icon' => 'show.svg',
                'attributes' => 'style="margin-right:3px;"'
            ),
        ),
    ),

    'palettes' => array(
        'default' => '{tag_legend},title,alias,pids;{publish_legend},published;',
    ),

    'fields' => array(
        'id' => [
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['id'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ],
        'pids' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['pids'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'select',
            'foreignKey' => 'tl_dse_products.title',
            'eval' => array(
                'maxlength'=>255,
                'includeBlankOption'=>true,
                'multiple'=>true,
                'chosen'=>true,
                'tl_class'  => 'clr',
            ),
            'sql' => "blob NULL",
            'relation' => array(
                'type' => 'belongsToMany',
                'load' => 'eager'
            )
        ),
        'tstamp'         => [
            'sql' => "int(10) unsigend NOT NULL default '0'"
        ],
        'sorting' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['title'],
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
        'alias' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['alias'],
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
                array('tl_dse_products_tag', 'generateAlias')
            ),
            'sql' => "varbinary(128) NOT NULL default ''"
        ),

        // PRODUCT VISIBILITY
        'published' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag']['published'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true
            ),
            'sql' => "char(1) NOT NULL default '1'"
        ),
    )
);

class tl_dse_products_tag extends Backend
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

        if (!$this->User->hasAccess('dse_products_tag', 'modules')) {
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
        if (!$this->User->hasAccess('tl_dse_products_tag::published', 'alexf'))
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
        if (!$this->User->hasAccess('tl_dse_products_tag::published', 'alexf'))
        {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to show/hide content element ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $this->Database->prepare("SELECT * FROM tl_dse_products_tag WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Versions('tl_dse_products_tag', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_dse_products_tag']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_dse_products_tag']['fields']['published']['save_callback'] as $callback)
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
        $this->Database->prepare("UPDATE tl_dse_products_tag SET tstamp=$time, published='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
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

        $objAlias = $this->Database->prepare("SELECT id FROM tl_dse_products_tag WHERE alias=?")
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
}
