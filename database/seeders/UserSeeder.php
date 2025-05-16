<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Николай',
            'second_name' => 'Иванов',
            'last_name' => 'Стоилов',
            'phone'=>'0889453666',
            'username' => 'stoilov12',
            'email' => 'stoilov12@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'student',
        ]);

        User::create([
            'first_name' => 'Георги',
            'second_name' => 'Ангелов',
            'last_name' => 'Йорданов',
            'phone'=>'0886789453',
            'username' => 'jordanov11',
            'email' => 'jordanov12@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'student',
        ]);

        User::create([
            'first_name' => 'Николай',
            'second_name' => 'Стоянов',
            'last_name' => 'Вълчев',
            'phone'=>'0884532111',
            'username' => 'nvulchev13',
            'email' => 'nvulchev@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'student',
        ]);

        User::create([
            'first_name' => 'Стоян',
            'second_name' => 'Андреев',
            'last_name' => 'Иванов',
            'phone'=>'0886423777',
            'username' => 'sivanov13',
            'email' => 'sivanov13@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'teacher',
        ]);

        User::create([
            'first_name' => 'Николай',
            'second_name' => 'Андреев',
            'last_name' => 'Марянов',
            'phone'=>'0884238412',
            'username' => 'nmarqnov14',
            'email' => 'nmarqnov14@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'teacher',
        ]);

        User::create([
            'first_name' => 'Admin',
            'second_name' => 'Admin',
            'last_name' => 'Admin',
            'phone'=>'0884445555',
            'username' => 'administrator',
            'email' => 'administrator@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'administrator',
        ]);
    }
}
