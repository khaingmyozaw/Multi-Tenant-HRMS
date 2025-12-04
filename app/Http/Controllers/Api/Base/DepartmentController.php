<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentRequest;
use App\Services\Base\DepartmentService;

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
}
