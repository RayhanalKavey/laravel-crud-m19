@extends('Layout.app')

@section('content')
<div class="container mx-auto max-w-5xl py-10">
    <div class="bg-white p-8  space-y-8">
        <!-- Product Image -->
        <div class="flex justify-center mb-8">
            @if($product->image)
                <img src="{{ asset("storage/{$product->image}" ) }}" alt="Product Image" class="h-64 w-64 object-cover rounded-lg shadow-lg">
            @else
                <div class="h-64 w-64 bg-gray-200 flex items-center justify-center rounded-lg shadow-lg">
                    <span class="text-gray-500">No Image Available</span>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-8 text-center">{{ $product->description ?: 'No description available.' }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Price -->
            <div class="flex flex-col">
                <span class="block text-lg font-medium text-gray-600">Price:</span>
                <p class="text-2xl text-gray-800 font-semibold">${{ number_format($product->price, 2) }}</p>
            </div>

            <!-- Stock -->
            <div class="flex flex-col">
                <span class="block text-lg font-medium text-gray-600">Stock:</span>
                <p class="text-2xl text-gray-800 font-semibold">{{ $product->stock }} units</p>
            </div>
        </div>

        <!-- Back and Edit Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-sm text-fuchsia-700 hover:underline">← Back to Products</a>
            <a href="{{ route('products.edit', $product->id) }}" class="bg-fuchsia-900 text-white px-6 py-3 rounded-lg hover:bg-fuchsia-800 transition">Edit Product</a>
        </div>
    </div>
</div>
@endsection
