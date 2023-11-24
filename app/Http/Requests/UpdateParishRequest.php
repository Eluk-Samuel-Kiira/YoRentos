<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParishRequest extends FormRequest
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
            'parish' => 'required|string|max:50|unique:mysql_locations.parishes',
            'subcounty_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'parish.required' => 'The parish field is required.',
            'parish.string' => 'The parish must be a string.',
            'parish.max' => 'The parish may not be greater than 50 characters.',
            'parish.unique' => 'The parish has already been taken.',
            'subcounty_id.required' => 'The subcounty_id field is required.',
            'subcounty_id.integer' => 'The subcounty_id must be an integer.',
        ];
    }
}
