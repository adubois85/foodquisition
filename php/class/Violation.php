<?php
namespace Edu\Cnm\Foodquisition;

require_once("autoload.php");

/**
 * Violation
 *
 * @author Danielle Branch <dbranch82@gmail.com>
 * @version 1.0
 **/
class Violation implements \JsonSerializable {

	 private $violationId;
	/**
	 * id for this Violation; this is the primary key
	 * will be auto-incrementing
	 * @var int $violationCategoryId
	 *
	 **/
	private $violationCategoryId;
	/**
	 *
	 * @var string $violationCode
	 *
 	*/
	private $violationCode;
	/**
	 *
	 *
	 * @var string $violationCodeDescription
	 */
	private $violationCodeDescription;
	/**
	 * Constructor for Violation
	 *
	 *
	 */
}

