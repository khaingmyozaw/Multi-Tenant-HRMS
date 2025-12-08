<?php

namespace App\Http\Requests\Position;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
        ];
    }
}
