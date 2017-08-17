<?php

namespace Edu\Cnm\Foodquisition\Test;

use Edu\Cnm\Foodquisition\{
	Category, Violation
};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/*
 * Full PHPUnit test for the Violation class
 *
 * This is a complete PHPUnit test of the Violation. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Violation
 * @author Danielle Branch <dbranch82@gmail.com>
 *
 */

class ViolationTest extends FoodquisitionTest {
	/**
	 * Category that created the Violation; this is for foreign key relations
	 * @var Category category
	 *
	 */
	protected $category = null;

	/**
	 *valid profile category Id
	 * @var int $VALID_VIOLATIONCATEGORYID
	 *
	 */
	protected $VALID_VIOLATIONCATEGORYID;
	/**
	 * Valid Violation Code
	 * @var string $VALID_VIOLATIONCODE
	 */
	protected $VALID_VIOLATIONCODE = "S42";
	/**
	 * valid violation code 2
	 *  @var string $VALID_VIOLATIONCODE2
	 *
	 */
	protected $VALID_VIOLATIONCODE2 = "s43";
	/**
	 * valid violation code description
	 * @var string $VALID_VIOLATIONCODEDESCRIPTION
	 */
	protected $VALID_VIOLATIONCODEDESCRIPTION = "ViolationCodeDescription";

	/**
	 *create dependent objects before running each test
	 **/
	public final function setUp(): void {
		//run the default setUp() method first
		parent::setUp();
		$this->category = new Category(null, "name");
		$this->category->insert($this->getPDO());

	}

	/**test inserting a valid Violation and verify that the actual mySQL data matches
	 *
	 **/
	public function testInsertValidViolation(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("violation");

		//create a new Violation and insert to into mySQL
		$violation = new Violation(null, $this->category->getCategoryId(), $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoViolation = Violation::getViolationByViolationId($this->getPDO(), $violation->getViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
		$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoViolation->getViolationCode(), $this->VALID_VIOLATIONCODE);
		$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->VALID_VIOLATIONCODEDESCRIPTION);
	}

	/**
	 * test inserting a Violation that already exists
	 *
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidViolation(): void {
		//create a Violation with a non null violation id and watch it fail
		$violation = new Violation(FoodquisitionTest::INVALID_KEY, $this->category->getCategoryId(), $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());
	}

	/**
	 * test inserting a Violation, editing it, and then updating it
	 *
	 */
	public function testUpdateValidViolation(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("violation");

		// create a new Violation and insert to into mySQL
		$violation = new Violation(null, $this->category->getCategoryId(), $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());

		// edit the Violation and update it in mySQL
		$violation->setViolationCode($this->VALID_VIOLATIONCODE2);
		$violation->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoViolation = Violation::getViolationByViolationId($this->getPDO(), $violation->getViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
		$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoViolation->getViolationCode(), $this->VALID_VIOLATIONCODE2);
		$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->VALID_VIOLATIONCODEDESCRIPTION);
	}

	/**
	 * test updating a Violation that already exist
	 *
	 * @expectedException \PDOException
	 *
	 */

	public function testUpdateInvalidViolation(): void {
		// create a Violation with a non null violation id and watch it fail
		$violation = new Violation(null, $this->category->getCategoryId(), $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->update($this->getPDO());
	}

	/**
	 * test creating a Violation and then deleting it
	 */
public function testDeleteValidViolation(): void {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("violation");

	//create a new Violation and insert it into mySQL
	$violation = new Violation(null, $this->category->getCategoryId(),  $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
	$violation->insert($this->getPDO());

	// delete the Violation from mySQL
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
	$violation->delete($this->getPDO());

	//grab the data from mySQL and enforce the Violation does not exist
	$pdoViolation = Violation::getViolationByViolationId($this->getPDO(), $violation->getViolationId());
	$this->assertNull($pdoViolation);
	$this->assertEquals($numRows, $this->getConnection()->getRowCount("violation"));
}

	/**
	 * test deleting a Violation that does not exist
	 *
	 * @expectedException \PDOException
	 */
	public function testDeleteInvalidViolation(): void {
		// create a Violation and try to delete it without actually inserting it
		$violation = new Violation(null, $this->category->getCategoryId(),  $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->delete($this->getPDO());
	}

	/**
	 * test inserting a Violation and regrabbing it from mySQL
	 */
	public function testGetValidViolationByViolationId(): void {
		//count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("violation");

		//create a new Violation and insert into mySQL
		$violation = new Violation(null, $this->category->getCategoryId(),  $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoViolation = Violation::getViolationByViolationId($this->getPDO(), $violation->getViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
		$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoViolation->getViolationCode(), $this->VALID_VIOLATIONCODE);
		$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->VALID_VIOLATIONCODEDESCRIPTION);
	}

	/**
	 * test grabbing a Violation that does not exist
	 */
	public function testGetInvalidViolationByViolationId(): void {
		//grab a profile id that exceeds the maximum allowable violation id
		$violation = Violation::getViolationByViolationId($this->getPDO(), FoodquisitionTest::INVALID_KEY);
		$this->assertNull($violation);
	}

	/**
	 * test inserting a Violation and regrabbing it from mySQL
	 *
	 */
	public function testGetValidViolationByViolationCategoryId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("violation");

		//create a new Violation and insert it into mySQL
		$violation = new Violation(null, $this->category->getCategoryId(),  $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Violation::getViolationsByViolationCategoryId($this->getPDO(), $violation->getViolationCategoryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\Violation", $results);

		// grab the result from the array and validate it
		$pdoViolation = $results[0];
		$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoViolation->getViolationCode(), $this->VALID_VIOLATIONCODE);
		$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->VALID_VIOLATIONCODEDESCRIPTION);
	}

	/**
	 *
	 *test grabbing a Violation that does not exist
	 */
	public function testGetInvalidViolationsByViolationCategoryId(): void {
		// grab a category id that exceeds the maximum allowable violation id
		$violation = Violation::getViolationsByViolationCategoryId($this->getPDO(), FoodquisitionTest::INVALID_KEY);
		$this->assertCount(0, $violation);
	}

	/**
	 * test inserting a Violation by violation code
	 *
	 */

	public function testGetValidViolationByViolationCode(): void {
		// count number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("violation");

		//create a new Violation and insert into mySQL
		$violation = new Violation(null, $this->category->getCategoryId(), $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Violation::getViolationByViolationCode($this->getPDO(), $violation->getViolationCode());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
		$this->assertCount(1, $results);

		//enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\Violation", $results);

		//grab the result from the array and validate it
		$pdoViolation = $results[0];
		$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoViolation->getViolationCode(), $this->VALID_VIOLATIONCODE);
		$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->VALID_VIOLATIONCODEDESCRIPTION);
	}

	/**
	 * test grabbing a Violation by code that does not exist
	 *
	 */
	public function testGetInValidViolationByViolationCode(): void {
		//grab a category id that excedds the maximum allowable category if
		$violation = Violation::getViolationsByViolationCategoryId($this->getPDO(), FoodquisitionTest::INVALID_KEY);
		$this->assertCount(0, $violation);
	}

	/**
	 * test grabbing a valid Violation by Violation code description
	 */
	public function testGetValidViolationByViolationCodeDescription(): void {
		// count number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("violation");

		//create a new Violation and insert into mySQL
		$violation = new Violation(null, $this->category->getCategoryId(), $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
		$violation->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Violation::getViolationByViolationCodeDescription($this->getPDO(), $violation->getViolationCodeDescription());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
		$this->assertCount(1, $results);

		//enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\Violation", $results);

		//grab the result from the array and validate it
		$pdoViolation = $results[0];
		$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoViolation->getViolationCode(), $this->VALID_VIOLATIONCODE);
		$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->VALID_VIOLATIONCODEDESCRIPTION);
	}

		public function testGetInValidViolationByViolationCodeDescription(): void {
			//grab an invalid code that the maximum allowable code if
			$violation = Violation::getViolationByViolationCodeDescription($this->getPDO(), FoodquisitionTest::INVALID_KEY);
			$this->assertCount(0, $violation);
	}

}
