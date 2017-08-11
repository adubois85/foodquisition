<?php
namespace Edu\Cnm\Foodquisition\Test;

use Edu\Cnm\Foodquisition\{Category, Violation};

// grab the class under scrutiny
require_once(dirname(_DIR_) . "/autoload.php");

/*
 * Full PHPUnit test for the Violation class
 *
 * This is a complete PHPUnit test of the Violation. Itis complete because *ALL* mySQL/PDO enabled methods
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
	 *
	 * @var int $VALID_VIOLATIONCATEGORYID
	 *
	 */
	protected $VALID_VIOLATIONCATEGORYID;
	/**
	 * Valid Violation Code
	 * @var string $VALID_VIOLATIONCODE
	 */
	protected $VALID_VIOLATIONCODE;
	/**
	 * valid violation code description
	 * @var string $VALID_VIOLATIONCODEDESCRIPTION
	 */
	protected $VALID_VIOLATIONCODESCRIPTION;

	/**
	 * test inserting a valid Violation and verify  that the actual mySQL data matches
	 */
	public function testInsertValidViolation(): void {
		// count the number of the rows and save it for later
		$numRows = $this->getConnection()->getRowCount("violation");
	}
		/**
		 *create dependent objects before running each test
		 **/
		public final function setUP(): void {
			//run the default setUp() method first
			parent::setUp();
			$this->category = new Category(null, null,);
				$this->category->insert($this->getPDO());

		}

		//create a new Violation and insert to mySQL
		public function testInsertValidViolation(): void {
			$violation = new Violation(null, $this->Violation->getViolationId(), $this->VALID_VIOLATIONCATEGORYID, $this->VALID_VIOLATIONCODE, $this->VALID_VIOLATIONCODEDESCRIPTION);
			$violation->insert($this->getPDO());

			// grab the data from mySQL and enforce the fields match our expectations
			$pdoViolation = Violation::getViolationByViolationId($this->getPDO(), $violation->getViolationId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("violation"));
			$this->assertEquals($pdoViolation->getViolationCategoryId(), $this->category->getViolationCategoryId());
			$this->assertEquals($pdoViolation->getViolationCode(), $this->getViolationCode);
			$this->assertEquals($pdoViolation->getViolationCodeDescription(), $this->get);
		}
		/**
		 * test inserting a Violation that already exists
		 *
		 *
		 */
	}
}
