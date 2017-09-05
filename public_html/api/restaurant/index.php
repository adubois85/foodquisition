<?php
require_once (dirname(__DIR__,3) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,3) . "/vendor/autoload.php");
require_once (dirname(__DIR__,3) . "/php/lib/xsrf.php");
require_once (dirname(__DIR__,3) . "/php/lib/google-places.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Foodquisition\Restaurant;
use SKAgarwal\GoogleApi\PlacesApi;

/*
 * API for Restaurant class
 *
 * @author Alexander DuBois <adubois@alumni.uci.edu>
 */

// verify there is an active session, and start it if not
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// create an empty reply object
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;


/*
 * TODO[Alex]: Google Places API integration
 */

try {
	// grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

	//$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");

	// $config["google"] now exists
	//$googleKey = ($config['google']);
	//var_dump($config);



	// Check the SERVER superglobal for the type of HTTP method used; use the ternary operator to set based upon whether
	// it already exists or not
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Can't trust end users, so sanitize the inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$restaurantName = filter_input(INPUT_GET, "restaurantName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$restaurantGoogleId = filter_input(INPUT_GET, "restaurantGoogleId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


	// Handler for GET requests (this should be the only type for this class);
	if($method === 'GET') {
		// first set the XSRF cookie
		setXsrfCookie();

		// get a specific restaurant from its ID and update our reply variable
		if(empty($id) === false) {
			$restaurant = Restaurant::getRestaurantByRestaurantId($pdo, $id);
			if($restaurant !== null) {
				$reply->data = $restaurant;
				$googleId = $restaurant->getRestaurantGoogleId();
				googleIdCheck($restaurant, $googleId);
				// Check if the restaurant has a Google Id, query google for one if it doesn't
//				if($googleId === null) {
//					// set up the Google Places call
//					$googlePlaces = new PlacesApi("$googleKey");
//					// we need to be specific when searching Google's database so we don't get similarly named places back
//					$query = $restaurant->getRestaurantName() ."+". $restaurant->getRestaurantAddress1() ."+".
//					$restaurant->getRestaurantCity();
////					var_dump($query);
//					$response = json_decode(($googlePlaces->textSearch("$query")), true);
////					var_dump($response);
//					$restaurant->setRestaurantGoogleId($response['results'][0]['place_id']);
//				}
			}

		// Personal note -- in PHP, elseif and else if (two words) are treated identically in these if/else blocks
		// The two-word form will not work, however, in the alternative syntax for control structures

		// get restaurants by their name; this should return an array of matches
		} else if(empty($restaurantName) === false) {
			$restaurants = Restaurant::getRestaurantByName($pdo, $restaurantName)->toArray();
			if($restaurants !== null) {
				$reply->data = $restaurants;
			}
		// get a restaurant by its Google ID if it has one
		} else if(empty($restaurantGoogleId) === false) {
			$restaurant  = Restaurant::getRestaurantByGoogleId($pdo, $restaurantGoogleId);
			if($restaurant !== null) {
				$reply->data = $restaurant;
			}
 		}
	}
	// catch errors and update the reply variable with the HTTP status code and its associated message
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
// set the HTTP header type
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// JSON encode and return the reply to front end caller
echo json_encode($reply);
