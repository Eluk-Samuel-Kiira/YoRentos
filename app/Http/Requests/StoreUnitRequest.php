<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'unit' => 'required|string|max:50',
            'room_no' => 'required|string|max:50',
            'estate_id' => 'required|integer',
            'estate_uid' => 'required|string',
            'duration_id' => 'required|integer',
            'price' => 'required|string',
            'square_footage' => 'required|string',
            'description' => 'required|string|max:10000',
            'resources' => 'required|array|max:15',
        ];
    }

    public function messages()
    {
        return [
            'unit.required' => 'The unit field is required.',
            'unit.string' => 'The unit field must be a string.',
            'unit.max' => 'The unit field must not exceed 50 characters.',
            
            'estate_id.required' => 'The estate ID field is required.',
            'estate_id.integer' => 'The estate ID must be an integer.',
            
            'estate_uid.required' => 'The estate UID field is required.',
            'estate_uid.integer' => 'The estate UID must be an integer.',
            
            'duration_id.required' => 'The duration ID field is required.',
            'duration_id.integer' => 'The duration ID must be an integer.',
            
            'price.required' => 'The price field is required.',
            'price.string' => 'The price field must be a string.',
            
            'square_footage.required' => 'The square footage field is required.',
            'square_footage.string' => 'The square footage field must be a string.',
            
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',
            'description.max' => 'The description field must not exceed 2000 characters.',
        ];
    }
}
