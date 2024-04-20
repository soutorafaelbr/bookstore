<?php

namespace Http\Controllers\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogOutControllerTest extends TestCase
{
    public function test_log_out()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $this->postJson(route('auth.logout'))->assertOk();
    }

    public function test_user_unauthenticated_can_not_log_out()
    {
        $this->postJson(route('auth.logout'))->assertUnauthorized();
    }
}
