<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SpecialityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $specialityId=$this->route('id');
        $facultyId=$this->input('faculty_id');
        return [
            'name' => [
              'required',
              'string',
              'max:255',
              Rule::unique('specialties', 'name')->where('faculty_id',$facultyId)->ignore($specialityId),
            ],
            'faculty_id'=>['required','exists:faculty,id'],
        ];
    }
}
