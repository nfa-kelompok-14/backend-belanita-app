<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Register Function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'image' => 'storage/profile/user_pict_default.png',
            'role' => 'user',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Login Function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Logout Function
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            if (!$token = JWTAuth::getToken()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Token not provided or already removed'
                ], 200);
            }
    
            JWTAuth::invalidate($token);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'success',
                'message' => 'Token already invalidated or expired'
            ], 200);
        }
    }
    

    /**
     * Get Me Function
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'user' => auth('api')->user()
        ]);
    }

    /**
     * Delete Own Profile Function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyOwnAccount(Request $request)
    {
        $user = auth('api')->user();

        $request->validate([
            'password' => 'required|string'
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password salah.'
            ], 401);
        }

        if ($user->image && $user->image !== 'storage/profile/user_pict_default.png') {
            $path = str_replace('storage/', '', $user->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        JWTAuth::invalidate(JWTAuth::getToken());
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Akun berhasil dihapus.'
        ]);
    }

    /**
     * FUnction Response With Token
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }


}
