<?php

namespace App\Repositories;


use App\Models\ExamHall;

class ExamHallRepository
{
    public function getAll()
    {
        return ExamHall::all();
    }

    public function getExamHallById(int $id): ExamHall
    {
        return ExamHall::findOrFail($id);
    }

    public function create(array $data): ExamHall
    {
        return ExamHall::create($data);
    }

    public function update(ExamHall $examHall, array $data): bool
    {
        return $examHall->update($data);
    }

    public function delete(ExamHall $examHall): ?bool
    {
        return $examHall->delete();
    }
}
