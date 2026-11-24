<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * Sesuai ketentuan, fitur registrasi ditiadakan (hanya login).
     * Mengakses /register diarahkan kembali ke /login.
     */
    public function test_registration_is_disabled_and_redirects_to_login(): void
    {
        $response = $this->get('/register');

        $response->assertRedirect(route('login'));
    }
}
