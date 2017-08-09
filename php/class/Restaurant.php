<?php
namespace Edu\Cnm\Foodquisition;

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
	 *	Cannot be NULL
	 * @var string $restaurantType
	 */
	private $restaurantType;

	/**
	 * the 5-digit (or 5 + 4-digit) ZIP code for this facility.
	 * Cannot be NULL
	 * @var string $restaurantZip
	 */
	private $restaurantZip;

}