<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends BaseResource
{
    protected function baseResource(): array
    {
        return [
        'id' => $this->id,
        'user_id' => $this->user_id,
        'company_id' => $this->company_id,
        'check_in' => $this->check_in,
        'check_out' => $this->check_out,
        'status' => $this->status,
        'location' => $this->location,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }

    protected function additionalResources(): array
    {
        return [
            'user' => new UserResource($this->whenLoaded('user')),
            'company' => new CompanyResource($this->whenLoaded('company')),
        ];
    }
}
