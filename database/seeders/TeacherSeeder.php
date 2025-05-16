<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'user_id' => 4,
            'title' => 'доц.',
            'department'=>'Информатика',
            'faculty'=>'ФКСТ',

        ]);
        Teacher::create([
            'user_id' => 5,
            'title' => 'проф.',
            'department'=>'Математика',
            'faculty'=>'ФКСТ',
        ]);
    }
}
