@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')

<h2>Edit Product</h2>

<form method="POST" action="{{ route('admin.products.update', $product) }}">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" value="{{ old('name', $product->name) }}">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>SKU</label>
        <input name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
        @error('sku') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $product->price) }}">
        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input name="quantity" type="number" class="form-control" value="{{ old('quantity', $product->quantity) }}">
        @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
