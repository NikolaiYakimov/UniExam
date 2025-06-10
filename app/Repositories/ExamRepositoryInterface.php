<?php

namespace App\Repositories;

interface ExamRepositoryInterface
{
    public function hasOverlap( $hallId,  $startTime,  $endTime);
    public function store($data);
    public function getBookedSlots($hallId, $startTime, $endTime);
}
