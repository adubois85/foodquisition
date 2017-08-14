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

}
