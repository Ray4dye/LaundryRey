<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Pendaftaran Akun Petugas Baru');
        $response->assertSee('Laundry Rey');
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Petugas Laundry Baru',
            'email' => 'petugasbaru@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'kasir',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertDatabaseHas('users', [
            'email' => 'petugasbaru@gmail.com',
            'role' => 'kasir',
        ]);
    }
}
