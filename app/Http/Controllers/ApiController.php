<?php

namespace App\Http\Controllers;

use App\Fetchers;
use Illuminate\Http\Request;

class ApiController extends Controller
{
	public function getMeetupList()
	{
		$response = [];

		$response['items'] = [];

		$response['items']['ets2c'] = (new Fetchers\Ets2cFetcher(config('meetups.url.ets2c')))->fetch();
		$response['items']['truckers.events'] =
			(new Fetchers\TruckerseventsFetcher(config('meetups.url.TruckersEvents')))->fetch();

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

		return response()->json($response);
	}

	public function getSubscribedNews(Request $request)
	{

	}
}
