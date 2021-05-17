<?php

namespace Database\Seeders;

use App\Models\Idioma;
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
        if(!User::query()->first())
            $this->call(UserSeeder::class);
        if(!Idioma::query()->first())
            $this->call(IdiomaSeeder::class);
    }
}
