<?php

namespace Edu\Cnm\Foodquisition;

use Edu\Cnm\Foodquisition\{
	Restaurant, Violation, Category, RestaurantViolation
};
use PHPUnit\Runner\Exception;

require_once("autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

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

//	public static function getData($url, $redirect = 1) {
//		$context = stream_context_create(array("http" => array("follow_location" => $redirect, "ignore_errors" => true, "method" => "HEAD")));
//
//	}


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
	public static function readBloodyCSV(string $bloodyFilename) {
		try {
			$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

			if(($fd = @fopen($bloodyFilename, "rb")) !== false) {
				fgetcsv($fd, 0, ",");
				while((($data = fgetcsv($fd, 0, ",")) !== false) && feof($fd) === false) {
					$restaurantId = null;
					$restaurantAddress1 = substr($data[2], 0, 128);
					$restaurantAddress2 = $data[0];
					$restaurantCity = $data[3];
					$restaurantFacilityKey = $data[1];
					$restaurantGoogleId = null;
					$restaurantName = substr($data[0], 0, 64);
					$restaurantPhoneNumber = $data[13];
					$restaurantState = $data[4];
					$restaurantType = $data[15];
					$restaurantZip = $data[5];
					$restaurantViolationId = null;
					$restaurantViolationRestaurantId = $restaurantId;
					$restaurantViolationViolationId = null;
					$restaurantViolationCompliance = $data[25];
					$restaurantViolationDate = $data[16];
					$restaurantViolationMemo = $data[27];
					$restaurantViolationResults = $data[23];
					$googleId = "";


					try {
						$restaurant = new Restaurant($restaurantId, $restaurantAddress1, $restaurantAddress2, $restaurantCity, $restaurantFacilityKey, $restaurantGoogleId, $restaurantName, $restaurantPhoneNumber, $restaurantState, $restaurantType, $restaurantZip);
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
						throw(new \Exception($exception->getMessage(), 0, $exception));
					}


//				if(($fd = @fopen($bloodyFilename, "rb")) !== false) {
//					fgetcsv($fd, 0, ",");
//					while((($data = fgetcsv($fd, 0, ",")) !== false) && feof($fd) === false) {
//						$restaurantViolationId = null;
//						$restaurantViolationRestaurantId = $restaurantId;
//						$restaurantViolationViolationId = null;
//						$restaurantViolationCompliance = $data[25];
//						$restaurantViolationDate = $data[16];
//						$restaurantViolationMemo = $data[27];
//						$restaurantViolationResults = $data[23];
//						$googleId = "";


						try {
							$restaurantViolation = new RestaurantViolation($restaurantViolationId, $restaurantViolationRestaurantId, $restaurantViolationViolationId, $restaurantViolationCompliance, $restaurantViolationDate, $restaurantViolationMemo, $restaurantViolationResults);
							$restaurantViolation->insert($pdo);

						} catch(\PDOException $pdoException) {
							$sqlStateCode = "23000";


							$errorInfo = $pdoException->errorInfo;
							if($errorInfo[0] === $sqlStateCode) {
								//echo "<p>Duplicate</p>";
							} else {
								throw(new \PDOException($pdoException->getMessage(), 0, $pdoException));
							}
						} catch(\Exception $exception) {
							throw(new \Exception($exception->getMessage(), 0, $exception));
						}
					}
					fclose($fd);
				}
			}


		catch
			(\PDOException $pdoException) {
				throw(new \PDOException($pdoException->getMessage(), 0, $pdoException));
			} catch(Exception $exception) {
				throw(new \Exception($exception->getMessage(), 0, $exception));
			}

}
		}

try {
	DataDownloader::readBloodyCSV("/home/dbranch6/food-inspections.csv");
} catch(\Exception $exception) {
	var_dump($exception);
	echo "Bloody Error (BE) " . $exception->getMessage() . PHP_EOL;
}


