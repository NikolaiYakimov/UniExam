<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 1,
            'exam_date' => now(),
            'exam_hall' => '1151',
            'max_students' => 100,
            'exam_type' => 'редовен',
        ]);

        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 2,
            'exam_date' => now(),
            'exam_hall' => '1153',
            'max_students' => 150,
            'exam_type' => 'поправителен',
        ]);
    }
}
