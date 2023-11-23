<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountyRequest extends FormRequest
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
            'county' => 'required|string|max:50|unique:mysql_locations.counties',
            'district_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'county.required' => 'The county field is required.',
            'county.string' => 'The county must be a string.',
            'county.max' => 'The county may not be greater than 50 characters.',
            'county.unique' => 'The county has already been taken.',
            'district_id.required' => 'The district field is required.',
            'district_id.integer' => 'The district must be an integer.',
        ];
    }
}
