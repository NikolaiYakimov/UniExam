<?php

namespace App\Repositories;


use App\Models\ExamHall;

class ExamHallRepository
{
    public function getExamHallById (int $id):ExamHall
    {
        return ExamHall::findOrFail($id);
    }
}
