<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Base\UserController as BaseUserController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseUserController
{
    /**
     * Get user list
     */
    public function index(Request $request)
    {
        return [
            'version one',
        ];
    }
}
