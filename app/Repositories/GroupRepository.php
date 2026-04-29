<?php

namespace App\Repositories;

use App\Models\Group;
use Illuminate\Support\Collection;

class GroupRepository
{
    public function getAll(): Collection
    {
        return Group::all();
    }
}
