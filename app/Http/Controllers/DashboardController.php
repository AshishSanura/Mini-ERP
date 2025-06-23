<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = SalesOrder::sum('total_amount');
        $totalOrders = SalesOrder::count();
        $lowStockProducts = Product::where('quantity', '<=', 10)->get();
        $lowStockCount = $lowStockProducts->count();

        return view('dashboard', compact(
            'totalSales', 'totalOrders', 'lowStockCount', 'lowStockProducts'
        ));
    }
}
