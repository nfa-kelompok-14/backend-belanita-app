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
}
