<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'data' => $users
        ], 200);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:6',
            'role'         => ['required', Rule::in(['user','admin'])],
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
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
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id) {

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'sometimes|required|string|max:100',
            'email'        => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user->id)],
            'password'     => 'sometimes|nullable|string|min:6',
            'role'         => ['sometimes', 'required', Rule::in(['user', 'admin'])],
            'phone_number' => 'sometimes|required|string|max:20',
            'address'      => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user->update([
            'name'         => $request->name ?? $user->name,
            'email'        => $request->email ?? $user->email,
            'password'     => $request->password ? Hash::make($request->password) : $user->password,
            'role'         => $request->role ?? $user->role,
            'phone_number' => $request->phone_number ?? $user->phone_number,
            'address'      => $request->address ?? $user->address,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Delete User Function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyUser($id)
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

}
