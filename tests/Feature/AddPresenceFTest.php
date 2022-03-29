<?php

namespace Tests\Feature;

use Database\Factories\EmployeeFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddPresenceFTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddNewPresenceSuccess()
    {
        $response = $this->post('/presence/register');

        $response->assertStatus(200);
    }
}
