<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected $with_related = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (! $this->with_related) {
            return $this->baseResource();
        }

        return array_merge(
            $this->baseResource(),
            $this->additionalResources()
        );
    }

    /**
     * Get base resource or data of the model
     *
     * @return array<string, mixed>
     */
    protected function baseResource(): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->whenHas('company_id'),
            'name' => $this->whenHas('name'),
            'short_name' => $this->whenHas('short_name'),
            'description' => $this->whenHas('description'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get additional or related data of the model
     */
    protected function additionalResources(): array
    {
        return [
            'company' => new CompanyResource($this->whenLoaded('company')),
        ];
    }
}
