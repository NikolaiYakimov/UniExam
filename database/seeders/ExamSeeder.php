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
            'exam_date' => Carbon::create(2024, 6, 15, 9, 0, 0),
            'exam_hall' => '1151',
            'max_students' => 100,
            'exam_type' => 'редовен',
        ]);


        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 1,
            'exam_date' => Carbon::create(2024, 7, 1, 9, 0, 0),
            'exam_hall' => '1151',
            'max_students' => 50,
            'exam_type' => 'поправителен',
        ]);
        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 1,
            'exam_date' => Carbon::create(2024, 7, 1, 9, 0, 0),
            'exam_hall' => '1151',
            'max_students' => 30,
            'exam_type' => 'ликвидация',
        ]);

        // ВПКС Exams
        Exam::create([
            'teacher_id' => 2,
            'subject_id' => 2,
            'exam_date' => Carbon::create(2024, 6, 20, 13, 30, 0),
            'exam_hall' => '1153',
            'max_students' => 150,
            'exam_type' => 'редовен',
        ]);

        Exam::create([
            'teacher_id' => 2,
            'subject_id' => 2,
            'exam_date' => Carbon::create(2024, 7, 5, 13, 30, 0),
            'exam_hall' => '1153',
            'max_students' => 75,
            'exam_type' => 'поправителен',
        ]);

        Exam::create([
            'teacher_id' => 2,
            'subject_id' => 2,
            'exam_date' => Carbon::create(2024, 7, 5, 13, 30, 0),
            'exam_hall' => '1153',
            'max_students' => 45,
            'exam_type' => 'ликвидация',
        ]);

        // ОМТ Exams
        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 3,
            'exam_date' => Carbon::create(2024, 6, 25, 11, 0, 0),
            'exam_hall' => '2201',
            'max_students' => 120,
            'exam_type' => 'редовен',
        ]);

        Exam::create([
            'teacher_id' => 1,
            'subject_id' => 3,
            'exam_date' => Carbon::create(2024, 7, 10, 11, 0, 0),
            'exam_hall' => '2201',
            'max_students' => 60,
            'exam_type' => 'поправителен',
        ]);
    }
}
