<?php

namespace App\Http\Requests\Industry;

use App\Http\Requests\ApiRequest;

class UpdateIndustryRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:225',
            'description' => 'nullable|string',
        ];
    }
}
