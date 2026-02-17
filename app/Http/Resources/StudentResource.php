<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{

    public function toArray(Request $request):array{
        return [
            'id'=> $this->id,
            'faculty_number'=>$this->faculty_number,
            'semester'=>$this->semester,
            'faculty_id' => $this->faculty_id,
            'specialty_id' => $this->specialty_id,
            'group_id' => $this->group_id,
        ];
    }
}
