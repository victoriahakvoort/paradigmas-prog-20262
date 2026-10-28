<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateUserRequest extends FormRequest
{
    #[Override]
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    #[Override]
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:100', 'min:3'],
            'email' => ['sometimes', 'email'],
            'password' => ['sometimes', 'string', 'min:4', 'max:20']
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O campo nome precisa ser um texto.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',

            'email.email' => 'O campo email deverá ser um email válido.',
            
            'password.string' => 'O campo senha deve ser um texto.',
            'password.min' => 'O campo senha deve conter no mínimo :min caracteres.',
            'password.max' => 'O campo senha deve conter no máximo :max caracteres.',
        ];
    }
}
