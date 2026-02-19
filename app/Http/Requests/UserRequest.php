<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user=$this->route('user');
        return [
            'first_name'     => ['required', 'string', 'max:60'],
            'second_name'    => ['nullable', 'string', 'max:60'],
            'last_name'      => ['required', 'string', 'max:60'],
            'username'       => ['required', 'string', 'max:90',Rule::unique('users', 'username')->ignore($user)],
            'email'          => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'password'       => [$this->isMethod("POST")?'required':'nullable', 'string', 'min:8'],
            'phone'          => ['nullable', 'string', 'max:15','min:10'],
            'role'           => ['required', 'in:student,teacher,administrator'],
            'faculty_number' => ['required_if:role,student', 'nullable', 'string'],
            'faculty_id'     => ['nullable', 'exists:faculties,id'],
            'specialty_id'   => ['nullable', 'exists:specialties,id'],
            'semester'       => ['nullable', 'integer', 'min:1', 'max:8'],
            'group_id'       => ['nullable', 'exists:groups,id'],
            'title'          => ['required_if:role,teacher', 'nullable', 'string'],
        ];
    }

    public function messages():array{
        return [
            'first_name.required' => 'Собственото име е задължително.',
            'first_name.max' => 'Собственото име не може да бъде по-дълго от 60 символа.',
            'second_name.max' => 'Презимето не може да бъде по-дълго от 60 символа.',
            'last_name.required' => 'Фамилията е задължителна.',
            'last_name.max' => 'Презимето не може да бъде по-дълго от 60 символа.',
            'username.required' => 'Потребителското име е задължително.',
            'username.unique' => 'Това потребителско име вече е заетo.',
            'email.required' => 'Имейл адресът е задължителен.',
            'email.email' => 'Моля, въведете валиден имейл адрес.',
            'email.unique' => 'Този имейл адрес вече е регистриран.',
            'password.required' => 'Паролата е задължителна.',
            'password.min' => 'Паролата трябва да бъде поне 8 символа.',

            'phone.max' => 'Телефонният номер е твърде дълъг.',
            'phone.min'=>"Телефонният номер трябва да е минимум 10 цифри",
            'role.required' => 'Моля, изберете роля на потребителя.',
            'role.in' => 'Избраната роля е невалидна.',
            'faculty_number.required_if' => 'Факултетният номер е задължителен, когато ролята е "Студент".',
            'title.required_if' => 'Титлата е задължителна, когато ролята е "Преподавател".',
            'faculty_id.exists' => 'Избраният факултет е невалиден.',
            'specialty_id.exists' => 'Избраната специалност е невалидна.',
            'group_id.exists' => 'Избраната група е невалидна.',

            'semester.integer' => 'Семестърът трябва да бъде число.',
            'semester.min' => 'Семестърът не може да бъде по-малък от 1.',
            'semester.max' => 'Семестърът не може да бъде по-голям от 8.',

        ];
    }
}
