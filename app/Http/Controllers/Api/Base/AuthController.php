<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Base\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Login in
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $request->validated();
        $request->authenticate(); // login attempt

        return api(
            'You successfully logged in.',
            $authService->login($request)
        );
    }

    /**
     * Logout
     */
    public function logout(AuthService $authService)
    {
        $authService->logout();
        return api('User have been logged out.');
    }
}
