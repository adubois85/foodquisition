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
	 * @var
	 *
	 */
	protected $category = null;

	/**
	 * valid category hash to create the profile object to own the test
	 * @var $VALID_HASH;

	/**
	 * @var string
	 *
	 * content of violation
	 * @var string $VALID_VIOLATIONCONTENT
	 *
	 */

	protected $VALID_PROFILE_HASH;

	/**
	 * valid salt to use to create the profile object to own the test
	 * @var string $VALID_SALT
	 *
	 */
	protected $VALID_PROFILE_SALT;

	protected $VALID_VIOLATIONCONTENT = "PHPUnit test passing";

	/**
	 * content of the updated Violation
	 * @var string $VALID_VIOLATONCONTENT2
	 *
	 */
	protected $VALID_VIOLATIONCONTENT2 = "PHPUnit test still passing";

	/**
	 *
	 *
	 *
	 *
	 */
}