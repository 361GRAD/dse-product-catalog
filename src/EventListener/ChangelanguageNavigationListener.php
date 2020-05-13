<?php
namespace Dse\ProductCatalogBundle\EventListener;

use Haste\Input\Input;
use Dse\ProductCatalogBundle\Model\DseProductsModel;
use Terminal42\ChangeLanguage\Event\ChangelanguageNavigationEvent;

class ChangelanguageNavigationListener {
    // Vendor\Extension\EventListener\ChangelanguageNavigationListener.php
    public function onChangelanguageNavigation(
        \Terminal42\ChangeLanguage\Event\ChangelanguageNavigationEvent $event
    ) {
        // The target root page for current event
        $targetRoot = $event->getNavigationItem()->getRootPage();
        $language   = $targetRoot->rootLanguage; // The target language

        // Find your current and new alias from the current URL
        // only manipulate if there are items
        if(Input::getAutoItem('items', false, true) !== NULL) {
            foreach(DseProductsModel::findPublishedBySku($this->getProductAlias()->sku) as $item) {
                if($language == $item->language) {
                    $newAlias = $item->alias;
                    break;
                }
            }
            // Pass the new alias to ChangeLanguage
            $event->getUrlParameterBag()->setUrlAttribute('items', $newAlias);
        }

    }

    /**
     * @return null|string
     */
    private function getProductAlias()
    {
        $alias = (string) Input::getAutoItem('items', false, true);

        // return '' !== $alias && null !== DseProductsModel::findPublishedSkuByAlias($alias) ? $alias : null;
        return DseProductsModel::findPublishedSkuByAlias($alias);
    }
}
