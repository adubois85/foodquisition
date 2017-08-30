<?php
namespace Edu\Cnm\Foodquisition;

require_once ("autoload.php");

/**
 * @author Alexander DuBois <adubois@alumni.uci.edu>
 * @version 0.1
 */
class Restaurant implements \JsonSerializable {

	/**
	 * ID for this restaurant; will be a unique, auto-incrementing integer.
	 * This is the primary key.
	 * @var int $restaurantId
	 */
	private $restaurantId;

	/**
	 * Per USPS standards, the address 1 line of the address (street number, name, direction, etc.) for this facility.
	 * Cannot be NULL
	 * @var string $restaurantAddress1
	 */
	private $restaurantAddress1;

	/**
	 * Per USPS standards, the address 2 line of the address (Typically delivery comments such as "leave at door") for this facility.
	 * @var string $restaurantAddress2
	 */
	private $restaurantAddress2;

	/**
	 * Per USPS standards, the city where this facilty is located.
	 * Cannot be NULL
	 * @var string $restaurantCity
	 */
	private $restaurantCity;

	/**
	 * The unique identifying number given to this facility by the City of Albuquerque
	 * Cannot be NULL
	 * @var string $restaurantFacilityKey
	 */
	private $restaurantFacilityKey;

	/**
	 * The ID number given by Google for this facility to allow for pulling information from Google APIs.  In theory it should be unique, but that's not guaranteed.
	 * Cannot be NULL
	 * @var string $restaurantGoogleId
	 */
	private $restaurantGoogleId;

	/**
	 * The name of this facility.
	 * Cannot be NULL
	 * @var string $restaurantName
	 */
	private $restaurantName;

	/**
	 * The phone number for this facility
	 * @var string $restaurantPhoneNumber
	 */
	private $restaurantPhoneNumber;

	/**
	 * The 2-digit abbreviation for the state in which this facility is located.
	 * Cannot be NULL
	 * @var string $restaurantState
	 */
	private $restaurantState;

	/**
	 * The designation of the type of business (e.g. mobile food unit, school, etc.) given to this facility by the city of Albquerque.
	 *   Cannot be NULL
	 * @var string $restaurantType
	 */
	private $restaurantType;

	/**
	 * the 5-digit (or 5 + 4-digit) ZIP code for this facility.
	 * Cannot be NULL
	 * @var string $restaurantZip
	 */
	private $restaurantZip;

	/**
	 * Constructor function for this facility
	 *
	 * @param int | null $newRestaurantId ID number for this facility, NULL if new
	 * @param string $newRestaurantAddress1 primary address line for this facility
	 * @param string | null $newRestaurantAddress2 optional secondary address line for this facility
	 * @param string $newRestaurantCity name of the city where this facility is located
	 * @param string $newRestaurantFacilityKey unique 7-digit number given to the facility by the city
	 * @param string | null $newRestaurantGoogleId ID given by google to this facility for pulling data from Google APIs
	 * @param string $newRestaurantName name of this facility
	 * @param string | null $newRestaurantPhoneNumber phone number for this facility
	 * @param string $newRestaurantState 2-digit abbreviation of state where this facility is located
	 * @param string $newRestaurantType designation given to this facility by the city regarding kind of business (e.g. school)
	 * @param string $newRestaurantZip 5-digit (or 5 + 4-digit) ZIP code for this facility
	 * @throws \TypeError if the entered data types are not of the correct type per type hints
	 * @throws \InvalidArgumentException if the entered the data types are not valid after sanitization
	 * @throws \RangeException if the entered data types are out of bounds for each function (e.g. not a positive integer, string too long, etc.)
	 * @throws \Exception for any other type of error not otherwise caught
	 */
	public function __construct(?int $newRestaurantId, string $newRestaurantAddress1, ?string $newRestaurantAddress2, string $newRestaurantCity, string $newRestaurantFacilityKey, ?string $newRestaurantGoogleId, string $newRestaurantName, ?string $newRestaurantPhoneNumber, string $newRestaurantState, string $newRestaurantType, string $newRestaurantZip) {

		try {
			$this->setRestaurantId($newRestaurantId);
			$this->setRestaurantAddress1($newRestaurantAddress1);
			$this->setRestaurantAddress2($newRestaurantAddress2);
			$this->setRestaurantCity($newRestaurantCity);
			$this->setRestaurantFacilityKey($newRestaurantFacilityKey);
			$this->setRestaurantGoogleId($newRestaurantGoogleId);
			$this->setRestaurantName($newRestaurantName);
			$this->setRestaurantPhoneNumber($newRestaurantPhoneNumber);
			$this->setRestaurantState($newRestaurantState);
			$this->setRestaurantType($newRestaurantType);
			$this->setRestaurantZip($newRestaurantZip);
		} catch(\RangeException | \InvalidArgumentException | \TypeError | \Exception $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * Accessor method for restaurantId
	 *
	 * @return int | null value of restaurantId
	 */
	public function getRestaurantId() : int {
		return($this->restaurantId);
	}

	/**
	 * Mutator method for restaurantId
	 *
	 * @param int | null $newRestaurantId new value of restaurantId
	 * @return void if $newRestaurantId is already null
	 * @throws \TypeError if $newRestaurantId is not an integer
	 * @thorws \RangeException if $newRestaurantId is not a positive number
	 */
	public function setRestaurantId (?int $newRestaurantId) : void {
		// the primary key must be null when we initially try to add it to the database or
		// we'll encounter an infinite loop.  If it is null already, we return it
		if ($newRestaurantId === null) {
			$this->restaurantId = null;
			return;
		}
		// the restaurantId must be a positive number; check that here
		if ($newRestaurantId < 1) {
			throw(new \RangeException("The entered restaurant ID is not a positive number."));
		}
		// now we can set the corresponding state variable to the entered value
		$this->restaurantId = $newRestaurantId;
	}

	/**
	 * Accessor method for restaurantAddress1
	 *
	 * @return string value of restaurantAddress1
	 */
	public function getRestaurantAddress1() : string {
		return($this->restaurantAddress1);
	}

	/**
	 * Mutator method for restaurantAddress1
	 *
	 * @param string $newRestaurantAddress1 new value of restaurantAddress1
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 128 characters
	 */
	public function setRestaurantAddress1(string $newRestaurantAddress1) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantAddress1 = trim($newRestaurantAddress1);
		$newRestaurantAddress1 = filter_var($newRestaurantAddress1, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// check if the resultant variable is still valid, then set
		
//		if(empty($newRestaurantAddress1)  === true) {
//			throw(new \InvalidArgumentException("There are no valid characters in the entered address line 1."));
//
//		}
		if(strlen($newRestaurantAddress1) > 128) {
			throw(new \RangeException("The entered address line 1 is too long."));
		}
		$this->restaurantAddress1 = $newRestaurantAddress1;
	}

	/**
	 * Accessor method for restaurantAddress2
	 *
	 * @return string value of restaurantAddress2
	 */
	public function getRestaurantAddress2() : string {
		return($this->restaurantAddress2);
	}

	/**
	 * Mutator method for restaurantAddress2
	 *
	 * @param string | null $newRestaurantAddress2 new value of restaurantAddress2
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 128 characters
	 */
	public function setRestaurantAddress2(?string $newRestaurantAddress2) {
		// since this is optional, check if anything was entered, return if null
		if ($newRestaurantAddress2 === null) {
			$this->restaurantAddress2 = null;
			return;
		}
		// prep the variable for sanitization, then sanitize it
		$newRestaurantAddress2 = trim($newRestaurantAddress2);
		$newRestaurantAddress2 = filter_var($newRestaurantAddress2, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantAddress2) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered address line 2."));
		}
		if(strlen($newRestaurantAddress2) > 128) {
			throw(new \RangeException("The entered address line 2 is too long."));
		}
		$this->restaurantAddress2 = $newRestaurantAddress2;
	}

	/**
	 * Accessor method for restaurantCity
	 *
	 * @return string value of restaurantCity
	 */
	public function getRestaurantCity() : string {
		return($this->restaurantCity);
	}
	/**
	 * Mutator method for restaurantCity
	 *
	 * @param string $newRestaurantCity new value of restaurantCity
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 64 characters
	 */
	public function setRestaurantCity(string $newRestaurantCity) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantCity = trim($newRestaurantCity);
		$newRestaurantCity = filter_var($newRestaurantCity, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantCity) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered city name."));
		}
		if(strlen($newRestaurantCity) > 64) {
			throw(new \RangeException("The entered city name is too long."));
		}
		$this->restaurantCity = $newRestaurantCity;
	}

	/**
	 * Accessor method for restaurantFacilityKey
	 *
	 * @return string value of restaurantFacilityKey
	 */
	public function getRestaurantFacilityKey() : string {
		return($this->restaurantFacilityKey);
	}
	/**
	 * Mutator method for restaurantFacilityKey
	 *
	 * @param string $newRestaurantFacilityKey new value of restaurantFacilityKey
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is not exactly 7 characters long
	 */
	public function setRestaurantFacilityKey(string $newRestaurantFacilityKey) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantFacilityKey = trim($newRestaurantFacilityKey);
		$newRestaurantFacilityKey = filter_var($newRestaurantFacilityKey, FILTER_SANITIZE_NUMBER_INT);

		// TODO: Alex - ask about standardizing string length

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantFacilityKey) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered facility key."));
		}
		if(strlen($newRestaurantFacilityKey) > 7) {
			throw(new \RangeException("The entered facility key is not the correct length."));
		}
		$this->restaurantFacilityKey = $newRestaurantFacilityKey;
	}

	/**
	 * Accessor method for restaurantGoogleId
	 *
	 * @return string value of restaurantGoogleId
	 */
	public function getRestaurantGoogleId() : string {
		return($this->restaurantGoogleId);
	}
	/**
	 * Mutator method for restaurantGoogleId
	 *
	 * @param string | null $newRestaurantGoogleId new value of restaurantGoogleId
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 128 characters
	 */
	public function setRestaurantGoogleId(?string $newRestaurantGoogleId) {
		// since this is optional, check if anything was entered, return if null
		if ($newRestaurantGoogleId === null) {
			$this->restaurantGoogleId = null;
			return;
		}
		// prep the variable for sanitization, then sanitize it
		$newRestaurantGoogleId = trim($newRestaurantGoogleId);
		$newRestaurantGoogleId = filter_var($newRestaurantGoogleId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantGoogleId) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered Google ID."));
		}
		if(strlen($newRestaurantGoogleId) > 128) {
			throw(new \RangeException("The entered Google ID is too long."));
		}
		$this->restaurantGoogleId = $newRestaurantGoogleId;
	}

	/**
	 * Accessor method for restaurantName
	 *
	 * @return string value of restaurantName
	 */
	public function getRestaurantName() : string {
		return($this->restaurantName);
	}
	/**
	 * Mutator method for restaurantName
	 *
	 * @param string $newRestaurantName new value of restaurantName
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 64 characters
	 */
	public function setRestaurantName(string $newRestaurantName) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantName = trim($newRestaurantName);
		$newRestaurantName = filter_var($newRestaurantName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantName) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered restaurant name."));
		}
		if(strlen($newRestaurantName) > 64) {
			throw(new \RangeException("The entered restaurant name is too long."));
		}
		$this->restaurantName = $newRestaurantName;
	}

	/**
	 * Accessor method for restaurantPhoneNumber
	 *
	 * @return string value of restaurantPhoneNumber
	 */
	public function getRestaurantPhoneNumber() : string {
		return($this->restaurantPhoneNumber);
	}
	/**
	 * Mutator method for restaurantPhoneNumber
	 *
	 * @param string | null $newRestaurantPhoneNumber new value of restaurantPhoneNumber
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 32 characters
	 */
	public function setRestaurantPhoneNumber(?string $newRestaurantPhoneNumber) {
		// since this is optional, check if anything was entered, return if null
		if (empty($newRestaurantPhoneNumber) === true) {
			$this->restaurantPhoneNumber = null;
			return;
		}

		// prep the variable for sanitization, then sanitize it
		$newRestaurantPhoneNumber = trim($newRestaurantPhoneNumber);
		$newRestaurantPhoneNumber = filter_var($newRestaurantPhoneNumber, FILTER_SANITIZE_NUMBER_INT);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantPhoneNumber) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered phone number."));
		}
		if(strlen($newRestaurantPhoneNumber) > 32) {
			throw(new \RangeException("The entered phone number is too long."));
		}
		$this->restaurantPhoneNumber = $newRestaurantPhoneNumber;
	}

	/**
	 * Accessor method for restaurantState
	 *
	 * @return string value of restaurantState
	 */
	public function getRestaurantState() : string {
		return($this->restaurantState);
	}
	/**
	 * Mutator method for restaurantState
	 *
	 * @param string $newRestaurantState new value of restaurantState
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is not exactly 2 characters long
	 */
	public function setRestaurantState(string $newRestaurantState) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantState = trim($newRestaurantState);
		$newRestaurantState = filter_var($newRestaurantState, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantState) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered state abbreviation."));
		}
		if(strlen($newRestaurantState) !== 2) {
			throw(new \RangeException("The entered state abbreviation is not the correct length."));
		}
		$this->restaurantState = $newRestaurantState;
	}

	/**
	 * Accessor method for restaurantType
	 *
	 * @return string value of restaurantType
	 */
	public function getRestaurantType() : string {
		return($this->restaurantType);
	}
	/**
	 * Mutator method for restaurantType
	 *
	 * @param string $newRestaurantType new value of restaurantType
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 64 characters
	 */
	public function setRestaurantType(string $newRestaurantType) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantType = trim($newRestaurantType);
		$newRestaurantType = filter_var($newRestaurantType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantType) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered restaurant type."));
		}
		if(strlen($newRestaurantType) > 64) {
			throw(new \RangeException("The entered restaurant type is too long."));
		}
		$this->restaurantType = $newRestaurantType;
	}

	/**
	 * Accessor method for restaurantZip
	 *
	 * @return string value of restaurantZip
	 */
	public function getRestaurantZip() : string {
		return($this->restaurantZip);
	}
	/**
	 * Mutator method for restaurantZip
	 *
	 * @param string $newRestaurantZip new value of restaurantZip
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is shorter than 5 or longer than 10 characters
	 */
	public function setRestaurantZip(string $newRestaurantZip) {
		// prep the variable for sanitization, then sanitize it
		$newRestaurantZip = trim($newRestaurantZip);
		$newRestaurantZip = filter_var($newRestaurantZip, FILTER_SANITIZE_NUMBER_INT);

		// check if the resultant variable is still valid, then set
		if(empty($newRestaurantZip) === true) {
			throw(new \InvalidArgumentException("There are no valid characters in the entered ZIP code."));
		}
		if(strlen($newRestaurantZip) < 5 || strlen($newRestaurantZip) > 10) {
			throw(new \RangeException("The entered ZIP code is too either too short or long."));
		}
		$this->restaurantZip = $newRestaurantZip;
	}

	/**
	 * Method to insert this restaurant into the database
	 *
	 * @param \PDO $pdoInsert the PDO connection object
	 * @throws \PDOException due to mySQL related issues
	 * @throws \TypeError if $pdoInsert is not a PDO connection object
	 */
	public function insert(\PDO $pdoInsert) : void {
		// first check if the restaurantId is not null -- that is, it already exists
		if ($this->restaurantId !== null) {
			throw (new \PDOException("The restaurant ID is not new."));
		}
		// next we prep the command to be passed to the database
		$queryInsert = "INSERT INTO restaurant(restaurantId, restaurantAddress1, restaurantAddress2, restaurantCity, restaurantFacilityKey, restaurantGoogleId, restaurantName, restaurantPhoneNumber, restaurantState, restaurantType, restaurantZip) VALUES (:restaurantId, :restaurantAddress1, :restaurantAddress2, :restaurantCity, :restaurantFacilityKey, :restaurantGoogleId, :restaurantName, :restaurantPhoneNumber, :restaurantState, :restaurantType, :restaurantZip)";
		$preppedInsert = $pdoInsert->prepare($queryInsert);

		// we have to sub out the placeholder values before submitting
		$parameters = ["restaurantId" => $this->restaurantId, "restaurantAddress1" => $this->restaurantAddress1, "restaurantAddress2" =>
			$this->restaurantAddress2, "restaurantCity" => $this->restaurantCity, "restaurantFacilityKey" => $this->restaurantFacilityKey, "restaurantGoogleId" => $this->restaurantGoogleId, "restaurantName" => $this->restaurantName, "restaurantPhoneNumber" => $this->restaurantPhoneNumber, "restaurantState" => $this->restaurantState, "restaurantType" => $this->restaurantType, "restaurantZip" => $this->restaurantZip];
		$preppedInsert->execute($parameters);

		// finally, the restaurantId should've been null up to this point, wo we sub it out with what mySQL gives us
		$this->restaurantId = intval($pdoInsert->lastInsertId());
	}

	/**
	 * Method for getting a restaurant entity by its restaurantId (primary key)
	 *
	 * @param \PDO $pdo the PDO connection object
	 * @param int $restaurantId the restaurantId that we are searching by
	 * @return Restaurant | null Restaurant entity if found, null if not
	 * @throws \PDOException for mySQL related errors
	 * @throws \TypeError if the entered variables are not of the correct data type
	 * @throws \Exception for other kinds of errors not otherwise caught
	 */
	public static function getRestaurantByRestaurantId(\PDO $pdo, int $restaurantId) : ?Restaurant {
		// first check that the entered restaurantId is a positive number
		if ($restaurantId < 1 ) {
			throw (new \PDOException("The entered restaurant ID is not a positive integer."));
		}

		// we create a template for our SELECT statement
		$query = "SELECT restaurantId, restaurantAddress1, restaurantAddress2, restaurantCity, restaurantFacilityKey, restaurantGoogleId, restaurantName, restaurantPhoneNumber, restaurantState, restaurantType, restaurantZip FROM restaurant WHERE restaurantId = :restaurantId";
		$statement = $pdo->prepare($query);

		// sub out the placeholder value for restaurantId we previously set
		$parameters = ["restaurantId" => $restaurantId];
		$statement->execute($parameters);

		// Build and array to store the fetched data in
		try {
			$restaurantArray = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$restaurantArray = new Restaurant($row["restaurantId"], $row["restaurantAddress1"], $row["restaurantAddress2"], $row["restaurantCity"], $row["restaurantFacilityKey"], $row["restaurantGoogleId"], $row["restaurantName"], $row["restaurantPhoneNumber"], $row["restaurantState"], $row["restaurantType"], $row["restaurantZip"]);
			}
		} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		return($restaurantArray);
	}

	/**
	 * A method for retreiving a restaurant entity by its restaurantFacilityKey
	 *
	 * @param \PDO $pdo the PDO connection object
	 * @param string $facilityKey the restaurant facility key that we are searching by
	 * @return Restaurant | null Restaurant entity if found, null if not
	 * @throws \PDOException for mySQL related errors
	 * @throws \TypeError if the entered variables are not of the correct data type
	 * @throws \Exception for other kinds of errors not otherwise caught
	 */
	public static function getRestaurantByFacilityKey(\PDO $pdo, string $facilityKey) : ?Restaurant {
		// first we sanitize the entered facility key
		$facilityKey = trim($facilityKey);
		$facilityKey = filter_var($facilityKey, FILTER_SANITIZE_NUMBER_INT);
		if(empty($facilityKey) === true) {
			throw (new \PDOException("There are no valid characters in the entered facility key."));
		}
		// we create a template for our SELECT statement
		$query = "SELECT restaurantId, restaurantAddress1, restaurantAddress2, restaurantCity, restaurantFacilityKey, restaurantGoogleId, restaurantName, restaurantPhoneNumber, restaurantState, restaurantType, restaurantZip FROM restaurant WHERE restaurantFacilityKey = :restaurantFacilityKey";
		$statement = $pdo->prepare($query);

		// we have to sub out the placeholder facility key before submitting it
		$parameters = ["restaurantFacilityKey" => $facilityKey];
		$statement->execute($parameters);

		// Build and array to store the fetched data in
		try {
			$restaurantArray = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$restaurantArray = new Restaurant($row["restaurantId"], $row["restaurantAddress1"], $row["restaurantAddress2"], $row["restaurantCity"], $row["restaurantFacilityKey"], $row["restaurantGoogleId"], $row["restaurantName"], $row["restaurantPhoneNumber"], $row["restaurantState"], $row["restaurantType"], $row["restaurantZip"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($restaurantArray);
	}

	/**
	 * Method for getting a restaurant entity by its Google ID
	 *
	 * @param \PDO $pdo the PDO connection object
	 * @param string $googleId the googleId that we are searching by
	 * @return Restaurant | null Restaurant entity if found, null if not
	 * @throws \PDOException for mySQL related errors
	 * @throws \TypeError if the entered variables are not of the correct data type
	 * @throws \Exception for other kinds of errors not otherwise caught
	 */
	public static function getRestaurantByGoogleId(\PDO $pdo, string $googleId) : ?Restaurant {
		// first check that the entered restaurantId is a positive number
		$googleId = trim($googleId);
		$googleId = filter_var($googleId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($googleId) === true) {
			throw (new \PDOException("There are no valid characters in the entered Google ID."));
		}

		// we create a template for our SELECT statement
		$query = "SELECT restaurantId, restaurantAddress1, restaurantAddress2, restaurantCity, restaurantFacilityKey, restaurantGoogleId, restaurantName, restaurantPhoneNumber, restaurantState, restaurantType, restaurantZip FROM restaurant WHERE restaurantGoogleId = :restaurantGoogleId";
		$statement = $pdo->prepare($query);

		// sub out the placeholder value for restaurantGoogleId we previously set
		$parameters = ["restaurantGoogleId" => $googleId];
		$statement->execute($parameters);

		// Build and array to store the fetched data in
		try {
			$restaurantArray = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$restaurantArray = new Restaurant($row["restaurantId"], $row["restaurantAddress1"], $row["restaurantAddress2"], $row["restaurantCity"], $row["restaurantFacilityKey"], $row["restaurantGoogleId"], $row["restaurantName"], $row["restaurantPhoneNumber"], $row["restaurantState"], $row["restaurantType"], $row["restaurantZip"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($restaurantArray);
	}

	/**
	 * Method for getting a restaurant entity by its name
	 *
	 * @param \PDO $pdo the PDO connection object
	 * @param string $restaurantName the restaurant name that we are searching for
	 * @return \SplFixedArray SplFixedArray of restaurant entities matching the entered text
	 * @throws \PDOException for mySQL related errors
	 * @throws \TypeError if the entered variables are not of the correct data type
	 * @throws \Exception for other kinds of errors not otherwise caught
	 */
	public static function getRestaurantByName(\PDO $pdo, string $restaurantName) : \SplFixedArray {
		// first check that the entered restaurantId is a positive number
		$restaurantName = trim($restaurantName);
		$restaurantName = filter_var($restaurantName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($restaurantName) === true) {
			throw (new \PDOException("There are no valid characters in the entered restaurant name."));
		}

		// escape any mySQL wild card characters
		$restaurantName = str_replace("_", "\\_", str_replace("%", "\\%", $restaurantName));

		// we create a template for our SELECT statement
		$query = "SELECT restaurantId, restaurantAddress1, restaurantAddress2, restaurantCity, restaurantFacilityKey, restaurantGoogleId, restaurantName, restaurantPhoneNumber, restaurantState, restaurantType, restaurantZip FROM restaurant WHERE restaurantName LIKE :restaurantName";
		$statement = $pdo->prepare($query);

		// make the search have wild cards before and after the search name
		$restaurantName = "%$restaurantName%";

		// sub out the placeholder value for restaurantName we previously set
		$parameters = ["restaurantName" => $restaurantName];
		$statement->execute($parameters);

		// Build and array to store the fetched data in
		$restaurantArray = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		// !== false not strictly necessary, just being verbose
		while(($row = $statement->fetch()) !== false) {
			try {
				$restaurantKeys = new Restaurant($row["restaurantId"], $row["restaurantAddress1"], $row["restaurantAddress2"], $row["restaurantCity"], $row["restaurantFacilityKey"], $row["restaurantGoogleId"], $row["restaurantName"], $row["restaurantPhoneNumber"], $row["restaurantState"], $row["restaurantType"], $row["restaurantZip"]);
				$restaurantArray[$restaurantArray->key()] = $restaurantKeys;
				$restaurantArray->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($restaurantArray);
	}

	/**
	 * Method for getting every restaurant in the database
	 *
	 * @param \PDO $pdo the PDO connection object
	 * @return \SplFixedArray SplFixedArray of every restaurant in the database
	 * @throws \PDOException for mySQL related errors
	 * @throws \TypeError if the variables are not of the correct data type
	 */
	public static function getAllRestaurants(\PDO $pdo) : \SplFixedArray{
		// we prepare our SELECT statement, then execute it
		$query = "SELECT restaurantId, restaurantAddress1, restaurantAddress2, restaurantCity, restaurantFacilityKey, restaurantGoogleId, restaurantName, restaurantPhoneNumber, restaurantState, restaurantType, restaurantZip FROM restaurant";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// Build and array to store the fetched data in
		$restaurantArray = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		// !== false not strictly necessary, just being verbose
		while(($row = $statement->fetch()) !== false) {
			try {
				$restaurantKeys = new Restaurant($row["restaurantId"], $row["restaurantAddress1"], $row["restaurantAddress2"], $row["restaurantCity"], $row["restaurantFacilityKey"], $row["restaurantGoogleId"], $row["restaurantName"], $row["restaurantPhoneNumber"], $row["restaurantState"], $row["restaurantType"], $row["restaurantZip"]);
				$restaurantArray[$restaurantArray->key()] = $restaurantKeys;
				$restaurantArray->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($restaurantArray);
	}

	/**
	 * Formats the state variables for JSON serialization
	 *
	 * @return array containing state variables to serialize
	 */
	public function jsonSerialize() {
		$jsonObject = get_object_vars($this);
		return($jsonObject);
	}
}
 