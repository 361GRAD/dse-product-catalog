<?php

namespace Dse\ProductCatalogBundle\Model;

use Contao\Model;

class DseProductsVariantsModel extends \Model
{

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_dse_products_variants';

    /**
     * Find variant by it's sku
     *
     * @param string $strId The products sku
     * @param integer $intLimit An optional limit
     * @param array $arrOptions An optional options array
     *
     * @return object|null A collection of models or null if there are no products
     */
    public static function findBySku($strId, $intLimit = 0, array $arrOptions = array())
    {
        $t = static::$strTable;

        $arrColumns = array("$t.sku=?");

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting ASC";
        }

        if ($intLimit > 0) {
            $arrOptions['limit'] = $intLimit;
        }

        return static::findBy($arrColumns, $strId, $arrOptions);
    }
}
