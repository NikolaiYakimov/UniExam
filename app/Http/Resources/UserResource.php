<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'username'=>$this->username,
            'email'=>$this->email,
//            'full_name' => trim("{$this->first_name} {$this->second_name} {$this->last_name}"),
            'phone'=>$this->phone,
            'role'=>$this->role,
            'student'=>$this->when($this->role==='student',new StudentResource($this->whenLoaded('student'))),
            'teacher'=>$this->when($this->role === 'teacher',new TeacherResource($this->whenLoaded('teacher')))
//            'administrator_data' => $this->when(
//                $this->role === 'administrator',
//                $this->whenLoaded('administrator')
//            ),
        ];
    }
}
