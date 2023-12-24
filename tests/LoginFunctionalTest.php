<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class LoginFunctionalTest extends TestCase {
    
    public function testSuccessfulLogin() {
        $client = new Client([
            'allow_redirects' => true,
            'cookies' => true
        ]);
        $response = $client->request('POST', 'http://localhost/RealEstate-PHP/login.php', [
            'form_params' => [
                'login' => 'login',
                'email' => 'michael@mail.com',
                'pass' => '123456'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode()); // Ensure redirection

    }

    public function testInvalidLogin() {
        $client = new Client();
    
        try {
            $response = $client->request('POST', 'http://localhost/RealEstate-PHP/login.php', [
                'form_params' => [
                    'email' => 'invalid@email.com',
                    'pass' => 'invalid_password',
                    'login' => 'login' // Simulating the form submission by including the 'login' parameter
                ]
            ]);
    
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
        }
    
        $this->assertEquals(401, $response->getStatusCode()); // Ensure redirection
    
        // Get the final response after redirections
        $statusCode = $response->getStatusCode();
        $htmlContent = (string) $response->getBody();
        
        $error = 'Email or Password does not match!';
        // Check for the specific alert class and message within the HTML content
        $this->assertStringContainsString($error, $htmlContent);
    }
    
    
}

?>
