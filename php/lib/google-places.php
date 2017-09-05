<?php
/*
 * Functions for handling Google Places API calls
 */
use SKAgarwal\GoogleApi\PlacesApi;

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
		$photoId = $response['result']['photos'][0]['photo_reference'];
		var_dump($photoId);
		return('https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference='."$photoId".'&key='."$googleKey");
	}
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
		$photoId = $response['result']['photos'][0]['photo_reference'];
		var_dump($photoId);
		return('https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference='."$photoId".'&key='."$googleKey");
}

function testFunction($googleId) {
	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);
	$oldGoogleId = $googleId;
	$googlePlaces = new PlacesApi("$googleKey");
	$response = json_decode(($googlePlaces->placeDetails("$oldGoogleId")), true);
//	return($response);
	$photoId = $response['result']['photos'][0]['photo_reference'];
	var_dump($photoId);
	return('https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference='."$photoId".'&key='."$googleKey");
}