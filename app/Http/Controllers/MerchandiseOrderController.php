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
            'quantity' => 'required|integer',
            'total_price' => 'required|integer',
            'status' => ['required', Rule::in(['pending', 'paid', 'shipped', 'completed'])],
            'users_id' => 'required|exists:users,id',
            'merchandise_id' => 'required|exists:merchandises,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $order = MerchandiseOrder::create([
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'users_id' => $request->users_id,
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
    
    public function update(Request $request, $id) {
        $order = MerchandiseOrder::find($id);
    
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
