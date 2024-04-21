<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'isbn' => $this->faker->randomNumber(),
            'value' => 10.00,
        ];
    }
}
