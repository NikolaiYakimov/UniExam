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
            'first_name' => 'Иван',
            'second_name' => 'Георгиев',
            'last_name' => 'Стоянов',
            'title' => 'доц.',
            'username' => 'istoqnov',
            'password' => Hash::make('123456'),
            'email' => 'istoqnov@gmail.com',
            'phone' => '0883645666',
        ]);
        Teacher::create([
            'first_name' => 'Георги',
            'second_name' => 'Василев',
            'last_name' => 'Дамянов',
            'title' => 'доц.',
            'username' => 'gdamqnov',
            'password' => Hash::make('123456'),
            'email' => 'gdamqnov@gmail.com',
            'phone' => '0883645789',
        ]);
    }
}
