<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDurationRequest extends FormRequest
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
            'duration' => 'required|string|max:50|unique:mysql_estates.durations',
        ];
    }

    public function messages()
    {
        return [
            'duration.required' => 'The rental duration is required.',
            'duration.string' => 'The rental duration must be a string.',
            'duration.max' => 'The rental duration may not be greater than 50 characters.',
            'duration.unique' => 'The rental duration has already been taken.',
        ];
    }
}
