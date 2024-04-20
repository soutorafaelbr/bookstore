<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AuthenticateRequest;
use App\utils\Authentication\DTOS\AuthenticateUserDTO;
use App\utils\Authentication\DTOS\UserTokenDTO;
use App\utils\Authentication\Services\AuthenticateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateUserController
{
    public function __invoke(AuthenticateRequest $request, AuthenticateUserService $authenticateUserService): JsonResponse
    {
        $userTokenDTO = $authenticateUserService->execute(
            new AuthenticateUserDTO(
                email: $request->get('email'),
                password: $request->get('password')
            )
        );

        return response()->json(['token' => $userTokenDTO->token], JsonResponse::HTTP_OK);
    }
}
