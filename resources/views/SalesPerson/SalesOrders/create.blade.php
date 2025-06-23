@extends('layouts.app')
@section('title', 'Create Sales Order')

@section('content')
<div class="mb-3">
    <h2>Create Sales Order</h2>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('sales_orders.store') }}">
    @csrf

    <div class="table-responsive mb-3">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Available Quantity</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>
                            {{ $product->name }} (₹{{ $product->price }})
                            <input type="hidden" name="products[{{ $index }}][id]" value="{{ $product->id }}">
                        </td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <input type="number" name="products[{{ $index }}][quantity]" class="form-control" min="0" value="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-success">Submit Order</button>
</form>
@endsection
