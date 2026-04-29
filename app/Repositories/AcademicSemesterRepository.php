<?php

namespace App\Repositories;

use App\Models\AcademicSemester;
use Carbon\Carbon;

class AcademicSemesterRepository
{
    public function getCurrentSemester(): ?AcademicSemester
    {
        return AcademicSemester::where('is_current', true)->first();
    }

    public function getNextSemester(Carbon $date): ?AcademicSemester
    {
        return AcademicSemester::where('start_date', '>=', $date)
            ->orderBy('start_date')
            ->first();
    }

    public function updateSemester(AcademicSemester $semester, array $data): bool
    {
        return $semester->update($data);
    }
}
