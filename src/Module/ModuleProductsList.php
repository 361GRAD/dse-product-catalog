<?php

namespace Dse\ProductCatalogBundle\Module;

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\BackendTemplate;
use Dse\ProductCatalogBundle\Model\DseProductsModel;

class ModuleProductsList extends ModuleProducts {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dse_products_list';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### PRODUCTS LIST ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

//        $this->products_sets = $this->sortOutProtected(deserialize($this->products_sets));
        $this->products_sets = deserialize($this->products_sets);
        // Return if there are no archives
        if (!is_array($this->products_sets) || empty($this->products_sets)) {
            return '';
        }

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        $offset = intval(0);
        $limit = null;

        // Maximum number of items
        if ($this->numberOfItems > 0) {
            $limit = $this->numberOfItems;
        }

        // Handle featured products
        if ($this->products_featured == 'featured') {
            $blnFeatured = true;
        } elseif ($this->products_featured == 'unfeatured') {
            $blnFeatured = false;
        } else {
            $blnFeatured = null;
        }

        // Get the total number of items
        $intTotal = DseProductsModel::countPublishedByPids($this->products_sets, $blnFeatured);

        if ($intTotal < 1) {
            $this->Template->articles = array();
            return;
        }

        $total = $intTotal - $offset;

        // Split the results
        if ($this->perPage > 0 && (!isset($limit) || $this->numberOfItems > $this->perPage)) {
            // Adjust the overall limit
            if (isset($limit)) {
                $total = min($limit, $total);
            }

            // Get the current page
            $id = 'page_n' . $this->id;
//            $page = \Input::get($id) ? : 1;
            $page = (\Input::get($id) !== null) ? \Input::get($id) : 1;

            // Do not index or cache the page if the page number is outside the range
            if ($page < 1 || $page > max(ceil($total / $this->perPage), 1)) {
                throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
            }

//            if ($page < 1 || $page > max(ceil($total / $this->perPage), 1)) {
//                global $objPage;
//                $objPage->noSearch = 1;
//                $objPage->cache = 0;
//
//                // Send a 404 header
//                header('HTTP/1.1 404 Not Found');
//                return;
//            }

            // Set limit and offset
            $offset += (max($page, 1) - 1) * $this->perPage;
            $limit = $this->perPage;

            // Overall limit
            if ($offset + $limit > $total) {
                $limit = $total - $offset;
            }

            // Add the pagination menu
            $objPagination = new \Pagination($total, $this->perPage, 7, $id);
            $this->Template->pagination = $objPagination->generate("\n  ");
        }

        // Get the items
        if (isset($limit)) {
            $objArticles = DseProductsModel::findPublishedByPids($this->products_sets, $blnFeatured, $limit, $offset);
        } else {
            $objArticles = DseProductsModel::findPublishedByPids($this->products_sets, $blnFeatured, 0, $offset);
        }

        // ToDo:
        $this->Template->articles = $this->parseArticles($objArticles, false, $this->full_details, false);

        $this->Template->sets = $this->products_sets;
        $this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyList'];
    }
}
