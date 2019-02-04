<?php

namespace Dse\ProductCatalogBundle\Model;

use Contao\Model;
use Contao\Database;
use Dse\ProductCatalogBundle\Model\DseProductsModel;
use Haste\IO\Reader\ArrayReader;
use Haste\IO\Writer\CsvFileWriter;

class DseProductsExport extends \Model
{
    /**
     * Name of the table
     * @var string
     */
    protected static $strTableSet = 'tl_dse_products_set';
    protected static $strTable = 'tl_dse_products';

    public static function dateFormat($tstamp)
    {
        return \Date::parse($GLOBALS['TL_CONFIG']['datimFormat'], $tstamp);
    }

    public static function stringFormat($string)
    {
        $unsArr = unserialize($string);
        $str = "";
        for($i=0; $i<count($unsArr); $i++) {
            if(is_array($unsArr[$i])) {
                $j = 1;
                foreach($unsArr[$i] as $key => $value) {
                    if($value) {
                        if($j < count($unsArr[$i])) {
                            $str .= $key . ": " . $value." ";
                        } else {
                            $str .= $key . ": " . $value;
                        }
                    }
                    $j++;
                }
            }
        }
        return $str;
    }

    public static function export()
    {
        // Get set IDs
        $arrIds = [];
        $i = 0;
        $arrSets = Database::getInstance()
            ->prepare("SELECT * FROM " . static::$strTableSet . " ORDER BY id")
            ->execute()
        ;
        while($arrSets->next()) {
            $arrIds[$i] = $arrSets->id;
            $i++;
        }

        // Get database column names
        $arrColNames = [];
        $j = 0;
        $arrCols = Database::getInstance()
            ->prepare("SHOW COLUMNS FROM " . static::$strTable)
            ->execute()
        ;
        while($arrCols->next()) {
            $arrColNames[$j] = $GLOBALS['TL_LANG']['MSC']['EXPORT'][$arrCols->Field];
            $j++;
        }

        // Initialize reader from model collection
        // $objReader = new \Haste\IO\Reader\ModelCollectionReader(DseProductsModel::findAllByPids(array('20')));
        $objReader = new \Haste\IO\Reader\ModelCollectionReader(DseProductsModel::findAllByPids($arrIds));

        // Initialize writer
        $objWriter = new \Haste\IO\Writer\CsvFileWriter();

        // Add header fields
        $objReader->setHeaderFields($arrColNames);
        $objWriter->enableHeaderFields();

        // Set row callback
        $objWriter->setRowCallback(function($arrRow) {
            $arrRow['tstamp'] = static::dateFormat($arrRow['tstamp']);
            $arrRow['singleSRC'] = \FilesModel::findByPk($arrRow['singleSRC'])->path;
            $arrRow['main_image_size'] = static::stringFormat($arrRow['main_image_size']);
            $arrRow['im_1_ct_img'] = \FilesModel::findByPk($arrRow['im_1_ct_img'])->path;
            $arrRow['im_2_ct_img'] = \FilesModel::findByPk($arrRow['im_2_ct_img'])->path;
            $arrRow['im_3_ct_img'] = \FilesModel::findByPk($arrRow['im_3_ct_img'])->path;
            $arrRow['im_4_ct_img'] = \FilesModel::findByPk($arrRow['im_4_ct_img'])->path;
            $arrRow['im_5_ct_img'] = \FilesModel::findByPk($arrRow['im_5_ct_img'])->path;
            $arrRow['bf_textarea_headline'] = str_replace(PHP_EOL, '', $arrRow['bf_textarea_headline']);
            $arrRow['bf_textarea_left'] = str_replace(PHP_EOL, '', $arrRow['bf_textarea_left']);
            $arrRow['bf_textarea_right'] = str_replace(PHP_EOL, '', $arrRow['bf_textarea_right']);
            $arrRow['bf_field_textarea_headline'] = str_replace(PHP_EOL, '', $arrRow['bf_field_textarea_headline']);
            $arrRow['bf_field_textarea_text'] = str_replace(PHP_EOL, '', $arrRow['bf_field_textarea_text']);
            $arrRow['bf_field_textarea_left'] = str_replace(PHP_EOL, '', $arrRow['bf_field_textarea_left']);
            $arrRow['bf_field_textarea_right'] = str_replace(PHP_EOL, '', $arrRow['bf_field_textarea_right']);
            $arrRow['bf_img_1'] = \FilesModel::findByPk($arrRow['bf_img_1'])->path;
            $arrRow['bf_img_1_size'] = static::stringFormat($arrRow['bf_img_1_size']);
            $arrRow['bf_img_2'] = \FilesModel::findByPk($arrRow['bf_img_2'])->path;
            $arrRow['bf_img_2_size'] = static::stringFormat($arrRow['bf_img_2_size']);
            $arrRow['bf_img_3'] = \FilesModel::findByPk($arrRow['bf_img_3'])->path;
            $arrRow['bf_img_3_size'] = static::stringFormat($arrRow['bf_img_3_size']);
            $arrRow['bf_img_4'] = \FilesModel::findByPk($arrRow['bf_img_4'])->path;
            $arrRow['bf_img_4_size'] = static::stringFormat($arrRow['bf_img_4_size']);
            $arrRow['bf_img_5'] = \FilesModel::findByPk($arrRow['bf_img_5'])->path;
            $arrRow['bf_img_5_size'] = static::stringFormat($arrRow['bf_img_5_size']);
            $arrRow['bf_img_6'] = \FilesModel::findByPk($arrRow['bf_img_6'])->path;
            $arrRow['bf_img_6_size'] = static::stringFormat($arrRow['bf_img_6_size']);
            $arrRow['reasons_image'] = \FilesModel::findByPk($arrRow['reasons_image'])->path;
            $arrRow['reasons_image_size'] = static::stringFormat($arrRow['reasons_image_size']);
            $arrRow['reasons_list'] = static::stringFormat($arrRow['reasons_list']);
            $arrRow['applications_field_big_image'] = \FilesModel::findByPk($arrRow['applications_field_big_image'])->path;
            $arrRow['applications_field_big_image_size'] = static::stringFormat($arrRow['applications_field_big_image_size']);
            $arrRow['applications_field_small_1_image'] = \FilesModel::findByPk($arrRow['applications_field_small_1_image'])->path;
            $arrRow['applications_field_small_1_image_size'] = static::stringFormat($arrRow['applications_field_small_1_image_size']);
            $arrRow['applications_field_small_2_image'] = \FilesModel::findByPk($arrRow['applications_field_small_2_image'])->path;
            $arrRow['applications_field_small_2_image_size'] = static::stringFormat($arrRow['applications_field_small_2_image_size']);
            $arrRow['applications_field_big_2_image'] = \FilesModel::findByPk($arrRow['applications_field_big_2_image'])->path;
            $arrRow['applications_field_big_2_image_size'] = static::stringFormat($arrRow['applications_field_big_2_image_size']);
            $arrRow['applications_field_small_3_image'] = \FilesModel::findByPk($arrRow['applications_field_small_3_image'])->path;
            $arrRow['applications_field_small_3_image_size'] = static::stringFormat($arrRow['applications_field_small_3_image_size']);
            $arrRow['applications_field_small_4_image'] = \FilesModel::findByPk($arrRow['applications_field_small_4_image'])->path;
            $arrRow['applications_field_small_4_image_size'] = static::stringFormat($arrRow['applications_field_small_4_image_size']);
            $arrRow['downloads_file_1'] = \FilesModel::findByPk($arrRow['downloads_file_1'])->path;
            $arrRow['downloads_file_2'] = \FilesModel::findByPk($arrRow['downloads_file_2'])->path;
            $arrRow['downloads_file_3'] = \FilesModel::findByPk($arrRow['downloads_file_3'])->path;
            $arrRow['downloads_file_4'] = \FilesModel::findByPk($arrRow['downloads_file_4'])->path;
            $arrRow['downloads_file_5'] = \FilesModel::findByPk($arrRow['downloads_file_5'])->path;
            $arrRow['downloads_file_6'] = \FilesModel::findByPk($arrRow['downloads_file_6'])->path;
            $arrRow['downloads_file_7'] = \FilesModel::findByPk($arrRow['downloads_file_7'])->path;
            $arrRow['downloads_file_8'] = \FilesModel::findByPk($arrRow['downloads_file_8'])->path;
            $arrRow['downloads_file_9'] = \FilesModel::findByPk($arrRow['downloads_file_9'])->path;
            $arrRow['downloads_file_10'] = \FilesModel::findByPk($arrRow['downloads_file_10'])->path;
            $arrRow['order_data'] = static::stringFormat($arrRow['order_data']);
            $arrRow['tech_data_image_size'] = static::stringFormat($arrRow['tech_data_image_size']);
            $arrRow['tech_data_image'] = \FilesModel::findByPk($arrRow['tech_data_image'])->path;
            $arrRow['description'] = str_replace(PHP_EOL, '', $arrRow['description']);
            $arrRow['thumb_image_size'] = static::stringFormat($arrRow['thumb_image_size']);
            $arrRow['thumb_image'] = \FilesModel::findByPk($arrRow['thumb_image'])->path;

            return $arrRow;
        });

        // Create a file
        $objWriter->writeFrom($objReader);

        // Download the file
        $objFile = new \File($objWriter->getFilename());
        $objFile->sendToBrowser();
    }
}
