<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
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
        $subjectId=$this->route('subject');
        $semester=$this->input('semester');

        return [
            'subject_name'=>['required','string','max:255',
                Rule::unique('subjects','name')->where('semester',$semester)->ignore($subjectId)],
            'description'=>['nullable','string'],
            'semester'=>['required','integer','min:1','max:8'],
            'price'=>['required','numeric','min:0'],
            'specialties'=>['nullable','array'],
            'specialties.*'=>['exists:specialties,id'],
            'teachers'=>['nullable','array'],
            'teachers.*'=>['exists:teachers,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'subject_name.required' => 'Името на дисциплината е задължително.',
            'subject_name.max'      => 'Името на дисциплината е твърде дълго.',

            'semester.required'     => 'Моля, посочете семестър.',
            'semester.min'          => 'Семестърът трябва да е минимум 1.',
            'semester.max'          => 'Семестърът не може да бъде по-голям от 8.',

            'price.required'        => 'Цената на дисциплината е задължителна.',
            'price.numeric'         => 'Цената трябва да бъде число.',
            'price.min'             => 'Цената не може да бъде отрицателна.',

            'specialties.array'     => 'Специалностите трябва да бъдат подадени като списък.',
            'specialties.*.exists'  => 'Една или повече от избраните специалности са невалидни.',

            'teachers.array'        => 'Преподавателите трябва да бъдат подадени като списък.',
            'teachers.*.exists'     => 'Един или повече от избраните преподаватели са невалидни.',
        ];
    }
}
