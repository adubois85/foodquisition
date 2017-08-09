<?php
namespace Edu\Cnm\Foodquisition;

require_once("autoload.php");

/**
 * Violation
 *
 * @author Danielle Branch <dbranch82@gmail.com>
 * @version 1.0
 **/
class Violation implements \JsonSerialize {

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
		// convert and store the violation id
		$this->violationId = $newViolationId;
	}
	/**
	 * accessor method for violation category id
	 *
	 * @return int value of violation category id
	 **/
	public function getViolationCategoryId() : int{
		return($this->violationCategoryId);
	}
	/**
	 * mutator method for violation category id
	 *
	 * @param int $newViolationCategoryId new value of violation category id
	 * @throws \RangeException if $newViolationCategoryId is not positive
	 * @throws \TypeError if $newViolationCategoryId is not an integer
	 **/
	/**
	 * @return string
	 */
	public function getViolationCode(): string {
		return $this->violationCode;
	}
	/**
	 * mutator method for violation code
	 * @param string $newViolationCode new violation code
	 * @throws \InvalidArgumentException if $newViolationCode in not a string or insecure
	 * @throws \RangeException if $newViolationCode is > 8 characters
	 * @throws \TypeError if $newViolationCode is not a string
	 **/
	public function setViolationCode(string $newViolationCode) {
		//verify the Violation code is secure
		$newViolationCode = trim($newViolationCode);
		$newViolationCode = filter_var($newViolationCode, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newViolationCode) === true) {
			throw(new \InvalidArgumentException("violation code is empty or insecure"));
		}
		// verify the violation code will fit in database
		if(strlen($newViolationCode) > 8) {
			throw(new \RangeException("violation code too large"));
		}
		//store the violation code content
		$this->violationCode = $newViolationCode;

	}
	/**
	 * accessor method for violation code description
	 *
	 * @param return string value of violation code description
	 *
	 **/
	public function getViolationCodeDescription() :string {
		return($this->violationCodeDescription);
	}
	/**
	 * mutator method for violation code description
	 *
	 * @param string $newViolationCodeDescription new violation code description
	 * @throws \InvalidArgumentException if $newViolationCodeDescription is not a string or insecure
	 * @throws \RangeException if $newViolationCodeDescription is > 255 characters
	 * @throws \TypeError if $newViolationCodeDescription is not a string
	 **/
	public function setViolationCodeDescription(string $newViolationCodeDescription) :void {
		// verify the violation code description is secure
		$newViolationCodeDescription = trim($newViolationCodeDescription);
		$newViolationCodeDescription = filter_var($newViolationCodeDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newViolationCodeDescription) === true ) {
			throw(new \InvalidArgumentException("violation code description too long"));
		}
		//verify the violation code description will fit into the database
		if(strlen($newViolationCodeDescription) > 255 ) {
			throw(new \RangeException("violation code description is too large"));
		}
		//store the violation code description
		$this->violationCodeDescription = $newViolationCodeDescription;
	}
	/**
	 * Inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) :void {
		// enforce the violationId is null
		if($this->violationId !== null) {

		}
	}
}

