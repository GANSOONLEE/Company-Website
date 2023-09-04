<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServerStressTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_server_stress()
    {
        for ($i = 0; $i < 1000; $i++) {
            $response = $this->get('/');
            $response->assertStatus(200);
            dump($i);
        }
    }
}
