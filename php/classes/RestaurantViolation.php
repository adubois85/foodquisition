<?php

namespace Edu\Cnm\Foodquisition;

require_once("autoload.php");

/**
 * Restaurant Violation cross section
 *
 * @author Dinn Bojorquez
 * @version 1.0
 */
class RestaurantViolation implements \JsonSerializable {
	use ValidateDate;
	/**
	 *id for restaurant violation
	 * @var int $restaurantViolationId
	 *
	 **/
	private $restaurantViolationId;
	/**
	 * id of the restaurant violation restaurant
	 * @var int $restaurantViolationRestaurantId
	 **/
	private $restaurantViolationRestaurantId;
	/**
	 * id of the restaurant violation violation
	 * @var int $restaurantViolationViolationId
	 **/
	private $restaurantViolationViolationId;
	/**
	 * date of restaurant violation
	 * @var \DateTime $restaurantViolationDate
	 **/
	private $restaurantViolationDate;
	/**
	 * memo for restaurant violation
	 * @varchar string $restaurantViolationMemo
	 *
	 **/
	private $restaurantViolationMemo;
	/**
	 *
	 * Results for restaurant violation
	 * @varchar string $restaurant
	 */
	private $restaurantViolationResults;

	/**
	 * constructor for this restaurantViolation
	 *
	 * @param int|null $newRestaurantViolationId of this restaurantViolation or null if a new restaurantViolation
	 * @param int $newRestaurantViolationRestaurantId of the restaurantId that caused the restaurant violation
	 * @param int $restaurantViolationViolation of the restaurant violation violation
	 * @param \DateTime|string|null $newRestaurantViolationDate date and time restaurant violation was sent or null if set to current date and time
	 * @param string $restaurantViolationMemo string containing inspector notes
	 * @param string $restaurantViolationResults sting containing results of inspection
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/

}
