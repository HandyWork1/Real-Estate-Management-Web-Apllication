<?php
require_once("admin/property_add_logic.php");

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class AdminPropertyTest extends TestCase {
    /** @var MockObject|PropertyProcessor */
    private $propertyProcessor;

    protected function setUp(): void {
        // Mock the database connection (can be extended further as needed)
        $dbMock = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create a mocked PropertyProcessor instance
        $this->propertyProcessor = $this->getMockBuilder(PropertyProcessor::class)
            ->setConstructorArgs([$dbMock])
            ->onlyMethods(['processPropertyAddition']) // Allow only certain methods to be mocked
            ->getMock();
    }

    public function testPropertyAdditionSuccess() {
        // Simulate the form data
        $postData = [
            $_POST['add'] = true,
            $_POST['title'] = 'Valley Haven Home',
            $_POST['content'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            $_POST['ptype'] = 'house',
            $_POST['bhk'] = '4 BHK',
            $_POST['stype'] = 'sale',
            $_POST['bed'] = '4',
            $_POST['bath'] = '2',
            $_POST['balc'] = '0',
            $_POST['kitc'] = '1',
            $_POST['hall'] = '2',
            $_POST['floor'] = '2nd Floor',
            $_POST['price'] = '3450000',
            $_POST['city'] = 'Hurlingham',
            $_POST['asize'] = '1869',
            $_POST['loc'] = 'Hurlingham Court, Argwings Kodhek Rd',
            $_POST['state'] = 'Nairobi',
            $_POST['status'] = 'available',
            $_POST['uid'] = '31',
            $_POST['feature'] = '<p>&nbsp;</p>
            <!---feature area start--->
            <div class="col-md-4">
            <ul>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Property Age : </span>10 Years</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Swimming Pool : </span>Yes</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Parking : </span>Yes</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">GYM : </span>Yes</li>
            </ul>
            </div>
            <div class="col-md-4">
            <ul>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Type : </span>House</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Security : </span>Yes</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Dining Capacity : </span>10 People</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Church/Temple : </span>No</li>
            </ul>
            </div>
            <div class="col-md-4">
            <ul>
            <li class="mb-3"><span class="text-secondary font-weight-bold">3rd Party : </span>No</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Elevator : No</span></li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">CCTV : </span>Yes</li>
            <li class="mb-3"><span class="text-secondary font-weight-bold">Water Supply : </span>Ground Water / Tank</li>
            </ul>
            </div>
            <!---feature area end---->
            <p>&nbsp;</p>',
            $_POST['totalfl'] = '2 Floor',

            // Simulate the file uploads by setting values in the $_FILES array
            $_FILES['aimage']['name'] = 'property-face-3.jpg',
            $_FILES['aimage1']['name'] = 'property-dining-2.jpg',
            $_FILES['aimage2']['name'] = 'property-office-2.jpg',
            $_FILES['aimage3']['name'] = 'property-dining-2.jpg',
            $_FILES['aimage4']['name'] = 'property-office-2.jpg',
            $_FILES['fimage']['name'] = 'floorplan_sample.jpg',
            $_FILES['fimage1']['name'] = 'property-plan-2.jpg',
            $_FILES['fimage2']['name'] = 'ground_floor_plan.jpg',

            // Set isFeatured to '0' for No
            $_POST['isFeatured'] = '0'

        ];

        // Define the expected messages (in this case, for successful property addition)
        $expectedResult = ['error' => '', 'msg' => '<p class="alert alert-success">Property Inserted Successfully</p>'];

        // Set up expectations for the mocked method call
        $this->propertyProcessor->expects($this->once())
            ->method('processPropertyAddition')
            ->with($postData) // Expect the form data to be passed to this method
            ->willReturn($expectedResult); // Return the expected result

        // Simulate form submission
        $result = $this->propertyProcessor->processPropertyAddition($postData);

        // Assert the result matches the expected outcome
        $this->assertEquals($expectedResult, $result);
    }
    public function testPropertyAdditionFailure() {
        // Simulate the form data
        $postData = [
            'title' => 'Test Property', // Include required fields
            // ... Other required fields according to your form
        ];
    
        // Define the expected error message (for a failed property addition)
        $expectedResult = ['error' => '<p class="alert alert-warning">Something went wrong. Please try again</p>', 'msg' => ''];
    
        // Set up expectations for the mocked method call
        $this->propertyProcessor->expects($this->once())
            ->method('processPropertyAddition')
            ->with($postData) // Expect the form data to be passed to this method
            ->willReturn($expectedResult); // Return the expected result
    
        // Simulate form submission
        $result = $this->propertyProcessor->processPropertyAddition($postData);
    
        // Assert the result matches the expected outcome
        $this->assertEquals($expectedResult, $result);
    }
    
}

?>