 <?php
	 require_once ("../classes/autoload.php");
	 require_once ("/etc/apache2/capstone-mysql/encrypted-config.php");

	 use Edu\Cnm\Foodquisition\{Restaurant, RestaurantViolation, Violation, Category, JsonObjectStorage};


	 /**
	  * function to get RestaurantDetails by Restaurant Name
	  * @param \SplFixedArray
	  * @returns $restaurantDetails[] storage of restaurant details
	  *
	  * @throws
	  *
	  **/

	 function getRestaurantDetails (\SplFixedArray $restaurants) : array {
	 	 $pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/foodquisition.ini");
	 	 $restaurantDetails = [];

	 	 foreach($restaurants as $restaurant) {
	 	 	$details = Details::getDetailsByDetails($pdo, $restaurant->getRestaurantDetails());
	 	 	$restaurantDetails = (object) [
	 	 		'restaurantId'=> $restaurant->getRestaurantId(),
				'restaurantName'=> $restaurant->getRestaurantName(),
				'restaurantAddress1'=> $restaurant->getRestaurantAddress1(),
		 }
	 }