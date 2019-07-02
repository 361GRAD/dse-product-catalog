<?php

namespace Dse\ProductCatalogBundle\Module;

use Dse\ProductCatalogBundle\Model\DseProductsSetModel;
use Dse\ProductCatalogBundle\Model\DseProductsVariantsModel;

abstract class ModuleProducts extends \Module {

    /**
     * URL cache array
     * @var array
     */
    private static $arrUrlCache = array();

    /**
     * Sort out protected sets
     * @param array
     * @return array
     */
    protected function sortOutProtected($arrSets) {
        if (BE_USER_LOGGED_IN || !is_array($arrSets) || empty($arrSets)) {
            return $arrSets;
        }

        $this->import('FrontendUser', 'User');
        $objArchive = DseProductsSetModel::findMultipleByIds($arrSets);

        $arrSets = array();

        if ($objArchive !== null) {
            while ($objArchive->next()) {
                if ($objArchive->protected) {
                    if (!FE_USER_LOGGED_IN) {
                        continue;
                    }

                    $groups = deserialize($objArchive->groups);

                    if (!is_array($groups) || empty($groups) || !count(array_intersect($groups, $this->User->groups))) {
                        continue;
                    }
                }

                $arrSets[] = $objArchive->id;
            }
        }

        return $arrSets;
    }

    /**
     * Parse an item and return it as string
     * @param object
     * @param boolean
     * @param string
     * @return string
     */
    protected function parseArticle($objArticle, $blnAddArchive=false, $strClass='', $blnFullDetails=0, $blnRelated=false) {
        global $objPage;

        if($blnRelated) {
            $objTemplate = new \FrontendTemplate($this->related_template);
        } else {
            $objTemplate = new \FrontendTemplate($this->products_template);
        }
        $objTemplate->setData($objArticle->row());

//        $objTemplate->class = (($objArticle->cssClass != '') ? ' ' . $objArticle->cssClass : '') . $strClass;
//        $objTemplate->productsHeadline = $objArticle->headline;
        $objTemplate->productsTitle = $objArticle->title;
//        $objTemplate->subHeadline = $objArticle->subheadline;
//        $objTemplate->linkHeadline = $this->generateLink($objArticle->headline, $objArticle, $blnAddArchive);
//        $objTemplate->more = $this->generateLink($GLOBALS['TL_LANG']['MSC']['more'], $objArticle, $blnAddArchive, true);
        $objTemplate->link = $this->generateProductsUrl($objArticle, $blnAddArchive);
        // $objTemplate->relatedProducts = deserialize($objArticle->related);
//        $objTemplate->set = $objArticle->getRelated('pid');
        $objTemplate->comparable = $this->comparable;
        $objTemplate->text = '';

        // Add images
        $objModel = \FilesModel::findByPk($objArticle->singleSRC);
//        $objModelDetails = \FilesModel::findByPk($objArticle->img_details);
//        $objModelLabel = \FilesModel::findByPk($objArticle->img_label);
        $objTemplate->main_image_path = $objModel->path;
//        $objTemplate->img_details = $objModelDetails->path;
//        $objTemplate->img_label = $objModelLabel->path;

        $objModel_2 = \FilesModel::findByPk($objArticle->singleSRC_2);
        $objTemplate->main_image_path_2 = $objModel_2->path;

        // Get product variants
        $objArticleVariants = DseProductsVariantsModel::findByPsku($objTemplate->sku, $objTemplate->variants_category);
        if($objArticleVariants) {
            $objTemplate->variants = $objArticleVariants;
        }

        $this->loadLanguageFile('tl_dse_products');
        $objTemplate->localTrans = $GLOBALS['TL_LANG']['tl_dse_products'];

        // Clean the RTE output
        if ($objArticle->descr != '') {
            if ($objPage->outputFormat == 'xhtml') {
                $objArticle->descr = \StringUtil::toXhtml($objArticle->descr);
            } else {
                $objArticle->descr = \StringUtil::toHtml5($objArticle->descr);
            }

            $objTemplate->descr = \StringUtil::encodeEmail($objArticle->descr);
        }

        if ($blnFullDetails) {

            // Compile the product text
            $objElement = \ContentModel::findPublishedByPidAndTable($objArticle->id, 'tl_dse_products');

            if ($objElement !== null) {
                while ($objElement->next()) {
                    $objTemplate->text .= $this->getContentElement($objElement->id);
                }
            }
        }

        // HOOK: add custom logic
        if (isset($GLOBALS['TL_HOOKS']['parseArticles']) && is_array($GLOBALS['TL_HOOKS']['parseArticles'])) {
            foreach ($GLOBALS['TL_HOOKS']['parseArticles'] as $callback) {
                $this->import($callback[0]);
                $this->$callback[0]->$callback[1]($objTemplate, $objArticle->row(), $this);
            }
        }

        return $objTemplate->parse();
    }

    /**
     * Parse one or more items and return them as array
     * @param object
     * @param boolean
     * @return array
     */
    protected function parseArticles($objArticles, $blnAddArchive=false, $blnFullDetails=0, $blnRelated=false) {
        $limit = $objArticles->count();
        
        if ($limit < 1) {
            return array();
        }

        $count = 0;
        $arrArticles = array();

        while ($objArticles->next()) {
            $arrArticles[] = $this->parseArticle($objArticles, $blnAddArchive, ((++$count == 1) ? ' first' : '') . (($count == $limit) ? ' last' : '') . ((($count % 2) == 0) ? ' odd' : ' even'), $blnFullDetails, $blnRelated);
        }

        return $arrArticles;
    }

    /**
     * Generate a URL and return it as string
     * @param object
     * @param boolean
     * @return string
     */
    protected function generateProductsUrl($objItem, $blnAddArchive=false) {
        $strCacheKey = 'id_' . $objItem->id;

        // Load the URL from cache
        if (isset(self::$arrUrlCache[$strCacheKey])) {
            return self::$arrUrlCache[$strCacheKey];
        }

        // Initialize the cache
        self::$arrUrlCache[$strCacheKey] = null;

        // Link to the default page
        if (self::$arrUrlCache[$strCacheKey] === null) {
            // ToDo:
            $objPage = \PageModel::findByPk($objItem->getRelated('pid')->jumpTo);
            if ($objPage === null) {
                self::$arrUrlCache[$strCacheKey] = ampersand(\Environment::get('request'), true);
            } else {
//                self::$arrUrlCache[$strCacheKey] = ampersand($this->generateFrontendUrl($objPage->row(), ($GLOBALS['TL_CONFIG']['useAutoItem'] ? '/' : '/items/') . ((!$GLOBALS['TL_CONFIG']['disableAlias'] && $objItem->alias != '') ? $objItem->alias : $objItem->id)));
//                self::$arrUrlCache[$strCacheKey] = sprintf(preg_replace('/%(?!s)/', '%%', $objPage->getFrontendUrl(\Config::get('useAutoItem') ? '/%s' : '/items/%s')), ((!\Config::get('disableAlias') && $objItem->alias != '') ? $objItem->alias : $objItem->id));
                self::$arrUrlCache[$strCacheKey] = ampersand($objPage->getFrontendUrl((\Config::get('useAutoItem') ? '/' : '/items/') . ((!\Config::get('disableAlias') && $objItem->alias != '') ? $objItem->alias : $objItem->id)));
            }

            // Add the current set parameter (products set)
            /*
             *
             * Archive functionality with $blnAddArchive are not needed here, clean up in the next version
             *
             */
//            if ($blnAddArchive && \Input::get('month') != '') {
//                self::$arrUrlCache[$strCacheKey] .= ($GLOBALS['TL_CONFIG']['disableAlias'] ? '&amp;' : '?') . 'month=' . \Input::get('month');
//            }
        }

        return self::$arrUrlCache[$strCacheKey];
    }

    /**
     * Generate a link and return it as string
     * @param string
     * @param object
     * @param boolean
     * @param boolean
     * @return string
     */
    protected function generateLink($strLink, $objArticle, $blnAddArchive=false, $blnIsReadMore=false) {
        // Internal link
        if ($objArticle->source != 'external') {
            return sprintf('<a href="%s" title="%s">%s%s</a>', $this->generateProductsUrl($objArticle, $blnAddArchive), specialchars(sprintf($GLOBALS['TL_LANG']['MSC']['readMore'], $objArticle->headline), true), $strLink, ($blnIsReadMore ? ' <span class="invisible">' . $objArticle->headline . '</span>' : ''));
        }

        // Encode e-mail addresses
        if (substr($objArticle->url, 0, 7) == 'mailto:') {
            $objArticle->url = \StringUtil::encodeEmail($objArticle->url);
        }

        // Ampersand URIs
        else {
            $objArticle->url = ampersand($objArticle->url);
        }

        global $objPage;

        // External link
        return sprintf('<a href="%s" title="%s"%s>%s</a>', $objArticle->url, specialchars(sprintf($GLOBALS['TL_LANG']['MSC']['open'], $objArticle->url)), ($objArticle->target ? (($objPage->outputFormat == 'xhtml') ? ' onclick="return !window.open(this.href)"' : ' target="_blank"') : ''), $strLink);
    }

}
