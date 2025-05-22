<?php

namespace App\Http\Controllers;

use App\Models\MerchandiseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MerchandiseOrderController extends Controller
{
    public function index() {
        $orders = MerchandiseOrder::all();

        // Error handling
        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => $orders
            ], 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer',
            'total_price' => 'required|integer',
            'status' => ['required', Rule::in(['pending', 'paid', 'shipped', 'completed'])],
            'users_id' => 'required|exists:users,id',
            'merchandise_id' => 'required|exists:merchandises,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $order = MerchandiseOrder::create([
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'users_id' => $request->users_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $order
        ], 201);
    }
}
