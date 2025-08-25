<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class  UpdateProfileRequest extends FormRequest
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
        $userId=$this->user()->id;
        return [
            'name'=>['prohibited'],
            'first_name'=>['prohibited'],
            'second_name'=>['prohibited'],
            'last_name'=>['prohibited'],
            'username'=>['prohibited'],
            'role'=>['prohibited'],
            'faculty_number'=>['prohibited'],
            'faculty_id' => ['prohibited'],
            'specialty_id' => ['prohibited'],
            'group_id' => ['prohibited'],
            'email'=>['sometimes','email','max:50',"unique:users,email,{$userId}"],
            'phone'=>['string','sometimes','digit:10',],
        ];
    }
    protected function prepareForValidation():void
    {
        $digitsOnly=isset($this->phone)? preg_replace('/\D+/','',(string)$this->phone):null;

        if($digitsOnly && str_starts_with($digitsOnly,'359') &&strlen($digitsOnly)===12){
        {
            $digitsOnly='0'.substr($digitsOnly,3);
        }

    }
        $this->merge([
            'email' => isset($this->email) ? trim($this->email) : null,
            'phone'=>$digitsOnly,
        ]);
    }

    public function messages(): array{
        return [
            'email.email'=>'Моля въведете валиден имейл адрес.',
            'email.unique'=>'Този имейл вече е зает.',
            'phone.digit'=>'Телефония номер трябва да съдържа 10 цифри'
        ];
    }
}
