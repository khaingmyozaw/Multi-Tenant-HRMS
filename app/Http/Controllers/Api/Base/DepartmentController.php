<?php

namespace App\Http\Controllers\Api\Base;

use Exception;
use Throwable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Services\Base\DepartmentService;
use App\Http\Requests\Department\DepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
class DepartmentController extends Controller
{
    /**
     * Get listing of departments
     */
    public function index(
        DepartmentRequest $request,
        DepartmentService $departmentService
    ) {
        return api(
            'Departments are fetched successfully.',
            $departmentService->index($request)
        );
    }

    /**
     * Store a newly department.
     */
    public function store(CreateDepartmentRequest $request, DepartmentService $departmentService)
    {
        try {
            $validated = $request->validated();
            $data = $departmentService->store($validated);

            return api('Industry created successfully', new DepartmentResource($data), 201);
        } catch (Exception $e) {
            report($e);

            return error();
        }
    }

    /**
     * Display the specified department.
     */
    public function show(Department $data)
    {
        try {
            return api(
                'Industry is fetched successfully',
                new DepartmentResource($data),
            );
        } catch (Throwable $e) {
            report($e);

            return error();
        }

    }

    /**
     * Update the specified department.
     */
    public function update(
        UpdateDepartmentRequest $request,
        Department $data,
        DepartmentService $departmentService
    ) {
        try {
            $validated = $request->validated();
            $data = $departmentService->update($validated, $data);

            return api('The provided department saved successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while saving data!');
        }
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Department $data)
    {
        $data->delete();

        return api('Industry deleted successfully.');
    }
}
