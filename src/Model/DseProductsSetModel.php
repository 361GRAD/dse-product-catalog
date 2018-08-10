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

/**
 * Class ProductsSetModel
 *
 * @package   BcatProducts
 * @author    Yuriy Davats 
 * @link      http://www.bcat.eu
 * @license   GNU
 */
class DseProductsSetModel extends \Model {

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_dse_products_set';

    /**
     * Find multiple packages sets by their IDs
     * 
     * @param array $arrIds     An array of archive IDs
     * @param array $arrOptions An optional options array
     * 
     * @return \Model\Collection|null A collection of models or null if there are no packages sets
     */
    public static function findMultipleByIds($arrIds, array $arrOptions=array()) {
        if (!is_array($arrIds) || empty($arrIds)) {
            return null;
        }

        $t = static::$strTable;

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = \Database::getInstance()->findInSet("$t.id", $arrIds);
        }

        return static::findBy(array("$t.id IN(" . implode(',', array_map('intval', $arrIds)) . ")"), null, $arrOptions);
    }

}
