<?php

namespace App\Services\Base;

use App\Models\Industry;
use App\Services\ApiService;

class IndustryService extends ApiService
{
    public function index() 
    {
        $request = request();
        $query = Industry::query();

        return $this->makeApiResponse($query, $request);
    }
}
