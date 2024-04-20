<?php

namespace Services;

use App\Domains\Authentication\DTOS\AuthenticateUserDTO;
use App\Domains\Authentication\Services\AuthenticateUserService;
use App\Exceptions\AuthenticationFailedException;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class AuthenticateUserServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app[AuthenticateUserService::class];
    }

    public function test_authenticates_user()
    {
        $user = User::factory()->hashedPassword($password = 123456789)->create();

        $this->service->execute(new AuthenticateUserDTO(email: $user->email, password: $password));

        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_responds_with_token()
    {
        $user = User::factory()->hashedPassword($password = 123456789)->create();

        $this->assertNotNull($this->service->execute(new AuthenticateUserDTO(email: $user->email, password: $password)));
    }

    public function test_throws_exception_when_data_do_not_match_in_database()
    {
        $this->expectException(AuthenticationFailedException::class);

        $user = User::factory()->create();

        $this->service->execute(new AuthenticateUserDTO(email: $user->email, password: 'pointhafinga'));
    }

    public function test_user_not_found_responds_with_exception()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->service->execute(new AuthenticateUserDTO(email: 'pac@pac.com', password: 'pointhafinga'));
    }
}
