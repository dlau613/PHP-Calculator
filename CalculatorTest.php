<?php
require 'vendor/autoload.php';
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
		$this->assertEquals(valid_expression("00"), false);
		$this->assertEquals(valid_expression("4+04"), false);
		$this->assertEquals(valid_expression("4.0 + 04.04"), false);
		$this->assertEquals(valid_expression("0"), true);
		$this->assertEquals(valid_expression("      "), false);

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

	public function test_process_input() {
		// the two empty_or_zero cases
		$this->assertEquals(process_input(""),"");
		$this->assertEquals(process_input("0"),"");

		$this->assertEquals(process_input(" 0"),"0 = 0");
		$this->assertEquals(process_input("0  "),"0 = 0");
		$this->assertEquals(process_input("   0    "),"0 = 0");

		$this->assertEquals(process_input("2"),"2 = 2");
		$this->assertEquals(process_input("2."),"Invalid expression!");
		$this->assertEquals(process_input("02"),"Invalid expression!");
		$this->assertEquals(process_input("00"),"Invalid expression!");
		$this->assertEquals(process_input(".2"),"Invalid expression!");
		$this->assertEquals(process_input("0.2"),"0.2 = 0.2");
		$this->assertEquals(process_input("2.0"),"2.0 = 2");

		$this->assertEquals(process_input("-49"),"-49 = -49");
		$this->assertEquals(process_input("2+3+4"),"2+3+4 = 9");
		$this->assertEquals(process_input("2*3*-4"),"2*3*-4 = -24");
		$this->assertEquals(process_input("2*-1*-2*-3"),"2*-1*-2*-3 = -12");
		$this->assertEquals(process_input("100-100/100"),"100-100/100 = 99");
		$this->assertEquals(process_input("3/2+1/3"),"3/2+1/3 = 1.8333333333333");
		$this->assertEquals(process_input("0/0"),"Division by zero error!");
		$this->assertEquals(process_input("abcd"),"Invalid expression!");
		$this->assertEquals(process_input("one/two"),"Invalid expression!");

		$this->assertEquals(process_input("3 +4*5"),"3 +4*5 = 23");
		$this->assertEquals(process_input("3 + 4 *     5"),"3 + 4 * 5 = 23");
		$this->assertEquals(process_input("-3--4/-5"),"-3- -4/-5 = -3.8");
		$this->assertEquals(process_input("-3.2+2*4-1/3"),"-3.2+2*4-1/3 = 4.4666666666667");

		$this->assertEquals(process_input("0 / 0.0"),"Division by zero error!");
		$this->assertEquals(process_input("3 + 4 /-0 *5"),"Division by zero error!");
		$this->assertEquals(process_input("3 + 4 /-0.02 *5"),"3 + 4 /-0.02 *5 = -997");
	


	}
}
?>

