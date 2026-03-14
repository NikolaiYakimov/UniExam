<?php

namespace App\Services;

use App\Models\ExamHall;
use App\Repositories\ExamHallRepository;

class ExamHallService
{
    public function __construct(private readonly ExamHallRepository $examHallRepository)
    {
    }

    public function getAllExamHalls()
    {
        return $this->examHallRepository->getAll();
    }

    public function createExamHall(array $data): ExamHall
    {
        return $this->examHallRepository->create($data);
    }

    public function updateExamHall(ExamHall $examHall, array $data): bool
    {
        return $this->examHallRepository->update($examHall, $data);
    }

    public function deleteExamHall(ExamHall $examHall): ?bool
    {
        if ($examHall->exams()->count() > 0) {
            throw new \Exception('Не може да изтриете зала, която се използва в изпити!');
        }

        return $this->examHallRepository->delete($examHall);
    }
}
