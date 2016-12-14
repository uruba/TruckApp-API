<?php

namespace App\Meetups;

use App\Meetups\Fetchers\Ets2cFetcher;
use App\Meetups\Fetchers\TruckerseventsFetcher;

class MeetupAdapter
{
	public function getMeetups()
	{
		$response = [];

		$response['items'] = [];

		$response['items']['ets2c'] = (new Ets2cFetcher(config('meetups.url.ets2c')))->fetch();
		$response['items']['truckers.events'] =
			(new TruckerseventsFetcher(config('meetups.url.TruckersEvents')))->fetch();

		$error = false;

		// error only when all the item arrays are empty
		$emptyCount = 0;
		$count = count($response['items']);
		foreach ($response['items'] as $item)
		{
			if (empty($item))
			{
				$emptyCount++;
			}

			if ($emptyCount == $count)
			{
				$error = true;
			}
		}

		$response['error'] = $error;

		return $response;
	}
}