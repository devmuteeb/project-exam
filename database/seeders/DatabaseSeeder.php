<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(StudentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AdminSeeder::class);
    }
}
