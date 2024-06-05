<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =  [
            [
                'name' => 'General Knowledge',
                'status' => '1'
            ],

            [
                'name' => 'IT',
                'status' => '1'
            ],

            [
                'name' => 'Digital Marketing',
                'status' => '1'
            ],

            [
                'name' => 'Cyber Security',
                'status' => '1'
            ]
        ];

        Category::insert($categories);
    }
}
