<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (Auth::check() && Auth::user()->role === 'admin')
        @section('content')
            <div class="container mt-4">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Total Sales</h5>
                                <p class="card-text fs-4">₹{{ number_format($totalSales, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Total Orders</h5>
                                <p class="card-text fs-4">{{ $totalOrders }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">Low Stock Products</h5>
                                @foreach($lowStockProducts as $product)
                                    <p class="card-text fs-4">{{ $product->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @if($lowStockProducts->isNotEmpty())
                    <div class="alert alert-warning">
                        <strong>Low Stock Alert:</strong>
                        <ul class="mb-0">
                            @foreach($lowStockProducts as $product)
                                <li>{{ $product->name }} (Qty: {{ $product->quantity }})</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endsection
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
