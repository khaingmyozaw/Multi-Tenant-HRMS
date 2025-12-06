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
        $data = $this->getBaseResource();

        if (! $request->routeIs('departments.show')) {
            return $data;
        }
        return array_merge($data, $this->getAdditionalResources());
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Include the related data with the resource
     */
    private function getAdditionalResources(): array
    {
        return [
            'company' => new CompanyResource($this->whenLoaded('company')),
        ];
    }
}
