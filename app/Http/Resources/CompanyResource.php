<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = $this->getCompanyData();
        if (! $request->routeIs('companies.show')) {
            return $base;
        }

        return array_merge($base, $this->getCompanyInformation());
    }

    /**
     * Get only company data
     * @return array
     */
    public function getCompanyData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact_email' => $this->contact_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get company data with detailed information
     * @return array
     */
    public function getCompanyInformation(): array
    {
        return [];
    }
}
