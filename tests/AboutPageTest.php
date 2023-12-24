<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class AboutPageTest extends TestCase {
    public function testAboutPageAddition() {
        $client = new Client();

        try {
            $response = $client->request('POST', 'http://localhost/RealEstate-PHP/admin/aboutadd.php', [
                'multipart' => [
                    [
                        'name' => 'addabout',
                        'contents' => 'addabout'
                    ],
                    [
                        'name' => 'title',
                        'contents' => 'Test Title'
                    ],
                    [
                        'name' => 'content',
                        'contents' => '<div id="pgc-w5d0dcc3394ac1-0-0" class="panel-grid-cell">
                        <div id="panel-w5d0dcc3394ac1-0-0-0" class="so-panel widget widget_sow-editor panel-first-child panel-last-child" data-index="0">
                        <div class="so-widget-sow-editor so-widget-sow-editor-base">
                        <div class="siteorigin-widget-tinymce textwidget">
                        <p>Welcome to Starlink Properties, where your dreams of finding the perfect home take flight. As a leading real estate company, we are dedicated to connecting you with the stars of the property market, guiding you on a journey to your ideal living space.</p>
                        <p>At Starlink Properties, we understand that a home is more than just bricks and mortar; it is a place where memories are made and futures are built. Our team of skilled and passionate professionals is committed to providing unparalleled service, ensuring your real estate experience is smooth, stress-free, and rewarding.</p>
                        <p>With an extensive portfolio of exquisite properties and a keen eye for market trends, we offer a galaxy of options to suit every taste and budget. Whether you are a first-time homebuyer, a seasoned investor, or looking to sell your property, our personalized approach will cater to your unique needs and preferences.</p>
                        <p>Integrity, transparency, and customer satisfaction are the guiding stars of our business. We prioritize building lasting relationships with our clients, earning their trust through open communication and expert guidance. Our dedication to excellence has positioned us as a shining star in the real estate constellation.</p>
                        <p>Discover the stellar service and exceptional properties that Starlink Properties has to offer. Explore our listings or reach out to our friendly team today, and let us help you navigate the cosmos of real estate, bringing you one step closer to the home of your dreams.</p>
                        </div>
                        </div>
                        </div>
                    </div>',
                    ],
                    [
                        'name' => 'aimage',
                        'contents' => fopen('admin/upload/condos-pool.png', 'r') // Provide the correct path here
                    ]
                ]
            ]);
            
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
        }
        
        // Perform assertions for successful addition
        $this->assertEquals(200, $response->getStatusCode());
        $htmlContent = (string) $response->getBody();
        $this->assertStringContainsString('alert alert-success', $htmlContent);
    }
}

?>