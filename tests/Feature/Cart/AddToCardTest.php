<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AddToCardTest extends TestCase
{
    /**
     * Test adding products to the cart.
     */

    // Simulate a request with email and cart content
    public function testAddToCart()
    {
        // Simulate a request with email and cart content as a JSON string
        $data = [
            'email' => 'tester@gmail.com',
            'cart' => [
                "product_code" => "256asd",
                "product_category" => "Fan Motor",
                "brand" => "SWJ",
                "brand_code" => "AM-003",
                "quantity" => 4         
            ],
        ];

        // Make a POST request to your API endpoint
        $response = $this->json('POST', '/api/user/add-to-cart', $data);

        // Assert that the response has a successful status code
        $response->assertStatus(Response::HTTP_OK);
    }

}
