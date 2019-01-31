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
            $arrColNames[$j] = $arrCols->Field;
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
//            return array(
//                $arrRow['id'],
//                $arrRow['pid'],
//
//                $arrRow['sorting'],
//                $arrRow['type'],
//                $arrRow['title'],
//                $arrRow['alias'],
//                $arrRow['sku'],
//
//                $arrRow['main_image_alt'],
//                $arrRow['related'],
//                $arrRow['add_image_map'],
//                $arrRow['im_1_x_coord'],
//                $arrRow['im_1_y_coord'],
//
//                $arrRow['im_1_ct_hl'],
//                $arrRow['im_1_ct_txt'],
//                $arrRow['im_2_x_coord'],
//                $arrRow['im_2_y_coord'],
//
//                $arrRow['im_2_ct_hl'],
//                $arrRow['im_2_ct_txt'],
//                $arrRow['im_3_x_coord'],
//                $arrRow['im_3_y_coord'],
//
//                $arrRow['im_3_ct_hl'],
//                $arrRow['im_3_ct_txt'],
//                $arrRow['im_4_x_coord'],
//                $arrRow['im_4_y_coord'],
//
//                $arrRow['im_4_ct_hl'],
//                $arrRow['im_4_ct_txt'],
//                $arrRow['im_5_x_coord'],
//                $arrRow['im_5_y_coord'],
//
//                $arrRow['im_5_ct_hl'],
//                $arrRow['im_5_ct_txt'],
//                $arrRow['bf_exclude_menu'],
//                $arrRow['bf_headline'],
//                $arrRow['bf_hl_text'],
//
//
//
//
//
//
//
//
//
//                $arrRow['bf_img_1_alt'],
//
//
//                $arrRow['bf_img_2_alt'],
//
//
//                $arrRow['bf_img_3_alt'],
//
//
//                $arrRow['bf_img_4_alt'],
//
//
//                $arrRow['bf_img_5_alt'],
//
//
//                $arrRow['bf_img_6_alt'],
//                $arrRow['reasons_exclude_menu'],
//                $arrRow['reasons_headline'],
//
//
//                $arrRow['reasons_image_alt'],
//
//                $arrRow['applications_exclude_menu'],
//                $arrRow['applications_headline'],
//                $arrRow['applications_text'],
//                $arrRow['applications_field_big_title'],
//
//
//                $arrRow['applications_field_big_image_alt'],
//                $arrRow['applications_field_small_1_title'],
//
//
//                $arrRow['applications_field_small_1_image_alt'],
//                $arrRow['applications_field_small_2_title'],
//
//
//                $arrRow['applications_field_small_2_image_alt'],
//                $arrRow['applications_field_big_2_title'],
//
//
//                $arrRow['applications_field_big_2_image_alt'],
//                $arrRow['applications_field_small_3_title'],
//
//
//                $arrRow['applications_field_small_3_image_alt'],
//                $arrRow['applications_field_small_4_title'],
//
//
//                $arrRow['applications_field_small_4_image_alt'],
//                $arrRow['video_exclude_menu'],
//                $arrRow['video_headline'],
//                $arrRow['video_text'],
//                $arrRow['video_link'],
//                $arrRow['downloads_exclude_menu'],
//                $arrRow['downloads_headline'],
//                $arrRow['downloads_text'],
//                $arrRow['downloads_file_1_title'],
//                
//                $arrRow['downloads_file_2_title'],
//                
//                $arrRow['downloads_file_3_title'],
//                
//                $arrRow['downloads_file_4_title'],
//                
//                $arrRow['downloads_file_5_title'],
//                
//                $arrRow['downloads_file_6_title'],
//                
//                $arrRow['downloads_file_7_title'],
//                
//                $arrRow['downloads_file_8_title'],
//                
//                $arrRow['downloads_file_9_title'],
//                
//                $arrRow['downloads_file_10_title'],
//                
//                $arrRow['attr_headline'],
//                $arrRow['attr_text'],
//                $arrRow['attr_bm_nennaufnahmeleistung'],
//                $arrRow['attr_bm_maschinengewicht'],
//                $arrRow['attr_bm_schrauben_weichholz_ohne_vorbohren'],
//                $arrRow['attr_bm_festdrehmoment'],
//                $arrRow['attr_bm_bohrspindelgewinde'],
//                $arrRow['attr_bm_spannhals'],
//                $arrRow['attr_bm_spannbereich_bohrfutter'],
//                $arrRow['attr_bm_durchsch_holz_1_gang_forstner'],
//                $arrRow['attr_bm_durchsch_holz_2_gang_forstner'],
//                $arrRow['attr_bm_drehzahl_nennlast_1_gang'],
//                $arrRow['attr_bm_drehzahl_nennlast_2_gang'],
//                $arrRow['attr_bm_schrauben_bis'],
//                $arrRow['attr_bm_durchsch_stahl_1_gang'],
//                $arrRow['attr_bm_durchsch_stahl_2_gang'],
//                $arrRow['attr_bm_durchsch_holz_1_gang'],
//                $arrRow['attr_bm_durchsch_holz_2_gang'],
//                $arrRow['attr_bm_durchsch_baustoff_1_gang'],
//                $arrRow['attr_bm_durchsch_baustoff_2_gang'],
//                $arrRow['attr_bm_durchsch_stein_1_gang'],
//                $arrRow['attr_bm_durchsch_stein_2_gang'],
//                $arrRow['attr_bm_durchsch_mauer_1_gang'],
//                $arrRow['attr_bm_schlagzahl_max'],
//                $arrRow['attr_bm_bohrbereich_stahl'],
//                $arrRow['attr_bm_bohrbereich_holz'],
//                $arrRow['attr_bm_bohrbereich_polypropylen'],
//                $arrRow['attr_bm_drehzahlen'],
//                $arrRow['attr_bm_werkzeugaufnahme'],
//                $arrRow['attr_bm_maschinentyp'],
//                $arrRow['attr_bm_einsatzgebiete'],
//                $arrRow['attr_bh_nennaufnahmeleistung'],
//                $arrRow['attr_bh_maschinengewicht'],
//                $arrRow['attr_bh_werkzeugaufnahme'],
//                $arrRow['attr_bh_bohrbereich_vollbohrer'],
//                $arrRow['attr_bh_bohrbereich_stahl'],
//                $arrRow['attr_bh_bohrleistung'],
//                $arrRow['attr_bh_einzelschlagenergie'],
//                $arrRow['attr_bh_drehzahl_nennlast'],
//                $arrRow['attr_bh_schlagzahl'],
//                $arrRow['attr_nt_nennaufnahmeleistung'],
//                $arrRow['attr_nt_maschinengewicht'],
//                $arrRow['attr_nt_werkzeugaufnahme'],
//                $arrRow['attr_nt_drehzahl_nennlast_gang'],
//                $arrRow['attr_nt_drehzahl_nennlast_01'],
//                $arrRow['attr_nt_bohrbereich_diamant_trocken'],
//                $arrRow['attr_nt_bohrbereich_diamant_nass'],
//                $arrRow['attr_nt_bohrbereich_diamant_staender_nass'],
//                $arrRow['attr_nt_bohrbereich_diamant_beton_hand_nass'],
//                $arrRow['attr_nt_bohrbereich_ls_kunststoff_hand'],
//                $arrRow['attr_nt_bohrbereich_ls_kunststoff_staender'],
//                $arrRow['attr_nt_bohrbereich_ls_kunststoff_stativ'],
//                $arrRow['attr_nt_bohrbereich_lb_hand'],
//                $arrRow['attr_nt_bohrbereich_lb_staender'],
//                $arrRow['attr_nt_bohrbereich_lb_stativ'],
//                $arrRow['attr_nt_drehzahl_nennlast_02'],
//                $arrRow['attr_nt_einsatzgebiete'],
//                $arrRow['attr_nt_untergruende'],
//                $arrRow['attr_t_nennaufnahmeleistung'],
//                $arrRow['attr_t_maschinengewicht'],
//                $arrRow['attr_t_werkzeugaufnahme'],
//                $arrRow['attr_t_drehzahl_nennlast_gang'],
//                $arrRow['attr_t_drehzahl_nennlast_01'],
//                $arrRow['attr_t_bohrbereich_diamant_hand_trocken'],
//                $arrRow['attr_t_bohrbereich_ls_kunststoff_hand'],
//                $arrRow['attr_t_bohrbereich_ls_kunststoff_staender'],
//                $arrRow['attr_t_bohrbereich_ls_kunststoff_stativ'],
//                $arrRow['attr_t_bohrbereich_lb_hand'],
//                $arrRow['attr_t_bohrbereich_lb_staender'],
//                $arrRow['attr_t_bohrbereich_lb_stativ'],
//                $arrRow['attr_t_drehzahl_nennlast_02'],
//                $arrRow['attr_t_einsatzgebiete'],
//                $arrRow['attr_t_untergruende'],
//                $arrRow['attr_t_anbohren'],
//                $arrRow['attr_t_led'],
//                $arrRow['attr_n_nennaufnahmeleistung'],
//                $arrRow['attr_n_maschinengewicht'],
//                $arrRow['attr_n_werkzeugaufnahme'],
//                $arrRow['attr_n_drehzahl_nennlast_gang'],
//                $arrRow['attr_n_drehzahl_nennlast_01'],
//                $arrRow['attr_n_bohrbereich_hand_nass'],
//                $arrRow['attr_n_bohrbereich_staender_nass_01'],
//                $arrRow['attr_n_bohrbereich_1_gang'],
//                $arrRow['attr_n_bohrbereich_2_gang'],
//                $arrRow['attr_n_bohrbereich_3_gang'],
//                $arrRow['attr_n_drehzahl_nennlast_02'],
//                $arrRow['attr_n_einsatzgebiete'],
//                $arrRow['attr_n_untergruende'],
//                $arrRow['attr_n_drehzahl_stufenlos'],
//                $arrRow['attr_n_anbohren'],
//                $arrRow['attr_n_feindosiereung'],
//                $arrRow['attr_n_bohrbereich_staender_nass_02'],
//                $arrRow['attr_n_led'],
//                $arrRow['attr_bome_nennaufnahmeleistung'],
//                $arrRow['attr_bome_maschinengewicht'],
//                $arrRow['attr_bome_werkzeugaufnahme'],
//                $arrRow['attr_bome_bohrbereich_vollbohrer'],
//                $arrRow['attr_bome_bohrbereich_hammerbohrkrone'],
//                $arrRow['attr_bome_bohrleistung_beton_30mm'],
//                $arrRow['attr_bome_bohrleistung_beton_35mm'],
//                $arrRow['attr_bome_bohrleistung_beton_22mm'],
//                $arrRow['attr_bome_bohrleistung_beton_20mm'],
//                $arrRow['attr_bome_bohrleistung_beton_25mm'],
//                $arrRow['attr_bome_bohrleistung_beton_14mm'],
//                $arrRow['attr_bome_einzelschlagenergie'],
//                $arrRow['attr_bome_drehzahl_nennlast'],
//                $arrRow['attr_bome_schlagzahl'],
//                $arrRow['attr_bome_messleistung_spitzmeissel'],
//                $arrRow['attr_bome_vibration_normal'],
//                $arrRow['attr_bome_vibration_kompressor'],
//                $arrRow['attr_bome_vibration_daempfelement'],
//                $arrRow['attr_bome_schalterarretierung'],
//                $arrRow['attr_bome_led'],
//                $arrRow['attr_mh_nennaufnahmeleistung'],
//                $arrRow['attr_mh_maschinengewicht'],
//                $arrRow['attr_mh_werkzeugaufnahme'],
//                $arrRow['attr_mh_einzelschlagenergie'],
//                $arrRow['attr_mh_schlagzahl'],
//                $arrRow['attr_mh_leistung_spitzmeissel'],
//                $arrRow['attr_mh_vibration_normal'],
//                $arrRow['attr_mh_vibration_kompressor'],
//                $arrRow['attr_mh_vibration_daempfelement'],
//                $arrRow['attr_mh_led'],
//                $arrRow['attr_mh_schalterarretierung'],
//                $arrRow['attr_ah_nennaufnahmeleistung'],
//                $arrRow['attr_ah_maschinengewicht'],
//                $arrRow['attr_ah_werkzeugaufnahme'],
//                $arrRow['attr_ah_einzelschlagenergie'],
//                $arrRow['attr_ah_schlagzahl'],
//                $arrRow['attr_ah_leistung_spitzmeissel'],
//                $arrRow['attr_ah_vibration_normal'],
//                $arrRow['attr_ah_vibration_kompressor'],
//                $arrRow['attr_ah_vibration_daempfelement'],
//                $arrRow['attr_ah_led'],
//                $arrRow['attr_ah_schalterarretierung'],
//                $arrRow['attr_zu_bs_max_bohrdurchschnitt'],
//                $arrRow['attr_zu_bs_max_bohrdurchschnitt_wassersammelring'],
//                $arrRow['attr_zu_bs_hub'],
//                $arrRow['attr_zu_bs_saeulenlaenge'],
//                $arrRow['attr_zu_bs_schraegverstellung'],
//                $arrRow['attr_zu_bs_bohrstaenderfuss'],
//                $arrRow['attr_zu_bs_gewicht'],
//                $arrRow['attr_zu_bs_befestigung'],
//                $arrRow['attr_zu_bs_maschinenempfehlung'],
//                $arrRow['attr_zu_is_gewicht'],
//                $arrRow['attr_zu_is_max_leistung'],
//                $arrRow['attr_zu_is_max_volumenstrom'],
//                $arrRow['attr_zu_is_max_unterdruck'],
//                $arrRow['attr_zu_is_behaeltervolumen_brutto'],
//                $arrRow['attr_zu_is_saugschlauch'],
//                $arrRow['attr_zu_is_schutzklasse'],
//                $arrRow['attr_zu_ag_bohrbereich'],
//                $arrRow['attr_zu_ag_hammer_trocken'],
//                $arrRow['attr_zu_ag_diamant_nass'],
//                $arrRow['attr_zu_ag_anschluss'],
//                $arrRow['attr_zu_sa_anschluss'],
//                $arrRow['attr_zu_sa_duss_maschinen'],
//                $arrRow['attr_zu_sa_weitere_maschinen'],
//                $arrRow['attr_zu_sa_meissel_laenge'],
//                $arrRow['attr_zu_sa_meissel_vlma'],
//                $arrRow['attr_zu_ah_anschluss'],
//                $arrRow['attr_zu_ah_bohrbereich'],
//                $arrRow['attr_zu_ah_systemprodukte'],
//                $arrRow['attr_zu_lc_drehzahlbereich_holz_25mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_kunststoff_25mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_holz_2635mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_kunststoff_2635mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_holz_3645mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_kunststoff_3645mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_holz_4660mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_kunststoff_4660mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_holz_6180mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_kunststoff_6180mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_holz_81110mm'],
//                $arrRow['attr_zu_lc_drehzahlbereich_kunststoff_81110mm'],
//                $arrRow['attr_zu_lc_anschlussgewinde'],
//                $arrRow['attr_zu_lc_bohrtiefe'],
//                $arrRow['attr_zu_lslb_maschinenempfehlung'],
//                $arrRow['attr_zu_lslb_anschlussgewinde'],
//                $arrRow['attr_zu_lslb_bohrtiefe'],
//                $arrRow['attr_zu_lslb_drehzahlbereich_4082mm'],
//                $arrRow['attr_zu_lslb_drehzahlbereich_83142mm'],
//                $arrRow['attr_zu_lslb_drehzahlbereich_143202mm'],
//                $arrRow['attr_zu_lslb_drehzahlbereich_203322mm'],
//                $arrRow['attr_zu_bst_max_bohrdurchschnitt'],
//                $arrRow['attr_zu_bst_hub'],
//                $arrRow['attr_zu_bst_gewicht'],
//                $arrRow['attr_zu_bst_maschinenempfehlungen'],
//                $arrRow['attr_zu_bst_maschinenhalter'],
//                $arrRow['attr_zu_bst_kanalrohr'],
//                $arrRow['attr_zu_bst_max_bohrkronenlaenge'],
//                $arrRow['attr_zu_an_lochsaege'],
//                $arrRow['attr_zu_an_duss_lochsaegen'],
//                $arrRow['attr_zu_an_fremdlochsaegen'],
//                $arrRow['attr_zu_an_sechskant'],
//                $arrRow['attr_zu_ep_lochsaege'],
//                $arrRow['attr_zu_ep_duss_lochsaegen'],
//                $arrRow['attr_zu_ep_fremdlochsaegen'],
//                $arrRow['attr_zu_ep_bohrfutter'],
//                $arrRow['attr_zu_ep_aufnahme'],
//                $arrRow['order_data_headline'],
//
//                $arrRow['published'],
//                $arrRow['featured'],
//                $arrRow['start'],
//                $arrRow['stop'],
//                $arrRow['tech_data_image_alt'],
//
//
//
//                $arrRow['subheadline'],
//                $arrRow['order_data_text'],
//                $arrRow['thumb_image_alt'],
//
//
//                $arrRow['order_data_exclude_menu'],
//                $arrRow['attr_exclude_menu'],
//            );
        });

        // Create a file
        $objWriter->writeFrom($objReader);

        // Download the file
        $objFile = new \File($objWriter->getFilename());
        $objFile->sendToBrowser();
    }
}
