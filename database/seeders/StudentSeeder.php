<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'user_id' => 1,
            'faculty_number' => '121221208',
            'faculty'=>'ФКСТ',
            'major'=>'КСИ',
            'semester'=>'3',
            'group'=>'42',

        ]);

        Student::create([
            'user_id' => 2,
            'faculty_number' => '121221200',
            'faculty'=>'ФКСТ',
            'major'=>'ИТИ',
            'semester'=>'5',
            'group'=>'45',
        ]);
        Student::create([
            'user_id' => 3,
            'faculty_number' => '121221105',
            'faculty'=>'ФКСТ',
            'major'=>'КСИ',
            'semester'=>'5',
            'group'=>'43',
        ]);
    }
}
