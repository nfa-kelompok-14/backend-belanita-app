<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;


class UserController extends Controller {

    public function index() {

        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No users found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Users retrieved successfully',
            'data' => UserResource::collection($users)
        ], 200);
    }

    public function show($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User found',
            'data' => new UserResource($user) 
        ], 200);
    }

    /**
     * Update Profile Function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->name = $request->input('name', $user->name);
        $user->phone_number = $request->input('phone_number', $user->phone_number);
        $user->address = $request->input('address', $user->address);

        if ($request->hasFile('image')) {
            if ($user->image && $user->image !== 'storage/profile/user_pict_default.png') {
                $oldPath = str_replace('storage/', '', $user->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('profile', $filename, 'public');
            $user->image = 'storage/' . $path;
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Delete User Function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        if ($user->image !== 'profile/user_pict_default.png') {
            $imagePath = public_path($user->image);
            if (file_exists($imagePath)) unlink($imagePath);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus.'
        ]);
    }

    public function me() {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($user)
        ]);
    }

}
