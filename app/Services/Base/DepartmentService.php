<?php

namespace App\Services\Base;

use App\Models\Department;
use App\Services\ApiService;

class DepartmentService extends ApiService
{
    protected string $model = Department::class;
}
