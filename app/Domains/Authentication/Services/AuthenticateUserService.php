<?php

namespace App\Domains\Authentication\Services;

use App\Domains\Authentication\DTOS\AuthenticateUserDTO;
use App\Domains\Authentication\DTOS\UserTokenDTO;
use App\Exceptions\AuthenticationFailedException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserService
{
    public function execute(AuthenticateUserDto $dto): UserTokenDTO
    {
        $user = User::query()->whereEmail($dto->email)->firstOrFail();

        throw_unless(Auth::attempt($dto->toArray()), AuthenticationFailedException::class);

        return new UserTokenDTO(token: $user->createToken($user->name)->plainTextToken);
    }
}
