<?php
// require_once 'PHPUnit/Framework/TestCase.php';
// require __DIR__ . '/vendor/autoload.php';
require 'vendor/autoload.php';
// use PHPUnit\Framework\TestCase;
// include 'calculator.php';
require_once('calculator.php');

class CalculatorTest extends PHPUnit_Framework_TestCase
{
	public function test_valid_expression() {
		$this->assertEquals(valid_expression("4"), true);
		$this->assertEquals(valid_expression("  4   "), true);
		$this->assertEquals(valid_expression("4.000"), true);
		$this->assertEquals(valid_expression("4.000 +"), false);
		$this->assertEquals(valid_expression(".4"), false);
		$this->assertEquals(valid_expression(".4 + 3"), false);
		$this->assertEquals(valid_expression("4+3"), true);
		$this->assertEquals(valid_expression("4 +3"), true);
		$this->assertEquals(valid_expression("4 + 3"), true);
		$this->assertEquals(valid_expression(" 4  +  3 "), true);
		$this->assertEquals(valid_expression(" 4 +- 3 "), false);
		$this->assertEquals(valid_expression("4 + -3"), true);
		$this->assertEquals(valid_expression("4+-3"), true);
		$this->assertEquals(valid_expression("4 + -0"), true);
		$this->assertEquals(valid_expression(" 4. *  3 "), false);
		$this->assertEquals(valid_expression("4 + 3/0 "), true);
		$this->assertEquals(valid_expression("4 + 3./0"), false);
		$this->assertEquals(valid_expression("4 / 0"), true);
		$this->assertEquals(valid_expression("4 / 0."), false);
		$this->assertEquals(valid_expression("4.0 / "), false);
		$this->assertEquals(valid_expression("3+4*5"), true);
		$this->assertEquals(valid_expression("3+-4*-5"), true);
		$this->assertEquals(valid_expression("-3--4/-5"), true);
		$this->assertEquals(valid_expression("-3+--5"), false);
		$this->assertEquals(valid_expression("-3--4/-5"), true);
		$this->assertEquals(valid_expression("abc"), false);
		$this->assertEquals(valid_expression("one/two"), false);
		$this->assertEquals(valid_expression("4a"), false);
		$this->assertEquals(valid_expression("4/3.e"), false);
		$this->assertEquals(valid_expression("4/3. +"), false);
		$this->assertEquals(valid_expression("4 - 5.0 + 0."), false);
		$this->assertEquals(valid_expression("4 / - 3.2"), false);
		$this->assertEquals(valid_expression("2d4+1"), false);
		$this->assertEquals(valid_expression("4 / .3"), false);
		$this->assertEquals(valid_expression("4 / -.3"), false);

	}
	public function test_divide_by_zero() {
		$this->assertEquals(division_by_zero("4/0"), true);
		$this->assertEquals(division_by_zero("4/-0"), true);
		$this->assertEquals(division_by_zero("4/ -0"), true);
		$this->assertEquals(division_by_zero("4/ -0.00"),true);
		$this->assertEquals(division_by_zero("4/ -0.02"),false);
		$this->assertEquals(division_by_zero("4/ -0.02 + 4"),false);
		$this->assertEquals(division_by_zero("4/ -0.2 "),false);
		$this->assertEquals(division_by_zero("4- -0.00"),false);
		$this->assertEquals(division_by_zero("4/0 + 5"), true);
		$this->assertEquals(division_by_zero("4 / 0 "), true);
		$this->assertEquals(division_by_zero("4/0.2"),false);
		$this->assertEquals(division_by_zero("4.0/0.0"),true);
		$this->assertEquals(division_by_zero("4.0/0.02"),false);
	}
}
?>

