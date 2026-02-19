<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class ForgotPasswordRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email'],
            ];
    }

    public function messages(): array{
        return [
            'email.required'=>'Имейл адреса е задължителен.',
            'email.email'=>'Моля, въведете валиден имейл адрес.',
            'email.exists' =>'Не можем да намерим потребител с този имейл адрес.'
        ];
    }
}
