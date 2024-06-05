<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $students = [
            [
                'name' => 'student',
                'email' => 'student@gmail.com',
                'password' => bcrypt('student'),
            ],
            [
                'name' => 'student1',
                'email' => 'student1@gmail.com',
                'password' => bcrypt('student'),
            ]
        ];

        Student::insert($students);
    }
}
