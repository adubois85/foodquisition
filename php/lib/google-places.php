<?php
/*
 * Functions for handling Google Places API calls
 */
use Edu\Cnm\Foodquisition\JsonObjectStorage;
use SKAgarwal\GoogleApi\PlacesApi;


/**
 * Google Places API calls for a single restaurant
 *
 * @param $restaurant /Restaurant object that we are getting information about
 * @param $googleId restaurantGoogleId of the restaurant; it is possibly null, either because we haven't queried
 * 		  Google for it yet or because Google can't find it
 * @return mixed -- Will update a restaurant's google ID in the database if it can; will give the first image associated
 *			   with that place from Google if it can (as raw data for Angular front-end), and that image's html attribution
 */

function googlePlacesSingle($restaurant, $googleId) : stdClass {
	// grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);
	// set up the Google Places call
	$googlePlaces = new PlacesApi("$googleKey");
	$googleImage = new stdClass();

	try {
		// if a Restaurant doesn't have a Google ID, then try to find one and add it
		if($googleId === null) {
			// we need to be specific when searching Google's database so we don't get similarly named places back
			$query = urlencode(($restaurant->getRestaurantName() . " " . $restaurant->getRestaurantAddress1() . " " . $restaurant->getRestaurantCity()));
			$response = json_decode(($googlePlaces->textSearch("$query")), true);
			//var_dump($response);
			// check if the response came back from Google OK and set the place ID, otherwise do nothing
			// we'll assume that the first returned result is the correct one
			if($response['status'] === 'OK') {
				// get the Google place_id and set it in our database
				$restaurant->setRestaurantGoogleId($response['results'][0]['place_id']);
				$restaurant->update($pdo);
				// make sure Google actually has a photo for the place, else it will error out
				if(isset($response['results'][0]['photos'])) {
					$attribution = $response['results'][0]['photos'][0]['html_attributions'][0];
					$googleImage->attribution = $attribution;
					$photoId = $response['results'][0]['photos'][0]['photo_reference'];
					$googleImage->photoId = $photoId;
				}
			}
		} else {
			$response = json_decode(($googlePlaces->placeDetails("$googleId")), true);
			// make sure Google actually has a photo for the place, else it will error out
			if($response['status'] === 'OK' && isset($response['result']['photos'])) {
				$attribution = $response['result']['photos'][0]['html_attributions'][0];
				$googleImage->attribution = $attribution;
				$photoId = $response['result']['photos'][0]['photo_reference'];
				$googleImage->photoId = $photoId;
			}
		}
		// if a photoID hasn't been set at this point, Google probably doesn't have a photo for the place, so give a placeholder instead
		if(isset($googleImage->photoId) === false) {
			// [TODO: Alex -- should return a placeholder image if it couldn't get one from Google; replace the echo]
			echo("No Image available");
		} else {
			//	var_dump($array);
			// Search Google for the image ID we found above, encode it into raw data to pass off to the front-end (Angular)
			$image = base64_encode(file_get_contents("https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference=$googleImage->photoId&key=$googleKey"));
			$googleImage->image = $image;
			$googleImage->attribution = $attribution;
		}
	} catch(Exception $exception) {
			$image = base64_encode(file_get_contents(dirname(__DIR__, 2) . "/public_html/images/placeholder.jpg"));
			$googleImage->image = $image;
			$googleImage->attribution = null;
	}
//	var_dump($googleImage);
	return $googleImage;
}

/**
 * Google Places API calls for an array of restaurants
 *
 * @param $restaurants array of Restaurant objects that we are getting information about
 * @param $googleId restaurantGoogleId of the restaurant; it is possibly null, either because we haven't queried
 * 		  Google for it yet or because Google can't find it
 * @return mixed -- Will update a restaurant's google ID in the database if it can; will give the first image associated
 *			   with each place from Google if it can (as raw data for Angular front-end), and that image's html attribution
 * 			as an array of values
 */

function googlePlacesArray(array $restaurants) : array {
	// grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");

	$config = readConfig("/etc/apache2/capstone-mysql/foodquisition.ini");
	// $config["google"] now exists
	$googleKey = ($config['google']);
	// set up the Google Places call
	$googlePlaces = new PlacesApi("$googleKey");
	$googleImages = [];
	foreach($restaurants as $restaurant) {
		$googleId = $restaurant->getRestaurantGoogleId();
		$googleImage = new stdClass();
		// if a Restaurant doesn't have a Google ID, then try to find one and add it
		if($googleId === null) {
			// we need to be specific when searching Google's database so we don't get similarly named places back
			$query = urlencode(($restaurant->getRestaurantName() . "+" . $restaurant->getRestaurantAddress1() . "+" . $restaurant->getRestaurantCity()));
			$response = json_decode(($googlePlaces->textSearch("$query")), true);
//			var_dump($response);
			// check if the response came back from Google OK and set the place ID, otherwise do nothing
			// we'll assume that the first returned result is the correct one
			if($response['status'] === 'OK') {
				// get the Google place_id and set it in our database
				$restaurant->setRestaurantGoogleId($response['results'][0]['place_id']);
				$restaurant->update($pdo);
				// make sure Google actually has a photo for the place, else it will error out
				if(isset($response['results'][0]['photos'])) {
					$attribution = $response['results'][0]['photos'][0]['html_attributions'][0];
					$googleImage->attribution = $attribution;
					$photoId = $response['results'][0]['photos'][0]['photo_reference'];
					$googleImage->photoId = $photoId;
				}
			}
		} else {
			$response = json_decode(($googlePlaces->placeDetails("$googleId")), true);
			// make sure Google actually has a photo for the place, else it will error out
			if($response['status'] === 'OK' && isset($response['result']['photos'])) {
				$attribution = $response['result']['photos'][0]['html_attributions'][0];
				$googleImage->attribution = $attribution;
				$photoId = $response['result']['photos'][0]['photo_reference'];
				$googleImage->photoId = $photoId;
			}
		}
		// if a photoID hasn't been set at this point, Google probably doesn't have a photo for the place, so give a placeholder instead
		if(isset($googleImage->photoId) === false) {
			// [TODO: Alex -- should return a placeholder image if it couldn't get one from Google; replace the echo.]
			echo("No Image available");
		} else {
			// Search Google for the image ID we found above, encode it into raw data to pass off to the front-end (Angular)
			$image = base64_encode(file_get_contents("https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&photoreference=$googleImage->photoId&key=$googleKey"));
			$googleImage->image = $image;
			$googleImage->attribution = $attribution;
		}
		$googleImages[] = $googleImage;
	}
	var_dump($googleImages);
	return $googleImages;
}