<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index() {
        $complaints = Complaint::all();

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
            'description' => 'required|string',
            'status' => ['required', Rule::in(['pending', 'processed', 'completed'])],
            'users_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $complaint = Complaint::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status,
            'users_id' => $request->users_id
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
            'status' => ['sometimes', Rule::in(['pending', 'processed', 'completed'])],
            'users_id' => 'sometimes|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
        ], 422);
    }

        $complaint->update($request->all());

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
