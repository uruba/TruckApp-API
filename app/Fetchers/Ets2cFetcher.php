<?php

namespace App\Fetchers;

use App\Helpers\HttpUtils;
use App\Interfaces\Fetchers\FetcherAbstract;
use Exception;

class Ets2cFetcher extends FetcherAbstract {

	public function fetch()
	{
		$dom = new \DOMDocument();

		libxml_use_internal_errors(true);
		try
		{
			$dom->loadHTML(HttpUtils::getHtmlCodeFromUrl($this->url));
		} catch (Exception $e)
		{
			return null;
		}

		$items = [];

		foreach (((new \DOMXPath($dom))->query("//*[@class='row']")) as $element)
		{
			$item = [];

			try
			{
				$childNodes = $element->childNodes;

				$item['server'] = $childNodes->item(1)->textContent;
				$item['time'] = $childNodes->item(3)->textContent;
				$item['location'] = $childNodes->item(5)->textContent;
				$item['organiser'] = $childNodes->item(7)->textContent;
				$item['language'] = $childNodes->item(9)->textContent;
				$item['participants'] = trim($childNodes->item(11)->textContent);
				$item['relativeURL'] = $childNodes->item(13)
					->childNodes->item(0)
					->attributes->getNamedItem("href")
					->nodeValue;

				$items[] = $item;
			} catch (Exception $e)
			{
			}

		}

		return $items;
	}
}
