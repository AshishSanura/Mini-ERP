<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('auth.login');
});

// User Roles Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Sales-Person Sales-Orders CRUD
    Route::resource('sales_orders', SalesOrderController::class)->only(['index', 'create', 'store']);

    // Sales-Person Sales-Orders PDF Export
    Route::get('sales_orders/{salesOrder}/export', [SalesOrderController::class, 'exportPdf'])->name('sales_orders.export');
});

// Admin Or Sales-Person Dashboard 
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Products CRUD 
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});