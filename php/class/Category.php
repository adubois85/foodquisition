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
	
}