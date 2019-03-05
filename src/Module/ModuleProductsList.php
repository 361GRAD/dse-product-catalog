<?php

namespace Dse\ProductCatalogBundle\Module;

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\BackendTemplate;
use Dse\ProductCatalogBundle\Model\DseProductsSetModel;
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
        $filterSearched = [];
        $filterData = [];
        $intTotal = 0;
        
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

        // Get filter data
        $objSet = DseProductsSetModel::findMultipleByIds($this->products_sets);
        $arrFilterFields = deserialize($objSet->filterfields);
        foreach ($arrFilterFields as $filterField) {
            // $filterFieldValue = html_entity_decode(\Input::get($filterField));
            $filterFieldValue = urldecode(\Input::get($filterField));

            if ($filterFieldValue != '') {
                $filterSearched[$filterField] = $filterFieldValue;
                $filterData['columns'][] = "tl_dse_products.$filterField LIKE ?";
                $filterData['values'][] = "%$filterFieldValue%";
            }            
        }

        // Get the total number of items
        if($filterData) {
            $this->Template->filterSearched = $filterSearched;
            $intTotal = DseProductsModel::countPublishedByColumns($filterData['columns'], $filterData['values']);
        } else {
            $intTotal = DseProductsModel::countPublishedByPids($this->products_sets, $blnFeatured);
        }
    
        // Filer and values for the form
        if($arrFilterFields) {
            $filters = implode(",", $arrFilterFields);
            $this->Template->arrFilters = $arrFilterFields;
            $this->Template->arrFiltersValue = DseProductsModel::getFilterValues($filters, $this->products_sets[0]);
        }

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
            $page = (\Input::get($id) !== null) ? \Input::get($id) : 1;

            // Do not index or cache the page if the page number is outside the range
            if ($page < 1 || $page > max(ceil($total / $this->perPage), 1)) {
                throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
            }

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
        if (isset($limit) && $filterData) {
            $objArticles = DseProductsModel::findPublishedByColumns($filterData['columns'], $filterData['values'], $limit, $offset);
        } elseif (!isset($limit) && $filterData) {
            $objArticles = DseProductsModel::findPublishedByColumns($filterData['columns'], $filterData['values'], 0, $offset);
        } elseif (isset($limit) && !$filterData) {
            $objArticles = DseProductsModel::findPublishedByPids($this->products_sets, $blnFeatured, $limit, $offset);
        } else {
            $objArticles = DseProductsModel::findPublishedByPids($this->products_sets, $blnFeatured, 0, $offset);
        }

        // ToDo: related products
        $this->Template->articles = $this->parseArticles($objArticles, false, $this->full_details, false);

        $this->Template->sets = $this->products_sets;
        $this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyList'];
    }
}
