<?php
namespace Edu\Cnm\Foodquisition;

require_once("autoload.php");

/**
 * Small Cross Section of a Violation
 *

 * @author Danielle Branch <dbranch82@gmail.com>
 * @version 4.0.1
 **/
class Violation implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Violation; this is the primary key
	 * @var int $ViolationId
	 **/

