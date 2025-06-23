@extends('layouts.app')
@section('title', 'Products')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>SKU</th>
            <th>Price (₹)</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5">No products found.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
