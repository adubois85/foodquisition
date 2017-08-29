<?php
require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Foodquisition\Restaurant;
use Edu\Cnm\Foodquisition\Violation;
use Edu\Cnm\Foodquisition\RestaurantViolation;
use Edu\Cnm\Foodquisition\Category;
use Edu\Cnm\Foodquisition\JsonObjectStorage;
/**
 * api for the restaurantViolation class
 *
 * @author Dannielle Bojorquez <dannielle.bojorquez@gmail.com>
 **/
//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	// ensure there's a user logged in
//	if(empty($_SESSION["adUser"]) === true) {
//		throw(new RuntimeException("user not logged in", 401));
//	}
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");
	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	//sanitize input
	$restaurantId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$ViolationId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$restaurantViolationId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$CategoryId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//get a specific application or all applications and update reply
		if(empty($restaurantId) === false) {
			$restaurant = Restaurant::getRestaurantByRestaurantId($pdo, $restaurantId);
			if($restaurant !== null) {
				$reply->data = $restaurant;
			}
		} else if(empty($restaurantViolationId) === false) {
			$restaurants = Restaurant::getRestaurantsByViolationId($pdo, $restaurantViolationId);
			if($restaurants !== null) {
				$storage = new JsonObjectStorage();
				for($i = 0; $i < count($restaurants); $i++){
					$storage->attach(
						$restaurants[$i],
						[
							Violation::getViolationByViolationId($pdo, $restaurants[$i]->getRestaurantViolationId()),
							RestaurantViolation::getRestaurantViolationByRestaurantViolationId($pdo, $restaurants[$i]->getRestaurantViolationId()),
							Category::getCategoryByCategoryId($pdo, $restaurants[$i]->getRestaurantCategoryId())
						]
					);
				}
				$reply->data = $storage;
			}
		} else if(empty($restaurantCategoryId) === false) {
			$restaurants = Restaurant::getRestaurantsByCategoryId($pdo, $restaurantCategoryId);
			if($restaurants !== null) {
				$reply->data = $restaurants->toArray();
			}
		}else if(empty($restaurantRestaurantViolationId) === false) {
			$restaurants = Restaurant::getRestaurantsByRestaurantViolationId($pdo, $restaurantRestaurantViolationId);
			if($restaurants !== null) {
				$reply->data = $restaurants->toArray();
			}
		} else {
			$restaurants = Restaurant::getAllRestaurants($pdo);
			if($restaurants !== null) {
				$storage = new JsonObjectStorage();
				for($i = 0; $i < count($restaurants); $i++){
					$storage->attach(
						$restaurants[$i],
						[
							Violation::getViolationByViolationId($pdo, $restaurants[$i]->getRestaurantViolationId()),
							RestaurantViolation::getRestaurantViolationByRestaurantViolationId($pdo, $restaurants[$i]->getRestaurantViolationId()),
							Category::getCategoryByCategoryId($pdo, $restaurants[$i]->getRestaurantCategoryId())
						]
					);
				}
				$reply->data = $storage;
			}
		}
	}else {
		throw (new Exception("Invalid HTTP request!", 405));
	}
	// update reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
header("Content-type: restaurant/json");
if($reply->data === null) {
	unset($reply->data);
}
// encode and return reply to front end caller
echo json_encode($reply);
