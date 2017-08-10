<?php
namespace Edu\Cnm\Foodquisition\Test;

use Edu\Cnm\Foodquisition\Category;

// grab the project test parameters
require_once("FoodquisitionTest.php");

//grab the class under scrutiny
require_once (dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPunit test for the Category class
 *
 * This is a complete PHPunit test of the Category class. It is complete because *ALL* mySQL/PDO enabled methods are tested for both invalid and valid inputs
 *
 * @see Category
 * @author Steve Stone <stoneflynm@gmail.com>
 */
class CategoryTest extends FoodquisitionTest {
	/**
	 * name of the Category
	 * @var string $VALID_CATEGORYNAME
	**/
	protected $VALID_CATEGORYNAME = "Fuzzies In Kitchen";
}