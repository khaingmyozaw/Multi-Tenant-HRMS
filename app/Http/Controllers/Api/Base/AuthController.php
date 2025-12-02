<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Base\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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

    /**
     * Register
     */
    public function register(RegisterRequest $request, AuthService $authService)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['username'] = make_username($validated['name']);
            $user = $authService->register($validated);
            $resource = new UserResource($user);

            DB::commit();

            return api(
                message: 'User has been registered.',
                data: [
                    'user' => $resource->toArray($request),
                    'token' => $user->createToken('API Token')->accessToken,
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return error(status: 500);
        }
    }
}
