<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AuthenticationFailedException extends Exception
{
    public function render()
    {
        return response()->json(__('auth.failed'), Response::HTTP_UNAUTHORIZED);
    }
}
