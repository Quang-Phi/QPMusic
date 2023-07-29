<?php

namespace App\Http\Requests\Admin\Songs;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'min:3|max:100',
            'img_url' => 'required|mimes:jpeg,png,gif|max:500000',
            'url' => 'required|mimes:mp3|max:500000',
        ];
    }

    public function messages(): array
    {
        return [
           
        ];
    }
}
