<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\MerchandiseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MerchandiseOrderController extends Controller
{
    public function index() {
        $orders = MerchandiseOrder::with('user' ,'merchandise')->get();

        // Error handling
        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'error',
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
            'quantity' => 'required|integer|min:1',
            'merchandise_id' => 'required|exists:merchandises,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $uniqueCode = "ORD-" . strtoupper(uniqid());

        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication is required to place an order. Please login first.'
            ], 401);
        }

        // Cek stok barang
        $merch = Merchandise::find($request->merchandise_id);

        if ($merch->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => "Merchandise is out of stock."
            ], 400);
        }

        // Kalkulasi total harga
        $totalPrice = $merch->price * $request->quantity;
        $merch->stock -= $request->quantity;
        $merch->save();

        $order = MerchandiseOrder::create([
            'order_number' => $uniqueCode,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id,
            'merchandise_id' => $request->merchandise_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $order
        ], 201);
    }

    public function show($id) {
        $order = MerchandiseOrder::find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $order
        ], 200);
    }

    public function update(Request $request, string $id) {
        $order = MerchandiseOrder::find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'sometimes|required|integer',
            'merchandise_id' => 'sometimes|required|exists:merchandises,id'
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
                'message' => 'Authentication is required to replace an order. Please login first.'
            ], 401);
        }

        // Cek stok barang
        $merch = Merchandise::find($request->merchandise_id);

        if ($merch->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                "message" => "Merchandise is out of stock."
            ], 400);
        }

        // Kalkulasi total harga
        $totalPrice = $merch->price * $request->quantity;
        $merch->stock -= $request->quantity;
        $merch->save();

        $data = [
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => $request->status ?? 'pending',
            'user_id' => $user->id,
            'merchandise_id' => $request->merchandise_id
        ];

        $order->update($request->only('quantity', 'merchandise_id'), $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully updated',
            'data' => $order
        ], 200);
    }

    public function destroy($id) {
        $order = MerchandiseOrder::find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully deleted'
        ], 200);
    }

}
