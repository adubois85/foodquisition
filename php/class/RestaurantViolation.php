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
	private	$restaurantViolationResaults;


}

