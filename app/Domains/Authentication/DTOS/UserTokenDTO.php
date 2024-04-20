<?php

namespace App\Domains\Authentication\DTOS;

class UserTokenDTO
{
    public function __construct(public string $token) {}
}
