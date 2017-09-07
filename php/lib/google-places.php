<?php
/*
 * Functions for handling Google Places API calls
 */
use SKAgarwal\GoogleApi\PlacesApi;
/*

// Check if the restaurant has a Google Id, query google for one if it doesn't
function googleIdCheck($restaurant, $googleId) {
	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);
	if($googleId === null) {
		// set up the Google Places call
		$googlePlaces = new PlacesApi("$googleKey");
		// we need to be specific when searching Google's database so we don't get similarly named places back
		$query = $restaurant->getRestaurantName() ."+". $restaurant->getRestaurantAddress1() ."+". $restaurant->getRestaurantCity();
		$response = json_decode(($googlePlaces->textSearch("$query")), true);
		//var_dump($response);
		// check if the response came back from Google OK and set the place ID, otherwise do nothing
		if($response['status'] === 'OK'){
			$restaurant->setRestaurantGoogleId($response['results'][0]['place_id']);
		}
		// If it has a Google ID already, query Google base on that ID.  If they don't match, assume the new one is
		// better and set it equal to that
	} else {
		$oldGoogleId = $googleId;
		$googlePlaces = new PlacesApi("$googleKey");
		$response = json_decode(($googlePlaces->placeDetails("$oldGoogleId")), true);
		$newGoogleId = $response['result']['place_id'];
		if ($oldGoogleId !== $newGoogleId) {
			$restaurant->setRestaurantGoogleId($newGoogleId);
		}
	}
////	var_dump($response);
//	$photoId = $response['results'][0]['photos'][0]['photo_reference'];
//	echo($photoId);
//	return('https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference='."$photoId".'&key='."$googleKey");
}

function googlePictureSearch($googleId) {
	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);

//	if($googleId === null) {
//		echo("No Google ID [Should probably return a placeholder image]");
//	} else {
		// set up the Google Places call
		$googlePlaces = new PlacesApi("$googleKey");
		$response = json_decode($googlePlaces->placeDetails("$googleId"), true);
		$photoId = $response['results'][0]['photos'][0]['photo_reference'];
//		var_dump($photoId);
//		var_dump($googleKey);
		$image = base64_encode(file_get_contents("https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference=$photoId&key=$googleKey"));
		var_dump($image);
}

function testFunction($restaurant, $googleId) {
	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);

	// set up the Google Places call
	$googlePlaces = new PlacesApi("$googleKey");
//	var_dump($googlePlaces);
	// we need to be specific when searching Google's database so we don't get similarly named places back
	$query = str_replace(" ", "+",$restaurant->getRestaurantName() ."+". $restaurant->getRestaurantAddress1() ."+". $restaurant->getRestaurantCity());
//	var_dump($query);
	$response = json_decode(($googlePlaces->textSearch("$query")), true);
	var_dump($response);
	$restaurant->setRestaurantGoogleId($response['results'][0]['place_id']);

	$oldGoogleId = $restaurant->getRestaurantGoogleId();
//	var_dump($oldGoogleId);
	$googlePlaces = new PlacesApi("$googleKey");
	$response = json_decode(($googlePlaces->placeDetails("$oldGoogleId")), true);
//	return($response);
//	var_dump($response);
	$result = $response["result"] ?? $response["results"];
	$photoId = $result['photos'][0]['photo_reference'];
//	var_dump($photoId);
	$image = base64_encode(file_get_contents("https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference=$photoId&key=$googleKey"));
	var_dump($image);
	return($image);
}
*/
/**
 * Google Places API calls
 *
 * @param $restaurant /Restaurant object that we are getting information about
 * @param $googleId restaurantGoogleId of the restaurant; it is possibly null, either because we haven't queried
 * 		  Google for it yet or because Google can't find it.
 * @param $position array position of the passed object; if it is only a single restaurant object, it will be the 0 position
 * @return mixed -- Will update a restaurant's google ID in the database if it can; will give the first image associated
 *			   with that place from Google if it can (as raw data for Angular front-end)
 */

function googleSingle($restaurant, $googleId, $position = 0) {
	// grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);
	// set up the Google Places call
	$googlePlaces = new PlacesApi("$googleKey");
	// if a Restaurant doesn't have a Google ID, then try to find one and add it
	if($googleId === null) {
		// we need to be specific when searching Google's database so we don't get similarly named places back
		$query = str_replace(" ", "+", $restaurant->getRestaurantName() . "+" . $restaurant->getRestaurantAddress1() . "+" . $restaurant->getRestaurantCity());
		$response = json_decode(($googlePlaces->textSearch("$query")), true);
		//var_dump($response);
		// check if the response came back from Google OK and set the place ID, otherwise do nothing
		// we'll assume that the first returned result is the correct one
		if($response['status'] === 'OK') {
			$restaurant->setRestaurantGoogleId($response['results'][0]['place_id']);
			$restaurant->update($pdo);
			$attribution = $response['results'][$position]['photos'][0]['html_attributions'][0];
			$photoId = $response['results'][$position]['photos'][0]['photo_reference'];
		}
	} else {
		$response = json_decode(($googlePlaces->placeDetails("$googleId")), true);
		if($response['status'] === 'OK') {
			$attribution = $response['result']['photos'][0]['html_attributions'][0];
			$photoId = $response['result']['photos'][0];
		}
	}
	if($photoId === null) {
		// [TODO: Alex -- should return a placeholder image if it couldn't get one from Google]
		echo("No Image available");
	} else {
		// Search Google for the image ID we found above, encode it into raw data to pass off to the front-end (Angular)
		$image = base64_encode(file_get_contents("https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference=$photoId&key=$googleKey"));
	}
	$googleImage = new stdClass();
	$googleImage->image = $image;
	$googleImage->attribution = $attribution;
	return $googleImage;
}