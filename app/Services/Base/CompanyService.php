<?php

namespace App\Services\Base;

use App\Models\Company;
use App\Services\ApiService;

class CompanyService extends ApiService
{
    protected string $model = Company::class;
}
