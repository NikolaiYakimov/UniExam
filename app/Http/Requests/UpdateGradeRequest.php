<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
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
            'grades' => ['required', 'array'],
            'grades.*' => ['nullable', 'numeric', 'min:2', 'max:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'grades.required' => 'Това поле е задължително.',
            'grades.array' => 'Оценките трябва да бъдат подадени като списък.',
            'grades.*.numeric' => "Една или повече от избраните оценки не са числа",
            'grades.*.min' => "Минималната оценка е 2! Не може да въведете по-ниска!",
            'grades.*.max' => "Максималната оценка е 6! Не може да въведете по-висока!"

        ];
    }
}
