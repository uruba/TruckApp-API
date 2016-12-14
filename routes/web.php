<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () {
	return "The TruckApp's official API";
});

$app->get('/v1/meetup-list', 'ApiController@getMeetupList');
$app->get('/v1/news', 'ApiController@getSubscribedNews');
