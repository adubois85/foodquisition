<?php
namespace Edu\Cnm\Foodquisition;

require_once("autoload.php");

/**
 * Violation
 *
 * @author Danielle Branch <dbranch82@gmail.com>
 * @version 1.0
 **/
class Violation implements \JsonSerializable {

	 private $violationId;
	/**
	 * id for this Violation; this is the primary key
	 * will be auto-incrementing
	 * @var int $violationCategoryId
	 *
	 **/
	private $violationCategoryId;
	/**
	 *
	 * @var string $violationCode
	 *
 	*/
	private $violationCode;
	/**
	 *
	 * @var string $violationCodeDescription
	 */
	private $violationCodeDescription;
	/**
	 * Constructor for Violation
	 * @param int|null $newViolationId id of this Violation or null if a new Violation
	 * @param int $newViolationCategoryId id of the Category for this Violation
	 * @param string $newViolationCode string that references actual Violation
	 * @param string $newViolationCodeDescription string that actually describes code violation
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 *
	 */
	public function __construct(?int $newViolationId, int $newViolationCategoryId, string $newViolationCode, string $newViolationCodeDescription) {
		try {
			$this->setViolationId($newViolationId);
			$this->setViolationCategoryId($newViolationCategoryId);
			$this->setViolationCode($newViolationCode);
			$this->setViolationCodeDescription($newViolationCodeDescription);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for violation id
	 *
	 * @return int|null value of violation id
	 **/
	public function getViolationId() : int {
		return($this->violationId);
	}
	/**
	 * mutator method for violation id
	 *
	 * @param int|null $ViolationId new value of violation id
	 * @throws \RangeException if $newViolationId is not positive
	 * @throws \TypeError if $newViolationId is not an integer
	 **/
	public function setViolationId(?int $newViolationId) : void {
		//if violation id is null immediately return it
		if($newViolationId === null) {
			$this->violationId = null;
			return;
		}
		// verify the violation id is positive
		if($newViolationId <= 0) {
			throw(new \RangeException("violation id is not positive"));
		}
}
}

