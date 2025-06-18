<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::with(['user', 'complaint'])->get();

        if ($feedback->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No feedback found'], 
            404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Feedback retrieved successfully',
                'data' => FeedbackResource::collection($feedback)
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'complaint_id' => 'required|exists:complaints,id',
            'message' => 'required|string|max:500',
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
                'message' => 'Authentication is required to create feedback. Please login first.'
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Only admins can create feedback.'
            ], 403);
        }

        $feedback = Feedback::create([
            'user_id' => $user->id,
            'complaint_id' => $request->complaint_id,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Feedback created successfully',
            'data' => new FeedbackResource($feedback)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::with(['user', 'complaint'])->find($id);

        if (!$feedback) {
            return response()->json([
                'status' => 'error',
                'message' => 'Feedback not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Feedback retrieved successfully',
            'data' => new FeedbackResource($feedback)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'status' => 'error',
                'message' => 'Feedback not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'sometimes|required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $feedback->update($request->only('message'));

        return response()->json([
            'status' => 'success',
            'message' => 'Feedback updated successfully',
            'data' => new FeedbackResource($feedback)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'status' => 'error',
                'message' => 'Feedback not found'
            ], 404);
        }

        $feedback->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Feedback deleted successfully'
        ], 200);
    }
}
