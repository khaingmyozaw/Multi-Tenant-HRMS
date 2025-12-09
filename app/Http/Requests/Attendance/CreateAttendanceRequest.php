<?php

namespace App\Http\Requests\Attendance;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateAttendanceRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'location' => 'required|string',
        ];
    }
}
