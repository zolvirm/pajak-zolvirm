<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemilik>
 */
class PemilikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => Str::upper(fake()->name()),
            'dusun' => fake()->streetName(),
            'RT' => mt_rand(1, 8),
            'RW' => '3',
            'alamat' => fake()->address()
        ];
    }
}
