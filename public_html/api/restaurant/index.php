<?php
require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Foodquisition\Restaurant;

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

try {
	// grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

	// Check the SERVER superglobal for the type of HTTP method used; use the ternary operator to set based upon whether
	// it already exists or not
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Can't trust end users, so sanitize the inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$restaurantName = filter_input(INPUT_GET, "restaurantName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$restaurantAddress = filter_input(INPUT_GET, "restaurantAddress", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// Handler for GET requests (this should be the only type for this class);
	if($method === 'GET') {
		// first set the XSRF cookie
		setXsrfCookie();

		// get a specific restaurant from its ID and update our reply variable
		if(empty($id) === false) {
			$restaurant =
		}






	}



}