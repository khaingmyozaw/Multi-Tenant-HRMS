<?php

namespace App\Services\Base;

use App\Models\Industry;
use App\Services\ApiService;

class IndustryService extends ApiService
{
    protected string $model = Industry::class;
}
