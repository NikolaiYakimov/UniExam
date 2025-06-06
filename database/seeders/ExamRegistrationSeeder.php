<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamRegistration::create(['student_id'=>1,'exam_id'=>1]);
        ExamRegistration::create(['student_id'=>2,'exam_id'=>4]);

        ExamRegistration::create(['student_id' => 3, 'exam_id' => 1]);
        ExamRegistration::create(['student_id' => 3, 'exam_id' => 3]);
        ExamRegistration::create(['student_id' => 3, 'exam_id' => 5]);

        // Retake exam registrations
        ExamRegistration::create(['student_id' => 1, 'exam_id' => 2]);
        ExamRegistration::create(['student_id' => 2, 'exam_id' => 4]);

    }
}
