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
	 * @varchar string $restaurantViolationResults
	 */
	private $restaurantViolationResults;

	/**
	 * constructor for this restaurantViolation
	 *
	 * @param int|null $newRestaurantViolationId of this restaurantViolation or null if a new restaurantViolation
	 * @param int $newRestaurantViolationRestaurantId of the restaurantId that caused the restaurant violation
	 * @param int $newRestaurantViolationViolation of the restaurant violation violation
	 * @param \DateTime|string|null $newRestaurantViolationDate date and time restaurant violation was sent or null if set to current date and time
	 * @param string $newRestaurantViolationMemo string containing inspector notes
	 * @param string $newRestaurantViolationResults sting containing results of inspection
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct(?int $newRestaurantViolationId, int $newRestaurantViolationRestaurantId, int $newRestaurantViolationViolationId, $newRestaurantViolationDate = null, string $newRestaurantViolationMemo, string $newRestaurantViolationResults) {
		try {
			$this->setRestaurantViolationId($newRestaurantViolationId);
			$this->setRestaurantViolationRestaurantId($newRestaurantViolationRestaurantId);
			$this->setRestaurantViolationViolationId($newRestaurantViolationViolationId);
			$this->setRestaurantViolationDate($newRestaurantViolationDate);
			$this->setRestaurantViolationMemo($newRestaurantViolationMemo);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *
	 * accessor method for restaurant violation Id
	 * @return int|null value of restaurant violation Id
	 */
	public function getRestaurantViolationId(): int {
		return ($this->restaurantViolationId);
	}

	/**
	 *
	 * mutator method for restaurant violation id
	 * @param int /null $newRestaurantViolationId new value of restaurant violation id
	 * @throws \RangeException if $newRestaurantViolationId is not positive
	 * @throws \TypeError if $newRestaurantViolationId is not an integ
	 **/
	public function setRestaurantViolationId(?int $newRestaurantViolationId): void {
		//if restaurant Violation id is null immediately return it
		if($newRestaurantViolationId === null) {
			$this->restaurantViolationId = null;
			return;
		}
		//verify the restaurant violation id is positive
		if($newRestaurantViolationId <= 0) {
			throw(new \RangeException("restaurant violation id is not positive"));
		}
		// convert and store the restaurant violation id
		$this->restaurantViolationId = $newRestaurantViolationId;
	}
	/**
	 * accessor method for restaurant violation restaurant id
	 *
	 * @return int value of restaurant violation restaurant id
	 **/
	public function getRestaurantViolationRestaurantId() : int{
		return($this->restaurantViolationRestaurantId);
	}
	/**
	 * mutator method for restaurant violation restaurant id
	 * @param int $newRestaurantViolationRestaurantId new value of restaurant violation restaurant id
	 * @throws \RangeException if $newRestaurantViolationRestaurantId is not positive
	 * @throws \TypeError if $newRestaurantViolationRestaurantId is not an integer
	 **/
	public function setRestaurantViolationRestaurantId(int $newRestaurantViolationRestaurantId) : void {
		//verify the restaurant violation restaurant id is positive
		if($newRestaurantViolationRestaurantId <= 0) {
			throw(new \RangeException("restaurant violation restaurant id is not positive"));
		}
		//convert and store the restaurant violation restaurant id
		$this->restaurantViolationRestaurantId = $newRestaurantViolationRestaurantId;
	}

}

