<?php

namespace Database\Seeders;

use App\Models\Typeoftrip;
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
        $this->call(TypeoftripsSeeder::class);
        $this->call(UserSeeder::class);
    }
}
