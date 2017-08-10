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
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct(?int $newViolationId, int $newViolationCategoryId, string $newViolationCode, string $newViolationCodeDescription) {
		try {
			$this->setViolationId($newViolationId);
			$this->setViolationCategoryId($newViolationCategoryId);
			$this->setViolationCode($newViolationCode);
			$this->setViolationCodeDescription($newViolationCodeDescription);
		} //determine what exception type was thrown
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
	public function getViolationId(): int {
		return ($this->violationId);
	}

	/**
	 * mutator method for violation id
	 *
	 * @param int|null $ViolationId new value of violation id
	 * @throws \RangeException if $newViolationId is not positive
	 * @throws \TypeError if $newViolationId is not an integer
	 **/
	public function setViolationId(?int $newViolationId): void {
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
	public function getViolationCategoryId(): int {
		return ($this->violationCategoryId);
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
	public function getViolationCodeDescription(): string {
		return ($this->violationCodeDescription);
	}

	/**
	 * mutator method for violation code description
	 *
	 * @param string $newViolationCodeDescription new violation code description
	 * @throws \InvalidArgumentException if $newViolationCodeDescription is not a string or insecure
	 * @throws \RangeException if $newViolationCodeDescription is > 255 characters
	 * @throws \TypeError if $newViolationCodeDescription is not a string
	 **/
	public function setViolationCodeDescription(string $newViolationCodeDescription): void {
		// verify the violation code description is secure
		$newViolationCodeDescription = trim($newViolationCodeDescription);
		$newViolationCodeDescription = filter_var($newViolationCodeDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newViolationCodeDescription) === true) {
			throw(new \InvalidArgumentException("violation code description too long"));
		}
		//verify the violation code description will fit into the database
		if(strlen($newViolationCodeDescription) > 255) {
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
	public function insert(\PDO $pdo): void {
		// enforce the violationId is null
		if($this->violationId !== null) {
			throw(new \PDOException("not a new tweet"));
		}
		// create query template
		$query = "INSERT INTO violation(violationId, violationCategoryId, violationCode, violationCodeDescription) VALUES(:violationId, :violationCategoryId, :violationCode, :violationCodeDescription)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["violationCategoryId" => $this->violationCategoryId, "violationCode" => $this->violationCode, "violationCodeDescription" => $this->violationCodeDescription];
		$statement->execute($parameters);

		// update the null violationId with what mySQL just gave us
		$this->violationId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this Violation from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 **/
	public function delete(\PDO $pdo): void {
		//enforce the violationId is not null
		if($this->violationId === null) {
			throw(new \PDOException("unable to delete a violation that does not exist"));
		}
		// create query template
		$query = "DELETE FROM violation WHERE violationId = :violationId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["violationId" => $this->violationId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Violation in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
// enforce the violationId is not null
		if($this->violationId === null) {
			throw(new \PDOException("unable to update violation that does not exist"));
		}
		// create query template
		$query = "UPDATE violation SET violationCategoryId = :violationCategoryId, violationCode = :violationCode, violationCodeDescription = :violationCodeDescription";
		$statement = $pdo->prepare($query);

		//bind the member variable to the place holders in the template
		$parameters = ["violationCategoryId" => $this->violationCategoryId, "violationCode" => $this->violationCode, "violationCodeDescription" => $this->violationCodeDescription];
		$statement->execute($parameters);
	}

	/**
	 * gets the Violation by violationId
	 *
	 * @param \PDO $pdo connection object
	 * @param int $violationId violation id to search for
	 * @return Violation|null Violation found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 *
	 **/
	public static function getViolationByViolationId(\PDO $pdo, int $violationId): ?Violation {
		// sanitize the violationId before searching
		if(violationId <= 0) {
			throw(new \PDOException("violation id is not positive"));
		}
		//create query template
		$query = "SELECT violationId, violationCategoryId, violationCode, violationCodeDescription FROM violation WHERE violationId = :violationId";
		$statement = $pdo->prepare($query);

		//bind the violation id to the place holder in the template
		$parameters = ["violationId" => $violationId];
		$statement->execute($parameters);

		//grab the violation from mySQL
		try {
			$tweet = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$violation = new Violation($row["violationId"], $row["violationCategoryId"], $row["violationCode"], $row[violationCodeDescription]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new\PDOException($exception->getMessage(), 0, $exception));
		}
		return ($violation);
	}

	/**
	 * gets the violation by category id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $violationCategoryId violation id to search by
	 * @return \SplFixedArray SplFixedArray of violations found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getViolationByViolationCategoryId(\PDO $pdo, int $violationCategoryId): \SplFixedArray {
		// sanitize the violation id before searching
		if($violationCategoryId <= 0) {
			throw(new \RangeException("violation category id must be positive"));
		}
// create query template
		$query = "SELECT violationId, violationCategoryId, violationCode, violationCodeDescription FROM violation WHERE violationCategoryId = :violationCategoryId";
		$statement = $pdo->prepare($query);
		// bind the violation category id to the place holder in the template
		$parameters = ["violationCategoryId" => $violationCategoryId];
		$statement->execute($parameters);
		// build an array of violations
		$violations = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$violation = new Violation($row["profileId"], $row["profileCategoryId"], $row["profileCode"], $row["profileCodeDescription"]);
				$violation[$violation->key()] = $violation;
				$violation->next();
			} catch(\Exception $exception) {
				// if the row could not be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($violations);
	}

	/**
	 * gets the Violation by code
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $violationCode violation code to search for
	 * @return \SplFixedArray SplFixedArray of Violations found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getViolationByViolationCode(\PDO $pdo, string $violationCode): \SplFixedArray {
		// sanitize the description before searching
		$violationCode = trim($violationCode);
		$violationCode = filter_var($violationCode, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($violationCode) === true) {
			throw(new \PDOException("violation code is invalid"));
		}
		// escape any mySQL wild cards
		$violationCode = str_replace("_", "\\_", str_replace("%", "\\%", $violationCode));

		// create query template
		$query = "SELECT violationId, violationCategoryId, violationCode, violationCodeDescription FROM violation WHERE violationCode LIKE :violationCode";
		$statement = $pdo->prepare($query);

		//bind the violation content to the place holder in the template
		$violationCode = "%$violationCode%";
		$parameters = ["violationCode" => $violationCode];
		$statement->execute($parameters);

		//build an array of violations
		$violations = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$violation = new Violation($row["violationId"], $row["violationCategoryId"], $row["violationCode"], $row["violationCodeDescription"]);
				$violation[$violation->key()] = $violation;
				$violation->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
	return ($violations);
	}
	/**
	 * gets the Violation by code description
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $violationCodeDescription violation code description to search for
	 * @return \SplFixedArray SplFixedArray of Violations found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getViolationByViolationCodeDescripyion(\PDO $pdo, string $violationCodeDescription): \SplFixedArray {
		// sanitize the description before searching
		$violationCodeDescription = trim($violationCodeDescription);
		$violationCodeDescription = filter_var($violationCodeDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($violationCodeDescription) === true) {
			throw(new \PDOException("violation code description is invalid"));
		}
		// escape any mySQL wild cards
		$violationCodeDescription = str_replace("_", "\\_", str_replace("%", "\\%", $violationCodeDescription));

		// create query template
		$query = "SELECT violationId, violationCategoryId, violationCode, violationCodeDescription FROM violation WHERE violationCodeDescription LIKE :violationCode";
		$statement = $pdo->prepare($query);

		//bind the violation content to the place holder in the template
		$violationCode = "%$violationCodeDescription%";
		$parameters = ["violationCodeDescription" => $violationCodeDescription];
		$statement->execute($parameters);

		//build an array of violations
		$violations = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$violation = new Violation($row["violationId"], $row["violationCategoryId"], $row["violationCode"], $row["violationCodeDescription"]);
				$violation[$violation->key()] = $violation;
				$violation->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
	return ($violation);
	}
	/**
	 * gets all Violations
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Tweets found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 *
	 **/
	public static function getAllViolations(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT violationId, violationCategoryId, violationCode, violationCodeDescription FROM violation";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of violations
		$violation = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$violation = new Violation($row["violationId"], $row["violationCategoryId"], $row["violationCode"], $row["violationCodeDescription"]);
				$violation[$violation->key()] = $violation;
				$violation->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($violation);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
	}
}




