<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;

class AuthService
{
    /**
     * @param array $credentials
     * @return array|string[]
     */
    public function login(array $credentials): array
    {
        if (!$token = auth('api')->attempt($credentials)) {
            return ['error' => 'Invalid credentials'];
        }

        return ['token' => $this->respondWithToken($token)];
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        auth('api')->logout();
    }


    /**
     * Get the token array structure.
     * @param bool|string $token
     * @return array
     */
    protected function respondWithToken(bool|string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 10000 * 60
        ];
    }

    /**
     * @param array $data
     * @return User|null
     */
    public function register(array $data): ?User
    {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
//        $user->role = 'user';

        $user->save();

        return $user;
    }

    public function profileInfo(): ?Authenticatable
    {
        return auth('api')->user();
    }
}
