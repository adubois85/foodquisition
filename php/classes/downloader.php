<?php

namespace Edu\Cnm\Foodquisition;

use Edu\Cnm\Foodquisition\{
	Restaurant, Violation, Category, RestaurantViolation
};

require_once("autoload.php");
require_once("/etc/apache2/mysql/encrypted-config.php");

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
	 * Gets the metadata from a file url
	 *
	 * @param string $url url to grab from
	 * @param int $redirect whether to redirect or not
	 * @return mixed stream data
	 * @throws \Exception if file doesn't exist
	 */

	public static function getData($url, $redirect = 1) {
		$context = stream_context_create(array("http" => array("follow_location" => $redirect, "ignore_errors" => true, "method" => "HEAD")));

	}


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
		foreach($files as $file) {
			//echo "glob:" . $file . "<br/>";
			unlink($file);
		}
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
	 * @throws \PDOException PDO related errors
	 * @throws \Exception catch-all exception
	 *
	 */
	public static function readBusinessesCSV($urlBegin, $urlEnd) {
		$urls = glob("urlBegin*$urlEnd");
		if(count($urls) > 0) {
			$url = $urls[0];
		}
		$context = stream_context_create(array("http" => array("ignore_errors" => true, "method" => "GET")));

		try {
			$pdo = connectToEncryptedMySQL("/etc/apache2/mysql/foodquisition.ini");

			if(($fd = @fopen($url, "rb", false, $context)) !== false) {
				fgetcsv($fd, 0, ",");
				while((($data = fgetcsv($fd, 0, ",")) !== false) && feof($fd) === false) {
					$restaurantId = null;
					$restaurantAddress1 = $data[0];
					$restaurantAddress2 = $data[0];
					$restaurantCity = $data[0];
					$restaurantFacilityKey = $data[0];
					$restaurantGoogleId = $data[0];
					$restaurantName = $data[0];
					$restaurantPhoneNumber = $data[0];
					$restaurantState = $data[0];
					$restaurantType = $data[0];
					$restaurantZip = $data[0];
					$categoryId = null;
					$categoryName = $data[0];
					$violationId = null;
					$violationCategoryId = $data[0];
					$violationCode = $data[0];
					$violationCodeDescription = $data[0];
					$restaurantViolationId = null;
					$restaurantViolationRestaurantId = $data[0];
					$restaurantViolationViolationId = $data[0];
					$restaurantViolationCompliance = $data[0];
					$restaurantViolationDate = $data[0];
					$restaurantViolationMemo = $data[0];
					$restaurantViolationResults = $data[0];
					$googleId = "";

					//Convert everything to UTF - 8

					$restaurantId = mb_convert_encoding($restaurantId, "UTF-8", "UTF-16");
					$restaurantAddress1 = mb_convert_encoding($restaurantAddress1, "UTF-8", "UTF-16");
					$restaurantAddress2 = mb_convert_encoding($restaurantAddress2, "UTF-8", "UTF-16");
					$restaurantCity = mb_convert_encoding($restaurantCity, "UTF-8", "UTF-16");
					$restaurantFacilityKey = mb_convert_encoding($restaurantFacilityKey, "UTF-8", "UTF-16");
					$restaurantName = mb_convert_encoding($restaurantName, "UTF-8", "UTF-16");
					$restaurantPhoneNumber = mb_convert_encoding($restaurantPhoneNumber, "UTF-8", "UTF-16");
					$restaurantState = mb_convert_encoding($restaurantState, "UTF-8", "UTF-16");
					$restaurantType = mb_convert_encoding($restaurantType, "UTF-8", "UTF-16");
					$restaurantZip = mb_convert_encoding($restaurantZip, "UTF-8", "UTF-16");
					$categoryId = mb_convert_encoding($categoryId, "UTF-8", "UTF-16");
					$categoryName = mb_convert_encoding($categoryName, "UTF-8", "UTF-16");


					try {
						$restaurant = new Restaurant($restaurantId, $googleId, $facilityKey, $name, $address, $phone);
						$restaurant->insert($pdo);
					} catch(\PDOException $pdoException) {
						$sqlStateCode = "23000";

						$errorInfo = $pdoException->errorInfo;
						if($errorInfo[0] === $sqlStateCode) {
							//echo "<p>Duplicate</p>";
						} else {
							throw(new \PDOException($pdoException->getMessage(), 0, $pdoException));
						}
					} catch(\Exception $exception) {
						throw(new \Exception($exception->getMessage(), 0, \$pdoException));
					}

				}
				try {
					$category = new Category($categoryId, $categoryName);
					$category->insert($pdo);
				} catch(\PDOException $pdoException) {
					$sqlStateCode = "23000";

					$errorInfo = $pdoException->errorInfo;
					if($errorInfo[0] === $sqlStateCode) {
						// echo "<p>Duplicate</p>";
					} else {
						throw(new \PDOException($pdoException->getMessage(), 0, $pdoException));
					}
				} catch(\Exception $exception) {
					throw(new \Exception($exception->getMessage(), 0, \$pdoException));
				}
				try {
					$violation = new Violation($violationId, $violationCategoryId, $violationCode, $violationCodeDescription);
					$violation->insert($pdo);
				} catch(\PDOException $pdoException) {
					$sqlStateCode = "23000";

					$errorInfo = $pdoException->errorInfo;
					if($errorInfo[0] === $sqlStateCode) {
						//echo "<p>Duplicate</p>";
					} else {
						throw(new \PDOException($pdoException->getMessage(), 0, $pdoException));
					}
				} catch(Exception $exception) {
					throw(new Exception($exception->getMessage(), 0, \$pdoException));
				}
				try {
					$restaurantViolation = new RestaurantViolation($restaurantViolationId, $rest, $facilityKey, $name, $address, $phone);
					$restaurantViolation->insert($pdo);
				} catch(\PDOException $pdoException) {
					$sqlStateCode = "23000";

					$errorInfo = $pdoException->errorInfo;
					if($errorInfo[0] === $sqlStateCode) {
						//echo "<p>Duplicate</p>";
					} else {
						throw(new \PDOException($pdoException->getMessage(), 0, \$pdoException));
					}
				} catch(\Exception $exception) {
					throw(new \Exception($exception->getMessage(), 0, \$pdoException));
				}
			}

		}


