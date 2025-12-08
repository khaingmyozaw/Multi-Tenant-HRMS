<?php

namespace App\Services\Base;

use App\Models\Position;
use App\Services\ApiService;

class PositionService extends ApiService 
{
    protected string $model = Position::class;
}