<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   BcatHotel
 * @author    Yuriy Davats
 * @link      http://www.bcat.eu
 * @license   GNU
 * @copyright die praxis
 */
/**
 * Namespace
 */

namespace Dse\ProductCatalogBundle\Model;

use Contao\Model;

/**
 * Class ProductsModel
 *
 * @package   BcatProducts
 * @author    Yuriy Davats
 * @link      http://www.bcat.eu
 * @license   GNU
 */
class DseProductsModel extends \Model
{

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_dse_products';

    /**
     * Find published by their parent ID and ID or alias
     *
     * @param mixed $varId The numeric ID or alias name
     * @param array $arrPids An array of parent IDs
     * @param array $arrOptions An optional options array
     *
     * @return \Model|null The PackagesModel or null if there are no packages
     */
    public static function findPublishedByParentAndIdOrAlias($varId, $arrPids, array $arrOptions = array())
    {
        if (!is_array($arrPids) || empty($arrPids)) {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = array("($t.id=? OR $t.alias=?) AND $t.pid IN(" . implode(',', array_map('intval', $arrPids)) . ")");

        if (!BE_USER_LOGGED_IN) {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        return static::findBy($arrColumns, array((is_numeric($varId) ? $varId : 0), $varId), $arrOptions);
    }

    /**
     * Find published by their parent ID
     *
     * @param array $arrPids An array of packages set IDs
     * @param boolean $blnFeatured If true, return only featured packages, if false, return only unfeatured packages
     * @param integer $intLimit An optional limit
     * @param integer $intOffset An optional offset
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|null A collection of models or null if there are no packages
     */
    public static function findPublishedByPids($arrPids, $blnFeatured = null, $intLimit = 0, $intOffset = 0, array $arrOptions = array())
    {
        if (!is_array($arrPids) || empty($arrPids)) {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = array("$t.pid IN(" . implode(',', array_map('intval', $arrPids)) . ")");

        if ($blnFeatured === true) {
            $arrColumns[] = "$t.featured=1";
        } elseif ($blnFeatured === false) {
            $arrColumns[] = "$t.featured=''";
        }

        // Never return unpublished elements in the back end, so they don't end up in the RSS feed
        // should we add one in the future :)
        if (!BE_USER_LOGGED_IN || TL_MODE == 'BE') {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting ASC";
        }

        $arrOptions['limit'] = $intLimit;
        $arrOptions['offset'] = $intOffset;

        return static::findBy($arrColumns, null, $arrOptions);
    }

    /**
     * Count published by their parent ID
     *
     * @param array $arrPids An array of packages set IDs
     * @param boolean $blnFeatured If true, return only featured packages, if false, return only unfeatured packages
     * @param array $arrOptions An optional options array
     *
     * @return integer The number of packages
     */
    public static function countPublishedByPids($arrPids, $blnFeatured = null, array $arrOptions = array())
    {
        if (!is_array($arrPids) || empty($arrPids)) {
            return 0;
        }

        $t = static::$strTable;
        $arrColumns = array("$t.pid IN(" . implode(',', array_map('intval', $arrPids)) . ")");

        if ($blnFeatured === true) {
            $arrColumns[] = "$t.featured=1";
        } elseif ($blnFeatured === false) {
            $arrColumns[] = "$t.featured=''";
        }

        if (!BE_USER_LOGGED_IN) {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        return static::countBy($arrColumns, null, $arrOptions);
    }

    /**
     * Find published with the default redirect target by their parent ID
     *
     * @param integer $intPid The packages sets ID
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|null A collection of models or null if there are no packages
     */
    public static function findPublishedDefaultByPid($intPid, array $arrOptions = array())
    {
        $t = static::$strTable;
        $arrColumns = array("$t.pid=? AND $t.source='default'");

        if (!BE_USER_LOGGED_IN) {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting ASC";
        }

        return static::findBy($arrColumns, $intPid, $arrOptions);
    }

    /**
     * Find published by their parent ID
     *
     * @param integer $intId The packages sets ID
     * @param integer $intLimit An optional limit
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|null A collection of models or null if there are no packages
     */
    public static function findPublishedByPid($intId, $intLimit = 0, array $arrOptions = array())
    {
        $time = time();
        $t = static::$strTable;

        $arrColumns = array("$t.pid=? AND ($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1");

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting ASC";
        }

        if ($intLimit > 0) {
            $arrOptions['limit'] = $intLimit;
        }

        return static::findBy($arrColumns, $intId, $arrOptions);
    }

    /**
     * Find related by their parent ID
     *
     * @param array $arrPids An array of packages set IDs
     * @param boolean $blnFeatured If true, return only featured packages, if false, return only unfeatured packages
     * @param integer $intLimit An optional limit
     * @param integer $intOffset An optional offset
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|null A collection of models or null if there are no packages
     */
    public static function findRelatedByIds($arrPids, $blnFeatured = null, $intLimit = 0, $intOffset = 0, array $arrOptions = array())
    {
        if (!is_array($arrPids) || empty($arrPids)) {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = array("$t.id IN(" . implode(',', array_map('intval', $arrPids)) . ")");

        if ($blnFeatured === true) {
            $arrColumns[] = "$t.featured=1";
        } elseif ($blnFeatured === false) {
            $arrColumns[] = "$t.featured=''";
        }

        // Never return unpublished elements in the back end, so they don't end up in the RSS feed
        // should we add one in the future :)
        if (!BE_USER_LOGGED_IN || TL_MODE == 'BE') {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting ASC";
        }

        $arrOptions['limit'] = $intLimit;
        $arrOptions['offset'] = $intOffset;

        return static::findBy($arrColumns, null, $arrOptions);
    }

    /**
     * Find related by their parent ID
     *
     * @param array $arrPids An array of packages set IDs
     * @param boolean $blnFeatured If true, return only featured packages, if false, return only unfeatured packages
     * @param integer $intLimit An optional limit
     * @param integer $intOffset An optional offset
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|null A collection of models or null if there are no packages
     */
    public static function findMultipleProductsByIds($arrPids, $blnFeatured = null, $intLimit = 0, $intOffset = 0, array $arrOptions = array())
    {
        if (!is_array($arrPids) || empty($arrPids)) {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = array("$t.id IN(" . implode(',', array_map('intval', $arrPids)) . ")");

        if ($blnFeatured === true) {
            $arrColumns[] = "$t.featured=1";
        } elseif ($blnFeatured === false) {
            $arrColumns[] = "$t.featured=''";
        }

        // Never return unpublished elements in the back end, so they don't end up in the RSS feed
        // should we add one in the future :)
        if (!BE_USER_LOGGED_IN || TL_MODE == 'BE') {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting ASC";
        }

        $arrOptions['limit'] = $intLimit;
        $arrOptions['offset'] = $intOffset;

        return static::findBy($arrColumns, null, $arrOptions);
    }
}
