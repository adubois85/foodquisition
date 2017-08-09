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
	private $restuaruantId;


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
	 * Constructro function fro this facility
	 *
	 * @param int | null restaurantId ID number for this facility, NULL if new
	 * @param string $restaurantAddress1 primary address line for this facility
	 * @param string | null $restaurantAddress2 optional secondary address line for this facility
	 * @param string $restaurantCity name of the city where this facility is located
	 * @param string $restaurantFaciltyKey unique 7-digit number given to the facility by the city
	 * @param string | null $restaurantGoogleId ID given by google to this facility for pulling data from Google APIs
	 * @param string $restaurantName name of this facility
	 * @param string | null $restaurantPhoneNumber phone number for this facility
	 * @param string $restaurantState 2-digit abbreviation of state where this facility is located
	 * @param string $restaurantType designation given to this facility by the city regarding kind of business (e.g. school)
	 * @param string $restaurantZip 5-digit (or 5 + 4-digit) ZIP code for this facility
	 * @throws [TODO: Alex - enumerate the types of exceptions the constructor can throw]
	 */
	public function __construct(?int $newRestaurantId, string $newRestaurantAddress1, ?string $newRestaurantAddress2, string $newRestaurantCity, string $newRestaurantFacilityKey, ?string $newRestaurantsGoogleId, string $newRestaurantName, ?string $newRestaurantPhoneNumber, string $newRestaurantState, string $newRestaurantType, string $newRestaurantZip) {

		// TODO: Alex - add exception checking to this function

		/**
		 * Accessor method for restaurantId
		 *
		 * @return int | null value of restaurantId
		 */
		public function getRestaurantId() : int {
			return($this->restuaruantId);
		}

		/**
		 * Mutator method for restaurantId
		 *
		 * @param int | null $newRestaurantId new value of restaurantId
		 * @throws \TypeError if $newRestaurantId is not an integer
		 * @thorws \RangeException if $newRestaurantId is not a positive number
		 */
		public function getRestaurantId (?int $newRestaurantId) : string {
			// the primary key must be null when we initially try to add it to the database or
			// we'll encounter an infinite loop.  If it is null already, we return it
			if ($newRestaurantId === null) {
				$this->restuaruantId = null;
				return;
			}
			// the restaurantId must be a positive number; check that here
			if ($newRestaurantId < 1) {
				throw(new \RangeException("The entered restaurant ID is not a positive number."));
			}
			// now we can set the corresponding state variable to the entered value
			$this->restuaruantId = $newRestaurantId;
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
			if(empty($newRestaurantAddress1) === true) {
				throw(new \InvalidArgumentException("There are no valid characters in the entered address line 1."));
			}
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
			if(strlen($newRestaurantCity) !== 7) {
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
		public function setRestaurantPhoneNumber(string $newRestaurantPhoneNumber) {
			// since this is optional, check if anything was entered, return if null
			if ($newRestaurantPhoneNumber === null) {
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
	}
}