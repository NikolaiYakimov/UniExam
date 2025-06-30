<?php

namespace App\Repositories;

use App\Models\Exam;

interface ExamRepositoryInterface
{
    public function hasOverlap( $hallId,  $startTime,  $endTime);
    public function store($data):Exam;
    public function getBookedSlots($hallId, $startTime, $endTime);
}
