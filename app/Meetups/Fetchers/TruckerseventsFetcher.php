<?php

namespace App\Meetups\Fetchers;

use App\Helpers\HttpUtils;
use App\Interfaces\Fetchers\FetcherAbstract;
use Exception;

class TruckerseventsFetcher extends FetcherAbstract {

	public function fetch()
	{
		$json = json_decode(HttpUtils::getHtmlCodeFromUrl($this->url), true);

		$items = array();

		foreach ($json['response'] as $entry)
		{
			$item = array();

			try
			{
				$item['server'] = implode(" ", [$entry['game'], $entry['server']]);
				$item['time'] = $entry['startTimestamp'];
				$item['location'] = $entry['startCity'];
				$item['organiser'] = $entry['organiser']['name'];
				$item['language'] = $entry['language'];
				$item['participants'] = $entry['participants'];
				$item['relativeURL'] = '';

				$items[] = $item;
			} catch (Exception $e)
			{
			}
		}

		return $items;
	}
}