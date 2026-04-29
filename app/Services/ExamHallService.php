<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\ExamHallDto;
use App\Models\ExamHall;
use App\Repositories\ExamHallRepository;
use Illuminate\Support\Collection;

class ExamHallService
{
    public function __construct(
        private readonly ExamHallRepository $examHallRepository
    ) {}

    public function getAllExamHalls(): Collection
    {
        return $this->examHallRepository->getAll();
    }

    public function createExamHall(ExamHallDto $dto): ExamHall
    {
        return $this->examHallRepository->create($dto->toArray());
    }

    public function updateExamHall(ExamHall $examHall, ExamHallDto $dto): bool
    {
        return $this->examHallRepository->update($examHall, $dto->toArray());
    }

    /**
     * @throws \Exception
     */
    public function deleteExamHall(ExamHall $examHall): ?bool
    {
        if ($examHall->exams()->count() > 0) {
            throw new \Exception('Не може да изтриете зала, която се използва в изпити!');
        }

        return $this->examHallRepository->delete($examHall);
    }
}
