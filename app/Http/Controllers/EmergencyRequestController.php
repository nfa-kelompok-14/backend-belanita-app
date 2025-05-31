<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmergencyRequestController extends Controller
{
    public function index() {
        $emergencies = EmergencyRequest::all();

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
                'data' => $emergencies
            ], 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'contacted_via' => ['required', Rule::in(['message', 'call'])],
            'users_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $emergency = EmergencyRequest::create([
            'contacted_via' => $request->contacted_via,
            'users_id' => $request->users_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $emergency
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
            'data' => $emergency
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
            'contacted_via' => ['sometimes', 'required', Rule::in(['message', 'call'])],
            'users_id' => 'sometimes|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
        ], 422);
    }

        $emergency->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Data successfully updated',
                'data' => $emergency
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
