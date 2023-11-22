<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_locations';
    
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
            'country' => 'required|string|max:50|unique:mysql_locations.countries',
        ];
    }

    public function messages()
    {
        return [
            'country.required' => 'The country field is required.',
            'country.string' => 'The country field must be a string.',
            'country.max' => 'The country field must not exceed 50 characters.',
            'country.unique' => 'The country already exists in the locations database.',
        ];
    }
}
