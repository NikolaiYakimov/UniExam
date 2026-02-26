<?php

namespace App\Services;

use App\Models\User;

class StudentService
{
    public function getStudentData(User $user):array{
        $student=$user->student->load('faculty','specialty','group');
        return [
            'user'=>$user,
            'student'=>$student,
        ];
    }
}
