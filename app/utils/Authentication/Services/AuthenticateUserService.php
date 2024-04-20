<?php

namespace App\utils\Authentication\Services;

use App\Exceptions\AuthenticationFailedException;
use App\Models\User;
use App\utils\Authentication\DTOS\AuthenticateUserDTO;
use App\utils\Authentication\DTOS\UserTokenDTO;
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
