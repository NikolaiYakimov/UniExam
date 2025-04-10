<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'first_name' => 'Геиорги',
            'second_name' => 'Димитров',
            'last_name' => 'Данов',
            'faculty_number' => '121221221',
            'major'=>'КСИ',
            'email' => 'gdanov12@gmail.com',
            'phone'=>'0889458777',
            'username' => 'gdanov12',
            'password' => Hash::make('123456'),
        ]);

        Student::create([
            'first_name' => 'Виктор',
            'second_name' => 'Ангелов',
            'last_name' => 'Стоименов',
            'faculty_number' => '121221121',
            'major'=>'КСИ',
            'email' => 'vstoimenov12@gmail.com',
            'phone'=>'0884523566',
            'username' => 'vstoimenov12',
            'password' => Hash::make('123456'),
        ]);

    }
}
