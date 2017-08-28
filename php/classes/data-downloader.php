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
		$files = glob("$path$name*$extension");
		{
			foreach($files as $file) {
				echo "glob:" . $file . "<br/>";
			}
			/*
			 * Downloads a file to a path from a url
			 *
			 * @param string $url url to grab
			 * @param string $path path to save to
			 * @param string $name filename to save in
			 * @param string $extension extension to save in
			 */

		public static function downloadFile($url, $path, $name, $extension) {
		//Delete old file(s)
				DataDownloader::deleteFiles($path, $name, $extension);

				//Create new file
				$newFile = null;
				$newFileName = $path . $name . ".csv";

				//echo $newFileName;

				$file = fopen($url, "rb");
				if($file) {
					$newFile = fopen($newFileName, "wb");

					if($newFile)
						while(!feof($file)) {
						fwrite($newFile, fread($file, 1024 * 8), 1024 * 8);

						}
				}
				 if($file) {
				fclose($file);
				 } else {
					fclose($newFile);
				 }
		}
		/**
		 * This function grabs the businesses.csv file and reads it
		 *
		 * @param string $urlBegin beginning of Url to grab file at
		 * @param string $urlEnd end of url to grab file at
		 * @throws PDOException PDO related errors
		 * @throws Exception catch-all exception
		 *
		 */
		public static function readBusinessesCSV($urlBegin, $urlEnd) {
			$urls = glob("urlBegin*$urlEnd");
			if(count($urls)>0) {
				$url = $urls[0];
			}
			$context = stream_context_create(array("http" => array("ignore_errors" => true, "method" => "GET")));

			try{
				$pdo = connectToEncryptedMySQL("/etc/apache2/mysql/foodquisition.ini");

				if(($fd = @fopen($url, "rb", false, $context)) !== false) {
					fgetcsv($fd, 0, ",");
					while((($data = fgetcsv($fd, 0, ",")) !== false) && feof($fd) === false) {
						//line 258//
					}
				}
			}
		}
		}
	}
}