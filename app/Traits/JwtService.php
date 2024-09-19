<?php

namespace App\Traits;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

trait JwtService
{

    private static string $GUARD_API = 'api';
    private static string $GUARD_API_STORE = 'store-api';

    protected function respondWithToken($token, $refreshToken, $user): JsonResponse
    {
        $ttl = config('jwt.ttl');

        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'expires_in' => $ttl * 60
        ]);
    }



    private function createRefreshToken($user)
    {
        $data = [
            'user_id' => $user->id,
            'random' => rand() . time(),
            'is_refresh_token' => true,
            'exp' => time() + config('jwt.refresh_ttl'),
        ];

        return JWTAuth::getJWTProvider()->encode($data);
    }

    public function loginUser(Request $request): JsonResponse
    {
        $this->login = $request->validated();

        if ($this->resolve()) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);
            $refreshToken = $this->createRefreshToken($user);
            return $this->respondWithToken($token, $refreshToken, $user);
        }

        return response()->json([
            'status' => 401,
            'message' => __('Thông tin đăng nhập chưa chính xác.')
        ], 401);
    }

    /**
     * Create refresh_token.
     */
    private function createRefreshTokenById($user)
    {
        $data = [
            'user_id' => $user->id,
            'random' => rand() . time(),
            'exp' => time() + config('jwt.refresh_ttl')
        ];
        return JWTAuth::getJWTProvider()->encode($data);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logoutUser(): JsonResponse
    {
        auth(self::$GUARD_API)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refreshToken(Request $request): JsonResponse
    {
        $data = $request->only('refresh_token'); // Lấy dữ liệu cần thiết

        $refreshToken = $data['refresh_token'];
        try {
            $decoded = JWTAuth::setToken($refreshToken)->getPayload();
            if (!$decoded->get('is_refresh_token', false)) {
                return response()->json(['message' => 'Invalid token type.'], 401);
            }

            if (time() - $decoded->get('token_generated') < config('jwt.refresh_ttl')) {
                return response()->json(['message' => 'Refresh token has already been used.'], 401);
            }
            $user = User::find($decoded->get('user_id'));

            $newToken = JWTAuth::fromUser($user);
            $newRefreshToken = $this->createRefreshToken($user);

            return $this->respondWithToken($newToken, $newRefreshToken, $user);
        } catch (Exception $e) {
            $this->logError("Error for refresh token", $e);
            return response()->json(['message' => 'Invalid token.', 'error' => $e->getMessage()], 401);
        }
    }
}
