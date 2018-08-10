<?php

$GLOBALS['TL_DCA']['tl_dse_products_set'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'ctable' => array('tl_dse_products'),
        'switchToEdit' => true,
        'enableVersioning' => true,
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

class tl_dse_products_set extends Backend
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