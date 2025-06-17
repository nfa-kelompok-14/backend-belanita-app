<?php

namespace App\Http\Controllers;

use App\Http\Resources\MerchandiseResource;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class MerchandiseController extends Controller
{
    public function index() {
        $merchandises = Merchandise::with('merchandiseCategory')->get();

        // Error handling
        if ($merchandises->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => MerchandiseResource::collection($merchandises),
            ], 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'merchandise_categories_id' => 'required|exists:merchandise_categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('merch', $filename, 'public');
            $imagePath = 'storage/' . $path;
        }

        $merchandise = Merchandise::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'merchandise_categories_id' => $request->merchandise_categories_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $merchandise
        ], 201);
    }

    public function show($slug) {
        $merchandise = Merchandise::where('slug', $slug)->first();

        if (!$merchandise) {
        return response()->json([
            'status' => 'error',    
            'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => new MerchandiseResource($merchandise)
        ], 200);
    }

    public function update(Request $request, $id) {
        $merchandise = Merchandise::find($id);

        if (!$merchandise) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data not found'
        ], 404);
    }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:100',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|integer',
            'stock' => 'sometimes|required|integer',
            'merchandise_categories_id' => 'sometimes|required|exists:merchandise_categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'merchandise_categories_id' => $request->merchandise_categories_id,
        ];

        // Hapus gambar lama kalau upload gambar baru
        if ($request->hasFile('image')) {
            if ($merchandise->image && $merchandise->image !== 'storage/merch/default.png') {
                $oldPath = str_replace('storage/', '', $merchandise->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('merch', $filename, 'public');
            $merchandise->image = 'storage/' . $path;
        }

        $merchandise->update($request->except('image'), $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully updated',
            'data' => $merchandise
        ], 200);
    }

    public function destroy($id) {
        $merchandise = Merchandise::find($id);

        if (!$merchandise) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data not found'
        ], 404);
    }

        if ($merchandise->image) {
            Storage::disk('public')->delete('merchandises/' . $merchandise->image);
    }

        $merchandise->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully deleted'
        ], 200);
    }

}
