<?php
namespace Edu\Cnm\Foodquisition\Test;
use Edu\Cnm\Foodquisition\{
	Restaurant, Violation, RestaurantViolation};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
/*
 * Full PHPUnit test for the RestaurantViolation class
 *
 * This is a complete PHPUnit test of the RestaurantViolation class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see RestaurantViolation
 * @author Dannielle Bojorquez <dannielle.bojorquez@gmail.com>
 *
 */
class RestaurantViolationTest extends FoodquisitionTest {
	/**
	 * RestaurantViolationRestaurantId that created the RestaurantViolation; this is for foreign key relations
	 * @var $RESTAURANT restaurant
	 */
	protected $restaurant = null;
	/**
	 * Violation that created the RestaurantViolation; this is for foreign key relations
	 * @var $VIOLATION violation
	 */
	protected $violation = null;

	/**
	 * restaurant Violation category that created the  RestaurantViolation; this is string
	 * @var $CATEGORY category
	 */
//	protected $category = null;
	/**
	 *memo of the violation
	 *@var string $VALID_RESTAURANTVIOLATIONMEMO
	 **/
	protected $VALID_RESTAURANTVIOLATIONMEMO = "TOO MUCH TYPING";
	/**
	 * updated memo of the violation
	 *@var string $VALID_RESTAURANTVIOLATIONMEMO1
	 **/
	protected $VALID_RESTAURANTVIOLATIONMEMO1 = "TOO MUCH TYPING1";
	/**
	 *results of the violation
	 *@var string $VALID_RESTAURANTVIOLATIONRESULTS
	 **/
	protected $VALID_RESTAURANTVIOLATIONRESULTS = "WAT";
	/**
	 * timestamp of the RestaurantViolation; this starts as null ans is assigned later
	 * @var \DateTime $VALID_RESTAURANTVIOLATIONDATE
	 **/
	protected $VALID_RESTAURANTVIOLATIONDATE = null;
	/**
	 * Valid timestamp to use as sunriseRestaurantViolationDate
	 **/
	protected $VALID_SUNRISEDATE = null;
	/**
	 * Valid timestamp to use as sunsetRestaurantViolationDate
	 **/
	protected $VALID_SUNSETDATE = null;
	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() : void{
		//run the default setup() method first
		parent::setup();
		// create and insert a restaurant to own the restaurantViolation
		$this->restaurant = new Restaurant(null,"2435 chapter ln", "apt 3","Albuquerque", "1253545", "googleid_65485789", "loco geek", "5054565432", "NM", "Mobile-food unit", "87106");
		$this->restaurant->insert($this->getPDO());
// added to  violation because this is what my class pulls from

		$this->violation = new Violation(null, 128708789,"4856865", "code description");
		$this->violation->insert($this->getPDO());

		// added category because violation pulls from category

//		$this->category = new Category(null, "name");
//		$this->category->insert($this->getPDO());

		// calculate the date(just us the time and date the unit test was setup...)
		$this->VALID_RESTAURANTVIOLATIONDATE = new \DateTime();
		//format the sunrise date to use for testing
		$this->VALID_SUNRISEDATE = new \DateTime();
		$this->VALID_SUNRISEDATE->sub(new \DateInterval("P10D"));

		//format the sunset date to use for testing
		$this->VALID_SUNSETDATE = new\DateTime();
		$this->VALID_SUNSETDATE->add(new \DateInterval("P10D"));
	}
	/**
	 * test inserting a valid RestaurantViolation and verify that the actual mySQL data matches
	 **/
	public function testInsertValidRestaurantViolation() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("RestaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$RestaurantViolation = new RestaurantViolation(null, $this->restaurant->getRestaurantId(), $this->violation->getViolationId(),$this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$RestaurantViolation->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRestaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationId($this->getPDO(), $RestaurantViolation->getRestaurantViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("RestaurantViolation"));
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->restaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->restaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test inserting a RestaurantViolation that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidRestaurantViolation() : void {
		// create a RestaurantViolation with a non null RestaurantViolation id and watch it fail
		$RestaurantViolation = new RestaurantViolation(FoodquisitionTest::INVALID_KEY, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(),$this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$RestaurantViolation->insert($this->getPDO());
		$RestaurantViolation = new RestaurantViolation(FoodquisitionTest::INVALID_KEY, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(),$this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$RestaurantViolation->insert($this->getPDO());
	}
	/**
	 * test inserting a RestaurantViolation, editing it, and then updating it
	 **/
	public function testUpdateValidRestaurantViolation() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("RestaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$RestaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$RestaurantViolation->insert($this->getPDO());
		$RestaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$RestaurantViolation->insert($this->getPDO());
		// edit the RestaurantViolation and update it in mySQL
		$RestaurantViolation->setRestaurantViolationMemo($this->VALID_RESTAURANTVIOLATIONMEMO2);
		$RestaurantViolation->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRestaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationId($this->getPDO(), $RestaurantViolation->getRestaurantViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("RestaurantViolation"));
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO2);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test updating a RestaurantViolation that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidRestaurantViolation() : void {
		// create a RestaurantViolation with a non null RestaurantViolation id and watch it fail
		$restaurantViolation = new RestaurantViolation(null, $this->restaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->update($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->restaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->update($this->getPDO());
	}
	/**
	 * test creating a RestaurantViolation and then deleting it
	 **/
	public function testDeleteValidRestaurantViolation() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("restaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->insert($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->insert($this->getPDO());
		// delete the RestaurantViolation from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurantViolation"));
		$restaurantViolation->delete($this->getPDO());
		// grab the data from mySQL and enforce the RestaurantViolation does not exist
		$pdoRestaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationId($this->getPDO(), $restaurantViolation->getRestaurantViolationId());
		$this->assertNull($pdoRestaurantViolation);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("restaurantViolation"));
	}
	/**
	 * test deleting a RestaurantViolation that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidRestaurantViolation() : void {
		// create a RestaurantViolation and try to delete it without actually inserting it
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
	}
	/**
	 * test inserting a RestaurantViolation and regrabbing it from mySQL
	 **/
	public function testGetValidRestaurantViolationByRestaurantViolationId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("restaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRestaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationId($this->getPDO(), $restaurantViolation->getRestaurantViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurantViolation"));
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test grabbing a RestaurantViolation that does not exist
	 **/
	public function testGetInvalidRestaurantViolationByRestaurantViolationId() : void {
		// grab a RestaurantViolationRestaurant id that exceeds the maximum allowable RestaurantViolationRestaurant id
		$restaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationId($this->getPDO(), FoodquisitionTest::INVALID_KEY);
		$this->assertNull($restaurantViolation);
	}
	/**
	 * test inserting a RestaurantViolation and regrabbing it from mySQL
	 **/
	public function testGetValidRestaurantViolationByRestaurantViolationRestaurantId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("restaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = RestaurantViolation::getRestaurantViolationByRestaurantViolationRestaurantId($this->getPDO(), $restaurantViolation->getRestaurantViolationRestaurantId());
		$results = RestaurantViolation::getRestaurantViolationByRestaurantViolationViolationId($this->getPDO(), $restaurantViolation->getRestaurantViolationViolationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurantViolation"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\RestaurantViolation", $results);
		// grab the result from the array and validate it
		$pdoRestaurantViolation = $results[0];
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test grabbing a RestaurantViolation that does not exist
	 **/
	public function testGetInvalidRestaurantViolationByRestaurantViolationRestaurantId() : void {
		// grab a RestaurantViolationRestaurantId id that exceeds the maximum allowable RestaurantViolationRestaurantId id
		$restaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationRestaurantId($this->getPDO(), FoodquisitionTest::INVALID_KEY);
		$this->assertCount(0, $restaurantViolation);
	}
	/**
	 * test grabbing a RestaurantViolation by RestaurantViolation memo
	 **/
	public function testGetValidRestaurantViolationByRestaurantViolationMemo() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("restaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = RestaurantViolation::getRestaurantViolationByRestaurantViolationMemo($this->getPDO(), $restaurantViolation->getRestaurantViolationMemo());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurantViolation"));
		$this->assertCount(1, $results);
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\RestaurantViolation", $results);
		// grab the result from the array and validate it
		$pdoRestaurantViolation = $results[0];
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test grabbing a RestaurantViolation by RestaurantViolation Results
	 **/
	public function testGetValidRestaurantViolationByRestaurantViolationResults() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("restaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = RestaurantViolation::getRestaurantViolationByRestaurantViolationResults($this->getPDO(), $restaurantViolation->getRestaurantViolationResults());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurantViolation"));
		$this->assertCount(1, $results);
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\RestaurantViolation", $results);
		// grab the result from the array and validate it
		$pdoRestaurantViolation = $results[0];
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test grabbing a RestaurantViolation by memo that does not exist
	 **/
	public function testGetInvalidRestaurantViolationByRestaurantViolationMemo() : void {
		// grab a RestaurantViolation by memo that does not exist
		$RestaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationMemo($this->getPDO(), "no RestaurantViolationMemo here");
		$this->assertCount(0, $RestaurantViolation);
	}
	/**
	 * test grabbing a RestaurantViolation by results that does not exist
	 **/
	public function testGetInvalidRestaurantViolationByRestaurantViolationResults() : void {
		// grab a RestaurantViolation by results that does not exist
		$RestaurantViolation = RestaurantViolation::getRestaurantViolationByRestaurantViolationResults($this->getPDO(), "no RestaurantViolationResults here");
		$this->assertCount(0, $RestaurantViolation);
	}
	/**
	 * test grabbing a valid RestaurantViolation by sunset and sunrise date
	 *
	 */
	public function testGetValidRestaurantViolationBySunDate() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("restaurantViolation");
		//create a new RestaurantViolation and insert it into the database
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		// grab the RestaurantViolation from the database and see if it matches expectations
		$results = RestaurantViolation::getRestaurantViolationByRestaurantViolationDate($this->getPDO(), $this->VALID_SUNRISEDATE, $this->VALID_SUNSETDATE);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("restaurantViolation"));
		$this->assertCount(1,$results);
		//enforce that no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\RestaurantViolation", $results);
		//use the first result to make sure that the inserted RestaurantViolation meets expectations
		$pdoRestaurantViolation = $results[0];
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
	/**
	 * test grabbing all RestaurantViolations
	 **/
	public function testGetAllValidRestaurantViolations() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("RestaurantViolation");
		// create a new RestaurantViolation and insert to into mySQL
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		$restaurantViolation = new RestaurantViolation(null, $this->RestaurantViolationViolationId->getRestaurantViolationViolationId(), $this->VALID_RESTAURANTVIOLATIONDATE, $this->VALID_RESTAURANTVIOLATIONMEMO, $this->VALID_RESTAURANTVIOLATIONRESULTS);
		$restaurantViolation->delete($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = RestaurantViolation::getAllRestaurantViolations($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("RestaurantViolation"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodquisition\\RestaurantViolation", $results);
		// grab the result from the array and validate it
		$pdoRestaurantViolation = $results[0];
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationRestaurantId(), $this->RestaurantViolationRestaurantId->getRestaurantViolationRestaurantId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationViolationId(), $this->RestaurantViolationViolationId->getRestaurantViolationViolationId());
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationMemo(), $this->VALID_RESTAURANTVIOLATIONMEMO);
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationResults(), $this->VALID_RESTAURANTVIOLATIONRESULTS);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoRestaurantViolation->getRestaurantViolationDate()->getTimestamp(), $this->VALID_RESTAURANTVIOLATIONDATE->getTimestamp());
	}
}/** this is the test END brace **/