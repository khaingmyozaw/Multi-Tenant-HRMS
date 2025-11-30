<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $request->authenticate();

        $user = Auth::user();
        $resource = new UserResource($user);
        $token = $user->createToken('API Token')->accessToken;

        return api(
            'You successfully logged in.',
            array_merge(
                $resource->toArray($request),
                ['token' => $token]
            ));
    }
}
