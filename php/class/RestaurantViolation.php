<?php
namespace Edu\CNM\foodquisition;

require_once("autoload.php");
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

 * public function _construct(?int $newRestaurantViolationId,int $newRestaurantViolationRestaurantId, int $newrestaurantViolationViolationId, string $newRestaurantViolationMemo, $newRestaurantViolationDate = null, string $newrestaurantViolationResults, ){
 	try->{
 		$this->setRestaurantViolationId($newRestaurantViolationId);
		$this->setrestaurantViolationRestaurantId($newRestaurantViolationRestaurantId);
		$this->setRestaurantViolationViolationId($newRestaurantViolationViolationId);
		$this->setRestaurantViolationMemo($newrestaurantViolationmemo);
		$this->setRestaurantViolationDate($newRestaurantViolationDate);
		$this->setRestaurantViolationResults($newRestaurantViolationResults);
		}
//determine what exception type was thrown
catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
	$exceptionType = get_class($exception);
	throw(new $exceptionType($exception->getMessage(), 0, $exception));
}
}

/**
 * accessor method for restaurantViolationId
 *
 * @return int|null value of restaurantViolationId
 **/
public function getRestaurantViolationId() : int{ return($this->restaurantViolationId);
}
	/**
	 * Mutator method for restaurantViolationId
	 *
	 * @param int | null $newRestaurantViolationId new value of restaurantViolationId
	 * @return void if $newRestaurantViolationId is already null
	 * @throws \TypeError if $newRestaurantViolationId is not an integer
	 * @thorws \RangeException if $newRestaurantViolationId is not a positive number
	 */
	public function setRestaurantViolationId (?int $newRestaurantViolationId) : void {
	// the primary key must be null when we initially try to add it to the database or
	// we'll encounter an infinite loop.  If it is null already, we return it
	if ($newRestaurantViolationId === null) {
		$this->restaurantViolationId = null;
		return;
	}
	// the restaurantViolationId must be a positive number; check that here
	if ($newRestaurantViolationId < 1) {
		throw(new \RangeException("The entered restaurant violation ID is not a positive number."));
	}
	// now we can set the corresponding state variable to the entered value
	$this->restaurantViolationId = $newRestaurantViolationId;
}
/**
 * accessor method for restaurant violation restaurant id
 *
 * @return int value of restaurant violation restaurant Id
 **/
	public function getRestaurantViolationRestaurantId() : int{
	return($this->restaurantViolationRestaurantId);
}

	/**
	 * mutator method for restaurant violation restaurant id
	 *
	 * @param int $newRestaurantViolationRestaurantId new value of restaurant violation restaurant id
	 * @throws \RangeException if $newRestaurantViolationRestaurantId is not positive
	 * @throws \TypeError if $newRestaurantViolationRestaurantId is not an integer
	 **/
	public function setRestaurantViolationRestaurantId(int $newRestaurantViolationRestaurantId) : void {

	// verify the profile id is positive
	if($newRestaurantViolationRestaurantId <= 0) {
		throw(new \RangeException("restaurant violation restaurant id is not positive"));
	}

	// convert and store the profile id
	$this->restaurantViolationRestaurantId = $newRestaurantViolationRestaurantId;
}
/**
 * accessor method for restaurant violation violation id
 *
 * @return int value of restaurant violation violation Id
 **/
	public function getRestaurantViolationViolationId() : int{
	return($this->restaurantViolationRestaurantId);
}

	/**
	 * mutator method for restaurant violation Violation id
	 *
	 * @param int $newRestaurantViolationViolationId new value of restaurant violation violation id
	 * @throws \RangeException if $newRestaurantViolationViolationId is not positive
	 * @throws \TypeError if $newRestaurantViolationViolationId is not an integer
	 **/
	public function setRestaurantViolationViolationId(int $newRestaurantViolationViolationId) : void {

	// verify the profile id is positive
	if($newRestaurantViolationViolationId <= 0) {
		throw(new \RangeException("restaurant violation violation id is not positive"));
	}

	// convert and store the profile id
	$this->restaurantViolationViolationId = $newRestaurantViolationViolationId;
}
/**
 * accessor method for restaurant violation date
 *
 * @return \Date value of restaurant violation date
 **/
	public function getRestaurantViolationDate() : \Date {
	return($this->RestaurantViolationDate);
}

	/**
	 * mutator method for restaurant violation date
	 *
	 * @param \DateTime|string|null $newRestaurantViolationDate restaurant violation date as a Date object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newRestaurantViolationDate is not a valid object or string
	 * @throws \RangeException if $newRestaurantViolationDate is a date that does not exist
	 **/
	public function setRestaurantViolationDate($newRestaurantViolationDate = null) : void {
	// base case: if the date is null, use the current date
	if($newRestaurantViolationDate === null) {
		$this->RestaurantViolationDate = new \Date();
		return;
	}

	// store the like date using the ValidateDate trait
	try {
		$newRestaurantViolationDate = self::validateDate($newRestaurantViolationDate);
	} catch(\InvalidArgumentException | \RangeException $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	$this->restaurantViolationDate = $newRestaurantViolationDate;
}

	/**
	 * Accessor method for restaurant violation memo
	 *
	 * @return string value of restaurant violation memo
	 */
	public function getRestaurantViolationMemo() : string {
	return($this->restaurantViolationMemo);
}
	/**
	 * Mutator method for restaurant violation memo
	 *
	 * @param string $newRestaurantCity new value of restaurant violation memo
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 255 characters
	 */
	public function setRestaurantViolationMemo(string $newRestaurantViolationMemo) {
	// prep the variable for sanitization, then sanitize it
	$newRestaurantViolationMemo = trim($newRestaurantViolationMemo);
	$newRestaurantViolationMemo = filter_var($newRestaurantViolationMemo, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// check if the resultant variable is still valid, then set
	if(empty($newRestaurantViolationMemo) === true) {
		throw(new \InvalidArgumentException("There are no valid characters in the entered city name."));
	}
	if(strlen($newRestaurantViolationMemo) > 255) {
		throw(new \RangeException("The entered city name is too long."));
	}
	$this->RestaurantViolationMemo = $newRestaurantViolationMemo;
}
	/**
	 * Accessor method for restaurant violation results
	 *
	 * @return string value of restaurant violation results
	 */
	public function getRestaurantViolationResults() : string {
	return($this->RestaurantViolationResults);
}
	/**
	 * Mutator method for restaurant violation results
	 *
	 * @param string $newRestaurantViolationResults new value of restaurant violation results
	 * @throws \TypeError if the entered value isn't a string
	 * @throws \InvalidArgumentException if the entered value is empty for any reason after sanitizing
	 * @throws \RangeException if the entered value is longer than 32 characters
	 */
	public function setRestaurantViolationResults(string $newRestaurantViolationResults) {
	// prep the variable for sanitization, then sanitize it
	$newRestaurantViolationResults = trim($newRestaurantViolationResults);
	$newRestaurantViolationResults = filter_var($newRestaurantViolationResults, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// check if the resultant variable is still valid, then set
	if(empty($newRestaurantViolationResults) === true) {
		throw(new \InvalidArgumentException("There are no valid characters in the entered restaurant violation results."));
	}
	if(strlen($newRestaurantViolationResults) > 32) {
		throw(new \RangeException("The entered restaurant violation results is too long."));
	}
	$this->restaurantViolationResults = $newRestaurantViolationResults;
}
/**
 * inserts this Restaurant violation into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
	public function insert(\PDO $pdo) : void {
	// enforce the restaurantViolationId is null (i.e., don't insert a restaurant violation that already exists)
	if($this->restaurantViolationId !== null) {
		throw(new \PDOException("not a new restaurantViolationId"));
	}

	// create query template
	$query = "INSERT INTO restaurantViolation(restaurantViolationId, resturantViolationrestaurant, tweetDate) VALUES(:tweetProfileId, :tweetContent, :tweetDate)";
	$statement = $pdo->prepare($query);

	// bind the member variables to the place holders in the template
	$formattedDate = $this->restaurantViolationDate->format("Y-m-d H:i:s.u");
	$parameters = ["tweetProfileId" => $this->restaurantViolationViolationId, "tweetContent" => $this->tweetContent, "tweetDate" => $formattedDate];
	$statement->execute($parameters);

	// update the null tweetId with what mySQL just gave us
	$this->restaurantViolationIdId = intval($pdo->lastInsertId());
}
