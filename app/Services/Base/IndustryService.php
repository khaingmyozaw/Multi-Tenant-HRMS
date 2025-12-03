<?php

namespace App\Services\Base;

use App\Models\Industry;
use App\Services\ApiService;

class IndustryService extends ApiService
{
    /**
     * Get list of industries
     * 
     * @return LengthAwarePaginator
     */
    public function index($request) 
    {
        $query = Industry::query();

        return $this->makeApiResponse($query, $request);
    }

    /**
     * Create industries
     * 
     * @param array
     * @return void
     */
    public function store(array $validated): void
    {
        Industry::create($validated);
    }

    /**
     * Update industry
     * 
     * @param array $request
     * @param Industry $industry
     * @return bool
     */
    public function update(array $validated, Industry $industry): bool
    {
        return $industry->update($validated);
    }
}
