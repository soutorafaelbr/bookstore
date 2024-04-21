<?php

namespace App\Domains\Books\DTOS;

class PersistBookDTO
{
    public function __construct(
        public string $name,
        public int $isbn,
        public float $value
    ) {}
}
