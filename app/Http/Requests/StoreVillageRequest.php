<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVillageRequest extends FormRequest
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
            'village' => 'required|string|max:50|unique:mysql_locations.villages',
            'parish_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'village.required' => 'The village field is required.',
            'village.string' => 'The village must be a string.',
            'village.max' => 'The village may not be greater than 50 characters.',
            'village.unique' => 'The village has already been taken.',
            'parish_id.required' => 'The parish_id field is required.',
            'parish_id.integer' => 'The parish_id must be an integer.',
        ];
    }
}
