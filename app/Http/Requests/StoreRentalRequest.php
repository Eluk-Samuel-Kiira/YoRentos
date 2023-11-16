<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:rentals',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The rental name is required.',
            'name.string' => 'The rental name must be a string.',
            'name.max' => 'The rental name may not be greater than 50 characters.',
            'name.unique' => 'The rental name has already been taken.',
        ];
    }
}
