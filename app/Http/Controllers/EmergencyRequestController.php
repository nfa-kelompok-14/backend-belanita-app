<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmergencyRequestResource;
use App\Models\EmergencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmergencyRequestController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication is required. Please login first.'
            ], 401);
        }

        $query = EmergencyRequest::with('user');

        if ($user->role === 'user') {
            $query->where('user_id', $user->id);
        }

        $query->orderBy('created_at', 'asc');

        $emergencies = $query->get();

        if ($emergencies->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => EmergencyRequestResource::collection($emergencies)
        ], 200);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'contacted_via' => 'required|in:message,call',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Ambil user
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication is required to create an emergency request. Please login first.'
            ], 401);
        }

        $emergency = EmergencyRequest::create([
            'contacted_via' => $request->contacted_via,
            'user_id' => $user->id,
            'notification_status' => 'unread'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => new EmergencyRequestResource($emergency)
        ], 201);
    }

    public function show($id) {
        $emergency = EmergencyRequest::find($id);

        if (!$emergency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => new EmergencyRequestResource($emergency)
        ], 200);
    }

    public function update(Request $request, $id) {
        $emergency = EmergencyRequest::find($id);
    
        if (!$emergency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'status' => ['nullable', Rule::in(['in_progress', 'completed'])],
            'notification_status' => ['nullable', Rule::in(['unread', 'read'])],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
    
        $data = [];
    
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }
    
        if ($request->has('notification_status')) {
            $data['notification_status'] = $request->notification_status;
        }
    
        $emergency->update($data);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully updated',
            'data' => new EmergencyRequestResource($emergency)
        ], 200);
    }
    

    public function destroy($id) {
        $user = auth('api')->user();
        $emergency = EmergencyRequest::find($id);
    
        if (!$emergency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }
    
        if ($user->role === 'user' && $user->id !== $emergency->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to delete this data.'
            ], 403);
        }
    
        $emergency->delete();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully deleted'
        ], 200);
    }
    

}
