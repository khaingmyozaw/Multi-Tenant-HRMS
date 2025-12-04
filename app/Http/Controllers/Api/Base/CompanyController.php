<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\Base\CompanyService;
use Exception;

class CompanyController extends Controller
{
    /**
     * Display a listing of department.
     */
    public function index(
        CompanyRequest $request,
        CompanyService $companyService
    ) {
        return api(
            'Companies are fetched successfully.',
            CompanyResource::collection($companyService->index($request)),
            200,
            true
        );
    }

    /**
     * Store a newly company.
     */
    public function store(CreateCompanyRequest $request, CompanyService $companyService)
    {
        try {
            $validated = $request->validated();

            return api(
                'Company created successfully',
                new CompanyResource($companyService->store($validated)),
                201
            );
        } catch (Exception $e) {
            report($e);

            return error();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return api(
            'Data fetched successfully',
            new CompanyResource($company),
        );
    }

    /**
     * Update the specified company.
     */
    public function update(
        UpdateCompanyRequest $request,
        Company $company,
        CompanyService $companyService
    ) {
        try {
            $validated = $request->validated();
            $companyService->update($validated, $company);

            return api('The provided company updated successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while saving data!');
        }
    }

    /**
     * Remove the specified company.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return api('Company deleted successfully.');
    }
}
