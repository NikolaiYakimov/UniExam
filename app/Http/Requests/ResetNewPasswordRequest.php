<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetNewPasswordRequest extends FormRequest
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
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array{
        return [
            'token.required'=>'Липсва валидационен токен.',
            'email.required'=>'Имейл адресът е задължителен.',
            'email.exists'=>'Не съществива потребител с този имейл.',
            'password.required'=> 'Моля, въведете нова парола.',
            'password.confirmed' => 'Двете пароли не съвпадат.',
            'password.min' => 'Паролата трябва да е поне 8 символа.',
            ];
    }
}
