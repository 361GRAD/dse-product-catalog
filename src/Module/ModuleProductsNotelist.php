<?php

namespace Dse\ProductCatalogBundle\Module;

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\Database;
use Contao\BackendTemplate;
use Dse\ProductCatalogBundle\Model\DseProductsModel;

class ModuleProductsNotelist extends ModuleProducts {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dse_products_notelist';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate() {
        if (TL_MODE == 'BE') {
            $objTemplate = new BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['MOD']['dse_products_notelist'][0] . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $this->strTemplate = $this->products_wrapper_template;

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile() {
        if (!isset($_GET)) {
            $this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyList'];
            return;
        }

        $objArticle = DseProductsModel::findMultipleProductsByIds(\Input::get('pid'));

        if (null === $objArticle) {
            throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
        }

        $arrArticle = $this->parseArticles($objArticle, false, true, false);

        $this->Template->objArticles = $objArticle;
        $this->Template->articles = $arrArticle;
    }

}
