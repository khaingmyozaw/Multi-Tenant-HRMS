<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIndustryRequest;
use App\Http\Requests\IndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Http\Resources\IndustryResource;
use App\Models\Industry;
use App\Services\Base\IndustryService;
use Exception;
use Throwable;

class IndustryController extends Controller
{
    /**
     * Display a industry list.
     */
    public function index(IndustryRequest $request, IndustryService $industryService)
    {
        return api(
            'Industries are fetched successfully.',
            IndustryResource::collection($industryService->index($request)),
            200,
            true
        );
    }

    /**
     * Store a newly industry.
     */
    public function store(CreateIndustryRequest $request, IndustryService $industryService)
    {
        try {
            $validated = $request->validated();
            $industry = $industryService->store($validated);

            return api('Industry created successfully', new IndustryResource($industry), 201);
        } catch (Exception $e) {
            report($e);

            return error();
        }
    }

    /**
     * Display the specified industry.
     */
    public function show(Industry $industry)
    {
        try {
            return api(
                'Industry is fetched successfully',
                new IndustryResource($industry),
            );
        } catch (Throwable $e) {
            report($e);

            return error();
        }

    }

    /**
     * Update the specified industry.
     */
    public function update(
        UpdateIndustryRequest $request,
        Industry $industry,
        IndustryService $industryService
    ) {
        try {
            $validated = $request->validated();
            $data = $industryService->update($validated, $industry);

            return api('The provided industry saved successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while saving data!');
        }
    }

    /**
     * Remove the specified industry.
     */
    public function destroy(Industry $industry)
    {
        $industry->delete();

        return api('Industry deleted successfully.');
    }
}
