<?php

namespace App\Helpers;

class HttpUtils {
	public static function getHtmlCodeFromUrl($url, $timeout = 5)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$htmlCode = curl_exec($ch);
		curl_close($ch);

		return $htmlCode;
	}
}
