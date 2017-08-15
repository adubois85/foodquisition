<?php
namespace Edu\Cnm\Foodquisition\Test;

use Edu\Cnm\Foodquisition\Restaurant;

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPUnit test for the Restaurant class
 *
 * This is a complete PHPUnit test of the Restaurant class because every mySQL / PDO enabled
 * methods are tested for both valid and invalid inputs.
 *
 * @see Restaurant
 * @author Alexander DuBois <adubois2@cnm.edu>
 */

class RestaurantTest extends FoodquisitionTest{

	/**
	 * valid restaurant address line 1 for the test restaurant entity
	 * @var $VALID_RESTAURANT_ADDRESS1
	 */
	protected $VALID_RESTAURANT_ADDRESS1 = "1234 Thunder Rd. NE";

	/**
	 * valid restaurant address line 2 for the test restaurant entity
	 * @var $VALID_RESTAURANT_ADDRESS2
	 */
	protected $VALID_RESTAURANT_ADDRESS2 = "Deliver to dock 31";

	/**
	 * valid restaurant city for the test restaurant entity
	 * @var $VALID_RESTAURANT_CITY
	 */
	protected $VALID_RESTAURANT_CITY = "Alburquerque";

	/**
	 * valid restaurant facility key for the test restaurant entity
	 * @var $VALID_RESTAURANT_FACILITY_KEY
	 */
	protected $VALID_RESTAURANT_FACILITY_KEY = "12345";

	/**
	 * valid restaurant Google ID for the test restaurant entity
	 * @var $VALID_RESTAURANT_GOOGLE_ID
	 */
	protected $VALID_RESTAURANT_GOOGLE_ID = "ChIJe4MJ090KIocR_fbZuM7408A";

	/**
	 * valid restaurant name for the test restaurant entity
	 * @var $VALID_RESTAURANT_NAME
	 */
	protected $VALID_RESTAURANT_NAME = "Fuzzy Wuzzy's Furry Food Emporium";

	/**
	 * valid restaurant phone number for the test restaurant entity
	 * @var $VALID_RESTAURANT_PHONE_NUMBER
	 */
	protected $VALID_RESTAURANT_PHONE_NUMBER = "5058675309";

	/**
	 * valid restaurant state for the test restaurant entity
	 * @var $VALID_RESTAURANT_STATE
	 */
	protected $VALID_RESTAURANT_STATE = "NM";

	/**
	 * valid restaurant type for the test restaurant entity
	 * @var $VALID_RESTAURANT_TYPE
	 */
	protected $VALID_RESTAURANT_TYPE = "Mobile-Food Unit";

	/**
	 * valid restaurant ZIP code for the test restaurant entity
	 * @var $VALID_RESTAURANT_ZIP
	 */
	protected $VALID_RESTAURANT_ZIP = "87114-4411";



}