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
}