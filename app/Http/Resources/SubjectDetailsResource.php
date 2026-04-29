<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject_name' => $this->subject_name,
            'description' => $this->description,
            'semester' => $this->semester,
            'price' => $this->price,
            'specialties' => $this->whenLoaded('specialties', function () {
                return $this->specialties->map(fn($s) => ['id' => $s->id, 'name' => $s->name]);
            }),
            'teachers' => $this->whenLoaded('teachers', function () {
                return $this->teachers->map(fn($t) => [
                    'id' => $t->id,
                    'name' => trim(($t->user->first_name ?? '') . ' ' . ($t->user->last_name ?? ''))
                ]);
            }),
        ];
    }
}
