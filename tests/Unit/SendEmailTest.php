<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testStoreMethod()
    {
        $response = $this->post('/api/subscribe', [
            'email' => 'axun0402@gmail.com',
        ]);

        $response->assertStatus(200);
    }
}
