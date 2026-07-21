<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_user_can_login_successfully_with_valid_credentials(): void
    {
        // 1. Arrange
        $user = User::factory()->create([
            'email'    => 'usuario@ejemplo.com',
            'password' => Hash::make('PasswordSegura123'),
        ]);

        // 2. Act
        $response = $this->postJson('/api/v1/login', [
            'email'    => 'usuario@ejemplo.com',
            'password' => 'PasswordSegura123',
        ]);

        // 3. Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                    ],
                    'token',
                ],
            ])
            ->assertJson([
                'message' => 'Inicio de sesión exitoso',
                'data' => [
                    'user' => [
                        'id'    => $user->id,
                        'email' => 'usuario@ejemplo.com',
                    ],
                ],
            ]);

        $this->assertNotEmpty($response->json('data.token'));
    }

    #[Test]
    public function test_login_fails_when_password_is_incorrect(): void
    {
        // Arrange
        User::factory()->create([
            'email'    => 'usuario@ejemplo.com',
            'password' => Hash::make('PasswordSegura123'),
        ]);

        // Act
        $response = $this->postJson('/api/v1/login', [
            'email'    => 'usuario@ejemplo.com',
            'password' => 'PasswordIncorrecta',
        ]);

        // Assert
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Las credenciales ingresadas son incorrectas.',
            ]);
    }

    #[Test]
    public function test_login_fails_when_user_does_not_exist(): void
    {
        // Act
        $response = $this->postJson('/api/v1/login', [
            'email'    => 'inexistente@ejemplo.com',
            'password' => 'CualquierPassword123',
        ]);

        // Assert
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Las credenciales ingresadas son incorrectas.',
            ]);
    }

    #[Test]
    public function test_login_fails_validation_when_fields_are_missing(): void
    {
        // Act
        $response = $this->postJson('/api/v1/login', []);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }
}