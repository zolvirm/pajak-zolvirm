<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\LaravelIgnition\Support\Composer\FakeComposer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pajak>
 */
class PajakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'NOP' => "3521040007" . fake()->unique()->randomNumber(7, true) . '0',
            'nama' => Str::upper(fake()->name()),
            'tahun' => fake()->year(),
            'yang_harus_dibayar' => mt_rand(700, 500000),
            'pemilik_id' => mt_rand(0, 10),
            'status_id' => mt_rand(0, 1)
        ];
    }
}
