<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required','min:8','regex:/^(?=.*[A-Za-z])(?=.*\d)$/','string', 'confirmed'],
            'new_password_confirmation' => ['required', 'string'],
        ];
    }
    public function messages(): array
    {
        return [
            'current_password.current_password' => 'Текущата парола е грешна!',
            'current_password.required' => 'Текущата парола е задължителна!',
            'new_password.confirmed' => 'Паролата за потвърждение не съвпада с новата парола!',
            'new_password.min' => 'Новата парола трябва да е поне 8 символа!',
            'new_password.regex'=>'Новата парола трябва да съдържа поне една буква и цифра!',
            'new_password_confirmation.required' => 'Потвърди новата парола!'

        ];
    }
}
