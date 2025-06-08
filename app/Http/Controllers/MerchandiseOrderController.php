<?php

namespace App\Http\Controllers;

use App\Models\MerchandiseOrder;
use App\Models\Merchandise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MerchandiseOrderController extends Controller
{
    public function index() {
        $orders = MerchandiseOrder::with('user' , 'merchandise')->get();

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
        'merchandise_id' => 'required|exists:merchandise,id',
        'quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }

    $user = auth()->user();
        if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
        }
    $merchandise = Merchandise::findOrFail($request->merchandise_id);

    if ($merchandise->stock < $request->quantity) {
        return response()->json([
            'status' => 'error',
            'message' => 'Stock tidak mencukupi.',
        ], 400);
    }

    // Hitung total harga
    $totalPrice = $merchandise->price * $request->quantity;

    // Buat pesanan
    $order = MerchandiseOrder::create([
        'user_id' => $user->id,
        'merchandise_id' => $merchandise->id,
        'quantity' => $request->quantity,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);

    // Kurangi stok
    $merchandise->stock -= $request->quantity;
    $merchandise->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Pesanan berhasil dibuat.',
        'data' => $order
    ], 201);
}


    public function show($id) {
        $order = MerchandiseOrder::with('user' , 'merchandise')->find($id);
    
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
    
    public function update(Request $request, $id) {
        $order = MerchandiseOrder::with('user' , 'merchandise')->find($id);
    
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'quantity' => 'sometimes|required|integer',
            'total_price' => 'sometimes|required|integer',
            'status' => ['sometimes', 'required', Rule::in(['pending', 'paid', 'shipped', 'completed'])],
            'users_id' => 'sometimes|required|exists:users,id',
            'merchandise_id' => 'sometimes|required|exists:merchandises,id'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
    
        $order->update($request->all());
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully updated',
            'data' => $order
        ], 200);
    }

    public function destroy($id) {
        $order = MerchandiseOrder::with('user' , 'merchandise')->find($id);
    
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
