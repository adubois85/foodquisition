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

	/**
	 * A test that inserts a valid new restaurant entity into the database, then verifies
	 * that the returned mySQL data matches.
	 *
	 * This is coverage for the INSERT method.
	 */
	public function testInsertValidRestaurant() : void {
		// count and store the number of rows for later
		$numRows = $this->getConnection()->getRowCount("restaurant");

		// create our new dummy entity and insert into mySQL
		$restaurant = new Restaurant(null, $this->VALID_RESTAURANT_ADDRESS1, $this->VALID_RESTAURANT_ADDRESS2, $this->VALID_RESTAURANT_CITY, $this->VALID_RESTAURANT_FACILITY_KEY, $this->VALID_RESTAURANT_GOOGLE_ID, $this->VALID_RESTAURANT_NAME, $this->VALID_RESTAURANT_PHONE_NUMBER, $this->VALID_RESTAURANT_STATE, $this->VALID_RESTAURANT_TYPE, $this->VALID_RESTAURANT_ZIP);
		$restaurant->insert($this->getPDO());

		// grab the data from mySQL and store it
		$pdoRestaurant = Restaurant::getRestaurantByRestaurantId($this->getPDO(), $restaurant->getRestaurantId());

		// compare the data we entered with what we got back to see if they're the same
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurant"));
		$this->assertEquals($pdoRestaurant->getRestaurantAddress1(), $this->VALID_RESTAURANT_ADDRESS1);
		$this->assertEquals($pdoRestaurant->getRestaurantAddress2(), $this->VALID_RESTAURANT_ADDRESS2);
		$this->assertEquals($pdoRestaurant->getRestaurantCity(), $this->VALID_RESTAURANT_CITY);
		$this->assertEquals($pdoRestaurant->getRestaurantFacilityKey(), $this->VALID_RESTAURANT_FACILITY_KEY);
		$this->assertEquals($pdoRestaurant->getRestaurantGoogleId(), $this->VALID_RESTAURANT_GOOGLE_ID);
		$this->assertEquals($pdoRestaurant->getRestaurantName(), $this->VALID_RESTAURANT_NAME);
		$this->assertEquals($pdoRestaurant->getRestaurantPhoneNumber(), $this->VALID_RESTAURANT_PHONE_NUMBER);
		$this->assertEquals($pdoRestaurant->getRestaurantState(), $this->VALID_RESTAURANT_STATE);
		$this->assertEquals($pdoRestaurant->getRestaurantType(), $this->VALID_RESTAURANT_TYPE);
		$this->assertEquals($pdoRestaurant->getRestaurantZip(), $this->VALID_RESTAURANT_ZIP);
	}

	/**
	 * A test that attempts to insert an invalid new restaurant entity into the database
	 *
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidRestaurant() : void {
		// create an entity with a larger primary key int value than the database will
		// accept, it should fail
		$restaurant = new Restaurant(FoodquisitionTest::INVALID_KEY, $this->VALID_RESTAURANT_ADDRESS1, $this->VALID_RESTAURANT_ADDRESS2, $this->VALID_RESTAURANT_CITY, $this->VALID_RESTAURANT_FACILITY_KEY, $this->VALID_RESTAURANT_GOOGLE_ID, $this->VALID_RESTAURANT_NAME, $this->VALID_RESTAURANT_PHONE_NUMBER, $this->VALID_RESTAURANT_STATE, $this->VALID_RESTAURANT_TYPE, $this->VALID_RESTAURANT_ZIP);
		$restaurant->insert($this->getPDO());
	}

	/**
	 * A test that inserts a valid new restaurant entity into the database, then verifies
	 * that the returned mySQL data matches
	 *
	 * This is coverage for the getRestaurantByRestaurantId method
	 */
	public function testGetValidRestaurantByRestaurantId() : void {
		// count and store the number of rows for later
		$numRows = $this->getConnection()->getRowCount("restaurant");

		// create our new dummy entity and insert into mySQL
		$restaurant = new Restaurant(null, $this->VALID_RESTAURANT_ADDRESS1, $this->VALID_RESTAURANT_ADDRESS2, $this->VALID_RESTAURANT_CITY, $this->VALID_RESTAURANT_FACILITY_KEY, $this->VALID_RESTAURANT_GOOGLE_ID, $this->VALID_RESTAURANT_NAME, $this->VALID_RESTAURANT_PHONE_NUMBER, $this->VALID_RESTAURANT_STATE, $this->VALID_RESTAURANT_TYPE, $this->VALID_RESTAURANT_ZIP);
		$restaurant->insert($this->getPDO());

		// grab the data from mySQL and store it
		$pdoRestaurant = Restaurant::getRestaurantByRestaurantId($this->getPDO(), $restaurant->getRestaurantId());

		// compare the data we entered with what we got back to see if they're the same
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurant"));
		$this->assertEquals($pdoRestaurant->getRestaurantAddress1(), $this->VALID_RESTAURANT_ADDRESS1);
		$this->assertEquals($pdoRestaurant->getRestaurantAddress2(), $this->VALID_RESTAURANT_ADDRESS2);
		$this->assertEquals($pdoRestaurant->getRestaurantCity(), $this->VALID_RESTAURANT_CITY);
		$this->assertEquals($pdoRestaurant->getRestaurantFacilityKey(), $this->VALID_RESTAURANT_FACILITY_KEY);
		$this->assertEquals($pdoRestaurant->getRestaurantGoogleId(), $this->VALID_RESTAURANT_GOOGLE_ID);
		$this->assertEquals($pdoRestaurant->getRestaurantName(), $this->VALID_RESTAURANT_NAME);
		$this->assertEquals($pdoRestaurant->getRestaurantPhoneNumber(), $this->VALID_RESTAURANT_PHONE_NUMBER);
		$this->assertEquals($pdoRestaurant->getRestaurantState(), $this->VALID_RESTAURANT_STATE);
		$this->assertEquals($pdoRestaurant->getRestaurantType(), $this->VALID_RESTAURANT_TYPE);
		$this->assertEquals($pdoRestaurant->getRestaurantZip(), $this->VALID_RESTAURANT_ZIP);
	}

	/**
	 * A test to attempt grabbing a restaurant entity that does not exist
	 */
	public function testGetInvalidRestaurantByRestaurantId() : void {
		// attempt to search for an entity with a primary key int value larger than the
		// database allows, it should be null
		$restaurant = Restaurant::getRestaurantByRestaurantId($this->getPDO(), FoodquisitionTest::INVALID_KEY);
		$this->assertNull($restaurant);
	}

	/**
 	* A test to attempt grabbing a valid restaurant entity by its facility key
 	*/
	public function testGetValidRestaurantByFacilityKey() : void {
		// count and store the number of rows for later
		$numRows = $this->getConnection()->getRowCount("restaurant");

		// create our new dummy entity and insert into mySQL
		$restaurant = new Restaurant(null, $this->VALID_RESTAURANT_ADDRESS1, $this->VALID_RESTAURANT_ADDRESS2,$this->VALID_RESTAURANT_CITY, $this->VALID_RESTAURANT_FACILITY_KEY, $this->VALID_RESTAURANT_GOOGLE_ID, $this->VALID_RESTAURANT_NAME, $this->VALID_RESTAURANT_PHONE_NUMBER, $this->VALID_RESTAURANT_STATE, $this->VALID_RESTAURANT_TYPE, $this->VALID_RESTAURANT_ZIP);
		$restaurant->insert($this->getPDO());

		// grab the data from mySQL and store it
		$result = Restaurant::getRestaurantByFacilityKey($this->getPDO(), $restaurant->getRestaurantFacilityKey());

		// compare the data we entered with what we got back to see if they're the same
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurant"));
		$this->assertCount(1, $result);

		// grab and validate it
		$this->assertEquals($result->getRestaurantAddress1(), $this->VALID_RESTAURANT_ADDRESS1);
		$this->assertEquals($result->getRestaurantAddress2(), $this->VALID_RESTAURANT_ADDRESS2);
		$this->assertEquals($result->getRestaurantCity(), $this->VALID_RESTAURANT_CITY);
		$this->assertEquals($result->getRestaurantFacilityKey(), $this->VALID_RESTAURANT_FACILITY_KEY);
		$this->assertEquals($result->getRestaurantGoogleId(), $this->VALID_RESTAURANT_GOOGLE_ID);
		$this->assertEquals($result->getRestaurantName(), $this->VALID_RESTAURANT_NAME);
		$this->assertEquals($result->getRestaurantPhoneNumber(), $this->VALID_RESTAURANT_PHONE_NUMBER);
		$this->assertEquals($result->getRestaurantState(), $this->VALID_RESTAURANT_STATE);
		$this->assertEquals($result->getRestaurantType(), $this->VALID_RESTAURANT_TYPE);
		$this->assertEquals($result->getRestaurantZip(), $this->VALID_RESTAURANT_ZIP);
	}

	/**
	 * A test to attempt grabbing a restaurant entity by a facility key that does not exist
	 */
	public function testGetInvalidRestaurantByFacilityKey() : void {
		// attempt to search for an entity with a facility key that does not exist
		$restaurant = Restaurant::getRestaurantByFacilityKey($this->getPDO(), "123456");
		$this->assertCount(0, $restaurant);
	}

	/**
	 * A test to attempt grabbing a valid restaurant entity by its Google ID
	 */
	public function testGetValidRestaurantByGoogleId() : void {
		// count and store the number of rows for later
		$numRows = $this->getConnection()->getRowCount("restaurant");

		// create our new dummy entity and insert into mySQL
		$restaurant = new Restaurant(null, $this->VALID_RESTAURANT_ADDRESS1, $this->VALID_RESTAURANT_ADDRESS2,$this->VALID_RESTAURANT_CITY, $this->VALID_RESTAURANT_FACILITY_KEY, $this->VALID_RESTAURANT_GOOGLE_ID, $this->VALID_RESTAURANT_NAME, $this->VALID_RESTAURANT_PHONE_NUMBER, $this->VALID_RESTAURANT_STATE, $this->VALID_RESTAURANT_TYPE, $this->VALID_RESTAURANT_ZIP);
		$restaurant->insert($this->getPDO());

		// grab the data from mySQL and store it
		$result = Restaurant::getRestaurantByGoogleId($this->getPDO(), $restaurant->getRestaurantGoogleId());

		// compare the data we entered with what we got back to see if they're the same
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurant"));
		$this->assertCount(1, $result);

		// grab and validate it
		$this->assertEquals($result->getRestaurantAddress1(), $this->VALID_RESTAURANT_ADDRESS1);
		$this->assertEquals($result->getRestaurantAddress2(), $this->VALID_RESTAURANT_ADDRESS2);
		$this->assertEquals($result->getRestaurantCity(), $this->VALID_RESTAURANT_CITY);
		$this->assertEquals($result->getRestaurantFacilityKey(), $this->VALID_RESTAURANT_FACILITY_KEY);
		$this->assertEquals($result->getRestaurantGoogleId(), $this->VALID_RESTAURANT_GOOGLE_ID);
		$this->assertEquals($result->getRestaurantName(), $this->VALID_RESTAURANT_NAME);
		$this->assertEquals($result->getRestaurantPhoneNumber(), $this->VALID_RESTAURANT_PHONE_NUMBER);
		$this->assertEquals($result->getRestaurantState(), $this->VALID_RESTAURANT_STATE);
		$this->assertEquals($result->getRestaurantType(), $this->VALID_RESTAURANT_TYPE);
		$this->assertEquals($result->getRestaurantZip(), $this->VALID_RESTAURANT_ZIP);
	}

	/**
	 * A test to attempt grabbing a restaurant entity by a Google ID that does not exist
	 */
	public function testGetInvalidRestaurantByGoogleId() : void {
		// attempt to search for an entity with a facility key that does not exist
		$restaurant = Restaurant::getRestaurantByGoogleId($this->getPDO(), "invalidgoogleid123");
		$this->assertCount(0, $restaurant);
	}

	/**
	 * A test to attempt grabbing a valid restaurant entity by its name
	 */
	public function testGetValidRestaurantByName() : void {
		// count and store the number of rows for later
		$numRows = $this->getConnection()->getRowCount("restaurant");

		// create our new dummy entity and insert into mySQL
		$restaurant = new Restaurant(null, $this->VALID_RESTAURANT_ADDRESS1, $this->VALID_RESTAURANT_ADDRESS2,$this->VALID_RESTAURANT_CITY, $this->VALID_RESTAURANT_FACILITY_KEY, $this->VALID_RESTAURANT_GOOGLE_ID, $this->VALID_RESTAURANT_NAME, $this->VALID_RESTAURANT_PHONE_NUMBER, $this->VALID_RESTAURANT_STATE, $this->VALID_RESTAURANT_TYPE, $this->VALID_RESTAURANT_ZIP);
		$restaurant->insert($this->getPDO());

		// grab the data from mySQL and store it
		$results = Restaurant::getRestaurantByName($this->getPDO(), $restaurant->getRestaurantName());

		// compare the data we entered with what we got back to see if they're the same
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurant"));
		$this->assertCount(1, $results);

		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\Restaurant", $results);

		// it should be the first indexed item in the array; grab and validate it
		$pdoRestaurant = $results[0];
		$this->assertEquals($pdoRestaurant->getRestaurantAddress1(), $this->VALID_RESTAURANT_ADDRESS1);
		$this->assertEquals($pdoRestaurant->getRestaurantAddress2(), $this->VALID_RESTAURANT_ADDRESS2);
		$this->assertEquals($pdoRestaurant->getRestaurantCity(), $this->VALID_RESTAURANT_CITY);
		$this->assertEquals($pdoRestaurant->getRestaurantFacilityKey(), $this->VALID_RESTAURANT_FACILITY_KEY);
		$this->assertEquals($pdoRestaurant->getRestaurantGoogleId(), $this->VALID_RESTAURANT_GOOGLE_ID);
		$this->assertEquals($pdoRestaurant->getRestaurantName(), $this->VALID_RESTAURANT_NAME);
		$this->assertEquals($pdoRestaurant->getRestaurantPhoneNumber(), $this->VALID_RESTAURANT_PHONE_NUMBER);
		$this->assertEquals($pdoRestaurant->getRestaurantState(), $this->VALID_RESTAURANT_STATE);
		$this->assertEquals($pdoRestaurant->getRestaurantType(), $this->VALID_RESTAURANT_TYPE);
		$this->assertEquals($pdoRestaurant->getRestaurantZip(), $this->VALID_RESTAURANT_ZIP);
	}



}