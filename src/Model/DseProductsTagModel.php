<?php

namespace Dse\ProductCatalogBundle\Model;

class DseProductsTagModel extends \Model {

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_dse_products_tag';

    /**
     * Get all tags
     * 
     * @return array
     */
    public static function getAllTags() {
        $t = static::$strTable;

        $arrTags = \Database::getInstance()
            ->prepare("SELECT * FROM $t WHERE pids !='' ORDER BY title")
            ->execute()
            ->fetchAllAssoc()
        ;
        
        return $arrTags;
    }

    /**
     * Find multiple packages sets by their IDs
     * 
     * @param array $arrIds     An array of archive IDs
     * @param array $arrOptions An optional options array
     * 
     * @return \Model\Collection|null A collection of models or null if there are no packages sets
     */
    public static function getProductsIdsFromSelectedTags($arrIds) {
        if (!is_array($arrIds) || empty($arrIds)) {
            return null;
        }

        $t = static::$strTable;

        $arrTagPids = \Database::getInstance()->execute("SELECT * FROM $t WHERE " . \Database::getInstance()->findInSet('id', $arrIds))->fetchAllAssoc();

        $arrSelectedPids = [];
        foreach($arrTagPids as $tagPids) {
            $arrSelectedPids = array_merge($arrSelectedPids, unserialize($tagPids["pids"]));
        }

        return array_unique($arrSelectedPids);
    }

}
