<?php

namespace Database\Seeders;

use App\Models\ExamHall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamHall::create(['name' => '1151','capacity' => 150,]);
        ExamHall::create(['name' => '1152','capacity' => 150,]);
        ExamHall::create(['name' => '1153','capacity' => 150,]);

    }
}
