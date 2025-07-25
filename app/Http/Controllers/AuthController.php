<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    )
    {
    }

    /**
     * Get a JWT via given credentials
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $loginData = $request->getContent();
        $credentials = json_decode($loginData, true);

        $login = $this->authService->login($credentials);
        return new JsonResponse($login, 200);
    }

    /**
     * Log the user out (Invalidate the token).
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return new JsonResponse(['message' => 'Successfully logged out']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $credentials = json_decode($data, true);

        $newUser = $this->authService->register($credentials);
        return new JsonResponse($newUser, 201);
    }

    /**
     * Get the authenticated User.
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $profile = $this->authService->profileInfo();
        return new JsonResponse($profile, 200);
    }
}
