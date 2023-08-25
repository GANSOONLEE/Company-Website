<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateCartTest extends TestCase
{

    // Simulate a request with email and cart content
    public function testUpdateCart()
    {
        // Simulate a request with email and cart content as a JSON string
        $data = [
            'email' => 'tester@gmail.com',
            "product_code" => "swj-001",
            "product_brand_code" => "swj",
            "quantity" => 2
        ];

        // Make a POST request to your API endpoint
        $response = $this->json('POST', '/api/update-cart-quantity', $data);

        // Assert that the response has a successful status code
        $response->assertStatus(Response::HTTP_OK);
    }
}
