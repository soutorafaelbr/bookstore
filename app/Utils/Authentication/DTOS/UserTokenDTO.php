<?php

namespace App\Utils\Authentication\DTOS;

class UserTokenDTO
{
    public function __construct(public string $token) {}
}
