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

	/**
	 * test inserting a valid category andd verify that the actual mySQL data matches
	 **/

	public function testInsertValidCategory() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("category");

		//create a new Category and insert into mqSQL
		$category = new Category(null, $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		//grab category back from mySQL and verify all fields match
		$pdoCategory = Category::getCategoryByCategoryId($this->getPDO(), $category->getCategoryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("category"));
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME);
	}

	/**
	 * test inserting a Category that all ready exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidCategory() : void {
		// create a category with a non null categoryId and watch it fail
		$category = new Category(FoodquisitionTest::INVALID_KEY, $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());
	}

	/**
	 * test inserting a Category, editing it, and then updating it
	 */
	public function testUpdateValidCategory() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("category");

		//create a new Category and insert into mySQL
		$category = new Category(null, $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		// edit the Category and update it in mySQL
		$category->setCategoryName($this->VALID_CATEGORYNAME);
		$category->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCategory = Category::getCategoryByCategoryId($this->getPDO(), $category->getCategoryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("category"));
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME);
	}

}