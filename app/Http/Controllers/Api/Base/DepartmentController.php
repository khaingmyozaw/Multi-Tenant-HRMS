<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\DepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Services\Base\DepartmentService;
use Exception;

class DepartmentController extends Controller
{
    /**
     * Get listing of departments
     */
    public function index(
        DepartmentRequest $request,
        DepartmentService $departmentService
    ) {
        $data = $departmentService->index($request);

        return api(
            'Departments are fetched successfully.',
            DepartmentResource::collection($data),
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

            return api('Department created successfully', new DepartmentResource($data), 201);
        } catch (Exception $e) {
            report($e);

            return error();
        }
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        return api(
            'Department fetched successfully',
            new DepartmentResource($department->load('company')),
        );
    }

    /**
     * Update the specified department.
     */
    public function update(
        UpdateDepartmentRequest $request,
        Department $department,
        DepartmentService $departmentService
    ) {
        try {
            $validated = $request->validated();
            $department = $departmentService->update($validated, $department);

            return api('The provided department saved successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while saving data!');
        }
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();

            return api('Department deleted successfully.');
        } catch (Exception $e) {
            report($e);

            return error('Error while deleting department.');
        }
    }
}
