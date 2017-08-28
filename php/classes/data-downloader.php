<?php

require_once ("Restaurant.php");
require_once ("Category.php");
require_once ("Violation.php");
require_once ("RestaurantViolation.php");
require_once ("/etc/apache2/mysql/encrypted-config.php");

/**
 *
 * This class will download data from inspection file
 *
 * @author Danielle and Steve
 *
 **/
class DataDownloader {

	/**
	 *
	 * FoodInspections-CNM.xls
	 *
	 **/


		/**
		 * Deletes a file or files fom a directory
		 *
		 * @param string $path path to file
		 * @param string $name filename
		 * @param string $extension extension of file
		 *
		 **/
	public static function deleteFiles($path, $name, $extension) {
	//Deletes files
		$files = glob("$path$name*$extension");{
		foreach($files as $file){
			echo "glob:" . $file . "<br/>";
		}
		/*
		 * Downloads a file to a path from a url
		 */

	}
}