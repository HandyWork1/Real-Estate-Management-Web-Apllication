<?php
use PHPUnit\Framework\TestCase;

class PropertyGridTest extends TestCase {
    
    public function testPropertyGridDisplay() {
        // Simulated form data
        $_REQUEST['filter'] = true;
        $_REQUEST['type'] = 'House';
        $_REQUEST['stype'] = 'sale';
        $_REQUEST['city'] = 'Nairobi'; 
        
        ob_start(); // Start output buffering to capture HTML output
        
        include('propertygrid.php');
        
        // Get the contents of the output buffer
        $output = ob_get_contents();
        
        ob_end_clean(); // Clean (erase) the output buffer
        
        // Check if the output contains a certain HTML element/class/text to validate the display
        $this->assertStringContainsString('Valley Haven Home', $output);
        $this->assertStringContainsString('For sale', $output);
        $this->assertStringContainsString('Ksh', $output);
        $this->assertStringContainsString('Hurlingham Court', $output);

    }
    public function testFailPropertyGridDisplay() {
        // Simulated form data
        $_REQUEST['filter'] = true;
        $_REQUEST['type'] = 'Apartment';
        $_REQUEST['stype'] = 'sale';
        $_REQUEST['city'] = 'Nairobi'; 
        
        ob_start(); // Start output buffering to capture HTML output
        
        include('propertygrid.php');
        
        // Get the contents of the output buffer
        $output = ob_get_contents();
        
        ob_end_clean(); // Clean (erase) the output buffer
        
        // Check if the output contains a certain HTML element/class/text to validate the display
        $this->assertStringContainsString('No Property Available', $output);

    }
}

?>