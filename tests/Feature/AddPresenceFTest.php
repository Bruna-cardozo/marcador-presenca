<?php

namespace Tests\Feature;

use Tests\TestCase;

class AddPresenceFTest extends TestCase
{
    /**
     * @return void
     */
    public function testAddNewPresenceSuccess()
    {
        $response = $this->json(
            'POST',
            '/presence/register',
            ['cpf' => '12345678910']
        );

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Presença registrada com sucesso']);
    }
}
