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
	 * @param
	 */
}