<?php

namespace App\Http\Requests\Admin\Genres;

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
            'name' => 'required|min:3|unique:genres,name',
            'img_url' => 'required|mimes:jpeg,png,gif|max:500000',
        ];
    }

    public function messages(): array
    {
        return [
           
        ];
    }
}
