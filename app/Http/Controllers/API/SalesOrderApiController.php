<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSalesOrderRequest;

class SalesOrderApiController extends Controller
{
    public function store(StoreSalesOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $total = 0;

            $order = SalesOrder::create([
                'user_id' => auth()->id(),
                'total_amount' => 0 // temp, will update later
            ]);

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $product->decrement('quantity', $item['quantity']);

                $lineTotal = $product->price * $item['quantity'];
                $total += $lineTotal;

                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);
            }

            $order->update(['total_amount' => $total]);

            DB::commit();

            return response()->json([
                'message' => 'Sales order created successfully.',
                'order_id' => $order->id,
                'total_amount' => $total
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        $order = SalesOrder::with(['items.product', 'user'])->find($id);
        
        if (!$order) {
            return response()->json(['error' => 'Sales order not found.'], 404);
        }

        return response()->json([
            'order_id' => $order->id,
            'user' => $order->user->name,
            'created_at' => $order->created_at->format('Y-m-d'),
            'items' => $order->items->map(function ($item) {
                return [
                    'product' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->price * $item->quantity
                ];
            }),
            'total_amount' => $order->total_amount
        ]);
    }

}
