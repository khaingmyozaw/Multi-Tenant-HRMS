<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Position\CreatePositionRequest;
use App\Http\Requests\Position\PositionRequest;
use App\Http\Requests\Position\UpdatePositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use App\Services\Base\PositionService;
use Exception;

class PositionController extends Controller
{
    /**
     * Display a listing of position.
     */
    public function index(
        PositionRequest $request,
        PositionService $positionService
    ) {
        return api(
            'Positions are fetched successfully.',
            PositionResource::collection($positionService->index($request)),
            200,
            true
        );
    }

    /**
     * Store a newly position.
     */
    public function store(
        CreatePositionRequest $request,
        PositionService $positionService
    ) {
        try {
            $validated = $request->validated();

            return api(
                'Position created successfully',
                new PositionResource($positionService->store($validated)),
                201
            );
        } catch (Exception $e) {
            report($e);

            return error('Error while saving data!');
        }
    }

    /**
     * Display the specified position.
     */
    public function show(Position $position)
    {
        return api(
            'Position fetched successfully',
            new PositionResource($position->load('company')),
        );
    }

    /**
     * Update the specified position.
     */
    public function update(
        UpdatePositionRequest $request,
        Position $position,
        PositionService $positionService)
    {
        try {
            $validated = $request->validated();
            $positionService->update($validated, $position);

            return api('The provided position updated successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while saving data!');
        }
    }

    /**
     * Remove the specified position.
     */
    public function destroy(Position $position) {
        try {
            $position->delete();

            return api('Position deleted successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while deleting position.');
        }
    }
}
