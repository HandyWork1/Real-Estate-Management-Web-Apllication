<?php
use PHPUnit\Framework\TestCase;

class InstallmentCalculatorTest extends TestCase {
    public function testInstallmentCalculator() {
        // Mock your form data
        $_REQUEST['calc'] = true;
        $_REQUEST['amount'] = 10000;
        $_REQUEST['month'] = 12;
        $_REQUEST['interest'] = 5;

        // Include the script containing the installment calculator logic
        include('calc.php');

        // Assert the calculated values
        $this->assertEquals(500, $interest);
        $this->assertEquals(10500, $pay);
        $this->assertEquals(875, $month);
    }
}

?>