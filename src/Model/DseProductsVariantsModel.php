<?php

namespace Dse\ProductCatalogBundle\Model;

use Contao\Model;
use Contao\Database;

class DseProductsVariantsModel extends \Model
{

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_dse_products_variants';

    /**
     * Find all variants
     *
     * @param string $psku The parent sku
     * @param string $variants_category The variants category
     *
     * @return array|null an array or null if there are no products
     */
    public static function findByPsku($psku, $variants_category)
    {
        // Get all columns with categroy name
        $arrColNames = ["sku"];
        $arrCols = Database::getInstance()
            ->prepare("SHOW COLUMNS FROM " . static::$strTable)
            ->execute()
        ;
        while($arrCols->next()) {
            if (strpos($arrCols->Field, $variants_category) !== false) {
                $arrColNames[] = $arrCols->Field;
            }
        }

        $arrVariants[0] = $arrColNames;

        // Only select the columns for the product variant category
        $arrVariants[] = Database::getInstance()
            ->prepare("SELECT " . implode(',', $arrColNames) . " FROM " . static::$strTable . " WHERE psku='" . $psku . "' AND category='" . $variants_category . "' AND language='" . $GLOBALS['TL_LANGUAGE'] . "' ORDER BY sorting ASC")
            ->execute()
            ->fetchAllAssoc()
        ;

        // Only get cols which have values
		$i = 0;
		$arrvalues = [];
		$myarray = $arrVariants[1];
		foreach($myarray as $myarr) {
			foreach($myarr as $key=>$value) {
				if(strlen($value) != 0) {
					$arrvalues[$key] = "";
				}
			}
			$myarray[$i] = array_intersect_key($myarray[$i], $arrvalues);

			$i++;
        }

        $arrVariants[0] = array_intersect_key(array_flip($arrColNames), $arrvalues);
        $arrVariants[1] = $myarray;

        return $arrVariants;
    }

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
