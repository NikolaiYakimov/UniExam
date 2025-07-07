<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
     return in_array(auth()->user()->role,['teacher','administrator']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "subject_id"=>'required|exists:subjects,id',
            'hall_id'=>'required|exists:exam_halls,id',
            'max_students'=>'required|integer|min:1',
            'exam_type'=>['required',Rule::in(['редовен','поправителен','ликвидация'])],
            'start_time'=>'required |date',
            'end_time' => [
                'required',
                'date',
                function ($attribute, $value, $fail)  {
                    if (Carbon::parse($value) <= Carbon::parse($this->start_time)) {
                        $fail('Крайното време трябва да е след началното!');
                    }
                }
            ],
        ];
    }
}
