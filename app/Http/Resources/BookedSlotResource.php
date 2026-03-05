<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookedSlotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'hall_id'=>$this->hall_id,
            'start' => $this->start_time->toIso8601String(),
            'end' => $this->end_time->toIso8601String()
        ];
    }
}
