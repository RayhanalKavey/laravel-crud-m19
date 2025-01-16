<!-- View a specific product's details -->
@extends('Layout.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Product Image -->
        <div class="flex justify-center mb-6">
            @if($product->image)
                <img src="{{ asset("storage/{$product->image}" ) }}" alt="Product Image" class="h-64 w-64 object-cover rounded-lg shadow-lg">
            @else
                <div class="h-64 w-64 bg-gray-200 flex items-center justify-center rounded-lg shadow-lg">
                    <span class="text-gray-500">No Image Available</span>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-6">{{ $product->description ?: 'No description available.' }}</p>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Price -->
            <div>
                <span class="block text-gray-500 font-medium">Price:</span>
                <p class="text-lg text-gray-800 font-semibold">${{ number_format($product->price, 2) }}</p>
            </div>

            <!-- Stock -->
            <div>
                <span class="block text-gray-500 font-medium">Stock:</span>
                <p class="text-lg text-gray-800 font-semibold">{{ $product->stock }} units</p>
            </div>
        </div>

        <!-- Back and Edit Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Back to Products</a>
            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit Product</a>
        </div>
    </div>
</div>
@endsection