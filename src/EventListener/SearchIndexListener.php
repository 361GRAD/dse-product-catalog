<?php
namespace Dse\ProductCatalogBundle\EventListener;

use Dse\ProductCatalogBundle\Model\DseProductsSetModel;
use Dse\ProductCatalogBundle\Model\DseProductsModel;

class SearchIndexListener extends \Frontend {
    /**
	 * Add news items to the indexer
	 *
	 * @param array   $arrPages
	 * @param integer $intRoot
	 * @param boolean $blnIsSitemap
	 *
	 * @return array
	 */
	public function getSearchablePages($arrPages, $intRoot=0, $blnIsSitemap=false)
	{
		$arrRoot = array();

		if ($intRoot > 0)
		{
            $arrRoot = $this->Database->getChildRecords($intRoot, 'tl_page');
		}

		$arrProcessed = array();
		$time = \Date::floorToMinute();

		// Get all news archives
        $objArchive = DseProductsSetModel::findAll();

		// Walk through each archive
		if ($objArchive !== null)
		{
            while ($objArchive->next())
			{
                // Skip news archives without target page
				if (!$objArchive->jumpTo)
				{
                    continue;
				}
                
				// Skip news archives outside the root nodes
				if (!empty($arrRoot) && !\in_array($objArchive->jumpTo, $arrRoot))
				{
                    continue;
				}
                
				// Get the URL of the jumpTo page
				if (!isset($arrProcessed[$objArchive->jumpTo]))
				{
                    $objParent = \PageModel::findWithDetails($objArchive->jumpTo);
                    
					// The target page does not exist
					if ($objParent === null)
					{
                        continue;
					}
                    
					// The target page has not been published (see #5520)
					if (!$objParent->published || ($objParent->start != '' && $objParent->start > $time) || ($objParent->stop != '' && $objParent->stop <= ($time + 60)))
					{
                        continue;
					}
                    
					if ($blnIsSitemap)
					{
						// The target page is protected (see #8416)
						if ($objParent->protected)
						{
							continue;
						}

						// The target page is exempt from the sitemap (see #6418)
						if ($objParent->robots == 'noindex,nofollow')
						{
							continue;
						}
					}
					// Generate the URL
					$arrProcessed[$objArchive->jumpTo] = $objParent->getAbsoluteUrl(\Config::get('useAutoItem') ? '/%s' : '/items/%s');
				}
                
				$strUrl = $arrProcessed[$objArchive->jumpTo];

				// Get the items
				$objArticle = DseProductsModel::findAllByPids(explode(" ", $objArchive->id));

				if ($objArticle !== null)
				{
					while ($objArticle->next())
					{
						$arrPages[] = $this->getLink($objArticle, $strUrl);
					}
				}
			}
        }

		return $arrPages;
    }
    
    /**
	 * Return the link of a news article
	 *
	 * @param NewsModel $objItem
	 * @param string    $strUrl
	 * @param string    $strBase
	 *
	 * @return string
	 */
	protected function getLink($objItem, $strUrl, $strBase='')
	{
		switch ($objItem->source)
		{
			// Link to an external page
			case 'external':
				return $objItem->url;
				break;

			// Link to an internal page
			case 'internal':
				if (($objTarget = $objItem->getRelated('jumpTo')) instanceof PageModel)
				{
					/** @var PageModel $objTarget */
					return $objTarget->getAbsoluteUrl();
				}
				break;

			// Link to an article
			case 'article':
				if (($objArticle = \ArticleModel::findByPk($objItem->articleId, array('eager'=>true))) !== null && ($objPid = $objArticle->getRelated('pid')) instanceof PageModel)
				{
					/** @var PageModel $objPid */
					return ampersand($objPid->getAbsoluteUrl('/articles/' . ($objArticle->alias ?: $objArticle->id)));
				}
				break;
		}

		// Backwards compatibility (see #8329)
		if ($strBase != '' && !preg_match('#^https?://#', $strUrl))
		{
			$strUrl = $strBase . $strUrl;
		}

		// Link to the default page
		return sprintf(preg_replace('/%(?!s)/', '%%', $strUrl), ($objItem->alias ?: $objItem->id));
	}
}
