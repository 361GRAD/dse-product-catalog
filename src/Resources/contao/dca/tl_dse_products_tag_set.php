<?php

$GLOBALS['TL_DCA']['tl_dse_products_tag_set'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'ctable' => array('tl_dse_products_tag'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'onload_callback' => array(
            array('tl_dse_products_tag_set', 'checkPermission'),
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
            'group_callback'          => array('tl_dse_products_tag_set', 'getGroupLabel')
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
            'edit'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['edit'],
                'href' => 'table=tl_dse_products_tag',
                'icon' => 'edit.svg'
            ),
            'editheader' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ),
            'copy' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.svg'
            ),
            'delete' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm']
                    . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['show'],
                'href' => 'act=show',
                'icon' => 'show.svg',
                'attributes' => 'style="margin-right:3px;"'
            ),
        ),
    ),

    'palettes' => array(
        'default' => '{title_legend},title;{filter_legend},filterfields;{tag_legend},tags,activeTags;{jumpto_legend},jumpTo;',
    ),

    'fields' => array(
        'id' => [
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['id'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ],
        'tstamp'         => [
            'sql' => "int(10) unsigend NOT NULL default '0'"
        ],
        'title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products_tag_set']['title'],
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
    )
);

class tl_dse_products_tag_set extends Backend
{
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

        if (!$this->User->hasAccess('dse_products_tag_set', 'modules')) {
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
}
