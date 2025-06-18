<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'sometimes|string|nullable',
            'phone' => 'required|string',
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
            $path = $file->storeAs('pengaduan', $filename, 'public');
            $imagePath =  $path;
        }

        $complaint = Complaint::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id,
            'date' => $request->date,
            'phone' => $request->phone,
            'image' => $imagePath,
            'location' => $request->location ?? null
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $complaint
        ], 201);
    }

    public function show($id)
    {
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

    public function update(Request $request, $id)
    {
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
            'location' => 'sometimes|string|nullable',
            'date' => 'sometimes|date',
            'phone' => 'required|string',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048'
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


        if ($request->hasFile('image')) {
            if ($complaint->image) {
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


        $complaint->update([
            'subject' => $request->subject ?? $complaint->subject,
            'description' => $request->description ?? $complaint->description,
            'status' => $request->status ?? $complaint->status,
            'location' => $request->location ?? $complaint->location,
            'phone' => $request->phone ?? $complaint->phone,
            'date' => $request->date ?? $complaint->date,
            'user_id' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Complaint successfully updated.',
            'data' => $complaint
        ], 200);
    }

    public function destroy($id)
    {
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

    public function userComplaints()
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        $complaints = Complaint::where('user_id', $user->id)->with(['feedbacks'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'User complaints retrieved',
            'data' => ComplaintResource::collection($complaints)
        ], 200);
    }

}
