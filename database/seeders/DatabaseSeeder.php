<?php

namespace Database\Seeders;

use App\Shared\Infrastructure\Laravel\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(5)->create();
    }
}
