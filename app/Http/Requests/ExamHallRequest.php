<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamHallRequest extends FormRequest
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
        $examHall=$this->route('examHall');
        return [
            'name'=>['required','string','max:30',
                Rule::unique('exam_halls','name')->ignore($examHall)],
            'capacity'=>['required','integer','min:1','max:150'],
            'opening_time'=>['required','date_format:H:i'],
            'closing_time'=>['required','date_format:H:i','after:opening_time']
        ];
    }
     public function messages(): array{
        return [
            'name.required' => 'Името на залата е задължително.',
            'name.string'=> 'Името трябва да бъде текст',
            'name.max'      => 'Името на залата не може да бъде по-дълго от 30 символа.',
            'name.unique'   => 'Зала с това име вече съществува.',

            'capacity.required' => 'Капацитетът на залата е задължителен.',
            'capacity.integer'  => 'Капацитетът трябва да бъде цяло число.',
            'capacity.min'      => 'Залата трябва да има минимум 20 места.',
            'capacity.max'      => 'Залата не може да надвишава 150 места.',

            'opening_time.required'    => 'Началният час е задължителен.',
            'opening_time.date_format' => 'Началният час трябва да бъде във формат ЧЧ:ММ (напр. 08:00).',

            'closing_time.required'    => 'Крайният час е задължителен.',
            'closing_time.date_format' => 'Крайният час трябва да бъде във формат ЧЧ:ММ.',
            'closing_time.after'       => 'Крайният час трябва да бъде след началния час.',
        ];
     }
}
