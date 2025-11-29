<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Base\UserController as BaseUserController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'version one'
        ];
    }
}
