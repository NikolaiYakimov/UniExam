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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'grade' => ['required', 'array'],
            'grade.*' => ['nullable', 'numeric', 'min:2', 'max:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'grade.required' => 'Това поле е задължително.',
            'grade.array' => 'Оценките трябва да бъдат подадени като списък.',
            'grade.*.numeric' => "Една или повече от избраните оценки не са числа",
            'grade.*.min' => "Минималната оценка е 2! Не може да въведете по-ниска!",
            'grade.*.max' => "Максималната оценка е 6! Не може да въведете по-висока!"

        ];
    }
}
