<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDistrictRequest extends FormRequest
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
                'district' => 'required|string|max:50|unique:mysql_locations.districts',
                'country_id' => 'required|integer',
            ];
        }
        public function messages()
        {
            return [
                'district.required' => 'The district field is required.',
                'district.string' => 'The district must be a string.',
                'district.max' => 'The district may not be greater than 50 characters.',
                'district.unique' => 'The district has already been taken.',
                'country_id.required' => 'The country field is required.',
                'country_id.integer' => 'The country must be an integer.',
            ];
        }
}
