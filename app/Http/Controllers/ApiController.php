<?php

namespace App\Http\Controllers;

use App\Helpers\Fetchers;

class ApiController extends Controller
{
    public function getMeetupList() {
        $response = array();
        
        $response['items'] = array();
        
        $response['items']['ets2c'] = (new Fetchers\ets2cFetcher('http://ets2c.com'))->fetch();
        $response['items']['truckers.events'] = (new Fetchers\truckerseventsFetcher('http://truckers.events/api/events'))->fetch();
        
        $error = false;
        
        // error only when all the item arrays are empty
        $emptyCount = 0;
        $count = count($response['items']);
        foreach ($response['items'] as $item) {
            if (empty($item)) {
               $emptyCount++; 
            } 
            
            if ($emptyCount == $count) {
                $error = true;
            }
        }

        $response['error'] = $error;

        return response()->json($response);
    }  
}
