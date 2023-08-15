<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// class ExampleTest extends TestCase
// {
//     /**
//      * A basic test example.
//      */
//     public function test_the_application_returns_a_successful_response(): void
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }
// }

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function indexPage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/about-us');
        $response->assertStatus(200);

        $response = $this->get('/contact');
        $response->assertStatus(200);
        
        $response = $this->get('/product');
        $response->assertStatus(200);
    }
}