<?php

namespace App\utils\Authentication\DTOS;

class UserTokenDTO
{
    public function __construct(public string $token) {}
}
