<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login()
    {
        // GET non valide
        $response = $this->get('api/login');
        $response->assertStatus(405);

        // Pas de donnée envoyé
        $response = $this->post('api/login');
        $response->assertStatus(422);

        // User non trouvé
        $response = $this->post('api/login', ['email' => 'test@test.com', 'password' => 'password']);
        $response->assertStatus(400);

        // Creation User et Verif du login
        $user = User::factory()->make();
        $mail = $user->email;
        $user->save();
        $response = $this->post('api/login', ['email' => $mail, 'password' => 'password']);
        $response->assertStatus(200);
        // Vérification que le token est bien présent
        $this->assertTrue(!!json_decode($response->content(), true)['accessToken']);
    }
}
