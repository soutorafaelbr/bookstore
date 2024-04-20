<?php

namespace App\Utils\Authentication\DTOS;

class AuthenticateUserDTO
{
    public function __construct(public string $email, public string $password) {}

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
