<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pajak;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'kadal',
            'username' => 'kadalbangkok',
            'email' => 'test@example.com',
            'password' => bcrypt('kadal')
        ]);

        // User::factory(2)->create();

        // Pajak::factory(20)->create();

        // Pemilik::factory(10)->create();
    }
}
