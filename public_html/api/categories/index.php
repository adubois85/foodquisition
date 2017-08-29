<?php
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Foodquisition\Category;
	// we only use the category class for testing purposes
/**
 * api for the Category class
 *
 * @author {} <dannielle.bojorquez@gmail.com>
 *
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
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

	// mock a category by mocking the session and assigning a specific item to it.
	// this is only for testing purposes and should not be in the live code.
	//$_SESSION["category"] = Category::getCategoryByCategoryId($pdo, 732);

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$categoryId = filter_input(INPUT_GET, "categoryId", FILTER_VALIDATE_INT);
	$categoryName = filter_input(INPUT_GET, "categoryName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it
	if(($method === "GET") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific tweet based on arguments provided or all the tweets and update reply
		if(empty($id) === false) {
			$category = Category::getCategoryByCategoryId($pdo, $id);
			if($category !== null) {
				$reply->data = $category;
			}
		} else if(empty($categoryName) === false) {
			$category = Category::getCategoryByCategoryName($pdo, $categoryName)->toArray();
			if($category !== null) {
				$reply->data = $category;
			}
		}
		// update the $reply->status $reply->message
	}
catch
	(\Exception | \TypeError $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}

header("Content-type: category/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);

// finally - JSON encodes the $reply object and sends it back to the front end.
}
