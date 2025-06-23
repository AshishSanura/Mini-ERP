@extends('layouts.app')
@section('title', 'Product Details')
@section('content')

<h2>Product Details</h2>

<table class="table table-bordered w-50">
    <tr>
        <th>Name:</th>
        <td>{{ $product->name }}</td>
    </tr>
    <tr>
        <th>SKU:</th>
        <td>{{ $product->sku }}</td>
    </tr>
    <tr>
        <th>Price:</th>
        <td>₹{{ $product->price }}</td>
    </tr>
    <tr>
        <th>Quantity:</th>
        <td>{{ $product->quantity }}</td>
    </tr>
</table>

<a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>

@endsection
