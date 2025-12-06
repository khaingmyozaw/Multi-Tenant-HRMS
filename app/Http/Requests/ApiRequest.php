<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
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
            'search' => 'nullable|string',
            'page' => 'nullable|integer|min:1', // Page number, must be a positive integer
            'per_page' => 'nullable|integer|min:1', // Items per page, must be a positive integer
            'sort_by' => 'nullable|string|in:id,name,created_at', // Sort column,
            'sort_direction' => 'nullable|string|in:asc,desc', // Sort direction, either 'asc' or 'desc'
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            '*.string' => 'The search value must be a valid string.',
            '*.integer' => 'The page number must be a valid integer.',
            '*.min' => 'The page number must be at least 1.',
            'per_page.integer' => 'The per_page value must be a valid integer.',
            'per_page.min' => 'The per_page value must be at least 1.',
            'sort_by.in' => 'The sort column must be one of the following: id, name, created_at.',
            'sort_direction.in' => 'The sort direction must be either "asc" or "desc".',

            '*.required' => 'The :attribute field is required.',
            '*.string' => 'the :attribute field must be a string.',
            '*.exists' => "The :attribute value is not match with our record.",
            '*.max' => "The :attribute field max length should be 225 characters.",
            '*.email' => "The provided email should be a valid email",
        ];
    }
}
