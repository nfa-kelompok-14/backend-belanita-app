<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with(['user', 'feedbacks'])->get();

        if ($complaints->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => ComplaintResource::collection($complaints)
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'description' => 'required|string',
            'location' => 'sometimes|string|nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
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

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('article', $filename, 'public');
            $imagePath = 'storage/' . $path;
        }



        $complaint = Complaint::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id,
            'image' => $imagePath,
            'location' => $request->location ?? null
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $complaint
        ], 201);
    }

    public function show($id) {
        $complaint = Complaint::with(['user', 'feedbacks'])->find($id);
        

        if (!$complaint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => new ComplaintResource($complaint)
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
            'location' => 'sometimes|string|nullable'
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

        // Hapus gambar lama kalau upload gambar baru
        if ($request->hasFile('image')) {
            if ($complaint->image && $complaint->image !== null) {
                $oldPath = str_replace('storage/', '', $complaint->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengaduan', $filename, 'public');
            $complaint->image = 'storage/' . $path;
        }


        $data = [
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id,
            'location' => $request->location ?? null
        ];

        $complaint->update($request->only('subject', 'description', 'status', 'location'), $data);

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
