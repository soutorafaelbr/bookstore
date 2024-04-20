<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Authentication\DTOS\AuthenticateUserDTO;
use App\Domains\Authentication\Services\AuthenticateUserService;
use App\Http\Requests\Auth\AuthenticateRequest;
use Illuminate\Http\JsonResponse;

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
