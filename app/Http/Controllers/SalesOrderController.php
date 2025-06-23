<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSalesOrderRequest;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = SalesOrder::with('items')->where('user_id', Auth::id())->get();
        return view('SalesPerson.SalesOrders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('SalesPerson.SalesOrders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($request->products as $item) {
                $product = Product::find($item['id']);
                if ($product->quantity < $item['quantity']) {
                    return back()->withErrors(['stock' => "Insufficient stock for {$product->name}"]);
                }
                $total += $product->price * $item['quantity'];
            }

            $order = SalesOrder::create([
                'user_id' => Auth::id(),
                'total_amount' => $total
            ]);

            foreach ($request->products as $item) {
                $product = Product::find($item['id']);
                $product->decrement('quantity', $item['quantity']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);
            }

            DB::commit();
            return redirect()->route('sales_orders.index')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * export Pdf the specified resource from storage.
     */
    public function exportPdf(SalesOrder $salesOrder)
    {
        $order = $salesOrder->load(['items.product', 'user']); // eager load relationships

        $pdf = Pdf::loadView('SalesPerson.SalesOrders.pdf', compact('order'));
        return $pdf->download('Sales Orders #'.$order->id.'.pdf');
    }
}
