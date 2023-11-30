<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstateRequest extends FormRequest
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
            'estate' => 'required|string|max:70|unique:mysql_estates.estates',
            'village_id' => 'required|integer',
            'rental_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'estate.required' => 'The estate field is required.',
            'estate.string' => 'The estate field must be a string.',
            'estate.max' => 'The estate field must not exceed 70 characters.',
            'estate.unique' => 'The estate field must be unique in the parishes table.',
            'broker_id.integer' => 'The broker ID must be an integer.',
            'village_id.required' => 'Your Area is probably not yet mapped in the system, Kindly contact us for further information.',
            'village_id.integer' => 'The village ID must be an integer.',
            'rental_id.required' => 'The rental  field is required.',
            'rental_id.integer' => 'The rental ID must be an integer.',
        ];
    }
}
