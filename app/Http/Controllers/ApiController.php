<?php

namespace App\Http\Controllers;

use App\Fetchers;
use App\Meetups\MeetupAdapter;
use Illuminate\Http\Request;

class ApiController extends Controller
{
	public function getMeetupList()
	{
		$meetupAdapter = new MeetupAdapter();

		return response()->json($meetupAdapter->getMeetups());
	}

	public function getSubscribedNews(Request $request)
	{

	}
}
