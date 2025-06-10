<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index() {
        $complaints = Complaint::with('user')->get();

        // Error handling
        if ($complaints->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => $complaints
            ], 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication is required to create a complaint. Please login first.'
            ], 401);
        }

        $complaint = Complaint::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $complaint
        ], 201);
    }

    public function show($id) {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $complaint
        ], 200);
    }

    public function update(Request $request, $id) {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
        }

        $validator = Validator::make($request->all(), [
            'subject' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|in:pending,processed,completed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
        ], 422);
        }

        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication is required to update a complaint. Please login first.'
            ], 401);
        }

        $data = [
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id
        ];

        $complaint->update($request->only('subject', 'description', 'status'), $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully updated',
            'data' => $complaint
        ], 200);
    }

    public function destroy($id) {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        $complaint->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully deleted'
    ], 200);
    }

}
