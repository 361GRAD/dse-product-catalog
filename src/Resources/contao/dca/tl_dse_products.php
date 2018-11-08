<?php

$GLOBALS['TL_DCA']['tl_dse_products'] = array(
    'config' => array(
        'dataContainer' => 'Table',
        'ptable' => 'tl_dse_products_set',
        'ctable' => array('tl_content'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => array(
            'keys' => array(
                'id' => 'primary',
                'pid' => 'index',
            )
        ),
    ),

    'list' => array(
//        'sorting' => array(
//            'mode' => 2,
//            'fields' => array(
//                'sku',
//                'type',
//                'title'
//            ),
//            'flag' => 3,
//            'panelLayout' => 'filter;sort,search,limit'
//        ),
        'sorting' => array(
            'mode' => 4,
            'fields' => array('sorting'),
            'headerFields' => array('title'),
            'panelLayout' => 'filter;sort,search,limit',
            'disableGrouping' => true,
            'child_record_callback' => array('tl_dse_products', 'listRows'),
//            'child_record_class' => 'row_class'
        ),
        'label' => array(
            'fields' => array(
                'sku',
                'type',
                'title'
            ),
            'showColumns' => true,
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
            'edit' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['edit'],
                'href' => 'table=tl_content',
                'icon' => 'edit.svg'
            ),
            'editheader' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ),
            'copy' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.svg'
            ),
            'cut' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['cut'],
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            ),
            'delete' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm']
                    . '\'))return false;Backend.getScrollOffset()"'
            ),
//            'feature' => array(
//                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['feature'],
//                'icon' => 'featured.svg',
//                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleFeatured(this,%s)"',
//                'button_callback' => array('tl_dse_products', 'featureIcon')
//            ),
            'toggle' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['toggle'],
                'icon' => 'visible.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_dse_products', 'toggleIcon')
            ),
            'show' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['show'],
                'href' => 'act=show',
                'icon' => 'show.svg',
                'attributes' => 'style="margin-right:3px;"'
            ),
        ),
    ),

    'palettes' => array(
        '__selector__'      =>  array('type', 'featured', 'add_image_map', 'add_additional_images'),
        'default'           =>  '{product_legend},type;',
        'type_bm'           =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_headline,attr_text,attr_bm_nennaufnahmeleistung,attr_bm_maschinengewicht,attr_bm_schrauben_weichholz_ohne_vorbohren,attr_bm_festdrehmoment,attr_bm_bohrspindelgewinde,attr_bm_spannhals,attr_bm_spannbereich_bohrfutter,attr_bm_durchsch_holz_1_gang_forstner,attr_bm_durchsch_holz_2_gang_forstner,attr_bm_drehzahl_nennlast_1_gang,attr_bm_drehzahl_nennlast_2_gang,attr_bm_schrauben_bis,attr_bm_durchsch_stahl_1_gang,attr_bm_durchsch_stahl_2_gang,attr_bm_durchsch_holz_1_gang,attr_bm_durchsch_holz_2_gang,attr_bm_durchsch_baustoff_1_gang,attr_bm_durchsch_baustoff_2_gang,attr_bm_durchsch_stein_1_gang,attr_bm_durchsch_stein_2_gang,attr_bm_durchsch_mauer_1_gang,attr_bm_schlagzahl_max,attr_bm_bohrbereich_stahl,attr_bm_bohrbereich_holz,attr_bm_bohrbereich_polypropylen,attr_bm_drehzahlen,attr_bm_werkzeugaufnahme,attr_bm_maschinentyp,attr_bm_einsatzgebiete;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_bh'           =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_bh_nennaufnahmeleistung,attr_bh_maschinengewicht,attr_bh_werkzeugaufnahme,attr_bh_bohrbereich_vollbohrer,attr_bh_bohrbereich_stahl,attr_bh_bohrleistung,attr_bh_einzelschlagenergie,attr_bh_drehzahl_nennlast,attr_bh_schlagzahl;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_nt'           =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_nt_nennaufnahmeleistung,attr_nt_maschinengewicht,attr_nt_werkzeugaufnahme,attr_nt_drehzahl_nennlast_gang,attr_nt_drehzahl_nennlast_01,attr_nt_bohrbereich_diamant_trocken,attr_nt_bohrbereich_diamant_nass,attr_nt_bohrbereich_diamant_staender_nass,attr_nt_bohrbereich_diamant_beton_hand_nass,attr_nt_bohrbereich_ls_kunststoff_hand,attr_nt_bohrbereich_ls_kunststoff_staender,attr_nt_bohrbereich_ls_kunststoff_stativ,attr_nt_bohrbereich_lb_hand,attr_nt_bohrbereich_lb_staender,attr_nt_bohrbereich_lb_stativ,attr_nt_drehzahl_nennlast_02,attr_nt_einsatzgebiete,attr_nt_untergruende;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_t'            =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_t_nennaufnahmeleistung,attr_t_maschinengewicht,attr_t_werkzeugaufnahme,attr_t_drehzahl_nennlast_gang,attr_t_drehzahl_nennlast_01,attr_t_bohrbereich_diamant_hand_trocken,attr_t_bohrbereich_ls_kunststoff_hand,attr_t_bohrbereich_ls_kunststoff_staender,attr_t_bohrbereich_ls_kunststoff_stativ,attr_t_bohrbereich_lb_hand,attr_t_bohrbereich_lb_staender,attr_t_bohrbereich_lb_stativ,attr_t_drehzahl_nennlast_02,attr_t_einsatzgebiete,attr_t_untergruende,attr_t_anbohren,attr_t_led;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_n'            =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_n_nennaufnahmeleistung,attr_n_maschinengewicht,attr_n_werkzeugaufnahme,attr_n_drehzahl_nennlast_gang,attr_n_drehzahl_nennlast_01,attr_n_bohrbereich_hand_nass,attr_n_bohrbereich_staender_nass_01,attr_n_bohrbereich_1_gang,attr_n_bohrbereich_2_gang,attr_n_bohrbereich_3_gang,attr_n_drehzahl_nennlast_02,attr_n_einsatzgebiete,attr_n_untergruende,attr_n_drehzahl_stufenlos,attr_n_anbohren,attr_n_feindosiereung,attr_n_bohrbereich_staender_nass_02,attr_n_led;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_bome'         =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_bome_nennaufnahmeleistung,attr_bome_maschinengewicht,attr_bome_werkzeugaufnahme,attr_bome_bohrbereich_vollbohrer,attr_bome_bohrbereich_hammerbohrkrone,attr_bome_bohrleistung_beton_30mm,attr_bome_bohrleistung_beton_35mm,attr_bome_bohrleistung_beton_22mm,attr_bome_bohrleistung_beton_20mm,attr_bome_bohrleistung_beton_25mm,attr_bome_bohrleistung_beton_14mm,attr_bome_einzelschlagenergie,attr_bome_drehzahl_nennlast,attr_bome_schlagzahl,attr_bome_messleistung_spitzmeissel,attr_bome_vibration_normal,attr_bome_vibration_kompressor,attr_bome_vibration_daempfelement,attr_bome_schalterarretierung,attr_bome_led;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_mh'           =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_mh_nennaufnahmeleistung,attr_mh_maschinengewicht,attr_mh_werkzeugaufnahme,attr_mh_einzelschlagenergie,attr_mh_schlagzahl,attr_mh_leistung_spitzmeissel,attr_mh_vibration_normal,attr_mh_vibration_kompressor,attr_mh_vibration_daempfelement,attr_mh_led,attr_mh_schalterarretierung;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_ah'           =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_ah_nennaufnahmeleistung,attr_ah_maschinengewicht,attr_ah_werkzeugaufnahme,attr_ah_einzelschlagenergie,attr_ah_schlagzahl,attr_ah_leistung_spitzmeissel,attr_ah_vibration_normal,attr_ah_vibration_kompressor,attr_ah_vibration_daempfelement,attr_ah_led,attr_ah_schalterarretierung;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_bs'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_bs_max_bohrdurchschnitt,attr_zu_bs_max_bohrdurchschnitt_wassersammelring,attr_zu_bs_hub,attr_zu_bs_saeulenlaenge,attr_zu_bs_schraegverstellung,attr_zu_bs_bohrstaenderfuss,attr_zu_bs_gewicht,attr_zu_bs_befestigung,attr_zu_bs_maschinenempfehlung;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_is'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_is_gewicht,attr_zu_is_max_leistung,attr_zu_is_max_volumenstrom,attr_zu_is_max_unterdruck,attr_zu_is_behaeltervolumen_brutto,attr_zu_is_saugschlauch,attr_zu_is_schutzklasse;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_ag'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_ag_bohrbereich,attr_zu_ag_hammer_trocken,attr_zu_ag_diamant_nass,attr_zu_ag_anschluss;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_sa'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_sa_anschluss,attr_zu_sa_duss_maschinen,attr_zu_sa_weitere_maschinen,attr_zu_sa_meissel_laenge,attr_zu_sa_meissel_vlma;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_ah'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_ah_anschluss,attr_zu_ah_bohrbereich,attr_zu_ah_systemprodukte;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_lc'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_lc_drehzahlbereich_holz_25mm,attr_zu_lc_drehzahlbereich_kunststoff_25mm,attr_zu_lc_drehzahlbereich_holz_2635mm,attr_zu_lc_drehzahlbereich_kunststoff_2635mm,attr_zu_lc_drehzahlbereich_holz_3645mm,attr_zu_lc_drehzahlbereich_kunststoff_3645mm,attr_zu_lc_drehzahlbereich_holz_4660mm,attr_zu_lc_drehzahlbereich_kunststoff_4660mm,attr_zu_lc_drehzahlbereich_holz_6180mm,attr_zu_lc_drehzahlbereich_kunststoff_6180mm,attr_zu_lc_drehzahlbereich_holz_81110mm,attr_zu_lc_drehzahlbereich_kunststoff_81110mm,attr_zu_lc_anschlussgewinde,attr_zu_lc_bohrtiefe;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_lslb'      =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_lslb_maschinenempfehlung,attr_zu_lslb_anschlussgewinde,attr_zu_lslb_bohrtiefe,attr_zu_lslb_drehzahlbereich_4082mm,attr_zu_lslb_drehzahlbereich_83142mm,attr_zu_lslb_drehzahlbereich_143202mm,attr_zu_lslb_drehzahlbereich_203322mm;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_bst'       =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_bst_max_bohrdurchschnitt,attr_zu_bst_hub,attr_zu_bst_gewicht,attr_zu_bst_maschinenempfehlungen,attr_zu_bst_maschinenhalter,attr_zu_bst_kanalrohr,attr_zu_bst_max_bohrkronenlaenge;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_an'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_an_lochsaege,attr_zu_an_duss_lochsaegen,attr_zu_an_fremdlochsaegen,attr_zu_an_sechskant;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
        'type_zu_ep'        =>  '{product_legend},type,title,alias,sku,singleSRC,main_image_size,main_image_alt,subheadline,description;{image_map_legend:hide},add_image_map;{benefits_field_legend:hide},bf_exclude_menu,bf_headline,bf_hl_text,bf_textarea_headline,bf_textarea_left,bf_textarea_right,bf_field_textarea_headline,bf_field_textarea_text,bf_field_textarea_left,bf_field_textarea_right,bf_img_1,bf_img_1_size,bf_img_1_alt,bf_img_2,bf_img_2_size,bf_img_2_alt,bf_img_3,bf_img_3_size,bf_img_3_alt,bf_img_4,bf_img_4_size,bf_img_4_alt,bf_img_5,bf_img_5_size,bf_img_5_alt,bf_img_6,bf_img_6_size,bf_img_6_alt;{reasons_legend:hide},reasons_exclude_menu,reasons_headline,reasons_image,reasons_image_size,reasons_image_alt,reasons_list;{applications_legend:hide},applications_exclude_menu,applications_headline,applications_text,applications_field_big_title,applications_field_big_image,applications_field_big_image_size,applications_field_big_image_alt,applications_field_small_1_title,applications_field_small_1_image,applications_field_small_1_image_size,applications_field_small_1_image_alt,applications_field_small_2_title,applications_field_small_2_image,applications_field_small_2_image_size,applications_field_small_2_image_alt,applications_field_big_2_title,applications_field_big_2_image,applications_field_big_2_image_size,applications_field_big_2_image_alt,applications_field_small_3_title,applications_field_small_3_image,applications_field_small_3_image_size,applications_field_small_3_image_alt,applications_field_small_4_title,applications_field_small_4_image,applications_field_small_4_image_size,applications_field_small_4_image_alt;{video_legend:hide},video_exclude_menu,video_headline,video_text,video_link;{downloads_legend:hide},downloads_exclude_menu,downloads_headline,downloads_text,downloads_file_1_title,downloads_file_1,downloads_file_2_title,downloads_file_2,downloads_file_3_title,downloads_file_3,downloads_file_4_title,downloads_file_4,downloads_file_5_title,downloads_file_5,downloads_file_6_title,downloads_file_6,downloads_file_7_title,downloads_file_7,downloads_file_8_title,downloads_file_8,downloads_file_9_title,downloads_file_9,downloads_file_10_title,downloads_file_10;{attributes_legend:hide},attr_zu_ep_lochsaege,attr_zu_ep_duss_lochsaegen,attr_zu_ep_fremdlochsaegen,attr_zu_ep_bohrfutter,attr_zu_ep_aufnahme;{order_data_legend:hide},order_data_headline,order_data;{tech_data_legend:hide},tech_data_headline,tech_data_text,tech_data_image,tech_data_image_size,tech_data_image_alt;{publish_legend},published;',
    ),

    'subpalettes' => array(
        'featured' => 'start,stop',
        'add_image_map' => 'im_1_x_coord,im_1_y_coord,im_1_ct_img,im_1_ct_hl,im_1_ct_txt,im_2_x_coord,im_2_y_coord,im_2_ct_img,im_2_ct_hl,im_2_ct_txt,im_3_x_coord,im_3_y_coord,im_3_ct_img,im_3_ct_hl,im_3_ct_txt,im_4_x_coord,im_4_y_coord,im_4_ct_img,im_4_ct_hl,im_4_ct_txt,im_5_x_coord,im_5_y_coord,im_5_ct_img,im_5_ct_hl,im_5_ct_txt',
        'add_additional_images' => 'additional_images'
    ),

    'fields' => array(
        'id' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['id'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'sql' => 'int(10) unsigned NOT NULL auto_increment'
        ),
        'pid' => array(
            'foreignKey' => 'tl_dse_products_set.title',
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array(
                'type' => 'belongsTo',
                'load' => 'eager'
            )
        ),
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'type' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['type'],
            'exclude' => true,
            'filter' => true,
            'inputType' => 'select',
            'options' => array(
                'type_bm'       => 'Bohrmaschinen',
                'type_bh'       => 'Bohrhämmer',
                'type_nt'       => 'Nass + Trocken',
                'type_t'        => 'Trocken',
                'type_n'        => 'Nass',
                'type_bome'     => 'Bohren + Meisseln',
                'type_mh'       => 'Meisselhämmer',
                'type_ah'       => 'Abbruchhämmer',
                'type_zu_bs'    => 'Zubehör - Bohrständer',
                'type_zu_is'    => 'Zubehör - Industriesauger',
                'type_zu_ag'    => 'Zubehör - Absauglocken',
                'type_zu_sa'    => 'Zubehör - Staubabsaugung',
                'type_zu_ah'    => 'Zubehör - Absaughaube',
                'type_zu_lc'    => 'Zubehör - Lochsäge LC',
                'type_zu_lslb'  => 'Zubehör - Lochsäge LS/LB',
                'type_zu_bst'   => 'Zubehör - Bohrstativ',
                'type_zu_an'    => 'Zubehör - Aufname',
                'type_zu_ep'    => 'Zubehör - Express Aufname',
            ),
            'eval' => array(
                'mandatory' => true,
                'includeBlankOption' => true,
                'multiple' => false,
                'chosen' => true,
                'submitOnChange' => true,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(32) NOT NULL default ''"
        ),
        'title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['title'],
            'exclude' => true,
            'sorting' => true,
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'alias' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['alias'],
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => array(
                'rgxp' => 'alias',
                'doNotCopy' => true,
                'readonly' => false,
                'unique' => true,
                'spaceToUnderscore' => true,
                'maxlength' => 128,
                'tl_class' => 'w50'
            ),
            'save_callback' => array(
                array('tl_dse_products', 'generateAlias')
            ),
            'sql' => "varbinary(128) NOT NULL default ''"
        ),
        'sku' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['sku'],
            'exclude' => true,
            'sorting' => true,
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'doNotCopy' => false,
                'unique' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'singleSRC' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['singleSRC'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => true,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'main_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['main_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'main_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['main_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'subheadline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['subheadline'],
            'exclude' => true,
            'sorting' => true,
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'description' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['description'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'textarea',
            'eval' => array(
                'mandatory' => false,
                'rte' => 'tinyMCE',
                'tl_class' => 'clr autoheight',
            ),
            'sql' => "text NULL"
        ),
        'related' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['related'],
            'inputType' => 'select',
            'eval' => array(
                'doNotCopy' => true,
                'multiple' => true,
                'chosen' => true,
//                'includeBlankOption' => true,
                'tl_class' => 'clr'
            ),
            'foreignKey' => 'tl_dse_products.title',
            'sql' => "TEXT NULL"
        ),
        'add_image_map' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['add_image_map'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'submitOnChange' => true,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "char(1) NOT NULL default ''"
        ),
//        'image_map' => array(
//            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['image_map'],
//            'exclude' => true,
//            'sorting' => false,
//            'search' => false,
//            'inputType' => 'multiColumnWizard',
//            'eval' => array(
//                'dragAndDrop'  => true,
//                'tl_class' => 'long autoheight clr wizard',
//                'maxCount' => 6,
//                'columnFields' => array(
//                    'im_content_image' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_content_image'],
//                        'exclude' => true,
//                        'inputType' => 'fileTree',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'filesOnly' => false,
//                            'extensions' => \Config::get('validImageTypes'),
//                            'tl_class' => 'autoheight',
//                        )
//                    ),
//                    'im_x_coord' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_x_coord'],
//                        'exclude' => true,
//                        'inputType' => 'text',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'maxlength' => 255,
//                            'tl_class' => 'w50',
//                        )
//                    ),
//                    'im_y_coord' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_y_coord'],
//                        'exclude' => true,
//                        'inputType' => 'text',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'maxlength' => 255,
//                            'tl_class' => 'w50',
//                        )
//                    ),
//                    'im_content_headline' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_content_headline'],
//                        'exclude' => true,
//                        'inputType' => 'text',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'maxlength' => 255,
//                            'tl_class' => 'w50',
//                        )
//                    ),
//                    'im_content_text' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_content_text'],
//                        'exclude' => true,
//                        'inputType' => 'text',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'maxlength' => 255,
//                            'tl_class' => 'w50',
//                        )
//                    ),
//                ),
//            ),
//            'sql' => 'blob NULL',
//        ),
        'im_1_x_coord' => array(
          'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_1_x_coord'],
          'exclude' => true,
          'filter' => false,
          'inputType' => 'text',
          'eval' => array(
              'mandatory' => true,
              'rgxp' => 'natural',
              'maxlength' => 4,
              'tl_class' => 'clr w50',
          ),
          'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_1_y_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_1_y_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_1_ct_img' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_1_ct_img'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => true,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'im_1_ct_hl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_1_ct_hl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'clr w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_1_ct_txt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_textarea_right'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'tl_class' => 'w50',
            ),
            'sql' => "text NULL"
        ),
        'im_2_x_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_2_x_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'clr w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_2_y_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_2_y_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_2_ct_img' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_2_ct_img'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'im_2_ct_hl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_2_ct_hl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_2_ct_txt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_2_ct_txt'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_3_x_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_3_x_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'clr w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_3_y_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_3_y_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_3_ct_img' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_3_ct_img'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'im_3_ct_hl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_3_ct_hl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_3_ct_txt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_3_ct_txt'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_4_x_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_4_x_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'clr w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_4_y_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_4_y_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_4_ct_img' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_4_ct_img'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'im_4_ct_hl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_4_ct_hl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_4_ct_txt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_4_ct_txt'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_5_x_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_5_x_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'clr w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_5_y_coord' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_5_y_coord'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'rgxp' => 'natural',
                'maxlength' => 4,
                'tl_class' => 'w50',
            ),
            'sql' => "smallint(5) unsigned NOT NULL default '0'"
        ),
        'im_5_ct_img' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_5_ct_img'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'im_5_ct_hl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_5_ct_hl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'im_5_ct_txt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['im_5_ct_txt'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
//        'add_additional_images' => array(
//            'exclude' => true,
//            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['add_additional_images'],
//            'inputType' => 'checkbox',
//            'eval' => array(
//                'doNotCopy' => true,
//                'submitOnChange' => true,
//                'tl_class' => 'w50 clr',
//            ),
//            'sql' => "char(1) NOT NULL default ''"
//        ),
//        'additional_images' => array(
//            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['additional_images'],
//            'exclude' => true,
//            'sorting' => false,
//            'search' => false,
//            'inputType' => 'multiColumnWizard',
//            'eval' => array(
//                'dragAndDrop'  => true,
//                'tl_class' => 'w50 autoheight clr wizard',
//                'maxCount' => 16,
//                'columnFields' => array(
//                    'additional_singleSRC' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['additional_singleSRC'],
//                        'exclude' => true,
//                        'inputType' => 'fileTree',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'filesOnly' => true,
//                            'extensions' => \Config::get('validImageTypes'),
//                            'tl_class' => 'w50 clr autoheight'
//                        )
//                    ),
//                ),
//            ),
//            'sql' => 'blob NULL',
//        ),

        // BENEFITS and FIELD
        'bf_exclude_menu' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_exclude_menu'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "char(1) NOT NULL default '0'"
        ),
        'bf_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_hl_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_hl_text'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_textarea_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_textarea_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_textarea_left' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_textarea_left'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'textarea',
            'eval' => array(
                'mandatory' => false,
                'rte' => 'tinyMCE',
                'tl_class' => 'clr w50 autoheight',
            ),
            'sql' => "text NULL"
        ),
        'bf_textarea_right' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_textarea_right'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'textarea',
            'eval' => array(
                'mandatory' => false,
                'rte' => 'tinyMCE',
                'tl_class' => 'w50 autoheight',
            ),
            'sql' => "text NULL"
        ),
        'bf_field_textarea_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_field_textarea_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_field_textarea_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_field_textarea_text'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_field_textarea_left' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_field_textarea_left'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'textarea',
            'eval' => array(
                'mandatory' => false,
                'rte' => 'tinyMCE',
                'tl_class' => 'clr w50 autoheight',
            ),
            'sql' => "text NULL"
        ),
        'bf_field_textarea_right' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_field_textarea_right'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'textarea',
            'eval' => array(
                'mandatory' => false,
                'rte' => 'tinyMCE',
                'tl_class' => 'w50 autoheight',
            ),
            'sql' => "text NULL"
        ),
//        'bf_images' => array(
//            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_images'],
//            'exclude' => true,
//            'sorting' => false,
//            'search' => false,
//            'inputType' => 'multiColumnWizard',
//            'eval' => array(
//                'dragAndDrop'  => true,
//                'tl_class' => 'w50 autoheight clr wizard',
//                'maxCount' => 6,
//                'columnFields' => array(
//                    'images' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['additional_singleSRC'],
//                        'exclude' => true,
//                        'inputType' => 'fileTree',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'filesOnly' => true,
//                            'extensions' => \Config::get('validImageTypes'),
//                            'tl_class' => 'w50 clr autoheight'
//                        )
//                    ),
//                ),
//            ),
//            'sql' => 'blob NULL',
//        ),
        'bf_img_1' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_1'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'bf_img_1_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_1_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'bf_img_1_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_1_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_img_2' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_2'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'bf_img_2_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_2_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'bf_img_2_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_2_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_img_3' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_3'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'bf_img_3_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_3_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'bf_img_3_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_3_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_img_4' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_4'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'bf_img_4_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_4_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'bf_img_4_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_4_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_img_5' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_5'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'bf_img_5_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_5_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'bf_img_5_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_5_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'bf_img_6' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_6'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'bf_img_6_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_6_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'bf_img_6_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['bf_img_6_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),

        // REASONS
        'reasons_exclude_menu' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_exclude_menu'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "char(1) NOT NULL default '0'"
        ),
        'reasons_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'reasons_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'reasons_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'reasons_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'reasons_list' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_list'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'multiColumnWizard',
            'eval' => array(
                'dragAndDrop'  => true,
                'tl_class' => 'autoheight clr wizard',
                'maxCount' => 6,
                'columnFields' => array(
                    'reasons_list_headline' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_list_headline'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array(
                            'mandatory' => false,
                            'maxlength' => 255,
                            'tl_class' => 'w50',
                        )
                    ),
                    'reasons_list_text' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['reasons_list_text'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array(
                            'mandatory' => false,
                            'maxlength' => 255,
                            'tl_class' => 'w50',
                        )
                    ),
                ),
            ),
            'sql' => 'blob NULL',
        ),
        // APPLICATIONS
        'applications_exclude_menu' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_exclude_menu'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "char(1) NOT NULL default '0'"
        ),
        'applications_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_text'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_big_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_title'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_big_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'applications_field_big_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'applications_field_big_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_1_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_1_title'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_1_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_1_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'applications_field_small_1_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_1_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'applications_field_small_1_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_1_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_2_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_2_title'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_2_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_2_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'applications_field_small_2_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_2_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'applications_field_small_2_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_2_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_big_2_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_2_title'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_big_2_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_2_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'applications_field_big_2_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_2_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'applications_field_big_2_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_big_2_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_3_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_3_title'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_3_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_3_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'applications_field_small_3_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_3_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'applications_field_small_3_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_3_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_4_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_4_title'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'applications_field_small_4_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_4_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'applications_field_small_4_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_4_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'applications_field_small_4_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['applications_field_small_4_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),

        // VIDEO
        'video_exclude_menu' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['video_exclude_menu'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "char(1) NOT NULL default '0'"
        ),
        'video_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['video_headline'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'video_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['video_text'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'video_link' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['video_link'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),

        // DOWNLOADS
        'downloads_exclude_menu' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_exclude_menu'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "char(1) NOT NULL default '0'"
        ),
        'downloads_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_headline'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_text'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
//        'downloads_links' => array(
//            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['download_links'],
//            'exclude' => true,
//            'sorting' => false,
//            'search' => false,
//            'inputType' => 'multiColumnWizard',
//            'eval' => array(
//                'dragAndDrop'  => true,
//                'tl_class' => 'long autoheight clr wizard',
//                'columnFields' => array(
//                    'download_file_text' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['download_file_text'],
//                        'exclude' => true,
//                        'inputType' => 'text',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'maxlength' => 255,
//                            'tl_class' => 'w50',
//                        )
//                    ),
//                    'download_file' => array(
//                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['download_file'],
//                        'exclude' => true,
//                        'inputType' => 'fileTree',
//                        'eval' => array(
//                            'mandatory' => false,
//                            'filesOnly' => false,
//                            'extensions' => 'jpg,jpeg,gif,png,pdf,doc,docx,xls,xlsx,ppt,pptx',
//                            'tl_class' => 'autoheight',
//                        )
//                    ),
//                ),
//            ),
//            'sql' => 'blob NULL',
//        ),
        'downloads_file_1_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_1_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_1' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_1'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_2_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_2_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_2' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_2'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_3_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_3_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_3' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_3'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_4_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_4_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_4' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_4'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_5_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_5_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_5' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_5'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_6_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_6_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_6' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_6'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_7_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_7_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_7' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_7'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_8_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_8_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_8' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_8'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_9_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_9_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_9' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_9'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),
        'downloads_file_10_title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_10_title'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'clr w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'downloads_file_10' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['downloads_file_10'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validFileTypes'),
                'tl_class' => 'w50 autoheight'
            ),
            'sql' => "binary(16) NULL"
        ),

        // BOHRMASCHINEN
        'attr_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_headline'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_text'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_schrauben_weichholz_ohne_vorbohren' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_schrauben_weichholz_ohne_vorbohren'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_festdrehmoment' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_festdrehmoment'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_bohrspindelgewinde' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_bohrspindelgewinde'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_spannhals' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_spannhals'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_spannbereich_bohrfutter' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_spannbereich_bohrfutter'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_holz_1_gang_forstner' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_holz_1_gang_forstner'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_holz_2_gang_forstner' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_holz_2_gang_forstner'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_drehzahl_nennlast_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_drehzahl_nennlast_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_drehzahl_nennlast_2_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_drehzahl_nennlast_2_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_schrauben_bis' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_schrauben_bis'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_stahl_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_stahl_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_stahl_2_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_stahl_2_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_holz_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_holz_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_holz_2_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_holz_2_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_baustoff_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_baustoff_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_baustoff_2_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_baustoff_2_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_stein_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_stein_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_stein_2_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_stein_2_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_durchsch_mauer_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_durchsch_mauer_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_schlagzahl_max' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_schlagzahl_max'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_bohrbereich_stahl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_bohrbereich_stahl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_bohrbereich_holz' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_bohrbereich_holz'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_bohrbereich_polypropylen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_bohrbereich_polypropylen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_drehzahlen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_drehzahlen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_maschinentyp' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_maschinentyp'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bm_einsatzgebiete' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bm_einsatzgebiete'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // BOHRHÄMMER
        'attr_bh_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_bohrbereich_vollbohrer' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_bohrbereich_vollbohrer'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_bohrbereich_stahl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_bohrbereich_stahl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_bohrleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_bohrleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_einzelschlagenergie' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_einzelschlagenergie'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_drehzahl_nennlast' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_drehzahl_nennlast'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bh_schlagzahl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bh_schlagzahl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // NASS + TROCKEN
        'attr_nt_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_drehzahl_nennlast_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_drehzahl_nennlast_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_drehzahl_nennlast_01' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_drehzahl_nennlast_01'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_diamant_trocken' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_diamant_trocken'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_diamant_nass' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_diamant_nass'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_diamant_staender_nass' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_diamant_staender_nass'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_diamant_beton_hand_nass' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_diamant_beton_hand_nass'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_ls_kunststoff_hand' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_ls_kunststoff_hand'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_ls_kunststoff_staender' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_ls_kunststoff_staender'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_ls_kunststoff_stativ' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_ls_kunststoff_stativ'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_lb_hand' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_lb_hand'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_lb_staender' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_lb_staender'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_bohrbereich_lb_stativ' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_bohrbereich_lb_stativ'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_drehzahl_nennlast_02' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_drehzahl_nennlast_02'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_einsatzgebiete' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_einsatzgebiete'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_nt_untergruende' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_nt_untergruende'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // TROCKEN
        'attr_t_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_drehzahl_nennlast_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_drehzahl_nennlast_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_drehzahl_nennlast_01' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_drehzahl_nennlast_01'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_diamant_hand_trocken' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_diamant_hand_trocken'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_ls_kunststoff_hand' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_ls_kunststoff_hand'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_ls_kunststoff_staender' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_ls_kunststoff_staender'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_ls_kunststoff_stativ' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_ls_kunststoff_stativ'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_lb_hand' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_lb_hand'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_lb_staender' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_lb_staender'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_bohrbereich_lb_stativ' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_bohrbereich_lb_stativ'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_drehzahl_nennlast_02' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_drehzahl_nennlast_02'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_einsatzgebiete' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_einsatzgebiete'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_untergruende' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_untergruende'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_anbohren' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_anbohren'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_t_led' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_t_led'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // NASS
        'attr_n_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_drehzahl_nennlast_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_drehzahl_nennlast_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_drehzahl_nennlast_01' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_drehzahl_nennlast_01'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_bohrbereich_hand_nass' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_bohrbereich_hand_nass'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_bohrbereich_staender_nass_01' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_bohrbereich_staender_nass_01'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_bohrbereich_1_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_bohrbereich_1_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_bohrbereich_2_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_bohrbereich_2_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_bohrbereich_3_gang' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_bohrbereich_3_gang'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_drehzahl_nennlast_02' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_drehzahl_nennlast_02'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_einsatzgebiete' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_einsatzgebiete'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_untergruende' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_untergruende'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_drehzahl_stufenlos' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_drehzahl_stufenlos'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_anbohren' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_anbohren'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_feindosiereung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_feindosiereung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_bohrbereich_staender_nass_02' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_bohrbereich_staender_nass_02'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_n_led' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_n_led'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // BOHREN + MEISSELN
        'attr_bome_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrbereich_vollbohrer' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrbereich_vollbohrer'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrbereich_hammerbohrkrone' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrbereich_hammerbohrkrone'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrleistung_beton_30mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrleistung_beton_30mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrleistung_beton_35mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrleistung_beton_35mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrleistung_beton_22mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrleistung_beton_22mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrleistung_beton_20mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrleistung_beton_20mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrleistung_beton_25mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrleistung_beton_25mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_bohrleistung_beton_14mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_bohrleistung_beton_14mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_einzelschlagenergie' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_einzelschlagenergie'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_drehzahl_nennlast' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_drehzahl_nennlast'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_schlagzahl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_schlagzahl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_messleistung_spitzmeissel' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_messleistung_spitzmeissel'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_vibration_normal' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_vibration_normal'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_vibration_kompressor' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_vibration_kompressor'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_vibration_daempfelement' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_vibration_daempfelement'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_schalterarretierung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_schalterarretierung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_bome_led' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_bome_led'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // MEISSELHAEMMER
        'attr_mh_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_einzelschlagenergie' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_einzelschlagenergie'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_schlagzahl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_schlagzahl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_leistung_spitzmeissel' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_leistung_spitzmeissel'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_vibration_normal' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_vibration_normal'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_vibration_kompressor' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_vibration_kompressor'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_vibration_daempfelement' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_vibration_daempfelement'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_led' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_led'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_mh_schalterarretierung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_mh_schalterarretierung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // ABBRUCHHÄMMER
        'attr_ah_nennaufnahmeleistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_nennaufnahmeleistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_maschinengewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_maschinengewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_werkzeugaufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_werkzeugaufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_einzelschlagenergie' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_einzelschlagenergie'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_schlagzahl' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_schlagzahl'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_leistung_spitzmeissel' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_leistung_spitzmeissel'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_vibration_normal' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_vibration_normal'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_vibration_kompressor' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_vibration_kompressor'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_vibration_daempfelement' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_vibration_daempfelement'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_led' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_led'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_ah_schalterarretierung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_ah_schalterarretierung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - BOHRSTÄNDER
        'attr_zu_bs_max_bohrdurchschnitt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_max_bohrdurchschnitt'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_max_bohrdurchschnitt_wassersammelring' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_max_bohrdurchschnitt_wassersammelring'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_hub' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_hub'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_saeulenlaenge' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_saeulenlaenge'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_schraegverstellung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_schraegverstellung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_bohrstaenderfuss' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_bohrstaenderfuss'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_gewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_gewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_befestigung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_befestigung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bs_maschinenempfehlung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bs_maschinenempfehlung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - INDUSTRIESAUGER
        'attr_zu_is_gewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_gewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_is_max_leistung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_max_leistung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_is_max_volumenstrom' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_max_volumenstrom'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_is_max_unterdruck' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_max_unterdruck'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_is_behaeltervolumen_brutto' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_behaeltervolumen_brutto'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_is_saugschlauch' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_saugschlauch'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_is_schutzklasse' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_is_schutzklasse'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - ABSAUGGLOCKEN
        'attr_zu_ag_bohrbereich' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ag_bohrbereich'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ag_hammer_trocken' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ag_hammer_trocken'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ag_diamant_nass' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ag_diamant_nass'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ag_anschluss' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ag_anschluss'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - STAUBABSAUGUNG
        'attr_zu_sa_anschluss' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_sa_anschluss'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_sa_duss_maschinen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_sa_duss_maschinen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_sa_weitere_maschinen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_sa_weitere_maschinen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_sa_meissel_laenge' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_sa_meissel_laenge'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_sa_meissel_vlma' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_sa_meissel_vlma'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - ABSAUBHAUBE
        'attr_zu_ah_anschluss' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ah_anschluss'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ah_bohrbereich' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ah_bohrbereich'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ah_systemprodukte' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ah_systemprodukte'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - LOCHSÄGE LC
        'attr_zu_lc_drehzahlbereich_holz_25mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_holz_25mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_kunststoff_25mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_kunststoff_25mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_holz_2635mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_holz_2635mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_kunststoff_2635mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_kunststoff_2635mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_holz_3645mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_holz_3645mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_kunststoff_3645mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_kunststoff_3645mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_holz_4660mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_holz_4660mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_kunststoff_4660mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_kunststoff_4660mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_holz_6180mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_holz_6180mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_kunststoff_6180mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_kunststoff_6180mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_holz_81110mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_holz_81110mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_drehzahlbereich_kunststoff_81110mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_drehzahlbereich_kunststoff_81110mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_anschlussgewinde' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_anschlussgewinde'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lc_bohrtiefe' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lc_bohrtiefe'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - LOCHSÄGE LS / LB
        'attr_zu_lslb_maschinenempfehlung' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_maschinenempfehlung'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lslb_anschlussgewinde' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_anschlussgewinde'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lslb_bohrtiefe' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_bohrtiefe'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lslb_drehzahlbereich_4082mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_drehzahlbereich_4082mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lslb_drehzahlbereich_83142mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_drehzahlbereich_83142mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lslb_drehzahlbereich_143202mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_drehzahlbereich_143202mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_lslb_drehzahlbereich_203322mm' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_lslb_drehzahlbereich_203322mm'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // BOHRSTATIV
        'attr_zu_bst_max_bohrdurchschnitt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_max_bohrdurchschnitt'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bst_hub' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_hub'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bst_gewicht' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_gewicht'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bst_maschinenempfehlungen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_maschinenempfehlungen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bst_maschinenhalter' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_maschinenhalter'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bst_kanalrohr' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_kanalrohr'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_bst_max_bohrkronenlaenge' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_bst_max_bohrkronenlaenge'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - AUFNAHME
        'attr_zu_an_lochsaege' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_an_lochsaege'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_an_duss_lochsaegen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_an_duss_lochsaegen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_an_fremdlochsaegen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_an_fremdlochsaegen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_an_sechskant' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_an_sechskant'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // ZUBEHÖR - EXPRESS AUFNAHME
        'attr_zu_ep_lochsaege' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ep_lochsaege'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ep_duss_lochsaegen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ep_duss_lochsaegen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ep_fremdlochsaegen' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ep_fremdlochsaegen'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ep_bohrfutter' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ep_bohrfutter'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'attr_zu_ep_aufnahme' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['attr_zu_ep_aufnahme'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),

        // BESTELLDATEN
        'order_data_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['order_data_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ),
            'sql' => "TEXT NULL"
        ),
        'order_data' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['order_data'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'multiColumnWizard',
            'eval' => array(
                'dragAndDrop'  => true,
                'tl_class' => 'long autoheight clr wizard',
                'columnFields' => array(
                    'order_data_value_1' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['order_data_value_1'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array(
                            'mandatory' => false,
                            'maxlength' => 255,
                            'tl_class' => 'w50',
                        )
                    ),
                    'order_data_value_2' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['order_data_value_2'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array(
                            'mandatory' => false,
                            'maxlength' => 255,
                            'tl_class' => 'w50',
                        )
                    ),
                    'order_data_value_3' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['order_data_value_3'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array(
                            'mandatory' => false,
                            'maxlength' => 255,
                            'tl_class' => 'w50',
                        )
                    ),
                    'order_data_value_4' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['order_data_value_4'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array(
                            'mandatory' => false,
                            'maxlength' => 255,
                            'tl_class' => 'w50',
                        )
                    ),
                ),
            ),
            'sql' => 'blob NULL',
        ),

        // TECHNISCHE DATEN
        'tech_data_headline' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['tech_data_headline'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'tech_data_text' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['tech_data_text'],
            'exclude' => true,
            'filter' => false,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50 clr',
            ),
            'sql' => "TEXT NULL"
        ),
        'tech_data_image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['tech_data_image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => false,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'tl_class' => 'w50 clr autoheight'
            ),
            'load_callback' => array(
                array('tl_dse_products', 'setSingleSrcFlags')
            ),
            'save_callback' => array(
                array('tl_dse_products', 'storeFileMetaInformation')
            ),
            'sql' => "binary(16) NULL"
        ),
        'tech_data_image_size' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['tech_data_image_size'],
            'exclude' => true,
            'inputType' => 'imageSize',
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval' => array(
                'rgxp' => 'natural',
                'includeBlankOption' => true,
                'nospace' => true,
                'helpwizard' => true,
                'tl_class' => 'w50 clr'
            ),
            'options_callback' => function () {
                return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
            },
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'tech_data_image_alt' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['tech_data_image_alt'],
            'exclude' => true,
            'sorting' => false,
            'search' => false,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "TEXT NULL"
        ),

        // PRODUCT VISIBILITY
        'published' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['published'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true
            ),
            'sql' => "char(1) NOT NULL default '1'"
        ),
        'featured' => array(
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['featured'],
            'inputType' => 'checkbox',
            'eval' => array(
                'doNotCopy' => true,
                'submitOnChange' => true,
            ),
            'sql' => "char(1) NOT NULL default ''"
        ),
        'start' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['start'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'datepicker' => true,
                'rgxp' => 'datim',
                'tl_class' => 'w50 wizard clr'
            ),
            'sql' => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_dse_products']['stop'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array(
                'datepicker' => true,
                'rgxp' => 'datim',
                'tl_class' => 'w50 wizard'
            ),
            'sql' => "varchar(10) NOT NULL default ''"
        )
    )
);

class tl_dse_products extends Backend
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
     * child_record_callback
     *
     * @param array $arrRow
     *
     * @return string
     */
    public function listRows($arrRow)
    {
        $strBuffer = '
        <div class="cte_type ' . (($arrRow['published']) ? 'published' : 'unpublished') . '">'
            . $arrRow['sku'] . ' - <strong>' . $arrRow['title'] . '</strong>
        </div>';

        return $strBuffer;
    }

    /**
     * Return the "toggle featured" button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function featureIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (\strlen(Input::get('tid')))
        {
            $this->toggleFeatured(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->hasAccess('tl_dse_products::featured', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.Input::get('id').'&amp;tid='.$row['id'].'&amp;state='.($row['featured'] ? '' : 1);

        if (!$row['featured'])
        {
            $icon = 'featured_.svg';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.StringUtil::specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label, 'data-state="' . ($row['featured'] ? 1 : '') . '"').'</a> ';
    }
    /**
     * Toggle the featured
     *
     * @param integer       $intId
     * @param boolean       $blnVisible
     * @param DataContainer $dc
     *
     * @throws Contao\CoreBundle\Exception\AccessDeniedException
     */
    public function toggleFeatured($intId, $blnVisible, DataContainer $dc=null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'feature');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        // Check the field access
        if (!$this->User->hasAccess('tl_dse_products::featured', 'alexf'))
        {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to show/hide content element ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $this->Database->prepare("SELECT * FROM tl_dse_products WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Versions('tl_dse_products', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_dse_products']['fields']['featured']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_dse_products']['fields']['featured']['save_callback'] as $callback)
            {
                if (\is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                }
                elseif (\is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_dse_products SET tstamp=$time, featured='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
    }

    /**
     * Return the "toggle visibility" button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (\strlen(Input::get('tid')))
        {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->hasAccess('tl_dse_products::published', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.Input::get('id').'&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.svg';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.StringUtil::specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : '') . '"').'</a> ';
    }
    /**
     * Toggle the visibility
     *
     * @param integer       $intId
     * @param boolean       $blnVisible
     * @param DataContainer $dc
     *
     * @throws Contao\CoreBundle\Exception\AccessDeniedException
     */
    public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        // Check the field access
        if (!$this->User->hasAccess('tl_dse_products::published', 'alexf'))
        {
            throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to show/hide content element ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $this->Database->prepare("SELECT * FROM tl_dse_products WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Versions('tl_dse_products', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_dse_products']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_dse_products']['fields']['published']['save_callback'] as $callback)
            {
                if (\is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                }
                elseif (\is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_dse_products SET tstamp=$time, published='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
    }

    /**
     * Auto-generate the products alias if it has not been set yet
     * @param mixed
     * @param \DataContainer
     * @return string
     * @throws \Exception
     */
    public function generateAlias($varValue, DataContainer $dc) {
        echo $varValue;
        $autoAlias = false;

        // Generate alias if there is none
        if ($varValue == '') {
            $autoAlias = true;
            $varValue = standardize(StringUtil::restoreBasicEntities($dc->activeRecord->title));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_dse_products WHERE alias=?")
            ->execute($varValue);

        // Check whether the project alias exists
        if ($objAlias->numRows > 1 && !$autoAlias) {
            throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        // Add ID to alias
        if ($objAlias->numRows && $autoAlias) {
            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }

    /**
     * Dynamically add flags to the "singleSRC" field
     *
     * @param mixed         $varValue
     * @param DataContainer $dc
     *
     * @return mixed
     */
    public function setSingleSrcFlags($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord)
        {
            switch ($dc->activeRecord->type)
            {
                case 'text':
                case 'hyperlink':
                case 'image':
                case 'accordionSingle':
                    $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('validImageTypes');
                    break;

                case 'download':
                    $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('allowedDownload');
                    break;
            }
        }

        return $varValue;
    }

    /**
     * Pre-fill the "alt" and "caption" fields with the file meta data
     *
     * @param mixed         $varValue
     * @param DataContainer $dc
     *
     * @return mixed
     */
    public function storeFileMetaInformation($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord->singleSRC != $varValue)
        {
            $this->addFileMetaInformationToRequest($varValue, ($dc->activeRecord->ptable ?: 'tl_article'), $dc->activeRecord->pid);
        }

        return $varValue;
    }
}
