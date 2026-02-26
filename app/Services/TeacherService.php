<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ExamRepository;

class TeacherService
{
    public function __construct(private readonly ExamRepository $examRepository)
    {
    }

    public function getTeacherData(User $user):array
    {
        $teacher=$user->teacher->load('faculty','specialty');
        $subjectCount=$teacher->subjects->count();
        $upcomingExamsCount=$this->examRepository->getTeacherUpcomingExams($teacher->id)->count();

        return [
            'user' => $user,
            'teacher' => $teacher,
            'subjects_count' => $subjectCount,
            'exams_count' => $upcomingExamsCount,
        ];
    }

}
