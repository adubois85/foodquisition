<?php

require_once ("");
require_once ("");
require_once ("");

/**
 *
 * This class will download data from inspection file
 *
 * @author Danielle and Steve
 *
 **/
class DatatDownloader {

	/**
	 *
	 * File name that we got from the city
	 *
	 **/

	/**
	 * Gets the metadata from a file url
	 *
	 * @param string $url url to grab from
	 * @param int $redirect whether to redirect or not
	 * @return mixed stream data
	 * @throws Exception if file doesn't exist
	 *
	 */
	public static function getMetaData($url, $redirect = 1) {
		$context = stream_context_create(array("http" => array("follow_location" => $redirect, "ignore_errors" => true, "method" => "HEAD"
		)));

		// "@" suppresses warnings and errors
		$fd = @fopen($url, "rb", false, $context);
		var_dump(stream_get_meta_data($fd));

		// Grab the stream data
		$streamData = stream_get_meta_data($fd);

		fclose($fd);

		$wrapperData = $streamData["wtapper_data"];

		//Loop through to find the "HTTP" attribute
		$http = "";
		foreach($wrapperData as $data) {
			if (strpos($data, "HTTP") !== false) {
				$http = $data;
				break;
			}
		}
		if(strpos($http, "400")) {
			throw(new Exception("Bad request"));
		}
		if(strpos($http, "401")) {
			throw(new Exception("Unauthorized"));

		}
		if(strpos($http, "403")) {
			throw(new Exception("Forbidden"));
		}

		if(strpos($http, "404")) {
			throw(new Exception("Not found"));
		}
		if(strpos($http, "418")){
			throw(new Exception("Get your tea set"));
		}
		return $streamData;

		/**
		 * Deletes a file or files fom a directory
		 *
		 * @param strind $path path to file
		 * @param string $name filename
		 * @param string $ex
		 *
		 **/


	}

}