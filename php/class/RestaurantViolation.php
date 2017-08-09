<?php
namespace Edu\CNM\foodquisition;

require_once("autoloader.php");
/*item class*/

/**
 * Create RestaurantViolation class
 *
 * This creates a class
 *
 * @author Dannielle Bojorquz <dbojorquez@cnm.edu>
 * @version 1.0.0
 **/
class RestaurantViolation implements \JsonSerializable{
	use ValidateDate;
	/**
	 * id for this RestaurantViolation; this is the primary key
	 * @var int $restaurantViolation
	 **/
	private $restaurantViolationId;
	/**
	 * id of the restaurant that has the violation; this is a foreign key
	 * @var int $restaurantViolationRestaurantId
	 **/
	private $restaurantViolationRestaurantId;
	/**
	 * id of the violation in the Restaurant; this is a foreign key
	 * @var $restaurantViolationViolationId
	 **/
	private $restaurantViolationViolationId;
	/**
	 * date the violation was on
	 * @var \Date $restaurantViolationDate
	 **/
	private $restaurantViolationDate;
	/**
	 * memo content of the violation
	 * @var string $restaurantViolationMemo
	 **/
	private $restaurantViolationMemo;
	/**
	 *results of the violation
	 * @var string $restaurantViolationResults
	 **/
	private	$restaurantViolationResults;

/**
 * constructor for this RestaurantId
 *
 * @param int|null $newRestaurantViolationId id of the restaurant with the violation or null if a new
 * @param int $newRestaurantViolationRestaurantId id of the restaurant with violations
 * @param int $newRestaurantViolationViolationId id of the violation
 * @param string $newRestaurantViolationMemo string containing notes from inspector
 * @param \Date|string|null $newRestaurantViolationDate date violation was recorded
 * @param string $newRestaurantViolationResults string containing results from inspection
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @throws \Exception if some other exception occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/
/**
 * public function _construct(?int $newRestaurantViolationId,int $newRestaurantViolationRestaurantId, int $newrestaurantViolationViolationId, string $newRestaurantViolationMemo, $newRestaurantViolationDate = null, string $newrestaurantViolationResults, )
 */
}

