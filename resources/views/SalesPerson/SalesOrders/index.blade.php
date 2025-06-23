@extends('layouts.app')
@section('title', 'Sales Orders')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Sales Orders</h2>
    <a href="{{ route('sales_orders.create') }}" class="btn btn-primary">+ Add Order</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->isEmpty())
    <div class="alert alert-info">No orders found.</div>
@else
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Order ID</th>
                <th>Total Amount (₹)</th>
                <th>Items</th>
                <th>Download Sales Order</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>₹{{ $order->total_amount }}</td>
                    <td>
                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->product->name }} (Qty: {{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('sales_orders.export', $order) }}" class="btn btn-sm btn-secondary">Download PDF</a>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
