<?php

namespace App\Http\Controllers;

use App\Models\MerchandiseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerchandiseCategoryController extends Controller
{
    public function index() {
        $categories = MerchandiseCategory::all();

        // Error handling
        if ($categories->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => $categories
            ], 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $category = MerchandiseCategory::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $category
        ], 201);
    }
}
