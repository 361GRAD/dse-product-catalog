<?php

if (Input::get('do') == 'dse_products_set') {
    $GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_dse_products';
}