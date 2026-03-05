<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpgradeGradeRequest extends FormRequest
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
        return [
            'grades' => ['required', 'array', 'min:1'],

            // Валидация за всяко едно студентско ID в масива
            'grades.*.student_id' => [
                'required',
                'integer',
                'exists:students,id' // Проверява дали този студент реално съществува
            ],

            // Валидация за самата оценка
            'grades.*.grade' => [
                'required',
                'numeric',
                'min:2',
                'max:6' // Оценката трябва да е между 2 и 6
            ],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'grades.required' => 'Моля, въведете поне една оценка.',
            'grades.array' => 'Невалиден формат на данните за оценките.',
            'grades.min' => 'Списъкът с оценки не може да бъде празен.',

            'grades.*.student_id.required' => 'Липсва идентификатор на студент.',
            'grades.*.student_id.integer' => 'Идентификаторът на студента трябва да е число.',
            'grades.*.student_id.exists' => 'Избраният студент не съществува в системата.',

            'grades.*.grade.required' => 'Моля, въведете оценка за студента.',
            'grades.*.grade.numeric' => 'Оценката трябва да бъде число (напр. 4 или 4.50).',
            'grades.*.grade.min' => 'Минималната възможна оценка е 2.',
            'grades.*.grade.max' => 'Максималната възможна оценка е 6.',
        ];
    }
}
