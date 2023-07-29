<?php

namespace App\Http\Requests\Admin\Accounts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            
        ];
    }

    public function messages(): array
    {
        return [
            'email.min' => 'Must be at least 4 characters before @gmail.com',
            'email.max' => 'Email cannot exceed 20 characters before @gmail.com',
        ];
    }
}
