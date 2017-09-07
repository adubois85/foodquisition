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

function googleSingle($restaurant, $googleId) {
	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);
	$photoId = "";
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
			$photoId = $response['results']['photos'][0];
		}
	} else {
		$response = json_decode(($googlePlaces->placeDetails("$oldGoogleId")), true);

	}




}