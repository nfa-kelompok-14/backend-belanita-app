<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerchandiseController extends Controller
{
    public function index() {
        $merchandises = Merchandise::all();

        // Error handling
        if ($merchandises->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => $merchandises
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
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $image = $request->file('image');
        $image->store('merchandises', 'public');

        $merchandise = Merchandise::create([
            'name' => $request->name,
            'image' => $image->hashName(),
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

    public function show($id) {
        $merchandise = Merchandise::find($id);

        if (!$merchandise) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $merchandise
        ], 200);
    }

    public function update(Request $request, $id) {
        $merchandise = Merchandise::find($id);

        if (!$merchandise) {
        return response()->json([
            'status' => 'failed',
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
            'status' => 'failed',
            'message' => $validator->errors()
        ], 422);
    }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('merchandises', 'public');
            $merchandise->image = $image->hashName();
    }

        $merchandise->update($request->except('image'));

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
            'status' => 'failed',
            'message' => 'Data not found'
        ], 404);
    }

        if ($merchandise->image) {
        \Storage::disk('public')->delete('merchandises/' . $merchandise->image);
    }

        $merchandise->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully deleted'
        ], 200);
    }

}
