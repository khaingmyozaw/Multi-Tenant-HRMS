<?php

namespace App\Services\Base;

use App\Models\Company;
use App\Services\ApiService;

class CompanyService extends ApiService
{
    /**
     * Get list of industries
     *
     * @param CompanyRequest
     * @return LengthAwarePaginator
     */
    public function index($request)
    {
        $query = Company::query();

        return $this->makeApiResponse($query, $request);
    }

    /**
     * Create company
     * 
     * @param array $validated
     * @return Company
     */
    public function store(array $validated): Company
    {
        return Company::create($validated);
    }

    /**
     * Update Company
     *
     * @param  array  $request
     * @param Company $company
     * @return bool
     */
    public function update(array $validated, Company $company): bool
    {
        return $company->update($validated);
    }
    
}
