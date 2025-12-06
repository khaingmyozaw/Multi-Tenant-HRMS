<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
        ];
    }

    /**
     * Get only base resource of the model
     */
    private function getBaseResource(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
        ];
    }

    /**
     * Include the related data with the resource
     */
    private function getAdditionalResources(): array
    {
        return [
            'company' => $this->whenLoaded('company')
        ];
    }
}
