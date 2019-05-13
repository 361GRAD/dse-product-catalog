<?php

namespace Dse\ProductCatalogBundle\Module;

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\Database;
use Contao\BackendTemplate;
use Dse\ProductCatalogBundle\Model\DseProductsModel;

class ModuleProductsReader extends ModuleProducts {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dse_products_reader';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate() {
        if (TL_MODE == 'BE') {
            $objTemplate = new BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### PRODUCTS READER ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }
        // Set the item from the auto_item parameter
//        if ($GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item'])) {
//            \Input::setGet('items', \Input::get('auto_item'));
//        }
        if (!isset($_GET['items']) && \Config::get('useAutoItem') && isset($_GET['auto_item']))
        {
            \Input::setGet('items', \Input::get('auto_item'));
        }

        // Do not index or cache the page if no news item has been specified
        if (!\Input::get('items'))
        {
            /** @var PageModel $objPage */
            global $objPage;

            $objPage->noSearch = 1;
            $objPage->cache = 0;

            return '';
        }

//        $this->products_sets = $this->sortOutProtected(deserialize($this->products_sets));
        $this->products_sets = deserialize($this->products_sets);

        // Do not index or cache the page if there are no archives
        if (!is_array($this->products_sets) || empty($this->products_sets)) {
            global $objPage;

            $objPage->noSearch = 1;
            $objPage->cache = 0;

            return '';
        }

        $this->strTemplate = $this->products_wrapper_template;

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile() {
        // Install Bundele Package: vendor/bin/contao-console assets:install
//        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/dseproductcatalog/js/dse-notelist.jquery-functions.js|static';
//        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/dseproductcatalog/js/dse-notelist-button.js|static';
        $GLOBALS['TL_JAVASCRIPT'][] = 'dist/js/image_map_rwdImageMaps.min.js|static';
        $GLOBALS['TL_JAVASCRIPT'][] = 'dist/js/dse_product_detail.js|static';

        global $objPage;

        $this->Template->articles = '';
        $this->Template->referer = 'javascript:history.go(-1)';

        // Get the product
        $objArticle = DseProductsModel::findPublishedByAlias(\Input::get('items'), $this->products_sets);

        if (null === $objArticle) {
            throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
        }

        $arrArticle = $this->parseArticle($objArticle, false, '', $this->full_details);

        if ($objArticle->related != "") {
//            $arrRelatedProductsIds = deserialize($objArticle->related);
//            foreach ($arrRelatedProductsIds as $relatedProductId) {
//                $objArticles = DseProductsModel::findPublishedByPids($this->products_sets, $blnFeatured, $limit, $offset);
                $objRelatedProduct = DseProductsModel::findRelatedByIds(deserialize($objArticle->related));
//                $this->Template->relatedArticles = $this->parseArticles($objRelatedProduct, false, $this->full_details);
                $arrRelatedArticles = $this->parseArticles($objRelatedProduct, false, 0, true);
//            }
        }

        $this->Template->articles = $arrArticle;
        $this->Template->relatedArticles = $arrRelatedArticles;

        // Overwrite the page title (see #2853 and #4955)
        if ($objArticle->title != '') {
            $objPage->pageTitle = strip_tags(strip_insert_tags($objArticle->title));
        }

        // Overwrite the page description
        if ($objArticle->descr != '') {
            $objPage->description = $this->prepareMetaDescription($objArticle->descr);
        }
    }

}
