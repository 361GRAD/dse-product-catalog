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
    public static function getAllTags($tagSetId) {
        $t = static::$strTable;
        
        $arrTags = \Database::getInstance()
            ->prepare("SELECT * FROM $t WHERE published=1 AND pid=$tagSetId ORDER BY sorting ASC")
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
    public static function getOnlyPublishedTags($arrTags) {
        if (!is_array($arrTags) || empty($arrTags)) {
            return null;
        }

        $t = static::$strTable;

        $arrTagPids = \Database::getInstance()
            ->execute("SELECT id FROM $t WHERE published=1 AND " . \Database::getInstance()->findInSet('id', $arrTags))
            ->fetchAllAssoc()
        ;

        return array_unique($arrTagPids);
    }

}
