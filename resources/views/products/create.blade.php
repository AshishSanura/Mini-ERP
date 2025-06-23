@extends('layouts.app')
@section('title', 'Create Product')
@section('content')

<h2>Create Product</h2>

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" value="{{ old('name') }}">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>SKU</label>
        <input name="sku" class="form-control" value="{{ old('sku') }}">
        @error('sku') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input name="price" type="number" step="0.01" class="form-control" value="{{ old('price') }}">
        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input name="quantity" type="number" class="form-control" value="{{ old('quantity') }}">
        @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
