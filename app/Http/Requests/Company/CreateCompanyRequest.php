<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\ApiRequest;

class CreateCompanyRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'contact_email' => 'required|email',
        ];
    }
}
