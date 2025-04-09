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
            'first_name' => 'Николай',
            'second_name' => 'Иванов',
            'last_name' => 'Стоилов',
            'faculty_number' => '121221208',
            'major'=>'КСИ',
            'email' => 'stoilov12@gmail.com',
            'phone'=>'0889453666',
            'username' => 'stoilov12',
            'password' => Hash::make('123456'),
        ]);

        Student::create([
            'first_name' => 'Георги',
            'second_name' => 'Ангелов',
            'last_name' => 'Йорданов',
            'faculty_number' => '121221198',
            'major'=>'КСИ',
            'email' => 'gyordanov12@gmail.com',
            'phone'=>'0887562499',
            'username' => 'gyordanov12',
            'password' => Hash::make('123456'),
        ]);
        Student::create([
            'first_name' => 'Николай',
            'second_name' => 'Стоянов',
            'last_name' => 'Вълчев',
            'faculty_number' => '121221105',
            'major'=>'КСИ',
            'email' => 'nvulchev@gmail.com',
            'phone'=>'0884532111',
            'username' => 'nvulchev13',
            'password' => Hash::make('123456'),
        ]);
    }
}
