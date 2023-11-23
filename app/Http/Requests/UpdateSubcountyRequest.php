<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcountyRequest extends FormRequest
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
            'subcounty' => 'required|string|max:50|unique:mysql_locations.subcounties',
            'county_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'subcounty.required' => 'The subcounty field is required.',
            'subcounty.string' => 'The subcounty must be a string.',
            'subcounty.max' => 'The subcounty may not be greater than 50 characters.',
            'subcounty.unique' => 'The subcounty has already been taken.',
            'county_id.required' => 'The county_id field is required.',
            'county_id.integer' => 'The county_id must be an integer.',
        ];
    }
}
