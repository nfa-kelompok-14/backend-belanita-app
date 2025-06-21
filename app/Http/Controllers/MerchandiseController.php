<?php

namespace App\Http\Controllers;

use App\Http\Resources\MerchandiseResource;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class MerchandiseController extends Controller
{
    public function index() {
        $query = Merchandise::with('merchandiseCategory');

        $query->orderBy('created_at', 'desc');

        $merchandises = $query->get();

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
           'price' => 'required|numeric|min:0',
            'stock' => 'required|integer',
            'merchandise_category_id' => 'required|exists:merchandise_categories,id'
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
            $path = $file->storeAs('merchandises', $filename, 'public');
            $imagePath = '' . $path;
        }

        $merchandise = Merchandise::create([
            'name' => $request->name,
            'image' => $imagePath,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'merchandise_category_id' => $request->merchandise_category_id
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
            'merchandise_category_id' => 'sometimes|required|exists:merchandise_categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'name',
            'description',
            'price',
            'stock',
            'merchandise_category_id',
        ]);

        // Hapus gambar lama kalau upload gambar baru
        if ($request->hasFile('image')) {
            if ($merchandise->image && $merchandise->image !== 'merchandises/default.png') {
                $oldPath = str_replace('', '', $merchandise->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('merchandises', $filename, 'public');
            $merchandise->image = '' . $path;
        }

        if ($request->filled('name')) {
            $merchandise->name = $request->name;
            $merchandise->slug = Str::slug($request->name);
        }

        $merchandise->update($data);

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
