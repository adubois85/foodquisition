<?php
/*
 * Functions for handling Google Places API calls
 */




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
		$response = json_decode(($googlePlaces->placeDetails("$oldGoogleId")));
		$newGoogleId = $response['results'][0]['place_id'];
		if ($oldGoogleId !== $newGoogleId) {
			$restaurant->setRestaurantGoogleId($newGoogleId);
		}
	}
}