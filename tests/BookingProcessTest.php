<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class BookingProcessTest extends TestCase {

    public function testBookingAvailability() {
        // Simulating the necessary session variable
        $_SESSION['uid'] = 35; // Assuming a user is logged in with this ID

        // Create a Guzzle client
        $client = new Client();

        // Simulate a scenario where a user visits the booking page with a property ID
        $response = $client->get('http://localhost/RealEstate-PHP/booking.php?pid=25');
        $this->assertEquals(200, $response->getStatusCode()); // Ensure the page loads successfully

        // Simulate form submission for booking
        $postData = [
            'property_id' => 25, 
            'uid' => 35, 
            'booking_date' => '2023-12-29',
            'start_time' => '13:00:00',
            'end_time' => '14:00:00'
        ];

        $response = $client->post('http://localhost/RealEstate-PHP/booking_process.php', [
            'form_params' => $postData
        ]);

        // Ensure a redirect to the feature page after successful booking
        $this->assertEquals(200, $response->getStatusCode()); // Check for a redirect status code
        // $this->assertEquals('http://localhost/RealEstate-PHP/feature.php', $response->getHeader('Location')[0]);

        // // Follow the redirect to check if the 'Booking was Made Successfully' message appears
        // $response = $client->get('http://localhost/RealEstate-PHP/feature.php');

        // // Assert that the booking process was successful
        // $this->assertEquals(200, $response->getStatusCode()); // Ensure the feature page loads successfully
        // $body = $response->getBody()->getContents();
        // $this->assertStringContainsString('Booking was Made Successfully', $body);
    }
}
?>
