<?php
namespace Edu\Cnm\Foodquisition;

require_once("autoload.php");

/**
 * @author Steve Stone <stoneflynm@gmail.com>
 * @version 1.0.0
**/

class Category implements \JsonSerializable {
	/**
	 * id for this category; this is the primary key
	 * @var int $categoryId
	 **/
	private $categoryId;
	/**
	 * name of the category
	 * @var string $categoryName
	 */
	private $categoryName;

	/**
	 * constructor for this category
	 *
	 * @param int|null $newCategoryId id of this category or null if a new category
	 * @param string $newCategoryName string containing name of category
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct(?int $newCategoryId, string $newCategoryName) {
		try {
			$this->setCategoryId($newCategoryId);
			$this->setCategoryName($newCategoryName);
		}
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for category id
	 *
	 * @return int|null value fo category id
	 **/

	public function getCategoryId(): int {
		return ($this->categoryId);
	}

	/**
	 * mutator method for category id
	 *
	 * @param int|null $newCategoryId value of new category id
	 * @throws \RangeException is $newCategoryId is not positive
	 * @throws |\TypeError is $newCategoryId is not an integer
	 **/

	public function setCategoryId(?int $newCategoryId): void {
		if($newCategoryId === null){
			$this->categoryId = null;
			return;
		}
		// verify the category id is positive
		if($newCategoryId <= 0) {
			throw(new \RangeException("category id is not positive"));
		}
		//convert and store the category id
		$this->categoryId = $newCategoryId;
	}

	/**
	 * accessor method for category name
	 *
	 * @return string value of category name
	 **/

	public function getCategoryName(): string {
		return ($this->categoryName);
	}

	/**
	 * mutator method for category name
	 *
	 * @param string $newCategoryName new value of category name
	 * @throws \InvalidArgumentException if $newCategoryName is not a string or insecure
	 * @throws \RangeException is $newCategoryName is > 32 characters
	 * @throws \TypeError if $newCategoryName is not a string
	 **/
	public function setCategoryName(string $newCategoryName) : void {
		// verify that the category name is secure
		$newCategoryName = trim($newCategoryName);
		$newCategoryName = filter_var($newCategoryName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCategoryName) === true) {
			throw(new \InvalidArgumentException("category name is empty or insecure"));
		}

		//verify the category name will fit in the database
		if(strlen($newCategoryName) > 32) {
			throw(new \RangeException("category name is too large"));
		}

		// store the category name
		$this->categoryName = $newCategoryName;
	}

	/**
	 * inserts this category into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {
		// enforce the profileId is null (i.e., don't insert a category that already exists)
		if($this->categoryId !== null) {
			throw(new \PDOException("not a new category"));
		}

		// create query template
		$query = "INSERT INTO category(categoryName) VALUES (:categoryName)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["categoryName" => $this->categoryName];
		$statement->execute($parameters);

		//update the null category id with what mySQL just gave us
		$this->categoryId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this category from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws |\TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		//enforce the categoryId is not null (i.e., don't delete a category that does not exist)
		if($this->categoryId === null) {
			throw(new \PDOException("unable to delete a category that does not exist"));
		}

		//create query template
		$query = "DELETE FROM category WHERE categoryId = :categoryId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["categoryId" => $this->categoryId];
		$statement->execute($parameters);
	}
	/**
	 * updates this Category in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
		// enforce the categoryId is not null (i.e., don't update a profile that does not exist)
		if($this->categoryId === null) {
			throw(new \PDOException("unable to delete a category that does not exist"));
		}

		//create query template
		$query = "UPDATE category SET categoryName = :categoryName WHERE categoryId = :categoryId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["categoryName" => $this->categoryName];
		$statement->execute($parameters);
	}

	/**
	 * gets category by category id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $categoryId category id to search for
	 * @return Category|null Category found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws |\TypeError when variables are not the correct data type
	 **/
	public static function getCategoryByCategoryId(\PDO $pdo, int $categoryId): ?Category{
		// sanitize the category id before searching
		if($categoryId <= 0) {
			throw(new \PDOException("profile id is not positive"));
		}

		// create query template
		$query = "SELECT categoryId, categoryName FROM category WHERE categoryId = :categoryId";
		$statement = $pdo->prepare($query);

		// bind the category id to the place holder in the template
		$parameters = ["categoryId" => $categoryId];
		$statement->execute($parameters);

		// grab the category from mySQL
		try {
			$category = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$category = new Category($row["categoryId"], $row["categoryName"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($category);
	}

	/**
	 * gets all the categories
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Categories found or null if not found
	 * @throws \PDOException when mqSQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllCategories(\PDO $pdo) : \SplFixedArray {
		//create query template
		$query = "SELECT categoryId, categoryName FROM category";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of categories
		$categories = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$category = new Category($row["categoryId"], $row["categoryName"]);
				$categories [$categories->key()] = $category;
				$categories->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($categories);
	}
	/**
	 * formats the state variable for JSON serializarion
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}