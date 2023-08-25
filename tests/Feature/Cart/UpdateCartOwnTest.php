<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

// /api/update-cart-own

class UpdateCartOwnTest extends TestCase
{
    /**
     * Test adding products to the cart.
     */

    // Simulate a request with email and cart content
    public function testUpdateCartOwn()
    {
        // Simulate a request with email and cart content as a JSON string
        $data = [
            "orderID" => "tester@gmail.com",
            'product_code' => '256asd',
            'product_brand_code' => '',
            "own" => 2
        ];

        // Make a POST request to your API endpoint
        $response = $this->json('POST', '/api/update-cart-own', $data);

        // Assert that the response has a successful status code
        $response->assertStatus(Response::HTTP_OK);
    }
}
