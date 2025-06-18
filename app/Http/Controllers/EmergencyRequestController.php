<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmergencyRequestResource;
use App\Models\EmergencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmergencyRequestController extends Controller
{
    public function index() {
        $emergencies = EmergencyRequest::with('user')->get();

        // Error handling
        if ($emergencies->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => EmergencyRequestResource::collection($emergencies)
            ], 200);
        }
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'contacted_via' => 'required|in:message,call',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
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
            'lat' => $request->lat,
            'long' => $request->long,
            'notification_status' => 'pending'
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
            'status' => ['required', Rule::in(['pending', 'notified', 'resolved'])],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }


        $data = [
            'notification_status' => $request->status,
            'user_id' => $request->user_id ?? $emergency->user_id,
            'contacted_via' => $emergency->contacted_via, 
            'lat' => $emergency->lat, 
            'long' => $emergency->long
        ];

        $emergency->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data successfully updated',
                'data' => new EmergencyRequestResource($emergency)
        ], 200);
    }

    public function destroy($id) {
        $emergency = EmergencyRequest::find($id);

        if (!$emergency) {
                return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        $emergency->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully deleted'
        ], 200);
    }

}
