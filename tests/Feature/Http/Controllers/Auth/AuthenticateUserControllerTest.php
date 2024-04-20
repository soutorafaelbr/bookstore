<?php

namespace Http\Controllers\Auth;

use App\Exceptions\AuthenticationFailedException;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticateUserControllerTest extends TestCase
{
    use WithFaker;

    public function test_authenticate_user()
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $this->postJson(route('auth.user'), ['email' => $user->email, 'password' => 'password'])
            ->assertOk();

        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_authentication_failed_responds_with_unauthorized()
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $this->postJson(route('auth.user'), ['email' => $user->email, 'password' => '123456'])
            ->assertUnauthorized();
    }

    public function test_responds_with_token()
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $this->postJson(route('auth.user'), ['email' => $user->email, 'password' => 'password'])
            ->assertJsonStructure(['token']);
    }

    public function test_responds_with_invalid_email()
    {
        $this->postJson(route('auth.user'), [
            'email' => 'randomString',
            'password' => 'randomPassword',
        ])->assertJsonValidationErrors(['email' => 'email']);
    }

    public function test_requires_email()
    {
        $this->postJson(route('auth.user'), [
            'email' => null,
            'password' => 'randomPassword',
        ])->assertJsonValidationErrors(['email' => 'required']);
    }

    public function test_requires_password()
    {
        $this->postJson(route('auth.user'), [
            'email' => 'atlas@atlastechno.com',
            'password' => null,
        ])->assertJsonValidationErrors(['password' => 'required']);
    }

    public function test_responds_with_not_found_when_user_does_not_exist()
    {
        $this->postJson(route('auth.user'), [
            'email' => 'atlas@atlastechno.com',
            'password' => 'randomPassword',
        ])->assertNotFound();
    }

    public function test_responds_with_unauthorized_when_credentials_does_not_exist()
    {
        $user = User::factory()->create();

        $this->postJson(route('auth.user'), [
            'email' => $user->email,
            'password' => 'randomPassword',
        ])->assertUnauthorized();
    }
}
