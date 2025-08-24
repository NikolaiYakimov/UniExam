<?php

namespace Database\Seeders;

use App\Models\AcademicSemester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicSemester::create([
            'name'=>'Summer Semester',
            'start_date'=>'2025-08-04',
            'end_date'=>'2025-08-07',
            'is_current'=>true,
        ]);
        AcademicSemester::create([
            'name'=>'Winter Semester',
            'start_date'=>'2025-08-08',
            'end_date'=>'2025-08-09',
            'is_current'=>false,
        ]);

    }
}
