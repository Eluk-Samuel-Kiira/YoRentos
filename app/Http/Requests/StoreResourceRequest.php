<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
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
            'resource' => 'required|string|max:50|unique:mysql_estates.resources',
        ];
    }

    public function messages()
    {
        return [
            'resource.required' => 'The rental resource is required.',
            'resource.string' => 'The rental resource must be a string.',
            'resource.max' => 'The rental resource may not be greater than 50 characters.',
            'resource.unique' => 'The rental resource has already been taken.',
        ];
    }
}
