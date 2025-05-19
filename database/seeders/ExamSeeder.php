<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ПТС Exams
        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 1,
            'hall_id' => 1, // 1151
            'start_time' => Carbon::create(2024, 6, 15, 9, 0, 0),
            'end_time' => Carbon::create(2024, 6, 15, 11, 0, 0),
            'max_students' => 100,
            'exam_type' => 'редовен',
        ]);

        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 1,
            'hall_id' => 1, // 1151
            'start_time' => Carbon::create(2024, 7, 1, 9, 0, 0),
            'end_time' => Carbon::create(2024, 7, 1, 11, 0, 0),
            'max_students' => 50,
            'exam_type' => 'поправителен',
        ]);

        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 1,
            'hall_id' => 1, // 1151
            'start_time' => Carbon::create(2024, 7, 1, 13, 0, 0),
            'end_time' => Carbon::create(2024, 7, 1, 15, 0, 0),
            'max_students' => 30,
            'exam_type' => 'ликвидация',
        ]);

        // ВПКС Exams
        Exam::create([
            'teacher_id' => 2,
            'subject_id' => 2,
            'hall_id' => 3, // 1153
            'start_time' => Carbon::create(2024, 6, 20, 13, 30, 0),
            'end_time' => Carbon::create(2024, 6, 20, 15, 30, 0),
            'max_students' => 150,
            'exam_type' => 'редовен',
        ]);

        Exam::create([
            'teacher_id' => 2,
            'subject_id' => 2,
            'hall_id' => 3, // 1153
            'start_time' => Carbon::create(2024, 7, 5, 13, 30, 0),
            'end_time' => Carbon::create(2024, 7, 5, 15, 30, 0),
            'max_students' => 75,
            'exam_type' => 'поправителен',
        ]);

        Exam::create([
            'teacher_id' => 2,
            'subject_id' => 2,
            'hall_id' => 3, // 1153
            'start_time' => Carbon::create(2024, 7, 5, 16, 0, 0),
            'end_time' => Carbon::create(2024, 7, 5, 18, 0, 0),
            'max_students' => 45,
            'exam_type' => 'ликвидация',
        ]);

        // ОМТ Exams
        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 3,
            'hall_id' => 2, // 1152
            'start_time' => Carbon::create(2024, 6, 25, 11, 0, 0),
            'end_time' => Carbon::create(2024, 6, 25, 13, 0, 0),
            'max_students' => 120,
            'exam_type' => 'редовен',
        ]);

        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 3,
            'hall_id' => 2, // 1152
            'start_time' => Carbon::create(2024, 7, 10, 11, 0, 0),
            'end_time' => Carbon::create(2024, 7, 10, 13, 0, 0),
            'max_students' => 60,
            'exam_type' => 'поправителен',
        ]);
    }
}
